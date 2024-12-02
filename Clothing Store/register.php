<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {
    // CAPTCHA Verification
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $secretKey = "6LdYvI4qAAAAALWjS-o-RWJUBwF_43z7epa2z8e2"; // Replace with your secret key
    $verifyURL = "https://www.google.com/recaptcha/api/siteverify";

    // Send POST request to Google for verification
    $response = file_get_contents($verifyURL . "?secret=" . $secretKey . "&response=" . $recaptchaResponse);
    $responseData = json_decode($response);

    if (!$responseData->success) {
        $message[] = 'CAPTCHA verification failed. Please try again.';
    } else {
        // Proceed with form validation and user registration
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_SPECIAL_CHARS);
        $number = $_POST['number'];
        $number = filter_var($number, FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_SPECIAL_CHARS);
        $cpass = sha1($_POST['cpass']);
        $cpass = filter_var($cpass, FILTER_SANITIZE_SPECIAL_CHARS);

        $select_user = $conn->prepare("SELECT * FROM users WHERE email = ? OR number = ?");
        $select_user->execute([$email, $number]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if ($select_user->rowCount() > 0) {
            $message[] = 'Email or number already exists!';
        } else {
            if ($pass != $cpass) {
                $message[] = 'Confirm password does not match!';
            } else {
                $insert_user = $conn->prepare("INSERT INTO users(name, email, number, password) VALUES(?,?,?,?)");
                $insert_user->execute([$name, $email, $number, $cpass]);
                $select_user = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
                $select_user->execute([$email, $pass]);
                $row = $select_user->fetch(PDO::FETCH_ASSOC);
                if ($select_user->rowCount() > 0) {
                    $_SESSION['user_id'] = $row['id'];
                    header('location:home.php');
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" href="images/LYgjKqzpQb.ico" type="image/x-icon">

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Custom CSS File Link -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<!-- Header Section Starts -->
<?php include 'components/user_header.php'; ?>
<!-- Header Section Ends -->

<section class="form-container" style="background-color: white;">

    <form action="" method="post">
        <h3>Register</h3>
        <input type="text" name="name" required placeholder="Enter your name" class="box" maxlength="50">
        <input type="email" name="email" required placeholder="Enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="number" name="number" required placeholder="Enter your number" class="box" min="0" max="9999999999" maxlength="10">
        <input type="password" name="pass" required placeholder="Enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="cpass" required placeholder="Confirm your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        
        <!-- Google reCAPTCHA widget -->
        <div class="g-recaptcha" data-sitekey="6LdYvI4qAAAAAEeMkh6TMzbyZLzI0jRCRxFvRsob"></div>

        <input type="submit" value="Register Now" name="submit" class="btn">
        <p>Already have an account? <a href="login.php">Login</a></p>
    </form>

</section>

<!-- Footer Section -->
<?php include 'components/footer.php'; ?>

<!-- Custom JS File Link -->
<script src="js/script.js"></script>

<!-- Google reCAPTCHA API -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>
</html>