!
function($) {
    $.fn.extend({
        tip: function(options) {
            return getOptions(options, this),
            insertCssForTip(),
            replaceTitle(this),
            _attachEvent(this),
            this
        }
    });
    var split_str = function(string, words_per_line) {
        if ("undefined" == typeof string || 0 == string.length) return "";
        words_per_line = parseInt(words_per_line);
        for (var output_string = string.substring(0, 1), i = 1; i < string.length; i++) i % words_per_line == 0 && (output_string += "<br/>"),
        output_string += string.substring(i, i + 1);
        return output_string
    },
    title_show_hoverFlag = !1,
    titleMouseOver = function(obj) {
        if ("undefined" == typeof $(obj).attr("_title") || "" == $(obj).attr("_title")) return ! 1;
        var _options = $(obj).data("options"),
        title_show = document.getElementById("title_show");
        null == title_show && (title_show = document.createElement("div"), $(title_show).attr("id", "title_show"), $("body").append(title_show), $(title_show).css({
            position: "absolute",
            border: "solid 1px " + _options.color,
            background: "#FFFFFF",
            lineHeight: "18px",
            fontSize: "12px",
            padding: "10px",
            left: "-9999px",
            "z-index": "10000"
        })),
        innerHtml = "";
        var words_per_line = _options.words_per_line;
        /^\d+px$/.test(words_per_line) ? ($(title_show).css("width", words_per_line), innerHtml = $(obj).attr("_title")) : (words_per_line = parseInt(words_per_line), innerHtml = split_str($(obj).attr("_title"), words_per_line)),
        $(title_show).html(innerHtml);
        var title_sanjiao = document.getElementById("title_sanjiao");
        null == title_sanjiao && (title_sanjiao = document.createElement("div"), $(title_sanjiao).attr("id", "title_sanjiao"), $("#title_show").append(title_sanjiao), $(title_sanjiao).css({
            position: "absolute",
            height: "10px",
            width: "14px",
            "z-index": "10001"
        })),
        $("#title_show").css("display", "block");
        var title_show_width = $("#title_show").width(),
        title_show_height = $("#title_show").height(),
        top_down = 10,
        offset = $(obj).offset(),
        ele_height = $(obj).height(),
        ele_width = $(obj).width(),
        padding_height = 20;
        title_show.style.left = offset.left + (ele_width - title_show_width - 20) / (_options["trangle-position"] || 2) + "px",
        "up" == _options.direction || offset.top - $(window).scrollTop() + ele_height + top_down + title_show_height + 25 >= $(window).height() ? (title_show.style.top = offset.top - top_down - title_show_height - padding_height + _options.tip_top + "px", $(title_sanjiao).html('<span class="sanjiao sanjiao_fff3">鈼�</span><span class="sanjiao sanjiao_ddd4">鈼�</span>'), title_sanjiao.style.top = title_show_height + padding_height - 9 + "px") : (title_show.style.top = offset.top + ele_height + top_down - _options.tip_top + "px", $(title_sanjiao).html('<span class="sanjiao sanjiao_ddd1">鈼�</span><span class="sanjiao sanjiao_fff2">鈼�</span>'), title_sanjiao.style.top = "-10px"),
        $(title_sanjiao).find("span[class^='sanjiao sanjiao_ddd']").css("color", _options.color),
        title_sanjiao.style.left = (title_show_width + 20 - 14) / 2 + "px"
    },
    hover_flag = !1,
    titleMouseOut = function() {
        var title_show = document.getElementById("title_show");
        return null == title_show ? !1 : void(hover_flag || (title_show.style.display = "none"))
    },
    _attachEvent = function(objs) {
        if ("object" != typeof objs) return ! 1;
        var current_over;
        for (i = 0; i < objs.length; i++) $(objs[i]).hover(function() {
            titleMouseOver(this),
            current_over = this,
            hover_flag = !0
        },
        function() {
            var that = this;
            current_over = this,
            hover_flag = !1,
            setTimeout(function() {
                title_show_hoverFlag || titleMouseOut(that)
            },
            60)
        });
        $("body").delegate("#title_show", "mouseenter",
        function() {
            title_show_hoverFlag = !0
        }),
        $("body").delegate("#title_show", "mouseleave",
        function() {
            title_show_hoverFlag = !1,
            titleMouseOut(current_over)
        })
    },
    replaceTitle = function(objs) {
        for (i = 0; i < objs.length; i++) $(objs[i]).attr("_title", $(objs[i]).attr("title")),
        $(objs[i]).removeAttr("title")
    },
    addStyleString = function(css) {
        var style = document.createElement("style");
        style.type = "text/css";
        try {
            style.appendChild(document.createTextNode(css))
        } catch(ex) {
            style.styleSheet.cssText = css
        }
        var head = document.getElementsByTagName("head")[0];
        head.appendChild(style)
    },
    insertCssForTip = function() {
        addStyleString(".sanjiao {font-size: 14px;font-family: 瀹嬩綋, sans-serif;height: 8px;}.sanjiao_ddd1 { position: absolute;left: 0px;top: 0px;z-index: 1;}.sanjiao_fff2 {color: #fff;position: absolute;left: 0px;top: 2px;z-index: 2;}.sanjiao_fff3 {color: #fff;position: absolute;left: 0px;top: 0px;z-index: 2;}.sanjiao_ddd4 {position: absolute;left: 0px;top: 2px;z-index: 1;}")
    },
    getOptions = function(options, obj) {
        var deFoptions = {
            words_per_line: "150px",
            color: "#e6e6e6",
            tip_top: 0,
            direction: "down"
        };
        $.extend(deFoptions, options);
        var words_per_line = deFoptions.words_per_line;
        "undefined" == typeof words_per_line && (words_per_line = "150px"),
        deFoptions.words_per_line = words_per_line,
        $(obj).data("options", $.extend({},
        deFoptions))
    }
} (jQuery),
function($, window, i) {
    $.fn.responsiveSlides = function(options) {
        var settings = $.extend({
            auto: !0,
            speed: 500,
            timeout: 4e3,
            pager: !1,
            nav: !1,
            random: !1,
            pause: !1,
            pauseControls: !0,
            prevText: "Previous",
            nextText: "Next",
            maxwidth: "",
            navContainer: "",
            manualControls: "",
            namespace: "rslides",
            before: $.noop,
            after: $.noop
        },
        options);
        return this.each(function() {
            i++;
            var vendor, selectTab, startCycle, restartCycle, rotate, $tabs, $this = $(this),
            index = 0,
            $slide = $this.children(),
            length = $slide.size(),
            fadeTime = parseFloat(settings.speed),
            waitTime = parseFloat(settings.timeout),
            maxw = parseFloat(settings.maxwidth),
            namespace = settings.namespace,
            namespaceIdx = namespace + i,
            navClass = namespace + "_nav " + namespaceIdx + "_nav",
            activeClass = namespace + "_here",
            visibleClass = namespaceIdx + "_on",
            slideClassPrefix = namespaceIdx + "_s",
            $pager = $("<ul class='" + namespace + "_tabs " + namespaceIdx + "_tabs' />"),
            visible = {
                "float": "left",
                position: "relative",
                opacity: 1,
                zIndex: 2
            },
            hidden = {
                "float": "none",
                position: "absolute",
                opacity: 0,
                zIndex: 1
            },
            supportsTransitions = function() {
                var docBody = document.body || document.documentElement,
                styles = docBody.style,
                prop = "transition";
                if ("string" == typeof styles[prop]) return ! 0;
                vendor = ["Moz", "Webkit", "Khtml", "O", "ms"],
                prop = prop.charAt(0).toUpperCase() + prop.substr(1);
                var i;
                for (i = 0; i < vendor.length; i++) if ("string" == typeof styles[vendor[i] + prop]) return ! 0;
                return ! 1
            } (),
            slideTo = function(idx) {
                settings.before(idx),
                supportsTransitions ? ($slide.removeClass(visibleClass).css(hidden).eq(idx).addClass(visibleClass).css(visible), index = idx, setTimeout(function() {
                    settings.after(idx)
                },
                fadeTime)) : $slide.stop().fadeOut(fadeTime,
                function() {
                    $(this).removeClass(visibleClass).css(hidden).css("opacity", 1)
                }).eq(idx).fadeIn(fadeTime,
                function() {
                    $(this).addClass(visibleClass).css(visible),
                    settings.after(idx),
                    index = idx
                })
            };
            if (settings.random && ($slide.sort(function() {
                return Math.round(Math.random()) - .5
            }), $this.empty().append($slide)), $slide.each(function(i) {
                this.id = slideClassPrefix + i
            }), $this.addClass(namespace + " " + namespaceIdx), options && options.maxwidth && $this.css("max-width", maxw), $slide.hide().css(hidden).eq(0).addClass(visibleClass).css(visible).show(), supportsTransitions && $slide.show().css({
                "-webkit-transition": "opacity " + fadeTime + "ms ease-in-out",
                "-moz-transition": "opacity " + fadeTime + "ms ease-in-out",
                "-o-transition": "opacity " + fadeTime + "ms ease-in-out",
                transition: "opacity " + fadeTime + "ms ease-in-out"
            }), $slide.size() > 1) {
                if (fadeTime + 100 > waitTime) return;
                if (settings.pager && !settings.manualControls) {
                    var tabMarkup = [];
                    $slide.each(function(i) {
                        var n = i + 1;
                        tabMarkup += "<li><a href='#' class='" + slideClassPrefix + n + "'>" + n + "</a></li>"
                    }),
                    $pager.append(tabMarkup),
                    options.navContainer ? $(settings.navContainer).append($pager) : $this.after($pager)
                }
                if (settings.manualControls && ($pager = $(settings.manualControls), $pager.addClass(namespace + "_tabs " + namespaceIdx + "_tabs")), (settings.pager || settings.manualControls) && $pager.find("li").each(function(i) {
                    $(this).addClass(slideClassPrefix + (i + 1))
                }), (settings.pager || settings.manualControls) && ($tabs = $pager.find("a"), selectTab = function(idx) {
                    $tabs.closest("li").removeClass(activeClass).eq(idx).addClass(activeClass)
                }), settings.auto && (startCycle = function() {
                    rotate = setInterval(function() {
                        $slide.stop(!0, !0);
                        var idx = length > index + 1 ? index + 1 : 0; (settings.pager || settings.manualControls) && selectTab(idx),
                        slideTo(idx)
                    },
                    waitTime)
                })(), restartCycle = function() {
                    settings.auto && (clearInterval(rotate), startCycle())
                },
                settings.pause && $this.hover(function() {
                    clearInterval(rotate)
                },
                function() {
                    restartCycle()
                }), (settings.pager || settings.manualControls) && ($tabs.bind("click",
                function(e) {
                    e.preventDefault(),
                    settings.pauseControls || restartCycle();
                    var idx = $tabs.index(this);
                    index === idx || $("." + visibleClass).queue("fx").length || (selectTab(idx), slideTo(idx))
                }).eq(0).closest("li").addClass(activeClass), settings.pauseControls && $tabs.hover(function() {
                    clearInterval(rotate)
                },
                function() {
                    restartCycle()
                })), settings.nav) {
                    var navMarkup = "<a href='#' class='" + navClass + " prev'>" + settings.prevText + "</a><a href='#' class='" + navClass + " next'>" + settings.nextText + "</a>";
                    options.navContainer ? $(settings.navContainer).append(navMarkup) : $this.after(navMarkup);
                    var $trigger = $("." + namespaceIdx + "_nav"),
                    $prev = $trigger.filter(".prev");
                    $trigger.bind("click",
                    function(e) {
                        e.preventDefault();
                        var $visibleClass = $("." + visibleClass);
                        if (!$visibleClass.queue("fx").length) {
                            var idx = $slide.index($visibleClass),
                            prevIdx = idx - 1,
                            nextIdx = length > idx + 1 ? index + 1 : 0;
                            slideTo($(this)[0] === $prev[0] ? prevIdx: nextIdx),
                            (settings.pager || settings.manualControls) && selectTab($(this)[0] === $prev[0] ? prevIdx: nextIdx),
                            settings.pauseControls || restartCycle()
                        }
                    }),
                    settings.pauseControls && $trigger.hover(function() {
                        clearInterval(rotate)
                    },
                    function() {
                        restartCycle()
                    })
                }
            }
            if ("undefined" == typeof document.body.style.maxWidth && options.maxwidth) {
                var widthSupport = function() {
                    $this.css("width", "100%"),
                    $this.width() > maxw && $this.css("width", maxw)
                };
                widthSupport(),
                $(window).bind("resize",
                function() {
                    widthSupport()
                })
            }
        })
    }
} (jQuery, this, 0),
function(factory) {
    "function" == typeof define && define.amd ? define(["jquery"], factory) : factory(jQuery)
} (function($) {
    "use strict";
    function parseDateString(dateString) {
        if (dateString instanceof Date) return dateString;
        if (String(dateString).match(matchers)) return String(dateString).match(/^[0-9]*$/) && (dateString = Number(dateString)),
        new Date(dateString);
        throw new Error("Couldn't cast `" + dateString + "` to a date object.")
    }
    function strftime(offsetObject) {
        return function(format) {
            var directives = format.match(/%(-|!)?[A-Z]{1}(:[^;]+;)?/gi);
            if (directives) for (var i = 0,
            len = directives.length; len > i; ++i) {
                var directive = directives[i].match(/%(-|!)?([a-zA-Z]{1})(:[^;]+;)?/),
                regexp = new RegExp(directive[0]),
                modifier = directive[1] || "",
                plural = directive[3] || "",
                value = null;
                directive = directive[2],
                DIRECTIVE_KEY_MAP.hasOwnProperty(directive) && (value = DIRECTIVE_KEY_MAP[directive], value = Number(offsetObject[value])),
                null !== value && ("!" === modifier && (value = pluralize(plural, value)), "" === modifier && 10 > value && (value = "0" + value.toString()), format = format.replace(regexp, value.toString()))
            }
            return format = format.replace(/%%/, "%")
        }
    }
    function pluralize(format, count) {
        var plural = "s",
        singular = "";
        return format && (format = format.replace(/(:|;|\s)/gi, "").split(/\,/), 1 === format.length ? plural = format[0] : (singular = format[0], plural = format[1])),
        1 === Math.abs(count) ? singular: plural
    }
    var PRECISION = 1e3,
    instances = [],
    matchers = [];
    matchers.push(/^[0-9]*$/.source),
    matchers.push(/([0-9]{1,2}\/){2}[0-9]{4}( [0-9]{1,2}(:[0-9]{2}){2})?/.source),
    matchers.push(/[0-9]{4}(\/[0-9]{1,2}){2}( [0-9]{1,2}(:[0-9]{2}){2})?/.source),
    matchers = new RegExp(matchers.join("|"));
    var DIRECTIVE_KEY_MAP = {
        Y: "years",
        m: "months",
        w: "weeks",
        d: "days",
        D: "totalDays",
        H: "hours",
        M: "minutes",
        S: "seconds"
    },
    Countdown = function(el, finalDate, currentServerDate, callback) {
        this.el = el,
        this.$el = $(el),
        this.interval = null,
        this.offset = {},
        this.setFinalDate(finalDate),
        this.setCurrentServerDate(currentServerDate),
        this.instanceNumber = instances.length,
        instances.push(this),
        this.$el.data("countdown-instance", this.instanceNumber),
        callback && (this.$el.on("update.countdown", callback), this.$el.on("stoped.countdown", callback), this.$el.on("finish.countdown", callback)),
        this.start()
    };
    $.extend(Countdown.prototype, {
        start: function() {
            if (null !== this.interval) throw new Error("Countdown is already running!");
            var self = this;
            this.update(),
            this.interval = setInterval(function() {
                self.update.call(self)
            },
            PRECISION)
        },
        stop: function() {
            clearInterval(this.interval),
            this.interval = null,
            this.dispatchEvent("stoped")
        },
        pause: function() {
            this.stop.call(this)
        },
        resume: function() {
            this.start.call(this)
        },
        remove: function() {
            this.stop(),
            delete instances[this.instanceNumber]
        },
        setFinalDate: function(value) {
            this.finalDate = parseDateString(value)
        },
        setCurrentServerDate: function(value) {
            void 0 !== value && (this.lastTimeStamp = this.finalDate.valueOf() - value),
            this.currentServerDate = value
        },
        update: function() {
            return 0 === this.$el.closest("html").length ? void this.remove() : (this.totalSecsLeft = this.lastTimeStamp ? this.lastTimeStamp = this.lastTimeStamp - 1e3: this.finalDate.valueOf() - (new Date).valueOf(), this.totalSecsLeft = Math.ceil(this.totalSecsLeft / 1e3), this.totalSecsLeft = this.totalSecsLeft < 0 ? 0 : this.totalSecsLeft, this.offset = {
                seconds: this.totalSecsLeft % 60,
                minutes: Math.floor(this.totalSecsLeft / 60) % 60,
                hours: Math.floor(this.totalSecsLeft / 60 / 60) % 24,
                days: Math.floor(this.totalSecsLeft / 60 / 60 / 24) % 7,
                totalDays: Math.floor(this.totalSecsLeft / 60 / 60 / 24),
                weeks: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 7),
                months: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 30),
                years: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 365)
            },
            0 === this.totalSecsLeft && (this.stop(), this.dispatchEvent("finish")), void this.dispatchEvent("update"))
        },
        dispatchEvent: function(eventName) {
            var event = $.Event(eventName + ".countdown");
            event.finalDate = this.finalDate,
            event.offset = $.extend({},
            this.offset),
            event.strftime = strftime(this.offset),
            this.$el.trigger(event)
        }
    }),
    $.fn.countdown = function() {
        var argumentsArray = Array.prototype.slice.call(arguments, 0);
        return this.each(function() {
            var instanceNumber = $(this).data("countdown-instance");
            if (void 0 !== instanceNumber) {
                var instance = instances[instanceNumber],
                method = argumentsArray[0];
                Countdown.prototype.hasOwnProperty(method) ? instance[method].apply(instance, argumentsArray.slice(1)) : null === String(method).match(/^[$A-Z_][0-9A-Z_$]*$/i) ? instance.setFinalDate.call(instance, method) : $.error("Method %s does not exist on jQuery.countdown".replace(/\%s/gi, method))
            } else new Countdown(this, argumentsArray[0], argumentsArray[1])
        })
    }
}),
function($, window, document, undefined) {
    var $window = $(window);
    $.fn.lazyload = function(options) {
        function update() {
            var counter = 0;
            elements.each(function() {
                var $this = $(this);
                if (!settings.skip_invisible || $this.is(":visible")) if ($.abovethetop(this, settings) || $.leftofbegin(this, settings));
                else if ($.belowthefold(this, settings) || $.rightoffold(this, settings)) {
                    if (++counter > settings.failure_limit) return ! 1
                } else $this.trigger("appear"),
                counter = 0
            })
        }
        var $container, elements = this,
        settings = {
            threshold: 0,
            failure_limit: 0,
            event: "scroll",
            effect: "show",
            container: window,
            data_attribute: "original",
            skip_invisible: !0,
            appear: null,
            load: null,
            placeholder: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"
        };
        return options && (undefined !== options.failurelimit && (options.failure_limit = options.failurelimit, delete options.failurelimit), undefined !== options.effectspeed && (options.effect_speed = options.effectspeed, delete options.effectspeed), $.extend(settings, options)),
        $container = settings.container === undefined || settings.container === window ? $window: $(settings.container),
        0 === settings.event.indexOf("scroll") && $container.bind(settings.event,
        function() {
            return update()
        }),
        this.each(function() {
            var self = this,
            $self = $(self);
            self.loaded = !1,
            ($self.attr("src") === undefined || $self.attr("src") === !1) && $self.is("img") && $self.attr("src", settings.placeholder),
            $self.one("appear",
            function() {
                if (!this.loaded) {
                    if (settings.appear) {
                        var elements_left = elements.length;
                        settings.appear.call(self, elements_left, settings)
                    }
                    $("<img />").bind("load",
                    function() {
                        var original = $self.attr("data-" + settings.data_attribute);
                        $self.hide(),
                        $self.is("img") ? $self.attr("src", original) : $self.css("background-image", "url('" + original + "')"),
                        $self[settings.effect](settings.effect_speed),
                        self.loaded = !0;
                        var temp = $.grep(elements,
                        function(element) {
                            return ! element.loaded
                        });
                        if (elements = $(temp), settings.load) {
                            var elements_left = elements.length;
                            settings.load.call(self, elements_left, settings)
                        }
                    }).attr("src", $self.attr("data-" + settings.data_attribute))
                }
            }),
            0 !== settings.event.indexOf("scroll") && $self.bind(settings.event,
            function() {
                self.loaded || $self.trigger("appear")
            })
        }),
        $window.bind("resize",
        function() {
            update()
        }),
        /(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion) && $window.bind("pageshow",
        function(event) {
            event.originalEvent && event.originalEvent.persisted && elements.each(function() {
                $(this).trigger("appear")
            })
        }),
        $(document).ready(function() {
            update()
        }),
        this
    },
    $.belowthefold = function(element, settings) {
        var fold;
        return fold = settings.container === undefined || settings.container === window ? (window.innerHeight ? window.innerHeight: $window.height()) + $window.scrollTop() : $(settings.container).offset().top + $(settings.container).height(),
        fold <= $(element).offset().top - settings.threshold
    },
    $.rightoffold = function(element, settings) {
        var fold;
        return fold = settings.container === undefined || settings.container === window ? $window.width() + $window.scrollLeft() : $(settings.container).offset().left + $(settings.container).width(),
        fold <= $(element).offset().left - settings.threshold
    },
    $.abovethetop = function(element, settings) {
        var fold;
        return fold = settings.container === undefined || settings.container === window ? $window.scrollTop() : $(settings.container).offset().top,
        fold >= $(element).offset().top + settings.threshold + $(element).height()
    },
    $.leftofbegin = function(element, settings) {
        var fold;
        return fold = settings.container === undefined || settings.container === window ? $window.scrollLeft() : $(settings.container).offset().left,
        fold >= $(element).offset().left + settings.threshold + $(element).width()
    },
    $.inviewport = function(element, settings) {
        return ! ($.rightoffold(element, settings) || $.leftofbegin(element, settings) || $.belowthefold(element, settings) || $.abovethetop(element, settings))
    },
    $.extend($.expr[":"], {
        "below-the-fold": function(a) {
            return $.belowthefold(a, {
                threshold: 0
            })
        },
        "above-the-top": function(a) {
            return ! $.belowthefold(a, {
                threshold: 0
            })
        },
        "right-of-screen": function(a) {
            return $.rightoffold(a, {
                threshold: 0
            })
        },
        "left-of-screen": function(a) {
            return ! $.rightoffold(a, {
                threshold: 0
            })
        },
        "in-viewport": function(a) {
            return $.inviewport(a, {
                threshold: 0
            })
        },
        "above-the-fold": function(a) {
            return ! $.belowthefold(a, {
                threshold: 0
            })
        },
        "right-of-fold": function(a) {
            return $.rightoffold(a, {
                threshold: 0
            })
        },
        "left-of-fold": function(a) {
            return ! $.rightoffold(a, {
                threshold: 0
            })
        }
    })
} (jQuery, window, document),
function(factory) {
    "function" == typeof define && define.amd ? define(["jquery"], factory) : factory(jQuery)
} (function($) {
    function encode(s) {
        return config.raw ? s: encodeURIComponent(s)
    }
    function decode(s) {
        return config.raw ? s: decodeURIComponent(s)
    }
    function stringifyCookieValue(value) {
        return encode(config.json ? JSON.stringify(value) : String(value))
    }
    function parseCookieValue(s) {
        0 === s.indexOf('"') && (s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, "\\"));
        try {
            return s = decodeURIComponent(s.replace(pluses, " ")),
            config.json ? JSON.parse(s) : s
        } catch(e) {}
    }
    function read(s, converter) {
        var value = config.raw ? s: parseCookieValue(s);
        return $.isFunction(converter) ? converter(value) : value
    }
    var pluses = /\+/g,
    config = $.cookie = function(key, value, options) {
        if (void 0 !== value && !$.isFunction(value)) {
            if (options = $.extend({},
            config.defaults, options), "number" == typeof options.expires) {
                var days = options.expires,
                t = options.expires = new Date;
                t.setTime( + t + 864e5 * days)
            }
            return document.cookie = [encode(key), "=", stringifyCookieValue(value), options.expires ? "; expires=" + options.expires.toUTCString() : "", options.path ? "; path=" + options.path: "", options.domain ? "; domain=" + options.domain: "", options.secure ? "; secure": ""].join("")
        }
        for (var result = key ? void 0 : {},
        cookies = document.cookie ? document.cookie.split("; ") : [], i = 0, l = cookies.length; l > i; i++) {
            var parts = cookies[i].split("="),
            name = decode(parts.shift()),
            cookie = parts.join("=");
            if (key && key === name) {
                result = read(cookie, value);
                break
            }
            key || void 0 === (cookie = read(cookie)) || (result[name] = cookie)
        }
        return result
    };
    config.defaults = {},
    $.removeCookie = function(key, options) {
        return void 0 === $.cookie(key) ? !1 : ($.cookie(key, "", $.extend({},
        options, {
            expires: -1
        })), !$.cookie(key))
    }
});
var itz = itz || {};
itz.index = {},
itz.index.init = function() {
    function synchronous() {
        var $investProgress = $(".invest-case-progress");
        $investProgress.length > 0 && $investProgress.each(function() {
            var $iP = $(this),
            progress = $iP.find(".ffA").text().replace("%", "") - 0,
            href = $iP.prev().attr("href"),
            progressId = $.getQueryString("id", href),
            progressHref = href.slice(href.indexOf("/dinvest"), href.indexOf("/detail?") + 8);
            100 > progress && $.ajax({
                url: "/dinvest/ajax/GetNowScale?id=" + progressId,
                jsonp: "jsoncallback",
                dataType: "jsonp",
                success: function(data) {
                    if (!data.code) if (data.data.scale >= 100) {
                        var parent = $iP.parent(),
                        child = $('<span class="icon icon-lable-1"></span><a href="' + progressHref + "id=" + progressId + '" class="invest-group-btn-1-gray" style="display:none;">浜嗚В璇︽儏</a><p class="invest-case-txt clearfix" style="display:none;">鎶曡祫浜烘暟锛�<strong class="fw-n">' + data.data.tender_times + "</strong>浜烘姇璧勬椤圭洰</p>");
                        $iP.find(".ffA").text("100%").end().find(".icp-width").animate({
                            width: "100%"
                        },
                        500,
                        function() {
                            $iP.prev().remove(),
                            $iP.remove(),
                            child.appendTo(parent).fadeIn()
                        })
                    } else $iP.find(".icp-width").animate({
                        width: data.data.scale + "%"
                    },
                    500).end().find(".ffA").text(data.data.scale + "%")
                }
            })
        })
    }
    $("#indexSlide").responsiveSlides({
        nav: !0,
        pager: !0,
        namespace: "indexSlide",
        pause: !0
    }),
    $("#topNotice").click(function() {
        var $con = $("#topNoticeCon");
        $con.is(":hidden") ? ($con.slideDown("fast"), $(this).addClass("top-notice-expanded").parent().addClass("website-notice-icon-expand")) : ($con.slideUp("fast"), $(this).removeClass("top-notice-expanded").parent().removeClass("website-notice-icon-expand"))
    }),
    $(".tips").length > 0 && ($(".tip1").tip({
        words_per_line: 35,
        tip_top: 0
    }), $(".tip2").tip({
        words_per_line: 35,
        tip_top: 18
    }), $(".tip3").tip({
        words_per_line: 35,
        tip_top: 5
    }));
    var $countdown = $(".countdown");
    $countdown.length > 0 && itz.getTimeStamp(function(data) {
        if (! (data.code > 0)) {
            var curSt = 1e3 * data.data;
            $countdown.each(function() {
                var $t = $(this),
                bt = $t.attr("_beginTime");
                if (curSt >= bt) {
                    var $p = $t.parent();
                    $p.find(".countdown-show").hide(),
                    $p.find(".countdown-hide").fadeIn(),
                    $p.find(".countdown").remove().end().append('<span class="invest-case-progress clearfix"><span class="fl">鎶曡祫杩涘害锛�</span><span class="icp-progress"><span class="icp-width" style="width:0%;"></span></span><span class="fl fs-s color-66 ffA">0%</span></span>'),
                    synchronous()
                } else $t.countdown(bt, curSt).on("update.countdown",
                function(event) {
                    var o = event.offset;
                    o.days > 0 && (o.hours = o.hours + 24 * o.days),
                    o.hours < 10 && (o.hours = "0" + o.hours),
                    $(this).html(event.strftime('<span class="icon">' + o.hours + '</span><b>:</b> <span class="icon">%M</span><b>:</b> <span class="icon">%S</span>'))
                }).on("finish.countdown",
                function() {
                    itz.getTimeStamp(function(data) {
                        if (0 == data.code && bt - 1e3 <= 1e3 * data.data) {
                            var $p = $t.parent();
                            $p.find(".countdown-show").hide(),
                            $p.find(".countdown-hide").fadeIn(),
                            $p.find(".countdown").remove().end().append('<span class="invest-case-progress clearfix"><span class="fl">鎶曡祫杩涘害锛�</span><span class="icp-progress"><span class="icp-width" style="width:0%;"></span></span><span class="fl fs-s color-66 ffA">0%</span></span>'),
                            synchronous()
                        }
                    })
                })
            })
        }
    }),
    synchronous();
    var $tabWrapper = $("#noticeTabs");
    $tabWrapper.find(".w-n-l-tab-nav span").itzTabs({
        $content: $tabWrapper.find(".w-n-l-tab-content"),
        currentClass: "cur",
        afterFn: function(index) {
            var $more = $tabWrapper.find(".w-n-l-tab-more a").hide();
            $($more[index]).show()
        }
    }),
    $("#media-news .m-slide-w").responsiveSlides({
        pause: !0,
        namespace: "m-slide-w"
    }),
    $("img.lazy").lazyload({}),
    $("#partners .partners-more").click(function() {
        var $t = $(this),
        $guars = $t.parent().find(".partners-extra-guars");
        $t.hide(),
        $guars.each(function(i, item) {
            var $item = $(item),
            $img = $item.find("img");
            $img.attr("src", $img.attr("data-original")),
            $item.fadeIn()
        })
    })
};