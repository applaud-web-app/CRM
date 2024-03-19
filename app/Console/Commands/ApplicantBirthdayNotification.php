<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Leads;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ApplicantBirthdayNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'applicantbirthdayNotification:every_day';

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
        $applicants = Leads::where('proccess_status','approved')->whereMonth('dob',$today->month)->whereDay('dob',$today->day)->get();
        if(count($applicants)){
            foreach ($applicants as $value) {
                $applicantName = $value->name;
                $profileImg = $value->profile_img;
                $applicantEmail = $value->email;
                $data = [
                    'name'=>$applicantName,
                    'image'=>$profileImg
                ];
                Mail::send('email.Birthday', ['data'=>$data], function ($message) use($applicantName,$applicantEmail){
                    $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
                    $message->to($applicantEmail, $applicantName);
                    $message->subject('🎉 Happy Birthday '. $applicantName.'  🎉');
                });
            }
        }
    }
}
