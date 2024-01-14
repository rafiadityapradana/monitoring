<!DOCTYPE html>
<html lang="en">

<head>
     <title>Monitoring Apps</title>

     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />

     <meta name="keywords"
          content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
     <meta name="author" content="Codedthemes" />

     <link rel="icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">
     <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="<?= base_url() ?>assets/pages/waves/css/waves.min.css" type="text/css" media="all">
     <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/icon/themify-icons/themify-icons.css">
     <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/icon/feather/css/feather.css">
     <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/icon/font-awesome/css/font-awesome.min.css">
     <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.css">
     <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/jquery.mCustomScrollbar.css">
     <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/morris.js/css/morris.css">

     <!-- ============================ -->

     <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery/jquery.min.js "></script>
     <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-ui/jquery-ui.min.js "></script>
     <script type="text/javascript" src="<?= base_url() ?>assets/js/popper.js/popper.min.js"></script>
     <script type="text/javascript" src="<?= base_url() ?>assets/js/bootstrap/js/bootstrap.min.js "></script>
     <!-- waves js -->
     <script src="<?= base_url() ?>assets/pages/waves/js/waves.min.js"></script>
     <!-- jquery slimscroll js -->
     <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
     <script src="<?= base_url() ?>assets/js/pcoded.min.js"></script>
     <script src="<?= base_url() ?>assets/js/vertical/vertical-layout.min.js"></script>
     <script src="<?= base_url() ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
     <!-- Custom js -->
     <script type="text/javascript" src="<?= base_url() ?>assets/js/script.min.js"></script>


</head>

<body>
     <!-- Pre-loader start -->
     <div class="theme-loader">
          <div class="loader-track">
               <div class="preloader-wrapper">
                    <div class="spinner-layer spinner-blue">
                         <div class="circle-clipper left">
                              <div class="circle"></div>
                         </div>
                         <div class="gap-patch">
                              <div class="circle"></div>
                         </div>
                         <div class="circle-clipper right">
                              <div class="circle"></div>
                         </div>
                    </div>
                    <div class="spinner-layer spinner-red">
                         <div class="circle-clipper left">
                              <div class="circle"></div>
                         </div>
                         <div class="gap-patch">
                              <div class="circle"></div>
                         </div>
                         <div class="circle-clipper right">
                              <div class="circle"></div>
                         </div>
                    </div>
                    <div class="spinner-layer spinner-yellow">
                         <div class="circle-clipper left">
                              <div class="circle"></div>
                         </div>
                         <div class="gap-patch">
                              <div class="circle"></div>
                         </div>
                         <div class="circle-clipper right">
                              <div class="circle"></div>
                         </div>
                    </div>
                    <div class="spinner-layer spinner-green">
                         <div class="circle-clipper left">
                              <div class="circle"></div>
                         </div>
                         <div class="gap-patch">
                              <div class="circle"></div>
                         </div>
                         <div class="circle-clipper right">
                              <div class="circle"></div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <!-- Pre-loader end -->
     <div id="pcoded" class="pcoded">
          <div class="pcoded-overlay-box"></div>
          <div class="pcoded-container navbar-wrapper">
               <nav class="navbar header-navbar pcoded-header">
                    <div class="navbar-wrapper">
                         <div class="navbar-logo">
                              <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                                   <i class="ti-menu"></i>
                              </a>

                              <a href="index.html">
                                   <img class="img-fluid" src="<?= base_url() ?>assets/images/logo.png"
                                        alt="Theme-Logo" />
                              </a>
                              <a class="mobile-options waves-effect waves-light">
                                   <i class="ti-more"></i>
                              </a>
                         </div>
                         <div class="navbar-container container-fluid">
                              <ul class="nav-left">
                                   <li>
                                        <div class="sidebar_toggle"><a href="javascript:void(0)"><i
                                                       class="ti-menu"></i></a></div>
                                   </li>
                                   <li>
                                        <a href="#!" onclick="javascript:toggleFullScreen()"
                                             class="waves-effect waves-light">
                                             <i class="ti-fullscreen"></i>
                                        </a>
                                   </li>
                              </ul>
                              <ul class="nav-right">

                                   <li class="user-profile header-notification">
                                        <a href="#!" class="waves-effect waves-light">

                                             <span>John Doe</span>
                                             <i class="ti-angle-down"></i>
                                        </a>
                                        <ul class="show-notification profile-notification">
                                             <li class="waves-effect waves-light">
                                                  <a href="#!">
                                                       <i class="ti-settings"></i> Settings
                                                  </a>
                                             </li>
                                             <li class="waves-effect waves-light">
                                                  <a href="user-profile.html">
                                                       <i class="ti-user"></i> Profile
                                                  </a>
                                             </li>
                                             <li class="waves-effect waves-light">
                                                  <a href="email-inbox.html">
                                                       <i class="ti-email"></i> My Messages
                                                  </a>
                                             </li>
                                             <li class="waves-effect waves-light">
                                                  <a href="auth-lock-screen.html">
                                                       <i class="ti-lock"></i> Lock Screen
                                                  </a>
                                             </li>
                                             <li class="waves-effect waves-light">
                                                  <a href="auth-normal-sign-in.html">
                                                       <i class="ti-layout-sidebar-left"></i> Logout
                                                  </a>
                                             </li>
                                        </ul>
                                   </li>
                              </ul>
                         </div>
                    </div>
               </nav>

               <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                         <nav class="pcoded-navbar">
                              <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                              <div class="pcoded-inner-navbar main-menu">

                                   <ul class="pcoded-item pcoded-left-item">
                                        <li class="">
                                             <a href="<?= base_url() ?>" class="waves-effect waves-dark">
                                                  <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                                  <span class="pcoded-mtext">Dashboard</span>
                                                  <span class="pcoded-mcaret"></span>
                                             </a>
                                        </li>
                                        <li class="">
                                             <a href="<?= base_url(
                                                 'app/data-monitoring'
                                             ) ?>" class="waves-effect waves-dark">
                                                  <span class="pcoded-micon"><i class="ti-receipt"></i></span>
                                                  <span class="pcoded-mtext">Data Monitoring</span>
                                                  <span class="pcoded-mcaret"></span>
                                             </a>
                                        </li>
                                        <li class="pcoded-hasmenu">
                                             <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                  <span class="pcoded-micon"><i
                                                            class="ti-layout-grid2-alt"></i><b>BC</b></span>
                                                  <span class="pcoded-mtext">Apps Managemenet</span>
                                                  <span class="pcoded-mcaret"></span>
                                             </a>
                                             <ul class="pcoded-submenu">
                                                  <li class=" ">
                                                       <a href="<?= base_url(
                                                           'app/data-users'
                                                       ) ?>" class="waves-effect waves-dark">
                                                            <span class="pcoded-micon"><i
                                                                      class="ti-angle-right"></i></span>
                                                            <span class="pcoded-mtext">Users</span>
                                                            <span class="pcoded-mcaret"></span>
                                                       </a>
                                                  </li>
                                                  <li class=" ">
                                                       <a href="<?= base_url(
                                                           'app/data-machine'
                                                       ) ?>" class="waves-effect waves-dark">
                                                            <span class="pcoded-micon"><i
                                                                      class="ti-angle-right"></i></span>
                                                            <span class="pcoded-mtext">Machine</span>
                                                            <span class="pcoded-mcaret"></span>
                                                       </a>
                                                  </li>
                                                  <li class="">
                                                       <a href="<?= base_url(
                                                           'app/data-server'
                                                       ) ?>" class="waves-effect waves-dark">
                                                            <span class="pcoded-micon"><i
                                                                      class="ti-angle-right"></i></span>
                                                            <span class="pcoded-mtext">Server</span>
                                                            <span class="pcoded-mcaret"></span>
                                                       </a>
                                                  </li>

                                             </ul>
                                        </li>
                                   </ul>
                              </div>
                         </nav>
                         <div class="pcoded-content">
                              <!-- Page-header start -->

                              <!-- Page-header end -->
                              <div class="pcoded-inner-content">
                                   <div class="main-body">
                                        <div class="page-wrapper">
                                             <div class="page-body">
                                                  <div class="row">
                                                       <div class="col-sm-12">
                                                            <div class="card">
                                                                 <div class="card-header">
                                                                      <h5>Hello card</h5>
                                                                      <span>lorem ipsum dolor sit amet, consectetur
                                                                           adipisicing elit</span>
                                                                      <div class="card-header-right">
                                                                           <ul class="list-unstyled card-option">
                                                                                <li>
                                                                                     <i
                                                                                          class="fa fa fa-wrench open-card-option"></i>
                                                                                </li>
                                                                                <li>
                                                                                     <i
                                                                                          class="fa fa-window-maximize full-card"></i>
                                                                                </li>
                                                                                <li>
                                                                                     <i
                                                                                          class="fa fa-minus minimize-card"></i>
                                                                                </li>
                                                                                <li>
                                                                                     <i
                                                                                          class="fa fa-refresh reload-card"></i>
                                                                                </li>
                                                                                <li>
                                                                                     <i
                                                                                          class="fa fa-trash close-card"></i>
                                                                                </li>
                                                                           </ul>
                                                                      </div>
                                                                 </div>
                                                                 <div class="card-block">
                                                                      <p>
                                                                           "Lorem ipsum dolor sit amet, consectetur
                                                                           adipiscing elit, sed do eiusmod tempor
                                                                           incididunt ut labore et dolore magna aliqua.
                                                                           Ut enim ad minim veniam, quis nostrud
                                                                           exercitation ullamco
                                                                           laboris nisi ut aliquip ex ea commodo
                                                                           consequat. Duis aute irure dolor
                                                                           in reprehenderit in voluptate velit esse
                                                                           cillum dolore eu fugiat nulla pariatur.
                                                                           Excepteur sint occaecat cupidatat non
                                                                           proident, sunt in culpa qui officia deserunt
                                                                           mollit anim id est
                                                                           laborum."
                                                                      </p>
                                                                 </div>
                                                            </div>
                                                       </div>

                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div id="styleSelector"></div>
                    </div>
               </div>
          </div>
     </div>


</body>

</html>