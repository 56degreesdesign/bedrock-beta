<?php
function get_inline_svg($name, $classes = '') {
    $filePath = get_template_directory() . '/assets/img/icons/' . $name . '.svg';

    if (file_exists($filePath)) {
        $svgContent = file_get_contents($filePath);

        if (!empty($classes)) {
            $svgContent = preg_replace('/<svg /', '<svg class="'.htmlspecialchars($classes).'" ', $svgContent, 1);
        }

        return $svgContent;
    }

    return '';
}

function get_svg_as_image_tag($name, $classes = '', $lazy = false) {
    $path = '/assets/img/icons/' . $name . '.svg';
    $localPath = get_template_directory() . $path;
    $filePath = get_template_directory_uri() . $path;

    if (file_exists($localPath)) {
        $fileName = basename($filePath, ".svg");
        $srcAttribute = $lazy ? 'data-lazy-src="'.htmlspecialchars($filePath).'"' : 'src="'.htmlspecialchars($filePath).'"';
        return '<img class="'. htmlspecialchars($classes) .'" alt="'.htmlspecialchars($fileName).'" '.$srcAttribute.'>';
    }

    return '';
}
