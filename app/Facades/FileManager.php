<?php

namespace App\Facades;

use App\Modules\Storage\Storage;
use Illuminate\Support\Facades\Auth;

class FileManager
{
    public static function save($file, $type, $redirect = null)
    {
        $storage = new Storage();

        if($storage->sizeСheck($file, $redirect)) {
            return $storage->save($file, $type);
        }
    }

    public static function loader($files, $entity, $id)
    {
        $file_ids = [];
        foreach ($files as $file) {
            $path = FileManager::save($file, 'file', true);
            $file_id = \App\Models\File::query()->insertGetId([
                $entity.'_id' => $id,
                'name' => $file->getClientOriginalName(),
                'src' => $path
            ]);
            array_push($file_ids, $file_id);
        }
        return $file_ids;
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
