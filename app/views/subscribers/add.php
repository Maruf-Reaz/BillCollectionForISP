<?php require APPROOT . '/views/layouts/header.php' ?>
    <!--Mobile header with Nav bar and notification bar-->
<?php require APPROOT . '/views/layouts/mobile_header.php' ?>
    <!--Menu Sidebar with nav bar-->
<?php require APPROOT . '/views/layouts/menu_sidebar.php' ?>
    <!--Desktop header with nav bar and header file-->
<?php require APPROOT . '/views/layouts/desktop_header.php' ?>

    <style>
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

    </style>

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row justify-content-lg-center">
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <div class="drop-shadow x_panel au-card au-card au-card--no-pad m-b-40">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="card-body">
                                        <div class="card-header card-header-primary">
                                            <h4 class="card-title"><i class="fa fa-pencil-alt"></i>Add Subscribers</h4>
                                        </div>
                                        <form action="<?php URLROOT ?>/Subscribers/add" enctype="multipart/form-data"
                                              method="post" id="register-form">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="form-group col-md-6 no-padding-left">
                                                        <div class="input-group-addon2">Name</div>
                                                        <div class="input-group">
                                                            <input type="hidden" id="message"
                                                                   value="<?php echo $data['message'] ?>">
                                                            <input type="hidden" id="type"
                                                                   value="<?php echo $data['type'] ?>">
                                                            <input type="text" name="name" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 no-padding-right">
                                                        <div class="input-group-addon2">NID/Passport</div>
                                                        <div class="input-group">
                                                            <input type="text" id="nid" name="nid" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 no-padding-left-right">
                                                        <div class="input-group-addon2">NID Image</div>
                                                        <div class="input-group">
                                                            <input type="file" name="nid_photo"
                                                                   class="custom-file-input">
                                                            <label class="custom-file-label"
                                                                   for="validatedCustomFile">Select
                                                                Photo</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 no-padding-left">
                                                        <div class="input-group-addon2">Phone Number</div>
                                                        <div class="input-group">
                                                            <input type="text" id="phone" name="phone"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 no-padding-right">
                                                        <div class="input-group-addon2">Email</div>
                                                        <div class="input-group">
                                                            <input type="text" id="email" name="email"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 no-padding-left-right">
                                                        <div class="input-group-addon2">Present Address</div>
                                                        <div class="input-group">
                                                            <textarea name="present_address" class="form-control"
                                                                      id="present_address" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 no-padding-left-right">
                                                        <div class="input-group-addon2">Permanent Address</div>
                                                        <div class="input-group">
                                                            <textarea name="permanent_address" class="form-control"
                                                                      id="permanent_address" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="container no-padding-left-right">
                                                        <div class="row">
                                                            <div class="form-group col-md-6 no-padding-left">
                                                                <div class="input-group-addon2">Package</div>
                                                                <div class="rs-select2--dark rs-select2--border col-md-12 col-xs-12 no-padding-left">
                                                                    <select name="package_id" class="js-select2">
                                                                        <option value="" selected="selected">Select
                                                                        </option>
                                                                        <?php foreach ($data['packages'] as $package): ?>
                                                                            <option value="<?php echo $package->id; ?>">
                                                                                <?php echo $package->name; ?>
                                                                            </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <div class="dropDownSelect2"></div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6 no-padding-right">
                                                                <div class="input-group-addon2">Location</div>
                                                                <div class="rs-select2--dark rs-select2--border col-md-12 col-xs-12 no-padding-right">
                                                                    <select id="location_id" name="location_id"
                                                                            class="js-select2">
                                                                        <option value="" selected="selected">
                                                                            Select
                                                                        </option>
                                                                        <?php foreach ($data['locations'] as $location): ?>
                                                                            <option value="<?php echo $location->id; ?>">
                                                                                <?php echo $location->location_name; ?>
                                                                            </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <div class="dropDownSelect2"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 no-padding-left-right">
                                                        <div class="input-group-addon2">Location Serial NO</div>
                                                        <div class="input-group">
                                                            <input type="number" id="location_serial_no"
                                                                   name="location_serial_no"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 no-padding-left">
                                                        <div class="input-group-addon2">Joining Date</div>
                                                        <div class="input-group">
                                                            <input type="text" name="joining_date"
                                                                   class="form-control datepicker" required
                                                                   readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 no-padding-right">
                                                        <div class="input-group-addon2">Photo</div>
                                                        <div class="input-group">
                                                            <input type="file" name="photo"
                                                                   class="custom-file-input">
                                                            <label class="custom-file-label"
                                                                   for="validatedCustomFile">Select
                                                                Photo</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 no-padding-left-right">
                                                        <div class="input-group-addon2">Notes</div>
                                                        <div class="input-group">
                                                                    <textarea name="notes" class="form-control"
                                                                              id="notes" rows="3"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-actions form-group">
                                                        <button type="submit" class="btn btn-primary"><i
                                                                    class="fa fa-plus"></i>Add
                                                            Subscriber
                                                        </button>
                                                    </div>
                                                </div>
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
            var message = $("#message").val();
            var type = $("#type").val();
            if (message != 0 && type != 0) {
                $.notify({
                    title: '<strong>' + type + '!!!</strong>',
                    icon: 'fas fa-comment-alt',
                    url: '',
                    target: '_blank',
                    message: message
                }, {
                    type: type,
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
                    delay: 0,
                });

            }

            /*date picker code*/
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            /*date picker code ends*/
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
                        photo: {
                            required: true,
                        },
                        nid: {
                            required: true,
                            rangelength: [6, 24]
                        },
                        phone: {
                            required: true,
                            rangelength: [6, 24],
                            pattern: /(^(\+8801|8801|01|008801))[1-9]{1}(\d){8}$/,
                            remote: '/subscribers/doesPhoneExist'
                        },
                        email: {
                            required: true,
                            email: true,
                            remote: '/subscribers/doesEmailExist'
                        },
                        present_address: {
                            required: true
                        },
                        permanent_address: {
                            required: true
                        },
                        package_id: {
                            required: true
                        },
                        location_id: {
                            required: true
                        },
                        location_serial_no: {
                            required: true,
                            number: true
                        },
                        joining_date: {
                            required: true
                        }

                    },
                    messages: {
                        name: {
                            required: 'Please enter aname',
                            rangelength: 'Name must have 6-30 characters',
                        },
                        photo: {
                            required: 'Please select a photo',
                        },
                        phone: {
                            required: 'Please enter a phone number',
                            pattern: 'Please enter a valid phone number'

                        },
                        email: {
                            required: 'Please enter a email',
                            email: 'Please enter valid a email'

                        },
                        nid: {
                            required: 'Please enter an NID card or Passport number',
                            rangelength: 'please enter a valid NID/Passport number'

                        },
                        present_address: {
                            required: 'Please enter a present address',
                        },
                        permanent_address: {
                            required: 'Please enter a permanent address',
                        },
                        package_id: {
                            required: 'Please select a internet package',
                        },
                        location_id: {
                            required: 'Please select a location',
                        },
                        location_serial_no: {
                            required: 'Please enter a location serial NO',
                        },
                        joining_date: {
                            required: 'Please select a joining date',
                        },
                    }
                });

            });


            $('#register-form').submit(function (e) {
                e.preventDefault();
                if ($("#register-form").valid()) {

                    var location_id = $("#location_id").val();
                    var location_serial_no = $("#location_serial_no").val();
                    var dataString = {
                        location_id: location_id,
                        location_serial_no: location_serial_no
                    };
                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        url: "/subscribers/checkOverlap",
                        data: dataString,
                        cache: false,
                        success: function (object) {
                            var message;
                            if (object.type === 1) {
                                if (confirm('This serial NO for this location exists in the database....' +
                                    'Are you sure you want to proceed?')) {
                                    $("#register-form").unbind().submit();

                                } else {
                                    message = "Change Location Serial Number for this location";
                                    $.notify({
                                        title: '<strong>Info</strong>',
                                        icon: 'fas fa-user-graduate ',
                                        url: '',
                                        target: '_blank',
                                        message: message
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
                                        delay: 7000,
                                    });
                                }
                            } else if (object.type === 2) {
                                message = object.message;
                                $.notify({
                                    title: '<strong>Info</strong>',
                                    icon: 'fas fa-user-graduate ',
                                    url: '',
                                    target: '_blank',
                                    message: message
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
                                    delay: 7000,
                                });
                            }

                            else {
                                $("#register-form").unbind().submit();

                            }
                        }
                    })
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('div.rs-select2--dark label.help-block').insertAfter($('div.rs-select2--dark'));
        })
    </script>
<?php require APPROOT . '/views/layouts/footer.php' ?>