</div>
        </div>

      </div>
    </div>
    <div class="modal fade" id="logintab">
        <div class="modal-dialog" role="document" >
            <div class="modal-content" id="logincontent">
                <?php
        $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
        );
    ?>
                <div class="card signin">
            <div class="card-header">Login</div>
            <div class="card-body">
             <div class="card-block p-4">
                  <form id="loginform" method="post" class="form-horizontal" role="form" action="<?php echo base_url() ?>authenticate">
                 
                   <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                   <div class="form-group">
                     <label for="username">Email address</label>
                     <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" name="username" id="username" value="" placeholder="username or email">
                   </div>
                   <div class="form-group">
                     <label for="exampleInputPassword1">Password</label>
                     <input id="login-password" type="password" class="form-control" name="password" id="password" placeholder="password">
                   </div>
                   <div class="form-group">
                     <div class="form-check">
                       <label class="form-check-label">
                       <input id="login-remember" type="checkbox" name="remember" value="1"> Remember Password</label>
                     </div>
                   </div>
                   <button id="btn-login" type="submit" class="btn btn-success">Login  </button>
                 </form>
                 <div class="mt-3">
                   <p class="small"><a href="javascript:;" id="forgotbtn">Forgot Your Password?</a></p>
                   <hr>
                   <!-- <p class="small text-muted">Registerd Via Mobile App?<a href="generatepwd.html"> Request Password here</a></p> -->
                   <p class="small text-muted">Don't have an account?<a href="javascript:;" id="signupbtn"> Sign up here.</a></p>
                    <p id="login-message" style="color:#FF0000;font-weight: bolder"> <?php echo $this->session->userdata("msg"); ?></p>
                 </div>
             </div>
            </div>
          </div> 
        <!--   Register -->
          <div class="card signup " style="display:none;">
            <div class="card-header">Sign Up</div>
            <div class="card-body">
              <form id="signupform" class="form-horizontal" role="form">
                                
                <div id="signupalert" style="display:none" class="alert alert-danger">
                    <p>Error:</p>
                    <span></span>
                </div>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <div class="form-group">
                  <label for="exampleInputEmail1" class="small">Email address</label>
                  <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" >
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="small">First Name</label>
                  <input class="form-control" id="exampleName" type="text" aria-describedby="firt name" placeholder="First Name"  name="firstname">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="small">Last Name</label>
                  <input class="form-control" id="exampleName2" type="text" aria-describedby="Last Name" placeholder="Last Name" name="lastname" >
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1" class="small">Password</label>
                  <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password" name="pass1">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1" class="small">Repeat Password</label>
                  <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Repeat Password" name="pass2">
                </div>
                
                <button id="btn-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
              </form>
              <div class="mt-3">
                <p class="small"><a href="javascript:;" id="forgotbtn">Forgot Your Password?</a></p>
                <hr>
                <p class="small text-muted">Already have an account?<a href="javascript:;" id="loginbtn"> Login</a></p>
                <p class="small text-muted">Read our<a href="#"> Terms and Conditions</a></p>
              </div>
            </div>
            </div>
        </div>
    </div>


      
    

    <!-- Optional JavaScript -->  
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
     
   <!--  <script src="<?=base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <script src="<?=base_url('assets/js/main.js'); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <?php $this->view("includes/js"); ?>
  </body>
</html>