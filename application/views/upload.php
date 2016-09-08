<?php
    $this->load->helper('form');
?>
<body>
    <?php
    echo form_open('upload');
    echo form_upload('some_data', 'some_data');
    echo form_submit();
    echo form_close();
    ?>
</body>