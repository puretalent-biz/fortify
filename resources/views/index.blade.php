@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @auth()

                @if( ! auth()->user()->two_factor_secret )
                    You have not enabled 2fa.

                <form method="post" action="{{ url('user/tow-factor-authentication') }}">
                    @csrf

                    <button type="submit" class="btn btn-primary">Enable</button>
                </form>

                @else
                    You have 2fa enabled.

                    @if(session('status') == 'tow-factor-authentication-enabled')
                        
                        <p>You have now enabled 2fa, please scan then following QR code into your phones authenticator application.</p>

                        {!! auth()->user()->towFactorQrCodeSvg() !!}

                        <p>Please store theses recovery codes in a secure location.</p>
                        @foreach(json_decode(decrypt(auth()->user()->tow_factor_recovery_codes, true)) as $code)

                            {{ trim($code) }}

                        @endforeach

                    @endif

                @endif

            @endauth

        </div>
    </div>
</div>
@endsection