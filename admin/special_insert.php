<?php
include('db.php');
session_start();
// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}
// Check if the form has been submitted via AJAX
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

   // Handle file upload
$imageName = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    // Get the file details
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageName = basename($_FILES['image']['name']);  // Only the file name
    $imagePath = '../images/' . $imageName;  // Full path to store the image

    // Check the file type (allow only jpg, png, jpeg, gif)
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

    if (in_array($imageFileType, $allowedTypes)) {
        // Move the file to the images folder
        if (move_uploaded_file($imageTmpName, $imagePath)) {
            // File uploaded successfully
        } else {
            echo json_encode([
                'message' => 'Failed to upload image.',
                'status' => 'error'
            ]);
            exit();
        }
    } else {
        echo json_encode([
            'message' => 'Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.',
            'status' => 'error'
        ]);
        exit();
    }
}

    // Prepare SQL query to insert data
    $sql = "INSERT INTO `special_products` (`name`, `price`, `image`) 
    VALUES ('$name', '$price', '$imageName')";  // Insert only the file name

    // Execute the query
    $query = mysqli_query($conn, $sql);

    // Prepare response
    if ($query) {
        // Return success message as JSON
        echo json_encode([
            'message' => 'Special Selection created successfully',
            'status' => 'success'
        ]);
    } else {
        // Return error message as JSON
        echo json_encode([
            'message' => 'Failed to create collection: ' . mysqli_error($conn),
            'status' => 'error'
        ]);
    }
    exit();
}

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
        <!-- Dropdown - Messages -->
      
    </li>

    <!-- Nav Item - Alerts -->
   

    <!-- Nav Item - Messages -->
   
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
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Special Selection Details</h2>
            <form id="carouselForm" method="POST" style="padding: 30px;">
    <!-- Name Field -->
    <div class="form-group">
        <label for="name_short">Name:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
    </div>

     <!-- Price Field -->
    <div class="form-group">
        <label for="name_long">Price:</label>
        <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" required>
    </div>

   <!-- Image Upload Field -->
   <div class="form-group">
    <label for="image">Image:</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" required>
        <label class="custom-file-label" for="image">Choose file</label>
    </div>
    <div id="imagePreview" class="image-preview" style="display: none;">
        <img id="previewImg" src="#" alt="Image Preview" style="max-width: 200px; max-height: 200px;"/>
    </div>
</div>


    <button type="submit" name="submit" class="btn btn-custom">Submit</button>
</form>

        </div>
        </div>
</div>

    <?php
include('includes/scripts.php');
include('includes/footer.php');
?>
<script>
document.getElementById('image').addEventListener('change', function() {
    const file = this.files[0];
    const previewImg = document.getElementById('previewImg');
    const imagePreview = document.getElementById('imagePreview');
    const fileNameLabel = document.querySelector('.custom-file-label');

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            previewImg.setAttribute('src', e.target.result);
            imagePreview.style.display = 'block'; // Show the preview
        }

        reader.readAsDataURL(file);

        // Update the label with the file name
        fileNameLabel.textContent = file.name;
    } else {
        imagePreview.style.display = 'none'; // Hide the preview if no file is selected
        fileNameLabel.textContent = 'Choose file'; // Reset label
    }
});
</script>

<script>
    $(document).ready(function() {
        $('#carouselForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Create FormData object to handle file upload
            var formData = new FormData(this);

            // Send AJAX request
            $.ajax({
                type: 'POST',
                url: '', // Same file for AJAX processing
                data: formData,
                processData: false,  // Do not process the data
                contentType: false,  // Do not set content type
                success: function(response) {
                    // Parse the JSON response from the server
                    var responseObj = JSON.parse(response);

                    // Show SweetAlert with the response message
                    swal({
                        title: responseObj.message,
                        icon: responseObj.status,
                        button: "OK",
                    }).then(function() {
                        // Redirect to collection_table.php after the alert is closed
                        window.location.href = 'special_table.php';
                    });
                },
                error: function(xhr, status, error) {
                    // If there's an error with the AJAX request
                    swal({
                        title: "Something went wrong!",
                        icon: "error",
                        button: "OK",
                    });
                }
            });
        });
    });
</script>


   
