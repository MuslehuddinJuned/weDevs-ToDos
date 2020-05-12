@extends('layout')
@section('pageTitle', 'To-Do List')
@section('content')
<div class="container">
    <todo :todo="{{ $todo }}"></todo>
</div>
@endsection
