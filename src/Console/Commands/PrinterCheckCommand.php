<?php


namespace Raftx24\Healthy\Console\Commands;


use Raftx24\Healthy\Support\StorageHelper;
use Storage;

use Illuminate\Console\Command;

class PrinterCheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:print';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        StorageHelper::createStorageFolder("app/health");
        $path = "health/schedule";
        $date = date("Y-m-d H:i:s");
        echo $date;
        file_put_contents(Storage::path($path), $date);
        chmod(Storage::path($path),0777);
    }
}
