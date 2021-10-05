<?php 
    $link = $args['link'] ?? false;
    $class = $args['class'] ?? '';
    $isPlaceholder = $args['isPlaceholder'] ?? false;
    if($link) : 
        $url = ($link['type'] == 'internal') ? $link['internal'] : $link['external'];
        $target = ($link['new_tab']) ? 'target="_blank" rel="noopener noreferrer"' : null; 
        $label = ($link['label']) ? $link['label'] : 'Learn more'; ?>

    <?php if($url) : ?>
        <a class="btn <?= $class ?>" href="<?= $url; ?>" <?= $target; ?>>
            <?= $label; ?>
        </a>
    <?php endif; ?>

    <?php elseif($isPlaceholder): ?>
        <a class="btn <?= $class ?>" href="#">
            Button
        </a>
<?php endif;
// Use this like this
// get_template_part( 'templates/partials/button', null, ['link' => $ACF_BUTTON_CONPNENT, 'class' => 'w-full'] ) ?>