<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function store(Request $request)
    {
        // dd($request->all());
        Todo::create([
            'item' => $request->item,
        ]);

        Session::flash('success', 'Success!');
        return redirect()->route('welcome');
    }

    public function edit($id)
    {
        Todo::find($id)->update([
            'task' => 'done'
        ]);

        Session::flash('done', 'Good Job!');
        return redirect()->route('welcome');
    }

    public function revert($idTodo)
    {
        Todo::find($idTodo)->update([
            'task' => null
        ]);

        Session::flash('warning', 'Reverted!');
        return redirect()->route('welcome');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Todo::find($id)->delete();

        Session::flash('delete', 'Deleted!');
        return redirect()->route('welcome');
    }
}
