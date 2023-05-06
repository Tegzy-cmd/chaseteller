<?php 
    session_start();
    include("includes/config.php");
    include("includes/conn.php");
    include("includes/func.php");

    $_SESSION["page_title"] = "Send Money Anywhere Around The Globe.";
    $_SESSION["nav"] = "send";
    include("header.php"); 
?>
  
  <!-- Content
  ============================================= -->
  <div id="content"> 
    
    <!-- Send Money
    ============================================= -->
    <section class="hero-wrap section">
      <div class="hero-mask opacity-9 bg-dark"></div>
      <div class="hero-bg" style="background-image:url('images/bg/banner-send.jpg');"></div>
      <div class="hero-content py-2 py-lg-5">
        <div class="container text-center">
          <h2 class="text-14 text-white">A Better Way to Send Money to any Location in the World.</h2>
          <p class="text-5 text-white mb-4">Send money with a better exchange rate and avoid excessive bank fees.<br class="d-none d-lg-block">
            Over 180 countries and 120 currencies supported.</p>
          <a class="btn btn-primary video-btn" href="help.php">How it Works</a> 
        </div>
      </div>
    </section>
    <!-- Send Money End --> 
    
    <!-- How it works
    ============================================= -->
    <section class="section bg-white">
      <div class="container">
        <h2 class="text-9 text-center"> The simple way to send money</h2>
        <p class="text-4 text-center mb-5">You can send money at anytime of the day without delay or high transaction fee price.</p>
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="featured-box style-3">
              <div class="featured-box-icon text-light"><span class="w-100 text-20 font-weight-500">1</span></div>
              <h3>Sign Up Your Account</h3>
              <p class="text-3">Become a registered user first, then log in to your account and enter your card or bank details that is required for you.</p>
            </div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="featured-box style-3">
              <div class="featured-box-icon text-light"><span class="w-100 text-20 font-weight-500">2</span></div>
              <h3>Select Your Recipient</h3>
              <p class="text-3">Enter your recipient's email address then add an amount with currency to send securely.</p>
            </div>
          </div>
          <div class="col-lg-4 mb-4 mb-sm-0">
            <div class="featured-box style-3">
              <div class="featured-box-icon text-light"><span class="w-100 text-20 font-weight-500">3</span></div>
              <h3>Send Money</h3>
              <p class="text-3">After sending money, the recipient will be notified via an email when money has been transferred to their account.</p>
            </div>
          </div>
        </div>
        <div class="text-center mt-2">
          <a href="signup.php" class="btn btn-outline-primary shadow-none text-uppercase">Sign up Now</a>
        </div>
      </div>
    </section>
    <!-- How it works End --> 
    
    <!-- Why choose us
    ============================================= -->
    <section class="section">
      <div class="container">
        <h2 class="text-9 text-center">Why choose ChasetellerBank?</h2>
        <p class="text-4 text-center mb-5">Here’s Top 4 reasons why using a ChasetellerBank account in other to manage your money.</p>
        <div class="row">
          <div class="col-md-6 mb-4 mb-md-0">
            <div class="hero-wrap section h-100 p-5 rounded">
              <div class="hero-mask rounded opacity-6 bg-dark"></div>
              <div class="hero-bg rounded" style="background-image:url('images/why.png');"></div>
              <div class="hero-content">
                <h2 class="text-6 text-white mb-3">Why ChasetellerBank?</h2>
                <p class="text-light mb-5">We are set to improve the banking experience of our customers by providing top notch with almost zero fault generation providing the reliability you demand.</p>
                <h2 class="text-6 text-white mb-3">Send Money with ChasetellerBank</h2>
                <p class="text-light">Our money transfer system is one of the most secure system out with total verification and light speed performance.</p>
                <p class="text-light mb-0">You can send money anywhere around the world at anytime with low fee charge and completion of transaction in no time.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="featured-box style-1">
              <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
              <h3>Over 180 countries</h3>
              <p>We can send or receive money from over 180 countries.</p>
            </div>
            <div class="featured-box style-1">
              <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
              <h3>Lower Fees</h3>
              <p>Low transaction fee charge for any transaction whatsoever.</p>
            </div>
            <div class="featured-box style-1">
              <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
              <h3>Easy to Use</h3>
              <p>Fast easy and accessible user interface design with smooth performance.</p>
            </div>
            <div class="featured-box style-1">
              <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
              <h3>Faster Payments</h3>
              <p>We carry out payment faster than any other competitor out there.</p>
            </div>
            <div class="featured-box style-1">
              <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
              <h3>100% secure</h3>
              <p>Secure authorization and authentication with login capabilities.</p>
            </div>
            <div class="featured-box style-1">
              <div class="featured-box-icon text-primary"> <i class="far fa-check-circle"></i> </div>
              <h3>24/7 customer service</h3>
              <p>Our customer service is there to solve any problem you might be having.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Why choose us End --> 
    
    <!-- How work
    ============================================= -->
    <section class="hero-wrap section shadow-md">
      <div class="hero-mask opacity-9 bg-primary"></div>
      <div class="hero-bg" style="background-image:url('images/bg/image-8.jpg');"></div>
      <div class="hero-content py-3 py-lg-5 my-3 my-lg-5">
        <div class="container text-center">
          <h2 class="text-9 text-white mb-4 mb-lg-5">How does send money work?</h2>
          <a class="video-btn d-inline-flex" href="#" data-toggle="modal" data-target="#videoModal"> 
            <span class="btn-video-play bg-white shadow-md rounded-circle m-auto"><i class="fas fa-play"></i></span> 
          </a> 
        </div>
      </div>
    </section>
    <!-- How work End --> 
    
    <!-- Testimonial
    ============================================= -->
    <section class="section">
      <div class="container">
        <h2 class="text-9 text-center">What people say about ChasetellerBank</h2>
        <p class="text-4 text-center mb-4">A payments experience people love to talk about</p>
        <div class="row">
          <div class="col-lg-10 col-xl-8 mx-auto">
            <div class="owl-carousel owl-theme" data-autoplay="true" data-nav="true" data-loop="true" data-margin="30" data-stagepadding="5" data-items-xs="1" data-items-sm="1" data-items-md="1" data-items-lg="1">
              <div class="item">
                <div class="testimonial rounded text-center p-4">
                  <p class="text-4">“Best bank account I've ever had! from the ATM rebates. ChasetellerBank is way above anything else out there you are definitely gonna love it.”</p>
                  <strong class="d-block font-weight-500">Jacob Sunderland</strong> <span class="text-muted">Founder at Icomatic Pvt Ltd</span> </div>
              </div>
              <div class="item">
                <div class="testimonial rounded text-center p-4">
                  <p class="text-4">“Their customer service is what differentiates ChasetellerBank from the rest of pack out there i just wanna say keep up the good work.”</p>
                  <strong class="d-block font-weight-500">Patrick Cary</strong> <span class="text-muted">Freelancer from USA</span> </div>
              </div>
              <div class="item">
                <div class="testimonial rounded text-center p-4">
                  <p class="text-4">“I can't say enough how much I love ChasetellerBank. I never thought i 'd care so much about a bank, but this one has been amazing from day one..”</p>
                  <strong class="d-block font-weight-500">De Mortel</strong> <span class="text-muted">Online Retail</span> </div>
              </div>
              <div class="item">
                <div class="testimonial rounded text-center p-4">
                  <p class="text-4">“I have used them twice now. Good rates, very efficient service and it denies high street banks an undeserved windfall. Excellent.”</p>
                  <strong class="d-block font-weight-500">Chris Tom</strong> <span class="text-muted">User from UK</span> </div>
              </div>
              <div class="item">
                <div class="testimonial rounded text-center p-4">
                  <p class="text-4">“It's a real good idea to manage your money by ChasetellerBank. The rates are fair and you can carry out the transactions without worrying!”</p>
                  <strong class="d-block font-weight-500">Mauri Lindberg</strong> <span class="text-muted">Freelancer from Australia</span> </div>
              </div>
              <div class="item">
                <div class="testimonial rounded text-center p-4">
                  <p class="text-4">“Only trying it out since a few days. But up to now excellent. Seems to work flawlessly. I'm only using it for sending money to friends at the moment.”</p>
                  <strong class="d-block font-weight-500">Dennis Jacques</strong> <span class="text-muted">User from USA</span> </div>
              </div>
              <div class="item">
                <div class="testimonial rounded text-center p-4">
                  <p class="text-4">“I use to not like online banking until a friend of mine recommended you guys and I've been taken in by their ease of use and transaction speed.”</p>
                  <strong class="d-block font-weight-500">Sophia Boden</strong> <span class="text-muted">User from CANADA</span> </div>
              </div>
            </div>
            <div class="text-center mt-4"><a href="#" class="btn-link text-4">See more people review<i class="fas fa-chevron-right text-2 ml-2"></i></a></div>
          </div>
        </div>
      </div>
    </section>
    <!-- Testimonial end --> 
    
    <!-- Frequently asked questions
    ============================================= -->
    <section class="section bg-white">
      <div class="container">
        <h2 class="text-9 text-center">Frequently Asked Questions</h2>
        <p class="text-4 text-center mb-4 mb-sm-5">Can't find it here? Check out our <a href="help.html">Help center</a></p>
        <div class="row">
          <div class="col-md-10 col-lg-8 mx-auto">
            <hr class="mb-0">
            <div class="accordion accordion-alternate arrow-right" id="popularTopics">
              <div class="card">
                <div class="card-header" id="heading1">
                  <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">What is ChasetellerBank?</a> </h5>
                </div>
                <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#popularTopics">
                  <div class="card-body">ChasetellerBank is an online banking platform that enables you to perform transactions such as transfer, receive money, deposit and withdraw. </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="heading2">
                  <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">How to send money online?</a> </h5>
                </div>
                <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#popularTopics">
                  <div class="card-body">First create an account with us then login your account proceed to send money in menu click on it fill in the details then click on confirm and the send. </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="heading3">
                  <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">Is my money safe with ChasetellerBank?</a> </h5>
                </div>
                <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#popularTopics">
                  <div class="card-body">Your money is completely safe with us as you are free to withdraw it at any time you want.</div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="heading4">
                  <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">How much fees does ChasetellerBank charge?</a> </h5>
                </div>
                <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#popularTopics">
                  <div class="card-body">We charge as low as 2.00 USD for a given transaction you can contact our customer care for more information on this.</div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="heading5">
                  <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">What is the fastest way to send money abroad?</a> </h5>
                </div>
                <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#popularTopics">
                  <div class="card-body">By using the ChasetellerBank send money feature we carry out your transaction at an alarming speed and deliver in less than a day.</div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="heading6">
                  <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">Can I open an ChasetellerBank account for business?</a> </h5>
                </div>
                <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#popularTopics">
                  <div class="card-body">Yes you can open an account for business or personal depending on what you want.</div>
                </div>
              </div>
            </div>
            <hr class="mt-0">
          </div>
        </div>
        <div class="text-center mt-4">
          <a href="help.php" class="btn-link text-4">See more FAQ<i class="fas fa-chevron-right text-2 ml-2"></i></a>
        </div>
      </div>
    </section>
    <!-- Frequently asked questions end --> 
    
    <!-- Special Offer
    ============================================= -->
    <section class="hero-wrap py-5">
      <div class="hero-mask opacity-8 bg-dark"></div>
      <div class="hero-bg" style="background-image:url('images/bg/image-2.jpg');"></div>
      <div class="hero-content">
        <div class="container d-md-flex text-center text-md-left align-items-center justify-content-center">
          <h2 class="text-6 font-weight-400 text-white mb-3 mb-md-0">Sign up today and get your first transaction fee free!</h2>
          <a href="signup.php" class="btn btn-outline-light text-nowrap ml-4">Sign up Now</a> </div>
      </div>
    </section>
    <!-- Special Offer end --> 
  </div>
  <!-- Content end --> 

<?php 
  unset($_SESSION["page_title"]);
  unset($_SESSION["nav"]);
  include("footer.php"); 
?>