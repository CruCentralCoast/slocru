<?php
$this->load->helper('url');
if (!$this->session->userdata('admin')) {
    redirect('/home', 'refresh');
}
?>
<div class="container" style="box-shadow: 0px 1px 10px #888888; border-radius:0 0 10px 10px; background-color: #fff; padding: 0 100px 0 100px">

    <br/>
    <div class="col-md-12" style="text-align: center; font-weight: 300; font-size: 36pt; padding: 10px 25px 10px 25px;">
        Admin Page
    </div>
    <br/>
    <img src="../assets/img/dropshadowup2.png" style="width:100%; height:25px;"/>
    <br/>

    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
        <li><a href="#bstud" data-toggle="tab">Bible Studies</a></li>
        <li><a href="#involved" data-toggle="tab">Get Involved</a></li>
        <li><a href="#events" data-toggle="tab">Events</a></li>
        <li><a href="#resources" data-toggle="tab">Resources</a></li>
        <li><a href="#staff" data-toggle="tab">Staff</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="home">1</div>
        <div class="tab-pane" id="bstud">
            <?php $this->load->view('admin/adminstudies'); ?>
        </div>
        <div class="tab-pane" id="involved">3</div>
        <div class="tab-pane" id="events">
            <?php $this->load->view('admin/adminevents'); ?>
        </div>
        <div class="tab-pane" id="resources">5</div>
        <div class="tab-pane" id="staff">6</div>
    </div>
</div>
<?php $this->load->view('javascript'); ?>
