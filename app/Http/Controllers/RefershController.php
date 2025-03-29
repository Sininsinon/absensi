<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AttendanceSetting;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RefershController extends Controller
{
        // ✅ Cek status tombol absen
        public function checkStatus()
        {
            $user = auth()->user();
            $setting = AttendanceSetting::first();
            $now = Carbon::now();
            $currentDate = $now->toDateString();
            $currentDay = $now->format('l');
            
            $attendance = Attendance::where('user_id', $user->id)
                ->whereDate('created_at', $currentDate)
                ->first();
    
            $startTime = Carbon::parse($setting->start_time);
            $endTime = Carbon::parse($setting->end_time);
            $checkInDeadline = Carbon::parse($setting->check_in_deadline);
            $checkOutDeadline = Carbon::parse($setting->check_out_deadline);
            
            $isBeforeStartTime = $now->lessThan($startTime);
            $isLate = $now->greaterThan($checkInDeadline);
            $isAfterCheckOutDeadline = $now->greaterThan($checkOutDeadline);
            
            $holidayDays = json_decode($setting->holiday_days ?? '[]', true);
            $holidays = json_decode($setting->holidays ?? '[]', true);
            $isHoliday = in_array($currentDay, $holidayDays) || in_array($currentDate, $holidays);
    
            $isCheckInDisabled = $attendance && $attendance->check_in || $isLate || $isBeforeStartTime || $isHoliday;
            $isCheckOutDisabled = !$attendance || $attendance->check_out || $isAfterCheckOutDeadline || $isHoliday;
    
            return response()->json([
                'isCheckInDisabled' => $isCheckInDisabled,
                'isCheckOutDisabled' => $isCheckOutDisabled
            ]);
        }
    
        // ✅ Handle Absen Masuk
        public function checkIn(Request $request)
        {
            $user = auth()->user();
            $now = Carbon::now();
            $setting = AttendanceSetting::first();
            
            $holidayDays = json_decode($setting->holiday_days ?? '[]', true);
            $holidays = json_decode($setting->holidays ?? '[]', true);
            $currentDay = $now->format('l');
            $currentDate = $now->toDateString();
            
            if (in_array($currentDay, $holidayDays) || in_array($currentDate, $holidays)) {
                return response()->json(['error' => 'Hari ini adalah hari libur.'], 400);
            }
            
            $attendance = Attendance::firstOrCreate(
                ['user_id' => $user->id, 'created_at' => $now->toDateString()],
                ['check_in' => $now]
            );
    
            return response()->json(['message' => 'Absen masuk berhasil!'], 200);
        }
    
        // ✅ Handle Absen Keluar
        public function checkOut(Request $request)
        {
            $user = auth()->user();
            $now = Carbon::now();
            $setting = AttendanceSetting::first();
            
            $holidayDays = json_decode($setting->holiday_days ?? '[]', true);
            $holidays = json_decode($setting->holidays ?? '[]', true);
            $currentDay = $now->format('l');
            $currentDate = $now->toDateString();
            
            if (in_array($currentDay, $holidayDays) || in_array($currentDate, $holidays)) {
                return response()->json(['error' => 'Hari ini adalah hari libur.'], 400);
            }
            
            $attendance = Attendance::where('user_id', $user->id)
                ->whereDate('created_at', $now->toDateString())
                ->first();
    
            if ($attendance && !$attendance->check_out) {
                $attendance->update(['check_out' => $now]);
                return response()->json(['message' => 'Absen keluar berhasil!'], 200);
            }
    
            return response()->json(['error' => 'Anda belum absen masuk atau sudah absen keluar.'], 400);
        }
    

}
