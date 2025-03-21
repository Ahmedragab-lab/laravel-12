<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    protected $models = ['roles', 'admins', 'users', 'settings', 'products', 'categories','colors','sizes'];
    protected $permissionMaps = ['create', 'read', 'update', 'delete'];
    public function index()
    {
        $data = Role::withCount(['users'])->get();
        return view('admin.roles.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $models = $this->models;
        $permissionMaps = $this->permissionMaps;
        return view('admin.roles.create', compact('models', 'permissionMaps'));
    }

    public function store(RoleRequest $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $role = Role::create($request->only(['name']));
            $role->syncPermissions($request->permissions);
            DB::commit();
            Alert::success('success', 'تم ادخال البيانات بنجاح');
            return redirect()->route('roles.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }

    public function edit(Role $role)
    {
        $models = $this->models;
        $permissionMaps = $this->permissionMaps;
        return view('admin.roles.edit', compact('role', 'models', 'permissionMaps'));
    } // end of edit

    public function update(RoleRequest $request, Role $role)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $role->update($request->only(['name']));
            $role->syncPermissions($request->permissions);
            DB::commit();
            Alert::success('تمت التعديل بنجاح', 'role updated successfully');
            return redirect()->route('roles.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();
            Alert::success('تم حذف البيانات بنجاح', 'role deleted successfully');
            return redirect()->route('roles.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()]);
        }
    }
}
