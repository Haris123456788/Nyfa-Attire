<?php
include('db.php');
session_start();
// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}
$id = $_GET['id'];
$sql = "SELECT * FROM special_products WHERE id=$id";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);

include('includes/header.php');
include('includes/sidebar.php');
?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav ml-auto">
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

        <div class="container">
            <div class="form-container">
                <h2 class="form-title">Edit Special Collection Details</h2>
                <form id="carouselForm" method="POST" enctype="multipart/form-data" action="special_update.php?id=<?php echo $row['id']; ?>" style="padding: 30px;">
                    <div class="form-group">
                        <label for="name_short">Name:</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" placeholder="Enter name" required>
                    </div>

            

                    <div class="form-group">
                        <label for="name_long">Price:</label>
                        <input type="text" class="form-control" name="price" value="<?php echo $row['price']; ?>" placeholder="Enter price" required>
                    </div>

                    

                  
                    <div class="form-group">
    <label for="current_image">Current Image:</label><br>
    <?php if (!empty($row['image'])): ?>
        <img src="../images/<?php echo $row['image']; ?>" alt="Current Image" style="max-width: 200px; max-height: 200px;"/><br>
        <small>Current image path: <?php echo $row['image']; ?></small>
    <?php else: ?>
        <p>No image uploaded.</p>
    <?php endif; ?>
</div>

<div class="form-group">
    <label for="image">Upload New Image (optional):</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
        <label class="custom-file-label" id="fileNameLabel" for="image">Choose file</label>
    </div>
    <div id="imagePreview" class="image-preview" style="display: none;">
        <img id="previewImg" src="#" alt="Image Preview" style="max-width: 200px; max-height: 200px;"/>
    </div>
</div>

<button type="submit" name="submit" class="btn btn-custom">Update</button>
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
    const fileNameLabel = document.getElementById('fileNameLabel');

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            // Update the preview image
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
    $(document).ready(function () {
        $('#carouselForm').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            // Serialize form data
            var formData = new FormData(this);

            // Send AJAX request
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'), // Use the form's `action` attribute for the URL
                data: formData,
                processData: false,  // Prevent jQuery from processing the data
                contentType: false,  // Let the browser set the content type
                success: function (response) {
                    // Parse the JSON response
                    var responseObj = JSON.parse(response);

                    // Show SweetAlert based on the response
                    Swal.fire({
                        title: responseObj.message,
                        icon: responseObj.status,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Redirect to the collection table if successful
                        if (responseObj.status === 'success') {
                            window.location.href = responseObj.redirect; // Redirect after message
                        }
                    });
                },
                error: function (xhr, status, error) {
                    // Handle AJAX errors
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong. Please try again later.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
    </script>
</div>

