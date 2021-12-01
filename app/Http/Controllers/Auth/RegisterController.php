<?php

namespace App\Http\Controllers\Auth;

use App\Events\RegistrationConfirmationEvent;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param RegisterRequest $request
     * @return null
     */
    protected function index(RegisterRequest $request)
    {
        $userId = DB::table('users')->insertGetId([
            'fullName'   => $request['fullName'],
            'userName'   => $request['userName'],
            'email'      => $request['email'],
            'phone'      => $request['phone'],
            'password'   => bcrypt($request['password']),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($userId) {
            event(new RegistrationConfirmationEvent($request['email'], $request['fullName']));
        }

        return response()->json(['status' => 201, 'message' => 'User has been created successfully.'], 201);

    }
}
