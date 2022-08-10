<form id="form-addtrans-<?= $titleContent ?>">
    <div class="card rounded-10">
        <div class="card-header d-flex flex-row gap-4 justify-content-between align-items-center">
            <div>
                <div class="az-content-label mg-b-5">Tambah <?= $titlePages; ?></div>
                <!-- <p class="mg-b-20 p-0 m-0">
                Tambah <?= $titlePages; ?> 
            </p> -->
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="form-group col-12 text-center">
                    <h6 class='py-3 mt-3 border-bottom border-top text-danger tx-uppercase tx-spacing-3'>Data Customer</h6>
                </div>
                <div class="form-group col-md-4">
                    <label>Nama Customer</label>
                    <input type="text" class="form-control cust_nm" name="cust_nm" placeholder="Input Nama Customer ..">
                </div>
                <div class="form-group col-md-4">
                    <label>No Telp</label>
                    <input type="text" class="form-control cust_tlp" name="cust_tlp" value="+628 ">
                </div>
                <div class="form-group col-md-4">
                    <label>Motor</label>
                    <!-- <div id="slWrapper" class="parsley-select bg-white w-100">
                        <select class="form-control motor select2" name="motor" data-placeholder="Choose one" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" required></select>
                        <div id="slErrorContainer"></div>
                    </div> -->
                    <select class="form-control motor" name="motor" required></select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 text-center">
                    <h6 class='py-3 mt-3 border-bottom border-top text-danger tx-uppercase tx-spacing-3'>Data Service</h6>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label>Tanggal</label>
                        <input type="date" class="form-control fc-datepicker trans-tgl" name="trans_tgl" placeholder="MM/DD/YYYY">
                    </div>
                    <div class="form-group">
                        <label>Pilih Montir</label>
                        <select class="form-control montir" name="montir"></select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label>Services</label>
                        <div class="load-service d-flex flex-wrap"></div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="form-group col-12 text-center">
                    <h6 class='py-3 mt-3 border-bottom border-top text-danger tx-uppercase tx-spacing-3'>Data Spareparts</h6>
                </div>
                <div class="form-group col-md-12 d-flex  justify-content-between align-items-center">
                    <div>
                        Tambah Spareparts
                    </div>
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="javascript:void(0)" class="btn btn-icon btn-link add-sparepart"> <i class="bx bx-plus"></i></a>
                            <a href="javascript:void(0)" class="btn btn-icon text-danger remove-sparepart"> <i class="bx bx-trash"></i></a>
                        </div>
                        <!-- <button id="addRow" type="button" class="btn btn-sm btn-primary"> + Halte </button> -->
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <table class="table">
                            <tr>
                                <th class="wd-5p">No</th>
                                <th class="wd-10p">Nama Sparepart</th>
                                <th class="wd-10p">Harga</th>
                                <th class="wd-5p">Qty</th>
                                <th class="wd-10p">SubTotal</th>
                            </tr>
                            <tbody id="new_chq">
                            </tbody>
                        </table>
                        <input type="hidden" value="1" id="total_chq">
                    </div>
                </div>
            </div>

        </div>
        <div class=" card-footer d-flex justify-content-end">
            <?= buttonSubmit('Simpan', 'bx bx-save', 'btn-submit-transaksi'); ?>
        </div>
    </div>
</form>