<?php
include('db.php');
session_start(); // Start the session at the top
// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}
$query = "SELECT * FROM `carousel` ORDER BY id DESC ";
$result = mysqli_query($conn, $query); 
include('includes/header.php');
include('includes/sidebar.php');
?>

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
<form
    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
      
    </li>   
  

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
                <a href="slider_insert.php"><button type='submit' name='submit' class='btn btn-primary  float-right'>Create New Slider</button></a>
                <!-- Page Heading -->
                     
                    <h1 class="h3 mb-2 text-gray-800">Slider Table</h1>
                    <p class="mb-4">Slider Data Tables where you can  &nbsp;<span class=" font-weight-bold text-primary">Edit</span> , <span class=" font-weight-bold text-primary">Upadte</span> , <span class=" font-weight-bold text-danger">Delete</span> &nbsp; your data.
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Slider Table</h6>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Sr. No</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Button_Text</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tfoot>
            <tr>
            <th>Sr. No</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Button_Text</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </tfoot>
        <tbody>
        <?php
        if(mysqli_num_rows($result) > 0) {
            $sn = 1;
            while($data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $sn . "</td>";
                echo "<td>" . $data['title'] . "</td>";
                echo "<td>" . $data['subtitle'] . "</td>";
                echo "<td>" . $data['button_text'] . "</td>";
                echo "<td>" . $data['image'] . "</td>";
                echo "<td><a href='slider_edit.php?id=" . $data['id'] . "'><button type='submit' name='submit' class='btn btn-primary'>Edit</button></a></td>";
                echo "<td> <a href='javascript:void(0);' onclick='return confirmDelete(" . $data['id'] . ")'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
                $sn++;
            }
        } else {
            echo "<tr><td colspan='4'>No matching records found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

                        </div>
                    </div>

                </div>
</div>

                <!-- /.container-fluid -->

            <!-- End of Main Content -->

        <!-- End of Content Wrapper -->

    <!-- End of Page Wrapper -->

<script>
  function confirmDelete(id) {
    // SweetAlert confirmation dialog
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, keep it'
    }).then((result) => {
      if (result.isConfirmed) {
        // Proceed with the deletion by following the link with the id
        window.location.href = 'slider_delete.php?id=' + id;
      }
    });
    return false; // Prevent the default link click behavior
  }
</script>
    <?php
include('includes/scripts.php');
include('includes/footer.php');
?>
