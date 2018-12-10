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
               <li class="nav-item">
                  <a href="<?php echo base_url(); ?>forsale" class="nav-link"><i class="fa fa-shopping-cart"></i>&nbsp;For Sale(<?=$this->merchant_model-> countMagazines(); ?>) <div  class="badge badge-primary"  ><i class="fa fa-plus"></i>Add  </div>   
                  </a>    
                  
               
                    </li>
                      <li class="nav-item">
                        <a href="<?php echo base_url(); ?>subscriptions" class="nav-link"><i class="fa fa-list"></i>&nbsp;My Subscriptions</a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>sales" class="nav-link"><i class="fa fa-money"></i>&nbsp;Sales</a>
                    </li>
           
		  
	<?php
    
    if($this->session->userdata("user_type")==1){
    
    ?>
     

                    
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>sellers" class="nav-link"><i class="fa fa-user"></i>&nbsp;Users</a>
                       
                    </li>
                    
                    <?php
                     if($this->merchant_model-> IssuewWaitingAction()>0){
                    ?>
                      <li class="nav-item">  
                              
                           <a href="<?php echo base_url(); ?>issues" class="nav-link"><i class="fa fa-paper-plane"></i>&nbsp;New  <font style="color:red">(<?php echo $this->merchant_model->IssuewWaitingAction(); ?>)</font></a>  
                    </li>
                    <?php    
                    }
                    ?>
                    <li class="nav-item">
                     
                     <a href="<?php echo base_url(); ?>approved" class="nav-link"><i class="fa fa-check"></i>&nbsp;Approved <?php echo "(".count($this->merchant_model->fetchAllApproved()).")"; ?> <?php  if($this->merchant_model->edition_details()>0) { ?><sup style='color:red'>&nbsp;&nbsp; [<?php echo $this->merchant_model->edition_details();  ?>]</sup> <?php }
                     ?> </a>
                    </li>
                      
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>returned" class="nav-link"><i class="fa fa-refresh"></i>&nbsp;Returned <?php echo "(".count($this->merchant_model->fetchAllReturned()).")"; ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>rejected" class="nav-link"><i class="fa fa-minus"></i>&nbsp;Rejected <?php echo "(".count($this->merchant_model->fetchAllRejected()).")"; ?></a>
                    </li>
					
					 <li class="nav-item">
                        <a href="<?php echo base_url(); ?>archived" class="nav-link"><i class="fa fa-archive"></i>&nbsp;Archived <?php echo "(".count($this->merchant_model->fetchAllArchived()).")"; ?></a>
                    </li>
                       
               
    
    
    <?php
    }
    ?>
		  
		  
		  
		  
		  </ul>
          </div> 
		  
		  
        </nav>

        <div id="main" class="w-100">
          <div id="viewz">