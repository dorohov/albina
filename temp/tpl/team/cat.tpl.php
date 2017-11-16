<?
$bg_prefix="bg-block__";
$block_prefix="team-page__";

$projects = new WP_Query(array(
	'post_type' => 'ourteam',
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
		<div class="team-panel__block">
			<?	
			// навигация по разделам		
			$this->tpl(
				'team/navbar', 
				array(
					"block_prefix" => "navbar-category__",
					"block_mod" => "",
					"link_prefix" => "btn-link__"
				)
			);
			?>			
			<div class="team-panel__row row  is--gutter  is--wrap">
				<?
				foreach($param['posts'] as $p) {
					//$projects->the_post();
					$id = get_the_ID();
					//$link = l($id);
					$link = l($p->ID);
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