<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function home() {
        $user = Auth::user();
        if ($user->role === "admin") {
        $users = User::all();
        }

        return view("admin.dashboard", [
            "users"=>$users ?? null
        ]);
    }
}
