<?php 
 if($image) : ?>
<picture <?php echo ($class) ? 'class="'.$class.'"' : ''; ?>>
    <?php if ( $image['mime_type'] != 'image/svg+xml' ) : ?>
    <source
        type="image/webp"
        srcset="<?php echo $image['sizes']['placeholder']; ?>.webp"
        data-srcset="<?php echo $image['url']; ?>.webp 1920w,
         <?php echo $image['sizes']['largeRetina']; ?>.webp 1440w,
         <?php echo $image['sizes']['largeRetina']; ?>.webp 1024w,
         <?php echo $image['sizes']['medium_large']; ?>.webp 600w,
         <?php echo $image['sizes']['medium_large']; ?>.webp 320w">
    <source
        type="<?php echo $image['mime_type']; ?>"
        srcset="<?php echo $image['sizes']['placeholder']; ?>"
        data-srcset="<?php echo $image['url']; ?> 1920w,
         <?php echo $image['sizes']['largeRetina']; ?> 1440w,
         <?php echo $image['sizes']['largeRetina']; ?> 1024w,
         <?php echo $image['sizes']['medium_large']; ?> 600w,
         <?php echo $image['sizes']['medium_large']; ?> 320w" >
        <img class="lazyload fade-up <?php echo $imageClass; ?>" data-expand="-50" src="<?php echo $image['sizes']['placeholder']; ?>" data-src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
    <?php else : ?>
        <img class="lazyload fade-up <?php echo $imageClass; ?>" data-expand="-50" src="<?php echo $image['url']; ?>" data-src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
    <?php endif; ?>
</picture>

<?php endif;
// Use this like this
// get_template_part( 'templates/partials/image', null, ['image' => $AFC_IMAGE, 'class' => 'w-full'] ) ?>