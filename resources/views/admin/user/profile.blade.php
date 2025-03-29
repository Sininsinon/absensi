@extends('admin.layout.layout') @section('content')
<div class="content-body">
    <div class="container-fluid mt-3 ">
        <div class="text-center">
            <h2 class="section-title">Hi, {{auth()->user()->name}}!</h2>
            <p class="section-lead">Change information about yourself on this page.</p>
        </div>
        <div class="d-flex justify-content-center">
            <div class="row mt-sm-4 w-80">
                <!-- <div class="col-12 col-md-12 col-lg-5">
                    </div> -->
                    <div class="">
                    <div class="card ">
                        <form method="post" class="needs-validation" novalidate="">
                            <div class="card-header ">
                                <div class="profile-widget-header mx-2 p-2">
                                    <h4>Profile</h4>
                                    @if(auth()->user()->foto == null)
                                    <img src="{{asset('assets/theme/images/user/1.png')}}" class="rounded-circle profile-widget-picture">
                                    @endif
                                    @if(auth()->user()->foto != null)
                                    <img alt="image" src="/storage/foto/{{auth()->user()->foto}}" class="rounded-circle profile-widget-picture">
                                    @endif
                                </div>
                                <div class="profile-widget-description">
                                    <div class="profile-widget-name">{{auth()->user()->name}} / {{auth()->user()->role}}
                                        <div class="text-muted d-inline font-weight-normal">
                                            <div class="slash"></div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="/{{auth()->user()->role}}/profile/{{auth()->user()->id}}/update" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" class="form-control" value="{{$user->name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{$user->email}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role">Level</label>
                                                <input type="text" class="form-control" value="{{$user->role}}"
                                                    name="role" disabled>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="password">Password Baru</label>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="Opsional">
                                            </div>
                                        </div> -->
                                        <div class="col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="foto">Foto</label>
                                                <input type="file" class="form-control-file mt-2" name="foto">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-outline-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    // Ambil referensi ke elemen input password
    const passwordInput = document.getElementById('password');

    // Tambahkan event listener untuk memeriksa input setiap kali pengguna mengetik
    passwordInput.addEventListener('input', function () {
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
