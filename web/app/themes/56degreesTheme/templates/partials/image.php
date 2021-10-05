<?php 
$image = $args['image'] ?? false;
$class = $args['class'] ?? false;
$imageClass = $args['imageClass'] ?? false;
$placeholder = $args['isPlaceholder'] ?? false;
if($image && !$placeholder) : ?>
<picture class="block <?= $class; ?>">
    <?php if ( $image['mime_type'] != 'image/svg+xml' ) : ?>
    <source
        type="image/webp"
        srcset="<?= $image['sizes']['placeholder']; ?>.webp"
        data-srcset="<?= $image['url']; ?>.webp 1920w,
        <?= $image['sizes']['largeRetina']; ?>.webp 1440w,
        <?= $image['sizes']['1536x1536']; ?>.webp 1024w,
        <?= $image['sizes']['large']; ?>.webp 600w,
        <?= $image['sizes']['medium_large']; ?>.webp 320w">
         
    <source
        type="<?= $image['mime_type']; ?>"
        srcset="<?= $image['sizes']['placeholder']; ?>"
        data-srcset="<?= $image['url']; ?> 1920w,
        <?= $image['sizes']['largeRetina']; ?> 1440w,
        <?= $image['sizes']['1536x1536']; ?> 1024w,
        <?= $image['sizes']['large']; ?> 600w,
        <?= $image['sizes']['medium_large']; ?> 320w">
        <img class="lazyload fade-up w-full <?= $imageClass; ?>" 
            data-expand="-50" src="<?= $image['sizes']['placeholder']; ?>" 
            data-src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
    <?php else : ?>
        <img class="lazyload fade-up w-full <?= $imageClass; ?>" 
            data-expand="-50" src="<?= $image['url']; ?>" 
            data-src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
    <?php endif; ?>
</picture>

<?php elseif($placeholder) : ?>
    <picture class="block <?= $class; ?>">
        <img class="lazyload fade-up w-full <?= $imageClass; ?>" 
            data-expand="-50" src="https://picsum.photos/300/200?random=1" 
            data-src="https://picsum.photos/1220/800?random=1" alt="Img Alt">
    </picture>
<?php endif;
// Use this like this
// get_template_part( 'templates/partials/image', null, ['image' => $AFC_IMAGE, 'class' => 'w-full'] ) ?>