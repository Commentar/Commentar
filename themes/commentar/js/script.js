(function($) {
    $("#commentar-container .commentar-comments .showReplies").click(
        function(e){
            e.preventDefault();
            var $replyToggler = $(this);
            var $span = $replyToggler.children("span.toggle-text");
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

                var $parent = replyLink.closest("li");

                if (!$parent.children("ul").length) {
                    $parent.append("<ul>");
                } else {
                    $parent.children("a.showReplies").click();
                }

                var $childList = parent.children("ul");
                $childList.addClass("commentar-comments").show();

                $childList.prepend("<li>");

                $childList.children().first().addClass("commentar-post").prepend(data);
            });
        }
    );

    $(".commentar-comments article footer a.delete").click(
        function(e) {
            e.preventDefault();

            var contentContainer = $(this).closest("article").children("main");

            $.get($(this).attr("href"), function(data) {
                var icon  = contentContainer.children(".icon-comments");
                var arrow = contentContainer.children(".triangle-topleft");

                var originalContent = contentContainer.html();
                var originalHeight  = contentContainer.height();

                contentContainer.height(originalHeight);

                contentContainer.html(data);
                contentContainer.append(icon);
                contentContainer.append(arrow);

                var confirmationForm = contentContainer.children('form');
                confirmationForm.on('click', 'a', function(e) {
                    e.preventDefault();

                    contentContainer.html(originalContent);
                });
                confirmationForm.on('submit', function(e) {
                    e.preventDefault();

                    $.ajax({
                        dataType: "json",
                        type: "POST",
                        url: confirmationForm.attr("action"),
                        success: function(data) {
                            if (data.result === "success") {
                                var childrenContainer = contentContainer.closest('ul');
                                var children = childrenContainer.children('li').length;

                                if (children > 1) {
                                    childrenContainer.parent().children('.showReplies').children('.number').text(children - 1);
                                    contentContainer.closest("article").closest("li").remove();
                                } else {
                                    childrenContainer.parent().children('.showReplies').remove();
                                    childrenContainer.remove();
                                }
                            } else {
                                contentContainer.html(originalContent);
                            }
                        }
                    });
                });
            });
        }
    );
}(jQuery));
