<?php

namespace App\Http\Controllers;

use App\Models\PaymentSettings;
use App\Models\Settings;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::where('settings_status', '1')->get();
        return view('Admin.Settings.settings')->with('settings', $settings);

    }

    public function edit($id)
    {
        $singleSetting = Settings::where('id', $id)->first();
        return view('Admin.Settings.editsettings')->with('singleSetting', $singleSetting);
    }

    public function updateSettings(Request $request, $id)
    {

        if ($request->has('paymetSettings')) {

            $update = PaymentSettings::where('id', $id)->update(
                [
                    'api_key' => $request->value1,
                    'secret_key' => $request->value2
                ]
            );
            if ($update) {
                return back()->with('success', 'Düzenleme işlemi başarılı');
            }
            return back()->with('error', 'Düzenleme işlemi başarısız');

        }


        if ($request->hasFile('settings_value')) {
            $request->validate([
                'settings_value' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);
            $fileName = uniqid() . '.' . $request->settings_value->getClientOriginalExtension();
            $request->settings_value->move(public_path('images/settings'), $fileName);
            $request->settings_value = $fileName;
        }

        $setting = Settings::where('id', $id)->update([
            'settings_value' => $request->settings_value
        ]);
        if ($setting) {
            $path = 'images/settings/' . $request->old_file;
            if (file_exists($path)) {
                @unlink($path);
            }
            return redirect(route('admin.settings'))->with('success', 'Düzenleme işlemi başarılı');
        }
        return redirect(route('admin.settings'))->with('error', 'Düzenleme işlemi başarısız');
    }

    public function paymetSettings()
    {
        $data = PaymentSettings::all();
        return view('Admin.ApiSettings.paymentsettings')->with('data', $data);
    }

    public function editPayment($id)
    {
        $paymentSetting = PaymentSettings::where('id', $id)->get();

        return view('Admin.ApiSettings.editpaymentsettings')->with('data', $paymentSetting);
    }


}
