
  <!-- Content
  ============================================= -->
  <div id="content" class="py-4">
    <div class="container">
      <div class="row">
        <!-- Left Panel
        ============================================= -->
        <aside class="col-lg-3">
          
          <!-- Profile Details
          =============================== --> 
          <div class="bg-light shadow-sm rounded text-center p-3 mb-4">
            <div class="profile-thumb mt-3 mb-4"> 
              <img class="rounded-circle" src="../uploads/users-avatar/<?php echo $user['image']; ?>" width="100" alt="User Avatar">
            </div>
            <p class="text-3 font-weight-500 mb-2">Hello, <?php echo ucwords($user["firstname"]." ".$user["lastname"]); ?></p>
            <p class="mb-2">
              <a href="profile.php" class="btn btn-primary btn-sm rounded-pill" data-toggle="tooltip" title="Edit Profile">
                <i class="fas fa-cog"></i> Settings
              </a>
            </p>
          </div>
          <!-- Profile Details End -->
          
          <!-- Available Balance
          =============================== -->
          <div class="bg-light shadow-sm rounded text-center p-3 mb-4">
            <div class="text-17 text-light my-3"><i class="fas fa-wallet"></i></div>
            <h3 class="text-9 font-weight-400"><?php echo print_currency($user["balance"], "USD"); ?></h3>
            <p class="mb-2 text-muted opacity-8">Available Balance</p>
            <hr class="mx-n3">
            <div class="d-flex">
              <a href="withdraw-money.php" class="btn-link mr-auto">Withdraw</a> 
              <a href="deposit-money.php" class="btn-link ml-auto">Deposit</a>
            </div>
          </div>
          <!-- Available Balance End -->
          
          <!-- Need Help?
          =============================== -->
          <div class="bg-light shadow-sm rounded text-center p-3 mb-4">
            <div class="text-17 text-light my-3"><i class="fas fa-comments"></i></div>
            <h3 class="text-3 font-weight-400 my-4">Need Help?</h3>
            <p class="text-muted opacity-8 mb-4">Have questions or concerns regrading your account?<br>
              Our experts are here to help!.</p>
            <a href="#" class="btn btn-primary btn-block">Chat with Us</a> 
          </div>
          <!-- Need Help? End -->
          
        </aside>
        <!-- Left Panel End -->