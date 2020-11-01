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
                                            <h4 class="card-title"><i class="fa fa-pencil-alt"></i>Edit Subscribers</h4>
                                        </div>
                                        <form action="<?php URLROOT ?>/Subscribers/edit" enctype="multipart/form-data"
                                              method="post" id="register-form">
                                            <div class="container">
                                                <input type="hidden" id="id" name="id"
                                                       value="<?php echo $data['subscriber']->id ?>">
                                                <div class="row">
                                                    <div class="form-group col-md-6 no-padding-left">
                                                        <div class="input-group-addon2">Name</div>
                                                        <div class="input-group">
                                                            <input type="text" name="name" class="form-control"
                                                                   value="<?php echo $data['subscriber']->name ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 no-padding-right">
                                                        <div class="input-group-addon2">NID/Passport</div>
                                                        <div class="input-group">
                                                            <input type="text" name="nid" class="form-control"
                                                                   value="<?php echo $data['subscriber']->nid ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 no-padding-left-right">
                                                        <div class="input-group-addon2">NID Image</div>
                                                        <div class="input-group">
                                                            <img class="img-40"
                                                                 src="<?php URLROOT; ?>/images/subscriber_nid/<?php echo $data['subscriber']->nid_photo ?> ?>"
                                                                 alt="image">
                                                            <input type="file" id="username3" name="nid_photo"
                                                                   class="form-control">
                                                            <input type="hidden" id="nid_old_photo"
                                                                   name="nid_old_photo"
                                                                   value="<?php echo $data['subscriber']->nid_photo ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6 no-padding-left">
                                                        <div class="input-group-addon2">Phone Number</div>
                                                        <div class="input-group">
                                                            <input type="text" name="phone" class="form-control"
                                                                   value="<?php echo $data['subscriber']->phone ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 no-padding-right">
                                                        <div class="input-group-addon2">Email</div>
                                                        <div class="input-group">
                                                            <input type="text" name="email" class="form-control"
                                                                   value="<?php echo $data['subscriber']->email ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 no-padding-left-right">
                                                        <div class="input-group-addon2">Present Address</div>
                                                        <div class="input-group">
                                                            <textarea name="present_address" class="form-control"
                                                                      id="present_address"
                                                                      rows="3"><?php echo $data['subscriber']->present_address ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 no-padding-left-right">
                                                        <div class="input-group-addon2">Permanent Address</div>
                                                        <div class="input-group">
                                                            <textarea name="permanent_address" class="form-control"
                                                                      id="permanent_address"
                                                                      rows="3"><?php echo $data['subscriber']->permanent_address ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="container no-padding-left-right">
                                                        <div class="row">
                                                            <div class="form-group col-md-6 no-padding-left">
                                                                <div class="rs-select2--dark rs-select2--border col-md-12 col-xs-12 no-padding-left">
                                                                    <div class="input-group-addon2">Package</div>
                                                                    <select name="package_id" class="js-select2">
                                                                        <option value="<?php echo $data['subscriber']->package_id ?>"
                                                                                selected="selected">
                                                                            <?php echo $data['subscriber']->package_name ?>
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
                                                                <div class="rs-select2--dark rs-select2--border col-md-12 col-xs-12 no-padding-left">
                                                                    <div class="input-group-addon2">Location</div>
                                                                    <select name="location_id" class="js-select2"
                                                                            id="location_id" readonly>
                                                                        <option value="<?php echo $data['subscriber']->location_id ?>"
                                                                                selected="selected">
                                                                            <?php echo $data['subscriber']->location_name ?>
                                                                        </option>
                                                                        <?php foreach ($data['locations'] as $location): ?>
                                                                            <option value="<?php echo $location->id; ?>">
                                                                                <?php echo $location->name; ?>
                                                                            </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <div class="dropDownSelect2"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 no-padding-left-right">
                                                        <div class="input-group-addon2">Location Serial NO
                                                        </div>
                                                        <div class="input-group">
                                                            <input type="number" name="location_serial_no"
                                                                   id="location_serial_no"
                                                                   class="form-control"
                                                                   value="<?php echo $data['subscriber']->location_serial_no ?>"
                                                                   readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 no-padding-left">
                                                        <div class="input-group-addon2">Joining Date</div>
                                                        <div class="input-group">
                                                            <input type="text" name="joining_date"
                                                                   class="form-control datepicker" required
                                                                   readonly
                                                                   value="<?php echo $data['subscriber']->joining_date ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 no-padding-right">
                                                        <div class="input-group-addon2">Photo</div>
                                                        <div class="input-group">
                                                            <img class="img-40"
                                                                 src="<?php URLROOT; ?>/images/subscribers/<?php echo $data['subscriber']->photo ?> ?>"
                                                                 alt="image">
                                                            <input type="file" id="username3" name="photo"
                                                                   class="form-control">
                                                            <input type="hidden" id="oldPhoto"
                                                                   name="oldPhoto"
                                                                   value="<?php echo $data['subscriber']->photo ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-12 no-padding-left-right">
                                                        <div class="input-group-addon2">Notes</div>
                                                        <div class="input-group">
                                                            <textarea name="notes" class="form-control" id="notes"
                                                                      rows="3"><?php echo $data['subscriber']->notes ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions form-group">
                                                        <button type="submit" class="btn btn-primary">
                                                            Confirm
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
                        }else {
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
                        nid: {
                            required: true,
                            rangelength: [6, 24]
                        },
                        phone: {
                            required: true,
                            rangelength: [6, 24],
                            pattern: /(^(\+8801|8801|01|008801))[1-9]{1}(\d){8}$/,
                            remote:
                                {
                                    url: '/subscribers/doesPhoneExistExceptId',
                                    data: {
                                        'id': $('#id').val(),
                                        'phone': $('#phone').innerHTML
                                    }
                                }
                        },
                        email: {
                            required: true,
                            email: true,
                            remote:
                                {
                                    url: '/subscribers/doesEmailExistExceptId',
                                    data: {
                                        'id': $('#id').val(),
                                        'email': $('#email').innerHTML
                                    }
                                }
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
        });
    </script>
<?php require APPROOT . '/views/layouts/footer.php' ?>