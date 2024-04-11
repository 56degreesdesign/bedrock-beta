<?php
function featuredImageToAcfImage($imageID) {
    $image = [];

    $url = wp_get_attachment_url($imageID);

    if ( ! $url) {
        return false;
    }

    $check_image = wp_get_attachment_image_src($imageID);
    $res_image = "";

    if ( is_array($check_image) ) {
        $res_image = $check_image[0];
    }
    else if (is_string($check_image)) {
        $res_image = $check_image;
    }
    else {
        return $image;
    }

    $res_image = str_replace(get_site_url().'/', ABSPATH, $res_image);
    $alt = get_post_meta($imageID, '_wp_attachment_image_alt', true);
    $title = get_the_title($imageID);

    $image['title'] = $title;
    $image['url'] = $url;
    $image['alt'] = $alt;
    $image['mime_type'] = mime_content_type($res_image);
    $image['placeholder'] = $url;
    $image['sizes'] = [];

    $attachmentData = wp_get_attachment_metadata(get_post_thumbnail_id());

    // Fix if missing sizes
    if ( ! isset($attachmentData['sizes']['1536x1536'])) {
        $attachmentData['sizes']['1536x1536'] = $attachmentData['sizes']['medium'];
    }
    if ( ! isset($attachmentData['sizes']['large'])) {
        $attachmentData['sizes']['large'] = $attachmentData['sizes']['medium'];
    }

    if ($attachmentData['sizes']) {
        foreach ($attachmentData['sizes'] as $label => $size) {
            $labelHeight = $label.'-height';
            $labelWidth = $label.'-width';

            $image['sizes'][$label] = wp_get_attachment_image_url($imageID, $label);
            $image['sizes'][$labelHeight] = $size['height'];
            $image['sizes'][$labelWidth] = $size['width'];
        }
    }

    return $image;
}