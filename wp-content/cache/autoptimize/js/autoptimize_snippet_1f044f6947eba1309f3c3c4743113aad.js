/*! Wolf Gram Wordpress Plugin v1.6.2 */ 
/*!
 * WolfGram
 *
 * Wolf Gram 1.6.2
 */
/* jshint -W062 */
/* global DocumentTouch */
var WolfGram=WolfGram||{},console=console||{};WolfGram=function(a){"use strict";return{init:function(){var b=this;this.setRelAttr(),a(window).resize(function(){b.widthClass()}).resize()},setRelAttr:function(){var b=Math.floor(9999*Math.random()+1);a("#wolf-instagram .wolf-instagram-item a").each(function(){a(this).attr("rel","wolfgram-gallery")}),a(".wolf-instagram-list li a").each(function(){a(this).attr("rel","wolfgram-widget-gallery"),a(this).attr("data-fancybox","wolfgram-widget-gallery-"+b)})},widthClass:function(){a(".wolf-instagram-gallery").each(function(){var b=a(this),c=b.find(".wolf-instagram-item:first-child").width();100>c&&380>c?(a(this).addClass("wolf-instagram-gallery-small"),a(this).removeClass("wolf-instagram-gallery-big")):380<c?(a(this).removeClass("wolf-instagram-gallery-small"),a(this).addClass("wolf-instagram-gallery-big")):(a(this).removeClass("wolf-instagram-gallery-small"),a(this).removeClass("wolf-instagram-gallery-big"))})}}}(jQuery),function(a){"use strict";a(document).ready(function(){WolfGram.init()})}(jQuery);