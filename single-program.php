<?php
  
  get_header();

  while(have_posts()) {
    the_post(); 
    pageBanner();?>
    <div class="container container--narrow page-section">
    	 <div class="metabox metabox--position-up metabox--with-home-link">
      		<p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link( 'program' ); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs</a> <span class="metabox__main"><?php the_title(); ?></span></p>
      	</div>
	    <div class="generic-content"> <?php the_content(); ?> </div>

       <?php 
        $relatedProfessors = new WP_Query( array(
            'posts_per_page'  => -1,
            'post_type'       => 'professor',
            'orderby'         => 'title',
            'order'           => 'ASC',
            'meta_query'      => array(
              array(
                'key'       =>  'related_program',
                'compare'   =>  'LIKE',
                'value'     =>  '"' . get_the_ID() . '"',
              )
            )
        )); 

        if ($relatedProfessors->have_posts()) {
        echo '<hr class="section-break" />';
        echo '<h2>Related Professors</h2>';
        echo '<ul class="professor-cards">';
          while ( $relatedProfessors->have_posts() ) {
            $relatedProfessors->the_post(); ?>

        <li class="professor-card__list-item">
            <a href="<?php the_permalink(); ?>" class="professor-card">
                <img src="<?php the_post_thumbnail_url('professorLandscape'); ?>" class="professor-card__image" />
                <span class="professor-card__name"><?php the_title(); ?></span>
            </a>
        </li>

        <?php  }
        
        echo '</ul>';

        ?>
        
        <?php }  wp_reset_postdata();  ?>

    <?php
        $today = date('Ymd');
        $eventsQuery = new WP_Query( array(
            'post_type'       => 'event',
            'meta_key'        => 'event_date',
            'orderby'         => 'meta_value_num',
            'order'           => 'ASC',
            'meta_query'      => array(
              array(
                'key'       => 'event_date',
                'compare'   => '>=',
                'value'     => $today,
                'type'      => 'numeric',
              ),
              array(
                'key'       =>  'related_program',
                'compare'   =>  'LIKE',
                'value'     =>  '"' . get_the_ID() . '"',
              )
            )
        )); 

        if ($eventsQuery->have_posts()) {
          echo '<hr class="section-break" />';
          echo '<h2>Upcoming ' . get_the_title() . ' Events</h2>';

          while ( $eventsQuery->have_posts() ) {
            
            $eventsQuery->the_post();
            get_template_part('template-parts/content', 'event');    
        
        } ?>

        <?php }  

        wp_reset_postdata(); 

        $relatedCampuses = get_field('related_campus');

        if ($relatedCampuses) {
            echo '<hr class="section-break">';
            echo '<h4 class="headline headline--small">' .  get_the_title() . ' is Available at These Campuses:</h4>';
            ?>
            <ul>
                <?php
                foreach($relatedCampuses as $campus) {
                    ?>
                    <li>
                        <a href="<?php echo get_the_permalink($campus); ?>">
                            <?php echo get_the_title($campus); ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>

            <?php
        }
        
        ?>
        
    </div>

  <?php }

  get_footer();

?>