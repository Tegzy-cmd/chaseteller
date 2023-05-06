<?php 
    session_start();
    include("includes/config.php");
    include("includes/conn.php");
    include("includes/func.php");

    $_SESSION["page_title"] = "How Can We Help You.";
    $_SESSION["nav"] = "help";
    include("header.php"); 
?>
  
  <!-- Page Header
  ============================================= -->
    <section class="hero-wrap section">
      <div class="hero-mask opacity-9 bg-dark"></div>
      <div class="hero-bg" style="background-image:url('images/bg/banner-help.jpg');"></div>
      <div class="hero-content py-2 py-lg-5">
        <div class="container">
          <div class="row align-items-center text-center">
            <div class="col-12">
              <h1 class="text-11 text-white mb-3">How can we help you?</h1>
            </div>
            <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
              <div class="input-group">
                <input class="form-control shadow-none border-0" type="search" id="search-input" placeholder="Search for answer..." value="">
                <div class="input-group-append"> <span class="input-group-text bg-white border-0 p-0">
                  <button class="btn text-muted px-3 border-0" type="button"><i class="fa fa-search"></i></button>
                  </span> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <!-- Page Header end --> 
  
  <!-- Content
  ============================================= -->
  <div id="content">
    
    <!-- Main Topics
    ============================================= -->
    <section class="section py-3 my-3 py-sm-5 my-sm-5">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
            <div class="bg-light shadow-sm rounded p-4 text-center"> <span class="d-block text-17 text-primary mt-2 mb-3"><i class="fas fa-user-circle"></i></span>
              <h3 class="text-body text-4">My Account</h3>
              <p class="mb-0"><a class="text-muted btn-link" href="">See articles<span class="text-1 ml-1"><i class="fas fa-chevron-right"></i></span></a></p>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
            <div class="bg-light shadow-sm rounded p-4 text-center"> <span class="d-block text-17 text-primary mt-2 mb-3"><i class="fas fa-money-check-alt"></i></span>
              <h3 class="text-body text-4">Payment</h3>
              <p class="mb-0"><a class="text-muted btn-link" href="">See articles<span class="text-1 ml-1"><i class="fas fa-chevron-right"></i></span></a></p>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3 mb-4 mb-sm-0">
            <div class="bg-light shadow-sm rounded p-4 text-center"> <span class="d-block text-17 text-primary mt-2 mb-3"><i class="fas fa-shield-alt"></i></span>
              <h3 class="text-body text-4">Security</h3>
              <p class="mb-0"><a class="text-muted btn-link" href="">See articles<span class="text-1 ml-1"><i class="fas fa-chevron-right"></i></span></a></p>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="bg-light shadow-sm rounded p-4 text-center"> <span class="d-block text-17 text-primary mt-2 mb-3"><i class="fas fa-credit-card"></i></span>
              <h3 class="text-body text-4">Payment Methods</h3>
              <p class="mb-0"><a class="text-muted btn-link" href="">See articles<span class="text-1 ml-1"><i class="fas fa-chevron-right"></i></span></a></p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Main Topics end -->
    
    <!-- Popular Topics
    ============================================= -->
    <section class="section bg-white">
      <div class="container">
        <h2 class="text-9 text-center">Popular Topics</h2>
        <p class="text-4 text-center mb-5">Check out our answers to some highly asked questions.</p>
        <div class="row">
          <div class="col-md-10 mx-auto">
            <div class="row">
              <div class="col-md-6">
                <div class="accordion accordion-alternate" id="popularTopics">
                  <div class="card">
                    <div class="card-header" id="heading1">
                      <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">I forgot the password for my account.</a> </h5>
                    </div>
                    <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#popularTopics">
                      <div class="card-body">To recover your password you can go to login then click on forgot password enter your email address and then click on the link send to your email to change your password.</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="heading2">
                      <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">How do I withdraw funds from my account?</a> </h5>
                    </div>
                    <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#popularTopics">
                      <div class="card-body">Login your account click on withdraw fill the withdrawal form and click confirm then click finish.</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="heading3">
                      <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">How do I link bank account to my account?</a> </h5>
                    </div>
                    <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#popularTopics">
                      <div class="card-body">Login your account click on bank account fill the bank account details form and click add account.</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="heading4">
                      <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">How do I confirm the email address on my account?</a> </h5>
                    </div>
                    <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#popularTopics">
                      <div class="card-body">We will send you your login details after creating your account.</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="heading5">
                      <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">How do I receive payments?</a> </h5>
                    </div>
                    <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#popularTopics">
                      <div class="card-body">Login your account click on request money fill the request form and click confirm then click finish.</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="accordion accordion-alternate" id="popularTopics2">
                  <div class="card">
                    <div class="card-header" id="heading6">
                      <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">How Can I View My Payments History?</a> </h5>
                    </div>
                    <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#popularTopics2">
                      <div class="card-body">Login your account click on transaction history.</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="heading7">
                      <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">Where is my refund?</a> </h5>
                    </div>
                    <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#popularTopics2">
                      <div class="card-body">Please exercise if your money has not been refunded yet we are working on it.</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="heading8">
                      <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse8" aria-expanded="false" aria-controls="collapse8">How do I request payments?</a> </h5>
                    </div>
                    <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#popularTopics2">
                      <div class="card-body">Login your account click on request fill the request form and click confirm then click finish.</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="heading3">
                      <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">Is my money safe with ChasetellerBank</a> </h5>
                    </div>
                    <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#popularTopics">
                      <div class="card-body">Your money is completely safe with us as you are free to withdraw it at any time you want.</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="heading10">
                      <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse10" aria-expanded="false" aria-controls="collapse10">Closing Your Account</a> </h5>
                    </div>
                    <div id="collapse10" class="collapse" aria-labelledby="heading10" data-parent="#popularTopics2">
                      <div class="card-body">Login to your account and then click on close your account.</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Popular Topics end -->
    
    <!-- Can't find
    ============================================= -->
    <section class="section py-4 my-4 py-sm-5 my-sm-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="bg-white shadow-sm rounded pl-4 pl-sm-0 pr-4 py-4">
              <div class="row no-gutters">
                <div class="col-12 col-sm-auto text-13 text-light d-flex align-items-center justify-content-center"> <span class="px-4 ml-3 mr-2 mb-4 mb-sm-0"><i class="far fa-envelope"></i></span> </div>
                <div class="col text-center text-sm-left">
                  <div class="">
                    <h5 class="text-3 text-body">Can't find what you're looking for?</h5>
                    <p class="text-muted mb-0">We want to answer all of your queries. Get in touch and we'll get back to you as soon as we can. <a class="btn-link" href="contact-us.php">Contact us<span class="text-1 ml-1"><i class="fas fa-chevron-right"></i></span></a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 mt-4 mt-lg-0">
            <div class="bg-white shadow-sm rounded pl-4 pl-sm-0 pr-4 py-4">
              <div class="row no-gutters">
                <div class="col-12 col-sm-auto text-13 text-light d-flex align-items-center justify-content-center"> <span class="px-4 ml-3 mr-2 mb-4 mb-sm-0"><i class="far fa-comment-alt"></i></span> </div>
                <div class="col text-center text-sm-left">
                  <div class="">
                    <h5 class="text-3 text-body">Technical questions</h5>
                    <p class="text-muted mb-0">Have some technical questions? Hit us up on live chat or whatever. <a class="btn-link" href="contact-us.php">Click here<span class="text-1 ml-1"><i class="fas fa-chevron-right"></i></span></a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Can't find end -->
    
  </div>
  <!-- Content end -->  

<?php 
  unset($_SESSION["page_title"]);
  unset($_SESSION["nav"]);
  include("footer.php"); 
?>