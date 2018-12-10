<script type="text/javascript">
	 
	$(document).on('click','.addcart', function(){
   		//console.log($(this).data("publication"));
   		var url 	=	"<?=site_url("home/addtocart"); ?>";
   		var id		=	$(this).data("id");
   		var price	=	$(this).data("price");
   		var title	=	$(this).data("publication");
   		var days    =   $(this).data("days");
   	    $(this).attr("disabled","");
        $.post(url,{"<?=$this->security->get_csrf_token_name(); ?>":"<?=$this->security->get_csrf_hash(); ?>","id":id,"title":title,"price":price,"period":days}).done(function(data)
        	{
            console.log(data);
        		var link ="<?=site_url("home/countCart"); ?>";
        		$.get(link, function(data) {
        					$("#cartbadge").html(data);
        				});
        	});	

	});
	$(document).on("click",".buynow",function(){
         
	});
	$(document).on("click",".cart-anchor",function(){
		$.get("<?=site_url("home/viewCart"); ?>", function(data) {
				$("#viewz" ).html(data);
		});
	});
	$(document).on("click",".removeCart",function(){
		$.post("<?=site_url("home/removefromcart"); ?>",{"<?=$this->security->get_csrf_token_name(); ?>":"<?=$this->security->get_csrf_hash(); ?>","id":$(this).data("id")}).done(function(){
			var link ="<?=site_url("home/countCart"); ?>";
			$.get(link, function(data) {
        					$("#cartbadge").html(data);
        				});
			$.get("<?=site_url("home/viewCart"); ?>", function(data) {
				$("#viewz" ).html(data);
			});
		});
	});
	$(document).on("click",".check-out",function(){
		var check='<?=$this->session->userdata("user_logged_in"); ?>';
		if(typeof(check) != "undefined" && check !== null) {
			if(!check)
				{
					$('#logintab').modal(focus);
				}
			else
				{
                    $(location).attr('href', '<?=site_url("f_checkout"); ?>');

				}
		
			}
      
	});
	$(document).on("click",".clearCart",function(){
		$.get("<?=site_url("home/empty_cart");   ?>");
		var link ="<?=site_url("home/countCart"); ?>";
		$.get(link, function(data) {
        					$("#cartbadge").html(data);
        				});
		$.get("<?=site_url("home/viewCart"); ?>", function(data) {
				$("#viewz" ).html(data);
			});
	});
	$(document).ready(function(){

	  var ses=JSON.parse('<?=(string)json_encode($this->cart->contents()) ?>');  
      $(".addcart").each(function(){
      	var el=$(this);
      	var id=el.data("id"); 
      	     
        $.each(ses, function(index, element) {
				    if(element.id==id)
				   	  	{
                           el.attr("disabled","disabled");
				   	  	}
				});
        
      });

	});
	$(document).on("click","#mpesapay",function(){
        $.get("<?=site_url("home/showNo"); ?>", function(data) {
            $("#phoneNos").html(data);
        });
	});
	$(".nav a").click(function(e){
     $(".nav a").find(".btn-primary").removeClass("btn-primary");
    
		$(this).addClass("btn-primary");
	
	});
    $(document).on("click",".phoneno",function()
    {
        $(".fnn").val($(this).data("phone"));
        // console.log($(this).data("phone"));
    });
    $(document).on("mouseover",".rating .star",function(){
       $(this).removeClass("fa-star-o").removeClass("bg-grey").addClass("fa-star").addClass("bg-gold");
       $(this).prevAll().removeClass("fa-star-o").removeClass("bg-grey").addClass("fa-star").addClass("bg-gold");
       $(this).nextAll().addClass("fa-star-o").addClass("bg-grey").removeClass("fa-star").removeClass("bg-gold");
    });
    $(document).on("mouseout",".rating .star",function(){
        var pero = $(this).parent();
        var paperid=$(this).data("paperid");
        $.get("<?=site_url("home/printRate/"); ?>"+paperid, function(d) {
            pero.html(d);

        });
    });
    $(document).on("click",".rating .star",function(){
        var csrfname = "<?=$this->security->get_csrf_token_name(); ?>";
        var csrfval  = "<?=$this->security->get_csrf_hash(); ?>";
        var pero = $(this).parent();
        var paperid=$(this).data("paperid");
        $.post("<?=site_url("home/rate"); ?>",{csrfname:csrfval,"paperid":$(this).data("paperid"),"rate":$(this).data("id")}).done(function(){
            $.get("<?=site_url("home/printRate/"); ?>"+paperid, function(d) {
                pero.html(d);

            });
        });
    });
    $(".mpesacheckout").on("submit",function(x){
          x.preventDefault();
          var phone   = $(".fnn").val();
          var amount  = $(".amount").val();
          var orderid = $(".ordernumber").val();
          $.get("home/mpesa_check/"+phone+"/"+amount+"/"+orderid);
    });
    $("#confirmpayment").on("click",function(){
        $.post("<?=site_url('home/mpesacheck'); ?>",{"id":$(this).data("id")}).done(function(data){
            if(data == 1)
              {
                  $(location).attr('href', '<?=site_url("dashboard"); ?>');
              }
            else
              {
                alert("no payment made");
              }
        });
    });
</script>