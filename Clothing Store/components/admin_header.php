


      <?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message" style="background: #ff6f61; color: #fff; padding: 10px 20px; border-radius: 5px; margin: 10px; display: flex; justify-content: space-between; align-items: center;">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();" style="cursor: pointer;"></i>
      </div>
      ';
   }
}
?>

<header class="header" style="background: linear-gradient(to right, #2c3e50, #34495e); box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); z-index: 999; position: sticky; top: 0;">

   <section class="flex" style="align-items: center; justify-content: space-between; padding: 10px 20px;">

      <a href="dashboard.php" class="logo" style="display: flex; align-items: center; text-decoration: none;">
         <img src="images/FOA Logo.png" alt="FOA Logo" width="50" height="50" style="border-radius: 50%; margin-right: 10px;">
         <span style="color: #ffd700; font-size: 24px; font-weight: bold;">Admin Panel</span>
      </a>

      <nav class="navbar" style="display: flex; gap: 20px;">
         <a href="dashboard.php" style="color: #fff; font-size: 16px; text-transform: uppercase; font-weight: 500; transition: color 0.3s;">Home</a>
         <a href="products.php" style="color: #fff; font-size: 16px; text-transform: uppercase; font-weight: 500; transition: color 0.3s;">Products</a>
         <a href="placed_orders.php" style="color: #fff; font-size: 16px; text-transform: uppercase; font-weight: 500; transition: color 0.3s;">Orders</a>
         <a href="admin_accounts.php" style="color: #fff; font-size: 16px; text-transform: uppercase; font-weight: 500; transition: color 0.3s;">Admins</a>
         <a href="users_accounts.php" style="color: #fff; font-size: 16px; text-transform: uppercase; font-weight: 500; transition: color 0.3s;">Users</a>
         <a href="messages.php" style="color: #fff; font-size: 16px; text-transform: uppercase; font-weight: 500; transition: color 0.3s;">Messages</a>
      </nav>

      <div class="icons" style="display: flex; align-items: center; gap: 20px;">
         <div id="menu-btn" class="fas fa-bars" style="color: #fff; font-size: 20px; cursor: pointer;"></div>
         <div id="user-btn" class="fas fa-user" style="color: #fff; font-size: 20px; cursor: pointer;" onclick="toggleProfile()"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">update profile</a>
         <div class="flex-btn">
            <a href="admin_login.php" class="option-btn">login</a>
            <a href="register_admin.php" class="option-btn">register</a>
         </div>
         <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
      </div>

   </section>

</header>

<script>
   // Function to toggle profile menu visibility
   function toggleProfile() {
      const profileMenu = document.getElementById('profileMenu');
      if (profileMenu.style.display === 'none' || profileMenu.style.display === '') {
         profileMenu.style.display = 'block';
      } else {
         profileMenu.style.display = 'none';
      }
   }

   // Close profile menu if clicked outside
   window.addEventListener('click', function (e) {
      const profileMenu = document.getElementById('profileMenu');
      const userBtn = document.getElementById('user-btn');
      if (!profileMenu.contains(e.target) && !userBtn.contains(e.target)) {
         profileMenu.style.display = 'none';
      }
   });
</script>
      