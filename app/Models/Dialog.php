<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dialog extends Model
{
    use HasFactory;

    protected $fillable = ['user1_id', 'user2_id', 'messages', 'updated_at'];

    public function timeUpdate($user_id, $employee_id)
    {
        $dialog = Dialog::query()
            ->where('user1_id', $user_id)->where('user2_id', $employee_id)
            ->orWhere('user2_id', $user_id)->where('user1_id', $employee_id)->first();
        if ($dialog) {
            $dialog->update([
                'user1_id' => $user_id,
                'user2_id' => $employee_id,
                'messages' => $dialog->messages+1
            ]);
        } else {
            Dialog::query()->insert([
                'user1_id' => $user_id,
                'user2_id' => $employee_id,
                'messages' => 1
            ]);
        }
    }

    public static function getEmployeesSortedByDialogs($user, $dialogs)
    {
        $dialog_emp_ids = [];
        foreach ($dialogs as $dialog) {
            if ($dialog->user1_id == $user->id) {
                array_push($dialog_emp_ids, $dialog->user2_id);
            } else {
                array_push($dialog_emp_ids, $dialog->user1_id);
            }
        }

        $ids_str = ''; $i=0;
        foreach ($dialog_emp_ids as $dialog_emp_id) {
            if ($i!=0) {$ids_str.=',';}
            $ids_str.=$dialog_emp_id;
            $i++;
        }

        $employees = User::query()->where('users.company_id', $user->company_id)
            ->where('company_id', '!=', null)->where('users.id', '!=', $user->id)
            ->whereIn('id', $dialog_emp_ids)->orderBy(DB::raw('FIELD(id, '.$ids_str.')'))->get();
        $employees_without_dialogs = User::query()->where('users.company_id', $user->company_id)
            ->where('company_id', '!=', null)->where('users.id', '!=', $user->id)
            ->whereNotIn('id', $dialog_emp_ids)->orderBy('name')->get();
        return $employees->merge($employees_without_dialogs);
    }
}
