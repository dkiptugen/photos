<main class="col-sm-9 ml-sm-auto col-md-10 pt-5 px-sm-4" role="main">
  <div id="page-wrapper" >
            
            
            
            
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                             For Sale
                        </h1>
                    </div>
                </div> 
                    
               
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card ">
                        <div class="card-header">
                             Photos <div class="btn-group">
			<button   class="btn btn-success dropdown-toggle" id="addmagazine"><i class="fa fa-plus"></i>Add  </button>
			  
																						  </ul>
			</div>
                        </div>
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Publication</th>
                                            <th>Issue</th>
                                            <th>Price</th>
                                               
                                            <th>Status</th>
                                              <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
		<?php 
		$cnt=0;
              
                 foreach($magazines->result() as $mg): 
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
                                            <td><?php echo $mg->p_circle ;?></td>
                                            <td><?php echo $mg->publication_price ;?></td>
                                            
                                            
                                               
                                             <td><?php echo $status ;?></td>
                                            <td><div class="btn-group">
			<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="caret"></span></button>
			 <ul class="dropdown-menu">
                             <li><a href="<?php echo base_url()."details/".$mg->ID."/".$this->merchant_model->slugify($mg->publication_title); ?>" >Edit</a></li>
                             <li><a href="<?php echo base_url()."details/".$mg->ID."/".$this->merchant_model->slugify($mg->publication_title); ?>">View Details</a></li>
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