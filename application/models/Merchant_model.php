<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant_model extends CI_Model {

    public $useraccount;
    public function __construct() {
        parent::__construct();
        
        $this->useraccount=$this->session->userdata("admin_id");
           
        date_default_timezone_set('Africa/Nairobi');
        
         
        
    
    }
    
    function readbook($bookID){
    
          $sql = "select * from m_subscription m join m_orders o on o.o_ordernumber=m.orderid left join m_publicationsonsale s on  s.p_id=o.o_itemid left join m_publications p on p.ID=s.publication_id where m.userID=$this->useraccount and s.p_id=$bookID and m.status=1 limit 1";
    
          $res=$this->db->query($sql); 
                
           if($res->result()){
           
           $this->count_downloads($bookID);
           
           return $res->result();
           }else{
           return false;
           }
    
    
    }
    
    function confirmPayment($orderID){
    
        $sql ="select * from m_subscription where orderid=$orderID";
        $res=$this->db->query($sql);
        $result=$res->result();
        return intval($result[0]->status);
        
        
    }
    
    function updateOrder($orderID){
       
        $sql ="select * from m_orders where oid=$orderID";
        $res=$this->db->query($sql);
        $result=$res->result();
        $amount=$result[0]->o_amount;
        $ordernumber=intval($result[0]->o_ordernumber);
        
        $s ="select * from m_subscription where orderid=$ordernumber";
        $resul=$this->db->query($s);
        $result=$resul->result();
        $orderamount=$result[0]->amount;
        $amountpaid=$result[0]->amountpaid;
        
        $newamount=$orderamount-$amount;
        
        $newbalance=$newamount-$amountpaid;
       
      
     $ql="update m_subscription set amount=$newamount,balance=$newbalance where orderid=$ordernumber";
      
     $resl=$this->db->query($ql);
     
     //return 0;
     //exit();
     
     if($resl){
        $del ="delete from m_orders where oid=$orderID";
        $res=$this->db->query($del);
        
        
        $sql1 ="select * from m_orders where o_ordernumber=$ordernumber";
        $res=$this->db->query($sql1);
        if($res->result()){
            
        }
        else{
          $ql="delete from m_subscription where orderid=$ordernumber";
          $resl=$this->db->query($ql);
        
        }
  
     
     if($res){
      return 1;
     }
   return 0;
     }
     return 0;    
    
     
    
    }
    
    
      function count_downloads($edition) {
        $datedownloaded = date('Y-m-d H:i:s');
        $userID = $this->useraccount;
        $uIPaddress = $this->getUserIP();
		 
       $sql = "INSERT INTO m_downloads (edition, datedownloaded, userID, IPaddress) values ('$edition','$datedownloaded','$userID','$uIPaddress')";
        $this->db->query($sql);
	 
    }

    function getUserIP() {
      
$ip1 = $_SERVER['REMOTE_ADDR'] ;  


if (getenv('HTTP_X_FORWARDED_FOR')) {							
  $ip2 = getenv('HTTP_X_FORWARDED_FOR');  
} else { 
   $ip2 = getenv('REMOTE_ADDR');  
}	
$ip=$ip1."-".$ip2;

return $ip;
    }
    
    
    function  magazinesdetails($magid){
           
          $sql = "select * from m_publications p join m_circle c on publication_circle=c.p_id  join m_genres g on p.genre=g.gid     and p.ID=$magid ";
                
          $res=$this->db->query($sql); 
                
          return $res->result();
        
    }
    
    
    function create_order() {

        $sql = "select * from m_subscription where userID=$this->useraccount order by orderid desc limit 1";
        $relt = $this->db->query($sql);
        foreach ($relt->result() as $r):
            $orderid = $r->orderid;

        endforeach;
        return $orderid;
    }
    
    
    
   function createOrder($itemid,$amount) {
                
       $timestamp=date('Y-m-d H:i:s');
                
       $total_orderAmount=array_sum($amount);
       
                   
        $data=array( "orderid"=>0,"userID"=>$this->useraccount,"amount"=>$total_orderAmount,"amountpaid"=>0,"balance"=>$total_orderAmount,"currency"=>"","channel"=>"","transactionid"=>0,"subid"=>0,"startdate"=>0,"enddate"=>0,"status"=>0,"orderupdated"=>$timestamp,"datemade"=>$timestamp,"be"=>0,"transaction_type"=>"","corporateid"=>0,"createdby"=>$this->useraccount,"submedium"=>'web');
                
        $this->db->insert("m_subscription",$data);
 
          if($this->db->affected_rows()>0)
          {
 
             $order= $this->create_order();
          }
        else
          {
             $order=false;
          }
      
  
    if($order){
        
       for($i=0;$i<=count($itemid)-1;$i++) {                     
       
        $data=array("oid"=>0,"o_ordernumber"=>$order,"o_itemid"=>$itemid[$i],"o_amount"=>$amount[$i],"o_userid"=>$this->useraccount);
        $this->db->insert("m_orders",$data);

        if($this->db->affected_rows()>0)
          {
            $val= true;
          }
        else
          {
            $val =false;
          }
        
     
     
     
    }
    }
                
    
    }
    
    
    function listEditions($magid){
        
            $sql = "select * from m_publicationsonsale  where publication_id=$magid ";
                
           $res= $this->db->query($sql); 
          
            return $res->result();
    }
	 function fetchAllApproved(){  
        
          $sql = "select * from m_publications p join m_circle c on publication_circle=c.p_id  and p.publication_status=1 order by p.ID asc";
              
          $res= $this->db->query($sql);
		 
		  return $res->result();
        
    }
	function fetchAllReturned(){  
        
          $sql = "select * from m_publications p join m_circle c on publication_circle=c.p_id  and p.publication_status=2 order by p.ID asc";
              
          $res= $this->db->query($sql);
		 
		 return $res->result();
        
    }
	function fetchAllRejected(){  
        
          $sql = "select * from m_publications p join m_circle c on publication_circle=c.p_id  and p.publication_status=3 order by p.ID asc";
              
          $res= $this->db->query($sql);
		 
		 return $res->result();
        
    }
	function fetchAllArchived(){  
        
          $sql = "select * from m_publications p join m_circle c on publication_circle=c.p_id  and p.publication_status=4 order by p.ID asc";
              
          $res= $this->db->query($sql);
		 
		 return $res->result();
        
    }
	
	
          function fetchMagazines(){
        
          $sql = "select * from m_publications p join m_circle c on publication_circle=c.p_id  and p.merchant_id=$this->useraccount  order by p.ID asc";
              
          return $this->db->query($sql);
        
    }
    public function unresolvedIssues($tracker){
        if($tracker){
                
           $sql = "select * from m_publications p join users u on u.userID=p.merchant_id left join m_circle c on p.publication_circle=c.p_id where p.publication_status=0 and p.ID=$tracker";  
            
                
           
        }else{
             $sql = "select * from m_publications p join users u on u.userID=p.merchant_id left join m_circle c on p.publication_circle=c.p_id  where p.publication_status=0";    
        }
          $ql=$this->db->query($sql);
          $res=$ql->result();
          return  $res;    
    }
    public function IssuewWaitingAction(){
        
       $sql = "select  count(ID) as issues from m_publications where publication_status=0";
          $ql=$this->db->query($sql);
          $res=$ql->result();
          return  $res[0]->issues;
          
    }
    public function fetchSellers(){
         $sql = "select * from  users order by userID asc limit 50";

          return $this->db->query($sql);
    }
     function countMagazines(){
        
          $sql = "select count(ID) as magsum from m_publications where merchant_id=$this->useraccount";           
          $ql=$this->db->query($sql);
          $res=$ql->result();
          
          return  $res[0]->magsum;
    
    }
    function getSellerSales($userID){
         if($userID){
            
            $userid=$userID;
            
         }else{
          $userid= $this->useraccount;
         }
         
        $sql="select *, sum(o_amount) as osum,count(o.o_itemid) as countsum from m_subscription m join m_orders o on o.o_ordernumber=m.orderid left join m_publicationsonsale s on  s.p_id=o.o_itemid left join m_publications p on p.ID=s.publication_id where p.merchant_id=$userid and m.status=1 and m.balance=0 group by o.o_itemid order by o.o_ordernumber desc";
 
   
 
          $ql=$this->db->query($sql);
          $res=$ql->result();
        
          return $res;
    
    }
    
    function edition_details(){
        
          $sql = "select  count(p_id) as issues from  m_publicationsonsale where  p_status <>1";       
          $ql=$this->db->query($sql);
          $res=$ql->result();
          return  $res[0]->issues;
          
    }
    
    function  unapproved_edition($magid){
        
          $sql = "select  count(p_id) as issues from  m_publicationsonsale where  publication_id =$magid and p_status<>1";    
         
          $ql=$this->db->query($sql);
          $res=$ql->result();
          return  $res[0]->issues;
          
    }
    
    
    function seller_details($userID){
        
          $sql = " select * from  users u left join m_publications p on u.userID=p.merchant_id left join m_circle c on c.p_circle =p.publication_circle where u.userID=$userID";    
                
          $ql=$this->db->query($sql);
          $res=$ql->result();
        
        return $res;
    }
       function edition($e1){
       
            $sql = "select * from m_publicationsonsale s left join m_publications p on s.publication_id=p.ID  where p_id=$e1 ";
        
             $res= $this->db->query($sql); 
          
            return $res->result();
        
    }
    
    function archiveedition($eid,$a){
    
    switch($a){
    
    case 2:
     $sql = "update m_publicationsonsale set p_status=4 where  p_id=$eid";
     break;
     
     case 1:
       $sql = "update m_publicationsonsale set p_status=1 where  p_id=$eid";
     break;
        
        }
     $res= $this->db->query($sql);      
          
    if($this->db->affected_rows()>0)
          {
            return  1;
          }
        else
          {
            return  0;
          } 
    
    
    }
    
    
    
    
    
    function  updatemedia($ID,$newdocname,$field){
        
            $sql = "select * from m_publicationsonsale s left join m_publications p on s.publication_id=p.ID  where p.ID=$ID limit 1";
                
            $res= $this->db->query($sql); 
            
            $result=$res->result();
            
            $pid=intval($result[0]->p_id);
            
             $datetime=  date('Y-m-d h:i:s');
            
            $url=$this->slugify($result[0]->publication_title)."/".$pid."/".$this->slugify($result[0]->p_edition);
            
            switch (intval($field)){
                
                case 1:
                    
                    $link=  base_url()."assets/pdfs/".$result[0]->cover;
                     $ql="update m_publicationsonsale set cover ='$newdocname'  where p_id=$pid";
                
                
                    break;
                
                case 2:
                         $link= "/assets/pdfs/".$result[0]->pdf;
                         $ql="update m_publicationsonsale set pdf ='$newdocname'  where p_id=$pid";
                    break;
                case 3:
                
                         $link= "";
                         $url="details/".$this->slugify($result[0]->publication_title)."/".$pid."/".$this->slugify($result[0]->p_edition);
                         $ql="update m_publicationsonsale set p_edition ='$newdocname'  where p_id=$pid";
                    break;
                
                 case 4:
                
                         $link= "";
                          $url="details/".$this->slugify($result[0]->publication_title)."/".$pid."/".$this->slugify($result[0]->p_edition);
                         $ql="update m_publicationsonsale set edition_descr ='$newdocname'  where p_id=$pid";
                
                    break;
                
                  case 5:
                
                         $link= "";
                         $url="details/".$ID."/".$this->slugify($result[0]->publication_title);
                         $ql="update m_publications  set publication_title ='$newdocname'  where ID=$ID";
                
                    break;
                 case 6:
                
                         $link= "";
                        $url="details/".$ID."/".$this->slugify($result[0]->publication_title);
                         $ql="update m_publications  set publication_circle =$newdocname  where ID=$ID";
                
                    break;
                 case 7:
                         $link= "";
                        $url="details/".$ID."/".$this->slugify($result[0]->publication_title);
                         $ql="update m_publications  set publication_price =$newdocname  where ID=$ID";
                
                    break;
                 case 8:
                
                         $link= "";
                        $url="details/".$ID."/".$this->slugify($result[0]->publication_title);
                         
                        $newdocname=$this->db->escape_str($newdocname);
                        $ql="update m_publications  set  descr ='$newdocname'  where ID=$ID";
                
                    break;
                 case 9:
                
                         $link= "";
                        $url="issues";
                         
                        $newdocname=$this->db->escape_str($newdocname);
                
                        $ql="update m_publications  set  publication_status =1,publicationapproval_date='$datetime',moderator_remarks='$newdocname'  where ID=$ID";
                
                    break;
                  case 10:
                
                         $link= "";
                        $url="issues";
                         
                        $newdocname=$this->db->escape_str($newdocname);
                        $ql="update m_publications  set  publication_status =2,publicationapproval_date='$datetime',moderator_remarks='$newdocname'  where ID=$ID";
                
                    break;
                  case 11:
                
                         $link= "";
                        $url="issues";
                         
                        $newdocname=$this->db->escape_str($newdocname);
                        $ql="update m_publications  set  publication_status =3,publicationapproval_date='$datetime',moderator_remarks='$newdocname'  where ID=$ID";
                
                    break;
                
                 case 12:
                
                         $link= "";
                        $url="details/".$ID."/".$this->slugify($result[0]->publication_title);
                        $newdocname=intval($newdocname);
                        $ql="update m_publications  set  publication_status =$newdocname  where ID=$ID";
                
                    break;
                 
                 case 13:
                
                        $link= "";
                        $url="details/".$ID."/".$this->slugify($result[0]->publication_title);
                        $newdocname=intval($newdocname);
                        $ql="update m_publications  set  publication_status =$newdocname  where ID=$ID";
                        $archql="update m_publicationsonsale set p_status=$newdocname where publication_id =$ID";
                        $this->db->query($archql); 
                
                    break;
                
                 case 14:
                
                         $link= "";
                         $url="details/".$ID."/".$this->slugify($result[0]->publication_title);
                         $ql="update m_publications  set  genre =$newdocname  where ID=$ID";
                
                    break;
					
					case 17:
                
                         $link= "";
                         $url="details/".$ID."/".$this->slugify($result[0]->publication_title);
                         $ql="update m_publications  set  authors ='$newdocname'  where ID=$ID";
                
                    break;
					
					case 19:
                
                         $link= "";
                         $url="details/".$ID."/".$this->slugify($result[0]->publication_title);
                         $ql="update m_publications  set  publisher ='$newdocname'  where ID=$ID";
                
                    break;
					
					case 20:
                
                         $link= "";
                         $url="details/".$ID."/".$this->slugify($result[0]->publication_title);
                         $ql="update m_publications  set  publicationcountry ='$newdocname'  where ID=$ID";
                
                    break;
					
					case 18:
                         $my=explode("-",$newdocname);
						 $pmonth=$my[0];
						 $pyear=$my[1];
                         $link= "";
                         $url="details/".$ID."/".$this->slugify($result[0]->publication_title);
                         $ql="update m_publications  set  publicationyear =$pyear,publicationmonth='$pmonth'  where ID=$ID";
                
                    break;
                
                default :
                
            }
              unlink($link);   
            
             $this->db->query($ql); 
			 
			 
            
            return  array($this->db->affected_rows(),$url);
                
        
    }
	
	 public function country_name($code){
             
			 $qr="select countryname from country where code like '$code' limit 1";
			 $res=$this->db->query($qr);
			 $result=$res->result();
			 return $result[0]->countryname;
        
             

	}
	
	
            
    function addEdition($doc,$descr,$tm,$edition,$ID,$cover){
        $data=array("p_id"=>0,"publication_id"=>$ID,"p_edition"=>$edition,"psubmission_date"=>$tm,"p_status"=>0,"edition_descr"=>$descr,"pdf"=>$doc,'cover'=>$cover);
        $this->db->insert("m_publicationsonsale",$data);
        
                
        if($this->db->affected_rows()>0)
          {
            return  1;
          }
        else
          {
            return  0;
          } 
        
    }
     function add_magazine($publication,$type,$price,$descr,$genre,$author,$publishdate,$publisher,$yob,$country){
        
        
        
        $data=array("ID"=>0,"merchant_id"=>$this->useraccount,"publication_title"=>$publication,"publication_circle"=>$type,"publication_price"=>$price,"descr"=>$descr,"publication_status"=>0,"publicationsubmission_date"=>  date('Y-m-d h:i:s'),"publicationapproval_date"=>0,"genre"=>$genre,"authors"=>$author,"publicationmonth"=>$publishdate,"publisher"=>$publisher,"publicationyear"=>$yob,"publicationcountry"=>$country); 
       
       
        $this->db->insert("m_publications",$data);
        
     
        
        if($this->db->affected_rows()>0)
          {
            return  1;
          }
        else
          {
            return  0;
          }
        
    }  
    
    function genreType(){
        $sql = "select * from  m_genres";
         $res=$this->db->query($sql);  
         return $res->result(); 
    }
	
	function country_autoload(){
		  $sql = "select * from  country";
         $res=$this->db->query($sql);  
         return $res->result();
	}

    function publication_autoload(){
        $sql = "select * from  m_circle";
         $res=$this->db->query($sql);  
         return $res->result();
    }
      function get_user($email) {
        $email = $this->db->escape_str($email);
        $sql = "select * from users where email='$email'";
        return $this->db->query($sql);
    }
	
	function getpurchaseditems($order){
		 $sql = "select * from m_subscription m join m_orders o on o.o_ordernumber=m.orderid left join m_publicationsonsale s on  s.p_id=o.o_itemid left join m_publications p on p.ID=s.publication_id where m.userID=$this->useraccount and m.orderid=$order";
         
         //$sql = "select * from m_subscription m join m_orders o on o.o_ordernumber=m.orderid left join m_publicationsonsale s on  s.p_id=o.o_itemid left join m_publications p on p.ID=s.publication_id left join users u on u.userID=m.userID where m.userID=$this->useraccount and m.orderid=$order";
         
         $res=$this->db->query($sql);
         return $res->result();
		
	}
    
    function getorders($order){
    
         //$sql = "select * from m_subscription m join m_orders o on o.o_ordernumber=m.orderid left join m_publicationsonsale s on  s.p_id=o.o_itemid left join m_publications p on p.ID=s.publication_id where m.userID=$this->useraccount and m.orderid=$order";
         
         $sql = "select * from m_subscription m join m_orders o on o.o_ordernumber=m.orderid left join m_publicationsonsale s on  s.p_id=o.o_itemid left join m_publications p on p.ID=s.publication_id left join users u on u.userID=m.userID where m.userID=$this->useraccount and m.orderid=$order";
         
         $res=$this->db->query($sql);
         return $res->result();
    
    }
    function mysubscriptions(){
    
         $sql = "select *,sum(o.o_amount) as om from m_subscription m join m_orders o on o.o_ordernumber=m.orderid left join m_publicationsonsale s on  s.p_id=o.o_itemid left join m_publications p on p.ID=s.publication_id where m.userID=$this->useraccount group by m.orderid order by o.o_ordernumber desc";
 
         $res=$this->db->query($sql);
         
         return $res->result();
         
    
    }

function AddNewNumber($number){

         $sql = "select telephone_no from users where userID=$this->useraccount";
       
         $phone=false;
 
         $res=$this->db->query($sql);
         
          $result=$res->result();
        
          foreach($result as $r){
          
          $phone=$r->telephone_no;
          
          }
          
          if($phone){
          
             
             $numbersarray=explode(";",$phone);
             
            
             
             if(in_array($number,$numbersarray)){
             
            
             
             }else{
             
               
                 $newnumberString=$phone.$number.";";
                 $sqlupdate= "update users set telephone_no='$newnumberString' where userID=$this->useraccount";
                 $res=$this->db->query($sqlupdate);  
            
             }
          
          }
          else{
          
                $newnumberString=$number.";";
                $sqlupdate= "update users set telephone_no='$newnumberString' where userID=$this->useraccount";
                $res=$this->db->query($sqlupdate);  
          
          }
          
           
           

}


      function validate($raw_email,$password) {    
        $email = $this->db->escape_str($raw_email);
        $sql = "select auth_key from users where (email='$email' or username='$email') and status=1";
        $rel = $this->db->query($sql);
                
                
                
        if ($rel->num_rows()>0) {
            foreach ($rel->result() as $rl):
                $authkey = $rl->auth_key;
            endforeach;
            $pass = md5($authkey . $password);
            $sql = "select * from users where password='$pass' and (email='$email' or username='$email')";
                
            $result = $this->db->query($sql);
            if ($result->num_rows()>0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
                
     function slugify($text)
    {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        if (function_exists('iconv')) {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }
        $text = $text;
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return 'n-a';
        }
        $text = strtolower($text);

        return $text;
    }
	 
}	  
