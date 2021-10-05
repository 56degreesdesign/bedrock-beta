<?php
$data = $args['data'] ?? false;
$class = $args['class'] ?? '';
$id = $args['id'] ?? '';
$title = $args['title'] ?? 'Placeholder Title';
$text = $args['text'] ?? 'Placeholder Text';
?>

<section class="py-32 bg-yellow-500">
    <div class="container" id="vue-space">
        <div inline-template is="parent-component">
            <div class="w-full">
                <div class="w-full">
                    <h2 class="pt-8 text-2xl font-extrabold text-white sm:text-3xl">Vue Parent Component</h2>
                    <child-component />
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
get_template_part( 'templates/components/vue/multi-file-component/child-component' ); ?>