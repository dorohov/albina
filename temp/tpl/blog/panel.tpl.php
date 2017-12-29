<?
$tax_query_field = 'slug';
$tax_query_terms = 'blog';
$btn_link = l(4);
if($param["include_page"] == "team"){	
	$tax_query_field = 'id';
	$tax_query_terms = $param["termId"];
	$btn_link = $param["termLink"];
}

$block_prefix="blog-panel__";
$posts = $this->getItems(array(
	'post_type' => 'post',
	'posts_per_page' => 3,
	'orderby' => array(
		'menu_order' => 'ASC',
		'date' => 'DESC',
		'ID' => 'DESC',
		'name' => 'ASC',
	),
	'tax_query' => array(array(
		'taxonomy' => 'category',
		'field' => $tax_query_field,
		'terms' => array($tax_query_terms),
	)),

));
if(count($posts)) {
?>
<div class="<?=$param["block_prefix"];?>block  <?=$param["block_mod"];?>">
	<div class="container <?=$param["block_prefix"];?>container">		
		<div class="<?=$param["heading_prefix"];?>block  ">
			<h2 class="<?=$param["heading_prefix"];?>heading  <?=$param["heading_mod"];?>"><span><?=$param["heading"];?></span></h2>		
		</div>	
		<div class="<?=$param["block_prefix"];?>list  <?=$param["block_mod"];?>">
			<div class="<?=$param["block_prefix"];?>row row  is--gutter  is--wrap  <?=$param["block_mod"];?>">
				<?
				
					foreach($posts as $p) {						
						$link = l($p->ID);
						$title = $p->post_title;
						//$note = get_field('blog__note', $p->ID);
						$preview = $this->Imgs->postImg($p->ID, '385x330');
						$team_item_get = get_field('blog_team_item', $p->ID);
						$team_item = $team_item_get->post_title;
						$team_post = get_field('team_post', $team_item_get->ID);
						if ($preview == ""){
							$preview = "http://via.placeholder.com/385x330";
						}						
				?>
				<div class="<?=$param["block_prefix"];?>cols cols  is--cols-4  is--cols-xs-l-6  <?=$param["block_mod"];?>">
					<article class="blog-card__item">
						<a href="<?=$link;?>" class="blog-card__preview block-hover__block">
							<img src="<?=$preview;?>" alt="<?=$title;?>"  class="block-hover__img  img-responsive"> 
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
							<?if($team_item !=""){?>
							<div class="blog-card__text-block  text__block"><?=$team_item;?> - <?=$team_post;?></div>
							<?}?>
						</div> 
					</article>
				</div>								
				<?}?>
			</div> 
		</div>
		<div class="<?=$param["block_prefix"];?>btn  <?=$param["block_mod"];?>">
			<a href="<?=$btn_link;?>" class="btn__item"><span>Все советы</span></a>
		</div>
	</div>
</div>							
<?}?>