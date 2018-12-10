<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant  extends CI_Controller {
 
    public function __construct() {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE); //default db
        $this->load->helper("url");
		$this->load->library('user_agent');
        $this->load->library("pagination");
        $this->load->helper('form');
        $this->load->model('merchant_model');
        date_default_timezone_set('Africa/Nairobi');
       // $this->output->enable_profiler(FALSE);
        
        //$this->is_logged_in();     
    }

    public function index() {
      
    }
	public function approved(){  
    
        $this->is_logged_in();
        $this->is_Admin();
        $data['publications']=$this->merchant_model->fetchAllApproved();
		$data['title']="Approved";
        
        $data['content']="widgets/pstatus";  
                
        $this->load->view('template', $data);
   
    }
	public function returned(){  
    
        $this->is_logged_in();
        $this->is_Admin();
        $data['publications']=$this->merchant_model->fetchAllReturned();
		$data['title']="Returned";
        
        $data['content']="widgets/pstatus";  
                
        $this->load->view('template', $data);
   
    }
		public function rejected(){  
    
        $this->is_logged_in();
        $this->is_Admin();
        $data['publications']=$this->merchant_model->fetchAllRejected();
		$data['title']="Rejected";
        
        $data['content']="widgets/pstatus";  
                
        $this->load->view('template', $data);
   
    }
		public function archived(){  
    
        $this->is_logged_in();
		$this->is_Admin();
        
        $data['publications']=$this->merchant_model->fetchAllArchived();
		$data['title']="Archived";
        
        $data['content']="widgets/pstatus";  
                
        $this->load->view('template', $data);
   
    }
	
    public function forsale(){
    
        $this->is_logged_in();
        
        $data['magazines']=$this->merchant_model->fetchMagazines();
        
        $data['content']="widgets/dash";
                
        $this->load->view('template', $data);
        
        
    
    }
    
    public function dashboard(){
    
        $this->is_logged_in();
        
       /* $data['magazines']=$this->merchant_model->fetchMagazines();
        
        $data['content']="widgets/dash";
                
        $this->load->view('template', $data);*/
        
        $this->mysubscriptions();
    
    }
    
    public function seller_details($userID){
          
         $this->is_logged_in();
                               
         $data['sellers_details']=$this->merchant_model->seller_details($userID); 
         $data['sales']=$this->merchant_model->getSellerSales($userID);
         $data['content']="widgets/sellers_details";
         $this->load->view('template', $data);
        
    }
    public function sales(){
     
       $this->is_logged_in();
     
       $data['sales']=$this->merchant_model->getSellerSales(false);
        $data['content']="widgets/sales";
         $this->load->view('template', $data);
        
    
    }
    public function getAccessKey()
      {
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        $credentials = base64_encode('pWWBSC9kMrQAILyZjiDQU3PcqAaj42fc:CzCgppD25CfHCGNP');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data= curl_exec($curl);
        curl_close($curl);
        // echo APPPATH;
        $d=json_decode($data);
       return $d->access_token;
      }
    
    public function new_checkout()
      {
        // echo number_format(trim($_GET['sumtotal']),2);
        $accesstoken=$this->getAccessKey();
        $shortcode="174379";
        $passkey="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        $timestamp=date('YmdHis');
        $mssdin=trim($_REQUEST['phonenumber']);
        $sumtotal=trim($_REQUEST['sumtotal']);
        $callback=trim(site_url('merchant/callback'));
        //echo $callback;
        $accountNumber=trim($_REQUEST['ordernumber']);
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$accesstoken)); //setting custom header


        $curl_post_data = array(
          //Fill in the request parameters with valid values
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
          'TransactionDesc'    =>   'payment of goods and services '
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r(json_decode($curl_response));
        echo "<br />";
        sleep(10);
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$accesstoken)); //setting custom header


        $curl_post_data = array(
          //Fill in the request parameters with valid values
          'BusinessShortCode' => $shortcode,
          'Password' => base64_encode($shortcode.$passkey.$timestamp),
          'Timestamp' => $timestamp,
          'CheckoutRequestID' => json_decode($curl_response)->CheckoutRequestID
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
      //  print_r($curl_response);

        //echo $curl_response;

        echo "<br />".$curl_response;
      }
    
    public function mysubscriptions(){
         
          $this->is_logged_in();
          $data['subs']=$this->merchant_model->mysubscriptions(); 
          $data['content']="widgets/subscriptions";
          $this->load->view('template', $data);
        
    }
    public function new_callback()
      {
          $data=file_get_contents("php://input");
            file_put_contents(APPPATH."logs/mpesa.log","\n weuoewoeweioiw",FILE_APPEND);
           
      }
     public function sellers() {
  
     
       $this->is_logged_in();
       if($this->session->userdata("user_type")==1){ 
        $data['sellers']=$this->merchant_model->fetchSellers();
        
        $data['content']="widgets/sellers";
                
        $this->load->view('template', $data);
       }
       else{
           redirect("dashboard");
       }
        
    }
       
    function getissue($ID=null){
         $this->is_logged_in();                   
         $data['issues']=$this->merchant_model->unresolvedIssues($ID);
         $data['content']="widgets/thisissue";
                
        $this->load->view('template', $data);
    }
   function issues(){
        $this->is_logged_in();
         $tracker=false;
         $data['issues']=$this->merchant_model->unresolvedIssues($tracker);
                             
         $data['content']="widgets/admin_issuetracker";
                
         $this->load->view('template', $data);
        
       
   }
    function magazinesdetails($magid){
        
          $this->is_logged_in();                  
          $data['magazinesdetails']=$this->merchant_model->magazinesdetails($magid);
          $data['editions']=$this->merchant_model->listEditions($magid);
          $data['content']="widgets/mag_details";    
          $this->load->view('template', $data);
        
    }
    function  edition($e1=null){
            
          $this->is_logged_in();             
         $e1=intval(trim($this->uri->segment(3,0)));
         
         $data['magazinesdetails']=$this->merchant_model->edition($e1);                   
          $data['content']="widgets/thisedition";    
          $this->load->view('template', $data);
          
          
        
    }
    
 function localizePhoneNumber($phonenumber){
 
      $local_phoneNumber=0;
 
  if(substr($phonenumber, 0, 4) === '+254'){
     
     $local_phoneNumber=str_replace("+254",0,$phonenumber) ;
  
  }
  else if(substr($phonenumber, 0, 3) === '254'){
      
      $local_phoneNumber=str_replace("254",0,$phonenumber) ;
  }
  else{
       $local_phoneNumber=$phonenumber;
  }
 
 return  $local_phoneNumber;
 
 }   
    
    
    
function checkout(){
      
ini_set("soap.wsdl_cache_enabled", "0");   
$mssdin="254728283148";//trim($_GET['phonenumber']);
$sumtotal=10; //trim($_GET['sumtotal']);
$accountNumber="PDS10";//trim($_GET['ordernumber']);

$this->merchant_model->AddNewNumber($this->localizePhoneNumber($mssdin));  // Add number

$userId="Order Number PDS".$accountNumber;//intval($this->session->userdata("admin_id"));
$item= $accountNumber;
$merchant_id = 505604;//  Replace with your Mercant Id
$merchant_transaction_id= rand(1, 10000000);
$passkey = "ed09387cf2a3dad2acf1b634e3a51091177f1a055f22b154acb5d2f96bf03a72"; //Replace with your Passkey;
$date=new DateTime;
$timestamp= $date->getTimestamp(); 
$password  = base64_encode(hash("sha256",$merchant_id. $passkey . $timestamp)); 
$callb ='https://www.standardmedia.co.ke/magazines/callback' ;
$callbmethod= "GET" ; 
$client = new SoapClient("https://safaricom.co.ke/mpesa_online/lnmo_checkout_server.php?wsdl",array('trace' =>1));
$client->__setLocation("https://safaricom.co.ke/mpesa_online/lnmo_checkout_server.php");

    $header=new CheckOutHeader();
    $header->MERCHANT_ID=$merchant_id;
    $header->PASSWORD=$password;
    $header->TIMESTAMP=$timestamp;
    $param1=array("MERCHANT_TRANSACTION_ID"=>$merchant_transaction_id,"REFERENCE_ID"=>$userId,"MSISDN"=>$mssdin,"AMOUNT"=>$sumtotal,"ENC_PARAMS"=>$item,"CALL_BACK_URL"=>$callb,"CALL_BACK_METHOD"=>$callbmethod,"TIMESTAMP"=>$timestamp);
    
    try{
    
     $head = new SoapHeader('tns:ns','CheckOutHeader',$header,false);
     $client->__setSoapHeaders($head);
     $result=$client->processCheckOut($param1);
 
  if($result->RETURN_CODE=="00"){
     
       
      $message=$result->CUST_MSG;
     
      /******************Confirm stuff*******************/
      $conf=new transactionConfirmRequest();
      $conf->TRX_ID=$result->TRX_ID;
      $conf->MERCHANT_TRANSACTION_ID=$merchant_transaction_id;
      $param0=new SoapParam($conf,"transactionConfirmRequest");
      $confirm= $client->__soapCall('confirmTransaction',array("transactionConfirmRequest"=>$param0));   
  
      /******************Confirm stuff*******************/
      
      if($confirm->RETURN_CODE=="00"){
     
           $trx_id=$confirm->TRX_ID;
           $mid=$confirm->MERCHANT_TRANSACTION_ID;
        
            header('Content-type: application/json'); 
            
             $data=array("trx_id"=>$trx_id,"mid"=>$mid,"msg"=>$message);
             
            echo json_encode($data);
 
            exit(); 
              
  
      }
       else{
           
       }
  
    
      
       
  }
  else{
       $message=$result->CUST_MSG;
  }
   
}
 catch (SoapFault $fault){
   
     
       echo $fault->faultcode."<br/>faultstring:".$fault->faultstring;
 }
 
    
  }
  
  
  
  function archiveedition(){
	
	$this->is_logged_in();
        $this->is_Admin();
	         $eid=$_GET['eid'];  
	        
	         $a=$_GET['action'];
	     
            $result=$this->merchant_model->archiveedition($eid,$a);
        
              
            header('Content-type: application/json'); 
 
            echo json_encode(array("id"=>$result));
 
            exit();   
             	
		
	}
    
    
    
    
	function getpurchaseditems($orderid){
	
            $result=$this->merchant_model->getpurchaseditems($orderid);
        
              
            header('Content-type: application/json'); 
 
            echo json_encode($result);
 
            exit(); 
             	
		
	}
    function getorders($orderid){
  
    
            $result=$this->merchant_model->getorders($orderid);
        
              
            header('Content-type: application/json'); 
 
            echo json_encode($result);
 
            exit(); 
             
            }
    
   
    
    public function confirmPayment($orderID){
    
    
          $result=$this->merchant_model->confirmPayment($orderID);
          
          if($result==1){
            $this->session->set_flashdata('confirmmsg', 'Payment Received. Lets get to reading');
          }
       
           header('Content-type: application/json'); 
 
            echo json_encode(array("id"=>$result));
 
            exit(); 
    }
    
    public function updateOrder($orderID){
    
          $result=$this->merchant_model->updateOrder($orderID);
               
           header('Content-type: application/json'); 
 
            echo json_encode(array("id"=>$result));
 
            exit(); 
    
    }
    public function createOrder($array=null){
                             
        $itemid=array(7,3,4,2);
        $amount=array(1000.00,200.00,3000.00,500.00);
        $resp=$this->merchant_model->createOrder($itemid,$amount) ;                    
        echo $resp;
        
        
        
    }
    
     public function readbook($bookID){
       
          error_reporting(~E_ALL);
          ini_set("display_errors", 0);
          
          $this->is_logged_in();
            
          $bookDetails=$this->merchant_model->readbook($bookID); 
          
          if($bookDetails){

            $filepath=$bookDetails[0]->pdf;
            
          header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        exit;
          
          }else{
          
          redirect("dashboard");
          }
          
     }
    
    
    
     function logout() {                    
        $admin_id = $this->session->userdata("admin_id");
        $username = $this->session->userdata('username');
        $usertype = $this->session->userdata('user_type');
        $user_logged_in= $this->session->userdata('user_logged_in');
        $user = $this->session->userdata('user');
        $this->session->sess_destroy();
         redirect('login');
    }
function is_Admin(){
	   $user = $this->session->userdata('user_type');
        if ($user==1) {
              return true;
        }else{
         
         redirect('dashboard');
         }
}
    function is_logged_in() {
        $user = $this->session->userdata('user');
        if ($user) {
              return true;
        }else{
         
         redirect('login');
         }
         
    }
    
     function authenticate() {
          //var_dump($this->input->post());
          $email=trim($this->input->post("username"));
          $password=trim($this->input->post("password"));
         $query = $this->merchant_model->validate($email,$password);
        if ($query) {
            $query1 = $this->merchant_model->get_user($email);
            foreach ($query1->result() as $row) {
                   $username = $row->username;
                if ($username == "") {
                    $username = $row->fname . " " . $row->lname;
                } elseif ($username == "") {
                    $username = $row->email;
                }
                $user = array('username' => $username,
                    'email' => $row->email,
                    'admin_id' => intval($row->userID),
                     'user_type' => intval($row->usertype),  
                    'user_logged_in' => TRUE,
                    'user' => 'user'
                );
            }
            $this->session->set_userdata($user);
                             
                               redirect('/');
                             
        } else {
                  $this->session->set_flashdata('msg', 'Incorrect Username or password!');
                             
            redirect('login');
                             
        }
    }
    
     function  auth(){
             
                  if( $this->session->userdata('user')) {
                      redirect("/");
                  }  else{          
          $data['content']="widgets/login";    
          $this->load->view('loginTemplate',$data);
                             
                  }
    }
	
	 public function register()
      {
        // var_dump($this->input->post());
        $this->load->helper('string');
        $authkey= random_string('alpha', 5);
        if($this->input->post())
          {
            if($this->input->post("pass1") == $this->input->post("pass2"))
              {
                $data=array(
                              "userID"=>NULL,
                              "username"=>$this->input->post("email"),
                              "names"=>ucwords($this->input->post("firstname")." ".$this->input->post("lastname")),
                              "fname"=>$this->input->post("firstname"),
                              "lname"=>$this->input->post("lastname"),
                              "email"=>$this->input->post("email"),
                              "password"=>hash("MD5",$authkey.$this->input->post("pass2")),
                              "status"=>1,
                              "usertype"=>0,
                              "auth_key"=>$authkey
                            );
                  $this->db->insert("users",$data);
                  if($this->db->affected_rows()>0)
                    {
                      $this->session->set_flashdata('msg', 'Account added successfully'); 
                                     
                    }
                  else
                    {
                      $this->session->set_flashdata('msg', 'Account could not be added now or already exists ');
                    }
              }
            else
              {
                $this->session->set_flashdata('msg', 'password Missmatch');
              }
            redirect('login','refresh');
          }
      }        
    	
            
    public function country_autoload(){
             
			 $result=$this->merchant_model->country_autoload();
        
             header('Content-type: application/json'); 
 
            echo json_encode($result);
 
            exit();  

	}	
    public function  genre_autoload(){
        
       $result=$this->merchant_model->genreType();
        
         header('Content-type: application/json'); 
 
            echo json_encode($result);
 
            exit();  
        
    }
    function publication_autoload(){
                             
        $result=$this->merchant_model->publication_autoload();
        
         header('Content-type: application/json'); 
 
            echo json_encode($result);
 
            exit(); 
    }
        function addMagazine(){
            
			$publication=trim($this->input->get('publication') );
           $type=  trim($this->input->get('type') );
           $price=  trim($this->input->get('price')  );
           $descr=  trim($this->input->get('descr')  );
            $genre=  trim($this->input->get('genre')  );
             $author=  trim($this->input->get('authors')  );
             $publishdate=  trim($this->input->get('publishdate')  );
             $publisher=  trim($this->input->get('publisher')  );
             $yob=  trim($this->input->get('yob')  );
             $country=  trim($this->input->get('country')  );
           
           $check=$this->merchant_model->add_magazine($publication,$type,$price,$descr,$genre,$author,$publishdate,$publisher,$yob,$country);
           
           
        
            header('Content-type: application/json'); 
 
            echo json_encode(array('id'=>$check));
 
            exit();
          
        }
        
        
        function updatetext($ID){
                  
				    $mediatype=intval(trim($this->input->post('mediatype')));
					
					if($mediatype==18){
						
						 $docname=$this->input->post('pubmonth')."-".$this->input->post('pubyear');
					}else{
						
						 $docname=$this->input->post('docname');
					}
				  
				    $resp=$this->merchant_model->updatemedia($ID,$docname,$mediatype);  
					
                             
                    // $resp=$this->merchant_model->updatemedia($ID,$this->input->post('docname'),$this->input->post('mediatype'));    
                           
                         if($resp){
                      
                         $message="Update successfully";
                 
                     }
                   else{
                 
                    $message="Error Occured. Please try again";
                   }     
             
             $this->session->set_flashdata('response_message', $message);
             header('Location:'.  base_url().$resp[1]);  
                             
            
        }
        
        
     function updatemedia($ID){
      
      $config['upload_path'] ="./assets/pdfs/";  
      $config['allowed_types'] ='pdf|jpg|png|jpeg';
      $config['max_size']  = '0';
      $config['max_width']  = '0';
      $config['max_height']  = '0';
      
      $this->load->library('upload');
      
      $this->upload->initialize($config);
 
      $this->load->library('image_lib');
                             
     $upload = $this->upload->do_upload("doc1");
        
        if($upload){
                             
         $data = array('upload_data' => $this->upload->data());
                             
          $newdocname=rand(5,10000000)."_".$data['upload_data']['file_name']; 
                         
                         $config['image_library'] = 'GD2';
                         $config['source_image'] = $config['upload_path'].$data['upload_data']['file_name'];
                         $config['create_thumb'] = FALSE;   
                         $config['quality'] = 100;
                             
                         $config['new_image'] = base_url()."assets/pdfs/".$newdocname;
                         $this->image_lib->initialize($config);
                      
                         rename($config['upload_path'].$data['upload_data']['file_name'],$config['upload_path'].$newdocname);
                        
                         
                           $resp=$this->merchant_model->updatemedia($ID,$newdocname,$this->input->post('mediatype'));  
                           
                         if($resp){
                      
                         $message="Document updated successfully";
                         
                             
                             
                     }
             else{
                 
                    $message="Error Occured. Please try again";
             }     
                             
        } else{
             
                             
          $message=$this->upload->display_errors();
                             
                             
                             
        }
                             
       $this->session->set_flashdata('response_message', $message);
       header('Location:'.  base_url()."details/".$resp[1]);  
                             
                             
                             
                             
           
                             
                             
             
     }
        
        
        
     function ajax($ID){
   
      $config['upload_path'] ="./assets/pdfs/";  
      $config['allowed_types'] ='pdf|jpg|png|jpeg';
      $config['max_size']  = '0';
      $config['max_width']  = '0';
      $config['max_height']  = '0';
      
      $this->load->library('upload');
      
      $this->upload->initialize($config);
     
	chmod("./assets/pdfs/", 0777);   
      
      $r=1;
      
        for($k=1;$k<=2;$k++){
  
     $upload = $this->upload->do_upload("doc".$k);
        
        if($upload){
            
            $r++;
            
             $data = array('upload_data' => $this->upload->data());
          
                             
                           
                       $newdocname=rand(5,10000000)."_".$data['upload_data']['file_name'];
							 
							   
                         rename($config['upload_path'].$data['upload_data']['file_name'],$config['upload_path'].$newdocname);
						  
						    
							 $config['source_image'] =FCPATH."assets/pdfs/".$newdocname;
							 
							  $this->load->library('image_lib');
				  $config['image_library'] = 'gd2';    
						  if($k==1){
							  
                           
                           /* $this->load->library('image_lib');
							$config['image_library'] = 'gd2';	*/									  
                                                           
                                                         // $config['source_image'] =FCPATH."assets/pdfs/".$newdocname;// $config['upload_path'].$data['upload_data']['file_name'];
                                                          $config['create_thumb'] = FALSE;
                                                          $config['quality'] = 100;
                                                          $config['width'] = '494';
                                                          $config['height'] = '330';
                                                          $config['maintain_ratio'] = FALSE;
                                                          $config['new_image'] = FCPATH."assets/pdfs/".$newdocname;
														  $this->image_lib->resize();
														 
 									  
				    $config['wm_type']          = 'overlay';
					$config['wm_overlay_path']  =FCPATH."assets/js/main-watermark.png";
					$config['wm_opacity']       = '50';
					$config['wm_vrt_alignment'] = 'middle';  
					$config['wm_hor_alignment'] = 'center';
					$this->load->library('image_lib',$config);  
					$this->image_lib->initialize($config); 
                    $this->image_lib->watermark();		
 
						  }
						  else if($k==2){    
 
                   $this->image_lib->clear();  
 
  		  
				   $this->load->library('image_lib');
				  $config['image_library'] = 'gd2';  
							   
                    /*$config['wm_text'] = 'Copyright 2018 - Standard Digital';
                    $config['wm_type'] = 'text';
                    $config['wm_font_size'] = '14';
                    $config['wm_font_color'] = '#FFFFFF';    
                    $config['wm_vrt_alignment'] = 'bottom';
                    $config['wm_hor_alignment'] = 'center';
                    $config['wm_padding'] = '0';
					
					 
					 
                    $this->load->library('image_lib',$config);
					$this->image_lib->initialize($config);
                    $this->image_lib->watermark();*/
					
					
					      
                                                         // $config['source_image'] =FCPATH."assets/pdfs/".$newdocname;// $config['upload_path'].$data['upload_data']['file_name'];
                                                          $config['create_thumb'] = FALSE;
                                                          $config['quality'] = 100;
                                                           
                                                          $config['maintain_ratio'] = FALSE;
                                                          $config['new_image'] = FCPATH."assets/pdfs/".$newdocname;
														 
														 
 									  
				    $config['wm_type']          = 'overlay';
					$config['wm_overlay_path']  =FCPATH."assets/js/main-watermark.png";
					$config['wm_opacity']       = '50';
					$config['wm_vrt_alignment'] = 'bottom';  
					$config['wm_hor_alignment'] = 'right';
					$this->load->library('image_lib',$config);  
					$this->image_lib->initialize($config); 
                    $this->image_lib->watermark();		
 
 
					 	
							   

							 
						  }							 
														
														
														
														
                          
                             
                         switch ($k){
                             case 1:
                                   $cover=$newdocname;
								   
                                 break;
                             case 2:
                                  $pdf=$newdocname;
                                 break;
                             
                             default :
                         }
                             
                             
        } else{
             
            $r--;
            $error=$this->upload->display_errors();
             echo $error;exit();  
              $this->session->set_flashdata('edition_process', "Error Occured. Edition was NOT added".$error);              
             header('Location:'.  base_url()."details/".$ID."/".$this->merchant_model->slugify($this->input->post("slugtitle")));  
                                           
        }
        
       }
                             
       if($r==3){
                             
                             
           if($this->merchant_model->addEdition($pdf,$this->input->post("descr"),date('Y-m-d h:i:s'),$this->input->post("edition"),$ID,$cover)){
                       
                         $error=1;
                          $this->session->set_flashdata('edition_process', "Success. Edition was added");
                         header('Location:'.  base_url()."details/".$ID."/".$this->merchant_model->slugify($this->input->post("slugtitle")));  
                         
                     }
             else{
                 
                 $error=2;
                 
                   $this->session->set_flashdata('edition_process', "Error Occured. Edition was NOT added".$error);
             }
       }else{
           
           $error=4; 
            $this->session->set_flashdata('edition_process', "Error Occured. Edition was NOT added".$error); 
       }
         
                   
            
       
        
        
                             
    
       
       }
       
       
}

class CheckOutHeader{
    
    public $MERCHANT_ID;
    public $PASSWORD;
    public $TIMESTAMP;
}

class ProcessCheckOutRequest{
     
        public $MERCHANT_TRANSACTION_ID;
        public $REFERENCE_ID;
        public $MSISDN;
        public $AMOUNT;
        public $ENC_PARAMS;
        public $CALL_BACK_URL;
        public $CALL_BACK_METHOD;
        public $TIMESTAMP;
        
}
 
class transactionConfirmRequest{
   
        public $TRX_ID;
        public $MERCHANT_TRANSACTION_ID;
}

class transactionStatusRequest{
    
        public $TRX_ID;
        public $MERCHANT_TRANSACTION_ID;
        
}