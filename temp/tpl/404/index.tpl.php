<?
	$block_prefix = "header-block__";
	$header_bg_404 = get_field('header_bg_404', 1);
	$bg = "";
	if($bg != ""){
		$bg = 'style="background-image: url('.$header_bg_404.');"'; 
	}
?>
<div class="content-block <?=$block_prefix;?>block  is--hidden" style="background-image: url('<?=$header_bg_404;?>');">
	<?
		$this->tpl(
			'_/bg-card-preview', 
			array(
				"block_prefix" => "header-block__",
				"block_mod" => "is--pen  is--z-index-1",
				"block_bg" => "/wp-content/themes/azbn7theme/img/bg/bg-404-pen.png",
			)
		);
		$this->tpl(
			'_/bg-card-preview', 
			array(
				"block_prefix" => "header-block__",
				"block_mod" => "is--brochure  is--z-index-3",
				"block_bg" => "/wp-content/themes/azbn7theme/img/bg/bg-404-brochure.png",
			)
		);
		$this->tpl(
			'_/bg-card-preview', 
			array(
				"block_prefix" => "header-block__",
				"block_mod" => "is--plane-orange  is--z-index-4",
				"block_bg" => "/wp-content/themes/azbn7theme/img/bg/bg-404-plane-orange.png",
			)
		);
		$this->tpl(
			'_/bg-card-preview', 
			array(
				"block_prefix" => "header-block__",
				"block_mod" => "is--cards  is--z-index-2",
				"block_bg" => "/wp-content/themes/azbn7theme/img/bg/bg-404-cards.png",
			)
		);
		$this->tpl(
			'_/bg-card-preview', 
			array(
				"block_prefix" => "header-block__",
				"block_mod" => "is--tablet  is--z-index-3",
				"block_bg" => "/wp-content/themes/azbn7theme/img/bg/bg-404-tablet.png",
			)
		);
		$this->tpl(
			'_/bg-card-preview', 
			array(
				"block_prefix" => "header-block__",
				"block_mod" => "is--plane-yellow  is--z-index-4",
				"block_bg" => "/wp-content/themes/azbn7theme/img/bg/bg-404-plane-yellow.png",
			)
		);
		$this->tpl(
			'_/bg-card-preview', 
			array(
				"block_prefix" => "header-block__",
				"block_mod" => "is--plane-green  is--z-index-4",
				"block_bg" => "/wp-content/themes/azbn7theme/img/bg/bg-404-plane-green.png",
			)
		);
		$this->tpl(
			'_/bg-card-preview', 
			array(
				"block_prefix" => "header-block__",
				"block_mod" => "is--leaflet  is--z-index-3",
				"block_bg" => "/wp-content/themes/azbn7theme/img/bg/bg-404-leaflet.png",
			)
		);
		$this->tpl(
			'_/bg-card-preview', 
			array(
				"block_prefix" => "header-block__",
				"block_mod" => "is--list",
				"block_bg" => "/wp-content/themes/azbn7theme/img/bg/bg-404-list.png",
			)
		);
		$this->tpl(
			'_/bg-card-preview', 
			array(
				"block_prefix" => "header-block__",
				"block_mod" => "is--list-two  is--z-index-1",
				"block_bg" => "/wp-content/themes/azbn7theme/img/bg/bg-404-list-two.png",
			)
		);
		$this->tpl(
			'_/bg-card-preview', 
			array(
				"block_prefix" => "header-block__",
				"block_mod" => "is--plane-turq  is--z-index-4",
				"block_bg" => "/wp-content/themes/azbn7theme/img/bg/bg-404-plane-turq.png",
			)
		);
		$this->tpl(
			'_/bg-card-preview', 
			array(
				"block_prefix" => "header-block__",
				"block_mod" => "is--cards-hand  is--z-index-3",
				"block_bg" => "/wp-content/themes/azbn7theme/img/bg/bg-404-cards-hand.png",
			)
		);
		$this->tpl(
			'_/bg-card-preview', 
			array(
				"block_prefix" => "header-block__",
				"block_mod" => "is--label  is--z-index-1",
				"block_bg" => "/wp-content/themes/azbn7theme/img/bg/bg-404-label.png",
			)
		);
		$this->tpl(
			'_/bg-card-preview', 
			array(
				"block_prefix" => "header-block__",
				"block_mod" => "is--num",
				"block_bg" => "/wp-content/themes/azbn7theme/img/bg/bg-404-num.png",
			)
		);
	?>
	
	<div class="<?=$block_prefix;?>btn">
		<a href="/" class="btn-link__item  is--white"><span>Ha главную</span></a>
	</div>
	<div class="container <?=$block_prefix;?>container content-block__container   is--noheader"></div>
</div>