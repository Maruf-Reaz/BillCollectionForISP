<!--Page header and All CSS Files-->
<?php require APPROOT . '/views/layouts/header.php' ?>
<!--Mobile header with Navbar and notification bar-->
<?php require APPROOT . '/views/layouts/mobile_header.php' ?>
<!--Menu Sidebar with navbar-->
<?php require APPROOT . '/views/layouts/menu_sidebar.php' ?>
<!--Desktopn header with navbar and header file-->
<?php require APPROOT . '/views/layouts/desktop_header.php' ?>

<style>
    .x_content .table-responsive table.table thead tr.headings th.column-title {
        border-right: 1px solid #dee2e6;
    }

    .x_content .table-responsive table.table tbody tr td {
        border-right: 1px solid #dee2e6;
    }

    .x_content .table-responsive table.table thead tr {
        border-bottom: 1px solid #dee2e6;
    }

    .x_content .table-responsive table.table thead tr th {
        border-right: 1px solid #dee2e6;
    }

    th.second-thead {
        font-weight: 400;
        padding: 8px 0 !important;
    }

    tr.second-tr {
        background: #FFFFFF;
        color: #666;
        font-weight: 400;
    }

    /*th.column-title {
        padding: 8px 0!important;
    }*/
</style>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="x_panel au-card au-card au-card--no-pad m-b-40">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="filters">
                            <h4>Monthly Income Report</h4>
                            <div class="rs-select2--dark rs-select2--border col-lg-2 col-xs-6">
                                <select class="js-select2" name="year" id="year">
                                    <option value="" selected="selected">-Select Year-</option>
									<?php
									for ( $i = date( 'Y' ); $i >= 1950; $i -- ) {
										echo "<option value='$i'>$i</option>";
									}
									?>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <div class="rs-select2--dark rs-select2--border col-lg-2 col-xs-6">
                                <select class="js-select2" name="month" id="month">
                                    <option value="" selected="selected">-Select Month-</option>
									<?php
									for ( $i = 1; $i <= 12; ++ $i ) {
										$month_name = date( 'F', mktime( 0, 0, 0, $i, 1 ) );
										echo "<option value='$month_name'>$month_name</option>";
									}
									?>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        </div>
                        <div class="x_content p-40-b">
                            <div class="table-responsive">
                                <table id="example2" class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">
                                        <th colspan="7" class="column-title" id="table_title">Report</th>
                                    </tr>
                                    <tr class="headings second-tr">
                                        <th class="column-title second-thead" colspan="6">Accountant Receivable</th>
                                        <th class="column-title second-thead" id="total_invoice">N/A</th>
                                    </tr>
                                    <tr class="headings">
                                        <th class="column-title">S/N
                                        </th>
                                        <th class="column-title">Accountant Name
                                        </th>
                                        <th class="column-title">Invoice Amount
                                        </th>
                                        <th style="padding: 8px 0; vertical-align: middle; background-color: #85CE36"
                                            class="column-title">Received Amount
                                        </th>
                                        <th class="column-title">Discount
                                        </th>
                                        <th class="column-title">Remaining Amount
                                        </th>
                                        <th class="column-title">Total Outstanding
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody id="data_table_body">

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

<script>
    $(document).ready(function () {
        if ($.fn.DataTable.isDataTable('#example2')) {
            $('#example2').DataTable().destroy();
        }
        $("#data_table_body").empty();
        $("#data_table_body").append('<tr class="alert-danger"><td colspan="7">Please Select a Month and Year</td></tr>');
        $('#year').attr('disabled', true);
        $("#month").change(function () {
            var month = $(this).val();
            if (month == "") {
                $('#year').attr('disabled', true);
                document.getElementById("table_title").innerHTML = "Report";
                $("#data_table_body").empty();
                $("#data_table_body").append('<tr class="alert-danger"><td colspan="7">Please Select a Month, and Year</td></tr>');
            } else {
                $('#year').attr('disabled', false);
                document.getElementById("table_title").innerHTML = "Report of" + " " + month;
                $("#data_table_body").empty();
                $("#data_table_body").append('<tr class="alert-danger"><td colspan="7">Please Select a Year</td></tr>');
            }
            $("#total_invoice").empty();
            $("#total_invoice").append('N/A');
            $('#year option[selected]').prop('selected', true);
        });
        $("#year").change(function () {
            var year = $(this).val();
            if (year == "") {
                $("#data_table_body").empty();
                $("#data_table_body").append('<tr class="alert-danger"><td colspan="7">Please Select a Year</td></tr>');
                $("#total_invoice").empty();
                $("#total_invoice").append('N/A');
            } else {
                var month = $('#month').val();
                document.getElementById("table_title").innerHTML = "Report of" + " " + month + " " + year;
                $("#data_table_body").empty();
                var dataString = {
                    month: month,
                    year: year
                };
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "/accounts/reports/getmonthwiseinvoice",
                    data: dataString,
                    cache: false,
                    success: function (object) {
                        if ($.fn.DataTable.isDataTable('#example2')) {
                            $('#example2').DataTable().destroy();
                        }
                        if (object == null) {
                            $("#total_invoice").empty();
                            $("#total_invoice").append('N/A');
                        } else {
                            $("#total_invoice").empty();
                            $("#total_invoice").append(object);
                        }
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "/accounts/reports/getaccountantwisedetails",
                    data: dataString,
                    cache: false,
                    success: function (objects) {
                        if ($.fn.DataTable.isDataTable('#example2')) {
                            $('#example2').DataTable().destroy();
                        }
                        if (objects == null) {
                            $("#data_table_body").empty();
                            $("#data_table_body").append('<tr class="alert-danger"><td colspan="7">No Data Found For This Month</td></tr>');
                        } else {
                            $("#data_table_body").empty();
                            //Add Item to Data Table
                            var total_invoice_amount = 0;
                            var total_received_amount = 0;
                            var total_discount = 0;
                            var total_remaining_amount = 0;
                            $.each(objects, function (key, value) {
                                total_invoice_amount += eval(value.invoice_amount);
                                total_received_amount += eval(value.received_amount);
                                total_discount += eval(value.discount);
                                total_remaining_amount += eval(value.remaining_amount);
                                $("#data_table_body").append(
                                    '<tr class="even pointer">' +
                                    '<td>' + eval(key + 1) + '</td>' +
                                    '<td>' + value.accountant_name + '</td>' +
                                    '<td>' + value.invoice_amount + '</td>' +
                                    '<td>' + value.received_amount + '</td>' +
                                    '<td>' + value.discount + '</td>' +
                                    '<td>' + value.remaining_amount + '</td>' +
                                    '<td>' + value.remaining_amount_after_payments + '</td>' +
                                    '</tr>'
                                );
                            });
                            $("#data_table_body").append(
                                '<tr class="even pointer">' +
                                '<td></td>' +
                                '<td>Total</td>' +
                                '<td>' + total_invoice_amount + '</td>' +
                                '<td>' + total_received_amount + '</td>' +
                                '<td>' + total_discount + '</td>' +
                                '<td>' + total_remaining_amount + '</td>' +
                                '<td>Total Outstanding</td>' +
                                '</tr>'
                            );
                        }
                    }
                });
            }
        });
    });
</script>

<!--Footer ,Load every JS libarary-->
<?php require APPROOT . '/views/layouts/footer.php' ?>