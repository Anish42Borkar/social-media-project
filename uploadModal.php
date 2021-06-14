<?php

    echo '
        <div class="modal">
            <div class="modal-background"></div>
            <div class="modal-content">

                <div class="card">
                    
                    <div class="card-content" >
                        <div class="content" >
                            <h1 class = "has-text-primary">Progress</h1>
                            <div style = "width:100%;height:2rem;"><progress class="progress is-primary is-large" value="0" max="100"></progress></div>
                            <h3 class="status">1</h3>
                            <p class="loaded_n_total">1</p>
                        </div>
                    </div>
                </div>

            </div>
            <button class="modal-close is-large hide" aria-label="close"></button>
        </div>
    ';

?>