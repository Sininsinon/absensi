<div class="modal fade" id="form-show{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLabel">Details User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group text-center"> 
                            <label for="kategori"><strong>Kategori Status</strong></label>
                            <p class="form-control-plaintext text-center">{{ $item->kategori->name_categories ?? 'Tidak Ada Kategori' }}</p>
                            <hr>
                    </div>
                </div>
                <hr>
                <div class="col-md-4">
                    <div class="form-group text-center">
                        <label><strong>institution</strong></label>
                        <p class="form-control-plaintext">{{$item->institution}}</p>
                        <hr>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group text-center">
                        <label><strong>Devisi Magang</strong></label>
                        <p class="form-control-plaintext">{{ $item->devisi->name_divisions ?? 'Tidak Ada Devisi' }}</p>
                        <hr>
                    </div>
                </div>

                       
            </div>
            </div>
        </div>
    </div>
</div>
