@extends('layouts.app')
@section('content')
<div class = "page">
 <div class = "menu">
    <div class = "logo">
     <div class = "orda_mail"><p>orda mail</p></div>
     <img class = "imgPanel" src="{{ asset('2052760.png') }}">
    </div>

    <div class = "panel">
     <img class = "imgPanel" src="{{ asset('plus-sign-comments-plus-icon-svg-1166617.png') }}">
     <div class = "newMessage"><p><a href = "{{route('new')}}">Написати</a></p></div>
    </div>
    <div class = "panel">
     <img class = "imgPanel" src="{{ asset('1594964.png') }}">
     <div class = "newMessage"><p><a href="{{route('index')}}">Діалоги</a></p></div>
   </div>
 </div>
  <div class = "mails">
      @foreach($users as $user)
        <div class="row">
            <div class="col-9">
                <a href="{{route('dialog', ['id'=>$user->id])}}"><b>{{$user->email}}</b></a>
                {{$user->message}}
            </div>
        </div>
      @endforeach
  </div>
</div>
@endsection
