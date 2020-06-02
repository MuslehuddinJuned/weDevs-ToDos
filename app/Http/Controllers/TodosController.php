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
        $todoList = Todo::orderBy('created_at','asc')->get();
        $todoList_count = Todo::where('complete', null)->count();       
        return view('./todo', compact('todoList', 'todoList_count'));
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
        $Todo = new Todo;
        $Todo->name = $request['name'];
        $Todo->save();

        $todoList = Todo::orderBy('created_at','asc')->get(); 
        $todoList_count = Todo::where('complete', null)->count(); 

        if(request()->expectsJson()){
            return response()->json([
                'todoList' => $todoList,
                'NewTask' => $Todo,
                'todoList_count' => $todoList_count
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
        $Todo = Todo::find($todo->id);        

        if($request['name']){
            $todo->name = $request['name'];
            $todo->save();
        }

        else {
            $todo->complete = $request['complete'];
            $todo->save();
        }
            $todoList = Todo::orderBy('created_at','asc')->get();
            $todoList_count = Todo::where('complete', null)->count(); 

            if(request()->expectsJson()){
                return response()->json([
                    'todoList' => $todoList,
                    'todoList_count' => $todoList_count
                ]);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == 'complete')
        Todo::where('complete', 'Yes')->delete();        

        else{
            $todo = Todo::find($id);
            $todo->delete();
        }
        
        $todoList = Todo::orderBy('created_at','asc')->get();
        $todoList_count = Todo::where('complete', null)->count(); 

        if(request()->expectsJson()){
            return response()->json([
                'todoList' => $todoList,
                'todoList_count' => $todoList_count
            ]);
        }
    }
}
