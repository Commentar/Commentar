jQuery(document).ready(
	function(){
		jQuery("#commentar-container .commentar-comments li .commentar-comments").each(
			function(){
				var amountOfComments = jQuery(this).children("li").length;
				jQuery(this)
				.css({
					display: "none"
				})
				.before(
					"<a href='' class='button showReplies icon-plus'>\n\
						<span>Show</span>\n\
						" + amountOfComments + " replies\n\
					</a>"
				);
			}
		);
		
		jQuery("#commentar-container .commentar-comments .showReplies").click(
			function(e){
				e.preventDefault();
				if(jQuery(this).siblings(".commentar-comments").is(":visible")) {
					jQuery(this)
					.addClass("icon-plus").removeClass("icon-minus")
					.siblings(".commentar-comments").hide();
					jQuery(this).children("span").html('Show');
				} else {
					jQuery(this)
					.addClass("icon-minus").removeClass("icon-plus")
					.siblings(".commentar-comments").show();
					jQuery(this).children("span").html("Hide");
				}
			}
		);

		jQuery("#commentar-container .commentar-comments .share").click(
			function(){
				if(jQuery(this).children("a").is(":visible")){
					jQuery(this).children("a").hide();
				} else {
					jQuery(this).children("a").show();
				}
			}
		);
	}
);