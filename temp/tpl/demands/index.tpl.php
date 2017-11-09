<?
$block_prefix = "demands-page__";
$bg_card = get_field('bg_card', $id);
$posts = new WP_Query(array(
	'post_type' => 'page',
	'posts_per_page' => -1,
	'post_parent' => 32,
	'post_status' => 'any',
	'post__not_in' => array(183),
	'orderby' => array(
		'menu_order' => 'ASC',
		'date' => 'DESC',
		'ID' => 'DESC',
		'name' => 'ASC',
	),
));
$posts_bottom = new WP_Query(array(
	'post_type' => 'page',
	'posts_per_page' => -1,
	'post_parent' => 32,
	'post_status' => 'any',
	'post__in' => array(183),
	'orderby' => array(
		'menu_order' => 'ASC',
		'date' => 'DESC',
		'ID' => 'DESC',
		'name' => 'ASC',
	),
));
$heading_small = get_field('page_heading_small', $id);
$heading_color = get_field('heading_color', $id);
$note_bottom = get_field('note_bottom', $id);
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
				'_/bg-card-preview', 
				array(
					"block_prefix" => "bg-preview__",
					"block_mod" => "is--demands",
					"block_bg" => $bg_card,
				)
			);
			?>
			<?
			$this->tpl(
				'_/bg-card', 
				array(
					"block_prefix" => "bg-plane__",
					"block_mod" => "is--demands-top  is--speed-5",
					"block_bg" => "bg-plane-demands-green.png",
				)
			);
			?>	
			<?
			$this->tpl(
				'_/bg-card', 
				array(
					"block_prefix" => "bg-plane__",
					"block_mod" => "is--demands-left  is--speed-25",
					"block_bg" => "bg-plane-demands-white-lg.png",
				)
			);
			?>	
			<?
			$this->tpl(
				'_/bg-card', 
				array(
					"block_prefix" => "bg-plane__",
					"block_mod" => "is--demands-right  is--speed-75",
					"block_bg" => "bg-plane-demands-white.png",
				)
			);
			?>
			<?
			$this->tpl(
				'_/bg-card', 
				array(
					"block_prefix" => "bg-plane__",
					"block_mod" => "is--demands-bottom  is--speed-10",
					"block_bg" => "bg-plane-demands-blue.png",
				)
			);
			?>			
		</div>	
	</div>
	<div class="container content-block__container <?=$block_prefix;?>container  bg-header__container">	
		<div class="demands-panel__block">
			<div class="demands-panel__row row  is--gutter  is--wrap">
				<div class="demands-panel__cols cols  is--cols-screen-7  is--cols-sm-12">
					<div class="demands-panel__text-block  text__block">
						<?=c($id);?>						
					</div>
					<div class="panel-group  demands-item__group" id="demands-collapse">
						<?
							while($posts->have_posts()) {
								$posts->the_post();
								$id = get_the_ID();
								$link = l($id);
								$title = t($id);
								$note = c($id);
								
						?>
						<div class="demands-item__panel panel">	
							<h4 class="demands-item__heading">
								<a class="demands-item__link" data-toggle="collapse" data-parent="#demands-collapse" href="#demands-<?=$id;?>">
									<div class="demands-item__icon">
										<svg class="icon-svg icon-btn-icon-down" role="img">
											<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-icon-down"></use>
										</svg>
									</div>
									<span><?=$title;?></span> 
								</a>
							</h4>
							<div id="demands-<?=$id;?>" class="demands-item__collapse panel-collapse collapse">
								<div class="demands-item__text-block text__block">
									<?=$note;?>
								</div>
							</div>
						</div>
						<?
						}
						wp_reset_postdata();
						?>
					</div>
					<? if ($note_bottom != ""){?>
					<div class="demands-panel__text-block  text__block  is--padding-top">
						<?=$note_bottom;?>
					</div>
					<?}?>
					<div class="panel-group  demands-item__group" id="demands-collapse-bottom">
					<?
						while($posts_bottom->have_posts()) {
							$posts_bottom->the_post();
							$id = get_the_ID();
							$link = l($id);
							$title = t($id);
							$note = c($id);
							
					?>
					<div class="demands-item__panel panel">	
						<h4 class="demands-item__heading">
							<a class="demands-item__link" data-toggle="collapse" data-parent="#demands-collapse-bottom" href="#demands-<?=$id;?>">
								<div class="demands-item__icon">
									<svg class="icon-svg icon-btn-icon-down" role="img">
										<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-icon-down"></use>
									</svg>
								</div>
								<span><?=$title;?></span> 
							</a>
						</h4>
						<div id="demands-<?=$id;?>" class="demands-item__collapse panel-collapse collapse">
							<div class="demands-item__text-block text__block">
								<?=$note;?>
							</div>
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
	</div>
</div>