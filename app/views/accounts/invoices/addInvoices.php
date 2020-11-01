<!--Page header and All CSS Files-->
<?php require APPROOT . '/views/layouts/header.php' ?>
<!--Mobile header with Navbar and notification bar-->
<?php require APPROOT . '/views/layouts/mobile_header.php' ?>
<!--Menu Sidebar with navbar-->
<?php require APPROOT . '/views/layouts/menu_sidebar.php' ?>
<!--Desktopn header with navbar and header file-->
<?php require APPROOT . '/views/layouts/desktop_header.php' ?>

<style>
    #addAllButton {
        margin: 7px auto 7px auto;
    }

    .even.pointer td {
        padding-left: 4px;
        padding-right: 4px;
    }

    table.jambo_table tbody tr:hover td {
        padding: 4px 4px;
    }
</style>

<form action="<?php URLROOT; ?>/accounts/invoices/addmultipleinvoices" method="post" id="add_invoice_form">
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="x_panel au-card au-card au-card--no-pad m-b-40">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="filters">
                                        <h4>Add Multiple Invoice</h4>
                                        <div class="rs-select2--dark rs-select2--border col-lg-2 col-xs-6">
                                            <select class="form-control js-select2" id="location_id" name="location_id">
                                                <option value="" selected="selected">-Select Area-</option>
                                                <?php foreach ($data['locations'] as $location): ?>
                                                    <option value="<?php echo $location->id; ?>">
                                                        <?php echo $location->location_name; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--dark rs-select2--border col-lg-2 col-xs-6">
                                            <select class="form-control js-select2" name="year" id="year">
                                                <option value="" selected="selected">-Select Year-</option>
                                                <?php
                                                for ($i = date('Y'); $i >= 1950; $i--) {
                                                    echo "<option value='$i'>$i</option>";
                                                }
                                                ?>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--dark rs-select2--border col-lg-2 col-xs-6">
                                            <select class="form-control js-select2" name="month" id="month">
                                                <option value="" selected="selected">-Select Month-</option>
                                                <?php
                                                for ($i = 1; $i <= 12; ++$i) {
                                                    $month_name = date('F', mktime(0, 0, 0, $i, 1));
                                                    echo "<option value='$month_name'>$month_name</option>";
                                                }
                                                ?>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                    <div class="x_content">
                                        <div class="table-responsive">
                                            <table id="example2" class="table table-striped jambo_table bulk_action">
                                                <thead>
                                                <tr class="headings">
                                                    <th class="column-title">S/N</th>
                                                    <th class="column-title">Name</th>
                                                    <th class="column-title">Subscriber ID</th>
                                                    <th class="column-title">Package Name</th>
                                                    <th class="column-title">Package Cost</th>
                                                    <th class="column-title">Discount</th>
                                                    <th class="column-title">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="data_table_body">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <center>
                                <div class="form-actions form-group">
                                    <button id="addAllButton" type="submit" class="btn btn-primary">Add All
                                    </button>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('#addAllButton').attr('hidden', true);
        $("#data_table_body").empty();
        $("#data_table_body").append('<tr class="alert-danger"><td colspan="7">Please Select a Month, Year and Area</td></tr>');
        $('#year').attr('disabled', true);
        $('#location_id').attr('disabled', true);
        $("#month").change(function () {
            var month = $(this).val();
            if (month == "") {
                $('#year').attr('disabled', true);
                $("#data_table_body").empty();
                $("#data_table_body").append('<tr class="alert-danger"><td colspan="7">Please Select a Month, Year and Area</td></tr>');
            } else {
                $('#year').attr('disabled', false);
                $("#data_table_body").empty();
                $("#data_table_body").append('<tr class="alert-danger"><td colspan="7">Please Select a Year and Area</td></tr>');
            }
            $('#year option[selected]').prop('selected', true);
            $('#location_id option[selected]').prop('selected', true);
            $('#location_id').attr('disabled', true);
            $('#addAllButton').attr('hidden', true);
        });
        $("#year").change(function () {
            var year = $(this).val();
            if (year == "") {
                $('#location_id option[selected]').prop('selected', true);
                $('#location_id').attr('disabled', true);
                $("#data_table_body").empty();
                $("#data_table_body").append('<tr class="alert-danger"><td colspan="7">Please Select a Year and Area</td></tr>');
            } else {
                $('#location_id').attr('disabled', false);
                $("#data_table_body").empty();
                $("#data_table_body").append('<tr class="alert-danger"><td colspan="7">Please Select an Area</td></tr>');
            }
            $('#addAllButton').attr('hidden', true);
        });
        $("#location_id").change(function () {
            var location_id = $(this).val();
            if (location_id == "") {
                $("#data_table_body").empty();
                $("#data_table_body").append('<tr class="alert-danger"><td colspan="7">Please Select an Area</td></tr>');
                $('#addAllButton').attr('hidden', true);
            } else {
                var month = $('#month').val();
                var year = $('#year').val();
                $("#data_table_body").empty();
                var dataString = {
                    location_id: location_id,
                    month: month,
                    year: year
                };

                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "/accounts/invoices/getsubscriberbylocation",
                    data: dataString,
                    cache: false,
                    success: function (objects) {
                        if (objects == null) {
                            $("#data_table_body").empty();
                            $("#data_table_body").append('No Subscriber Found In This Location');
                        } else {
                            $("#data_table_body").empty();
                            //Add Item to Data Table
                            $.each(objects, function (key, value) {
                                if (value.flag == true) {
                                    $("#data_table_body").append(
                                        '<tr class="even pointer">' +
                                        '<td>' + eval(key + 1) + '</td>' +
                                        '<td><input type="text" class="form-control" readonly value="' + value.name + '"></td>' +
                                        '<td><input type="text" class="form-control" readonly value="' + value.registration_no + '"><input type="hidden" class="subscriber_id" name="subscriber_id[]" value="' + value.id + '"></td>' +
                                        '<td><input type="text" class="form-control" readonly value="' + value.package_name + '"></td>' +
                                        '<td><input type="text" class="form-control amount" name="amount[]" readonly value="' + value.package_cost + '"></td>' +
                                        '<td><input type="number" class="form-control discount" name="discount[]" readonly value="' + value.discount + '"></td>' +
                                        '<td><input type="button" disabled class="btn btn-primary btn-sm" value="Added"></td>' +
                                        '</tr>'
                                    );
                                } else {
                                    $("#data_table_body").append(
                                        '<tr class="even pointer">' +
                                        '<td>' + eval(key + 1) + '</td>' +
                                        '<td><input type="text" class="form-control" readonly value="' + value.name + '"></td>' +
                                        '<td><input type="text" class="form-control" readonly value="' + value.registration_no + '"><input type="hidden" class="subscriber_id" name="subscriber_id[]" value="' + value.id + '"></td>' +
                                        '<td><input type="text" class="form-control" readonly value="' + value.package_name + '"></td>' +
                                        '<td><input type="number" step="any" class="form-control amount" readonly name="amount[]" value="' + value.package_cost + '"></td>' +
                                        '<td><input type="number" class="form-control discount" name="discount[]" value="0"></td>' +
                                        '<td><input type="button"  class="btn btn-primary btn-sm add_invoice_btn" name="add_invoice_btn[]" value="Add"></td>' +
                                        '</tr>'
                                    );
                                }
                                $(".add_invoice_btn").click(function () {
                                    var subscriber_id = $(this).closest("tr").find(".subscriber_id").val();
                                    var amount = $(this).closest("tr").find(".amount").val();
                                    var discount = $(this).closest("tr").find(".discount").val();
                                    var newDataString = {
                                        subscriber_id: subscriber_id,
                                        amount: amount,
                                        discount: discount,
                                        month: month,
                                        year: year
                                    };
                                    $.ajax({
                                        type: "POST",
                                        dataType: 'json',
                                        url: "/accounts/invoices/addsingleinvoice",
                                        data: newDataString,
                                        cache: false,
                                        success: function (data) {
                                            if (data == true) {
                                                $.notify({
                                                    title: '<strong>Confirmation!</strong>',
                                                    icon: 'fas fa-comment-alt',
                                                    url: 'https://www.emanagementsys.com/',
                                                    target: '_blank',
                                                    message: "Successfully Added!"
                                                }, {
                                                    type: 'success',
                                                    animate: {
                                                        enter: 'animated lightSpeedIn',
                                                        exit: 'animated lightSpeedOut'
                                                    },
                                                    placement: {
                                                        from: "top",
                                                        align: "right"
                                                    },
                                                    offset: {
                                                        x: 50,
                                                        y: 100
                                                    },
                                                    spacing: 10,
                                                    z_index: 1031,
                                                    delay: 3000,
                                                });
                                            } else {
                                                $.notify({
                                                    title: '<strong>Confirmation!</strong>',
                                                    icon: 'fas fa-comment-alt',
                                                    url: 'https://www.emanagementsys.com/',
                                                    target: '_blank',
                                                    message: "Failed!"
                                                }, {
                                                    type: 'danger',
                                                    animate: {
                                                        enter: 'animated lightSpeedIn',
                                                        exit: 'animated lightSpeedOut'
                                                    },
                                                    placement: {
                                                        from: "top",
                                                        align: "right"
                                                    },
                                                    offset: {
                                                        x: 50,
                                                        y: 100
                                                    },
                                                    spacing: 10,
                                                    z_index: 1031,
                                                    delay: 3000,
                                                });
                                            }
                                        }
                                    });
                                    $(this).prop("disabled", true);
                                    $(this).attr('value', 'Added');
                                });
                                $('#addAllButton').attr('hidden', false);
                            });
                        }
                    }
                });
            }
        });
    });
</script>

<!--Footer ,Load every JS libarary-->
<?php require APPROOT . '/views/layouts/footer.php' ?>