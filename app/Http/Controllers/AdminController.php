<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index()
    {
        $users = User::where('role', 'normal')->get();
        $totalProducts = Product::count();
        return view('admin.index', compact('users', 'totalProducts'));
    }

    public function sina($id){
        $sins = DB::table('signales')->where('user_id2', $id)->get();
        return view('admin.sina', ['sins' => $sins]);
    }

    public function tables(){
        $users = User::where('role', 'normal')->get();
        return view('admin.tables', compact('users'));
    }


    public function makeAdmin($id)
    {
    $user = User::findOrFail($id);
    $user->role = 'admin';
    $user->save();

    return redirect()->back()->with('message', 'User has been made an admin.');
    }

    public function deleteUser($id)
    {
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->back()->with('message', 'User has been deleted.');
    }
}
