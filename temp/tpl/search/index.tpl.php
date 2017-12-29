<div class="content-block catalog-page" role="main">
	<div class="container content-container">
		<div class="breadcrumb-block _cp__breadcrumb-block">
			<ul class="breadcrumb__list">
				<li class="breadcrumb__list-item"><a href="/" class="breadcrumb__list-link">Главная</a></li>
				<li class="breadcrumb__list-item is--active">Поиск</li>
			</ul>
		</div>

		<div class="page-header-block">
			<h1 class="page-header__heading">Вы искали: <?=get_search_query();?></h1>
		</div>
		<div class="row _cp__row">
			
			<?
			if(count($param['posts'])) {
				
				$i = 0;
				
				foreach($param['posts'] as $p) {
					//var_dump($p);
					
					$i++;
					
					$ost = $i % 10;
					
					if($ost == 1 || $i == 0) {
						$col_w = 6;
					} else {
						$col_w = 3;
					}
					
					$link = l($p->ID);
					$cost = $this->getMeta($p->ID, 'cost');
					
				?>
				
				<div class="cols _cp__cols cols-<?=$col_w;?>">
					<div class="catalog-element  ">	
						<a href="<?=$link;?>" class="catalog-element__preview" style="background-image: url(<?=$this->Imgs->postImg($p->ID, '991x544');?>);">
						</a>
						<div class="catalog-element__note">
							<h4 class="catalog-element__heading"><?=$p->post_title;?></h4>
							
							<?
							if($cost != '') {
							?>
							<div class="catalog-element__cost">
								<?=$cost;?>
								<span><svg class="icon-svg icon-ruble" role="img">
									<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#ruble"></use>
								</svg></span>
							</div>
							<?
							}
							?>
							
							<a href="<?=$link;?>" class="catalog-element__link">
								<span><svg class="icon-svg icon-arrow-next-flat" role="img">
									<use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#arrow-next-flat"></use>
								</svg></span>
							</a>
						</div>
					</div>
				</div>
				
				<?
				}
				
			} else {
				
			}
			?>
			
		</div>
		
	</div>
</div>