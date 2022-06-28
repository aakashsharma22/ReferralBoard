<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invite;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $referralToken = session('referralToken');
        $successfulReferredCount = 0;

        $user = User::where('unique_referral_code', $referralToken)->first();

        //If invited user
        if(!empty($user)) {
            $successfulReferredCount = $user->getSuccessfulReferral() + 1;

            $user->update(['successful_referral' => $successfulReferredCount]);

            $invite = Invite::where(['user_id' => $user->id, 'email' => $data['email']])->first();

            //If someone else registered using the token
            if(empty($invite)) {
                Invite::create([
                    'user_id' => $user->getId(),
                    'email' => $data['email'],
                    'status' => 'user registered'
                ]);
            } else {
                $invite->update([
                    'status' => 'user registered'
                ]);
            }
        }

        do {
            $token = Str::random(16);
        } while (User::where('unique_referral_code', $token)->first());

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'unique_referral_code' => $token
        ]);
    }
}
