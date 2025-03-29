<!-- Modal -->
<div class="modal fade" id="form-tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLabel">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/user/store" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <small class="text-muted">* Jika dikosongkan, password default adalah <b>P05</b></small>
                                <div id="warning-message" style="color: red; display: none;">
                                    Password minimal 8 karakter dan 1 huruf kapital
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">No Telepon</label>
                                <input type="text" class="form-control" name="phone" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_id">Kategori</label>
                                <select class="custom-select" name="category_id" required>
                                    <option value="">Pilih Status Kategori</option>
                                    @foreach ($kategori as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->name_categories }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="division_id">Devisi</label>
                                <select class="custom-select" name="division_id" required>
                                    <option value="">Pilih Devisi</option>
                                    @foreach ($devisi as $devisi)
                                    <option value="{{ $devisi->id }}">{{ $devisi->name_divisions }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="institution">institution</label>
                                <input type="text" class="form-control" name="institution" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">Level</label>
                                <select class="custom-select" name="role" required>
                                    <option value="">Pilih Level...</option>
                                    <option value="admin">Admin</option>
                                    <option value="intern">Intern</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-outline-primary float-right">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>