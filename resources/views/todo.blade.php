@extends('layout')
@section('pageTitle', 'To-Do List')
@section('content')
<div class="container">
        <todo-list :todo="{{ $todo }}"></todo-list>
</div>
@endsection
