<?php
$data = $args['data'] ?? false;
$class = $args['class'] ?? '';
$id = $args['id'] ?? '';
$title = $args['title'] ?? 'Placeholder Title';
$text = $args['text'] ?? 'Placeholder Text';
?>
<section class="example-view py-11 bg-gray-500 <?= $class ?>" id="<?= $id ?>">
    <div class="container">
        <?php if ( $title ): ?>
            <h2 class="pt-8 text-2xl font-extrabold text-white sm:text-3xl"><?= $title ?></h2>
        <?php endif; ?>

        <?php if ( $text ): ?>
            <p class="mt-4 text-lg leading-6 text-indigo-200"><?= $text ?></p>
        <?php endif; ?>
    </div>
</section>

<section class="py-11 bg-green-700">
    <div class="container">
        <div class="w-1/4">
            <h2 class="pb-8 text-2xl font-extrabold text-white sm:text-3xl">Image Component</h2>
            <?php get_template_part( 'templates/partials/images/image', null, ['isPlaceholder' => true] ); ?>
        </div>
    </div>
</section>

<section class="py-11 bg-blue-400">
    <div class="container">
        <div class="w-1/4">
            <h2 class="pb-8 text-2xl font-extrabold text-white sm:text-3xl">Button Component</h2>
            <?php get_template_part( 'templates/partials/button', null, ['isPlaceholder' => true] ); ?>
        </div>
    </div>
</section>