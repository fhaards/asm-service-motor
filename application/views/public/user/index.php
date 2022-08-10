<div class="card rounded-10">
    <div class="card-header d-flex flex-row gap-4 justify-content-between align-items-center">
        <div>
            <div class="az-content-label mg-b-5">Manajemen <?= $titlePages; ?></div>
            <p class="mg-b-20 p-0 m-0">
                Data <?= $titlePages; ?> Keseluruhan
            </p>
        </div>
        <div>
            <button class="btn rounded-10 btn-with-icon btn-az-primary" data-toggle="modal" data-target="#modal-add-<?= $titleContent; ?>">
                <i class="bx bx-plus"></i>
                Data Baru
            </button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped " id="table-<?= $titleContent; ?>" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="wd-10p">Nama</th>
                    <th class="wd-10p">Username</th>
                    <th class="wd-10p">Email</th>
                    <th class="wd-10p">Level</th>
                    <th class="wd-10p">Telp</th>
                    <th class="wd-10p">Alamat</th>
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
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Nama</label>
                            <input type="text" class="form-control name" name="name" placeholder="Nama .." required>
                        </div>

                        <div class="col-md-6">
                            <label>No Telp</label>
                            <input type="text" class="form-control telp" name="telp" value="+628 " placeholder="No Telp ..">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control alamat" name="alamat" placeholder="Alamat .."></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label> Data Account</label>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control email" name="email" placeholder="Email .." required>
                    </div>
                    <div class="form-group">
                        <label class="d-flex flex-row justify-content-between">
                            <span>Username <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div></span>
                            <span class="validate-username"></span>
                        </label>
                        <input type="text" class="form-control username" name="username" placeholder="Username .." required>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8">
                            <label>Password</label>
                            <input type="text" class="form-control password" name="password" value="12345" placeholder="Password .." required>
                        </div>
                        <div class="col-md-4">
                            <label>Level</label>
                            <select class="form-control level" name="level">
                                <option value="frontdesk">Frontdesk</option>
                                <option value="partman">Partman</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <?= buttonCancel("modal"); ?>
                    <?= buttonSubmit('Simpan', 'bx bx-save', 'btn-submit-user'); ?>
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
                    <input type="hidden" class="form-control old-pass" name="old_password">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Nama</label>
                            <input type="text" class="form-control input-1" name="name" placeholder="Nama .." required>
                        </div>

                        <div class="col-md-6">
                            <label>No Telp</label>
                            <input type="text" class="form-control input-2" name="telp" value="+628 " placeholder="No Telp ..">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control input-3" name="alamat" placeholder="Alamat .."></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label> Data Account</label>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control input-4" name="email" placeholder="Email .." required>
                    </div>
                    <div class="form-group">
                        <label class="d-flex flex-row justify-content-between">
                            <span>Username <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div></span>
                            <span class="validate-username"></span>
                        </label>
                        <input type="text" class="form-control input-5" name="username" placeholder="Username .." required>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8">
                            <label>New Password</label>
                            <input type="text" class="form-control password" name="password" placeholder="Password ..">
                        </div>
                        <div class="col-md-4">
                            <label>Level</label>
                            <select class="form-control input-6" name="level">
                                <option value="frontdesk">Frontdesk</option>
                                <option value="partman">Partman</option>
                            </select>
                        </div>

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