<div class="container" style="box-shadow: 0px 1px 10px #888888; border-radius:0 0 10px 10px; background-color: #fff; padding: 0 100px 0 100px">
    <br/>
    <div class="col-md-12" style="text-align: center; font-weight: 300; font-size: 36pt; padding: 10px 25px 10px 25px;">
        Admin Login
    </div>
    <br/>
    <img src="../assets/img/dropshadowup2.png" style="width:100%; height:25px;"/>
    <br/>
    <div class="col-md-4" style="padding: 10px 0 30px 0;">
        <form action="<?php echo base_url() . 'admin/'; ?>" role="form" method="post">
            <div class="form-group">
                <label for="InputUsername">Username</label>
                <input type="text" class="form-control" name="username" id="InputUsername" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="InputPassword">Password</label>
                <input type="password" class="form-control" name="password" id="InputPassword" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</div>
