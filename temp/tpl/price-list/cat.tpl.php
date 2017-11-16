<?
$category = get_queried_object();
$heading = $category->name;
$category_id = $category->term_id;
//var_dump($category_id);

$bg_prefix="bg-block__";
$block_prefix="blog-page__";
$breadcrumb_prefix = "breadcrumb__";
$breadcrumb_mod="is--heading  is--center";
$heading_prefix="page-header__";
$heading_mod="is--heading  is--center";

$bg_prefix="bg-block__";
$block_prefix="pricelist-page__";

$projects = new WP_Query(array(
	'post_type' => 'ourprice',
	'posts_per_page' => -1,
));
?>
<div class="content-block <?=$block_prefix;?>content-block  <?=$bg_prefix;?>block" role="main">	
	<div class="container content-block__container <?=$block_prefix;?>container <?=$bg_prefix;?>container">
		<?
		// хлебные крошки первого уровня
		$this->tpl(
			'_/bread', 
			array(
				"block_prefix" => "breadcrumb__",
				"block_mod" => "is--heading  is--center"
			)
		);
		// заголовок страницы		
		$this->tpl(
			'_/heading', 
			array(
				"block_prefix" => "page-header__",
				"block_mod" => "is--heading  is--center"
			)
		);
		?>
		<div class="pricelist-panel__block">
			<?	
			// навигация по разделам		
			$this->tpl(
				'price/navbar', 
				array(
					"block_prefix" => "navbar-category__",
					"block_mod" => "",
					"link_prefix" => "btn-link__"
				)
			);
			?>			
			<div class="pricelist-panel__block-row row  is--gutter  is--wrap">
				<div class="pricelist-panel__block-cols cols  is--cols-screen-3">
					[[azbntple 
						tpl="/src/block/site/default/navbar/aside-pricelist.html"
						block_prefix="navbar-category__"
						link_prefix="btn-link__"
					]]					
					<?	
					// навигация по разделам		
					$this->tpl(
						'blog/navbar', 
						array(
							"block_prefix" => "navbar-category__",
							"block_mod" => "is--aside",					
							'category_active' => $category
						)
					);
					?>
				</div>
				<div class="pricelist-panel__block-cols cols  is--cols-screen-9">
					<div class="pricelist-panel__list">
						<div class="pricelist-panel__row row  is--gutter  is--wrap">
							<?
							while($projects->have_posts()) {
								$projects->the_post();
								$id = get_the_ID();
								$link = l($id);
								$title = t($id);
								$preview = $this->Imgs->postImg($p->ID, '375x480');
								$position = get_field('team_post', $id);
								if($preview == ""){
									$preview = "http://via.placeholder.com/375x480";
								}
							?>
							<div class="team-panel__cols cols  is--cols-screen-3  is--cols-sm-6  is--cols-sm-l-4  is--cols-xs-l-6">
								<div class="team-card__item">
									<a href="<?=$link;?>" class="team-card__preview block-hover__block">
										<img src="<?=$preview;?>" alt="<?=$title;?>"  class="block-hover__img  img-responsive"> 
										<div class="block-hover__item">
											<div class="block-hover__icon"> 
												<div class="block-hover__icon-inner">
													<svg class="icon-svg icon-plus" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#plus"></use></svg>
												</div>
											</div>
										</div>
									</a> 			
									<div class="team-card__note">
										<h4 class="team-card__heading"><a href="<?=$link;?>"><?=$title;?></a></h4>
										<?if($position != ""){?>
										<div class="team-card__text-block  text__block"><?=$position;?></div>
										<?}?>
									</div> 
								</div>
							</div>				
							<?
							}
							wp_reset_postdata();
							?>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?
		//фоновые картинки
		$this->tpl(
			'_/bg', 
			array(
				"block_prefix" => "bg-block__",
				"block_mod" => "is--branch",
				"block_bg" => "bg-branch.png",
			)
		);
		$this->tpl(
			'_/bg', 
			array(
				"block_prefix" => "bg-block__",
				"block_mod" => "is--candle  is--pricelist",
				"block_bg" => "bg-candle.png",
			)
		);
		$this->tpl(
			'_/bg', 
			array(
				"block_prefix" => "bg-block__",
				"block_mod" => "is--leaf  is--pricelist",
				"block_bg" => "bg-leaf.png",
			)
		);
		$this->tpl(
			'_/bg', 
			array(
				"block_prefix" => "bg-block__",
				"block_mod" => "is--filler  is--pricelist",
				"block_bg" => "bg-filler.png",
			)
		);
	?>	
</div>