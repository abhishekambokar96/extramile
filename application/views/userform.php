<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include __DIR__ . '/main_header_includes.php'; ?>

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

    textarea {
        box-shadow: 1px -1px 0px 0px #224268 !important;
    }

    .btn_submit:hover {
        box-shadow: 0px 3px 12px -2px #787678;
    }


    .required {
        color: red;
    }
    </style>
    <style type="text/css">
    .datatable-header {
        padding: 0px 20px 0 20px;
    }

    .dataTables_length {
        margin: 0;
    }

    .radio {
        margin: 6px;
    }
    </style>

</head>

<body>
    <?php include __DIR__ . '/main_navbar.php'; ?>

    <div class="page-content pt-0" style="font-family:'Roboto';">
        <?php include __DIR__ . '/main_sidebar.php';
        ?>

        <div class="content-wrapper">

            <div class="content">

                <h1 style="font-weight:700; text-align:center;">Employee CRUD Operation<br></h1>
                <br>
                <div class="card" style="border-top-right-radius: 15px;border-top-left-radius: 15px;">

                    <div class="card-header bg-dark header-elements-inline"
                        style="border-top-right-radius: 15px;border-top-left-radius: 15px;">
                        <h5 class="card-title"><b>Employee CRUD Operation</b> </h5>
                    </div>

                    <div class="card-body">
                        <form name="personal_details" id="personal_details" method="post"
                            action="<?php echo base_url('user_form/save') ?>" enctype="multipart/form-data"
                            data-skip="false">

                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Name : <span class="required">*</span></label>
                                                    <input type="text" name="name" placeholder="Enter name"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Email/username : <span class="required">*</span></label>
                                                    <input type="email" name="email" placeholder="Enter email"
                                                        class="form-control">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Mobile Number : <span class="required">*</span></label>
                                                    <input type="mobile" name="mobile" placeholder="Enter Mobile Number"
                                                        class="form-control" min="10" max="10">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Gender : <span class="required">*</span></label><br>
                                                    <input type="radio" class="radio" name="gender"
                                                        value="female">Female
                                                    <input type="radio" class="radio" name="gender" value="male">Male
                                                    <input type="radio" class="radio" name="gender" value="other">Other
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select State : <span class="required">*</span></label>
                                                    <select class="select2" name="state" id="state">
                                                        <option value="" disabled selected>Choose State</option>
                                                        <?php
                                                        foreach ($state as $value) {
                                                            echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-md-12">
                                            <div class="text-right">
                                                <button type="submit" class="btn bg-slate-700">SUBMIT FORM <i
                                                        class="icon-paperplane ml-2"></i></button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                        <br>
                        <div class="row mt-10">
                            <div class="table-responsive">
                                <table class="table table-bordered table-columned" id="dt_list">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th>
                                            <th>Gender </th>
                                            <th>State </th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal_theme_success" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" action="<?php echo base_url() . 'user_form/update_details' ?>" id="frmedituser"
                    name="frmedituser" data-skip="false">
                    <div class="modal-header bg-theme" style="color:black;">
                        <h6 class="modal-title" style="float:left;">Edit User Details</h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name : <span class="required">*</span></label>
                                    <input type="text" name="name" id="name" placeholder="Enter Name"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email : <span class="required">*</span></label>
                                    <input type="email" id="email" name="email" placeholder="Enter email"
                                        class="form-control">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> Mobile No : <span class="required">*</span></label>
                                    <input type="mobile" id="mobile" name="mobile" placeholder="Enter Mobile No"
                                        class="form-control">

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gender : <span class="required">*</span></label><br>
                                    <input type="radio" class="radio" name="gender" id="female" value="female">Female
                                    <input type="radio" class="radio" name="gender" id="male" value="male">Male
                                    <input type="radio" class="radio" name="gender" id="other" value="other">Other
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select State : <span class="required">*</span></label>
                                    <select class="select2" name="state_edit" id="state_edit">
                                        <!-- <option value="" disabled selected>Choose State</option> -->
                                        <?php
                                        foreach ($state as $value) {
                                            echo "<option value='" . $value['id'] . "' >" . $value['name'] . "</option>";
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <input type="hidden" name="id" id="id">
                        <button type="submit" class="btn bg-success">Update changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/main_footer_includes.php'; ?>

    <script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2({
            minimumResultsForSearch: Infinity
        });

        var dt_student_report = $('#dt_list').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "iDisplayLength": -1,
            "ordering": false,
            "ajax": {
                "url": "<?php echo base_url() ?>user_form/fetch_details",
                "type": "POST",
            },
            "dom": 'Blfrtip',

            drawCallback: function(settings) {},

        });

        $(".dataTables_length select").addClass("datatable_show_select");

        $('#dt_list').on('click', '.edit-user', function(e) {

            var _this = $(this);
            var url = '<?php echo base_url() . 'user_form/get_details' ?>';
            var data = '{"id":"' + $(_this).data('id') + '"}';
            customAjax(url, data);

            $('#modal_theme_success').modal('show');

        });

        $('#dt_list tbody').on('click', '.delete-user', function() {
            var _this = $(this);
            var id = $(this).data('id');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this user details!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }).then(function() {
                var url = '<?php echo base_url() . 'user_form/delete_details' ?>';
                var data = '{"id":"' + id + '"}';
                customAjax(url, data);
            });
        });
    });

    function data_fill(response) {
        $('#id').val(response.data[0].id);
        $('#name').val(response.data[0].name);
        $('#mobile').val(response
            .data[0].mobile);
        $('#email').val(response.data[0].email);
        $('#add_to_result_edit_yes').prop('checked', true);
        var gender = response.data[0].gender;
        if (gender == "male") {
            $('#male').prop('checked', true);
        }
        if (gender == "female") {
            $('#female').prop('checked', true);
        }
        if (gender == "other") {
            $('#other').prop('checked', true);
        }
        $('#state_edit option[value=' + response.data[0].state + ']').prop('selected', true).trigger('change');
    }
    </script>

</body>

</html>