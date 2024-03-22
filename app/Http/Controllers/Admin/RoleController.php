<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public $role;
    public $roles;
    public $permission;
    public $rolePermissions;
    public function index(){
        $this->roles = Role::get();
        return view('admin.role.add',['roles'=>$this->roles]);
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
        ]);
        $this->role = Role::create([
            'name' => $request->name
        ]);

        return redirect('/add-role')->with('message','Role save successful');
    }
    public function edit($id){
        $this->roles = Role::get();
        $this->role = Role::find($id);
        return view('admin.role.edit',['roles'=>$this->roles],['role'=>$this->role]);
    }
    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
        ]);
        $this->role = Role::find($id);
        $this->role->name = $request->name;
        $this->role->save();
        return redirect('/add-role')->with('message','Role update successful');
    }
    public function destroy($id){
        $this->role = Role::find($id);
        $this->role->delete();
        return redirect('/add-role')->with('message','Role delete successful');
    }
    public function addOrEditPermission($id){
        $this->permissions = Permission::get();
        $this->role = Role::find($id);
        $this->rolePermissions= DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id',$this->role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('admin.role.add-permission',['role'=>$this->role, 'permissions'=>$this->permissions, 'rolePermissions'=>$this->rolePermissions]);
    }
    public function givePermissionToRole(Request $request, $id){
        $request->validate([
            'permission'=>'required',
        ]);
        $this->role = Role::find($id);
        $this->role->syncPermissions($request->permission);
        return redirect()->back()->with('message','Permission add to role');
    }
}
