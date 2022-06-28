@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Invite a user
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" action="{{route('processInvitation')}}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email IDs</label>
                                <input type="email" class="form-control" multiple name="emails" placeholder="email@email.com">

                                @if (isset($hasError) && $hasError)
                                    <div class="alert alert-danger">
                                        <small>{{ $message }}</small>
                                    </div>
                                @elseif((isset($hasError) && !$hasError))
                                    <div class="alert alert-info">
                                        <small>{{ $message }}</small>
                                    </div>
                                @else
                                    <small>We'll never share your email with anyone else.</small>
                                @endif

                            </div>
                            <button type="submit" class="btn btn-success">Send Invitation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
