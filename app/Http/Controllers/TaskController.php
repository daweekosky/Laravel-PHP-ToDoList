<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('user_id', '=', \Auth::user()->id)->get();
        return view('dashboard',['tasks'=>$tasks]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task;
        return view('form',['task'=>$task]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required|min:5|max:40',
                                    'description' => 'required|min:0|max:255',
                                    'date' => 'date',
        ]);
        if(\Auth::user() == null){
            return view('home');
        }

        $task = new Task();
        $task->user_id = \Auth::user()->id;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->end_date = $request->enddate;
        $task->is_done = 0;
        if($task->save()){
            return redirect('dashboard');
        }
        return view('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        if (\Auth::user()->id != $task->user_id) {
            return back()->with(['success' => false, 'message_type' => 'danger','message' => 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.']);
        }
        return view('edittask', ['task'=>$task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if(\Auth::user()->id != $task->user_id){
            return back()->with(['success' => false, 'message_type' => 'danger','message' => 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.']);
        }
        $task->title = $request->title;
        $task->description = $request->description;
        $task->end_date = $request->enddate;
        if($task->save()) {
            return redirect()->route('dashboard');
        }
        return "Wystąpił błąd.";
    }

    public function update2(Request $request, $id)
    {
        $task = Task::find($id);
        if(\Auth::user()->id != $task->user_id){
            return back()->with(['success' => false, 'message_type' => 'danger','message' => 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.']);
        }
        $task->is_done = 1;
        if($task->save()) {
            return redirect()->route('dashboard');
        }
        return "Wystąpił błąd.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Znajdź komentarz o danych id:
        $task = Task::find($id);
        if(\Auth::user()->id != $task->user_id){
            return back();
        }
        if($task->delete()){
            return redirect()->route('dashboard');
        }
        else return back();
    }
}
