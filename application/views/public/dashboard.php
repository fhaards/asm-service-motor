<!-- <div class="jumbotron">
    <h1 class="text-white tx-uppercase tx-spacing-4 text-center"><?= APP_NAME; ?></h1>
    <p>Bootstrap is the most popular HTML, CSS...</p>
</div> -->
<div class="card card-dashboard-seven rounded-10" id="dashboard-top-card">
    <div class="card-body py-md-2 px-md-3">
        <div class="row">
            <div class="col-12 col-lg-12 py-2 pl-4">
                <h5>Overview</h5>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4 pl-4">
                <div>
                    <label class="az-content-label">Total Pendapatan</label>
                    <h2 class="count-transaksi-amount"></h2>
                    <div class="desc up">
                        <i class="icon ion-md-stats"></i>
                        <span class="count_transaksi"></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 pl-4">
                <div>
                    <label class="az-content-label">Pendapatan Spareparts</label>
                    <h2 class="count-sparepart-amount"></h2>
                    <div class="desc up">
                        <i class="icon ion-md-stats"></i>
                        <span class="count_sparepart_qty"></span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-2 pl-4">
                <div>
                    <label class="az-content-label">Total Pegawai</label>
                    <h2 class="count_montir"></h2>
                </div>
            </div>
            <div class="col-6 col-lg-2 pl-4">
                <div>
                    <label class="az-content-label">Total Motor</label>
                    <h2 class="count-motor">

                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card card-dashboard-seven rounded-10" id="dashboard-stats">
    <div class="card-header p-3 m-0 d-flex d-flex flex-row gap-4 justify-content-between align-items-center">
        <div class="">
            <div class="az-content-label mg-b-5">Statistik Penjualan</div>
            <p class="mg-b-20 p-0 m-0">Tampilkan Data Pertahun</p>
        </div>
        <div class='form-group d-flex flex-row p-0 m-0'>
            <select class="form-control rounded-10 get-year">
            </select>
        </div>
    </div>
    <div class="card-body py-md-2 px-md-3">
        <div class="col-md-12">
            <div class="chart-js-line mb-3 py-3">
                <div class="chartjs-wrapper-demo"><canvas id="chartPendaptan"></canvas></div>
            </div>
        </div>
    </div>
</div>