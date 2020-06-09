@extends('layout')
@section('pageTitle', 'To-Do List')
@section('content')
<div class="container">
        <todo-list :todo="{{ $todoList }}"></todo-list>
        <footer class="text-right col-md-10">Developed by Muslehuddin Juned. <a href="https://www.sustipe.com">www.sustipe.com</a></footer>
</div>
@endsection
