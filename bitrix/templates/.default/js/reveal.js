/*
 * Foundation Responsive Library
 * http://foundation.zurb.com
 * Copyright 2013, ZURB
 * Free to use under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 */

(function ($, window, document, undefined) {
    'use strict';



    // private Fast Selector wrapper,
    // returns jQuery object. Only use where
    // getElementById is not available.
    var S = function (selector, context) {
        if (typeof selector === 'string') {
            if (context) {
                return $(context.querySelectorAll(selector));
            }

            return $(document.querySelectorAll(selector));
        }

        return $(selector, context);
    };

    /*
     https://github.com/paulirish/matchMedia.js
     */

    window.matchMedia = window.matchMedia || (function( doc, undefined ) {

        "use strict";

        var bool,
            docElem = doc.documentElement,
            refNode = docElem.firstElementChild || docElem.firstChild,
        // fakeBody required for <FF4 when executed in <head>
            fakeBody = doc.createElement( "body" ),
            div = doc.createElement( "div" );

        div.id = "mq-test-1";
        div.style.cssText = "position:absolute;top:-100em";
        fakeBody.style.background = "none";
        fakeBody.appendChild(div);

        return function(q){

            div.innerHTML = "&shy;<style media=\"" + q + "\"> #mq-test-1 { width: 42px; }</style>";

            docElem.insertBefore( fakeBody, refNode );
            bool = div.offsetWidth === 42;
            docElem.removeChild( fakeBody );

            return {
                matches: bool,
                media: q
            };

        };

    }( document ));

    /*
     * jquery.requestAnimationFrame
     * https://github.com/gnarf37/jquery-requestAnimationFrame
     * Requires jQuery 1.8+
     *
     * Copyright (c) 2012 Corey Frang
     * Licensed under the MIT license.
     */

    (function( $ ) {

        // requestAnimationFrame polyfill adapted from Erik Möller
        // fixes from Paul Irish and Tino Zijdel
        // http://paulirish.com/2011/requestanimationframe-for-smart-animating/
        // http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating


        var animating,
            lastTime = 0,
            vendors = ['webkit', 'moz'],
            requestAnimationFrame = window.requestAnimationFrame,
            cancelAnimationFrame = window.cancelAnimationFrame;

        for(; lastTime < vendors.length && !requestAnimationFrame; lastTime++) {
            requestAnimationFrame = window[ vendors[lastTime] + "RequestAnimationFrame" ];
            cancelAnimationFrame = cancelAnimationFrame ||
                window[ vendors[lastTime] + "CancelAnimationFrame" ] ||
                window[ vendors[lastTime] + "CancelRequestAnimationFrame" ];
        }

        function raf() {
            if ( animating ) {
                requestAnimationFrame( raf );
                jQuery.fx.tick();
            }
        }

        if ( requestAnimationFrame ) {
            // use rAF
            window.requestAnimationFrame = requestAnimationFrame;
            window.cancelAnimationFrame = cancelAnimationFrame;
            jQuery.fx.timer = function( timer ) {
                if ( timer() && jQuery.timers.push( timer ) && !animating ) {
                    animating = true;
                    raf();
                }
            };

            jQuery.fx.stop = function() {
                animating = false;
            };
        } else {
            // polyfill
            window.requestAnimationFrame = function( callback, element ) {
                var currTime = new Date().getTime(),
                    timeToCall = Math.max( 0, 16 - ( currTime - lastTime ) ),
                    id = window.setTimeout( function() {
                        callback( currTime + timeToCall );
                    }, timeToCall );
                lastTime = currTime + timeToCall;
                return id;
            };

            window.cancelAnimationFrame = function(id) {
                clearTimeout(id);
            };

        }

    }( jQuery ));


    function removeQuotes (string) {
        if (typeof string === 'string' || string instanceof String) {
            string = string.replace(/^[\\/'"]+|(;\s?})+|[\\/'"]+$/g, '');
        }

        return string;
    }

    window.Foundation = {
        name : 'Foundation',

        version : '5.0.0',

        media_queries : {

        },

        stylesheet : $('<style></style>').appendTo('head')[0].sheet,

        init : function (scope, libraries, method, options, response) {
            var library_arr,
                args = [scope, method, options, response],
                responses = [];

            // check RTL
            this.rtl = /rtl/i.test(S('html').attr('dir'));

            // set foundation global scope
            this.scope = scope || this.scope;

            if (libraries && typeof libraries === 'string' && !/reflow/i.test(libraries)) {
                if (this.libs.hasOwnProperty(libraries)) {
                    responses.push(this.init_lib(libraries, args));
                }
            } else {
                for (var lib in this.libs) {
                    responses.push(this.init_lib(lib, libraries));
                }
            }

            return scope;
        },

        init_lib : function (lib, args) {
            if (this.libs.hasOwnProperty(lib)) {
                this.patch(this.libs[lib]);

                if (args && args.hasOwnProperty(lib)) {
                    return this.libs[lib].init.apply(this.libs[lib], [this.scope, args[lib]]);
                }

                return this.libs[lib].init.apply(this.libs[lib], args);
            }

            return function () {};
        },

        patch : function (lib) {
            lib.scope = this.scope;
            lib['data_options'] = this.lib_methods.data_options;
            lib['bindings'] = this.lib_methods.bindings;
            lib['S'] = S;
            lib.rtl = this.rtl;
        },

        inherit : function (scope, methods) {
            var methods_arr = methods.split(' ');

            for (var i = methods_arr.length - 1; i >= 0; i--) {
                if (this.lib_methods.hasOwnProperty(methods_arr[i])) {
                    this.libs[scope.name][methods_arr[i]] = this.lib_methods[methods_arr[i]];
                }
            }
        },

        random_str : function (length) {
            var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.split('');

            if (!length) {
                length = Math.floor(Math.random() * chars.length);
            }

            var str = '';
            for (var i = 0; i < length; i++) {
                str += chars[Math.floor(Math.random() * chars.length)];
            }
            return str;
        },

        libs : {},

        // methods that can be inherited in libraries
        lib_methods : {
            throttle : function(fun, delay) {
                var timer = null;

                return function () {
                    var context = this, args = arguments;

                    clearTimeout(timer);
                    timer = setTimeout(function () {
                        fun.apply(context, args);
                    }, delay);
                };
            },

            // parses data-options attribute
            data_options : function (el) {
                var opts = {}, ii, p, opts_arr, opts_len,
                    data_options = el.data('options');

                if (typeof data_options === 'object') {
                    return data_options;
                }

                opts_arr = (data_options || ':').split(';'),
                    opts_len = opts_arr.length;

                function isNumber (o) {
                    return ! isNaN (o-0) && o !== null && o !== "" && o !== false && o !== true;
                }

                function trim(str) {
                    if (typeof str === 'string') return $.trim(str);
                    return str;
                }

                // parse options
                for (ii = opts_len - 1; ii >= 0; ii--) {
                    p = opts_arr[ii].split(':');

                    if (/true/i.test(p[1])) p[1] = true;
                    if (/false/i.test(p[1])) p[1] = false;
                    if (isNumber(p[1])) p[1] = parseInt(p[1], 10);

                    if (p.length === 2 && p[0].length > 0) {
                        opts[trim(p[0])] = trim(p[1]);
                    }
                }

                return opts;
            },

            delay : function (fun, delay) {
                return setTimeout(fun, delay);
            },

            // test for empty object or array
            empty : function (obj) {
                if (obj.length && obj.length > 0)    return false;
                if (obj.length && obj.length === 0)  return true;

                for (var key in obj) {
                    if (hasOwnProperty.call(obj, key))    return false;
                }

                return true;
            },

            register_media : function(media, media_class) {
                if(Foundation.media_queries[media] === undefined) {
                    $('head').append('<meta class="' + media_class + '">');
                    Foundation.media_queries[media] = removeQuotes($('.' + media_class).css('font-family'));
                }
            },

            addCustomRule : function(rule, media) {
                if(media === undefined) {
                    Foundation.stylesheet.insertRule(rule, Foundation.stylesheet.cssRules.length);
                } else {
                    var query = Foundation.media_queries[media];
                    if(query !== undefined) {

                    }
                }
            },

            loaded : function (image, callback) {
                function loaded () {
                    callback(image[0]);
                }

                function bindLoad () {
                    this.one('load', loaded);

                    if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
                        var src = this.attr( 'src' ),
                            param = src.match( /\?/ ) ? '&' : '?';

                        param += 'random=' + (new Date()).getTime();
                        this.attr('src', src + param);
                    }
                }

                if (!image.attr('src')) {
                    loaded();
                    return;
                }

                if (image[0].complete || image[0].readyState === 4) {
                    loaded();
                } else {
                    bindLoad.call(image);
                }
            },

            bindings : function (method, options) {
                var self = this,
                    should_bind_events = !S(this).data(this.name + '-init');

                if (typeof method === 'string') {
                    return this[method].call(this);
                }

                if (S(this.scope).is('[data-' + this.name +']')) {
                    S(this.scope).data(this.name + '-init', $.extend({}, this.settings, (options || method), this.data_options(S(this.scope))));

                    if (should_bind_events) {
                        this.events(this.scope);
                    }

                } else {
                    S('[data-' + this.name + ']', this.scope).each(function () {
                        var should_bind_events = !S(this).data(self.name + '-init');

                        S(this).data(self.name + '-init', $.extend({}, self.settings, (options || method), self.data_options(S(this))));

                        if (should_bind_events) {
                            self.events(this);
                        }
                    });
                }
            }
        }
    };

    $.fn.foundation = function () {
        var args = Array.prototype.slice.call(arguments, 0);

        return this.each(function () {
            Foundation.init.apply(Foundation, [this].concat(args));
            return this;
        });
    };

}(jQuery, this, this.document));


;(function ($, window, document, undefined) {
    'use strict';

    Foundation.libs.reveal = {
        name : 'reveal',

        version : '5.0.0',

        locked : false,

        settings : {
            animation: 'fadeAndPop',
            animation_speed: 250,
            close_on_background_click: true,
            close_on_esc: true,
            dismiss_modal_class: 'close-reveal-modal',
            bg_class: 'reveal-modal-bg',
            open: function(){},
            opened: function(){},
            close: function(){},
            closed: function(){},
            bg : $('.reveal-modal-bg'),
            css : {
                open : {
                    'opacity': 0,
                    'visibility': 'visible',
                    'display' : 'block'
                },
                close : {
                    'opacity': 1,
                    'visibility': 'hidden',
                    'display': 'none'
                }
            }
        },

        init : function (scope, method, options) {
            Foundation.inherit(this, 'delay');

            this.bindings(method, options);
        },

        events : function (scope) {
            var self = this;

            $('[data-reveal-id]', this.scope)
                .off('.reveal')
                .on('click.fndtn.reveal', function (e) {
                    e.preventDefault();

                    if (!self.locked) {
                        var element = $(this),
                            ajax = element.data('reveal-ajax');

                        self.locked = true;

                        if (typeof ajax === 'undefined') {
                            self.open.call(self, element);
                        } else {
                            var url = ajax === true ? element.attr('href') : ajax;

                            self.open.call(self, element, {url: url});
                        }
                    }
                });

            $(this.scope)
                .off('.reveal')
                .on('click.fndtn.reveal', this.close_targets(), function (e) {

                    e.preventDefault();

                    if (!self.locked) {
                        var settings = $('[data-reveal].open').data('reveal-init'),
                            bg_clicked = $(e.target)[0] === $('.' + settings.bg_class)[0];

                        if (bg_clicked && !settings.close_on_background_click) {
                            return;
                        }

                        self.locked = true;
                        self.close.call(self, bg_clicked ? $('[data-reveal].open') : $(this).closest('[data-reveal]'));
                    }
                });

            if($('[data-reveal]', this.scope).length > 0) {
                $(this.scope)
                    // .off('.reveal')
                    .on('open.fndtn.reveal', this.settings.open)
                    .on('opened.fndtn.reveal', this.settings.opened)
                    .on('opened.fndtn.reveal', this.open_video)
                    .on('close.fndtn.reveal', this.settings.close)
                    .on('closed.fndtn.reveal', this.settings.closed)
                    .on('closed.fndtn.reveal', this.close_video);
            } else {
                $(this.scope)
                    // .off('.reveal')
                    .on('open.fndtn.reveal', '[data-reveal]', this.settings.open)
                    .on('opened.fndtn.reveal', '[data-reveal]', this.settings.opened)
                    .on('opened.fndtn.reveal', '[data-reveal]', this.open_video)
                    .on('close.fndtn.reveal', '[data-reveal]', this.settings.close)
                    .on('closed.fndtn.reveal', '[data-reveal]', this.settings.closed)
                    .on('closed.fndtn.reveal', '[data-reveal]', this.close_video);
            }

            $('body').on('keyup.fndtn.reveal', function ( event ) {
                var open_modal = $('[data-reveal].open'),
                    settings = open_modal.data('reveal-init');
                if ( event.which === 27  && settings.close_on_esc) { // 27 is the keycode for the Escape key
                    open_modal.foundation('reveal', 'close');
                }
            });

            return true;
        },

        open : function (target, ajax_settings) {
            if (target) {
                if (typeof target.selector !== 'undefined') {
                    var modal = $('#' + target.data('reveal-id'));
                } else {
                    var modal = $(this.scope);

                    ajax_settings = target;
                }
            } else {
                var modal = $(this.scope);
            }

            if (!modal.hasClass('open')) {
                var open_modal = $('[data-reveal].open');

                if (typeof modal.data('css-top') === 'undefined') {
                    modal.data('css-top', parseInt(modal.css('top'), 10))
                        .data('offset', this.cache_offset(modal));
                }

                modal.trigger('open');

                if (open_modal.length < 1) {
                    this.toggle_bg();
                }

                if (typeof ajax_settings === 'undefined' || !ajax_settings.url) {
                    this.hide(open_modal, this.settings.css.close);
                    this.show(modal, this.settings.css.open);
                } else {
                    var self = this,
                        old_success = typeof ajax_settings.success !== 'undefined' ? ajax_settings.success : null;

                    $.extend(ajax_settings, {
                        success: function (data, textStatus, jqXHR) {
                            if ( $.isFunction(old_success) ) {
                                old_success(data, textStatus, jqXHR);
                            }

                            modal.html(data);
                            $(modal).foundation('section', 'reflow');

                            self.hide(open_modal, self.settings.css.close);
                            self.show(modal, self.settings.css.open);
                        }
                    });

                    $.ajax(ajax_settings);
                }
            }
        },

        close : function (modal) {

            var modal = modal && modal.length ? modal : $(this.scope),
                open_modals = $('[data-reveal].open');

            if (open_modals.length > 0) {
                this.locked = true;
                modal.trigger('close');
                this.toggle_bg();
                this.hide(open_modals, this.settings.css.close);
            }
        },

        close_targets : function () {
            var base = '.' + this.settings.dismiss_modal_class;

            if (this.settings.close_on_background_click) {
                return base + ', .' + this.settings.bg_class;
            }

            return base;
        },

        toggle_bg : function () {
            if ($('.' + this.settings.bg_class).length === 0) {
                this.settings.bg = $('<div />', {'class': this.settings.bg_class})
                    .appendTo('body');
            }

            if (this.settings.bg.filter(':visible').length > 0) {
                this.hide(this.settings.bg);
            } else {
                this.show(this.settings.bg);
            }
        },

        show : function (el, css) {
            // is modal
            if (css) {
                if (el.parent('body').length === 0) {
                    var placeholder = el.wrap('<div style="display: none;" />').parent();
                    el.on('closed.fndtn.reveal.wrapped', function() {
                        el.detach().appendTo(placeholder);
                        el.unwrap().unbind('closed.fndtn.reveal.wrapped');
                    });

                    el.detach().appendTo('body');
                }

                if (/pop/i.test(this.settings.animation)) {
                    css.top = $(window).scrollTop() - el.data('offset') + 'px';
                    var end_css = {
                        top: $(window).scrollTop() + el.data('css-top') + 'px',
                        opacity: 1
                    };

                    return this.delay(function () {
                        return el
                            .css(css)
                            .animate(end_css, this.settings.animation_speed, 'linear', function () {
                                this.locked = false;
                                el.trigger('opened');
                            }.bind(this))
                            .addClass('open');
                    }.bind(this), this.settings.animation_speed / 2);
                }

                if (/fade/i.test(this.settings.animation)) {
                    var end_css = {opacity: 1};

                    return this.delay(function () {
                        return el
                            .css(css)
                            .animate(end_css, this.settings.animation_speed, 'linear', function () {
                                this.locked = false;
                                el.trigger('opened');
                            }.bind(this))
                            .addClass('open');
                    }.bind(this), this.settings.animation_speed / 2);
                }

                return el.css(css).show().css({opacity: 1}).addClass('open').trigger('opened');
            }

            // should we animate the background?
            if (/fade/i.test(this.settings.animation)) {
                return el.fadeIn(this.settings.animation_speed / 2);
            }

            return el.show();
        },

        hide : function (el, css) {
            // is modal
            if (css) {
                if (/pop/i.test(this.settings.animation)) {
                    var end_css = {
                        top: - $(window).scrollTop() - el.data('offset') + 'px',
                        opacity: 0
                    };

                    return this.delay(function () {
                        return el
                            .animate(end_css, this.settings.animation_speed, 'linear', function () {
                                this.locked = false;
                                el.css(css).trigger('closed');
                            }.bind(this))
                            .removeClass('open');
                    }.bind(this), this.settings.animation_speed / 2);
                }

                if (/fade/i.test(this.settings.animation)) {
                    var end_css = {opacity: 0};

                    return this.delay(function () {
                        return el
                            .animate(end_css, this.settings.animation_speed, 'linear', function () {
                                this.locked = false;
                                el.css(css).trigger('closed');
                            }.bind(this))
                            .removeClass('open');
                    }.bind(this), this.settings.animation_speed / 2);
                }

                return el.hide().css(css).removeClass('open').trigger('closed');
            }

            // should we animate the background?
            if (/fade/i.test(this.settings.animation)) {
                return el.fadeOut(this.settings.animation_speed / 2);
            }

            return el.hide();
        },

        close_video : function (e) {
            var video = $(this).find('.flex-video'),
                iframe = video.find('iframe');

            if (iframe.length > 0) {
                iframe.attr('data-src', iframe[0].src);
                iframe.attr('src', 'about:blank');
                video.hide();
            }
        },

        open_video : function (e) {
            var video = $(this).find('.flex-video'),
                iframe = video.find('iframe');

            if (iframe.length > 0) {
                var data_src = iframe.attr('data-src');
                if (typeof data_src === 'string') {
                    iframe[0].src = iframe.attr('data-src');
                } else {
                    var src = iframe[0].src;
                    iframe[0].src = undefined;
                    iframe[0].src = src;
                }
                video.show();
            }
        },

        cache_offset : function (modal) {
            var offset = modal.show().height() + parseInt(modal.css('top'), 10);

            modal.hide();

            return offset;
        },

        off : function () {
            $(this.scope).off('.fndtn.reveal');
        },

        reflow : function () {}
    };
}(jQuery, this, this.document));
