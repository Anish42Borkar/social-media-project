<!DOCTYPE html>

<?php

    require_once('connection.php');

?>

<html>

<head>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/style.css">
</head>

<body>
    <!-- Navigation bar -->
    <nav class="menubar">

        <div class="icon"><img src="Images/logo.png" alt="">
        </div>

        <div>

            <form class="" action="">
                <input class="search" type="text" placeholder="search">
            </form>

        </div>

        <div class="con">
            <div><img src="Images/upload.png" alt="" height="40px" width="40px" id="icon"></div>
            <div><img src="Images/profile.png" alt="" height="40px" width="40px" id="icon2"></div>
        </div>

    </nav>
    <!-- profile information -->
    <div class="profileinfo">

        <div class="center">
            <figure class="profile_img"><img src="Images/random.jpg"></figure>

            <h2 class="username">jester21</h2>

        </div>
        <button type="button" class="btn btn-primary follow">Follow</button>
    </div>
    <!-- buttons for video and about -->
    <div class="vid_abt">
        <button type="button" class="btn video_btn">Video</button>
        <button type="button" class="btn about_btn">About</button>
    </div>
    <!-- all post of the users  -->
    <div class="index">

        <?php
            
            $post = mysqli_query($conn, "SELECT * FROM `post`");

            if(mysqli_num_rows($post) > 0){

                while($row = mysqli_fetch_array($post)){


        ?>

        <div class="card">

            <div class="embed-responsive embed-responsive-21by9 video_container">
                <iframe class="video" src="https://www.youtube.com/embed/lMk3WMnUZ1s" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <div class="card-body">

                <p class="card-text"><?php echo $row['p_date'];?></p>
                <h5 class="card-title">poste title</h5>
                <p class="card-text"><?php echo $row['p_content'];?></p>

                <div class="card_footer">
                    <span class="post_icon"><i class="far fa-heart fa-2x"></i></span>
                    <span class="post_icon"><i class="fab fa-telegram-plane fa-2x"></i></span>
                    <span class="post_icon"><i class="far fa-comment fa-2x"></i></span>
                </div>

            </div>

        </div>

        <?php

                }

            }

        ?>
    </div>

    <!-- about the customer -->
    <div class="index-about hide">
        <h1>Description</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus eius tempora cupiditate animi, neque corporis aut odio sapiente nam autem inventore facilis vitae adipisci quo ipsam sunt iste excepturi eum. Lorem, ipsum dolor sit amet consectetur
            adipisicing elit. Beatae explicabo atque error, quisquam perspiciatis corrupti pariatur repellat, id voluptas nemo saepe eaque omnis quidem fugiat illum dolore sunt, placeat iste?</p>
        <ol class="about_links">
            <li class="about_link"></li>
            <li class="about_link"></li>
            <li class="about_link"></li>
        </ol>
    </div>

    <script src="./js/style.js"></script>
    <script src="./js/main.js"></script>
</body>

</html>