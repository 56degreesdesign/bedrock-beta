<?php 
$image = $args['image'] ?? false;
$class = $args['class'] ?? false;
$imageClass = $args['imageClass'] ?? false;
$placeholder = $args['isPlaceholder'] ?? false;
$image_position = $args['imgPosition'] ?? 'object-center';
$alt = $image['alt'] != '' ? $image['alt'] : $image['title'];

if($image && !$placeholder) : ?>
<picture class="block absolute top-0 left-0 w-full h-full <?= $class; ?>">
    <?php if ( $image['mime_type'] != 'image/svg+xml' ) : ?>
    <source
        type="image/webp"
        srcset="<?= $image['sizes']['placeholder']; ?>.webp"
        data-srcset="<?= $image['url']; ?>.webp 1440w,
        <?= $image['sizes']['1536x1536']; ?>.webp 1024w,
        <?= $image['sizes']['large']; ?>.webp 600w,
        <?= $image['sizes']['medium_large']; ?>.webp 320w">
         
    <source
        type="<?= $image['mime_type']; ?>"
        srcset="<?= $image['sizes']['placeholder']; ?>"
        data-srcset="<?= $image['url']; ?> 1440w,
        <?= $image['sizes']['1536x1536']; ?> 1024w,
        <?= $image['sizes']['large']; ?> 600w,
        <?= $image['sizes']['medium_large']; ?> 320w">
        <img class="lazyload fade-up w-full h-full <?= $image_position; ?> object-cover absolute top-0 left-0 <?= $imageClass; ?>" 
            data-expand="-50" src="<?= $image['sizes']['placeholder']; ?>" 
            width="150"
            height="150"
            data-src="<?= $image['url']; ?>" alt="<?= $$alt; ?>">
    <?php else : ?>
        <img class="lazyload fade-up w-full h-full <?= $image_position; ?> object-cover absolute top-0 left-0 <?= $imageClass; ?>" 
            data-expand="-50" src="<?= $image['url']; ?>" 
            width="150"
            height="150"
            data-src="<?= $image['url']; ?>" alt="<?= $alt; ?>">
    <?php endif; ?>
</picture>

<?php elseif($placeholder) : ?>
    <picture class="block absolute top-0 left-0 w-full h-full <?= $class; ?>">
        <img class="lazyload fade-up w-full h-full object-center object-cover absolute top-0 left-0 <?= $imageClass; ?>" 
            data-expand="-50" src="https://picsum.photos/300/200?random=1" 
            data-src="https://picsum.photos/1220/800?random=1" alt="Img Alt">
    </picture>
<?php endif;
// Use this like this
// get_template_part( 'templates/partials/images/image', 'bg', ['image' => $AFC_IMAGE, 'class' => 'w-full'] ) ?>