<?php

namespace App\Listeners;

use App\Events\UserCreateEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailCreateUserNotification
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
     * @param  \App\Events\UserCreateEvent  $event
     * @return void
     */
    public function handle(UserCreateEvent $event)
    {
//        dd($event);
        $user = $event->user;
        Mail::send('admin.staff.send_mail',compact('user'),function ($email) use ($user) {
            $email->subject('Nhà Xe Thu Đức - Lấy lại mật khẩu');
            $email->to($user->email,$user->name);
        });
    }
}
