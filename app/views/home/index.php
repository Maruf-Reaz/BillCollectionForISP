<?php /*require APPROOT . '/views/inc/header.php'; */ ?>
<?php require APPROOT . '/views/layouts/header.php' ?>
    <!--Mobile header with Navbar and notification bar-->
<?php require APPROOT . '/views/layouts/mobile_header.php' ?>
    <!--Menu Sidebar with navbar-->
<?php require APPROOT . '/views/layouts/menu_sidebar.php' ?>
    <!--Desktopn header with navbar and header file-->
<?php require APPROOT . '/views/layouts/desktop_header.php' ?>

    <style>
        card {
            margin-top: 0px;
        }

        .col-sm-6, .col-md-4, .col-md-6, .col-md-12, .col-lg-3, .col-lg-6 {
            padding: 0 15px;
        }
    </style>

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 no-padding-left">
                        <div class="card card-stats">
                            <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <p class="card-category">Subscriber</p>
                                <h3 id="total_employee"
                                    class="card-title"><?php echo $data['total_subscriber_count'] ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    Total Subscriber
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon">
                                    <i class="fas fa-user-check "></i>
                                </div>
                                <p class="card-category">Active</p>
                                <h3 id="total_present"
                                    class="card-title"><?php echo $data['active_subscriber_count'] ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    Active Subscriber
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-danger card-header-icon">
                                <div class="card-icon">
                                    <i class="fas fa-user-times "></i>
                                </div>
                                <p class="card-category">Inactive</p>
                                <h3 id="total_absent"
                                    class="card-title"><?php echo $data['inactive_subscriber_count'] ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    Inactive Subscriber
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 no-padding-right">
                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="fa fa-dollar-sign "></i>
                                </div>
                                <p class="card-category">Due</p>
                                <h3 id="device_connected"
                                    class="card-title"><?php echo $data['subscriber_with_due_count'] ?>
                                    /<?php echo $data['active_subscriber_count'] ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    Subscriber has due
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="calender-cont widget-calender">
                                    <div id="calendar"></div>
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
            $.notify({
                title: '<strong>Greetings!</strong>',
                icon: 'fas fa-comment-alt',
                url: 'https://www.emanagementsys.com/',
                target: '_blank',
                message: "Welcome to Fastnet Communication!"
            }, {
                type: 'success',
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
                delay: 3000,
            });
        });
    </script>

<?php /*require APPROOT . '/views/inc/footer.php'; */ ?>
<?php require APPROOT . '/views/layouts/footer.php' ?>