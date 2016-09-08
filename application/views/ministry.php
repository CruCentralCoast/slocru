<div class="container">
    <div id="sidebar">
        <p class="title">MINISTRY TEAMS</p>
        <div class="list-group" id="list">
            <?php
                for($i = 0; $i < count($ministry); $i++) {
<<<<<<< HEAD
                    $id = explode(" ",$ministry[$i]->Name);
                    $id = explode("'", $id[0]);
                    $id = $id[0];
                    echo '<a href="#'.$id.'" data-toggle="tab" class="list-group-item teams">';
                    echo $ministry[$i]->Name;
=======
                    $id = explode(" ",$ministry[$i]->name);
                    $id = explode("'", $id[0]);
                    $id = $id[0];
                    echo '<a href="#'.$id.'" data-toggle="tab" class="list-group-item teams">';
                    echo $ministry[$i]->name;
>>>>>>> 550b510db1043461989ad293a1f567c94694e9dd
                    echo '</a>';
                }
            ?>
        </div>
    </div>
    <div id='content' class="tab-content">
        <div class="Select-team tab-pane fade in active">
            <p class="select">SELECT A TEAM<br>TO LEARN MORE</p>
        </div>
        <?php
            for($i = 0; $i < count($ministry); $i++) {
<<<<<<< HEAD
                $id = explode(" ",$ministry[$i]->Name);
=======
                $id = explode(" ",$ministry[$i]->name);
>>>>>>> 550b510db1043461989ad293a1f567c94694e9dd
                $id = explode("'", $id[0]);
                $id = $id[0];

                echo '<div class="ministry tab-pane fade" id="'.$id.'" style="text-align: center">';
<<<<<<< HEAD
                    echo '<img class="photo" src="'.$ministry[$i]->Image.'"/>';
                    echo '<p class="ministry-name">'.$ministry[$i]->Name.'</p>';
                    echo '<p class="description">';
                    echo str_replace("\n",'<br/>',$ministry[$i]->Description);
                    echo '</p>';
                    echo '<p class="description">';
                    echo '<i>Leaders: ' . $ministry[$i]->Leaders . '</i></p>';
                    echo '<br>';
=======
                    echo '<img class="photo" src="'.$ministry[$i]->image->url.'"/>';
                    echo '<p class="ministry-name">'.$ministry[$i]->name.'</p>';
                    echo '<p class="description">';
                    echo str_replace("\n",'<br/>',$ministry[$i]->description);
                    echo '</p>';
                    echo '<p class="description">';
                    if($ministry[$i]->leaders != null) {
                        echo '<i>Leaders: ' ;
                        for($j = 0; $j < count($ministry[$i]->leaders); $j++) {
                            echo $ministry[$i]->leaders[$j]->name->first . " " . $ministry[$i]->leaders[$j]->name->last;
                            if($j < count($ministry[$i]->leaders) - 1) {
                                echo ", ";
                            }
                        }
                        echo '</i>';
                    }
                    echo '</p><br>';
>>>>>>> 550b510db1043461989ad293a1f567c94694e9dd
                    echo '<a class="sign-up" data-toggle="modal" href="#'.$id.'modal" class="button">Sign-up Here</a>';          
                    echo '<br>';
                    echo '<br>';
                    echo '<br>';
                echo '</div>';
                    
                echo '<div class="modal fade" id="'.$id.'modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                    echo '<div class="modal-dialog">';
                        echo '<div class="modal-content">';
                            echo '<div class="modal-header">';
                                echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
<<<<<<< HEAD
                                echo '<h4 class="modal-title">Sign up for '.$ministry[$i]->Name.'!</h4>';
=======
                                echo '<h4 class="modal-title">Sign up for '.$ministry[$i]->name.'!</h4>';
>>>>>>> 550b510db1043461989ad293a1f567c94694e9dd
                            echo '</div>';
                            echo '<form action="'.base_url().'ministry/mail/" class="form-horizontal" role="form" method="post">';
                                echo '<div class="modal-body">';
                                    echo '<div class="form-group">';
                                        echo '<label for="inputName" class="col-lg-2 control-label">Name</label>';
                                        echo '<div class="col-lg-10">';
                                            echo '<input type="text" name="name" class="form-control" id="inputName" placeholder="Name"/>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                        echo '<label for="inputEmail" class="col-lg-2 control-label">Email</label>';
                                        echo '<div class="col-lg-10">';
                                            echo '<input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email"/>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                        echo '<label for="inputCell" class="col-lg-2 control-label">Cell Phone</label>';
                                        echo '<div class="col-lg-10">';
                                            echo '<input type="text" name="cell" class="form-control" id="inputCell" placeholder="Cell Phone Number"/>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                        echo '<label for="inputNotes" class="col-lg-2 control-label">Notes</label>';
                                        echo '<div class="col-lg-10">';
                                            echo '<textarea name="notes" class="form-control" id="inputNotes" rows="5" placeholder="Type in any information you would like us to know..."></textarea>';
<<<<<<< HEAD
                                            echo '<input type="hidden" name="tls" value="'.$ministry[$i]->Email.'"/>';
=======
                                            if($ministry[$i]->leaders != null) {
                                                echo '<input type="hidden" name="tls" value="'.$ministry[$i]->leaders[0]->email.'"/>';
                                            }
>>>>>>> 550b510db1043461989ad293a1f567c94694e9dd
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="modal-footer">';
                                    echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
                                    echo '<button type="submit" id="submit_button" class="btn btn-primary" data-loading-text="Sending...">Submit</button>';
                                echo '</div>';
                            echo '</form>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
        }
        ?>
    </div>
</div>
<?php $this->load->view('javascript'); ?>