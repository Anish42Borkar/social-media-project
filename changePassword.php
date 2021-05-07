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

              <input class="input is-primary setting_elements_margin" type="text" placeholder="Enter Current Password">
              <input class="input is-primary setting_elements_margin" type="text" placeholder="Enter New Password">
              <input class="input is-primary setting_elements_margin" type="text" placeholder="Confirm Password">
              
              <div class="buttons">
                <a class="button is-primary">Save</a>
              </div>
            </div>
        </section>

        <?php
            include 'scripts.php';
        ?>
    </body>
</html>