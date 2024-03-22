<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public $users;
    public $user;
    public $roles;

    public function index(){
        $this->users = User::get();
        $this->roles = Role::get();
        return view('admin.user.index',['users'=>$this->users,'roles'=>$this->roles]);
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255|unique:users,email',
            'password'=>'required|string|min:8|max:255',
            'confirm_password'=>'required|same:password|string|min:8|max:255',
            'roles'=>'required',
        ]);
        $this->user=User::create([
                'name' => $request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);
        $this->user->syncRoles($request->roles);
        return redirect('/add-user')->with('message','User create successful');
    }
}
