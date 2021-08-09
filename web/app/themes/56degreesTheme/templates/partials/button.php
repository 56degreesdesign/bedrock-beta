<?php 
 if($link) : 
    $url = ($link['type'] == 'internal') ? $link['internal'] : $link['external'];
    $target = ($link['new_tab']) ? 'target="_blank" rel="noopener noreferrer"' : null; 
    $label = ($link['label']) ? $link['label'] : 'Learn more';
?>

<?php if($url && $label) : ?>
    <a class="btn <?php echo $class; ?>" href="<?php echo $url; ?>" <?php echo $target; ?>>
        <?php echo $label; ?>
    </a>
<?php endif; ?>

<?php endif;
// Use this like this
// get_template_part( 'templates/partials/button', null, ['link' => $ACF_BUTTON_CONPNENT, 'class' => 'w-full'] ) ?>