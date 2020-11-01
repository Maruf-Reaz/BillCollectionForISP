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
            <div class="row justify-content-lg-center">
                <div class="col-sm-12 col-md-6 col-xs-12">
                    <div class="x_panel au-card au-card--no-pad m-b-40">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h4 class="header-title-new"><i class="fa fa-pencil-alt"></i>Accountant Info</h4>
                                <center>
                                    <img src="<?php URLROOT; ?>/images/accountants/<?php echo $data['accountant']->photo; ?>" alt="image" class="img-circle">
                                    <div>
                                        <h4>
                                            <?php echo $data['accountant']->accountant_name; ?>
                                        </h4>
                                        <h6 style="font-weight: 400;">
                                            <?php echo $data['accountant']->registration_no; ?>
                                        </h6>
                                    </div>
                                </center>


                                <div class="activate-table table-responsive table-style1">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><strong>Name</strong></td>
                                                <td>
                                                    <?php echo $data['accountant']->accountant_name; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>NID/Passport Number</strong></td>
                                                <td>
                                                    <?php echo $data['accountant']->nid_number; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Contact Number</strong></td>
                                                <td>
                                                    <?php echo $data['accountant']->contact_number; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Gender</strong></td>
                                                <td>
                                                    <?php echo $data['accountant']->gender; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Blood Group</strong></td>
                                                <td>
                                                    <?php echo $data['accountant']->blood_group; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Educational Qualification</strong></td>
                                                <td>
                                                    <?php echo $data['accountant']->educational_qualification; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>E-mail</strong></td>
                                                <td>
                                                    <?php echo $data['accountant']->email; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Present Address</strong></td>
                                                <td>
                                                    <?php echo $data['accountant']->present_address; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Permanent Address</strong></td>
                                                <td>
                                                    <?php echo $data['accountant']->permanent_address; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Footer ,Load every JS libarary-->
<?php require APPROOT . '/views/layouts/footer.php' ?>