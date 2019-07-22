<?php

  get_header();

  while(have_posts()) {
    the_post(); 
    
    pageBanner( array(
        'title' => 'Hello there this is the title',
        'subtitle' =>  'Hi this is the sub title',
    ));

    ?>

  <div class="container container--narrow page-section">

    <?php 
    // = the id of the current pages parent page
    $theParent = wp_get_post_parent_id( get_the_ID());

    if ($theParent) {

    ?>
      
       <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a> <span class="metabox__main"><?php the_title(); ?></span></p>
      </div>

    <?php } ?>

    <?php 
    // or operator gives us the option of having 2 conditions
    // this function returns the pages in memory - you'd have to echo this one
    $testArray = get_pages( array(
      'child_of' => get_the_id()
    ));
    
    if( $theParent or $testArray ) { 

    ?>

    <div class="page-links">
      <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?></a></h2>
      <ul class="min-list">
        <?php 
          // wp_list_pages lists all the pages until we give arguments
          // this function calls for an associative array
          // basic array $animals = array('cat', 'dog', 'pig');
          /* associative array $animalSounds = array (
            'cat' => 'meow',
            'dog' => 'bark',
            'pig' => 'oink'
          );
          */
          if ($theParent) {
            $findChildrenOf = $theParent;
          } else{
            $findChildrenOf = get_the_ID();
          }
          wp_list_pages(array(
            'title_li' => NULL,
            'child_of' => $findChildrenOf,
            // change the order of the column
            'sort_column' => 'menu_order',
          ));
        ?>
      </ul>
    </div>

    <?php } ?>



    <div class="generic-content">
      <?php the_content(); ?>
    </div>

  </div>
    
  <?php }

  get_footer();

?>