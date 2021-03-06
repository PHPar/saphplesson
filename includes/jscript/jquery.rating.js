;if(jQuery) (function($){
	$.rating = {
		cancel: 'Cancel Rating',
		cancelValue: '',
		split: 0,
		
		groups: {},
		event: {
			fill: function(n, el, settings, state){
				this.drain(n);
				$(el).prevAll('.star_group_'+n).andSelf().addClass('star_'+(state || 'hover'));
				var lnk = $(el).children('a'); val = lnk.text();
				if(settings.focus) settings.focus.apply($.rating.groups[n].valueElem[0], [val, lnk[0]]);
			},
			drain: function(n, el, settings) {
				$.rating.groups[n].valueElem.siblings('.star_group_'+n).removeClass('star_on').removeClass('star_hover');
			},
			reset: function(n, el, settings){
				if(!$($.rating.groups[n].current).is('.cancel'))
					$($.rating.groups[n].current).prevAll('.star_group_'+n).andSelf().addClass('star_on');
				var lnk = $(el).children('a'); val = lnk.text();
				if(settings.blur) settings.blur.apply($.rating.groups[n].valueElem[0], [val, lnk[0]]);
			},
			click: function(n, el, settings){
				$.rating.groups[n].current = el;
				var lnk = $(el).children('a'); val = lnk.text();
				$.rating.groups[n].valueElem.val(val);
				$.rating.event.drain(n, el, settings);
				$.rating.event.reset(n, el, settings);
				if(settings.callback) settings.callback.apply($.rating.groups[n].valueElem[0], [val, lnk[0]]);
			}      
		}
	};
	$.fn.rating = function(instanceSettings){
		if(this.length==0) return this;
		instanceSettings = $.extend(
			{},
			$.rating,
			instanceSettings || {}
		);
		this.each(function(i){
			var settings = $.extend(
				{},
				instanceSettings || {},
				($.metadata? $(this).metadata(): ($.meta?$(this).data():null)) || {}
			);
			var n = this.name;
			if(!$.rating.groups[n]) $.rating.groups[n] = {count: 0};
			i = $.rating.groups[n].count; $.rating.groups[n].count++;

			$.rating.groups[n].readOnly = $.rating.groups[n].readOnly || settings.readOnly || $(this).attr('disabled');
			
			if(i == 0){
				$.rating.groups[n].valueElem = $('<input type="hidden" name="' + n + '" value=""' + (settings.readOnly ? ' disabled="disabled"' : '') + '>');
				$(this).before($.rating.groups[n].valueElem);

				/*if($.rating.groups[n].readOnly || settings.required){
				}
				else{
					$(this).before(
						$('<div class="cancel"><a title="' + settings.cancel + '">' + settings.cancelValue + '</a></div>')
						.mouseover(function(){ $.rating.event.drain(n, this, settings); $(this).addClass('star_on'); })
						.mouseout(function(){ $.rating.event.reset(n, this, settings); $(this).removeClass('star_on'); })
						.click(function(){ $.rating.event.click(n, this, settings); })
					);
				}*/
			};
			eStar = $('<div class="star"><a title="' + (this.title || this.value) + '">' + this.value + '</a></div>');
			$(this).after(eStar);
			if(settings.half) settings.split = 2;
			if(typeof settings.split=='number' && settings.split>0){
				var spi = (i % settings.split), spw = Math.floor($(eStar).width()/settings.split);
				$(eStar)
				.width(spw)
				.find('a').css({ 'margin-left':'-'+ (spi*spw) +'px' })
			};
			$(eStar).addClass('star_group_'+n)
			if($.rating.groups[n].readOnly){
				$(eStar)
				.addClass('star_readonly');
			}
			else{
				$(eStar)
				.addClass('star_live')
				.mouseover(function(){ $.rating.event.drain(n, this, settings); $.rating.event.fill(n, this, settings, 'hover'); })
				.mouseout(function(){ $.rating.event.drain(n, this, settings); $.rating.event.reset(n, this, settings); })
				.click(function(){ $.rating.event.click(n, this, settings); });
			};
			if(this.checked) $.rating.groups[n].current = eStar;
			$(this).remove();
			if(i + 1 == this.length) $.rating.event.reset(n, this, settings);
		});
		for(n in $.rating.groups)
			(function(c, v, n){ if(!c) return;
				$.rating.event.fill(n, c, instanceSettings || {}, 'on');
				$(v).val($(c).children('a').text());
			})
			($.rating.groups[n].current, $.rating.groups[n].valueElem, n);

		return this;
	};
	$(function(){ $('input[@type=radio].star').rating(); });
})(jQuery);