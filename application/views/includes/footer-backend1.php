</div>
        </div>

      </div>
    </div>
    

      
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     
    
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables/dataTables.bootstrap.js"></script>
     <script src="<?php echo base_url(); ?>assets/js/bootstrapValidator.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom-scripts.js"></script>   
    <?php //$this->view("includes/js"); ?>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
    <script type="text/javascript">
        $(document).on("click","#signupbtn",function(){
            $(".signin").attr("style","display:none");
            $(".signup").removeAttr("style");
        });
        $(document).on("click","#loginbtn",function(){
            $(".signup").attr("style","display:none");
            $(".signin").removeAttr("style");
        });
    </script>
    <div class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
 
      </div>
      <div class="modal-footer">
         <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Save</button>-->
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  </body>
</html>