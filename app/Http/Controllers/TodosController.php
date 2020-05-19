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
        $todoRemain = Todo::where('complete', NULL)->get();
        $todoComplete = Todo::where('complete', 'Yes')->get();

        return view('./todo', compact('todo', 'todoRemain', 'todoComplete'));
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

        $IncompleteList = Todo::where('complete', NULL)->get();

        if(request()->expectsJson()){
            return response()->json([
                'IncompleteList' => $IncompleteList,

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
        $Todo = Todo::find($todo->id);        

        if($request['name']){
            $todo->name = $request['name'];
            $todo->save();
        }

        else {
            $todo->complete = $request['complete'];
            $todo->save();
        }
            $FullList = Todo::orderBy('created_at','asc')->get();
            $IncompleteList = Todo::where('complete', NULL)->get();
            $CompleteList = Todo::where('complete', 'Yes')->get();

            if(request()->expectsJson()){
                return response()->json([
                    'FullList' => $FullList,
                    'IncompleteList' => $IncompleteList,
                    'CompleteList' => $CompleteList
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
        
        $FullList = Todo::orderBy('created_at','asc')->get();
        $IncompleteList = Todo::where('complete', NULL)->get();
        $CompleteList = Todo::where('complete', 'Yes')->get();

        if(request()->expectsJson()){
            return response()->json([
                'FullList' => $FullList,
                'IncompleteList' => $IncompleteList,
                'CompleteList' => $CompleteList
            ]);
        }
    }
}
