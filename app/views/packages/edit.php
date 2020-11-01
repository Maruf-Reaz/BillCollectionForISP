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
                                        <h4 class="card-title"><i class="fa fa-pencil-alt"></i>Edit Package</h4>
                                    </div>
                                    <form action="<?php URLROOT ?>/Packages/edit" enctype="multipart/form-data" method="post" id="register-form">
                                        <input type="hidden" name="id" value="<?php echo $data['package']->id?>">
                                        <div class="form-group">
                                            <div class="input-group-addon2">Name</div>
                                            <div class="input-group">
                                                <input type="text" name="name" value="<?php echo $data['package']->name ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Cost</div>
                                            <div class="input-group">
                                                <input type="text" name="cost" value="<?php echo $data['package']->cost ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-addon2">Speed</div>
                                            <div class="input-group">
                                                <input type="text" name="speed" value="<?php echo $data['package']->speed ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group-addon2">Notes</div>
                                            <div class="input-group">
                                                <textarea name="notes" class="form-control" id="exampleFormControlTextarea3" rows="3"><?php echo $data['package']->notes
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
    $(document).ready(function() {

        //Validation Code Starts.....
        $(function() {

            $.validator.setDefaults({
                errorClass: 'help-block',
                highlight: function(element) {
                    $(element)
                        .closest('.form-group')
                        .addClass('has-error');
                },
                unhighlight: function(element) {
                    $(element)
                        .closest('.form-group')
                        .removeClass('has-error');
                },
                errorPlacement: function(error, element) {
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
                        number: true
                    },
                    speed: {
                        required: true,
                        number: true
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