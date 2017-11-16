<?
	$_id = $param["block_modal_id"];
	$_prefix = $param["block_prefix"];
	$_mod = $param["block_mod"];
	$_heading = $param["block_heading"];
	$_headingSmall = $param["block_heading_small"];
?>
<div class="modal fade <?=$_prefix;?>modal" id="<?=$_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog <?=$_prefix;?>dialog  <?=$_mod;?>">
		<div class="modal-body <?=$_prefix;?>body  <?=$_mod;?>" >
			<button type="button" class="btn-site  <?=$_prefix;?>close  modal-close" data-dismiss="modal" aria-hidden="true">
				<svg class="icon-svg icon-modal-close" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#modal-close"></use></svg>
			</button>
			<div class="modal-content <?=$_prefix;?>content">
				<?if ($_heading !=""){?>
				<div class="page-header__block  is--modals">
					<h4 class="page-header__heading  is--modals"><span><?=$_heading;?></span></h4>
					<?if ($_headingSmall !=""){?>	
					<div class="page-header__heading-small  is--modals"><?=$_headingSmall;?></div>	
					<?}?>	
				</div>
				<?}?>
			</div>
		</div> 
	</div>
</div>