<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\jobs\MailTest;
use Artisan;

class MailData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Data Mail';

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
        //
    }
}
