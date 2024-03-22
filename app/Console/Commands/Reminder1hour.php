<?php

namespace App\Console\Commands;

use App\Helpers\Common;
use App\Models\Followup;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class Reminder1hour extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'follow-up:before_an_hour';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Follow up notification to user before 1 hour';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $common=new Common();
        date_default_timezone_set("Asia/Calcutta");
        $userid = Auth::id();
        $next1hr = Carbon::now()->addMinutes(60);
        $sendReminder = Followup::select('id','added_by','next_followup')->where('reminder1hr',0)->whereBetween('next_followup',[Carbon::now(),$next1hr])->get();
        foreach ($sendReminder as $value) {
            $common->followupReminder($value->added_by);
            Followup::where('id',$value->id)->update(["reminder1hr"=>1]);
        }
    }
}
