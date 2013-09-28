(function($) {
    $("#commentar-container .commentar-comments .showReplies").click(
        function(e){
            e.preventDefault();
            var $replyToggler = $(this);
            var $span = $replyToggler.children("span");
            var originalText = $span.text();
            if($replyToggler.siblings(".commentar-comments").is(":visible")) {
                $replyToggler
                .addClass("icon-plus").removeClass("icon-minus")
                .siblings(".commentar-comments").hide();
            } else {
                $replyToggler
                .addClass("icon-minus").removeClass("icon-plus")
                .siblings(".commentar-comments").show();
            }
            $span.text($replyToggler.data("toggle"));
            $replyToggler.data("toggle", originalText)
        }
    );

    $("#commentar-container .commentar-comments .share").click(
        function(){
            if($(this).children("a").is(":visible")){
                $(this).children("a").hide();
            } else {
                $(this).children("a").show();
            }
        }
    );

    $(".reply").click(
        function(e){
            var replyLink = $(this);

            e.preventDefault();

            $.get(replyLink.attr("href"), function(data) {
                $(".commentar-comments .commentar-post").remove();

                var parent = replyLink.closest("li");

                if (!parent.children("ul").length) {
                    parent.append("<ul>");
                } else {
                    parent.children("a.showReplies").click();
                }

                var childList = parent.children("ul");
                childList.addClass("commentar-comments").show();

                childList.prepend("<li>");

                childList.children().first().addClass("commentar-post").prepend(data);
            });
        }
    );
}(jQuery));
