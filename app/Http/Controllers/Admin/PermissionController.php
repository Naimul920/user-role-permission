<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public $permission;
    public $permissions;
    public function index(){
        $this->permissions = Permission::get();
        return view('admin.permission.add',['permissions'=>$this->permissions]);
    }
    public function store(Request $request){
     $request->validate([
         'name'=>'required',
     ]);
     $this->permission = Permission::create([
         'name' => $request->name
     ]);

     return redirect('/add-permission')->with('message','Permission save successful');
    }
    public function edit($id){
        $this->permissions = Permission::get();
        $this->permission = Permission::find($id);
        return view('admin.permission.edit',['permissions'=>$this->permissions],['permission'=>$this->permission]);
    }
    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
        ]);
        $this->permission = Permission::find($id);
        $this->permission->name = $request->name;
        $this->permission->save();
    return redirect('/add-permission')->with('message','Permission update successful');
    }
    public function destroy($id){
        $this->permission = Permission::find($id);
        $this->permission->delete();
        return redirect('/add-permission')->with('message','Permission delete successful');
    }
}
