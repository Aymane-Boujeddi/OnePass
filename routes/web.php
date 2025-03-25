<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Mail;
use App\Mail\WarningEmail;

Route::get('/login', function () {
    if (RateLimiter::tooManyAttempts('send-message:'.request()->ip(), $perHour = 5)) {
        $seconds = RateLimiter::availableIn('send-message:'.request()->ip());
     
        Mail::to('badrdine03@gmail.com')->send(new WarningEmail());
        return 'You may try again in '.$seconds.' seconds.'.'user ip is '.request()->ip();
    }

    RateLimiter::increment('send-message:'.request()->ip());
});



