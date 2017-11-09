<div class="modal fade <?=$param["block_prefix"];?>modal" id="<?=$param["block_modal_id"];?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog <?=$param["block_prefix"];?>dialog  <?=$param["block_mod"];?>">
		<div class="modal-body <?=$param["block_prefix"];?>body  <?=$param["block_mod"];?>" >
			<button type="button" class="btn-site  <?=$param["block_prefix"];?>close  modal-close" data-dismiss="modal" aria-hidden="true">
				<svg class="icon-svg icon-modal-close" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#modal-close"></use></svg>
			</button>
			<div class="modal-content <?=$param["block_prefix"];?>content">
				<?if ($param["block_heading"] !=""){?>
				<div class="page-header__block  is--modals">
					<h4 class="page-header__heading  is--modals"><span><?=$param["block_heading"]?></span></h4>
					<?if ($param["block_note"] !=""){?>	
					<div class="page-header__heading-small  is--modals"><?=$param["block_note"]?></div>	
					<?}?>	
				</div>
				<?}?>
			</div> 	 
			<?
			$this->tpl(
				'_/bg-card', 
				array(
					"block_prefix" => "bg-plane__",
					"block_mod" => "is--enter  is--speed-100",
					"block_modal_id" => "modal-enter",
					"block_bg" => "bg-plane-enter-blue.png",
				)
			);
			?>
		</div> 
	</div>
</div>