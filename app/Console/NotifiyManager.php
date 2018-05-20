<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User_service;
use App\User_service_assignment;
use Carbon\Carbon;
class NotifiyManager extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'NotifiyManager:NotifiyManager';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify Manager befor 2 days about salary';

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
        $all_salaries = \App\Salary::all();
        $total_salary = 0;
        foreach ($all_salaries as $key => $value) {
            $total_salary += $value->total_salary;
        }

        $this->info('Notified Success');
        return $total_salary;
        
        //$this->info('Hourly Update has been send successfully');
    }

}
