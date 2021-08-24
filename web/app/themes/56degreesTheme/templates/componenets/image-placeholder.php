<?php 
$class = $args['class'] ?? ''; ?>
<picture <?php echo ($class) ? 'class="'.$class.'"' : ''; ?>>
    <img class="w-full" src="https://i.stack.imgur.com/y9DpT.jpg" alt="Placeholder">
</picture>

<?php
// Use this like this
// get_template_part( 'templates/componenets/image', 'placeholder', ['class' => 'w-full'] ) ?>