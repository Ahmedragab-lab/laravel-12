<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Finance_calenders_Request;
use App\Models\Finance_calender;
use App\Models\Finance_cln_periods;
use App\Models\Month;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class Finance_calendersController extends Controller
{
    public function index()
    {
      $com_code = auth()->user()->com_code;
      $data = Finance_calender::where('com_code',$com_code)->latest()->paginate(10);
      $CheckDataOpenCounter = Finance_calender::where(['is_open' => 1])->count();
      return view('admin.finance_calenders.index',compact('data','CheckDataOpenCounter'));
    }
    public function create(){
        return view('admin.finance_calenders.create');
    }
    public function store(Finance_calenders_Request  $request){
        try {
            DB::beginTransaction();
            $input['FINANCE_YR'] = $request->FINANCE_YR;
            $input['FINANCE_YR_DESC'] = $request->FINANCE_YR_DESC;
            $input['start_date'] = $request->start_date;
            $input['end_date'] = $request->end_date;
            $input['added_by'] = auth()->user()->id;
            $input['com_code'] = auth()->user()->com_code;
            $Finance_calender=Finance_calender::create($input);
            if($Finance_calender){
                $dataParent = Finance_calender::select("id")->where($input)->first();
                $startDate = new DateTime($request->start_date);
                $endDate = new DateTime($request->end_date);
                $dareInterval = new DateInterval('P1M');
                $datePerioud = new DatePeriod($startDate, $dareInterval, $endDate);
                foreach ($datePerioud as $date) {
                    $dataMonth['finance_calenders_id'] = $dataParent['id'];
                    $Montname_en = $date->format('F');
                    $dataParentMonth = Month::select("id")->where(['name_en' => $Montname_en])->first();
                    $dataMonth['MONTH_ID'] = $dataParentMonth['id'];
                    $dataMonth['FINANCE_YR'] = $input['FINANCE_YR'];
                    $dataMonth['START_DATE_M'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
                    $dataMonth['END_DATE_M'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
                    $dataMonth['year_and_month'] = date('Y-m', strtotime($date->format('Y-m-d')));
                    $datediff = strtotime($dataMonth['END_DATE_M']) - strtotime($dataMonth['START_DATE_M']);
                    $dataMonth['number_of_days'] = round($datediff / (60 * 60 * 24)) + 1;
                    $dataMonth['com_code'] = auth()->user()->com_code;
                    $dataMonth['updated_at'] = date("Y-m-d H:i:s");
                    $dataMonth['created_at'] = date("Y-m-d H:i:s");
                    $dataMonth['added_by'] = auth()->user()->id;
                    $dataMonth['updated_by'] = auth()->user()->id;
                    $dataMonth['start_date_for_pasma'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
                    $dataMonth['end_date_for_pasma'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
                    Finance_cln_periods::create($dataMonth);
                }
            }
            DB::commit();
            Alert::success('success', 'تم ادخال البيانات بنجاح');
            return redirect()->route('finance_calender.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطا ' . $ex->getMessage()])->withInput();
        }
    }
    public function edit( $id){
        $data = Finance_calender::find($id);
        if ($data['is_open'] != 0) {
            return redirect()->back()->with(['error' => ' عفوا لايمكن تعديل السنة المالية في هذه الحالة']);
        }
        return view('admin.finance_calenders.edit',compact('data'));

    }
    public function update(Finance_calenders_Request $request, $id){
        try {
            $data=Finance_calender::find($id);
            if (empty($data)) {
                return redirect()->back()->with(['error' => ' عفوا حدث خطأ ']);
            }
            if ($data['is_open'] != 0) {
                return redirect()->back()->with(['error' => ' عفوا لايمكن تعديل السنة المالية في هذه الحالة'])->withInput();
            }
            $validator = Validator::make($request->all(), [
                'FINANCE_YR' => ['required', Rule::unique('finance_calenders')->ignore($id)],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with(['error' => ' عفوا اسم السنة المالية مسجل من قبل'])->withInput();
            }
            DB::beginTransaction();
            $input['FINANCE_YR'] = $request->FINANCE_YR;
            $input['FINANCE_YR_DESC'] = $request->FINANCE_YR_DESC;
            $input['start_date'] = $request->start_date;
            $input['end_date'] = $request->end_date;
            $input['added_by'] = auth()->user()->id;
            $input['updated_by'] = auth()->user()->id;
            $input['com_code'] = auth()->user()->com_code;
            $flag = Finance_calender::where(['id' => $id])->update($input);
            if($flag){
                if ($data['start_date'] != $request->start_date or $data['end_date'] != $request->end_date){
                    $flagDelete = Finance_cln_periods::where('finance_calenders_id',$id)->delete();
                    if ($flagDelete) {
                        $startDate = new DateTime($request->start_date);
                        $endDate = new DateTime($request->end_date);
                        $dareInterval = new DateInterval('P1M');
                        $datePerioud = new DatePeriod($startDate, $dareInterval, $endDate);
                        foreach ($datePerioud as $date) {
                            $dataMonth['finance_calenders_id'] = $id;
                            $Montname_en = $date->format('F');
                            $dataParentMonth = Month::select("id")->where(['name_en' => $Montname_en])->first();
                            $dataMonth['MONTH_ID'] = $dataParentMonth['id'];
                            $dataMonth['FINANCE_YR'] = $input['FINANCE_YR'];
                            $dataMonth['START_DATE_M'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
                            $dataMonth['END_DATE_M'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
                            $dataMonth['year_and_month'] = date('Y-m', strtotime($date->format('Y-m-d')));
                            $datediff = strtotime($dataMonth['END_DATE_M']) - strtotime($dataMonth['START_DATE_M']);
                            $dataMonth['number_of_days'] = round($datediff / (60 * 60 * 24)) + 1;
                            $dataMonth['com_code'] = auth()->user()->com_code;
                            $dataMonth['updated_at'] = date("Y-m-d H:i:s");
                            $dataMonth['created_at'] = date("Y-m-d H:i:s");
                            $dataMonth['added_by'] = auth()->user()->id;
                            $dataMonth['updated_by'] = auth()->user()->id;
                            $dataMonth['start_date_for_pasma'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
                            $dataMonth['end_date_for_pasma'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
                            Finance_cln_periods::create($dataMonth);
                        }
                    }
                }
            }
            DB::commit();
            Alert::success('success', 'تم تعديل البيانات بنجاح');
            return redirect()->route('finance_calender.index');
            } catch (\Exception $ex) {
                DB::rollBack();
                return redirect()->back()->with(['error' => 'عفوا حدث خطا ' . $ex->getMessage()])->withInput();
            }
    }
    public function destroy($id){
        try {
            $data = Finance_calender::select("*")->where(['id' => $id])->first();
            if (empty($data)) {
                return redirect()->back()->with(['error' => 'عفوا لا توجد بيانات']);
            }
            if ($data['is_open'] != 0) {
                return redirect()->back()->with(['error' => ' عفوا لايمكن حذف السنة المالية في هذه الحالة']);
            }
            $flag=$data->delete();
            if($flag){
                Finance_cln_periods::where(['finance_calenders_id' => $id])->delete();
            }
            Alert::success('success', 'تم حذف البيانات بنجاح');
            return redirect()->route('finance_calender.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'عفوا حدث خطا ' .$ex->getMessage()])->withInput();
        }
    }
    function show_year_monthes(Request $request)
    {
        // return response()->json($request->id);
        if ($request->ajax()) {
            $finance_cln_periods = Finance_cln_periods::where('finance_calenders_id',$request->id)->get();
            return view("admin.finance_calenders.show_year_monthes",compact('finance_cln_periods'));
        }
    }

    public function do_open($id)
    {
        try {
            $data = Finance_calender::select("*")->where(['id' => $id])->first();
            if (empty($data)) {
                return redirect()->back()->with(['error' => ' عفوا حدث خطأ ']);
            }
            if ($data['is_open'] != 0) {
                return redirect()->back()->with(['error' => ' عفوا لايمكن فتح السنة المالية في هذه الحالة']);
            }
            $CheckDataOpenCounter = Finance_calender::where(['is_open' => 1])->count();
            if ($CheckDataOpenCounter > 0) {
                return redirect()->back()->with(['error' => '   عفوا هناك بالفعل سنة مالية مازالت مفتوحة ']);
            }
            $dataToUpdate['is_open'] = 1;
            $dataToUpdate['updated_by'] = auth()->user()->id;
            $flag = Finance_calender::where(['id' => $id])->update($dataToUpdate);
            Alert::success('success', 'تم تحديث البيانات بنجاح');
            return redirect()->route('finance_calender.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => ' عفوا حدث خطأ '] . $ex->getMessage());
        }
    }
}
