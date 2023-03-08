

<?php get_header(); 

/*  local.EVENTS */


pageBanner(array(
  'title' => 'All Events',
  'subtitle' => 'See what is gooooing on in our wold.'
));

?>




  <div class="container container--narrow page-section">
  <?php 

  
  
  while(have_posts()) {

    the_post(); 

    get_template_part('template-parts/content-event');
  
  
  }  

echo paginate_links();

?>

<hr class="section-break">

<p>Looking for a recap of past events? <a href="<?php echo site_url('/past-events') ?>">CHECK OUT!</a></p>


</div>




<?php get_footer(); ?>