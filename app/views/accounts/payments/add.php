<!--Page header and All CSS Files-->
<?php require APPROOT . '/views/layouts/header.php' ?>
<!--Mobile header with Navbar and notification bar-->
<?php require APPROOT . '/views/layouts/mobile_header.php' ?>
<!--Menu Sidebar with navbar-->
<?php require APPROOT . '/views/layouts/menu_sidebar.php' ?>
<!--Desktop header with navbar and header file-->
<?php require APPROOT . '/views/layouts/desktop_header.php' ?>

<style>
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
                <div class="col-lg-6" style="margin: auto">
                    <div class="drop-shadow x_panel au-card au-card au-card--no-pad m-b-40">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="card-body">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title"><i class="fa fa-pencil-alt"></i>Make Payment</h4>
                                    </div>
                                    <form action="<?php URLROOT; ?>/accounts/payments/add" method="post"
                                          id="register-form">
                                        <div class="form-group">
                                            <div class="input-group-addon2">Subscriber ID</div>
                                            <div class="input-group">
                                                <input type="text" id="registration_number" name="registration_number"
                                                       readonly
                                                       class="form-control" placeholder="Enter Subscriber ID..."
                                                       value="<?php echo $data['subscriber']->registration_no; ?>">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Subscriber Name</div>
                                            <div class="input-group">
                                                <input type="text" readonly class="form-control" id="subscriber_name"
                                                       name="subscriber_name"
                                                       value="<?php echo $data['subscriber']->name; ?>">
                                                <input type="hidden" id="subscriber_id" name="subscriber_id"
                                                       value="<?php echo $data['subscriber']->id; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Due Amount</div>
                                            <div class="input-group">
                                                <input type="text" id="due_amount" readonly name="due_amount"
                                                       class="form-control"
                                                       value="<?php echo $data['subscriber']->due_amount; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Paid Amount</div>
                                            <div class="input-group">
                                                <input type="text" id="paid_amount" name="paid_amount"
                                                       class="form-control" placeholder="Enter Amount To Be Paid..."
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Discount</div>
                                            <div class="input-group">
                                                <input type="text" id="discount" name="discount" class="form-control"
                                                       value="0" placeholder="Enter Discount..." required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Payment Method</div>
                                            <div class="rs-select2--dark rs-select2--border col-lg-12 col-xs-6">
                                                <select name="payment_method_id" id="payment_method_id"
                                                        class="js-select2">
                                                    <option value="" selected="selected">-Select Payment Method-
                                                    </option>
													<?php foreach ( $data['payment_methods'] as $payment_method ): ?>
                                                        <option value="<?php echo $payment_method->id; ?>">
															<?php echo $payment_method->payment_method_name; ?>
                                                        </option>
													<?php endforeach; ?>
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-group" id="bankDiv">
                                            <div class="input-group-addon2">Bank</div>
                                            <div class="rs-select2--dark rs-select2--border col-lg-12 col-xs-6">
                                                <select name="bank_id" id="bank_id" class="js-select2">
                                                    <option value="" selected="selected">-Select Bank-</option>
													<?php foreach ( $data['banks'] as $bank ): ?>
                                                        <option value="<?php echo $bank->id; ?>">
															<?php echo $bank->bank_name; ?>
                                                        </option>
													<?php endforeach; ?>
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Date</div>
                                            <div class="input-group">
                                                <input type="text" id="date" name="date" readonly class="form-control"
                                                       value="<?php echo date( 'Y-m-d' ); ?>">
                                            </div>
                                        </div>
                                        <div class="form-actions form-group">
                                            <input type="button" value="Make Payment"
                                                   class="btn btn-primary makePaymentButton">
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
        $('input.makePaymentButton').click(function () {
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

        bankDiv.style.visibility = 'hidden';
        bankDiv.style.display = 'none';
        //$('#payment_method_id').attr('disabled', true);

        /*$("#registration_number").keyup(function () {
            var registration_number = $('#registration_number').val();
            var dataString = {
                registration_number: registration_number
            };
            $("#subscriber_name").val("");
            $("#subscriber_id").val("");
            $("#due_amount").val("");
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/accounts/payments/getdueamount",
                data: dataString,
                cache: false,
                success: function (object) {
                    if (object == null) {
                        $("#subscriber_name").val("N/A");
                        $("#subscriber_id").val("");
                        $("#due_amount").val("N/A");
                        $('#payment_method_id option[selected]').prop('selected', true);
                        $('#payment_method_id').attr('disabled', true);
                    } else {
                        $("#subscriber_name").val(object.name);
                        $("#subscriber_id").val(object.id);
                        $("#due_amount").val(object.due_amount);
                        $('#payment_method_id').attr('disabled', false);
                    }
                    bankDiv.style.visibility = 'hidden';
                    bankDiv.style.display = 'none';
                }
            });
        });*/

        $("#payment_method_id").change(function () {
            var payment_method = document.getElementById('payment_method_id');
            var payment_method_name = payment_method.options[payment_method.selectedIndex].innerHTML;
            if (payment_method_name.trim().toLowerCase() == "bank") {
                bankDiv.style.visibility = 'visible';
                bankDiv.style.display = 'block';
            } else {
                bankDiv.style.visibility = 'hidden';
                bankDiv.style.display = 'none';
            }
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
                        required: true
                    },
                    paid_amount: {
                        required: true,
                        pattern: /^[0-9]+(?:\.[0-9]{1,5})?$/
                    },
                    discount: {
                        required: true,
                        pattern: /^[0-9]+(?:\.[0-9]{1,5})?$/
                    },
                    payment_method_id: {
                        required: true
                    },
                    bank_id: {
                        required: true
                    }
                },
                messages: {
                    registration_number: {
                        required: 'Please enter registration number'
                    },
                    paid_amount: {
                        required: 'Please enter amount to be paid',
                        pattern: 'Please enter a valid amount'
                    },
                    discount: {
                        required: 'Please enter a discount',
                        pattern: 'Please enter a valid discount'
                    },
                    payment_method_id: {
                        required: 'Please select a payment method'
                    },
                    bank_id: {
                        required: 'Please select a bank'
                    }
                }
            });
        });
        // Validation Code Ends Here....
    });
</script>

<!--Footer ,Load every JS libarary-->
<?php require APPROOT . '/views/layouts/footer.php' ?>