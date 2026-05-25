<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>8026-sortables</title>
  <link href="{{ asset('css/reset.css')}}" rel="stylesheet">
  <link href="{{ asset('css/style.css')}}" rel="stylesheet">
</head>
<body>
<div id="wrapper">

<div id="input_form">
@include('layouts.registrations')
</div>

<div id="drag-area">
@include('layouts.drags')
</div>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script src="{{ asset('js/main.js')}}"></script>
</body>
</html>