<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class WorkAnniversary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'workAnniversary:every_day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       $employee = User::withoutRole('Superadmin')->whereDate('joining_date','!=',Carbon::today())->whereMonth('joining_date', '=', Carbon::now()->month)->whereDay('joining_date', '=', Carbon::now()->day)->get();
       if(count($employee)){
        foreach ($employee as $value) {
            $userEmail = $value->email;
            $userName = $value->first_name." ".$value->last_name;
            $data = [
                'name'=>$userName,
            ];
            Mail::send('email.work-anniversary', ['data'=>$data], function ($message) use($userEmail,$userName){
                $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
                $message->to($userEmail, $userName)->subject('🎉 Happy Work Anniversary '. $userName.'  🎉');
            }); 
        }
    }
    }
}
