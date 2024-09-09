<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil pengguna yang sedang masuk
        $user = Auth::User();

        // Ambil todos yang terkait dengan pengguna yang sedang masuk
        $todos = $user->todos; // Pastikan relasi 'todos' ada di model User

        return view('todo.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:3|max:10'
            ],
            [

                'name.min' => 'minimal 4 karakter',
                'name.max' => 'maximal 10 karakter',
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
                'name' => 'required|min:3|max:10'
            ],
            [

                'name.min' => 'minimal 4 karakter',
                'name.max' => 'maximal 10 karakter',
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
