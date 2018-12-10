<main class="col-sm-9 ml-sm-auto col-md-10 pt-5 px-sm-4" role="main">
<div id="page-wrapper" >
            
        
            <div id="page-inner">
                
               
                
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                             
                           Subscriptions
                             
                             
                             <small>(<?php echo count($subs); ?>)</small>
                        </h1>
                        
                        
                    </div>
                </div> 
                
                
                <?php
                if($this->session->userdata("confirmmsg")){
                ?>
                <div class="alert alert-success"> <?php echo $this->session->userdata("confirmmsg");  ?></div>  
                <?php
                }
                ?>
                
                
                
                                
                                 
                  
                  
               
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card">
                         
                        <div class="card-block py-3">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                              <th>Order No.</th>
                                             
                                            <th>Date Made</th>
                                               <th>Amount</th>
                                           <th>Status</th> 
                                              <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
		<?php 
		$cnt=0;
              
                 foreach($subs  as $mg): 
		    $cnt++;
                        
                    $status="Inactive";
                    switch (intval($mg->status)){
              
                case 1:
                    $status="Active";
                    break;
                
                case 0:
               
                    $status="Pending";
                    break;
                
               
                
                default:
            
                 
                    }
                    
                  
			?>
                <tr class="<?php if($cnt%2==1){ ?>odd<?php }else{ ?> even<?php } ?>gradeX">
                                            
                                            <td><?php echo "PDS".$mg->orderid; ?></td>
 
                                            <td><?php echo $mg->datemade ;  ?></td>
                                            <td><?php echo number_format($mg->om,2) ;  ?></td>
                                            <td><?php echo $status ;?></td>
                                            <td>
                                            <?php
                                            
                                            if(intval($mg->status)==1){
                                            ?>
                                                 <button value="<?php echo $mg->orderid; ?>"   onclick="editOperations(16,this.value)" class="btn btn-success btn-link" style="cursor:pointer"><i class="fa fa-download"></i>&nbsp;Download</button>
                                            <!--<a href="<?php echo base_url(); ?>readbook/<?php echo  $mg->o_itemid;  ?>"  class="btn btn-success"><i class="fa fa-book"></i>Read</a>-->
                                            <?php
                                            }
                                            else{?>
                                             <button class="btn btn-success" value="<?php echo $mg->orderid; ?>"   onclick="editOperations(15,this.value)" class="btn btn-primary" style="cursor:pointer"><i class="fa fa-money"></i>&nbsp;Pay Now</button>
                                             <?php
                                            }
                                            ?>
                                            
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
    
    </div>
    
</main>    
    
    
     
  