<?php
/**
 * Created by PhpStorm.
 * User: reza
 * Date: 2019-03-12
 * Time: 02:58
 */

namespace Raftx24\Healthy\Support;


class StorageHelper
{
    public static function createStorageFolder($folderName)
    {
        if (!is_dir(storage_path($folderName))) {
            mkdir(storage_path($folderName));
            chmod(storage_path($folderName), 0777);
        }
    }
}