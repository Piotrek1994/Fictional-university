<?php get_header(); 

/* local/CAMPUSES */

pageBanner(array(
  'title' => 'Our campuses',
  'subtitle' => 'We have campuses all over  the world'
));

?>



  <div class="container container--narrow page-section">

<div class="acf-map">


  <?php 
  while(have_posts()) {
    the_post(); 
    $mapLocation = get_field('map_location');
    ?>
    <div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng']; ?>"><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <?php echo $mapLocation['address']; ?>
</div>
    <?php } ?>
</div>



</div>




<?php get_footer(); ?>