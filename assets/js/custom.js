	$(function(){
		if($("#table-1").offset()){
		var tableOffset = $("#table-1").offset().top;
		var $header = $("#table-1 > thead").clone();
		var $fixedHeader = $("#header-fixed").append($header);
		$fixedHeader.hide();

		$(window).bind("scroll", function() {
			var offset = $(this).scrollTop();

			if (offset >= tableOffset && $fixedHeader.is(":hidden")) {
				$fixedHeader.show();
			}
			else if (offset < tableOffset) {
				$fixedHeader.hide();
			}
			
		  var counter = 0;
			$("#header-fixed th").each(function(){
				var width = $('#table-1 tr:eq(2) td:eq(' + counter + ')').width();
				this.width = width;
				counter++;
			});
		});
		}
	});