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
        <div class="alert alert-outline-info rounded-10 pb-3 mb-3" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">x</span>
            </button>
            <strong>Keterangan :</strong>
            <ul class="nav flex-column">
                <li class="nav-item">1 . Jika terdapat Jumlah produk > 0 , Maka kategori tidak dapat di hapus </li>
            </ul>
        </div>
        <table class="table table-striped " id="table-<?= $titleContent; ?>" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="wd-10p">No</th>
                    <th class="wd-10p">Kode Unik</th>
                    <th class="wd-10p">Nama Kategori</th>
                    <th class="wd-10p">Jumlah Produk</th>
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
                        <label>Kode Unik</label>
                        <input type="text" class="form-control sparepart_cat_code" maxlength="3" name="sparepart_cat_code" placeholder="Masukan Kode Unik ..">
                    </div>
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" class="form-control sparepart_cat_nm" name="sparepart_cat_nm" placeholder="Nama <?= $titlePages; ?> ..">
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
                    <div class="form-group">
                        <input type="hidden" class="form-control this-id">
                        <div class="form-group">
                            <label>Kode Unik</label>
                            <input type="text" class="form-control input-1" maxlength="3" name="sparepart_cat_code" placeholder="Masukan Kode Unik ..">
                        </div>
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input type="text" class="form-control input-2" name="sparepart_cat_nm" placeholder="Nama <?= $titlePages; ?> ..">
                        </div>
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