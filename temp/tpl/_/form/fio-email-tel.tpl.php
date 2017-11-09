<form action="#" class="<?=$param["block_form_prefix"];?>block  <?=$param["block_form_mod"];?>  azbn7__api__form"  >
	<input type="hidden" name="key" value="londonisthecapitalofgreatbritain">
	<input type="hidden" name="f[Из формы]" value="<?=$param["block_form_page"];?>: <?=$param["block_form_heading"];?>">
	<div class="<?=$param["block_form_prefix"];?>inner  <?=$param["block_form_mod"];?>"  >
		<div class="row <?=$param["block_form_prefix"];?>row  is--wrap">
			<div class="cols <?=$param["block_form_prefix"];?>cols  <?=$param["block_form_mod"];?>  is--name">
				<div class="<?=$param["block_form_prefix"];?>item">
					<input type="text" class="<?=$param["block_form_prefix"];?>control form-control validate[required, custom[onlyLetterSp]]  <?=$param["block_form_color"];?>" id="<?=$param["block_form_id"];?>[name]" name="f[Имя]" placeholder="Ваше имя">
				</div>	
			</div>
			<div class="cols <?=$param["block_form_prefix"];?>cols  <?=$param["block_form_mod"];?>  is--email">
				<div class="<?=$param["block_form_prefix"];?>item">
					<input type="email" class="<?=$param["block_form_prefix"];?>control form-control validate[required,custom[email]]  <?=$param["block_form_color"];?>  <?=$param["block_form_color"];?>" id="<?=$param["block_form_id"];?>[email]" name="f[Email]" placeholder="Ваш E-mail:">
				</div>	
			</div>
			<div class="cols <?=$param["block_form_prefix"];?>cols  <?=$param["block_form_mod"];?>  is--tel">
				<div class="<?=$param["block_form_prefix"];?>item">
					<input type="tel" class="<?=$param["block_form_prefix"];?>control form-control validate[required,custom[phone]]  <?=$param["block_form_color"];?>  <?=$param["block_form_color"];?>" id="<?=$param["block_form_id"];?>[tel]" name="f[Телефон]" placeholder="Телефон:">
				</div>	
			</div>
			<div class="cols <?=$param["block_form_prefix"];?>cols  <?=$param["block_form_mod"];?>  is--agreement">
				<div class="rect-switch <?=$param["block_form_prefix"];?>item  <?=$param["block_form_color"];?>">
	                <input class="rect-switch__input validate[required]    <?=$param["block_form_color"];?>" id="<?=$param["block_form_id"];?>[processing]" name="f[processing]" type="checkbox" checked />
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