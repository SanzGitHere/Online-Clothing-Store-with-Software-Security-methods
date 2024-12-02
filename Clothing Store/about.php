<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>
   <link rel="icon" href="images/LYgjKqzpQb.ico" type="image/x-icon">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->


<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about.webp" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>At F.O.A, where we embody an active lifestyle and celebrate the spirit of freedom. Our brand represents more than just clothing; it's a movement that encourages you to break free from limitations, pursue your passions, and live life on your own terms. At F.O.A, we believe in the power of freedom. It's the driving force behind everything we do, from designing high-quality apparel to creating a vibrant community. We aim to inspire individuals to embrace their true selves and chase their dreams fearlessly. Our customers and followers mean the world to us. You are the heartbeat of our community, and your support fuels our passion to continually push boundaries. We built this brand with you in mind, striving to provide you with apparel that not only looks great but also reflects your adventurous spirit.

To our incredible team, thank you for being the backbone of this organization. Your dedication, creativity, and commitment to our brand's vision are invaluable. Together, we form a tight-knit family, working harmoniously to bring F.O.A's ethos to life. Join us on this journey as we embark on new adventures, embrace challenges, and celebrate the freedom that lies within each of us. Together, let's inspire the world to prioritize freedom over anything.
</p>

      </div>

   </div>

</section>

<!-- about section ends -->





<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=






<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>