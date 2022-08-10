<div class="d-flex flex-row gap-4 justify-content-between align-items-center">
    <div></div>
    <div class="d-flex flex-row">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" onclick="printThis()" class="btn rounded-10 btn-with-icon btn-dark cetak-btn">
                <i class="bx bx-printer"></i>
                Cetak
            </button>
        </div>
    </div>
</div>

<div class="card card-invoice mt-5" id="detail-transaksi">
    <input type="hidden" class="setup-id" value="<?= $UrlId; ?>">
    <div class="card-body p-3  <?= ($getData['status'] == 'Completed' ? 'status-trans-lunas' : ''); ?>">

        <?php if ($getData['status'] == 'Completed') : ?>
            <div class="invoice-header">
                <h1 class="invoice-title">Invoice</h1>
                <div class="billed-from">
                    <h6 class="text-primary tx-uppercase tx-spacing-3"><?= APP_NAME; ?></h6>
                    <p><?= APP_ADDRESS; ?><br>
                        Tel No: <?= APP_TELP; ?><br>
                        Email: asm@gmail.com</p>
                </div>
            </div>
        <?php else : ?>
            <h1 class="invoice-title text-warning text-center">On Working</h1>
        <?php endif; ?>


        <div class="row mg-t-20">
            <?php if ($getData['status'] == 'Completed') : ?>
                <div class="col-md">
                    <label class="tx-gray-600">Tagihan Kepada</label>
                    <div class="billed-to">
                        <h6 class="cust-nm"></h6>
                        <p class="cust-tlp"></p>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-md">
                <?php if ($getData['status'] == 'Completed') : ?>
                    <label class="tx-gray-600">Informasi Invoice</label>
                <?php endif; ?>
                <p class="invoice-info-row">
                    <span>No</span>
                    <span class="trans_id"></span>
                </p>
                <p class="invoice-info-row">
                    <span>Tanggal</span>
                    <span class="trans_tgl"></span>
                </p>
                <p class="invoice-info-row">
                    <span>Montir / Pekerja</span>
                    <span class="montir"></span>
                </p>
            </div>
        </div>

        <div class="table-responsive mg-t-40">
            <table class="table table-invoice">
                <thead>
                    <tr>
                        <th class="text-primary wd-20p">Name</th>
                        <th class="text-primary wd-5p tx-center">QNTY</th>
                        <th class="text-primary wd-10p tx-right">Unit Price</th>
                        <th class="text-primary wd-10p tx-right">Amount</th>
                    </tr>
                </thead>
            </table>
            <table class="table table-invoice bprder-none table-striped">
                <thead>
                    <tr colspan="4">
                        <th><strong class="text-dark font-weight-bold">Jasa Service</strong></th>
                    </tr>
                </thead>
                <tbody class="table-service"></tbody>
            </table>

            <table class="table table-invoice bprder-none table-striped">
                <thead>
                    <tr colspan="4">
                        <th><strong class="text-dark font-weight-bold">Spareparts</strong></th>
                    </tr>
                </thead>
                <tbody class="table-sparepart"></tbody>
                <?php if ($getData['status'] == 'Completed') : ?>
                    <tfoot>
                        <tr>
                            <td colspan="1" rowspan="4" class="valign-middle">
                                <div class="text-muted mt-3">
                                    <label class="tx-13 font-weight-bold">Notes</label>
                                    <p>Thank you for using our services and purchasing spare parts products at our store. We always try to do our best for the satisfaction of our customers.</p>
                                </div><!-- invoice-notes -->
                            </td>
                            <td rowspan="4"></td>
                            <td class="tx-right">Tax (0%)</td>
                            <td class="tx-right"> - </td>
                        </tr>
                        <tr>
                            <td class="tx-right">Payment</td>
                            <td class="tx-right uang_bayar"> - </td>
                        </tr>
                        <tr>
                            <td class="tx-right tx-uppercase tx-bold tx-inverse">Total</td>
                            <td class="tx-right">
                                <h4 class="tx-primary tx-bold total_harga"></h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-right">-</td>
                            <td class="tx-right uang_kembali"> - </td>
                        </tr>
                    </tfoot>
                <?php endif; ?>
            </table>
        </div>
        <hr class="mg-b-40">
        <!-- <a href="" class="btn btn-primary btn-block">Pay Now</a> -->

    </div>
</div>