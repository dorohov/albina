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
						<h3 class="orders-card__heading  is--delivery">Выберите способ оплаты:</h3>
						<ul class="orders-card__delivery-tabs">
							<li class="orders-card__delivery-tabs-item">
								<a href="#cash" class="orders-card__delivery-tabs-link" data-toggle="tab">
									<div class="orders-card__delivery-tabs-icon">
										<svg class="icon-svg icon-btn-icon-cash" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-icon-cash"></use></svg>
									</div>
									<div class="orders-card__delivery-tabs-heading">Наличными</div>
									<div class="orders-card__delivery-tabs-note">В офисе</div>
								</a>
							</li>
							<li class="orders-card__delivery-tabs-item">
								<a href="#checking" class="orders-card__delivery-tabs-link" data-toggle="tab">
									<div class="orders-card__delivery-tabs-icon">
										<svg class="icon-svg icon-btn-icon-checking" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-icon-checking"></use></svg>
									</div>
									<div class="orders-card__delivery-tabs-heading">На расчетный счет</div>
									<div class="orders-card__delivery-tabs-note">Для юр. лиц</div>
								</a>
							</li>
							<li class="orders-card__delivery-tabs-item">
								<a href="#оnline" class="orders-card__delivery-tabs-link" data-toggle="tab">
									<div class="orders-card__delivery-tabs-icon">
										<svg class="icon-svg icon-btn-icon-оnline" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-icon-оnline"></use></svg>
									</div>
									<div class="orders-card__delivery-tabs-heading">Оплата оnline</div>
									<div class="orders-card__delivery-tabs-note">Со скидкой 3%</div>
								</a>
							</li>
						</ul>
						<div class="orders-card__delivery-panes">
							<div class="orders-card__delivery-pane" id="cash"></div>
							<div class="orders-card__delivery-pane" id="checking">
								<label for="file-requisites" class="btn-link__item  is--icon  is--xs">
									<input type="file" name="file-requisites" id="file-requisites" class="btn-link__file">
									<div class="btn-link__icon  is--icon  is--xs">
										<svg class="icon-svg icon-btn-icon-requisites" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-icon-requisites"></use></svg>
									</div>
									<span>Загрузить реквизиты</span>
								</label>
							</div>
							<div class="orders-card__delivery-pane" id="оnline"></div>
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
									<button type="button" class="btn__item  is--bg"  data-toggle="modal" data-target="#modal-payment"><span>Оформить заказ</span></button>
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
$modal_id = 328;
$modal_heading = get_field('modal_heading', $modal_id);
$modal_heading_small = get_field('modal_heading_small', $modal_id);
$modal_btn = get_field('modal_btn', $modal_id);
$this->tpl(
	'_/modals/message', 
	array(
		"block_prefix" => "modal-base__",
		"block_mod" => "is--enter",
		"block_modal_id" => "modal-payment",
		"block_heading" => $modal_heading,
		"block_note" => $modal_heading_small,
		"block_btn_name" => $modal_btn,
	)
);
?>