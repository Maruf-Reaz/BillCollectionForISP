<?php require APPROOT . '/views/layouts/header.php' ?>
    <!--Sole CSS-->
    <link href="<?php echo URLROOT; ?>/css/invoice.css" rel="stylesheet" media="all">
    <!--Mobile header with Navbar and notification bar-->
<?php require APPROOT . '/views/layouts/mobile_header.php' ?>
    <!--Menu Sidebar with navbar-->
<?php require APPROOT . '/views/layouts/menu_sidebar.php' ?>
    <!--Desktopn header with navbar and header file-->
<?php require APPROOT . '/views/layouts/desktop_header.php' ?>

    <style>
        .col-lg-8,
        .col-md-8 {
            margin: auto;
        }

        .print-button {
            margin-top: 12px;
        }
    </style>

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12" id="content">
                        <div class="drop-shadow x_panel au-card au-card--no-pad m-b-40">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="card-body">
                                        <div class="card-header card-header-primary">
                                            <h4 class="card-title"><i class="fa fa-pencil-alt"></i>
												<?php echo $data['invoice']->note ?>
                                            </h4>
                                        </div>
                                        <div class="panel-body profile-view-dis">
                                            <div class="invoice-box">
                                                <table cellpadding="0" cellspacing="0">
                                                    <tr class="top">
                                                        <td colspan="2">
                                                            <table>
                                                                <tr>
                                                                    <td class="title">
                                                                        <img src="<?php echo URLROOT; ?>/images/icon/ems-2.png"
                                                                             style="width:100%; max-width:100px;">
                                                                    </td>
                                                                    <td>
                                                                        Invoice #:
                                                                        <strong>
																			<?php echo $data['invoice']->invoice_number ?></strong><br>
                                                                        Date:
                                                                        <strong>
																			<?php echo $data['invoice']->date ?></strong>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr class="information">
                                                        <td colspan="2">
                                                            <table>
                                                                <tr>
                                                                    <td>
                                                                        <strong>Fastnet Communications</strong><br>
                                                                        In Front Of Rainbow School,<br>
                                                                        Box Ali Munsi Road(Navy Hall Road)<br>
                                                                        Bandartila,Chattogram<br>
                                                                        Email : fastnetctg@gmail.com<br>
                                                                        Cell: +8801816234583
                                                                    </td>
                                                                    <td>
                                                                        <strong>Name:</strong>
																		<?php echo $data['invoice']->subscriber_name; ?>
                                                                        <br>
                                                                        <strong>Subscriber ID:</strong>
																		<?php echo $data['invoice']->registration_no; ?>
                                                                        <br>
                                                                        <strong>Location:</strong>
																		<?php echo $data['invoice']->location_name; ?>
                                                                        <br>
                                                                        <strong>Joining Date:</strong>
																		<?php echo $data['invoice']->joining_date ?>
                                                                        <br>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr class="heading">
                                                        <td>Details</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr class="item">
                                                        <td>Sub Total</td>
                                                        <td>
															<?php echo $data['invoice']->amount; ?>
                                                        </td>
                                                    </tr>
                                                    <tr class="item">
                                                        <td>Discount</td>
                                                        <td>
															<?php echo $data['invoice']->discount; ?>
                                                        </td>
                                                    </tr>
                                                    <tr class="total">
                                                        <td></td>
                                                        <td>
                                                            Total:
															<?php echo $data['invoice']->amount_after_discount; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <center>
                    <button class="btn btn-primary print-button" onclick="pop_print()"><i class="fa fa-print fa-lg"></i>
                        Generate PDF
                    </button>
                </center>
            </div>
        </div>
    </div>

    <script>
        function pop_print() {
            w = window.open(null, 'Print_Page', 'scrollbars=yes');
            var myStyle = '<link rel="stylesheet" href="css/style.css"media="all"/>';
            var myStyle2 = '<link rel="stylesheet" href="/css/invoice.css"  media="all">';
            var myStyle3 = '<style> .card-title { margin-left: 280 ;}  </style>';
            w.document.write(myStyle + myStyle2 + myStyle3 + jQuery('#content').html());
            w.document.close();
            w.print();
        }
    </script>

<?php require APPROOT . '/views/layouts/footer.php' ?>