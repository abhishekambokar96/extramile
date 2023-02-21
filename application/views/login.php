<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Test - Login</title>

    <?php include 'main_header_includes.php'; ?>
    <style>
    .login-form {
        width: 100% !important;
    }

    .card {
        box-shadow: 0px 6px 14px -2px #bab6ba;
    }
    </style>
</head>
<?php include 'main_navbar_login.php'; ?>

<div class="page-content" style="font-family: 'Roboto';">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->

        <div class="content" style="font-family:Roboto">
            <div class="row">
                <div class="col-md-3">
                </div>

                <!-- Login form -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h3>Sign In</h3>
                            </div>

                            <!-- Login form -->
                            <form class="login-form" method="post" name="login_form" id="login_form"
                                action="<?php echo base_url('Login') ?>" data-skip="false">
                                <div class="row">
                                    <div class="col-md-12 text-center mb-3">
                                        <h5 class="mb-0">Login to your Account</h5>
                                        <span class="d-block text-muted">Enter your credentials below</span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                            <input type="text" class="form-control" name="username"
                                                placeholder="Email ID">
                                            <div class="form-control-feedback">
                                                <i class="icon-user text-muted"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-group-feedback form-group-feedback-left">
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Password">
                                            <div class="form-control-feedback">
                                                <i class="icon-lock2 text-muted"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block bg-slate-700"
                                                style="border-radius:40px;"> SIGN
                                                IN
                                                <i class="icon-circle-right2 ml-2"></i></button>
                                        </div>

                                    </div>

                                    <div class="col-md-12">

                                        <p class="text-center errmsgs"><?php echo (isset($error)) ? $error : ''; ?></p>
                                    </div>
                                </div>
                                <!-- <div class="text-center">
                                <a href="login_password_recover.html">Forgot password?</a>
                            </div> -->
                            </form>
                            <!-- /login form -->
                        </div>
                    </div>
                </div>
                <!-- /login form -->

                <div class="col-md-3">
                </div>
            </div>
        </div>
        <!-- /content area -->
    </div>
    <!-- /main content -->

</div>
<div id="modalRegister" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form method="post" action="<?php echo base_url() . 'login/forgot_password' ?>" id="frmeditfaculty"
                name="frmeditfaculty" data-skip="false">
                <!-- <div class="modal-header bg-theme" style="color:black; font-family: roboto !important;">
                <h6 class="modal-title" style="font-size: 20px;font-weight: 500;">Forgot Password</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div> -->

                <div class="modal-body">
                    <!-- <div class="card"> -->
                    <div class="card-header bg-dark header-elements-inline">
                        <h6 class="card-title"><b>FORGOT PASSWORD </b></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <b><label>Enter Email ID : <span class="required">*</span></label></b>
                                <input type="email" name="email" placeholder="Enter email" class="form-control">
                            </div>

                        </div>
                    </div>

                    <!-- </div> -->

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success pull-right">Verify Email</button>

                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'main_footer.php'; ?>
<?php include 'main_footer_includes.php'; ?>
</body>

</html>

<script type="text/javascript">
$(document).ready(function() {

});

function login_redirect(response) {
    var role_id = response.data['role_id'];
    if (role_id == 2) {
        window.location = "<?php echo base_url() ?>employee_performance";
    }
    if (role_id == 1) {
        window.location = "<?php echo base_url() ?>user_form";
    }

}

function redirect_with_msg_error(data) {

    swal("Information", data.message, "error").then(function() {

    });
}
</script>