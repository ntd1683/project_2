<?php

namespace App\Listeners;

use App\Events\ApplicantOrderEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailOrderNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ApplicantOrderEvent  $event
     * @return void
     */
    public function handle(ApplicantOrderEvent $event)
    {
        $info = $event->info;
        Mail::send('applicant.send_mail_order',compact('info'),function ($email) use ($info) {
            $email->subject('Nhà Xe Thu Đức - Thông Tin Vé Xe');
            $email->to($info->arr_customer['email'],$info->arr_customer['name']);
        });
    }
}
