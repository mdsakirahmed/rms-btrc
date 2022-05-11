@extends('layouts.frontend.app')
@section('content')
    <div style="float: right; background: #D3D2D6; height: 100%; width: 30%;">
        <div style="margin-top: 40vh; text-align: center">
            <img src="assets/frontend/images/logo.png" width="100">
            <p style="color: #0A0A0A; font-weight: bold; margin: 10px 0px 30px 0px;">Bangladesh Telecommunication <br> Regulatory Commission </p>
            <a href="{{ route('login') }}" style="background: rgba(23,103,38,0.96); padding: 10px 30px 10px 30px; color: white; font-weight: bold; text-decoration: none; border-radius: 5px;">Login</a>
        </div>
    </div>
@endsection
