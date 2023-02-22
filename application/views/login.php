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

        <div class="content" style="font-family:Roboto">
            <div class="row">
                <div class="col-md-3">
                </div>

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
                               
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                </div>
            </div>
        </div>
    </div>
    <!-- /main content -->

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