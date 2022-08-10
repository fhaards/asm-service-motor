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
            font-family: "Arial", Arial, Helvetica, sans-serif;
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;

            /** Extra personal styles **/
            color: #1c1917;
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
            border: 1px solid #d6d3d1;
        }

        #table tr:nth-child(even) {
            background-color: #f5f5f4;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
            background-color: #dc2626;
            color: #fff;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <!-- Define header and footer blocks before your content -->
    <header>
        <h3 style="padding:0px;margin:0px;"><?= $title_pdf; ?></h3>
        <!-- Laporan Data Keseluruhan Kecelakaan / Insiden -->
    </header>

    <!-- <footer>
        Copyright <?= APP_NAME; ?> &copy; <?php echo date("Y"); ?>
    </footer> -->

    <!-- Wrap the content of your PDF inside a main tag -->
    <main>
        <?php if (empty($item)) : ?>
            <div style="text-align:center;padding:10px;margin-top:30%;">
                <H6>Data Tidak Ada/Kosong</H6>
            </div>
        <?php else : ?>

            <?php if ($tipe_data == "all") : ?>
                <table id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Tgl</th>
                            <th>Sparepart</th>
                            <th>Harga(Unit)</th>
                            <th>Qty</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        <?php foreach ($item as $x) : ?>
                            <?php $no++; ?>
                            <tr>
                                <td style="text-align:center;"><?= $no; ?></td>
                                <td><?= $x['id_trans']; ?></td>
                                <td><?= date("d - m - Y", strtotime($x['trans_tgl'])); ?></td>
                                <td><?= $x['sparepart_nm']; ?></td>
                                <td><?= 'Rp. ' . number_format($x['sparepart_hrg'], 0); ?></td>
                                <td><?= $x['sparepart_qty']; ?></td>
                                <td><?= 'Rp. ' . number_format($x['sparepart_total_hrg'], 0); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">Total Qty</td>
                            <td> <?= $count['grandtotal_qty']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="6">Total Harga</td>
                            <td><?= 'Rp. ' . number_format($count['grandtotal_hrg'], 0); ?></td>
                        </tr>
                    </tfoot>
                </table>
            <?php elseif ($tipe_data == "bulanan") : ?>
                <table id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tgl</th>
                            <th>Qty</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        <?php foreach ($item as $x) : ?>
                            <?php $no++; ?>
                            <tr>
                                <td style="text-align:center;"><?= $no; ?></td>
                                <td><?= date("d - m - Y", strtotime($x['trans_tgl'])); ?></td>
                                <td><?= $x['sparepart_qty']; ?></td>
                                <td><?= 'Rp. ' . number_format($x['sparepart_total_hrg'], 0); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Total Qty</td>
                            <td> <?= $count['grandtotal_qty']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">Total Harga</td>
                            <td><?= 'Rp. ' . number_format($count['grandtotal_hrg'], 0); ?></td>
                        </tr>
                    </tfoot>
                </table>
            <?php endif; ?>
        <?php endif; ?>
    </main>
</body>

</html>