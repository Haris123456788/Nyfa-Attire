<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

include('includes/header.php');
include('includes/sidebar.php');
?>
        <!-- Sidebar -->
        
        <!-- End of Sidebar -->

       <!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                    aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['email']; ?></span>
                    <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    
                    <a class="dropdown-item" href="logout.php">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                       
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                    <?php
include('db.php'); // Include your database connection

// Initialize counts
$collectionsCount = 0;
$specialSelectionCount = 0;
$topRatedCount = 0;
$emailSubscriptionsCount = 0;

// Query for Collections count
$query_collections = "SELECT COUNT(*) AS total FROM collection";
$result_collections = mysqli_query($conn, $query_collections);
if ($result_collections) {
    $row = mysqli_fetch_assoc($result_collections);
    $collectionsCount = $row['total'] ?? 0;
}

// Query for Special Selection count
$query_special_selection = "SELECT COUNT(*) AS total FROM special_products";
$result_special_selection = mysqli_query($conn, $query_special_selection);
if ($result_special_selection) {
    $row = mysqli_fetch_assoc($result_special_selection);
    $specialSelectionCount = $row['total'] ?? 0;
}

// Query for Top Rated count
$query_top_rated = "SELECT COUNT(*) AS total FROM top_rated";
$result_top_rated = mysqli_query($conn, $query_top_rated);
if ($result_top_rated) {
    $row = mysqli_fetch_assoc($result_top_rated);
    $topRatedCount = $row['total'] ?? 0;
}

// Query for Email Subscriptions count
$query_email_subscriptions = "SELECT COUNT(*) AS total FROM newsletter_subscriptions";
$result_email_subscriptions = mysqli_query($conn, $query_email_subscriptions);
if ($result_email_subscriptions) {
    $row = mysqli_fetch_assoc($result_email_subscriptions);
    $emailSubscriptionsCount = $row['total'] ?? 0;
}
?>




  <!-- Collections Card -->
  <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Collections</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $collectionsCount; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-folder-open fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Special Selection Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Special Selection</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $specialSelectionCount; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-star fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Rated Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Top Rated</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    <?php echo $topRatedCount; ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Email Subscriptions Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Email Subscriptions</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $emailSubscriptionsCount; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-envelope fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                    <!-- Content Row -->

                    

                    <!-- Content Row -->
                  
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           
    <?php
include('includes/scripts.php');
include('includes/footer.php');
?>
   

   
   

