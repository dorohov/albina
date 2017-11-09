<div class="content-block blog-page__content-block  is--hidden" role="main">	
	<div class="page-header-panel__block  <?=$heading_color;?>">
		<div class="page-header-panel__container container">
			<div class="breadcrumb__block  is--heading  is--blue  is--center">
				<ul class="breadcrumb__list  is--heading  is--blue  is--center">
					<li class="breadcrumb__list-item">
						<a href="/" class="breadcrumb__list-link">Главная</a>
					</li>
					<li class="breadcrumb__list-item">
						<a href="<?=l(4);?>" class="breadcrumb__list-link"><?=t(4);?></a>
					</li>
					<li class="breadcrumb__list-item is--active"><?=t($id);?></li>
				</ul>
			</div>	
			<div class="page-header__block  is--heading  is--blue  is--panel  is--center">
				<h1 class="page-header__heading  is--heading  is--blue  is--panel  is--center"><span><?=t($id);?></span></h1>	
				<?if ($heading_small != ""){?>
				<h3 class="page-header__heading-small  is--heading  is--blue  is--panel"><?=$heading_small;?></h3>		
				<?}?>
			</div>
			<?
				$this->tpl(
					'_/bg-round', 
					array(
						"block_prefix"=>"bg-round__",
					)
				);
			?> 	
		</div>	 
		<?
		$this->tpl(
			'_/bg-card', 
			array(
				"block_prefix" => "bg-plane__",
				"block_mod" => "is--clients-left  is--speed-25",
				"block_bg" => "bg-plane-clients-white.png",
			)
		);
		?>
		<?
		$this->tpl(
			'_/bg-card', 
			array(
				"block_prefix" => "bg-plane__",
				"block_mod" => "is--clients-right  is--speed-10",
				"block_bg" => "bg-plane-clients-blue.png",
			)
		);
		?>	
	</div>
	<div class="container content-block__container blog-page__container  bg-header__container">
		<div class="text__container">
			<div class="text__block">
				<?=c($this->post['id']);?>
			</div>
		</div>
	</div>
</div>