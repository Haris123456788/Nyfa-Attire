<?php
include('db.php');
session_start();

// Check if the form has been submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id']; // Get the ID from the URL
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $rating = $_POST['rating'];
    $label = $_POST['label'];

    // Prepare the SQL update statement
    $sql = "UPDATE `collection` SET
                name = '" . mysqli_real_escape_string($conn, $name) . "',
                category = '" . mysqli_real_escape_string($conn, $category) . "',
                price = '" . mysqli_real_escape_string($conn, $price) . "',
                rating = '" . mysqli_real_escape_string($conn, $rating) . "',
                label = '" . mysqli_real_escape_string($conn, $label) . "'";

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
            'message' => 'Collection Updated Successfully',
            'status' => 'success',
            'redirect' => 'collection_table.php' // Specify the redirect URL
        ]);
    } else {
        // Return error response as JSON
        echo json_encode([
            'message' => 'Failed to update collection: ' . mysqli_error($conn),
            'status' => 'error'
        ]);
    }
    exit;
}
?>