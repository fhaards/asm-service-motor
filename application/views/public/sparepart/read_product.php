<div class="card rounded-10">
    <div class="card-header d-flex flex-row gap-4 justify-content-between align-items-center">
        <div>
            <div class="az-content-label mg-b-5">Manajemen <?= $titlePages; ?></div>
            <p class="mg-b-20 p-0 m-0">
                Data <?= $titlePages; ?> Keseluruhan
            </p>
        </div>
        <div class="d-flex flex-row">
            <div class="btn-group mr-3" role="group" aria-label="Basic example">
                <button type="button" class="btn rounded-10 btn-with-icon btn-outline-dark" data-toggle="modal" data-target="#modal-report-<?= $titleContent; ?>">
                    <i class="bx bx-printer"></i>
                    Cetak
                </button>

            </div>
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
                <li class="nav-item">1 . Jika terdapat Transaksi dengan sparepart tsb berjumlah > 0 , Maka kategori tidak dapat di hapus </li>
            </ul>
        </div>
        <div class="justify-content-between mb-3">
            <form action="" class=" border-bottom" id="filter-<?= $titleContent; ?>">
                <div class="d-flex align-items-center justify-content-end">
                    <div class="col px-0 mx-0 d-md-block d-none"> <strong>Filter</strong></div>

                    <div class="col-md-3 form-group">
                        <label>Category </label>
                        <select class="filter-category form-control">
                        </select>
                    </div>
                    <!-- <div class="col-md-3 form-group">
                        <label>Stok </label>
                        <select class="filter-stok form-control">
                            <option value="All"> -- Pilih Stok --</option>
                            <option value="1">Ready</option>
                            <option value="0">Kosong</option>
                        </select>
                    </div> -->
                    <div class="col-md-2  px-0 mx-0 form-group">
                        <label class="d-flex flex-row align-items-center">
                            Tanggal
                            <a href="javascript:void(0)" class="ml-2 p-0 m-0 clear-dates">
                                <span class="bx bx-refresh"></span>Clear
                            </a>
                        </label>
                        <input type="date" class="filter-date form-control">
                    </div>
                </div>
            </form>
        </div>
        <table class="table table-striped " id="table-<?= $titleContent; ?>" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="wd-5p">ID</th>
                    <th class="wd-10p">Nama Produk</th>
                    <th class="wd-10p">Kategori</th>
                    <th class="wd-10p">Harga</th>
                    <th class="wd-5p">Stock</th>
                    <th class="wd-10p">Tgl IN / UP</th>
                    <th class="wd-5p">Transaksi</th>
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
                    <!-- <div class="form-group">
                        <label>Model ID</label>
                        <input type="text" class="form-control sparepart_prod_id" minlength="4" maxlength="5" name="sparepart_prod_id" placeholder="Model ID  ..">
                    </div> -->
                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control category" name="category" placeholder="Kategori ..">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control sparepart_prod_nm" name="sparepart_prod_nm" placeholder="Nama <?= $titlePages; ?> ..">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8">
                            <label>Harga Produk</label>
                            <input type="number" min="0" class="form-control sparepart_prod_hrg" name="sparepart_prod_hrg" placeholder="Harga ..">
                        </div>
                        <div class="col-md-4">
                            <label>Stock</label>
                            <input type="number" min="0" class="form-control sparepart_prod_stock" name="sparepart_prod_stock" placeholder="Stock ..">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control sparepart_prod_desc" name="sparepart_prod_desc" placeholder="Deskripsi"></textarea>
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
                        <label>Model Id</label>
                        <h5 class="span-id"></h5>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control category" name="category" placeholder="Kategori ..">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control input-1" name="sparepart_prod_nm" placeholder="Nama <?= $titlePages; ?> ..">
                    </div>
                    <div class="form-group">
                        <label>Harga Produk</label>
                        <input type="number" min="0" class="form-control input-2" name="sparepart_prod_hrg" placeholder="Harga ..">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control input-3" name="sparepart_prod_desc" placeholder="Deskripsi"></textarea>
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

<div id="modal-report-<?= $titleContent; ?>" class="modal fade effect-slide-in-bottom modal-fullscreen">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo rounded-10">
            <div class="modal-header">
                <h6 class="modal-title text-capitalize">Report <?= $titlePages; ?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group pb-3 d-flex align-items-center justify-content-between border-bottom">
                    <label>Cetak Semua</label>
                    <a href="<?= base_url() . 'reports/sparepart'; ?>" target="_blank" class="btn rounded-10 btn-with-icon btn-az-primary">
                        <i class="bx bx-printer"></i> Cetak
                    </a>
                </div>
                <div class="form-group pb-3 border-bottom">
                    <label>Cetak Sesuai Tanggal</label>
                    <div class="d-flex align-items-center justify-content-between ">
                        <input type="date" class="form-control mr-3 pilih-tanggal-spec">

                        <button type="button" target="_blank" class="btn rounded-10 btn-with-icon btn-az-primary" onclick="cetakTglSpec()">
                            <i class="bx bx-printer"></i> Cetak
                        </button>
                    </div>
                </div>
                <!-- <div class="form-group pb-3 border-bottom">
                    <label>Cetak Sesuai Bulan</label>
                    <div class="d-flex align-items-center justify-content-between ">

                        <select class="form-control mr-3 pilih-bulan"></select>

                        <button type="button" target="_blank" class="btn rounded-10 btn-with-icon btn-az-primary pilih-bulan-btn">
                            <i class="bx bx-printer"></i> Cetak
                        </button>
                    </div>
                </div> -->
            </div>
            <div class="modal-footer">
                <?= buttonCancel("modal"); ?>
            </div>

        </div>
    </div>
</div>