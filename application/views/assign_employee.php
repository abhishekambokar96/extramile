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
        <?php include __DIR__ . '/main_sidebar.php'; ?>


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
                        <form name="assign_details" id="assign_details" method="post"
                            action="<?php echo base_url('assign_employee/save') ?>" enctype="multipart/form-data"
                            data-skip="false">

                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset>

                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Employee : <span class="required">*</span></label>
                                                    <select class="select2" name="employee" id="employee">
                                                        <option value="" disabled selected>Choose Employee</option>
                                                        <?php
                                                        foreach ($employee as $value) {
                                                            echo "<option value='" . $value['id'] . "'>" . $value['name'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Employee Reference : <span
                                                            class="required">*</span></label>
                                                    <select class="select2" name="employee_ref" id="employee_ref">
                                                        <option value="" disabled selected>Choose Employee Reference
                                                        </option>
                                                        <?php
                                                        foreach ($employee as $value) {
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
                                            <th>Employee Name</th>
                                            <th>Employee Reference Name</th>
                                            <th>Feedback</th>

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
                "url": "<?php echo base_url() ?>assign_employee/fetch_details",
                "type": "POST",
            },
            "dom": 'Blfrtip',

            drawCallback: function(settings) {},

        });

        $(".dataTables_length select").addClass("datatable_show_select");
    });
    </script>

</body>

</html>