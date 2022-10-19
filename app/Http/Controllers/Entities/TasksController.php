<?php

namespace App\Http\Controllers\Entities;

use App\Facades\FileManager;
use App\Helpers\Converter;
use App\Helpers\Date;
use App\Helpers\Regular;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Entities\Task;
use App\Models\Entities\TaskComment;
use App\Models\Mediators\TaskUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $tasks = Task::query()->select('tasks.*', 'task_user.user_id', 'task_user.responsibility')
            ->join('task_user', 'task_user.task_id', '=', 'tasks.id')
            ->where('task_user.user_id', '=', $user->id)
            ->where('tasks.status', '!=', 'closed')
            ->groupBy('tasks.id')->orderBy('tasks.created_at', 'desc')->paginate(10);

        return view('entities.tasks.tasks', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $company = Company::query()->find($user->company_id);
        if ($company) {
            $employees = User::query()->where('company_id', $company->id)->orderBy('surname')->get();
        } else {
            $employees = User::query()->where('id', $user->id)->get();
        }

        return view('entities.tasks.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->observers[0] == null) {
            $observers = []; $i=0;
            foreach ($request->observers as $observer) {
                if($observer !== null) {
                    array_push($observers, $observer);
                } $i++;
            }
            $request->request->add(['observers' => $observers]);
        }

        $request->validate([
            'title' => 'required|max:255',
            'priority' => 'required|max:255',
            'performer' => 'required|max:255',
            'observers' => 'max:10',
            'observers.*' => 'required|max:255',
            'description' => 'required|max:4000',
            'deadline' => 'date_format:Y-m-d|after:'.date('Y-m-d', strtotime(Carbon::yesterday())).'|nullable',
            'files' => 'max:10',
            'files.*' => 'max:10000'
        ]);

        $user = Auth::user();
        $company = Company::query()->where('id', $user->company_id)->first();

        $task_id = Task::query()->insertGetId([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => 'new',
            'deadline' => $request->deadline,
            'code' => str_replace(' ', '_', strtolower(Converter::transliteration(Regular::removeSymbols(mb_strimwidth($company?$company->name:$user->name, 0, 30)))))
                .'_'.str_replace(' ', '_', strtolower(Converter::transliteration(Regular::removeSymbols(mb_strimwidth($request->title, 0, 20)))))
                .'_'.bin2hex(random_bytes(10)),
            'creator_id' => $user->id
        ]);

        if (isset($request->all()['files'])) {
            FileManager::loader($request->all()['files'], 'task', $task_id);
        }

        $performer = User::query()->where('code', $request->performer)->first();
        TaskUser::query()->insert([
            'task_id' => $task_id,
            'user_id' => $performer->id,
            'responsibility' => 'performer'
        ]);

        foreach ($request->observers as $observer) {
            $employee = User::query()->where('code', $observer)->first();
            if($employee->id !== $performer->id) {
                TaskUser::query()->insert([
                    'task_id' => $task_id,
                    'user_id' => $employee->id,
                    'responsibility' => 'observer'
                ]);
            }
        }

        session()->flash('info', 'Задача добавлена');
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $user = Auth::user();
        $task = Task::get($user->id, $code);
        if (!$task) {
            return view('errors.oops');
        }

        $files = \App\Models\File::query()->where('task_id', $task->id)->get();
        $comments = TaskComment::query()
            ->select('task_comments.*', 'users.name', 'users.surname', 'users.name', 'users.code')
            ->join('users', 'users.id', '=', 'task_comments.user_id')
            ->where('task_id', $task->id)->get();
        $creator = User::query()->where('id', $task->creator_id)->first();
        // TODO: ленивая выгрузка
        $members = User::query()->select('users.*', 'task_user.task_id', 'task_user.user_id', 'task_user.responsibility')
            ->join('task_user', 'users.id', '=', 'task_user.user_id')
            ->where('task_id', $task->id)->get();

        return view('entities.tasks.show', compact('user', 'task', 'files', 'comments', 'creator', 'members'));
    }

    public function transmit(Request $request, $task_code)
    {
        $user = Auth::user();
        $task = Task::get($user->id, $task_code);
        $employee = User::query()->where('company_id', $user->company_id)->where('code', $request->employee)->first();
        if(!$employee) {
            return 1;
        }

        $task_user = TaskUser::query()->where('task_id', $task->id)->get();
        foreach ($task_user as $mediator) {
            if ($mediator->user_id == $user->id) {
                $mediator->update([
                    'responsibility' => 'observer'
                ]);
            }
        }

        $performer = TaskUser::query()->where('task_id', $task->id)->where('user_id', $employee->id)->first();

        if ($performer) {
            $performer->update(['responsibility' => 'performer']);
        } else {
            TaskUser::query()->insert([
                'task_id' => $task->id,
                'user_id' => $employee->id,
                'responsibility' => 'performer'
            ]);
        }

        $task->update([
            'status' => 'transmitted'
        ]);

        session()->flash('info', 'Задача передана пользователю '.$employee->surname.' '.$employee->name);
        return 1;
    }

    public function add_member(Request $request, $task_code) {
        $user = Auth::user();
        $task = Task::get($user->id, $task_code);

        if ($task) {
            $employees = User::query()->whereIn('code', $request->employees)->get();

            foreach ($employees as $employee) {
                if(!TaskUser::query()->where('task_id', $task->id)->where('user_id', $employee->id)->first() and
                $employee->company_id == $user->company_id) {
                    TaskUser::query()->insert([
                        'task_id' => $task->id,
                        'user_id' => $employee->id,
                        'responsibility' => 'observer'
                    ]);
                }
            }
        }

        return 1;
    }

    public function comment(Request $request, $code)
    {
        $request->validate([
            'text' => 'required_without:files|max:2000',
            'files' => 'max:10',
            'files.*' => 'max:10000'
        ]);

        $user = Auth::user();
        $task = Task::get($user->id, $code);

        if(!$task) {
            return view('errors.oops');
        }

        $comment_id = TaskComment::query()->insertGetId([
            'user_id' => $user->id,
            'task_id' => $task->id,
            'text' => $request->text
        ]);

        if (isset($request->all()['files'])) {
            FileManager::loader($request->all()['files'], 'comment', $comment_id);
        }

        session()->flash('info', 'Комментарий добавлен');
        return redirect()->back();
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

    public function work($code)
    {
        $user = Auth::user();
        $task = Task::get($user->id, $code);
        $task->update([
            'status' => 'work'
        ]);

        session()->flash('info', 'Статус: в работе');
        return redirect()->back();
    }

    /**
     * Finish task
     *
     * @return void
     */
    public function finish($code)
    {
        $user = Auth::user();
        $task = Task::get($user->id, $code);
        $task->update([
            'status' => 'closed',
            'deleted_at' => Date::now()
        ]);

        $comments = $task->comments();
        $comment_ids = [];
        foreach ($comments as $comment) {
            array_push($comment_ids, $comment->id);
        }
        $files = \App\Models\File::query()->where('task_id', $task->id)->orWhereIn('comment_id', $comment_ids)->get();
        foreach ($files as $file) {
            FileManager::delete($file->src);
        }

        session()->flash('info', 'Задача закрыта');
        return redirect()->back();
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
}
