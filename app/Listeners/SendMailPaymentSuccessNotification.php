<?php

namespace App\Listeners;

use App\Events\ApprovalPaymentEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailPaymentSuccessNotification
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
     * @param  \App\Events\ApprovalPaymentEvent  $event
     * @return void
     */
    public function handle(ApprovalPaymentEvent $event)
    {
        $payment_info = $event->payment_info;
        Mail::send('admin.ticket.send_mail',compact('payment_info'),function ($email) use ($payment_info) {
            $email->subject('Nhà Xe Thu Đức - Xác nhận thanh toán đặt vé');
            $email->to($payment_info->email_passenger,$payment_info->name_passenger);
        });
    }
}
