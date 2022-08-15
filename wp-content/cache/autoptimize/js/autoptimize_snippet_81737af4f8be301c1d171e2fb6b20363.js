/*!
 * Infinite scroll blog
 *
 * Milu 1.0.2
 */
var MiluLoadPosts=function($){'use strict';return{isWVC:'undefined'!==typeof WVC,init:function(){this.loadMorePosts();},loadMorePosts:function(){var _this=this;$(document).on('click','.loadmore-button',function(event){event.preventDefault();if(MiluParams.isCustomizer){event.stopPropagation();alert(MiluParams.l10n.infiniteScrollDisabledMsg);return;}
var $button=$(this),href=$button.attr('href');if($button.hasClass('trigger-loading')){return;}
$button.addClass('trigger-loading');$button.html(MiluParams.l10n.infiniteScrollMsg);$.get(href,function(response){if(response){_this.processContent(response,$button);}else{console.log('empty response');}});});},processContent:function(response,$button){if(response){var _this=this,href=$button.attr('href'),containerId=$button.parent().prev().attr('id'),$container=$('#'+containerId),entryEffect=$container.find('.entry:first-child').attr('data-aos'),max=parseInt($button.attr('data-max-pages'),10),newItems,$lastItem=$container.find('.entry:last-child'),lastItemOffsetBottom=$lastItem.offset().top+$lastItem.height(),$dom,nextPage;$dom=$(document.createElement('html'));$dom[0].innerHTML=response;newItems=$dom.find('#'+containerId).html(),nextPage=parseInt($dom.find('.loadmore-button').attr('data-next-page'),10);if(_this.isWVC&&entryEffect){$dom.find('#'+containerId).find('.entry').each(function(){$(this).addClass('aos-disabled');$(this).attr('data-aos-delay',1500);});newItems=$dom.find('#'+containerId).html();}
$container.append(newItems);_this.trackPageView(href);if(MiluParams.doLoadMorePaginationHashChange){history.pushState(null,null,href);}
if(max<nextPage||undefined===nextPage||isNaN(nextPage)){$button.html(MiluParams.l10n.infiniteScrollEndMsg);setTimeout(function(){$button.fadeOut(500,function(){$(this).remove();});},3000);}else{$.post(MiluParams.ajaxUrl,{action:'milu_ajax_get_next_page_link',href:$button.attr('href')},function(response){if(response){if($.parseJSON(response)){response=$.parseJSON(response);$button.attr('data-current-page',response.currentPage);$button.attr('data-next-page',response.nextPage);$button.attr('href',response.href);}}
$button.removeClass('trigger-loading');$button.html(MiluParams.l10n.loadMoreMsg);});}
_this.callBack($container);if($container.hasClass('grid-padding-yes')){lastItemOffsetBottom+=14;}
if($container.hasClass('display-metro')||$container.hasClass('display-masonry')||$container.hasClass('display-masonry_modern')){setTimeout(function(){_this.scrollToPoint($(window).scrollTop()+200);},1000);}else{setTimeout(function(){_this.scrollToPoint(lastItemOffsetBottom);},1000);}
setTimeout(function(){window.dispatchEvent(new Event('resize'));},1500);}},urldecode:function(url){var txt=document.createElement('textarea');txt.innerHTML=url;return txt.value;},scrollToPoint:function(scrollPoint){$('html, body').stop().animate({scrollTop:scrollPoint-MiluUi.getToolBarOffset()},1E3,'swing');},trackPageView:function(url){if('undefined'!==typeof _gaq){_gaq.push(['_trackPageview',url]);}
else if('undefined'!==typeof ga){ga('send','pageview',{'page':url});}},callBack:function($container){$container=$container||$('.items');var entryEffect=$container.find('.entry:first-child').attr('data-aos');if('undefined'!==typeof MiluUi){MiluUi.adjustmentClasses();MiluUi.resizeVideoBackground();MiluUi.lazyLoad();MiluUi.fluidVideos($container,true);MiluUi.flexSlider();MiluUi.lightbox();MiluUi.addItemAnimationDelay();MiluUi.parallax();MiluUi.setInternalLinkClass();MiluUi.muteVimeoBackgrounds();setTimeout(function(){MiluUi.videoThumbnailPlayOnHover();},200);}
if('undefined'!==typeof MiluYTVideoBg){MiluYTVideoBg.init($container);MiluYTVideoBg.playVideo($container);}
if($('.masonry-container').length||$('.metro-container').length){MiluMasonry.masonry();MiluMasonry.resizeTimer();if($container.data('isotope')){$container.isotope('reloadItems').isotope();}}
if($('.fleximages-container').length){MiluMasonry.flexImages();}
if('undefined'!==typeof MiluAjaxNav){MiluAjaxNav.setAjaxLinkClass();}
if('undefined'!==typeof WPM){WPM.init();}
if('undefined'!==typeof WVCBigText){WVCBigText.init();}
if('undefined'!==typeof WolfCustomPostMeta){WolfCustomPostMeta.checkLikedPosts();}
if($container.find('.twitter-tweet').length){$.getScript('http://platform.twitter.com/widgets.js');}
if($container.find('.instagram-media').length){$.getScript('//platform.instagram.com/en_US/embeds.js');if('undefined'!==typeof window.instgrm){window.instgrm.Embeds.process();}}
if($container.find('audio:not(.minimal-player-audio):not(.loop-post-player-audio),video').length){$container.find('audio,video').mediaelementplayer();}
if(this.isWVC&&entryEffect){setTimeout(function(){$container.find('.aos-disabled').each(function(){$(this).removeClass('aos-disabled');});},1000);}}};}(jQuery);;(function($){'use strict';$(document).ready(function(){MiluLoadPosts.init();});})(jQuery);