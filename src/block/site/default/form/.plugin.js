$(function(){
	"use strict";	
	$('form.azbn7__api__form')
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
				$('#modal-message').modal();					
			});				
		}			
	});
});
/*
 * Inline Form Validation Engine 2.6.2, jQuery plugin
 *
 * Copyright(c) 2010, Cedric Dugas
 * http://www.position-absolute.com
 *
 * 2.0 Rewrite by Olivier Refalo
 * http://www.crionics.com
 *
 * Form validation engine allowing custom regex rules to be added.
 * Licensed under the MIT License
 */

(function($) {

	"use strict";

	var methods = {

		/**
		* Kind of the constructor, called before any action
		* @param {Map} user options
		*/
		init: function(options) {
			var form = this;
			if (!form.data('jqv') || form.data('jqv') == null ) {
				options = methods._saveOptions(form, options);
				// bind all formError elements to close on click
				$(document).on("click", ".formError", function() {
					$(this).fadeOut(150, function() {
						// remove prompt once invisible
						$(this).closest('.formError').remove();
					});
				});
			}
			return this;
		 },
		/**
		* Attachs jQuery.validationEngine to form.submit and field.blur events
		* Takes an optional params: a list of options
		* ie. jQuery("#formID1").validationEngine('attach', {promptPosition : "centerRight"});
		*/
		attach: function(userOptions) {

			var form = this;
			var options;

			if(userOptions)
				options = methods._saveOptions(form, userOptions);
			else
				options = form.data('jqv');

			options.validateAttribute = (form.find("[data-validation-engine*=validate]").length) ? "data-validation-engine" : "class";
			if (options.binded) {

				// delegate fields
				form.on(options.validationEventTrigger, "["+options.validateAttribute+"*=validate]:not([type=checkbox]):not([type=radio]):not(.datepicker)", methods._onFieldEvent);
				form.on("click", "["+options.validateAttribute+"*=validate][type=checkbox],["+options.validateAttribute+"*=validate][type=radio]", methods._onFieldEvent);
				form.on(options.validationEventTrigger,"["+options.validateAttribute+"*=validate][class*=datepicker]", {"delay": 300}, methods._onFieldEvent);
			}
			if (options.autoPositionUpdate) {
				$(window).bind("resize", {
					"noAnimation": true,
					"formElem": form
				}, methods.updatePromptsPosition);
			}
			form.on("click","a[data-validation-engine-skip], a[class*='validate-skip'], button[data-validation-engine-skip], button[class*='validate-skip'], input[data-validation-engine-skip], input[class*='validate-skip']", methods._submitButtonClick);
			form.removeData('jqv_submitButton');

			// bind form.submit
			form.on("submit", methods._onSubmitEvent);
			return this;
		},
		/**
		* Unregisters any bindings that may point to jQuery.validaitonEngine
		*/
		detach: function() {

			var form = this;
			var options = form.data('jqv');

			// unbind fields
			form.off(options.validationEventTrigger, "["+options.validateAttribute+"*=validate]:not([type=checkbox]):not([type=radio]):not(.datepicker)", methods._onFieldEvent);
			form.off("click", "["+options.validateAttribute+"*=validate][type=checkbox],["+options.validateAttribute+"*=validate][type=radio]", methods._onFieldEvent);
			form.off(options.validationEventTrigger,"["+options.validateAttribute+"*=validate][class*=datepicker]", methods._onFieldEvent);

			// unbind form.submit
			form.off("submit", methods._onSubmitEvent);
			form.removeData('jqv');

			form.off("click", "a[data-validation-engine-skip], a[class*='validate-skip'], button[data-validation-engine-skip], button[class*='validate-skip'], input[data-validation-engine-skip], input[class*='validate-skip']", methods._submitButtonClick);
			form.removeData('jqv_submitButton');

			if (options.autoPositionUpdate)
				$(window).off("resize", methods.updatePromptsPosition);

			return this;
		},
		/**
		* Validates either a form or a list of fields, shows prompts accordingly.
		* Note: There is no ajax form validation with this method, only field ajax validation are evaluated
		*
		* @return true if the form validates, false if it fails
		*/
		validate: function(userOptions) {
			var element = $(this);
			var valid = null;
			var options;

			if (element.is("form") || element.hasClass("validationEngineContainer")) {
				if (element.hasClass('validating')) {
					// form is already validating.
					// Should abort old validation and start new one. I don't know how to implement it.
					return false;
				} else {
					element.addClass('validating');
					if(userOptions)
						options = methods._saveOptions(element, userOptions);
					else
						options = element.data('jqv');
					var valid = methods._validateFields(this);

					// If the form doesn't validate, clear the 'validating' class before the user has a chance to submit again
					setTimeout(function(){
						element.removeClass('validating');
					}, 100);
					if (valid && options.onSuccess) {
						options.onSuccess();
					} else if (!valid && options.onFailure) {
						options.onFailure();
					}
				}
			} else if (element.is('form') || element.hasClass('validationEngineContainer')) {
				element.removeClass('validating');
			} else {
				// field validation
		                var form = element.closest('form, .validationEngineContainer');
		                options = (form.data('jqv')) ? form.data('jqv') : $.validationEngine.defaults;
		                valid = methods._validateField(element, options);

		                if (valid && options.onFieldSuccess)
		                    options.onFieldSuccess();
		                else if (options.onFieldFailure && options.InvalidFields.length > 0) {
		                    options.onFieldFailure();
		                }

		                return !valid;
			}
			if(options.onValidationComplete) {
				// !! ensures that an undefined return is interpreted as return false but allows a onValidationComplete() to possibly return true and have form continue processing
				return !!options.onValidationComplete(form, valid);
			}
			return valid;
		},
		/**
		*  Redraw prompts position, useful when you change the DOM state when validating
		*/
		updatePromptsPosition: function(event) {

			if (event && this == window) {
				var form = event.data.formElem;
				var noAnimation = event.data.noAnimation;
			}
			else
				var form = $(this.closest('form, .validationEngineContainer'));

			var options = form.data('jqv');
			// No option, take default one
			if (!options)
				options = methods._saveOptions(form, options);
			form.find('['+options.validateAttribute+'*=validate]').not(":disabled").each(function(){
				var field = $(this);
				if (options.prettySelect && field.is(":hidden"))
				  field = form.find("#" + options.usePrefix + field.attr('id') + options.useSuffix);
				var prompt = methods._getPrompt(field);
				var promptText = $(prompt).find(".formErrorContent").html();

				if(prompt)
					methods._updatePrompt(field, $(prompt), promptText, undefined, false, options, noAnimation);
			});
			return this;
		},
		/**
		* Displays a prompt on a element.
		* Note that the element needs an id!
		*
		* @param {String} promptText html text to display type
		* @param {String} type the type of bubble: 'pass' (green), 'load' (black) anything else (red)
		* @param {String} possible values topLeft, topRight, bottomLeft, centerRight, bottomRight
		*/
		showPrompt: function(promptText, type, promptPosition, showArrow) {
			var form = this.closest('form, .validationEngineContainer');
			var options = form.data('jqv');
			// No option, take default one
			if(!options)
				options = methods._saveOptions(this, options);
			if(promptPosition)
				options.promptPosition=promptPosition;
			options.showArrow = showArrow==true;

			methods._showPrompt(this, promptText, type, false, options);
			return this;
		},
		/**
		* Closes form error prompts, CAN be invidual
		*/
		hide: function() {
			 var form = $(this).closest('form, .validationEngineContainer');
			 var options = form.data('jqv');
			 // No option, take default one
			 if (!options)
				options = methods._saveOptions(form, options);
			 var fadeDuration = (options && options.fadeDuration) ? options.fadeDuration : 0.3;
			 var closingtag;

			 if(form.is("form") || form.hasClass("validationEngineContainer")) {
				 closingtag = "parentForm"+methods._getClassName($(form).attr("id"));
			 } else {
				 closingtag = methods._getClassName($(form).attr("id")) +"formError";
			 }
			 $('.'+closingtag).fadeTo(fadeDuration, 0, function() {
				 $(this).closest('.formError').remove();
			 });
			 return this;
		 },
		 /**
		 * Closes all error prompts on the page
		 */
		 hideAll: function() {
			 var form = this;
			 var options = form.data('jqv');
			 var duration = options ? options.fadeDuration:300;
			 $('.formError').fadeTo(duration, 0, function() {
				 $(this).closest('.formError').remove();
			 });
			 return this;
		 },
		/**
		* Typically called when user exists a field using tab or a mouse click, triggers a field
		* validation
		*/
		_onFieldEvent: function(event) {
			var field = $(this);
			var form = field.closest('form, .validationEngineContainer');
			var options = form.data('jqv');
			// No option, take default one
			if (!options)
				options = methods._saveOptions(form, options);
			options.eventTrigger = "field";

            if (options.notEmpty == true){

                if(field.val().length > 0){
                    // validate the current field
                    window.setTimeout(function() {
                        methods._validateField(field, options);
                    }, (event.data) ? event.data.delay : 0);

                }

            }else{

                // validate the current field
                window.setTimeout(function() {
                    methods._validateField(field, options);
                }, (event.data) ? event.data.delay : 0);

            }




		},
		/**
		* Called when the form is submited, shows prompts accordingly
		*
		* @param {jqObject}
		*            form
		* @return false if form submission needs to be cancelled
		*/
		_onSubmitEvent: function() {
			var form = $(this);
			var options = form.data('jqv');

			//check if it is trigger from skipped button
			if (form.data("jqv_submitButton")){
				var submitButton = $("#" + form.data("jqv_submitButton"));
				if (submitButton){
					if (submitButton.length > 0){
						if (submitButton.hasClass("validate-skip") || submitButton.attr("data-validation-engine-skip") == "true")
							return true;
					}
				}
			}

			options.eventTrigger = "submit";

			// validate each field
			// (- skip field ajax validation, not necessary IF we will perform an ajax form validation)
			var r=methods._validateFields(form);

			if (r && options.ajaxFormValidation) {
				methods._validateFormWithAjax(form, options);
				// cancel form auto-submission - process with async call onAjaxFormComplete
				return false;
			}

			if(options.onValidationComplete) {
				// !! ensures that an undefined return is interpreted as return false but allows a onValidationComplete() to possibly return true and have form continue processing
				return !!options.onValidationComplete(form, r);
			}
			return r;
		},
		/**
		* Return true if the ajax field validations passed so far
		* @param {Object} options
		* @return true, is all ajax validation passed so far (remember ajax is async)
		*/
		_checkAjaxStatus: function(options) {
			var status = true;
			$.each(options.ajaxValidCache, function(key, value) {
				if (!value) {
					status = false;
					// break the each
					return false;
				}
			});
			return status;
		},

		/**
		* Return true if the ajax field is validated
		* @param {String} fieldid
		* @param {Object} options
		* @return true, if validation passed, false if false or doesn't exist
		*/
		_checkAjaxFieldStatus: function(fieldid, options) {
			return options.ajaxValidCache[fieldid] == true;
		},
		/**
		* Validates form fields, shows prompts accordingly
		*
		* @param {jqObject}
		*            form
		* @param {skipAjaxFieldValidation}
		*            boolean - when set to true, ajax field validation is skipped, typically used when the submit button is clicked
		*
		* @return true if form is valid, false if not, undefined if ajax form validation is done
		*/
		_validateFields: function(form) {
			var options = form.data('jqv');

			// this variable is set to true if an error is found
			var errorFound = false;

			// Trigger hook, start validation
			form.trigger("jqv.form.validating");
			// first, evaluate status of non ajax fields
			var first_err=null;
			form.find('['+options.validateAttribute+'*=validate]').not(":disabled").each( function() {
				var field = $(this);
				var names = [];
				if ($.inArray(field.attr('name'), names) < 0) {
					errorFound |= methods._validateField(field, options);
					if (errorFound && first_err==null)
						if (field.is(":hidden") && options.prettySelect)
							first_err = field = form.find("#" + options.usePrefix + methods._jqSelector(field.attr('id')) + options.useSuffix);
						else {

							//Check if we need to adjust what element to show the prompt on
							//and and such scroll to instead
							if(field.data('jqv-prompt-at') instanceof jQuery ){
								field = field.data('jqv-prompt-at');
							} else if(field.data('jqv-prompt-at')) {
								field = $(field.data('jqv-prompt-at'));
							}
							first_err=field;
						}
					if (options.doNotShowAllErrosOnSubmit)
						return false;
					names.push(field.attr('name'));

					//if option set, stop checking validation rules after one error is found
					if(options.showOneMessage == true && errorFound){
						return false;
					}
				}
			});

			// second, check to see if all ajax calls completed ok
			// errorFound |= !methods._checkAjaxStatus(options);

			// third, check status and scroll the container accordingly
			form.trigger("jqv.form.result", [errorFound]);

			if (errorFound) {
				if (options.scroll) {
					var destination=first_err.offset().top;
					var fixleft = first_err.offset().left;

					//prompt positioning adjustment support. Usage: positionType:Xshift,Yshift (for ex.: bottomLeft:+20 or bottomLeft:-20,+10)
					var positionType=options.promptPosition;
					if (typeof(positionType)=='string' && positionType.indexOf(":")!=-1)
						positionType=positionType.substring(0,positionType.indexOf(":"));

					if (positionType!="bottomRight" && positionType!="bottomLeft") {
						var prompt_err= methods._getPrompt(first_err);
						if (prompt_err) {
							destination=prompt_err.offset().top;
						}
					}

					// Offset the amount the page scrolls by an amount in px to accomodate fixed elements at top of page
					if (options.scrollOffset) {
						destination -= options.scrollOffset;
					}

					// get the position of the first error, there should be at least one, no need to check this
					//var destination = form.find(".formError:not('.greenPopup'):first").offset().top;
					if (options.isOverflown) {
						var overflowDIV = $(options.overflownDIV);
						if(!overflowDIV.length) return false;
						var scrollContainerScroll = overflowDIV.scrollTop();
						var scrollContainerPos = -parseInt(overflowDIV.offset().top);

						destination += scrollContainerScroll + scrollContainerPos - 5;
						var scrollContainer = $(options.overflownDIV).filter(":not(:animated)");

						scrollContainer.animate({ scrollTop: destination }, 1100, function(){
							if(options.focusFirstField) first_err.focus();
						});

					} else {
						$("html, body").animate({
							scrollTop: destination
						}, 1100, function(){
							if(options.focusFirstField) first_err.focus();
						});
						$("html, body").animate({scrollLeft: fixleft},1100)
					}

				} else if(options.focusFirstField)
					first_err.focus();
				return false;
			}
			return true;
		},
		/**
		* This method is called to perform an ajax form validation.
		* During this process all the (field, value) pairs are sent to the server which returns a list of invalid fields or true
		*
		* @param {jqObject} form
		* @param {Map} options
		*/
		_validateFormWithAjax: function(form, options) {

			var data = form.serialize();
									var type = (options.ajaxFormValidationMethod) ? options.ajaxFormValidationMethod : "GET";
			var url = (options.ajaxFormValidationURL) ? options.ajaxFormValidationURL : form.attr("action");
									var dataType = (options.dataType) ? options.dataType : "json";
			$.ajax({
				type: type,
				url: url,
				cache: false,
				dataType: dataType,
				data: data,
				form: form,
				methods: methods,
				options: options,
				beforeSend: function() {
					return options.onBeforeAjaxFormValidation(form, options);
				},
				error: function(data, transport) {
					if (options.onFailure) {
						options.onFailure(data, transport);
					} else {
						methods._ajaxError(data, transport);
					}
				},
				success: function(json) {
					if ((dataType == "json") && (json !== true)) {
						// getting to this case doesn't necessary means that the form is invalid
						// the server may return green or closing prompt actions
						// this flag helps figuring it out
						var errorInForm=false;
						for (var i = 0; i < json.length; i++) {
							var value = json[i];

							var errorFieldId = value[0];
							var errorField = $($("#" + errorFieldId)[0]);

							// make sure we found the element
							if (errorField.length == 1) {

								// promptText or selector
								var msg = value[2];
								// if the field is valid
								if (value[1] == true) {

									if (msg == ""  || !msg){
										// if for some reason, status==true and error="", just close the prompt
										methods._closePrompt(errorField);
									} else {
										// the field is valid, but we are displaying a green prompt
										if (options.allrules[msg]) {
											var txt = options.allrules[msg].alertTextOk;
											if (txt)
												msg = txt;
										}
										if (options.showPrompts) methods._showPrompt(errorField, msg, "pass", false, options, true);
									}
								} else {
									// the field is invalid, show the red error prompt
									errorInForm|=true;
									if (options.allrules[msg]) {
										var txt = options.allrules[msg].alertText;
										if (txt)
											msg = txt;
									}
									if(options.showPrompts) methods._showPrompt(errorField, msg, "", false, options, true);
								}
							}
						}
						options.onAjaxFormComplete(!errorInForm, form, json, options);
					} else
						options.onAjaxFormComplete(true, form, json, options);

				}
			});

		},
		/**
		* Validates field, shows prompts accordingly
		*
		* @param {jqObject}
		*            field
		* @param {Array[String]}
		*            field's validation rules
		* @param {Map}
		*            user options
		* @return false if field is valid (It is inversed for *fields*, it return false on validate and true on errors.)
		*/
		_validateField: function(field, options, skipAjaxValidation) {
			if (!field.attr("id")) {
				field.attr("id", "form-validation-field-" + $.validationEngine.fieldIdCounter);
				++$.validationEngine.fieldIdCounter;
			}

			if(field.hasClass(options.ignoreFieldsWithClass))
				return false;

           if (!options.validateNonVisibleFields && (field.is(":hidden") && !options.prettySelect || field.parent().is(":hidden")))
				return false;

			var rulesParsing = field.attr(options.validateAttribute);
			var getRules = /validate\[(.*)\]/.exec(rulesParsing);

			if (!getRules)
				return false;
			var str = getRules[1];
			var rules = str.split(/\[|,|\]/);

			// true if we ran the ajax validation, tells the logic to stop messing with prompts
			var isAjaxValidator = false;
			var fieldName = field.attr("name");
			var promptText = "";
			var promptType = "";
			var required = false;
			var limitErrors = false;
			options.isError = false;
			options.showArrow = options.showArrow ==true;

			// If the programmer wants to limit the amount of error messages per field,
			if (options.maxErrorsPerField > 0) {
				limitErrors = true;
			}

			var form = $(field.closest("form, .validationEngineContainer"));
			// Fix for adding spaces in the rules
			for (var i = 0; i < rules.length; i++) {
				rules[i] = rules[i].toString().replace(" ", "");//.toString to worked on IE8
				// Remove any parsing errors
				if (rules[i] === '') {
					delete rules[i];
				}
			}

			for (var i = 0, field_errors = 0; i < rules.length; i++) {

				// If we are limiting errors, and have hit the max, break
				if (limitErrors && field_errors >= options.maxErrorsPerField) {
					// If we haven't hit a required yet, check to see if there is one in the validation rules for this
					// field and that it's index is greater or equal to our current index
					if (!required) {
						var have_required = $.inArray('required', rules);
						required = (have_required != -1 &&  have_required >= i);
					}
					break;
				}


				var errorMsg = undefined;
				switch (rules[i]) {

					case "required":
						required = true;
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._required);
						break;
					case "custom":
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._custom);
						break;
					case "groupRequired":
						// Check is its the first of group, if not, reload validation with first field
						// AND continue normal validation on present field
						var classGroup = "["+options.validateAttribute+"*=" +rules[i + 1] +"]";
						var firstOfGroup = form.find(classGroup).eq(0);
						if(firstOfGroup[0] != field[0]){

							methods._validateField(firstOfGroup, options, skipAjaxValidation);
							options.showArrow = true;

						}
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._groupRequired);
						if(errorMsg)  required = true;
						options.showArrow = false;
						break;
					case "ajax":
						// AJAX defaults to returning it's loading message
						errorMsg = methods._ajax(field, rules, i, options);
						if (errorMsg) {
							promptType = "load";
						}
						break;
					case "minSize":
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._minSize);
						break;
					case "maxSize":
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._maxSize);
						break;
					case "min":
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._min);
						break;
					case "max":
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._max);
						break;
					case "past":
						errorMsg = methods._getErrorMessage(form, field,rules[i], rules, i, options, methods._past);
						break;
					case "future":
						errorMsg = methods._getErrorMessage(form, field,rules[i], rules, i, options, methods._future);
						break;
					case "dateRange":
						var classGroup = "["+options.validateAttribute+"*=" + rules[i + 1] + "]";
						options.firstOfGroup = form.find(classGroup).eq(0);
						options.secondOfGroup = form.find(classGroup).eq(1);

						//if one entry out of the pair has value then proceed to run through validation
						if (options.firstOfGroup[0].value || options.secondOfGroup[0].value) {
							errorMsg = methods._getErrorMessage(form, field,rules[i], rules, i, options, methods._dateRange);
						}
						if (errorMsg) required = true;
						options.showArrow = false;
						break;

					case "dateTimeRange":
						var classGroup = "["+options.validateAttribute+"*=" + rules[i + 1] + "]";
						options.firstOfGroup = form.find(classGroup).eq(0);
						options.secondOfGroup = form.find(classGroup).eq(1);

						//if one entry out of the pair has value then proceed to run through validation
						if (options.firstOfGroup[0].value || options.secondOfGroup[0].value) {
							errorMsg = methods._getErrorMessage(form, field,rules[i], rules, i, options, methods._dateTimeRange);
						}
						if (errorMsg) required = true;
						options.showArrow = false;
						break;
					case "maxCheckbox":
						field = $(form.find("input[name='" + fieldName + "']"));
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._maxCheckbox);
						break;
					case "minCheckbox":
						field = $(form.find("input[name='" + fieldName + "']"));
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._minCheckbox);
						break;
					case "equals":
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._equals);
						break;
					case "funcCall":
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._funcCall);
						break;
					case "creditCard":
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._creditCard);
						break;
					case "condRequired":
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._condRequired);
						if (errorMsg !== undefined) {
							required = true;
						}
						break;
					case "funcCallRequired":
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._funcCallRequired);
						if (errorMsg !== undefined) {
							required = true;
						}
						break;

					default:
				}

				var end_validation = false;

				// If we were passed back an message object, check what the status was to determine what to do
				if (typeof errorMsg == "object") {
					switch (errorMsg.status) {
						case "_break":
							end_validation = true;
							break;
						// If we have an error message, set errorMsg to the error message
						case "_error":
							errorMsg = errorMsg.message;
							break;
						// If we want to throw an error, but not show a prompt, return early with true
						case "_error_no_prompt":
							return true;
							break;
						// Anything else we continue on
						default:
							break;
					}
				}

				//funcCallRequired, first in rules, and has error, skip anything else
				if( i==0 && str.indexOf('funcCallRequired')==0 && errorMsg !== undefined ){
					if(promptText != '') {
						promptText += "<br/>";
					}
					promptText += errorMsg;
					options.isError=true;
					field_errors++;
					end_validation=true;
				}

				// If it has been specified that validation should end now, break
				if (end_validation) {
					break;
				}

				// If we have a string, that means that we have an error, so add it to the error message.
				if (typeof errorMsg == 'string') {
					if(promptText != '') {
						promptText += "<br/>";
					}
					promptText += errorMsg;
					options.isError = true;
					field_errors++;
				}
			}
			// If the rules required is not added, an empty field is not validated
			//the 3rd condition is added so that even empty password fields should be equal
			//otherwise if one is filled and another left empty, the "equal" condition would fail
			//which does not make any sense
			if(!required && !(field.val()) && field.val().length < 1 && $.inArray('equals', rules) < 0) options.isError = false;

			// Hack for radio/checkbox group button, the validation go into the
			// first radio/checkbox of the group
			var fieldType = field.prop("type");
			var positionType=field.data("promptPosition") || options.promptPosition;

			if ((fieldType == "radio" || fieldType == "checkbox") && form.find("input[name='" + fieldName + "']").length > 1) {
				if(positionType === 'inline') {
					field = $(form.find("input[name='" + fieldName + "'][type!=hidden]:last"));
				} else {
				field = $(form.find("input[name='" + fieldName + "'][type!=hidden]:first"));
				}
				options.showArrow = options.showArrowOnRadioAndCheckbox;
			}

			if(field.is(":hidden") && options.prettySelect) {
				field = form.find("#" + options.usePrefix + methods._jqSelector(field.attr('id')) + options.useSuffix);
			}

			if (options.isError && options.showPrompts){
				methods._showPrompt(field, promptText, promptType, false, options);
			}else{
				if (!isAjaxValidator) methods._closePrompt(field);
			}

			if (!isAjaxValidator) {
				field.trigger("jqv.field.result", [field, options.isError, promptText]);
			}

			/* Record error */
			var errindex = $.inArray(field[0], options.InvalidFields);
			if (errindex == -1) {
				if (options.isError)
				options.InvalidFields.push(field[0]);
			} else if (!options.isError) {
				options.InvalidFields.splice(errindex, 1);
			}

			methods._handleStatusCssClasses(field, options);

			/* run callback function for each field */
			if (options.isError && options.onFieldFailure)
				options.onFieldFailure(field);

			if (!options.isError && options.onFieldSuccess)
				options.onFieldSuccess(field);

			return options.isError;
		},
		/**
		* Handling css classes of fields indicating result of validation
		*
		* @param {jqObject}
		*            field
		* @param {Array[String]}
		*            field's validation rules
		* @private
		*/
		_handleStatusCssClasses: function(field, options) {
			/* remove all classes */
			if(options.addSuccessCssClassToField)
				field.removeClass(options.addSuccessCssClassToField);

			if(options.addFailureCssClassToField)
				field.removeClass(options.addFailureCssClassToField);

			/* Add classes */
			if (options.addSuccessCssClassToField && !options.isError)
				field.addClass(options.addSuccessCssClassToField);

			if (options.addFailureCssClassToField && options.isError)
				field.addClass(options.addFailureCssClassToField);
		},

		 /********************
		  * _getErrorMessage
		  *
		  * @param form
		  * @param field
		  * @param rule
		  * @param rules
		  * @param i
		  * @param options
		  * @param originalValidationMethod
		  * @return {*}
		  * @private
		  */
		 _getErrorMessage:function (form, field, rule, rules, i, options, originalValidationMethod) {
			 // If we are using the custon validation type, build the index for the rule.
			 // Otherwise if we are doing a function call, make the call and return the object
			 // that is passed back.
	 		 var rule_index = jQuery.inArray(rule, rules);
			 if (rule === "custom" || rule === "funcCall" || rule === "funcCallRequired") {
				 var custom_validation_type = rules[rule_index + 1];
				 rule = rule + "[" + custom_validation_type + "]";
				 // Delete the rule from the rules array so that it doesn't try to call the
			    // same rule over again
			    delete(rules[rule_index]);
			 }
			 // Change the rule to the composite rule, if it was different from the original
			 var alteredRule = rule;


			 var element_classes = (field.attr("data-validation-engine")) ? field.attr("data-validation-engine") : field.attr("class");
			 var element_classes_array = element_classes.split(" ");

			 // Call the original validation method. If we are dealing with dates or checkboxes, also pass the form
			 var errorMsg;
			 if (rule == "future" || rule == "past"  || rule == "maxCheckbox" || rule == "minCheckbox") {
				 errorMsg = originalValidationMethod(form, field, rules, i, options);
			 } else {
				 errorMsg = originalValidationMethod(field, rules, i, options);
			 }

			 // If the original validation method returned an error and we have a custom error message,
			 // return the custom message instead. Otherwise return the original error message.
			 if (errorMsg != undefined) {
				 var custom_message = methods._getCustomErrorMessage($(field), element_classes_array, alteredRule, options);
				 if (custom_message) errorMsg = custom_message;
			 }
			 return errorMsg;

		 },
		 _getCustomErrorMessage:function (field, classes, rule, options) {
			var custom_message = false;
			var validityProp = /^custom\[.*\]$/.test(rule) ? methods._validityProp["custom"] : methods._validityProp[rule];
			 // If there is a validityProp for this rule, check to see if the field has an attribute for it
			if (validityProp != undefined) {
				custom_message = field.attr("data-errormessage-"+validityProp);
				// If there was an error message for it, return the message
				if (custom_message != undefined)
					return custom_message;
			}
			custom_message = field.attr("data-errormessage");
			 // If there is an inline custom error message, return it
			if (custom_message != undefined)
				return custom_message;
			var id = '#' + field.attr("id");
			// If we have custom messages for the element's id, get the message for the rule from the id.
			// Otherwise, if we have custom messages for the element's classes, use the first class message we find instead.
			if (typeof options.custom_error_messages[id] != "undefined" &&
				typeof options.custom_error_messages[id][rule] != "undefined" ) {
						  custom_message = options.custom_error_messages[id][rule]['message'];
			} else if (classes.length > 0) {
				for (var i = 0; i < classes.length && classes.length > 0; i++) {
					 var element_class = "." + classes[i];
					if (typeof options.custom_error_messages[element_class] != "undefined" &&
						typeof options.custom_error_messages[element_class][rule] != "undefined") {
							custom_message = options.custom_error_messages[element_class][rule]['message'];
							break;
					}
				}
			}
			if (!custom_message &&
				typeof options.custom_error_messages[rule] != "undefined" &&
				typeof options.custom_error_messages[rule]['message'] != "undefined"){
					 custom_message = options.custom_error_messages[rule]['message'];
			 }
			 return custom_message;
		 },
		 _validityProp: {
			 "required": "value-missing",
			 "custom": "custom-error",
			 "groupRequired": "value-missing",
			 "ajax": "custom-error",
			 "minSize": "range-underflow",
			 "maxSize": "range-overflow",
			 "min": "range-underflow",
			 "max": "range-overflow",
			 "past": "type-mismatch",
			 "future": "type-mismatch",
			 "dateRange": "type-mismatch",
			 "dateTimeRange": "type-mismatch",
			 "maxCheckbox": "range-overflow",
			 "minCheckbox": "range-underflow",
			 "equals": "pattern-mismatch",
			 "funcCall": "custom-error",
			 "funcCallRequired": "custom-error",
			 "creditCard": "pattern-mismatch",
			 "condRequired": "value-missing"
		 },
		/**
		* Required validation
		*
		* @param {jqObject} field
		* @param {Array[String]} rules
		* @param {int} i rules index
		* @param {Map}
		*            user options
		* @param {bool} condRequired flag when method is used for internal purpose in condRequired check
		* @return an error string if validation failed
		*/
		_required: function(field, rules, i, options, condRequired) {
			switch (field.prop("type")) {
				case "radio":
				case "checkbox":
					// new validation style to only check dependent field
					if (condRequired) {
						if (!field.prop('checked')) {
							return options.allrules[rules[i]].alertTextCheckboxMultiple;
						}
						break;
					}
					// old validation style
					var form = field.closest("form, .validationEngineContainer");
					var name = field.attr("name");
					if (form.find("input[name='" + name + "']:checked").length == 0) {
						if (form.find("input[name='" + name + "']:visible").length == 1)
							return options.allrules[rules[i]].alertTextCheckboxe;
						else
							return options.allrules[rules[i]].alertTextCheckboxMultiple;
					}
					break;
				case "text":
				case "password":
				case "textarea":
				case "file":
				case "select-one":
				case "select-multiple":
				default:
					var field_val      = $.trim( field.val()                               );
					var dv_placeholder = $.trim( field.attr("data-validation-placeholder") );
					var placeholder    = $.trim( field.attr("placeholder")                 );
					if (
						   ( !field_val                                    )
						|| ( dv_placeholder && field_val == dv_placeholder )
						|| ( placeholder    && field_val == placeholder    )
					) {
						return options.allrules[rules[i]].alertText;
					}
					break;
			}
		},
		/**
		* Validate that 1 from the group field is required
		*
		* @param {jqObject} field
		* @param {Array[String]} rules
		* @param {int} i rules index
		* @param {Map}
		*            user options
		* @return an error string if validation failed
		*/
		_groupRequired: function(field, rules, i, options) {
			var classGroup = "["+options.validateAttribute+"*=" +rules[i + 1] +"]";
			var isValid = false;
			// Check all fields from the group
			field.closest("form, .validationEngineContainer").find(classGroup).each(function(){
				if(!methods._required($(this), rules, i, options)){
					isValid = true;
					return false;
				}
			});

			if(!isValid) {
		  return options.allrules[rules[i]].alertText;
		}
		},
		/**
		* Validate rules
		*
		* @param {jqObject} field
		* @param {Array[String]} rules
		* @param {int} i rules index
		* @param {Map}
		*            user options
		* @return an error string if validation failed
		*/
		_custom: function(field, rules, i, options) {
			var customRule = rules[i + 1];
			var rule = options.allrules[customRule];
			var fn;
			if(!rule) {
				alert("jqv:custom rule not found - "+customRule);
				return;
			}

			if(rule["regex"]) {
				 var ex=rule.regex;
					if(!ex) {
						alert("jqv:custom regex not found - "+customRule);
						return;
					}
					var pattern = new RegExp(ex);

					if (!pattern.test(field.val())) return options.allrules[customRule].alertText;

			} else if(rule["func"]) {
				fn = rule["func"];

				if (typeof(fn) !== "function") {
					alert("jqv:custom parameter 'function' is no function - "+customRule);
						return;
				}

				if (!fn(field, rules, i, options))
					return options.allrules[customRule].alertText;
			} else {
				alert("jqv:custom type not allowed "+customRule);
					return;
			}
		},
		/**
		* Validate custom function outside of the engine scope
		*
		* @param {jqObject} field
		* @param {Array[String]} rules
		* @param {int} i rules index
		* @param {Map}
		*            user options
		* @return an error string if validation failed
		*/
		_funcCall: function(field, rules, i, options) {
			var functionName = rules[i + 1];
			var fn;
			if(functionName.indexOf('.') >-1)
			{
				var namespaces = functionName.split('.');
				var scope = window;
				while(namespaces.length)
				{
					scope = scope[namespaces.shift()];
				}
				fn = scope;
			}
			else
				fn = window[functionName] || options.customFunctions[functionName];
			if (typeof(fn) == 'function')
				return fn(field, rules, i, options);

		},
		_funcCallRequired: function(field, rules, i, options) {
			return methods._funcCall(field,rules,i,options);
		},
		/**
		* Field match
		*
		* @param {jqObject} field
		* @param {Array[String]} rules
		* @param {int} i rules index
		* @param {Map}
		*            user options
		* @return an error string if validation failed
		*/
		_equals: function(field, rules, i, options) {
			var equalsField = rules[i + 1];

			if (field.val() != $("#" + equalsField).val())
				return options.allrules.equals.alertText;
		},
		/**
		* Check the maximum size (in characters)
		*
		* @param {jqObject} field
		* @param {Array[String]} rules
		* @param {int} i rules index
		* @param {Map}
		*            user options
		* @return an error string if validation failed
		*/
		_maxSize: function(field, rules, i, options) {
			var max = rules[i + 1];
			var len = field.val().length;

			if (len > max) {
				var rule = options.allrules.maxSize;
				return rule.alertText + max + rule.alertText2;
			}
		},
		/**
		* Check the minimum size (in characters)
		*
		* @param {jqObject} field
		* @param {Array[String]} rules
		* @param {int} i rules index
		* @param {Map}
		*            user options
		* @return an error string if validation failed
		*/
		_minSize: function(field, rules, i, options) {
			var min = rules[i + 1];
			var len = field.val().length;

			if (len < min) {
				var rule = options.allrules.minSize;
				return rule.alertText + min + rule.alertText2;
			}
		},
		/**
		* Check number minimum value
		*
		* @param {jqObject} field
		* @param {Array[String]} rules
		* @param {int} i rules index
		* @param {Map}
		*            user options
		* @return an error string if validation failed
		*/
		_min: function(field, rules, i, options) {
			var min = parseFloat(rules[i + 1]);
			var len = parseFloat(field.val());

			if (len < min) {
				var rule = options.allrules.min;
				if (rule.alertText2) return rule.alertText + min + rule.alertText2;
				return rule.alertText + min;
			}
		},
		/**
		* Check number maximum value
		*
		* @param {jqObject} field
		* @param {Array[String]} rules
		* @param {int} i rules index
		* @param {Map}
		*            user options
		* @return an error string if validation failed
		*/
		_max: function(field, rules, i, options) {
			var max = parseFloat(rules[i + 1]);
			var len = parseFloat(field.val());

			if (len >max ) {
				var rule = options.allrules.max;
				if (rule.alertText2) return rule.alertText + max + rule.alertText2;
				//orefalo: to review, also do the translations
				return rule.alertText + max;
			}
		},
		/**
		* Checks date is in the past
		*
		* @param {jqObject} field
		* @param {Array[String]} rules
		* @param {int} i rules index
		* @param {Map}
		*            user options
		* @return an error string if validation failed
		*/
		_past: function(form, field, rules, i, options) {

			var p=rules[i + 1];
			var fieldAlt = $(form.find("*[name='" + p.replace(/^#+/, '') + "']"));
			var pdate;

			if (p.toLowerCase() == "now") {
				pdate = new Date();
			} else if (undefined != fieldAlt.val()) {
				if (fieldAlt.is(":disabled"))
					return;
				pdate = methods._parseDate(fieldAlt.val());
			} else {
				pdate = methods._parseDate(p);
			}
			var vdate = methods._parseDate(field.val());

			if (vdate > pdate ) {
				var rule = options.allrules.past;
				if (rule.alertText2) return rule.alertText + methods._dateToString(pdate) + rule.alertText2;
				return rule.alertText + methods._dateToString(pdate);
			}
		},
		/**
		* Checks date is in the future
		*
		* @param {jqObject} field
		* @param {Array[String]} rules
		* @param {int} i rules index
		* @param {Map}
		*            user options
		* @return an error string if validation failed
		*/
		_future: function(form, field, rules, i, options) {

			var p=rules[i + 1];
			var fieldAlt = $(form.find("*[name='" + p.replace(/^#+/, '') + "']"));
			var pdate;

			if (p.toLowerCase() == "now") {
				pdate = new Date();
			} else if (undefined != fieldAlt.val()) {
				if (fieldAlt.is(":disabled"))
					return;
				pdate = methods._parseDate(fieldAlt.val());
			} else {
				pdate = methods._parseDate(p);
			}
			var vdate = methods._parseDate(field.val());

			if (vdate < pdate ) {
				var rule = options.allrules.future;
				if (rule.alertText2)
					return rule.alertText + methods._dateToString(pdate) + rule.alertText2;
				return rule.alertText + methods._dateToString(pdate);
			}
		},
		/**
		* Checks if valid date
		*
		* @param {string} date string
		* @return a bool based on determination of valid date
		*/
		_isDate: function (value) {
			var dateRegEx = new RegExp(/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(?:(?:0?[1-9]|1[0-2])(\/|-)(?:0?[1-9]|1\d|2[0-8]))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(0?2(\/|-)29)(\/|-)(?:(?:0[48]00|[13579][26]00|[2468][048]00)|(?:\d\d)?(?:0[48]|[2468][048]|[13579][26]))$/);
			return dateRegEx.test(value);
		},
		/**
		* Checks if valid date time
		*
		* @param {string} date string
		* @return a bool based on determination of valid date time
		*/
		_isDateTime: function (value){
			var dateTimeRegEx = new RegExp(/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1}$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^((1[012]|0?[1-9]){1}\/(0?[1-9]|[12][0-9]|3[01]){1}\/\d{2,4}\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1})$/);
			return dateTimeRegEx.test(value);
		},
		//Checks if the start date is before the end date
		//returns true if end is later than start
		_dateCompare: function (start, end) {
			return (new Date(start.toString()) < new Date(end.toString()));
		},
		/**
		* Checks date range
		*
		* @param {jqObject} first field name
		* @param {jqObject} second field name
		* @return an error string if validation failed
		*/
		_dateRange: function (field, rules, i, options) {
			//are not both populated
			if ((!options.firstOfGroup[0].value && options.secondOfGroup[0].value) || (options.firstOfGroup[0].value && !options.secondOfGroup[0].value)) {
				return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;
			}

			//are not both dates
			if (!methods._isDate(options.firstOfGroup[0].value) || !methods._isDate(options.secondOfGroup[0].value)) {
				return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;
			}

			//are both dates but range is off
			if (!methods._dateCompare(options.firstOfGroup[0].value, options.secondOfGroup[0].value)) {
				return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;
			}
		},
		/**
		* Checks date time range
		*
		* @param {jqObject} first field name
		* @param {jqObject} second field name
		* @return an error string if validation failed
		*/
		_dateTimeRange: function (field, rules, i, options) {
			//are not both populated
			if ((!options.firstOfGroup[0].value && options.secondOfGroup[0].value) || (options.firstOfGroup[0].value && !options.secondOfGroup[0].value)) {
				return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;
			}
			//are not both dates
			if (!methods._isDateTime(options.firstOfGroup[0].value) || !methods._isDateTime(options.secondOfGroup[0].value)) {
				return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;
			}
			//are both dates but range is off
			if (!methods._dateCompare(options.firstOfGroup[0].value, options.secondOfGroup[0].value)) {
				return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;
			}
		},
		/**
		* Max number of checkbox selected
		*
		* @param {jqObject} field
		* @param {Array[String]} rules
		* @param {int} i rules index
		* @param {Map}
		*            user options
		* @return an error string if validation failed
		*/
		_maxCheckbox: function(form, field, rules, i, options) {

			var nbCheck = rules[i + 1];
			var groupname = field.attr("name");
			var groupSize = form.find("input[name='" + groupname + "']:checked").length;
			if (groupSize > nbCheck) {
				options.showArrow = false;
				if (options.allrules.maxCheckbox.alertText2)
					 return options.allrules.maxCheckbox.alertText + " " + nbCheck + " " + options.allrules.maxCheckbox.alertText2;
				return options.allrules.maxCheckbox.alertText;
			}
		},
		/**
		* Min number of checkbox selected
		*
		* @param {jqObject} field
		* @param {Array[String]} rules
		* @param {int} i rules index
		* @param {Map}
		*            user options
		* @return an error string if validation failed
		*/
		_minCheckbox: function(form, field, rules, i, options) {

			var nbCheck = rules[i + 1];
			var groupname = field.attr("name");
			var groupSize = form.find("input[name='" + groupname + "']:checked").length;
			if (groupSize < nbCheck) {
				options.showArrow = false;
				return options.allrules.minCheckbox.alertText + " " + nbCheck + " " + options.allrules.minCheckbox.alertText2;
			}
		},
		/**
		* Checks that it is a valid credit card number according to the
		* Luhn checksum algorithm.
		*
		* @param {jqObject} field
		* @param {Array[String]} rules
		* @param {int} i rules index
		* @param {Map}
		*            user options
		* @return an error string if validation failed
		*/
		_creditCard: function(field, rules, i, options) {
			//spaces and dashes may be valid characters, but must be stripped to calculate the checksum.
			var valid = false, cardNumber = field.val().replace(/ +/g, '').replace(/-+/g, '');

			var numDigits = cardNumber.length;
			if (numDigits >= 14 && numDigits <= 16 && parseInt(cardNumber) > 0) {

				var sum = 0, i = numDigits - 1, pos = 1, digit, luhn = new String();
				do {
					digit = parseInt(cardNumber.charAt(i));
					luhn += (pos++ % 2 == 0) ? digit * 2 : digit;
				} while (--i >= 0)

				for (i = 0; i < luhn.length; i++) {
					sum += parseInt(luhn.charAt(i));
				}
				valid = sum % 10 == 0;
			}
			if (!valid) return options.allrules.creditCard.alertText;
		},
		/**
		* Ajax field validation
		*
		* @param {jqObject} field
		* @param {Array[String]} rules
		* @param {int} i rules index
		* @param {Map}
		*            user options
		* @return nothing! the ajax validator handles the prompts itself
		*/
		 _ajax: function(field, rules, i, options) {

			 var errorSelector = rules[i + 1];
			 var rule = options.allrules[errorSelector];
			 var extraData = rule.extraData;
			 var extraDataDynamic = rule.extraDataDynamic;
			 var data = {
				"fieldId" : field.attr("id"),
				"fieldValue" : field.val()
			 };

			 if (typeof extraData === "object") {
				$.extend(data, extraData);
			 } else if (typeof extraData === "string") {
				var tempData = extraData.split("&");
				for(var i = 0; i < tempData.length; i++) {
					var values = tempData[i].split("=");
					if (values[0] && values[0]) {
						data[values[0]] = values[1];
					}
				}
			 }

			 if (extraDataDynamic) {
				 var tmpData = [];
				 var domIds = String(extraDataDynamic).split(",");
				 for (var i = 0; i < domIds.length; i++) {
					 var id = domIds[i];
					 if ($(id).length) {
						 var inputValue = field.closest("form, .validationEngineContainer").find(id).val();
						 var keyValue = id.replace('#', '') + '=' + escape(inputValue);
						 data[id.replace('#', '')] = inputValue;
					 }
				 }
			 }

			 // If a field change event triggered this we want to clear the cache for this ID
			 if (options.eventTrigger == "field") {
				delete(options.ajaxValidCache[field.attr("id")]);
			 }

			 // If there is an error or if the the field is already validated, do not re-execute AJAX
			 if (!options.isError && !methods._checkAjaxFieldStatus(field.attr("id"), options)) {
				 $.ajax({
					 type: options.ajaxFormValidationMethod,
					 url: rule.url,
					 cache: false,
					 dataType: "json",
					 data: data,
					 field: field,
					 rule: rule,
					 methods: methods,
					 options: options,
					 beforeSend: function() {},
					 error: function(data, transport) {
						if (options.onFailure) {
							options.onFailure(data, transport);
						} else {
							methods._ajaxError(data, transport);
						}
					 },
					 success: function(json) {

						 // asynchronously called on success, data is the json answer from the server
						 var errorFieldId = json[0];
						 //var errorField = $($("#" + errorFieldId)[0]);
						 var errorField = $("#"+ errorFieldId).eq(0);

						 // make sure we found the element
						 if (errorField.length == 1) {
							 var status = json[1];
							 // read the optional msg from the server
							 var msg = json[2];
							 if (!status) {
								 // Houston we got a problem - display an red prompt
								 options.ajaxValidCache[errorFieldId] = false;
								 options.isError = true;

								 // resolve the msg prompt
								 if(msg) {
									 if (options.allrules[msg]) {
										 var txt = options.allrules[msg].alertText;
										 if (txt) {
											msg = txt;
							}
									 }
								 }
								 else
									msg = rule.alertText;

								 if (options.showPrompts) methods._showPrompt(errorField, msg, "", true, options);
							 } else {
								 options.ajaxValidCache[errorFieldId] = true;

								 // resolves the msg prompt
								 if(msg) {
									 if (options.allrules[msg]) {
										 var txt = options.allrules[msg].alertTextOk;
										 if (txt) {
											msg = txt;
							}
									 }
								 }
								 else
								 msg = rule.alertTextOk;

								 if (options.showPrompts) {
									 // see if we should display a green prompt
									 if (msg)
										methods._showPrompt(errorField, msg, "pass", true, options);
									 else
										methods._closePrompt(errorField);
								}

								 // If a submit form triggered this, we want to re-submit the form
								 if (options.eventTrigger == "submit")
									field.closest("form").submit();
							 }
						 }
						 errorField.trigger("jqv.field.result", [errorField, options.isError, msg]);
					 }
				 });

				 return rule.alertTextLoad;
			 }
		 },
		/**
		* Common method to handle ajax errors
		*
		* @param {Object} data
		* @param {Object} transport
		*/
		_ajaxError: function(data, transport) {
			if(data.status == 0 && transport == null)
				alert("The page is not served from a server! ajax call failed");
			else if(typeof console != "undefined")
				console.log("Ajax error: " + data.status + " " + transport);
		},
		/**
		* date -> string
		*
		* @param {Object} date
		*/
		_dateToString: function(date) {
			return date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
		},
		/**
		* Parses an ISO date
		* @param {String} d
		*/
		_parseDate: function(d) {

			var dateParts = d.split("-");
			if(dateParts==d)
				dateParts = d.split("/");
			if(dateParts==d) {
				dateParts = d.split(".");
				return new Date(dateParts[2], (dateParts[1] - 1), dateParts[0]);
			}
			return new Date(dateParts[0], (dateParts[1] - 1) ,dateParts[2]);
		},
		/**
		* Builds or updates a prompt with the given information
		*
		* @param {jqObject} field
		* @param {String} promptText html text to display type
		* @param {String} type the type of bubble: 'pass' (green), 'load' (black) anything else (red)
		* @param {boolean} ajaxed - use to mark fields than being validated with ajax
		* @param {Map} options user options
		*/
		 _showPrompt: function(field, promptText, type, ajaxed, options, ajaxform) {
		 	//Check if we need to adjust what element to show the prompt on
			if(field.data('jqv-prompt-at') instanceof jQuery ){
				field = field.data('jqv-prompt-at');
			} else if(field.data('jqv-prompt-at')) {
				field = $(field.data('jqv-prompt-at'));
			}

			 var prompt = methods._getPrompt(field);
			 // The ajax submit errors are not see has an error in the form,
			 // When the form errors are returned, the engine see 2 bubbles, but those are ebing closed by the engine at the same time
			 // Because no error was found befor submitting
			 if(ajaxform) prompt = false;
			 // Check that there is indded text
			 if($.trim(promptText)){
				 if (prompt)
					methods._updatePrompt(field, prompt, promptText, type, ajaxed, options);
				 else
					methods._buildPrompt(field, promptText, type, ajaxed, options);
			}
		 },
		/**
		* Builds and shades a prompt for the given field.
		*
		* @param {jqObject} field
		* @param {String} promptText html text to display type
		* @param {String} type the type of bubble: 'pass' (green), 'load' (black) anything else (red)
		* @param {boolean} ajaxed - use to mark fields than being validated with ajax
		* @param {Map} options user options
		*/
		_buildPrompt: function(field, promptText, type, ajaxed, options) {

			// create the prompt
			var prompt = $('<div>');
			prompt.addClass(methods._getClassName(field.attr("id")) + "formError");
			// add a class name to identify the parent form of the prompt
			prompt.addClass("parentForm"+methods._getClassName(field.closest('form, .validationEngineContainer').attr("id")));
			prompt.addClass("formError");

			switch (type) {
				case "pass":
					prompt.addClass("greenPopup");
					break;
				case "load":
					prompt.addClass("blackPopup");
					break;
				default:
					/* it has error  */
					//alert("unknown popup type:"+type);
			}
			if (ajaxed)
				prompt.addClass("ajaxed");

			// create the prompt content
			var promptContent = $('<div>').addClass("formErrorContent").html(promptText).appendTo(prompt);

			// determine position type
			var positionType=field.data("promptPosition") || options.promptPosition;

			// create the css arrow pointing at the field
			// note that there is no triangle on max-checkbox and radio
			if (options.showArrow) {
				var arrow = $('<div>').addClass("formErrorArrow");

				//prompt positioning adjustment support. Usage: positionType:Xshift,Yshift (for ex.: bottomLeft:+20 or bottomLeft:-20,+10)
				if (typeof(positionType)=='string')
				{
					var pos=positionType.indexOf(":");
					if(pos!=-1)
						positionType=positionType.substring(0,pos);
				}

				switch (positionType) {
					case "bottomLeft":
					case "bottomRight":
						prompt.find(".formErrorContent").before(arrow);
						arrow.addClass("formErrorArrowBottom").html('<div class="line1"><!-- --></div><div class="line2"><!-- --></div><div class="line3"><!-- --></div><div class="line4"><!-- --></div><div class="line5"><!-- --></div><div class="line6"><!-- --></div><div class="line7"><!-- --></div><div class="line8"><!-- --></div><div class="line9"><!-- --></div><div class="line10"><!-- --></div>');
						break;
					case "topLeft":
					case "topRight":
						arrow.html('<div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div>');
						prompt.append(arrow);
						break;
				}
			}
			// Add custom prompt class
			if (options.addPromptClass)
				prompt.addClass(options.addPromptClass);

            // Add custom prompt class defined in element
            var requiredOverride = field.attr('data-required-class');
            if(requiredOverride !== undefined) {
                prompt.addClass(requiredOverride);
            } else {
                if(options.prettySelect) {
                    if($('#' + field.attr('id')).next().is('select')) {
                        var prettyOverrideClass = $('#' + field.attr('id').substr(options.usePrefix.length).substring(options.useSuffix.length)).attr('data-required-class');
                        if(prettyOverrideClass !== undefined) {
                            prompt.addClass(prettyOverrideClass);
                        }
                    }
                }
            }

			prompt.css({
				"opacity": 0
			});
			if(positionType === 'inline') {
				prompt.addClass("inline");
				if(typeof field.attr('data-prompt-target') !== 'undefined' && $('#'+field.attr('data-prompt-target')).length > 0) {
					prompt.appendTo($('#'+field.attr('data-prompt-target')));
				} else {
					field.after(prompt);
				}
			} else {
				field.before(prompt);
			}

			var pos = methods._calculatePosition(field, prompt, options);
			// Support RTL layouts by @yasser_lotfy ( Yasser Lotfy )
			if ($('body').hasClass('rtl')) {
				prompt.css({
					'position': positionType === 'inline' ? 'relative' : 'absolute',
					"top": pos.callerTopPosition,
					"left": "initial",
					"right": pos.callerleftPosition,
					"marginTop": pos.marginTopSize,
					"opacity": 0
				}).data("callerField", field);
		    	} else {
				prompt.css({
					'position': positionType === 'inline' ? 'relative' : 'absolute',
					"top": pos.callerTopPosition,
					"left": pos.callerleftPosition,
					"right": "initial",
					"marginTop": pos.marginTopSize,
					"opacity": 0
				}).data("callerField", field);
		    	}


			if (options.autoHidePrompt) {
				setTimeout(function(){
					prompt.animate({
						"opacity": 0
					},function(){
						prompt.closest('.formError').remove();
					});
				}, options.autoHideDelay);
			}
			return prompt.animate({
				"opacity": 0.87
			});
		},
		/**
		* Updates the prompt text field - the field for which the prompt
		* @param {jqObject} field
		* @param {String} promptText html text to display type
		* @param {String} type the type of bubble: 'pass' (green), 'load' (black) anything else (red)
		* @param {boolean} ajaxed - use to mark fields than being validated with ajax
		* @param {Map} options user options
		*/
		_updatePrompt: function(field, prompt, promptText, type, ajaxed, options, noAnimation) {

			if (prompt) {
				if (typeof type !== "undefined") {
					if (type == "pass")
						prompt.addClass("greenPopup");
					else
						prompt.removeClass("greenPopup");

					if (type == "load")
						prompt.addClass("blackPopup");
					else
						prompt.removeClass("blackPopup");
				}
				if (ajaxed)
					prompt.addClass("ajaxed");
				else
					prompt.removeClass("ajaxed");

				prompt.find(".formErrorContent").html(promptText);

				var pos = methods._calculatePosition(field, prompt, options);
				// Support RTL layouts by @yasser_lotfy ( Yasser Lotfy )
				if ($('body').hasClass('rtl')) {
					var css = {"top": pos.callerTopPosition,
					"left": "initial",
					"right": pos.callerleftPosition,
					"marginTop": pos.marginTopSize,
					"opacity": 0.87};
				} else {
					var css = {"top": pos.callerTopPosition,
					"left": pos.callerleftPosition,
					"right": "initial",
					"marginTop": pos.marginTopSize,
					"opacity": 0.87};
				}

                prompt.css({
                    "opacity": 0,
                    "display": "block"
                });

				if (noAnimation)
					prompt.css(css);
				else
					prompt.animate(css);
			}
		},
		/**
		* Closes the prompt associated with the given field
		*
		* @param {jqObject}
		*            field
		*/
		 _closePrompt: function(field) {
			 var prompt = methods._getPrompt(field);
			 if (prompt)
				 prompt.fadeTo("fast", 0, function() {
					 prompt.closest('.formError').remove();
				 });
		 },
		 closePrompt: function(field) {
			 return methods._closePrompt(field);
		 },
		/**
		* Returns the error prompt matching the field if any
		*
		* @param {jqObject}
		*            field
		* @return undefined or the error prompt (jqObject)
		*/
		_getPrompt: function(field) {
				var formId = $(field).closest('form, .validationEngineContainer').attr('id');
			var className = methods._getClassName(field.attr("id")) + "formError";
				var match = $("." + methods._escapeExpression(className) + '.parentForm' + methods._getClassName(formId))[0];
			if (match)
			return $(match);
		},
		/**
		  * Returns the escapade classname
		  *
		  * @param {selector}
		  *            className
		  */
		  _escapeExpression: function (selector) {
			  return selector.replace(/([#;&,\.\+\*\~':"\!\^$\[\]\(\)=>\|])/g, "\\$1");
		  },
		/**
		 * returns true if we are in a RTLed document
		 *
		 * @param {jqObject} field
		 */
		isRTL: function(field)
		{
			var $document = $(document);
			var $body = $('body');
			var rtl =
				(field && field.hasClass('rtl')) ||
				(field && (field.attr('dir') || '').toLowerCase()==='rtl') ||
				$document.hasClass('rtl') ||
				($document.attr('dir') || '').toLowerCase()==='rtl' ||
				$body.hasClass('rtl') ||
				($body.attr('dir') || '').toLowerCase()==='rtl';
			return Boolean(rtl);
		},
		/**
		* Calculates prompt position
		*
		* @param {jqObject}
		*            field
		* @param {jqObject}
		*            the prompt
		* @param {Map}
		*            options
		* @return positions
		*/
		_calculatePosition: function (field, promptElmt, options) {

			var promptTopPosition, promptleftPosition, marginTopSize;
			var fieldWidth 	= field.width();
			var fieldLeft 	= field.position().left;
			var fieldTop 	=  field.position().top;
			var fieldHeight 	=  field.height();
			var promptHeight = promptElmt.height();


			// is the form contained in an overflown container?
			promptTopPosition = promptleftPosition = 0;
			// compensation for the arrow
			marginTopSize = -promptHeight;


			//prompt positioning adjustment support
			//now you can adjust prompt position
			//usage: positionType:Xshift,Yshift
			//for example:
			//   bottomLeft:+20 means bottomLeft position shifted by 20 pixels right horizontally
			//   topRight:20, -15 means topRight position shifted by 20 pixels to right and 15 pixels to top
			//You can use +pixels, - pixels. If no sign is provided than + is default.
			var positionType=field.data("promptPosition") || options.promptPosition;
			var shift1="";
			var shift2="";
			var shiftX=0;
			var shiftY=0;
			if (typeof(positionType)=='string') {
				//do we have any position adjustments ?
				if (positionType.indexOf(":")!=-1) {
					shift1=positionType.substring(positionType.indexOf(":")+1);
					positionType=positionType.substring(0,positionType.indexOf(":"));

					//if any advanced positioning will be needed (percents or something else) - parser should be added here
					//for now we use simple parseInt()

					//do we have second parameter?
					if (shift1.indexOf(",") !=-1) {
						shift2=shift1.substring(shift1.indexOf(",") +1);
						shift1=shift1.substring(0,shift1.indexOf(","));
						shiftY=parseInt(shift2);
						if (isNaN(shiftY)) shiftY=0;
					};

					shiftX=parseInt(shift1);
					if (isNaN(shift1)) shift1=0;

				};
			};


			switch (positionType) {
				default:
				case "topRight":
					promptleftPosition +=  fieldLeft + fieldWidth - 27;
					promptTopPosition +=  fieldTop;
					break;

				case "topLeft":
					promptTopPosition +=  fieldTop;
					promptleftPosition += fieldLeft;
					break;

				case "centerRight":
					promptTopPosition = fieldTop+4;
					marginTopSize = 0;
					promptleftPosition= fieldLeft + field.outerWidth(true)+5;
					break;
				case "centerLeft":
					promptleftPosition = fieldLeft - (promptElmt.width() + 2);
					promptTopPosition = fieldTop+4;
					marginTopSize = 0;

					break;

				case "bottomLeft":
					promptTopPosition = fieldTop + field.height() + 5;
					marginTopSize = 0;
					promptleftPosition = fieldLeft;
					break;
				case "bottomRight":
					promptleftPosition = fieldLeft + fieldWidth - 27;
					promptTopPosition =  fieldTop +  field.height() + 5;
					marginTopSize = 0;
					break;
				case "inline":
					promptleftPosition = 0;
					promptTopPosition = 0;
					marginTopSize = 0;
			};



			//apply adjusments if any
			promptleftPosition += shiftX;
			promptTopPosition  += shiftY;

			return {
				"callerTopPosition": promptTopPosition + "px",
				"callerleftPosition": promptleftPosition + "px",
				"marginTopSize": marginTopSize + "px"
			};
		},
		/**
		* Saves the user options and variables in the form.data
		*
		* @param {jqObject}
		*            form - the form where the user option should be saved
		* @param {Map}
		*            options - the user options
		* @return the user options (extended from the defaults)
		*/
		 _saveOptions: function(form, options) {

			 // is there a language localisation ?
			 if ($.validationEngineLanguage)
			 var allRules = $.validationEngineLanguage.allRules;
			 else
			 $.error("jQuery.validationEngine rules are not loaded, plz add localization files to the page");
			 // --- Internals DO NOT TOUCH or OVERLOAD ---
			 // validation rules and i18
			 $.validationEngine.defaults.allrules = allRules;

			 var userOptions = $.extend(true,{},$.validationEngine.defaults,options);

			 form.data('jqv', userOptions);
			 return userOptions;
		 },

		 /**
		 * Removes forbidden characters from class name
		 * @param {String} className
		 */
		 _getClassName: function(className) {
			 if(className)
				 return className.replace(/:/g, "_").replace(/\./g, "_");
					  },
		/**
		 * Escape special character for jQuery selector
		 * http://totaldev.com/content/escaping-characters-get-valid-jquery-id
		 * @param {String} selector
		 */
		 _jqSelector: function(str){
			return str.replace(/([;&,\.\+\*\~':"\!\^#$%@\[\]\(\)=>\|])/g, '\\$1');
		},
		/**
		* Conditionally required field
		*
		* @param {jqObject} field
		* @param {Array[String]} rules
		* @param {int} i rules index
		* @param {Map}
		* user options
		* @return an error string if validation failed
		*/
		_condRequired: function(field, rules, i, options) {
			var idx, dependingField;

			for(idx = (i + 1); idx < rules.length; idx++) {
				dependingField = jQuery("#" + rules[idx]).first();

				/* Use _required for determining wether dependingField has a value.
				 * There is logic there for handling all field types, and default value; so we won't replicate that here
				 * Indicate this special use by setting the last parameter to true so we only validate the dependingField on chackboxes and radio buttons (#462)
				 */
				if (dependingField.length && methods._required(dependingField, ["required"], 0, options, true) == undefined) {
					/* We now know any of the depending fields has a value,
					 * so we can validate this field as per normal required code
					 */
					return methods._required(field, ["required"], 0, options);
				}
			}
		},

	    _submitButtonClick: function(event) {
	        var button = $(this);
	        var form = button.closest('form, .validationEngineContainer');
	        form.data("jqv_submitButton", button.attr("id"));
	    }
		  };

	 /**
	 * Plugin entry point.
	 * You may pass an action as a parameter or a list of options.
	 * if none, the init and attach methods are being called.
	 * Remember: if you pass options, the attached method is NOT called automatically
	 *
	 * @param {String}
	 *            method (optional) action
	 */
	 $.fn.validationEngine = function(method) {

		 var form = $(this);
		 if(!form[0]) return form;  // stop here if the form does not exist

		 if (typeof(method) == 'string' && method.charAt(0) != '_' && methods[method]) {

			 // make sure init is called once
			 if(method != "showPrompt" && method != "hide" && method != "hideAll")
			 methods.init.apply(form);

			 return methods[method].apply(form, Array.prototype.slice.call(arguments, 1));
		 } else if (typeof method == 'object' || !method) {

			 // default constructor with or without arguments
			 methods.init.apply(form, arguments);
			 return methods.attach.apply(form);
		 } else {
			 $.error('Method ' + method + ' does not exist in jQuery.validationEngine');
		 }
	};



	// LEAK GLOBAL OPTIONS
	$.validationEngine= {fieldIdCounter: 0,defaults:{

		// Name of the event triggering field validation
		validationEventTrigger: "blur",
		// Automatically scroll viewport to the first error
		scroll: true,
		// Focus on the first input
		focusFirstField:true,
		// Show prompts, set to false to disable prompts
		showPrompts: true,
		// Should we attempt to validate non-visible input fields contained in the form? (Useful in cases of tabbed containers, e.g. jQuery-UI tabs)
		validateNonVisibleFields: false,
		// ignore the validation for fields with this specific class (Useful in cases of tabbed containers AND hidden fields we don't want to validate)
		ignoreFieldsWithClass: 'ignoreMe',
		// Opening box position, possible locations are: topLeft,
		// topRight, bottomLeft, centerRight, bottomRight, inline
		// inline gets inserted after the validated field or into an element specified in data-prompt-target
		promptPosition: "topRight",
		bindMethod:"bind",
		// internal, automatically set to true when it parse a _ajax rule
		inlineAjax: false,
		// if set to true, the form data is sent asynchronously via ajax to the form.action url (get)
		ajaxFormValidation: false,
		// The url to send the submit ajax validation (default to action)
		ajaxFormValidationURL: false,
		// HTTP method used for ajax validation
		ajaxFormValidationMethod: 'get',
		// Ajax form validation callback method: boolean onComplete(form, status, errors, options)
		// retuns false if the form.submit event needs to be canceled.
		onAjaxFormComplete: $.noop,
		// called right before the ajax call, may return false to cancel
		onBeforeAjaxFormValidation: $.noop,
		// Stops form from submitting and execute function assiciated with it
		onValidationComplete: false,

		// Used when you have a form fields too close and the errors messages are on top of other disturbing viewing messages
		doNotShowAllErrosOnSubmit: false,
		// Object where you store custom messages to override the default error messages
		custom_error_messages:{},
		// true if you want to validate the input fields on blur event
		binded: true,
		// set to true if you want to validate the input fields on blur only if the field it's not empty
		notEmpty: false,
		// set to true, when the prompt arrow needs to be displayed
		showArrow: true,
		// set to false, determines if the prompt arrow should be displayed when validating
		// checkboxes and radio buttons
		showArrowOnRadioAndCheckbox: false,
		// did one of the validation fail ? kept global to stop further ajax validations
		isError: false,
		// Limit how many displayed errors a field can have
		maxErrorsPerField: false,

		// Caches field validation status, typically only bad status are created.
		// the array is used during ajax form validation to detect issues early and prevent an expensive submit
		ajaxValidCache: {},
		// Auto update prompt position after window resize
		autoPositionUpdate: false,

		InvalidFields: [],
		onFieldSuccess: false,
		onFieldFailure: false,
		onSuccess: false,
		onFailure: false,
		validateAttribute: "class",
		addSuccessCssClassToField: "",
		addFailureCssClassToField: "",

		// Auto-hide prompt
		autoHidePrompt: false,
		// Delay before auto-hide
		autoHideDelay: 10000,
		// Fade out duration while hiding the validations
		fadeDuration: 300,
	 // Use Prettify select library
	 prettySelect: false,
	 // Add css class on prompt
	 addPromptClass : "",
	 // Custom ID uses prefix
	 usePrefix: "",
	 // Custom ID uses suffix
	 useSuffix: "",
	 // Only show one message per error prompt
	 showOneMessage: false
	}};
	$(function(){$.validationEngine.defaults.promptPosition = methods.isRTL()?'topLeft':"topRight"});
})(jQuery);
(function($){
    $.fn.validationEngineLanguage = function(){
	};
    $.validationEngineLanguage = {
        newLang: function(){
            $.validationEngineLanguage.allRules = {
                "required": { // Add your regex rules here, you can take telephone as an example
                    "regex": "none",
                    "alertText": "* Необходимо заполнить",
                    "alertTextCheckboxMultiple": "* Вы должны выбрать вариант",
                    "alertTextCheckboxe": "* Необходимо отметить"
                },
                "requiredInFunction": { 
                    "func": function(field, rules, i, options){
                        return (field.val() == "test") ? true : false;
                    },
                    "alertText": "* Значением поля должно быть test"
                },
                "minSize": {
                    "regex": "none",
                    "alertText": "* Пароль должен состоять минимум из  ",
                    "alertText2": " символов"
                },
                "maxSize": {
                    "regex": "none",
                    "alertText": "* Максимум ",
                    "alertText2": " символа(ов)"
                },
                "groupRequired": {
                    "regex": "none",
                    "alertText": "* Вы должны заполнить одно из следующих полей"
                },
                "min": {
                    "regex": "none",
                    "alertText": "* Минимальное значение "
                },
                "max": {
                    "regex": "none",
                    "alertText": "* Максимальное значение "
                },
                "past": {
                    "regex": "none",
                    "alertText": "* Дата до "
                },
                "future": {
                    "regex": "none",
                    "alertText": "* Дата от "
                },	
                "maxCheckbox": {
                    "regex": "none",
                    "alertText": "* Нельзя выбрать столько вариантов"
                },
                "minCheckbox": {
                    "regex": "none",
                    "alertText": "* Пожалуйста, выберите ",
                    "alertText2": " опцию(ии)"
                },
                "equals": {
                    "regex": "none",
                    "alertText": "* Пароли не совпадают, повторите попытку!"
                },
                "creditCard": {
                    "regex": "none",
                    "alertText": "* Неверный номер кредитной карты"
                },
                "phone": {
                    // credit: jquery.h5validate.js / orefalo
                    "regex": /^([\+][0-9]{1,3}([ \.\-])?)?([\(][0-9]{1,6}[\)])?([0-9 \.\-]{1,32})(([A-Za-z \:]{1,11})?[0-9]{1,4}?)$/,
                    "alertText": "* Неправильный формат телефона"
                },
                "email": {
                    // Shamelessly lifted from Scott Gonzalez via the Bassistance Validation plugin http://projects.scottsplayground.com/email_address_validation/
                    "regex": /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i,
                    "alertText": "* Неверный формат email"
                },
                "integer": {
                    "regex": /^[\-\+]?\d+$/,
                    "alertText": "* Не целое число"
                },
                "number": {
                    // Number, including positive, negative, and floating decimal. credit: orefalo
                    "regex": /^[\-\+]?((([0-9]{1,3})([,][0-9]{3})*)|([0-9]+))?([\.]([0-9]+))?$/,
                    "alertText": "* Неправильное число с плавающей точкой"
                },
                "date": {
                    "regex": /^(0[1-9]|[12][0-9]|3[01])[ \.](0[1-9]|1[012])[ \.](19|20)\d{2}$/,
                    "alertText": "* Неправильная дата (должно быть в ДД.MM.ГГГГ формате)"
                },
                "dateUTF": {
                    "regex": /^(19|20)\d{2}[ \.-](0[1-9]|1[012])[ \.-](0[1-9]|[12][0-9]|3[01])$/,
                    "alertText": "* Неправильная дата (должно быть в ГГГГ.ММ.ДД формате)"
                },
                "datetime": {
                    "regex": /^(0[1-9]|[12][0-9]|3[01])[ \.-](0[1-9]|1[012])[ \.-](19|20)\d{2}[ \.-](([0,1][0-9])|(2[0-3])):[0-5][0-9]$/,
                    "alertText": "* Неправильная дата (должно быть в ДД.MM.ГГГГ ЧЧ:ММ формате)"
                },
                "time": {
                    "regex": /^(([0,1][0-9])|(2[0-3])):[0-5][0-9]$/,
                    "alertText": "* Неправильное время (должно быть в ЧЧ:ММ формате)"
                },
                "ipv4": {
                	"regex": /^((([01]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))[.]){3}(([0-1]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))$/,
                    "alertText": "* Неправильный IP-адрес"
                },
                "url": {
                    "regex": /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i,
                    "alertText": "* Неправильный URL"
                },
                "onlyNumberSp": {
                    "regex": /^[0-9\ ]+$/,
                    "alertText": "* Только числа"
                },
                "onlyLetterSp": {
                    "regex": /^[a-zA-Z\u0400-\u04FF\ \']+$/,
                    "alertText": "* Только буквы"
                },
                "onlyLetterNumber": {
                    "regex": /^[0-9a-zA-Z\u0400-\u04FF]+$/,
                    "alertText": "* Запрещены специальные символы"
                },
                // --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
                "ajaxUserCall": {
                    "url": "ajaxValidateFieldUser",
                    // you may want to pass extra data on the ajax call
                    "extraData": "name=eric",
                    "alertText": "* Этот пользователь уже занят",
                    "alertTextLoad": "* Проверка, подождите..."
                },
                "ajaxNameCall": {
                    // remote json service location 
                    "url": "ajaxValidateFieldName",
                    // error
                    "alertText": "* Это имя уже занято",
                    // if you provide an "alertTextOk", it will show as a green prompt when the field validates
                    "alertTextOk": "* Это имя доступно",
                    // speaks by itself
                    "alertTextLoad": "* Проверка, подождите..."
                },
                "validate2fields": {
                    "alertText": "* Пожалуйста, введите HELLO"
                }
            };
            
        }
    };
    $.validationEngineLanguage.newLang();
})(jQuery);
/*
    jQuery Masked Input Plugin
    Copyright (c) 2007 - 2015 Josh Bush (digitalbush.com)
    Licensed under the MIT license (http://digitalbush.com/projects/masked-input-plugin/#license)
    Version: 1.4.1
*/
!function(factory) {
    "function" == typeof define && define.amd ? define([ "jquery" ], factory) : factory("object" == typeof exports ? require("jquery") : jQuery);
}(function($) {
    var caretTimeoutId, ua = navigator.userAgent, iPhone = /iphone/i.test(ua), chrome = /chrome/i.test(ua), android = /android/i.test(ua);
    $.mask = {
        definitions: {
            "9": "[0-9]",
            a: "[A-Za-z]",
            "*": "[A-Za-z0-9]"
        },
        autoclear: !0,
        dataName: "rawMaskFn",
        placeholder: "_"
    }, $.fn.extend({
        caret: function(begin, end) {
            var range;
            if (0 !== this.length && !this.is(":hidden")) return "number" == typeof begin ? (end = "number" == typeof end ? end : begin, 
            this.each(function() {
                this.setSelectionRange ? this.setSelectionRange(begin, end) : this.createTextRange && (range = this.createTextRange(), 
                range.collapse(!0), range.moveEnd("character", end), range.moveStart("character", begin), 
                range.select());
            })) : (this[0].setSelectionRange ? (begin = this[0].selectionStart, end = this[0].selectionEnd) : document.selection && document.selection.createRange && (range = document.selection.createRange(), 
            begin = 0 - range.duplicate().moveStart("character", -1e5), end = begin + range.text.length), 
            {
                begin: begin,
                end: end
            });
        },
        unmask: function() {
            return this.trigger("unmask");
        },
        mask: function(mask, settings) {
            var input, defs, tests, partialPosition, firstNonMaskPos, lastRequiredNonMaskPos, len, oldVal;
            if (!mask && this.length > 0) {
                input = $(this[0]);
                var fn = input.data($.mask.dataName);
                return fn ? fn() : void 0;
            }
            return settings = $.extend({
                autoclear: $.mask.autoclear,
                placeholder: $.mask.placeholder,
                completed: null
            }, settings), defs = $.mask.definitions, tests = [], partialPosition = len = mask.length, 
            firstNonMaskPos = null, $.each(mask.split(""), function(i, c) {
                "?" == c ? (len--, partialPosition = i) : defs[c] ? (tests.push(new RegExp(defs[c])), 
                null === firstNonMaskPos && (firstNonMaskPos = tests.length - 1), partialPosition > i && (lastRequiredNonMaskPos = tests.length - 1)) : tests.push(null);
            }), this.trigger("unmask").each(function() {
                function tryFireCompleted() {
                    if (settings.completed) {
                        for (var i = firstNonMaskPos; lastRequiredNonMaskPos >= i; i++) if (tests[i] && buffer[i] === getPlaceholder(i)) return;
                        settings.completed.call(input);
                    }
                }
                function getPlaceholder(i) {
                    return settings.placeholder.charAt(i < settings.placeholder.length ? i : 0);
                }
                function seekNext(pos) {
                    for (;++pos < len && !tests[pos]; ) ;
                    return pos;
                }
                function seekPrev(pos) {
                    for (;--pos >= 0 && !tests[pos]; ) ;
                    return pos;
                }
                function shiftL(begin, end) {
                    var i, j;
                    if (!(0 > begin)) {
                        for (i = begin, j = seekNext(end); len > i; i++) if (tests[i]) {
                            if (!(len > j && tests[i].test(buffer[j]))) break;
                            buffer[i] = buffer[j], buffer[j] = getPlaceholder(j), j = seekNext(j);
                        }
                        writeBuffer(), input.caret(Math.max(firstNonMaskPos, begin));
                    }
                }
                function shiftR(pos) {
                    var i, c, j, t;
                    for (i = pos, c = getPlaceholder(pos); len > i; i++) if (tests[i]) {
                        if (j = seekNext(i), t = buffer[i], buffer[i] = c, !(len > j && tests[j].test(t))) break;
                        c = t;
                    }
                }
                function androidInputEvent() {
                    var curVal = input.val(), pos = input.caret();
                    if (oldVal && oldVal.length && oldVal.length > curVal.length) {
                        for (checkVal(!0); pos.begin > 0 && !tests[pos.begin - 1]; ) pos.begin--;
                        if (0 === pos.begin) for (;pos.begin < firstNonMaskPos && !tests[pos.begin]; ) pos.begin++;
                        input.caret(pos.begin, pos.begin);
                    } else {
                        for (checkVal(!0); pos.begin < len && !tests[pos.begin]; ) pos.begin++;
                        input.caret(pos.begin, pos.begin);
                    }
                    tryFireCompleted();
                }
                function blurEvent() {
                    checkVal(), input.val() != focusText && input.change();
                }
                function keydownEvent(e) {
                    if (!input.prop("readonly")) {
                        var pos, begin, end, k = e.which || e.keyCode;
                        oldVal = input.val(), 8 === k || 46 === k || iPhone && 127 === k ? (pos = input.caret(), 
                        begin = pos.begin, end = pos.end, end - begin === 0 && (begin = 46 !== k ? seekPrev(begin) : end = seekNext(begin - 1), 
                        end = 46 === k ? seekNext(end) : end), clearBuffer(begin, end), shiftL(begin, end - 1), 
                        e.preventDefault()) : 13 === k ? blurEvent.call(this, e) : 27 === k && (input.val(focusText), 
                        input.caret(0, checkVal()), e.preventDefault());
                    }
                }
                function keypressEvent(e) {
                    if (!input.prop("readonly")) {
                        var p, c, next, k = e.which || e.keyCode, pos = input.caret();
                        if (!(e.ctrlKey || e.altKey || e.metaKey || 32 > k) && k && 13 !== k) {
                            if (pos.end - pos.begin !== 0 && (clearBuffer(pos.begin, pos.end), shiftL(pos.begin, pos.end - 1)), 
                            p = seekNext(pos.begin - 1), len > p && (c = String.fromCharCode(k), tests[p].test(c))) {
                                if (shiftR(p), buffer[p] = c, writeBuffer(), next = seekNext(p), android) {
                                    var proxy = function() {
                                        $.proxy($.fn.caret, input, next)();
                                    };
                                    setTimeout(proxy, 0);
                                } else input.caret(next);
                                pos.begin <= lastRequiredNonMaskPos && tryFireCompleted();
                            }
                            e.preventDefault();
                        }
                    }
                }
                function clearBuffer(start, end) {
                    var i;
                    for (i = start; end > i && len > i; i++) tests[i] && (buffer[i] = getPlaceholder(i));
                }
                function writeBuffer() {
                    input.val(buffer.join(""));
                }
                function checkVal(allow) {
                    var i, c, pos, test = input.val(), lastMatch = -1;
                    for (i = 0, pos = 0; len > i; i++) if (tests[i]) {
                        for (buffer[i] = getPlaceholder(i); pos++ < test.length; ) if (c = test.charAt(pos - 1), 
                        tests[i].test(c)) {
                            buffer[i] = c, lastMatch = i;
                            break;
                        }
                        if (pos > test.length) {
                            clearBuffer(i + 1, len);
                            break;
                        }
                    } else buffer[i] === test.charAt(pos) && pos++, partialPosition > i && (lastMatch = i);
                    return allow ? writeBuffer() : partialPosition > lastMatch + 1 ? settings.autoclear || buffer.join("") === defaultBuffer ? (input.val() && input.val(""), 
                    clearBuffer(0, len)) : writeBuffer() : (writeBuffer(), input.val(input.val().substring(0, lastMatch + 1))), 
                    partialPosition ? i : firstNonMaskPos;
                }
                var input = $(this), buffer = $.map(mask.split(""), function(c, i) {
                    return "?" != c ? defs[c] ? getPlaceholder(i) : c : void 0;
                }), defaultBuffer = buffer.join(""), focusText = input.val();
                input.data($.mask.dataName, function() {
                    return $.map(buffer, function(c, i) {
                        return tests[i] && c != getPlaceholder(i) ? c : null;
                    }).join("");
                }), input.one("unmask", function() {
                    input.off(".mask").removeData($.mask.dataName);
                }).on("focus.mask", function() {
                    if (!input.prop("readonly")) {
                        clearTimeout(caretTimeoutId);
                        var pos;
                        focusText = input.val(), pos = checkVal(), caretTimeoutId = setTimeout(function() {
                            input.get(0) === document.activeElement && (writeBuffer(), pos == mask.replace("?", "").length ? input.caret(0, pos) : input.caret(pos));
                        }, 10);
                    }
                }).on("blur.mask", blurEvent).on("keydown.mask", keydownEvent).on("keypress.mask", keypressEvent).on("input.mask paste.mask", function() {
                    input.prop("readonly") || setTimeout(function() {
                        var pos = checkVal(!0);
                        input.caret(pos), tryFireCompleted();
                    }, 0);
                }), chrome && android && input.off("input.mask").on("input.mask", androidInputEvent), 
                checkVal();
            });
        }
    });
});
/* 
 * Author: @senthil2rajan
 * plugin: timepicker
 * website: senthilraj.github.io/Timepicki
 */
(function($) {

	$.fn.timepicki = function(options) {

		var defaults = {
			format_output: function(tim, mini, meri) {
			    if (settings.show_meridian) {
                    // limit hours between 1 and 12 - inculsive.
			        tim = Math.min(Math.max(parseInt(tim), 1), 12);
			        if (tim < 10)
			            tim = "0" + tim;

			        
			        mini = Math.min(Math.max(parseInt(mini), 0), 59);
			        if (mini < 10)
			            mini = "0" + mini;

					return tim + ":" + mini + " " + meri;
			    } else {

			        // limit hours between 0 and 23 - inculsive.
			        tim = Math.min(Math.max(parseInt(tim), 0), 23);

			        if (tim < 10)
			            tim = "0" + tim;


			        mini = Math.min(Math.max(parseInt(mini), 0), 59);
			        if (mini < 10)
			            mini = "0" + mini;

			        mini = Math.min(Math.max(parseInt(mini), 0), 59);

					return tim + ":" + mini;
				}
			},
			increase_direction: 'up',
			custom_classes: '',
			min_hour_value: 1,
			max_hour_value: 12,
			show_meridian: true,
			step_size_hours: '1',
			step_size_minutes: '1',
			overflow_minutes: false,
			disable_keyboard_mobile: false,
			reset: false,
			add: false,
			on_change: null,
      			input_writable: false
		};

		var settings = $.extend({}, defaults, options);

		return this.each(function() {

			var ele = $(this);
			var ele_hei = ele.outerHeight();
			ele_hei += 0;
			$(ele).wrap("<div class='time_pick'>");
			var ele_par = $(this).parents(".time_pick");

			// developer can specify which arrow makes the numbers go up or down
			var top_arrow_button = (settings.increase_direction === 'down') ?
				"<div class='prev action-prev'><svg class='icon-svg' role='img'><use xmlns:xlink='http://www.w3.org/1999/xlink' xlink:href='/wp-content/themes/azbn7theme/img/svg/sprite.svg#arrow-down'></use></svg></div>" :
				"<div class='prev action-next'><svg class='icon-svg' role='img'><use xmlns:xlink='http://www.w3.org/1999/xlink' xlink:href='/wp-content/themes/azbn7theme/img/svg/sprite.svg#arrow-up'></use></svg></div>";
			var bottom_arrow_button = (settings.increase_direction === 'down') ?
				"<div class='next action-next'><svg class='icon-svg' role='img'><use xmlns:xlink='http://www.w3.org/1999/xlink' xlink:href='/wp-content/themes/azbn7theme/img/svg/sprite.svg#arrow-up'></use></svg></div>" :
				"<div class='next action-prev'><svg class='icon-svg' role='img'><use xmlns:xlink='http://www.w3.org/1999/xlink' xlink:href='/wp-content/themes/azbn7theme/img/svg/sprite.svg#arrow-down'></use></svg></div>";

			var new_ele = $(
				"<div class='timepicker_wrap " + settings.custom_classes + "'>" +
					"<div class='time'>" +
						top_arrow_button +
						"<div class='ti_tx'><input type='text' class='timepicki-input'" + (settings.disable_keyboard_mobile ? "readonly" : "") + "></div>" +
						bottom_arrow_button +
					"</div>" +
					"<div class='delimiter'>:</div>" +
					"<div class='mins'>" +
						top_arrow_button +
						"<div class='mi_tx'><input type='text' class='timepicki-input'" + (settings.disable_keyboard_mobile ? "readonly" : "") + "></div>" +
						bottom_arrow_button +
					"</div>");
			if(settings.show_meridian){
				new_ele.append(
					"<div class='meridian'>" +
						top_arrow_button +
						"<div class='mer_tx'><input type='text' class='timepicki-input' readonly></div>" +
						bottom_arrow_button +
					"</div>");
			}
			if(settings.reset){
				new_ele.append(
					"<div class='picki_btn'><button type='button' class='btn-link__item  is--timepicki  reset_time'><span>Сбросить</span></button></div>");
			}
			if(settings.add){
				new_ele.append(
					"<div class='picki_btn'><button type='button' class='btn-link__item  is--timepicki  add_time'><span>Готово</span></dutton></div>");
			}
			ele_par.append(new_ele);
			var ele_next = $(this).next(".timepicker_wrap");
			var ele_next_all_child = ele_next.find("div");
			var inputs = ele_par.find('input');
			
			$('.add_time').on("click", function(event) {
				close_timepicki();
			});
			$('.reset_time').on("click", function(event) {
				ele.val("");
				close_timepicki();
			});

			$(".timepicki-input").keydown(function (keyevent) {
			    // our goal here is very simple.
			    // no matter what the user presses
			    // we must ensure that the values in our
			    // timepicki inputs are valid, and that pressing
			    // enter does not submit the form if the
			    // input field on which timepicki is applied is a part of a form.
			    
			    
			    // With that in mind. We proceed like this:
			    // 1) If enter is pressed:
			    //      i) Prevent default operations - form submission.
                //      ii) close_timepicki().
			    //      iii) return.
                //
			    // 2) For any other key presses:
			    //      i) realize that we cannot check what the user has typed
			    //         just yet, because this function is a handler
			    //         that runs before any text is rendered in the input
			    //         box.
			    //      ii) So, register a function validate() that will execute right 
			    //          after the keypress character is rendered. All validation
                //          is done inside validate().
                //-----------------------------------------------------------------------------------
			    //  NOTE:.change() event does not work here, as it is called when input looses focus|
                //-----------------------------------------------------------------------------------

                // (1)
			    // prevent potential form submission, if enter is pressed.
			    if (keyevent.keyCode == 13) {

			        keyevent.preventDefault();

			        set_value();
			        close_timepicki();
			        // nothing to do here.
			        return;
			    }



			    // the grand father div specifies the type of 
			    // input that we are dealing with. if the grandFatherDiv
			    // has a class "time", then its a time input, if it has a class
			    // "mins", then its a minutes input, and if it has a class "meridian"
                // then its a meridian input.
			    var grandfatherDiv = $(this).parent().parent();

                // aliasing for readability
			    var input = $(this);

			    // pick the value from the field,
			    // because before change the field always has a
                // valid value.
			    var lastValue = input.val();

                // (2)
			    // validate() function validates the
			    // user input. 
			    function validate() {
			        
			        var isValidNumber = /^\d+$/.test(input.val());
			        var isEmpty = input.val() === "";
			        
                    
			        if (grandfatherDiv.hasClass("time")) { /// HOUR


			            // if its a valid number.
                        // clip it and assign it.
			            if (isValidNumber) {

                            // clip number.
			                var hours = (settings.show_meridian) ?
                            Math.min(Math.max(parseInt(input.val()), 1), 12) : // for 12 hour date picker.
			                Math.min(Math.max(parseInt(input.val()), 0), 23); // for 24 hours date picker.

			                // assign number.
			                input.val(hours);

			            } else if(!isEmpty) {
                            // else if the number is invalid and not empty
                            // assign the lastValue
			                input.val(lastValue);

			            }



			        } else if (grandfatherDiv.hasClass("mins")) { /// MINUTE


			            // if its a valid number.
			            // clip it and assign it.
			            if (isValidNumber) {

			                // clip number.
			                var minutes = Math.min(Math.max(parseInt(input.val()), 0), 59);

			                // assign number.
			                input.val(minutes);

			            } else if (!isEmpty) {
			                // else if the number is invalid and not empty
			                // assign the lastValue
			                input.val(lastValue);

			            }


			        } else if (grandfatherDiv.hasClass("meridian")) { /// MERIDIAN
			            // key presses should not affect
			            // meridian - except up and down
			            // which are handled else where
                        // and will still work.
			            keyevent.preventDefault();
			        } else {
                        // alert("This should not happen.");
			        }

			    }
			    
			    // wrapValidate() ensures that validate()
			    // is not called more than once. 'done'
                // is a flag used to ensure this.
			    done = false;
			    function wrapValidate() {
			        if (!done) {


                        validate();

			            done = true;
                    }
			    }
			    // enqueue wrapValidate function before any thing
			    // else takes place. For this we use setTimeout()
                // with 0
			    setTimeout(wrapValidate, 0);




					

			});

			// open or close time picker when clicking
			$(document).on("click", function(event) {
				//if (!$(event.target).is(ele_next) && ele_next.css("display")=="block" && !$(event.target).is($('.reset_time'))) {
				if (!$(event.target).is(ele_next) && $('.timepicker_wrap.is--active')  && !$(event.target).is($('.reset_time'))) {
					if (!$(event.target).is(ele)) {
						set_value(event, !is_element_in_timepicki($(event.target)));
					} else {
						var ele_lef =  0;
						
						ele_next.css({
							"top": ele_hei + "px",
							"left": ele_lef + "px"
						});
						open_timepicki();
					}
				}
			});

			// open the modal when the user focuses on the input
			ele.on('focus', open_timepicki);

			// select all text in input when user focuses on it
			inputs.on('focus', function() {
				var input = $(this);
				if (!input.is(ele)) {
					input.select();
				}
			});

			// allow user to increase and decrease numbers using arrow keys
			inputs.on('keydown', function(e) {
				var direction, input = $(this);

				// UP
				if (e.which === 38) {
					if (settings.increase_direction === 'down') {
						direction = 'prev';
					} else {
						direction = 'next';
					}
				// DOWN
				} else if (e.which === 40) {
					if (settings.increase_direction === 'down') {
						direction = 'next';
					} else {
						direction = 'prev';
					}
				}

				if (input.closest('.timepicker_wrap .time').length) {
					change_time(null, direction);
				} else if (input.closest('.timepicker_wrap .mins').length) {
					change_mins(null, direction);
				} else if (input.closest('.timepicker_wrap .meridian').length && settings.show_meridian) {
					change_meri(null, direction);
				}
			});

			// close the modal when the time picker loses keyboard focus
			inputs.on('blur', function() {
				setTimeout(function() {
					var focused_element = $(document.activeElement);
					if (focused_element.is(':input') && !is_element_in_timepicki(focused_element)) {
						set_value();
						close_timepicki();
					}
				}, 0);
			});

			function is_element_in_timepicki(jquery_element) {
				return $.contains(ele_par[0], jquery_element[0]) || ele_par.is(jquery_element);
			}

			function set_value(event, close) {
				// use input values to set the time
				var tim = ele_next.find(".ti_tx input").val();
				var mini = ele_next.find(".mi_tx input").val();
				var meri = "";
				if(settings.show_meridian){
					meri = ele_next.find(".mer_tx input").val();
				}
				
				if (tim.length !== 0 && mini.length !== 0 && (!settings.show_meridian || meri.length !== 0)) {
					// store the value so we can set the initial value
					// next time the picker is opened
					ele.attr('data-timepicki-tim', tim);
					ele.attr('data-timepicki-mini', mini);
					
					if(settings.show_meridian){
						ele.attr('data-timepicki-meri', meri);
						// set the formatted value
						ele.val(settings.format_output(tim, mini, meri));
					}else{
						ele.val(settings.format_output(tim, mini));
					}
				}

				//Call user on_change callback function if set
				if (settings.on_change !== null) {
					settings.on_change(ele[0]);
				}

				if (close) {
					close_timepicki();
				}
			}

			function open_timepicki() {
				set_date(settings.start_time);
				//ele_next.fadeIn();
				ele_next.addClass("is--active");
				if(!settings.input_writable) {
					// focus on the first input and select its contents
					var first_input = ele_next.find('input:visible').first();
					first_input.focus();
				}
				// if the user presses shift+tab while on the first input,
				// they mean to exit the time picker and go to the previous field
				var first_input_exit_handler = function(e) {
					if (e.which === 9 && e.shiftKey) {
						first_input.off('keydown', first_input_exit_handler);
						var all_form_elements = $(':input:visible:not(.timepicki-input)');
						var index_of_timepicki_input = all_form_elements.index(ele);
						var previous_form_element = all_form_elements.get(index_of_timepicki_input-1);
						previous_form_element.focus();
					}
				};
				first_input.on('keydown', first_input_exit_handler);
			}

			function close_timepicki() {
				//ele_next.fadeOut();
				ele_next.removeClass("is--active");
			}

			function set_date(start_time) {
				var d, ti, mi, mer;

				// if a value was already picked we will remember that value
				if (ele.is('[data-timepicki-tim]')) {
					ti = Number(ele.attr('data-timepicki-tim'));
					mi = Number(ele.attr('data-timepicki-mini'));
					if(settings.show_meridian){
						mer = ele.attr('data-timepicki-meri');
					}
				// developer can specify a custom starting value
				} else if (typeof start_time === 'object') {
					ti = Number(start_time[0]);
					mi = Number(start_time[1]);
					if(settings.show_meridian){
						mer = start_time[2];
					}
				// default is we will use the current time
				} else {
					d = new Date();
					ti = d.getHours();
					mi = d.getMinutes();
					mer = "AM";
					if (settings.show_meridian){
						if (ti == 0) { // midnight 
							ti = 12;
						} else if (ti == 12) { // noon
							mer = "PM";
						} else if (ti > 12) {
							ti -= 12;
							mer = "PM";
						}
					}
				}

				if (ti < 10) {
					ele_next.find(".ti_tx input").val("0" + ti);
				} else {
					ele_next.find(".ti_tx input").val(ti);
				}
				if (mi < 10) {
					ele_next.find(".mi_tx input").val("0" + mi);
				} else {
					ele_next.find(".mi_tx input").val(mi);
				}
				if(settings.show_meridian){
					if (mer < 10) {
						ele_next.find(".mer_tx input").val("0" + mer);
					} else {
						ele_next.find(".mer_tx input").val(mer);
					}
				}
			}

			function change_time(cur_ele, direction) {
				var cur_cli = "time";
				var cur_time = Number(ele_next.find("." + cur_cli + " .ti_tx input").val());
				var ele_st = Number(settings.min_hour_value);
				var ele_en = Number(settings.max_hour_value);
				var step_size = Number(settings.step_size_hours);
				if ((cur_ele && cur_ele.hasClass('action-next')) || direction === 'next') {
					if (cur_time + step_size > ele_en) {
						var min_value = ele_st;
						if (min_value < 10) {
							min_value = '0' + min_value;
						} else {
							min_value = String(min_value);
						}
						ele_next.find("." + cur_cli + " .ti_tx input").val(min_value);
					} else {
						cur_time = cur_time + step_size;
						if (cur_time < 10) {
							cur_time = "0" + cur_time;
						}
						ele_next.find("." + cur_cli + " .ti_tx input").val(cur_time);
					}
				} else if ((cur_ele && cur_ele.hasClass('action-prev')) || direction === 'prev') {
					var minValue = Number(settings.min_hour_value)
					if (cur_time - step_size < minValue) {
						var max_value = ele_en;
						if (max_value < 10) {
							max_value = '0' + max_value;
						} else {
							max_value = String(max_value);
						}
						ele_next.find("." + cur_cli + " .ti_tx input").val(max_value);
					} else {
						cur_time = cur_time - step_size;
						if (cur_time < 10) {
							cur_time = "0" + cur_time;
						}
						ele_next.find("." + cur_cli + " .ti_tx input").val(cur_time);
					}
				}
			}

			function change_mins(cur_ele, direction) {
				var cur_cli = "mins";
				var cur_mins = Number(ele_next.find("." + cur_cli + " .mi_tx input").val());
				var ele_st = 0;
				var ele_en = 59;
				var step_size = Number(settings.step_size_minutes);
				if ((cur_ele && cur_ele.hasClass('action-next')) || direction === 'next') {
					if (cur_mins + step_size > ele_en) {
						ele_next.find("." + cur_cli + " .mi_tx input").val("00");
						if(settings.overflow_minutes){
							change_time(null, 'next');
						}
					} else {
						cur_mins = cur_mins + step_size;
						if (cur_mins < 10) {
							ele_next.find("." + cur_cli + " .mi_tx input").val("0" + cur_mins);
						} else {
							ele_next.find("." + cur_cli + " .mi_tx input").val(cur_mins);
						}
					}
				} else if ((cur_ele && cur_ele.hasClass('action-prev')) || direction === 'prev') {
					if (cur_mins - step_size <= -1) {
						ele_next.find("." + cur_cli + " .mi_tx input").val(ele_en + 1 - step_size);
						if(settings.overflow_minutes){
							change_time(null, 'prev');
						}
					} else {
						cur_mins = cur_mins - step_size;
						if (cur_mins < 10) {
							ele_next.find("." + cur_cli + " .mi_tx input").val("0" + cur_mins);
						} else {
							ele_next.find("." + cur_cli + " .mi_tx input").val(cur_mins);
						}
					}
				}
			}

			function change_meri(cur_ele, direction) {
				var cur_cli = "meridian";
				var ele_st = 0;
				var ele_en = 1;
				var cur_mer = null;
				cur_mer = ele_next.find("." + cur_cli + " .mer_tx input").val();
				if ((cur_ele && cur_ele.hasClass('action-next')) || direction === 'next') {
					if (cur_mer == "AM") {
						ele_next.find("." + cur_cli + " .mer_tx input").val("PM");
					} else {
						ele_next.find("." + cur_cli + " .mer_tx input").val("AM");
					}
				} else if ((cur_ele && cur_ele.hasClass('action-prev')) || direction === 'prev') {
					if (cur_mer == "AM") {
						ele_next.find("." + cur_cli + " .mer_tx input").val("PM");
					} else {
						ele_next.find("." + cur_cli + " .mer_tx input").val("AM");
					}
				}
			}

			// handle clicking on the arrow icons
			var cur_next = ele_next.find(".action-next");
			var cur_prev = ele_next.find(".action-prev");
			$(cur_prev).add(cur_next).on("click", function() {
				var cur_ele = $(this);
				if (cur_ele.parent().attr("class") == "time") {
					change_time(cur_ele);
				} else if (cur_ele.parent().attr("class") == "mins") {
					change_mins(cur_ele);
				} else {
					if(settings.show_meridian){
						change_meri(cur_ele);
					}
				}
			});

		});
	};

}(jQuery));
/*!
 * Datepicker v0.6.3
 * https://github.com/fengyuanchen/datepicker
 *
 * Copyright (c) 2014-2017 Fengyuan Chen
 * Released under the MIT license
 *
 * Date: 2017-09-29T14:28:06.767Z
 */
(function (global, factory) {
	typeof exports === 'object' && typeof module !== 'undefined' ? factory(require('jquery')) :
	typeof define === 'function' && define.amd ? define(['jquery'], factory) :
	(factory(global.jQuery));
}(this, (function ($) { 'use strict';

$ = $ && $.hasOwnProperty('default') ? $['default'] : $;

var DEFAULTS = {
  // Show the datepicker automatically when initialized
  autoShow: false,

  // Hide the datepicker automatically when picked
  autoHide: false,

  // Pick the initial date automatically when initialized
  autoPick: false,

  // Enable inline mode
  inline: false,

  // A element (or selector) for putting the datepicker
  container: null,

  // A element (or selector) for triggering the datepicker
  trigger: null,

  // The ISO language code (built-in: en-US)
  language: '',

  // The date string format
  format: 'mm/dd/yyyy',

  // The initial date
  date: null,

  // The start view date
  startDate: null,

  // The end view date
  endDate: null,

  // The start view when initialized
  startView: 0, // 0 for days, 1 for months, 2 for years

  // The start day of the week
  // 0 for Sunday, 1 for Monday, 2 for Tuesday, 3 for Wednesday,
  // 4 for Thursday, 5 for Friday, 6 for Saturday
  weekStart: 0,

  // Show year before month on the datepicker header
  yearFirst: false,

  // A string suffix to the year number.
  yearSuffix: '',

  // Days' name of the week.
  days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],

  // Shorter days' name
  daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

  // Shortest days' name
  daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],

  // Months' name
  months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],

  // Shorter months' name
  monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

  // A element tag for each item of years, months and days
  itemTag: 'li',

  // A class (CSS) for muted date item
  mutedClass: 'muted',

  // A class (CSS) for picked date item
  pickedClass: 'picked',

  // A class (CSS) for disabled date item
  disabledClass: 'disabled',

  // A class (CSS) for highlight date item
  highlightedClass: 'highlighted',

  // The template of the datepicker
  template: '<div class="datepicker-container">' + '<div class="datepicker-panel" data-view="years picker">' + '<ul>' + '<li data-view="years prev">&lsaquo;</li>' + '<li data-view="years current"></li>' + '<li data-view="years next">&rsaquo;</li>' + '</ul>' + '<ul data-view="years"></ul>' + '</div>' + '<div class="datepicker-panel" data-view="months picker">' + '<ul>' + '<li data-view="year prev">&lsaquo;</li>' + '<li data-view="year current"></li>' + '<li data-view="year next">&rsaquo;</li>' + '</ul>' + '<ul data-view="months"></ul>' + '</div>' + '<div class="datepicker-panel" data-view="days picker">' + '<ul>' + '<li data-view="month prev">&lsaquo;</li>' + '<li data-view="month current"></li>' + '<li data-view="month next">&rsaquo;</li>' + '</ul>' + '<ul data-view="week"></ul>' + '<ul data-view="days"></ul>' + '</div>' + '</div>',

  // The offset top or bottom of the datepicker from the element
  offset: 10,

  // The `z-index` of the datepicker
  zIndex: 1000,

  // Filter each date item (return `false` to disable a date item)
  filter: null,

  // Event shortcuts
  show: null,
  hide: null,
  pick: null
};

var NAMESPACE = 'datepicker';
var EVENT_CLICK = 'click.' + NAMESPACE;
var EVENT_FOCUS = 'focus.' + NAMESPACE;
var EVENT_HIDE = 'hide.' + NAMESPACE;
var EVENT_KEYUP = 'keyup.' + NAMESPACE;
var EVENT_PICK = 'pick.' + NAMESPACE;
var EVENT_RESIZE = 'resize.' + NAMESPACE;
var EVENT_SHOW = 'show.' + NAMESPACE;
var CLASS_HIDE = NAMESPACE + '-hide';
var LANGUAGES = {};
var VIEWS = {
  DAYS: 0,
  MONTHS: 1,
  YEARS: 2
};

var toString = Object.prototype.toString;


function typeOf(obj) {
  return toString.call(obj).slice(8, -1).toLowerCase();
}

function isString(value) {
  return typeof value === 'string';
}

var isNaN = Number.isNaN || window.isNaN;

function isNumber(value) {
  return typeof value === 'number' && !isNaN(value);
}

function isUndefined(value) {
  return typeof value === 'undefined';
}

function isDate(value) {
  return typeOf(value) === 'date';
}

function proxy(fn, context) {
  for (var _len = arguments.length, args = Array(_len > 2 ? _len - 2 : 0), _key = 2; _key < _len; _key++) {
    args[_key - 2] = arguments[_key];
  }

  return function () {
    for (var _len2 = arguments.length, args2 = Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
      args2[_key2] = arguments[_key2];
    }

    return fn.apply(context, args.concat(args2));
  };
}

function selectorOf(view) {
  return '[data-view="' + view + '"]';
}

function isLeapYear(year) {
  return year % 4 === 0 && year % 100 !== 0 || year % 400 === 0;
}

function getDaysInMonth(year, month) {
  return [31, isLeapYear(year) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
}

function getMinDay(year, month, day) {
  return Math.min(day, getDaysInMonth(year, month));
}

var formatParts = /(y|m|d)+/g;

function parseFormat(format) {
  var source = String(format).toLowerCase();
  var parts = source.match(formatParts);

  if (!parts || parts.length === 0) {
    throw new Error('Invalid date format.');
  }

  format = {
    source: source,
    parts: parts
  };

  $.each(parts, function (i, part) {
    switch (part) {
      case 'dd':
      case 'd':
        format.hasDay = true;
        break;

      case 'mm':
      case 'm':
        format.hasMonth = true;
        break;

      case 'yyyy':
      case 'yy':
        format.hasYear = true;
        break;

      default:
    }
  });

  return format;
}

var _window$1 = window;
var document$2 = _window$1.document;

var $window = $(window);
var $document$1 = $(document$2);
var REGEXP_DIGITS = /\d+/g;

var methods = {
  // Show the datepicker
  show: function show() {
    if (!this.built) {
      this.build();
    }

    if (this.shown) {
      return;
    }

    if (this.trigger(EVENT_SHOW).isDefaultPrevented()) {
      return;
    }

    this.shown = true;
    this.$picker.removeClass(CLASS_HIDE).on(EVENT_CLICK, $.proxy(this.click, this));
    this.showView(this.options.startView);

    if (!this.inline) {
      $window.on(EVENT_RESIZE, this.onResize = proxy(this.place, this));
      $document$1.on(EVENT_CLICK, this.onGlobalClick = proxy(this.globalClick, this));
      $document$1.on(EVENT_KEYUP, this.onGlobalKeyup = proxy(this.globalKeyup, this));
      this.place();
    }
  },


  // Hide the datepicker
  hide: function hide() {
    if (!this.shown) {
      return;
    }

    if (this.trigger(EVENT_HIDE).isDefaultPrevented()) {
      return;
    }

    this.shown = false;
    this.$picker.addClass(CLASS_HIDE).off(EVENT_CLICK, this.click);

    if (!this.inline) {
      $window.off(EVENT_RESIZE, this.onResize);
      $document$1.off(EVENT_CLICK, this.onGlobalClick);
      $document$1.off(EVENT_KEYUP, this.onGlobalKeyup);
    }
  },
  toggle: function toggle() {
    if (this.shown) {
      this.hide();
    } else {
      this.show();
    }
  },


  // Update the datepicker with the current input value
  update: function update() {
    var value = this.getValue();

    if (value === this.oldValue) {
      return;
    }

    this.setDate(value, true);
    this.oldValue = value;
  },


  /**
   * Pick the current date to the element
   *
   * @param {String} _view (private)
   */
  pick: function pick(_view) {
    var $this = this.$element;
    var date = this.date;


    if (this.trigger(EVENT_PICK, {
      view: _view || '',
      date: date
    }).isDefaultPrevented()) {
      return;
    }

    date = this.formatDate(this.date);
    this.setValue(date);

    if (this.isInput) {
      $this.trigger('input');
      $this.trigger('change');
    }
  },


  // Reset the datepicker
  reset: function reset() {
    this.setDate(this.initialDate, true);
    this.setValue(this.initialValue);

    if (this.shown) {
      this.showView(this.options.startView);
    }
  },


  /**
   * Get the month name with given argument or the current date
   *
   * @param {Number} month (optional)
   * @param {Boolean} short (optional)
   * @return {String} (month name)
   */
  getMonthName: function getMonthName(month, short) {
    var options = this.options;
    var monthsShort = options.monthsShort;
    var months = options.months;


    if ($.isNumeric(month)) {
      month = Number(month);
    } else if (isUndefined(short)) {
      short = month;
    }

    if (short === true) {
      months = monthsShort;
    }

    return months[isNumber(month) ? month : this.date.getMonth()];
  },


  /**
   * Get the day name with given argument or the current date
   *
   * @param {Number} day (optional)
   * @param {Boolean} short (optional)
   * @param {Boolean} min (optional)
   * @return {String} (day name)
   */
  getDayName: function getDayName(day, short, min) {
    var options = this.options;
    var days = options.days;


    if ($.isNumeric(day)) {
      day = Number(day);
    } else {
      if (isUndefined(min)) {
        min = short;
      }

      if (isUndefined(short)) {
        short = day;
      }
    }

    if (min) {
      days = options.daysMin;
    } else if (short) {
      days = options.daysShort;
    }

    return days[isNumber(day) ? day : this.date.getDay()];
  },


  /**
   * Get the current date
   *
   * @param {Boolean} formatted (optional)
   * @return {Date|String} (date)
   */
  getDate: function getDate(formatted) {
    var date = this.date;


    return formatted ? this.formatDate(date) : new Date(date);
  },


  /**
   * Set the current date with a new date
   *
   * @param {Date} date
   * @param {Boolean} _updated (private)
   */
  setDate: function setDate(date, _updated) {
    var filter = this.options.filter;


    if (isDate(date) || isString(date)) {
      date = this.parseDate(date);

      if ($.isFunction(filter) && filter.call(this.$element, date) === false) {
        return;
      }

      this.date = date;
      this.viewDate = new Date(date);

      if (!_updated) {
        this.pick();
      }

      if (this.built) {
        this.render();
      }
    }
  },


  /**
   * Set the start view date with a new date
   *
   * @param {Date} date
   */
  setStartDate: function setStartDate(date) {
    if (isDate(date) || isString(date)) {
      this.startDate = this.parseDate(date);

      if (this.built) {
        this.render();
      }
    }
  },


  /**
   * Set the end view date with a new date
   *
   * @param {Date} date
   */
  setEndDate: function setEndDate(date) {
    if (isDate(date) || isString(date)) {
      this.endDate = this.parseDate(date);

      if (this.built) {
        this.render();
      }
    }
  },


  /**
   * Parse a date string with the set date format
   *
   * @param {String} date
   * @return {Date} (parsed date)
   */
  parseDate: function parseDate(date) {
    var format = this.format;

    var parts = [];

    if (isDate(date)) {
      return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    } else if (isString(date)) {
      parts = date.match(REGEXP_DIGITS) || [];
    }

    date = new Date();

    var length = format.parts.length;

    var year = date.getFullYear();
    var day = date.getDate();
    var month = date.getMonth();

    if (parts.length === length) {
      $.each(parts, function (i, part) {
        var value = parseInt(part, 10) || 1;

        switch (format.parts[i]) {
          case 'dd':
          case 'd':
            day = value;
            break;

          case 'mm':
          case 'm':
            month = value - 1;
            break;

          case 'yy':
            year = 2000 + value;
            break;

          case 'yyyy':
            year = value;
            break;

          default:
        }
      });
    }

    return new Date(year, month, day);
  },


  /**
   * Format a date object to a string with the set date format
   *
   * @param {Date} date
   * @return {String} (formatted date)
   */
  formatDate: function formatDate(date) {
    var format = this.format;

    var formatted = '';

    if (isDate(date)) {
      var year = date.getFullYear();
      var values = {
        d: date.getDate(),
        m: date.getMonth() + 1,
        yy: year.toString().substring(2),
        yyyy: year
      };

      values.dd = (values.d < 10 ? '0' : '') + values.d;
      values.mm = (values.m < 10 ? '0' : '') + values.m;
      formatted = format.source;
      $.each(format.parts, function (i, part) {
        formatted = formatted.replace(part, values[part]);
      });
    }

    return formatted;
  },


  // Destroy the datepicker and remove the instance from the target element
  destroy: function destroy() {
    this.unbind();
    this.unbuild();
    this.$element.removeData(NAMESPACE);
  }
};

var handlers = {
  click: function click(e) {
    var $target = $(e.target);
    var options = this.options,
        viewDate = this.viewDate,
        format = this.format;


    e.stopPropagation();
    e.preventDefault();

    if ($target.hasClass('disabled')) {
      return;
    }

    var view = $target.data('view');
    var viewYear = viewDate.getFullYear();
    var viewMonth = viewDate.getMonth();
    var viewDay = viewDate.getDate();

    switch (view) {
      case 'years prev':
      case 'years next':
        {
          viewYear = view === 'years prev' ? viewYear - 10 : viewYear + 10;
          this.viewDate = new Date(viewYear, viewMonth, getMinDay(viewYear, viewMonth, viewDay));
          this.renderYears();
          break;
        }

      case 'year prev':
      case 'year next':
        viewYear = view === 'year prev' ? viewYear - 1 : viewYear + 1;
        this.viewDate = new Date(viewYear, viewMonth, getMinDay(viewYear, viewMonth, viewDay));
        this.renderMonths();
        break;

      case 'year current':
        if (format.hasYear) {
          this.showView(VIEWS.YEARS);
        }

        break;

      case 'year picked':
        if (format.hasMonth) {
          this.showView(VIEWS.MONTHS);
        } else {
          $target.addClass(options.pickedClass).siblings().removeClass(options.pickedClass);
          this.hideView();
        }

        this.pick('year');
        break;

      case 'year':
        viewYear = parseInt($target.text(), 10);
        this.date = new Date(viewYear, viewMonth, getMinDay(viewYear, viewMonth, viewDay));

        if (format.hasMonth) {
          this.viewDate = new Date(this.date);
          this.showView(VIEWS.MONTHS);
        } else {
          $target.addClass(options.pickedClass).siblings().removeClass(options.pickedClass);
          this.hideView();
        }

        this.pick('year');
        break;

      case 'month prev':
      case 'month next':
        viewMonth = view === 'month prev' ? viewMonth - 1 : viewMonth + 1;

        if (viewMonth < 0) {
          viewYear -= 1;
          viewMonth += 12;
        } else if (viewMonth > 11) {
          viewYear += 1;
          viewMonth -= 12;
        }

        this.viewDate = new Date(viewYear, viewMonth, getMinDay(viewYear, viewMonth, viewDay));
        this.renderDays();
        break;

      case 'month current':
        if (format.hasMonth) {
          this.showView(VIEWS.MONTHS);
        }

        break;

      case 'month picked':
        if (format.hasDay) {
          this.showView(VIEWS.DAYS);
        } else {
          $target.addClass(options.pickedClass).siblings().removeClass(options.pickedClass);
          this.hideView();
        }

        this.pick('month');
        break;

      case 'month':
        viewMonth = $.inArray($target.text(), options.monthsShort);
        this.date = new Date(viewYear, viewMonth, getMinDay(viewYear, viewMonth, viewDay));

        if (format.hasDay) {
          this.viewDate = new Date(viewYear, viewMonth, getMinDay(viewYear, viewMonth, viewDay));
          this.showView(VIEWS.DAYS);
        } else {
          $target.addClass(options.pickedClass).siblings().removeClass(options.pickedClass);
          this.hideView();
        }

        this.pick('month');
        break;

      case 'day prev':
      case 'day next':
      case 'day':
        if (view === 'day prev') {
          viewMonth -= 1;
        } else if (view === 'day next') {
          viewMonth += 1;
        }

        viewDay = parseInt($target.text(), 10);
        this.date = new Date(viewYear, viewMonth, viewDay);
        this.viewDate = new Date(viewYear, viewMonth, viewDay);
        this.renderDays();

        if (view === 'day') {
          this.hideView();
        }

        this.pick('day');
        break;

      case 'day picked':
        this.hideView();
        this.pick('day');
        break;

      default:
    }
  },
  globalClick: function globalClick(_ref) {
    var target = _ref.target;
    var element = this.element,
        $trigger = this.$trigger;

    var trigger = $trigger[0];
    var hidden = true;

    while (target !== document) {
      if (target === trigger || target === element) {
        hidden = false;
        break;
      }

      target = target.parentNode;
    }

    if (hidden) {
      this.hide();
    }
  },
  keyup: function keyup() {
    this.update();
  },
  globalKeyup: function globalKeyup(_ref2) {
    var target = _ref2.target,
        key = _ref2.key,
        keyCode = _ref2.keyCode;

    if (this.isInput && target !== this.element && this.shown && (key === 'Tab' || keyCode === 9)) {
      this.hide();
    }
  }
};

var render = {
  render: function render() {
    this.renderYears();
    this.renderMonths();
    this.renderDays();
  },
  renderWeek: function renderWeek() {
    var _this = this;

    var items = [];
    var _options = this.options,
        weekStart = _options.weekStart,
        daysMin = _options.daysMin;


    weekStart = parseInt(weekStart, 10) % 7;
    daysMin = daysMin.slice(weekStart).concat(daysMin.slice(0, weekStart));
    $.each(daysMin, function (i, day) {
      items.push(_this.createItem({
        text: day
      }));
    });

    this.$week.html(items.join(''));
  },
  renderYears: function renderYears() {
    var options = this.options,
        startDate = this.startDate,
        endDate = this.endDate;
    var disabledClass = options.disabledClass,
        filter = options.filter,
        yearSuffix = options.yearSuffix;

    var viewYear = this.viewDate.getFullYear();
    var now = new Date();
    var thisYear = now.getFullYear();
    var year = this.date.getFullYear();
    var start = -5;
    var end = 6;
    var items = [];
    var prevDisabled = false;
    var nextDisabled = false;
    var i = void 0;

    for (i = start; i <= end; i += 1) {
      var date = new Date(viewYear + i, 1, 1);
      var disabled = false;

      if (startDate) {
        disabled = date.getFullYear() < startDate.getFullYear();

        if (i === start) {
          prevDisabled = disabled;
        }
      }

      if (!disabled && endDate) {
        disabled = date.getFullYear() > endDate.getFullYear();

        if (i === end) {
          nextDisabled = disabled;
        }
      }

      if (!disabled && filter) {
        disabled = filter.call(this.$element, date) === false;
      }

      var picked = viewYear + i === year;
      var view = picked ? 'year picked' : 'year';

      items.push(this.createItem({
        picked: picked,
        disabled: disabled,
        muted: i === start || i === end,
        text: viewYear + i,
        view: disabled ? 'year disabled' : view,
        highlighted: date.getFullYear() === thisYear
      }));
    }

    this.$yearsPrev.toggleClass(disabledClass, prevDisabled);
    this.$yearsNext.toggleClass(disabledClass, nextDisabled);
    this.$yearsCurrent.toggleClass(disabledClass, true).html(viewYear + start + yearSuffix + ' - ' + (viewYear + end) + yearSuffix);
    this.$years.html(items.join(''));
  },
  renderMonths: function renderMonths() {
    var options = this.options,
        startDate = this.startDate,
        endDate = this.endDate,
        viewDate = this.viewDate;

    var disabledClass = options.disabledClass || '';
    var months = options.monthsShort;
    var filter = $.isFunction(options.filter) && options.filter;
    var viewYear = viewDate.getFullYear();
    var now = new Date();
    var thisYear = now.getFullYear();
    var thisMonth = now.getMonth();
    var year = this.date.getFullYear();
    var month = this.date.getMonth();
    var items = [];
    var prevDisabled = false;
    var nextDisabled = false;
    var i = void 0;

    for (i = 0; i <= 11; i += 1) {
      var date = new Date(viewYear, i, 1);
      var disabled = false;

      if (startDate) {
        prevDisabled = date.getFullYear() === startDate.getFullYear();
        disabled = prevDisabled && date.getMonth() < startDate.getMonth();
      }

      if (!disabled && endDate) {
        nextDisabled = date.getFullYear() === endDate.getFullYear();
        disabled = nextDisabled && date.getMonth() > endDate.getMonth();
      }

      if (!disabled && filter) {
        disabled = filter.call(this.$element, date) === false;
      }

      var picked = viewYear === year && i === month;
      var view = picked ? 'month picked' : 'month';

      items.push(this.createItem({
        disabled: disabled,
        picked: picked,
        highlighted: viewYear === thisYear && date.getMonth() === thisMonth,
        index: i,
        text: months[i],
        view: disabled ? 'month disabled' : view
      }));
    }

    this.$yearPrev.toggleClass(disabledClass, prevDisabled);
    this.$yearNext.toggleClass(disabledClass, nextDisabled);
    this.$yearCurrent.toggleClass(disabledClass, prevDisabled && nextDisabled).html(viewYear + options.yearSuffix || '');
    this.$months.html(items.join(''));
  },
  renderDays: function renderDays() {
    var $element = this.$element,
        options = this.options,
        startDate = this.startDate,
        endDate = this.endDate,
        viewDate = this.viewDate,
        currentDate = this.date;
    var disabledClass = options.disabledClass,
        filter = options.filter,
        monthsShort = options.monthsShort,
        weekStart = options.weekStart,
        yearSuffix = options.yearSuffix;

    var viewYear = viewDate.getFullYear();
    var viewMonth = viewDate.getMonth();
    var now = new Date();
    var thisYear = now.getFullYear();
    var thisMonth = now.getMonth();
    var thisDay = now.getDate();
    var year = currentDate.getFullYear();
    var month = currentDate.getMonth();
    var day = currentDate.getDate();
    var length = void 0;
    var i = void 0;
    var n = void 0;

    // Days of prev month
    // -----------------------------------------------------------------------

    var prevItems = [];
    var prevViewYear = viewYear;
    var prevViewMonth = viewMonth;
    var prevDisabled = false;

    if (viewMonth === 0) {
      prevViewYear -= 1;
      prevViewMonth = 11;
    } else {
      prevViewMonth -= 1;
    }

    // The length of the days of prev month
    length = getDaysInMonth(prevViewYear, prevViewMonth);

    // The first day of current month
    var firstDay = new Date(viewYear, viewMonth, 1);

    // The visible length of the days of prev month
    // [0,1,2,3,4,5,6] - [0,1,2,3,4,5,6] => [-6,-5,-4,-3,-2,-1,0,1,2,3,4,5,6]
    n = firstDay.getDay() - parseInt(weekStart, 10) % 7;

    // [-6,-5,-4,-3,-2,-1,0,1,2,3,4,5,6] => [1,2,3,4,5,6,7]
    if (n <= 0) {
      n += 7;
    }

    if (startDate) {
      prevDisabled = firstDay.getTime() <= startDate.getTime();
    }

    for (i = length - (n - 1); i <= length; i += 1) {
      var prevViewDate = new Date(prevViewYear, prevViewMonth, i);
      var disabled = false;

      if (startDate) {
        disabled = prevViewDate.getTime() < startDate.getTime();
      }

      if (!disabled && filter) {
        disabled = filter.call($element, prevViewDate) === false;
      }

      prevItems.push(this.createItem({
        disabled: disabled,
        highlighted: prevViewYear === thisYear && prevViewMonth === thisMonth && prevViewDate.getDate() === thisDay,
        muted: true,
        picked: prevViewYear === year && prevViewMonth === month && i === day,
        text: i,
        view: 'day prev'
      }));
    }

    // Days of next month
    // -----------------------------------------------------------------------

    var nextItems = [];
    var nextViewYear = viewYear;
    var nextViewMonth = viewMonth;
    var nextDisabled = false;

    if (viewMonth === 11) {
      nextViewYear += 1;
      nextViewMonth = 0;
    } else {
      nextViewMonth += 1;
    }

    // The length of the days of current month
    length = getDaysInMonth(viewYear, viewMonth);

    // The visible length of next month (42 means 6 rows and 7 columns)
    n = 42 - (prevItems.length + length);

    // The last day of current month
    var lastDate = new Date(viewYear, viewMonth, length);

    if (endDate) {
      nextDisabled = lastDate.getTime() >= endDate.getTime();
    }

    for (i = 1; i <= n; i += 1) {
      var date = new Date(nextViewYear, nextViewMonth, i);
      var picked = nextViewYear === year && nextViewMonth === month && i === day;
      var _disabled = false;

      if (endDate) {
        _disabled = date.getTime() > endDate.getTime();
      }

      if (!_disabled && filter) {
        _disabled = filter.call($element, date) === false;
      }

      nextItems.push(this.createItem({
        disabled: _disabled,
        picked: picked,
        highlighted: nextViewYear === thisYear && nextViewMonth === thisMonth && date.getDate() === thisDay,
        muted: true,
        text: i,
        view: 'day next'
      }));
    }

    // Days of current month
    // -----------------------------------------------------------------------

    var items = [];

    for (i = 1; i <= length; i += 1) {
      var _date = new Date(viewYear, viewMonth, i);
      var _disabled2 = false;

      if (startDate) {
        _disabled2 = _date.getTime() < startDate.getTime();
      }

      if (!_disabled2 && endDate) {
        _disabled2 = _date.getTime() > endDate.getTime();
      }

      if (!_disabled2 && filter) {
        _disabled2 = filter.call($element, _date) === false;
      }

      var _picked = viewYear === year && viewMonth === month && i === day;
      var view = _picked ? 'day picked' : 'day';

      items.push(this.createItem({
        disabled: _disabled2,
        picked: _picked,
        highlighted: viewYear === thisYear && viewMonth === thisMonth && _date.getDate() === thisDay,
        text: i,
        view: _disabled2 ? 'day disabled' : view
      }));
    }

    // Render days picker
    // -----------------------------------------------------------------------

    this.$monthPrev.toggleClass(disabledClass, prevDisabled);
    this.$monthNext.toggleClass(disabledClass, nextDisabled);
    this.$monthCurrent.toggleClass(disabledClass, prevDisabled && nextDisabled).html(options.yearFirst ? viewYear + yearSuffix + ' ' + monthsShort[viewMonth] : monthsShort[viewMonth] + ' ' + viewYear + yearSuffix);
    this.$days.html(prevItems.join('') + items.join('') + nextItems.join(''));
  }
};

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var _window = window;
var document$1 = _window.document;

var $document = $(document$1);

// Classes
var CLASS_TOP_LEFT = NAMESPACE + '-top-left';
var CLASS_TOP_RIGHT = NAMESPACE + '-top-right';
var CLASS_BOTTOM_LEFT = NAMESPACE + '-bottom-left';
var CLASS_BOTTOM_RIGHT = NAMESPACE + '-bottom-right';
var CLASS_PLACEMENTS = [CLASS_TOP_LEFT, CLASS_TOP_RIGHT, CLASS_BOTTOM_LEFT, CLASS_BOTTOM_RIGHT].join(' ');

var Datepicker = function () {
  function Datepicker(element) {
    var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

    _classCallCheck(this, Datepicker);

    this.$element = $(element);
    this.element = element;
    this.options = $.extend({}, DEFAULTS, LANGUAGES[options.language], options);
    this.built = false;
    this.shown = false;
    this.isInput = false;
    this.inline = false;
    this.initialValue = '';
    this.initialDate = null;
    this.startDate = null;
    this.endDate = null;
    this.init();
  }

  _createClass(Datepicker, [{
    key: 'init',
    value: function init() {
      var $this = this.$element,
          options = this.options;
      var startDate = options.startDate,
          endDate = options.endDate,
          date = options.date;


      this.$trigger = $(options.trigger);
      this.isInput = $this.is('input') || $this.is('textarea');
      this.inline = options.inline && (options.container || !this.isInput);
      this.format = parseFormat(options.format);

      var initialValue = this.getValue();

      this.initialValue = initialValue;
      this.oldValue = initialValue;
      date = this.parseDate(date || initialValue);

      if (startDate) {
        startDate = this.parseDate(startDate);

        if (date.getTime() < startDate.getTime()) {
          date = new Date(startDate);
        }

        this.startDate = startDate;
      }

      if (endDate) {
        endDate = this.parseDate(endDate);

        if (startDate && endDate.getTime() < startDate.getTime()) {
          endDate = new Date(startDate);
        }

        if (date.getTime() > endDate.getTime()) {
          date = new Date(endDate);
        }

        this.endDate = endDate;
      }

      this.date = date;
      this.viewDate = new Date(date);
      this.initialDate = new Date(this.date);
      this.bind();

      if (options.autoShow || this.inline) {
        this.show();
      }

      if (options.autoPick) {
        this.pick();
      }
    }
  }, {
    key: 'build',
    value: function build() {
      if (this.built) {
        return;
      }

      this.built = true;

      var $this = this.$element,
          options = this.options;

      var $picker = $(options.template);

      this.$picker = $picker;
      this.$week = $picker.find(selectorOf('week'));

      // Years view
      this.$yearsPicker = $picker.find(selectorOf('years picker'));
      this.$yearsPrev = $picker.find(selectorOf('years prev'));
      this.$yearsNext = $picker.find(selectorOf('years next'));
      this.$yearsCurrent = $picker.find(selectorOf('years current'));
      this.$years = $picker.find(selectorOf('years'));

      // Months view
      this.$monthsPicker = $picker.find(selectorOf('months picker'));
      this.$yearPrev = $picker.find(selectorOf('year prev'));
      this.$yearNext = $picker.find(selectorOf('year next'));
      this.$yearCurrent = $picker.find(selectorOf('year current'));
      this.$months = $picker.find(selectorOf('months'));

      // Days view
      this.$daysPicker = $picker.find(selectorOf('days picker'));
      this.$monthPrev = $picker.find(selectorOf('month prev'));
      this.$monthNext = $picker.find(selectorOf('month next'));
      this.$monthCurrent = $picker.find(selectorOf('month current'));
      this.$days = $picker.find(selectorOf('days'));

      if (this.inline) {
        $(options.container || $this).append($picker.addClass(NAMESPACE + '-inline'));
      } else {
        $(document$1.body).append($picker.addClass(NAMESPACE + '-dropdown'));
        $picker.addClass(CLASS_HIDE);
      }

      this.renderWeek();
    }
  }, {
    key: 'unbuild',
    value: function unbuild() {
      if (!this.built) {
        return;
      }

      this.built = false;
      this.$picker.remove();
    }
  }, {
    key: 'bind',
    value: function bind() {
      var options = this.options,
          $this = this.$element;


      if ($.isFunction(options.show)) {
        $this.on(EVENT_SHOW, options.show);
      }

      if ($.isFunction(options.hide)) {
        $this.on(EVENT_HIDE, options.hide);
      }

      if ($.isFunction(options.pick)) {
        $this.on(EVENT_PICK, options.pick);
      }

      if (this.isInput) {
        $this.on(EVENT_KEYUP, $.proxy(this.keyup, this));
      }

      if (!this.inline) {
        if (options.trigger) {
          this.$trigger.on(EVENT_CLICK, $.proxy(this.toggle, this));
        } else if (this.isInput) {
          $this.on(EVENT_FOCUS, $.proxy(this.show, this));
        } else {
          $this.on(EVENT_CLICK, $.proxy(this.show, this));
        }
      }
    }
  }, {
    key: 'unbind',
    value: function unbind() {
      var $this = this.$element,
          options = this.options;


      if ($.isFunction(options.show)) {
        $this.off(EVENT_SHOW, options.show);
      }

      if ($.isFunction(options.hide)) {
        $this.off(EVENT_HIDE, options.hide);
      }

      if ($.isFunction(options.pick)) {
        $this.off(EVENT_PICK, options.pick);
      }

      if (this.isInput) {
        $this.off(EVENT_KEYUP, this.keyup);
      }

      if (!this.inline) {
        if (options.trigger) {
          this.$trigger.off(EVENT_CLICK, this.toggle);
        } else if (this.isInput) {
          $this.off(EVENT_FOCUS, this.show);
        } else {
          $this.off(EVENT_CLICK, this.show);
        }
      }
    }
  }, {
    key: 'showView',
    value: function showView(view) {
      var $yearsPicker = this.$yearsPicker,
          $monthsPicker = this.$monthsPicker,
          $daysPicker = this.$daysPicker,
          format = this.format;


      if (format.hasYear || format.hasMonth || format.hasDay) {
        switch (Number(view)) {
          case VIEWS.YEARS:
            $monthsPicker.addClass(CLASS_HIDE);
            $daysPicker.addClass(CLASS_HIDE);

            if (format.hasYear) {
              this.renderYears();
              $yearsPicker.removeClass(CLASS_HIDE);
              this.place();
            } else {
              this.showView(VIEWS.DAYS);
            }

            break;

          case VIEWS.MONTHS:
            $yearsPicker.addClass(CLASS_HIDE);
            $daysPicker.addClass(CLASS_HIDE);

            if (format.hasMonth) {
              this.renderMonths();
              $monthsPicker.removeClass(CLASS_HIDE);
              this.place();
            } else {
              this.showView(VIEWS.YEARS);
            }

            break;

          // case VIEWS.DAYS:
          default:
            $yearsPicker.addClass(CLASS_HIDE);
            $monthsPicker.addClass(CLASS_HIDE);

            if (format.hasDay) {
              this.renderDays();
              $daysPicker.removeClass(CLASS_HIDE);
              this.place();
            } else {
              this.showView(VIEWS.MONTHS);
            }
        }
      }
    }
  }, {
    key: 'hideView',
    value: function hideView() {
      if (!this.inline && this.options.autoHide) {
        this.hide();
      }
    }
  }, {
    key: 'place',
    value: function place() {
      if (this.inline) {
        return;
      }

      var $this = this.$element,
          options = this.options,
          $picker = this.$picker;

      var containerWidth = $document.outerWidth();
      var containerHeight = $document.outerHeight();
      var elementWidth = $this.outerWidth();
      var elementHeight = $this.outerHeight();
      var width = $picker.width();
      var height = $picker.height();

      var _$this$offset = $this.offset(),
          left = _$this$offset.left,
          top = _$this$offset.top;

      var offset = parseFloat(options.offset);
      var placement = CLASS_TOP_LEFT;

      if (isNaN(offset)) {
        offset = 10;
      }

      if (top > height && top + elementHeight + height > containerHeight) {
        top -= height + offset;
        placement = CLASS_BOTTOM_LEFT;
      } else {
        top += elementHeight + offset;
      }

      if (left + width > containerWidth) {
        left += elementWidth - width;
        placement = placement.replace('left', 'right');
      }

      $picker.removeClass(CLASS_PLACEMENTS).addClass(placement).css({
        top: top,
        left: left,
        zIndex: parseInt(options.zIndex, 10)
      });
    }

    // A shortcut for triggering custom events

  }, {
    key: 'trigger',
    value: function trigger(type, data) {
      var e = $.Event(type, data);

      this.$element.trigger(e);

      return e;
    }
  }, {
    key: 'createItem',
    value: function createItem(data) {
      var options = this.options;
      var itemTag = options.itemTag;

      var item = {
        text: '',
        view: '',
        muted: false,
        picked: false,
        disabled: false,
        highlighted: false
      };
      var classes = [];

      $.extend(item, data);

      if (item.muted) {
        classes.push(options.mutedClass);
      }

      if (item.highlighted) {
        classes.push(options.highlightedClass);
      }

      if (item.picked) {
        classes.push(options.pickedClass);
      }

      if (item.disabled) {
        classes.push(options.disabledClass);
      }

      return '<' + itemTag + ' class="' + classes.join(' ') + '" data-view="' + item.view + '">' + item.text + '</' + itemTag + '>';
    }
  }, {
    key: 'getValue',
    value: function getValue() {
      var $this = this.$element;

      return this.isInput ? $this.val() : $this.text();
    }
  }, {
    key: 'setValue',
    value: function setValue() {
      var value = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';

      var $this = this.$element;

      if (this.isInput) {
        $this.val(value);
      } else {
        $this.text(value);
      }
    }
  }], [{
    key: 'setDefaults',
    value: function setDefaults() {
      var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

      $.extend(DEFAULTS, LANGUAGES[options.language], options);
    }
  }]);

  return Datepicker;
}();

$.extend(Datepicker.prototype, render, handlers, methods);

var AnotherDatepicker = $.fn.datepicker;

$.fn.datepicker = function jQueryDatepicker(option) {
  for (var _len = arguments.length, args = Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
    args[_key - 1] = arguments[_key];
  }

  var result = void 0;

  this.each(function each() {
    var $this = $(this);
    var data = $this.data('datepicker');

    if (!data) {
      if (/destroy/.test(option)) {
        return;
      }

      var options = $.extend({}, $this.data(), $.isPlainObject(option) && option);

      data = new Datepicker(this, options);
      $this.data('datepicker', data);
    }

    if (typeof option === 'string') {
      var fn = data[option];

      if ($.isFunction(fn)) {
        result = fn.apply(data, args);
      }
    }
  });

  return typeof result !== 'undefined' ? result : this;
};

$.fn.datepicker.Constructor = Datepicker;
$.fn.datepicker.languages = LANGUAGES;
$.fn.datepicker.setDefaults = Datepicker.setDefaults;
$.fn.datepicker.noConflict = function noConflict() {
  $.fn.datepicker = AnotherDatepicker;
  return this;
};

})));
(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? factory(require('jquery')) :
  typeof define === 'function' && define.amd ? define(['jquery'], factory) :
  (factory(global.jQuery));
}(this, (function ($) {

  'use strict';

  $.fn.datepicker.languages['ru-RU'] = {
    format: 'dd.mm.YYYY',
    days: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
    daysShort: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
    daysMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
    months: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
    monthsShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
    weekStart: 1,
    startView: 0,
    yearFirst: false,
    yearSuffix: ''
  };
})));