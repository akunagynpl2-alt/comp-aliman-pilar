<?php

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

RateLimiter::for('contact', function (Request $request) {
    return Limit::perHour(5)->by($request->ip())
                ->response(function () {
                    return back()->withErrors(['form' => 'Terlalu banyak percobaan pengiriman. Silakan coba lagi dalam 1 jam.']);
                });
});

RateLimiter::for('admin-login', function (Request $request) {
    return Limit::perMinute(5)->by($request->ip());
});
