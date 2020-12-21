@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        </div>
        <div class="col-md-8 mb-3">
            <p class="login-card-description">Please enter your authentication code to login.</p>

            <form method="post" action="{{ url('/two-factor-challenge') }}">
                @csrf
                <input type="text" name="code" class="form-control" maxlength="6" autofocus />
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-8">
            <p class="login-card-description">Please enter your recovery code to login.</p>

            <form method="post" action="{{ url('/two-factor-challenge') }}">
                @csrf
                <input type="text" name="recovery_code" class="form-control" autofocus />
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection