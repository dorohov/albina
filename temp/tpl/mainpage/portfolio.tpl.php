<?
	$portfolio_heading = get_field('portfolio_heading', $id);
	$portfolio_pos1 = get_field('portfolio_pos1', $id);
	$portfolio_pos2 = get_field('portfolio_pos2', $id);
?>
<div class="<?=$param["block_prefix"];?>block  <?=$param["block_mod"];?>">	
	<?
	$this->tpl(
		'_/bg-card', 
		array(
			"block_prefix" => "bg-plane__",
			"block_mod" => "is--index-portfolio  is--speed-15",
			"block_bg" => "bg-plane-index-portf-yellow.png",
		)
	);
	$this->tpl(
		'_/bg-card-preview', 
		array(
			"block_prefix" => "bg-static__",
			"block_mod" => "is--clip-left",
			"block_bg" => "/wp-content/themes/azbn7theme/img/bg/bg-clip-left.png",
		)
	);
	$this->tpl(
		'_/bg-card-preview', 
		array(
			"block_prefix" => "bg-static__",
			"block_mod" => "is--clip-right",
			"block_bg" => "/wp-content/themes/azbn7theme/img/bg/bg-clip-right.png",
		)
	);
	$this->tpl(
		'_/bg-card-preview', 
		array(
			"block_prefix" => "bg-static__",
			"block_mod" => "is--flover",
			"block_bg" => "/wp-content/themes/azbn7theme/img/bg/bg-flover.png",
		)
	);
	?>
	<div class="container <?=$param["block_prefix"];?>container bg-header__container">
		<h2 class="<?=$param["block_prefix"];?>heading  <?=$param["block_mod"];?>"><?=$portfolio_heading;?></h2>
		<div class="<?=$param["block_prefix"];?>row row  is--gutter  is--wrap  <?=$param["block_mod"];?>">
			<?
			foreach($portfolio_pos1 as $index => $item) {
				$id = $item->ID;
				$link = l($id);
				$title = t($id);
				$preview = $this->Imgs->postImg($id, '550x260');
				$preview_sm = $this->Imgs->postImg($id, '315x250');
				$preview_xs = $this->Imgs->postImg($id, '360x360');
				$preview_full = $this->Imgs->postImg($id, '1280x880');
				$cols = "is--cols-screen-4";
				$full = $index % 3;
				if ($full){
					$cols = "is--cols-screen-2";
					$preview = $this->Imgs->postImg($id, '245x260');
				}
			?>
			<div class="<?=$param["block_prefix"];?>cols cols  <?=$cols;?>  is--cols-sm-4  <?=$param["block_mod"];?>">
				<div class="portfolio-card__item  block-hover__block">
					<a href="<?=$preview_full;?>" data-fancybox="portfolio-card" class="portfolio-card__preview" title="<?=$title?>">
						<picture class="portfolio-card__preview-picture"> 
							<source media="(min-width: 1025px)" 
									srcset="<?=$preview;?>">
							<source media="(min-width: 768px)" 
									srcset="<?=$preview_sm;?>">
							<img src="<?=$preview_xs;?>" alt="<?=$title?>">
						</picture>	
						<div class="block-hover__item">
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
			?>			
		</div>
	</div>
</div>