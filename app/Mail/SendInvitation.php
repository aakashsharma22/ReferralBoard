<?php

namespace App\Mail;

use App\Models\Invite;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $referrerName = $this->user->getName();
        $referralToken = $this->user->getUniqueReferralCode();

        return $this->from(config('app.mail_from_address'), config('app.mail_from_name'))
                    ->subject("$referrerName recommends ContactOut")
                    ->with(['referrerName' => $referrerName,
                            'referralToken' => $referralToken
                    ])
                    ->view('emailInvitation');
    }
}
