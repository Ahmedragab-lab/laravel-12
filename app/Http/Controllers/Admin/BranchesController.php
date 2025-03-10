<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchesRequest;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class BranchesController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = Branch::where('com_code',$com_code)->latest()->paginate(10);
      return view('admin.branches.index',compact('data'));
    }
    public function create(){
        return view('admin.branches.create');
    }
    public function store(BranchesRequest $request){
        try {
            $com_code = auth()->user()->com_code;
            DB::beginTransaction();
            $input['name'] = $request->name;
            $input['address'] = $request->address;
            $input['phones'] = $request->phones;
            $input['email'] = $request->email;
            $input['active'] = $request->active;
            $input['added_by'] = auth()->user()->id;
            $input['com_code'] = $com_code;
            Branch::create($input);
            DB::commit();
            Alert::success('success', 'تم ادخال البيانات بنجاح');
            return redirect()->route('branches.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }
    public function edit(Branch $branch)
    {
        $com_code = auth()->user()->com_code;
        $data = Branch::where('com_code',$com_code)->where('id',$branch->id)->first();
        if (empty($data)) {
            return redirect()->route('branches.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة']);
        }
        return view('admin.Branches.edit', ['data' => $data]);
    }
    public function update(BranchesRequest $request ,Branch $branch){
        try {
            $com_code = auth()->user()->com_code;
            $data = Branch::where('com_code',$com_code)->where('id',$branch->id)->first();
            if (empty($data)) {
                return redirect()->route('branches.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة']);
            }
            DB::beginTransaction();
            $input['name'] = $request->name;
            $input['address'] = $request->address;
            $input['phones'] = $request->phones;
            $input['email'] = $request->email;
            $input['active'] = $request->active;
            $input['added_by'] = auth()->user()->id;
            $input['com_code'] = $com_code;
            // Branch::where('id',$id)->update($input);
            $branch->update($input);
            DB::commit();
            Alert::success('success', 'تم تعديل البيانات بنجاح');
            return redirect()->route('branches.index');
            } catch (\Exception $ex) {
                DB::rollBack();
                return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما '. $ex->getMessage()])->withInput();
                }
    }

    public function destroy($id)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = Branch::where('com_code',$com_code)->where('id',$id)->first();
            if (empty($data)) {
                return redirect()->route('branches.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة']);
            }
            DB::beginTransaction();
            $data->delete();
            DB::commit();
            Alert::success('success', 'تم حذف البيانات بنجاح');
            return redirect()->route('branches.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('branches.index')->with(['error' => 'عفوا حدث خطا  ' . $ex->getMessage()]);
        }
    }
}
