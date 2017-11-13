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
?>
<div class="content-block <?=$block_prefix;?>content-block  <?=$bg_prefix;?>block" role="main">	
	<div class="container content-block__container <?=$block_prefix;?>container <?=$bg_prefix;?>container">
		<div class="<?=$breadcrumb_prefix;?>block  <?=$breadcrumb_mod;?>">
			<ul class="<?=$breadcrumb_prefix;?>list  <?=$breadcrumb_mod;?>">
				<li class="<?=$breadcrumb_prefix;?>list-item">
					<a href="<?=l(1);?>" class="<?=$breadcrumb_prefix;?>list-link">Главная</a>
				</li>
				<li class="<?=$breadcrumb_prefix;?>list-item">
					<a href="<?=l(4);?>" class="<?=$breadcrumb_prefix;?>list-link"><?=t(4);?></a>
				</li>
				<li class="<?=$breadcrumb_prefix;?>list-item is--active"><?=$heading;?></li>
			</ul>
		</div>
		<div class="<?=$heading_prefix;?>block  <?=$heading_mod;?>">
			<h1 class="<?=$heading_prefix;?>heading  <?=$heading_mod;?>"><span><?=$heading;?></span></h1>
		</div>

		<div class="blog-panel__block">
			<?	
			// навигация по разделам		
			$this->tpl(
				'blog/navbar', 
				array(
					"block_prefix" => "navbar-category__",
					"block_mod" => "is--nofixed",					
					'category_active' => $category
				)
			);
			?>
			<div class="blog-panel__block-row row  is--gutter  is--wrap">
				<div class="blog-panel__block-cols cols  is--cols-screen-3">			<?	
					// навигация по рубрикам		
					$this->tpl(
						'blog/aside', 
						array(
							"block_prefix" => "navbar-category__",
							"block_mod" => "is--aside",	
							"link_prefix" => "btn-link__",				
							'category_active' => $category,
							'category_parent' => $category_id
						)
					);
					?>
				</div>
				<div class="blog-panel__block-cols cols  is--cols-screen-9">
					<div class="blog-panel__row row  is--gutter  is--wrap">
						<?
							while (have_posts()) {
								the_post();
								$id = get_the_ID();
								$link = l($id);
								$title = t($id);
								$img = $this->Imgs->postImg($id, '385x330');
								if ($img ==""){
									$img="http://via.placeholder.com/385x330";
								}
						?>
						<div class="blog-panel__cols cols  is--cols-4">
							<article class="blog-card__item">
								<a href="<?=$link;?>" class="blog-card__preview block-hover__block">
									<img src="http://via.placeholder.com/385x330" alt="<?=$title;?>"  class="block-hover__img  img-responsive"> 
									<div class="block-hover__item">
										<div class="block-hover__icon"> 
											<div class="block-hover__icon-inner">
												<svg class="icon-svg icon-plus" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#plus"></use></svg>
											</div>
										</div>
									</div>
								</a> 			
								<div class="blog-card__note">
									<h4 class="blog-card__heading"><a href="<?=$link;?>"><?=$title;?></a></h4>
									<div class="blog-card__text-block  text__block">{{block_note}}</div>
								</div> 
							</article>
						</div>
						<?} wp_reset_postdata();?>
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
				"block_mod" => "is--candle",
				"block_bg" => "bg-candle.png",
			)
		);
	?>
</div>