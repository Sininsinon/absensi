@extends('admin.layout.layout') @section('content')
<div class="content-body" >
        <!-- Notifikasi -->
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="container-fluid">
        <!-- <div class=" col-lg-12" >
                <div class="card gradient-1 text-center " style="height: 65px;">
                        <h3 class="card-title text-white mt-4" style="text-align: center;">Manajemen User</h3>
                </div>
        </div>     -->
            <div class="col-full ">
                <div class="card shadow " >
                    <div class="card-header bg-white"> 
                        <h3 class=" font-bold">Nama: <span class="font-weight-light">{{ $user->name }}</span></h3>
                        <div class="card-header-form float-left">                           
                            <!-- Tombol Absen (Memicu Modal) -->
                            <div class="text-center my-4">
                                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#checkInModal">Absen Masuk</button>
                                <button class="btn btn-danger btn-md" data-toggle="modal" data-target="#checkOutModal">Absen Keluar</button>
                                @if($attendances->count() > 0)
                                    <button class="btn btn-warning btn-md" data-toggle="modal" data-target="#cancelModal">Batalkan Absen hari ini</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <table class="table table-hover table-responsive" id="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th style="width: 40%">Tanggal</th>
                                    <th style="width: 40%">Jam Masuk</th>
                                    <th style="width: 20%">Jam keluar</th>
                                    <th style="width: 20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendances as $attendance)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}
                                    </td>
                                    <td>
                                    @if ($attendance->is_cancelled)
                                        <span class="text-danger">Absen dibatalkan oleh sistem</span>
                                    @else
                                        {{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('h:i A') : '🙂' }}
                                    @endif
                                    </td>
                                    <td>
                                        {{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('h:i A') : '🙂' }}
                                    </td>
                                    <td>
                                        @if($attendance->is_cancelled)
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#allowCancelModal-{{ $attendance->id }}">
                                            Izinkan
                                        </button>
                                        @else
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancelModal-{{ $attendance->id }}">
                                            Batalkan Absen
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                <!-- Modal Konfirmasi Pembatalan -->
                                <div class="modal fade" id="cancelModal-{{ $attendance->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Pembatalan Absen</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin membatalkan absen <strong>{{ $user->name }}</strong> pada tanggal <strong>{{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}</strong>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <form action="{{ route('admin.monitoring.allow.cancel') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">
                                                <button type="submit" class="btn btn-danger">Ya, Batalkan</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Konfirmasi Izinkan Pembatalan -->
                                <div class="modal fade" id="allowCancelModal-{{ $attendance->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Izinkan Pembatalan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Anda yakin ingin mengizinkan pembatalan absen untuk <strong>{{ $attendance->user->name }}</strong> pada tanggal <strong>{{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.monitoring.cancel.today') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">
                                                    <button type="submit" class="btn btn-warning">Ya, Izinkan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Tombol Kembali -->
                        <a href="{{ route('admin.monitoring') }}" class="btn btn-secondary mx-3 mt-3 ">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Absen Masuk -->
<div class="modal fade" id="checkInModal" tabindex="-1" role="dialog" aria-labelledby="checkInModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkInModalLabel">Konfirmasi Absen Masuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin melakukan absensi masuk untuk <strong>{{ $user->name }}</strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form action="{{ route('admin.monitoring.checkin', $user->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Ya, Absen Masuk</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Absen Keluar -->
<div class="modal fade" id="checkOutModal" tabindex="-1" role="dialog" aria-labelledby="checkOutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkOutModalLabel">Konfirmasi Absen Keluar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin melakukan absensi keluar untuk <strong>{{ $user->name }}</strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form action="{{ route('admin.monitoring.checkout', $user->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Ya, Absen Keluar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Batalkan Absen -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Batalkan Absen</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>Pilih data absensi yang ingin dibatalkan untuk <strong>{{ $user->name }}</strong>:</p>
        <div class="text-center">
            <!-- Batalkan Absen Masuk -->
            <form action="{{ route('admin.monitoring.cancel.checkin', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-warning btn-lg w-100 mb-2">Batalkan Absen Masuk</button>
            </form>

            <!-- Batalkan Absen Keluar -->
            <form action="{{ route('admin.monitoring.cancel.checkout', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-lg w-100">Batalkan Absen Keluar</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection

@push('script')
<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });

    var data_anggota = $(this).attr('data-id')
    function confirmDelete(button) {
    
        event.preventDefault()
        const id = button.getAttribute('data-id');
        const kode = button.getAttribute('id');
        swal({
                title: 'Apa Anda Yakin ?',
                text: 'Anda akan menghapus data: "' + kode + '". Ketika Anda tekan OK, maka data tidak dapat dikembalikan !',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
        .then((willDelete) => {
            if (willDelete) {
              const form = document.getElementById('delete-form');
              // Setelah pengguna mengkonfirmasi penghapusan, Anda bisa mengirim form ke server
              form.action = '/user/' + id; // Ubah aksi form sesuai dengan ID yang sesuai
              form.submit();
            }
        });
    }

    // Ambil referensi ke elemen input password
    const passwordInput = document.getElementById('password');

    // Tambahkan event listener untuk memeriksa input setiap kali pengguna mengetik
    passwordInput.addEventListener('input', function() {
        // Ambil nilai password dari input
        const password = passwordInput.value;

        // Periksa panjang password
        const isLengthValid = password.length >= 8;

        // Periksa apakah setidaknya satu huruf kapital ada di dalam password
        const hasCapitalLetter = /[A-Z]/.test(password);

        // Jika panjang password tidak mencukupi atau tidak memiliki huruf kapital
        if (!isLengthValid || !hasCapitalLetter) {
            // Tampilkan pesan kesalahan
            document.getElementById('warning-message').style.display = 'block';
        } else {
            // Hapus pesan kesalahan jika password valid
            document.getElementById('warning-message').style.display = 'none';
        }
    });

    function validasiInput(inputElement) {
      // Membuang karakter angka dari nilai input
      inputElement.value = inputElement.value.replace(/[^a-zA-Z]/g, '');
    }
</script>
@endpush