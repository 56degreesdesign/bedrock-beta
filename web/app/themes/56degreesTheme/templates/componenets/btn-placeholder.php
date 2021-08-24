<?php 
$label = $args['label'] ?? 'View all';
$class = $args['class'] ?? '';
?>
<a class="btn <?= $class ?>" href="#">
    <span><?php echo $label; ?></span><svg xmlns="http://www.w3.org/2000/svg" width="34.4" height="13.322"><path data-name="Path 195" d="M27.546.354l6.148 6.148-6.467 6.467m6.467-6.467H0" fill="none" stroke="#fff" stroke-miterlimit="10"/></svg>
</a>
<?php
// Use this like this
// get_template_part( 'templates/componenets/btn', 'placeholder', ['label' => 'Label Text, 'class' => 'w-full'] ) ?>