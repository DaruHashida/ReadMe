<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$heading}}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" >
</head>

<body class="page page--main">
{{$slot}}
<x-footer></x-footer>

<script src={{ asset('js/main.js')}}></script>
</body>
</html>
