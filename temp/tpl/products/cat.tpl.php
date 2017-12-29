<?
$block_prefix = "products-page__";

$obj = $this->entity;
$slug = $this->entity->slug;
$heading = $this->entity->name;
$id = $this->entity->term_id;
$bg_view =  get_field('products_bg', $obj);
$text_block =  get_field('products_text', $obj);
$bg = $this->Imgs->rawImg($bg_view, '735x590');
$heading_color = get_field('heading_color', $obj);
$products_portfolio = get_field('products_portfolio', $obj);
$projects = new WP_Query(array(
	'post_type' => 'ourproduct',
	'posts_per_page' => -1,
	'orderby' => array(
		'ID' => 'ASC',
		'date' => 'DESC',
		'menu_order' => 'ASC',
		'name' => 'ASC',
	),
	'tax_query' => array(array(
		'taxonomy' => 'ourproducts-categories',
		'field' => 'slug',
		'terms' => array($slug),
	)),
));
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
						<a href="<?=l(5);?>" class="breadcrumb__list-link"><?=t(5);?></a>
					</li>
					<li class="breadcrumb__list-item is--active"><?=$heading;?></li>
				</ul>
			</div>	
			<div class="page-header__block  is--heading  is--blue  is--panel">
				<h1 class="page-header__heading  is--heading  is--blue  is--panel"><span><?=$heading;?></span></h1>
			</div>  			
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
				"block_bg" => $bg,
			)
		);
		?>
	</div>
	<div class="container content-block__container <?=$block_prefix;?>container  bg-header__container">	
		<div class="products-panel-card__block">
			<div class="products-panel-card__row row  is--gutter  is--wrap">
				<div class="products-panel-card__cols cols  is--cols-screen-7  is--cols-sm-12">
					<div class="products-panel-card__text-block  text__block">
						<?=$text_block;?>
						<?if(count($param['posts']) == 0){?>
						<p>&nbsp;</p>
						<p><button type="button" class="btn__item is--bg" data-toggle="modal" data-target="#modal-calc"><span>Рассчитать стоимость</span></button></p>
						<?}?>
					</div>		
				</div>
			</div>
			<?
			if(count($param['posts']) > 0){
			?>
			<div class="products-panel__block">
				<div class="products-panel__row row  is--gutter  is--wrap">
					<?	
						while($projects->have_posts()) {
							$projects->the_post();
							$id = get_the_ID();
							$link = l($id);
							$title = t($id);
							$short_text =  get_field('products_short_text', $id);
							$preview = $this->Imgs->postImg($p->ID, '370x285');
							if($preview == ""){
								$preview = "https://placeholdit.imgix.net/~text?txtsize=30&txt=370x285&w=370&h=285";
							}
					?>
					<div class="products-panel__cols cols  is--cols-screen-3  is--cols-sm-6">
						<div class="products-card__item  block-hover__block">
							<div class="products-card__row row  is--wrap">
								<div class="products-card__cols cols">
									<a href="<?=$link?>" class="products-card__preview">
										<img src="<?=$preview?>" alt="<?=$title?>">	
										<div class="block-hover__item">
											<div class="block-hover__icon">
												<div class="block-hover__icon-inner">
													<svg class="icon-svg icon-plus" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#plus"></use></svg>
												</div>
											</div>
										</div>
									</a>
									<div class="products-card__note">
										<h3 class="products-card__heading"><a href="<?=$link;?>"><?=$title;?></a></h3>
										<div class="products-card__text-block  text__block"><?=$short_text;?></div>
									</div>
								</div>
								<div class="products-card__cols cols">
									<div class="products-card__cost">
										от <span class="products-card__cost-num">200</span>
										<span class="products-card__cost-ruble">
											<svg class="icon-svg icon-ruble" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#ruble"></use></svg>
										</span>
										/100&nbsp;шт.
									</div>
									<div class="products-card__btn">
										<a href="<?=$link;?>" class="btn__item  is--bg  is--md-w"><span>Рассчитать</span></a>
									</div>
								</div>
							</div>
						</div>
					</div>					
					<?
					}
					wp_reset_postdata();
					?>	
				</div>
			</div>
			<?}?>
			<?if(count($param['posts']) == 0){?>
			<div class="portfolio-panel__block">
				<div class="page-header__block  is--heading  is--blue">
					<h3 class="page-header__heading  is--heading  is--blue"><span>Примеры наших работ</span></h3>		
				</div>	 
				<div class="portfolio-panel__row row  is--gutter  is--wrap">
					<?			
						foreach($products_portfolio as $item) {
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
			<?}?>
		</div>
	</div>
</div>
<?if(count($param['posts']) == 0){
	$modal_id = 307;
	$modal_heading = get_field('modal_heading', $modal_id);
	$modal_heading_small = get_field('modal_heading_small', $modal_id);
	$modal_btn = get_field('modal_btn', $modal_id);
	$this->tpl(
		'_/modals/modal', 
		array(
			"block_prefix" => "modal-base__",
			"block_tpl" => "calc",
			"block_mod" => "is--enter",
			"block_modal_id" => "modal-calc",
			"block_heading" => $modal_heading,
			"block_note" => $modal_heading_small,
			"block_form_id" => "fbcl",
			"block_form_prefix" => "form__",
			"block_form_mod" => "is--sm",
			"block_btn_name" => $modal_btn,
		)
	);
}
?>