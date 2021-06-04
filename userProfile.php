<!DOCTYPE html>

<html>

    <?php
        include 'header.php';
    ?>

    <body>
        <?php
        include 'navbar.php';
        ?>

        <!-- profile information -->
        <div class="profileinfo">

            <div class="center">
                <figure class="profile_img"><img src="Images/random.jpg"></figure>

                <h1 class="username"></h1>

                <div class="follow-container">
                    <span class="followers">Followers <span class="followers-count">1m</span></span>
                    <span class="following">Following <span class="following-count">1k</span></span>
                </div>

                <button type="button" class="btn btn-primary follow common_js_class">Follow</button>
                <button type="button" class="btn btn-primary unfollow common_js_class1">Unfollow</button>
            </div>
            
        </div>
        <!-- buttons for video and about -->
        <div class="vid_abt has-background-success-light">
            <button type="button" class="btn video_btn">Video</button>
            <button type="button" class="btn about_btn">About</button>
        </div>
        <!-- all post of the users  -->
        <div class="index js-index">

        </div>

        <!-- about the customer -->
        <div class="index-about hide js-index-about">
            <h1>Description</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus eius tempora cupiditate animi, neque corporis aut odio sapiente nam autem inventore facilis vitae adipisci quo ipsam sunt iste excepturi eum. Lorem, ipsum dolor sit amet consectetur
                adipisicing elit. Beatae explicabo atque error, quisquam perspiciatis corrupti pariatur repellat, id voluptas nemo saepe eaque omnis quidem fugiat illum dolore sunt, placeat iste?
            </p>
            
        </div>
        
        <?php
            include 'scripts.php';
        ?>
        <script src="js/userProfile.js"></script>

    </body>

</html>

