<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Routing\Controller;
use App\Models\Lists;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::with(['list', 'tag']);

        if ($request->has('userId')) {
            $query->where('userId', $request->userId);
        }

        if ($request->has('tagId')) {
            $query->where('tagId', $request->tagId);
        }

        if ($request->has('listId')) {
            $query->where('listId', $request->listId);
        }

        if ($request->has('completed')) {
            $query->where('completed', $request->completed);
        }

        if ($request->has('archived')) {
            $query->where('archived', $request->archived);
        }

        return TaskResource::collection($query->get());
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
        $validated = $request->validate([
            'name' => 'required|string',
            'userId' => 'required|exists:users,id',
            'listId' => 'nullable|exists:lists,id',
            'tagId' => 'nullable|exists:tags,id',
        ]);

        $listId = $validated['listId'] ?? Lists::where('userId', $validated['userId'])->first()->id;

        $task = Task::create([
            'name' => $validated['name'],
            'userId' => $validated['userId'],
            'listId' => $listId,
            'tagId' => $validated['tagId'],
            'completed' => $request->completed ?? false,
        ]);

        return new TaskResource($task);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
