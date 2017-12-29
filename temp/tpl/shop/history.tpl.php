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
					<div class="orders-card__block">
						<h3 class="orders-card__heading"><?=t($id);?></h3>
						<div class="orders-card__row row  is--jcfe  is--gutter15">
							<div class="orders-card__cols cols">
								<div class="search-block__block">
									<form action="#" class="search-block__inner">
										<button type="submit" class="search-block__btn">
											<svg class="icon-svg icon-icon-round-search" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#icon-round-search"></use></svg>
										</button>
										<input type="text" class="search-block__input" placeholder="Найти заказ">
									</form>
								</div>
							</div>
							<div class="orders-card__cols cols">
								<div class="select-block__block">	
									<div class="select-block__select-box">
										<div class="select-block__select-icon  is--xs">
											<svg class="icon-svg icon-btn-icon-down" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-icon-down"></use></svg>
										</div>
										<select class="select-block__select  is--xs">
											<option>Все заказы</option>
											<option>Прошлый месяц</option>
											<option>3 месяца назад</option>
											<option>6 месяцев назад</option>
											<option>Год назад</option>
										</select>
									</div>	
								</div>
							</div>
						</div>
						<div class="orders-card__text-block text__block">
							<div class="table-responsive">
								<table class="table table-bordered  is--noline">
									<thead>
										<tr>
											<th class="is--left">Дата</th>
											<th class="is--left">Заказ</th>
											<th>Кол-во,<small>шт</small></th>
											<th>Стоимость</th>
											<th>Статус</th>
											<th>Оплата</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="is--left">20.02.2017</td>
											<td class="is--left">
												<h4 class="orders-card__table-heading">Визитки</h4>
											</td>
											<td>100</td>
											<td><span class="is--ruble">450</span></td>
											<td>В обработке</td>
											<td>Оплата наличными</td>
										</tr>
										<tr>
											<td class="is--left">20.02.2017</td>
											<td class="is--left">
												<h4 class="orders-card__table-heading">Визитки, лифлеты</h4>
											</td>
											<td>200</td>
											<td><span class="is--ruble">750</span></td>
											<td>В обработке</td>
											<td>Оплачено</td>
										</tr>
										<tr class="is--done">
											<td class="is--left">20.02.2017</td>
											<td class="is--left">
												<h4 class="orders-card__table-heading">Афиши, плакаты, постеры</h4>
												<div class="orders-card__table-note">
													<div><span>Размер:</span> АО 841*1189</div>
													<div><span>Способ печати:</span> Трафарет</div>
												</div>
											</td>
											<td>100</td>
											<td><span class="is--ruble">15 000</span></td>
											<td>Выполнено</td>
											<td>
												<button type="button" class="btn__item  is--xxs"><span>Повторить заказ</span></button>
											</td>
										</tr>
									</tbody>
								</table>
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