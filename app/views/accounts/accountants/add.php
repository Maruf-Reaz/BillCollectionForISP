<!--Page header and All CSS Files-->
<?php require APPROOT . '/views/layouts/header.php' ?>
<!--Mobile header with Navbar and notification bar-->
<?php require APPROOT . '/views/layouts/mobile_header.php' ?>
<!--Menu Sidebar with navbar-->
<?php require APPROOT . '/views/layouts/menu_sidebar.php' ?>
<!--Desktopn header with navbar and header file-->
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

</style>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row justify-content-lg-center">
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="drop-shadow x_panel au-card au-card--no-pad m-b-40">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="card-body">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title"><i class="fa fa-pencil-alt"></i>Add Accountant</h4>
                                    </div>
                                    <form action="<?php URLROOT; ?>/accounts/accountants/add"
                                          enctype="multipart/form-data" method="post" class="form-horizontal"
                                          id="register-form">
                                        <div class="container">
                                            <div class="row">
                                                <div class="form-group col-md-12 no-padding-left-right">
                                                    <div class="input-group-addon2">Name</div>
                                                    <div class="input-group">
                                                        <input type="text" id="accountant_name" name="accountant_name"
                                                               placeholder="Enter Name..." class="form-control"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12 no-padding-left-right">
                                                    <div class="input-group-addon2">Photo</div>
                                                    <div class="input-group">
                                                        <input id="photo" name="photo" required
                                                               class="custom-file-input" type="file">
                                                        <label class="custom-file-label">Select Photo</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 no-padding-left">
                                                    <div class="input-group-addon2">NID Or Passport Number</div>
                                                    <div class="input-group">
                                                        <input type="text" id="nid_number" name="nid_number"
                                                               placeholder="Enter NID Or Passport Number..."
                                                               class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 no-padding-right">
                                                    <div class="input-group-addon2">Contact Number</div>
                                                    <div class="input-group">
                                                        <input type="text" id="contact_number" name="contact_number"
                                                               placeholder="Enter Contact Number..."
                                                               class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 no-padding-left">
                                                    <div class="input-group-addon2">Email</div>
                                                    <div class="input-group">
                                                        <input type="email" id="email" name="email"
                                                               placeholder="Enter Email..." class="form-control"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 no-padding-right">
                                                    <div class="input-group-addon2">Educational Qualification</div>
                                                    <div class="input-group">
                                                        <input type="text" id="educational_qualification"
                                                               name="educational_qualification"
                                                               placeholder="Enter Educational Qualification..."
                                                               class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="container no-padding-left-right">
                                                    <div class="row">
                                                        <div class="form-group col-md-6 no-padding-left">
                                                            <div class="input-group-addon2">Gender</div>
                                                            <div class="rs-select2--dark rs-select2--border col-md-12 col-xs-12 no-padding-left">
                                                                <select class="js-select2" id="gender" name="gender">
                                                                    <option value="" selected="selected">-Select Gender-
                                                                    </option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                    <option value="Other">Other</option>
                                                                </select>
                                                                <div class="dropDownSelect2"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6 no-padding-right">
                                                            <div class="input-group-addon2">Blood Group</div>
                                                            <div class="rs-select2--dark rs-select2--border col-md-12 col-xs-12 no-padding-left">
                                                                <select class="js-select2" id="blood_group"
                                                                        name="blood_group">
                                                                    <option value="N/A" selected="selected">-Select
                                                                        Blood
                                                                        Group-
                                                                    </option>
                                                                    <option value="A+">A+</option>
                                                                    <option value="A-">A-</option>
                                                                    <option value="O+">O+</option>
                                                                    <option value="O-">O-</option>
                                                                    <option value="B+">B+</option>
                                                                    <option value="B-">B-</option>
                                                                    <option value="AB+">AB+</option>
                                                                    <option value="AB-">AB-</option>
                                                                </select>
                                                                <div class="dropDownSelect2"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12 no-padding-left-right">
                                                    <div class="input-group-addon2">Present Address</div>
                                                    <div class="input-group">
                                                        <textarea type="text" id="present_address"
                                                                  name="present_address"
                                                                  placeholder="Enter Present Address..."
                                                                  class="form-control" required rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12 no-padding-left-right">
                                                    <div class="input-group-addon2">Permanent Address</div>
                                                    <div class="input-group">
                                                        <textarea type="text" id="permanent_address"
                                                                  name="permanent_address"
                                                                  placeholder="Enter Permanent Address..."
                                                                  class="form-control" required rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-actions form-group">
                                                    <button type="submit" class="btn btn-primary">Add Accountant
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
        $(':input').removeAttr('placeholder');

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
                    accountant_name: {
                        required: true,
                        rangelength: [3, 30]
                    },
                    photo: {
                        required: true,
                        remote: '/accounts/accountants/doesPhotoExist'
                    },
                    nid_number: {
                        required: true,
                        minlength: 8,
                        remote: '/accounts/accountants/doesNidNumberExist'
                    },
                    contact_number: {
                        required: true,
                        minlength: 11,
                        pattern: /(^(\+8801|8801|01|008801))[1-9]{1}(\d){8}$/,
                        remote: '/accounts/accountants/doesContactNumberExist'
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: '/accounts/accountants/doesEmailExist'
                    },
                    gender: {
                        required: true
                    },
                    educational_qualification: {
                        required: true
                    },
                    present_address: {
                        required: true
                    },
                    permanent_address: {
                        required: true
                    }
                },
                messages: {
                    accountant_name: {
                        required: 'Please enter name',
                        rangelength: 'Name must have 3-30 characters'
                    },
                    photo: {
                        required: 'Please insert a photo'
                    },
                    nid_number: {
                        required: 'Please enter NID or Passport number',
                        minlength: 'NID Or Passport number must have minimum 8 characters'
                    },
                    contact_number: {
                        required: 'Please enter Contact Number',
                        pattern: 'Please enter a valid phone number',
                        minlength: 'Contact number must have minimum 11 characters'
                    },
                    email: {
                        required: 'Please enter an email',
                        email: 'Please enter a valid email'
                    },
                    gender: {
                        required: 'Please select gender'
                    },
                    educational_qualification: {
                        required: 'Please enter educational qualification'
                    },
                    present_address: {
                        required: 'Please enter present address'
                    },
                    permanent_address: {
                        required: 'Please enter permanent address'
                    }
                }
            });
        });
        // Validation Code Ends Here....
    });
</script>
<!--Footer ,Load every JS libarary-->
<?php require APPROOT . '/views/layouts/footer.php' ?>