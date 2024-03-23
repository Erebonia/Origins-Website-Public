
<link rel="stylesheet" type="text/css" href="rss/slick.css">
<link rel="stylesheet" type="text/css" href="rss/slick-theme.css">
<style type="text/css">
  html, body {
    margin: 0;
    padding: 0;
  }

  * {
    box-sizing: border-box;
  }

  .slider {
    width: 100%;
    margin: 0px auto;
  }

  .slick-slide {
    margin: 0px 20px;
  }

  .slick-slide img {
    width: 100%;
  }

  .slick-prev:before,
  .slick-next:before {
    /*color: black;*/
    font-size: 50px;
  }


  .slick-slide {
    transition: all ease-in-out .3s;
    opacity: .5;
  }

  .slick-active {
    opacity: .7;
  }

  .slick-current {
    opacity: 1;
    font-size: large;
  }
  .slick-current>.titt{ color: yellow !important; }
  .slick-slide {
   margin: 0px;
 }
</style>
</head>
<body>
	<!-- This SHIT MAKES THE FRONT PAGE LAG 
  <?php $master = include 'master.php'; ?>
  <section class="center slider wow zoomIn" data-wow-delay="0.1s">



    <?php include 'rsslib.php';?>
    <div class="col-md-2 col-sm-12 col-xs-12 text-center ckc"  style="margin: 0px;padding: 0px;border: 1px solid #3d4042;">
      <img class="img-responsive center-block" style="" src="img/news.jpg">     
      <?php echo RSS_Display(array($master['news']), 1); ?>
      <div class="clearfix"></div>      
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 text-center ckc" style="margin: 0px;padding: 0px;border: 1px solid #3d4042;">
      <img class="img-responsive center-block" style="" src="img/updates.jpg">
      <?php echo RSS_Display(array($master['updates']), 1); ?>
      <div class="clearfix"></div>
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 text-center ckc" style="margin: 0px;padding: 0px;border: 1px solid #3d4042;">
      <img class="img-responsive center-block" style="" src="img/events.jpg">
      <?php echo RSS_Display(array($master['events']), 1); ?>
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 text-center ckc" style="margin: 0px;padding: 0px;border: 1px solid #3d4042;">
      <img class="img-responsive center-block" style="" src="img/events1.jpg">
      <?php echo RSS_Display(array($master['events1']), 1); ?>
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 text-center ckc" style="margin: 0px;padding: 0px;border: 1px solid #3d4042;">
      <img class="img-responsive center-block" style="" src="img/events2.jpg">
      <?php echo RSS_Display(array($master['events2']), 1); ?>
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 text-center ckc" style="margin: 0px;padding: 0px;border: 1px solid #3d4042;">
      <img class="img-responsive center-block" style="" src="img/events3.jpg">
      <?php echo RSS_Display(array($master['events3']), 1); ?>
    </div>  -->


  </section>



  <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
  <script src="rss/slick.js" type="text/javascript" charset="utf-8"></script>
  
  <script type="text/javascript" media="screen">
    var $jq = jQuery.noConflict();
    $jq(document).on('ready', function() {

      $jq(".center").slick({
        dots: true,
        infinite: true,
        centerMode: true,
        slidesToShow: 5,
        slidesToScroll: 3,
        responsive: [
        {
        breakpoint: 1000, // or whatever breakpoint you want to render below
        settings: {
          variableWidth: false,
          adaptiveHeight: false,
          centerMode: false,
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      ]
    });

    });
  </script>

