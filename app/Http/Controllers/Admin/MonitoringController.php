<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{
    public function index()
    {
        
        $data = array('title' => 'Monitoring');
        $users = User::where('role', 'intern')->get(); // Ambil semua user magang
        return view('admin.monitoring.index', compact('users') ,$data);
    }

    public function show($user_id)
    {
        $data = array('title' => 'Data User');
        $user = User::findOrFail($user_id);
        $attendances = Attendance::where('user_id', $user_id)->orderBy('date', 'desc')->get();
        $attendance = Attendance::where('user_id', $user_id)
        ->whereDate('date', Carbon::today())
        ->first();

        
        return view('admin.monitoring.show', compact('user', 'attendances', 'attendance') ,$data);
    }

    public function checkIn(Request $request, $user_id)
    {
        $today = Carbon::today();

        $attendance = Attendance::firstOrCreate(
            ['user_id' => $user_id, 'date' => $today],
            ['check_in' => Carbon::now()]
        );

        return redirect()->back()->with('success', 'Absensi masuk berhasil!');
    }

    public function checkOut(Request $request, $user_id)
    {
        $today = Carbon::today();

        $attendance = Attendance::where('user_id', $user_id)->where('date', $today)->first();

        if ($attendance && !$attendance->check_out) {
            $attendance->update(['check_out' => Carbon::now()]);
        }

        return redirect()->back()->with('success', 'Absensi keluar berhasil!');
    }

    public function cancelCheckIn($id)
    {
        $attendance = Attendance::where('user_id', $id)
            ->whereDate('date', now()->toDateString())
            ->first();

        if ($attendance && $attendance->check_in) {
            $attendance->update(['check_in' => null]);
            return redirect()->back()->with('success', 'Absen masuk berhasil dibatalkan!');
        }

        return redirect()->back()->with('error', 'Absen masuk tidak ditemukan!');
    }

    public function cancelCheckOut($id)
    {
        $attendance = Attendance::where('user_id', $id)
            ->whereDate('date', now()->toDateString())
            ->first();

        if ($attendance && $attendance->check_out) {
            $attendance->update(['check_out' => null]);
            return redirect()->back()->with('success', 'Absen keluar berhasil dibatalkan!');
        }

        return redirect()->back()->with('error', 'Absen keluar tidak ditemukan!');
    }

    
    public function allowCancelAttendance(Request $request)
    {
        $attendanceId = $request->attendance_id;
    
        // Cek apakah data absensi ada
        $attendance = DB::table('attendances')
            ->where('id', $attendanceId)
            ->first();
    
        if (!$attendance) {
            return redirect()->back()->with('error', 'Data absensi tidak ditemukan.');
        }
    
        // Izinkan pembatalan
        DB::table('attendances')
            ->where('id', $attendanceId)
            ->update(['is_cancelled' => true]);
    
        return redirect()->back()->with('success', 'Pembatalan absen diizinkan.');
    }
    
    public function cancelTodayAttendance(Request $request)
    {
        $attendanceId = $request->attendance_id;
    
        // Cek apakah data absensi ada dan sudah diizinkan untuk dibatalkan
        $attendance = DB::table('attendances')
            ->where('id', $attendanceId)
            ->where('is_cancelled', true)
            ->first();
    
        if (!$attendance) {
            return redirect()->back()->with('error', 'Pembatalan tidak diizinkan atau data tidak ditemukan.');
        }
    
        // Update status dibatalkan
        DB::table('attendances')
            ->where('id', $attendanceId)
            ->update(['is_cancelled' => true, 'is_cancelled' => false]);
    
        return redirect()->back()->with('success', 'Absen berhasil dibatalkan.');
    }
    
    


}
