@extends('admin.layout.layout') @section('content')
<div class="content-body" >
    <div class="container-fluid">
        <!-- <div class=" col-lg-12" >
                <div class="card gradient-1 text-center " style="height: 65px;">
                        <h3 class="card-title text-white mt-4" style="text-align: center;">Manajemen User</h3>
                </div>
        </div>     -->
            <div class="col-full ">
                <div class="card shadow " >
                    <div class="card-header bg-white"> 
                        <div class="card-header-form float-right">
                            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal"
                                data-target="#form-tambah"><i class="fa fa-plus"></i> Tambah</button>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <table class="table table-hover table-responsive" id="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th style="width: 20%">Nama</th>
                                    <th style="width: 20%">Email</th>
                                    <th style="width: 20%">No Tlp</th>
                                    <th style="width: 8%">Level</th>
                                    <th style="width: 20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phone}}</td>
                                    
                                    @if($item->role == 'admin')
                                    <td><div class="badge badge-success">Admin</div></td>
                                    @elseif($item->role == 'intern')
                                    <td><div class="badge badge-info">Intern</div></td>
                                    @endif
                                    <td>
                                        <form action="/user/{{$item->id}}" id="delete-form">
                                            <a href="#form-show{{ $item->id }}" data-toggle="modal"
                                                class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i>
                                                Details
                                            </a>
                                            <a href="#form-edit{{ $item->id }}" data-toggle="modal"
                                                class="btn btn-sm btn-outline-warning"><i class="fa fa-save"></i>
                                                Edit
                                            </a>
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                id="{{$item->name}}" data-id="{{$item->id}}"
                                                onclick="confirmDelete(this)"><i class="fa fa-trash"></i> Delete</a>
                                        </form>
                                    </td>
                                </tr>
                                @include('admin.user.edit', ['id' => $item->id])
                                @include('admin.user.show', ['id' => $item->id])
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.user.form');
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