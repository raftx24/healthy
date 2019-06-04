<?php

namespace Raftx24\Healthy\Http\Controllers;

use Illuminate\Routing\Controller;
use Raftx24\Healthy\Checkers\Check;
use Raftx24\Healthy\Checkers\ScheduleCheck;
use Raftx24\Healthy\Checkers\JobCheck;
use Response;


class HealthController extends Controller
{
    public function readiness()
    {
        $start = microtime(true);

        $health = true;
        $result = [
            "status" => "successfully",
            "result" => "pong",
            "health" => true,
            "log" => [],
        ];
        /** @var JobCheck $check */
        foreach ($this->getChecks() as $check) {
            $check->check();
            $result["health"] &= $check->isHealthy();
            $result["log"][] = $check->getLog();

        }
        $result["time"] = (int)((microtime(true) - $start) * 1000);
        return Response::json($result, $health ? 200 : 500);
    }

    public function liveness()
    {
        return Response::json([
            "status" => "successfully"
        ]);
    }

    /**
     * @return Check[]
     */
    private function getChecks(): array
    {
        $checks = [];
        if (config("healthy.job.enabled")) {
            $checks[] = new JobCheck();
        }
        if (config("healthy.schedule.enabled")) {
            $checks[] = new ScheduleCheck();
        }
        return $checks;
    }
}
