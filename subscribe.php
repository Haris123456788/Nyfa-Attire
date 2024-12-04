<?php
session_start();
include('db.php');

$response = array('status' => '', 'message' => '');

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if email already exists
    $check_email = "SELECT * FROM newsletter_subscriptions WHERE email = '$email'";
    $result = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($result) > 0) {
        $response['status'] = 'error';
        $response['message'] = 'This email is already subscribed!';
    } else {
        // Insert email into database
        $sql = "INSERT INTO newsletter_subscriptions (email) VALUES ('$email')";
        if (mysqli_query($conn, $sql)) {
            $response['status'] = 'success';
            $response['message'] = 'Subscription successful!';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Failed to subscribe. Please try again later.';
        }
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request.';
}

echo json_encode($response);
exit();
?>
