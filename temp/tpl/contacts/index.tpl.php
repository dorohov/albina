<?
	$block_prefix = "contacts-page__";
	$adds = getContact('adds');
	$webSite = getContact('webSite');
	$phone = getContact('phone');
	$phone_num = phone(getContact('phone'));
	$map = getContact('map');
	$clock = getContact('clock');
	$skype = getContact('skype');
?>
<div class="content-block <?=$block_prefix;?>content-block  is--hidden" role="main">
	<div class="contacts-panel__block  is--panel">
		<div class="contacts-panel__inner"> 
			<?if ($adds != ""){?>
			<div class="contacts-panel__item">
				<div class="contact-item__item  is--nobg">
					<div class="contact-item__icon  is--nobg">
						<svg class="icon-svg icon-contacts-location" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#contacts-location"></use></svg>
					</div>
					<?=$adds;?>
				</div>		
			</div>	
			<?}?>
			<?if ($clock != ""){?>
			<div class="contacts-panel__item">
				<div class="contact-item__item  is--nobg">
					<div class="contact-item__icon  is--nobg">
						<svg class="icon-svg icon-contacts-clock" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#contacts-clock"></use></svg>
					</div>
					<?=$clock;?>
				</div>		
			</div>	
			<?}?>
			<?if ($email != ""){?>
			<div class="contacts-panel__item">
				<div class="contact-item__item  is--nobg">
					<a href="mailto:<?=$email;?>" class="contact-item__link  is--nobg">
						<div class="contact-item__icon  is--nobg">
							<svg class="icon-svg icon-contacts-email" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#contacts-email"></use></svg>
						</div>
						<?=$email;?>
					</a>
				</div>		
			</div>	
			<?}?>
			<?if ($skype != ""){?>
			<div class="contacts-panel__item">
				<div class="contact-item__item  is--nobg">
					<a href="skype:<?=$skype;?>?call" class="contact-item__link  is--nobg">
						<div class="contact-item__icon  is--nobg">
							<svg class="icon-svg icon-skype" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#skype"></use></svg>
						</div>
						<?=$skype;?>
					</a>
				</div>		
			</div>	
			<?}?>
		</div>
		<div class="contacts-panel__map  is--panel">
			<div class="contacts-panel__map-item" id="2gis-map"></div>
		</div>
		<?
		$this->tpl(
			'_/bg-card', 
			array(
				"block_prefix" => "bg-plane__",
				"block_mod" => "is--contacts-top  is--speed-20",
				"block_bg" => "bg-plane-contacs-orange.png",
			)
		);
		?>	
		<?
		$this->tpl(
			'_/bg-card', 
			array(
				"block_prefix" => "bg-plane__",
				"block_mod" => "is--contacts-left  is--speed-10",
				"block_bg" => "bg-plane-contacs-blue.png",
			)
		);
		?>	
		<?
		$this->tpl(
			'_/bg-card', 
			array(
				"block_prefix" => "bg-plane__",
				"block_mod" => "is--contacts-right  is--speed-55",
				"block_bg" => "bg-plane-contacs-green.png",
			)
		);
		?>	
	</div>
</div>