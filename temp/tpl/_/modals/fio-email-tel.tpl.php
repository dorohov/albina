<?
	$_prefix = $param["block_form_prefix"];
	$_heading = $param["block_form_heading"];
	$_mod = $param["block_form_mod"];
	$_id = $param["block_form_id"];
	$_color = $param["block_form_color"];
	$_btnMod = $param["block_btn_mod"];
	$_btnName = $param["block_btn_name"];
?>
<form action="#" class="<?=$_prefix;?>block  <?=$_mod;?>  azbn7__api__form" >
	<input type="hidden" name="key" value="londonisthecapitalofgreatbritain">
	<input type="hidden" name="f[Форма]" value="<?=$_heading;?>">
	<div class="<?=$_prefix;?>inner  <?=$_mod;?>"  >
		<div class="row <?=$_prefix;?>row  is--wrap">
			<div class="cols <?=$_prefix;?>cols  <?=$_mod;?>  is--name">
				<div class="<?=$_prefix;?>item">
					<input type="text" class="<?=$_prefix;?>control form-control validate[required, custom[onlyLetterSp]]  <?=$_mod;?>  <?=$_color;?>" id="<?=$_id;?>[name]" name="f[Имя]" placeholder="Имя">
				</div>	
			</div>
			<div class="cols <?=$_prefix;?>cols  <?=$_mod;?>  is--tel">
				<div class="<?=$_prefix;?>item">
					<input type="tel" class="<?=$_prefix;?>control form-control validate[required,custom[phone]]  <?=$_mod;?>  <?=$_color;?>" id="<?=$_id;?>[tel]" name="f[Телефон]" placeholder="Телефон">
				</div>	
			</div>
			<div class="cols <?=$_prefix;?>cols  <?=$_mod;?>">
				<div class="<?=$_prefix;?>item">
					<input type="text" data-plugin='datepicker' class="<?=$_prefix;?>control form-control validate[required]  <?=$_mod;?>  <?=$_color;?>" id="<?=$_id;?>[date]" name="f[Дата приема]"  placeholder="Выберите дату приема" readonly>
				</div>	
			</div>
			<div class="cols <?=$_prefix;?>cols  <?=$_mod;?>">
				<div class="<?=$_prefix;?>item">
					<input type="text" data-plugin="timepicki" class="<?=$_prefix;?>control form-control validate[required]  <?=$_mod;?>  <?=$_color;?>" id="<?=$_id;?>[time]" name="f[Время приема]" placeholder="Желаемое время приема" readonly>
				</div>	
			</div>
			<div class="cols <?=$_prefix;?>cols  <?=$_mod;?>  is--note">
				<div class="<?=$_prefix;?>item">
					<textarea class="<?=$_prefix;?>control form-control  <?=$_mod;?> <?=$_color;?>" name="f[Короткое описание проблемы]" placeholder="Короткое описание проблемы"></textarea>
				</div>	
			</div>
			<div class="cols <?=$_prefix;?>cols  <?=$_mod;?>  is--agreement">
				<div class="rect-switch <?=$_prefix;?>item  <?=$_mod;?>">
	                <input class="rect-switch__input validate[required]" id="<?=$_id;?>[processing]" name="<?=$_id;?>[processing]" type="checkbox" checked />
	                <label for="<?=$_id;?>[processing]" class="rect-switch__label"></label> 
					<label for="<?=$_id;?>[processing]" class="rect-switch__text"> 
						Я согласен на обработку <a href="/agreement.html">персональных данных</a>
					</label>
	            </div>	
			</div>
			<div class="cols <?=$_prefix;?>cols  <?=$_mod;?>  is--btn">
				<button type="submit" class="btn__item  <?=$_btnMod;?>"><span><?=$_btnName;?></span></button>
			</div>
		</div>	
	</div> 
</form> 