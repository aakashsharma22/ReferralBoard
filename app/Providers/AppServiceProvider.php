<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $emailId = "";
        Validator::extend("emails", function($attribute, $value, $parameters) {
            $rules = [
                'email' => 'required|email',
            ];

            $emails = explode(",", $value);

            foreach ($emails as $email) {
                $data = [
                    'email' => $email
                ];
                $validator = Validator::make($data, $rules);
                if ($validator->fails()) {
                    $emailId = $email;
                    return false;
                }
            }
            return true;
        }, 'Error message - ' . $emailId . ' is not in right format');
    }
}
