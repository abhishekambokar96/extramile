<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-brand">
        <a href="#" class="d-inline-block">
            <img src="<?php echo base_url('assets/global_assets/images/image.png') ?>"
                style="width: 12rem;height: 2.2rem;" alt="">
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>


    <div class="collapse navbar-collapse" id="navbar-mobile">
        <span class="navbar-text ml-md-3 mr-md-auto">
            <span class="badge bg-success"></span>
        </span>

        <ul class="navbar-nav">
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <!-- <img src="<?php echo base_url('assets/global_assets/images/placeholders/placeholder.jpg') ?>"
                        class="rounded-circle" alt=""> -->
                    <span style=" text-transform: uppercase;"> WELCOME,
                        <?php echo $this->session->userdata('username'); ?></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <!-- <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> MY PROFILE</a> -->
                    <a href="<?php echo base_url() ?>change_password" class="dropdown-item"><i class="icon-key"></i>
                        CHANGE PASSWORD</a>

                    <a href="<?php echo base_url('logout') ?>" class="dropdown-item"><i class="icon-switch2"></i>
                        LOGOUT</a>
                </div>
            </li>
        </ul>

    </div>
</div>