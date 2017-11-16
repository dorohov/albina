'use strict';

$(function(){
	
	
	/* закомментить после использования */
	
	(function(){
		
		var _prefix = 'http://orel-print.ru/wp-content/uploads/';
		
		var imgs = $('img[src^="' + _prefix + '"]');//.attr('src').split('/')
		
		imgs.each(function(index){
			
			var img = $(this);
			var src = img.attr('src');
			//console.log(src);
			
			var _file = src.split(_prefix);
			_file = _file[1];
			//console.log(_file);
			
			new Azbn7__API__Request({
				method : 'img/import',
				file : _file,
				prefix : _prefix,
			}, function(resp){
				
				console.log(resp.response);
				
			});
			
		});
		
	})();
	
	
	$('.azbn-jqfeShowMoreBtn-btn')
		.jqfeShowMoreBtn({
			container:'.azbn-jqfeShowMoreBtn-container',
			items:'.azbn-jqfeShowMoreBtn-item',
			display:'block',
			count:9,
			css_hidden:{
				opacity:0,
			},
			css_visible:{
				opacity:1,
			},
			animation_time:500,
		})
		.trigger('click')
	;
	
	$('form.azbn7__api__form')
		//.attr('method', 'POST')
		.on('submit', function(event){
			event.preventDefault();
			
			
		})
		.on('jqv.form.result', function(event, errorFound){//submit.azbn7
			event.preventDefault();
			
			if(errorFound) {
				
			} else {
				
				var form = $(this);
				var _form = form.clone();
				
				var method = form.attr('data-method') || 'formsave';
				
				_form
					.append($('<input/>', {
						type : 'hidden',
						name : 'method',
						value : method,
					}))
				;
				
				new Azbn7__API__Request(_form.serialize(), function(resp){
					
					_form
						.trigger('reset')
						.empty()
						.remove()
					;
					
					form
						.trigger('reset')
					;
					
					form
						.closest('.modal')
							.modal('hide');
					
					/*
					$('.azbn7__api__message__text')
						.html(resp.response.message.text)
						.closest('.modal')
							.modal();
					*/
					
					$('#modal-message').modal();
					
				});
				
			}
			
		});
	
	$(document.body).on('click.azbn7', '.azbn__calc__ordered__modal-close', null, function(event){
		event.preventDefault();
		
		$(this).closest('.modal').find('.modal-close').trigger('click');
		
	});
	
	
	
	$(document.body).on('click.azbn7', '.azbn__calc__create-order-btn', null, function(event){
		event.preventDefault();
		
		$('.azbn__calc__result').trigger('submit');
		
	});
	
	
	
	$(document.body).on('click.azbn7', '.azbn__cart__item__delete-pos', null, function(event){
		event.preventDefault();
		
		var btn = $(this);
		var row = btn.closest('.azbn__cart__item');
		
		var item_id = row.attr('data-item-id');
		
		new Azbn7__API__Request({
			method : 'cart/delete_pos',
			order_id : item_id,
		}, function(resp){
			
			row
				.empty()
				.remove()
			;
			
			if(resp && resp.response && resp.response.cart) {
				
				$('.azbn__cart__items-amount').html(resp.response.cart.length);
				
			}
			
			console.log(resp);
			
			/*
			$('.azbn7__api__message__text')
				.html(resp.response.message.text)
				.closest('.modal')
					.modal();
			*/
			
		});
		
	});
	
	
	
	$(document.body).on('azbn7.ui.calc.recalc', '.azbn__calc__semiresult', null, function(event, param){
		event.preventDefault();
		
		var cont = $(this);
		
		var result = 0;
		
		$('.azbn__calc__result__item[name="o[sum]"]').val(result);
		$('.azbn__calc__sum-visible').html(result);
		
		var form = $('.azbn__calc__result');
		var _form = form.clone();
		
		var method = 'ourproduct/calculation';
		
		_form
			.append($('<input/>', {
				type : 'hidden',
				name : 'method',
				value : method,
			}))
		;
		
		new Azbn7__API__Request(_form.serialize(), function(resp){
			
			console.log(resp);
			
		});
		
	});
	
	$(document.body).on('submit.azbn7', '.azbn__calc__builder-form', null, function(event){
		event.preventDefault();
	});
	
	$(document.body).on('click.azbn7', '.azbn__calc__semiresult__item .azbn__calc__semiresult__item__reset-btn', null, function(event){
		event.preventDefault();
		
		var btn = $(this);
		var uid = btn.closest('.azbn__calc__semiresult__item').attr('data-uid');
		
		$('.azbn__calc__field[data-uid="' + uid + '"] .azbn__calc__field-form').trigger('reset');
		
		$('.azbn__calc__field[data-uid="' + uid + '"]').trigger('azbn7.ui.calc.field.change', [{
			uid : uid,
			visible_value : '',
			value : '',
		}]);
		
	});
	
	$(document.body).on('submit.azbn7', '.azbn__calc__result', null, function(event, param){
		event.preventDefault();
		
		var form = $(this);
		var _form = form.clone();
		
		var method = 'cart/create_pos';
		
		_form
			.append($('<input/>', {
				type : 'hidden',
				name : 'method',
				value : method,
			}))
		;
		
		new Azbn7__API__Request(_form.serialize(), function(resp){
			
			_form
				.trigger('reset')
				.empty()
				.remove()
			;
			
			form
				.trigger('reset')
			;
			
			/*
			form
				.closest('.modal')
					.modal('hide');
			*/
			
			$('#modal-basket').modal();
			
			$('.azbn__calc__field-form').trigger('reset');
			
			/*
			$('.azbn7__api__message__text')
				.html(resp.response.message.text)
				.closest('.modal')
					.modal();
			*/
			
			//$('#modal-message').modal();
			
		});
		
	});

	$(document.body).on('submit.azbn7', '.azbn__profile__edit-delivery-form', null, function(event){
		event.preventDefault();
		
		var form = $(this);
		var _form = form.clone();
		
		var method = 'profile/update_delivery';
		
		_form
			.append($('<input/>', {
				type : 'hidden',
				name : 'method',
				value : method,
			}))
		;
		
		new Azbn7__API__Request(_form.serialize(), function(resp){
			
			_form
				.trigger('reset')
				.empty()
				.remove()
			;
			
			form
				.trigger('reset')
			;
			
			form
				.closest('.modal')
					.modal('hide');
			
			window.location.reload();
			//$('#modal-basket').modal();
			
		});
		
	});

	
	$(document.body).on('submit.azbn7', '.azbn__profile__edit-profile-form', null, function(event){
		event.preventDefault();
		
		var form = $(this);
		var _form = form.clone();
		
		var method = 'profile/update_profile';
		
		_form
			.append($('<input/>', {
				type : 'hidden',
				name : 'method',
				value : method,
			}))
		;
		
		new Azbn7__API__Request(_form.serialize(), function(resp){
			
			_form
				.trigger('reset')
				.empty()
				.remove()
			;
			
			form
				.trigger('reset')
			;
			
			form
				.closest('.modal')
					.modal('hide');
			
			window.location.reload();
			//$('#modal-basket').modal();
			
		});
		
	});
	
	
	$(document.body).on('click.azbn7', '.azbn__cart__item__change-amount-btn', null, function(event){
		event.preventDefault();
		
		var btn = $(this);
		var change = parseInt(btn.attr('data-change'));
		
		//console.log(change);
		
		/*
		var method = 'cart/update_amount';
		
		_form
			.append($('<input/>', {
				type : 'hidden',
				name : 'method',
				value : method,
			}))
		;
		
		new Azbn7__API__Request({
			
		}, function(resp){
			
			_form
				.trigger('reset')
				.empty()
				.remove()
			;
			
			form
				.trigger('reset')
			;
			
			form
				.closest('.modal')
					.modal('hide');
			
			window.location.reload();
			//$('#modal-basket').modal();
			
		});
		*/
	});
	
	
	
	$(document.body).on('azbn7.ui.calc.field.change', '.azbn__calc__field', null, function(event, param){
		event.preventDefault();
		
		/*
		param = {
			uid
			visible_value
			value
		}
		*/
		
		var btn = $(this);
		var sr_cont = $('.azbn__calc__semiresult');
		var r_cont = $('.azbn__calc__result');
		
		var sr_item = sr_cont.find('.azbn__calc__semiresult__item[data-uid="' + param.uid + '"]');
		var r_item = r_cont.find('.azbn__calc__result__item[name="o[field][' + param.uid + ']"]');
		
		sr_item.find('.__visible-value').html(param.visible_value);
		r_item.val(param.value);
		
		if(param.value == '') {
			sr_item.addClass('azbn__calc__display-none');
		} else {
			sr_item.removeClass('azbn__calc__display-none');
		}
		
		sr_cont.trigger('azbn7.ui.calc.recalc');
		
	});
	
	$(document.body).on('change.azbn7', '.azbn__calc__field select', null, function(event){
		event.preventDefault();
		
		var btn = $(this);
		var item = btn.closest('.azbn__calc__field');
		
		var val = btn.val();
		var option = btn.find('option[value="' + val + '"]');
		
		item.trigger('azbn7.ui.calc.field.change', [{
			uid : item.attr('data-uid'),
			visible_value : option.html(),
			value : val,
		}]);
		
	});


	$(document.body).on('blur.azbn7', '.azbn__profile__email-exists', null, function(event){
		event.preventDefault();

		var input = $(this);
		var val = input.val();

		var re1 = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
		var method = 'profile/check_email';

		if(val != '' && re1.test(val)) {
			
			new Azbn7__API__Request({
				email : val,
				method : method,
			}, function(resp){
				
				if(resp && resp.response && resp.response.result == 1 && resp.response.message.text != '') {

					$('.azbn__profile__can-reg')
						.addClass('azbn__calc__display-none')
					;

					var next_modal = $('#modal-simple-response');

					if(next_modal.length) {
						input.val('');
						next_modal.find('.modal__response__message').html(resp.response.message.text);
						next_modal.modal();
					}

				} else {

					$('.azbn__profile__can-reg')
						.removeClass('azbn__calc__display-none')
					;

				}

			});

		} else {

			$('.azbn__profile__can-reg')
				.addClass('azbn__calc__display-none')
			;

		}

	});

	$(document.body).on('submit.azbn7', '.azbn__simple-response__form', null, function(event){
		event.preventDefault();

		var form = $(this);
		var _form = form.clone();
		
		var method = form.attr('data-method') || 'default';//'profile/reset_password';
		
		_form
			.append($('<input/>', {
				type : 'hidden',
				name : 'method',
				value : method,
			}))
		;
		
		new Azbn7__API__Request(_form.serialize(), function(resp){
			
			_form
				.trigger('reset')
				.empty()
				.remove()
			;
			
			form
				.trigger('reset')
			;
			
			form
				.closest('.modal')
					.modal('hide')
			;

			var next_modal = $('#modal-simple-response');
			
			if(next_modal.length) {
				if(resp && resp.response && resp.response.message && resp.response.message.text != '') {
					next_modal.find('.modal__response__message').html(resp.response.message.text);
					next_modal.modal();
				}
			}

		});

	});
	
	$(document.body).on('click.azbn7', '.azbn__calc__upload-btn', null, function(event){
		event.preventDefault();
		
		var btn = $(this);
		var item = btn.closest('.azbn__calc__field');
		
		$(document.body).Azbn7_AjaxUploader('upload', {
			name : 'azbn__calc__field_upload',
			action : '/api/',
			on_percent : function(file, total, loaded, percent) {
				//console.log(file.name + ': ' + percent);
				//Azbn7.User.msg('info', 'Загрузка ' + file.name + ': ' + percent + '%');
			},
			callback : function(file, response, uploaded, is_last) {
				
				var json = JSON.parse(response);
				//console.log(json);
				
				if(json.response && json.response.attachment) {
					
					if(json.response.attachment.ID && json.response.attachment.ID != '' && json.response.attachment.url != '') {
						
						var val = json.response.attachment.url;
						var visible_val = val.split('/').pop().split('\\').pop();
						
						item.find('.azbn__calc__field_upload__value').html(visible_val);
						
						item.trigger('azbn7.ui.calc.field.change', [{
							uid : item.attr('data-uid'),
							visible_value : visible_val,
							value : val,
						}]);
						
					} else {
						
						var val = json.response.message.text;
						var visible_val = json.response.message.text;
						
						item.find('.azbn__calc__field_upload__value').html(visible_val);
						
					}
					
				} else {
					
					
					
				}
				
			},
		});
		
	});
	
	
	
	$(document.body).on('click.azbn7', '.azbn__order__create', null, function(event){
		event.preventDefault();
		
		var btn = $(this);
		var href = btn.attr('href');
		
		new Azbn7__API__Request({
			method : 'cart/create_order',
		}, function(resp){
			
			if(resp && resp.response && resp.response.order_id) {
				//window.location.href = href + '?order_id=' + resp.response.order_id;
				
				$('#modal-basket').modal();
				
			}
			
		});
		
	});
	
})