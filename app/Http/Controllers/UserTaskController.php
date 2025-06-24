<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserTaskController extends Controller
{
    public function showTasks($id)
    {
        $user = User::with('tasks')->findOrFail($id);
        return view('user.tasks', compact('user'));
    }
}
