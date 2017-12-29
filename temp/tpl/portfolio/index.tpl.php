<?
$block_prefix = "portfolio-page__";
/*$posts = new WP_Query(array(
	'post_type' => 'page',
	'posts_per_page' => -1,
	'post_parent' => 8,
	'orderby' => array(
		'menu_order' => 'ASC',
		'date' => 'DESC',
		'ID' => 'DESC',
		'name' => 'ASC',
	),
));*/
$projects = new WP_Query(array(
	'post_type' => 'ourwork',
	'posts_per_page' => -1,
));
$heading_small = get_field('page_heading_small', $id);
$heading_color = get_field('heading_color', $id);
?>
<div class="content-block <?=$block_prefix;?>content-block  is--hidden" role="main">	
	<div class="page-header-panel__block  <?=$heading_color;?>">
		<div class="page-header-panel__container container">
			<div class="breadcrumb__block  is--heading  is--blue">
				<ul class="breadcrumb__list  is--heading  is--blue">
					<li class="breadcrumb__list-item">
						<a href="/" class="breadcrumb__list-link">Главная</a>
					</li>
					<li class="breadcrumb__list-item is--active"><?=t($id);?></li>
				</ul>
			</div>	
			<div class="page-header__block  is--heading  is--blue  is--panel">
				<h1 class="page-header__heading  is--heading  is--blue  is--panel"><span><?=t($id);?></span></h1>	
				<?if ($heading_small != ""){?>
				<h3 class="page-header__heading-small  is--heading  is--blue  is--panel"><?=$heading_small;?></h3>		
				<?}?>
			</div>  			
		</div>	
		<?
		$this->tpl(
			'_/bg-card', 
			array(
				"block_prefix" => "bg-plane__",
				"block_mod" => "is--portfolio  is--speed-5",
				"block_bg" => "bg-plane-portfolio.png",
			)
		);
		?>
	</div>
	<div class="container content-block__container <?=$block_prefix;?>container  bg-header__container">	
		<div class="portfolio-panel__block">
			<div class="portfolio-panel__row row  is--gutter  is--wrap">
				<div class="portfolio-panel__cols cols  is--cols-screen-3  is--navbar">
					<?
					$this->tpl(
						'portfolio/navbar', 
						array(
							"block_prefix" => "portfolio-navbar__",
						)
					);
					?>
				</div>
				<div class="portfolio-panel__cols cols  is--cols-screen-9  is--cols-sm-12">
					<div class="portfolio-panel__inner-row row  is--gutter  is--wrap">
						<?
						while($projects->have_posts()) {
							$projects->the_post();
							$id = get_the_ID();
							$link = l($id);
							$title = t($id);
							$preview = $this->Imgs->postImg($p->ID, '385x265');
							$preview_full = $this->Imgs->postImg($p->ID, '1280x880');
						?>
						<div class="portfolio-panel__inner-cols cols  is--cols-screen-4  is--cols-sm-4">
							<div class="portfolio-card__item  block-hover__block">
								<a href="<?=$preview_full;?>" data-fancybox="portfolio-gallery" class="portfolio-card__preview">
									<img src="<?=$preview;?>" alt="<?=$title;?>" class="img-responsive">	
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
						wp_reset_postdata();
						?>	
						<div class="portfolio-panel__inner-cols cols  is--cols-screen-4  is--cols-sm-4  is--btn">
							<div class="portfolio-card__item  is--link-icon">
								<a href="#" class="btn-link__item  is--icon  is--xxs  is--noline  is--down  is--underline">
									<div class="btn-link__icon  is--icon  is--xxs  is--noline  is--down  is--underline">
										<svg class="icon-svg icon-btn-icon-down" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-icon-down"></use></svg>
									</div>
									<span>Другие работы</span>
								</a>
							</div>
						</div> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>