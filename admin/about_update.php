<?php
include('db.php');
session_start();

// Check if the form has been submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id']; // Get the ID from the URL
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $description = $_POST['description'];
   

    // Prepare the SQL update statement
    $sql = "UPDATE `about` SET
                title = '" . mysqli_real_escape_string($conn, $title) . "',
                subtitle = '" . mysqli_real_escape_string($conn, $subtitle) . "',
                description = '" . mysqli_real_escape_string($conn, $description) . "'";

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
            'message' => 'About Updated Successfully',
            'status' => 'success',
            'redirect' => 'about_table.php' // Specify the redirect URL
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
