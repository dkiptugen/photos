<main class="col-sm-9 ml-sm-auto col-md-10 pt-5 px-sm-4" role="main">     
<div id="page-wrapper" >
            
        
            <div id="page-inner">
                
               
                
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                             
                           Seller Profile
                             
                             
                             <small>   <?php  if($sellers_details[0]->names==""){ echo strtoupper($sellers_details[0]->fname." ".$sellers_details[0]->lname);}else{ echo strtoupper($sellers_details[0]->names);}?> </small>
                        </h1>
                        
                        
                    </div>
                </div> 
                
				
				<div class="tabbed">
      <input name="tabbed" id="tabbed1" type="radio" checked>
      <section>
        <h1>
          <label for="tabbed1">Seller Details</label>
        </h1>
        <div>
        
		       <div class="row">
			   <div class="col-md-12"> 
                    <div class="card" >
                        <div class="card-header card-title">
                              Seller Bio
                        </div>
			        <div class="card-block">
			          
			  <br/>Full Names :
       <?php  if($sellers_details[0]->names==""){ echo strtoupper($sellers_details[0]->fname." ".$sellers_details[0]->lname);}else{ echo strtoupper($sellers_details[0]->names);}?>  
        <br/>Email : 
                       <?php echo $sellers_details[0]->email;?>     
          <br/>
         Status :
            <?php if(intval($sellers_details[0]->status)==1){echo "Active";}else{echo "Inacive";}?>     
         
			  </div>
			  </div>
			  </div>
			  </div>
		   
        </div>
      </section>
      <input name="tabbed" id="tabbed2" type="radio">
      <section>
        <h1>
          <label for="tabbed2">Submissions</label>
        </h1>
        <div>
             <div class="row">
                <div class="col-md-12"> 
                  <div class="card ">
                        <div class="card-header card-title">
                         Submissions
                        </div>
                     
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            
                                            <th>Publication</th>
                                            
                                            <th>Price</th>
                                               
                                            <th>Status</th>
                                              <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
		<?php 
		$cnt=0;
              
                 foreach($sellers_details  as $mg): 
		         $cnt++;
                  
                        $status="Awaiting Approval";
                    switch (intval($mg->publication_status)){
                       
                        case 0:
                                $status="Awaiting Approval";
                        
                         break;
                        case 1:
                                $status="On sale";
                         
                            break;
                        
                        case 2:
                                $status="Returned";
                            break;
                             case 3:
                                $status="Rejected";
                            break;
                             case 4:
                                $status="Archived";
                            break;
                            
                        
                    }
                  
			?>
                <tr class="<?php if($cnt%2==1){ ?>odd<?php }else{ ?> even<?php } ?>gradeX">
                                            
                                            
                                            <td><?php echo $mg->publication_title; ?></td>
                                            
                                            <td><?php echo $mg->publication_price ;?></td>
                                         
                                             <td><?php echo $status ;?></td>
                                            <td>
                                            
                                             <button class="btn btn-primary"><i class="fa fa-money"></i>Pay</button>
                                           
                                            
                                            </td>
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
      </section>
      <input name="tabbed" id="tabbed3" type="radio">
      <section>
        <h1>
          <label for="tabbed3">Sales</label>
        </h1>
        <div>
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card ">
                        <div class="card-header card-title">
                         Sales
                        </div>
                     
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            
                                            <th>Publication</th>
                                            <th>Edition</th>
                                            <th>Price</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
		<?php 
                        
		 
               $totalamount=0;
                 foreach($sales  as $mg): 
		         $cnt++;
		         
		         $totalamount+=$mg->o_amount;
                  
                    
			?>
                <tr class="<?php if($cnt%2==1){ ?>odd<?php }else{ ?> even<?php } ?>gradeX">
                                            
                                            
                                            <td><?php echo $mg->publication_title; ?></td>
                                            
                                            <td><?php echo $mg->p_edition ;?></td>
                                         
                                             <td><?php echo $mg->o_amount;?></td>
                                             
                                        </tr>
                                        
		<?php endforeach; ?>
		
		<tr class="odd gradeX">
                                            
                                            
                                            <td>TOTAL</td>
                                            
                                            <td> </td>
                                         
                                             <td><?php echo number_format($totalamount,2);?></td>
                                             
                                        </tr>
                                                                           
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
                 
            </div>
        </div>
      </section>
      <input name="tabbed" id="tabbed4" type="radio">
      <section>
        <h1>
          <label for="tabbed4">Payments</label>
        </h1>
        <div>
          Payments
        </div>
      </section>
	  
	  
	   <input name="tabbed" id="tabbed5" type="radio">
      <section>
        <h1>
          <label for="tabbed5">Account Options</label>  
        </h1>
        <div>
           
			    
             
                      
			        
			       <div class="btn-group"> 
			<button   class="btn btn-sm dropdown-toggle" id="changepassword"><i class="fa fa-plus"></i>Change Password</button>
			<button   class="btn btn-sm dropdown-toggle" id="deactivate"><i class="fa fa-plus"></i>Deactivate</button>
		 																 
			</div> 
         
			   
			  
			  
			  
		   </div>
      </section>
  
    </div>
  
   
         </div>
				
	  
            
        </div>
    
    </div>
</main> 