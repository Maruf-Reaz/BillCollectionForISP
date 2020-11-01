<!--Page header and All CSS Files-->
<?php require APPROOT . '/views/layouts/header.php' ?>
<!--Mobile header with Navbar and notification bar-->
<?php require APPROOT . '/views/layouts/mobile_header.php' ?>
<!--Menu Sidebar with navbar-->
<?php require APPROOT . '/views/layouts/menu_sidebar.php' ?>
<!--Desktopn header with navbar and header file-->
<?php require APPROOT . '/views/layouts/desktop_header.php' ?>

<style>
    .x_panel img {
        border-radius: 10px !important;
    }
    .back-button {
        margin-top: 15px;
    }
</style>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row justify-content-lg-center">
                <div class="col-sm-12 col-md-6 col-xs-12">
                    <div class="x_panel au-card au-card--no-pad m-b-40">
                        <img src="/images/nid.jpg" alt="">
                    </div>
                    <center class="back-button">
                        <button class="btn btn-primary">
                            <i class="fa fa-undo fa-lg"></i>Back
                        </button>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Footer ,Load every JS libarary-->
<?php require APPROOT . '/views/layouts/footer.php' ?>
