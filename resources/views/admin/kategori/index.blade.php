@extends('admin.layout.layout') @section('content')
<div class="content-body">
    <div class="container-fluid">
            <div class="col-full">
                <div class="card shadow">
                    <div class="card-header bg-white"> 
                        <div class="card-header-form float-right">
                            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal"
                                data-target="#form-tambah"><i class="fa fa-plus"></i> Tambah</button>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <table class="table table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th style="width: 70%">Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kategori as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name_categories}}</td>
                                    <td>
                                        <form action="/kategori/{{$item->id}}" id="delete-form">
                                            <a href="#form-edit{{$item->id}}"
                                                class="btn btn-sm btn-outline-warning" data-toggle="modal"
                                                ><i class="fa fa-edit"></i>
                                                Edit</a>
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                id="{{$item->name_categories}}" data-id="{{$item->id}}"
                                                onclick="confirmDelete(this)"><i class="fa fa-trash"></i> Delete</a>
                                        </form>
                                    </td>
                                </tr>
                                @include('admin.kategori.edit', ['id' => $item->id])
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.kategori.form');
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
                text: 'Anda akan menghapus data: "' + kode +
                    '". Ketika Anda tekan OK, maka data tidak dapat dikembalikan !',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    const form = document.getElementById('delete-form');
                    // Setelah pengguna mengkonfirmasi penghapusan, Anda bisa mengirim form ke server
                    form.action = '/kategori/' + id; // Ubah aksi form sesuai dengan ID yang sesuai
                    form.submit();
                }
            });
    }

</script>
@endpush