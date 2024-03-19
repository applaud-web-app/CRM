<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class EmployeeBirthdayNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employeebirthdayNotification:every_day';

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
        $today = Carbon::today();
        $employee = User::withoutRole('Superadmin')->whereMonth('dob', $today->month)->whereDay('dob', $today->day)->get();
        if(count($employee)){
            foreach ($employee as $value) {
                $userEmail = $value->email;
                $userName = $value->first_name." ".$value->last_name;
                $data = [
                    'name'=>$userName,
                    'image'=>$value->profile_img
                ];
                Mail::send('email.Birthday', ['data'=>$data], function ($message) use($userEmail,$userName){
                    $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
                    $message->to($userEmail, $userName)->subject('🎉 Happy Birthday '. $userName.'  🎉');
                });
            }
        }
    }
}
