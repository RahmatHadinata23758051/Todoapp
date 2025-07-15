<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Tampilkan semua task milik user login
    public function index(Request $request)
    {
        $tasks = $request->user()->tasks()->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    // Tampilkan form tambah task
    public function create()
    {
        return view('tasks.create');
    }

    // Simpan task baru untuk user login
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
            'label' => 'nullable|string|max:50',
            'is_done' => 'nullable|boolean',
        ]);
        $validated['is_done'] = $request->is_done ?? 0;
        $request->user()->tasks()->create($validated);
        return redirect()->route('tasks.index')->with('success', 'Task berhasil ditambahkan!');
    }

    // Tampilkan detail task milik user login
    public function show(Request $request, $id)
    {
        $task = $request->user()->tasks()->findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    // Tampilkan form edit task milik user login
    public function edit(Request $request, $id)
    {
        $task = $request->user()->tasks()->findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    // Update task milik user login
    public function update(Request $request, $id)
    {
        $task = $request->user()->tasks()->findOrFail($id);
        $request->validate([
            'title' => 'required|max:255',
            'deadline' => 'nullable|date',
            'label' => 'nullable|string|max:50',
        ]);
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'label' => $request->label,
            'is_done' => $request->is_done ? 1 : 0,
        ]);
        return redirect()->route('tasks.index')->with('success', 'Task berhasil diupdate!');
    }

    // Hapus task milik user login
    public function destroy(Request $request, $id)
    {
        $task = $request->user()->tasks()->findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task berhasil dihapus!');
    }
}
