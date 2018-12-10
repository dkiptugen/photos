<main class="col-sm-9 ml-sm-auto col-md-10 pt-5 px-sm-4" role="main">     
<div id="page-wrapper" >
            
        
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            <input type="hidden" id="magTitle" value="<?php echo $magazinesdetails[0]->publication_title; ?>"/>
                             <input type="hidden" id="editionTitle" value="<?php echo $magazinesdetails[0]->p_edition; ?>"/>
                             <input type="hidden" id="magid" value="<?php echo $magazinesdetails[0]->ID; ?>"/>
                             <input type="hidden" id="eid" value="<?php echo $magazinesdetails[0]->p_id; ?>"/>
                                <input type="hidden" id="descr" value="<?php  echo $magazinesdetails[0]->edition_descr; ?>"/>
                                
                           <?php echo $magazinesdetails[0]->publication_title; ?>   <small><?php echo   $magazinesdetails[0]->p_edition; ?>  </small>
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
               
               
               
            <div class="row" >
                <div class="col-md-12"> 
                    <div class="card">
                    
                    
                        <div class="card-header card-title">
                        
                        
                        <?php
    
    if($this->session->userdata("user_type")==1){
    
    ?>
     
                        
                        
                             Options
                             
                             <?php
                             
                             if(intval($magazinesdetails[0]->p_status)==1){
                             ?>
       
			<div class="btn-group">  
                                            
			 <button   class="btn  btn-sm btn-danger" id="archiveedition"><i class="fa fa-archive"></i>&nbsp;Deactivate edition </button>
			  
																						   
			</div>
			<?php
			}
			else{
			?>
			
			    <div class="btn-group">  
                                            
			 <button   class="btn  btn-sm btn-success" id="unarchiveedition"><i class="fa fa-shopping-cart"></i>&nbsp;Put on Sale </button>
			  
																						   
			</div>  
			
			  
			
			<?php
			}
			
			}else{  
			if(intval($magazinesdetails[0]->p_status)==1){
			echo "This edition is On Sale";
			}else{
			echo "<font style='color:red'>Moderator will review this edition before its put on sale</font>";
			}
			
			}
			?>
                       
                       
                       
                        </div>
                        
                        
                        <br/>
                        
                        
                        
                        <div class="card-block">
                            
                          
  
							
				 	
                      <!--  <div id="exTab1" class="container">
                     
                                
         <ul  class="nav nav-pills">  
			<li class="active">
        <a   href="#1a">Cover page</a>
			</li>
			<li ><a   href="#2a" data-toggle="tab">Edition</a>
			</li>
			<li  ><a   href="#3a" data-toggle="tab"> Description</a>
			</li>
  		<li ><a   href="#4a" data-toggle="tab">Pdf file</a>
			</li>
		</ul>

			<div class="tab-content clearfix">
			  <div class="tab-pane active" id="1a"> 
                              <br/>
       <img class="img-responsive" style="float: left" src="<?php echo base_url()."assets/pdfs/".$magazinesdetails[0]->cover; ?>"/> <br class="clearfix"/>
    
      
       <div class="row">
                    <div class="col-md-12">
       <br class="clearboth"/>
         <div class="btn-group">
                                          <button value="1"  onclick="editOperations(this.value,0)"   class="btn  btn-link" id="editcover"><i class="fa fa-camera"></i>&nbsp;Change </button>&nbsp;
			 																			  </ul>
			</div> 
                    </div>
       </div>
         
         
         
         
				</div>
				<div class="tab-pane" id="2a">
                                  <br/>
        <?php  echo $magazinesdetails[0]->p_edition; ?>
                                  
                                   
       <div class="row">
                    <div class="col-md-12">
       <br class="clearboth"/>
         <div class="btn-group">
                                          
		<button value="2"  onclick="editOperations(this.value,0)"   class="btn  btn-link dropdown-toggle" id="editedit"><i class="fa fa-edit"></i>Edit Edition </button>&nbsp;
			 																			  </ul>
			</div> 
                    </div>
       </div>
		</div>
        <div class="tab-pane" id="3a">
           <br/>
           <?php  echo $magazinesdetails[0]->edition_descr; ?>       
                    
       <div class="row">
                    <div class="col-md-12">
       <br class="clearboth"/>
         <div class="btn-group">
                                          <button  value="3"  onclick="editOperations(this.value,0)"  class="btn  btn-link dropdown-toggle" id="editdescr"><i class="fa fa-edit"></i>Edit description </button>&nbsp;
			 																			  </ul>
			</div> 
                    </div>
       </div>       
        </div>
          <div class="tab-pane" id="4a">
            <br/>
            <a href="<?php echo base_url()."assets/pdfs/".$magazinesdetails[0]->pdf; ?>">pdf</a>
              
               
       <div class="row">
                    <div class="col-md-12">
       <br class="clearboth"/>
         <div class="btn-group">
             <button value="4"  onclick="editOperations(this.value,0)"  class="btn  btn-link dropdown-toggle" id="editfile"><i class="fa fa-edit"></i> Upload new file </button>&nbsp;
			 																			  </ul>
			</div> 
                    </div>
       </div>
	</div>
			</div>
 	
			
  </div>-->  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <div class="tabbed">
      <input name="tabbed" id="tabbed1" type="radio" checked>
      <section>
        <h1>
          <label for="tabbed1">Cover Page</label>
        </h1>
        <div>  
            <img class="img-responsive"  style="float: left;width:240px;" src="<?php echo base_url()."assets/pdfs/".$magazinesdetails[0]->cover; ?>"/> <br class="clearfix"/>
    
      
       <div class="row">
                    <div class="col-md-12">
       <br class="clearboth"/>
         <div class="btn-group">
                                          <button value="1"  onclick="editOperations(this.value,0)"   class="btn  btn-link" id="editcover"><i class="fa fa-camera"></i>&nbsp;Change </button>&nbsp;
			 																			  </ul>
			</div> 
                    </div>
       </div>
         
		   
		   
        </div>
      </section>
      <input name="tabbed" id="tabbed2" type="radio">
      <section>
        <h1>
          <label for="tabbed2">Edition</label>
        </h1>
        <div>
               <?php  echo $magazinesdetails[0]->p_edition; ?>
                                  
                                   
       <div class="row">
                    <div class="col-md-12">
       <br class="clearboth"/>
         <div class="btn-group">
                                          
		<button value="2"  onclick="editOperations(this.value,0)"   class="btn  btn-link dropdown-toggle" id="editedit"><i class="fa fa-edit"></i>Edit Edition </button>&nbsp;
			 																			  </ul>
			</div> 
                    </div>
       </div>
        </div>
      </section>
      <input name="tabbed" id="tabbed3" type="radio">
      <section>
        <h1>
          <label for="tabbed3">Description</label>
        </h1>
        <div>
            <?php  echo $magazinesdetails[0]->edition_descr; ?>       
                    
       <div class="row">
                    <div class="col-md-12">
       <br class="clearboth"/>
         <div class="btn-group">
                                          <button  value="3"  onclick="editOperations(this.value,0)"  class="btn  btn-link dropdown-toggle" id="editdescr"><i class="fa fa-edit"></i>Edit description </button>&nbsp;
			 																			  </ul>
			</div> 
                    </div>
       </div>
        </div>
      </section>
      <input name="tabbed" id="tabbed4" type="radio">
      <section>
        <h1>
          <label for="tabbed4">Photo (HD)</label>
        </h1>
        <div>
             <img src="<?php echo base_url()."assets/pdfs/".$magazinesdetails[0]->pdf; ?>"></img>
              
               
       <div class="row">  
                    <div class="col-md-12">
       <br class="clearboth"/>
         <div class="btn-group">
             <button value="4"  onclick="editOperations(this.value,0)"  class="btn  btn-link dropdown-toggle" id="editfile"><i class="fa fa-edit"></i> Upload new file </button>&nbsp;
			 																			  </ul>
			</div> 
                    </div>
       </div>
        </div>
      </section>
  
    </div>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
                            
                        
                            
                        </div>
                    </div>
                    
                </div>
                
                
                
                
                
            </div>
                 
            
            
        </div>
         
    </div>
</main>  