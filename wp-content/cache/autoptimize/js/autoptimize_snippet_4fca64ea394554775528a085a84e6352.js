/*!
 * BigText
 *
 * WPBakery Page Builder Extension 3.2.8
 */
var WVCBigText=function($){'use strict';return{init:function(){var _this=this;_this.bigText();$(window).on('wvc_resized',function(){_this.bigText();});},bigText:function(){$('.wvc-bigtext').each(function(){$(this).bigtext();});}};}(jQuery);(function($){'use strict';$(document).ready(function(){WVCBigText.init();window.dispatchEvent(new Event('resize'));});})(jQuery);