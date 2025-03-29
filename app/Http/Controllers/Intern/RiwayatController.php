<?php

namespace App\Http\Controllers\Intern;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $attendances = Attendance::where('user_id', $user->id)
        ->orderBy('date', 'asc')
        ->get();

    return view('menu.riwayat.index', compact('attendances'));  
    }

    public function generatePDF()
    {
        $user = Auth::user(); // Ambil data user yang login
        $attendances = Attendance::where('user_id', $user->id)->get(); // Filter absensi hanya untuk user ini

        $pdf = pdf::loadView('menu.riwayat.print', [
            'attendances' => $attendances,
            'userName' => $user->name,
            'institution' => $user->institution ?? 'Asal Institusi', // Pastikan ada field `institution`
        ])->setPaper('A4', 'portrait');

        return $pdf->download('Absensi_' . $user->name . '.pdf');
    }
}
