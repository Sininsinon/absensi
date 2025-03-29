<!-- Modal -->
<div class="modal fade" id="form-edit{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLabel">Tambah Data Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="/kategori/{{$item->id}}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="name_categories">Nama</label>
                                <input type="text" class="form-control" value="{{$item->name_categories}}" name="name_categories">
                            </div >
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> save</button>
                            </div>
                        </form>
            </div>
        </div>
    </div>
</div>