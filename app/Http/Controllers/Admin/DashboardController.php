<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $data = array('title' => 'Dashboard');
        $users = User::where('role', 'intern')->get(); // Ambil semua user magang

         // Total user dengan role 'intern'
    $totalInterns = User::where('role', 'intern')->count();

    // Total absen masuk hari ini
    $totalCheckInToday = Attendance::whereDate('date', Carbon::today())
        ->whereNotNull('check_in')
        ->count();

    // Total absen keluar hari ini
    $totalCheckOutToday = Attendance::whereDate('date', Carbon::today())
        ->whereNotNull('check_out')
        ->count();

        return view('admin.dashboard.index' , compact('users', 'totalInterns', 'totalCheckInToday', 'totalCheckOutToday'), $data);   
    }
}
