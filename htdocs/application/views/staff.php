<div class="container" style="background-color: #fff;">
    <div class="col-md-12" style="text-align: center; font-weight: 300; font-size: 36pt; padding: 10px 25px 10px 25px;">
        Staff
    </div>
    <?php
    
        //Since we have 2 Mission Team Leaders, we center those up top
        echo '<div class="row" style="padding: 10px 0 30px 0;">';
        echo '<div class="col-md-3"></div>';
        
        $group = '';
        $groups = 0;
        
        //Loop through the rest of staff
        for($i = 0; $i < count($staff); $i) 
        {
            if($group != $staff[$i]->group)
            {
                echo '<div class="' . $staff[$i]->group . '">';
                $group = $staff[$i]->group;
                $groups++;
            }
            echo '<div class="row">';
            
            for($j = 0; $j < 3; $j++) 
            {
                echo '<div class="card">';
                echo '<img src="' . $staff[$i]->Picture . '" class="picture"></img>';
                echo '<p class="name">' . $staff[$i]->Name . '</p>';
                echo '<p class="role">' . $staff[$i]->Role . '</p><br/>';
                echo '<a class="email" href="mailto:'.$staff[$i]->Email.'" target="_blank">'.$staff[$i]->Email.'</a>';
                echo '</div>';
                $i++;
            }
            echo '</div>';
        }
        
        while($groups--)
        {
            echo '</div>';
        }
    ?>
    <?php $this->load->view('javascript'); ?>
</div>
