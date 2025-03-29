@extends('admin.layout.layout') @section('content')
<div class="content-body">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="card gradient-1">
                    <div class="card-body">
                        <h3 class="card-title text-white">Absen Masuk Hari Ini</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $totalCheckInToday }}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"
                            ><i class="fa fa-sign-in"></i
                        ></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card gradient-2">
                    <div class="card-body">
                        <h3 class="card-title text-white">Absen Keluar Hari ini</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $totalCheckOutToday }}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"
                            ><i class="fa fa-sign-out"></i
                        ></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card gradient-4">
                    <div class="card-body">
                        <h3 class="card-title text-white">
                        Total User Magang
                        </h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $totalInterns }}</h2>
                            <a  class="text-white" href="/admin/user">Detail</a>
                        </div>
                        <span class="float-right display-5 opacity-5"
                            ><i class="fa fa-users"></i
                        ></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
            <div class="col-full">
                <div class="card shadow mb-4">
                    <div class="card-header bg-white">
                        <h4 class="text-info">Monitoring</h4>
                    </div>
                    <div class="card-body p-2">
                        <table class="table table-hover table-responsive" id="table">
                        <thead>
                                <tr>
                                    <th>No.</th>
                                    <th style="width: 40%">Nama</th>
                                    <th style="width: 40%">Email</th>
                                    <th style="width: 20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a href="{{ route('admin.monitoring.show', $user->id) }}"
                                            class="btn btn-sm btn-outline-warning"><i class="fa fa-eye"></i>
                                            Show</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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

    $(document).ready(function () {
        $('#data-table').DataTable();
    });
</script>
@endpush