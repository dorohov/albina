<?
	$header_bg = get_field('header_bg', $id);
	$heading = get_field('heading', $id);
	$heading_small = get_field('heading_small', $id);

	$bg = "";
	if($bg != ""){
		$bg = 'style="background-image: url('.$header_bg.');"'; 
	}

	$posts = new WP_Query(array(
		'post_type' => 'page',
		'posts_per_page' => 3,
		'post_parent' => 9,
		'orderby' => array(
			'menu_order' => 'ASC',
			'date' => 'DESC',
			'ID' => 'DESC',
			'name' => 'ASC',
		),
	));

?>
<div class="content-block <?=$param["block_prefix"];?>block  is--hidden  is--index" style="background-image: url('<?=$header_bg;?>');">
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
	?>
	<div class="<?=$param["block_prefix"];?>header-block">
		<h1 class="<?=$param["block_prefix"];?>header-heading"><?=$heading;?></h1>
		<h3 class="<?=$param["block_prefix"];?>header-heading-small"><?=$heading_small;?></h3>
	</div>
	<div class="<?=$param["block_prefix"];?>scrollto">
		<a class="scrollto <?=$param["block_prefix"];?>scrollto-link" href="#index-advantages" data-scrollto-diff="-90">
			<svg class="icon-svg icon-mouse" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#mouse"></use></svg>
		</a>
	</div>
	<div class="<?=$param["block_prefix"];?>action-block">
		<div class="row <?=$param["block_prefix"];?>action-row  is--gutter  is--wrap  is--jcc is--aic"> 
			<div class="cols <?=$param["block_prefix"];?>action-cols  is--heading">
				<div class="cols <?=$param["block_prefix"];?>action-heading">Акции</div>
			</div>
			<?
				while($posts->have_posts()) {
					$posts->the_post();
					$id = get_the_ID();
					$link = l($id);
					$title = t($id);
					$preview = $this->Imgs->postImg($p->ID, '520x295');
					if ($preview == ""){
						$preview = "https://placeholdit.imgix.net/~text?txtsize=30&txt=520x295&w=520&h=295";
					}						
			?>
			<div class="cols <?=$param["block_prefix"];?>action-cols  is--item">
				<div class="action-card__item  block-hover__block">
					<a href="<?=$link;?>" class="action-card__preview">
						<img src="<?=$preview;?>" alt="<?=$title;?>"  class="img-responsive">	
						<div class="block-hover__item">		
							<div class="block-hover__heading  is--xs"><?=$title;?></div>
							<div class="block-hover__icon">
								<div class="block-hover__icon-inner">
									<svg class="icon-svg icon-plus" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#plus"></use></svg>
								</div>
							</div>
						</div>
					</a>			
				</div>
			</div>
			<?
				}
				wp_reset_postdata();
			?>
			<div class="cols <?=$param["block_prefix"];?>action-cols  is--item">
				<a href="<?=l(9);?>" class="btn-link__item  is--white"><span>Вcе акции</span></a>
			</div>
		</div>
	</div>
</div>