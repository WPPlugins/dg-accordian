(function( $ ) {
	'use strict';
	var dg_accordian={

		Snipits: {

			Accordian_Widget: {

				Ajax_Data: function(accordian_data, append_to){
					var accordian_ajax_url = window.location.origin+ajaxurl;
					jQuery.post(accordian_ajax_url,{
							'action': 'dg_accordian_widget',
							'data':   accordian_data
						},
						function(response){
							var change_html = dg_accordian.Snipits.Accordian_Widget.Change_Widget_Data;
							change_html(append_to, response);
						}
					);
				},

				Change_Data: function(selector){
					var data, ajax_result,
						append_to=selector.data('accordian-change-id'),
						accordian_widget = dg_accordian.Snipits.Accordian_Widget;
					data = {
						data_value: selector.val(),
						data_type: selector.data('accordian-value'),
					};
					accordian_widget.Ajax_Data(data, append_to);
				},

				Change_Widget_Data: function(append_to, ajax_result){
					var options, data_obj;
					data_obj=JSON.parse(ajax_result);
					options+='<option value="" selected="selected">No Filter</option>';
					$.each(data_obj, function(key, value){
						options+='<option value="'+value.slug+'">'+value.name+'</option>';
					});
					$(append_to).html(options);
					$(append_to).val('').trigger('change');
				},

			},

		},

		MouseEvents: function(){
			var _this=dg_accordian, widget=_this.Snipits.Accordian_Widget;
			$('.dg-widget-post-type, .dg-widget-taxonomy').on('change', function(evt){
				widget.Change_Data($(this));
			});
		},

		Ready: function(){
			var _this=dg_accordian;
			_this.MouseEvents();
		},

		Load: function(){
			var _this=dg_accordian;

		},

		Scroll: function(){
			var _this=dg_accordian;

		},

		Resize: function(){
			var _this=dg_accordian;

		},

		Init: function(){
			var ready, load, scroll, resize, _this=dg_accordian;
			ready=_this.Ready, load=_this.Load, resize=_this.Resize;
			$(document).ready(ready);
			$(window).load(load);
			$(window).resize(scroll);
			$(window).scroll(resize);
		}

	};

	dg_accordian.Init();


})( jQuery );