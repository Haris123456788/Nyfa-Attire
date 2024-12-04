<?php
session_start();
include('includes/header.php');
include('db.php'); // Ensure db.php contains the connection to your database
?>

<body class="bg-gradient">

    <div class="container full-height d-flex align-items-center justify-content-center">
        <!-- Outer Row -->
        <div class="row justify-content-center w-100">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img src="../admin/img/fashion_4.jpg" alt="Login Image" class="img-fluid">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                                        </div>
                                        <input type="submit" name="login_btn" value="Login" class="btn btn-primary btn-user btn-block">
                                    </form>

                                    <?php
                                    if (isset($_POST['login_btn'])) {
                                        $email = mysqli_real_escape_string($conn, $_POST['email']);
                                        $password = mysqli_real_escape_string($conn, $_POST['password']);
                                    
                                        // Fetch user from the database
                                        $sql = "SELECT * FROM login WHERE email='$email'";
                                        $query = mysqli_query($conn, $sql);
                                    
                                        if ($query && mysqli_num_rows($query) == 1) {
                                            $user = mysqli_fetch_assoc($query);
                                    
                                            // Verify password
                                            if (password_verify($password, $user['password'])) {
                                                // Set session variables
                                                $_SESSION['logged_in'] = true;
                                                $_SESSION['user_id'] = $user['id'];
                                                $_SESSION['email'] = $user['email'];
                                    
                                                header('Location: index.php');
                                                exit();
                                            } else {
                                                echo "<div class='alert alert-danger mt-3'>Invalid email or password.</div>";
                                            }
                                        } else {
                                            echo "<div class='alert alert-danger mt-3'>Invalid email or password.</div>";
                                        }
                                    }
                                    
                                    ?>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include('includes/scripts.php');
    ?>
</body>
</html>
