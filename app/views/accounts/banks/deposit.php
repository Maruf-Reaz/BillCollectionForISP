<!--Page header and All CSS Files-->
<?php require APPROOT . '/views/layouts/header.php' ?>
<!--Mobile header with Navbar and notification bar-->
<?php require APPROOT . '/views/layouts/mobile_header.php' ?>
<!--Menu Sidebar with navbar-->
<?php require APPROOT . '/views/layouts/menu_sidebar.php' ?>
<!--Desktopn header with navbar and header file-->
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
</style>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row justify-content-lg-center">
                <div class="col-lg-6">
                    <div class="drop-shadow x_panel au-card au-card--no-pad m-b-40">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="card-body">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title"><i class="fa fa-pencil-alt"></i>Transaction</h4>
                                    </div>
                                    <form action="<?php URLROOT; ?>/accounts/banks/deposit" method="post"
                                          class="form-horizontal" id="register-form">
                                        <div class="form-group">
                                            <div class="input-group-addon2">Bank Name</div>
                                            <div class="input-group">
                                                <input type="text" id="bank_name" name="bank_name" readonly
                                                       class="form-control" required
                                                       value="<?php echo $data['bank']->bank_name; ?>">
                                                <input type="hidden" id="bank_id" name="bank_id"
                                                       value="<?php echo $data['bank']->id; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Amount</div>
                                            <div class="input-group">
                                                <input type="text" id="amount" name="amount"
                                                       placeholder="Enter Amount..." class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Note</div>
                                            <div class="input-group">
                                                <input type="text" id="note" name="note" placeholder="Enter a Note..."
                                                       class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-actions form-group">
                                            <input type="button" value="Deposit"
                                                   class="btn btn-primary depositButton">
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
        $('input.depositButton').click(function () {
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
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
            $("#register-form").validate({
                rules: {
                    amount: {
                        required: true,
                        pattern: /^[0-9]+(?:\.[0-9]{1,5})?$/
                    },
                    bank_id: {
                        required: true
                    },
                    note: {
                        required: true
                    }
                },
                messages: {
                    amount: {
                        required: 'Please enter amount to be deposited',
                        pattern: 'Please enter a valid amount'
                    },
                    bank_id: {
                        required: 'Please select a bank'
                    },
                    note: {
                        required: 'Please enter purpose of transaction'
                    }
                }
            });
        });
        // Validation Code Ends Here....
    });
</script>

<!--Footer ,Load every JS libarary-->
<?php require APPROOT . '/views/layouts/footer.php' ?>