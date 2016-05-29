<div class="well">
    <div class="row offset1">
        <?php
        $username = array(
            'name' => 'username',
            'placeholder' => 'johndoe'
        );
        
        $email = array(
            'name' => 'email',
            'placeholder' => 'johndoe@fishtaco.com'
        );
        
        $password = array(
            'name' => 'password'
        );
        
        $confirm_password = array(
            'name' => 'confirm_password'
        );
        
        $submit = array(
            'value' => 'Submit',
            'class' => 'btn btn-primary'
        );
            echo form_open('register/');
            echo '<fieldset>';
            echo '<label>Username</label>';
            echo form_input($username);
            echo '<label>Email</label>';
            echo form_input($email);
            echo '<label>Password</label>';
            echo form_password($password);
            if($match === 'ERROR')
                echo '<span style="color:red"> Password does not match</span>';
            
            echo '<label>Confirm password</label>';
            echo form_password($confirm_password).'<br/>';
            echo form_submit($submit);
          echo '</fieldset>';
        echo form_close();
        ?>
    </div>
</div>
