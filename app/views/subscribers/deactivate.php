<?php require APPROOT . '/views/layouts/header.php' ?>
<!--Mobile header with Navbar and notification bar-->
<?php require APPROOT . '/views/layouts/mobile_header.php' ?>
<!--Menu Sidebar with navbar-->
<?php require APPROOT . '/views/layouts/menu_sidebar.php' ?>
<!--Desktop header with navbar and header file-->
<?php require APPROOT . '/views/layouts/desktop_header.php' ?>

<style>
    h6 {
        font-weight: 400;
    }
</style>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-xs-12">
                    <div class="x_panel au-card au-card--no-pad m-b-40" style="border-left: 2px solid #85CE36;">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h4 class="header-title-new"><i class="fa fa-pencil-alt"></i>Subscriber Info</h4>
                                <center>
                                    <img class="img-circle" src="<?php echo URLROOT ?>/images/subscribers/<?php echo $data['subscriber']->photo ?>">
                                    <div>
                                        <h4>
                                            <?php echo $data['subscriber']->name ?>
                                        </h4>
                                        <h6>
                                            <?php echo $data['subscriber']->registration_no ?>
                                        </h6>
                                    </div>
                                </center>
                                <div class="activate-table table-responsive table-style1">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><strong>Location :</strong></td>
                                                <td>
                                                    <?php echo $data['subscriber']->location_name ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Location Serial NO:</strong></td>
                                                <td>
                                                    <?php echo $data['subscriber']->location_serial_no ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Joining Date :</strong></td>
                                                <td>
                                                    <?php echo $data['subscriber']->joining_date ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Package :</strong></td>
                                                <td>
                                                    <?php echo $data['subscriber']->package_name ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Speed :</strong></td>
                                                <td>
                                                    <?php echo $data['subscriber']->package_speed ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Bill :</strong></td>
                                                <td>
                                                    <?php echo $data['subscriber']->package_cost ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status :</strong></td>
                                                <?php if ($data['subscriber']->status==1): ?>
                                                <td><strong style="color: green; margin-left:0px">Active</strong></td>
                                                <?php else: ?>
                                                <td><strong style="color: red; margin-left:0px">Not Active</strong></td>
                                                <?php endif ?>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="drop-shadow x_panel au-card au-card au-card--no-pad m-b-40">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="card-body">
                                   <div class="card-header card-header-primary">
                                        <h4 class="card-title"><i class="fa fa-pencil-alt"></i>Deactivate</h4>
                                    </div>
                                    <form action="<?php URLROOT ?>/Subscribers/deactivate/<?php echo $data['subscriber']->id ?>" method="post">
                                        <div class="form-group">
                                            <div class="input-group-addon2">Deactivation Date</div>
                                            <div class="input-group">
                                                <input placeholder="<?php echo date(" m")?>/<?php echo date("d")?>/<?php echo date("Y")?>"type="text"
                                                name="deactivation_date" value="" class="form-control datepicker" readonly>
                                            </div>
                                        </div>
                                        <div class="form-actions form-group">
                                            <button type="submit" class="btn btn-danger">Deactivate</button>
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
    <script>
        $(document).ready(function() {
            /*date picker code*/
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            /*date picker code ends*/
        });
    </script>
    <?php require APPROOT . '/views/layouts/footer.php' ?>