<?php 

get_header();

while(have_posts()){
    the_post();
    
    pageBanner(array(
      'title' => 'Hello there this is the title',
      'photo' => 'https://img.freepik.com/darmowe-zdjecie/piekne-ujecie-gor-i-drzew-pokrytych-sniegiem-i-mgla_181624-17590.jpg?w=1380&t=st=1678278560~exp=1678279160~hmac=3f3d3a57430d881e14727e614b00392b344798c4634e1ed0bc84f1ee98e97de2'
    ));
    
    ?>






    <div class="container container--narrow page-section">


    <?php 

    $theParent = wp_get_post_parent_id(get_the_ID());
    
    if($theParent){ ?>

        <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a> <span class="metabox__main"><?php the_title(); ?></span>
        </p>
      </div>

     <?php   
    }
    
    ?>

    <?php
    $testArray = get_pages(array(
        'child_of' => get_the_ID()
    ));
    
    if($theParent or $testArray) { ?>
      <div class="page-links">
        <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?></a></h2>
        <ul class="min-list">
          
        <?php
        if($theParent){
            $findChildrenOf = $theParent;

        } else {
            $findChildrenOf = get_the_ID();
        }

    

        wp_list_pages(array(
            'title_li' => NULL,
            'child_of' => $findChildrenOf,
            'sort_columns' => 'menu_order'


        ));

        ?>

        </ul>
      </div>

    

      <div class="generic-content">
        <?php the_content(); ?>
      </div>
    </div>

    <?php }} ?>
    


<?php 

get_footer();

?>
    



