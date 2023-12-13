
<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>LB Hope UI | Dashboard</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="./assets/images/favicon.ico" />
      
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="./assets/css/core/libs.min.css" />
      
      <!-- Aos Animation Css -->
      <link rel="stylesheet" href="./assets/vendor/aos/dist/aos.css" />
      
      <!-- Hope Ui Design System Css -->
      <link rel="stylesheet" href="./assets/css/hope-ui.min.css?v=2.0.0" />
      
      <!-- Custom Css -->
      <link rel="stylesheet" href="./assets/css/custom.min.css?v=2.0.0" />
      
      <!-- Dark Css -->
      <link rel="stylesheet" href="./assets/css/dark.min.css"/>
      
      <!-- Customizer Css -->
      <link rel="stylesheet" href="./assets/css/customizer.min.css" />
      
      <!-- RTL Css -->
      <link rel="stylesheet" href="./assets/css/rtl.min.css"/>
      <link rel="stylesheet" href="./assets/bootstrap-icons/bootstrap-icons.css">

    <!-- Notificaciones personalizadas -->
      <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        

        .position-absolute {
            position: absolute !important;
        }
    </style>
      
  </head>
  <body class=" ">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body"></div>
      </div>    
    </div>
    <!-- loader END -->
    <?php if(isset($_SESSION["user_id"])):?>
        <aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all ">
            <div class="sidebar-header d-flex align-items-center justify-content-start">
                <a href="./" class="navbar-brand">
                    <!--Logo start-->
                    <!--logo End-->
                    
                    <!--Logo start-->
                    <div class="logo-main">
                        <div class="logo-normal">
                            <svg class=" icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                                <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                                <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                                <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="logo-mini">
                            <svg class=" icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                                <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                                <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                                <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                            </svg>
                        </div>
                    </div>
                    <!--logo End-->
                    
                    
                    
                    
                    <h4 class="logo-title">Sales System</h4>
                </a>
                <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                    <i class="icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </i>
                </div>
            </div>
            <div class="sidebar-body pt-0 data-scrollbar">
                <div class="sidebar-list">
                    <!-- Sidebar Menu Start -->
                    <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                        <!--
                        <li class="nav-item static-item">
                            <a class="nav-link static-item disabled" href="#" tabindex="-1">
                                <span class="default-icon">Home</span>
                                <span class="mini-icon">-</span>
                            </a>
                        </li>
                    -->
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./">
                                <i class="bi bi-house">

                                </i>
                                <span class="item-name">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#personal-menu" role="button" aria-expanded="false" aria-controls="personal-menu">
                                <i class="bi bi-list">

                                </i>
                                <span class="item-name">Personal</span>
                                <i class="right-icon">
                                    <svg class="icon-18" xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </i>
                            </a>
                            <ul class="sub-nav collapse" id="personal-menu" data-bs-parent="#sidebar-menu">
                                <li class="nav-item">
                                    <a class="nav-link " href="./?view=clientes&opt=all">
                                      <i class="icon">
                                           <i class="bi bi-circle"></i>
                                        </i>
                                      <i class="sidenav-mini-icon"> C </i>
                                      <span class="item-name"> Clientes </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="./?view=proveedores&opt=all">
                                      <i class="icon">
                                           <i class="bi bi-circle"></i>
                                        </i>
                                      <i class="sidenav-mini-icon"> P </i>
                                      <span class="item-name"> Proveedores </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#gestion-menu" role="button" aria-expanded="false" aria-controls="gestion-menu">
                                <i class="bi bi-list">

                                </i>
                                <span class="item-name">Gestion</span>
                                <i class="right-icon">
                                    <svg class="icon-18" xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </i>
                            </a>
                            <ul class="sub-nav collapse" id="gestion-menu" data-bs-parent="#sidebar-menu">
                                <li class="nav-item">
                                    <a class="nav-link " href="./?view=productos&opt=all">
                                      <i class="icon">
                                           <i class="bi bi-circle"></i>
                                        </i>
                                      <i class="sidenav-mini-icon"> P </i>
                                      <span class="item-name"> Productos </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="./?view=ventas&opt=all">
                                      <i class="icon">
                                           <i class="bi bi-circle"></i>
                                        </i>
                                      <i class="sidenav-mini-icon"> V </i>
                                      <span class="item-name"> Ventas </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li><hr class="hr-horizontal"></li>
                        <!--<li class="nav-item static-item">
                            <a class="nav-link static-item disabled" href="#" tabindex="-1">
                                <span class="default-icon">Admin</span>
                                <span class="mini-icon">-</span>
                            </a>
                        </li>-->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#sidebar-special" role="button" aria-expanded="false" aria-controls="sidebar-special">
                                <i class="bi bi-gear">

                                </i>
                                <span class="item-name">Administracion</span>
                                <i class="bi bi-chevron-right">
                                    
                                </i>
                            </a>
                            <ul class="sub-nav collapse" id="sidebar-special" data-bs-parent="#sidebar-menu">
                                <li class="nav-item">
                                    <a class="nav-link " href="./?view=users&opt=all">
                                      <i class="icon"><i class="bi bi-circle"></i> </i><i class="sidenav-mini-icon"> U </i><span class="item-name">Usuarios</span>
                                    </a>
                                </li>
                            </ul>
                        </li>                        
                    </ul>
                    <!-- Sidebar Menu End -->        
                </div>
            </div>
            <div class="sidebar-footer"></div>
        </aside>    
        <main class="main-content">
          <div class="position-relative iq-banner">
            <!--Nav Start-->
            <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
              <div class="container-fluid navbar-inner">
                <a href="../dashboard/index.html" class="navbar-brand">
                    <!--Logo start-->
                    <!--logo End-->
                    
                    <!--Logo start-->
                    <div class="logo-main">
                        <div class="logo-normal">
                            <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                                <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                                <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                                <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="logo-mini">
                            <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                                <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                                <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                                <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                            </svg>
                        </div>
                    </div>
                    <!--logo End-->
                    <h4 class="logo-title">LB Hope UI</h4>
                </a>
                <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                    <i class="icon">
                     <svg  width="20px" class="icon-20" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                    </svg>
                    </i>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon">
                      <span class="mt-2 navbar-toggler-bar bar1"></span>
                      <span class="navbar-toggler-bar bar2"></span>
                      <span class="navbar-toggler-bar bar3"></span>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                    <li class="me-0 me-xl-2">

                    </li>

                  <?php
                    $user = UserData::getByID($_SESSION["user_id"]);
                  ?>
                
                    <li class="nav-item dropdown">
                      <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="./assets/images/avatars/01.png" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                        <img src="./assets/images/avatars/avtar_1.png" alt="User-Profile" class="theme-color-purple-img img-fluid avatar avatar-50 avatar-rounded">
                        <img src="./assets/images/avatars/avtar_2.png" alt="User-Profile" class="theme-color-blue-img img-fluid avatar avatar-50 avatar-rounded">
                        <img src="./assets/images/avatars/avtar_4.png" alt="User-Profile" class="theme-color-green-img img-fluid avatar avatar-50 avatar-rounded">
                        <img src="./assets/images/avatars/avtar_5.png" alt="User-Profile" class="theme-color-yellow-img img-fluid avatar avatar-50 avatar-rounded">
                        <img src="./assets/images/avatars/avtar_3.png" alt="User-Profile" class="theme-color-pink-img img-fluid avatar avatar-50 avatar-rounded">
                        <div class="caption ms-3 d-none d-md-block ">
                            <h6 class="mb-0 caption-title"><?php echo $user->nombre;?></h6>
                            <p class="mb-0 caption-sub-title"></p>
                        </div>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                       <!-- <li><a class="dropdown-item" href="../dashboard/app/user-profile.html">Profile</a></li>
                        <li><a class="dropdown-item" href="../dashboard/app/user-privacy-setting.html">Privacy Setting</a></li>
                    -->
                        <!-- <li><hr class="dropdown-divider"></li> -->
                        <li><a class="dropdown-item" href="./?action=access&opt=logout">Cerrar Sesion</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </nav> 

            <?php View::load("index");?>

          <!-- Footer Section Start -->
          <footer class="footer">
              <div class="footer-body">
                  
                  <div class="right-panel">                
                     
                  </div>
              </div>
          </footer>
          <!-- Footer Section End -->   
        </main>
        <!-- Wrapper End-->
        <!-- offcanvas start -->
    <?php else:?>
      
      <div class="wrapper">
          <section class="login-content">
             <div class="row m-0 align-items-center bg-white vh-100">            
                <div class="col-md-6">
                    <?php Core::getFlashes();?>
                    <div class="row justify-content-center">
                      <div class="col-md-10">
                         <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                            <div class="card-body">
                               <a href="../../dashboard/index.html" class="navbar-brand d-flex align-items-center mb-3">
                                  <!--Logo start-->
                                  <!--logo End-->
                                  
                                  <!--Logo start-->
                                  <div class="logo-main">
                                      <div class="logo-normal">
                                          <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                              <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                                              <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                                              <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                                              <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                                          </svg>
                                      </div>
                                      <div class="logo-mini">
                                          <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                              <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                                              <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                                              <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                                              <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                                          </svg>
                                      </div>
                                  </div>
                                  <!--logo End-->
                                                                                  
                                  
                                  <h4 class="logo-title ms-3">Clase</h4>
                               </a>
                               <h2 class="mb-2 text-center">INICIAR SESION</h2>
                               <p class="text-center">INGRESA TUS DATOS PARA INICIAR SESION.</p>
                               <form method="post" action="./?action=access&opt=login">
                                  <div class="row">
                                     <div class="col-lg-12">
                                        <div class="form-group">
                                           <label for="email" class="form-label">Usuario</label>
                                           <input type="text" name="username" required class="form-control" id="username" aria-describedby="username" placeholder=" ">
                                        </div>
                                     </div>
                                     <div class="col-lg-12">
                                        <div class="form-group">
                                           <label for="password" class="form-label">Password</label>
                                           <input type="password" name="password" required class="form-control" id="password" aria-describedby="password" placeholder=" ">
                                        </div>
                                     </div>

                                  </div>
                                  <div class="d-flex justify-content-center">
                                     <button type="submit" class="btn btn-primary">INICIAR SESION</button>
                                  </div>

                               </form>
                            </div>
                         </div>
                      </div>
                   </div>
                   <div class="sign-bg">
                      <svg width="280" height="230" viewBox="0 0 431 398" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <g opacity="0.05">
                         <rect x="-157.085" y="193.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -157.085 193.773)" fill="#3B8AFF"/>
                         <rect x="7.46875" y="358.327" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 7.46875 358.327)" fill="#3B8AFF"/>
                         <rect x="61.9355" y="138.545" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 61.9355 138.545)" fill="#3B8AFF"/>
                         <rect x="62.3154" y="-190.173" width="543" height="77.5714" rx="38.7857" transform="rotate(45 62.3154 -190.173)" fill="#3B8AFF"/>
                         </g>
                      </svg>
                   </div>
                </div>
                <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
                   <img src="./assets/images/auth/01.png" class="img-fluid gradient-main animated-scaleX" alt="images">
                </div>
             </div>
          </section>
      </div>
    <?php endif; ?>

    <script>
        $(document).ready(function () {
            <?php
                Core::getToastr();
            ?>      

        });
    </script>
    

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- Library Bundle Script -->
    <script src="./assets/js/core/libs.min.js"></script>
    
    <!-- External Library Bundle Script -->
    <script src="./assets/js/core/external.min.js"></script>
    
    <!-- Widgetchart Script -->
    <script src="./assets/js/charts/widgetcharts.js"></script>
    
    <!-- mapchart Script -->
    <script src="./assets/js/charts/vectore-chart.js"></script>
    <script src="./assets/js/charts/dashboard.js" ></script>
    
    <!-- fslightbox Script -->
    <script src="./assets/js/plugins/fslightbox.js"></script>
    
    <!-- Settings Script -->
    <script src="./assets/js/plugins/setting.js"></script>
    
    <!-- Slider-tab Script -->
    <script src="./assets/js/plugins/slider-tabs.js"></script>
    
    <!-- Form Wizard Script -->
    <script src="./assets/js/plugins/form-wizard.js"></script>
    
    <!-- AOS Animation Plugin-->
    <script src="./assets/vendor/aos/dist/aos.js"></script>
    
    <!-- App Script -->
    <script src="./assets/js/hope-ui.js" defer></script>

    
    


    
  </body>
</html>