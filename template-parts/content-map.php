<div class="acf-map">
        <?php $mapLocation = get_field('map_location'); ?>
        <div class="marker" data-lat="<?php echo $mapLocation['lat']; ?>" data-lng="<?php echo $mapLocation['lng']; ?>">
            <h3><?php the_title(); ?></h3>
            <p><?php echo $mapLocation['address']; ?></p>
        </div>
</div>