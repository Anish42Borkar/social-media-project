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
            Uploade You`r Files Here
        </div>
        </div>

        <section class="section">
            <div class="container setting_center_container">
                
                <div class="folde">
                
                    <!-- <span class="tag is-primary is-medium">Upload Video Here</span> -->
                    <div class="upload_files">
                        <div class="upload-media upload-video hide">
                            <div class="loaderr">
                                <div></div>
                            </div>
                            <video src="" id = "my-video" class = "video-js"  controls></video>
                        </div>
        
                        <div class="file file-video is-large  is-boxed has-name upload-file">
                            <label class="file-label">
                                <input class="file-input" type="file" name="resume">
                                    <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label">
                                        Upload Video...
                                    </span>
                                </span>
                                <span class="file-name">
                                    Screen Shot 2017-07-29 at 15.54.25.png
                                </span>
                            </label>
                        </div>
        
        
                        <!-- <span class="tag is-primary is-medium">Upload Thumnail Here</span> -->
                        <div class="upload-media upload-image hide">
                            <div class="loaderr">
                                <div></div>
                            </div>
                            <img class = "image-preview" alt="" src = "" >
                        </div>
                        <div class="file file-thumnail is-large  is-boxed has-name upload-file">
                            <label class="file-label">
                                <input class="file-input" type="file" name="resume">
                                    <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label">
                                        Upload Thumbnail
                                    </span>
                                </span>
                                <span class="file-name">
                                    Screen Shot 2017-07-29 at 15.54.25.png
                                </span>
                            </label>
                        </div>

                    </div>

                    <div class="upload_text_folde">
                    
                        <div class="upload_text">
                            <div class="field">
                                <label class="label">Title</label>
                                <div class="control">
                                    <input class="input is-warning post_title" type="text" placeholder="Write your title here">
                                    <p class="help hide">This username is available</p>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Description</label>
                                <div class="control">
                                    <textarea class="textarea is-warning post_desc" placeholder="Write the post description here"></textarea>
                                    <p class="help hide">This username is available</p>
                                </div>
                            </div>
                        </div>
                    
                    </div>

                </div>

                <div class="buttons upload-btn">
                <a class="button is-primary">Submit</a>
                </div>
                
            </div>
        
        </section>
        <?php
        include 'scripts.php';
        ?>

        <script src='js/upload.js'></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </body>
</html>