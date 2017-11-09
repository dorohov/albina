<?
$adv = get_field('adv', $id);
if ($adv != ""){
?>
<div class="advantages-panel__block  is--index" id="index-advantages">  
	<?
	$this->tpl(
		'_/bg-card', 
		array(
			"block_prefix" => "bg-plane__",
			"block_mod" => "is--index-adv-top",
			"block_bg" => "bg-plane-index-adv-white.png",
		)
	);
	?>
	<div class="container <?=$param["block_prefix"];?>container bg-header__container">
		<div class="<?=$param["block_prefix"];?>row row  is--gutter  is--wrap">
			<?=$adv;?>		
		</div>
	</div>
</div>
<?}?>