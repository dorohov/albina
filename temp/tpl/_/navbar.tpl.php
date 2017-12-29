<?
	$email = getContact('email');
	$email_arr = explode('@', $email);
	$phone = getContact('phone');	
	$phone_num = phone(getContact('phone'));
	
	$in_cart = $this->Cart->getCartItems();
	
?>
<nav class="navbar-site scroll navbar scroll-navbar">
	<div class="<?=$param["block_prefix"];?>inner">
		<div class="container <?=$param["block_prefix"];?>container">
			<div class="row <?=$param["block_prefix"];?>row">
				<div class="cols <?=$param["block_prefix"];?>cols  is--header"> 	
					<div class="<?=$param["block_prefix"];?>header">
						<div class="row <?=$param["block_prefix"];?>row-header ">
							<div class="cols <?=$param["block_prefix"];?>cols-header  is--hamburger">
								<div class="<?=$param["block_prefix"];?>hamburger">
									<button class="<?=$param["block_prefix"];?>hamburger-btn hamburger__item" data-toggle="collapse" data-target="#bs-navbar-collapse" aria-expanded="false" data-toggle-nav=".navbar-site" data-body="html" data-collapse-nav=".navbar__collapse">
										<span class="hamburger__line  is--left"></span>
										<span class="hamburger__line  is--center"></span>
										<span class="hamburger__line  is--right"></span>
									</button>
								</div>
							</div>
							<div class="cols <?=$param["block_prefix"];?>cols-header  is--brand">
								<a class="<?=$param["block_prefix"];?>brand" href="/">
									<svg class="icon-svg icon-logotip" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#logotip"></use></svg>
								</a>
							</div>
							<div class="cols <?=$param["block_prefix"];?>cols-header  is--tel">
								<a href="tel:{{contacts.phone_tel}}" class="<?=$param["block_prefix"];?>tel  is--icon">
									<svg class="icon-svg icon-tel" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#tel"></use></svg>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="cols <?=$param["block_prefix"];?>cols  is--collapse">
					<div class="<?=$param["block_prefix"];?>collapse" >
						<div class="<?=$param["block_prefix"];?>collapse-inner">
							<div class="row <?=$param["block_prefix"];?>collapse-row">
								<div class="cols <?=$param["block_prefix"];?>collapse-cols  is--soc" >
									<?
										$this->tpl(
											'_/social/social', 
											array(
												"block_prefix"=>"social__",
											)
										);
									?> 
								</div>
								<div class="cols <?=$param["block_prefix"];?>collapse-cols  is--nav">
									<div class="row <?=$param["block_prefix"];?>nav-row  is--wrap">
										<div class="cols <?=$param["block_prefix"];?>nav-cols cols  is--sm">
											<ul class="<?=$param["block_prefix"];?>nav  is--sm">
												<?
													$menu_items_bottom = $this->getMenu(2);
													
													if(count($menu_items_bottom)) {
														
														$__menu_array = array(
															'items' => array(),
															'structure' => array(),
														);
														
														foreach($menu_items_bottom as $item) {
															$__menu_array['items'][$item->ID] = $item;
															$__menu_array['structure'][$item->menu_item_parent][] = &$__menu_array['items'][$item->ID];
														}
														
														if(count($__menu_array['structure'][0])) {
															foreach($__menu_array['structure'][0] as $item_sub0) {
																
																$item_class = '';
																
																if($item_sub0->object_id == $this->post['id']){
																	$item_class = $item_class . ' is--active ';
																}
																
																if(count($__menu_array['structure'][$item_sub0->ID])) {
																
																?>
																
																<li class="<?=$param["block_prefix"];?>nav-item  dropdown">
																	<a href="#" class="dropdown-toggle <?=$param["block_prefix"];?>nav-link" data-toggle="dropdown"><?=$item_sub0->title;?></a>
																	<div class="<?=$param["block_prefix"];?>nav-dropdown dropdown-menu">
																		<div class="container <?=$param["block_prefix"];?>nav-dropdown-container">
																			<div class="<?=$param["block_prefix"];?>nav-dropdown-row  row  is--gutter  is--wrap">
																			<?
																				foreach($__menu_array['structure'][$item_sub0->ID] as $item_sub1) {
																			?>
																				<div class="<?=$param["block_prefix"];?>nav-dropdown-cols  cols">
																					<ul class="<?=$param["block_prefix"];?>nav-dropdown-menu">
																						<li class="navbar__nav-dropdown-item  is--heading">
																							<a href="<?=$item_sub1->url;?>" class="navbar__nav-dropdown-link  is--heading"><?=$item_sub1->title;?></a>
																						</li>
																					</ul>
																				</div>
																			<?
																				}
																			?>				
																			</div>
																		</div>
																	</div>
																</li>
																
																<?
																
																} else {
																	
																	?>
																	
																	<li class="<?=$param["block_prefix"];?>nav-item <?=$item_class;?> ">
																		<a href="<?=$item_sub0->url;?>" class="<?=$param["block_prefix"];?>nav-link"><?=$item_sub0->title;?></a>
																	</li>
																	
																	<?
																	
																}
																
															}
														}
													}
												?>
											</ul>
										</div>
										<div class="cols <?=$param["block_prefix"];?>nav-cols cols">
											<ul class="<?=$param["block_prefix"];?>nav">
												<li class="<?=$param["block_prefix"];?>nav-item  dropdown">
													<a href="#" class="dropdown-toggle <?=$param["block_prefix"];?>nav-link" data-toggle="dropdown">Продукция</a>
													<div class="<?=$param["block_prefix"];?>nav-dropdown dropdown-menu">
														<div class="container <?=$param["block_prefix"];?>nav-dropdown-container">
															<div class="<?=$param["block_prefix"];?>nav-dropdown-row  row  is--gutter  is--wrap">
																<?
																$menu_items_bottom = $this->getMenu(23);
																
																if(count($menu_items_bottom)) {
																	
																	$__menu_array = array(
																		'items' => array(),
																		'structure' => array(),
																	);
																	
																	foreach($menu_items_bottom as $item) {
																		$__menu_array['items'][$item->ID] = $item;
																		$__menu_array['structure'][$item->menu_item_parent][] = &$__menu_array['items'][$item->ID];
																	}
																	
																	if(count($__menu_array['structure'][0])) {
																		foreach($__menu_array['structure'][0] as $item_sub0) {
																			
																			$item_class = '';
																			
																			if($item_sub0->object_id == $this->post['id']){
																				$item_class = $item_class . ' is--active ';
																			}
																			
																			if(count($__menu_array['structure'][$item_sub0->ID])) {
																			
																			?>
																			
																			<div class="<?=$param["block_prefix"];?>nav-dropdown-cols  cols  is--cols-screen-2">
																					<?
																						foreach($__menu_array['structure'][$item_sub0->ID] as $item_sub1) {
																					?>
																					<ul class="<?=$param["block_prefix"];?>nav-dropdown-menu">			
																							<li class="navbar__nav-dropdown-item  is--heading">
																								<a href="<?=$item_sub1->url;?>" class="navbar__nav-dropdown-link  is--heading"><?=$item_sub1->title;?></a>
																							</li>
																							<?
																								foreach($__menu_array['structure'][$item_sub1->ID] as $item_sub2) {
																							?>
																							<li class="navbar__nav-dropdown-item  is--link">
																								<a href="<?=$item_sub2->url;?>" class="navbar__nav-dropdown-link  is--link"><?=$item_sub2->title;?></a>
																							</li>
																							<?
																								}
																							?>
																					</ul>
																					<?
																						}
																					?>
																			</div>
																			
																			<?
																			
																			} /*else {
																				
																				?>
																				
																				<!--<li class="<?=$param["block_prefix"];?>nav-item <?=$item_class;?> ">
																					<a href="<?=$item_sub0->url;?>" class="<?=$param["block_prefix"];?>nav-link"><?=$item_sub0->title;?></a>
																				</li>-->
																				
																				<?
																				
																			}*/
																			
																		}
																	}
																}
															?>
														</div>
												</li>
												<?
													$menu_items_bottom = $this->getMenu(3);
													
													if(count($menu_items_bottom)) {
														
														$__menu_array = array(
															'items' => array(),
															'structure' => array(),
														);
														
														foreach($menu_items_bottom as $item) {
															$__menu_array['items'][$item->ID] = $item;
															$__menu_array['structure'][$item->menu_item_parent][] = &$__menu_array['items'][$item->ID];
														}
														
														if(count($__menu_array['structure'][0])) {
															foreach($__menu_array['structure'][0] as $item_sub0) {
																
																$item_class = '';
																
																if($item_sub0->object_id == $this->post['id']){
																	$item_class = $item_class . ' is--active ';
																}
																
																if(count($__menu_array['structure'][$item_sub0->ID])) {
																
																?>
																
																<li class="<?=$param["block_prefix"];?>nav-item  dropdown">
																	<a href="#" class="dropdown-toggle <?=$param["block_prefix"];?>nav-link" data-toggle="dropdown"><?=$item_sub0->title;?></a>
																	<div class="<?=$param["block_prefix"];?>nav-dropdown dropdown-menu">
																		<div class="container <?=$param["block_prefix"];?>nav-dropdown-container">
																			<div class="<?=$param["block_prefix"];?>nav-dropdown-row  row  is--gutter  is--wrap">
																			<?
																				foreach($__menu_array['structure'][$item_sub0->ID] as $item_sub1) {
																			?>
																				<div class="<?=$param["block_prefix"];?>nav-dropdown-cols  cols">
																					<ul class="<?=$param["block_prefix"];?>nav-dropdown-menu">
																						<li class="navbar__nav-dropdown-item  is--heading">
																							<a href="<?=$item_sub1->url;?>" class="navbar__nav-dropdown-link  is--heading"><?=$item_sub1->title;?></a>
																						</li>
																					</ul>
																				</div>
																			<?
																				}
																			?>				
																			</div>
																		</div>
																	</div>
																</li>
																
																<?
																
																} else {
																	
																	?>
																	
																	<li class="<?=$param["block_prefix"];?>nav-item <?=$item_class;?> ">
																		<a href="<?=$item_sub0->url;?>" class="<?=$param["block_prefix"];?>nav-link"><?=$item_sub0->title;?></a>
																	</li>
																	
																	<?
																	
																}
																
															}
														}
													}
												?>
											</ul>
										</div>
									</div>
								</div>
								<div class="cols <?=$param["block_prefix"];?>collapse-cols  is--contacts" >
									<?if ($phone != ""){?>
									<div class="<?=$param["block_prefix"];?>tel-block">
										<a href="tel:+<?=$phone_num?>" class="<?=$param["block_prefix"];?>tel"><?=$phone;?></a>
									</div>
									<?}?>
									<?if ($email != ""){?>
									<div class="<?=$param["block_prefix"];?>tel-block">
										<a href="mailto:<?=$email;?>" class="<?=$param["block_prefix"];?>email"><span><?=$email_arr[0];?></span>@<?=$email_arr[1];?></a>
									</div>
									<?}?>
								</div>
								<div class="cols <?=$param["block_prefix"];?>collapse-cols  is--btn" >
									
									<?
									if(!is_user_logged_in()) {
									?>
									<button type="button" data-toggle="modal" data-target="#modal-enter" class="<?=$param["block_prefix"];?>btn-icon">
										<svg class="icon-svg icon-btn-login" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-login"></use></svg>
									</button>
									<?
									} else {
									?>
									<a href="<?=l(313);?>" class="<?=$param["block_prefix"];?>btn-icon">
										<svg class="icon-svg icon-btn-login" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-login"></use></svg>
									</a>
									<?
									}
									?>
									
									<a href="<?=l(311);?>" class="<?=$param["block_prefix"];?>btn-icon">
										<svg class="icon-svg icon-btn-basket" role="img"><use xlink:href="<?=$this->path('img');?>/svg/sprite.svg#btn-basket"></use></svg>
										<span class="<?=$param["block_prefix"];?>btn-icon-label azbn__cart__items-amount "><?=count($in_cart);?></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</nav>