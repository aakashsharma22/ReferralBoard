<p>
    {{ $referrerName }} has been using ContactOut, and thinks it could be of use for you.

</p>

<p>
    Here’s their invitation link for you:
    <a href="{{ route('userRegistration', $referralToken) }}">Referral Link</a>
</p>

<p>
    ContactOut gives you access to contact details for about 75% of the world’s professionals.

    Great for recruiting, sales, and marketing outreach.

    It’s an extension that works right on top of LinkedIn.

    Here’s their invitation link again:
    <a href="{{ route('userRegistration', $referralToken) }}">Referral Link</a>
</p>
