<!doctype html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport"
		      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php if ( !function_exists('yoast_breadcrumb') ) : ?>
            <title><?= wp_get_document_title(); ?></title>
        <?php endif; ?>
		<script>document.documentElement.className = document.documentElement.className.replace(/\bno-js\b/, 'js');</script>
        <!-- Preload all fonts  -->
        <!-- <link rel="preload" href="<?= ''; //get_template_directory_uri(); ?>/assets/font/ModernEra-Medium.woff2" as="font" type="font/woff2" crossorigin> -->
		<!-- Critical CSS -->
        <style id="critical-css"><?= file_get_contents( get_template_directory() . '/critical.css'); ?></style>

        <link rel="preload" href="<?= get_template_directory_uri(); ?>/build/css/app.css?ver=<?= filemtime(get_template_directory() . '/build/css/app.css' ); ?>" as="style" type="text/css">
        <link rel="preload" href="<?= get_template_directory_uri(); ?>/build/js/app.js?ver=<?= filemtime(get_template_directory() . '/build/js/app.js' ); ?>" as="script" type="text/javascript">
        <?php wp_head() ?>
	</head>
	<body <?php body_class() ?>>