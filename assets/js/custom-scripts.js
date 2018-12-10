
$(function() {
    
    
    
  $("#addmagazine").click(function(){
         
  var header = "Add Publication";
/*var content = "<div class='form-group'><label for='publication'>Publication Title:</label> <input type='text'  class='form-control' id='publication'></div>\n\
<div class='form-group'><label for='genre'>Genre:</label>"+genreType("genre","genre")+"</div><div class='form-group'><label for='type'>Type:</label>"+loadPublicationType("type","type")+"</div><div class='form-group'><label for='type'>Price:<br/>FREE : <input onchange='isfree(this)' id='isfree' name='isfree' type='checkbox'/></label><input type='price' class='form-control' id='price'></div><div class='form-group'><label for='type'>Description:</label><textarea class='form-control' id='descr'></textarea></div><button   type='submit'  class='btn btn-primary'  onclick = 'addButton();'>Submit</button></div>";
  */
  
  var content = "<div class='form-group'><label for='publication'>Publication Title:</label> <input type='text'  class='form-control' id='publication'></div>\n\
<div class='form-group'><label for='genre'>Genre:</label>"+genreType("genre","genre")+"</div><div class='form-group'><label for='type'>Type:</label>"+loadPublicationType("type","type")+"</div><div class='form-group'><label for='author'>Author(If book):</label><input class='form-control' id='authors'></input></div><div class='form-group'><label for='publisher'>Publisher:</label><input class='form-control' id='publisher'></input></div><div class='form-group'><label for='publishdate'>Publication Month (If book):</label><select class='form-control' id='publishdate'><option>-</option><option>January</option><option>February</option><option>March</option><option>April</option><option>May</option><option>June</option><option>July</option><option>August</option><option>September</option><option>October</option><option>November</option><option>December</option></select></div><div class='form-group'><label for='yop'>Year of Publication(If book):</label>"+yoB("yob","yob")+"</div><div class='form-group'><label for='county'>Country:</label>"+worldCountries("country","country")+"</div><div class='form-group'><label for='type'>Price:<br/>FREE : <input onchange='isfree(this)' id='isfree' name='isfree' type='checkbox'/></label><input type='price' class='form-control' id='price'></div><div class='form-group'><label for='type'>Description:</label><textarea class='form-control' id='descr'></textarea></div><button   type='submit'  class='btn btn-primary'  onclick = 'addPublication();'>Submit</button></div>";
  doModal(header, content);  
 
    }); 
    
    
    $("#addedition").click(function(){
     
        
 var header ="Add Image";
 var content = "<form id='file_upload_form' method='post' action='/photos/ajax/"+$("#magid").val()+"'  enctype='multipart/form-data'><div class='form-group'><label for='edition'>Short Caption:</label> <input type='text'  class='form-control' id='edition' name='edition'></div>\n\
 <div class='form-group'><label for='type'>Thumb (HD):</label><input type='file' class='form-control'  name='doc1'   id='doc1'/></div><div class='form-group'><label for='type'>Original Image in HD:</label><input type='file' class='form-control'  name='doc2'   id='doc2'/></div><div class='form-group'><label for='type'>Long Caption :</label><textarea class='form-control' id='descr' name='descr'></textarea></div><button   type='submit'  class='btn btn-primary' >Submit</button></div><input type='hidden' name='slugtitle' value='"+$("#magTitle").val()+"'/></form>";
 
doModal(header, content); 
         
         
         
     
    });
    
    
     
    
     $("#unarchiveedition").click(function(){
        
       
        archiveedition(1);
         
     
    });
    
   
   
   
   $("#archiveedition").click(function(){
        
       
 var header = $("#editionTitle").val();
 var content = "<p>Archiving this edition would subsequently withdraw it from market. Sales will be put on hold until you unarchive it.</p> <button  value='2' onclick='archiveedition(this.value)'  type='submit'  class='btn btn-primary'   '>Archive</button></div><input type='hidden' name='slugtitle' value='"+$("#magTitle").val()+"'/></form>";

doModal(header, content); 
         
     
    });
   
 
 
   
   
   
   
    
      
     

}(jQuery));


function isfree(id){
 
 
if($(id).is(":checked")){

  $("#price").val("0.00");
  
   document.getElementById("price").setAttribute("disabled", true);
   
}else{

 $("#price").val("");
 document.getElementById("price").removeAttribute("disabled");
 
 }

}


function  yoB(id,name){
   
       var $selectBox="";
 
        $selectBox ="<select id='"+id+"' name="+name+" class='form-control'>"; //document.createElement("select");
  
         $selectBox += '<option value="0">--</option><option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option> <option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1993</option><option value="1991">1991</option><option value="1992">1992</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option>';
 
         $selectBox+="</select>";
          
    
 return  $selectBox;
    }


function archiveedition($v){


var $eid=$("#eid").val();  
    
    var urlData={"eid":$eid,"action":$v};
    var urlString="/photos/archiveedition";
     
    ajaxSubmit(urlString, urlData);     

}


function worldCountries(id,name){
   
    var $selectBox="";
     $.ajax({
    async: false, 
    url: "/photos/country_autoload", 
    data: null,
    success: function(data) {
 
        $selectBox ="<select id='"+id+"' name="+name+" class='form-control'>"; //document.createElement("select");
 
       for(var o in data){
    
         $selectBox += '<option value="'+data[o]['code']+'">'+data[o]['countryname']+ '</option>';  
     
       }
         $selectBox+="</select>";
          
    }});     
  
  
 
 return  $selectBox;
    }


function genreType(id,name){
   
    var $selectBox="";
     $.ajax({
    async: false, 
    url: "/photos/genre_autoload",
    data: null,
    success: function(data) {
 
        $selectBox ="<select id='"+id+"' name="+name+" class='form-control'>"; //document.createElement("select");
 
       for(var o in data){
    
         $selectBox += '<option value="' + data[o]['gid'] + '">' +data[o]['gname']+ '</option>';
     
       }
         $selectBox+="</select>";
          
    }});  
  
  
 
 return  $selectBox;
    }

function loadPublicationType(id,name){
   
    var $selectBox="";
     $.ajax({
    async: false,
    url: "/photos/publication_autoload",
    data: null,
    success: function(data) {
 
        $selectBox ="<select id='"+id+"' name="+name+" class='form-control'>"; //document.createElement("select");
 
       for(var o in data){
    
         $selectBox += '<option value="' + data[o]['p_id'] + '">' +data[o]['p_circle']+ '</option>';
     
       }
         $selectBox+="</select>";
          
    }});  
  
  
 
 return  $selectBox;
    }

function   viewMagazine(v){
 var header =$("#magTitle").val()+" Cover";
 var content = "<img width='100%' src='"+v+"'/>";

doModal(header, content); 
          
    
}


function    editOperations(v,optional){
 
 
 
 var magID=parseInt($("#magid").val()); 
    
    switch (parseInt(v)){
        
           case 1:
            
            var header ="New Cover";
            
             var content = "<form method='post' action='/photos/updatemedia/"+magID+"'  enctype='multipart/form-data'><div class='form-group' > <input  name='mediatype' type='hidden' value='1'/> <label for='type'>Cover Image (HD):</label><input type='file' class='form-control'  name='doc1'   id='doc1'/></div>      <button   type='submit'  class='btn btn-primary' >Submit</button></div> </form>";

            
            break;
            
        case 2:
             var header ="Edition / Issue";
              var content = " <form method='post' action='/photos/updatetext/"+magID+"'><div class='form-group'><input  name='mediatype' type='hidden' value='3'/><label for='edition'>Edition:</label> <input type='text'  class='form-control' id='edition' name='docname' value='"+$("#editionTitle").val()+"'></div>\n\
            </div><button   type='submit'  class='btn btn-primary'>Submit</button></div></form> ";

            break;
            
        case 3:
             var header ="Description";
                  var content = " <form method='post' action='/photos/updatetext/"+magID+"'><div class='form-group'><input  name='mediatype' type='hidden' value='4'/><label for='edition'>Edition:</label> <textarea  style='height:100px'  class='form-control' name='docname' >"+$("#descr").val()+"</textarea></div>\n\
            </div><button   type='submit'  class='btn btn-primary'>Submit</button></div></form> ";

            
            break;
            
        case 4:
            
             var header ="Upload new Image file";
              var content = "<form method='post' action='/photos/updatemedia/"+magID+"'  enctype='multipart/form-data'><div class='form-group' > <input  name='mediatype' type='hidden' value='2'/> <label for='type'>Image in HD:</label><input type='file' class='form-control'  name='doc1'   id='doc1'/></div>      <button   type='submit'  class='btn btn-primary' >Submit</button></div> </form>";

            
                    
        break;
        
            
        case 5:
             var header ="Magazine";
              var content = " <form method='post' action='/photos/updatetext/"+magID+"'><div class='form-group'><input  name='mediatype' type='hidden' value='5'/><label for='edition'>Edition:</label> <input type='text'  class='form-control'   name='docname' value='"+$("#magTitle").val()+"'></div>\n\
            </div><button   type='submit'  class='btn btn-primary'>Submit</button></div></form> ";

            break;
              case 6:  
             var header ="Edition/Issue";
              var content = " <form method='post' action='/photos/updatetext/"+magID+"'><div class='form-group'><input  name='mediatype' type='hidden' value='6'/><label for='docname'>Issue:</label>   "+loadPublicationType("docname","docname")+"  </div>\n\
            </div><button   type='submit'  class='btn btn-primary'>Submit</button></div></form> ";

            break;
              case 7:
              var header ="Price /Unit";
              var content = " <form method='post' action='/photos/updatetext/"+magID+"'><div class='form-group'><input  name='mediatype' type='hidden' value='7'/><label for='price'>Price:</label> <input type='text'  class='form-control'   name='docname' value='"+optional+"'></div>\n\
            </div><button   type='submit'  class='btn btn-primary'>Submit</button></div></form> ";

            break;
              case 8:
             var header ="Overview";
              var content = " <form method='post' action='/photos/updatetext/"+magID+"'><div class='form-group'><input  name='mediatype' type='hidden' value='8'/><label for='price'>Overview:</label>  <textarea style='height:100px' class='form-control'   name='docname'  >"+$("#magdetails").val()+"</textarea></div>\n\
            </div><button   type='submit'  class='btn btn-primary'>Submit</button></div></form> ";

            break;
            
              case 9:
             var header ="Approve Book / Magazine";
              var content = " <form method='post' action='/photos/updatetext/"+magID+"'><div class='form-group'><input  name='mediatype' type='hidden' value='9'/><label for='price'>Brief comment:</label>  <textarea style='height:100px' class='form-control'   name='docname'  ></textarea></div>\n\
            </div><button   type='submit'  class='btn btn-success'>Approve</button></div></form> ";

            break;
               case 10:
             var header ="Return Book / Magazine";
              var content = " <form method='post' action='/photos/updatetext/"+magID+"'><div class='form-group'><input  name='mediatype' type='hidden' value='10'/><label for='price'>Brief reason for returning:</label>  <textarea style='height:100px' class='form-control'   name='docname'  ></textarea></div>\n\
            </div><button   type='submit'  class='btn btn-warning'>Return</button></div></form> ";

            break;
               case 11:
             var header ="Reject Book / Magazine";
              var content = " <form method='post' action='/photos/updatetext/"+magID+"'><div class='form-group'><input  name='mediatype' type='hidden' value='11'/><label for='price'>Brief reason for rejecting:</label>  <textarea style='height:100px' class='form-control'   name='docname'  ></textarea></div>\n\
            </div><button   type='submit'  class='btn btn-danger'>Reject</button></div></form> ";

            break;
            
             break;
               case 12:
             var header ="Return / Reject Reasons";
              var content = "<div>"+ $("#moderator-reasons").val()+"</div><form method='post' action='/photos/updatetext/"+magID+"'><br/><div class='form-group'><input  name='docname' type='hidden' value='0'/><input  name='mediatype' type='hidden' value='12'/><button   type='submit'  class='btn btn-success'><i class='fa fa-check'></i>Re-submit </button></div></form>";  
         

            break;
            
        case 13:
        var header ="Move to archives";
       var content = "<p>Archiving this Item would subsequently archive all its editions. Sales will be put on hold until you unarchive it.</p><form method='post' action='/photos/updatetext/"+magID+"'> <button   type='submit'  class='btn btn-danger'   '>Archive</button></div><input  name='docname' type='hidden' value='4'/><input type='hidden' name='mediatype' value='13'/></form>";

       // doModal(header, content); 
        break;
        
        case 14:
         var header ="Genre";
              var content = " <form method='post' action='/photos/updatetext/"+magID+"'><div class='form-group'><input  name='mediatype' type='hidden' value='14'/><label for='docname'>Genre:</label>   "+genreType("docname","docname")+"  </div>\n\
            </div><button   type='submit'  class='btn btn-primary'>Submit</button></div></form> ";
 
        break;
        
         case 15:
              
           
          var header ="Order No: PDS"+optional;
         
          var content =getOrder(parseInt(optional));
          
          
          setInterval(function(){ confirmPayment(parseInt(optional)); }, 5000);
          
          
                
         break;
		 
		 
		 
		 case 16:
              
           
          var header ="Download your HD image";
         
          var content =readBook(parseInt(optional));
             
         break;
		 
		  case 17:
              
          var header ="Author[s]";
              var content = " <form method='post' action='/photos/updatetext/"+magID+"'><div class='form-group'><input  name='mediatype' type='hidden' value='17'/><label for='authors'>Author[s]:</label>  <input class='form-control'   name='docname'   value='"+$("#magAuthors").val()+"'/></div>\n\
             </div><button   type='submit'  class='btn btn-primary'>Submit</button></div></form> ";

             
         break;
		 
		  case 18:
              
          var header ="Publication Date";
              var content = " <form method='post' action='/photos/updatetext/"+magID+"'> <div class='form-group'><input  name='mediatype' type='hidden' value='18'/><label for='publicationmonth'>Publication Month:</label>  <select class='form-control' id='pubmonth'  name='pubmonth'><option>January</option><option>February</option><option>March</option><option>April</option><option>May</option><option>June</option><option>July</option><option>August</option><option>September</option><option>October</option><option>November</option><option>December</option></select></div>\n\
             </div><div class='form-group'><label for='publicationyear'>Publication Year:</label>"+yoB("pubyear","pubyear")+"</div>\n\
			 <button   type='submit'  class='btn btn-primary'>Submit</button></div></form> ";

             
         break;
		 
		  case 19:
              
          var header ="Publisher";
              var content = " <form method='post' action='/photos/updatetext/"+magID+"'><div class='form-group'><input  name='mediatype' type='hidden' value='19'/><label for='authors'>Publisher:</label>  <input class='form-control'   name='docname'   value='"+$("#magPublisher").val()+"'/></div>\n\
             </div><button   type='submit'  class='btn btn-primary'>Submit</button></div></form> ";

             
         break;
		 
		  case 20:
              
          var header ="Country";
              var content = " <form method='post' action='/photos/updatetext/"+magID+"'><div class='form-group'><input  name='mediatype' type='hidden' value='20'/><label for='country'>Country:</label>"+worldCountries("docname","docname")+"</div>\n\
             </div><button   type='submit'  class='btn btn-primary'>Submit</button></div></form> ";

             
         break;
         
         
         
        
        default :
    }
        
     doModal(header, content); 
    
}

 

function readBook(orderID){
 
    var t= "<table class='table table-striped table-bordered table-hover'><thead><tr><th>Image</th><th>Option</th> </tr></thead><tbody>"  ;
  
   $.ajax({
    async: false,
    url: "/photos/getpurchaseditems/"+orderID,
    data:null,
    success: function(data) {
          
   for (var g in data){
                     
     t+="<tr><td>"+data[g]['publication_title']+"</td><td> <a   class='btn btn-link btn-success' target='_blank'   href='/photos/readbook/"+data[g]['o_itemid']+"'><i class='fa fa-download'></i>&nbsp;Get</a></td></tr>";
                     
  }
    }}); 
    
      
    
   t+="</tbody></table>";
   
   
   return t; 

}



function getOrder(orderID){
  
  var phonenumber="";
  var total_amount= 0;
    var t= "<table class='table table-striped table-bordered table-hover'><thead><tr><th>Book / Magazine</th><th>Amount</th><th></th></tr></thead><tbody>"  ;
  
   $.ajax({
    async: false,
    url: "/photos/getorders/"+orderID,
    data:null,
    success: function(data) {
          
      for (var g in data){
                     
                     t+="<tr><td>"+data[g]['publication_title']+"</td><td>"+data[g]['o_amount']+"</td><td> <button  class='btn btn-link dropdown-toggle'   onclick='deleteOrderItem("+data[g]['oid']+")'><i class='fa fa-trash-o'></i>Remove</button></td></tr>";
                     total_amount +=parseFloat(data[g]['o_amount']);
                     phonenumber=data[g]['telephone_no'];
                 }
    }});   
    
     t+="<tr><td><strong>TOTAL AMOUNT DUE</strong></td><td><strong>"+total_amount+"</strong></td><td></td></tr>"; 
    
   t+="</tbody></table>";
   
   
var tel="";
  
 if(phonenumber===null || phonenumber==="" ){  
 
   }else{
      
     var phonenumbers_array=phonenumber.split(";");
      
   if(phonenumbers_array.length>1){
       
       tel="<br/>Click Number to use or Enter New One Below<br/><div> ";
       for(var a=0;a<=phonenumbers_array.length-2;a++){
       
       tel+=" <button  class='btn btn-info mynumber' onclick='checkoutfromhistory("+total_amount+","+orderID+",this.value)' value='"+phonenumbers_array[a]+"' class='pmynumbers'>"+phonenumbers_array[a]+"</button> ";
       } 
       
       tel+="</div>";   
         
         
   }else{
        tel= phonenumber;
   } 
   } 
   
   
   var usdtotal=parseFloat(total_amount/106);
   
   var total_amount_usd=usdtotal + parseFloat(0.30);
   
   
   t+="<div><div><h3>Payment Options</h3><div class='tabbed'><input name='tabbed' id='tabbed1' type='radio' checked><section><h1><label for='tabbed1'><img width='50px' height='30px' src='/photos/assets/img/mpesa.png'/>&nbsp;Mpesa</label></h1><div><ul><li>Go to M-PESA Menu</li><li>Select <strong>Lipa Na MPesa</strong></li><li>Select <strong>Pay Bill</strong> option</li><li>Enter <strong>505604</strong> as the Business Number</li><li>Enter <strong>PDS"+orderID+"</strong> as the Account Number</li><li>In the amount section, enter <strong>"+total_amount+"</strong></li><li>Enter your M-PESA PIN</li><li>Click <strong>OK</strong></li><li>You will receive an SMS confirming the transaction</li><li><strong>wait for 3 minutes as we process transaction</strong><p id='confirmmessage'> </p></ul></div></section><input name='tabbed' id='tabbed2' type='radio'><section><h1><label for='tabbed2'><img width='70px' height='30px' src='/photos/assets/img/paypal.png'/>&nbsp;Paypal</label></h1><div><div class='checkout-btn'><form action='https://www.paypal.com/cgi-bin/webscr' method='post' accept-charset='utf-8'><input type='hidden' name='cmd' value='_xclick'><input type='hidden' name='charset' value='utf-8'><input type='hidden' name='business' value='onlineaccounts@standardmedia.co.ke'><input type='hidden' name='item_name' value='The Standard'><input type='hidden' name='item_number' value='PDS"+orderID+"'><input type='hidden' name='amount' value='"+total_amount_usd+"'><input type='hidden' name='currency_code' value='USD'><input type='hidden' name='notify_url' value='/photos/paypalcallback'><input type='hidden' name='return' value='/photos/dashboard'><input type='hidden' name='cancel_return' value='/photos/dashboard'><input type='hidden' name='bn' value='Business_BuyNow_WPS_SE'><input type='submit' class='btn btn-primary fa fa-paypal' value='Pay with PayPal'></form><div class='clr'></div></div></div></section> </div></div></div>";
  
   
   
   //<ul class='nav nav-tabs'><li class='active'><a data-toggle='tab' href='#mpesa'><img width='50px' height='30px' src='/photos/assets/img/mpesa.png'/></a></li><li><a data-toggle='tab' href='#paypal'><img width='70px' height='30px' src='/photos/assets/img/paypal.png'/></a></li></ul><div class='tab-content'><div id='mpesa' class='tab-pane fade in active'> <p><div class='form-group'>"+tel+"</div> <div class='form-group'> <label for='phonenumber'>Enter Phone number <button id='btnrefresh' onclick='checkoutrefresh("+total_amount+","+orderID+")' class='btn btn-primary btn-success'><i class='fa fa-refresh'></i>Refresh</button></label> <input type='text'  class='form-control' onkeyup='checkout("+total_amount+","+orderID+")' id='phonenumber' maxlength='10'><br/><p id='checkphone'> </p></div></p></div><div id='paypal' class='tab-pane fade'> <h3>Paypal</h3><p> </p></div></div></div>  <br/> <p id='confirmmessage'> </p></div>"
   
   /*<button onclick='confirmPayment("+orderID+")' class='btn btn-success btn-bg'><i class='fa fa-check'></i> Confirm</button>*/
   return t; 


}

 
 
 function  confirmPayment(x){
    
   var $urlString="/photos/confirmPayment/"+x;
 
   
              $.ajax({                                                                        
                
                url: $urlString,
                
                type: "GET",
                
                 timeout: 32400000,
                
                dataType:"json",
                
                contentType: "application/json",
               
                cache: false,
                
                data: null,
                
               success: function(data) {
                
                   if(parseInt(data.id)==1){
           
           document.getElementById("confirmmessage").innerHTML="<font style='color:green'>Payment Received</font>";
             window.location.reload();
		    //$(".modal").modal("close");
		    //editOperations(16,x);
           
       }else{
           document.getElementById("confirmmessage").innerHTML="<font style='color:red'>Payment not received...Trying again in a few</font>";
       }
        
        return false;
                    
             
                },
              error:function (xhr, ajaxOptions, thrownError){
                    
              
                
                },
             beforeSend:function(){                       
                
                  document.getElementById("confirmmessage").innerHTML="<font style='color:gold'>Checking...</font>";
                
             }
                 
              });
}
 
 
 
 


function confirmPayment1(x){
 
 
 
 var urlString="/photos/confirmPayment/"+x;
  $.ajax({
    async: false,
    url:  urlString,
    timeout: 32400000,
    dataType:"json",
    contentType: "application/json",         
    data: null,
    success: function(data) {
     
       if(parseInt(data.id)==1){
           
           document.getElementById("confirmmessage").innerHTML="<font style='color:green;font-size:17px;font-weight:bolder'>Payment Received</font>";
           window.location.reload();
           
       }else{
           document.getElementById("confirmmessage").innerHTML="<font style='color:red;font-size:17px;font-weight:bolder'>Payment not received...Try again after a few</font>";
       }
          
    },
     error:function (xhr, ajaxOptions, thrownError){
                  document.getElementById("confirmmessage").innerHTML="Error Occured";     
                },
             beforeSend:function(){                       
                  
                     document.getElementById("confirmmessage").innerHTML="Checking...";
             }
    
    
    }); 
 
}

function deleteOrderItem(i){

  ajaxSubmit("/photos/updateOrder/"+i, null);
}


function addPublication(){
     
    
    var publication=$("#publication").val();
    var type=$("#type").val();
    var price=$("#price").val();
    var descr=$("#descr").val();
    var genre=$("#genre").val();
    
     var author= $("#authors").val();
     var publishdate=$("#publishdate").val();
     var publisher= $("#publisher").val();
     var yob= $("#yob").val();
     var country=$("#country").val();  
    
    var urlData={"publication":publication,"type":type,"price":price,"descr":descr,"genre":genre,"authors":author,"publishdate":publishdate,"publisher":publisher,"yob":yob,"country":country};
    var urlString="/photos/addMagazine";
     
    ajaxSubmit(urlString, urlData);
  
}

function checkoutrefresh(sumtotal,ordernumber){
 
document.getElementById("checkphone").innerHTML="";
   
  var phone=$("#phonenumber").val();
  if(phone.length===10){
  checkout(sumtotal,ordernumber);
 }
 else{
 alert("Enter Valid Phone Number");
 }

}
function checkoutfromhistory(sumtotal,ordernumber,phone){
 
document.getElementById("checkphone").innerHTML="";
   
  $("#phonenumber").val(phone);
  if(phone.length===10){
  checkout(sumtotal,ordernumber);
 }
 else{
 alert("Enter Valid Phone Number");
 }

}


function checkout(sumtotal,ordernumber){

 var phone=$("#phonenumber").val();
 
 if(phone.length===10){
 
 var urlString="/photos/checkout";
 var contentData={"phonenumber":phone,"sumtotal":sumtotal,"ordernumber":ordernumber};
     
   $.ajax({
    async: false,
    url:  urlString,
    data:contentData,
    success: function(data) {
           
    
           
          document.getElementById("checkphone").innerHTML="<button  class='btn btn-link btn-success dropdown-toggle'><i class='fa fa-check'></i></button><font style='color:green'> "+data.msg+"</font>";
 
           
      
          
    }}); 
 
 
 
 }

}

function doModal(heading, formContent)
{
  
           
          $(".modal .modal-title").html(heading);
          $(".modal .modal-body").html(formContent);
          $(".modal").modal("show");
        
}


function  ajaxSubmit(urlString,contentData){
    $.ajax({
    async: false,
    url:  urlString,
    data:contentData,
    success: function(data) {
           
       if(parseInt(data.id)==1){
           
		   alert("Complete");
           window.location.reload();
           
       }else{
           
       }
          
    }}); 
    
 
}

 
 
 
 
  
 
 

 
  