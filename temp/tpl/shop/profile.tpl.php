<?
$block_prefix = "basket-page__";
?>
<div class="content-block <?=$block_prefix;?>content-block  is--hidden" role="main">
	<?
		$this->tpl(
			'shop/heading', 
			array(
				"block_prefix" => "page-header-panel__",
			)
		);
	?>
	<?
		$this->tpl(
			'_/bg-card', 
			array(
				"block_prefix" => "bg-plane__",
				"block_mod" => "is--cabinet  is--speed-30",
				"block_bg" => "bg-plane-calc-yellow.png",
			)
		);
	?>
	<div class="container content-block__container cabinet-panel__container  bg-header__container  is--padding-top">
		<div class="cabinet-panel__block">
			<div class="cabinet-panel__row row  is--gutter  is--wrap  is-jcfe">
				<div class="cabinet-panel__cols cols">
					<?
						$this->tpl(
							'shop/sale', 
							array(
								"block_prefix" => "cabinet-sale__",
							)
						);
					?>
				</div>
			</div>
			<div class="cabinet-panel__row row  is--gutter  is--wrap">
				<div class="cabinet-panel__cols cols  is--cols-screen-2  is--navbar">
					<?
						$this->tpl(
							'shop/navbar', 
							array(
								"block_prefix" => "cabinet-navbar__",
							)
						);
					?>
				</div>
				<div class="cabinet-panel__cols cols  is--cols-screen-10  is--cols-sm-12">
					
					<div class="cabinet-panel__inner-row row  is--gutter  is--wrap">
						<div class="cabinet-panel__inner-cols cols  is--cols-screen-4  is--cols-sm-4">
							<div class="cabinet-profile-card__item">
								<h3 class="cabinet-profile-card__heading">Персональные данные</h3>
								<div class="cabinet-profile-card__list"><b>ФИО:</b> <span>Сидоров Егорыавпр Ефремович</span></div>
								<div class="cabinet-profile-card__list"><b>E-mail:</b> <span>ya@mail.ru</span></div>
								<div class="cabinet-profile-card__list"><b>Телефон:</b> <span>+7 (920) 086-45-66</span></div>
								<div class="cabinet-profile-card__link">
									<button type="button" class="btn-link__item  is--xs" data-toggle="modal" data-target="#modal-profile-info"><span>Редактировать</span></button>
								</div>
							</div>
						</div> 
						<div class="cabinet-panel__inner-cols cols  is--cols-screen-4  is--cols-sm-4">	
							<div class="cabinet-profile-card__item">
								<h3 class="cabinet-profile-card__heading">Адрес доставки</h3>
								<div class="cabinet-profile-card__list"><b>Индекс:</b> <span>302028</span></div>
								<div class="cabinet-profile-card__list"><b>Город:</b> <span>Орёл</span></div>
								<div class="cabinet-profile-card__list"><b>Адрес:</b> <span>ул. Бульвар Победы 6, 4 этаж, оф. 52</span></div>
								<div class="cabinet-profile-card__link">
									<button type="button" class="btn-link__item  is--xs" data-toggle="modal" data-target="#modal-profile-address"><span>Редактировать</span></button>
								</div>
							</div>
						</div> 
						<div class="cabinet-panel__inner-cols cols  is--cols-screen-4  is--cols-sm-4">
							<div class="cabinet-profile-card__item">
								<h3 class="cabinet-profile-card__heading">Реквизиты</h3>
								<div class="cabinet-profile-card__list"><b>Файл загружен:</b> <span><a href="#" target="_blank">Посмотреть</a></span></div>
								<div class="cabinet-profile-card__link">
									<button type="button" class="btn-link__item  is--xs" data-toggle="modal" data-target="#modal-profile-requisites"><span>Редактировать</span></button>
								</div>
							</div>
						</div> 
					</div>
				</div>		
			</div>
		</div> 
	</div>		
	<?
		$this->tpl(
			'_/bg-card', 
			array(
				"block_prefix" => "bg-plane__",
				"block_mod" => "is--basket  is--speed-5",
				"block_bg" => "bg-plane-basket-blue.png",
			)
		);
	?>
</div>
<?
$modal_id = 322;
$modal_heading = get_field('modal_heading', $modal_id);
$modal_heading_small = get_field('modal_heading_small', $modal_id);
$modal_btn = get_field('modal_btn', $modal_id);
$this->tpl(
	'_/modals/modal', 
	array(
		"block_prefix" => "modal-base__",
		"block_tpl" => "profile-info",
		"block_mod" => "is--enter",
		"block_modal_id" => "modal-profile-info",
		"block_heading" => $modal_heading,
		"block_note" => $modal_heading_small,
		"block_form_id" => "fmpi",
		"block_form_prefix" => "form__",
		"block_form_mod" => "is--sm",
		"block_btn_name" => $modal_btn,
	)
);
$modal_id = 324;
$modal_heading = get_field('modal_heading', $modal_id);
$modal_heading_small = get_field('modal_heading_small', $modal_id);
$modal_btn = get_field('modal_btn', $modal_id);
$this->tpl(
	'_/modals/modal', 
	array(
		"block_prefix" => "modal-base__",
		"block_tpl" => "profile-address",
		"block_mod" => "is--enter",
		"block_modal_id" => "modal-profile-address",
		"block_heading" => $modal_heading,
		"block_note" => $modal_heading_small,
		"block_form_id" => "fmpa",
		"block_form_prefix" => "form__",
		"block_form_mod" => "is--sm",
		"block_btn_name" => $modal_btn,
	)
);
$modal_id = 326;
$modal_heading = get_field('modal_heading', $modal_id);
$modal_heading_small = get_field('modal_heading_small', $modal_id);
$modal_btn = get_field('modal_btn', $modal_id);
$this->tpl(
	'_/modals/modal', 
	array(
		"block_prefix" => "modal-base__",
		"block_tpl" => "profile-requisites",
		"block_mod" => "is--enter",
		"block_modal_id" => "modal-profile-requisites",
		"block_heading" => $modal_heading,
		"block_note" => $modal_heading_small,
		"block_form_id" => "fmpr",
		"block_form_prefix" => "form__",
		"block_form_mod" => "is--sm",
		"block_btn_name" => $modal_btn,
	)
);
?>