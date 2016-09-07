<script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
<script type='text/javascript' src='scripts/fg_ajax.js'></script>
<script type='text/javascript' src='scripts/fg_captcha_validator.js'></script>
<script type='text/javascript' src='scripts/fg_moveable_popup.js'></script>
<script type='text/javascript' src='scripts/fg_form_submitter.js'></script>
<div id='fg_formContainer'>
    <div id="fg_container_header">
        <div id="fg_box_Title">Sign up to drive</div>
        <div id="fg_box_Close"><a href="javascript:fg_hideform('fg_formContainer','fg_backgroundpopup');">Close(X)</a></div>
    </div>

    <div id="fg_form_InnerContainer">
    <form id='contactus' action='javascript:fg_submit_form()' method='post' accept-charset='UTF-8'>

    <input type='hidden' name='submitted' id='submitted' value='1'/>
    <input type='hidden' name='<?php echo $formproc->GetFormIDInputName(); ?>' value='<?php echo $formproc->GetFormIDInputValue(); ?>'/>
    <input type='text'  class='spmhidip' name='<?php echo $formproc->GetSpamTrapInputName(); ?>' />
    
    <!--<div id="DELETETHIS">This form not yet implemented, add ability to enter driver info and add to database</div>
    -->
    <div class='short_explanation'>* required fields</div>
    <div id='fg_server_errors' class='error'></div>
    <div class='container'>
        <label for='name' >Your Full Name*: </label><br/>
        <input type='text' name='name' id='name' value='' maxlength="50" /><br/>
        <span id='contactus_name_errorloc' class='error'></span>
    </div>
    <div class='container'>
    <label for='email' >Email*:</label><br/>
        <input type='text' name='email' id='email' value='' maxlength="50" /><br/>
        <span id='contactus_email_errorloc' class='error'></span>
    </div>
    <div class='container'>
    <label for='phone' >Phone Number*:</label><br/>
        <input type='text' name='phone' id='phone' value='' maxlength="50" /><br/>
        <span id='contactus_phone_errorloc' class='error'></span>
    </div>
    <div class='container'>
    <label for='address' >Your Address*:</label><br/>
        <input type='text' name='address' id='address' value='' maxlength="50" /><br/>
        <span id='contactus_address_errorloc' class='error'></span>
    </div>
    <div class='container'>
    <label for='seats'>Number of seats:</label><br/>
        <select name="seats">
            <?php
               for($i=1; $i<=8; $i++)
                  echo '<option value="'.$i.'">'.$i.'</option>'; ?>
        </select>
    </div>
    <div class='container'>
    <label for='churches' >Church you are driving to*:</label><br/>
         <select name="churches">
            <option value="">Select a church...</option>
            <?php
            $con = mysql_connect("localhost","slocrus1_all","2cor129");
            if (!$con)
            {
               die('Could not connect: ' . mysql_error());
            }

            mysql_select_db("slocrus1_slocru", $con);

            $sql="SELECT * FROM churches";

            $result = mysql_query($sql);
            while ($row = mysql_fetch_assoc($result)) {
              echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
            }

            mysql_close($con);
            ?>
	 </select>

	 </div>
	 <div class='container'>
    <label for='services' >Service you are going to*:</label><br/>
	 <select name="services">
		 <option value="service1">1st service</option>
		 <option value="service2">2nd service</option>
		 <option value="service3">Evening service (if available)</option>
	 </select>

	 </div>
    
    <!-- DON'T NEED MESSAGE FORM FOR THIS IMPLEMENTATION
    <div class='container'>
        <label for='message' >Message:</label><br/>
        <span id='contactus_message_errorloc' class='error'></span>
        <textarea rows="10" cols="50" name='message' id='message'></textarea>
    </div>
    -->
    <div class='container'>
    <div><img alt='Captcha image' src='show-captcha.php?rand=1' id='scaptcha_img' /></div>
        <label for='scaptcha' >Enter the code above here:</label>
        <input type='text' name='scaptcha' id='scaptcha' maxlength="10" /><br/>
        <span id='contactus_scaptcha_errorloc' class='error'></span>
        <div class='short_explanation'>Can't read the image?
        <a href='javascript: refresh_captcha_img();'>Click here to refresh</a>.</div>
    </div>


    <div class='container'>
        <input type='submit' name='Submit' value='Submit' />
    </div>
    </form>
    </div>
</div>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("contactus");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("name","req","Please provide your name");

    frmvalidator.addValidation("email","req","Please provide your email address");

    frmvalidator.addValidation("email","email","Please provide a valid email address");
    
    frmvalidator.addValidation("phone","req","Please provide your phone number");

    frmvalidator.addValidation("address","req","Please provide an address");

    frmvalidator.addValidation("message","maxlen=2048","The message is too long!(more than 2KB!)");

    frmvalidator.addValidation("scaptcha","req","Please enter the code in the image above");


    document.forms['contactus'].scaptcha.validator
      = new FG_CaptchaValidator(document.forms['contactus'].scaptcha,
                    document.images['scaptcha_img']);

    function SCaptcha_Validate()
    {
        return document.forms['contactus'].scaptcha.validator.validate();
    }

    frmvalidator.setAddnlValidationFunction("SCaptcha_Validate");

    function refresh_captcha_img()
    {
        var img = document.images['scaptcha_img'];
        img.src = img.src.substring(0,img.src.lastIndexOf("?")) + "?rand="+Math.random()*1000;
    }

    document.forms['contactus'].refresh_container=function()
    {
        var formpopup = document.getElementById('fg_formContainer');
        var innerdiv = document.getElementById('fg_form_InnerContainer');
        var b = innerdiv.offsetHeight+40+30;

        formpopup.style.height = b+"px";
    }

    document.forms['contactus'].form_val_onsubmit = document.forms['contactus'].onsubmit;


    document.forms['contactus'].onsubmit=function()
    {
        if(!this.form_val_onsubmit())
        {
            this.refresh_container();
            return false;
        }

        return true;
    }
    function fg_submit_form()
    {
        //alert('submiting form');
        var containerobj = document.getElementById('fg_form_InnerContainer');
        var sourceobj = document.getElementById('fg_submit_success_message');
        var error_div = document.getElementById('fg_server_errors');
        var formobj = document.forms['contactus']

        var submitter = new FG_FormSubmitter("popup-contactform.php",containerobj,sourceobj,error_div,formobj);
        var frm = document.forms['contactus'];

        submitter.submit_form(frm);
    }

// ]]>
</script>

<div id='fg_backgroundpopup'></div>

<div id='fg_submit_success_message'>
    <h2>Thanks!</h2>
    <p>
    Thanks for contacting us. We will get in touch with you soon!
    <p>
        <a href="javascript:fg_hideform('fg_formContainer','fg_backgroundpopup');">Close this window</a>
    <p>
    </p>
</div>
