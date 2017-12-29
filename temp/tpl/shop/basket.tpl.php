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
						<div class="orders-card__text-block text__block">
							<div class="table-responsive">
								<table class="table table-bordered  is--noline">
									<thead>
										<tr>
											<th class="is--left">Заказ</th>
											<th class="is--left">Параметры</th>
											<th class="is--qty">Кол-во<small>, шт</small></th>
											<th class="is--th-cost">Стоимость<small>, руб.</small></th>
											<th class="is--del"></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="is--left">
												<h4 class="orders-card__table-heading"><a href="#">Визитки на картонной бумаге</a></h4>
											</td>
											<td class="is--left">
												<div class="orders-card__table-note">
													<div><span>Размер:</span> Cтандарт 90*90</div>
													<div><span>Печать:</span> Односторонняя</div>
													<div><span>Бумага:</span> Majestic</div>
													<div><span>Способ печати:</span> Трафарет</div>
												</div>
											</td>
											<td>
												<div class="qty-block__block">
													<label class="qty-block__inner">
														<button type="button" class="qty-block__btn  is--minus">
															<svg class="icon-svg icon-qty-minus" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#qty-minus"></use></svg>
														</button>
														<input type="text" class="qty-block__input" value="100" >
														<button type="button" class="qty-block__btn  is--plus">
															<svg class="icon-svg icon-qty-plus" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#qty-plus"></use></svg>
														</button>
													</label>	
												</div>
											</td>
											<td><span class="is--ruble  is--bold">450</span></td>
											<td class="is--del">
												<button type="button" class="btn__icon">
													<svg class="icon-svg icon-btn-del" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-del"></use></svg>
												</button>
											</td>
										</tr>
										<tr>
											<td class="is--left">
												<h4 class="orders-card__table-heading"><a href="#">Карманные календари</a></h4>
											</td>
											<td class="is--left">
												<div class="orders-card__table-note">
													<div><span>Размер:</span> Cтандарт 70*100</div>
													<div><span>Способ печати:</span> Лакирование</div>
												</div>
											</td>
											<td>
												<div class="qty-block__block">
													<label class="qty-block__inner">
														<button type="button" class="qty-block__btn  is--minus">
															<svg class="icon-svg icon-qty-minus" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#qty-minus"></use></svg>
														</button>
														<input type="text" class="qty-block__input" value="100" >
														<button type="button" class="qty-block__btn  is--plus">
															<svg class="icon-svg icon-qty-plus" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#qty-plus"></use></svg>
														</button>
													</label>	
												</div>
											</td>
											<td><span class="is--ruble  is--bold">450</span></td>
											<td class="is--del">
												<button type="button" class="btn__icon">
													<svg class="icon-svg icon-btn-del" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-del"></use></svg>
												</button>
											</td>
										</tr>
										<tr>
											<td class="is--left">
												<h4 class="orders-card__table-heading"><a href="#">Календари - Плакаты</a></h4>
											</td>
											<td class="is--left">
												<div class="orders-card__table-note">
													<div><span>Размер:</span> А3 297*420</div>
													<div><span>Способ печати:</span> Вырубка</div>
												</div>
											</td>
											<td>
												<div class="qty-block__block">
													<label class="qty-block__inner">
														<button type="button" class="qty-block__btn  is--minus">
															<svg class="icon-svg icon-qty-minus" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#qty-minus"></use></svg>
														</button>
														<input type="text" class="qty-block__input" value="100" >
														<button type="button" class="qty-block__btn  is--plus">
															<svg class="icon-svg icon-qty-plus" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#qty-plus"></use></svg>
														</button>
													</label>	
												</div>
											</td>
											<td><span class="is--ruble  is--bold">450</span></td>
											<td class="is--del">
												<button type="button" class="btn__icon">
													<svg class="icon-svg icon-btn-del" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-del"></use></svg>
												</button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="basket-orders__block">
							<div class="basket-orders__row row  is--jcsb  is--gutter15">
								<div class="basket-orders__cols cols  is--print">
									<a href="javascript:(print());" class="btn-link__item  is--icon  is--xs">
										<div class="btn-link__icon  is--icon  is--xs">
											<svg class="icon-svg icon-btn-icon-print" role="img">
												<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-icon-print"></use>
											</svg>
										</div>
										<span>Распечатать</span>
									</a>
								</div>
								<div class="basket-orders__cols cols  is--cost">
									<div class="basket-orders__cost-block">
										<div class="basket-orders__cost">Стоимость заказа: <span>30 523</span></div>
										<div class="basket-orders__sale">Цена со скидкой 3%</div>			
									</div>
								</div>
							</div>
							<div class="basket-orders__row row  is--jcfe">
								<div class="basket-orders__cols cols">
									<?
									/*
									<button type="button" class="btn__item  is--bg"><span>Заказать</span></button>
									*/
									?>
									<a href="<?=l(318);?>" class="btn__item  is--bg"><span>Заказать</span></a>
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