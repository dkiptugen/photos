

</div>
        </div>

      </div>
    </div>
    

      
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php /*base_url('assets/js/jquery.router.js'); */ ?>"></script> 
    <script src="<?php /* base_url('assets/bower_components/popper.js/dist/umd/popper.min.js'); */ ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables/dataTables.bootstrap.js"></script>
     <script src="<?php echo base_url(); ?>assets/js/bootstrapValidator.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom-scripts2.js?<?=date("Ydm"); ?>"></script>
    <script src="<?=base_url('assets/js/main.js'); ?>"></script>   
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