<!-- Modal -->
<div class="modal fade" id="form-edit{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLabel">Tambah Data Devisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="/devisi/{{$item->id}}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="name_divisions">Nama</label>
                                <input type="text" class="form-control" value="{{$item->name_divisions}}" name="name_divisions">
                            </div >
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> save</button>
                            </div>
                        </form>
            </div>
        </div>
    </div>
</div>