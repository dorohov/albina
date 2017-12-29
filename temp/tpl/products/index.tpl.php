<?
$block_prefix = "products-page__";
$heading_small = get_field('page_heading_small', $id);
$heading_color = get_field('heading_color', $id);
?>
<div class="content-block <?=$block_prefix;?>content-block  is--hidden" role="main">	
	<div class="page-header-panel__block  <?=$heading_color;?>">
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
		</div>	
		<?
		$this->tpl(
			'_/bg-card', 
			array(
				"block_prefix" => "bg-plane__",
				"block_mod" => "is--portfolio  is--speed-5",
				"block_bg" => "bg-plane-portfolio.png",
			)
		);
		?>
	</div>
	<div class="container content-block__container <?=$block_prefix;?>container  bg-header__container">	
		<?			
			$this->tpl(
				'products/category-panel', 
				array(
					"block_prefix"=>"products-panel-category__",
				)
			);
		?>
	</div>	
</div>