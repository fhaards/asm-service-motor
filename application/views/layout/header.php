<div class="az-header">
    <div class="container-fluid">
        <div class="az-header-left">
            <a href="" id="azSidebarToggle" class="az-header-menu-icon"><span></span></a>
        </div>
        <div class="az-header-center">
            <input type="search" class="form-control" placeholder="Search for anything...">
            <button class="btn"><i class="fas fa-search"></i></button>
        </div>
        <div class="az-header-right">
            <div class="az-header-message d-none">
                <a href="app-chat.html">
                    <i class="bx bx-conversation tx-30"></i>
                </a>
            </div>
            <div class="dropdown az-header-notification d-none">
                <a href="" class="new">
                    <i class="bx bx-bell tx-30 bx-tada"></i>
                </a>
                <div class="dropdown-menu">
                    <div class="az-dropdown-header mg-b-20 d-sm-none">
                        <a href="" class="az-header-arrow">
                            <i class="icon ion-md-arrow-back"></i>
                        </a>
                    </div>
                    <h6 class="az-notification-title">Notifications</h6>
                    <p class="az-notification-text">You have 2 unread notification</p>
                    <div class="az-notification-list">
                        <div class="media new">
                            <div class="az-img-user"><img src="https://via.placeholder.com/500x500" alt=""></div>
                            <div class="media-body">
                                <p>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</p>
                                <span>Mar 15 12:32pm</span>
                            </div>
                        </div>
                        <div class="media new">
                            <div class="az-img-user online"><img src="https://via.placeholder.com/500x500" alt=""></div>
                            <div class="media-body">
                                <p><strong>Joyce Chua</strong> just created a new blog post</p>
                                <span>Mar 13 04:16am</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="az-img-user"><img src="https://via.placeholder.com/500x500" alt=""></div>
                            <div class="media-body">
                                <p><strong>Althea Cabardo</strong> just created a new blog post</p>
                                <span>Mar 13 02:56am</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="az-img-user"><img src="https://via.placeholder.com/500x500" alt=""></div>
                            <div class="media-body">
                                <p><strong>Adrian Monino</strong> added new comment on your photo</p>
                                <span>Mar 12 10:40pm</span>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-footer"><a href="">View All Notifications</a></div>
                </div>
            </div>
            <div class="dropdown az-profile-menu">
                <a href="" class="az-img-user">
                    <i class="bx bxs-user-circle tx-30"></i>
                </a>
                <div class="dropdown-menu ">
                    <?php if (isLogin()) : ?>
                        <div class="az-dropdown-header d-sm-none">
                            <a href="" class="az-header-arrow">
                                <i class="icon ion-md-arrow-back"></i>
                            </a>
                        </div>
                        <div class="az-header-profile">
                            <div class="az-img-user d-flex align-items-center justify-content-center">
                                <i class="bx bxs-user-circle tx-100-f"></i>
                            </div>
                            <p class="h6 p-0 m-0"><?= getUserData()['name']; ?> </p>
                            <span>You are, <?= getUserData()['level']; ?></span>
                        </div>
                        <div class="dropdown-item">
                            <a href="<?= base_url() . 'auth/destroy'; ?>" class="btn btn-light btn-inline-block d-flex flex-row align-items-center">
                                <i class="bx bx-log-out"></i>
                                Sign Out
                            </a>
                        </div>
                    <?php else : ?>
                        <div class="dropdown-item">
                            <button class="btn rounded-10 btn-with-icon btn-block btn-az-primary" data-toggle="modal" data-target="#modal-auth">
                                <i class="bx bx-log-in"></i>
                                Login
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 
    <a href="" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
    <a href="" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
    <a href="" class="dropdown-item"><i class="typcn typcn-time"></i> Activity Logs</a>
    <a href="" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a> 
-->