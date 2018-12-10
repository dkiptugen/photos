<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home_model extends CI_Model
    {
        public $userid;
        public function __construct()
            {
                parent::__construct();
                date_default_timezone_set('Africa/Nairobi');
                $this->userid=$this->session->userdata("admin_id");
            }
        public function getNav()
            {
                return $this->db->where('gstatus',1)
                                 ->get("m_genres")
                                 ->result();  
            }
        public function ourproducts($limit,$start=0)
            {
                return
                    $this->db->join("m_publications","m_publications.ID =m_publicationsonsale.publication_id")
                             //->where("publisher","The standard")
                             ->where('p_status',1)
                             ->limit($limit,$start)

                             ->order_by("m_publicationsonsale.p_id","DESC")

                             //->group_by('publication_id')
                             ->get("m_publicationsonsale");
            }
        public function is_bought($paperid)
            {
                $papertype=$this->preview($paperid)->publication_type;
                $this->db->join("m_orders","m_subscription.orderid=m_orders.o_ordernumber");
                $this->db->where("o_itemid",$paperid)->where("status",1);
                $this->db->where("o_userid",$this->userid);
                if($papertype==1)
                    {
                        $this->db->where("o_enddate >= '".date('Y-m-d H:i:s',strtotime(date("Ymd")))."'")
                                 ->where("o_startdate <= '".date('Y-m-d H:i:s',strtotime(date("Ymd")))."'");
                    }
                $dbh=$this->db->get("m_subscription");
                if($dbh)
                    {
                        if ($dbh->num_rows() > 0)
                            {
                                return (bool)TRUE;
                            }
                        return (bool)FALSE;
                    }
                else
                    {
                        return $this->db->error();
                    }
            }
        public function category($catid,$catname,$limit,$start=0)
            {
                //return array(2,3,4,5,7,8,3,2);
                $this->db->join("m_publications","m_publications.ID =m_publicationsonsale.publication_id")
                         ->where("genre",$catid)
                         ->where("publication_status",1)
                         ->where('p_status',1)
                         ->order_by("publication_circle","DESC");
                return  $this->db->get("m_publicationsonsale");
            }
        public function getCatName($id)
            {
                return $this->db->where("gid",$id)
                                ->get("m_genres")
                                ->row();
            }
        public function getLatest($limit,$start=0)
            {
                $dbh=$this->db->where('p_status',1)
                              ->join("m_publications","m_publications.ID =m_publicationsonsale.publication_id")
                              ->order_by("psubmission_date")
                              ->group_by('publication_id')
                              ->limit($limit,$start)
                              ->get("m_publicationsonsale");
                return $dbh->result();
            }
        public function getBestseller($limit,$start=0)
            {
                $data=$this->db->join("m_publicationsonsale","m_publicationsonsale.p_id=m_papertraffic.paperid")
                               ->where('p_status',1)
                               ->order_by("downloadcount")
                         ->limit($limit,$start)
                         ->get("m_papertraffic");
                return $data->result();
            }
        public function preview($id)
            {
                $dbh=$this->db->join("m_publications","m_publications.ID =m_publicationsonsale.publication_id")
                              ->where("p_id",$id)
                              ->where('p_status',1)
                              ->get("m_publicationsonsale");
                return $dbh->row();
            }
        public function getPublication($id)
            {
                return $this->db->join("m_publications","m_publications.ID =m_publicationsonsale.publication_id")
                                ->where("p_id",$id)
                                ->where('p_status',1)
                                ->get("m_publicationsonsale")
                                ->row();
            }
        public function related($catid,$id,$limit)
            {
                $dbh=$this->db->join("m_publications","m_publications.ID =m_publicationsonsale.publication_id")
                              ->where("p_id!=".$id)
                              ->where('p_status',1)
                              ->where("genre",$catid)
                              ->limit($limit)
                              ->get("m_publicationsonsale");
                return $dbh->result();
            }
        public function getRates($id)
            {
                $dbh=$this->db->where("paper_id",$id)
                              ->order_by("days","asc")
                              ->get("m_rates");
                return $dbh->result();
            }
        public function success($id)
            {
                $this->db->where("orderid",$id)
                         ->set("status",1)
                         ->update("m_subscription");
            }
        public function getPhoneNos()
            {
                $dbh    =   $this->db->select("telephone_no as phone")
                                     ->where("userID",$this->userid)
                                     ->get("users");
                if($dbh->num_rows()>0)
                    {
                        $phone=$dbh->row()->phone;

                        if($phone==NULL)
                            {
                                return FALSE;
                            }
                        else
                            {
                                $phone=explode(";",$phone);
                                $phone=array_diff($phone, array(""));
                                return $phone;
                            }
                    }                
            }
        public function localizePhoneNumber($phonenumber)
            {
                if(substr($phonenumber, 0, 4) === '+254')
                    {
                        $local_phoneNumber  =   str_replace("+254",0,$phonenumber) ;
                    }
                else if(substr($phonenumber, 0, 3) === '254')
                    {
                        $local_phoneNumber  =   str_replace("254",0,$phonenumber) ;
                    }
                else
                    {
                        $local_phoneNumber  =   $phonenumber;
                    }
                return  $local_phoneNumber;
            }
        public function insertPhoneNo($phone)
            {
                $phone=$this->localizePhoneNumber($phone);
                $fetch=$this->getPhoneNos();
                if($fetch)
                    {

                        if(!in_array($phone,$fetch))
                            {
                                $phone=$phone.";";
                                $X=TRUE;
                            }
                    }
                else
                    {
                        $phone=$phone.";";
                        $X=TRUE;
                    }
                if($X)
                    {
                        $this->db->set("telephone_no","CONCAT(`telephone_no`,'".$phone."')",FALSE)
                                 ->where("userID",$this->userid)
                                 ->update("users");
                    }
            }
        public function createorder()
            {
                $data=array(
                            "userID"        =>  $this->userid,
                            "amount"        =>  $this->cart->total(),
                            "orderupdated"  =>  date('Y-m-d H:i:s'),
							"balance"  => $this->cart->total(),
                            "datemade"      =>  date('Y-m-d H:i:s'),
                            "createdby"     =>  $this->userid,
                            "submedium"     =>  "web"
                           );
						   
                $this->db->insert("m_subscription",$data);
            }
        public function getOrderNo()
            {
                return
                    $this->db->where("userID",$this->userid)
                             ->order_by("orderid","DESC")
                             ->limit(1)
                             ->get("m_subscription")
                             ->row()
                             ->orderid;
            }
        public function createOrderValues($rowid,$itemid,$amount,$period)
            {
                $startdate = date('Y-m-d H:i:s');
                $date = date_create(date('Y-m-d'));
                $enddate=($period==="infinity")?NULL:date_format(date_add($date,date_interval_create_from_date_string($period." days")),'Y-m-d H:i:s');
                $orderid=$this->getOrderNo();
                $j=$this->db->query("select * from m_orders where o_ordernumber='".$orderid."' && o_rowid='".$rowid."'");
                if($j->num_rows()>0)
                    {
                        $data=array(                 
                                        "o_itemid"      =>  $itemid,
                                        "o_amount"      =>  $amount,
                                        "o_userid"      =>  $this->userid,
                                        "o_startdate"   =>  $startdate,
                                        "o_enddate"     =>  $enddate
                                   );
                        $this->db->where("o_ordernumber",$orderid)
                                 ->where("o_rowid",$rowid)
                                 ->update("m_orders",$data);
                    }
                else
                    {
                        $data=array(
                                        "o_ordernumber" =>  $orderid,
                                        "o_rowid"       =>  $rowid,
                                        "o_itemid"      =>  $itemid,
                                        "o_amount"      =>  $amount,
                                        "o_userid"      =>  $this->userid,
                                        "o_startdate"   =>  $startdate,
                                        "o_enddate"     =>  $enddate
                                   );
                        $this->db->insert("m_orders",$data);
                    }
                
            }
        public function rateproduct()
            {
                $userid=(isset($_SESSION["admin_id"]))?$_SESSION["admin_id"]:0;
                $check=$this->db->where("userid",$_SESSION["admin_id"])
                                ->where("paperid",$this->input->post("paperid"))
                                ->get("m_rating");
                if($check->num_rows()>0)
                    {
                       $this->db->where("id",$check->row()->id)
                                ->update("m_rating",array("rate"=>$this->input->post("rate")));
                    }
                else
                    {
                        $data = array(  "id"       => NULL,
                                        "paperid"  => $this->input->post("paperid"),
                                        "rate"     => $this->input->post("rate"),
                                        "ratetime" => date('Y-m-d H:i:s'),
                                        "userid"   =>$userid
                                    );
                        $this->db->insert("m_rating",$data);
                    }
            }
        public function getInrate($paperid)
            {

                $dbh = $this->db->where("userid",$this->userid)
                            ->where("paperid",$paperid)
                            ->get("m_rating");
                if($dbh->num_rows()>0)
                    {
                        return $dbh->row()
                                   ->rate;
                    }
                else
                    {
                       return $this->getAvRate($paperid);
                    }
            }
        public function getAvRate($paperid)
            {
                $data = $this->db->where("paperid",$paperid)
                                 ->order_by("ratetime","DESC")
                                 ->limit(15)
                                 ->get("m_rating");
                if($data->num_rows()>0)
                    {
                        $x=0;
                        foreach($data->result() as $value)
                            {
                                $x +=$value->rate;
                            }

                        $rate = round(($x) / $data->num_rows());
                        return $rate;
                    }
                else
                    {
                        $x=0;
                        return (int)$x;
                    }
            }
        public function payment($orderid,$mode,$identifier,$ref,$currency,$amount)
            {
                
                $data   =   array(  
                                    "p_orderid"     =>  $orderid,
                                    "paymentmode"   =>  $mode,
                                    "identifier"    =>  $identifier,
                                    "ref"           =>  $ref,
                                    "currency"      =>  $currency,
                                    "amount"        =>  $amount
                                );                        
                $this->db->insert("m_payments",$data);
            }
        public function getOrderId($check)
            {
                return $this->db->where("checkoutid",$check)
                                ->order_by("c_date","DESC")
                                ->limit(1)
                                ->get("m_checkout")
                                ->row()
                                ->orderid;
            }
        public function createCheck($orderid,$check)
            {
                $data = array(
                                "orderid"    => $orderid,
                                "checkoutid" => $check
                             );
                $this->db->insert("m_checkout",$data);
            }
        public function getGenre($id)
            {
                return
                $this->db->where("gid",$id)
                         ->get("m_genres")
                         ->row();
            }
    }
?>