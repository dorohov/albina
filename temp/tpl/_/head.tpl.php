<meta charset="utf-8" >

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<title>
<?
if(is_category()) {
	single_cat_title();
} else {
	the_title();
}
?>
</title>
<meta name="keywords" content="">
<meta name="description" content="">

<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="apple-touch-icon" sizes="180x180" href="<?=$this->path('favicon');?>/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?=$this->path('favicon');?>/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?=$this->path('favicon');?>/favicon-16x16.png">
<link rel="manifest" href="<?=$this->path('favicon');?>/manifest.json">
<link rel="mask-icon" href="<?=$this->path('favicon');?>/safari-pinned-tab.svg" color="#132c81">
<link rel="shortcut icon" href="<?=$this->path('favicon');?>/favicon.ico">
<meta name="apple-mobile-web-app-title" content="orel-print.ru">
<meta name="application-name" content="orel-print.ru">
<meta name="msapplication-config" content="<?=$this->path('favicon');?>/browserconfig.xml">
<meta name="theme-color" content="#ffffff"> 

<link href="<?php echo $this->path('css');?>/site.css" rel="stylesheet">
