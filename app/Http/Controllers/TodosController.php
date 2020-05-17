<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use DB;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todo = Todo::orderBy('created_at','asc')->get();
        $todoRemain = DB::select('SELECT * FROM `todos` where complete IS NULL');

        return view('./todo', compact('todo', 'todoRemain'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            // $newtask = $request->user()->todos()->create();

            $Todo = new Todo;
            $Todo->name = $request['name'];
            $Todo->save();

            if(request()->expectsJson()){
                return response()->json([
                    'NewTask' => $Todo
                ]);
            }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        // print_r($request);
        // dd($request); 
        // $todo->update($request);
        $Todo = Todo::find($todo->id);
        if($request['complete'])
        $todo->complete = $request['complete'];
        if($request['name'])
        $todo->name = $request['name'];
        if(!$request['name'] && !$request['complete'])
        $todo->complete = NULL;
        $todo->save();
        // $todoList = Todo::orderBy('created_at','asc')->get();

        if(request()->expectsJson()){
            return response()->json([
                // 'todoList' => $todoList
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        // if(request()->expectsJson()){
        //     return response()->json([
        //         'message' => "Deleted"
        //     ]);
        // }
    }
}
