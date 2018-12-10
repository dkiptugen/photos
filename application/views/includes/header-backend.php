<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- stylesheets -->
    <link rel="stylesheet" href="<?=base_url('assets/css/font-awesome.css'); ?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/style.css'); ?>">
	<title>Standard Digital Photos</title>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-9511843-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-9511843-1');
  </script>

  </head>
  
  
  <body ng-controller="mainController">
  
   
    
    <nav class="navbar navbar-expand fixed-top navbar-dark flex-column-sm" style="background:#000d4e;">
     
    
      <a class="navbar-brand display-4" href="<?=site_url(); ?>">Photos</a>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mr-2">
            <a class="nav-link cart-anchor" href="#"><i class="fa fa-shopping-cart"></i> <span class="badge badge-success" id="cartbadge"><? //=$this->cart->total_items(); ?></span></a>
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
         
    </nav>
    
    