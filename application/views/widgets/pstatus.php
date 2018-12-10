<main class="col-sm-9 ml-sm-auto col-md-10 pt-5 px-sm-4" role="main">
  <div id="page-wrapper" >
            
            
            
            
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            <?php echo $title; ?>  
                        </h1>
                    </div>
                </div> 
                    
               
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card ">
                       
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr><th>#</th>
                                            <th>Publication</th>
                                            <th>Issue</th>
                                            <th>Price</th>
                                              
                                              
                                        </tr>
                                    </thead>
                                    <tbody>
		<?php 
		$cnt=0;
              $count=1;
                 foreach($publications as $mg): 
		    $cnt++;
             
             $issues=$this->merchant_model->unapproved_edition($mg->ID);  
             if($issues>0){
              $ac="style='background:#F5CBA7'";
        
             }else{
             
             $ac="";
             } 
                       
			?>
                                        <tr class="<?php if($cnt%2==1){ ?>odd<?php }else{ ?> even<?php } ?>gradeX" <?php echo $ac; ?> >
										    <td><?php echo $count; ?></td>
                                            <td><?php echo $mg->publication_title; ?></td>
                                            <td><?php echo $mg->p_circle ;?></td>
                                            <td><?php echo $mg->publication_price ;?></td>
                                            
                                            
                                               
                                             
                                            <td><div class="btn-group">
			<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="caret"></span></button>
			 <ul class="dropdown-menu">
                             <li><a href="<?php echo base_url()."details/".$mg->ID."/".$this->merchant_model->slugify($mg->publication_title); ?>" >Edit</a></li>
                             <li><a href="<?php echo base_url()."details/".$mg->ID."/".$this->merchant_model->slugify($mg->publication_title); ?>">View Details</a></li>
			 																			  </ul>
			</div></td>
                                        </tr>
		<?php

		 $count++;
		endforeach; ?>
                                                                           
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                
                
                
                
                
            </div>
               


 
			   
            
            
        </div>
         <footer> </footer>
    </div>
</main>             