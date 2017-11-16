<?
$r_id = get_the_ID();
$objacts = get_field("name_objacts", $r_id); 
$objacts_link = get_field("objacts", $r_id); 
$vk = get_field("vk", $r_id); 
$fb = get_field("fb", $r_id); 
$inst = get_field("inst", $r_id); 
$img = $this->Imgs->postImg($r_id, '650x450');
$date = d2r(get_the_date('d.m.Y', $r_id));
$date_iso = d2r(get_the_date('Y-m-d', $r_id));
$fullimage = get_field('fullimage', $r_id);
?>
<div class="content-block reviews-page__block" role="main">
	<div class="container content-block__container reviews-page__container">
		<div class="breadcrumb__block  is--center">
			<ul class="breadcrumb__list  is--center">
				<li class="breadcrumb__list-item"><a href="/" class="breadcrumb__list-link">Главная</a></li>		
				<li class="breadcrumb__list-item">
					<a href="<?=l(1838);?>" class="breadcrumb__list-link"><?=t(1838);?></a>
				</li>	
				<li class="breadcrumb__list-item">
					<a href="<?=l(1921);?>" class="breadcrumb__list-link"><?=t(1921);?></a>
				</li>
				<li class="breadcrumb__list-item  is--active">Отзыв — <? the_title();?></li>
			</ul>
		</div>		
		<div class="page-header__block  is--heading  is--center">
			<h1  class="page-header__heading  is--heading  is--center"><span>Отзыв — <? the_title();?></span></h1>		
		</div> 
		<div class="reviews-card-panel__block">		
			<div class="row reviews-card-panel__row  is--wrap  is--gutter">
				<div class="cols reviews-card-panel__cols  is--cols-5">		
					<div class="reviews-card-panel__preview"><img src="<?=$img;?>" alt="" class="img-responsive"></div>
				</div>
				<div class="cols reviews-card-panel__cols  is--cols-7">
					<div class="reviews-card-panel__inner-row  row  is--wrap  is--gutter">
						<div class="reviews-card-panel__inner-cols cols  is--cols-12">
							<div class="reviews-card-panel__heading-row row  is--gutter15" >
								<div class="reviews-card-panel__heading-cols cols  is--heading">
									<h4 class="reviews-card-panel__heading"><?=$objacts;?></h4>
								</div>
								<div class="reviews-card-panel__heading-cols cols  is--btn">
									<a href="<?=$objacts_link;?>" class="btn__item is--xs">Посмотреть проект</a>
								</div>
							</div>
							<div class="reviews-card-panel__text  text__block">
								<?	the_content();	?>
								
								<?
								if($fullimage != '') {
								?>
								<p>
									<br />
									<a href="<?=$fullimage;?>" data-fancybox="original-review" >Оригинал</a>
								</p>
								<?
								}
								?>
								
							</div>
						</div>
						<div class="reviews-card-panel__inner-cols cols  is--cols-12">
							<div class="reviews-card-panel__footer-row row  is--wrap  is--gutter15">
								<div class="reviews-card-panel__footer-cols cols">
									<time class="reviews-card-panel__date" datetime="<?=$date_iso?>"><?=$date;?></time>
								</div>
								<div class="reviews-card-panel__footer-cols cols">					
									<div class="reviews-card-panel__soc-row row " >
										<? if ($vk != ""){?>
										<div class="reviews-card-panel__soc-cols cols">
											<a href="<?=$vk;?>" target="_blank" class="social__item  is--vk  is--reviews-item">
												<div class="social__icon">
													<svg class="icon-svg icon-vk" role="img">
														<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#vk"></use>
													</svg>
												</div>
											</a>
										</div>
										<?}?>
										<? if ($fb != ""){?>
										<div class="reviews-card-panel__soc-cols cols">
											<a href="<?=$fb;?>" target="_blank" class="social__item  is--fb  is--reviews-item">
												<div class="social__icon">
													<svg class="icon-svg icon-fb" role="img">
														<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#fb"></use>
													</svg>
												</div>
											</a>
										</div>
										<?}?>
										<? if ($inst != ""){?>
										<div class="reviews-card-panel__soc-cols cols">
											<a href="<?=$inst;?>" target="_blank" class="social__item  is--inst  is--reviews-item">
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
						</div>
					</div>
				</div> 
			</div>	
		</div> 
	</div> 
</div> 