<main class="col-sm-9 ml-sm-auto col-md-10 pt-5 px-sm-4" role="main">     
<div id="page-wrapper" >
            
        
            <div id="page-inner">
                
                <input id="moderator-reasons" value="<?php echo $magazinesdetails[0]->moderator_remarks; ?>" type="hidden"/>
                <?php
                $itemstatus=intval($magazinesdetails[0]->publication_status);
                
            switch($itemstatus){
                case 1:
                       $action=false;
                       $reason="Status : Reviewed & approved";
					    $disabled="" ;
                    break;
                
                case 0:
                    $disabled="disabled";
                    $action=true;
                    $reason="Status : Waiting Review";  
                    break;
                
                case 2:
                    $action=true;
                
                   $disabled="" ;
                    $reason="Status : Returned. Please <button   onclick='editOperations(this.value, 0)' value='12'  class='btn  btn-link'><i class='fa fa-edit'></i>&nbsp;Review</button> and resubmit";
                    break;
                
                case 3:
                    $action=true;
                 $disabled="" ;
                    $reason="Status : Rejected. Please <button   onclick='editOperations(this.value, 0)' value='12'  class='btn  btn-link'><i class='fa fa-edit'></i>&nbsp;Review</button> and resubmit";
                    break;
                      case 4:
                    $action=true;
                    $disabled="disabled" ;
                    $reason="Status : Archived.  <button   onclick='editOperations(this.value, 0)' value='12'  class='btn  btn-danger'><i class='fa fa-unlock'></i>&nbsp;Unarchive Now</button> Note: This would require Moderator approval";
                    break;
                
                default:
            }
            
            if(!$action){
                $dialog="alert-success";
            }
            else{
                 $dialog="alert-danger";
            }
                ?>
            
  <div class="alert  <?php echo $dialog; ?>">
  <strong><?php  echo $reason;?></strong>  
</div> 

 <?php 
			 if($magazinesdetails[0]->moderator_remarks){
			 ?>
<div class="alert alert-info">
 Moderator Remarks: <?php  echo $magazinesdetails[0]->moderator_remarks;?>  
</div> 
			 <?php
			 }
			 ?>


 
                
                
                
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            <input type="hidden" id="magTitle" value="<?php echo $magazinesdetails[0]->publication_title; ?>"/>
                             <input type="hidden" id="magid" value="<?php echo $magazinesdetails[0]->ID; ?>"/>
                                <input type="hidden" id="magdetails" value="<?php echo $magazinesdetails[0]->descr; ?>"/>
								 <input type="hidden" id="magAuthors" value="<?php echo $magazinesdetails[0]->authors; ?>"/>
								  <input type="hidden" id="magPublisher" value="<?php echo $magazinesdetails[0]->publisher; ?>"/>  
								   
								
                           <?php echo $magazinesdetails[0]->publication_title; ?>  
                             
                             
                             <small>(<?php echo count($editions); ?>) Editions <?php if($this->session->userdata("user_type")==1){?><font style="font-size:17px;color:orangered">(Provided by <?php $seller=$this->merchant_model->seller_details($magazinesdetails[0]->merchant_id); if($seller[0]->names){echo $seller[0]->names;}else{ echo $seller[0]->email;} ?> )</font><?php } else{}?></small>
                        </h1>
                        
                        
                    </div>
                </div> 
                
                
                
                
                
                
                 <div class="row">
                    <div class="col-md-12"> 
                    <div class="card ">
                       
                        <div class="card-block">
                            <div class="table-responsive">
                                
                                



								
								
								
								
								
								<div class="tabbed">
      <input name="tabbed" id="tabbed1" type="radio" checked>
      <section>
        <h1>
          <label for="tabbed1">Title</label>
        </h1>
        <div>
        
		  <?php echo $magazinesdetails[0]->publication_title; ?> <div class="btn-group">
             <button value="5"  <?php echo $disabled; ?>  onclick="editOperations(this.value,0)"  class="btn  btn-link dropdown-toggle"  ><i class="fa fa-edit"></i> Edit </button>&nbsp;
			 																			  </ul>
			</div> 
       <div class="row">
                    <div class="col-md-12">
       <br class="clearboth"/>
          
                    </div>
       </div>  
		   
        </div>
      </section>
      <input name="tabbed" id="tabbed2" type="radio">
      <section>
        <h1>
          <label for="tabbed2">Genre</label>
        </h1>
        <div>
           <?php echo $magazinesdetails[0]->gname; ?> <div class="btn-group">
             <button value="14"  <?php echo $disabled; ?> onclick="editOperations(this.value,0)"  class="btn btn-link dropdown-toggle"  ><i class="fa fa-edit"></i> Edit </button>&nbsp;
			 																			  </ul>
			</div> 
                                  
                                   
       <div class="row">
                    <div class="col-md-12">
       <br class="clearboth"/>
         
                    </div>
       </div>  
        </div>
      </section>
      <input name="tabbed" id="tabbed3" type="radio">
      <section>
        <h1>
          <label for="tabbed3">Issue / Edition</label>
        </h1>
        <div>
           <?php echo $magazinesdetails[0]->p_circle; ?> <div class="btn-group">
             <button value="6"  <?php echo $disabled; ?> onclick="editOperations(this.value,0)"  class="btn btn-link dropdown-toggle"  ><i class="fa fa-edit"></i> Edit </button>&nbsp;
			 																			  </ul>
			</div> 
                                  
                                   
       <div class="row">
                    <div class="col-md-12">
       <br class="clearboth"/>
         
                    </div>
       </div>
        </div>
      </section>
      <input name="tabbed" id="tabbed4" type="radio">
      <section>
        <h1>
          <label for="tabbed4">Price</label>
        </h1>
        <div>
               <?php  echo $magazinesdetails[0]->publication_price; ?>
            <div class="btn-group">
             <button value="7"    <?php echo $disabled; ?>  onclick="editOperations(this.value,<?php echo $magazinesdetails[0]->publication_price; ?>)"  class="btn  btn-link dropdown-toggle"  ><i class="fa fa-edit"></i> Change </button>&nbsp;
			 		To change offered price,Please contact Admin at Standard Digital																	  </ul>
			</div> 
                    
       <div class="row">
                    <div class="col-md-12">
       <br class="clearboth"/>
          
                    </div>
       </div>
        </div>
      </section>
	  
	   <input name="tabbed" id="tabbed9" type="radio">
      <section>
        <h1>
          <label for="tabbed9">Author[s]</label>  
        </h1>
        <div>
		     
			 <?php 
			 if($magazinesdetails[0]->authors){
			 ?>
		
            <?php echo $magazinesdetails[0]->authors; ?> <div class="btn-group">
             <button value="17"  <?php echo $disabled; ?>  onclick="editOperations(this.value,0)"  class="btn  btn-link dropdown-toggle" ><i class="fa fa-edit"></i> Edit </button>&nbsp;
			 																			 
			</div> 
			<?php  
			 }
			 ?>
              
               
       <div class="row">
                    <div class="col-md-12">
       <br class="clearboth"/>
         
          </div>
       </div>
        </div>
      </section>
	  
	  
	   <input name="tabbed" id="tabbed5" type="radio">
      <section>
        <h1>
          <label for="tabbed5">Overview</label>  
        </h1>
        <div>
                    <?php echo $magazinesdetails[0]->descr; ?> <div class="btn-group">
             <button value="8"  <?php echo $disabled; ?>  onclick="editOperations(this.value,0)"  class="btn  btn-link dropdown-toggle" ><i class="fa fa-edit"></i> Edit </button>&nbsp;
			 																			  </ul>
			</div> 
              
               
       <div class="row">
                    <div class="col-md-12">
       <br class="clearboth"/>
         
                    </div>
       </div>
        </div>
      </section>
	  
	  
	  
	   <input name="tabbed" id="tabbed6" type="radio">
      <section>
        <h1>
          <label for="tabbed6">publication date</label>  
        </h1>
        <div>
		
		 <?php 
			 if($magazinesdetails[0]->publicationmonth){
			 ?>
            <?php echo $magazinesdetails[0]->publicationmonth."/".$magazinesdetails[0]->publicationyear; ?> <div class="btn-group">
             <button value="18"  <?php echo $disabled; ?>  onclick="editOperations(this.value,0)"  class="btn  btn-link dropdown-toggle" ><i class="fa fa-edit"></i> Edit </button>&nbsp;
			 																			 
			</div> 
			<?php
			 }
			 ?>
              
               
       <div class="row">
                    <div class="col-md-12">
       <br class="clearboth"/>
         
                    </div>
       </div>
        </div>
      </section>
	   <input name="tabbed" id="tabbed7" type="radio">
      <section>
        <h1>
          <label for="tabbed7">Publisher</label>  
        </h1>
        <div>
		
		 <?php 
			 if($magazinesdetails[0]->publisher){
			 ?>
             <?php echo $magazinesdetails[0]->publisher; ?> <div class="btn-group">
             <button value="19"  <?php echo $disabled; ?>  onclick="editOperations(this.value,0)"  class="btn  btn-link dropdown-toggle" ><i class="fa fa-edit"></i> Edit </button>&nbsp;
			 																			  
			</div> 
			<?php
			}
			?>
              
               
       <div class="row">
                    <div class="col-md-12">
       <br class="clearboth"/>
         
                    </div>
       </div>
        </div>
      </section>
	   <input name="tabbed" id="tabbed8" type="radio">
      <section>
        <h1>
          <label for="tabbed8">Country</label>    
        </h1>
        <div>
             <?php echo $this->merchant_model->country_name(trim($magazinesdetails[0]->publicationcountry))."(".$magazinesdetails[0]->publicationcountry.")"; ?> <div class="btn-group">
             <button value="20"  <?php echo $disabled; ?>  onclick="editOperations(this.value,0)"  class="btn  btn-link dropdown-toggle" ><i class="fa fa-edit"></i> Edit </button>&nbsp;
			 																			 
			</div> 
              
               
       <div class="row">
                    <div class="col-md-12"> 
       <br class="clearboth"/>
         
                    </div>
       </div>
        </div>
      </section>
  
    </div>
  
								
								
 

			   
              </div>               
                            
                        </div>
                  
                </div>
            </div>
</div></div><br/>
                   
                
                
                
                
                
                
                
                <?php if($this->session->userdata("edition_process")){
                ?>
                   <div class="alert alert-info">
  <strong><?php  echo $this->session->userdata("edition_process"); ?></strong>  
</div>  
      <?php
      }
      ?>          
                
                
                
                  
               
            <div class="row mt-2">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header">
                            Options 
                             
                            <div class="btn-group">
                                <button    <?php echo $disabled; ?>  class="btn btn-sm btn-danger"   onclick="editOperations(this.value, 0)" value="13"><i class="fa fa-archive"></i>Archive </button>
                               </div>
			 <div class="btn-group"> 
			<button   <?php echo $disabled; ?>   class="btn btn-sm btn-success" id="addedition"><i class="fa fa-plus"></i>Add edition </button>
			  
																						  </ul>
			</div>
                        </div>
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                             <th> </th>
                                            <th>Edition</th>
                                            <th>Date Submitted</th>
                                            <th>Sales (copies)</th>
                                               
                                           <th>Status</th> 
                                              <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
		<?php 
		$cnt=0;
              
                 foreach($editions  as $mg): 
		    $cnt++;
                        
                    $status="Inactive";
                    switch (intval($mg->p_status)){
                       
                        case 0:
                                $status="Inactive";
                        
                         break;
                        case 1:
                                $status="On sale";
                         
                            break;
                        
                        case 2:
                                $status="Suspended";
                            break;
                            
                             break;
                        
                        case 4:
                                $status="Archived";
                            break;  
                        
                        
                    }
                        
			?>
                                        <tr class="<?php if($cnt%2==1){ ?>odd<?php }else{ ?> even<?php } ?>gradeX">
                                            
                                            <td><button value="<?php echo base_url()."assets/pdfs/".$mg->cover; ?>" onclick="viewMagazine(this.value)" class="btn bg-warning">View Cover</button></td>
                                            <td><?php echo $mg->p_edition; ?></td>
                                            <td><?php echo $mg->psubmission_date ;?></td>
                                            <td><?php   ?></td>
                                            
                                            
                                               
                                             <td><?php echo $status ;?></td>
                                            <td><div class="btn-group">
			<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="caret"></span></button>
			 <ul class="dropdown-menu">
                             <li><a href="<?php echo base_url()."details/".$this->merchant_model->slugify($magazinesdetails[0]->publication_title)."/".$mg->p_id."/".$this->merchant_model->slugify($mg-> p_edition); ?>" >Edit</a></li>
                             <li><a href="<?php echo base_url()."details/".$this->merchant_model->slugify($magazinesdetails[0]->publication_title)."/".$mg->p_id."/".$this->merchant_model->slugify($mg-> p_edition); ?>">View Details</a></li>
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
    
    </div>
</main>