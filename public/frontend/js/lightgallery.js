/*! lightgallery - v1.3.5 - 2016-09-30
 * http://sachinchoolur.github.io/lightGallery/
 * Copyright (c) 2016 Sachin N; Licensed Apache 2.0 */
!(function (a, b) {
    "function" == typeof define && define.amd
        ? define(["jquery"], function (a) {
            return b(a);
        })
        : "object" == typeof exports
            ? (module.exports = b(require("jquery")))
            : b(jQuery);
})(this, function (a) {
    !(function () {
        "use strict";
        function b(b, d) {
            if (((this.el = b), (this.$el = a(b)), (this.s = a.extend({}, c, d)), this.s.dynamic && "undefined" !== this.s.dynamicEl && this.s.dynamicEl.constructor === Array && !this.s.dynamicEl.length))
                throw "When using dynamic mode, you must also define dynamicEl as an Array.";
            return (
                (this.modules = {}),
                (this.lGalleryOn = !1),
                (this.lgBusy = !1),
                (this.hideBartimeout = !1),
                (this.isTouch = "ontouchstart" in document.documentElement),
                this.s.slideEndAnimatoin && (this.s.hideControlOnEnd = !1),
                this.s.dynamic
                    ? (this.$items = this.s.dynamicEl)
                    : "this" === this.s.selector
                        ? (this.$items = this.$el)
                        : "" !== this.s.selector
                            ? this.s.selectWithin
                                ? (this.$items = a(this.s.selectWithin).find(this.s.selector))
                                : (this.$items = this.$el.find(a(this.s.selector)))
                            : (this.$items = this.$el.children()),
                (this.$slide = ""),
                (this.$outer = ""),
                this.init(),
                this
            );
        }
        var c = {
            mode: "lg-slide",
            cssEasing: "ease",
            easing: "linear",
            speed: 600,
            height: "100%",
            width: "100%",
            addClass: "",
            startClass: "lg-start-zoom",
            backdropDuration: 150,
            hideBarsDelay: 6e3,
            useLeft: !1,
            closable: !0,
            loop: !0,
            escKey: !0,
            keyPress: !0,
            controls: !0,
            slideEndAnimatoin: !0,
            hideControlOnEnd: !1,
            mousewheel: !0,
            getCaptionFromTitleOrAlt: !0,
            appendSubHtmlTo: ".lg-sub-html",
            subHtmlSelectorRelative: !1,
            preload: 1,
            showAfterLoad: !0,
            selector: "",
            selectWithin: "",
            nextHtml: "",
            prevHtml: "",
            index: !1,
            iframeMaxWidth: "100%",
            download: !0,
            counter: !0,
            appendCounterTo: ".lg-toolbar",
            swipeThreshold: 50,
            enableSwipe: !0,
            enableDrag: !0,
            dynamic: !1,
            dynamicEl: [],
            galleryId: 1,
        };
        (b.prototype.init = function () {
            var b = this;
            b.s.preload > b.$items.length && (b.s.preload = b.$items.length);
            var c = window.location.hash;
            c.indexOf("lg=" + this.s.galleryId) > 0 &&
                ((b.index = parseInt(c.split("&slide=")[1], 10)),
                    a("body").addClass("lg-from-hash"),
                    a("body").hasClass("lg-on") ||
                    (setTimeout(function () {
                        b.build(b.index);
                    }),
                        a("body").addClass("lg-on"))),
                b.s.dynamic
                    ? (b.$el.trigger("onBeforeOpen.lg"),
                        (b.index = b.s.index || 0),
                        a("body").hasClass("lg-on") ||
                        setTimeout(function () {
                            b.build(b.index), a("body").addClass("lg-on");
                        }))
                    : b.$items.on("click.lgcustom", function (c) {
                        try {
                            c.preventDefault(), c.preventDefault();
                        } catch (d) {
                            c.returnValue = !1;
                        }
                        b.$el.trigger("onBeforeOpen.lg"), (b.index = b.s.index || b.$items.index(this)), a("body").hasClass("lg-on") || (b.build(b.index), a("body").addClass("lg-on"));
                    });
        }),
            (b.prototype.build = function (b) {
                var c = this;
                c.structure(),
                    a.each(a.fn.lightGallery.modules, function (b) {
                        c.modules[b] = new a.fn.lightGallery.modules[b](c.el);
                    }),
                    c.slide(b, !1, !1),
                    c.s.keyPress && c.keyPress(),
                    c.$items.length > 1 &&
                    (c.arrow(),
                        setTimeout(function () {
                            c.enableDrag(), c.enableSwipe();
                        }, 50),
                        c.s.mousewheel && c.mousewheel()),
                    c.counter(),
                    c.closeGallery(),
                    c.$el.trigger("onAfterOpen.lg"),
                    c.$outer.on("mousemove.lg click.lg touchstart.lg", function () {
                        c.$outer.removeClass("lg-hide-items"),
                            clearTimeout(c.hideBartimeout),
                            (c.hideBartimeout = setTimeout(function () {
                                c.$outer.addClass("lg-hide-items");
                            }, c.s.hideBarsDelay));
                    });
            }),
            (b.prototype.structure = function () {
                var b,
                    c = "",
                    d = "",
                    e = 0,
                    f = "",
                    g = this;
                for (a("body").append('<div class="lg-backdrop"></div>'), a(".lg-backdrop").css("transition-duration", this.s.backdropDuration + "ms"), e = 0; e < this.$items.length; e++) c += '<div class="lg-item"></div>';
                if (
                    (this.s.controls && this.$items.length > 1 && (d = '<div class="lg-actions"><div class="lg-prev lg-icon">' + this.s.prevHtml + '</div><div class="lg-next lg-icon">' + this.s.nextHtml + "</div></div>"),
                        ".lg-sub-html" === this.s.appendSubHtmlTo && (f = '<div class="lg-sub-html"></div>'),
                        (b =
                            '<div class="lg-outer ' +
                            this.s.addClass +
                            " " +
                            this.s.startClass +
                            '"><div class="lg" style="width:' +
                            this.s.width +
                            "; height:" +
                            this.s.height +
                            '"><div class="lg-inner">' +
                            c +
                            '</div><div class="lg-toolbar group"><span class="lg-close lg-icon"></span></div>' +
                            d +
                            f +
                            "</div></div>"),
                        a("body").append(b),
                        (this.$outer = a(".lg-outer")),
                        (this.$slide = this.$outer.find(".lg-item")),
                        this.s.useLeft ? (this.$outer.addClass("lg-use-left"), (this.s.mode = "lg-slide")) : this.$outer.addClass("lg-use-css3"),
                        g.setTop(),
                        a(window).on("resize.lg orientationchange.lg", function () {
                            setTimeout(function () {
                                g.setTop();
                            }, 100);
                        }),
                        this.$slide.eq(this.index).addClass("lg-current"),
                        this.doCss() ? this.$outer.addClass("lg-css3") : (this.$outer.addClass("lg-css"), (this.s.speed = 0)),
                        this.$outer.addClass(this.s.mode),
                        this.s.enableDrag && this.$items.length > 1 && this.$outer.addClass("lg-grab"),
                        this.s.showAfterLoad && this.$outer.addClass("lg-show-after-load"),
                        this.doCss())
                ) {
                    var h = this.$outer.find(".lg-inner");
                    h.css("transition-timing-function", this.s.cssEasing), h.css("transition-duration", this.s.speed + "ms");
                }
                setTimeout(function () {
                    a(".lg-backdrop").addClass("in");
                }),
                    setTimeout(function () {
                        g.$outer.addClass("lg-visible");
                    }, this.s.backdropDuration),
                    this.s.download && this.$outer.find(".lg-toolbar").append('<a id="lg-download" target="_blank" download class="lg-download lg-icon"></a>'),
                    (this.prevScrollTop = a(window).scrollTop());
            }),
            (b.prototype.setTop = function () {
                if ("100%" !== this.s.height) {
                    var b = a(window).height(),
                        c = (b - parseInt(this.s.height, 10)) / 2,
                        d = this.$outer.find(".lg");
                    b >= parseInt(this.s.height, 10) ? d.css("top", c + "px") : d.css("top", "0px");
                }
            }),
            (b.prototype.doCss = function () {
                var a = function () {
                    var a = ["transition", "MozTransition", "WebkitTransition", "OTransition", "msTransition", "KhtmlTransition"],
                        b = document.documentElement,
                        c = 0;
                    for (c = 0; c < a.length; c++) if (a[c] in b.style) return !0;
                };
                return !!a();
            }),
            (b.prototype.isVideo = function (a, b) {
                var c;
                if (((c = this.s.dynamic ? this.s.dynamicEl[b].html : this.$items.eq(b).attr("data-html")), !a && c)) return { html5: !0 };
                var d = a.match(/\/\/(?:www\.)?youtu(?:\.be|be\.com)\/(?:watch\?v=|embed\/)?([a-z0-9\-\_\%]+)/i),
                    e = a.match(/\/\/(?:www\.)?vimeo.com\/([0-9a-z\-_]+)/i),
                    f = a.match(/\/\/(?:www\.)?dai.ly\/([0-9a-z\-_]+)/i),
                    g = a.match(/\/\/(?:www\.)?(?:vk\.com|vkontakte\.ru)\/(?:video_ext\.php\?)(.*)/i);
                return d ? { youtube: d } : e ? { vimeo: e } : f ? { dailymotion: f } : g ? { vk: g } : void 0;
            }),
            (b.prototype.counter = function () {
                this.s.counter && a(this.s.appendCounterTo).append('<div id="lg-counter"><span id="lg-counter-current">' + (parseInt(this.index, 10) + 1) + '</span> / <span id="lg-counter-all">' + this.$items.length + "</span></div>");
            }),
            (b.prototype.addHtml = function (b) {
                var c,
                    d,
                    e = null;
                if (
                    (this.s.dynamic
                        ? this.s.dynamicEl[b].subHtmlUrl
                            ? (c = this.s.dynamicEl[b].subHtmlUrl)
                            : (e = this.s.dynamicEl[b].subHtml)
                        : ((d = this.$items.eq(b)),
                            d.attr("data-sub-html-url") ? (c = d.attr("data-sub-html-url")) : ((e = d.attr("data-sub-html")), this.s.getCaptionFromTitleOrAlt && !e && (e = d.attr("title") || d.find("img").first().attr("alt")))),
                        !c)
                )
                    if ("undefined" != typeof e && null !== e) {
                        var f = e.substring(0, 1);
                        ("." !== f && "#" !== f) || (e = this.s.subHtmlSelectorRelative && !this.s.dynamic ? d.find(e).html() : a(e).html());
                    } else e = "";
                ".lg-sub-html" === this.s.appendSubHtmlTo ? (c ? this.$outer.find(this.s.appendSubHtmlTo).load(c) : this.$outer.find(this.s.appendSubHtmlTo).html(e)) : c ? this.$slide.eq(b).load(c) : this.$slide.eq(b).append(e),
                    "undefined" != typeof e && null !== e && ("" === e ? this.$outer.find(this.s.appendSubHtmlTo).addClass("lg-empty-html") : this.$outer.find(this.s.appendSubHtmlTo).removeClass("lg-empty-html")),
                    this.$el.trigger("onAfterAppendSubHtml.lg", [b]);
            }),
            (b.prototype.preload = function (a) {
                var b = 1,
                    c = 1;
                for (b = 1; b <= this.s.preload && !(b >= this.$items.length - a); b++) this.loadContent(a + b, !1, 0);
                for (c = 1; c <= this.s.preload && !(0 > a - c); c++) this.loadContent(a - c, !1, 0);
            }),
            (b.prototype.loadContent = function (b, c, d) {
                var e,
                    f,
                    g,
                    h,
                    i,
                    j,
                    k = this,
                    l = !1,
                    m = function (b) {
                        for (var c = [], d = [], e = 0; e < b.length; e++) {
                            var g = b[e].split(" ");
                            "" === g[0] && g.splice(0, 1), d.push(g[0]), c.push(g[1]);
                        }
                        for (var h = a(window).width(), i = 0; i < c.length; i++)
                            if (parseInt(c[i], 10) > h) {
                                f = d[i];
                                break;
                            }
                    };
                if (k.s.dynamic) {
                    if ((k.s.dynamicEl[b].poster && ((l = !0), (g = k.s.dynamicEl[b].poster)), (j = k.s.dynamicEl[b].html), (f = k.s.dynamicEl[b].src), k.s.dynamicEl[b].responsive)) {
                        var n = k.s.dynamicEl[b].responsive.split(",");
                        m(n);
                    }
                    (h = k.s.dynamicEl[b].srcset), (i = k.s.dynamicEl[b].sizes);
                } else {
                    if (
                        (k.$items.eq(b).attr("data-poster") && ((l = !0), (g = k.$items.eq(b).attr("data-poster"))),
                            (j = k.$items.eq(b).attr("data-html")),
                            (f = k.$items.eq(b).attr("href") || k.$items.eq(b).attr("data-src")),
                            k.$items.eq(b).attr("data-responsive"))
                    ) {
                        var o = k.$items.eq(b).attr("data-responsive").split(",");
                        m(o);
                    }
                    (h = k.$items.eq(b).attr("data-srcset")), (i = k.$items.eq(b).attr("data-sizes"));
                }
                var p = !1;
                k.s.dynamic ? k.s.dynamicEl[b].iframe && (p = !0) : "true" === k.$items.eq(b).attr("data-iframe") && (p = !0);
                var q = k.isVideo(f, b);
                if (!k.$slide.eq(b).hasClass("lg-loaded")) {
                    if (p)
                        k.$slide
                            .eq(b)
                            .prepend('<div class="lg-video-cont" style="max-width:' + k.s.iframeMaxWidth + '"><div class="lg-video"><iframe class="lg-object" frameborder="0" src="' + f + '"  allowfullscreen="true"></iframe></div></div>');
                    else if (l) {
                        var r = "";
                        (r = q && q.youtube ? "lg-has-youtube" : q && q.vimeo ? "lg-has-vimeo" : "lg-has-html5"),
                            k.$slide.eq(b).prepend('<div class="lg-video-cont ' + r + ' "><div class="lg-video"><span class="lg-video-play"></span><img class="lg-object lg-has-poster" src="' + g + '" /></div></div>');
                    } else
                        q
                            ? (k.$slide.eq(b).prepend('<div class="lg-video-cont "><div class="lg-video"></div></div>'), k.$el.trigger("hasVideo.lg", [b, f, j]))
                            : k.$slide.eq(b).prepend('<div class="lg-img-wrap"><img class="lg-object lg-image" src="' + f + '" /></div>');
                    if ((k.$el.trigger("onAferAppendSlide.lg", [b]), (e = k.$slide.eq(b).find(".lg-object")), i && e.attr("sizes", i), h)) {
                        e.attr("srcset", h);
                        try {
                            picturefill({ elements: [e[0]] });
                        } catch (s) {
                            console.error("Make sure you have included Picturefill version 2");
                        }
                    }
                    ".lg-sub-html" !== this.s.appendSubHtmlTo && k.addHtml(b), k.$slide.eq(b).addClass("lg-loaded");
                }
                k.$slide
                    .eq(b)
                    .find(".lg-object")
                    .on("load.lg error.lg", function () {
                        var c = 0;
                        d && !a("body").hasClass("lg-from-hash") && (c = d),
                            setTimeout(function () {
                                k.$slide.eq(b).addClass("lg-complete"), k.$el.trigger("onSlideItemLoad.lg", [b, d || 0]);
                            }, c);
                    }),
                    q && q.html5 && !l && k.$slide.eq(b).addClass("lg-complete"),
                    c === !0 &&
                    (k.$slide.eq(b).hasClass("lg-complete")
                        ? k.preload(b)
                        : k.$slide
                            .eq(b)
                            .find(".lg-object")
                            .on("load.lg error.lg", function () {
                                k.preload(b);
                            }));
            }),
            (b.prototype.slide = function (b, c, d) {
                var e = this.$outer.find(".lg-current").index(),
                    f = this;
                if (!f.lGalleryOn || e !== b) {
                    var g = this.$slide.length,
                        h = f.lGalleryOn ? this.s.speed : 0,
                        i = !1,
                        j = !1;
                    if (!f.lgBusy) {
                        if (this.s.download) {
                            var k;
                            (k = f.s.dynamic
                                ? f.s.dynamicEl[b].downloadUrl !== !1 && (f.s.dynamicEl[b].downloadUrl || f.s.dynamicEl[b].src)
                                : "false" !== f.$items.eq(b).attr("data-download-url") && (f.$items.eq(b).attr("data-download-url") || f.$items.eq(b).attr("href") || f.$items.eq(b).attr("data-src"))),
                                k ? (a("#lg-download").attr("href", k), f.$outer.removeClass("lg-hide-download")) : f.$outer.addClass("lg-hide-download");
                        }
                        if (
                            (this.$el.trigger("onBeforeSlide.lg", [e, b, c, d]),
                                (f.lgBusy = !0),
                                clearTimeout(f.hideBartimeout),
                                ".lg-sub-html" === this.s.appendSubHtmlTo &&
                                setTimeout(function () {
                                    f.addHtml(b);
                                }, h),
                                this.arrowDisable(b),
                                c)
                        ) {
                            var l = b - 1,
                                m = b + 1;
                            0 === b && e === g - 1 ? ((m = 0), (l = g - 1)) : b === g - 1 && 0 === e && ((m = 0), (l = g - 1)),
                                this.$slide.removeClass("lg-prev-slide lg-current lg-next-slide"),
                                f.$slide.eq(l).addClass("lg-prev-slide"),
                                f.$slide.eq(m).addClass("lg-next-slide"),
                                f.$slide.eq(b).addClass("lg-current");
                        } else
                            f.$outer.addClass("lg-no-trans"),
                                this.$slide.removeClass("lg-prev-slide lg-next-slide"),
                                e > b ? ((j = !0), 0 !== b || e !== g - 1 || d || ((j = !1), (i = !0))) : b > e && ((i = !0), b !== g - 1 || 0 !== e || d || ((j = !0), (i = !1))),
                                j ? (this.$slide.eq(b).addClass("lg-prev-slide"), this.$slide.eq(e).addClass("lg-next-slide")) : i && (this.$slide.eq(b).addClass("lg-next-slide"), this.$slide.eq(e).addClass("lg-prev-slide")),
                                setTimeout(function () {
                                    f.$slide.removeClass("lg-current"), f.$slide.eq(b).addClass("lg-current"), f.$outer.removeClass("lg-no-trans");
                                }, 50);
                        f.lGalleryOn
                            ? (setTimeout(function () {
                                f.loadContent(b, !0, 0);
                            }, this.s.speed + 50),
                                setTimeout(function () {
                                    (f.lgBusy = !1), f.$el.trigger("onAfterSlide.lg", [e, b, c, d]);
                                }, this.s.speed))
                            : (f.loadContent(b, !0, f.s.backdropDuration), (f.lgBusy = !1), f.$el.trigger("onAfterSlide.lg", [e, b, c, d])),
                            (f.lGalleryOn = !0),
                            this.s.counter && a("#lg-counter-current").text(b + 1);
                    }
                }
            }),
            (b.prototype.goToNextSlide = function (a) {
                var b = this;
                b.lgBusy ||
                    (b.index + 1 < b.$slide.length
                        ? (b.index++, b.$el.trigger("onBeforeNextSlide.lg", [b.index]), b.slide(b.index, a, !1))
                        : b.s.loop
                            ? ((b.index = 0), b.$el.trigger("onBeforeNextSlide.lg", [b.index]), b.slide(b.index, a, !1))
                            : b.s.slideEndAnimatoin &&
                            (b.$outer.addClass("lg-right-end"),
                                setTimeout(function () {
                                    b.$outer.removeClass("lg-right-end");
                                }, 400)));
            }),
            (b.prototype.goToPrevSlide = function (a) {
                var b = this;
                b.lgBusy ||
                    (b.index > 0
                        ? (b.index--, b.$el.trigger("onBeforePrevSlide.lg", [b.index, a]), b.slide(b.index, a, !1))
                        : b.s.loop
                            ? ((b.index = b.$items.length - 1), b.$el.trigger("onBeforePrevSlide.lg", [b.index, a]), b.slide(b.index, a, !1))
                            : b.s.slideEndAnimatoin &&
                            (b.$outer.addClass("lg-left-end"),
                                setTimeout(function () {
                                    b.$outer.removeClass("lg-left-end");
                                }, 400)));
            }),
            (b.prototype.keyPress = function () {
                var b = this;
                this.$items.length > 1 &&
                    a(window).on("keyup.lg", function (a) {
                        b.$items.length > 1 && (37 === a.keyCode && (a.preventDefault(), b.goToPrevSlide()), 39 === a.keyCode && (a.preventDefault(), b.goToNextSlide()));
                    }),
                    a(window).on("keydown.lg", function (a) {
                        b.s.escKey === !0 && 27 === a.keyCode && (a.preventDefault(), b.$outer.hasClass("lg-thumb-open") ? b.$outer.removeClass("lg-thumb-open") : b.destroy());
                    });
            }),
            (b.prototype.arrow = function () {
                var a = this;
                this.$outer.find(".lg-prev").on("click.lg", function () {
                    a.goToPrevSlide();
                }),
                    this.$outer.find(".lg-next").on("click.lg", function () {
                        a.goToNextSlide();
                    });
            }),
            (b.prototype.arrowDisable = function (a) {
                !this.s.loop &&
                    this.s.hideControlOnEnd &&
                    (a + 1 < this.$slide.length ? this.$outer.find(".lg-next").removeAttr("disabled").removeClass("disabled") : this.$outer.find(".lg-next").attr("disabled", "disabled").addClass("disabled"),
                        a > 0 ? this.$outer.find(".lg-prev").removeAttr("disabled").removeClass("disabled") : this.$outer.find(".lg-prev").attr("disabled", "disabled").addClass("disabled"));
            }),
            (b.prototype.setTranslate = function (a, b, c) {
                this.s.useLeft ? a.css("left", b) : a.css({ transform: "translate3d(" + b + "px, " + c + "px, 0px)" });
            }),
            (b.prototype.touchMove = function (b, c) {
                var d = c - b;
                Math.abs(d) > 15 &&
                    (this.$outer.addClass("lg-dragging"),
                        this.setTranslate(this.$slide.eq(this.index), d, 0),
                        this.setTranslate(a(".lg-prev-slide"), -this.$slide.eq(this.index).width() + d, 0),
                        this.setTranslate(a(".lg-next-slide"), this.$slide.eq(this.index).width() + d, 0));
            }),
            (b.prototype.touchEnd = function (a) {
                var b = this;
                "lg-slide" !== b.s.mode && b.$outer.addClass("lg-slide"),
                    this.$slide.not(".lg-current, .lg-prev-slide, .lg-next-slide").css("opacity", "0"),
                    setTimeout(function () {
                        b.$outer.removeClass("lg-dragging"),
                            0 > a && Math.abs(a) > b.s.swipeThreshold ? b.goToNextSlide(!0) : a > 0 && Math.abs(a) > b.s.swipeThreshold ? b.goToPrevSlide(!0) : Math.abs(a) < 5 && b.$el.trigger("onSlideClick.lg"),
                            b.$slide.removeAttr("style");
                    }),
                    setTimeout(function () {
                        b.$outer.hasClass("lg-dragging") || "lg-slide" === b.s.mode || b.$outer.removeClass("lg-slide");
                    }, b.s.speed + 100);
            }),
            (b.prototype.enableSwipe = function () {
                var a = this,
                    b = 0,
                    c = 0,
                    d = !1;
                a.s.enableSwipe &&
                    a.isTouch &&
                    a.doCss() &&
                    (a.$slide.on("touchstart.lg", function (c) {
                        a.$outer.hasClass("lg-zoomed") || a.lgBusy || (c.preventDefault(), a.manageSwipeClass(), (b = c.originalEvent.targetTouches[0].pageX));
                    }),
                        a.$slide.on("touchmove.lg", function (e) {
                            a.$outer.hasClass("lg-zoomed") || (e.preventDefault(), (c = e.originalEvent.targetTouches[0].pageX), a.touchMove(b, c), (d = !0));
                        }),
                        a.$slide.on("touchend.lg", function () {
                            a.$outer.hasClass("lg-zoomed") || (d ? ((d = !1), a.touchEnd(c - b)) : a.$el.trigger("onSlideClick.lg"));
                        }));
            }),
            (b.prototype.enableDrag = function () {
                var b = this,
                    c = 0,
                    d = 0,
                    e = !1,
                    f = !1;
                b.s.enableDrag &&
                    !b.isTouch &&
                    b.doCss() &&
                    (b.$slide.on("mousedown.lg", function (d) {
                        b.$outer.hasClass("lg-zoomed") ||
                            ((a(d.target).hasClass("lg-object") || a(d.target).hasClass("lg-video-play")) &&
                                (d.preventDefault(),
                                    b.lgBusy || (b.manageSwipeClass(), (c = d.pageX), (e = !0), (b.$outer.scrollLeft += 1), (b.$outer.scrollLeft -= 1), b.$outer.removeClass("lg-grab").addClass("lg-grabbing"), b.$el.trigger("onDragstart.lg"))));
                    }),
                        a(window).on("mousemove.lg", function (a) {
                            e && ((f = !0), (d = a.pageX), b.touchMove(c, d), b.$el.trigger("onDragmove.lg"));
                        }),
                        a(window).on("mouseup.lg", function (g) {
                            f ? ((f = !1), b.touchEnd(d - c), b.$el.trigger("onDragend.lg")) : (a(g.target).hasClass("lg-object") || a(g.target).hasClass("lg-video-play")) && b.$el.trigger("onSlideClick.lg"),
                                e && ((e = !1), b.$outer.removeClass("lg-grabbing").addClass("lg-grab"));
                        }));
            }),
            (b.prototype.manageSwipeClass = function () {
                var a = this.index + 1,
                    b = this.index - 1,
                    c = this.$slide.length;
                this.s.loop && (0 === this.index ? (b = c - 1) : this.index === c - 1 && (a = 0)),
                    this.$slide.removeClass("lg-next-slide lg-prev-slide"),
                    b > -1 && this.$slide.eq(b).addClass("lg-prev-slide"),
                    this.$slide.eq(a).addClass("lg-next-slide");
            }),
            (b.prototype.mousewheel = function () {
                var a = this;
                a.$outer.on("mousewheel.lg", function (b) {
                    b.deltaY && (b.deltaY > 0 ? a.goToPrevSlide() : a.goToNextSlide(), b.preventDefault());
                });
            }),
            (b.prototype.closeGallery = function () {
                var b = this,
                    c = !1;
                this.$outer.find(".lg-close").on("click.lg", function () {
                    b.destroy();
                }),
                    b.s.closable &&
                    (b.$outer.on("mousedown.lg", function (b) {
                        c = !!(a(b.target).is(".lg-outer") || a(b.target).is(".lg-item ") || a(b.target).is(".lg-img-wrap"));
                    }),
                        b.$outer.on("mouseup.lg", function (d) {
                            (a(d.target).is(".lg-outer") || a(d.target).is(".lg-item ") || (a(d.target).is(".lg-img-wrap") && c)) && (b.$outer.hasClass("lg-dragging") || b.destroy());
                        }));
            }),
            (b.prototype.destroy = function (b) {
                var c = this;
                b || c.$el.trigger("onBeforeClose.lg"),
                    a(window).scrollTop(c.prevScrollTop),
                    b && (c.s.dynamic || this.$items.off("click.lg click.lgcustom"), a.removeData(c.el, "lightGallery")),
                    this.$el.off(".lg.tm"),
                    a.each(a.fn.lightGallery.modules, function (a) {
                        c.modules[a] && c.modules[a].destroy();
                    }),
                    (this.lGalleryOn = !1),
                    clearTimeout(c.hideBartimeout),
                    (this.hideBartimeout = !1),
                    a(window).off(".lg"),
                    a("body").removeClass("lg-on lg-from-hash"),
                    c.$outer && c.$outer.removeClass("lg-visible"),
                    a(".lg-backdrop").removeClass("in"),
                    setTimeout(function () {
                        c.$outer && c.$outer.remove(), a(".lg-backdrop").remove(), b || c.$el.trigger("onCloseAfter.lg");
                    }, c.s.backdropDuration + 50);
            }),
            (a.fn.lightGallery = function (c) {
                return this.each(function () {
                    if (a.data(this, "lightGallery"))
                        try {
                            a(this).data("lightGallery").init();
                        } catch (d) {
                            console.error("lightGallery has not initiated properly");
                        }
                    else a.data(this, "lightGallery", new b(this, c));
                });
            }),
            (a.fn.lightGallery.modules = {});
    })();
});
