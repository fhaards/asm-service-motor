<script src="<?php echo base_url() . 'src/app-function.js'; ?>"></script>

<?php
$getCurrentUrl = current_url();
$url1 =  $this->uri->segment(1);
$url2 =  $this->uri->segment(2);
$url3 =  $this->uri->segment(3);
?>

<?php if ($getCurrentUrl == base_url() . 'login') : ?>
    <script src="<?php echo base_url() . 'src/app-auth.js'; ?>"></script>
<?php endif; ?>

<?php if ($getCurrentUrl == base_url() . 'dashboard') : ?>
    <script src="<?php echo base_url() . 'lib/chart.js/Chart.bundle.min.js'; ?>"></script>
    <script src="<?php echo base_url() . 'src/public-dashboard.js'; ?>"></script>
<?php endif; ?>

<?php if ($getCurrentUrl == base_url() . 'motor') : ?>
    <script src="<?php echo base_url() . 'src/public-motor.js'; ?>"></script>
<?php endif; ?>

<?php if ($getCurrentUrl == base_url() . 'user') : ?>
    <script src="<?php echo base_url() . 'src/public-user.js'; ?>"></script>
<?php endif; ?>

<?php if ($getCurrentUrl == base_url() . 'service') : ?>
    <script src="<?php echo base_url() . 'src/public-service.js'; ?>"></script>
<?php endif; ?>

<?php if ($getCurrentUrl == base_url() . 'spart-cat') : ?>
    <script src="<?php echo base_url() . 'src/public-spart-cat.js'; ?>"></script>
<?php endif; ?>

<?php if ($getCurrentUrl == base_url() . 'spart-prod') : ?>
    <script src="<?php echo base_url() . 'lib/parsleyjs/parsley.min.js'; ?>"></script>
    <script src="<?php echo base_url() . 'src/public-spart-prod.js'; ?>"></script>
<?php endif; ?>

<?php if ($getCurrentUrl == base_url() . 'montir') : ?>
    <script src="<?php echo base_url() . 'src/public-montir.js'; ?>"></script>
<?php endif; ?>

<!-- TRASAKSI -->
<?php if ($getCurrentUrl == base_url() . 'transaksi') : ?>
    <script src="<?php echo base_url() . 'src/public-transaksi.js'; ?>"></script>
<?php endif; ?>

<?php if ($url1 == "transaksi" && $url2 == "add") : ?>
    <script src="<?php echo base_url() . 'lib/parsleyjs/parsley.min.js'; ?>"></script>
    <script src="<?php echo base_url() . 'src/public-transaksi-add.js'; ?>"></script>
<?php endif; ?>

<?php if ($url1 == "transaksi" && $url2 == "add-sparepart") : ?>
    <script src="<?php echo base_url() . 'lib/parsleyjs/parsley.min.js'; ?>"></script>
    <script src="<?php echo base_url() . 'src/public-penjualan-add.js'; ?>"></script>
<?php endif; ?>

<?php if ($url1 == "transaksi" && $url2 == "detail") : ?>
    <script src="<?php echo base_url() . 'src/public-transaksi-detail.js'; ?>"></script>
<?php endif; ?>

<!-- PENJUALAN -->
<?php if ($getCurrentUrl == base_url() . 'penjualan') : ?>
    <script src="<?php echo base_url() . 'src/public-penjualan.js'; ?>"></script>
<?php endif; ?>

<?php if ($url1 == "penjualan" && $url2 == "detail") : ?>
    <script src="<?php echo base_url() . 'src/public-penjualan-detail.js'; ?>"></script>
<?php endif; ?>

<?php if ($url1 == "url1" && $url2 == "url2") : ?>
    <script src="<?php echo base_url() . 'src/page-laka.js'; ?>"></script>
<?php endif; ?>