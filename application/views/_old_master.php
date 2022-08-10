<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Based Templates">
    <meta name="author" content="Company Names">

    <title><?= APP_NAME; ?></title>

    <!-- vendor css -->
    <link href="<?= base_url() . 'assets/img/app/icons.ico'; ?>" rel="icon" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="<?= base_url() . 'vendor/fortawesome/font-awesome/css/all.min.css'; ?>" rel="stylesheet">
    <link href="<?= base_url() . 'lib/ionicons/css/ionicons.min.css'; ?>" rel="stylesheet">
    <link href="<?= base_url() . 'lib/typicons.font/typicons.css'; ?>" rel="stylesheet">
    <link href="<?= base_url() . 'lib/boxicons/css/boxicons.min.css'; ?>" rel="stylesheet">

    <!-- <link href="<?= base_url() . 'lib/datatables.net-dt/css/jquery.dataTables.min.css'; ?>" rel="stylesheet">
    <link href="<?= base_url() . 'lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css'; ?>" rel="stylesheet"> -->
    <link href="<?= base_url() . 'vendor/datatables/datatables/media/css/jquery.dataTables.min.css'; ?>" rel="stylesheet">
    <link href="<?= base_url() . 'vendor/select2/select2/dist/css/select2.min.css'; ?>" rel="stylesheet">

    <!-- <link href="<?= base_url() . 'lib/sweetalert2/sweetalert2.material-ui.min.css'; ?>" rel="stylesheet"> -->

    <!-- azia CSS -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/css/azia.css'; ?>">
    <link rel="stylesheet" href="<?= base_url() . 'assets/css/custom.css'; ?>">

</head>

<body class="az-body <?= (isLogin() ? 'az-body-sidebar' : 'az-body-login'); ?>" onafterprint="clearPrint()">

    <?php if ($this->uri->segment(1) != 'login') : ?>
        <?php $this->load->view('master_layout'); ?>
    <?php else : ?>
        <?php $this->load->view('auth_form'); ?>
    <?php endif; ?>

    <script src="<?= base_url() . 'lib/jquery/jquery.min.js'; ?>"></script>
    <script src="<?= base_url() . 'lib/bootstrap/js/bootstrap.bundle.min.js'; ?>"></script>
    <script src="<?= base_url() . 'lib/ionicons/ionicons.js'; ?>"></script>

    <!-- <script src="<?= base_url() . 'lib/datatables.net/js/jquery.dataTables.min.js'; ?>"></script>
    <script src="<?= base_url() . 'lib/datatables.net-dt/js/dataTables.dataTables.min.js'; ?>"></script>
    <script src="<?= base_url() . 'lib/datatables.net-responsive/js/dataTables.responsive.min.js'; ?>"></script>
    <script src="<?= base_url() . 'lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js'; ?>"></script> -->
    <script src="<?= base_url() . 'vendor/datatables/datatables/media/js/jquery.dataTables.min.js'; ?>"></script>
    <script src="<?= base_url() . 'vendor/select2/select2/dist/js/select2.min.js'; ?>"></script>

    <script src="<?= base_url() . 'assets/js/azia.js'; ?>"></script>
    <script src="<?= base_url() . 'lib/moment/min/moment-with-locales.min.js'; ?>"></script>
    <script src="<?= base_url() . 'lib/sweetalert2/sweetalert2.all.min.js'; ?>"></script>
    <script>
        var BASE_URL = "http://localhost/asm_/";
    </script>
    <script>
        $(function() {
            'use strict'

            $('.az-sidebar .with-sub').on('click', function(e) {
                e.preventDefault();
                $(this).parent().toggleClass('show');
                $(this).parent().siblings().removeClass('show');
            })

            $(document).on('click touchstart', function(e) {
                e.stopPropagation();

                // closing of sidebar menu when clicking outside of it
                if (!$(e.target).closest('.az-header-menu-icon').length) {
                    var sidebarTarg = $(e.target).closest('.az-sidebar').length;
                    if (!sidebarTarg) {
                        $('body').removeClass('az-sidebar-show');
                    }
                }
            });


            $('#azSidebarToggle').on('click', function(e) {
                e.preventDefault();

                if (window.matchMedia('(min-width: 992px)').matches) {
                    $('body').toggleClass('az-sidebar-hide');
                } else {
                    $('body').toggleClass('az-sidebar-show');
                }
            })
        });
    </script>
    <?php $this->load->view('_stack_js'); ?>
</body>

</html>