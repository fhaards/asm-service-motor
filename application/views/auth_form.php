<div class="az-signin-wrapper auth-form">
    <div class="az-card-signin rounded-10 bg-white shadow">
        <div class="az-signin-header">
            <h1 class="az-logo mb-5">
                <img src="<?= base_url() . 'assets/img/app/logo.svg'; ?>" width="100%">
            </h1>
            <form id="login-form">
                <div class="form-group">
                    <h6> Login </h6>
                    <hr>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" id="username" aria-describedby="usernameHelp" placeholder="Enter Username ..." />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password ..." />
                </div>
                <?= buttonSubmit('Login', 'bx bx-log-in', 'btn-login'); ?>
            </form>
        </div>
    </div>
</div>