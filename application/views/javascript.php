<script src="http://code.jquery.com/jquery.js"></script>
<script src="../assets/js/bootstrap.js"></script>
<script>
    $(document).ready(function() {
        $("#home-button").click(function() {
            window.location.href = "<?php echo base_url() ?>";
        });
    });
</script>