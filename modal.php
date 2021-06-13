<?php

    echo '
        <div class="modal">
            <div class="modal-background"></div>
            <div class="modal-content">
                <!-- press play! -->

                <div class="player">
                    <video class="player__video viewer" src=""></video>

                    <div class="player__controls">
                        <div class="progress">
                            <div class="progress__filled"></div>
                        </div>
                        <button class="player__button toggle" title="Toggle Play">►</button>
                        <input type="range" name="volume" class="player__slider" min="0" max="1" step="0.05" value="1">
                        <input type="range" name="playbackRate" class="player__slider" min="0.5" max="2" step="0.1" value="1">
                        <button data-skip="-10" class="player__button">« 10s</button>
                        <button data-skip="25" class="player__button">25s »</button>
                        <button type="button" class="player__button fullscreen">&#x26F6;</button>
                    </div>
                </div>

            </div>
            <button class="modal-close is-large" aria-label="close"></button>
        </div>
    ';

?>