<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanySettingRequest;
use App\Models\CompanySetting;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CompanySettingController extends Controller
{
    public function index(){
        $com_code = auth()->user()->com_code;
        $data = CompanySetting::select('*')->where('com_code', $com_code)->first();
        return view('admin.company_setting.index',compact('data'));
    }
    public function edit()
    {
        $com_code = auth()->user()->com_code;
        $data = CompanySetting::select('*')->where('com_code', $com_code)->first();
        return view('admin.company_setting.edit', ['data' => $data]);
    }

    public function update(CompanySettingRequest $request){
        try{
            $com_code = auth()->user()->com_code;
            CompanySetting::updateOrCreate([
                'com_code' => $com_code,
            ],[
                'company_name' => $request->company_name,
                'phones' => $request->phones,
                'address' => $request->address,
                'email' => $request->email,
                'com_code'=>auth()->user()->com_code,
                'added_by'=>auth()->user()->id,
                'updated_by'=>auth()->user()->id,
                'after_miniute_calculate_delay'=>$request->after_miniute_calculate_delay,
                'after_miniute_calculate_early_departure'=>$request->after_miniute_calculate_early_departure,
                'after_miniute_quarterday'=>$request->after_miniute_quarterday,
                'after_time_half_daycut'=>$request->after_time_half_daycut,
                'after_time_allday_daycut'=>$request->after_time_allday_daycut,
                'monthly_vacation_balance'=>$request->monthly_vacation_balance,
                'after_days_begin_vacation'=>$request->after_days_begin_vacation,
                'first_balance_begin_vacation'=>$request->first_balance_begin_vacation,
                'sanctions_value_first_abcence'=>$request->sanctions_value_first_abcence,
                'sanctions_value_second_abcence'=>$request->sanctions_value_second_abcence,
                'sanctions_value_third_abcence'=>$request->sanctions_value_third_abcence,
                'sanctions_value_forth_abcence'=>$request->sanctions_value_forth_abcence,
            ]);
            Alert::success('شكرا لك', 'تم تعديل البيانات بنجاح');
            return redirect()->route('company.settings');
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $e])->withInput();
            // dd($e);
        }
    }
}
