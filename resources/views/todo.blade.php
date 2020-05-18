@extends('layout')
@section('pageTitle', 'To-Do List')
@section('content')
<div class="container">
        <todo-list 
                :todoremain="{{ json_encode($todoRemain)}}" 
                :todo="{{ json_encode($todo) }}"
                :todocomplete="{{ json_encode($todoComplete) }}">
        </todo-list>
</div>
@endsection
