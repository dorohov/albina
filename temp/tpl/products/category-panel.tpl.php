<?
	$products_top = get_field('products_top', 1);
	$products_left = get_field('products_left', 1);
	$products_bottom = get_field('products_bottom', 1);
?>

		<div class="<?=$param["block_prefix"];?>row row  is--gutter  is--wrap">
			<div class="<?=$param["block_prefix"];?>cols cols  is--cols-screen-4  is--cols-sm-6  is--big">
				<?
					foreach($products_top as $cat) {
						$link = get_term_link($cat->term_id, 'ourproducts-categories');
						$title = $cat->name;
						$preview_590 =  get_field('products_preview', $cat);
						$preview = $this->Imgs->rawImg($preview_590, '590x590');
				?>
				<div class="products-card__item  is--category  is--lg  block-hover__block">
					<a href="<?=$link;?>" class="products-card__preview  is--category  is--lg">		
						<div class="products-card__note  is--category  is--lg">
							<h3 class="products-card__heading  is--category  is--lg"  data-heading="<?=$title;?>"><?=$title;?></h3>	
						</div>
						<img src="<?=$preview;?>" alt="<?=$title;?>" class="img-responsive">	
						<div class="block-hover__item">
							<div class="block-hover__heading  is--category  is--lg"><?=$title;?></div>
							<div class="block-hover__icon">
								<div class="block-hover__icon-inner">
									<svg class="icon-svg icon-plus" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#plus"></use></svg>
								</div>
							</div>
						</div>
					</a>
				</div>
				<?	
					}
				?>
			</div>
			<div class="<?=$param["block_prefix"];?>cols cols  is--cols-screen-8  is--cols-sm-6  is--list">
				<div class="<?=$param["block_prefix"];?>inner-row row  is--gutter  is--wrap">
					<?
						foreach($products_left as $cat) {
							$link = get_term_link($cat->term_id, 'ourproducts-categories');
							$title = $cat->name;
							$preview_590 =  get_field('products_preview', $cat);
							$preview = $this->Imgs->rawImg($preview_590, '590x590');
					?>
					<div class="<?=$param["block_prefix"];?>inner-cols cols  is--cols-screen-3  is--cols-sm-6">
						<div class="products-card__item  is--category  block-hover__block">
							<a href="<?=$link;?>" class="products-card__preview  is--category  is--lg">		
								<div class="products-card__note  is--category">
									<h3 class="products-card__heading  is--category"  data-heading="<?=$title;?>"><?=$title;?></h3>	
								</div>
								<img src="<?=$preview;?>" alt="<?=$title;?>" class="img-responsive">	
								<div class="block-hover__item">
									<div class="block-hover__heading  is--category"><?=$title;?></div>
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
			<div class="<?=$param["block_prefix"];?>cols cols  is--cols-screen-8  is--cols-sm-6  is--list">
				<div class="<?=$param["block_prefix"];?>inner-row row  is--gutter  is--wrap">
					<?
						foreach($products_bottom as $cat) {
							$link = get_term_link($cat->term_id, 'ourproducts-categories');
							$title = $cat->name;
							$preview_590 =  get_field('products_preview', $cat);
							$preview = $this->Imgs->rawImg($preview_590, '590x590');
					?>
					<div class="<?=$param["block_prefix"];?>inner-cols cols  is--cols-screen-3  is--cols-sm-6">
						<div class="products-card__item  is--category  block-hover__block">
							<a href="<?=$link;?>" class="products-card__preview  is--category  is--lg">		
								<div class="products-card__note  is--category">
									<h3 class="products-card__heading  is--category"  data-heading="<?=$title;?>"><?=$title;?></h3>	
								</div>
								<img src="<?=$preview;?>" alt="<?=$title;?>" class="img-responsive">	
								<div class="block-hover__item">
									<div class="block-hover__heading  is--category"><?=$title;?></div>
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
			<div class="<?=$param["block_prefix"];?>cols cols  is--cols-screen-4  is--cols-sm-6  is--link">
				<div class="products-card__item  is--link">
					<a href="<?=l(7);?>" class="btn-link__item"><span>Услуги типографии</span></a>
				</div>	
			</div>
		</div>