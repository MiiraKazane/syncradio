<script type="text/javascript">	
	(function($) {
		"use strict";
		var options = {
			events_source: '<?= SITE ?>Calendar/getAll',
			view: 'month',
			language: 'es-MX',
			tmpl_path: '<?= URL ?>assetss/tmpls/',
			tmpl_cache: false,
			day: 'now',
			modal: "#events-modal",
			modal_type: "iframe",
			time_start: '05:00',
			time_end: '23:00',
			time_split: '30',
			width: '90%',
			merge_holidays: false,

			onAfterEventsLoad: function(events) {
				if(!events) {
					return;
				}
				var list = $('#eventlist');
				list.html('');

				$.each(events, function(key, val) {
					$(document.createElement('li'))
						.html('<a href="' + val.url + '">' + val.title + '</a>')
						.appendTo(list);
				});
			},
			onAfterViewLoad: function(view) {
				$('.page-header h3').text(this.getTitle());
				$('.btn-group button').removeClass('active');
				$('button[data-calendar-view="' + view + '"]').addClass('active');
			},
			classes: {
				months: {
					general: 'label'
				}
			}
		};

		var calendar = $('#calendar').calendar(options);

		$('.btn-group button[data-calendar-nav]').each(function() {
			var $this = $(this);
			$this.click(function() {
				calendar.navigate($this.data('calendar-nav'));
			});
		});

		$('.btn-group button[data-calendar-view]').each(function() {
			var $this = $(this);
			$this.click(function() {
				calendar.view($this.data('calendar-view'));
			});
		});
		
		$('#events-modal .modal-header, #events-modal .modal-footer').click(function(e){
			//e.preventDefault();
			//e.stopPropagation();
		});
	}(jQuery));
</script>