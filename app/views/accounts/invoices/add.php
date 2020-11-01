<!--Page header and All CSS Files-->
<?php require APPROOT . '/views/layouts/header.php' ?>
<!--Mobile header with Navbar and notification bar-->
<?php require APPROOT . '/views/layouts/mobile_header.php' ?>
<!--Menu Sidebar with navbar-->
<?php require APPROOT . '/views/layouts/menu_sidebar.php' ?>
<!--Desktopn header with navbar and header file-->
<?php require APPROOT . '/views/layouts/desktop_header.php' ?>

<style>
    .col-lg-7,
    .col-md-7,
    .col-sm-7 {
        margin: auto;
    }

    .input-group textarea {
        border-radius: 5px;
    }

    .form-group.col-md-6 {
        padding-right: 15px;
        padding-left: 15px;
    }

    .form-group.col-md-12 {
        padding-right: 15px;
        padding-left: 15px;
    }

    .alert-success span strong {
        text-transform: capitalize;
    }

    .jconfirm-buttons {
        background: orange;
    }

    .jconfirm-buttons .btn-default {
        background: #fff;
        color: black;
    }

    button.btn-default {
        background: #fff !important;
        color: black !important;
    }

    div.jconfirm-closeIcon {
        color: orange !important;
    }

    .select2-selection {
        width: 100% !important;
    }

    .select2-container--default {
        width: 100% !important;
    }
</style>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="drop-shadow x_panel au-card au-card au-card--no-pad m-b-40">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="card-body">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title"><i class="fa fa-pencil-alt"></i>Add Single Invoice</h4>
                                    </div>
                                    <form action="<?php URLROOT; ?>/accounts/invoices/add" method="post"
                                          id="register-form">
                                        <div class="form-group">
                                            <div class="input-group-addon2">Month</div>
                                            <div class="rs-select2--dark rs-select2--border col-lg-12 col-xs-6">
                                                <select name="month" id="month" class="js-select2">
                                                    <option value="" selected="selected">-Select Month-</option>
													<?php
													for ( $i = 1; $i <= 12; ++ $i ) {
														$month_name = trim( date( 'F', mktime( 0, 0, 0, $i, 1 ) ) );
														echo "<option value='$month_name'>$month_name</option>";
													}
													?>
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Year</div>
                                            <div class="rs-select2--dark rs-select2--border col-lg-12 col-xs-6">
                                                <select name="year" id="year" class="js-select2">
                                                    <option value="" selected="selected">-Select Year-</option>
													<?php
													for ( $i = date( 'Y' ); $i >= 1950; $i -- ) {
														echo "<option value='$i'>$i</option>";
													}
													?>
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Subscriber ID</div>
                                            <div class="input-group">
                                                <input type="text" id="registration_number" name="registration_number"
                                                       class="form-control" placeholder="Enter Subscriber ID">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Subscriber Name</div>
                                            <div class="input-group">
                                                <input type="text" id="subscriber_name" name="subscriber_name" readonly
                                                       class="form-control">
                                                <input type="hidden" id="subscriber_id" name="subscriber_id">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Location</div>
                                            <div class="input-group">
                                                <input type="text" id="location_name" name="location_name" readonly
                                                       class="form-control">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Package Name</div>
                                            <div class="input-group">
                                                <input type="text" id="package_name" name="package_name" readonly
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Package Cost</div>
                                            <div class="input-group">
                                                <input type="text" id="package_cost" name="package_cost"
                                                       class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Amount</div>
                                            <div class="input-group">
                                                <input type="text" id="amount" name="amount" class="form-control" placeholder="Enter total amount of invoice">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Discount</div>
                                            <div class="input-group">
                                                <input type="text" id="discount" name="discount" class="form-control"
                                                       placeholder="Enter Discount..." required value="0">
                                            </div>
                                        </div>
                                        <div class="form-actions form-group">
                                            <input type="button" value="Add Invoice"
                                                   class="btn btn-primary addInvoiceButton">
                                        </div>
                                    </form>
                                </div>
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
        $('input.addInvoiceButton').click(function () {
            $.confirm({
                html: true,
                title: '<i class = "fa fa-exclamation-triangle" style="color: orange"></i> Confirmation!',
                content: 'Make sure all the informations are correct. <br> <strong style="font-size: 26px">This cannot be changed.</strong>',
                backgroundDismiss: true,
                typeAnimated: true,
                theme: 'bootstrap',
                smoothContent: true,
                closeIcon: true,
                type: 'danger',
                buttons: {
                    confirm: function () {
                        $("#register-form").submit();
                    },
                    cancel: function () {
                    }
                }
            });
        });
        $('#year').attr('disabled', true);
        $('#registration_number').attr('disabled', true);
        $("#month").change(function () {
            var month = $(this).val();
            if (month == "") {
                $('#year').attr('disabled', true);
            } else {
                $('#year').attr('disabled', false);
            }
            $('#year option[selected]').prop('selected', true);
            $("#registration_number").val("");
            $('#registration_number').attr('disabled', true);
            $("#subscriber_name").val("");
            $("#subscriber_id").val("");
            $("#location_name").val("");
            $("#package_name").val("");
            $("#package_cost").val("");
        });
        $("#year").change(function () {
            var year = $(this).val();
            if (year == "") {
                $('#registration_number').attr('disabled', true);
            } else {
                $('#registration_number').attr('disabled', false);
            }
            $("#registration_number").val("");
            $("#subscriber_name").val("");
            $("#subscriber_id").val("");
            $("#location_name").val("");
            $("#package_name").val("");
            $("#package_cost").val("");
        });
        $("#registration_number").keyup(function () {
            var registration_number = $('#registration_number').val();
            var dataString = {
                registration_number: registration_number
            };
            $("#subscriber_name").val("");
            $("#subscriber_id").val("");
            $("#location_name").val("");
            $("#package_name").val("");
            $("#package_cost").val("");
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/accounts/invoices/getsubscriberbyregistrationnumber",
                data: dataString,
                cache: false,
                success: function (object) {
                    if (object == null) {
                        $("#subscriber_name").val("");
                        $("#subscriber_id").val("");
                        $("#location_name").val("");
                        $("#package_name").val("");
                        $("#package_cost").val("");
                    } else {
                        $("#subscriber_name").val(object.name);
                        $("#subscriber_id").val(object.id);
                        $("#location_name").val(object.location_name);
                        $("#package_name").val(object.package_name);
                        $("#package_cost").val(object.package_cost);
                        var month = $("#month :selected").text();
                        var year = $("#year :selected").text();
                        var newDataString = {
                            registration_number: registration_number,
                            month: month,
                            year: year
                        };
                        $.ajax({
                            type: "POST",
                            dataType: 'json',
                            url: "/accounts/invoices/doesinvoiceexist",
                            data: newDataString,
                            cache: false,
                            success: function (data) {
                                if (data == true) {
                                    alert("Invoice of" + " " + month + " " + year + " " + "for" + " " + registration_number + " " + "is already added");
                                    $('.addInvoiceButton').attr('disabled', true);
                                } else {
                                    $('.addInvoiceButton').attr('disabled', false);
                                }
                            }
                        });
                    }
                }
            });
        });

        //Validation Code Starts.....
        $(function () {
            $.validator.setDefaults({
                errorClass: 'help-block',
                highlight: function (element) {
                    $(element)
                        .closest('.form-group')
                        .addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element)
                        .closest('.form-group')
                        .removeClass('has-error');
                },
                errorPlacement: function (error, element) {
                    if (element.prop('type') === 'checkbox') {
                        error.insertAfter(element.parent());
                    } else if (element.className = 'js-select2') {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
            $("#register-form").validate({
                rules: {
                    registration_number: {
                        required: true,
                        remote: '/accounts/invoices/doessubscriberexist'
                    },
                    amount: {
                        required: true,
                        pattern: /^[0-9]+(?:\.[0-9]{1,5})?$/
                    },
                    discount: {
                        required: true,
                        pattern: /^[0-9]+(?:\.[0-9]{1,5})?$/
                    },
                    month: {
                        required: true
                    },
                    year: {
                        required: true
                    }
                },
                messages: {
                    registration_number: {
                        required: 'Please enter Subscriber ID'
                    },
                    amount: {
                        required: 'Please enter an amount',
                        pattern: 'Please enter a valid amount'
                    },
                    discount: {
                        required: 'Please enter a discount',
                        pattern: 'Please enter a valid discount'
                    },
                    month: {
                        required: 'Please select a payment month'
                    },
                    year: {
                        required: 'Please select a year'
                    }
                }
            });
        });
        // Validation Code Ends Here....
    });
</script>

<!--Footer ,Load every JS libarary-->
<?php require APPROOT . '/views/layouts/footer.php' ?>