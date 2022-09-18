<?php

namespace App\Http\Controllers;

use App\Facades\File;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController
{
    public function index()
    {
        $user = Auth::user();
        $employees = User::query()->where('company_id', $user->company_id)->where('id', '!=', $user->id)->get();

        return view('chat', compact('user', 'employees'));
    }

    public function getDialog($code)
    {
        $user = Auth::user();
        $employee = User::employee($user->company_id, $code);
        $messages = Message::query()->where('from_id', $user->id)->where('to_id', $employee->id)
            ->orWhere('from_id', $employee->id)->where('to_id', $user->id)
            ->orderBy('created_at', 'desc')->limit(10)->get();

        foreach ($messages as $message) {
            $message->time = date('n-j H:i', strtotime($message->created_at));
        }

        // TODO: очередь
        $new_mess = Message::query()->where('from_id', $employee->id)->where('to_id', $user->id)->where('view', null)->get();
        foreach ($new_mess as $new_message) {
            $new_message->update(['view' => 1]);
        }

        return [
            'user' => $user,
            'employee' => $employee,
            'message' => $messages,
            'server_time' => date('n-j H:i', strtotime(\Carbon\Carbon::now()))
        ];
    }

    public function moreMessages(Request $request, $code)
    {
        $user = Auth::user();
        $employee = User::employee($user->company_id, $code);
        $messages = Message::query()->orderBy('created_at', 'desc')
            ->where('from_id', $user->id)->where('to_id', $employee->id)
            ->orWhere('from_id', $employee->id)->where('to_id', $user->id)
            ->offset($request->messages_shown)->limit(10)->get();

        foreach ($messages as $message) {
            $message->time = date('n-j H:i', strtotime($message->created_at));
        }

        return [
            'user' => $user,
            'employee' => $employee,
            'message' => $messages,
            'server_time' => date('n-j H:i', strtotime(\Carbon\Carbon::now()))
        ];
    }

    public function message(Request $request, $code)
    {
        $request->validate([
            'text' => 'required_without:files|max:4000',
            'files' => 'max:10',
            'files.*' => 'max:20000'
        ]);

        $user = Auth::user();
        $employee = User::employee($user->company_id, $code);

        $message_id = Message::query()->insertGetId([
            'company_id' => $user->company_id,
            'from_id' => $user->id,
            'to_id' => $employee->id,
            'text' => $request->text
        ]);

        if (isset($request->all()['files'])) {
            $file_ids = File::loader($request->all()['files'], 'message', $message_id);
            $files = \App\Models\File::query()->select('message_id', 'name', 'src')->whereIn('id', $file_ids)->get();
        }

        $message = Message::find($message_id);
        $message->time = date('n-j H:i', strtotime($message->created_at));

        return [
            'photo' => $user->photo,
            'message' => $message,
            'files' => isset($files) ? $files : null,
            'server_time' => date('n-j H:i', strtotime(\Carbon\Carbon::now()))
        ];
    }
}
