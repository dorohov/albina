<?
	$products_heading = get_field('products_heading', $id);
?>
<div class="<?=$param["block_prefix"];?>block  <?=$param["block_mod"];?>">	
	<?
	$this->tpl(
		'_/bg-card', 
		array(
			"block_prefix" => "bg-plane__",
			"block_mod" => "is--index-products-top",
			"block_bg" => "bg-plane-index-adv-blue.png",
		)
	);
	$this->tpl(
		'_/bg-card', 
		array(
			"block_prefix" => "bg-plane__",
			"block_mod" => "is--index-products-right  is--speed-25",
			"block_bg" => "bg-plane-index-prod-green.png",
		)
	);
	?>	
	<div class="container <?=$param["block_prefix"];?>container bg-header__container">
		<h2 class="<?=$param["block_prefix"];?>heading  <?=$param["block_mod"];?>"><?=$products_heading;?></h2>
		<?			
			$this->tpl(
				'products/category-panel', 
				array(
					"block_prefix" => $param["block_prefix"],
				)
			);
		?>
	</div>
</div>				