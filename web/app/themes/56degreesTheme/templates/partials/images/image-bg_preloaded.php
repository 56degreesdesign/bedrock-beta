<?php 
$image = $args['image'] ?? false;
$class = $args['class'] ?? false;
$imageClass = $args['imageClass'] ?? false;
$placeholder = $args['isPlaceholder'] ?? false;
$image_position = $args['imgPosition'] ?? 'object-center';
if($image && !$placeholder) : ?>

<?php if ( $image['mime_type'] != 'image/svg+xml' ) : ?>
<link rel="preload" as="image" 
        imagesrcset="<?= $image['url']; ?>.webp 1440w,
        <?= $image['sizes']['1536x1536']; ?>.webp 1024w,
        <?= $image['sizes']['large']; ?>.webp 600w,
        <?= $image['sizes']['medium_large']; ?>.webp 320w" 
        imagesizes="100vw">
<?php endif; ?>      
<picture class="block absolute top-0 left-0 w-full h-full <?= $class; ?>">
    <?php if ( $image['mime_type'] != 'image/svg+xml' ) : ?>
    <source
        type="image/webp"
        srcset="<?= $image['url']; ?>.webp 1440w,
        <?= $image['sizes']['1536x1536']; ?>.webp 1024w,
        <?= $image['sizes']['large']; ?>.webp 600w,
        <?= $image['sizes']['medium_large']; ?>.webp 320w">
         
    <source
        type="<?= $image['mime_type']; ?>"
        srcset="<?= $image['url']; ?> 1440w,
        <?= $image['sizes']['1536x1536']; ?> 1024w,
        <?= $image['sizes']['large']; ?> 600w,
        <?= $image['sizes']['medium_large']; ?> 320w">
        <img class="w-full h-full <?= $image_position; ?> object-cover absolute top-0 left-0 <?= $imageClass; ?>" 
            src="<?= $image['sizes']['placeholder']; ?>" 
            width="150"
            height="150"
            sizes="100vw"
            alt="<?= $image['alt']; ?>">
    <?php else : ?>
        <img class="w-full h-full <?= $image_position; ?> object-cover absolute top-0 left-0 <?= $imageClass; ?>" 
            src="<?= $image['url']; ?>" 
            width="150"
            height="150"
            alt="<?= $image['alt']; ?>">
    <?php endif; ?>
</picture>
<?php endif;
// Use this like this
// get_template_part( 'templates/partials/images/image', 'bg_preloaded', ['image' => $AFC_IMAGE, 'class' => 'w-full'] ) ?>