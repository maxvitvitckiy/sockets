@extends('layouts.app')
@section('content')
    <div class = "page">
        <div class = "menu">
            <div class = "logo">
                <div class = "orda_mail"><p>orda mail</p></div>
                <img class = "imgPanel"  src="{{ asset('2052760.png') }}">
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
            <form onsubmit="sendMessage(this.value)" method="post">
                @csrf
                <div class="row">
                    <div class="col-11">
                        <textarea id="message" placeholder="Написати..." name="message"></textarea>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <p><strong>Виникла помилка</strong></p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="col-1" style="display:flex; justify-content: center">
                        <button class="btn" type="submit"><i class="fa-solid fa-paper-plane" style="font-size: 1.7em"></i></button>
                    </div>
                </div>
            </form>
            <div id="messages">
                @foreach($messages as $message)
                    <div class="row">
                        <div class="col-9">
                            <b>{{$message->getFrom()}}:</b>
                            {{$message->message}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
<script>
    let socket = new WebSocket("ws://192.168.0.107:8080");
    let room = 0
    console.log(123)
    if({{$id}} > {{Auth::user()->id}}) {
        room = '{{$id}}_{{Auth::user()->id}}'
    }
    else {
        room = '{{Auth::user()->id}}_{{$id}}'
    }

    function sendMessage() {
        let message = document.getElementById("message");
        console.log(message.value)

        socket.send('{"type": "message", "room": "' + room + '", "value": "'+message.value+'"}')
    }

    socket.onopen = function () {
        console.log('123')
        socket.send('{"type": "connection", "value": "'+ room+ '"}')
    };

    socket.onclose = function (event) {
        console.log("123");
    };

    socket.onmessage = function (event) {
        let messages = document.getElementById("messages");
        let message = '<div class="row">' +
            '<div class="col-9">' +
            '<b>' + "{{\App\Models\User::where("id", $id)->first()->email}}" + ':</b>' + event.data +
            '</div>' +
            '</div>'

        messages.insertAdjacentHTML('beforebegin', message);
    };

    socket.onerror = function (event) {
    };

</script>
