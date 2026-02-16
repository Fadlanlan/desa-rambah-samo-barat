<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the settings.
     */
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        $village = \App\Models\Village::first() ?? new \App\Models\Village();
        return view('admin.settings.index', compact('settings', 'village'));
    }

    /**
     * Update the specified settings in storage.
     */
    public function update(Request $request)
    {
        // Handle Village Identity
        if ($request->has('village_identity')) {
            $village = \App\Models\Village::first() ?? new \App\Models\Village();

            $villageData = $request->only([
                'nama_desa', 'visi', 'misi', 'sejarah'
            ]);

            // Handle Logo
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('desa', $filename, 'public');
                $villageData['logo'] = 'storage/desa/' . $filename;
            }

            // Handle Organizational Structure (Staff)
            $staffData = [];
            if ($request->has('staff')) {
                $staffInputs = $request->input('staff');
                $staffPhotos = $request->file('staff_photos') ?? [];

                foreach ($staffInputs as $index => $staff) {
                    $photoPath = $staff['old_photo'] ?? null;

                    if (isset($staffPhotos[$index])) {
                        $file = $staffPhotos[$index];
                        $filename = 'staff_' . $index . '_' . time() . '.' . $file->getClientOriginalExtension();
                        $file->storeAs('desa/staff', $filename, 'public');
                        $photoPath = 'storage/desa/staff/' . $filename;
                    }

                    $staffData[] = [
                        'nama' => $staff['nama'],
                        'jabatan' => $staff['jabatan'],
                        'foto' => $photoPath
                    ];
                }
            }
            $villageData['struktur_organisasi'] = $staffData;

            $village->fill($villageData)->save();
        }

        // Handle General Settings
        $data = $request->except(['_token', '_method', 'village_identity', 'nama_desa', 'visi', 'misi', 'sejarah', 'struktur_organisasi', 'logo']);

        foreach ($data as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
