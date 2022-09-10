<?php

namespace App\Modules\Files;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class Storage
{
    /**
     * KB
     *
     * @var int
     */
    protected $maxSize = 20000000;

    public function save($file, $type)
    {
        $user = Auth::user();
        $company = Company::query()->find($user->company_id);

        $unique_code = bin2hex(random_bytes(4));
        $file_name = explode('.', $file->getClientOriginalName())[0];
        $file_extension = $file->extension();

        if ($company) {
            $path = 'companies/'.$company->code.'/'.$type.'s/'.$file_name.'_'.$unique_code.'.'.$file_extension;
            \Illuminate\Support\Facades\Storage::disk('public')->put($path, file_get_contents($file));
        } else {
            $path = 'users/'.$type.'s/'.$user->code.'/'.$file_name.'_'.$unique_code.'.'.$file_extension;
            \Illuminate\Support\Facades\Storage::disk('public')->put($path, file_get_contents($file));
        }

        return '/storage/'.$path;
    }

    public function delete($file)
    {
        if (file_exists($file)) {
            unlink($file);
        }
    }

    public function sizeСheck($file, $redirect)
    {
        if(filesize($file) > $this->maxSize) {
            if($redirect) {
                session()->flash('error', 'Максимальный размер загружаемых файлов '.mb_substr($this->maxSize, 0, 2).' магабайт');
                header('Location: '.back()->getTargetUrl().' ');
            }
            return false;
        }

        return true;
    }

    /**
     * Get the date of change
     *
     * @return void
     */
    public function date($file)
    {
        if (file_exists($file)) {
            return date('F d Y h:i A', filectime($file));
        }
    }

    /**
     * Check user or company storage limit and delete files
     *
     * @return void
     */
    public function checkStorage() {
        /**
         * TODO: Проверка занятого простанства доступного пользователю / компании
         */
    }
}
