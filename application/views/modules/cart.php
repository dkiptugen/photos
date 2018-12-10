<main class="col-sm-9 ml-sm-auto col-md-10 pt-5 px-sm-4" role="main">
 
  <div class="page-header">
    <h1 class="font-light">Shopping Cart</h1>
  </div>
  <div class="row mb-5">
    <div class="col-lg-8 mb-4">
      <nav class="navbar navbar-light bg-light justify-content-between mb-3">
        <a class="navbar-text">You have <?=$this->cart->total_items(); ?> item<?=($this->cart->total_items()!=1)?"s":NULL; ?> in your cart</a>
        <button <?=($this->cart->total_items()===0)?"disabled":NULL; ?> class="btn btn-success my-2 my-sm-0 check-out"  >Check out</button>
      </nav>
      <?php
      foreach($this->cart->contents() as $key => $value)
          {
            // var_dump($value["options"]);
            echo'
              <div class="card mb-3">
                <div class="card-body">
                  <button type="button" class="close removeCart" data-dismiss="alert" aria-label="Close" data-id="'.$key.'">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   <div class="row">
                     
                   <div class="col-3 col-md-2">
                     <a href="#single-magazine"><img class="img-fluid" src="'.base_url("assets/pdfs/".$value["options"]["cover"]).'" alt="magazines-title"></a>
                   </div>
                     <div class="col-9 col-md-10">
                       <h5 class="card-title">'.$value['name'].'</h5>
                       <p class="card-text small">Author: <a href="#" >'.$value["options"]['author'].'</a></p>
                       <p class="card-text small">Publisher: <a href="#" >'.$value["options"]['publisher'].'</a></p>
                        <p class="card-text small">Edition: <a href="#" >'.$value["options"]['edition'].'</a></p>
                       <p class="font-light" style="font-size: 1.5rem;">ksh
                       '.$this->cart->format_number($value['subtotal']).'</p>
                     </div>
                   </div>          
                </div>
              </div>';
          }
          // var_dump($this->session->userdata());
          ?>
      <nav class="navbar navbar-light bg-light justify-content-between mb-3">
        <a class="navbar-text">You have <?=$this->cart->total_items(); ?> item<?=($this->cart->total_items()!=1)?"s":NULL; ?> in your cart</a>
        <button <?=($this->cart->total_items()===0)?"disabled":NULL; ?> class="btn btn-success my-2 my-sm-0 check-out" >Check out</button>
       
      </nav>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">Your cart total</div>
        <div class="card-body">
        <p class="card-text display-4">ksh <?=number_format($this->cart->total()); ?></p>
        <button class="btn btn-success btn-lg btn-block check-out" <?=($this->cart->total_items()===0)?"disabled":NULL; ?> >checkout</button>
         <a class="btn btn-secondary mt-2 btn-lg btn-block clearCart" type="button">Empty Cart</a>
        </div>
      </div> 
    </div>
  </div>              
</main>