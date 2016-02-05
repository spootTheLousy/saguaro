//RePod - Displays the original image when hovering over its thumbnail.

ImageHover = {
    init: function() {
        //typeof repod_thread_updater_calls == "object" && repod_thread_updater_calls.push(repod_image_hover_bindings);
        //typeof repod_infinite_scroll_calls == "object" && repod_infinite_scroll_calls.push(repod_image_hover_bindings);
        this.config = {
            enabled: Core.isReady() && Core.getItem("imageHover") === "true",
            selector: ".postimg"
        }
        Core && Core.info.push({
            mode: 'modern',
            menu: {
                category: 'Images',
                read: this.config.enabled,
                variable: 'imageHover',
                label: 'Image hover',
                hover: 'Expand images on hover, limited to browser size'
            }
        });
        this.update();
    },
    update: function() {
        var that = this;
        if(this.config.enabled) {
            $(document).on("mouseover", this.config.selector, function() {
                that.display($(this));
            });
            $(document).on("mouseout", this.config.selector, function() {
                that.remove_display()
            });
        }
    },
    display: function(e) {
        if(!$(e).data("o-s")) {
            var element = $('<div id="img_hover_element" />');
            var css = {
                right: "0px",
                top: "0px",
                position: "fixed",
                width: "auto",
                height: "auto",
                "max-height": "100%",
                "max-width": Math.round($("body").width() - ($(e).offset().left + $(e).outerWidth(true)) + 20) + "px"
            }

            if(/\.webm$/.test($(e).parent().attr("href"))) {
                $(element).append("<video class='expandedwebm-" + $(e).data("name") + "' loop autoplay src='" + $(e).parent().attr("href") + "'></video>");
            } else {
                var img = $("<img src='" + $(e).parent().attr("href") + "'/>");
                $(img).css(css);
                $(element).append(img);
            }

            $(element).css(css);
            $("body").append(element);
        }
    },
    remove_display: function() {
        $("#img_hover_element").remove();
    }
};
