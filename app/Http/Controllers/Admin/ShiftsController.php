<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShiftesRequest;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ShiftsController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = Shift::where('com_code', $com_code)->latest()->paginate(10);
        return view('admin.shiftes.index', compact('data'));
    }
    public function create()
    {
        return view('admin.shiftes.create');
    }
    public function store(ShiftesRequest $request)
    {
        try {
            DB::beginTransaction();
            $input['com_code'] = auth()->user()->com_code;
            $input['type'] = $request->type;
            $input['from_time'] = $request->from_time;
            $input['to_time'] = $request->to_time;
            $input['total_hour'] = $request->total_hour;
            $input['active'] = $request->active;
            $input['added_by'] = auth()->user()->id;
            Shift::create($input);
            DB::commit();
            Alert::success('success', 'تم ادخال البيانات بنجاح');
            return redirect()->route('shiftes.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }
    public function edit($id)
    {
        // dd($shift->id);
        $com_code = auth()->user()->com_code;
        $data = Shift::where('com_code', $com_code)->where('id', $id)->first();
        // if (empty($data1)) {
        //     return redirect()->route('shiftes.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة']);
        // }
        // dd($data->id);
        return view('admin.shiftes.edit', compact('data'));
    }
    public function update(ShiftesRequest $request, $id)
    {
        try {
            //  dd($id);
            $com_code = auth()->user()->com_code;
            $data = Shift::where('com_code', $com_code)->where('id', $id)->first();
            if (empty($data)) {
                return redirect()->route('shiftes.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة']);
            }
            DB::beginTransaction();
            $input['type'] = $request->type;
            $input['from_time'] = $request->from_time;
            $input['to_time'] = $request->to_time;
            $input['total_hour'] = $request->total_hour;
            $input['active'] = $request->active;
            $input['updated_by'] = auth()->user()->id;
            // Shift::where('id',$id)->update($input);
            $data->update($input);
            DB::commit();
            Alert::success('success', 'تم تعديل البيانات بنجاح');
            return redirect()->route('shiftes.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = Shift::where('com_code', $com_code)->where('id', $id)->first();
            if (empty($data)) {
                return redirect()->route('shiftes.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة']);
            }
            DB::beginTransaction();
            $data->delete();
            DB::commit();
            Alert::success('success', 'تم حذف البيانات بنجاح');
            return redirect()->route('shiftes.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('shiftes.index')->with(['error' => 'عفوا حدث خطا  ' . $ex->getMessage()]);
        }
    }


    public function ajax_search(Request $request)
    {
        // return response()->json($request);
        if ($request->ajax()) {
            $type_search = $request->type_search;
            $hour_from_range = $request->hour_from_range;
            $hour_to_range = $request->hour_to_range;
            $query = Shift::query();
            if ($type_search && $type_search !== 'all') {
                $query->where('type', $type_search);
            }
            if ($hour_from_range && $hour_to_range) {
                $query->whereBetween('total_hour', [$hour_from_range, $hour_to_range]);
            } elseif ($hour_from_range) {
                $query->where('total_hour', '>=', $hour_from_range);
            } elseif ($hour_to_range) {
                $query->where('total_hour', '<=', $hour_to_range);
            }
            $data = $query->latest()->paginate(1);
            return view('admin.shiftes.ajax_search', ['data' => $data]);
        }
    }
}
