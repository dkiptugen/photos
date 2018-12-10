<main class="col-sm-9 ml-sm-auto col-md-10 pt-5 px-sm-4" role="main">     
  <div id="page-wrapper" >
            
            
            
            
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                           Sellers  <small></small>
                        </h1>
                    </div>
                </div> 
                    
               
            <div class="row">
                <div class="col-md-12"> 
                   <div class="card ">
                        <div class="card-header card-title">
                         Users
                        </div>
                     
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Full Names</th>
                                            <th>Email</th>
                                              <th> Roles </th>
                                            <th>Status</th> 
                                              <th> </th> 
                                        </tr>
                                    </thead>
                                    <tbody>
		<?php 
		$cnt=0;
              
                 foreach($sellers->result() as $u): 
		    $cnt++;
                  
                        $status="Seller";
                    switch (intval($u->status)){
                       
                        case 1:
                                $status="Active";
                        
                         break;
                        case 3:
                                $status="Inactive";
                         
                            break;
                        
                        
                    }
			?>
                                        <tr class="<?php if($cnt%2==1){ ?>odd<?php }else{ ?> even<?php } ?>gradeX">
                                            <td><?php echo $u->userID; ?></td>
                                            <td><?php echo $u->names;?></td>
                                            <td><?php echo $u->email ;?></td>
                                              <td><?php echo  $status ;?></td>
                               
                                             <td><?php  echo $status ;?></td>
                                            <td><div class="btn-group">
			<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="caret"></span></button>
			 <ul class="dropdown-menu">
           
                             <li><a href="<?php echo base_url()."seller/".$u->userID."/".$this->merchant_model->slugify($u->names); ?> ">View Details</a></li>
			 																			  </ul>
			</div></td>
                                        </tr>
		<?php endforeach; ?>
                                                                           
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
                
                
                
                
                
            </div>
                 
            
            
        </div>
         <footer> </footer>
    </div>
</main>              