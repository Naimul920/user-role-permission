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
    public $data;

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
    public function edit($id){
        $this->users = User::get();
        $this->roles = Role::get();
        $this->user= User::find($id);
        $this->userRoles = $this->user->roles->pluck('name','name')->all();
        return view('admin.user.edit',['users'=>$this->users,'roles'=>$this->roles,'user'=>$this->user,'userRoles'=>$this->userRoles]);
    }
    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required|string|max:255',
            'password'=>'max:255',
            'confirm_password'=>'same:password|max:255',
            'roles'=>'required',
        ]);
        $this->data=[
            'name'=> $request->name,
            'email'=> $request->email,
        ];
        if (!empty($request->password)){
            $this->data+=[
                'password'=>Hash::make($request->password),
            ];
        }

        $this->user=User::find($id);
        $this->user->update($this->data);
        $this->user->syncRoles($request->roles);
        return redirect('/add-user')->with('message', 'User update successful');
    }
    public function destroy($id){
        $this->user = User::find($id);
        $this->user->delete();
        return redirect('/add-user')->with('message', 'User delete successful');
    }
}
