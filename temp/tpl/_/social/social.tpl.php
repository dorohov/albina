<?
	$vk = getContact('vk');
	$fb = getContact('fb');
	$inst = getContact('inst');
?>
<div class="<?=$param["block_prefix"];?>block">
	<div class="row <?=$param["block_prefix"];?>row"> 
		<? if ($vk != ""){?>
		<div class="cols <?=$param["block_prefix"];?>cols">
			<a href="<?=$vk;?>" target="_blank" class="<?=$param["block_prefix"];?>item  is--vk">
				<svg class="icon-svg icon-vk" role="img">
					<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#vk"></use>
				</svg>
			</a>
		</div>
		<?}?>
		<? if ($inst != ""){?>
		<div class="cols <?=$param["block_prefix"];?>cols">
			<a href="<?=$inst;?>" target="_blank" class="<?=$param["block_prefix"];?>item  is--inst">
				<svg class="icon-svg icon-inst" role="img">
					<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#inst"></use>
				</svg>
			</a>
		</div>
		<?}?>
		<? if ($fb != ""){?>
		<div class="cols <?=$param["block_prefix"];?>cols">
			<a href="<?=$fb;?>" target="_blank" class="<?=$param["block_prefix"];?>item  is--fb">
				<svg class="icon-svg icon-fb" role="img">
					<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#fb"></use>
				</svg>
			</a>
		</div>
		<?}?>
	</div>
</div>