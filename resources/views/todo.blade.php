@extends('layout')
@section('pageTitle', 'To-Do List')
@section('content')
<div class="container">
        <todo-list 
                :todoremain="{{ json_encode($todoRemain)}}" 
                :todo="{{ json_encode($todo) }}"
                :todocomplete="{{ json_encode($todoComplete) }}">
        </todo-list>
        <footer class="text-right col-md-10">Developed by Muslehuddin Juned. <a href="https://www.sustipe.com">www.sustipe.com</a></footer>
</div>
@endsection
