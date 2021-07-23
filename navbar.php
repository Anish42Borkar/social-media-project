<?php

    echo '

        <!-- Navigation bar -->
        <nav class="menubar">

        <div class="icon"><img src="images/logo2.png" alt="" class = "logo">
        </div>

        <div>

            <form class="" action="">
                <input class="search" type="text" placeholder="Search">
            </form>

        </div>

        <div class="con">
            <div><i class="fas fa-cloud-upload-alt fa-2x upload-icon"></i></div>
            <div><i class="far fa-user fa-2x user_icon"></i> <i class="fas fa-times fa-2x user_cross_icon hide"></i></div>
        </div>

        </nav>

        <div class="autocomplete">
                
        </div>

        <aside class="menu js-list hide">
        <ul class="menu-list">
            <li class = "index-link-js"><a href="index.php">Home</a></li>
            <li class = "profile-link-js" ><a href="profile.php">Profile</a></li>
            <li class = "setting-link-js" ><a href="setting.php">Settings</a></li>
            <li><a class="logout">Logout</a></li>
        </ul>
        </aside>

    ';

?>