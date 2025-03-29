<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\AttendanceSetting;


class AttendanceSettingController extends Controller
{
    public function index()
    {
        $setting = AttendanceSetting::first() ?? new AttendanceSetting();
        $data = array('title' => 'Settings');
        return view('admin.settings.index', compact('setting'),$data);
    }

    public function update(Request $request)
    {
        $setting = AttendanceSetting::first();
        if (!$setting) {
            $setting = AttendanceSetting::create([
                'start_time' => '08:00:00',
                'check_in_deadline' => '12:00:00',
                'end_time' => '15:00:00',
                'check_out_deadline' => '20:00:00',
                'late_limit' => 60,
                'holidays' => json_encode([]),
                'holiday_days' => json_encode(['Sunday']) // Default hari libur Minggu
            ]);
        }
    
        // Ambil data yang bisa langsung diupdate
        $dataToUpdate = array_filter($request->only(['start_time', 'end_time', 'late_limit', 'check_in_deadline', 'check_out_deadline']), function ($value) {
            return !is_null($value) && $value !== ''; // Hanya update jika ada input baru
        });
    
        // Cek dan update `holidays` jika ada input
        if ($request->has('holidays')) {
            $dataToUpdate['holidays'] = json_encode(explode(',', $request->holidays));
        }
    
        // Cek dan update `holiday_days` jika ada input
        if ($request->has('holiday_days')) {
            $dataToUpdate['holiday_days'] = json_encode(explode(',', $request->holiday_days));
        }
    
        // Update pengaturan absensi
        $setting->update($dataToUpdate);
    
        return back()->with('success', 'Pengaturan absensi diperbarui!');
    }
    
}
