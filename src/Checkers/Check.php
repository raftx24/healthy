<?php


namespace Raftx24\Healthy\Checkers;


use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Raftx24\Healthy\Support\StorageHelper;
use Storage;

abstract class Check
{
    protected $healthy;
    protected $log=[];


    /**
     * Check resource.
     *
     * @return self
     */
    abstract public function check();

    /**
     * @return mixed
     */
    public function isHealthy()
    {
        return $this->healthy;
    }

    /**
     * @return array
     */
    public function getLog(): array
    {
        return $this->log;
    }



    protected function createTimeStampFile($fileName)
    {
        StorageHelper::createStorageFolder("app/health");
        $path = "health/".$fileName;
        if(!Storage::exists($path)){
            file_put_contents(Storage::path($path),date("Y-m-d H:i:s"));
            Storage::put($path,date("Y-m-d H:i:s"));
            chmod(Storage::path($path),0777);
        }
        return $path;
    }

}
