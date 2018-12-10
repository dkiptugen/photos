<main class="col-sm-9 ml-sm-auto col-md-10 pt-5 px-sm-4" role="main">
    <?php
    $ci= & get_instance();
    $rate=$ci->getRate($preview->p_id);
    ?>
<script type="application/ld+json">
{
  "@id":"<?=site_url(); ?>",
  "@context":"http://schema.org",
  "@type":"Book",
  "name" : "<?=$preview->publication_title; ?>",
  "author": {
    "@type":"Organization",
    "name":"<?=$preview->publisher; ?>"
  },
  "url" : "<?=current_url(); ?>",
  "workExample" : [{
    "@type": "Book",
    "isbn": "",
    "bookEdition": "<?=$preview->p_edition; ?>",
    "bookFormat": "http://schema.org/EBook",
    "potentialAction":{
    "@type":"ReadAction",
    "target":
      {
        "@type":"EntryPoint",
        "urlTemplate":"<?=current_url(); ?>",
        "actionPlatform":[
          "http://schema.org/DesktopWebPlatform",
          "http://schema.org/IOSPlatform",
          "http://schema.org/AndroidPlatform"
        ]
      },
      "expectsAcceptanceOf":{
        "@type":"Offer",
        "Price":<?=$preview->publication_price; ?>,
        "priceCurrency":"Ksh",
        "eligibleRegion" : {
          "@type":"Country",
          "name":"KE"
        },
        "availability": "http://schema.org/InStock"
      }
    }
  }]

}
</script>
<script type="application/ld+json">
  {
  
  "@type": "Review",
  "itemReviewed": {
    "@type": "Thing",
    "name": "<?=$preview->publication_title; ?>"
  },
   "reviewRating": {
    "@type": "Rating",
    "ratingValue": "<?=$this->hmodel->getAvRate($preview->p_id); ?>",
    "bestRating": "5"
  },
  "publisher": {
    "@type": "Organization",
    "name": "<?=$preview->publisher; ?>"
  }
  }
</script>
  <div class="page-header d-flex">
    <h1 class="font-light"><?=$preview->publication_title; ?></h1>
  </div>
  <div class="row mb-5">
    <div class="col-lg-3 mb-4">
      <div class="card">
        <img class="card-img-top" src="<?=base_url("assets/pdfs/".$preview->cover); ?>" alt="">
      
      </div>
    </div>
    <div class="col-lg-5 col-md-6 mb-4">
      <h3 class="font-light"><?=$preview->publication_title.":".$preview->p_edition; ?></h3>
      <span class="rating my-5">
        <?=$rate; ?>
      </span>
      <br>
      <p class="badge badge-danger mt-2">Ksh <?=$preview->publication_price; ?>/=</p>
      <ul class="social-share-btns clearfix">

         <li class="facebook col-2"> 
           <a href="https://www.facebook.com/sharer/sharer.php?u=<?=current_url(); ?>?utm_source=facebook%26utm_medium=social%26utm_campaign=share_buttons">
             <i class="fa fa-facebook"></i>
             <span class="share-text">Share on Facebook</span>
           </a> 
         </li><!--
         --><li class="twitter col-2"> 
           <a href="https://twitter.com/intent/tweet/?text=<?=$preview->publication_title; ?>&amp;url=<?=current_url(); ?>?utm_source=twitter%26utm_medium=social%26utm_campaign=share_buttons&amp;via=@zeti">
             <i class="fa fa-twitter"></i>
             <span class="share-text">Share on Twitter</span>
           </a> 
         </li><!--
         --><li class="googleplus col-2"> 
           <a href="https://plus.google.com/share?url=<?=current_url(); ?>?utm_source=googleplus%26utm_medium=social%26utm_campaign=share_buttons">
             <i class="fa fa-google-plus"></i>
             <span class="share-text">Share on Google Plus</span>
           </a> 
         </li><!--
         --><li class="email col-2"> 
           <a href="mailto:?subject=zeti&amp;body=<?=current_url(); ?>?utm_source=email%26utm_medium=email%26utm_campaign=share_buttons"> 
             <i class="fa fa-envelope-o"></i> 
             <span class="share-text">Share via Email</span>
           </a> 
         </li><!--
         --><li class="whatsapp col-2"> 
           <a href="whatsapp://send?text=zeti-<?=current_url(); ?>?utm_source=whatsapp%26utm_medium=social%26utm_campaign=share_buttons"> 
             <i class="fa fa-whatsapp"></i> 
             <span class="share-text">Share on Whatsapp</span>
           </a> 
         </li>

       </ul>
      
      <hr>
      <p><?=$preview->edition_descr; ?>
          <?php
          if($this->hmodel->is_bought($preview->p_id))
            {
                echo '<a href="'.site_url("home/download/".$preview->p_id).'" class="btn btn-success ml-auto"><i class="fa fa-cloud-download"></i> Download</a>';
            }

          ?>
      </p>

    </div>
    <?php
    if(!$this->hmodel->is_bought($preview->p_id))
        {
            if ($preview->publication_type == 0) {
                $btn = ($this->assist->is_cartitem($preview->p_id)) ? "disabled" : NULL;
                echo '
                  <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                      <div class="card-header" role="tab" id="headingOne">
                        <div class="form-check d-inline font-weight-bold">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" aria-expanded="true" aria-controls="collapseOne" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                            Single issue
                          </label>
                        </div>
                        <span class="float-right text-danger font-weight-bold">ksh ' . $preview->publication_price . '/=</span>
                      </div>
        
                      <div  aria-labelledby="" >
                        <div class="card-body">
                          <p class="small text-muted"></p>
                          <button class="btn btn-info btn-block addcart"  data-id="' . $preview->p_id . '" data-publication="' . $preview->publication_title . '" data-edition="' . $preview->p_edition . '" data-price="' . $preview->publication_price . '" ' . $btn . ' data-days="infinity"  ><i class="fa fa-cart-plus mr-2"></i>Add to Cart</button>
                          <button class="btn btn-secondary btn-block buynow"   data-id="' . $preview->p_id . '" data-publication="' . $preview->publication_title . '" data-edition="' . $preview->p_edition . '" data-price="' . $preview->publication_price . '" ' . $btn . ' data-days="infinity">Buy Now</button>
                        </div>
                      </div>
                    </div>
                  </div>';
                }
            else
                {

                    echo '
                       <div class="col-lg-4 col-md-6 mb-4">
                          <div id="accordion" role="tablist">';
                        // var_dump($rates);
                       $x = 1;
                       $btn = ($this->assist->is_cartitem($preview->p_id)) ? "disabled" : NULL;
                       foreach ($rates as $value)
                            {
                                $sub = ($x != 1) ? "collapse" : "collapse show";
                                $checked = ($x == 1) ? "checked" : NULL;
                                echo '
                                    <div class="card">
                                      <div class="card-header" role="tab" id="heading' . $x . '">
                                        <div class="form-check d-inline font-weight-bold">
                                          <label class="form-check-label">
                                            <input class="form-check-input" type="radio" data-toggle="collapse" data-target="#collapse' . $x . '" aria-expanded="true" aria-controls="collapseOne" name="exampleRadios" id="exampleRadios1" value="option1" ' . $checked . '>
                                          ' . $value->subscription . ' 
                                          </label>
                                        </div>
                                        <span class="float-right text-danger font-weight-bold">ksh ' . $value->amount_ksh . '/=</span>
                                      </div>
                
                                      <div id="collapse' . $x . '" class="' . $sub . '" role="tabpanel" aria-labelledby="heading' . $x . '" data-parent="#accordion">
                                        <div class="card-body">
                                          <p class="small text-muted">' . $value->description . '</p>
                                          <button class="btn btn-info btn-block addcart"  data-id="' . $preview->p_id . '" data-publication="' . $preview->publication_title . ' - ' . $value->subscription . '" data-edition="' . $preview->p_edition . '" data-price="' . $value->amount_ksh . '" ' . $btn . ' data-days="' . $value->subscription . '" ><i class="fa fa-cart-plus mr-2"></i>Add to Cart</button>
                                          <button class="btn btn-secondary btn-block buynow"  data-id="' . $preview->p_id . '" data-publication="' . $preview->publication_title . ' - ' . $value->subscription . '" data-edition="' . $preview->p_edition . '" data-price="' . $value->amount_ksh . '" ' . $btn . ' data-days="' . $value->subscription . '" >Buy Now</button>
                                        </div>
                                      </div>
                                    </div>';
                                $x++;
                            }
                       echo '</div>
                       </div>';
            }
        }
      ?>
   
    
  </div>
  
    <?php
    
    if(is_array($related) && @$related[0]!==NULL)
      {
        echo '<hr class="mb-5">
          <div class="page-header d-flex">
            <h2 class="font-light">You May Also Like</h2>    
          </div>  
          <div class="row">';
          // var_dump(@$related[0]);
        foreach($related  as $value)
          {
            $days=($value->publication_type==0)?"infinity":1;
            $rate=$ci->getRate($value->p_id);
            $action=($this->hmodel->is_bought($value->p_id))?'<a href="'.site_url("home/download/".$value->p_id).'" class="btn btn-success ml-auto"><i class="fa fa-cloud-download"></i></a>':'<button class="addcart btn btn-success ml-auto" data-id="'.$value->p_id.'" data-days="'.$days.'" data-publication="'.$value->publication_title.'" data-edition="'.$value->p_edition.'" data-price="'.$value->publication_price.'"><i class="fa fa-cart-plus"></i></button>';
              $img=site_url('assets/pdfs/'.$value->cover);
              echo'
                <div class="col-lg-3 col-md-6 mb-4">
                  <div class="card h-100">
                    <a href="'.site_url("home/preview/".$value->p_id."/".$this->assist->slugify($value->publication_title)).'">
                      <figure style="position:relative;">
                        <div style="width:100%; background-image:url('.$img.'); background-color: #cccccc;height: 250px; background-color: #cccccc;background-repeat: no-repeat; background-size: cover;" class="card-img-top"></div> 
                          <figcaption class="text text-center text-light" style="background:rgba(0,0,0,0.3); width:100%; font-size: 8pt; position:absolute; width:100%; bottom:0;">'.@$value->p_edition.'<figcaption>
                      </figure>
                    </a>
                    <div class="card-body">
                      <h5>Ksh '.$value->publication_price.' /=</h5>
                      <p class="card-text">'.$value->publication_title.'</p>
                    </div>
                    <div class="card-footer d-flex">          
                      <span class="rating mt-2">
                       '.$rate.'        
                      </span>
                      '.$action.'          
                    </div>
                  </div>
                </div>';
        }
      }
    ?>
   
  </div>  
</main>