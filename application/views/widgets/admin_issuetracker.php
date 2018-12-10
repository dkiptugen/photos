<main class="col-sm-9 ml-sm-auto col-md-10 pt-5 px-sm-4" role="main">
  <div id="page-wrapper" >
            
            
            
            
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                           Recent Submissions  <small></small>
                        </h1>
                    </div>
                </div> 
                      <?php 
                                if($this->session->userdata("response_message")){
                                ?>
                              <div class="alert alert-warning">
  <strong>Info:</strong>  <?php  echo $this->session->userdata("response_message"); ?>
</div>  
                  <?php
                  }
                  ?>
               
                
                    
                        <?php
                          
                if($issues){
                        ?>
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card ">
                        <div class="card-header card-title">
                          Submission requiring approval <!--<div class="btn-group">
			<button   class="btn btn-primary dropdown-toggle" id="addmagazine"><i class="fa fa-plus"></i>Add  </button>
			  
																						  </ul>
			</div>-->
                        </div>
                     
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th></th>
											 <th>Date</th>
                                            <th>Title</th>
                                             <th>Price</th> 
                                            <th>Submitted by</th>
                                              <th>Email</th>
                                            <th> </th> 
                                             
                                        </tr>
                                    </thead>
                                    <tbody>
		<?php 
               
		$cnt=0;
                $i=1;
              
                 foreach($issues as $u): 
		    $cnt++;
                 $i++;
                   ?>
                                        <tr class="<?php if($cnt%2==1){ ?>odd<?php }else{ ?> even<?php } ?>gradeX">
                                            <td><?php echo $i; ?></td>
											 <td><?php echo $u->publicationsubmission_date; ?></td>  
                                            <td><?php echo $u->publication_title; ?></td>
                                             <td><?php echo $u->publication_price; ?></td>
                                            <td><?php echo  $u->fname . " " . $u->lname; ?></td>
                                            <td><?php echo $u->email ;?></td>
                                          
                                            <td><div class="btn-group">
			<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="caret"></span></button>
			 <ul class="dropdown-menu">
           
                             <li><a href="<?php echo base_url()."issues/".$u->ID."/".$this->merchant_model->slugify($u->publication_title);?> ">View Details</a></li>
			 																			  </ul>
			</div></td>
                                        </tr>
		<?php endforeach; 
                
                ?>
                                                                           
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                         
                        
                    </div>
                    <!--End Advanced Tables -->
                </div>
                
                
                
                
                
            </div>
                 
            <?php
                         }else{
                    ?>
                 <div class="alert alert-info">
                    No more issues here;
                 </div>
                    <?php
                }
                     ?>   
            
        </div>
         <footer> </footer>
    </div>
</main>         