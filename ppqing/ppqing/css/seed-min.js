/* Copyright 2011, KISSY UI Library, MIT Licensed */
(function(m, f, o) {
    if (m[f] === o)m[f] = {};
    f = m[f];
    var r = m.document,u = location,q = function(a, c, d, e) {
        if (!c || !a)return a;
        if (d === o)d = true;
        var g,h,l;
        if (e && (l = e.length))for (g = 0; g < l; g++) {
            h = e[g];
            if (h in c)if (d || !(h in a))a[h] = c[h]
        } else for (h in c)if (d || !(h in a))a[h] = c[h];
        return a
    },y = false,v = [],x = false,A = /^#?([\w-]+)$/,B = 0;
    q(f, {version:"1.1.6",__init:function() {
        this.Env = {mods:{},_loadQueue:{}};
        var a = r.getElementsByTagName("script");
        this.Config = {debug:"",base:a[a.length - 1].src.replace(/^(.*)(seed|kissy).*$/i,
                "$1"),timeout:10}
    },ready:function(a) {
        x || this._bindReady();
        y ? a.call(m, this) : v.push(a);
        return this
    },_bindReady:function() {
        var a = this,c = r.documentElement.doScroll,d = c ? "onreadystatechange" : "DOMContentLoaded",e = function() {
            a._fireReady()
        };
        x = true;
        if (r.readyState === "complete")return e();
        if (r.addEventListener) {
            var g = function() {
                r.removeEventListener(d, g, false);
                e()
            };
            r.addEventListener(d, g, false);
            m.addEventListener("load", e, false)
        } else {
            var h = function() {
                if (r.readyState === "complete") {
                    r.detachEvent(d, h);
                    e()
                }
            };
            r.attachEvent(d,
                    h);
            m.attachEvent("onload", e);
            var l = false;
            try {
                l = m.frameElement == null
            } catch(t) {
            }
            if (c && l) {
                var p = function() {
                    try {
                        c("left");
                        e()
                    } catch(b) {
                        setTimeout(p, 1)
                    }
                };
                p()
            }
        }
    },_fireReady:function() {
        if (!y) {
            y = true;
            if (v) {
                for (var a,c = 0; a = v[c++];)a.call(m, this);
                v = null
            }
        }
    },available:function(a, c) {
        if ((a = (a + "").match(A)[1]) && f.isFunction(c))var d = 1,e = f.later(function() {
            if (r.getElementById(a) && (c() || 1) || ++d > 500)e.cancel()
        }, 40, true)
    },mix:q,merge:function() {
        var a = {},c,d = arguments.length;
        for (c = 0; c < d; ++c)q(a, arguments[c]);
        return a
    },
        augment:function() {
            var a = arguments,c = a.length - 2,d = a[0],e = a[c],g = a[c + 1],h = 1;
            if (!f.isArray(g)) {
                e = g;
                g = o;
                c++
            }
            if (!f.isBoolean(e)) {
                e = o;
                c++
            }
            for (; h < c; h++)q(d.prototype, a[h].prototype || a[h], e, g);
            return d
        },extend:function(a, c, d, e) {
            if (!c || !a)return a;
            var g = Object.prototype,h = c.prototype,l = function(t) {
                function p() {
                }

                p.prototype = t;
                return new p
            }(h);
            a.prototype = l;
            l.constructor = a;
            a.superclass = h;
            if (c !== Object && h.constructor === g.constructor)h.constructor = c;
            d && q(l, d);
            e && q(a, e);
            return a
        },namespace:function() {
            var a = arguments,
                    c = a.length,d = null,e,g,h,l = a[c - 1] === true && c--;
            for (e = 0; e < c; ++e) {
                h = ("" + a[e]).split(".");
                d = l ? m : this;
                for (g = m[h[0]] === d ? 1 : 0; g < h.length; ++g)d = d[h[g]] = d[h[g]] || {}
            }
            return d
        },app:function(a, c) {
            var d = f.isString(a),e = d ? m[a] || {} : a;
            q(e, this, true, f.__APP_MEMBERS);
            e.__init();
            q(e, f.isFunction(c) ? c() : c);
            d && (m[a] = e);
            return e
        },log:function(a, c, d) {
            if (f.Config.debug) {
                if (d)a = d + ": " + a;
                if (m.console !== o && console.log)console[c && console[c] ? c : "log"](a)
            }
        },error:function(a) {
            if (f.Config.debug)throw a;
        },guid:function(a) {
            var c = B++ +
                    "";
            return a ? a + c : c
        }});
    f.__init();
    f.__APP_MEMBERS = ["__init","namespace"];
    if (u && (u.search || "").indexOf("ks-debug") !== -1)f.Config.debug = true
})(window, "KISSY");
(function(m, f, o) {
    function r(b) {
        var i = typeof b;
        return b === null || i !== "object" && i !== "function"
    }

    function u(b) {
        return v.slice.call(b)
    }

    var q = document,y = q.documentElement,v = Array.prototype,x = v.indexOf,A = v.lastIndexOf,B = v.filter,a = String.prototype.trim,c = Object.prototype.toString,d = encodeURIComponent,e = decodeURIComponent,g = d("[]"),h = /^\s+|\s+$/g,l = /^(\w+)\[\]$/,t = /\S/;
    f.mix(f, {isUndefined:function(b) {
        return b === o
    },isBoolean:function(b) {
        return c.call(b) === "[object Boolean]"
    },isString:function(b) {
        return c.call(b) ===
                "[object String]"
    },isNumber:function(b) {
        return c.call(b) === "[object Number]" && isFinite(b)
    },isPlainObject:function(b) {
        return b && c.call(b) === "[object Object]" && !b.nodeType && !b.setInterval
    },isEmptyObject:function(b) {
        for (var i in b)return false;
        return true
    },isFunction:function(b) {
        return c.call(b) === "[object Function]"
    },isArray:function(b) {
        return c.call(b) === "[object Array]"
    },trim:a ? function(b) {
        return b == o ? "" : a.call(b)
    } : function(b) {
        return b == o ? "" : b.toString().replace(h, "")
    },substitute:function(b, i, j) {
        if (!f.isString(b) ||
                !f.isPlainObject(i))return b;
        return b.replace(j || /\\?\{([^{}]+)\}/g, function(k, n) {
            if (k.charAt(0) === "\\")return k.slice(1);
            return i[n] !== o ? i[n] : ""
        })
    },each:function(b, i, j) {
        var k,n = 0,s = b.length,w = s === o || f.isFunction(b);
        j = j || m;
        if (w)for (k in b) {
            if (i.call(j, b[k], k, b) === false)break
        } else for (k = b[0]; n < s && i.call(j, k, n, b) !== false; k = b[++n]);
        return b
    },indexOf:x ? function(b, i) {
        return x.call(i, b)
    } : function(b, i) {
        for (var j = 0,k = i.length; j < k; ++j)if (i[j] === b)return j;
        return-1
    },lastIndexOf:A ? function(b, i) {
        return A.call(i,
                b)
    } : function(b, i) {
        for (var j = i.length - 1; j >= 0; j--)if (i[j] === b)break;
        return j
    },unique:function(b, i) {
        i && b.reverse();
        for (var j = b.slice(),k = 0,n,s; k < j.length;) {
            for (s = j[k]; (n = f.lastIndexOf(s, j)) !== k;)j.splice(n, 1);
            k += 1
        }
        i && j.reverse();
        return j
    },inArray:function(b, i) {
        return f.indexOf(b, i) > -1
    },makeArray:function(b) {
        if (b === null || b === o)return[];
        if (f.isArray(b))return b;
        if (typeof b.length !== "number" || f.isString(b) || f.isFunction(b))return[b];
        return u(b)
    },filter:B ? function(b, i, j) {
        return B.call(b, i, j)
    } : function(b, i, j) {
        var k = [];
        f.each(b, function(n, s, w) {
            i.call(j, n, s, w) && k.push(n)
        });
        return k
    },param:function(b, i) {
        if (!f.isPlainObject(b))return"";
        i = i || "&";
        var j = [],k,n;
        for (k in b) {
            n = b[k];
            k = d(k);
            if (r(n))j.push(k, "=", d(n + ""), i); else if (f.isArray(n) && n.length)for (var s = 0,w = n.length; s < w; ++s)r(n[s]) && j.push(k, g + "=", d(n[s] + ""), i)
        }
        j.pop();
        return j.join("")
    },unparam:function(b, i) {
        if (typeof b !== "string" || (b = f.trim(b)).length === 0)return{};
        for (var j = {},k = b.split(i || "&"),n,s,w,z,C = 0,D = k.length; C < D; ++C) {
            n = k[C].split("=");
            s = e(n[0]);
            try {
                w = e(n[1] || "")
            } catch(E) {
                w = n[1] || ""
            }
            if ((z = s.match(l)) && z[1]) {
                j[z[1]] = j[z[1]] || [];
                j[z[1]].push(w)
            } else j[s] = w
        }
        return j
    },later:function(b, i, j, k, n) {
        i = i || 0;
        k = k || {};
        var s = b,w = f.makeArray(n),z;
        if (f.isString(b))s = k[b];
        s || f.error("method undefined");
        b = function() {
            s.apply(k, w)
        };
        z = j ? setInterval(b, i) : setTimeout(b, i);
        return{id:z,interval:j,cancel:function() {
            this.interval ? clearInterval(z) : clearTimeout(z)
        }}
    },clone:function(b) {
        var i = b,j,k;
        if (b && ((j = f.isArray(b)) || f.isPlainObject(b))) {
            i = j ? [] : {};
            for (k in b)if (b.hasOwnProperty(k))i[k] =
                    f.clone(b[k])
        }
        return i
    },now:function() {
        return(new Date).getTime()
    },globalEval:function(b) {
        if (b && t.test(b)) {
            var i = q.getElementsByTagName("head")[0] || y,j = q.createElement("script");
            j.text = b;
            i.insertBefore(j, i.firstChild);
            i.removeChild(j)
        }
    }});
    try {
        u(y.childNodes)
    } catch(p) {
        u = function(b) {
            for (var i = [],j = b.length - 1; j >= 0; j--)i[j] = b[j];
            return i
        }
    }
})(window, KISSY);
(function(m, f, o) {
    var r = m.document,u = r.getElementsByTagName("head")[0] || r.documentElement,q = 2,y = 3,v = 4,x = f.mix,A = r.createElement("script").readyState ? function(a, c) {
        var d = a.onreadystatechange;
        a.onreadystatechange = function() {
            var e = a.readyState;
            if (e === "loaded" || e === "complete") {
                a.onreadystatechange = null;
                d && d();
                c.call(this)
            }
        }
    } : function(a, c) {
        a.addEventListener("load", c, false)
    },B = /\.css(?:\?|$)/i;
    m = {add:function(a, c, d) {
        var e = this.Env.mods,g;
        if (f.isString(a) && !d && f.isPlainObject(c)) {
            g = {};
            g[a] = c;
            a = g
        }
        if (f.isPlainObject(a)) {
            f.each(a,
                    function(h, l) {
                        h.name = l;
                        e[l] && x(h, e[l], false)
                    });
            x(e, a)
        } else {
            d = d || {};
            g = e[a] || {};
            a = d.host || g.host || a;
            g = e[a] || {};
            x(g, {name:a,status:q});
            if (!g.fns)g.fns = [];
            c && g.fns.push(c);
            x(e[a] = g, d);
            g.attach !== false && this.__isAttached(g.requires) && this.__attachMod(g)
        }
        return this
    },use:function(a, c, d) {
        a = a.replace(/\s+/g, "").split(",");
        d = d || {};
        var e = this,g = e.Env.mods,h = (d || 0).global,l,t = a.length,p,b,i;
        h && e.__mixMods(h);
        if (e.__isAttached(a))c && c(e); else {
            for (l = 0; l < t && (p = g[a[l]]); l++)if (p.status !== v) {
                if (d.order && l > 0) {
                    if (!p.requires)p.requires =
                            [];
                    p._requires = p.requires.concat();
                    b = a[l - 1];
                    if (!f.inArray(b, p.requires) && !f.inArray(p.name, g[b].requires || []))p.requires.push(b)
                }
                e.__attach(p, function() {
                    if (p._requires) {
                        p.requires = p._requires;
                        delete p._requires
                    }
                    if (!i && e.__isAttached(a)) {
                        i = true;
                        c && c(e)
                    }
                }, h)
            }
            return e
        }
    },__attach:function(a, c, d) {
        function e() {
            if (g.__isAttached(h)) {
                a.status === q && g.__attachMod(a);
                a.status === v && c()
            }
        }

        for (var g = this,h = a.requires || [],l = 0,t = h.length; l < t; l++)g.__attach(g.Env.mods[h[l]], e, d);
        g.__buildPath(a);
        g.__load(a, e, d)
    },__mixMods:function(a) {
        var c =
                this.Env.mods,d = a.Env.mods,e;
        for (e in d)this.__mixMod(c, d, e, a)
    },__mixMod:function(a, c, d, e) {
        var g = a[d] || {},h = g.status;
        f.mix(g, f.clone(c[d]));
        if (h)g.status = h;
        e && this.__buildPath(g, e.Config.base);
        a[d] = g
    },__attachMod:function(a) {
        var c = this;
        if (a.fns) {
            f.each(a.fns, function(d) {
                d && d(c)
            });
            a.fns = o
        }
        a.status = v
    },__isAttached:function(a) {
        for (var c = this.Env.mods,d,e = (a = f.makeArray(a)).length - 1; e >= 0 && (d = c[a[e]]); e--)if (d.status !== v)return false;
        return true
    },__load:function(a, c, d) {
        function e() {
            l[h] = q;
            if (a.status !==
                    y) {
                d && g.__mixMod(g.Env.mods, d.Env.mods, a.name, d);
                if (a.status !== v)a.status = q;
                c()
            }
        }

        var g = this,h = a.fullpath,l = f.Env._loadQueue,t = l[h];
        a.status = a.status || 0;
        if (a.status < 1 && t)a.status = t.nodeName ? 1 : q;
        if (f.isString(a.cssfullpath)) {
            g.getScript(a.cssfullpath);
            a.cssfullpath = q
        }
        if (a.status < 1 && h) {
            a.status = 1;
            t = g.getScript(h, {success:function() {
                KISSY.log(a.name + " is loaded.", "info");
                e()
            },error:function() {
                a.status = y;
                l[h] = q
            },charset:a.charset});
            B.test(h) || (l[h] = t)
        } else a.status === 1 ? A(t, e) : c()
    },__buildPath:function(a, c) {
        function d(g, h) {
            if (!a[h] && a[g])a[h] = (c || e.base) + a[g];
            if (a[h] && e.debug)a[h] = a[h].replace(/-min/g, "")
        }

        var e = this.Config;
        d("path", "fullpath");
        a.cssfullpath !== q && d("csspath", "cssfullpath")
    },getScript:function(a, c, d) {
        var e = B.test(a),g = r.createElement(e ? "link" : "script"),h = c,l,t,p;
        if (f.isPlainObject(h)) {
            c = h.success;
            l = h.error;
            t = h.timeout;
            d = h.charset
        }
        if (e) {
            g.href = a;
            g.rel = "stylesheet"
        } else {
            g.src = a;
            g.async = true
        }
        if (d)g.charset = d;
        if (e)f.isFunction(c) && c.call(g); else A(g, function() {
            if (p) {
                p.cancel();
                p = o
            }
            f.isFunction(c) &&
            c.call(g);
            u && g.parentNode && u.removeChild(g)
        });
        if (f.isFunction(l))p = f.later(function() {
            p = o;
            l()
        }, (t || this.Config.timeout) * 1E3);
        u.insertBefore(g, u.firstChild);
        return g
    }};
    x(f, m);
    f.each(m, function(a, c) {
        f.__APP_MEMBERS.push(c)
    })
})(window, KISSY);
(function(m) {
    var f = {core:{path:"../base/dd.js",requires:["ks-core"]},"ks-core":{path:"packages/core-min.js"},avatarcutter:{path:"../ks-mod/avatarcutter/avatarcutter.js",requires:["core"]},pinyin:{path:"../ks-mod/pinyin/pinyin.js",requires:["core","pytable"]},pytable:{path:"../ks-mod/pinyin/pytable.js"},univlist:{path:"../ks-mod/schoolselector/univs.js"},highschoollist:{path:"../ks-mod/schoolselector/highschools.js"},schoolselector:{path:"../ks-mod/schoolselector/schoolselector.js",requires:["pinyin"]},
        swfupload:{path:"../ks-mod/swfupload/swfupload.js"},suggestion:{path:"../ks-mod/suggestion/suggestion.js",requires:["core"]},"x-suggestion":{path:"../ks-mod/suggestion/x-suggestion.js",requires:["core"]}};
    m.each(["sizzle","dd","datalazyload","flash","switchable","suggest","calendar","uibase","overlay","imagezoom"], function(o) {
        f[o] = {path:o + "/" + o + "-pkg-min.js",requires:["core"],charset:"utf-8"}
    });
    f.calendar.csspath = "calendar/default-min.css";
    m.add(f)
})(KISSY);
KISSY.app("DD");
DD.namespace("DD.Var");
DD.clearTypeDetector = new function() {
    var m = this;
    m.hasSmoothing = function() {
        if (typeof screen.fontSmoothingEnabled != "undefined")return screen.fontSmoothingEnabled; else try {
            var f = document.createElement("canvas");
            f.width = "35";
            f.height = "35";
            f.style.display = "none";
            document.body.appendChild(f);
            var o = f.getContext("2d");
            o.textBaseline = "top";
            o.font = "32px Arial";
            o.fillStyle = "black";
            o.strokeStyle = "black";
            o.fillText("E", 0, 0);
            for (var r = 8; r <= 32; r++)for (var u = 1; u <= 32; u++) {
                var q = o.getImageData(u, r, 1, 1).data[3];
                if (q !=
                        255 && q != 0) {
                    document.body.removeChild(f);
                    return true
                }
            }
            document.body.removeChild(f);
            return false
        } catch(y) {
            return null
        }
    };
    m.insertClasses = function() {
        var f = !(navigator.userAgent.indexOf("Windows NT 5.1") > -1) ? true : m.hasSmoothing();
        document.getElementsByTagName("html")[0].className += f == true ? " hasFontSmoothing-true" : f == false ? " hasFontSmoothing-false" : " hasFontSmoothing-unknown"
    }
};
KISSY.ready(function() {
    DD.clearTypeDetector.insertClasses()
});
