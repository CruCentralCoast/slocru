<div class="container">
    <div class="left">
        <hr />
        <div class="left-header">
            There are so many ways to get involved with SLO Cru!
        </div>
        <hr />
        <div class="box">
            <a href="<?php echo base_url() . "studies" ?>">
                <div class="white-box">
                    <img class="photo" src="../assets/img/involvement/community.jpg"/>
                    <br />
                    COMMUNITY GROUPS
                </div>
            </a>
        </div>
        <div class="box">
            <a href="<?php echo base_url() . "ministry" ?>">
                <div class="white-box">
                    <img class="photo" src="../assets/img/involvement/ministry.jpg"/>
                    <br />
                    MINISTRY TEAMS
                </div>
            </a>
        </div>

        <div class="box">
            <a href="http://crucentralcoast.com/">
                <div class="white-box">
                    <img class="photo" src="../assets/img/involvement/contextualized.jpg"/>
                    <br />
                    CONTEXTUALIZED MINISTRIES
                </div>
            </a>
        </div>
        <div class="box">
            <a href="<?php echo base_url() . "missions" ?>">
                <div class="white-box">
                    <img class="photo" src="../assets/img/involvement/summer.jpg"/>
                    <br />
                    SUMMER MISSIONS / STINT
                </div>
            </a>
        </div>
    </div>
    <div class="right">
        <div class="list-item">
            <div class="list-icon"> 
                <i class="fa fa-calendar fa-3x"></i>
            </div>
            <div class="list-text">
                UPCOMING EVENTS
            </div>
        </div>
        <br/>

        <?php foreach($events as $event) { ?>
            <?php
                $timestamp = strtotime($event->Date);
                $month = date("M", $timestamp);
                $day = date("j", $timestamp);
            ?>
            <a class="event" href="events#<?php echo $event->Id; ?>">
            <!--<a class="event" href="events">-->
                <div class="list-item-event">
                    <div class="date-container">
                        <div class="event-date">
                            <div class="month"><?php echo strtoupper($month); ?></div>
                            <div class="day"><?php echo $day; ?></div>
                        </div>
                    </div>
                    <div class="event-text">
                        <div class="event-text-title">
                            <?php
                                $str = $event->Name . " (";
                                $starttime = strtotime($event->StartTime);
                                if(isset($event->EndTime)) {
                                    $endtime = strtotime($event->EndTime);
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
                            <?php echo $event->Location; ?>
                        </div>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>
</div>