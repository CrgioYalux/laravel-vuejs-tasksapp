<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostTask;
use App\Models\User;
use Inertia\Response;
use App\Http\Requests\PostTaskRequest;

class PostTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $is_super_admin = in_array('super admin', $request->user()->roles->pluck('name')->toArray());
        $tasks = $is_super_admin
            ? PostTask
            ::join('users', 'users.id', '=', 'post_tasks.assigned_to_user_id')
            ->join('posts', 'posts.id', '=', 'post_tasks.post_id')
            ->select('users.name as user_name', 'post_tasks.*', 'posts.body as body')
            ->get()
            : PostTask
            ::join('users', 'users.id', '=', 'post_tasks.assigned_to_user_id')
            ->join('posts', 'posts.id', '=', 'post_tasks.post_id')
            ->select('users.name as user_name', 'post_tasks.*', 'posts.body as body')
            ->where(
                    'assigned_to_user_id',
                    '=',
                    $request->user()->id
            )
            ->get();

        return inertia('Tasks/Index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $is_super_admin = in_array('super admin', $request->user()->roles->pluck('name')->toArray());
        $created_by_user_id = $request->user()->id;
        $users = $is_super_admin
            ? User::where('id', '!=', $request->user()->id)->select('id', 'name')->get()
            : [];

        return inertia('Tasks/Create', [
            'created_by_user_id' => $created_by_user_id,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\PostTaskRequest
     * @return \Illuminate\Http\Response
     */
    public function store(PostTaskRequest $request)
    {
        try {
            User::findOrFail($request->assigned_to_user_id);

            $post = Post::create([
                'body' => $request->body,
                'created_by_user_id' => $request->created_by_user_id
            ]);

            PostTask::create([
                'post_id' => $post->id,
                'title' => $request->title,
                'assigned_to_user_id' => $request->assigned_to_user_id
            ]);
        }
        catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            about(404, "The User was not found");
        }

        return redirect()->route('tasks.index');
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
