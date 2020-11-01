<?php require APPROOT . '/views/layouts/header.php' ?>
    <!--Mobile header with Nav bar and notification bar-->
<?php require APPROOT . '/views/layouts/mobile_header.php' ?>
    <!--Menu Sidebar with nav bar-->
<?php require APPROOT . '/views/layouts/menu_sidebar.php' ?>
    <!--Desktop header with nav bar and header file-->
<?php require APPROOT . '/views/layouts/desktop_header.php' ?>

    <style>
        .col-lg-6, .col-md-6, .col-sm-6 {
            margin: auto;
        }

        .input-group textarea {
            border-radius: 5px;
        }
    </style>

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="drop-shadow x_panel au-card au-card au-card--no-pad m-b-40">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="card-body">
                                        <div class="card-header card-header-primary">
                                            <h4 class="card-title"><i class="fa fa-pencil-alt"></i>Add Internet Packages</h4>
                                        </div>
                                        <form action="<?php URLROOT ?>/Packages/add" enctype="multipart/form-data"
                                              method="post" id="register-form">
                                            <div class="form-group">
                                                <div class="input-group-addon2">Name</div>
                                                <div class="input-group">
                                                    <input type="text" name="name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group-addon2">Cost</div>
                                                <div class="input-group">
                                                    <input type="text" name="cost" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group-addon2">Speed</div>
                                                <div class="input-group">
                                                    <input type="text" name="speed" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group-addon2">Notes</div>
                                                <div class="input-group">
                                                    <textarea name="notes" class="form-control" id="notes"
                                                              rows="3"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-actions form-group">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Add
                                                    Package
                                                </button>
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
                        },
                        cost: {
                            required: true,
                            number:true
                        },
                        speed: {
                            required: true,
                            number:true
                        },

                    },
                    messages: {
                        name: {
                            required: 'Please enter Internet Package name',
                            rangelength: 'Name must have 6-30 characters',
                        },
                        cost: {
                            required: 'Please enter Internet Package cost',
                            number: 'Can only be numbers',
                        },
                        speed: {
                            required: 'Please enter Internet Package speed',
                            number: 'Can only be numbers',
                        },
                    }
                });

            });
        });
    </script>
<?php require APPROOT . '/views/layouts/footer.php' ?>