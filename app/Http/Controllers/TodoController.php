<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Session::get('todos') ?? [];
        return view('dashboard', ['todos' => $todos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'todoTitle' => 'required|string|max:100',
        ]);
        $todo = [
            'id' => uniqid(),
            'title' => $validated['todoTitle'],
        ];
        $todos = Session::get('todos') ?? [];
        $todos[] = $todo;
        Session::push('todos', $todo);
        return redirect()->route('dashboard.index');
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
        $todos = Session::get('todos') ?? [];
        $todo = collect($todos)->firstWhere('id', $id);
        return view('edit', ['todo' => $todo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'todoTitle' => 'required|string|max:100',
        ]);
        $todos = Session::get('todos') ?? [];
        $todos = array_map(function ($todo) use ($id, $validated) {
            if ($todo['id'] === $id) {
                $todo['title'] = $validated['todoTitle'];
            }
            return $todo;
        }, $todos);
        Session::put('todos', $todos);
        return redirect()->route('dashboard.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todos = Session::get('todos') ?? [];
        $todos = array_filter($todos, function ($todo) use ($id) {
            return $todo['id'] !== $id;
        });
        Session::put('todos', $todos);
        return redirect()->route('dashboard.index');
    }
}
