<?php
  
  get_header();

  while(have_posts()) {
    the_post(); 
pageBanner();?>

    <div class="container container--narrow page-section">
    	 <div class="metabox metabox--position-up metabox--with-home-link">
      		<p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link( 'event' ); ?>"><i class="fa fa-home" aria-hidden="true"></i> Events Home</a> <span class="metabox__main"><?php the_title(); ?></span></p>
      	</div>
	    <div class="generic-content">
	    	<?php the_content();  ?>
      </div>

    <?php 

  
  $posts = get_field('related_program');

    if( $posts ): 
    echo '<hr class="section-break">';
    echo '<h2 class="headline headline--medium">Related Program(s)</h2>';
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