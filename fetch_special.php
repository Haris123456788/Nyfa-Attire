<?php
include('db.php');

// Fetch special products from the database
$query = "SELECT * FROM special_products";
$result = $conn->query($query);

if ($result->num_rows > 0):
    while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-6 col-lg-4 col-xl-3 p-2">
            <div class="special-img position-relative overflow-hidden">
                <img src="images/placeholder.jpg" data-src="images/<?php echo $row['image']; ?>" class="w-100 lazy" loading="lazy">
                <span class = "position-absolute d-flex align-items-center justify-content-center text-primary fs-4">
                            <i class = "fas fa-heart"></i>
                        </span>
            </div>
            <div class="text-center">
                <p class="text-capitalize mt-3 mb-1"><?php echo $row['name']; ?></p>
                <span class="fw-bold d-block">$ <?php echo number_format($row['price'], 2); ?></span>
                <a href="#" class="btn btn-primary mt-3">Add to Cart</a>
            </div>
        </div>
    <?php endwhile;
else: ?>
    <p class="text-center">No special products available.</p>
<?php endif; ?>