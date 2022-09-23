<?php
namespace App\Http\Controllers\Entities;

use App\Http\Controllers\Controller;
use App\Models\DealStage;
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

        return view('entities.deals.deals');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function settings()
    {
        $user = Auth::user();
        $stages = DealStage::query()->where('user_id', $user->id)->orderBy('position')->get();

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
        $stages = [];
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

            $stage = [
                'user_id' => $user->id,
                'title' => $stage_obj->title,
                'color' => $stage_obj->color,
                'position' => $stage_obj->position
            ];
            array_push($stages, $stage);
        }

        DealStage::query()->where('user_id', $user->id)->delete();
        DealStage::query()->insert($stages);

        return $stages;
    }
}
