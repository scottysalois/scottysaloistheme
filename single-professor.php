<?php
  
  get_header();

  while(have_posts()) {
    the_post(); 
    pageBanner();

    ?>


    <div class="container container--narrow page-section">
	    <div class="generic-content">
        <div class="row group">
            <div class="one-third">
                <?php the_post_thumbnail('professorPortrait'); ?>
            </div>
            <div class="two-thirds">
                <?php the_content(); ?>
            </div>
        </div>
        </div>

    <?php 

  
  $posts = get_field('related_program');

    if( $posts ): 
    echo '<hr class="section-break">';
    echo '<h2 class="headline headline--medium">Subject(s) Taught</h2>';
    echo '<ul class="link-list min-list">'; ?>
      
      <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
      
          <?php setup_postdata($post); ?>
          
          <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
      
      <?php endforeach; ?>
      
      <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 

    echo '</ul>'; ?>

    <?php endif; ?>


  </div>

  <?php }

  get_footer();

?>