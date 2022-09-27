<?php
namespace App\Http\Controllers\Entities;

use App\Helpers\Converter;
use App\Helpers\Regular;
use App\Http\Controllers\Controller;
use App\Models\DealStage;
use App\Models\Entities\Deal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $stages = DealStage::query()->where('user_id', $user->id)->where('title', '!=', null)
            ->where('color', '!=', null)->where('position', '!=', null)->orderBy('position')->get();

        return view('entities.deals.deals', compact('user', 'stages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'max:255',
            'phone' => 'max:255',
            'email' => 'max:255',
            'position' => 'max:255',
            'company' => 'max:255',
            'product' => 'max:255',
            'price' => 'max:255',
            'deadline' => 'date_format:Y-m-d H:i|after:'.date('Y-m-d H:i', strtotime(Carbon::yesterday())).'|nullable',
            'note' => 'max:3000'
        ]);

        $stages = DealStage::query()->where('user_id', $user->id)->where('title', '!=', null)
            ->where('color', '!=', null)->where('position', '!=', null)->orderBy('position')->get();

        $deal_id = Deal::query()->insert([
            'user_id' => $user->id,
            'stage_id' => $stages[0]->id,
            'status' => $request->status,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'position' => $request->position,
            'company' => $request->company,
            'product' => $request->product,
            'price' => $request->price,
            'deadline' => $request->deadline,
            'note' => $request->note,
            'code' => str_replace(' ', '_', strtolower(Converter::transliteration(Regular::removeSymbols(mb_strimwidth($request->name, 0, 40, "..")))))
                .'_'.bin2hex(random_bytes(12))
        ]);

        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'max:255',
            'phone' => 'max:255',
            'email' => 'max:255',
            'position' => 'max:255',
            'company' => 'max:255',
            'product' => 'max:255',
            'price' => 'max:255',
            'deadline' => 'date_format:Y-m-d H:i|after:'.date('Y-m-d H:i', strtotime(Carbon::yesterday())).'|nullable',
            'note' => 'max:3000'
        ]);

        if($request->next == 'true') {
            $next_stage = $this->getNextStage($user, $code);
        }

        $deal = Deal::query()->where('user_id', $user->id)->where('code', $code)->first();
        $deal->update([
            'stage_id' => isset($next_stage)?$next_stage->id:$deal->stage_id,
            'status' => $request->status,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'position' => $request->position,
            'company' => $request->company,
            'product' => $request->product,
            'price' => $request->price,
            'deadline' => $request->deadline,
            'note' => $request->note
        ]);

        return 1;
    }

    protected function getNextStage($user, $code)
    {
        $deal = Deal::query()->where('user_id', $user->id)->where('code', $code)->first();
        $stages = DealStage::query()->where('user_id', $user->id)->where('position', '!=', null)
            ->orderBy('position')->get();

        for ($i=0; $i < count($stages); $i++) {
            if($stages[$i]->id == $deal->stage_id) {
                return $stages[$i+1];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        $user = Auth::user();
        Deal::query()->where('user_id', $user->id)->where('code', $code)->first()->delete();

        return 1;
    }

    public function settings()
    {
        $user = Auth::user();
        $stages = DealStage::query()->where('user_id', $user->id)->where('position', '!=', null)
            ->orderBy('position')->get();
        $stages_no_position = DealStage::query()->where('user_id', $user->id)->where('position', null)->get();
        $stages = $stages->merge($stages_no_position);

        return view('entities.deals.settings', compact('stages'));
    }

    public function addStage()
    {
        $user = Auth::user();
        $stages = DealStage::query()->where('user_id', $user->id)->get();
        $stage = DealStage::query()->insert([
            'user_id' => $user->id,
            'code' => bin2hex(random_bytes(8))
        ]);

        return redirect()->route('deals.settings');
    }

    public function saveStages(Request $request)
    {
        $user = Auth::user();
        foreach ($request->stages as $stage) {
            $stage_obj = new Request();
            $stage_obj->merge([
                'title' => $stage[1],
                'color' => $stage[2],
                'position' => $stage[3],
            ]);

            $stage_obj->validate([
                'title' => 'required|max:255',
                'color' => 'required|max:255',
                'position' => 'required|max:4'
            ]);

            DealStage::query()->where('user_id', $user->id)->where('code', $stage[0])->first()->update([
                'title' => $stage_obj->title,
                'color' => $stage_obj->color,
                'position' => $stage_obj->position
            ]);
        }

        session()->flash('info', 'Настройки этапов сделки сохранены');
        return 1;
    }

    public function deleteStage($code)
    {
        $user = Auth::user();
        $stage = DealStage::query()->where('user_id', $user->id)->where('code', $code)->first();
        Deal::query()->where('user_id', $user->id)->where('stage_id', $stage->id)->delete();
        $stage->delete();

        return 1;
    }
}
