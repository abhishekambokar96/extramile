<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title; ?></title>

    <?php include 'main_header_includes.php'; ?>

    <script src="<?php echo base_url('assets/global_assets/js/plugins/tables/datatables/datatables.min.js') ?>">
    </script>
    <script src="<?php echo base_url('assets/global_assets/js/plugins/forms/styling/switchery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/global_assets/js/plugins/tables/footable/footable.min.js') ?>"></script>
    <style>
    label {
        font-weight: 600;
        font-size: 15px;
    }

    input {
        box-shadow: 1px -1px 0px 0px #224268 !important;

    }

    /* input:hover {
        box-shadow: 4px -2px 0px 0px #229d65 !important;
    } */

    .btn_submit:hover {
        box-shadow: 0px 3px 12px -2px #787678;
    }

    .required {
        color: red;
    }
    </style>
</head>

<body>

    <?php include 'main_navbar.php'; ?>

    <div class="page-content pt-0" style="font-family: 'Roboto';">

        <div class="content-wrapper">

            <div class="content">

                <h1 style="font-weight:700; text-align:center;">CHANGE PASSWORD<br></h1>
                <br>

                <div class="card" style="width: 90%;margin-left: 65px;">
                    <div class="card-header bg-dark header-elements-inline"
                        style="border-top-right-radius: 15px;border-top-left-radius: 15px;">
                        <h6 class="card-title"><b>Change Password</b></h6>
                    </div>

                    <div class="card-body">
                        <form name="change_password" id="change_password" method="post"
                            action="<?php echo base_url('change_password/save') ?>" enctype="multipart/form-data"
                            data-skip="fale">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Username : <span class="required">*</span></label>
                                                    <input type="text" name="username" placeholder="Enter Username"
                                                        class="form-control"
                                                        value="<?php echo $this->session->userdata('username'); ?>"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Old Password : <span class="required">*</span></label>
                                                    <input type="password" name="old_password"
                                                        placeholder="Enter Old Password" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>New Password : <span class="required">*</span></label>
                                                    <input type="password" name="new_password"
                                                        placeholder="Enter New Password" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Confirm New Password : <span
                                                            class="required">*</span></label>
                                                    <input type="password" name="confirm_new_password"
                                                        placeholder="Enter Confirm New Password" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="text-right">
                                                <button type="submit" class="btn bg-slate-700">Submit <i
                                                        class="icon-paperplane ml-2"></i></button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <?php include 'main_footer.php'; ?>
    <?php include 'main_footer_includes.php'; ?>

    <script type="text/javascript">
    $(document).ready(function() {

    });

    function redirect_with_msg(data) {
        swal({
            text: data.message,
            type: "success"
        }).then(function() {
            window.location = data.link;
        });
    }
    </script>

</body>

</html>