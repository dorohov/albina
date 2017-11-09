<div class="<?=$param["block_prefix"];?>panel  <?=$param["block_mod"];?>"  style="background-image: url(<?=$this->path('img');?>/bg/<?=$param["block_bg"];?>)">
	<?
	$this->tpl(
		'_/bg-card', 
		array(
			"block_prefix" => "bg-plane__",
			"block_mod" => "is--form-top  is--speed-10",
			"block_bg" => "bg-plane-form-green.png",
		)
	);
	?>
	<?
	$this->tpl(
		'_/bg-card', 
		array(
			"block_prefix" => "bg-plane__",
			"block_mod" => "is--form-bottom  is--speed-25",
			"block_bg" => "bg-plane-form-yellow.png",
		)
	);
	?>	
	<div class="container <?=$param["block_prefix"];?>container  <?=$param["block_mod"];?>">
		<div class="<?=$param["block_prefix"];?>panel-inner  <?=$param["block_mod"];?>">			
			<div class="page-header__block  is--form-panel  is--center">
				<h1 class="page-header__heading  is--form-panel  is--center"><span><?=$param["block_heading"];?></span></h1>	
			</div>
			<?
			$this->tpl(
				'_/form/'.$param["block_tpl"], 
				array(
					"block_form_heading" => $param["block_heading"],
					"block_form_page" => $param["block_form_heading"],
					"block_form_prefix" => $param["block_form_prefix"],
					"block_form_mod" => $param["block_form_mod"],
					"block_form_color" => $param["block_form_color"],
					"block_form_id" => $param["block_form_id"],
					"block_btn_name" => $param["block_btn_name"],
					"block_btn_mod" => $param["block_btn_mod"],
				)
			);
			?>
		</div> 
	</div> 
</div> 