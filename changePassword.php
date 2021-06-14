<!DOCTYPE html>
<html lang="en">
    
    <?php
        include 'header.php';
    ?>
    
    <body>
        <?php
        include 'navbar.php';
        ?>

        <section class="section">
            <div class="container setting_center_container">

              <input class="input is-warning setting_elements_margin currentPassword" type="text" placeholder="Enter Current Password">
              <input class="input is-warning setting_elements_margin newPassword" type="text" placeholder="Enter New Password">
              <input class="input is-warning setting_elements_margin confirmPassword" type="text" placeholder="Confirm Password">
              
              <div class="buttons">
                <a class="button is-primary changePassBtn">Save</a>
              </div>
            </div>
        </section>

        <?php
            include 'scripts.php';
        ?>
        <script src="js/changePassword.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </body>
</html>