<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .loader {
        position: relative;
        border: 0.5rem solid gray;
        border-radius: 50%;
        border-top: 0.5rem solid rgb(29, 161, 242);
        width: 3rem;
        height: 3rem;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        }
        @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
        }

        /* Add animation to "page content" */
        .animate-bottom {
        position: relative;
        -webkit-animation-name: animatebottom;
        -webkit-animation-duration: 1s;
        animation-name: animatebottom;
        animation-duration: 1s
        }

        @-webkit-keyframes animatebottom {
        from { bottom:-100px; opacity:0 } 
        to { bottom:0px; opacity:1 }
        }

        @keyframes animatebottom { 
        from{ bottom:-100px; opacity:0 } 
        to{ bottom:0; opacity:1 }
        }
    </style>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
</head>
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<body>
    <div id="error">
        <h1>Você não parece estar logado :( <br> faça login <a href="/login">clicando aqui</a></h1>
    </div>
    <div id="app">
        <app-main></app-main>
    </div>
    <script>
        var currentUser = {!!session('user')!!}
        let app = document.querySelector("#app");
        let error = document.querySelector("#error");
        currentUser != undefined ? error.remove():app.remove();

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('1274225ed523873978b3', {
        cluster: 'mt1'
        });
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>