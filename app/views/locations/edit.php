<?php require APPROOT . '/views/layouts/header.php' ?>
    <!--Mobile header with Nav bar and notification bar-->
<?php require APPROOT . '/views/layouts/mobile_header.php' ?>
    <!--Menu Sidebar with nav bar-->
<?php require APPROOT . '/views/layouts/menu_sidebar.php' ?>
    <!--Desktop header with nav bar and header file-->
<?php require APPROOT . '/views/layouts/desktop_header.php' ?>

    <style>
        .col-lg-6 {
            margin: auto;
        }

        textarea.form-control {
            border-radius: 5px;
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
                    <div class="col-lg-6">
                        <div class="x_panel au-card au-card au-card--no-pad m-b-40">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="card-body">
                                        <div class="card-header card-header-primary">
                                            <h4 class="card-title"><i class="fa fa-pencil-alt"></i>Edit Location</h4>
                                        </div>
                                        <form action="<?php URLROOT ?>/Locations/edit" enctype="multipart/form-data"
                                              method="post" id="register-form">
                                            <input type="hidden" name="id" value="<?php echo $data['location']->id ?>">
                                            <div class="form-group">
                                                <div class="input-group-addon2">Name</div>
                                                <div class="input-group">
                                                    <input type="text" name="name"
                                                           value="<?php echo $data['location']->name ?>"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group-addon2">Name</div>
                                                <div class="rs-select2--dark rs-select2--border col-lg-12 col-xs-6">
                                                    <select name="accountant_id" id="accountant_id"
                                                            class="js-select2">
														<?php foreach ( $data['accountants'] as $accountant ): ?>
															<?php if ( $accountant->id == $data['location']->accountant_id ): ?>
                                                                <option selected
                                                                        value="<?php echo $accountant->id; ?>"><?php echo $accountant->accountant_name; ?></option>
															<?php else: ?>
                                                                <option value="<?php echo $accountant->id; ?>"><?php echo $accountant->accountant_name; ?></option>
															<?php endif; ?>
														<?php endforeach; ?>
                                                    </select>
                                                    <div class="dropDownSelect2"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group-addon2">Notes</div>
                                                <div class="input-group">
                                                <textarea name="notes" class="form-control"
                                                          id="exampleFormControlTextarea3"
                                                          rows="3"><?php echo $data['location']->notes
	                                                ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-actions form-group">
                                                <button type="submit" class="btn btn-primary">Confirm</button>
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
                        }
                        else if (element.className = 'js-select2') {
                            error.insertAfter(element.parent());
                        }
                        else {
                            error.insertAfter(element);
                        }
                    }
                });
                $("#register-form").validate({
                    rules: {
                        name: {
                            required: true,
                            rangelength: [6, 24]
                        }
                    },
                    messages: {
                        name: {
                            required: 'Please enter area name',
                            rangelength: 'Name must have 6-30 characters',
                        },
                    }
                });

            });
        });
    </script>

<?php require APPROOT . '/views/layouts/footer.php' ?>