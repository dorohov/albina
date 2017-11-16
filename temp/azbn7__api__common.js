'use strict';

var Azbn7__API__Request = function(data, cb) {
	
	var ctrl = this;
	
	//data.method = method || data.method;
	
	$.ajax({
		url : '/api/',
		type : 'POST',
		dataType : 'json',
		data : data,
		success : cb,
		error : function(jqXHR, textStatus, errorThrown){
			console.warn(textStatus);
		},
	});
	
	return ctrl;
	
}
