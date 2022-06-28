<?php


namespace App\Http\Controllers;


use App\Mail\SendInvitation;
use App\Models\Invite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserReferralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('registration');
    }

    public function referralInvite() {
        return view('referralInvite');
    }

    public function processInvitation(Request $request) {
        $user = Auth::user();
        $userId = $user->getId();

        if($user->getSuccessfulReferral() >= 10) {
            throw new \Exception("You have reached the limit of referral invitation");
        }

        $emails = $request->input('emails');
        $emails = explode(",", $emails);

        $validator = Validator::make($request->all(), [
            'emails' => 'emails',
        ]);

        $validator->after(function ($validator) use ($request, $emails, $userId) {
            foreach ($emails as $email) {
                if (Invite::where(['email' => $email, 'user_id' => $userId])->exists()) {
                    $validator->errors()->add('email', 'You have already sent the invitation to '. $email);
                }

                if (User::where(['email' => $email])->exists()) {
                    $validator->errors()->add('email', $email . ' already registered in the system');
                }
            }
        });

        if ($validator->fails()) {
            return redirect(route('referralInvite'))
                ->withErrors($validator)
                ->withInput();
        }

        foreach ($emails as $email) {
            do {
                $token = Str::random(20);
            } while (Invite::where('unique_referral_token', $token)->first());

            $invite = Invite::create([
                'user_id' => $userId,
                'email' => $email,
                'status' => 'invitation sent',
                'unique_referral_token' => $token
            ]);

            Mail::to($email)->send(new SendInvitation($invite, $user));
        }


        return redirect('/user/referrals')->with('success', 'The invitation has been sent successfully');
    }

    public function registration($referralToken)
    {
        $invite = Invite::where('unique_referral_token', $referralToken)->first();

        session(['referralToken' => $referralToken]);
        return view('auth.register', ['invite' => $invite]);
    }

    public function referralCount() {
        $user = Auth::user();
        $successfulReferralCount = $user->getSuccessfulReferral();
        return view('referralCount', ['successfulReferralCount' => $successfulReferralCount]);
    }

    public function userReferralBoard() {
        $user = Auth::user();
        $invite = Invite::where('user_id', $user->getId())->get();
        return view('userReferralBoard', ['invites' => $invite]);
    }

    public function adminReferralBoard() {
        $invites = Invite::leftJoin('users', 'invite.user_id', '=', 'users.id')
            ->select(DB::raw('users.name as referrer, invite.email as email_referred, DATE_FORMAT(invite.created_at, \'%D %b %Y\'), invite.status'))
            ->get();
        return view('adminReferralBoard', ['invites' => $invites]);
    }
}
