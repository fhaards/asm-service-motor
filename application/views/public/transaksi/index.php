<div class="card rounded-10">
    <div class="card-header d-flex flex-column flex-md-row gap-4 justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
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

                <!-- <button type="button" data-toggle="dropdown" class="btn rounded-10 btn-with-icon btn-az-primary">
                    <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i>
                    <div class="dropdown-menu">
                        <a href="" class="dropdown-item">Services Only</a>
                        <a href="" class="dropdown-item">Sparepart Only</a>
                    </div>
                </button> -->
            </div>
            <a href="<?= base_url() . 'transaksi/add'; ?>" class="btn rounded-10 btn-with-icon btn-outline-danger mr-3">
                <i class="bx bx-plus"></i>
                Transaksi
            </a>
            <a href="<?= base_url() . 'transaksi/add-sparepart'; ?>" class="btn rounded-10 btn-with-icon  btn-outline-primary">
                <i class="bx bx-plus-circle"></i>
                Penjualan Sparepart
            </a>

        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 justify-content-between mb-3">
                <form action="" class=" border-bottom" id="filter-<?= $titleContent; ?>">
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="col px-0 mx-0 d-md-block d-none"> <strong>Filter</strong></div>
                        <!-- <div class="col-md-3 form-group">
                            <label>Total Harga</label>
                            <select class="filter-total form-control">
                                <option value="All"> -- Pilih Total --</option>
                                <option value="100000">0 - Rp. 100 Ribu</option>
                                <option value="1000000">Rp. 100 Ribu - Rp. 1 Juta</option>
                                <option value="10000000">Rp. 1 Juta - Rp. 100 Juta</option>
                            </select>
                        </div> -->
                        <div class="col-md-3 form-group">
                            <label>Tipe</label>
                            <select class="filter-tipe form-control">
                                <option value="All"> -- Pilih Tipe --</option>
                                <option value="1">Service + Sparepart</option>
                                <option value="2">Service Only</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Status Transaksi</label>
                            <select class="filter-status form-control">
                                <option value="All"> -- Pilih Status --</option>
                                <option value="On Working">On Working</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
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


            <div class="col-md-12 table-responsive">
                <table class="table table-striped " id="table-<?= $titleContent; ?>" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="">ID</th>
                            <th class="">Tipe</th>
                            <th class="">Nama</th>
                            <th class="">Tanggal</th>
                            <th class="">Telp</th>
                            <th class="">Motor</th>
                            <th class="">Montir</th>
                            <th class="">Total Harga</th>
                            <th class="">Status</th>
                            <th class=""></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="modal-status-<?= $titleContent; ?>" class="modal fade effect-slide-in-bottom modal-fullscreen">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo rounded-10">
            <div class="modal-header">
                <h6 class="modal-title text-capitalize">Pembayaran <?= $titleContent; ?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-status-<?= $titleContent ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>ID Transaksi</label>
                        <input type="hidden" class="form-control this-id">
                        <p class="text-right h3 trans_id_display"></p>
                    </div>
                    <div class="form-group">
                        <label>Total Tagihan</label>
                        <input type="hidden" class="form-control total_harga" name="total_harga">
                        <p class="text-right h3 total_harga_display"></p>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Uang</label>
                        <input type="number" class="form-control uang_bayar" name="uang_bayar" placeholder="Jumlah Nominal Uang ..">
                    </div>
                </div>
                <div class="modal-footer">
                    <?= buttonCancel("modal"); ?>
                    <?= buttonSubmit('Bayar', 'bx bx-money', ''); ?>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="modal-report-<?= $titleContent; ?>" class="modal fade effect-slide-in-bottom modal-fullscreen">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo rounded-10">
            <div class="modal-header">
                <h6 class="modal-title text-capitalize">Report <?= $titleContent; ?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group pb-3 d-flex align-items-center justify-content-between border-bottom">
                    <label>Cetak Semua</label>
                    <a href="<?= base_url() . 'reports/transaksi'; ?>" target="_blank" class="btn rounded-10 btn-with-icon btn-az-primary">
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
                <div class="form-group pb-3 border-bottom">
                    <label>Cetak Sesuai Bulan</label>
                    <div class="d-flex align-items-center justify-content-between ">

                        <select class="form-control mr-3 pilih-bulan"></select>

                        <button type="button" target="_blank" class="btn rounded-10 btn-with-icon btn-az-primary pilih-bulan-btn">
                            <i class="bx bx-printer"></i> Cetak
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?= buttonCancel("modal"); ?>
            </div>

        </div>
    </div>
</div>