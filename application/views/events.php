<script>
    var currentEvent = -1;
function activateEvent(id) {
    location.hash = id;
    $("#event" + id).show();
    $("#eventPhoto" + id).show();
    $("#eventBttn" + id).fadeTo(.6);
    if(currentEvent != id)  {
        $("#event" + currentEvent).hide();
        $("#eventPhoto" + currentEvent).hide();
    }
    currentEvent = id;
}
    window.onhashchange = function() {
        if(document.getElementById("event" + location.hash.substr(1)) != null)
            activateEvent(location.hash.substr(1));
    };
</script>

<div class="container">
    <div class="light-left" style="height:155px;">
        <?php foreach($events as $event) { if(!property_exists($event, "bannerImageLink") || $event->bannerImageLink == "") {continue;}?>
        <img id="eventPhoto<?php echo $event->_id; ?>" style="display:none;" class="banner-photo" src="<?php echo  $event->bannerImageLink; ?>"/>
        <?php } ?>
    </div>
    <div class="right" style="height: 400px; overflow-y: scroll;">
        <div class="list-item">
            <div class="list-icon"> 
                <i class="fa fa-calendar fa-3x"></i>
            </div>
            <div class="list-text" style="margin-bottom: 10px;">
                UPCOMING EVENTS
            </div>
        </div>
        <br/>

        <?php foreach($events as $event) { ?>
            <?php
                $timestamp = strtotime($event->startDate);
                $month = date("M", $timestamp);
                $day = date("j", $timestamp);
            ?>
            <a style="cursor:pointer;" onclick="activateEvent('<?php echo $event->_id; ?>')" class="event">
            <!--<a class="event" href="events">-->
                <div id="eventBttn<?php echo $event->_id; ?>" class="list-item-event">
                    <div class="date-container">
                        <div class="event-date">
                            <div class="month"><?php echo strtoupper($month); ?></div>
                            <div class="day"><?php echo $day; ?></div>
                        </div>
                    </div>
                    <div class="event-text">
                        <div class="event-text-title">
                            <?php
                                $str = $event->name . " (";
                                $starttime = strtotime($event->startDate);
                                if(isset($event->endDate)) {
                                    $endtime = strtotime($event->endDate);
                                }
                                else {
                                    $endtime = NULL;
                                }

                                $str .= date("g", $starttime);
                                if(date("i", $starttime) !== "00") {
                                    $str .= ":" . date("i", $starttime);
                                }

                                if($endtime !== NULL) {
                                    $str .= "&ndash;";
                                    $str .= date("g", $endtime);
                                    if(date("i", $endtime) !== "00") {
                                        $str .= ":" . date("i", $endtime);
                                    }
                                    $str .= date("a", $endtime);
                                }
                                else {
                                    $str .= $str .= date("a", $starttime);
                                }

                                $str .= ")";

                                echo $str;
                                //Weekly Meeting Week 1 (8pm)&ndash;
                                ?>
                        </div>
                        <div class="event-text-desc">
                            <?php echo $event->location->street1 . ", " . $event->location->suburb; ?>
                        </div>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>
    <?php 
        for($i = 0; $i < count($events); $i++) { ?>
    <div class="left" style="height: 445px; display:none;" id="event<?php echo $events[$i]->_id; ?>">
        
        <div>
            <div class="left-header" >
                <hr />
            <?php echo strtoupper($events[$i]->name); ?>
                <hr />
            </div>
            <p>
            <?php echo $events[$i]->description; ?>
            </p>
            <div class="box">
                <h3>WHEN</h3>
                <p><?php 
                    $date = new DateTime($events[$i]->startDate);
                    $startTime = new DateTime($events[$i]->startDate);
                    $endTime = new DateTime($events[$i]->endDate);
                    $startTime = $startTime->format("g:ia");
                    $endTime = $endTime->format("g:ia");
                    $date = $date->format('l F jS, Y');
                    echo $date . " " . $startTime . " - " . $endTime; ?>
                </p>
            </div>
            <div class="box">
                <h3>WHERE</h3>
                <p><?php echo $events[$i]->location->street1 . ", " . $events[$i]->location->suburb; ?></p>
            </div>
            <?php if($events[$i]->url != "" || $events[$i]->url != null) { ?>
            <a target="_blank" href="<?php echo $events[$i]->url; ?>"><div class="btn">SEE MORE INFO</div></a>
            <?php } ?>
        </div>
        <?php 
        if($i == 0) { ?>
            <script>$(document).ready(function() { 
                if(location.hash == null || location.hash == "" || document.getElementById("event" + location.hash.substr(1)) == null) {
                    activateEvent('<?php echo $events[$i]->_id; ?>'); 
                } else {
                    activateEvent(location.hash.substr(1));
                }
            });</script>
        <?php } ?>
    </div>
    <?php } ?>
    <div class="right weeklyevents" style="height:200px;">
        <img src="../../assets/img/events/clubshowcase.jpg" />
        <div class="right-header">WEEKLY EVENTS</div>
        <div class="right-header-small">Morning Prayer</div>
        <center>
        <p>
            Week Days at 8am (Upstairs in the UU)
        </p>
        </center>
        <div class="right-header-small">Sharing Times</div>
        <center>
        <p>
            Tuesday and Thursday from 11-12 (UU Mustang) <br />
        </p>
        </center>
    </div>
</div>