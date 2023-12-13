<?php
	global $config;

	$meta_title = (!empty($meta_title)) ? $meta_title : $config['default_title'];
	$meta_description = (!empty($meta_description)) ? $meta_description : $config['default_description'];
	$meta_image = ((!empty($meta_image)) ? $meta_image : $config['base_url'] . $config['default_image']);
?>
<!DOCTYPE HTML>
<html lang="<?=LANG?>">
	<head>
		<!--Metas-->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title><?=$meta_title?></title>
		<meta name="description" content="<?=$meta_description?>">
		<META NAME="Language" CONTENT="<?=__('lang')?>"> 
		<META NAME="locality" CONTENT ="Madrid"> 
		<META NAME="Robots" CONTENT="all"> 
		<META NAME="country" CONTENT="Spain">
		<meta name="Copyright" CONTENT="The Happiness Car"> 
		<meta name="Publisher" CONTENT="The Happiness Car"> 
		<meta name="distribution" CONTENT="Global"> 
		<meta name="ROBOTS" content="index,follow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
		<!-- for Facebook -->
		<meta property="og:url" content="<?=getBaseUrl() . url(CURRENT_ROUTE_NAME)?>">
		<meta property="og:title" content="<?=$meta_title?>" />
		<meta property="og:type" content="article" />
		<meta property="og:image" content="<?=getBaseUrl() . url(CURRENT_ROUTE_NAME)?>/img/social.jpg" />
		<meta property="og:description" content="<?=$meta_description?>" />
		<meta property="og:site_name" content="<?=$meta_title?>" />
		<meta property="og:locale" content="<?=__('lang.slug')?>" />

		<!-- for Twitter -->
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:title" content="<?=$meta_title?>" />
		<meta name="twitter:description" content="<?=$meta_description?>" />
		<meta name="twitter:image" content="<?=getBaseUrl() . url(CURRENT_ROUTE_NAME)?>/img/social.jpg" />
		
		<!-- icons -->
		<link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/icons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/icons/favicon-16x16.png">
		<link rel="manifest" href="/icons/site.webmanifest">
		<link rel="mask-icon" href="/icons/safari-pinned-tab.svg" color="#7f9272">
		<link rel="shortcut icon" href="/icons/favicon.ico">
		<meta name="msapplication-TileColor" content="#7f9272">
		<meta name="msapplication-config" content="/icons/browserconfig.xml">
		<meta name="theme-color" content="#7f9272">

		<link rel="canonical" href="<?=getBaseUrl() . url(CURRENT_ROUTE_NAME)?>">

		<!--Adobe font-->
		<link rel="stylesheet" href="https://use.typekit.net/gzr5wtf.css">
		<!--Css-->
		<link rel="stylesheet" type="text/css" href="/css/styles.css?v2">

		<!--Javascript-->
		<script src="/js/jquery.inview.js"></script>
		<script src="/js/general-min.js?v1"></script>
		<script src="/js/lenis.min.js"></script> 
		<script src="/js/macy.js"></script>

		<!-- Global site tag (gtag.js) - Google Analytics -->

	</head> 
	<body <?=(!empty($body_class))? " class=\"$body_class\"" : '';?>>
		<div class="main" role="main">
			<?=$view_content; ?>
			<?php element('header'); ?>
			<?php element('footer'); ?>
		</div>
	</body>
	<script>
		$(document).ready(function(){
			const lenis = new Lenis()

			lenis.on('scroll', (e) => {
				console.log(e)
			})

			function raf(time) {
				lenis.raf(time)
				requestAnimationFrame(raf)
			}

			requestAnimationFrame(raf)
		});
	</script>
</html>