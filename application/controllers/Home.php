<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
	{
		public $data;
		public function __construct()
			{
				parent::__construct();
				$this->load->model("home_model","hmodel");
                $this->load->model("merchant_model","mmodel");
				$this->data["nav"]=$this->hmodel->getNav();
				$this->load->library("cart");
				$this->cart->product_name_rules = "\.\:\-_\"\' a-zA-Z0-9";
			}
		public function index()
			{
				$this->data["view"]         =   "home";
				$pag                        =	$this->assist->page(current_url(),$this->hmodel->ourproducts(10000000)->num_rows(),9,1);
				$this->data["link"] 		=	$pag->links;
                $this->data["homeproducts"] =   $this->hmodel->ourproducts($pag->vpp,$this->input->get("page"))->result();
				
				$this->load->view('structure',$this->data);
			}
		public function category($id,$name)
			{
				$this->data["category"]     =   $this->hmodel->category($id,$name)->result();
				$this->data["view"]         =   "category";
                $this->load->view('structure',$this->data);
			}
		public function preview($id)
			{
				$this->data['preview']      =   $this->hmodel->preview($id);
                if($this->data['preview']->publication_type==1)
                    {
                        $this->data["rates"]=   $this->hmodel->getRates($this->data['preview']->publication_id);
                    }
				$this->data["related"]      =   $this->hmodel->related($this->data['preview']->genre,$id,8);
				$this->data["view"]         =   "preview";
                $this->load->view('structure',$this->data);
			}		 
        public function addtocart()
        	{
        		$this->cart->product_name_rules = "\.\:\-_\"\' a-z0-9";
        		$this->cart->product_name_safe = FALSE;
        		// var_dump($this->input->post());
    			$j    = $this->hmodel->getPublication($this->input->post('id'));
        		$data = array(
				        'id'        => $this->input->post('id'),
				        'qty'       => 1,
				        'price'     => (int)$this->input->post('price'),
				        'name'      => str_replace("'","&acute;",$this->input->post('title')),
				        'noofdays'  => $this->input->post("period"),
				        'options'   => array(
					        	                'edition' => str_replace("'","&acute;",$j->p_edition),
					        	                "cover"=>$j->cover,
					        	                "author"=>str_replace("'","&acute;",$j->authors),
					        	                "publisher"=>str_replace("'","&acute;",$j->publisher)
				        	                )
					);
				$this->cart->insert($data);
				// var_dump($this->cart->contents());
        	}
        public function is_bought($id)
            {
                $this->output->set_output($this->hmodel->is_bought($id));
            }
        public function removefromcart()
        	{
                $this->cart->remove($this->input->post("id"));
        	}
        public function empty_cart()
        	{
        		$this->cart->destroy();        
    		}
        public function countCart()
        	{
        		$this->output->set_output($this->cart->total_items());
        	}
        public function viewCart()
        	{
        		$this->load->view("modules/cart");
        	}
        public function checkout()
            {
                if(isset($_SESSION["admin_id"]))
                    {
                        if(!isset($_SESSION["Order-".$this->session->userdata("admin_id")]))
                            {
                                $this->hmodel->createorder();
                                $this->session->set_userdata('Order-'.$this->session->userdata("admin_id"),TRUE);
                            }
                        $items=$this->createorder();
                        foreach ($items as $item)
                            {
                                $this->hmodel->createOrderValues($item["rowid"],$item["itemid"],$item["amount"],$item["days"]);
                            }  
                    } 
                $this->data["ordernumber"]  =   "PDS".$this->hmodel->getOrderNo(); 
                //$this->empty_cart();            
                $this->data["view"] =   "checkout";
                $this->load->view('structure',$this->data);
            }
        public function createOrder()
            {
                $x=0;
                foreach($this->cart->contents() as $key => $value)
                    {    
                        $data[$x]["rowid"]  =   $key;       
                        $data[$x]["itemid"] =   $value['id'];
                        $data[$x]["amount"] =   $value['subtotal'];
                        $data[$x]["days"]   =   ($value['noofdays']=="infinity")?NULL:$value['noofdays'];
                        $x++;
                    } 
                return @$data;
            }
        public function showNo()
            {
                $data=$this->hmodel->getPhoneNos();
                if($data!==FALSE)
                    {
                        foreach($data as $value)
                            {
                                echo '<label class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input phoneno" data-phone="'.$value.'" name="radbt">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">'.$value.'</span>
                                      </label>';
                            }
                    }
            }
        public function getRate($paperid)
            {
                $x=NULL;
                if(isset($_SESSION["admin_id"]))
                    {
                        $data=$this->hmodel->getInrate($paperid);
                    }
                else
                    {
                        $data=$this->hmodel->getAvRate($paperid);
                    }
                for($i=1;$i<=5;$i++)
                    {
                        $type=($data >= $i)?"fa-star bg-gold":"fa-star-o bg-grey";
                        $x .= '<span data-id="'.$i.'" class="star fa '.$type.'" data-paperid="'.$paperid.'"></span>';
                    }
                    return $x;
            }
        public function printRate($paperid)
            {
              $this->output->set_output($this->getRate($paperid));
            }
        public function rate()
            {
                $this->hmodel->rateproduct();
            }
        public function download($paperid)
            {
                $this->load->helper('download');
                $this->mmodel->count_downloads($paperid);
                //$pdf=$this->hmodel->preview($paperid)->pdf;                
                //force_download(FCPATH.'assets/pdfs/'.$pdf, NULL); 
                redirect("readbook/".$paperid) ; 
            }
        public function mpesa_check($msisdn,$amount,$account)
            {
                echo $this->hmodel->insertPhoneNo($msisdn);
                $this->load->library("Mpesa");
                $data       =   $this->mpesa->checkout($msisdn,$amount,$account);
                $data       =   json_decode($data);
                $check      =   $data["CheckoutRequestID"];
                $this->hmodel->createCheck($account,$check);
            }
        public function mpesasuccess()
            {

            }
        public function callback()
            {
                $data=file_get_contents("php://input");
                $data=json_decode($data);
                $data=$data['Body']["stkCallback"];
                if($data["ResultCode"]===0)
                    {
                        foreach($data["CallbackMetadata"]["Item"] as $value)
                            {
                                $mpesa[$value["Name"]]  =   $value["Value"];
                            }
                        $orderid=$this->hmodel->getOrderId($data["CheckoutRequestID"]);
                        $this->hmodel->success($orderid); 
                        $this->hmodel->payment($orderid,"mpesa",$mpesa["PhoneNumber"],$mpesa["MpesaReceiptNumber"],"KES",$mpesa["Amount"]);
                        $this->empty_cart();
                        unset($_SESSION["Order-".$this->session->userdata("admin_id")]);
                        redirect("dashboard","refresh");
                    }
            }
        public function paypalcallback()
            {
                if($_POST["payment_status"]==="Completed")
                    {
                        $orderid    =  (int)str_replace("PDS", "", $_POST["item_number"]);
                        $this->hmodel->success($orderid); 
                        $this->hmodel->payment($orderid,"paypal",$_POST["payer_email"],$_POST["ipn_track_id"],$_POST["mc_currency"],$_POST["payment_fee"]);
                        $this->empty_cart();
                        unset($_SESSION["Order-".$this->session->userdata("admin_id")]);
                        redirect("dashboard","refresh");
                    }
            }
        public function mpesacheck()
        	{
                $dbh = $this->db->where("orderid",$this->input->post("id"))
                                ->get("m_subscription");
                if($dbh)
	                {
                       	$x = $dbh->row();
                       	if($x->status == 1)
                       		{
                       			$this->empty_cart();
                              	echo (bool)TRUE;
                       		}
                       	else
	                       	{
	                       		echo (bool)FALSE;
	                       	}
	                }
	            else
		            {
		            	var_dump($this->db->error());
		            }

        	}
        ##################################################################################################################################
        #################################################################################################################################

        /* Mpesa Test */
        public function changenoformat()
            {
                $this->load->library("Mpesa");
                echo $this->mpesa->telno("0713154085");
            }
        public function accesskey()
            {
                $this->load->library("Mpesa");
                echo $this->mpesa->getAccessKey();
            }
        public function m_checkout()
            {
                $this->load->library("Mpesa");

                echo $this->mpesa->checkout("0713154085",1,'Epk2017');
            } 
        public function confirm($id)
            {
                $this->load->library("Mpesa");
                echo $this->mpesa->confirmCheckout($id);
            }
        /* End of mpesa test*/
        #####################################################################################################################################
        #####################################################################################################################################
	}
