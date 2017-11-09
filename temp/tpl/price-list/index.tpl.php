<?
$block_prefix = "pricelist-page__";
$bg_card = get_field('bg_card', $id);
/*
$posts = new WP_Query(array(
	'post_type' => 'page',
	'posts_per_page' => -1,
	'post_parent' => 32,
	'post_status' => 'any',
	'post__not_in' => array(183),
	'orderby' => array(
		'menu_order' => 'ASC',
		'date' => 'DESC',
		'ID' => 'DESC',
		'name' => 'ASC',
	),
));
$posts_bottom = new WP_Query(array(
	'post_type' => 'page',
	'posts_per_page' => -1,
	'post_parent' => 32,
	'post_status' => 'any',
	'post__in' => array(183),
	'orderby' => array(
		'menu_order' => 'ASC',
		'date' => 'DESC',
		'ID' => 'DESC',
		'name' => 'ASC',
	),
));*/
$heading_small = get_field('page_heading_small', $id);
$heading_color = get_field('heading_color', $id);
$note_bottom = get_field('note_bottom', $id);
?>
<div class="content-block <?=$block_prefix;?>content-block  is--hidden" role="main">	
	<div class="page-header-panel__block  is--hidden  <?=$heading_color;?>">
		<div class="page-header-panel__container container">
			<div class="breadcrumb__block  is--heading  is--blue">
				<ul class="breadcrumb__list  is--heading  is--blue">
					<li class="breadcrumb__list-item">
						<a href="/" class="breadcrumb__list-link">Главная</a>
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
		</div>	
	</div>
	<div class="pricelist-navbar__block dropdown">
		<a href="#" data-toggle="dropdown" class="pricelist-navbar__btn-block">
			<div class="pricelist-navbar__btn">
				<div class="pricelist-navbar__btn-hamb">
					<div class="pricelist-navbar__btn-hamb-item  is--top"></div>
					<div class="pricelist-navbar__btn-hamb-item  is--center"></div>
					<div class="pricelist-navbar__btn-hamb-item  is--bottom"></div>
					<div class="pricelist-navbar__btn-hamb-item  is--left-top"></div>
					<div class="pricelist-navbar__btn-hamb-item  is--right-top"></div>
				</div>
				<div class="pricelist-navbar__btn-name">
					Другие разделы
				</div>
			</div>		
		</a>
		<div class="pricelist-navbar__dropdown">
			<div class="pricelist-navbar__dropdown-inner">
				<ul class="pricelist-navbar__nav">
					<li class="pricelist-navbar__item  is--active">
						<a class="pricelist-navbar__link" href="#">Визитки</a>
					</li>
					<li class="pricelist-navbar__item">
						<a class="pricelist-navbar__link" href="#">Листовки</a>
					</li>
					<li class="pricelist-navbar__item">
						<a class="pricelist-navbar__link" href="#">Лифлеты</a>
					</li>
					<li class="pricelist-navbar__item">
						<a class="pricelist-navbar__link" href="#">Бланки</a>
					</li>
					<li class="pricelist-navbar__item">
						<a class="pricelist-navbar__link" href="#">Пакеты</a>
					</li>
					<li class="pricelist-navbar__item">
						<a class="pricelist-navbar__link" href="#">Календари</a>
					</li>
					<li class="pricelist-navbar__item">
						<a class="pricelist-navbar__link" href="#">Плакаты</a>
					</li>
					<li class="pricelist-navbar__item">
						<a class="pricelist-navbar__link" href="#">Открытки</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container content-block__container <?=$block_prefix;?>container  bg-header__container">	
		<div class="pricelist-panel__block">
			<div class="pricelist-item__card">	
				<div class="pricelist-item__row row  is--wrap  is--gutter15">
					<div class="pricelist-item__cols cols  is--cols-screen-4  is--preview">
						<h3 class="pricelist-item__heading">Визитки на картоне <small>(90*60 мм)</small></h3>
						<div class="pricelist-item__preview">
							<img src="<?=$this->path('img');?>/temp/pricelist-prewiev-vizitki-460x400.png" alt="">
						</div>
					</div>
					<div class="pricelist-item__cols cols  is--cols-screen-8  is--note">
						<div class="pricelist-item__text-block  text__block">
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>тираж<small>/шт.</small>
											</th>
											<th>односторонние</th>
											<th>двусторонние</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>100</td>
											<td>
											<span class='is--ruble'>250</span>
											</td>
											<td>
											<span class='is--ruble'>450</span>
											</td>
										</tr>
										<tr>
											<td>200</td>
											<td>
											<span class='is--ruble'>550</span>
											</td>
											<td>
											<span class='is--ruble'>750</span>
											</td>
										</tr>
										<tr>
											<td>300</td>
											<td>
											<span class='is--ruble'>650</span>
											</td>
											<td>
											<span class='is--ruble'>1 010</span>
											</td>
										</tr>
										<tr>
											<td>400</td>
											<td>
											<span class='is--ruble'>890</span>
											</td>
											<td>
											<span class='is--ruble'>1 290</span>
											</td>
											</tr>
										<tr>
											<td>1 000</td>
											<td>
											<span class='is--ruble'>1 500</span>
											</td>
											<td>
											<span class='is--ruble'>1 500</span>
											</td>
										</tr>
										<tr>
										<td>2 000</td>
											<td>
											<span class='is--ruble'>2 500</span>
											</td>
											<td>
											<span class='is--ruble'>2 500</span>
											</td>
										</tr>
										<tr>
											<td>3 000</td>
											<td>
											<span class='is--ruble'>3 000</span>
											</td>
											<td>
											<span class='is--ruble'>3 000</span>
											</td>
										</tr>
										<tr>
											<td>4 000</td>
											<td>
											<span class='is--ruble'>3 500</span>
											</td>
											<td>
											<span class='is--ruble'>3 500</span>
											</td>
										</tr>
										<tr>
											<td>5 000</td>
											<td>
											<span class='is--ruble'>4 500</span>
											</td>
											<td>
											<span class='is--ruble'>4 500</span>
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
</div> 