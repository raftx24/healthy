<?php

namespace Raftx24\Healthy\Checkers;

use Storage;

class ScheduleCheck extends Check
{
    public function check()
    {
        $this->healthy = true;
        $path = $this->createTimeStampFile("schedule");
        if ((time() - strtotime(Storage::get($path))) > (config("healthy.schedule.threshold") * 60)) {
            $this->healthy = false;
        }
        $this->log =  [
            "file" => "schedule",
            "isHealthy" => $this->healthy,
            "last_checked_time" => Storage::get($path)
        ];
        return $this;
    }
}