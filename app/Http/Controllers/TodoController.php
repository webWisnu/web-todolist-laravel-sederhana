<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;


class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $max_data = 4;

        if (request('search')) {

            $todos = $user->todos()->where('name', 'like', '%' . request('search') . '%')
                ->paginate($max_data)->withQueryString();
        } else {

            $todos = $user->todos()->orderBy('name', 'asc')->paginate($max_data)
                ->withQueryString();
        }

        if ($request->has('from_date') && $request->has('to_date')) {
            $todos = $todos->whereBetween('created_at', [
                $request->input('from_date'),
                $request->input('to_date')
            ]);
        }

        return view('todo.index', compact('todos'));
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:3|max:50'
            ],
            [

                'name.min' => 'minimal 4 karakter',
                'name.max' => 'maximal 50 karakter',
            ]
        );

        $todo = Todo::create([
            'name' => $request->name,
            'user_id' => Auth::id(),

        ]);

        $todo->save();
        notify()->success('Data Berhasil Masuk');
        return redirect()->route('todo');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => 'required|min:3|max:50'
            ],
            [

                'name.min' => 'minimal 4 karakter',
                'name.max' => 'maximal 50 karakter',
            ]
        );

        $todo = [
            'name' => $request->name,
            'is_done' => $request->is_done,

        ];


        Todo::where('id', $id)->update($todo);

        notify()->success('Data Berhasil di Perbarui');
        return redirect()->route('todo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Todo::where('id', $id)->delete();
        notify()->success('Data Berhasil di Hapus');
        return redirect()->route('todo');
    }
}
