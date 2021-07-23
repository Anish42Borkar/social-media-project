<!DOCTYPE html>

<html>

    <?php
        include 'header.php';
    ?>

    <body>
        <?php
        include 'navbar.php';
        ?>
        <section class="section is-medium" >
            <div class = "container">
                <h1 class="title has-text-link-dark">Add Comment</h1>
                <textarea class="textarea is-info comment-box" placeholder="Comment!"></textarea>
                <div class="buttons"style= "display:flex;justify-content:flex-end;padding:1rem;">
                    <button class="button is-info comment-btn" >Comment</button>
                </div>
            </div>
            <hr class = "has-background-primary">
            
            <div class = "comment" >
            </div>
        </section>
        
        <?php
            include 'scripts.php';
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script src="js/comment.js"></script>
    </body>

</html>