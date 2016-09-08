<div class="container" style="
     background-color: #fff;">
    <br/>
    <?php if ($this->session->flashdata('email_response')) { ?>
        <div class="alert alert-success alert-dismissable" style="text-align: center;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Success!</strong> Someone will be in contact with you soon about joining a bible study.<br/>
            If you do not hear from someone soon, please let us know at <a href="mailto:admin@slocru.com">admin@slocru.com</a>
        </div>
    <?php } ?>
    <div class="col-md-12" style="text-align: center; font-size: 36pt; font-weight: 300; padding: 10px 25px;">
        Sign up for a bible study
    </div>
    <br/>
    <div class="row text-center">
        <!-- Button trigger modal -->
        <div class="container" style="width: 80%; font-size: 18pt; text-align: justify; font-weight: 300;">
            Slo cru believes that  bible studies are one of the most effective ways 
            to get involved and integrated in the community of believers here in San Luis Obispo. 
            In order to foster a comfortable and open environment, students are grouped with their 
            peers and organized based on gender, year, dorm, and interests. Click the button below 
            to get involved with a cru bible study that will meet your needs.
        </div>
        <br/><br/>
        <div class="container" style="width: 40%">
            <a data-toggle="modal" href="#myModal" class="btn btn-warning btn-lg btn-block" style="padding: 20px; font-size: 25pt;"><i>SIGN UP</i></a>
        </div>
        <br/>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Sign up for a bible study</h4>
                    </div>
                    <form action="<?php echo base_url() . 'studies/mail/'; ?>" class="form-horizontal" role="form" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inputName" class="col-lg-2 control-label">Name</label>
                                <div class="col-lg-10">
                                    <input type="text" name="name" class="form-control" id="inputName" placeholder="Name"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputGender" class="col-lg-2 control-label">Gender</label>
                                <div class="col-lg-10">
                                    <select name="gender" class="form-control" id="inputGender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCollege" class="col-lg-2 control-label">College</label>
                                <div class="col-lg-10">
                                    <select name="college" class="form-control" id="inputCollege">
                                        <option value="Cal Poly SLO">Cal Poly SLO</option>
                                        <option value="Cuesta">Cuesta</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputYear" class="col-lg-2 control-label">Year</label>
                                <div class="col-lg-10">
                                    <select name="year" class="form-control" id="inputYear">
                                        <option value="Freshmen">Freshmen</option>
                                        <option value="Sophomore">Sophomore</option>
                                        <option value="Junior">Junior</option>
                                        <option value="Senior">Senior</option>
                                        <option value="Senior plus">Senior+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="dorm">
                                <label for="inputDorm" class="col-lg-2 control-label">Dorm</label>
                                <div class="col-lg-10">
                                    <select name="dorm" class="form-control" id="inputDorm">
                                        <option value="Yosemite">Yosemite</option>
                                        <option value="Sierra Madre">Sierra Madre</option>
                                        <option value="Tenaya">Tenaya</option>
                                        <option value="Trinity">Trinity</option>
                                        <option value="Santa Lucia">Santa Lucia</option>
                                        <option value="North Mountain">North Mountain</option>
                                        <option value="Muir">Muir</option>
                                        <option value="Fremont">Fremont</option>
                                        <option value="Sequoia">Sequoia</option>
                                        <option value="Cerro Vista">Cerro Vista</option>
                                        <option value="PCV">PCV</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="room">
                                <label for="inputRoom" class="col-lg-2 control-label">Room</label>
                                <div class="col-lg-10">
                                    <input type="text" name="room" class="form-control" id="inputRoom" placeholder="Room"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-10">
                                    <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCell" class="col-lg-2 control-label">Cell Phone</label>
                                <div class="col-lg-10">
                                    <input type="text" name="cell" class="form-control" id="inputCell" placeholder="Cell Phone Number"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputInterest" class="col-lg-2 control-label">Interests</label>
                                <div class="col-lg-10">
                                    <div class="checkbox" id="inputInterest">
                                        <label class="pull-left">
                                            <input type="checkbox" name="interests[]" value="Asian Americans">
                                            Asian Americans
                                        </label>
                                    </div>
                                    <div class="checkbox" id="inputInterest">
                                        <label class="pull-left">
                                            <input type="checkbox" name="interests[]" value="Athletes">
                                            Collegiate / Club Athletes
                                        </label>
                                    </div>
                                    <div class="checkbox" id="inputInterest">
                                        <label class="pull-left">
                                            <input type="checkbox" name="interests[]" value="Greeks">
                                            Greeks
                                        </label>
                                    </div>
                                    <div class="checkbox" id="inputInterest">
                                        <label class="pull-left">
                                            <input type="checkbox" name="interests[]" value="Latino/Hispanic">
                                            Latino / Hispanic
                                        </label>
                                    </div>
                                    <div class="checkbox" id="inputInterest">
                                        <label class="pull-left">
                                            <input type="checkbox" name="interests[]" value="Transfers">
                                            Transfers
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputNotes" class="col-lg-2 control-label">Notes</label>
                                <div class="col-lg-10">
                                    <textarea name="notes" class="form-control" id="inputNotes" rows="5" placeholder="Type in any information you would like us to know..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="submit_button" class="btn btn-primary" data-loading-text="Sending...">Submit</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</div>
<?php $this->load->view('javascript'); ?>
<script>
    $(document).ready(function() {
        $('#submit_button')
                .click(function() {
                    var btn = $(this);
                    btn.button('loading');
                    setTimeout(function() {
                        btn.button('reset');
                    }, 3000);
                });
        $("#inputYear").change(function() {
            var value = $('#inputYear :selected').text();
            var college = $('#inputCollege :selected').text();
            if (value !== "Freshmen" || college === "Cuesta")
            {
                $("#dorm").hide();
                $("#room").hide();
            }
            else
            {
                $("#dorm").show();
                $("#room").show();
            }
        });
        $("#inputCollege").change(function() {
            var value = $('#inputYear :selected').text();
            var college = $('#inputCollege :selected').text();
            if (college === "Cuesta")
            {
                $("#dorm").hide();
                $("#room").hide();
            }
            else if (value === "Freshmen" && college !== "Cuesta")
            {
                $("#dorm").show();
                $("#room").show();
            }
        });
    });
</script>
