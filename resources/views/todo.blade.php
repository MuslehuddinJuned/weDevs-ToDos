@extends('layout')
@section('pageTitle', 'To-Do List')
@section('content')
<div class="container">
        <todo-list :todo="{{ json_encode($todoList) }}" :count="{{json_encode($todoList_count)}}"></todo-list>
        <footer class="text-right col-md-10">Developed by Muslehuddin Juned. <a href="https://www.sustipe.com">www.sustipe.com</a></footer>
</div>
@endsection
