<header class="header" style="background: linear-gradient(to right, #2c2c2c, #3a3a3a); box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">

   <section class="flex" style="align-items: center;">

      <a href="home.php" class="logo">
         <img src="images/FOA Logo.png" alt="FOA Logo" width="120" height="50" style="border-radius: 50%; border: 2px solid #ffd700;">
      </a>

      <nav class="navbar" style="display: flex; gap: 15px;">
         <a href="home.php" style="color: #fff; font-size: 18px; text-transform: uppercase; font-weight: 500; transition: color 0.3s;">Home</a>
         <a href="about.php" style="color: #fff; font-size: 18px; text-transform: uppercase; font-weight: 500; transition: color 0.3s;">About</a>
         <a href="menu.php" style="color: #fff; font-size: 18px; text-transform: uppercase; font-weight: 500; transition: color 0.3s;">Collection</a>
         <a href="orders.php" style="color: #fff; font-size: 18px; text-transform: uppercase; font-weight: 500; transition: color 0.3s;">Orders</a>
         <a href="contact.php" style="color: #fff; font-size: 18px; text-transform: uppercase; font-weight: 500; transition: color 0.3s;">Contact</a>
         <a href="admin/admin_login.php" style="color: #ffd700; font-size: 18px; text-transform: uppercase; font-weight: 600; transition: color 0.3s;">Admin Portal</a>
      </nav>

      <div class="icons" style="display: flex; align-items: center; gap: 20px;">
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="search.php" style="color: #fff; font-size: 20px;"><i class="fas fa-search"></i></a>
         <a href="cart.php" style="color: #fff; font-size: 20px; position: relative;">
            <i class="fas fa-shopping-cart"></i>
            <span style="position: absolute; top: -10px; right: -10px; background: #ffd700; color: #000; font-size: 14px; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; border-radius: 50%;"><?= $total_cart_items; ?></span>
         </a>
         <div id="user-btn" class="fas fa-user" style="color: #fff; font-size: 20px;"></div>
         <div id="menu-btn" class="fas fa-bars" style="color: #fff; font-size: 20px;"></div>
      </div>

      <div class="profile" style="background: #333; color: #fff; padding: 15px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name" style="font-size: 18px; font-weight: bold;"><?= $fetch_profile['name']; ?></p>
         <div class="flex" style="gap: 10px;">
            <a href="profile.php" class="btn" style="background: #ffd700; color: #000; padding: 10px 20px; border-radius: 5px; font-weight: bold;">Profile</a>
            <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn" style="background: #ff4d4d; color: #fff; padding: 10px 20px; border-radius: 5px; font-weight: bold;">Logout</a>
         </div>
         <p class="account" style="margin-top: 10px; font-size: 16px;">
            <a href="login.php" style="color: #ffd700;">Login</a> or
            <a href="register.php" style="color: #ffd700;">Register</a>
         </p> 
         <?php
            }else{
         ?>
         <p class="name" style="font-size: 18px; font-weight: bold;">Please login first!</p>
         <a href="login.php" class="btn" style="background: #ffd700; color: #000; padding: 10px 20px; border-radius: 5px; font-weight: bold;">Login</a>
         <?php
            }
         ?>
      </div>

   </section>

</header>
