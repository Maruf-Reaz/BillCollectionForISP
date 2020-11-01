<?php require APPROOT . '/views/layouts/header.php' ?>
    <!--Mobile header with Navbar and notification bar-->
<?php require APPROOT . '/views/layouts/mobile_header.php' ?>
    <!--Menu Sidebar with navbar-->
<?php require APPROOT . '/views/layouts/menu_sidebar.php' ?>
    <!--Desktopn header with navbar and header file-->
<?php require APPROOT . '/views/layouts/desktop_header.php' ?>

    <style>
        table.jambo_table tbody tr td a.btn-primary {
            background-color: #85CE36 !important;
            border-color: #85CE36 !important;
            box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(133, 206, 54, 0.4) !important;
            padding: 6px 0 !important;
        }

        table.jambo_table tbody tr td a.btn-primary {
            background-color: #85CE36 !important;
            border-color: #85CE36 !important;
            box-shadow: 0 4px 10px 5px rgba(0, 0, 0, 0.14), 0 7px 20px 5px rgba(133, 206, 54, 0.4);
        !important;
            padding: 6px 0 !important;
        }

        /*table.jambo_table thead tr.headings th:nth-child(3) {
            min-width: 200px!important;
        }*/

    </style>

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="x_panel au-card au-card au-card--no-pad m-b-40">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="filters">
                                        <h4>Subscribers With Due Amount</h4>
                                        <div class="rs-select2--dark rs-select2--border col-lg-2 col-xs-6">
                                            <select class="js-select2" name="location_id" id="location_id">
                                                <option selected="selected">Location</option>
												<?php foreach ( $data['locations'] as $location ): ?>
                                                    <option value="<?php echo $location->id; ?>"> <?php echo $location->location_name; ?></option>
												<?php endforeach; ?>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                    <div class="x_content">
                                        <div class="table-responsive">
                                            <table id="example2" class="table table-striped jambo_table bulk_action">
                                                <thead>
                                                <tr class="headings">
                                                    <th class="column-title">#</th>
                                                    <th class="column-title">Photo</th>
                                                    <th class="column-title">Name</th>
                                                    <th class="column-title">User ID</th>
                                                    <th class="column-title">Phone</th>
                                                    <th class="column-title">Package Name</th>
                                                    <th class="column-title">Prev. Due</th>
                                                    <th class="column-title">Current Due</th>
                                                    <th class="column-title">Total Due</th>
                                                    <th class="column-title">Location</th>
                                                    <th class="column-title">Location Serial</th>
                                                    <th class="column-title">Options</th>
                                                </tr>
                                                </thead>
                                                <tbody id="data_table_body">
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function () {
            $('#example2').DataTable({

                "pagingType": "full_numbers",

                "dom": 'tB<"right"rpl>',

                "ordering": false,

                buttons: []
            });
            $('#example2 tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search" class="form-control bottom-search"/>');
            });
            // DataTable
            var table = $('#example2').DataTable();
            // Apply the search
            table.columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
            $('#example2 tfoot tr').insertAfter($('#example2 thead tr'));

            $("#location_id").change(function () {
                var location_id = $(this).val();
                //$("#data_table_body").empty();
                var dataString = 'location_id=' + location_id;
                $.ajax
                ({
                    type: "POST",
                    dataType: 'json',
                    url: "/subscribers/getsubscribersbylocationandaccountant",
                    data: dataString,
                    cache: false,
                    success: function (objects) {
                        if ($.fn.DataTable.isDataTable('#example2')) {
                            $('#example2').DataTable().destroy();
                        }
                        if (objects.length === 0) {
                            $("#data_table_body").empty();
                            $("#data_table_body").append('<tr>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>'
                            );
                        } else {
                            $("#data_table_body").empty();
                            //add_to_item_table(objects);
                            $.each(objects, function (key, value) {
                                var package = value.package_name;
                                var options = '<a class="btn btn-primary" href="/accounts/payments/add/' + value.id + '">Payment</a> ';
                                if (value.due_amount != 0) {
                                    $("#data_table_body").append('<tr class="even pointer">' +
                                        '<td>' + eval(key + 1) + '</td>' +
                                        '<td><img class="img-40" src="/images/subscribers/' + value.photo + '"</td>' +
                                        '<td>' + value.name + '</td>' +
                                        '<td>' + value.registration_no + '</td>' +
                                        '<td>' + value.phone + '</td>' +
                                        '<td>' + package + '</td>' +
                                        '<td>' + value.previous_due_amount + '</td>' +
                                        '<td>' + value.current_due_amount + '</td>' +
                                        '<td>' + value.due_amount + '</td>' +
                                        '<td>' + value.location_name + '</td>' +
                                        '<td>' + value.location_serial_no + '</td>' +
                                        '<td>' + options + '</td>' +
                                        '</td>' +
                                        '</tr>'
                                    );
                                }
                            })

                        }
                    }
                })
            });

        });
        $(document).ajaxComplete(function () {
            $('#example2').DataTable({

                "pagingType": "full_numbers",

                "dom": 'tB<"right"rpl>',

                "ordering": false,

                buttons: []
            });
            $('#example2 tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search" class="form-control bottom-search"/>');
            });
            // DataTable
            var table = $('#example2').DataTable();
            // Apply the search
            table.columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
            $('#example2 tfoot tr').insertAfter($('#example2 thead tr'));
        });
    </script>

<?php require APPROOT . '/views/layouts/footer.php' ?>