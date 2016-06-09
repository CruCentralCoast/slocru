<style type="text/css">
    input[type=date]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        display: none;
    }
    input[type=date]::-webkit-clear-button {
        -webkit-appearance: none;
        display: none;
    }
    input[type=time]::-webkit-clear-button {
        -webkit-appearance: none;
        display: none;
    }
</style>
<br/>
<?php foreach ($events as $value) { ?>
    <!-- Button trigger modal -->
    <button class="btn" data-toggle="modal" data-target="#<?php echo $value->DirectLink ?>">
        <?php echo $value->Name ?>
    </button>
    <div class="modal fade" id="<?php echo $value->DirectLink ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?php echo base_url() . 'admin/updateevent/' . $value->Id; ?>" role="form" method="post">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="<?php echo $value->Name ?>" name="name">
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" class="form-control" value="<?php echo $value->Date ?>" name="date" />
                        </div>
                        <div class="form-group">
                            <label>Start Time</label>
                            <input type="time" class="form-control" value="<?php echo $value->StartTime ?>" name="starttime">
                        </div>
                        <div class="form-group">
                            <label>End Time</label>
                            <input type="time" class="form-control" value="<?php echo $value->EndTime ?>" name="endtime">
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" class="form-control" value="<?php echo $value->Location ?>" name="location">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="7" name="description"><?php echo $value->Description ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="text" class="form-control" value="<?php echo $value->Image ?>" name="image">
                        </div>
                        <div class="form-group">
                            <label>Outside Link</label>
                            <input type="text" class="form-control" value="<?php echo $value->Link ?>" name="outsidelink">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" <?php
                                if ($value->ShowSlide == 1) {
                                    echo 'checked';
                                }
                                ?> name="display">
                                Display event image on front page
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Direct Link</label>
                            <input type="text" class="form-control" value="<?php echo $value->DirectLink ?>" name="directlink">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" style="text-decoration: none; color: white">
                            <a href="<?php echo base_url() . 'admin/deleteevent/' . $value->Id ?>">Delete</a>
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } ?>
<button class="btn" data-toggle="modal" data-target="#newevent">
    +
</button>
<div class="modal fade" id="newevent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="<?php echo base_url() . 'admin/newevent/'; ?>" role="form" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Start Time</label>
                        <input type="time" name="starttime" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>End Time</label>
                        <input type="time" name="endtime" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="7"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="text" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Outside Link</label>
                        <input type="text" name="outsidelink" class="form-control">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="display">
                            Display event image on front page
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Direct Link</label>
                        <input type="text" name="directlink" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" value="Create Event" class="btn btn-primary"/>
            </div>
            </form>
        </div>
    </div>
</div>
<br/>
<br/>
