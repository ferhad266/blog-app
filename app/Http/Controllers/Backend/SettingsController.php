<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $data['adminSettings'] = Settings::all()->sortBy('settings_must');

        return view('backend.settings.index', compact('data'));
    }

    public function sortable()
    {
        // value = id , key = must
        foreach ($_POST['item'] as $key => $value) {
            $settings = Settings::find(intval($value));
            $settings->settings_must = intval($key);
            $settings->save();
        }

        echo true;
    }

    public function destroy($id)
    {
        $settings = Settings::find($id);
        if ($settings->delete()) {
            return back()->with('success', 'Delete process is valid.');
        }
        return back()->with('errore', 'Delete process is invalid!');
    }

    public function edit($id)
    {
        $settings = Settings::where('id', $id)->first();

        return view('backend.settings.edit')->with('settings', $settings);
    }

    public function update(Request $request, $id)
    {
        if ($request->hasFile('settings_value')) {
            $request->validate([
                'settings_value' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $fileName = uniqid() . '.' . $request->settings_value->getClientOriginalExtension();

            $request->settings_value->move(public_path('images/settings'), $fileName);
            $request->settings_value = $fileName;
        }

        $settings = Settings::Where('id', $id)
            ->update([
                'settings_value' => $request->settings_value
            ]);

        if ($settings) {
            $path = 'images/settings/' . $request->old_file;
            if (file_exists($path)) {
                @unlink(public_path($path));
            }
            return back()->with('success', 'Update was successfully!');
        } else {
            return back()->with('error', 'Update was not successfully!');
        }
    }
}
