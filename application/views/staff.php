<div class="container">
    <?php
        $group = '';
        
        //Loop through the rest of staff
        for($i = 0; $i < count($mtl); $i) 
        {
            if($group != $mtl[$i]->Group && $group != '')
            {
                echo '</div>';
                echo '<div class="' . $mtl[$i]->Group . '">';
                $group = $mtl[$i]->Group;
                if($group == 'staff')
                {
                    echo '<div class="header">';
                    echo '<hr class="header-lines-staff" />';
                    echo '<p class="header-staff">CAMPUS FIELD STAFF & AREA DIRECTORS</p>';
                    echo '<hr class="header-lines-staff" />';
                    echo '</div>';
                }
                elseif($group == 'intern')
                {
                    echo '<div class="header">';
                    echo '<hr class="header-lines-intern" />';
                    echo '<p class="header-intern">CAMPUS MINISTRY INTERNS & PART-TIME FIELD STAFF</p>';
                    echo '<hr class="header-lines-intern" />';
                    echo '</div>';
                }
            }
            elseif($group != $mtl[$i]->Group)
            {
                echo '<div class="' . $mtl[$i]->Group . '">';
                $group = $mtl[$i]->Group;
                if($group == 'mtl')
                {
                    echo '<div class="header">';
                    echo '<hr class="header-lines-mtl" />';
                    echo '<p class="header-mtl">CRU CENTRAL COAST MISSIONAL TEAM LEADERS</p>';
                    echo '<hr class="header-lines-mtl" />';
                    echo '</div>';
                }
            }
            echo '<div class="card">';

            if($mtl[$i]->Picture === ""){
                echo '<div class=picture></div>';
            } else {
                echo '<img src="../../assets/img/staff/' . $mtl[$i]->Picture . '" class="picture">';
            }
            echo '<p class="' . $group . '-name">' . $mtl[$i]->Name . '</p>';
            echo '<p class="role">' . $mtl[$i]->Role . '</p>';
            if($mtl[$i]->Email != ""){
                echo '<p class="email"><a href="mailto:'.$mtl[$i]->Email.'" target="_blank">'.$mtl[$i]->Email.'</a></p>';
            } else {
                echo '<p>&nbsp;</p>';
            }
            echo '</div>';
            $i++;
        }
        
        //Loop through the rest of staff
        for($i = 0; $i < count($staff); $i) 
        {
            if($group != $staff[$i]->Group && $group != '')
            {
                echo '</div>';
                echo '<div class="' . $staff[$i]->Group . '">';
                $group = $staff[$i]->Group;
                if($group == 'staff')
                {
                    echo '<div class="header">';
                    echo '<hr class="header-lines-staff" />';
                    echo '<p class="header-staff">CAMPUS FIELD STAFF & AREA DIRECTORS</p>';
                    echo '<hr class="header-lines-staff" />';
                    echo '</div>';
                }
                elseif($group == 'intern')
                {
                    echo '<div class="header">';
                    echo '<hr class="header-lines-intern" />';
                    echo '<p class="header-intern">CAMPUS MINISTRY INTERNS & PART-TIME FIELD STAFF</p>';
                    echo '<hr class="header-lines-intern" />';
                    echo '</div>';
                }
            }
            elseif($group != $staff[$i]->Group)
            {
                echo '<div class="' . $staff[$i]->Group . '">';
                $group = $staff[$i]->Group;
                if($group == 'mtl')
                {
                    echo '<div class="header">';
                    echo '<hr class="header-lines-mtl" />';
                    echo '<p class="header-mtl">CRU CENTRAL COAST MISSIONAL TEAM LEADERS</p>';
                    echo '<hr class="header-lines-mtl" />';
                    echo '</div>';
                }
            }
            echo '<div class="card">';

            if($staff[$i]->Picture === ""){
                echo '<div class=picture></div>';
            } else {
                echo '<img src="../../assets/img/staff/' . $staff[$i]->Picture . '" class="picture">';
            }
            echo '<p class="' . $group . '-name">' . $staff[$i]->Name . '</p>';
            echo '<p class="role">' . $staff[$i]->Role . '</p>';
            if($staff[$i]->Email != ""){
                echo '<p class="email"><a href="mailto:'.$staff[$i]->Email.'" target="_blank">'.$staff[$i]->Email.'</a></p>';
            } else {
                echo '<p>&nbsp;</p>';
            }
            echo '</div>';
            $i++;
        }
        
        //Loop through the rest of staff
        for($i = 0; $i < count($intern); $i) 
        {
            if($group != $intern[$i]->Group && $group != '')
            {
                echo '</div>';
                echo '<div class="' . $intern[$i]->Group . '">';
                $group = $intern[$i]->Group;
                if($group == 'staff')
                {
                    echo '<div class="header">';
                    echo '<hr class="header-lines-staff" />';
                    echo '<p class="header-staff">CAMPUS FIELD STAFF & AREA DIRECTORS</p>';
                    echo '<hr class="header-lines-staff" />';
                    echo '</div>';
                }
                elseif($group == 'intern')
                {
                    echo '<div class="header">';
                    echo '<hr class="header-lines-intern" />';
                    echo '<p class="header-intern">CAMPUS MINISTRY INTERNS & PART-TIME FIELD STAFF</p>';
                    echo '<hr class="header-lines-intern" />';
                    echo '</div>';
                }
            }
            elseif($group != $intern[$i]->Group)
            {
                echo '<div class="' . $intern[$i]->Group . '">';
                $group = $intern[$i]->Group;
                if($group == 'mtl')
                {
                    echo '<div class="header">';
                    echo '<hr class="header-lines-mtl" />';
                    echo '<p class="header-mtl">CRU CENTRAL COAST MISSIONAL TEAM LEADERS</p>';
                    echo '<hr class="header-lines-mtl" />';
                    echo '</div>';
                }
            }
            echo '<div class="card">';

            if($intern[$i]->Picture === ""){
                echo '<div class=picture></div>';
            } else {
                echo '<img src="../../assets/img/staff/' . $intern[$i]->Picture . '" class="picture">';
            }
            echo '<p class="' . $group . '-name">' . $intern[$i]->Name . '</p>';
            echo '<p class="role">' . $intern[$i]->Role . '</p>';
            if($intern[$i]->Email != ""){
                echo '<p class="email"><a href="mailto:'.$intern[$i]->Email.'" target="_blank">'.$intern[$i]->Email.'</a></p>';
            } else {
                echo '<p>&nbsp;</p>';
            }
            echo '</div>';
            $i++;
        }
    ?>
    <?php $this->load->view('javascript'); ?>
    </div>
</div>
