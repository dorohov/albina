"use strict";$(function(){var n,e=$("#inputRange"),a=$("#inputRangeinput"),i=50,o=15e3;e.ionRangeSlider({grid:!1,type:"single",min:i,max:o,step:50,from:500,onStart:function(n){a.prop("value",n.from)},onChange:function(n){a.prop("value",n.from)}}),n=e.data("ionRangeSlider"),a.on("change keyup",function(){var e=$(this).prop("value");e<i?e=i:e>o&&(e=o),n.update({from:e})})});