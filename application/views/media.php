<div class="container">
    <div class="column left">
        <p class="heading-gallery">PHOTO GALLERY</p>
        <a href="construction">
			<img src="../../assets/img/placeholders/fallretreat2014.jpg" class="top-album">
        </a>
        <p class="gallery-name">Fall Retreat 2014</p>
        <div class="column gallery-pain-left">
            <div class="gallery-middle">
                <a href="construction">
                    <img src="../../assets/img/placeholders/nato2014.jpg" class="left-albums">
                </a>
                <p class="gallery-name">NATO 2014</p>
            </div>
            <div class="gallery-bottom">
                <a href="construction">
                    <img src="../../assets/img/placeholders/cruville2013.jpg" class="left-albums">
                </a>
                <p class="gallery-name">Cruville 2013</p>
            </div>
        </div>
        <div class="column gallery-pain-right">
            <div class="gallery-middle">
                <a href="construction">
                    <img src="../../assets/img/placeholders/dearsister2014.jpg" class="right-albums">
                </a>
                <p class="gallery-name">Dear Sister 2014</p>
            </div>
            <div class="gallery-bottom">
                <a href="construction">
                    <img src="../../assets/img/placeholders/crunato13.jpg" class="right-albums">
                </a>
                <p class="gallery-name">CRU NATO '13</p>
            </div>
        </div>
    </div>
    <div class="column right">
        <div class="column middle">
            <p class="headings">FACEBOOK</p>
            <div class="facebook">
                
                <?php
                    $FBapp_id = '1210920498923666';
                    $FBapp_secret = 'a557ffd01906087b51f851ca6313bb6b';
                     
                    function get_FBtoken($url){
                        
                        $url = $url . "&format=json";
                        
                        $curl = curl_init($url);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                        $return = curl_exec($curl);
                        curl_close($curl);
                        
                        $return = $return . '';
                        $return = substr($return,strpos($return,"access_token=")+13);
                        
                        return $return;
                    }

                    $FBaccess_token = get_FBtoken("https://graph.facebook.com/oauth/access_token?client_id=" . $FBapp_id . "&client_secret=" . $FBapp_secret . "&grant_type=client_credentials");
                    
                    function get_FBfeed($url){
                        
                        $curl = curl_init($url);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                        $return = curl_exec($curl);
                        curl_close($curl);
                        
                        return json_decode($return, true);
                    }
                    
                    $FBpage_ID = get_FBfeed('https://graph.facebook.com/SloCrusade?access_token=' . $FBaccess_token)['id'];
                    
                    //https://graph.facebook.com/" + page-id + "/feed?access_token=" + URLEncoder.encodeUTF8(access-token)
                    $FBurl = "https://graph.facebook.com/" . $FBpage_ID . "/feed?access_token=" . $FBaccess_token ;
                    
                    $FBfeed = get_FBfeed($FBurl)['data'];
                    
                    date_default_timezone_set('America/Los_Angeles');
                    $FBslo_cru = '<a target="_blank" href="https://www.facebook.com/SloCrusade/" class="fb-username">Slo Cru</a>';
                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                    foreach ($FBfeed as $FBpost) {
                        
                        $FBurl = "https://graph.facebook.com/" . $FBpost['id'];
                        $FBpostData = get_FBfeed($FBurl);
                        echo '<div class="facebook-post">';
                        
                        echo '<div class="row fb-row" style="margin:0px">';
                        echo '  <div class="pull-left">';
                        if (array_key_exists('story',$FBpost)) {
                            echo $FBslo_cru . substr($FBpost['story'],7);
                        } else {
                            echo $FBslo_cru;
                        } 
                        echo '</br>';
                        $FBdate = strtotime($FBpost['created_time']);
                        echo date('F j',$FBdate) . ' at ' . date('g:ia',$FBdate);
                        echo '</div></div>'; //ends the user row
                        if (array_key_exists('message',$FBpost)) {
                            echo '</br>';
                            $text = $FBpost['message'];
                            if (preg_match($reg_exUrl, $text, $url)) {
                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . ">$url[0]</a> ", $text);
                            } else {
                                echo $text;
                            }
                        }
                        if (array_key_exists('picture',$FBpostData)) {
                                echo '</br><img src="' . $FBpostData['picture'] . '" style="width: 60%;margin-left:20%;"/>';
                            }
                        echo '</div>';//'<hr/>';//ends the post
                    }
                ?>
            </div>
        </div>
        <div class="column far-right">
            <div class="column right-top">
                <p class="headings">YOUTUBE</p>
                <div class="youtube-vid">
                    <!--<p class="coming">Youtube Videos Coming Soon</p>-->
                    <?php
                        
                        function get_youtube($url){

                            $youtube = "http://www.youtube.com/oembed?url=". $url ."&format=json";

                            $curl = curl_init($youtube);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                            $return = curl_exec($curl);
                            curl_close($curl);
                            
                            return json_decode($return, true);
                        }

                        $url = "https://www.youtube.com/playlist?list=PLi2onRqvLcjnULwq581sf-6w26kuHe2P3";

                        // Display Data 
                        function extractYTsrc($html) {
                            $html = substr($html,strpos($html,"src=\"")+5);
                            return substr($html,0,strpos($html,"\""));
                        }
                        
                        function phpAlert($msg) {
                            echo '<script type="text/javascript">alert("' . $msg . '")</script>';
                        }

                        echo '<iframe src="' . extractYTsrc(get_youtube($url)["html"]) . '" width="302" height="160" allowfullscreen="" frameborder="0"></iframe>';
                        //phpAlert( get_youtube($url)["html"] );
                        //phpAlert("hello");
                    ?>
                </div>
            </div>
            <div class="column right-middle">
                <p class="headings">Twitter</p>
                <div class="twitter">
                    <?php
                    foreach ($tweets as $value) {
                        //$test = $tweets[0];
                        $tw_date = explode(' ', $value['created_at']);
                        echo '<div class="row" style="margin:0px">';
                        echo '  <div class="pull-left" style="font-size:14pt;">';
                        echo $value['user']['name'] . ' @' . $value['user']['screen_name'] . '<br/>';
                        echo '  </div>';
                        echo '  <div class="pull-right">' . $tw_date[1] . ' ' . $tw_date[2] . '</div>';
                        echo '</div>';
                        //Thanks to css-tricks.com for url-parsing script
                        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                        $text = $value['text'];
                        if (preg_match($reg_exUrl, $text, $url)) {
                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . ">$url[0]</a> ", $text);
                        } else
                            echo $text;
                        //echo $value['text'];
                        echo '<hr/>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="column bottom-right">
            <p class="headings">INSTAGRAM <span class="insta-info">(Follow us @crucentralcoast)</span></p>
            <!-- SnapWidget -->
            <div class="insta-feed">
                <p class="coming">Instagram feed Coming Soon</p>
            </div>
        </div>
    </div>
</div>