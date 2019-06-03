<?php

namespace Raftx24\Healthy\Checkers;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Raftx24\Healthy\Support\Jobs\PrinterCheckJob;
use Raftx24\Healthy\Support\StorageHelper;
use Storage;

class JobCheck extends Check
{

    public function check()
    {
        $queues = config("healthy.job.queues") ?: app('config')['queue.default'];
        $queues = collect(explode(",", $queues));
        $this->healthy = true;
        foreach ($queues as $q) {
            $isQueueHealthy = true;
            $path = $this->createTimeStampFile("queue_" . $q);
            dispatch(new PrinterCheckJob())->onQueue($q);
            if ((time() - strtotime(Storage::get($path))) > (config("healthy.job.threshold") * 60)) {
                $this->healthy = false;
                $isQueueHealthy = false;
            }
            $this->log[] = [
                "queue" => $q,
                "isHealthy" => $isQueueHealthy,
                "last_checked_time" => Storage::get($path)
            ];
        }
        return $this;
    }


}
