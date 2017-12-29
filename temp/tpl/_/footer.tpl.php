		<?
			$block_prefix = "footer__";
			$email = getContact('email');
			$email_arr = explode('@', $email);
			$phone = getContact('phone');	
			$phone_num = phone(getContact('phone'));
			$adds = getContact('adds');
			$old_site = getContact('old_site');
		?>
		<footer class="<?=$block_prefix;?>block">	
			<div class="container <?=$block_prefix;?>container">
				<div class="row <?=$block_prefix;?>row">
					<div class="cols <?=$block_prefix;?>cols  is--logotip">
						<a href="/" class="<?=$block_prefix;?>logotip">
							<svg class="icon-svg icon-logotip" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#logotip"></use></svg>
						</a>			
					</div>
					<?if($old_site != ""){?>
					<div class="cols <?=$block_prefix;?>cols  is--btn">
						<a href="<?=$old_site;?>" class="btn__item is--xs-400  is--invers"><span>Старая версия сайта</span></a>
					</div>
					<?}?>
					<div class="cols <?=$block_prefix;?>cols  is--contacts">
						<div class="<?=$block_prefix;?>contacts-row row">					
							<?if ($phone != ""){?>
							<div class="<?=$block_prefix;?>contacts-cols cols">
								<a href="tel:+<?=$phone_num?>" class="<?=$block_prefix;?>contacts-item"><?=$phone;?></a>
							</div>
							<?}?>
							<?if ($email != ""){?>
							<div class="<?=$block_prefix;?>contacts-cols cols">
								<a href="mailto:<?=$email;?>" class="<?=$block_prefix;?>contacts-item"><span><?=$email_arr[0];?></span>@<?=$email_arr[1];?></a>
							</div>
							<?}?>
						</div>
					</div>
					<?if ($adds != ""){?>
					<div class="cols <?=$block_prefix;?>cols  is--address">
						<div class="<?=$block_prefix;?>contacts-item  is--address">
							<?=$adds;?>
						</div>
					</div>
					<?}?>
					<div class="cols <?=$block_prefix;?>cols  is--dorohovdesign">
						<div class="row <?=$block_prefix;?>dorohovdesign-row"> 
							<div class="cols <?=$block_prefix;?>dorohovdesign-cols  is--text">
								<div class="<?=$block_prefix;?>dorohovdesign-text">Разработка сайта</div>
							</div>
							<div class="cols <?=$block_prefix;?>dorohovdesign-cols  is--logotip">
								<a href="http://dorohovdesign.ru/" target="_blank" class="<?=$block_prefix;?>dorohovdesign-logotip">
									<svg class="icon-svg icon-dorohovdesign" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#dorohovdesign"></use></svg>
								</a>
							</div>
						</div>				 
					</div>	
				</div>
			</div>
		</footer>	
		<?
			//modals

			$modal_id = 522;
			$modal_heading = get_field('modal_heading', $modal_id);
			$modal_heading_small = get_field('modal_heading_small', $modal_id);
			$modal_btn = get_field('modal_btn', $modal_id);
			$this->tpl(
				'_/modals/message', 
				array(
					"block_prefix" => "modal-base__",
					"block_mod" => "is--enter",
					"block_modal_id" => "modal-message",
					"block_heading" => $modal_heading,
					"block_note" => $modal_heading_small,
					"block_btn_name" => $modal_btn,
				)
			);

			$modal_id = 305;
			$modal_heading = get_field('modal_heading', $modal_id);
			$modal_heading_small = get_field('modal_heading_small', $modal_id);
			$modal_btn = get_field('modal_btn', $modal_id);
			$this->tpl(
				'_/modals/enter', 
				array(
					"block_prefix" => "modal-base__",
					"block_mod" => "is--enter",
					"block_modal_id" => "modal-enter",
					"block_heading" => $modal_heading,
					"block_note" => $modal_heading_small,
				)
			);

			if(get_post_type() == "ourproduct" ) {
				$modal_id = 303;
				$modal_heading = get_field('modal_heading', $modal_id);
				$modal_heading_small = get_field('modal_heading_small', $modal_id);
				$modal_btn = get_field('modal_btn', $modal_id);
				$this->tpl(
					'_/modals/modal', 
					array(
						"block_prefix" => "modal-base__",
						"block_tpl" => "buy",
						"block_mod" => "is--enter",
						"block_modal_id" => "modal-buy",
						"block_heading" => $modal_heading,
						"block_note" => $modal_heading_small,
						"block_form_id" => "fbm",
						"block_form_prefix" => "form__",
						"block_form_mod" => "is--sm",
						"block_btn_name" => $modal_btn,
					)
				);
			}
		?>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="<?=$this->path('js');?>/jquery-3.2.1.min.js" ></script>
		<script src="<?=$this->path('js');?>/document-ready.js" ></script>

		<script src="<?=$this->path('js');?>/bootstrap.min.js" ></script>
		<script src="<?=$this->path('js');?>/svg4everybody.min.js" ></script>
		<script>svg4everybody();</script> 
		<script src="<?=$this->path('js');?>/azbn7__api__common.js" ></script>
		<?
			if($this->post['id'] == 1) {
				$this->tpl('_/script/2gisMap');
				$this->tpl('_/script/fancybox');
			}
			if($this->post['id'] == 2) {
				$this->tpl('_/script/2gisMap');
			}
			if(is_single()) {
				$this->tpl('_/script/fancybox');
			}
			if($this->post['id'] == 6) {
				$this->tpl('_/script/fancybox');
			}

			if(get_post_type() == "ourwork" ) {
				$this->tpl('_/script/fancybox');
			}
			if(get_post_type() == "ourproduct" ) {
				$this->tpl('_/script/rangeSlider');
			}
			if(is_tax('ourproducts-categories')) {
				$this->tpl('_/script/fancybox');
			}
			if($this->entity->post_parent == 7) {
				$this->tpl('_/script/fancybox');
			}
			if($this->entity->post_parent == 8) {
				$this->tpl('_/script/fancybox');
			}
			wp_footer();
			$this->tpl('_/metrics', array());
		?>
		<script>
			(function(){
				
				var l = window.location;
				var t = new Date().getTime();
				
				var i = document.createElement('img');
				i.width = 0; i.height = 0;
				i.onload = function(){document.body.appendChild(i);};
				i.setAttribute('src', 'http://app.azbn.ru/counter/common/?h=' + l.hostname + '&p=' + l.port + '&lt=' + t);
				
			})();
		</script>
	</body>
</html>