@extends('layout.app')

@section('content')
<div class="h-full">

<div class="bg-[#ededed] ">
 @if(session('success'))
            <div id="success-alert" class="text-center py-3 font-bold" >{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div id="error-alert" class="text-center py-3 font-bold">{{ session('error') }}</div>
        @endif
 </div>

<div class="flex justify-between px-2 bg-[#537FE7] py-2 items-center border-b-2 border-[#6e92e7]">
    <a href="/profile">
        <div class="flex justify-around gap-2">
            <div class=""> 
                <div class="rounded-full border border-[#ededed] h-[50px] w-[50px]">
                @if(auth()->user()->profile_picture == null)
                <img src="{{ asset('images/default.jpeg') }}" alt="" class="rounded-full h-full w-full object-cover">
                @endif
                @if(auth()->user()->profile_picture != null)
                <img src="{{ asset(auth()->user()->profile_picture ? 'storage/photos/' . auth()->user()->profile_picture : 'images/default.jpeg') }}" alt="" class="rounded-full h-full w-full object-cover">
                @endif
                </div>
            </div>
            <div class="text-white whitespace-nowrap">
                <p class="font-bold">{{auth()->user()->name}}</p>
                <p class="font-light text-sm text-[#eded] ">{{auth()->user()->kategori->name_categories}}</span></p>
            </div>
        </div>
    </a>
    <div class="text-2xl text-[#537FE7]">
        <!-- The button to open modal -->
         
        <label for="my_modal_6"><i class="bi bi-box-arrow-right"></i></label>
    </div>
</div>
<!-- Put this part before </body> tag -->
<!-- <input type="checkbox" id="my_modal_6" class="modal-toggle" />
<div class="modal" role="dialog">
  <div class="modal-box">
    <h3 class="text-lg font-bold">Hello!</h3>
    <p class="py-4">apakah anda yakin ingin keluar</p>
    <div class="modal-action text-sm">
      <label for="my_modal_6" class="btn">batal</label>
      <a href="/logout"><button class="btn btn-error">keluar</button></a>
    </div>
  </div>
</div> -->
<!-- end modal logout -->

<div class="bg-[#537FE7] rounded-b-2xl shadow-md shadow-blue-500/50 pt-5 md:relative md:min-h-[42vh]">
    <div class="pt-3 md:absolute md:bottom-0 w-full">
    <div class="bg-[white] rounded-t-2xl mt-5 mx-6 py-2">
        <div class=" mx-3 py-2">
            <div class="flex flex-col items-center">
                <!-- <p class="font-[700] text-lg">jam aktif</p> -->
                <p class="font-extrabold text-3xl text-blue-500" id="wib-time"></p>
                <p class="text-xs text-slate-500" id="wib-date"></p>
            </div>
        </div>
        <div class="bg-[#c0b4b4] h-[1.5px] mx-7 mt-4"></div>
        <div class="my-3 mt-4 mx-3 flex items-center flex-col">
            <div class="flex flex-col items-center">
                <p class="text-md font-semibold text-slate-500">Jam kerja</p>
                <p class="text-md font-extrabold text-slate-700">
                    {{ \Carbon\Carbon::parse($setting->start_time)->format('h:i A') }} - 
                    <span>{{ \Carbon\Carbon::parse($setting->end_time)->format('h:i A') }}</span>
                </p>
            </div>
            <div class="my-1">
                <label for="my_modal_absen_masuk" class="btn bg-[#537FE7] border-none hover:bg-[#537FE7] text-[#ededed] btn-md shadow-lg shadow-blue-500/50">
                    Jam Masuk
                </label>
                    <!-- modal Absen Masuk -->
                    <!-- Put this part before </body> tag -->
                    <input type="checkbox" id="my_modal_absen_masuk" class="modal-toggle" />
                    <div class="modal" role="dialog">
                    <div class="modal-box relative">
                    <h3 class="mb-1 text-center"><span class="text-lg font-bold"></span></h3>
                    
                    <p> <strong>Jam Masuk</strong> akan dicatat pada tanggal <strong>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</strong> pukul <strong id="jam1">{{ \Carbon\Carbon::now()->format('H:i:s A') }}</strong> </p>

                    <form action="{{ route('attendance.check-in') }}" method="POST">
                        @csrf
                        <div class="modal-action text-sm">
                        <label for="my_modal_absen_masuk" class="btn bg-[white] border-none hover:bg-[white] btn-md absolute top-0 right-0"><i class="bi bi-x text-2xl"></i></label>
                        <button id="btnCheckIn" type="submit" class="btn btn-success w-full text-white" 
                            >
                            ABSEN MASUK
                        </button>
                        <!-- <button class="btn btn-success w-full text-white">ABSEN MASUK</button> -->
                        </form>
                        </div>
                    </div>
                    </div>
                    <!-- modal Absen Masuk end-->
                <label for="my_modal_absen_keluar" class="btn bg-[#537FE7] border-none hover:bg-[#537FE7] text-[#ededed] btn-md shadow-lg shadow-blue-500/50">Jam Keluar</label>
                    <!-- modal Absen Keluar -->
                    <!-- Put this part before </body> tag -->
                    <input type="checkbox" id="my_modal_absen_keluar" class="modal-toggle" />
                    <div class="modal" role="dialog">
                        <div class="modal-box relative">
                            <h3 class="mb-1 text-center"><span class="text-lg font-bold"></span></h3>
                            <p> <strong>Jam Keluar</strong> akan dicatat pada tanggal <strong>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</strong> pukul <strong id="jam2">{{ \Carbon\Carbon::now()->format('H:i:s A') }}</strong> </p>
                            <form action="{{ route('attendance.check-out') }}" method="POST">
                                @csrf
                            <div class="modal-action text-sm">
                            <label for="my_modal_absen_keluar" class="btn bg-[white] border-none hover:bg-[white] btn-md absolute top-0 right-0"><i class="bi bi-x text-2xl"></i></label>
                                <button id="btnCheckOut" type="submit" class="btn btn-error w-full text-white" >
                                    ABSEN KELUAR
                                </button>
                            </form>
                        <!-- <button class="btn btn-error w-full text-white">ABSEN KELUAR</button> -->
                        </div>
                    </div>
                    </div>
                    <!-- modal Absen Keluar end-->
            </div>
        </div>
    </div>
    </div>
</div>
<div class="rounded-t-2xl mt-5">
    <div class="h-full mx-5 rounded-b-2xl">
        <div class="text-center mb-3">
            <p class="font-extrabold">Riwayat Kehadiran</p>
        </div>
        <div class="overflow-x-hidden mx-1 mt-4 flex justify-center ">
        <table class=" overflow-hidden text-xs overflow-y-auto w-full">
            <tbody class="divide-y divide-gray-300">
            @forelse ($attendances as $attendance)
                    <tr class="hover:bg-gray-100 text-xs">
                        <td class="px-4 py-2 text-center"> {{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}</td>
                        <td class="px-5 py-2 text-center">
                        @if ($attendance->is_cancelled)
                            <span class="text-red-900">Absen dibatalkan oleh sistem</span>
                        @else
                        {{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('h:i A') : '🙂' }} - 
                        {{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('h:i A') : '🙂' }}
                        @endif
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-7 py-3 text-center">Tidak ada data absensi.</td>
                        </tr>
                    @endforelse
            </tbody>
        </table>
    </div>
    </div>
</div>
</div>

<script>

    function updateClock() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        
        // Format waktu ke 12 jam
        hours = hours % 12;
        hours = hours ? hours : 12; // jam 0 menjadi 12
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        var timeString = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
        
        // Update waktu pada elemen dengan ID "jam"
        document.getElementById('jam1').innerHTML = '' + timeString;
        document.getElementById('jam2').innerHTML = '' + timeString;
    }

    // Update jam setiap detik
    setInterval(updateClock, 1000);

    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(function () {
            fadeOutAlert('success-alert');
            fadeOutAlert('error-alert');
        }, 3000); // Hilang setelah 3 detik
    });

    function fadeOutAlert(id) {
        let alertBox = document.getElementById(id);
        if (alertBox) {
            alertBox.classList.add("opacity-0");
            setTimeout(() => alertBox.remove(), 500); // Hapus setelah animasi selesai
        }
    }

    function updateWorldTime() {
        let options = { timeZone: "Asia/Jakarta", weekday: 'long', day: '2-digit', month: 'long', year: 'numeric' };

        let wibDate = new Date().toLocaleDateString("id-ID", options); // Format: Senin, 12 Februari 2025
        let wibTime = new Date().toLocaleTimeString("id-ID", { timeZone: "Asia/Jakarta",  hour: '2-digit', 
            minute: '2-digit', hour12: true });

        document.getElementById("wib-date").innerText = wibDate;
        document.getElementById("wib-time").innerText = wibTime;
    }
    setInterval(updateWorldTime, 1000);
    updateWorldTime();

    function updateButtonStatus() {
    fetch("{{ route('attendance.status') }}")
        .then(response => response.json())
        .then(data => {
            let btnCheckIn = document.getElementById("btnCheckIn");
            let btnCheckOut = document.getElementById("btnCheckOut");

            if (data.isCheckInDisabled) {
                btnCheckIn.disabled = true;
            } else {
                btnCheckIn.disabled = false;
            }

            if (data.isCheckOutDisabled) {
                btnCheckOut.disabled = true;
            } else {
                btnCheckOut.disabled = false;
            }
        })
        .catch(error => console.error("Error fetching status:", error));
}

setInterval(updateButtonStatus, 700); // Cek status setiap 5 detik

</script>
@endsection