<?php

namespace App\Console\Commands;

use App\Helpers\Common;
use App\Models\Followup;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class FollowupNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'follow-up:every_day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Follow up notification to user one day before';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $common=new Common();
        date_default_timezone_set("Asia/Calcutta");
        $userid = Auth::id();
        $next24hr = Carbon::now()->addHour(24);
        $sendReminder = Followup::select('id','added_by','next_followup')->where('reminder24hr',0)->whereBetween('next_followup',[Carbon::now(),$next24hr])->get();
        
        foreach ($sendReminder as $value) {
            $common->followupReminder($value->added_by);
            Followup::where('id',$value->id)->update(["reminder24hr"=>1]);
        }
        
    }
}
