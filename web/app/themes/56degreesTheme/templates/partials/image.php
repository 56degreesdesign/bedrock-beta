<?php
// images
$image = $args['image'] ?? false;
$image_mobile = $args['imageMobile'] ?? false;

// classes
$class = $args['class'] ?? false;
$imageClass = $args['imageClass'] ?? 'w-full';

// loading and display
$placeholder = $args['isPlaceholder'] ?? false;
$lazy = $args['lazy'] ?? true;
$bg = $args['bg'] ? 'absolute left-0 top-0 w-full h-full' : null;
$fetchpriority = $args['fetch'] ?? null;
$expand = $args['expand'] ?? -50;

// Alternative text
$alt = $image['alt'] != '' ? $image['alt'] : $image['title'] ?? '';

if ( $image && !$placeholder ) :
?>
<picture class="block <?= $bg; ?> <?= $class; ?>">
    <?php if ($image['mime_type'] != 'image/svg+xml') : ?>
        <?php if ($image_mobile && !empty($image_mobile['url'])) : ?>

            <?php // desktop ?>
            <source
                media="(min-width: 1024px)"
                type="image/webp"
                srcset="<?= $image['sizes']['placeholder']; ?>.webp"
                data-srcset="<?= $image['url']; ?>.webp 1440w,
                             <?= $image['sizes']['1536x1536']; ?>.webp 1024w"
            >

            <source
                media="(min-width: 1024px)"
                type="<?= $image['mime_type']; ?>"
                srcset="<?= $image['sizes']['placeholder']; ?>"
                data-srcset="<?= $image['url']; ?> 1440w,
                             <?= $image['sizes']['1536x1536']; ?> 1024w"
            >

            <?php // mobile ?>
            <source
                media="(max-width: 1024px)"
                type="image/webp"
                srcset="<?= $image_mobile['sizes']['placeholder']; ?>.webp"
                data-srcset="<?= $image_mobile['sizes']['1536x1536']; ?>.webp 600w,
                             <?= $image_mobile['sizes']['large']; ?>.webp 320w"
            >

            <source
                media="(max-width: 1024px)"
                type="image/webp"
                srcset="<?= $image_mobile['sizes']['placeholder']; ?>"
                data-srcset="<?= $image_mobile['sizes']['1536x1536']; ?>
                             <?= $image_mobile['sizes']['large']; ?>"
            >
        <?php else : ?>
            <source
                type="image/webp"
                srcset="<?= $image['sizes']['placeholder']; ?>.webp"
                data-srcset="<?= $image['url']; ?>.webp 1440w,
                             <?= $image['sizes']['1536x1536']; ?>.webp 1024w,
                             <?= $image['sizes']['large']; ?>.webp 600w,
                             <?= $image['sizes']['medium_large']; ?>.webp 320w"
            >

            <source
                type="<?= $image['mime_type']; ?>"
                srcset="<?= $image['sizes']['placeholder']; ?>"
                data-srcset="<?= $image['url']; ?> 1440w,
                             <?= $image['sizes']['1536x1536']; ?> 1024w,
                             <?= $image['sizes']['large']; ?> 600w,
                             <?= $image['sizes']['medium_large']; ?> 320w"
            >
        <?php endif; ?>

        <img <?= $fetchpriority ? 'fetchpriority="'. $fetchpriority .'"' : null; ?> class="lazyload fade-up <?= $imageClass; ?> <?= $bg ? 'absolute left-0 top-0 w-full h-full object-center object-cover' : null; ?>"
             data-expand="<?= $expand; ?>" src="<?= $image['sizes']['placeholder']; ?>"
             width="150"
             height="150"
            <?= $lazy ? 'loading="lazy"' : null; ?>
             data-src="<?= $image['url']; ?>" alt="<?= $alt; ?>">
    <?php else : ?>
        <img <?= $fetchpriority ? 'fetchpriority="'. $fetchpriority .'"' : null; ?> class="lazyload fade-up <?= $imageClass; ?> <?= $bg ? 'absolute left-0 top-0 w-full h-full object-center object-cover' : null; ?>"
             data-expand="<?= $expand; ?>" src="<?= $image['url']; ?>"
             width="150"
             height="150"
            <?= $lazy ? 'loading="lazy"' : null; ?>
             data-src="<?= $image['url']; ?>" alt="<?= $alt; ?>">
    <?php endif; ?>
</picture>
<?php elseif ( $placeholder ) : ?>
<picture class="block <?= $class; ?> <?= $bg; ?>">
    <img class="lazyload fade-up <?= $imageClass; ?> <?= $bg ? 'absolute left-0 top-0 w-full h-full object-center object-cover' : null; ?>"
         data-expand="<?= $expand; ?>" src="https://picsum.photos/300/200?random=1"
         data-src="https://picsum.photos/1220/800?random=1" alt="Img Alt">
</picture>
<?php endif; ?>
