<?
$category = get_queried_object();

$heading = $category->name;
$category_parent = $category->parent == 0 ? $category : get_term_by('term_taxonomy_id', $category->parent, 'ourprice-categories');
//var_dump($category);

$breadcrumb_prefix = "breadcrumb__";
$breadcrumb_mod="is--heading  is--center";
$heading_prefix="page-header__";
$heading_mod="is--heading  is--center";

$bg_prefix="bg-block__";
$block_prefix="pricelist-page__";
?>
<div class="content-block <?=$block_prefix;?>content-block  <?=$bg_prefix;?>block" role="main">	
	<div class="container content-block__container <?=$block_prefix;?>container <?=$bg_prefix;?>container">
		<div class="<?=$breadcrumb_prefix;?>block  <?=$breadcrumb_mod;?>">
			<ul class="<?=$breadcrumb_prefix;?>list  <?=$breadcrumb_mod;?>">
				<li class="<?=$breadcrumb_prefix;?>list-item">
					<a href="<?=l(1);?>" class="<?=$breadcrumb_prefix;?>list-link">Главная</a>
				</li>
				<li class="<?=$breadcrumb_prefix;?>list-item">
					<a href="<?=l(5);?>" class="<?=$breadcrumb_prefix;?>list-link"><?=t(5);?></a>
				</li>
				<li class="<?=$breadcrumb_prefix;?>list-item is--active"><?=$heading;?></li>
			</ul>
		</div>
		<div class="<?=$heading_prefix;?>block  <?=$heading_mod;?>">
			<h1 class="<?=$heading_prefix;?>heading  <?=$heading_mod;?>"><span><?=$heading;?></span></h1>
		</div>
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
				<?	
				// навигация по разделам		
				$this->tpl(
					'price/aside', 
					array(
						"block_prefix" => "navbar-category__",
						"block_mod" => "is--aside",					
						'category_parent' => $category_parent
					)
				);
				$categories = get_categories(array(
					'taxonomy'				=> 'ourprice-categories',
					'child_of'				=> $category_parent->term_id,
				));
				//if(count($categories) = 0) {
				?>
					<div class="pricelist-panel__list">
						<div class="pricelist-panel__row row  is--gutter  is--wrap">
							<?
							while (have_posts()) {
								the_post();
								$id = get_the_ID();
								$link = l($id);
								$title = t($id);
								$content = c($id);
							?>
							<div class="pricelist-panel__cols cols  is--cols-12">
								<div class="text__block  pricelist-panel__text-block">
									<?=$content;?>
								</div>
							</div>
							<?} wp_reset_postdata();?>
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