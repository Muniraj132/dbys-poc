<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Event;
use DateTime;

class RegisterController extends Controller
{
   public function getcountry()
   {
   
    $response = Http::get('https://reqres.in/api/users?page=2');
    $data = $response->json();

    $validationErrors = [];
    foreach ($data['data'] as $user) {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'first_name' => 'required||max:255',
            'last_name' => 'nullable|string',
        ];

        $validator = Validator::make($user, $rules);

        if ($validator->fails()) {
            $validationErrors[] = $validator->errors()->toArray();
            continue;
        }
        // If validation passes, store the data
        dd($user);
        $newUser = new User();
        $newUser->email = $user['email'];
        $newUser->username = $user['first_name'];
        $newUser->comments = $user['last_name'];
        $newUser->password = Hash::make($user['last_name']);
        $newUser->save();
    }


    if (!empty($validationErrors)) {

        return response()->json(['errors' => $validationErrors], 422);
    }

    return response()->json(['message' => 'Registered successfully']);

    }
    public function getevents(){

        $Events = Event::orderBy('id','desc')->where('status','publish')->get();
        $baseImageUrl =asset('Eventresource_files/');
        $response = [];
        foreach ($Events as $item) {
            
            $startdateTime = new DateTime($item->start_datetime);
            $startdate = $startdateTime->format('d-m-Y'); // 2023-08-16
            $starttime = $startdateTime->format('h:i A'); // 05:39 PM
            $startformattedDateTime = $startdate . ' ' . $starttime; // 2023-08-16 05:39 PM

            $enddateTime = new DateTime($item->end_datetime);
            $enddate = $enddateTime->format('d-m-Y'); // 2023-08-16
            $endtime = $enddateTime->format('h:i A'); // 05:39 PM
            $endformattedDateTime = $enddate . ' ' . $endtime; // 2023-08-16 05:39 PM

            $response[] = [
                'id' => $item->id,
                'name' => $item->title,
                'image_url' => $baseImageUrl .'/'. $item->image,
                'Description'=> strip_tags($item->description),
                'Startdate & time'=>$startformattedDateTime,
                'enddate & time'=>$endformattedDateTime,
                'Location'=>$item->location,
            ];
        }

        return response()->json($response);
    }
   }

