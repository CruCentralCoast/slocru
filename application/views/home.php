<div class="container">
    <div class="slider-wrapper theme-default hidden-xs">
        <div id="slider" class="nivoSlider">
            <a href="<?php echo base_url(); ?>">
                <!--<img src="../assets/img/slides/Banner1_SLOCRU.png"/> -->
            </a>
            <?php
                for ($i = 0; $i < count($events); $i++) {
                    if (property_exists($events[$i], "image")) {
                        echo '<a href="' . base_url() . 'events#' . $events[$i]->_id .'"><img src="' . $events[$i]->bannerImageLink . '"/></a>';
                    }
                }
            ?>
        </div>
    </div>
</div>
<div class="container middle">
    <div class="column">
        <div class="text">
            <p class="about">WHAT IS CRU?</p>
            <p class="mission" id="line1">A caring community passionate about</p>
            <p class="mission" id="line2">connecting people to Jesus Christ.</p>
            <div class="learn-more-button">
                <a href="http://slocru.com/about">
                    <p class="learn-more">You can learn more here</p>
                </a>
            </div>
        </div>
    </div>
    <div class="column">
        <div class="text">
            <p class="meeting">CRU WEEKLY MEETING</p>
            <p class="meeting-info" id="line1"><span class="time">Tuesdays at 8pm</span></p>
            <p class="meeting-info" id="line2">Chumash Auditorium</p>
            <p class="break"></p>
            <p class="address">1 Grand Avenue, San Luis Obispo, CA 93407</p>
        </div>
    </div>
    <div class="column">
        <div class="directions-button">
            <a href="https://www.google.com/maps/place/Chumash+Auditorium/@35.3002242,-120.6612301,882m/data=!3m2!1e3!4b1!4m5!3m4!1s0x80ecf1b1a0354921:0x13310e2d6d3cc64b!8m2!3d35.3002242!4d-120.6590414" target="_blank">
                <p class="button">GET DIRECTIONS</p>
            </a>
        </div>
        <!-- The Watch meetings button is currently buggy, Fix Later. -->
        <div class="livestream-button">
            <a href="https://www.youtube.com/user/slocrusade/videos" target="_blank">
                <p class="button">WATCH THE MEETING</p>
            </a>
        </div>
    </div>
</div>

<!-- This will possibly have to be rewritten in php as the images are not going
     to always be the same three, but will change throughout the year. -->
<div class="container bottom">
    <div class="wrap">
        <a href="leadership">
            <img src="../assets/img/placeholders/leadership.png" class="holder" id="holder1"/>
        </a>
    </div>
    <div class="wrap">
        <a href="missions">
            <img src="../assets/img/image-holder2.png" class="holder" id="holder2"/>
        </a>
    </div>
    <div class="wrap">
        <a href="https://www.facebook.com/groups/1810897575812604/" target="_blank">
            <img src="../assets/img/image-holder3.jpg" class="holder" id="holder3"/>
        </a>
    </div>
</div>
<?php $this->load->view('javascript'); ?>
<script src="../assets/js/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider({
            effect: 'slideInRight',
            animSpeed: 250,
            pauseOnHover: true,
            pauseTime: 5000,
            controlNav: false,
            prevText: '<',
            nextText: '>',
            directionNav: true
        });
    });
</script>
