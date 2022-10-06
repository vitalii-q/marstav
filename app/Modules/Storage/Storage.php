<?php

namespace App\Modules\Storage;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Storage
{
    /**
     * KB
     *
     * @var int
     */
    protected $maxSize = 10000000;

    public function save($file, $type)
    {
        $user = Auth::user();
        $company = Company::query()->find($user->company_id);

        $unique_code = bin2hex(random_bytes(6));
        $file_name = explode('.', $file->getClientOriginalName())[0];
        $file_extension = $file->extension();

        if ($company) {
            $path = 'companies/'.$company->code.'/'.$type.'s/'.$file_name.'_'.$unique_code.'.'.$file_extension;
            \Illuminate\Support\Facades\Storage::disk('public')->put($path, file_get_contents($file));
        } else {
            $path = 'users/'.$user->code.'/'.$type.'s/'.$file_name.'_'.$unique_code.'.'.$file_extension;
            \Illuminate\Support\Facades\Storage::disk('public')->put($path, file_get_contents($file));
        }

        return '/storage/'.$path;
    }

    public function replace($path, $to)
    {
        $pathExp = explode('/', $path);
        $file_name = end($pathExp); $file_path = '';
        if ($pathExp[0] == '') {
            unset($pathExp[0]);
            if ($pathExp[1] == 'storage') {
                unset($pathExp[1]);
            }
        } elseif ($pathExp[0] == 'storage') {
            unset($pathExp[0]);
        }
        foreach ($pathExp as $pathExpPath) {
            $file_path .= '/'.$pathExpPath;
        }

        if (file_exists('storage'.$file_path) and !file_exists('/storage/'.$to.$file_name)) {
            \Illuminate\Support\Facades\Storage::disk('public')->move($file_path, $to . $file_name);
        }

        return '/storage/'.$to.$file_name;
    }

    public function delete($file)
    {
        $file = mb_substr($file, 1); // обрезаем символ /
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

    public static function getSizeDir($path)
    {
        if(is_dir($path)) {
            $totalsize = 0;
            if ($dirstream = @opendir($path)) {
                while (false !== ($filename = readdir($dirstream))) {
                    if ($filename != "." && $filename != "..")
                    {
                        if (is_file($path."/".$filename))
                            $totalsize += filesize($path."/".$filename);

                        if (is_dir($path."/".$filename))
                            $totalsize += Storage::getSizeDir($path."/".$filename);
                    }
                }
            }
            closedir($dirstream);

            return $totalsize;
        } else {
            return 0;
        }
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
    public function checkStorage(Request $request) {
        $user = User::getWithRate();
        list($space_involved, $space_percents, $style) = User::getStorageInfo($user);

        if ($space_involved + $request->download_size > $user->space) {
            return ['free_space' => false, 'space_involved' => Calculator::bToGb($space_involved), 'space_total' => Calculator::bToGb($user->space), 'space_parcents' => $space_percents, 'style' => $style];
        }

        return ['free_space' => true, 'space_involved' => Calculator::bToGb($space_involved), 'space_total' => Calculator::bToGb($user->space), 'space_parcents' => $space_percents, 'style' => $style];
    }

    public function limitDeleteFiles() {
        // TODO: удаление старых файлов по превышению лимита
    }
}
