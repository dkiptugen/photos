<main class="col-sm-9 ml-sm-auto col-md-10 pt-5 px-sm-4" role="main">     
   <div id="page-wrapper" >
            
            
            
            
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                           <?php echo $issues[0]->publication_title; ?> <small></small>
                               <input type="hidden" id="magid" value="<?php echo  $issues[0]->ID; ?>"/>
                        </h1>
                    </div>
                </div> 
                    
               
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header">
                            Options&nbsp;<div class="btn-group">
                                <button value="9"  onclick="editOperations(this.value,0)"   class="btn btn-success dropdown-toggle"  ><i class="fa fa-check"></i>Approve  </button>
			  
																						  </ul>
			</div> 
                            <div class="btn-group">
                                <button value="10"  onclick="editOperations(this.value,0)"    class="btn btn-warning dropdown-toggle"  ><i class="fa fa-refresh"></i>Return</button>
			  
																						  </ul>
			</div>
                            <div class="btn-group">
                                <button value="11"  onclick="editOperations(this.value,0)"    class="btn btn-danger dropdown-toggle"  ><i class="fa fa-minus"></i>Reject</button>
			  
																						  </ul>
			</div> 
                        </div>
                        <div class="card-block">
						
						
						
	<div class="tabbed">
      <input name="tabbed" id="tabbed1" type="radio" checked>
      <section>
        <h1>
          <label for="tabbed1">Book / Magazine Name</label>
        </h1>
        <div>
        
		    <p>   <?php echo $issues[0]->publication_title; ?></p>
		   
        </div>
      </section>
      <input name="tabbed" id="tabbed2" type="radio">
      <section>
        <h1>
          <label for="tabbed2">Overview</label>
        </h1>
        <div>
            <p>   <?php echo $issues[0]->descr; ?></p> 
        </div>
      </section>
      <input name="tabbed" id="tabbed3" type="radio">
      <section>
        <h1>
          <label for="tabbed3">Price / Unit</label>
        </h1>
        <div>
           <p>   <?php echo $issues[0]->publication_price; ?></p>
        </div>
      </section>
      <input name="tabbed" id="tabbed4" type="radio">
      <section>
        <h1>
          <label for="tabbed4">Issue</label>
        </h1>
        <div>
           <p>   <?php echo $issues[0]->p_circle; ?></p>
        </div>
      </section>
	  
	  
	   <input name="tabbed" id="tabbed5" type="radio">
      <section>
        <h1>
          <label for="tabbed5">Seller[s]</label>  
        </h1>
        <div>
           <p>   <?php echo $issues[0]->fname." ". $issues[0]->lname; ?></p>
      </section>
  
    </div>
  
   
         </div>
                    </div>
                   
                </div>
                
                
                
                
                
            </div>
                 
                
                 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                          Editions <small></small>
                          
                        </h1>
                    </div>
                </div> 
            
                                     <div class="card-block">
   
                <?php
                
                 $editionsinthis=$this->merchant_model->listEditions(intval($issues[0]->ID));
                
                if($editionsinthis){
                    ?>
                                           <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										 <th> </th>
                                            <th>Edition</th>
                                            <th>Submission Date</th>
                                            
                                               
                                            <th>Status</th>
                                              
                                        </tr>
                                    </thead>
                                    <tbody>
		<?php 
		$cnt=0;
              
                 foreach($editionsinthis as $mg): 
		    $cnt++;
                  
                        $status="Awaiting Approval";
                    switch (intval($mg->p_status)){
                       
                        case 0:
                                $status="Awaiting Approval";
                        
                         break;
                        case 1:
                                $status="On sale";
                         
                            break;
                        
                        case 2:
                                $status="Rejected";
                            break;
                        
                    }
			?>
                                        <tr class="<?php if($cnt%2==1){ ?>odd<?php }else{ ?> even<?php } ?>gradeX">
										
										 <td> 
                                                <img height="100px" class="img" src="<?php echo base_url()."assets/pdfs/".$mg->cover; ?>"/>
                                            </td>
                                            <td><?php echo $mg->p_edition; ?></td>
                                            <td><?php echo $mg->psubmission_date ;?></td>
                                            
                                            
                                            
                                               
                                             <td><?php echo $status ;?></td>
                                            
                                        </tr>
		<?php endforeach; ?>
                                                                           
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                                         
                                         <?php
                }
                ?>
                                     </div>
            
        </div>
         <footer> </footer>
    </div>
</main>          