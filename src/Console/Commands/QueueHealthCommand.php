<?php


namespace Raftx24\Healthy\Console\Commands;


use Raftx24\Healthy\Checkers\JobCheck;
use Raftx24\Healthy\Support\StorageHelper;
use Storage;

use Illuminate\Console\Command;

class QueueHealthCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'health:queue';

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
        $check= new JobCheck();
        $check->check();
        if($check->isHealthy())
            return 0;
        return 1;

    }
}
