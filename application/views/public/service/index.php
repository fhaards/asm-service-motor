<div class="card rounded-10">
    <div class="card-header d-flex flex-row gap-4 justify-content-between align-items-center">
        <div>
            <div class="az-content-label mg-b-5">Manajemen <?= $titleContent; ?></div>
            <p class="mg-b-20 p-0 m-0">
                Data <?= $titleContent; ?> Keseluruhan
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
                    <th class="wd-10p">Nama Service</th>
                    <th class="wd-10p">Harga Service</th>
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
                <h6 class="modal-title text-capitalize">Tambah <?= $titleContent; ?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form-add-<?= $titleContent ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Servis</label>
                        <input type="text" class="form-control service_nm" name="service_nm" placeholder="Nama <?= $titleContent; ?> ..">
                    </div>
                    <div class="form-group">
                        <label>Harga Servis</label>
                        <input type="number" min="0" class="form-control service_hrg" name="service_hrg" placeholder="Harga ..">
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
                <h6 class="modal-title text-capitalize">Edit <?= $titleContent; ?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form-edit-<?= $titleContent ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control this-id">
                        <div class="form-group">
                            <label>Nama Servis</label>
                            <input type="text" class="form-control input-1" name="service_nm" placeholder="Nama <?= $titleContent; ?> ..">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Harga Servis</label>
                        <input type="number" min="0" class="form-control input-2" name="service_hrg" placeholder="Harga ..">
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