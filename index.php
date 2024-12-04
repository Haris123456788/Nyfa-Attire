<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attire Home</title>
    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap css -->
    <link rel = "stylesheet" href = "bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <!-- custom css -->
    <link rel = "stylesheet" href = "css/main.css">
</head>
<body>
    
      <!-- navbar -->
  <?php include("header.php");  ?>
    <!-- end of navbar -->

   <!-- header -->

   <?php
include('db.php');

$carousel_query = "SELECT * FROM carousel";
$carousel_result = $conn->query($carousel_query);
?>

<header id="header" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php
        if ($carousel_result->num_rows > 0):
            $isActive = true;
            while ($row = $carousel_result->fetch_assoc()):
        ?>
        <!-- Dynamic Carousel Item -->
        <div class="carousel-item <?php echo $isActive ? 'active' : ''; ?>" 
     style="background-image: url('images/<?php echo $row['image']; ?>'); 
            background-size: cover; 
            background-position: center; 
            height: 100vh;">

<div class="container h-100 d-flex flex-column justify-content-center align-items-center text-center text-white">
                <h2 class="text-capitalize"><?php echo $row['title']; ?></h2>
                <h1 class="text-uppercase py-2 fw-bold"><?php echo $row['subtitle']; ?></h1>
                <a href="#" class="btn mt-3 text-uppercase"><?php echo $row['button_text']; ?></a>
            </div>
        </div>
        <?php
            $isActive = false; // Ensure only the first item is marked active
            endwhile;
        else:
        ?>
        <p class="text-white text-center">No carousel items available.</p>
        <?php endif; ?>
    </div>

    <!-- Carousel Controls -->
    <?php if ($carousel_result->num_rows > 1): ?>
        <button class="carousel-control-prev" type="button" data-bs-target="#header" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    <?php endif; ?>
</header>


    <!-- end of header -->


<!-- Collection Section -->
<section id="collection" class="py-5">
    <div class="container">
        <div class="title text-center">
            <h2 class="position-relative d-inline-block">New Collection</h2>
        </div>

        <div class="row g-0">
            <!-- Filter Buttons -->
            <div class="d-flex flex-wrap justify-content-center mt-5 filter-button-group">
                <button type="button" class="btn m-2 text-dark active-filter-btn" data-filter="*">All</button>
                <button type="button" class="btn m-2 text-dark" data-filter=".best">Best Sellers</button>
                <button type="button" class="btn m-2 text-dark" data-filter=".feat">Featured</button>
                <button type="button" class="btn m-2 text-dark" data-filter=".new">New Arrival</button>
            </div>

            <!-- Product Items -->
            <div class="collection-list mt-4 row gx-0 gy-3">
                <!-- AJAX Content Will Load Here -->
            </div>
        </div>
    </div>
</section>

<!-- End of Collection Section -->

    
    
   <!-- Special Products Section -->
<section id="special" class="py-5">
    <div class="container">
        <div class="title text-center py-5">
            <h2 class="position-relative d-inline-block">Special Selection</h2>
        </div>

        <div class="special-list row g-0">
            <!-- AJAX Content Will Load Here -->
        </div>
    </div>
</section>
<!-- End of Special Products Section -->
    
<?php
include('db.php');

// Fetching the offer details from the database
$offer_query = "SELECT * FROM offer LIMIT 1"; // Adjust the query if needed
$offer_result = $conn->query($offer_query);



if ($offer_result->num_rows > 0) {
    $offer_row = $offer_result->fetch_assoc();
    $image = $offer_row['image']; // Assuming 'offer_image' is the field storing the image name
    $text = $offer_row['text']; // Assuming 'discount_text' is the field for discount text
    $title = $offer_row['title']; // Assuming 'offer_title' is the field for title
    $button_text = $offer_row['button_text']; // Assuming 'button_text' is the field for button text
}
?>

<!-- offers -->
<section id="offers" class="py-5" 
    style="background-image: url('images/<?php echo $image; ?>'); 
           background-size: cover; 
           background-position: center;">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center text-center justify-content-lg-start text-lg-start">
            <div class="offers-content">
                <span class="text-white"><?php echo $text; ?></span>
                <h2 class="mt-2 mb-4 text-white"><?php echo $title; ?></h2>
                <a href="#" class="btn"><?php echo $button_text; ?></a>
            </div>
        </div>
    </div>
</section>
<!-- end of offers -->


   
     <!-- Top rated products -->
     <section id="top-rated" class="py-5">
    <div class="container">
        <div class="title text-center py-5">
            <h2 class="position-relative d-inline-block">Top Rated</h2>
        </div>

        <div class="top-rated-list row g-0">
            <!-- AJAX Content Will Load Here -->
        </div>
    </div>
</section>
    <!-- end of Top rated products -->

    <!-- about us -->
    <?php
include('db.php');

// Fetch about data from the database
$about_query = "SELECT * FROM about";
$about_result = $conn->query($about_query);
$about_data = $about_result->fetch_assoc(); // Assuming there's only one row for about us data
?>

<section id="about" class="py-5">
    <div class="container">
        <div class="row gy-lg-5 align-items-center">
            <div class="col-lg-6 order-lg-1 text-center text-lg-start">
                <div class="title pt-3 pb-5">
                    <h2 class="position-relative d-inline-block ms-4">
                        <?php echo $about_data['title']; ?>
                    </h2>
                </div>
                <p class="lead text-muted"><?php echo $about_data['subtitle']; ?></p>
                <p><?php echo $about_data['description']; ?></p>
            </div>
            <div class="col-lg-6 order-lg-0">
                <img src="images/<?php echo $about_data['image']; ?>" alt="About Us" class="img-fluid">
            </div>
        </div>
    </div>
</section>

    <!-- end of about us -->

    <!-- popular -->
    <?php
include('db.php');

// Fetch products for each category from the respective tables
$top_rated_query = "SELECT * FROM top_rated LIMIT 3";  // Query for the top-rated products table
$best_selling_query = "SELECT * FROM collection WHERE category = 'best' LIMIT 3";
$on_sale_query = "SELECT * FROM collection WHERE label = 'sale' LIMIT 3";  // Updated query to limit the result to 3 items

$top_rated_result = $conn->query($top_rated_query);
$best_selling_result = $conn->query($best_selling_query);
$on_sale_result = $conn->query($on_sale_query);
?>

<section id="popular" class="py-5">
    <div class="container">
        <div class="title text-center pt-3 pb-5">
            <h2 class="position-relative d-inline-block ms-4">Popular Of This Year</h2>
        </div>

        <div class="row">
            <!-- Top Rated Section -->
            <div class="col-md-6 col-lg-4 row g-3">
                <h3 class="fs-5">Top Rated</h3>
                <?php if ($top_rated_result->num_rows > 0): ?>
                    <?php while ($row = $top_rated_result->fetch_assoc()): ?>
                        <div class="d-flex align-items-start justify-content-start">
                            <img src="images/<?php echo $row['image']; ?>" alt="" class="img-fluid pe-3 w-25">
                            <div>
                                <p class="mb-0"><?php echo $row['name']; ?></p>
                                <span>$ <?php echo number_format($row['price'], 2); ?></span>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No top-rated products available.</p>
                <?php endif; ?>
            </div>

            <!-- Best Selling Section -->
            <div class="col-md-6 col-lg-4 row g-3">
                <h3 class="fs-5">Best Selling</h3>
                <?php if ($best_selling_result->num_rows > 0): ?>
                    <?php while ($row = $best_selling_result->fetch_assoc()): ?>
                        <div class="d-flex align-items-start justify-content-start">
                            <img src="images/<?php echo $row['image']; ?>" alt="" class="img-fluid pe-3 w-25">
                            <div>
                                <p class="mb-0"><?php echo $row['name']; ?></p>
                                <span>$ <?php echo number_format($row['price'], 2); ?></span>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No best-selling products available.</p>
                <?php endif; ?>
            </div>

            <!-- On Sale Section -->
            <div class="col-md-6 col-lg-4 row g-3">
                <h3 class="fs-5">On Sale</h3>
                <?php if ($on_sale_result->num_rows > 0): ?>
                    <?php while ($row = $on_sale_result->fetch_assoc()): ?>
                        <div class="d-flex align-items-start justify-content-start">
                            <img src="images/<?php echo $row['image']; ?>" alt="" class="img-fluid pe-3 w-25">
                            <div>
                                <p class="mb-0"><?php echo $row['name']; ?></p>
                                <span>$ <?php echo number_format($row['price'], 2); ?></span>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No products on sale.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

    <!-- end of popular -->
   <!-- Newsletter -->
   <section id="newsletter" class="py-5">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <div class="title text-center pt-3 pb-5">
                    <h2 class="position-relative d-inline-block ms-4">Newsletter Subscription</h2>
                </div>

                <p class="text-center text-muted">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus rem officia accusantium maiores quisquam dolorum?
                </p>

                <form id="subscribeForm">
    <div class="input-group mb-3 mt-3">
        <input type="email" id="email" class="form-control" placeholder="Enter Your Email ..." required>
        <button class="btn btn-primary" type="button" id="subscribeBtn">Subscribe</button>
    </div>
</form>

            </div>
        </div>
    </section>
    <!-- End of Newsletter -->

    

    <!-- footer -->
    <?php include("footer.php");  ?>
    <!-- end of footer -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector(".navbar");
    const header = document.querySelector("#header");

    if (navbar && header) {
        // Get the navbar height
        const navbarHeight = navbar.offsetHeight;

        // Set the margin dynamically
        header.style.marginTop = `${navbarHeight}px`;

        // Adjust for mobile screens
        if (window.innerWidth <= 768) {
            header.style.marginTop = `${navbarHeight}px`;
        }
    }
});

</script>
<!-- Include jQuery -->
<script src="js/jquery-3.6.0.js"></script>
  <!-- Include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.min.js"></script>

<!-- Show SweetAlert for Feedback Using Ajax -->
<script>
    $(document).ready(function () {
        $('#subscribeBtn').click(function () {
            const email = $('#email').val();
            
            // Regular Expression to validate email format
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email.trim() === '') {
                swal({
                    title: "Error",
                    text: "Email is required!",
                    icon: "error",
                    button: "OK",
                });
                return;
            }

            if (!emailRegex.test(email)) {
                swal({
                    title: "Invalid Email",
                    text: "Please enter a valid email address!",
                    icon: "warning",
                    button: "OK",
                });
                return;
            }

            $.ajax({
                url: 'subscribe.php',
                type: 'POST',
                data: { email: email },
                dataType: 'json',
                success: function (response) {
                    swal({
                        title: response.status === 'success' ? "Success" : "Error",
                        text: response.message,
                        icon: response.status,
                        button: "OK",
                    });
                    if (response.status === 'success') {
                        $('#email').val(''); // Clear the email field
                    }
                },
                error: function () {
                    swal({
                        title: "Error",
                        text: "Something went wrong. Please try again.",
                        icon: "error",
                        button: "OK",
                    });
                }
            });
        });
    });
</script>



<!-- Include ImagesLoaded -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.4/imagesloaded.pkgd.min.js"></script>

<!-- Include Isotope -->
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>


<!-- Include Bootstrap -->
<script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>


<!-- Include Custom Script -->
<script src="js/script.js"></script>




</body>
</html>