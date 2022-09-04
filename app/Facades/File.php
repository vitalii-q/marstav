<?php

namespace App\Facades;

use App\Modules\Files\Storage;
use Illuminate\Support\Facades\Auth;

class File
{
    public static function save($file, $type, $redirect = null)
    {
        $storage = new Storage();

        if($storage->sizeСheck($file, $redirect)) {
            return $storage->save($file, $type);
        }
    }

    public static function delete($file)
    {
        $storage = new Storage();
        $storage->delete($file);
    }

    public static function date($file)
    {
        $storage = new Storage();
        return $storage->date($file);
    }
}
