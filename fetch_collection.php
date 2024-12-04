<?php
include('db.php');

// Fetch products from the database
$products_query = "SELECT * FROM collection";
$products_result = $conn->query($products_query);

if ($products_result->num_rows > 0):
    while ($row = $products_result->fetch_assoc()): ?>
        <div class="col-md-6 col-lg-4 col-xl-3 p-2 collection-item <?php echo $row['category']; ?>">
            <div class="collection-img position-relative">
                <img src="images/placeholder.jpg" data-src="images/<?php echo $row['image']; ?>" class="w-100 lazy" loading="lazy">
                <?php if (!empty(trim($row['label']))): ?>
                    <span class="position-absolute bg-primary text-white d-flex align-items-center justify-content-center">
                        <?php echo $row['label']; ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="text-center">
                <div class="rating mt-3">
                    <?php for ($i = 0; $i < $row['rating']; $i++): ?>
                        <span class="text-primary"><i class="fas fa-star"></i></span>
                    <?php endfor; ?>
                </div>
                <p class="text-capitalize my-1"><?php echo $row['name']; ?></p>
                <span class="fw-bold">$ <?php echo number_format($row['price'], 2); ?></span>
            </div>
        </div>
    <?php endwhile;
else: ?>
    <p class="text-center">No products available.</p>
<?php endif; ?>
