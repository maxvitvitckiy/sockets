@extends('layouts.app')
@section('content')
    <div class="page">
        <div class="menu">
            <div class="logo">
                <div class="orda_mail"><p>orda mail</p></div>
                <img class="imgPanel" src="./img/2052760.png">
            </div>

            <div class="panel">
                <img class="imgPanel" src="{{ asset('plus-sign-comments-plus-icon-svg-1166617.png') }}">
                <div class="newMessage"><p><a href="newMes.html">Написати</a></p></div>
            </div>
            <div class="panel">
                <img class="imgPanel" src="{{ asset('1594964.png') }}">
                <div class="newMessage"><p><a href="{{route('index')}}">Діалоги</a></p></div>
            </div>
        </div>
        <div class="mails">
            <form onsubmit="createDialog(this.value)" method="post">
                @csrf
                <div class="row">
                    <div class="col-2">
                        {{ Form::select("email", $emails) }}
                    </div>
                    <div class="col-1" style="display:flex; justify-content: center">
                        <button class="btn" type="submit"><i class="fa-solid fa-paper-plane"
                                                             style="font-size: 1.7em"></i></button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
