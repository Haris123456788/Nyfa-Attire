<?php
include('db.php');
session_start();

// Check if the form has been submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id']; // Get the ID from the URL
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Prepare the SQL update statement
    $sql = "UPDATE `top_rated` SET
                name = '" . mysqli_real_escape_string($conn, $name) . "',
                price = '" . mysqli_real_escape_string($conn, $price) . "'";

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../images/";
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats (optional)
        $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowedTypes)) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                // Update the SQL statement to include the new image path
                $sql .= ", image = '" . mysqli_real_escape_string($conn, $fileName) . "'";
            } else {
                echo json_encode([ 
                    'message' => 'Failed to upload image.',
                    'status' => 'error'
                ]);
                exit;
            }
        } else {
            echo json_encode([ 
                'message' => 'Invalid file format.',
                'status' => 'error'
            ]);
            exit;
        }
    }

    // Complete the SQL statement with the WHERE clause
    $sql .= " WHERE id = $id";

    // Execute query
    if (mysqli_query($conn, $sql)) {
        // Return success response as JSON
        echo json_encode([
            'message' => 'Top Rated Updated Successfully',
            'status' => 'success',
            'redirect' => 'top_rated_table.php' // Specify the redirect URL
        ]);
    } else {
        // Return error response as JSON
        echo json_encode([
            'message' => 'Failed to update top rated: ' . mysqli_error($conn),
            'status' => 'error'
        ]);
    }
    exit;
}
?>
