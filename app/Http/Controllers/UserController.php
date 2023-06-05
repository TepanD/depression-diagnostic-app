<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function show_all_users()
    {
        $users = User::where('id', '!=', auth()->id())->paginate(10);
        return view('users.index', compact('users'));
    }

    public function update_user_role(Request $request){
        if($request->ajax()){
            $user = User::findOrFail($request->user_id);

            $user->update([
                'role'=> $request->role
            ]);

            echo "successfully updated role";
        }
    }
}
