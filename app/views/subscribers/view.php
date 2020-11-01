<!--Page header and All CSS Files-->
<?php require APPROOT . '/views/layouts/header.php' ?>
<!--Mobile header with Navbar and notification bar-->
<?php require APPROOT . '/views/layouts/mobile_header.php' ?>
<!--Menu Sidebar with navbar-->
<?php require APPROOT . '/views/layouts/menu_sidebar.php' ?>
<!--Desktopn header with navbar and header file-->
<?php require APPROOT . '/views/layouts/desktop_header.php' ?>
<style>
    .col-md-6 {
        margin: auto;
    }

    .print-button {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .print-button i {
        padding-right: 7px;
    }

    div.activate-table {
        margin-bottom: 0;
    }
</style>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-xs-12">
                    <div class="x_panel au-card au-card--no-pad m-b-40" id="content">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h4 class="header-title-new"><i class="fa fa-pencil-alt"></i>Subscriber Info</h4>
                                <center class="custom">
                                    <img src="<?php URLROOT; ?>/images/subscribers/<?php echo $data['subscriber']->photo; ?>"
                                         alt="image" class="img-circle">
                                    <div>
                                        <h4>
											<?php echo $data['subscriber']->name; ?>
                                        </h4>
                                        <h6 style="font-weight: 400;">
											<?php echo $data['subscriber']->registration_no; ?>
                                        </h6>
                                    </div>
                                </center>


                                <div class="activate-table table-responsive table-style1">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td><strong>Name</strong></td>
                                            <td>
												<?php echo $data['subscriber']->name; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>NID/Passport Number</strong></td>
                                            <td>
												<?php echo $data['subscriber']->nid; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Contact Number</strong></td>
                                            <td>
												<?php echo $data['subscriber']->phone; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>E-mail</strong></td>
                                            <td>
												<?php echo $data['subscriber']->email; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Note</strong></td>
                                            <td>
												<?php echo $data['subscriber']->notes; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Present Address</strong></td>
                                            <td>
												<?php echo $data['subscriber']->present_address; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Permanent Address</strong></td>
                                            <td>
												<?php echo $data['subscriber']->permanent_address; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Location</strong></td>
                                            <td>
												<?php echo $data['subscriber']->location_name; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Location Serial Number</strong></td>
                                            <td>
												<?php echo $data['subscriber']->location_serial_no; ?>
                                            </td>
                                        </tr>
										<?php if ( $data['subscriber']->package_id == 0 ): ?>
                                            <tr>
                                                <td><strong>Package</strong></td>
                                                <td>
                                                    N/A
                                                </td>
                                            </tr>
										<?php else: ?>
                                            <tr>
                                                <td><strong>Package</strong></td>
                                                <td>
													<?php echo $data['subscriber']->package_name; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Speed</strong></td>
                                                <td>
													<?php echo $data['subscriber']->package_speed; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Cost</strong></td>
                                                <td>
													<?php echo $data['subscriber']->package_cost; ?>
                                                </td>
                                            </tr>
										<?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <center>
                        <a class="btn btn-primary print-button"
                           href="<?php echo URLROOT; ?>/accounts/payments/showpaymentsbysubscriberid/<?php echo $data['subscriber']->id; ?>">
                            Payment History</a>
                        <button class="btn btn-primary print-button" onclick="pop_print()">
                            <i class="fa fa-print fa-lg"></i>Generate PDF
                        </button>
                    </center>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function pop_print() {
        w = window.open(null, 'Print_Page', 'scrollbars=yes');
        var myStyle = '<link rel="stylesheet" href="/css/style.css"media="all"/>';
        var myStyle1 = '<link rel="stylesheet" href="/vendor/bootstrap-4.1/bootstrap.min.css"media="all"/>';
        var myStyle2 = '<link rel="stylesheet" href="/css/material-dashboard.css"media="all"/>';
        var myStyle3 = '<style> .img-circle { width: 200 ;}  </style>';
        var myStyle4 = '<style> .table {margin-left:180 ;} </style>';
        var myStyle5 = '<style> .table tbody tr td  {width:290 ; border :none;} </style>';
        var myStyle6 = '<style> .header-title-new {margin-left:410 ;} </style>';
        w.document.write(myStyle + myStyle1 + myStyle2 + myStyle3 + myStyle4 + myStyle5 + myStyle6 + jQuery('#content').html());
        w.document.close();
        w.print();
    }
</script>
<!--Footer ,Load every JS libarary-->
<?php require APPROOT . '/views/layouts/footer.php' ?>