<?
$reviews = new WP_Query(array(
	'post_type' => 'ourreview',
	'posts_per_page' => 4,
	'orderby' => 'date',
	'order'   => 'DESC',
));
?>
<div class="content-block about-page__block  bg-pattern  is--wall">
	<div class="container content-block__container about-page__container-reviews">
		<div class="page-header__block  is--heading  is--center">
			<h1  class="page-header__heading  is--heading  is--center"><span>Отзывы наших клиентов</span></h1>		
		</div> 
		<div class="reviews-panel__block">	
			<?						
			if(count($reviews)) {				
			?>
			<div class="row reviews-panel__row  is--wrap  is--gutter">
				<?
					while ($reviews->have_posts()) {
						$reviews->the_post();

						$r_id = get_the_ID();
						$link = l($r_id);
						$title = t($r_id);

						$img = $this->Imgs->postImg($r_id, 'full');

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
			<?}?>
			<div class="reviews-panel__btn">
				<a href="<?=l(1921);?>" class="btn-link__item is--lg">Читать все отзывы</a>
			</div>
		</div>
	</div>
</div>