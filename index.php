<?php 
    session_start();
    include("includes/config.php");
    include("includes/conn.php");
    include("includes/func.php");

    $_SESSION["page_title"] = "Money Transfer and Online Payments.";
    $_SESSION["nav"] = "home";
    include("header.php"); 
?>
  
  <!-- Content
  ============================================= -->
  <div id="content"> 
    
    <!-- Slideshow
    ============================================= -->
 <div class="bd-example">
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/bg/image5.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>First slide label</h5>
          <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/bg/image6.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Second slide label</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
</div>
    <!-- Slideshow end -->
    
    <!-- Why choose
    ============================================= -->
    <section class="section bg-light">
      <div class="container">
        <h2 class="text-9 text-center">Why should you choose Bank?</h2>
        <p class="text-4 text-center mb-5">Here’s Top 4 reasons why using a Bank account to manage your money is a fantastic choice.</p>
        <div class="row">
          <div class="col-sm-6 col-lg-3 mb-5 mb-lg-0">
            <div class="featured-box">
              <div class="featured-box-icon text-primary"> <i class="fas fa-hand-pointer"></i> </div>
              <h3>Easy to use</h3>
              <p class="text-3">Our banking system is easy to learn and master in a short amount of time. We also provide you with the best user interface.</p>
              <a href="#" class="btn-link text-3">Learn more<i class="fas fa-chevron-right text-1 ml-2"></i></a> </div>
          </div>
          <div class="col-sm-6 col-lg-3 mb-5 mb-lg-0">
            <div class="featured-box">
              <div class="featured-box-icon text-primary"> <i class="fas fa-share"></i> </div>
              <h3>Faster Payments</h3>
              <p class="text-3">We carry out payments faster than other companies would which in turn allows for more business transactions for our customers.</p>
              <a href="#" class="btn-link text-3">Learn more<i class="fas fa-chevron-right text-1 ml-2"></i></a> </div>
          </div>
          <div class="col-sm-6 col-lg-3 mb-5 mb-sm-0">
            <div class="featured-box">
              <div class="featured-box-icon text-primary"> <i class="fas fa-dollar-sign"></i> </div>
              <h3>Lower Fees</h3>
              <p class="text-3">Perform transactions and get charged for next to nothing as we are bent on giving you the most affordable fee rate.</p>
              <a href="#" class="btn-link text-3">Learn more<i class="fas fa-chevron-right text-1 ml-2"></i></a> </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="featured-box">
              <div class="featured-box-icon text-primary"> <i class="fas fa-lock"></i> </div>
              <h3>100% secure</h3>
              <p class="text-3">We make sure your account and details are safe with us as we carry out rigorous authentication and authorization before access.</p>
              <a href="#" class="btn-link text-3">Learn more<i class="fas fa-chevron-right text-1 ml-2"></i></a> </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Why choose end -->
    
    <!-- Payment Solutions
    ============================================= -->
    <section class="section">
      <div class="container overflow-hidden">
        <div class="row">
          <div class="col-lg-5 col-xl-6 d-flex">
            <div class="my-auto pb-5 pb-lg-0">
              <h2 class="text-9">Payment Solutions for anyone.</h2>
              <p class="text-4">We at UBS Transact have been the leader in technology driven financial services and applications. What does that mean? Anytime access to your funds, Full-service banking and Personalized services to help you stay ahead of your ever evolving needs.</p>
              <a href="#" class="btn-link text-4">Find more solution<i class="fas fa-chevron-right text-2 ml-2"></i></a> </div>
          </div>
          <div class="col-lg-7 col-xl-6">
            <div class="row banner style-2 justify-content-center">
              <div class="col-12 col-sm-6 mb-4 text-center">
                <div class="item rounded shadow d-inline-block"> <a href="#">
                  <div class="caption rounded-bottom">
                    <h2 class="text-5 font-weight-400 mb-0">Freelancer</h2>
                  </div>
                  <div class="banner-mask"></div>
                  <img class="img-fluid" src="images/about-1.jpg" alt="banner"> </a> </div>
              </div>
              <div class="col-12 col-sm-6 mb-4 text-center">
                <div class="item rounded shadow d-inline-block"> <a href="#">
                  <div class="caption rounded-bottom">
                    <h2 class="text-5 font-weight-400 mb-0">Online Shopping</h2>
                  </div>
                  <div class="banner-mask"></div>
                  <img class="img-fluid" src="images/about-4.jpg" alt="banner"> </a> </div>
              </div>
              <div class="col-12 col-sm-6 mb-4 mb-sm-0 text-center">
                <div class="item rounded shadow d-inline-block"> <a href="#">
                  <div class="caption rounded-bottom">
                    <h2 class="text-5 font-weight-400 mb-0">Online Sellers</h2>
                  </div>
                  <div class="banner-mask"></div>
                  <img class="img-fluid" src="images/about-3.png" alt="banner"> </a> </div>
              </div>
              <div class="col-12 col-sm-6 text-center">
                <div class="item rounded shadow d-inline-block"> <a href="#">
                  <div class="caption rounded-bottom">
                    <h2 class="text-5 font-weight-400 mb-0">Affiliate Marketing</h2>
                  </div>
                  <div class="banner-mask"></div>
                  <img class="img-fluid" src="images/about-2.jpg" alt="banner"> </a> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Payment Solutions end -->
    
    <!-- What can you do
    ============================================= -->
    <section class="section bg-light">
      <div class="container">
        <h2 class="text-9 text-center">What can you do with UBS Transact?</h2>
        <p class="text-4 text-center mb-5">UBS Transact has helped customers and agencies alike to perform their daily activities without any obstacles and obtain their objectives such as...</p>
        <div class="row">
          <div class="col-sm-6 col-lg-3 mb-4"> <a href="#">
            <div class="featured-box style-5 rounded">
              <div class="featured-box-icon text-primary"> <i class="fas fa-share-square" style="font-size:100px;"></i> </div>
              <h3><b>Send Money</b></h3>
            </div>
            </a> </div>
          <div class="col-sm-6 col-lg-3 mb-4"> <a href="#">
            <div class="featured-box style-5 rounded">
              <div class="featured-box-icon text-primary"> <i class="fas fa-check-square" style="font-size:100px;"></i> </div>
              <h3><b>Receive Money</b></h3>
            </div>
            </a> </div>
          <div class="col-sm-6 col-lg-3 mb-4"> <a href="#">
            <div class="featured-box style-5 rounded">
              <div class="featured-box-icon text-primary"> <i class="fas fa-user-friends" style="font-size:100px;"></i> </div>
          h3><b>Pay a Friend</b></h3>
            </div>
            </a> </div>
          <div class="col-sm-6 col-lg-3 mb-4"> <a href="#">
            <div class="featured-box style-5 rounded">
              <div class="featured-box-icon text-primary"> <i class="fas fa-shopping-bag" style="font-size:100px;"></i> </div>
              <h3><b>Online Shopping</b></h3>
            </div>
            </a> </div>
        </div>
        <div class="text-center mt-4"><a href="#" class="btn-link text-4">See more can you do<i class="fas fa-chevron-right text-2 ml-2"></i></a></div>
      </div>
    </section>
    <!-- What can you do end -->
    
    <!-- How work
    ============================================= -->
    <section class="section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="card bg-dark-3 shadow-sm border-0"> <img class="card-img opacity-8" src="images/how-works.jpg" alt="banner">
              <div class="card-img-overlay p-0"> <a class="d-flex h-100 video-btn" href="#" data-src="https://www.youtube.com/embed/7e90gBu4pas" data-toggle="modal" data-target="#videoModal"> <span class="btn-video-play bg-white shadow-md rounded-circle m-auto"><i class="fas fa-play"></i></span> </a> </div>
            </div>
          </div>
          <div class="col-lg-6 mt-5 mt-lg-0">
            <div class="ml-4">
              <h2 class="text-9">How does it work?</h2>
              <p class="text-4">We provide the perfect banking solutions with easy to use and customize interface with secure login and authentication. Follow the steps below to become part of our elite customers.</p>
              <ul class="list-unstyled text-3 line-height-5">
                <li><i class="fas fa-check mr-2"></i>Sign Up Account</li>
                <li><i class="fas fa-check mr-2"></i>Receive & Send Payments from worldwide</li>
                <li><i class="fas fa-check mr-2"></i>Your funds will be transferred to your local bank account</li>
              </ul>
              <a href="signup.php" class="btn btn-outline-primary shadow-none mt-2">Open a Free Account</a> </div>
          </div>
        </div>
      </div>
    </section>
    <!-- How work end -->
    
    <!--Testimonial
    ============================================= -->
    <!-- 0 -->
    <!-- Testimonial end -->
    
    <!-- Customer Support
    ============================================= -->
    <section class="hero-wrap section shadow-md">
      <div class="hero-mask opacity-9 bg-primary"></div>
      <div class="hero-bg" style="background-image:url('images/bg/image-2.jpg');"></div>
      <div class="hero-content py-5">
        <div class="container text-center">
          <h2 class="text-9 text-white">Awesome Customer Support</h2>
          <p class="text-4 text-white mb-4">Have you any query? Don't worry. We have great people ready to help you whenever you need it.</p>
          <a href="contact-us.php" class="btn btn-light">Contact Us</a> </div>
      </div>
    </section>
    <!-- Customer Support end -->
    
    <!-- Mobile App
    ============================================= -->
    <section class="section py-5">
      <div class="container">
        <div class="justify-content-center text-center">
          <h2 class="text-9">Get the app</h2>
          <p class="text-4 mb-4">Download our app for the fastest, most convenient way to send & get Payment.</p>
          <a class="d-inline-flex mx-3" href="#">
            <img alt="" src="images/app-store.png">
          </a> 
          <a class="d-inline-flex mx-3" href="#">
            <img alt="" src="images/google-play-store.png"></a> 
          </div>
      </div>
    </section>
    <!-- Mobile App end -->
    
  </div>
  <!-- Content end --> 

<?php 
  unset($_SESSION["page_title"]);
  unset($_SESSION["nav"]);
   include('footer.php')
?>