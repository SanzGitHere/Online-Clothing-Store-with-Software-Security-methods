<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>The Outer Clove - Dresses</title>

   <link rel="icon" href="images/LYgjKqzpQb.ico" type="image/x-icon">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      .box-container {
         display: flex;
         justify-content: space-between;
         flex-wrap: wrap;
      }

      .box {
         position: relative;
         overflow: hidden;
         transition: background-color 0.3s ease;
      }

      .box:hover {
         background-color: #f5f5f5;
      }
   </style>

</head>


<body>

<?php include 'components/user_header.php'; ?>


<section class="hero">

   <div class="swiper hero-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <div class="content">
               <span>Shop Now</span>
               <h3>Elegant Evening Dresses</h3>
               <a href="menu.php" class="btn">View Collection</a>
            </div>
            <div class="image">
               <img src="images/elegantevening2.webp" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>Shop Now</span>
               <h3>Stylish Workwear</h3>
               <a href="menu.php" class="btn">View Collection</a>
            </div>
            <div class="image">
               <img src="images/stylishworkwear.avif" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>Shop Now</span>
               <h3>Smart Casuals</h3>
               <a href="menu.php" class="btn">View Collection</a>
            </div>
            <div class="image">
               <img src="images/smartcasual.jpg" alt="">
            </div>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<section class="category" style="position: relative; background-image: url('images/dress-background.jpg'); background-size: cover; background-position: center;">

   <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.5); filter: blur(10px);"></div>

   <h1 class="title">Dress Categories</h1>

   <div class="box-container">

      <a href="category.php?category=evening dresses" class="box" style="background-color: #your_default_color;">
         <img src="images\evening dress.webp" alt="">
         <h3>Evening Dresses</h3>
      </a>

      <a href="category.php?category=workwear" class="box" style="background-color: #your_default_color;">
         <img src="images/workwear.jpg" alt="">
         <h3>Workwear</h3>
      </a>

      <a href="category.php?category=casual" class="box" style="background-color: #your_default_color;">
         <img src="images/casual.avif" alt="">
         <h3>Casual Dresses</h3>
      </a>

      <a href="category.php?category=party wear" class="box" style="background-color: #your_default_color;">
         <img src="images/party.jpg" alt="">
         <h3>Party Wear</h3>
      </a>

   </div>

</section>


<section class="products">

   <h1 class="title">Latest Dresses</h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
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
         }else{
            echo '<p class="empty">No dresses available yet!</p>';
         }
      ?>

   </div>

   <div class="more-btn">
      <a href="menu.html" class="btn">View All</a>
   </div>

</section>

<?php include 'components/footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});

</script>

</body>
</html>
