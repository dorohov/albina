<form action="#" class="<?=$param["block_form_prefix"];?>block  <?=$param["block_form_mod"];?>"  >
	<input type="hidden" name="key" value="londonisthecapitalofgreatbritain">
	<div class="<?=$param["block_form_prefix"];?>inner  <?=$param["block_form_mod"];?>"  >
		<div class="row <?=$param["block_form_prefix"];?>row  is--wrap">
			<div class="cols <?=$param["block_form_prefix"];?>cols  <?=$param["block_form_mod"];?>">
				<div class="<?=$param["block_form_prefix"];?>item">
					<input type="number" class="<?=$param["block_form_prefix"];?>control form-control validate[required]  <?=$param["block_form_color"];?>" id="<?=$param["block_form_id"];?>[index]" name="<?=$param["block_form_id"];?>[index]" placeholder="Индекс:" value="302028">
				</div>	
			</div>
			<div class="cols <?=$param["block_form_prefix"];?>cols  <?=$param["block_form_mod"];?>">
				<div class="<?=$param["block_form_prefix"];?>item">
					<input type="text" class="<?=$param["block_form_prefix"];?>control form-control validate[required]  <?=$param["block_form_color"];?>  <?=$param["block_form_color"];?>" id="<?=$param["block_form_id"];?>[city]" name="<?=$param["block_form_id"];?>[city]" placeholder="Город:" value="Орёл">
				</div>	
			</div>
			<div class="cols <?=$param["block_form_prefix"];?>cols  <?=$param["block_form_mod"];?>">
				<div class="<?=$param["block_form_prefix"];?>item">
					<input type="text" class="<?=$param["block_form_prefix"];?>control form-control validate[required]  <?=$param["block_form_color"];?>  <?=$param["block_form_color"];?>" id="<?=$param["block_form_id"];?>[address]" name="<?=$param["block_form_id"];?>[address]" placeholder="Адрес:" value="ул. Бульвар Победы 6, 4 этаж, оф. 52">
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