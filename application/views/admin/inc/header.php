<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Admin Panel</title>

    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/images/fav/fav1.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>assets/images/fav/fav2.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/fav/fav3.png">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .fa-angle-left:before {
            content: "\f104";
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        Welcome, <strong>Admin</strong>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo base_url() . 'admin/login/logout'; ?>" class="dropdown-item">
                            Logout
                        </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo base_url(); ?>" class="brand-link bg-white">
                <span class="brand-text ml-5"><strong>Dnectar Admin</strong></span>
            </a>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="<?php echo base_url() . 'admin/home/index'; ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview <?php echo (!empty($mainModule) && $mainModule == 'Category') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Categories
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo base_url() . 'admin/category/create'; ?>" class="nav-link <?php echo (!empty($mainModule) && $mainModule == 'Category' && !empty($subModule) && $subModule == 'CreateCategory') ? 'active' : '' ?>">
                                    <i class="far fa-circle"></i>
                                    <p>Add Categories</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url() . 'admin/category/index'; ?>" class="nav-link <?php echo (!empty($mainModule) && $mainModule == 'Category' && !empty($subModule) && $subModule == 'ViewCategory') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Categories</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview <?php echo (!empty($mainModule) && $mainModule == 'Article') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Articles
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo base_url() . 'admin/article/create'; ?>" class="nav-link <?php echo (!empty($mainModule) && $mainModule == 'Article' && !empty($subModule) && $subModule == 'CreateArticle') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Article</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url() . 'admin/article/index'; ?>" class="nav-link <?php echo (!empty($mainModule) && $mainModule == 'Article' && !empty($subModule) && $subModule == 'ViewArticle') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Article</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">