<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="margin-top:50px;">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="{{asset('storage/images/banners/banner-1.jpg')}}" alt="banner-1">
      <div class="carousel-caption">
        <h3>Lorem Itsum<h3>
		<p>et dolor</p>
      </div>
    </div>
    <div class="item">
      <img src="{{asset('storage/images/banners/banner-1.jpg')}}" alt="banner-1">
      <div class="carousel-caption">
        <h3>Lorem Itsum<h3>
		<p>et dolor</p>
      </div>
    </div>
    <div class="item">
      <img src="{{asset('storage/images/banners/banner-1.jpg')}}" alt="banner-1">
      <div class="carousel-caption">
        <h3>Lorem Itsum<h3>
		<p>et dolor</p>
      </div>
    </div>     
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>