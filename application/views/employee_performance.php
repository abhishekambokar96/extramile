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

        <div class="content-wrapper">

            <div class="content">

                <h1 style="font-weight:700; text-align:center;">Employee Performance<br></h1>
                <br>
                <div class="card"
                    style="width: 90%;margin-left: 65px;border-top-right-radius: 15px;border-top-left-radius: 15px;">

                    <div class="card-header bg-dark header-elements-inline"
                        style="border-top-right-radius: 15px;border-top-left-radius: 15px;">
                        <h5 class="card-title"><b>Employee Performance</b> </h5>
                    </div>

                    <div class="card-body">

                        <div class="row mt-10">
                            <div class="table-responsive">
                                <table class="table table-bordered table-columned" style="text-align:center;"
                                    id="dt_list">
                                    <thead>
                                        <tr>
                                            <th>Employee Reference Name</th>
                                            <th>Response</th>
                                            <th>Status</th>
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
                <form method="post" action="<?php echo base_url() . 'employee_performance/update_feedback' ?>"
                    id="frmedituser" name="frmedituser" data-skip="false">
                    <div class="modal-header bg-theme" style="color:black;">
                        <h6 class="modal-title" style="float:left;">Response</h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Feedback : <span class="required">*</span></label>
                                    <input type="textarea" id="feedback" name="feedback" placeholder="Enter Feedback"
                                        class="form-control">

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
                "url": "<?php echo base_url() ?>employee_performance/fetch_details",
                "type": "POST",
            },
            "dom": 'Blfrtip',
            "className": "text-center",

            drawCallback: function(settings) {},

        });

        $(".dataTables_length select").addClass("datatable_show_select");

        $('#dt_list').on('click', '.edit-response', function(e) {

            var _this = $(this);
            $('#id').val($(_this).data('id'));

            $('#modal_theme_success').modal('show');

        });
    });
    </script>

</body>

</html>