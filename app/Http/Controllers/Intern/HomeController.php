<?php

namespace App\Http\Controllers\Intern;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Devisi;
use App\Models\AttendanceSetting;

use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $setting = AttendanceSetting::first();
        $user = Auth::user();
        $attendances = Attendance::where('user_id', $user->id)
        ->select('date') // Hanya ambil kolom tanggal
        ->distinct() // Ambil tanggal yang unik
        ->orderBy('date', 'desc') // Urutkan dari yang terbaru
        ->limit(6) // Ambil 6 tanggal terbaru
        ->pluck('date'); // Ambil daftar tanggal saja
        
        $attendances = Attendance::where('user_id', $user->id)
        ->whereIn('date', $attendances) // Filter berdasarkan tanggal yang sudah diambil
        ->orderBy('date', 'asc') // Urutkan dari terbaru
        ->get();
        $attendance = Attendance::where('user_id', $user->id)
                        ->whereDate('date', Carbon::today())
                        ->first();

        return view('menu.home.index', compact('attendance', 'attendances', 'user', 'setting'));   
    }

    public function checkIn(Request $request)
    {
        // Cek apakah user sudah absen hari ini
        $attendance = Attendance::where('user_id', auth()->id())
        ->whereDate('date', now()->toDateString())
        ->first();
    
    if ($attendance) {
        // Jika sudah check-in tapi belum check-out, lakukan check-out
        if (!$attendance->check_in) {
            $attendance->update([
                'check_in' => now()->toTimeString(),
            ]);
            return redirect()->back()->with('success', 'Absen Masuk berhasil!');
        }
    
        // Jika sudah check-in dan check-out, maka tidak bisa absen lagi
        return redirect()->back()->with('error', 'Anda sudah menyelesaikan absen hari ini!');
    }
    
    // Jika belum ada data absensi hari ini, buat data baru untuk check-in
    Attendance::create([
        'user_id' => auth()->id(),
        'date' => now()->toDateString(),
        'check_in' => now()->toTimeString(),
    ]);
    
    return redirect()->back()->with('success', 'Absen Masuk berhasil!');
    
    }

    

    

    public function checkOut()
    {
        $user = Auth::user();
        $today = Carbon::today();

        // Cari data absen hari ini
        $attendance = Attendance::where('user_id', $user->id)
                        ->whereDate('date', $today)
                        ->first();

        if ($attendance && !$attendance->check_out) {
            $attendance->update([
                'check_out' => Carbon::now()->format('H:i:s'),
            ]);

            return back()->with('success', 'Absen keluar berhasil!');
        }

        return back()->with('error', 'Anda sudah absen keluar atau belum absen masuk!');
    }
}
