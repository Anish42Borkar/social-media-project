<!DOCTYPE html>
<html lang="en">
    
    <?php
        include 'header.php';
    ?>
    <body>
        <?php
        include 'navbar.php';
        ?>

        <div class="container is-max-desktop">
            <div class="notification is-primary setting_lable">
              Admin Panel
            </div>
          </div>

        <section class="section">
            <div class="container admin-panel-center">
                <div class="admin-panel-card post">
                    <p>Posts</p>
                </div>

                <div class="admin-panel-card report">
                    <p>Report</p>
                </div>

                <div class="admin-panel-card comments">
                    <p>Comments</p>
                </div>
            </div>
        </section>
        
        <?php
            include 'scripts.php';
        ?>
    </body>
</html>