<?php

include 'components/connect.php';

// Start session at the top
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

// CAPTCHA Logic
$captchaError = ''; // For displaying CAPTCHA errors
$captchaPassed = false; // For checking if CAPTCHA is solved

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['captcha']) && isset($_SESSION['captcha_answer']) && $_POST['captcha'] == $_SESSION['captcha_answer']) {
        $captchaPassed = true;
    } else {
        $captchaError = "Invalid CAPTCHA. Please try again.";
    }
}

// Generate CAPTCHA only if it is not passed
if (!$captchaPassed) {
    $num1 = rand(1, 10);
    $num2 = rand(1, 10);
    $_SESSION['captcha_answer'] = $num1 + $num2;
}

include 'components/add_cart.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Menu</title>
   <link rel="icon" href="images/LYgjKqzpQb.ico" type="image/x-icon">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>our menu</h3>
   <p><a href="home.php">home</a> <span> / menu</span></p>
</div>

<!-- CAPTCHA Section -->
<?php if (!$captchaPassed): ?>
<section class="captcha-section">
   <div class="form-container">
      <h1 class="title">Verify You Are Human</h1>
      <form action="menu.php" method="POST" class="captcha-form">
         <label for="captcha">What is <?php echo $num1; ?> + <?php echo $num2; ?>?</label>
         <input type="text" id="captcha" name="captcha" required>
         <button type="submit" class="btn">Verify</button>
      </form>
      <?php if ($captchaError): ?>
         <p style="color: red;"><?php echo $captchaError; ?></p>
      <?php endif; ?>
   </div>
</section>
<?php else: ?>

<!-- menu section starts  -->

<section class="products">

   <h1 class="title">latest dishes</h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="flex">
            <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
      <?php
            }
         } else {
            echo '<p class="empty">No products added yet!</p>';
         }
      ?>

   </div>

</section>

<?php endif; ?>

<!-- menu section ends -->

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
