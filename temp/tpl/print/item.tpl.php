<?
	$block_prefix = "services-page__";
	$bg_card = get_field('bg_card', $id);
	$heading_small = get_field('page_heading_small', $id);
	$adv_panel = get_field('adv_panel', $id);
	$adv_heading = get_field('adv_heading', $id);
	$form_heading = get_field('form_heading', $id);
	$form_btn_name = get_field('form_btn_name', $id);	
	if($form_heading == ""){
		$form_heading = "Узнайте стоимость под ваш проект";
	};
	if($form_btn_name == ""){
		$form_btn_name = "Отправить";
	}
	$form_heading_page = t($id);
	$heading_color = get_field('heading_color', $id);

	$portfolio_panel = get_field('portfolio_panel', $id);
?>
<div class="content-block <?=$block_prefix;?>content-block  is--hidden" role="main">	
	<div class="page-header-panel__block  <?=$heading_color;?>">
		<div class="page-header-panel__container container">
			<div class="breadcrumb__block  is--heading  is--blue">
				<ul class="breadcrumb__list  is--heading  is--blue">
					<li class="breadcrumb__list-item">
						<a href="/" class="breadcrumb__list-link">Главная</a>
					</li>
					<li class="breadcrumb__list-item">
						<a href="<?=l(8);?>" class="breadcrumb__list-link"><?=t(8);?></a>
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
					"block_mod" => "is--card",
					"block_bg" => $bg_card,
				)
			);
			?>
			<?
			$this->tpl(
				'_/bg-card', 
				array(
					"block_prefix" => "bg-plane__",
					"block_mod" => "is--portfolio  is--speed-15",
					"block_bg" => "bg-plane-portfolio.png",
				)
			);
			?>
			<?
			$this->tpl(
				'_/bg-card', 
				array(
					"block_prefix" => "bg-plane__",
					"block_mod" => "is--services-bottom  is--speed-75",
					"block_bg" => "bg-plane-services-bottom.png",
				)
			);
			?>		
		</div>	
	</div>
	<div class="container content-block__container <?=$block_prefix;?>container  bg-header__container">
		<div class="services-panel-card__block">
			<div class="services-panel-card__row row  is--gutter  is--wrap">
				<div class="services-panel-card__cols cols  is--cols-screen-7  is--cols-sm-12">
					<div class="services-panel-card__text-block  text__block">
						<?=c($this->post['id']);?>				
					</div>		
				</div>
			</div>
			<? if($adv_panel != ""){?>
			<div class="advantages-panel__block">
				<? if($adv_heading != ""){?>
				<div class="page-header__block  is--blue">
					<h3 class="page-header__heading  is--blue"><span><?=$adv_heading;?></span></h3>		
				</div>
				<?}?>
				<div class="advantages-panel__row row  is--gutter  is--wrap">
					<?=$adv_panel;?>
				</div>
			</div>
			<?}?>

			<div class="portfolio-panel__block">
				<div class="page-header__block  is--heading  is--blue">
					<h3 class="page-header__heading  is--heading  is--blue"><span>Примеры наших работ</span></h3>		
				</div>	 
				<div class="portfolio-panel__row row  is--gutter  is--wrap">
					<?			
						foreach($portfolio_panel as $item) {
							$id = $item->ID;
							$preview = $this->Imgs->postImg($id, '385x265');
							$preview_full = $this->Imgs->postImg($id, '1280x880');
					?>
					<div class="portfolio-panel__cols cols  is--cols-screen-3  is--cols-sm-6">
						<div class="portfolio-card__item  block-hover__block">
							<a href="<?=$preview_full;?>" data-fancybox="portfolio-card" class="portfolio-card__preview">
								<img src="<?=$preview;?>" alt="" class="img-responsive">	
								<div class="block-hover__item">
									<div class="block-hover__icon">
										<div class="block-hover__icon-inner">
											<svg class="icon-svg icon-plus" role="img">
												<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?=$this->path('img');?>/svg/sprite.svg#plus"></use>
											</svg>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<? } ?>
					<div class="portfolio-panel__cols cols  is--cols-screen-3  is--cols-sm-6  is--link">
						<div class="portfolio-card__item  is--link">
							<a href="<?=l(6);?>" class="btn-link__item   "><span>Другие работы</span></a>
						</div>			
					</div>
				</div>
			</div>
		</div>
	</div>	
	<?
	$this->tpl(
		'_/form/panel', 
		array(
			"block_prefix" => "form-panel__",
			"block_tpl" => "fio-email-tel",
			"block_mod" => "is--lg",
			"block_bg" => "bg-form-panel.jpg",
			"block_heading" => $form_heading,
			"block_form_heading" => $form_heading_page,
			"block_form_prefix" => "form__",
			"block_form_mod" => "is--inline  is--cols-2-5",
			"block_form_color" => "is--white",
			"block_form_id" => "fcab",
			"block_btn_name" => $form_btn_name,
			"block_btn_mod" => "is--form-inline  is--white",
		)
	);
	?> 
</div>