<div class="modal fade" id="form-edit{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLabel">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/user/{{$item->id}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{$item->name}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{$item->email}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password Baru</label>
                                <input type="password" name="password" class="form-control" placeholder="Opsional">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">No Telepon</label>
                                <input type="text" class="form-control" name="phone" value="{{$item->phone}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_id">Kategori</label>
                                <select class="custom-select" name="category_id">
                                    <option value="">Pilih Status Kategori</option>
                                    @foreach ($kategori as $kategori)
                                    <option value="{{ $kategori->id }}" {{ $item->category_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->name_categories }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="division_id">Devisi</label>
                                <select class="custom-select" name="division_id">
                                <option value="">Pilih Devisi</option>
                                @foreach ($devisi as $div)
                                    <option value="{{ $div->id }}" {{ $item->division_id == $div->id ? 'selected' : '' }}>
                                        {{ $div->name_divisions }}
                                    </option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="institution">institution</label>
                                <input type="text" class="form-control" name="institution" value="{{$item->institution}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">Level</label>
                                <select class="custom-select" name="role">
                                    <option value="">Pilih Level...</option>
                                    <option value="admin" {{ $item->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="intern" {{ $item->role == 'intern' ? 'selected' : '' }}>Intern</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> save</button>
                </form>
            </div>
        </div>
    </div>
</div>
