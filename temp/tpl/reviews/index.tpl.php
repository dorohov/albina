<?
	$reviews = $this->getItems(array(
		'post_type' => 'ourreview',
		'posts_per_page' => -1,
		'orderby' => 'date',
		'order'   => 'DESC',
	));
	
	$paged = intval(get_query_var('paged'));
	$reviews_parts = array_chunk($reviews, 4);
	$reviews_part = $reviews_parts[$paged];
	
?>
<div class="content-block reviews-page__block" role="main">
	<div class="container content-block__container reviews-page__container">
		<!--
		<div class="page-header__block  is--heading  is--center">
			<h1  class="page-header__heading  is--heading  is--center"><span>!!! Требуется доработка программиста !!!</span></h1>		
		</div> 
		-->
		<div class="breadcrumb__block  is--center">
			<ul class="breadcrumb__list  is--center">
				<li class="breadcrumb__list-item"><a href="/" class="breadcrumb__list-link">Главная</a></li>		
				<li class="breadcrumb__list-item">
					<a href="<?=l(1838);?>" class="breadcrumb__list-link"><?=t(1838);?></a>
				</li>
				<li class="breadcrumb__list-item  is--active"><?=the_title();?></li>
			</ul>
		</div>	
		<div class="page-header__block  is--heading  is--center">
			<h1  class="page-header__heading  is--heading  is--center"><span><?=the_title();?></span></h1>		
		</div> 
		<div class="reviews-panel__block">		
			<div class="row reviews-panel__row  is--wrap  is--gutter">
				<?
					//while ($reviews->have_posts()) {
					foreach($reviews_part as $p) {
						//$reviews->the_post();

						//$r_id = get_the_ID();
						$r_id = $p->ID;
						
						$link = l($r_id);
						$title = t($r_id);

						$img = $this->Imgs->postImg($r_id, 'full');

						$fullimage = get_field('fullimage', $r_id);
						$objacts = get_field("name_objacts", $r_id); 
						$note = get_field("note_short", $r_id); 
						$vk = get_field("vk", $r_id); 
						$fb = get_field("fb", $r_id); 
						$inst = get_field("inst", $r_id); 
						$img = $this->Imgs->postImg($r_id, '390x270');
						$date = d2r(get_the_date('d.m.Y', $r_id));
						$date_iso = d2r(get_the_date('Y-m-d', $r_id));
				?>
				<div class="cols reviews-panel__cols  is--cols-6">		
					<div class="reviews-item__item  block-hover__block  is--page">
						<div class="reviews-item__row row  is--wrap  is--gutter15">
							<div class="reviews-item__cols cols  is--cols-6  is--preview">
								<a href="<?=$link;?>" class="reviews-item__preview">
									<img src="<?=$img;?>" img="img-responsive" alt="">
									<div class="block-hover__item">
										<div class="block-hover__icon">
											<div class="block-hover__icon-inner">
												<svg class="icon-svg icon-plus" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#plus"></use></svg>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="reviews-item__cols cols  is--cols-6  is--note">	
								<div class="reviews-item__inner">
									<div class="reviews-item__heading-row row  is--wrap  is--gutter15" >
										<div class="reviews-item__heading-cols cols  is--heading">
											<h4 class="reviews-item__heading  is--page"><a href="<?=$link;?>"><?=$title;?></a>
											</h4>
										</div>
										<div class="reviews-item__heading-cols cols  is--soc">
											<div class="reviews-item__soc-row row " >
												<? if ($vk != ""){?>
												<div class="reviews-item__soc-cols cols">
													<a href="<?=$vk;?>" target="_blank" class="social__item  is--vk  is--reviews">
														<div class="social__icon">
															<svg class="icon-svg icon-vk" role="img">
																<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#vk"></use>
															</svg>
														</div>
													</a>
												</div>
												<?}?>
												<? if ($fb != ""){?>
												<div class="reviews-item__soc-cols cols">
													<a href="<?=$fb;?>" target="_blank" class="social__item  is--fb  is--reviews">
														<div class="social__icon">
															<svg class="icon-svg icon-fb" role="img">
																<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#fb"></use>
															</svg>
														</div>
													</a>
												</div>
												<?}?>
												<? if ($inst != ""){?>
												<div class="reviews-item__soc-cols cols">
													<a href="<?=$inst;?>" target="_blank" class="social__item  is--inst  is--reviews">
														<div class="social__icon">
															<svg class="icon-svg icon-inst" role="img">
																<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#inst"></use>
															</svg>
														</div>
													</a>
												</div>
												<?}?>
											</div>
										</div>
									</div>									
									<div class="reviews-item__objacts"><?=$objacts;?></div>
									<div class="reviews-item__text"><?=$note;?></div>
									
									<?
									if($fullimage != '') {
									?>
									<div class="reviews-item__text">
										<br />
										<a href="<?=$fullimage;?>" data-fancybox="original-review" >Оригинал</a>
									</div>
									<?
									}
									?>
									
									<div class="reviews-item__footer-row row  is--wrap  is--gutter15">
										<div class="reviews-item__footer-cols cols">
											<time class="reviews-item__date" datetime="<?=$date_iso?>"><?=$date;?></time>
										</div>
										<div class="reviews-item__footer-cols cols">
											<div class="reviews-item__link  is--page">
												<a href="<?=$link;?>">Читать подробнее</a>
											</div>
										</div>
									</div>				
								</div>
							</div>
						</div>	
					</div>			
				</div>
				<?}?>
			</div> 
			<div class="pagination-panel__block">
				<ol class="pagination-panel__list">		
					
					
					<?
					if(count($reviews_parts)) {
						foreach($reviews_parts as $p_index => $p_arr) {
					?>
					
					<li class="pagination-panel__item <?if($p_index == $paged){?>is--active<?}?> ">
						<a href="?paged=<?=$p_index;?>" class="pagination-panel__link"><?=($p_index + 1);?></a>
					</li>
					
					<?
						}
					}
					?>
					
					<?
					/*
					<li class="pagination-panel__item    ">
						<a href="#" class="pagination-panel__link">
							<svg class="icon-svg icon-owl-prev" role="img">
								<use xlink:href="/img/svg/sprite.svg#owl-prev"></use>
							</svg>
						</a>
					</li>
					<li class="pagination-panel__item    ">
						<a href="#" class="pagination-panel__link"> 1</a>
					</li>
					<li class="pagination-panel__item  is--active">
						<a href="#" class="pagination-panel__link"> 2</a>
					</li>		
					<li class="pagination-panel__item    ">
						<a href="#" class="pagination-panel__link"> 3</a>
					</li>	
					<li class="pagination-panel__item    ">
						<a href="#" class="pagination-panel__link">...</a>
					</li>
					<li class="pagination-panel__item    ">
						<a href="#" class="pagination-panel__link">10</a>
					</li>		
					<li class="pagination-panel__item    ">
						<a href="#" class="pagination-panel__link">
							<svg class="icon-svg icon-owl-next" role="img">
								<use xlink:href="/img/svg/sprite.svg#owl-next"></use>
							</svg>
						</a>
					</li>
					*/
					?>
					
				</ol>
			</div> 
		</div>	
	</div>	
</div> 	
<?
/*
$this->tpl(
	'_/form/panel', 
	array(
		"form_prefix"=>"form-panel__",
		"form_mod" => "is--consultation",
		"form_bg" => "bg-form-consultation.jpg",
		"form_id" => "fc",
		"form_dir" => "true",
		"form_heading" => "Получить бесплатную консультацию",
		"form_note" => "",
		"form_text" => "",
		"form_btn" => "Отправить",
	)
);
*/
?>
<?
$this->tpl(
	'_/form/panel', 
	array(
		"form_prefix"=>"form-panel__",
		"form_mod" => "is--consultation",
		"form_bg" => "bg-form-consultation.jpg",
		"form_id" => "fc",
		"form_dir" => "false",
		"form_heading" => "Получить бесплатную консультацию",
		"form_note" => "",
		"form_text" => "",
		"form_btn" => "Отправить",
	)
);
?>