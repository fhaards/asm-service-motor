<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title_pdf; ?></title>
    <style>
        /** Define the margins of your page **/
        @page {
            margin: 0cm 0cm;
        }

        body {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            margin-top: 3cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0px;
            padding: 0px;
        }

        /** Define the header rules **/
        header {
            font-family: "Monospace", Arial, Helvetica, sans-serif;
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;

            /** Extra personal styles **/
            color: #dc2626;
            text-align: center;
            line-height: 1.5cm;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;

            /** Extra personal styles **/
            color: #ddd;
            text-align: center;
            line-height: 1.5cm;
        }

        #table {
            width: 100%;
            border-collapse: collapse;
        }

        #table td,
        #table th {
            border: 1px solid #6b7280;
            padding: 8px;
            font-size: 10px;
        }

        #table tr:nth-child(even) {
            background-color: #fef2f2;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
            background-color: #7f1d1d;
            color: #fff;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <header>
        <h3 style="padding:0px;margin:0px;"><?= $title_pdf; ?></h3>
        <!-- Laporan Data Keseluruhan Kecelakaan / Insiden -->
    </header>

    <!-- <footer>
        Copyright <?= APP_NAME; ?> &copy; <?php echo date("Y"); ?>
    </footer> -->

    <main>
        <div class="card card-invoice mt-5" id="detail-transaksi">
            <div class="card-body p-3">
                <div class="invoice-header">
                    <h1 class="invoice-title">Invoice</h1>
                    <div class="billed-from">
                        <h6><?= APP_NAME; ?></h6>
                        <p>201 Something St., Something Town, YT 242, Country 6546<br>
                            Tel No: 324 445-4544<br>
                            Email: youremail@companyname.com</p>
                    </div>
                </div>

                <div class="row mg-t-20">
                    <div class="col-md">
                        <label class="tx-gray-600">Tagihan Kepada</label>
                        <div class="billed-to">
                            <h6 class="cust-nm"></h6>
                            <p class="cust-tlp"></p>
                        </div>
                    </div>
                    <div class="col-md">
                        <label class="tx-gray-600">Informasi Invoice</label>
                        <p class="invoice-info-row">
                            <span>Invoice No</span>
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
                        <tfoot>
                            <tr>
                                <td colspan="3" class="tx-right">Tax (0%)</td>
                                <td colspan="2" class="tx-right"> - </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="tx-right tx-uppercase tx-bold tx-inverse">Total</td>
                                <td colspan="3" colspan="2" class="tx-right">
                                    <h4 class="tx-primary tx-bold total_harga">/h4>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
        <!-- <p style="page-break-after: never;">
            Content Page 2
        </p> -->
    </main>
</body>

</html>