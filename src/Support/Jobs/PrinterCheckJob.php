<?php


namespace Raftx24\Healthy\Support\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Raftx24\Healthy\Support\StorageHelper;
use Storage;

class PrinterCheckJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        StorageHelper::createStorageFolder("app/health");
        $fileQueue = Storage::path("health/queue_".$this->job->getConnectionName());
        file_put_contents($fileQueue,date("Y-m-d H:i:s"));
    }
}