<?php $this->load->view('layout/sidebar'); ?>
<div class="az-content az-content-dashboard-two">
    <?php $this->load->view('layout/header'); ?>

    <div class="az-content-body content-master">
        <div class="py-3 d-block d-md-flex m-0 master-page-header">
            <div>
                <h2 class="az-content-title mg-b-5 mg-b-lg-8 text-capitalize"><?= $titlePages; ?></h2>
                <p class="mg-b-0"><?= $titleSubPages; ?></p>
            </div>
        </div>
        <!-- Load Breadcrumbs -->
        <?= $breadcrumb; ?>
        <div class="my-3"></div>
        <!-- Load Contents -->
        <?php $this->load->view($content); ?>
    </div>
    <?php $this->load->view('layout/footer'); ?>
</div>