<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md"
    style="margin-top: 20px;margin-bottom: 20px;margin-left: 26px;margin-right: 5px;">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <?php $roleid = $this->session->userdata('role_id'); ?>
                <?php if ($roleid == 1) { ?>
                <li class="nav-item"><a href="<?php echo base_url('user_form') ?>" class="nav-link 'active'"><i
                            class="icon-width"></i> <span>Create Employee</span></a></li>

                <li class="nav-item"><a href="<?php echo base_url('assign_employee') ?>" class="nav-link"><i
                            class="icon-home4"></i><span>Assign Employee</span>
                    </a></li>
                <?php } ?>

                <!-- /main -->

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>