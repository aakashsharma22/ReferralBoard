@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <tr>
                        <td align="center" width="90%">
                            <table width="90%">
                                <tr>
                                    <td ><u>Referrer</u></td>
                                    <td ><u>Email Referred</u></td>
                                    <td ><u>Date</u></td>
                                    <td ><u>Status</u></td>
                                </tr>
                                @foreach($invites as $invite)

                                    <tr>
                                        <td>{{ $invite['referrer'] }}</td>
                                        <td>{{ $invite['email_referred'] }}</td>
                                        <td>{{ date_format(date_create($invite['created_at']), "jS M Y ") }}</td>
                                        <td>{{ $invite['status'] }}</td>

                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
