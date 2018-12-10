<main class="col-sm-9 ml-sm-auto col-md-10 pt-5 px-sm-4" role="main">
  <div id="carouselExampleSlidesOnly" class="carousel slide p-0 mb-2" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <img class="d-block w-100" src="<?=site_url("assets/slides/slide-1.jpg"); ?>" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="<?=site_url("assets/slides/slide-2.jpg"); ?>" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="<?=site_url("assets/slides/slide-3.jpg"); ?>" alt="Third slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="<?=site_url("assets/slides/slide-4.jpg"); ?>" alt="Third slide">
          </div>
        </div>
      </div>

  <div class="row mt-5">
    <?php
    //var_dump($category);
    $ci= & get_instance();
    foreach($category as $value)
      {
        $days=($value->publication_type==0)?"infinity":1;
        $rate=$ci->getRate($value->p_id);
        $action=($this->hmodel->is_bought($value->p_id))?'<a href="'.site_url("home/download/".$value->p_id).'" class="btn btn-success ml-auto"><i class="fa fa-cloud-download"></i></a>':'<button class="addcart btn btn-success ml-auto" data-id="'.$value->p_id.'" data-days="'.$days.'" data-publication="'.$value->publication_title.'" data-edition="'.$value->p_edition.'" data-price="'.$value->publication_price.'"><i class="fa fa-cart-plus"></i></button>';
        $usd   =  round($value->publication_price/100,2);              
        $usd +=  round((2.9*$usd)/100,2) + 0.30;
        $img=site_url('assets/pdfs/'.$value->cover);
          echo'
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card h-100">
            <a href="'.site_url('home/preview/'.$value->p_id."/".$this->assist->slugify($value->publication_title)).'" class="preview link" data-id="'.$value->p_id.'">
              <figure style="position:relative;">
                <div style="width:100%; background-image:url('.$img.'); background-color: #cccccc;height: 250px; background-color: #cccccc;background-repeat: no-repeat; background-size: cover;"></div> 
                  <figcaption class="text text-center text-light" style="background:rgba(0,0,0,0.3); width:100%; font-size: 8pt; position:absolute; width:100%; bottom:0;">'.@$value->p_edition.'<figcaption>
              </figure>
              </a>
            <div class="card-body">
               <a href="'.site_url('home/preview/'.$value->p_id."/".$this->assist->slugify($value->publication_title)).'" class="preview" data-id="'.$value->p_id.'" style="text-decoration:none; color:#000;"> 
                <h5>Ksh '.$value->publication_price.' /USD '.$usd.'</h5>
                <p class="card-text">'.$value->publication_title.'</p>
              </a>
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
   ?>
  </div>
</main>

