<main class="col-sm-9 ml-sm-auto col-md-10 pt-5 px-sm-4" role="main">
<div id="page-wrapper" >
            
        
            <div id="page-inner">
                
               
                
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                             
                           Estimated Sales
                             
                             
                              
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
                                        <tr>
                                            
                                            <th>Book / Magazine</th>
                                            <th>Edition</th>
                                            <th>Unit Price</th>
                                            <th>Copies Solid</th>
                                             
                                            <th>Totals</th>
                                            
                                              
                                        </tr>
                                    </thead>
                                    <tbody>
	 <?php 
                        
		 
               $totalamount=0;
                $cnt=0;
                 foreach($sales  as $mg): 
		         $cnt++;
		         
		         $totalamount+=$mg->osum;
                  
                    
			?>
                <tr class="<?php if($cnt%2==1){ ?>odd<?php }else{ ?> even<?php } ?>gradeX">
                                            
                                            
                                            <td><?php echo $mg->publication_title; ?></td>
                                            
                                            <td><?php echo $mg->p_edition ;?></td>
                                             <td><?php echo $mg->o_amount ;?></td>
                                               <td><?php echo $mg->countsum ;?></td>
                                             
                                             <td><?php echo $mg->osum;?></td>
                                             
                                        </tr>
                                        
		<?php endforeach; ?>
		
		<tr class="odd gradeX">
                                            
                                            
                                            <td>TOTAL</td>
                                            
                                            <td> </td>
                                             <td> </td>
                                             
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
    
    </div>
</main>