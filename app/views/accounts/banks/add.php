<!--Page header and All CSS Files-->
<?php require APPROOT . '/views/layouts/header.php' ?>
<!--Mobile header with Navbar and notification bar-->
<?php require APPROOT . '/views/layouts/mobile_header.php' ?>
<!--Menu Sidebar with navbar-->
<?php require APPROOT . '/views/layouts/menu_sidebar.php' ?>
<!--Desktopn header with navbar and header file-->
<?php require APPROOT . '/views/layouts/desktop_header.php' ?>
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
                                        <h4 class="card-title"><i class="fa fa-pencil-alt"></i>Add Bank</h4>
                                    </div>
                                    <form action="<?php URLROOT; ?>/accounts/banks/add" method="post"
                                          class="form-horizontal" id="register-form">
                                        <div class="form-group">
                                            <div class="input-group-addon2">Name</div>
                                            <div class="input-group">
                                                <input type="text" id="bank_name" name="bank_name"
                                                       placeholder="Enter Name of Bank..." class="form-control"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Account Number</div>
                                            <div class="input-group">
                                                <input type="text" id="account_number" name="account_number"
                                                       placeholder="Enter Account Number..." class="form-control"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Joining Date</div>
                                            <div class="input-group">
                                                <input type="text" id="opening_date" name="opening_date" class="form-control datepicker" readonly
                                                       required placeholder="Enter Opening Date">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Note</div>
                                            <div class="input-group">
                                                <input type="text" id="note" name="note" placeholder="Enter A Note..."
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-actions form-group">
                                            <button type="submit" class="btn btn-primary">Add Bank</button>
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
        $('.datepicker').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'yyyy-mm-dd'
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
                    bank_name: {
                        required: true,
                        minlength: 6
                    },
                    account_number: {
                        required: true
                    },
                    opening_date: {
                        required: true
                    }
                },
                messages: {
                    bank_name: {
                        required: 'Please enter Bank Name',
                        minlength: 'Bank name must have minimum 6 characters'
                    },
                    account_number: {
                        required: 'Please enter Account Number'
                    },
                    opening_date: {
                        required: 'Please enter Opening Date'
                    }
                }
            });
        });
        // Validation Code Ends Here....
    });
</script>

<!--Footer ,Load every JS libarary-->
<?php require APPROOT . '/views/layouts/footer.php' ?>