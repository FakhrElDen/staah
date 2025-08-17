<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
//     $response = Http::withHeaders([
//         'Content-Type' => 'application/json',
//     ])->post('https://getyourweb.staah.net/common-cgi/Simulator/Services.pl', [
//         "propertyid" => "934001",
//         'apikey' => 'GeT-aPi-DemoY-U1V8-bdt-03gEp-u1D8a4Y',
//         'action' => 'property_info',
//         "version"=> "2"
//     ]);

//     dd([
//         'status' => $response->status(),
//         'body' => $response->body(),
//     ]);
    return view('welcome');
});
