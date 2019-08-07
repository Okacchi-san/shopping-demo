<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        
        return view('admin.user_admin', ['users' => $users]);
    }
    
    public function destroy(Request $request)
    {
        $userId = $request->userId;
        $user = User::find($userId);
        
        $user->delete();
        
        return back();
    }
    
}
