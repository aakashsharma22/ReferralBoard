@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="form-group">
                        @if (\Illuminate\Support\Facades\Auth::user()->getIsAdmin())
                            <form action="/admin/referrals">
                                <input type="submit" value="Admin Referral Board" />
                            </form>
                        @endif

                        <form action="/user/referrals">
                            <input type="submit" value="User Referral Board" />
                        </form>

                        <form action="/referral_count">
                            <input type="submit" value="Go to Successful Referrals" />
                        </form>

                        <form action="/referrals">
                            <input type="submit" value="Referral Invite Page" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
