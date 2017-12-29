<div class="modal fade <?=$param["block_prefix"];?>modal" id="<?=$param["block_modal_id"];?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog <?=$param["block_prefix"];?>dialog  <?=$param["block_mod"];?>">
		<div class="modal-body <?=$param["block_prefix"];?>body  <?=$param["block_mod"];?>" >
			<button type="button" class="btn-site  <?=$param["block_prefix"];?>close  modal-close" data-dismiss="modal" aria-hidden="true">
				<svg class="icon-svg icon-modal-close" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#modal-close"></use></svg>
			</button>
			<div class="modal-content <?=$param["block_prefix"];?>content">
				<?if ($param["block_heading"] !=""){?>
				<div class="page-header__block  is--modals  is--enter">
					<h4 class="page-header__heading  is--modals  is--enter"><span><?=$param["block_heading"]?></span></h4>
					<?if ($param["block_note"] !=""){?>	
					<div class="page-header__heading-small  is--modals  is--enter"><?=$param["block_note"]?></div>	
					<?}?>	
				</div>
				<?}?>
				<ul class="<?=$param["block_prefix"];?>tabs-nav">
					<li class="<?=$param["block_prefix"];?>tabs-nav-item  active">
						<a href="#tab-enter" data-toggle="tab" class="<?=$param["block_prefix"];?>tabs-nav-link">Войти</a> 
					</li>
					<li class="<?=$param["block_prefix"];?>tabs-nav-item">
						<a href="#tab-registr" data-toggle="tab" class="<?=$param["block_prefix"];?>tabs-nav-link">Регистрация</a>
					</li>
					<li class="<?=$param["block_prefix"];?>tabs-nav-item">
						<a href="#tab-pass" data-toggle="tab" class="<?=$param["block_prefix"];?>tabs-nav-link">Забыли пароль?</a>
					</li>
				</ul> 
				<div class="<?=$param["block_prefix"];?>tab-content">
					<div class="<?=$param["block_prefix"];?>tab-pan active" id="tab-enter">
						<?
							$this->tpl(
								'_/form/autoriz', 
								array(
									"block_prefix" => "form__",
									"block_mod" => "is--sm",
									"block_id" => "feo",
									"block_btn" => "Войти",
								)
							);
						?>		
						<?
							$this->tpl(
								'_/social/social-enter', 
								array(
									"block_prefix"=>"social__",
									"block_mod"=>"is--enter",
									"block_heading"=>"Войти с помощью соц. сетей",
								)
							);
						?>
					</div>
					<div class="<?=$param["block_prefix"];?>tab-pan" id="tab-registr">
						<?
							$this->tpl(
								'_/form/registr', 
								array(
									"block_prefix" => "form__",
									"block_mod" => "is--sm",
									"block_id" => "fro",
									"block_btn" => "Зарегистрироваться",
								)
							);
						?>		
						<?
							$this->tpl(
								'_/social/social-enter', 
								array(
									"block_prefix"=>"social__",
									"block_mod"=>"is--enter",
									"block_heading"=>"Для упрощения регистрации вы можете связать свой аккаунт в соц.сети с личным кабинетом",
								)
							);
						?>
					</div>
					<div class="<?=$param["block_prefix"];?>tab-pan" id="tab-pass">
						<?
							$this->tpl(
								'_/form/recovery', 
								array(
									"block_prefix" => "form__",
									"block_mod" => "is--sm",
									"block_id" => "frpass",
									"block_btn" => "Восстановить пароль",
								)
							);
						?>
					</div>
				</div>
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