<!DOCTYPE html>
<html lang="en">
  
    <?php
      include 'header.php';
    ?>
  <body>

    <?php
      include 'navbar.php';
    ?>
    <!-- has-background-primary-light disable -->
    <div class="container is-max-desktop">
      <div class="notification is-primary setting_lable">
        Settings
      </div>
    </div>

    <section class="section">
      <div class="container setting_center_container">

        <div class="wrapper1 setting_elements_margin">
          <img src="https://images.unsplash.com/photo-1484608856193-968d2be4080e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" alt="">
          <input type="file" name="" class="my_file">
        </div>
        
        <div class="wrapper2 setting_elements_margin">
          <img src="https://images.unsplash.com/photo-1484608856193-968d2be4080e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" alt="">
          <input type="file" name="" class="my_file">
        </div>

        <!-- <input class="input is-primary setting_elements_margin" type="text" placeholder="Enter new user name"> -->
        <textarea class="textarea is-primary setting_elements_margin" placeholder="Enter new Description"></textarea>
        
        <div class="buttons">
          <a class="button is-primary save">Save</a>
          <a class="button is-primary" href="changePassword.php">Change Password</a>
        </div>
      </div>
    </section>

    <?php
      include 'uploadModal.php';
      include 'scripts.php';
    ?>
    <script src="js/setting.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </body>
</html>