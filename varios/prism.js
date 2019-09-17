/* PrismJS 1.17.1
https://prismjs.com/download.html#themes=prism-dark&languages=markup+css+clike+javascript+bash+markup-templating+docker+git+php+markdown+json+jsonp+json5+python+shell-session+yaml+toml&plugins=line-numbers+command-line+keep-markup */
var _self = "undefined" != typeof window ? window : "undefined" != typeof WorkerGlobalScope && self instanceof WorkerGlobalScope ? self : {},
    Prism = function(u) {
        var c = /\blang(?:uage)?-([\w-]+)\b/i,
            a = 0;
        var _ = {
            manual: u.Prism && u.Prism.manual,
            disableWorkerMessageHandler: u.Prism && u.Prism.disableWorkerMessageHandler,
            util: {
                encode: function(e) {
                    return e instanceof L ? new L(e.type, _.util.encode(e.content), e.alias) : Array.isArray(e) ? e.map(_.util.encode) : e.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/\u00a0/g, " ")
                },
                type: function(e) {
                    return Object.prototype.toString.call(e).slice(8, -1)
                },
                objId: function(e) {
                    return e.__id || Object.defineProperty(e, "__id", {
                        value: ++a
                    }), e.__id
                },
                clone: function n(e, r) {
                    var t, a, i = _.util.type(e);
                    switch (r = r || {}, i) {
                        case "Object":
                            if (a = _.util.objId(e), r[a]) return r[a];
                            for (var o in t = {}, r[a] = t, e) e.hasOwnProperty(o) && (t[o] = n(e[o], r));
                            return t;
                        case "Array":
                            return a = _.util.objId(e), r[a] ? r[a] : (t = [], r[a] = t, e.forEach(function(e, a) {
                                t[a] = n(e, r)
                            }), t);
                        default:
                            return e
                    }
                }
            },
            languages: {
                extend: function(e, a) {
                    var n = _.util.clone(_.languages[e]);
                    for (var r in a) n[r] = a[r];
                    return n
                },
                insertBefore: function(n, e, a, r) {
                    var t = (r = r || _.languages)[n],
                        i = {};
                    for (var o in t)
                        if (t.hasOwnProperty(o)) {
                            if (o == e)
                                for (var l in a) a.hasOwnProperty(l) && (i[l] = a[l]);
                            a.hasOwnProperty(o) || (i[o] = t[o])
                        } var s = r[n];
                    return r[n] = i, _.languages.DFS(_.languages, function(e, a) {
                        a === s && e != n && (this[e] = i)
                    }), i
                },
                DFS: function e(a, n, r, t) {
                    t = t || {};
                    var i = _.util.objId;
                    for (var o in a)
                        if (a.hasOwnProperty(o)) {
                            n.call(a, o, a[o], r || o);
                            var l = a[o],
                                s = _.util.type(l);
                            "Object" !== s || t[i(l)] ? "Array" !== s || t[i(l)] || (t[i(l)] = !0, e(l, n, o, t)) : (t[i(l)] = !0, e(l, n, null, t))
                        }
                }
            },
            plugins: {},
            highlightAll: function(e, a) {
                _.highlightAllUnder(document, e, a)
            },
            highlightAllUnder: function(e, a, n) {
                var r = {
                    callback: n,
                    selector: 'code[class*="language-"], [class*="language-"] code, code[class*="lang-"], [class*="lang-"] code'
                };
                _.hooks.run("before-highlightall", r);
                for (var t, i = e.querySelectorAll(r.selector), o = 0; t = i[o++];) _.highlightElement(t, !0 === a, r.callback)
            },
            highlightElement: function(e, a, n) {
                var r = function(e) {
                        for (; e && !c.test(e.className);) e = e.parentNode;
                        return e ? (e.className.match(c) || [, "none"])[1].toLowerCase() : "none"
                    }(e),
                    t = _.languages[r];
                e.className = e.className.replace(c, "").replace(/\s+/g, " ") + " language-" + r;
                var i = e.parentNode;
                i && "pre" === i.nodeName.toLowerCase() && (i.className = i.className.replace(c, "").replace(/\s+/g, " ") + " language-" + r);
                var o = {
                    element: e,
                    language: r,
                    grammar: t,
                    code: e.textContent
                };

                function l(e) {
                    o.highlightedCode = e, _.hooks.run("before-insert", o), o.element.innerHTML = o.highlightedCode, _.hooks.run("after-highlight", o), _.hooks.run("complete", o), n && n.call(o.element)
                }
                if (_.hooks.run("before-sanity-check", o), !o.code) return _.hooks.run("complete", o), void(n && n.call(o.element));
                if (_.hooks.run("before-highlight", o), o.grammar)
                    if (a && u.Worker) {
                        var s = new Worker(_.filename);
                        s.onmessage = function(e) {
                            l(e.data)
                        }, s.postMessage(JSON.stringify({
                            language: o.language,
                            code: o.code,
                            immediateClose: !0
                        }))
                    } else l(_.highlight(o.code, o.grammar, o.language));
                else l(_.util.encode(o.code))
            },
            highlight: function(e, a, n) {
                var r = {
                    code: e,
                    grammar: a,
                    language: n
                };
                return _.hooks.run("before-tokenize", r), r.tokens = _.tokenize(r.code, r.grammar), _.hooks.run("after-tokenize", r), L.stringify(_.util.encode(r.tokens), r.language)
            },
            matchGrammar: function(e, a, n, r, t, i, o) {
                for (var l in n)
                    if (n.hasOwnProperty(l) && n[l]) {
                        var s = n[l];
                        s = Array.isArray(s) ? s : [s];
                        for (var u = 0; u < s.length; ++u) {
                            if (o && o == l + "," + u) return;
                            var c = s[u],
                                g = c.inside,
                                f = !!c.lookbehind,
                                h = !!c.greedy,
                                d = 0,
                                m = c.alias;
                            if (h && !c.pattern.global) {
                                var p = c.pattern.toString().match(/[imsuy]*$/)[0];
                                c.pattern = RegExp(c.pattern.source, p + "g")
                            }
                            c = c.pattern || c;
                            for (var y = r, v = t; y < a.length; v += a[y].length, ++y) {
                                var k = a[y];
                                if (a.length > e.length) return;
                                if (!(k instanceof L)) {
                                    if (h && y != a.length - 1) {
                                        if (c.lastIndex = v, !(x = c.exec(e))) break;
                                        for (var b = x.index + (f && x[1] ? x[1].length : 0), w = x.index + x[0].length, A = y, P = v, O = a.length; A < O && (P < w || !a[A].type && !a[A - 1].greedy); ++A)(P += a[A].length) <= b && (++y, v = P);
                                        if (a[y] instanceof L) continue;
                                        j = A - y, k = e.slice(v, P), x.index -= v
                                    } else {
                                        c.lastIndex = 0;
                                        var x = c.exec(k),
                                            j = 1
                                    }
                                    if (x) {
                                        f && (d = x[1] ? x[1].length : 0);
                                        w = (b = x.index + d) + (x = x[0].slice(d)).length;
                                        var N = k.slice(0, b),
                                            S = k.slice(w),
                                            C = [y, j];
                                        N && (++y, v += N.length, C.push(N));
                                        var E = new L(l, g ? _.tokenize(x, g) : x, m, x, h);
                                        if (C.push(E), S && C.push(S), Array.prototype.splice.apply(a, C), 1 != j && _.matchGrammar(e, a, n, y, v, !0, l + "," + u), i) break
                                    } else if (i) break
                                }
                            }
                        }
                    }
            },
            tokenize: function(e, a) {
                var n = [e],
                    r = a.rest;
                if (r) {
                    for (var t in r) a[t] = r[t];
                    delete a.rest
                }
                return _.matchGrammar(e, n, a, 0, 0, !1), n
            },
            hooks: {
                all: {},
                add: function(e, a) {
                    var n = _.hooks.all;
                    n[e] = n[e] || [], n[e].push(a)
                },
                run: function(e, a) {
                    var n = _.hooks.all[e];
                    if (n && n.length)
                        for (var r, t = 0; r = n[t++];) r(a)
                }
            },
            Token: L
        };

        function L(e, a, n, r, t) {
            this.type = e, this.content = a, this.alias = n, this.length = 0 | (r || "").length, this.greedy = !!t
        }
        if (u.Prism = _, L.stringify = function(e, a) {
                if ("string" == typeof e) return e;
                if (Array.isArray(e)) return e.map(function(e) {
                    return L.stringify(e, a)
                }).join("");
                var n = {
                    type: e.type,
                    content: L.stringify(e.content, a),
                    tag: "span",
                    classes: ["token", e.type],
                    attributes: {},
                    language: a
                };
                if (e.alias) {
                    var r = Array.isArray(e.alias) ? e.alias : [e.alias];
                    Array.prototype.push.apply(n.classes, r)
                }
                _.hooks.run("wrap", n);
                var t = Object.keys(n.attributes).map(function(e) {
                    return e + '="' + (n.attributes[e] || "").replace(/"/g, "&quot;") + '"'
                }).join(" ");
                return "<" + n.tag + ' class="' + n.classes.join(" ") + '"' + (t ? " " + t : "") + ">" + n.content + "</" + n.tag + ">"
            }, !u.document) return u.addEventListener && (_.disableWorkerMessageHandler || u.addEventListener("message", function(e) {
            var a = JSON.parse(e.data),
                n = a.language,
                r = a.code,
                t = a.immediateClose;
            u.postMessage(_.highlight(r, _.languages[n], n)), t && u.close()
        }, !1)), _;
        var e = document.currentScript || [].slice.call(document.getElementsByTagName("script")).pop();
        if (e && (_.filename = e.src, e.hasAttribute("data-manual") && (_.manual = !0)), !_.manual) {
            function n() {
                _.manual || _.highlightAll()
            }
            "loading" !== document.readyState ? window.requestAnimationFrame ? window.requestAnimationFrame(n) : window.setTimeout(n, 16) : document.addEventListener("DOMContentLoaded", n)
        }
        return _
    }(_self);
"undefined" != typeof module && module.exports && (module.exports = Prism), "undefined" != typeof global && (global.Prism = Prism);
Prism.languages.markup = {
    comment: /<!--[\s\S]*?-->/,
    prolog: /<\?[\s\S]+?\?>/,
    doctype: /<!DOCTYPE[\s\S]+?>/i,
    cdata: /<!\[CDATA\[[\s\S]*?]]>/i,
    tag: {
        pattern: /<\/?(?!\d)[^\s>\/=$<%]+(?:\s(?:\s*[^\s>\/=]+(?:\s*=\s*(?:"[^"]*"|'[^']*'|[^\s'">=]+(?=[\s>]))|(?=[\s/>])))+)?\s*\/?>/i,
        greedy: !0,
        inside: {
            tag: {
                pattern: /^<\/?[^\s>\/]+/i,
                inside: {
                    punctuation: /^<\/?/,
                    namespace: /^[^\s>\/:]+:/
                }
            },
            "attr-value": {
                pattern: /=\s*(?:"[^"]*"|'[^']*'|[^\s'">=]+)/i,
                inside: {
                    punctuation: [/^=/, {
                        pattern: /^(\s*)["']|["']$/,
                        lookbehind: !0
                    }]
                }
            },
            punctuation: /\/?>/,
            "attr-name": {
                pattern: /[^\s>\/]+/,
                inside: {
                    namespace: /^[^\s>\/:]+:/
                }
            }
        }
    },
    entity: /&#?[\da-z]{1,8};/i
}, Prism.languages.markup.tag.inside["attr-value"].inside.entity = Prism.languages.markup.entity, Prism.hooks.add("wrap", function(a) {
    "entity" === a.type && (a.attributes.title = a.content.replace(/&amp;/, "&"))
}), Object.defineProperty(Prism.languages.markup.tag, "addInlined", {
    value: function(a, e) {
        var s = {};
        s["language-" + e] = {
            pattern: /(^<!\[CDATA\[)[\s\S]+?(?=\]\]>$)/i,
            lookbehind: !0,
            inside: Prism.languages[e]
        }, s.cdata = /^<!\[CDATA\[|\]\]>$/i;
        var n = {
            "included-cdata": {
                pattern: /<!\[CDATA\[[\s\S]*?\]\]>/i,
                inside: s
            }
        };
        n["language-" + e] = {
            pattern: /[\s\S]+/,
            inside: Prism.languages[e]
        };
        var i = {};
        i[a] = {
            pattern: RegExp("(<__[\\s\\S]*?>)(?:<!\\[CDATA\\[[\\s\\S]*?\\]\\]>\\s*|[\\s\\S])*?(?=<\\/__>)".replace(/__/g, a), "i"),
            lookbehind: !0,
            greedy: !0,
            inside: n
        }, Prism.languages.insertBefore("markup", "cdata", i)
    }
}), Prism.languages.xml = Prism.languages.extend("markup", {}), Prism.languages.html = Prism.languages.markup, Prism.languages.mathml = Prism.languages.markup, Prism.languages.svg = Prism.languages.markup;
! function(s) {
    var t = /("|')(?:\\(?:\r\n|[\s\S])|(?!\1)[^\\\r\n])*\1/;
    s.languages.css = {
        comment: /\/\*[\s\S]*?\*\//,
        atrule: {
            pattern: /@[\w-]+[\s\S]*?(?:;|(?=\s*\{))/,
            inside: {
                rule: /@[\w-]+/
            }
        },
        url: {
            pattern: RegExp("url\\((?:" + t.source + "|[^\n\r()]*)\\)", "i"),
            inside: {
                function: /^url/i,
                punctuation: /^\(|\)$/
            }
        },
        selector: RegExp("[^{}\\s](?:[^{};\"']|" + t.source + ")*?(?=\\s*\\{)"),
        string: {
            pattern: t,
            greedy: !0
        },
        property: /[-_a-z\xA0-\uFFFF][-\w\xA0-\uFFFF]*(?=\s*:)/i,
        important: /!important\b/i,
        function: /[-a-z0-9]+(?=\()/i,
        punctuation: /[(){};:,]/
    }, s.languages.css.atrule.inside.rest = s.languages.css;
    var e = s.languages.markup;
    e && (e.tag.addInlined("style", "css"), s.languages.insertBefore("inside", "attr-value", {
        "style-attr": {
            pattern: /\s*style=("|')(?:\\[\s\S]|(?!\1)[^\\])*\1/i,
            inside: {
                "attr-name": {
                    pattern: /^\s*style/i,
                    inside: e.tag.inside
                },
                punctuation: /^\s*=\s*['"]|['"]\s*$/,
                "attr-value": {
                    pattern: /.+/i,
                    inside: s.languages.css
                }
            },
            alias: "language-css"
        }
    }, e.tag))
}(Prism);
Prism.languages.clike = {
    comment: [{
        pattern: /(^|[^\\])\/\*[\s\S]*?(?:\*\/|$)/,
        lookbehind: !0
    }, {
        pattern: /(^|[^\\:])\/\/.*/,
        lookbehind: !0,
        greedy: !0
    }],
    string: {
        pattern: /(["'])(?:\\(?:\r\n|[\s\S])|(?!\1)[^\\\r\n])*\1/,
        greedy: !0
    },
    "class-name": {
        pattern: /((?:\b(?:class|interface|extends|implements|trait|instanceof|new)\s+)|(?:catch\s+\())[\w.\\]+/i,
        lookbehind: !0,
        inside: {
            punctuation: /[.\\]/
        }
    },
    keyword: /\b(?:if|else|while|do|for|return|in|instanceof|function|new|try|throw|catch|finally|null|break|continue)\b/,
    boolean: /\b(?:true|false)\b/,
    function: /\w+(?=\()/,
    number: /\b0x[\da-f]+\b|(?:\b\d+\.?\d*|\B\.\d+)(?:e[+-]?\d+)?/i,
    operator: /--?|\+\+?|!=?=?|<=?|>=?|==?=?|&&?|\|\|?|\?|\*|\/|~|\^|%/,
    punctuation: /[{}[\];(),.:]/
};
Prism.languages.javascript = Prism.languages.extend("clike", {
    "class-name": [Prism.languages.clike["class-name"], {
        pattern: /(^|[^$\w\xA0-\uFFFF])[_$A-Z\xA0-\uFFFF][$\w\xA0-\uFFFF]*(?=\.(?:prototype|constructor))/,
        lookbehind: !0
    }],
    keyword: [{
        pattern: /((?:^|})\s*)(?:catch|finally)\b/,
        lookbehind: !0
    }, {
        pattern: /(^|[^.])\b(?:as|async(?=\s*(?:function\b|\(|[$\w\xA0-\uFFFF]|$))|await|break|case|class|const|continue|debugger|default|delete|do|else|enum|export|extends|for|from|function|get|if|implements|import|in|instanceof|interface|let|new|null|of|package|private|protected|public|return|set|static|super|switch|this|throw|try|typeof|undefined|var|void|while|with|yield)\b/,
        lookbehind: !0
    }],
    number: /\b(?:(?:0[xX](?:[\dA-Fa-f](?:_[\dA-Fa-f])?)+|0[bB](?:[01](?:_[01])?)+|0[oO](?:[0-7](?:_[0-7])?)+)n?|(?:\d(?:_\d)?)+n|NaN|Infinity)\b|(?:\b(?:\d(?:_\d)?)+\.?(?:\d(?:_\d)?)*|\B\.(?:\d(?:_\d)?)+)(?:[Ee][+-]?(?:\d(?:_\d)?)+)?/,
    function: /#?[_$a-zA-Z\xA0-\uFFFF][$\w\xA0-\uFFFF]*(?=\s*(?:\.\s*(?:apply|bind|call)\s*)?\()/,
    operator: /-[-=]?|\+[+=]?|!=?=?|<<?=?|>>?>?=?|=(?:==?|>)?|&[&=]?|\|[|=]?|\*\*?=?|\/=?|~|\^=?|%=?|\?|\.{3}/
}), Prism.languages.javascript["class-name"][0].pattern = /(\b(?:class|interface|extends|implements|instanceof|new)\s+)[\w.\\]+/, Prism.languages.insertBefore("javascript", "keyword", {
    regex: {
        pattern: /((?:^|[^$\w\xA0-\uFFFF."'\])\s])\s*)\/(\[(?:[^\]\\\r\n]|\\.)*]|\\.|[^/\\\[\r\n])+\/[gimyus]{0,6}(?=\s*($|[\r\n,.;})\]]))/,
        lookbehind: !0,
        greedy: !0
    },
    "function-variable": {
        pattern: /#?[_$a-zA-Z\xA0-\uFFFF][$\w\xA0-\uFFFF]*(?=\s*[=:]\s*(?:async\s*)?(?:\bfunction\b|(?:\((?:[^()]|\([^()]*\))*\)|[_$a-zA-Z\xA0-\uFFFF][$\w\xA0-\uFFFF]*)\s*=>))/,
        alias: "function"
    },
    parameter: [{
        pattern: /(function(?:\s+[_$A-Za-z\xA0-\uFFFF][$\w\xA0-\uFFFF]*)?\s*\(\s*)(?!\s)(?:[^()]|\([^()]*\))+?(?=\s*\))/,
        lookbehind: !0,
        inside: Prism.languages.javascript
    }, {
        pattern: /[_$a-z\xA0-\uFFFF][$\w\xA0-\uFFFF]*(?=\s*=>)/i,
        inside: Prism.languages.javascript
    }, {
        pattern: /(\(\s*)(?!\s)(?:[^()]|\([^()]*\))+?(?=\s*\)\s*=>)/,
        lookbehind: !0,
        inside: Prism.languages.javascript
    }, {
        pattern: /((?:\b|\s|^)(?!(?:as|async|await|break|case|catch|class|const|continue|debugger|default|delete|do|else|enum|export|extends|finally|for|from|function|get|if|implements|import|in|instanceof|interface|let|new|null|of|package|private|protected|public|return|set|static|super|switch|this|throw|try|typeof|undefined|var|void|while|with|yield)(?![$\w\xA0-\uFFFF]))(?:[_$A-Za-z\xA0-\uFFFF][$\w\xA0-\uFFFF]*\s*)\(\s*)(?!\s)(?:[^()]|\([^()]*\))+?(?=\s*\)\s*\{)/,
        lookbehind: !0,
        inside: Prism.languages.javascript
    }],
    constant: /\b[A-Z](?:[A-Z_]|\dx?)*\b/
}), Prism.languages.insertBefore("javascript", "string", {
    "template-string": {
        pattern: /`(?:\\[\s\S]|\${(?:[^{}]|{(?:[^{}]|{[^}]*})*})+}|(?!\${)[^\\`])*`/,
        greedy: !0,
        inside: {
            "template-punctuation": {
                pattern: /^`|`$/,
                alias: "string"
            },
            interpolation: {
                pattern: /((?:^|[^\\])(?:\\{2})*)\${(?:[^{}]|{(?:[^{}]|{[^}]*})*})+}/,
                lookbehind: !0,
                inside: {
                    "interpolation-punctuation": {
                        pattern: /^\${|}$/,
                        alias: "punctuation"
                    },
                    rest: Prism.languages.javascript
                }
            },
            string: /[\s\S]+/
        }
    }
}), Prism.languages.markup && Prism.languages.markup.tag.addInlined("script", "javascript"), Prism.languages.js = Prism.languages.javascript;
! function(e) {
    var t = "\\b(?:BASH|BASHOPTS|BASH_ALIASES|BASH_ARGC|BASH_ARGV|BASH_CMDS|BASH_COMPLETION_COMPAT_DIR|BASH_LINENO|BASH_REMATCH|BASH_SOURCE|BASH_VERSINFO|BASH_VERSION|COLORTERM|COLUMNS|COMP_WORDBREAKS|DBUS_SESSION_BUS_ADDRESS|DEFAULTS_PATH|DESKTOP_SESSION|DIRSTACK|DISPLAY|EUID|GDMSESSION|GDM_LANG|GNOME_KEYRING_CONTROL|GNOME_KEYRING_PID|GPG_AGENT_INFO|GROUPS|HISTCONTROL|HISTFILE|HISTFILESIZE|HISTSIZE|HOME|HOSTNAME|HOSTTYPE|IFS|INSTANCE|JOB|LANG|LANGUAGE|LC_ADDRESS|LC_ALL|LC_IDENTIFICATION|LC_MEASUREMENT|LC_MONETARY|LC_NAME|LC_NUMERIC|LC_PAPER|LC_TELEPHONE|LC_TIME|LESSCLOSE|LESSOPEN|LINES|LOGNAME|LS_COLORS|MACHTYPE|MAILCHECK|MANDATORY_PATH|NO_AT_BRIDGE|OLDPWD|OPTERR|OPTIND|ORBIT_SOCKETDIR|OSTYPE|PAPERSIZE|PATH|PIPESTATUS|PPID|PS1|PS2|PS3|PS4|PWD|RANDOM|REPLY|SECONDS|SELINUX_INIT|SESSION|SESSIONTYPE|SESSION_MANAGER|SHELL|SHELLOPTS|SHLVL|SSH_AUTH_SOCK|TERM|UID|UPSTART_EVENTS|UPSTART_INSTANCE|UPSTART_JOB|UPSTART_SESSION|USER|WINDOWID|XAUTHORITY|XDG_CONFIG_DIRS|XDG_CURRENT_DESKTOP|XDG_DATA_DIRS|XDG_GREETER_DATA_DIR|XDG_MENU_PREFIX|XDG_RUNTIME_DIR|XDG_SEAT|XDG_SEAT_PATH|XDG_SESSION_DESKTOP|XDG_SESSION_ID|XDG_SESSION_PATH|XDG_SESSION_TYPE|XDG_VTNR|XMODIFIERS)\\b",
        n = {
            environment: {
                pattern: RegExp("\\$" + t),
                alias: "constant"
            },
            variable: [{
                pattern: /\$?\(\([\s\S]+?\)\)/,
                greedy: !0,
                inside: {
                    variable: [{
                        pattern: /(^\$\(\([\s\S]+)\)\)/,
                        lookbehind: !0
                    }, /^\$\(\(/],
                    number: /\b0x[\dA-Fa-f]+\b|(?:\b\d+\.?\d*|\B\.\d+)(?:[Ee]-?\d+)?/,
                    operator: /--?|-=|\+\+?|\+=|!=?|~|\*\*?|\*=|\/=?|%=?|<<=?|>>=?|<=?|>=?|==?|&&?|&=|\^=?|\|\|?|\|=|\?|:/,
                    punctuation: /\(\(?|\)\)?|,|;/
                }
            }, {
                pattern: /\$\((?:\([^)]+\)|[^()])+\)|`[^`]+`/,
                greedy: !0,
                inside: {
                    variable: /^\$\(|^`|\)$|`$/
                }
            }, {
                pattern: /\$\{[^}]+\}/,
                greedy: !0,
                inside: {
                    operator: /:[-=?+]?|[!\/]|##?|%%?|\^\^?|,,?/,
                    punctuation: /[\[\]]/,
                    environment: {
                        pattern: RegExp("(\\{)" + t),
                        lookbehind: !0,
                        alias: "constant"
                    }
                }
            }, /\$(?:\w+|[#?*!@$])/],
            entity: /\\(?:[abceEfnrtv\\"]|O?[0-7]{1,3}|x[0-9a-fA-F]{1,2}|u[0-9a-fA-F]{4}|U[0-9a-fA-F]{8})/
        };
    e.languages.bash = {
        shebang: {
            pattern: /^#!\s*\/.*/,
            alias: "important"
        },
        comment: {
            pattern: /(^|[^"{\\$])#.*/,
            lookbehind: !0
        },
        "function-name": [{
            pattern: /(\bfunction\s+)\w+(?=(?:\s*\(?:\s*\))?\s*\{)/,
            lookbehind: !0,
            alias: "function"
        }, {
            pattern: /\b\w+(?=\s*\(\s*\)\s*\{)/,
            alias: "function"
        }],
        "for-or-select": {
            pattern: /(\b(?:for|select)\s+)\w+(?=\s+in\s)/,
            alias: "variable",
            lookbehind: !0
        },
        "assign-left": {
            pattern: /(^|[\s;|&]|[<>]\()\w+(?=\+?=)/,
            inside: {
                environment: {
                    pattern: RegExp("(^|[\\s;|&]|[<>]\\()" + t),
                    lookbehind: !0,
                    alias: "constant"
                }
            },
            alias: "variable",
            lookbehind: !0
        },
        string: [{
            pattern: /((?:^|[^<])<<-?\s*)(\w+?)\s*(?:\r?\n|\r)(?:[\s\S])*?(?:\r?\n|\r)\2/,
            lookbehind: !0,
            greedy: !0,
            inside: n
        }, {
            pattern: /((?:^|[^<])<<-?\s*)(["'])(\w+)\2\s*(?:\r?\n|\r)(?:[\s\S])*?(?:\r?\n|\r)\3/,
            lookbehind: !0,
            greedy: !0
        }, {
            pattern: /(["'])(?:\\[\s\S]|\$\([^)]+\)|`[^`]+`|(?!\1)[^\\])*\1/,
            greedy: !0,
            inside: n
        }],
        environment: {
            pattern: RegExp("\\$?" + t),
            alias: "constant"
        },
        variable: n.variable,
        function: {
            pattern: /(^|[\s;|&]|[<>]\()(?:add|apropos|apt|aptitude|apt-cache|apt-get|aspell|automysqlbackup|awk|basename|bash|bc|bconsole|bg|bzip2|cal|cat|cfdisk|chgrp|chkconfig|chmod|chown|chroot|cksum|clear|cmp|column|comm|cp|cron|crontab|csplit|curl|cut|date|dc|dd|ddrescue|debootstrap|df|diff|diff3|dig|dir|dircolors|dirname|dirs|dmesg|du|egrep|eject|env|ethtool|expand|expect|expr|fdformat|fdisk|fg|fgrep|file|find|fmt|fold|format|free|fsck|ftp|fuser|gawk|git|gparted|grep|groupadd|groupdel|groupmod|groups|grub-mkconfig|gzip|halt|head|hg|history|host|hostname|htop|iconv|id|ifconfig|ifdown|ifup|import|install|ip|jobs|join|kill|killall|less|link|ln|locate|logname|logrotate|look|lpc|lpr|lprint|lprintd|lprintq|lprm|ls|lsof|lynx|make|man|mc|mdadm|mkconfig|mkdir|mke2fs|mkfifo|mkfs|mkisofs|mknod|mkswap|mmv|more|most|mount|mtools|mtr|mutt|mv|nano|nc|netstat|nice|nl|nohup|notify-send|npm|nslookup|op|open|parted|passwd|paste|pathchk|ping|pkill|pnpm|popd|pr|printcap|printenv|ps|pushd|pv|quota|quotacheck|quotactl|ram|rar|rcp|reboot|remsync|rename|renice|rev|rm|rmdir|rpm|rsync|scp|screen|sdiff|sed|sendmail|seq|service|sftp|sh|shellcheck|shuf|shutdown|sleep|slocate|sort|split|ssh|stat|strace|su|sudo|sum|suspend|swapon|sync|tac|tail|tar|tee|time|timeout|top|touch|tr|traceroute|tsort|tty|umount|uname|unexpand|uniq|units|unrar|unshar|unzip|update-grub|uptime|useradd|userdel|usermod|users|uudecode|uuencode|v|vdir|vi|vim|virsh|vmstat|wait|watch|wc|wget|whereis|which|who|whoami|write|xargs|xdg-open|yarn|yes|zenity|zip|zsh|zypper)(?=$|[)\s;|&])/,
            lookbehind: !0
        },
        keyword: {
            pattern: /(^|[\s;|&]|[<>]\()(?:if|then|else|elif|fi|for|while|in|case|esac|function|select|do|done|until)(?=$|[)\s;|&])/,
            lookbehind: !0
        },
        builtin: {
            pattern: /(^|[\s;|&]|[<>]\()(?:\.|:|break|cd|continue|eval|exec|exit|export|getopts|hash|pwd|readonly|return|shift|test|times|trap|umask|unset|alias|bind|builtin|caller|command|declare|echo|enable|help|let|local|logout|mapfile|printf|read|readarray|source|type|typeset|ulimit|unalias|set|shopt)(?=$|[)\s;|&])/,
            lookbehind: !0,
            alias: "class-name"
        },
        boolean: {
            pattern: /(^|[\s;|&]|[<>]\()(?:true|false)(?=$|[)\s;|&])/,
            lookbehind: !0
        },
        "file-descriptor": {
            pattern: /\B&\d\b/,
            alias: "important"
        },
        operator: {
            pattern: /\d?<>|>\||\+=|==?|!=?|=~|<<[<-]?|[&\d]?>>|\d?[<>]&?|&[>&]?|\|[&|]?|<=?|>=?/,
            inside: {
                "file-descriptor": {
                    pattern: /^\d/,
                    alias: "important"
                }
            }
        },
        punctuation: /\$?\(\(?|\)\)?|\.\.|[{}[\];\\]/,
        number: {
            pattern: /(^|\s)(?:[1-9]\d*|0)(?:[.,]\d+)?\b/,
            lookbehind: !0
        }
    };
    for (var a = ["comment", "function-name", "for-or-select", "assign-left", "string", "environment", "function", "keyword", "builtin", "boolean", "file-descriptor", "operator", "punctuation", "number"], r = n.variable[1].inside, s = 0; s < a.length; s++) r[a[s]] = e.languages.bash[a[s]];
    e.languages.shell = e.languages.bash
}(Prism);
! function(h) {
    function v(e, n) {
        return "___" + e.toUpperCase() + n + "___"
    }
    Object.defineProperties(h.languages["markup-templating"] = {}, {
        buildPlaceholders: {
            value: function(a, r, e, o) {
                if (a.language === r) {
                    var c = a.tokenStack = [];
                    a.code = a.code.replace(e, function(e) {
                        if ("function" == typeof o && !o(e)) return e;
                        for (var n, t = c.length; - 1 !== a.code.indexOf(n = v(r, t));) ++t;
                        return c[t] = e, n
                    }), a.grammar = h.languages.markup
                }
            }
        },
        tokenizePlaceholders: {
            value: function(p, k) {
                if (p.language === k && p.tokenStack) {
                    p.grammar = h.languages[k];
                    var m = 0,
                        d = Object.keys(p.tokenStack);
                    ! function e(n) {
                        for (var t = 0; t < n.length && !(m >= d.length); t++) {
                            var a = n[t];
                            if ("string" == typeof a || a.content && "string" == typeof a.content) {
                                var r = d[m],
                                    o = p.tokenStack[r],
                                    c = "string" == typeof a ? a : a.content,
                                    i = v(k, r),
                                    u = c.indexOf(i);
                                if (-1 < u) {
                                    ++m;
                                    var g = c.substring(0, u),
                                        l = new h.Token(k, h.tokenize(o, p.grammar), "language-" + k, o),
                                        s = c.substring(u + i.length),
                                        f = [];
                                    g && f.push.apply(f, e([g])), f.push(l), s && f.push.apply(f, e([s])), "string" == typeof a ? n.splice.apply(n, [t, 1].concat(f)) : a.content = f
                                }
                            } else a.content && e(a.content)
                        }
                        return n
                    }(p.tokens)
                }
            }
        }
    })
}(Prism);
Prism.languages.docker = {
    keyword: {
        pattern: /(^\s*)(?:ADD|ARG|CMD|COPY|ENTRYPOINT|ENV|EXPOSE|FROM|HEALTHCHECK|LABEL|MAINTAINER|ONBUILD|RUN|SHELL|STOPSIGNAL|USER|VOLUME|WORKDIR)(?=\s)/im,
        lookbehind: !0
    },
    string: /("|')(?:(?!\1)[^\\\r\n]|\\(?:\r\n|[\s\S]))*\1/,
    comment: /#.*/,
    punctuation: /---|\.\.\.|[:[\]{}\-,|>?]/
}, Prism.languages.dockerfile = Prism.languages.docker;
Prism.languages.git = {
    comment: /^#.*/m,
    deleted: /^[-–].*/m,
    inserted: /^\+.*/m,
    string: /("|')(?:\\.|(?!\1)[^\\\r\n])*\1/m,
    command: {
        pattern: /^.*\$ git .*$/m,
        inside: {
            parameter: /\s--?\w+/m
        }
    },
    coord: /^@@.*@@$/m,
    commit_sha1: /^commit \w{40}$/m
};
! function(n) {
    n.languages.php = n.languages.extend("clike", {
		function2: /\b(?:print|isset)\b/i,   
        keyword: /\b(?:__halt_compiler|abstract|and|array|as|break|callable|case|catch|class|clone|const|continue|declare|default|die|do|echo|else|elseif|empty|enddeclare|endfor|endforeach|endif|endswitch|endwhile|eval|exit|extends|final|finally|for|foreach|function|global|goto|if|implements|include|include_once|instanceof|insteadof|interface|list|namespace|new|or|parent|private|protected|public|require|require_once|return|static|switch|throw|trait|try|unset|use|var|while|xor|yield)\b/i,
        boolean: {
            pattern: /\b(?:false|true)\b/i,
            alias: "constant"
        },
        constant: [/\b[A-Z_][A-Z0-9_]*\b/, /\b(?:null)\b/i],
        comment: {
            pattern: /(^|[^\\])(?:\/\*[\s\S]*?\*\/|\/\/.*)/,
            lookbehind: !0
        }
    }), n.languages.insertBefore("php", "string", {
        "shell-comment": {
            pattern: /(^|[^\\])#.*/,
            lookbehind: !0,
            alias: "comment"
        }
    }), n.languages.insertBefore("php", "comment", {
        delimiter: {
            pattern: /\?>$|^<\?(?:php(?=\s)|=)?/i,
            alias: "important"
        }
    }), n.languages.insertBefore("php", "keyword", {
        variable: /\$+(?:\w+\b|(?={))/i,
        package: {
            pattern: /(\\|namespace\s+|use\s+)[\w\\]+/,
            lookbehind: !0,
            inside: {
                punctuation: /\\/
            }
        }
    }), n.languages.insertBefore("php", "operator", {
        property: {
            pattern: /(->)[\w]+/,
            lookbehind: !0
        }
    });
    var e = {
        pattern: /{\$(?:{(?:{[^{}]+}|[^{}]+)}|[^{}])+}|(^|[^\\{])\$+(?:\w+(?:\[.+?]|->\w+)*)/,
        lookbehind: !0,
        inside: {
            rest: n.languages.php
        }
    };
    n.languages.insertBefore("php", "string", {
        "nowdoc-string": {
            pattern: /<<<'([^']+)'(?:\r\n?|\n)(?:.*(?:\r\n?|\n))*?\1;/,
            greedy: !0,
            alias: "string",
            inside: {
                delimiter: {
                    pattern: /^<<<'[^']+'|[a-z_]\w*;$/i,
                    alias: "symbol",
                    inside: {
                        punctuation: /^<<<'?|[';]$/
                    }
                }
            }
        },
        "heredoc-string": {
            pattern: /<<<(?:"([^"]+)"(?:\r\n?|\n)(?:.*(?:\r\n?|\n))*?\1;|([a-z_]\w*)(?:\r\n?|\n)(?:.*(?:\r\n?|\n))*?\2;)/i,
            greedy: !0,
            alias: "string",
            inside: {
                delimiter: {
                    pattern: /^<<<(?:"[^"]+"|[a-z_]\w*)|[a-z_]\w*;$/i,
                    alias: "symbol",
                    inside: {
                        punctuation: /^<<<"?|[";]$/
                    }
                },
                interpolation: e
            }
        },
        "single-quoted-string": {
            pattern: /'(?:\\[\s\S]|[^\\'])*'/,
            greedy: !0,
            alias: "string"
        },
        "double-quoted-string": {
            pattern: /"(?:\\[\s\S]|[^\\"])*"/,
            greedy: !0,
            alias: "string",
            inside: {
                interpolation: e
            }
        }
    }), delete n.languages.php.string, n.hooks.add("before-tokenize", function(e) {
        if (/<\?/.test(e.code)) {
            n.languages["markup-templating"].buildPlaceholders(e, "php", /<\?(?:[^"'/#]|\/(?![*/])|("|')(?:\\[\s\S]|(?!\1)[^\\])*\1|(?:\/\/|#)(?:[^?\n\r]|\?(?!>))*|\/\*[\s\S]*?(?:\*\/|$))*?(?:\?>|$)/gi)
        }
    }), n.hooks.add("after-tokenize", function(e) {
        n.languages["markup-templating"].tokenizePlaceholders(e, "php")
    })
}(Prism);
! function(d) {
    function n(n, e) {
        return n = n.replace(/<inner>/g, "(?:\\\\.|[^\\\\\\n\r]|(?:\r?\n|\r)(?!\r?\n|\r))"), e && (n = n + "|" + n.replace(/_/g, "\\*")), RegExp("((?:^|[^\\\\])(?:\\\\{2})*)(?:" + n + ")")
    }
    var e = "(?:\\\\.|``.+?``|`[^`\r\\n]+`|[^\\\\|\r\\n`])+",
        t = "\\|?__(?:\\|__)+\\|?(?:(?:\r?\n|\r)|$)".replace(/__/g, e),
        a = "\\|?[ \t]*:?-{3,}:?[ \t]*(?:\\|[ \t]*:?-{3,}:?[ \t]*)+\\|?(?:\r?\n|\r)";
    d.languages.markdown = d.languages.extend("markup", {}), d.languages.insertBefore("markdown", "prolog", {
        blockquote: {
            pattern: /^>(?:[\t ]*>)*/m,
            alias: "punctuation"
        },
        table: {
            pattern: RegExp("^" + t + a + "(?:" + t + ")*", "m"),
            inside: {
                "table-data-rows": {
                    pattern: RegExp("^(" + t + a + ")(?:" + t + ")*$"),
                    lookbehind: !0,
                    inside: {
                        "table-data": {
                            pattern: RegExp(e),
                            inside: d.languages.markdown
                        },
                        punctuation: /\|/
                    }
                },
                "table-line": {
                    pattern: RegExp("^(" + t + ")" + a + "$"),
                    lookbehind: !0,
                    inside: {
                        punctuation: /\||:?-{3,}:?/
                    }
                },
                "table-header-row": {
                    pattern: RegExp("^" + t + "$"),
                    inside: {
                        "table-header": {
                            pattern: RegExp(e),
                            alias: "important",
                            inside: d.languages.markdown
                        },
                        punctuation: /\|/
                    }
                }
            }
        },
        code: [{
            pattern: /(^[ \t]*(?:\r?\n|\r))(?: {4}|\t).+(?:(?:\r?\n|\r)(?: {4}|\t).+)*/m,
            lookbehind: !0,
            alias: "keyword"
        }, {
            pattern: /``.+?``|`[^`\r\n]+`/,
            alias: "keyword"
        }, {
            pattern: /^```[\s\S]*?^```$/m,
            greedy: !0,
            inside: {
                "code-block": {
                    pattern: /^(```.*(?:\r?\n|\r))[\s\S]+?(?=(?:\r?\n|\r)^```$)/m,
                    lookbehind: !0
                },
                "code-language": {
                    pattern: /^(```).+/,
                    lookbehind: !0
                },
                punctuation: /```/
            }
        }],
        title: [{
            pattern: /\S.*(?:\r?\n|\r)(?:==+|--+)(?=[ \t]*$)/m,
            alias: "important",
            inside: {
                punctuation: /==+$|--+$/
            }
        }, {
            pattern: /(^\s*)#+.+/m,
            lookbehind: !0,
            alias: "important",
            inside: {
                punctuation: /^#+|#+$/
            }
        }],
        hr: {
            pattern: /(^\s*)([*-])(?:[\t ]*\2){2,}(?=\s*$)/m,
            lookbehind: !0,
            alias: "punctuation"
        },
        list: {
            pattern: /(^\s*)(?:[*+-]|\d+\.)(?=[\t ].)/m,
            lookbehind: !0,
            alias: "punctuation"
        },
        "url-reference": {
            pattern: /!?\[[^\]]+\]:[\t ]+(?:\S+|<(?:\\.|[^>\\])+>)(?:[\t ]+(?:"(?:\\.|[^"\\])*"|'(?:\\.|[^'\\])*'|\((?:\\.|[^)\\])*\)))?/,
            inside: {
                variable: {
                    pattern: /^(!?\[)[^\]]+/,
                    lookbehind: !0
                },
                string: /(?:"(?:\\.|[^"\\])*"|'(?:\\.|[^'\\])*'|\((?:\\.|[^)\\])*\))$/,
                punctuation: /^[\[\]!:]|[<>]/
            },
            alias: "url"
        },
        bold: {
            pattern: n("__(?:(?!_)<inner>|_(?:(?!_)<inner>)+_)+__", !0),
            lookbehind: !0,
            greedy: !0,
            inside: {
                content: {
                    pattern: /(^..)[\s\S]+(?=..$)/,
                    lookbehind: !0,
                    inside: {}
                },
                punctuation: /\*\*|__/
            }
        },
        italic: {
            pattern: n("_(?:(?!_)<inner>|__(?:(?!_)<inner>)+__)+_", !0),
            lookbehind: !0,
            greedy: !0,
            inside: {
                content: {
                    pattern: /(^.)[\s\S]+(?=.$)/,
                    lookbehind: !0,
                    inside: {}
                },
                punctuation: /[*_]/
            }
        },
        strike: {
            pattern: n("(~~?)(?:(?!~)<inner>)+?\\2", !1),
            lookbehind: !0,
            greedy: !0,
            inside: {
                content: {
                    pattern: /(^~~?)[\s\S]+(?=\1$)/,
                    lookbehind: !0,
                    inside: {}
                },
                punctuation: /~~?/
            }
        },
        url: {
            pattern: n('!?\\[(?:(?!\\])<inner>)+\\](?:\\([^\\s)]+(?:[\t ]+"(?:\\\\.|[^"\\\\])*")?\\)| ?\\[(?:(?!\\])<inner>)+\\])', !1),
            lookbehind: !0,
            greedy: !0,
            inside: {
                variable: {
                    pattern: /(\[)[^\]]+(?=\]$)/,
                    lookbehind: !0
                },
                content: {
                    pattern: /(^!?\[)[^\]]+(?=\])/,
                    lookbehind: !0,
                    inside: {}
                },
                string: {
                    pattern: /"(?:\\.|[^"\\])*"(?=\)$)/
                }
            }
        }
    }), ["url", "bold", "italic", "strike"].forEach(function(e) {
        ["url", "bold", "italic", "strike"].forEach(function(n) {
            e !== n && (d.languages.markdown[e].inside.content.inside[n] = d.languages.markdown[n])
        })
    }), d.hooks.add("after-tokenize", function(n) {
        "markdown" !== n.language && "md" !== n.language || ! function n(e) {
            if (e && "string" != typeof e)
                for (var t = 0, a = e.length; t < a; t++) {
                    var i = e[t];
                    if ("code" === i.type) {
                        var r = i.content[1],
                            o = i.content[3];
                        if (r && o && "code-language" === r.type && "code-block" === o.type && "string" == typeof r.content) {
                            var l = "language-" + r.content.trim().split(/\s+/)[0].toLowerCase();
                            o.alias ? "string" == typeof o.alias ? o.alias = [o.alias, l] : o.alias.push(l) : o.alias = [l]
                        }
                    } else n(i.content)
                }
        }(n.tokens)
    }), d.hooks.add("wrap", function(n) {
        if ("code-block" === n.type) {
            for (var e = "", t = 0, a = n.classes.length; t < a; t++) {
                var i = n.classes[t],
                    r = /language-(.+)/.exec(i);
                if (r) {
                    e = r[1];
                    break
                }
            }
            var o = d.languages[e];
            if (o) {
                var l = n.content.replace(/&lt;/g, "<").replace(/&amp;/g, "&");
                n.content = d.highlight(l, o, e)
            } else if (e && "none" !== e && d.plugins.autoloader) {
                var s = "md-" + (new Date).valueOf() + "-" + Math.floor(1e16 * Math.random());
                n.attributes.id = s, d.plugins.autoloader.loadLanguages(e, function() {
                    var n = document.getElementById(s);
                    n && (n.innerHTML = d.highlight(n.textContent, d.languages[e], e))
                })
            }
        }
    }), d.languages.md = d.languages.markdown
}(Prism);
Prism.languages.json = {
    property: {
        pattern: /"(?:\\.|[^\\"\r\n])*"(?=\s*:)/,
        greedy: !0
    },
    string: {
        pattern: /"(?:\\.|[^\\"\r\n])*"(?!\s*:)/,
        greedy: !0
    },
    comment: /\/\/.*|\/\*[\s\S]*?(?:\*\/|$)/,
    number: /-?\d+\.?\d*(e[+-]?\d+)?/i,
    punctuation: /[{}[\],]/,
    operator: /:/,
    boolean: /\b(?:true|false)\b/,
    null: {
        pattern: /\bnull\b/,
        alias: "keyword"
    }
};
Prism.languages.jsonp = Prism.languages.extend("json", {
    punctuation: /[{}[\]();,.]/
}), Prism.languages.insertBefore("jsonp", "punctuation", {
    function: /[_$a-zA-Z\xA0-\uFFFF][$\w\xA0-\uFFFF]*(?=\s*\()/
});
! function(n) {
    var e = /("|')(?:\\(?:\r\n?|\n|.)|(?!\1)[^\\\r\n])*\1/;
    n.languages.json5 = n.languages.extend("json", {
        property: [{
            pattern: RegExp(e.source + "(?=\\s*:)"),
            greedy: !0
        }, {
            pattern: /[_$a-zA-Z\xA0-\uFFFF][$\w\xA0-\uFFFF]*(?=\s*:)/,
            alias: "unquoted"
        }],
        string: {
            pattern: e,
            greedy: !0
        },
        number: /[+-]?(?:NaN|Infinity|0x[a-fA-F\d]+|(?:\d+\.?\d*|\.\d+)(?:[eE][+-]?\d+)?)/
    })
}(Prism);
Prism.languages.python = {
    comment: {
        pattern: /(^|[^\\])#.*/,
        lookbehind: !0
    },
    "string-interpolation": {
        pattern: /(?:f|rf|fr)(?:("""|''')[\s\S]+?\1|("|')(?:\\.|(?!\2)[^\\\r\n])*\2)/i,
        greedy: !0,
        inside: {
            interpolation: {
                pattern: /((?:^|[^{])(?:{{)*){(?!{)(?:[^{}]|{(?!{)(?:[^{}]|{(?!{)(?:[^{}])+})+})+}/,
                lookbehind: !0,
                inside: {
                    "format-spec": {
                        pattern: /(:)[^:(){}]+(?=}$)/,
                        lookbehind: !0
                    },
                    "conversion-option": {
                        pattern: /![sra](?=[:}]$)/,
                        alias: "punctuation"
                    },
                    rest: null
                }
            },
            string: /[\s\S]+/
        }
    },
    "triple-quoted-string": {
        pattern: /(?:[rub]|rb|br)?("""|''')[\s\S]+?\1/i,
        greedy: !0,
        alias: "string"
    },
    string: {
        pattern: /(?:[rub]|rb|br)?("|')(?:\\.|(?!\1)[^\\\r\n])*\1/i,
        greedy: !0
    },
    function: {
        pattern: /((?:^|\s)def[ \t]+)[a-zA-Z_]\w*(?=\s*\()/g,
        lookbehind: !0
    },
    "class-name": {
        pattern: /(\bclass\s+)\w+/i,
        lookbehind: !0
    },
    decorator: {
        pattern: /(^\s*)@\w+(?:\.\w+)*/im,
        lookbehind: !0,
        alias: ["annotation", "punctuation"],
        inside: {
            punctuation: /\./
        }
    },
    keyword: /\b(?:and|as|assert|async|await|break|class|continue|def|del|elif|else|except|exec|finally|for|from|global|if|import|in|is|lambda|nonlocal|not|or|pass|print|raise|return|try|while|with|yield)\b/,
    builtin: /\b(?:__import__|abs|all|any|apply|ascii|basestring|bin|bool|buffer|bytearray|bytes|callable|chr|classmethod|cmp|coerce|compile|complex|delattr|dict|dir|divmod|enumerate|eval|execfile|file|filter|float|format|frozenset|getattr|globals|hasattr|hash|help|hex|id|input|int|intern|isinstance|issubclass|iter|len|list|locals|long|map|max|memoryview|min|next|object|oct|open|ord|pow|property|range|raw_input|reduce|reload|repr|reversed|round|set|setattr|slice|sorted|staticmethod|str|sum|super|tuple|type|unichr|unicode|vars|xrange|zip)\b/,
    boolean: /\b(?:True|False|None)\b/,
    number: /(?:\b(?=\d)|\B(?=\.))(?:0[bo])?(?:(?:\d|0x[\da-f])[\da-f]*\.?\d*|\.\d+)(?:e[+-]?\d+)?j?\b/i,
    operator: /[-+%=]=?|!=|\*\*?=?|\/\/?=?|<[<=>]?|>[=>]?|[&|^~]/,
    punctuation: /[{}[\];(),.:]/
}, Prism.languages.python["string-interpolation"].inside.interpolation.inside.rest = Prism.languages.python, Prism.languages.py = Prism.languages.python;
Prism.languages["shell-session"] = {
    command: {
        pattern: /\$(?:[^\r\n'"<]|(["'])(?:\\[\s\S]|\$\([^)]+\)|`[^`]+`|(?!\1)[^\\])*\1|((?:^|[^<])<<\s*)["']?(\w+?)["']?\s*(?:\r\n?|\n)(?:[\s\S])*?(?:\r\n?|\n)\3)+/,
        inside: {
            bash: {
                pattern: /(\$\s*)[\s\S]+/,
                lookbehind: !0,
                alias: "language-bash",
                inside: Prism.languages.bash
            },
            sh: {
                pattern: /^\$/,
                alias: "important"
            }
        }
    },
    output: {
        pattern: /.(?:.*(?:\r\n?|\n|.$))*/
    }
};
Prism.languages.yaml = {
    scalar: {
        pattern: /([\-:]\s*(?:![^\s]+)?[ \t]*[|>])[ \t]*(?:((?:\r?\n|\r)[ \t]+)[^\r\n]+(?:\2[^\r\n]+)*)/,
        lookbehind: !0,
        alias: "string"
    },
    comment: /#.*/,
    key: {
        pattern: /(\s*(?:^|[:\-,[{\r\n?])[ \t]*(?:![^\s]+)?[ \t]*)[^\r\n{[\]},#\s]+?(?=\s*:\s)/,
        lookbehind: !0,
        alias: "atrule"
    },
    directive: {
        pattern: /(^[ \t]*)%.+/m,
        lookbehind: !0,
        alias: "important"
    },
    datetime: {
        pattern: /([:\-,[{]\s*(?:![^\s]+)?[ \t]*)(?:\d{4}-\d\d?-\d\d?(?:[tT]|[ \t]+)\d\d?:\d{2}:\d{2}(?:\.\d*)?[ \t]*(?:Z|[-+]\d\d?(?::\d{2})?)?|\d{4}-\d{2}-\d{2}|\d\d?:\d{2}(?::\d{2}(?:\.\d*)?)?)(?=[ \t]*(?:$|,|]|}))/m,
        lookbehind: !0,
        alias: "number"
    },
    boolean: {
        pattern: /([:\-,[{]\s*(?:![^\s]+)?[ \t]*)(?:true|false)[ \t]*(?=$|,|]|})/im,
        lookbehind: !0,
        alias: "important"
    },
    null: {
        pattern: /([:\-,[{]\s*(?:![^\s]+)?[ \t]*)(?:null|~)[ \t]*(?=$|,|]|})/im,
        lookbehind: !0,
        alias: "important"
    },
    string: {
        pattern: /([:\-,[{]\s*(?:![^\s]+)?[ \t]*)("|')(?:(?!\2)[^\\\r\n]|\\.)*\2(?=[ \t]*(?:$|,|]|}|\s*#))/m,
        lookbehind: !0,
        greedy: !0
    },
    number: {
        pattern: /([:\-,[{]\s*(?:![^\s]+)?[ \t]*)[+-]?(?:0x[\da-f]+|0o[0-7]+|(?:\d+\.?\d*|\.?\d+)(?:e[+-]?\d+)?|\.inf|\.nan)[ \t]*(?=$|,|]|})/im,
        lookbehind: !0
    },
    tag: /![^\s]+/,
    important: /[&*][\w]+/,
    punctuation: /---|[:[\]{}\-,|>?]|\.\.\./
}, Prism.languages.yml = Prism.languages.yaml;
! function(e) {
    var d = "(?:[\\w-]+|'[^'\n\r]*'|\"(?:\\.|[^\\\\\"\r\n])*\")";
    Prism.languages.toml = {
        comment: {
            pattern: /#.*/,
            greedy: !0
        },
        table: {
            pattern: RegExp("(^\\s*\\[\\s*(?:\\[\\s*)?)" + d + "(?:\\s*\\.\\s*" + d + ")*(?=\\s*\\])", "m"),
            lookbehind: !0,
            greedy: !0,
            alias: "class-name"
        },
        key: {
            pattern: RegExp("(^\\s*|[{,]\\s*)" + d + "(?:\\s*\\.\\s*" + d + ")*(?=\\s*=)", "m"),
            lookbehind: !0,
            greedy: !0,
            alias: "property"
        },
        string: {
            pattern: /"""(?:\\[\s\S]|[^\\])*?"""|'''[\s\S]*?'''|'[^'\n\r]*'|"(?:\\.|[^\\"\r\n])*"/,
            greedy: !0
        },
        date: [{
            pattern: /\d{4}-\d{2}-\d{2}(?:[T\s]\d{2}:\d{2}:\d{2}(?:\.\d+)?(?:Z|[+-]\d{2}:\d{2})?)?/i,
            alias: "number"
        }, {
            pattern: /\d{2}:\d{2}:\d{2}(?:\.\d+)?/i,
            alias: "number"
        }],
        number: /(?:\b0(?:x[\da-zA-Z]+(?:_[\da-zA-Z]+)*|o[0-7]+(?:_[0-7]+)*|b[10]+(?:_[10]+)*))\b|[-+]?\d+(?:_\d+)*(?:\.\d+(?:_\d+)*)?(?:[eE][+-]?\d+(?:_\d+)*)?\b|[-+]?(?:inf|nan)\b/,
        boolean: /\b(?:true|false)\b/,
        punctuation: /[.,=[\]{}]/
    }
}();
! function() {
    if ("undefined" != typeof self && self.Prism && self.document) {
        var l = "line-numbers",
            c = /\n(?!$)/g,
            m = function(e) {
                var t = a(e)["white-space"];
                if ("pre-wrap" === t || "pre-line" === t) {
                    var n = e.querySelector("code"),
                        r = e.querySelector(".line-numbers-rows"),
                        s = e.querySelector(".line-numbers-sizer"),
                        i = n.textContent.split(c);
                    s || ((s = document.createElement("span")).className = "line-numbers-sizer", n.appendChild(s)), s.style.display = "block", i.forEach(function(e, t) {
                        s.textContent = e || "\n";
                        var n = s.getBoundingClientRect().height;
                        r.children[t].style.height = n + "px"
                    }), s.textContent = "", s.style.display = "none"
                }
            },
            a = function(e) {
                return e ? window.getComputedStyle ? getComputedStyle(e) : e.currentStyle || null : null
            };
        window.addEventListener("resize", function() {
            Array.prototype.forEach.call(document.querySelectorAll("pre." + l), m)
        }), Prism.hooks.add("complete", function(e) {
            if (e.code) {
                var t = e.element,
                    n = t.parentNode;
                if (n && /pre/i.test(n.nodeName) && !t.querySelector(".line-numbers-rows")) {
                    for (var r = !1, s = /(?:^|\s)line-numbers(?:\s|$)/, i = t; i; i = i.parentNode)
                        if (s.test(i.className)) {
                            r = !0;
                            break
                        } if (r) {
                        t.className = t.className.replace(s, " "), s.test(n.className) || (n.className += " line-numbers");
                        var l, a = e.code.match(c),
                            o = a ? a.length + 1 : 1,
                            u = new Array(o + 1).join("<span></span>");
                        (l = document.createElement("span")).setAttribute("aria-hidden", "true"), l.className = "line-numbers-rows", l.innerHTML = u, n.hasAttribute("data-start") && (n.style.counterReset = "linenumber " + (parseInt(n.getAttribute("data-start"), 10) - 1)), e.element.appendChild(l), m(n), Prism.hooks.run("line-numbers", e)
                    }
                }
            }
        }), Prism.hooks.add("line-numbers", function(e) {
            e.plugins = e.plugins || {}, e.plugins.lineNumbers = !0
        }), Prism.plugins.lineNumbers = {
            getLine: function(e, t) {
                if ("PRE" === e.tagName && e.classList.contains(l)) {
                    var n = e.querySelector(".line-numbers-rows"),
                        r = parseInt(e.getAttribute("data-start"), 10) || 1,
                        s = r + (n.children.length - 1);
                    t < r && (t = r), s < t && (t = s);
                    var i = t - r;
                    return n.children[i]
                }
            }
        }
    }
}();
! function() {
    if ("undefined" != typeof self && self.Prism && self.document) {
        var u = /(?:^|\s)command-line(?:\s|$)/;
        Prism.hooks.add("before-highlight", function(e) {
            var t = e.vars = e.vars || {},
                a = t["command-line"] = t["command-line"] || {};
            if (!a.complete && e.code) {
                var n = e.element.parentNode;
                if (n && /pre/i.test(n.nodeName) && (u.test(n.className) || u.test(e.element.className)))
                    if (e.element.querySelector(".command-line-prompt")) a.complete = !0;
                    else {
                        var r = e.code.split("\n");
                        a.numberOfLines = r.length;
                        var s = a.outputLines = [],
                            o = n.getAttribute("data-output"),
                            i = n.getAttribute("data-filter-output");
                        if (o || "" === o) {
                            o = o.split(",");
                            for (var l = 0; l < o.length; l++) {
                                var m = o[l].split("-"),
                                    p = parseInt(m[0], 10),
                                    d = 2 === m.length ? parseInt(m[1], 10) : p;
                                if (!isNaN(p) && !isNaN(d)) {
                                    p < 1 && (p = 1), d > r.length && (d = r.length), d--;
                                    for (var c = --p; c <= d; c++) s[c] = r[c], r[c] = ""
                                }
                            }
                        } else if (i)
                            for (l = 0; l < r.length; l++) 0 === r[l].indexOf(i) && (s[l] = r[l].slice(i.length), r[l] = "");
                        e.code = r.join("\n")
                    }
                else a.complete = !0
            } else a.complete = !0
        }), Prism.hooks.add("before-insert", function(e) {
            var t = e.vars = e.vars || {},
                a = t["command-line"] = t["command-line"] || {};
            if (!a.complete) {
                for (var n = e.highlightedCode.split("\n"), r = 0, s = (a.outputLines || []).length; r < s; r++) a.outputLines.hasOwnProperty(r) && (n[r] = a.outputLines[r]);
                e.highlightedCode = n.join("\n")
            }
        }), Prism.hooks.add("complete", function(e) {
            var t = e.vars = e.vars || {},
                a = t["command-line"] = t["command-line"] || {};
            if (!a.complete) {
                var n = e.element.parentNode;
                u.test(e.element.className) && (e.element.className = e.element.className.replace(u, " ")), u.test(n.className) || (n.className += " command-line");
                var r = function(e, t) {
                        return (n.getAttribute(e) || t).replace(/"/g, "&quot")
                    },
                    s = new Array((a.numberOfLines || 0) + 1),
                    o = r("data-prompt", "");
                if ("" !== o) s = s.join('<span data-prompt="' + o + '"></span>');
                else {
                    var i = r("data-user", "user"),
                        l = r("data-host", "localhost");
                    s = s.join('<span data-user="' + i + '" data-host="' + l + '"></span>')
                }
                var m = document.createElement("span");
                m.className = "command-line-prompt", m.innerHTML = s;
                for (var p = 0, d = (a.outputLines || []).length; p < d; p++)
                    if (a.outputLines.hasOwnProperty(p)) {
                        var c = m.children[p];
                        c.removeAttribute("data-user"), c.removeAttribute("data-host"), c.removeAttribute("data-prompt")
                    } e.element.insertBefore(m, e.element.firstChild), a.complete = !0
            }
        })
    }
}();
! function(e, s) {
    void 0 !== e && e.Prism && e.document && s.createRange && (Prism.plugins.KeepMarkup = !0, Prism.hooks.add("before-highlight", function(e) {
        if (e.element.children.length) {
            var a = 0,
                s = [],
                p = function(e, n) {
                    var o = {};
                    n || (o.clone = e.cloneNode(!1), o.posOpen = a, s.push(o));
                    for (var t = 0, d = e.childNodes.length; t < d; t++) {
                        var r = e.childNodes[t];
                        1 === r.nodeType ? p(r) : 3 === r.nodeType && (a += r.data.length)
                    }
                    n || (o.posClose = a)
                };
            p(e.element, !0), s && s.length && (e.keepMarkup = s)
        }
    }), Prism.hooks.add("after-highlight", function(n) {
        if (n.keepMarkup && n.keepMarkup.length) {
            var a = function(e, n) {
                for (var o = 0, t = e.childNodes.length; o < t; o++) {
                    var d = e.childNodes[o];
                    if (1 === d.nodeType) {
                        if (!a(d, n)) return !1
                    } else 3 === d.nodeType && (!n.nodeStart && n.pos + d.data.length > n.node.posOpen && (n.nodeStart = d, n.nodeStartPos = n.node.posOpen - n.pos), n.nodeStart && n.pos + d.data.length >= n.node.posClose && (n.nodeEnd = d, n.nodeEndPos = n.node.posClose - n.pos), n.pos += d.data.length);
                    if (n.nodeStart && n.nodeEnd) {
                        var r = s.createRange();
                        return r.setStart(n.nodeStart, n.nodeStartPos), r.setEnd(n.nodeEnd, n.nodeEndPos), n.node.clone.appendChild(r.extractContents()), r.insertNode(n.node.clone), r.detach(), !1
                    }
                }
                return !0
            };
            n.keepMarkup.forEach(function(e) {
                a(n.element, {
                    node: e,
                    pos: 0
                })
            }), n.highlightedCode = n.element.innerHTML
        }
    }))
}(self, document);