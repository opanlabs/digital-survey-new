<?php

namespace App\Console\Commands;

use App\Models\RegisterSurvey;
use App\Models\RegisterClaim;

use Carbon\Carbon;
use App\Notifications\ScheduleNotification;
use Notification;

use Illuminate\Console\Command;

class NotifCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notif:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        //kirim notifikasi jika besok customer ada schedule survey register zoom meeting
        $meetingTomorrow = RegisterSurvey::whereDate('survey_date', '=', Carbon::tomorrow())->get();
        foreach ($meetingTomorrow as $data) {
            $mailData = [
                'name' => $data->customer->customer_name,
                'link' => $data->link_zoom,
                'hours' => Carbon::parse($data->survey_date)->format('H:i')
            ];
            Notification::route('mail',$data->customer->email)->notify(new ScheduleNotification($mailData));
        }

        //kirim notifikasi jika besok customer ada schedule survey claim zoom meeting
        $meetingClaimTomorrow = RegisterClaim::whereDate('survey_date', '=', Carbon::tomorrow())->get();
        foreach ($meetingClaimTomorrow as $data) {
            $mailData = [
                'name' => $data->customer->customer_name,
                'link' => $data->link_zoom,
                'hours' => Carbon::parse($data->survey_date)->format('H:i')
            ];
            Notification::route('mail',$data->customer->email)->notify(new ScheduleNotification($mailData));
        }

        \Log::info("Notifikasi Schedule Harian Sudah Dikirim!");
    }
}
