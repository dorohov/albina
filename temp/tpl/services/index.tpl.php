<?
$block_prefix = "services-page__";
$posts = new WP_Query(array(
	'post_type' => 'page',
	'posts_per_page' => -1,
	'post_parent' => 7,
	'orderby' => array(
		'menu_order' => 'ASC',
		'date' => 'DESC',
		'ID' => 'DESC',
		'name' => 'ASC',
	),
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
			<?
				$this->tpl(
					'_/bg-round', 
					array(
						"block_prefix"=>"bg-round__",
					)
				);
			?>  
			<?
			$this->tpl(
				'_/bg-card', 
				array(
					"block_prefix" => "bg-plane__",
					"block_mod" => "is--action  is--speed-55",
					"block_bg" => "bg-plane-action.png",
				)
			);
			?>				
		</div>	
	</div>
	<div class="container content-block__container <?=$block_prefix;?>container  bg-header__container">	
		<div class="services-panel-category__block">
			<div class="services-panel-category__row row  is--gutter  is--wrap">
				<?
				while($posts->have_posts()) {
					$posts->the_post();
					$id = get_the_ID();
					$link = l($id);
					$title = t($id);
					$preview = $this->Imgs->postImg($p->ID, '520x460');
					if ($preview == ""){
						$preview = "https://placeholdit.imgix.net/~text?txtsize=30&txt=520x460&w=520&h=460";
					}	
					
				?>
				<div class="services-panel-category__cols cols  is--cols-4">
					<div class="services-card__item">
						<a href="<?=$link;?>" class="services-card__preview block-hover__block">	
							<img src="<?=$preview;?>" alt="<?=$title;?>">		
							<div class="block-hover__item">
								<div class="block-hover__heading"><?=$title;?></div>
								<div class="block-hover__icon">
									<div class="block-hover__icon-inner">
										<svg class="icon-svg icon-plus" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#plus"></use></svg>
									</div>
								</div>
							</div>
						</a>
						<h3 class="services-card__heading"><a href="<?=$link;?>"><?=$title;?></a></h3>	
					</div>
				</div>
				<?
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
</div>