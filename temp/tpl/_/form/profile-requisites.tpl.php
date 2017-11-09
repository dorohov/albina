<form action="formsave" class="<?=$param["block_form_prefix"];?>block  <?=$param["block_form_mod"];?>"  >
	<input type="hidden" name="key" value="londonisthecapitalofgreatbritain">
	<div class="<?=$param["block_form_prefix"];?>inner  <?=$param["block_form_mod"];?>"  >
		<div class="row <?=$param["block_form_prefix"];?>row  is--wrap">
			<div class="cols <?=$param["block_form_prefix"];?>cols  <?=$param["block_form_mod"];?>  is--file">
				<div class="<?=$param["block_form_prefix"];?>item">
					<label for="<?=$param["block_form_id"];?>[file]" class="btn-link__item  is--icon  is--xs">
						<input type="file" id="<?=$param["block_form_id"];?>[file]" class="btn-link__file">
						<div class="btn-link__icon  is--icon  is--xs">
							<svg class="icon-svg icon-btn-icon-maket" role="img">
								<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-icon-maket"></use>
							</svg>
						</div>
						<span>Загрузить реквизиты</span>
					</label>
				</div>
			</div>
			<div class="cols <?=$param["block_form_prefix"];?>cols  <?=$param["block_form_mod"];?>  is--agreement">
				<div class="rect-switch <?=$param["block_form_prefix"];?>item  <?=$param["block_form_color"];?>">
	                <input class="rect-switch__input validate[required]    <?=$param["block_form_color"];?>" id="<?=$param["block_form_id"];?>[processing]" name="<?=$param["block_form_id"];?>[processing]" type="checkbox" checked />
	                <label for="<?=$param["block_form_id"];?>[processing]" class="rect-switch__label    <?=$param["block_form_color"];?>"></label> 
					<label for="<?=$param["block_form_id"];?>[processing]" class="rect-switch__text    <?=$param["block_form_color"];?>"> 
						Я согласен на обработку <a href="<?=l(98);?>">персональных данных</a>
					</label>
	            </div>	
			</div>
			<div class="cols <?=$param["block_form_prefix"];?>cols  <?=$param["block_form_mod"];?>  is--btn">
				<button type="submit" class="btn__item  <?=$param["block_btn_mod"];?>"><span><?=$param["block_btn_name"];?></span></button>
			</div>
		</div>	
	</div> 
</form> 