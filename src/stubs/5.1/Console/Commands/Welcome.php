<?php

namespace $NAMESPACE$\Console\Commands;

use Illuminate\Console\Command;

class Welcome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '$NAME$:go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A demonstration of a simple command';

    /**
     * The drip e-mail service.
     *
     * @var DripEmailer
     */
    protected $drip;

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
        $this->info("Live little man!!!");
    }
}