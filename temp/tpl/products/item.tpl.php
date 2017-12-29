<?
$block_prefix = "products-page__";
$heading_small = "Отправляйте заказы нам через сайт";
$heading_color = "is--calc";
$heading = t($this->post['id']);
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
		</div>	
		<?
		$this->tpl(
			'_/bg-card', 
			array(
				"block_prefix" => "bg-plane__",
				"block_mod" => "is--calc-left  is--speed-100",
				"block_bg" => "bg-plane-calc-yellow.png",
			)
		);
		$this->tpl(
			'_/bg-card', 
			array(
				"block_prefix" => "bg-plane__",
				"block_mod" => "is--calc-right  is--speed-15",
				"block_bg" => "bg-plane-calc-blue.png",
			)
		);
		?>
	</div>
	<div class="container content-block__container <?=$block_prefix;?>container  bg-header__container">	
		<div class="calc-panel__block">
			<div class="calc-panel__row row  is--gutter  is--wrap">
				<div class="calc-panel__cols cols  is--cols-screen-9  is--cols-sm-12">
					<!-- <h4 class="calc-panel__heading">Визитки на картонной бумаге</h4> -->
					<div class="calc-panel__calc-row row  is--wrap  is--gutter15">
						<div class="calc-panel__calc-cols cols">
							<div class="select-block__block">
								<label class="select-block__row row">
									<div class="cols select-block__cols">
										<div class="select-block__heading">Выберите размер:</div>
									</div>
									<div class="cols select-block__cols">
										<div class="select-block__select-box">
											<div class="select-block__select-icon">
												<svg class="icon-svg icon-btn-icon-down" role="img">
													<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-icon-down"></use>
												</svg>
											</div>
											<select class="select-block__select">
												<option>Стандарт 90*50</option><option>Евро 85*55</option><option>Нестандартный</option>
											</select>
										</div>
									</div>
								</label>	
							</div>
						</div>
						<div class="calc-panel__calc-cols cols">
							<div class="select-block__block">
								<label class="select-block__row row">
									<div class="cols select-block__cols">
										<div class="select-block__heading">Печать:</div>
									</div>
									<div class="cols select-block__cols">
										<div class="select-block__select-box">
											<div class="select-block__select-icon"><svg class="icon-svg icon-btn-icon-down" role="img">
												<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-icon-down"></use>
											</svg></div>
											<select class="select-block__select">
												<option>Односторонняя</option><option>Двусторонняя</option>
											</select>
										</div>
									</div>
								</label>	
							</div>
						</div>
						<div class="calc-panel__calc-cols cols">
							<div class="select-block__block">
								<label class="select-block__row row">
									<div class="cols select-block__cols">
										<div class="select-block__heading">Бумага:</div>
									</div>
									<div class="cols select-block__cols">
										<div class="select-block__select-box">
											<div class="select-block__select-icon"><svg class="icon-svg icon-btn-icon-down" role="img">
												<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-icon-down"></use>
											</svg></div>
											<select class="select-block__select">
												<option>Majestic</option><option>Touch cover</option><option>Лён</option><option>Другая</option>
											</select>
										</div>
									</div>
								</label>	
							</div>
						</div>
						<div class="calc-panel__calc-cols cols">
							<div class="select-block__block">
								<label class="select-block__row row">
									<div class="cols select-block__cols">
										<div class="select-block__heading">Отделка:</div>
									</div>
									<div class="cols select-block__cols">
										<div class="select-block__select-box">
											<div class="select-block__select-icon"><svg class="icon-svg icon-btn-icon-down" role="img">
												<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-icon-down"></use>
											</svg></div>
											<select class="select-block__select">
												<option>Лакирование</option><option>Трафарет</option><option>Вырубка</option>
											</select>
										</div>
									</div>
								</label>	
							</div>
						</div>
						<div class="calc-panel__calc-cols cols  is--cols-12">
							<div class="range-block__block">
								<label class="range-block__row row  is--wrap">
									<div class="cols range-block__cols  is--heading">
										<div class="range-block__heading">Количество:</div>
									</div>
									<div class="cols range-block__cols  is--range">
										<input type="text" id="inputRange" name="" value="" >
									</div>
									<div class="cols range-block__cols  is--range-input">
										<input type="number" step="50" min="50" max="15000" name="" value="500"  class="range-block__input" id="inputRangeinput">
									</div>
								</label>	
							</div> 
						</div>
						<div class="calc-panel__calc-cols cols">
							<label for="maket" class="btn-link__item  is--icon">
								<input type="file" name="maket" id="maket" class="btn-link__file">
								<div class="btn-link__icon  is--icon">
									<svg class="icon-svg icon-btn-icon-maket" role="img">
										<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-icon-maket"></use>
									</svg>
								</div>
								<span>Загрузить макет</span>
							</label> 
						</div>
					</div>
				</div>
				<div class="calc-panel__cols cols  is--cols-screen-3  is--cols-sm-12">
					<div class="calc-result__block">
						<div class="calc-result__inner"> 
							<div class="calc-result__container">
								<div class="calc-result__row">
									<h4 class="calc-result__heading">Параметры заказа</h4>
									<div class="calc-result__type">Визитки на картонной бумаге</div>
									<div class="calc-result__text-block text__block">
										<ul>
											<li><b>Размер:</b> <span>90*50</span></li>
											<li><b>Тип печати:</b> <span>1-сторонняя</span></li>
											<li><b>Количество:</b> <span>500</span></li>
											<li><b>Отделка:</b> <span>Лакирование</span></li>
											<li><b>Макет:</b> <span>Нет</span></li>
										</ul>
									</div>
									<div class="calc-result__cost">
										Цена: 
										<span class="calc-result__cost-num">10 678</span>
										<span class="calc-result__cost-ruble">
											<svg class="icon-svg icon-ruble" role="img">
												<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#ruble"></use>
											</svg>
										</span>
									</div> 
									<div class="calc-result__basket">
										<button type="button" class="btn__item is--bg  is--calc-result"><span>В корзину</span></button>
									</div> 
									<div class="calc-result__buy">
										<button type="button" class="btn__item is--calc-result" data-toggle="modal" data-target="#modal-buy"><span>Купить в 1 клик</span></button>
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