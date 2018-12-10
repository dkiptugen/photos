<main class="col-sm-9 ml-sm-auto col-md-10 pt-5 px-sm-4" role="main">
 
  <div class="page-header">
    <h1 class="font-light">Checkout</h1>
  </div>
  <div class="row mb-5">
    <div class="col-lg-8 mb-4">
      <nav class="navbar navbar-light bg-light justify-content-between mb-3">
       <div class="navbar-text">Choose your payment method</div>
      </nav>
      <div id="accordion" role="tablist">
        <div class="card mb-2">
          <div class="card-header" role="tab" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link btn-block text-left big" id="mpesapay" type="button" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne" data-target="#collapseOne">
                <img src="<?=base_url("assets/img/mpesa.png"); ?>" alt="" style="height: 20px;"> Pay with Mpesa
              </button>
            </h5>
          </div>

          <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              
              <!--<form method="post" class="mpesacheckout">
                <div class="form-row align-items-center">
                  <div class="col-lg-8 py-2" id="phoneNos"></div>
                  <input type="hidden" class="form-control mb-2 mb-sm-0 ordernumber" value="<?="PDS".$this->hmodel->getOrderNo(); ?>" />
                  <input type="hidden" class="form-control mb-2 mb-sm-0 amount" value="<?=$this->cart->total(); ?>" />
                  <div class="col-lg-8" >
                    <label class="sr-only" for="inlineFormInput">Enter Phone Number</label>
                    <input type="text" class="form-control mb-2 mb-sm-0 fnn" id="inlineFormInput" placeholder="Enter Phone Number">
                  </div>               
                  
                  <div class="col-lg-4">
                    <button type="submit" class="btn btn-success btn-block">Make Payment Request</button>
                  </div>
                </div>
              </form>-->
			  <ul>
        <li>Go to M-PESA Menu</li>
        <li>Select <strong>Lipa Na MPesa</strong></li>
        <li>Select <strong>Pay Bill</strong> option</li>
         <li>Enter <strong>505604</strong> as the Business Number</li>
        <li>Enter <strong><?php echo "PDS".$this->hmodel->getOrderNo(); ?></strong> as the Account Number</li>
        <li>In the amount section, enter <strong><?php echo $this->cart->total(); ?></strong></li>
        <li>Enter your M-PESA PIN</li>
        <li>Click <strong>OK</strong></li>
        <li>You will receive an SMS confirming the transaction</li>
        <li>Click <strong>"Confirm"</strong> button below to finish your transaction
    </ul>
	           <div class="col-lg-4">
                    <button  class="btn btn-success btn-block " id="confirmpayment" data-id="<?=$this->hmodel->getOrderNo(); ?>">Confirm</button>
                  </div>

			  
			  
			  
			  
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" role="tab" id="headingTwo">
            <h5 class="mb-0">
              <button class="collapsed btn btn-link btn-block text-left" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne" data-target="#collapseTwo">
                <i class="fa fa-paypal" aria-hidden="true"></i> Pay with PayPal
              </button>
            </h5>
          </div>
          <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
              <?php
                $amount=round($this->cart->total()/100,2);              
                $amount +=round((2.9*$amount)/100,2) + 0.30;
              ?>
                <div class="checkout-btn">
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" accept-charset="utf-8">
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="charset" value="utf-8">
                        <input type="hidden" name="business" value="onlineaccounts@standardmedia.co.ke">
                        <input type="hidden" name="item_name" value="The Standard">
                        <input type="hidden" name="item_number" value="<?="PDS".$this->hmodel->getOrderNo(); ?>">
                        <input type="hidden" name="amount" value="<?=$amount; ?>">
                        <input type="hidden" name="currency_code" value="USD">
                        <input type="hidden" name="notify_url" value="<?=site_url("home/paypalcallback"); ?>">
                        <input type="hidden" name="return" value="<?=site_url("dashboard"); ?>">
                        <input type="hidden" name="cancel_return" value="<?=current_url(); ?>">
                        <input type="hidden" name="bn" value="Business_BuyNow_WPS_SE">

                        <input type="submit" class="btn btn-primary fa fa-paypal" value="Pay with PayPal">

                    </form>

                    <div class="clr"></div>

                </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">ORDER SUMMARY</div>
        <div class="card-body pb-0">
        <table class="table table-sm">
          <tbody>
            <tr>
              <td colspan="2" class="text-muted">Cart sub total</td>
              <td>Ksh <?=number_format($this->cart->total());  ?> </td>
            </tr>
            <tr>
              <td colspan="2" class="text-muted">Discount</td>
              <td>Ksh 0 </td>
            </tr>
            <tr>
              <td colspan="2"><strong>Total</strong></td>
              <td><strong>Ksh <?=number_format($this->cart->total());  ?>  </strong></td>
            </tr>
          </tbody>
        </table>
        </div>
      </div> 
    </div>
  </div>              
</main>