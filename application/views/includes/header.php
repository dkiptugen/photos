<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
     <title>Standard Digital Photos</title>
    <link rel="stylesheet" href="<?=base_url('assets/css/font-awesome.css'); ?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/style.css'); ?>">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-9511843-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-9511843-1');
    </script>

  </head>
  <body>
    <nav class="navbar navbar-expand fixed-top navbar-dark flex-column-sm" style="background:#000d4e;">
      <a class="navbar-brand display-4" href="<?=site_url(); ?>">PHOTOS</a>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mr-2">
            <a class="nav-link cart-anchor" href="javascript:;"><i class="fa fa-shopping-cart"></i> <span class="badge badge-success" id="cartbadge"><?=$this->cart->total_items(); ?></span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fa fa-user"></i> My Account
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="<?=site_url("dashboard"); ?>">Dashboard</a>
              <a class="dropdown-item cart-anchor" href="javascript:;">Cart</a>
             <?php 
                if($this->session->userdata("user_logged_in"))
                  {
                    echo '<a class="dropdown-item" href="'.site_url("logout").'">Sign Out</a>';
                  }
                else
                  {
                    echo '<a class="dropdown-item" href="'.site_url("login").'">Login</a>';
                  }
              ?>
            </div>
          </li>
        </ul>
        <!-- <form action="" class="form-inline">
            <label class="sr-only" for="inlineFormInputName2">Name</label>
            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2 mb-sm-0" id="inlineFormInputName2" placeholder="Jane Doe">

            <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>            
            <input type="text" class="form-control form-control-sm  mr-sm-2" id="inlineFormInputGroupUsername2 " placeholder="Username">
          

            <button type="submit" class="btn btn-primary btn-sm">Login</button>
        </form> -->
    </nav>
    <div class="container-fluid">
      <div class="row">
        <nav class="navbar-expand-sm navbar-light col-sm-3 col-md-2 mt-sm-0 pb-0 flex-column sidebar">
          
          <form class="d-flex align-items-center search ">
            <input class="form-control" type="text" placeholder="Search..." aria-label="Search">
            <button class="navbar-toggler  ml-3" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          </form>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav">
              
              <?php
              foreach($nav as $val)
                {
                  echo'
                    <li class="nav-item category">
                      <a class="nav-link" data-id="'.$val->gid.'" data-name="'.$this->assist->slugify(strtolower($val->gname)).'" href="'.site_url("category/".$val->gid."/".$this->assist->slugify(strtolower($val->gname))).'">'.ucwords($val->gname).'</a>
                    </li>';
                }
              ?>
            </ul>
          </div>
        </nav>

        <div id="main" class="w-100">
          <div id="viewz">
            <?php $this->view("modules/".$view); ?>
