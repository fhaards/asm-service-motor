<div class="card rounded-10">
    <div class="card-header d-flex flex-row gap-4 justify-content-between align-items-center">
        <div>
            <div class="az-content-label mg-b-5">Manajemen <?= $titlePages; ?></div>
            <p class="mg-b-20 p-0 m-0">
                Data <?= $titlePages; ?> Keseluruhan
            </p>
        </div>
        <div>
            <button class="btn rounded-10 btn-with-icon btn-az-primary" data-toggle="modal" data-target="#modal-add-<?= $titleContent; ?>">
                <i class="bx bx-plus"></i>
                Data Baru
            </button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped " id="table-<?= $titleContent; ?>" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="wd-10p">ID</th>
                    <th class="wd-10p">Nama</th>
                    <th class="wd-10p">Telp</th>
                    <th class="wd-10p">Tgl Lahir</th>
                    <th class="wd-10p">Jenis Kelamin</th>
                    <th class="wd-10p">Alamat</th>
                    <th class="wd-5p">
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>


<div id="modal-add-<?= $titleContent; ?>" class="modal fade effect-slide-in-bottom modal-fullscreen">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo rounded-10">
            <div class="modal-header">
                <h6 class="modal-title text-capitalize">Tambah <?= $titlePages; ?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form-add-<?= $titleContent ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Montir</label>
                        <input type="text" class="form-control montir_nm" name="montir_nm" placeholder="Nama <?= $titlePages; ?> ..">
                    </div>
                    <div class="form-group">
                        <label>No Telp</label>
                        <input type="number" min="0" class="form-control montir_tlp" name="montir_tlp" placeholder="No Telp ..">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Jenis Kelamin</label>
                            <select class="form-control montir_jk" name="montir_jk">
                                <option value="Laki Laki">Laki Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Tgl Lahir</label>
                            <input type="date" class="form-control montir_tgl_lahir" name="montir_tgl_lahir" placeholder="Tgl Lahir ..">
                        </div>

                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control montir_alamat" name="montir_alamat" placeholder="Alamat.."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <?= buttonCancel("modal"); ?>
                    <?= buttonSubmit('Simpan', 'bx bx-save', ''); ?>
                </div>
            </form>
        </div>
    </div>
</div>



<div id="modal-edit-<?= $titleContent; ?>" class="modal fade effect-slide-in-bottom modal-fullscreen">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo rounded-10">
            <div class="modal-header">
                <h6 class="modal-title text-capitalize">Edit <?= $titlePages; ?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form-edit-<?= $titleContent ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" class="form-control this-id">
                    <div class="form-group">
                        <label>Nama Montir</label>
                        <input type="text" class="form-control input-1" name="montir_nm" placeholder="Nama <?= $titlePages; ?> ..">
                    </div>
                    <div class="form-group">
                        <label>No Telp</label>
                        <input type="number" min="0" class="form-control input-2" name="montir_tlp" placeholder="No Telp ..">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Jenis Kelamin</label>
                            <select class="form-control input-3" name="montir_jk">
                                <option value="Laki Laki">Laki Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Tgl Lahir</label>
                            <input type="date" class="form-control input-4" name="montir_tgl_lahir" placeholder="Tgl Lahir ..">
                        </div>

                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control input-5" name="montir_alamat" placeholder="Alamat.."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <?= buttonCancel("modal"); ?>
                    <?= buttonSubmit('Simpan', 'bx bx-save', ''); ?>
                </div>
            </form>
        </div>
    </div>
</div>