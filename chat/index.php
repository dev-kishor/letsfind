<?php
session_start();
include_once "../admin/config/db.php";
?>
<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php
          $user_code = $_SESSION['user_id'];

          $sql = mysqli_query($conn, "SELECT * FROM vv_users WHERE user_id = {$user_code}");
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          }
          ?>
          <img src="php/images/1680857293profile.jpg" alt="">
          <div class="details">
            <span><?php echo $row['first_name'] . " " . $row['last_name'] ?></span>
            <p><?php echo $row['user_status']; ?></p>
          </div>
        </div>
        </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">

      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>

</html>