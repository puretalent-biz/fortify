@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    <p>{{ __('You are logged in!') }}</p>

                    @if( ! auth()->user()->two_factor_secret )
                        <h3>You have not enabled 2fa.</h3>

                        <form method="post" action="{{ url('user/two-factor-authentication') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Enable</button>
                        </form>

                    @else
                        <h3>You have 2fa enabled.</h3>

                        <form method="post" action="{{ url('user/two-factor-authentication') }}" class="mb-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary">Disable</button>
                        </form>

                        {!! auth()->user()->twoFactorQrCodeSvg() !!}

                        <hr class="mb-3">

                        <h4>Please store theses recovery codes in a secure location.</h4>

                        @foreach(json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)

                        <ul class="list-unstyled">
                            <li><code>{{ trim($code) }}</code></li>
                        </ul>

                        @endforeach

                    @endif



                    @if(session('status') == 'two-factor-authentication-disabled')

                    @endif


                    @if(session('status') == 'two-factor-authentication-enabled')
                        
                        <p>You have now enabled 2fa, please scan then following QR code into your phones authenticator application.</p>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
