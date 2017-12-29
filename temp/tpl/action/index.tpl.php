<?
$posts = new WP_Query(array(
	'post_type' => 'page',
	'posts_per_page' => -1,
	'post_parent' => 9,
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
<div class="content-block action-page__content-block  is--hidden" role="main">	
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
	<div class="container content-block__container action-page__container  bg-header__container">
		<div class="action-panel__block">
			<div class="action-panel__row row  is--gutter  is--wrap">
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
				<div class="action-panel__cols cols  is--cols-screen-4  is--cols-sm-6">
					<div class="action-card__item  block-hover__block">
						<a href="<?=$link;?>" class="action-card__preview">
							<img src="<?=$preview;?>" alt="<?=$title;?>" class="img-responsive">	
							<div class="block-hover__item">		
								<div class="block-hover__heading"><?=$title;?></div>
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
			</div>
		</div>
	</div>
</div>