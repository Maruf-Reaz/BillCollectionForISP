<style>
    a:hover,
    a {
        border-radius: 7px;
        color: #fff
    }
</style>
<!-- PAGE CONTAINER-->
<div class="page-container">
    <!-- HEADER DESKTOP-->

    <!-- HEADER DESKTOP-->
    <header class="header-desktop">
        <div class="section__content section__content--p30 d-lg-block d-none">
            <div class="container-fluid">
                <div class="header-wrap">
                    <form class="form-header" action="" method="POST">
                        <a class="hide-sidebar-onclick d-lg-block d-none"><i class="fa fa-bars"></i></a>
                    </form>
                    <div class="header-button">
                        <div class="noti-wrap">
                            <div class="account-wrap">
                                <div class="account-item clearfix js-item-menu">
                                    <div class="image">
                                                <img src="<?php echo URLROOT; ?>/images/icon/admin.jpg" alt="Admin" />
                                            </div>
                                            <div class="content">
                                                <a class="js-acc-btn" href="#">Admin</a>
                                            </div>

                                    <div class="account-dropdown js-dropdown">
                                        <div class="info clearfix">
                                            <div class="image">
                                                <a href="#">
                                                    <img src="<?php echo URLROOT; ?>/images/icon/admin.jpg" alt="Admin" />
                                                </a>
                                            </div>
                                            <div class="content">
                                                <h5 class="name">
                                                    <a href="#">Admin</a>
                                                </h5>
                                                <span class="email">admin@mail.com</span>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__footer">
                                            <a href="<?php echo URLROOT; ?>/users/logout">
                                                <i class="zmdi zmdi-power"></i>Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="section__content section__content--p30 d-lg-none d-block">
            <div class="container-fluid">
                <div class="header-wrap">
                    <form class="form-header" action="" method="POST">
                        <a class="hide-sidebar-onclick d-lg-block d-none"><i class="fa fa-bars"></i></a>
                    </form>
                    <div class="header-button">
                        <div class="noti-wrap">
                            <div class="account-wrap">
                                <div class="account-item clearfix js-item-menu">
                                    <div class="image">
                                        <img src="<?php echo URLROOT; ?>/images/icon/admin.jpg" alt="Admin" />
                                    </div>
                                    <div class="content">
                                        <a class="js-acc-btn" href="#">Admin</a>
                                    </div>

                                    <div class="account-dropdown js-dropdown">
                                        <div class="info clearfix">
                                            <div class="image">
                                                <a href="#">
                                                    <img src="<?php echo URLROOT; ?>/images/icon/admin.jpg" alt="Admin" />
                                                </a>
                                            </div>
                                            <div class="content">
                                                <h5 class="name">
                                                    <a href="#">Admin</a>
                                                </h5>
                                                <span class="email">admin@mail.com</span>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__footer">
                                            <a href="<?php echo URLROOT; ?>/users/logout">
                                                <i class="zmdi zmdi-power"></i>Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER DESKTOP-->
    <script>
        $(document).on('click', 'a.hide-sidebar-onclick', function () {
            $('aside.menu-sidebar').removeClass('d-none d-lg-block').addClass('d-block d-lg-none');
            $('div.page-container').removeClass('page-container').addClass('page-container-zero');
            $('header.header-desktop').removeClass('header-desktop').addClass('header-desktop-zero');
            $('a.hide-sidebar-onclick').removeClass('hide-sidebar-onclick').addClass('show-sidebar-onclick');
        });
        $(document).on('click', 'a.show-sidebar-onclick', function () {
            $('aside.menu-sidebar').removeClass('d-block d-lg-none').addClass('d-none d-lg-block');
            $('div.page-container-zero').removeClass('page-container-zero').addClass('page-container');
            $('header.header-desktop-zero').removeClass('header-desktop-zero').addClass('header-desktop');
            $('a.show-sidebar-onclick').removeClass('show-sidebar-onclick').addClass('hide-sidebar-onclick');
        });
    </script>