<?php
class Mpesa
	{
		public $ci;
		public $mpesa;
		public function __construct()
			{
               $this->ci 	 = 	& get_instance();
               $this->ci->load->config("mpesa",TRUE);
               $this->mpesa  =	(object)$this->ci->config->item('mpesa');
			}
		public function telno($tel)
			{
				
				if(substr($tel, 0, 4) === '+254')
					{     
     					$tel=str_replace("+254",254,$tel) ;  
  					}
  				elseif (substr($tel, 0, 1) === '0')
  					{
  						$tel = substr($tel, 1);
  						$tel = (int)"254".$tel;
  					}
  				return $tel;
			}
		public function getAccessKey()
            {
                $url         =  $this->mpesa->Auth_link;
                $curl        = 	curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                $credentials =  base64_encode($this->mpesa->ConsumerKey.':'.$this->mpesa->ConsumerSecret);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $data        =  curl_exec($curl);
                curl_close($curl);  
                // return $data;          
                $d           =  json_decode($data);
                return $d->access_token;
            }
        public function checkout($mssdin,$sumtotal,$accountNumber)
      		{
		        $mssdin			= 	$this->telno($mssdin);
		        $accesstoken 	=	$this->getAccessKey();
		        $shortcode 		=	$this->mpesa->checkout_shortcode;
		        $passkey 		=	$this->mpesa->checkout_passkey;
		        $timestamp 		=	date('YmdHis');
		        $callback 		=	$this->mpesa->checkout_callbackurl;
		        $url 			=  	$this->mpesa->checkout_processlink;
		        $curl 			= 	curl_init();
		        curl_setopt($curl, CURLOPT_URL, $url);
		        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$accesstoken)); //setting custom header
		        $curl_post_data = array(
								          'BusinessShortCode'  =>   $shortcode,
								          'Password'           =>   base64_encode($shortcode.$passkey.$timestamp),
								          'Timestamp'          =>   $timestamp,
								          'TransactionType'    =>   'CustomerPayBillOnline',
								          'Amount'             =>   $sumtotal,
								          'PartyA'             =>   $mssdin,
								          'PartyB'             =>   $shortcode,
								          'PhoneNumber'        =>   $mssdin,
								          'CallBackURL'        =>   $callback,
								          'AccountReference'   =>   $accountNumber,
								          'TransactionDesc'    =>   'payment of goods and services'
								        );

		        $data_string 	= json_encode($curl_post_data);

		        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		        curl_setopt($curl, CURLOPT_POST, true);
		        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		        $curl_response 	= curl_exec($curl);
	        	return $curl_response;
	      	}
	    public function confirmCheckout($checkoutid)
	    	{
	    		$url 			= 	$this->mpesa->checkout_querylink;
	    		$accesstoken 	=	$this->getAccessKey();
	    		$shortcode 		=	$this->mpesa->checkout_shortcode;
		        $passkey 		=	$this->mpesa->checkout_passkey;
		        $timestamp 		=	date('YmdHis');
		        $callback 		=	$this->mpesa->checkout_callbackurl;
	    		$curl 			= 	curl_init();
		        curl_setopt($curl, CURLOPT_URL, $url);
		        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$accesstoken));
		        $curl_post_data = array(
		         
								          'BusinessShortCode' 	=> 	$shortcode,
								          'Password' 			=> 	base64_encode($shortcode.$passkey.$timestamp),
								          'Timestamp' 			=> 	$timestamp,
								          'CheckoutRequestID' 	=> 	$checkoutid
								        );

		        $data_string = json_encode($curl_post_data);
		        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		        curl_setopt($curl, CURLOPT_POST, true);
		        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		        $curl_response = curl_exec($curl);
		        return $curl_response;
	    	}

	}