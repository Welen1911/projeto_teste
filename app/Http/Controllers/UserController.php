<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id) {
        $user = User::findOrFail($id);

        return response()->json($user, 200);
        // return view('events.user', ['user' => $user]);
    }

    public function showAll() {
        $users = User::all();

        return response()->json($users, 200);
    }
}
