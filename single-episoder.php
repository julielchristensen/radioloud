<?php
//loads the header.php template.

get_header();
?>
<script>
    let aktuelepisode = <?php echo get_the_ID() ?>;
    console.log(aktuelepisode);

</script>







<?php
get_footer();
