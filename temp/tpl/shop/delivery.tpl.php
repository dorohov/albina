<?
$block_prefix = "basket-page__";
?>
<div class="content-block <?=$block_prefix;?>content-block  is--hidden" role="main">
	<?
		$this->tpl(
			'shop/heading', 
			array(
				"block_prefix" => "page-header-panel__",
			)
		);
	?>
	<?
		$this->tpl(
			'_/bg-card', 
			array(
				"block_prefix" => "bg-plane__",
				"block_mod" => "is--cabinet  is--speed-30",
				"block_bg" => "bg-plane-calc-yellow.png",
			)
		);
	?>
	<div class="container content-block__container cabinet-panel__container  bg-header__container  is--padding-top">
		<div class="cabinet-panel__block">
			<div class="cabinet-panel__row row  is--gutter  is--wrap  is-jcfe">
				<div class="cabinet-panel__cols cols">
					<?
						$this->tpl(
							'shop/sale', 
							array(
								"block_prefix" => "cabinet-sale__",
							)
						);
					?>
				</div>
			</div>
			<div class="cabinet-panel__row row  is--gutter  is--wrap">
				<div class="cabinet-panel__cols cols  is--cols-screen-2  is--navbar">
					<?
						$this->tpl(
							'shop/navbar', 
							array(
								"block_prefix" => "cabinet-navbar__",
							)
						);
					?>
				</div>
				<div class="cabinet-panel__cols cols  is--cols-screen-10  is--cols-sm-12">
					<?
						$this->tpl(
							'shop/basket-step', 
							array(
								"block_prefix" => "basket-step__",
							)
						);
					?>
					<div class="orders-card__block">					
						<h3 class="orders-card__heading  is--delivery">Выберите способ доставки:</h3>
						<ul class="orders-card__delivery-tabs">
							<li class="orders-card__delivery-tabs-item">
								<a href="#courier" class="orders-card__delivery-tabs-link" data-toggle="tab">
									<div class="orders-card__delivery-tabs-icon">
										<svg class="icon-svg icon-btn-icon-courier" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-icon-courier"></use></svg>
									</div>
									<div class="orders-card__delivery-tabs-heading">Курьером</div>
									<div class="orders-card__delivery-tabs-note">Доставка по городу 300 рублей</div>
								</a>
							</li>
							<li class="orders-card__delivery-tabs-item">
								<a href="#transport" class="orders-card__delivery-tabs-link" data-toggle="tab">
									<div class="orders-card__delivery-tabs-icon">
										<svg class="icon-svg icon-btn-icon-transport" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-icon-transport"></use></svg>
									</div>
									<div class="orders-card__delivery-tabs-heading">До транспортной компании</div>
									<div class="orders-card__delivery-tabs-note">300 рублей</div>
								</a>
							</li>
							<li class="orders-card__delivery-tabs-item">
								<a href="#pickup" class="orders-card__delivery-tabs-link" data-toggle="tab">
									<div class="orders-card__delivery-tabs-icon">
										<svg class="icon-svg icon-btn-icon-pickup" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-icon-pickup"></use></svg>
									</div>
									<div class="orders-card__delivery-tabs-heading">Самовывоз</div>
									<div class="orders-card__delivery-tabs-note">Бесплатно</div>
								</a>
							</li>
						</ul>
						<div class="orders-card__delivery-panes">
							<div class="orders-card__delivery-pane " id="courier">
								<div class="orders-card__delivery-row  row  is--wrap  is--gutter15">
									<div class="orders-card__delivery-cols  cols">
										<h4 class="orders-card__delivery-pane-heading">Адрес доставки:</h4>
										<div class="orders-card__delivery-pane-note">
											302028, Орёл, ул. Бульвар Победы 6, 4 этаж, оф. 52
										</div>
										<div>
											<button type="button" class="btn-link__item  is--xs" data-toggle="modal" data-target="#modal-profile-address"><span>Редактировать</span></button>
										</div>
									</div>
								</div>
							</div>
							<div class="orders-card__delivery-pane" id="transport">
								<h4 class="orders-card__delivery-pane-heading">Выберите транспортную компанию:</h4>
								<div class="orders-card__transport-list">
									<div class="orders-card__delivery-tabs-item  active  is--transport">
										<div class="orders-card__delivery-tabs-link  active  is--transport">  
											<div class="orders-card__delivery-tabs-icon  active  is--transport">
												<svg class="icon-svg icon-transport-icon-pacom" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#transport-icon-pacom"></use></svg>
											</div>
											<div class="orders-card__delivery-tabs-heading">ПЭК</div>
											<div class="orders-card__delivery-tabs-note"><a href="https://pecom.ru/services-are/the-calculation-of-the-cost/" target="_blank">Расчитать стоимость</a></div>
										</div>
									</div>
									<div class="orders-card__delivery-tabs-item  is--transport">
										<div class="orders-card__delivery-tabs-link  is--transport">  
											<div class="orders-card__delivery-tabs-icon  is--transport">
												<svg class="icon-svg icon-transport-icon-baikalsr" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#transport-icon-baikalsr"></use></svg>
											</div>
											<div class="orders-card__delivery-tabs-heading">Байкал Сервис</div>
											<div class="orders-card__delivery-tabs-note"><a href="https://orel.baikalsr.ru/tools/calculator/" target="_blank">Расчитать стоимость</a></div>
										</div>
									</div>
									<div class="orders-card__delivery-tabs-item  is--transport">
										<div class="orders-card__delivery-tabs-link  is--transport">  
											<div class="orders-card__delivery-tabs-icon  is--transport">
												<svg class="icon-svg icon-transport-icon-dellin" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#transport-icon-dellin"></use></svg>
											</div>
											<div class="orders-card__delivery-tabs-heading">Деловые линии</div>
											<div class="orders-card__delivery-tabs-note"><a href="https://orel.dellin.ru/requests/" target="_blank">Расчитать стоимость</a></div>
										</div>
									</div>
									<div class="orders-card__delivery-tabs-item  is--transport">
										<div class="orders-card__delivery-tabs-link  is--transport">  
											<div class="orders-card__delivery-tabs-icon  is--transport">
												<svg class="icon-svg icon-transport-icon-skif" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#transport-icon-skif"></use></svg>
											</div>
											<div class="orders-card__delivery-tabs-heading">СКИФКАРГО</div>
											<div class="orders-card__delivery-tabs-note"><a href="http://www.skif-cargo.ru/calc/" target="_blank">Расчитать стоимость</a></div>
										</div>
									</div>
									<div class="orders-card__delivery-tabs-item  is--input"> 
										<input type="text" class="form__control" name="transport-more" placeholder="Другая компания">
									</div>
								</div>
							</div>
							<div class="orders-card__delivery-pane" id="pickup">
								<div class="orders-card__delivery-row  row  is--wrap  is--gutter15">
									<div class="orders-card__delivery-cols  cols">
										<h4 class="orders-card__delivery-pane-heading">Пункт выдачи:</h4>
										<div class="orders-card__delivery-pane-note">
											302028, г. Орёл, ул. Бульвар Победы 6, 4 этаж, оф. 52
										</div>
									</div>
								</div>
							</div> 
						</div>
						<div class="basket-orders__block">
							<div class="basket-orders__row row  is--jcfe  is--gutter15">
								<div class="basket-orders__cols cols">
									<div class="basket-orders__cost-block">
										<div class="basket-orders__cost">Стоимость заказа с доcтавкой: <span>30 523</span></div>		
									</div>
								</div>
							</div>
							<div class="basket-orders__row row  is--jcfe">
								<div class="basket-orders__cols cols">									
									<?
									/*
									<button type="button" class="btn__item  is--bg"><span>Продолжить</span></button>
									*/
									?>
									<a href="<?=l(320);?>" class="btn__item  is--bg"><span>Продолжить</span></a>
								</div>
							</div>
						</div>
					</div>
				</div>		
			</div>
		</div> 
	</div>		
	<?
		$this->tpl(
			'_/bg-card', 
			array(
				"block_prefix" => "bg-plane__",
				"block_mod" => "is--basket  is--speed-5",
				"block_bg" => "bg-plane-basket-blue.png",
			)
		);
	?>
</div>
<?
$modal_id = 324;
$modal_heading = get_field('modal_heading', $modal_id);
$modal_heading_small = get_field('modal_heading_small', $modal_id);
$modal_btn = get_field('modal_btn', $modal_id);
$this->tpl(
	'_/modals/modal', 
	array(
		"block_prefix" => "modal-base__",
		"block_tpl" => "profile-address",
		"block_mod" => "is--enter",
		"block_modal_id" => "modal-profile-address",
		"block_heading" => $modal_heading,
		"block_note" => $modal_heading_small,
		"block_form_id" => "fmpa",
		"block_form_prefix" => "form__",
		"block_form_mod" => "is--sm",
		"block_btn_name" => $modal_btn,
	)
);
?>