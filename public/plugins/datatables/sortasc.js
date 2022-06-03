"use strict";
(function (h) { "function" === typeof define && define.amd ? define(["jquery"], function (E) { return h(E, window, document); }) : "object" === typeof exports ? module.exports = function (E, H) { E || (E = window); H || (H = "undefined" !== typeof window ? require("jquery") : require("jquery")(E)); return h(H, E, E.document); } : h(jQuery, window, document); })(function (h, E, H, k) {
    function Z(a) {
        var b, c, d = {};
        h.each(a, function (e) {
            if ((b = e.match(/^([^A-Z]+?)([A-Z])/)) && -1 !== "a aa ai ao as b fn i m o s ".indexOf(b[1] + " "))
                c = e.replace(b[0], b[2].toLowerCase()),
                    d[c] = e, "o" === b[1] && Z(a[e]);
        });
        a._hungarianMap = d;
    }
    function J(a, b, c) {  }
    function Ca(a) {
    }
    function eb(a) {}
    function fb(a) {
    }
    function gb(a) {}
    function hb(a, b, c, d, e, f) {}
    function Ea(a, b) {
        var c = n.defaults.column,
            d = a.aoColumns.length, c = h.extend({},
                n.models.oColumn, c, { nTh: b ? b : H.createElement("th"),
                    sTitle: c.sTitle ? c.sTitle : b ? b.innerHTML : "",
                    aDataSort: c.aDataSort ? c.aDataSort : [d], mData: c.mData ? c.mData : d, idx: d });
        a.aoColumns.push(c); c = a.aoPreSearchCols; c[d] = h.extend({}, n.models.oSearch, c[d])
        ka(a, d, h(b).data()); }
    function ka(a, b, c) {
        var b = a.aoColumns[b], d = a.oClasses, e = h(b.nTh);
        var g = b.mData, j = S(g), i = b.mRender ?
            S(b.mRender) : null, c = function (a) { return "string" === typeof a && -1 !== a.indexOf("@"); };
        b._bAttrSrc = h.isPlainObject(g) && (c(g.sort) || c(g.type) || c(g.filter));
        b._setter = null;
        b.fnGetData = function (a, b, c) { var d = j(a, b, k, c); return i && b ? i(d, b, a, c) : d; };
        b.fnSetData = function (a, b, c) { return N(g)(a, b, c); };
        "number" !== typeof g && (a._rowReadObject = !0);
        a.oFeatures.bSort || (b.bSortable = !1, e.addClass(d.sSortableNone));
        a = -1 !== h.inArray("asc", b.asSorting);
        c = -1 !== h.inArray("desc", b.asSorting);
        !b.bSortable || !a && !c ? (b.sSortingClass = d.sSortableNone,
            b.sSortingClassJUI = "") : a && !c ? (b.sSortingClass = d.sSortableAsc, b.sSortingClassJUI = d.sSortJUIAscAllowed) : !a && c ? (b.sSortingClass = d.sSortableDesc, b.sSortingClassJUI = d.sSortJUIDescAllowed) : (b.sSortingClass = d.sSortable, b.sSortingClassJUI = d.sSortJUI);
    }
    function $(a) {}
    function aa(a, b) {
    }
    function ba(a, b) {}
    function V(a) {}
    function ma(a, b) {}
    function Ga(a) {
        var b = a.aoColumns, c = a.aoData, d = n.ext.type.detect, e, f, g, j, i, h, l, q, t;
        e = 0;
        for (f = b.length; e < f; e++)
            if (l = b[e], t = [], !l.sType && l._sManualType)
                l.sType = l._sManualType;
            else if (!l.sType) {
                g = 0;
                for (j = d.length; g <
                j; g++) {
                    i = 0;
                    for (h = c.length; i < h; i++) {
                        t[i] === k && (t[i] = B(a, i, e, "type"));
                        q = d[g](t[i], a);
                        if (!q && g !== d.length - 1)
                            break;
                        if ("html" === q)
                            break;
                    }
                    if (q) {
                        l.sType = q;
                        break;
                    }
                }
                l.sType || (l.sType = "string");
            }
    }
    function ib(a, b, c, d) {
    }
    function O(a, b, c, d) { var e = a.aoData.length, f = h.extend(!0, {}
        , n.models.oRow, { src: c ? "dom" : "data", idx: e });
        f._aData = b; a.aoData.push(f);
        for (var g = a.aoColumns, j = 0, i = g.length; j < i; j++)
            g[j].sType = null; a.aiDisplayMaster.push(e); b = a.rowIdFn(b); b !== k && (a.aIds[b] = f);
        (c || !a.oFeatures.bDeferRender) && Ha(a, e, c, d); return e; }
    function na(a, b) {
        var c;
        b instanceof h || (b = h(b));
        return b.map(function (b, e) { c = Ia(a, e); return O(a, c.data, e, c.cells); });
    }
    function B(a, b, c, d) { var e = a.iDraw, f = a.aoColumns[c], g = a.aoData[b]._aData, j = f.sDefaultContent, i = f.fnGetData(g, d, { settings: a, row: b, col: c }); if (i === k)
        return a.iDrawError != e && null === j && (K(a, 0, "Requested unknown parameter " + ("function" == typeof f.mData ? "{function}" : "'" + f.mData + "'") + " for row " + b + ", column " + c, 4), a.iDrawError = e), j; if ((i === g || null === i) && null !== j && d !== k)
        i = j;
    else if ("function" === typeof i)
        return i.call(g); return null === i && "display" == d ? "" : i; }
    function jb(a, b, c, d) {
    }
    function Ja(a) { }
    function S(a) {

        if ("string" === typeof a && (-1 !== a.indexOf(".") || -1 !== a.indexOf("[") ||
            -1 !== a.indexOf("("))) {}
        return function (b) { return b[a]; };
    }
    function N(a) {
    }
    function Ka(a) {  }
    function oa(a) {  }
    function pa(a, b, c) {}
    function da(a, b, c, d) { }
    function Ia(a, b, c, d) {
        var e = [], f = b.firstChild, g, j, i = 0, m, l = a.aoColumns, q = a._rowReadObject, d = d !== k ? d : q ? {} : [], t = function (a, b) { if ("string" === typeof a) {
            var c = a.indexOf("@");
            -1 !== c && (c = a.substring(c + 1), N(a)(d, b.getAttribute(c)));
        } }, G = function (a) { if (c === k || c === i)
            j = l[i], m = h.trim(a.innerHTML), j && j._bAttrSrc ? (N(j.mData._)(d, m), t(j.mData.sort, a), t(j.mData.type, a), t(j.mData.filter, a)) : q ? (j._setter || (j._setter = N(j.mData)), j._setter(d, m)) : d[i] = m; i++; };
        if (f)
            for (; f;) {
                g = f.nodeName.toUpperCase();
                if ("TD" == g || "TH" == g)
                    G(f), e.push(f);
                f = f.nextSibling;
            }
        else {
            e = b.anCells;
            f = 0;
            for (g = e.length; f < g; f++)
                G(e[f]);
        }
        if (b = b.firstChild ? b : b.nTr)
            (b = b.getAttribute("id")) && N(a.rowId)(d, b);
        return { data: d, cells: e };
    }
    function Ha(a, b, c, d) {
        var e = a.aoData[b], f = e._aData, g = [], j, i, m, l, q;
        if (null === e.nTr) {
            j = c || H.createElement("tr");
            e.nTr = j;
            e.anCells = g;
            j._DT_RowIndex = b;
            La(a, e);
            l = 0;
            for (q = a.aoColumns.length; l < q; l++) {
                m = a.aoColumns[l];
                i = c ? d[l] : H.createElement(m.sCellType);
                i._DT_CellIndex = { row: b, column: l };
                g.push(i);
                if ((!c || m.mRender || m.mData !== l) && (!h.isPlainObject(m.mData) || m.mData._ !== l + ".display"))
                    i.innerHTML =
                        B(a, b, l, "display");
                m.sClass && (i.className += " " + m.sClass);
                m.bVisible && !c ? j.appendChild(i) : !m.bVisible && c && i.parentNode.removeChild(i);
                m.fnCreatedCell && m.fnCreatedCell.call(a.oInstance, i, B(a, b, l), f, b, l);
            }
            r(a, "aoRowCreatedCallback", null, [j, f, b, g]);
        }
        e.nTr.setAttribute("role", "row");
    }
    function La(a, b) {
    }
    function kb(a) {
        var b, c, d, e, f, g = a.nTHead, j = a.nTFoot, i = 0 === h("th, td", g).length, m = a.oClasses, l = a.aoColumns;
        i && (e = h("<tr/>").appendTo(g));
        b = 0;
        for (c = l.length; b < c; b++)
            f = l[b], d = h(f.nTh).addClass(f.sClass), i && d.appendTo(e), a.oFeatures.bSort && (d.addClass(f.sSortingClass), !1 !== f.bSortable && (d.attr("tabindex", a.iTabIndex).attr("aria-controls", a.sTableId), Ma(a, f.nTh, b))), f.sTitle != d[0].innerHTML && d.html(f.sTitle), Na(a, "header")(a, d, f, m);
        i && ea(a.aoHeader, g);
        if (null !== j) {
            a = a.aoFooter[0];
            b = 0;
            for (c = a.length; b < c; b++)
                f = l[b], f.nTf = a[b].cell, f.sClass && h(f.nTf).addClass(f.sClass);
        }
    }
    function fa(a, b, c) {
    }
    function P(a) {
        var b = r(a, "aoPreDrawCallback", "preDraw", [a]);
        if (-1 !== h.inArray(!1, b))
            C(a, !1);
        else {
            var b = [], c = 0, d = a.asStripeClasses, e = d.length, f = a.oLanguage, g = a.iInitDisplayStart, j = "ssp" == y(a), i = a.aiDisplay;
            a.bDrawing = !0;
            g !== k && -1 !== g && (a._iDisplayStart = j ? g : g >= a.fnRecordsDisplay() ? 0 : g, a.iInitDisplayStart = -1);
            var g = a._iDisplayStart, m = a.fnDisplayEnd();
            if (a.bDeferLoading)
                a.bDeferLoading = !1, a.iDraw++, C(a, !1);
            else if (j) {
                if (!a.bDestroying && !lb(a))
                    return;
            }
            else
                a.iDraw++;
            if (0 !== i.length) {
                f = j ? a.aoData.length : m;
                for (j = j ? 0 : g; j < f; j++) {
                    var l = i[j], q = a.aoData[l];
                    null === q.nTr && Ha(a, l);
                    var t = q.nTr;
                    if (0 !== e) {
                        var G = d[c % e];
                        q._sRowStripe != G && (h(t).removeClass(q._sRowStripe).addClass(G),
                            q._sRowStripe = G);
                    }
                    r(a, "aoRowCallback", null, [t, q._aData, c, j, l]);
                    b.push(t);
                    c++;
                }
            }
            else
                c = f.sZeroRecords, 1 == a.iDraw && "ajax" == y(a) ? c = f.sLoadingRecords : f.sEmptyTable && 0 === a.fnRecordsTotal() && (c = f.sEmptyTable), b[0] = h("<tr/>", { "class": e ? d[0] : "" }).append(h("<td />", { valign: "top", colSpan: V(a), "class": a.oClasses.sRowEmpty }).html(c))[0];
            r(a, "aoHeaderCallback", "header", [h(a.nTHead).children("tr")[0], Ka(a), g, m, i]);
            r(a, "aoFooterCallback", "footer", [h(a.nTFoot).children("tr")[0], Ka(a), g, m, i]);
            d = h(a.nTBody);
            d.children().detach();
            d.append(h(b));
            r(a, "aoDrawCallback", "draw", [a]);
            a.bSorted = !1;
            a.bFiltered = !1;
            a.bDrawing = !1;
        }
    }
    function T(a, b) {
        var c = a.oFeatures, d = c.bFilter; c.bSort && mb(a);
        d ? ga(a, a.oPreviousSearch) : a.aiDisplay = a.aiDisplayMaster.slice();
        !0 !== b && (a._iDisplayStart = 0); a._drawHold = b; P(a); a._drawHold = !1;
    }
    function nb(a) {
    }
    function ea(a, b) {
        var c = h(b).children("tr"), d, e, f, g, j, i, m, l, q, k;
        a.splice(0, a.length);
        f = 0;
        for (i = c.length; f < i; f++)
            a.push([]);
        f = 0;
        for (i = c.length; f <
        i; f++) {
            d = c[f];
            for (e = d.firstChild; e;) {
                if ("TD" == e.nodeName.toUpperCase() || "TH" == e.nodeName.toUpperCase()) {
                    l = 1 * e.getAttribute("colspan");
                    q = 1 * e.getAttribute("rowspan");
                    l = !l || 0 === l || 1 === l ? 1 : l;
                    q = !q || 0 === q || 1 === q ? 1 : q;
                    g = 0;
                    for (j = a[f]; j[g];)
                        g++;
                    m = g;
                    k = 1 === l ? !0 : !1;
                    for (j = 0; j < l; j++)
                        for (g = 0; g < q; g++)
                            a[f + g][m + j] = { cell: e, unique: k }, a[f + g].nTr = d;
                }
                e = e.nextSibling;
            }
        }
    }
    function ra(a, b, c) {
        var d = [];
        c || (c = a.aoHeader, b && (c = [], ea(c, b)));
        for (var b = 0, e = c.length; b < e; b++)
            for (var f = 0, g = c[b].length; f < g; f++)
                if (c[b][f].unique && (!d[f] ||
                    !a.bSortCellsTop))
                    d[f] = c[b][f].cell;
        return d;
    }
    function sa(a, b, c) {}
    function lb(a) { }
    function ub(a) {
    }
    function vb(a, b) {
    }
    function ta(a, b) { }
    function pb(a) {}
    function ga(a, b, c) {}
    function yb(a) { }
    function xb(a, b, c, d, e, f) {  }
    function wb(a, b, c, d, e, f) {
    }
    function Pa(a, b, c, d) {
    }
    function zb(a) {
    }
    function Ab(a) { }
    function Bb(a) { }
    function sb(a) {
    }
    function Cb(a) {  }
    function Db(a, b) {}
    function ha(a) {
        var b, c, d = a.iInitDisplayStart, e = a.aoColumns, f;
        c = a.oFeatures;
        var g = a.bDeferLoading;
        if (a.bInitialised) {
            nb(a);
            kb(a);
            fa(a, a.aoHeader);
            fa(a, a.aoFooter);
            C(a, !0);
            c.bAutoWidth && Fa(a);
            b = 0;
            for (c = e.length; b < c; b++)
                f = e[b], f.sWidth && (f.nTh.style.width = v(f.sWidth));
            r(a, null, "preInit", [a]);
            T(a);
            e =
                y(a);
            if ("ssp" != e || g)
                "ajax" == e ? sa(a, [], function (c) { var f = ta(a, c); for (b = 0; b < f.length; b++)
                    O(a, f[b]); a.iInitDisplayStart = d; T(a); C(a, !1); ua(a, c); }, a) : (C(a, !1), ua(a));
        }
        else
            setTimeout(function () { ha(a); }, 200);
    }
    function ua(a, b) {}
    function Ra(a, b) {  }
    function ob(a) {
    }
    function tb(a) {
    }
    function Ta(a, b, c) { }
    function qb(a) { }
    function C(a, b) { }
    function rb(a) {
    }
    function la(a) {
    }
    function I(a, b, c) {
    }
    function Fa(a) {}
    function Eb(a, b) {}
    function Fb(a, b) { }
    function Gb(a, b) { }
    function v(a) { }
    function X(a) {
        var b, c, d = [], e = a.aoColumns, f, g, j, i;
        b = a.aaSortingFixed;
        c = h.isPlainObject(b);
        var m = [];
        f = function (a) {
            a.length &&
            !h.isArray(a[0]) ? m.push(a) : h.merge(m, a);
        };
        h.isArray(b) && f(b);
        c && b.pre && f(b.pre);
        f(a.aaSorting);
        c && b.post && f(b.post);
        for (a = 0; a < m.length; a++) {
            i = m[a][0];
            f = e[i].aDataSort;
            b = 0;
            for (c = f.length; b < c; b++)
                g = f[b], j = e[g].sType || "string", m[a]._idx === k && (m[a]._idx = h.inArray(m[a][1], e[g].asSorting)), d.push({ src: i, col: g, dir: m[a][1], index: m[a]._idx, type: j, formatter: n.ext.type.order[j + "-pre"] });
        }
        return d;
    }
    function mb(a) {
        var b, c, d = [], e = n.ext.type.order, f = a.aoData, g = 0, j, i = a.aiDisplayMaster, h;
        Ga(a);
        h = X(a);
        b = 0;
        for (c = h.length; b <
        c; b++)
            j = h[b], j.formatter && g++, Hb(a, j.col);
        if ("ssp" != y(a) && 0 !== h.length) {
            b = 0;
            for (c = i.length; b < c; b++)
                d[i[b]] = b;
            g === h.length ? i.sort(function (a, b) { var c, e, g, j, i = h.length, k = f[a]._aSortData, n = f[b]._aSortData; for (g = 0; g < i; g++)
                if (j = h[g], c = k[j.col], e = n[j.col], c = c < e ? -1 : c > e ? 1 : 0, 0 !== c)
                    return "asc" === j.dir ? c : -c; c = d[a]; e = d[b]; return c < e ? -1 : c > e ? 1 : 0; }) : i.sort(function (a, b) {
                var c, g, j, i, k = h.length, n = f[a]._aSortData, o = f[b]._aSortData;
                for (j = 0; j < k; j++)
                    if (i = h[j], c = n[i.col], g = o[i.col], i = e[i.type + "-" + i.dir] || e["string-" + i.dir],
                        c = i(c, g), 0 !== c)
                        return c;
                c = d[a];
                g = d[b];
                return c < g ? -1 : c > g ? 1 : 0;
            });
        }
        a.bSorted = !0;
    }
    function Ib(a) { for (var b, c, d = a.aoColumns, e = X(a), a = a.oLanguage.oAria, f = 0, g = d.length; f < g; f++) {
        c = d[f];
        var j = c.asSorting;
        b = c.sTitle.replace(/<.*?>/g, "");
        var i = c.nTh;
        i.removeAttribute("aria-sort");
        c.bSortable && (0 < e.length && e[0].col == f ? (i.setAttribute("aria-sort", "asc" == e[0].dir ? "ascending" : "descending"), c = j[e[0].index + 1] || j[0]) : c = j[0], b += "asc" === c ? a.sSortAscending : a.sSortDescending);
        i.setAttribute("aria-label", b);
    } }
    function Va(a, b, c, d) {
        var e = a.aaSorting, f = a.aoColumns[b].asSorting, g = function (a, b) { var c = a._idx; c === k && (c = h.inArray(a[1], f)); return c + 1 < f.length ? c + 1 : b ? null : 0; };
        "number" === typeof e[0] && (e = a.aaSorting = [e]);
        c && a.oFeatures.bSortMulti ? (c = h.inArray(b, D(e, "0")), -1 !== c ? (b = g(e[c], !0), null === b && 1 === e.length && (b = 0), null === b ? e.splice(c, 1) : (e[c][1] = f[b], e[c]._idx = b)) : (e.push([b, f[0], 0]), e[e.length - 1]._idx = 0)) : e.length && e[0][0] == b ? (b = g(e[0]), e.length = 1, e[0][1] = f[b], e[0]._idx = b) : (e.length = 0, e.push([b, f[0]]), e[0]._idx = 0);
        T(a);
        "function" ==
        typeof d && d(a);
    }
    function Ma(a, b, c, d) { var e = a.aoColumns[c]; Wa(b, {}, function (b) { !1 !== e.bSortable && (a.oFeatures.bProcessing ? (C(a, !0), setTimeout(function () { Va(a, c, b.shiftKey, d); "ssp" !== y(a) && C(a, !1); }, 0)) : Va(a, c, b.shiftKey, d)); }); }
    function wa(a) {
        var b = a.aLastSort, c = a.oClasses.sSortColumn, d = X(a), e = a.oFeatures, f, g;
        if (e.bSort && e.bSortClasses) {
            e = 0;
            for (f = b.length; e < f; e++)
                g = b[e].src, h(D(a.aoData, "anCells", g)).removeClass(c + (2 > e ? e + 1 : 3));
            e = 0;
            for (f = d.length; e < f; e++)
                g = d[e].src, h(D(a.aoData, "anCells", g)).addClass(c +
                    (2 > e ? e + 1 : 3));
        }
        a.aLastSort = d;
    }
    function Hb(a, b) { var c = a.aoColumns[b], d = n.ext.order[c.sSortDataType], e; d && (e = d.call(a.oInstance, a, b, ba(a, b))); for (var f, g = n.ext.type.order[c.sType + "-pre"], j = 0, i = a.aoData.length; j < i; j++)
        if (c = a.aoData[j], c._aSortData || (c._aSortData = []), !c._aSortData[b] || d)
            f = d ? e[j] : B(a, j, b, "sort"), c._aSortData[b] = g ? g(f) : f; }
    function xa(a) {
    }
    function Jb(a, b, c) {
    }
    function ya(a) { }
    function K(a, b, c, d) {
    }
    function F(a, b, c, d) { h.isArray(c) ? h.each(c, function (c, d) { h.isArray(d) ? F(a, b, d[0], d[1]) : F(a, b, d); }) : (d === k && (d = c), b[c] !== k && (a[d] = b[c])); }
    function Xa(a, b, c) { var d, e; for (e in b)
        b.hasOwnProperty(e) && (d = b[e], h.isPlainObject(d) ? (h.isPlainObject(a[e]) || (a[e] = {}), h.extend(!0, a[e], d)) : a[e] = c && "data" !== e && "aaData" !== e && h.isArray(d) ? d.slice() : d); return a; }
    function Wa(a, b, c) {
        h(a).on("click.DT", b, function (b) { h(a).blur(); c(b); }).on("keypress.DT", b, function (a) { 13 === a.which && (a.preventDefault(), c(a)); }).on("selectstart.DT", function () { return !1; });
    }
    function z(a, b, c, d) { c && a[b].push({ fn: c, sName: d }); }
    function r(a, b, c, d) { var e = []; b && (e = h.map(a[b].slice().reverse(), function (b) { return b.fn.apply(a.oInstance, d); })); null !== c && (b = h.Event(c + ".dt"), h(a.nTable).trigger(b, d), e.push(b.result)); return e; }
    function Sa(a) { var b = a._iDisplayStart, c = a.fnDisplayEnd(), d = a._iDisplayLength; b >= c && (b = c - d); b -= b % d; if (-1 === d || 0 > b)
        b = 0; a._iDisplayStart = b; }
    function Na(a, b) {
        var c = a.renderer, d = n.ext.renderer[b];
        return h.isPlainObject(c) && c[b] ? d[c[b]] || d._ : "string" ===
        typeof c ? d[c] || d._ : d._;
    }
    function y(a) { return a.oFeatures.bServerSide ? "ssp" : a.ajax || a.sAjaxSource ? "ajax" : "dom"; }
    function ia(a, b) {}
    function Da(a) {
        h.each({ num: function (b) { return za(b, a); }, "num-fmt": function (b) { return za(b, a, Ya); }, "html-num": function (b) {
                return za(b, a, Aa);
            }, "html-num-fmt": function (b) { return za(b, a, Aa, Ya); } }, function (b, c) { x.type.order[b + a + "-pre"] = c; b.match(/^html\-/) && (x.type.search[b + a] = x.type.search.html); });
    }
    function Lb(a) { return function () { var b = [ya(this[n.ext.iApiIndex])].concat(Array.prototype.slice.call(arguments)); return n.ext.internal[a].apply(this, b); }; }
    var n = function (a) {
        var b = this, c = a === k, d = this.length;
        this.each(function () {
            var e = {}, g = 1 < d ? Xa(e, a, !0) : a, j = 0, i, e = this.getAttribute("id"), m = !1, l = n.defaults, q = h(this);
            if ("table" != this.nodeName.toLowerCase())
                K(null, 0, "Non-table node initialisation (" + this.nodeName + ")", 2);
            else {
                var t = n.settings, j = 0;
                for (i = t.length; j < i; j++) {
                    var o = t[j];
                    if (o.nTable == this || o.nTHead && o.nTHead.parentNode == this || o.nTFoot && o.nTFoot.parentNode == this) {
                        var s = g.bRetrieve !== k ? g.bRetrieve : l.bRetrieve;
                        if (c || s)
                            return o.oInstance;
                        if (g.bDestroy !== k ? g.bDestroy : l.bDestroy) {
                            o.oInstance.fnDestroy();
                            break;
                        }
                        else {
                            K(o, 0, "Cannot reinitialise DataTable", 3);
                            return;
                        }
                    }
                    if (o.sTableId == this.id) {
                        t.splice(j, 1);
                        break;
                    }
                }
                if (null === e || "" === e)
                    this.id = e = "DataTables_Table_" + n.ext._unique++;
                var p = h.extend(!0, {}, n.models.oSettings, { sDestroyWidth: q[0].style.width,
                    sInstance: e, sTableId: e });
                p.nTable = this;
                p.oApi = b.internal;
                p.oInit = g;
                t.push(p);
                p.oInstance = 1 === b.length ? b : q.dataTable();
                eb(g);
                Ca(g.oLanguage);
                g.aLengthMenu && !g.iDisplayLength && (g.iDisplayLength = h.isArray(g.aLengthMenu[0]) ? g.aLengthMenu[0][0] : g.aLengthMenu[0]);
                g = Xa(h.extend(!0, {}, l), g);
                F(p.oFeatures, g, "bPaginate bLengthChange bFilter bSort bSortMulti bInfo bProcessing bAutoWidth bSortClasses bServerSide bDeferRender".split(" "));
                F(p, g, ["asStripeClasses", "ajax", "fnServerData", "fnFormatNumber", "sServerMethod",
                    "aaSorting", "aaSortingFixed", "aLengthMenu", "sPaginationType", "sAjaxSource", "sAjaxDataProp", "iStateDuration", "sDom", "bSortCellsTop", "iTabIndex", "fnStateLoadCallback", "fnStateSaveCallback", "renderer", "searchDelay", "rowId", ["iCookieDuration", "iStateDuration"], ["oSearch", "oPreviousSearch"], ["aoSearchCols", "aoPreSearchCols"], ["iDisplayLength", "_iDisplayLength"]]);
                F(p.oScroll, g, [["sScrollX", "sX"], ["sScrollXInner", "sXInner"], ["sScrollY", "sY"], ["bScrollCollapse", "bCollapse"]]);
                F(p.oLanguage, g, "fnInfoCallback");
                p.rowIdFn = S(g.rowId);
                gb(p);
                var u = p.oClasses;
                h.extend(u, n.ext.classes, g.oClasses);
                q.addClass(u.sTable);
                p.iInitDisplayStart === k && (p.iInitDisplayStart = g.iDisplayStart, p._iDisplayStart = g.iDisplayStart);
                null !== g.iDeferLoading && (p.bDeferLoading = !0, e = h.isArray(g.iDeferLoading), p._iRecordsDisplay = e ? g.iDeferLoading[0] : g.iDeferLoading, p._iRecordsTotal = e ? g.iDeferLoading[1] : g.iDeferLoading);
                var v = p.oLanguage;
                h.extend(!0, v, g.oLanguage);
                v.sUrl && (h.ajax({ dataType: "json", url: v.sUrl, success: function (a) {
                        Ca(a);
                        J(l.oLanguage, a);
                        h.extend(true, v, a);
                        ha(p);
                    }, error: function () { ha(p); } }), m = !0);
                null === g.asStripeClasses && (p.asStripeClasses = [u.sStripeOdd, u.sStripeEven]);
                var e = p.asStripeClasses, x = q.children("tbody").find("tr").eq(0);
                -1 !== h.inArray(!0, h.map(e, function (a) { return x.hasClass(a); })) && (h("tbody tr", this).removeClass(e.join(" ")), p.asDestroyStripes = e.slice());
                e = [];
                t = this.getElementsByTagName("thead");
                0 !== t.length && (ea(p.aoHeader, t[0]), e = ra(p));
                if (null === g.aoColumns) {
                    t = [];
                    j = 0;
                    for (i = e.length; j < i; j++)
                        t.push(null);
                }
                else
                    t =
                        g.aoColumns;
                j = 0;
                for (i = t.length; j < i; j++)
                    Ea(p, e ? e[j] : null);
                ib(p, g.aoColumnDefs, t, function (a, b) { ka(p, a, b); });
                if (x.length) {
                    var w = function (a, b) { return a.getAttribute("data-" + b) !== null ? b : null; };
                    h(x[0]).children("th, td").each(function (a, b) { var c = p.aoColumns[a]; if (c.mData === a) {
                        var d = w(b, "sort") || w(b, "order"), e = w(b, "filter") || w(b, "search");
                        if (d !== null || e !== null) {
                            c.mData = { _: a + ".display", sort: d !== null ? a + ".@data-" + d : k, type: d !== null ? a + ".@data-" + d : k, filter: e !== null ? a + ".@data-" + e : k };
                            ka(p, a);
                        }
                    } });
                }
                var U = p.oFeatures, e = function () {
                    if (g.aaSorting === k) {
                        var a = p.aaSorting;
                        j = 0;
                        for (i = a.length; j < i; j++)
                            a[j][1] = p.aoColumns[j].asSorting[0];
                    }
                    wa(p);
                    U.bSort && z(p, "aoDrawCallback", function () { if (p.bSorted) {
                        var a = X(p), b = {};
                        h.each(a, function (a, c) { b[c.src] = c.dir; });
                        r(p, null, "order", [p, a, b]);
                        Ib(p);
                    } });
                    z(p, "aoDrawCallback", function () { (p.bSorted || y(p) === "ssp" || U.bDeferRender) && wa(p); }, "sc");
                    var a = q.children("caption").each(function () { this._captionSide = h(this).css("caption-side"); }), b = q.children("thead");
                    b.length === 0 && (b = h("<thead/>").appendTo(q));
                    p.nTHead = b[0];
                    b = q.children("tbody");
                    b.length === 0 && (b = h("<tbody/>").appendTo(q));
                    p.nTBody = b[0];
                    b = q.children("tfoot");
                    if (b.length === 0 && a.length > 0 && (p.oScroll.sX !== "" || p.oScroll.sY !== ""))
                        b = h("<tfoot/>").appendTo(q);
                    if (b.length === 0 || b.children().length === 0)
                        q.addClass(u.sNoFooter);
                    else if (b.length > 0) {
                        p.nTFoot = b[0];
                        ea(p.aoFooter, p.nTFoot);
                    }
                    if (g.aaData)
                        for (j = 0; j < g.aaData.length; j++)
                            O(p, g.aaData[j]);
                    else
                        (p.bDeferLoading || y(p) == "dom") && na(p, h(p.nTBody).children("tr"));
                    p.aiDisplay = p.aiDisplayMaster.slice();
                    p.bInitialised = true;
                    m === false && ha(p);
                };
                g.bStateSave ? (U.bStateSave = !0, z(p, "aoDrawCallback", xa, "state_save"), Jb(p, g, e)) : e();
            }
        });
        b = null;
        return this;
    }, x, s, o, u, Za = {}, Mb = /[\r\n]/g, Aa = /<.*?>/g, Zb = /^\d{2,4}[\.\/\-]\d{1,2}[\.\/\-]\d{1,2}([T ]{1}\d{1,2}[:\.]\d{2}([\.:]\d{2})?)?$/, $b = RegExp("(\\/|\\.|\\*|\\+|\\?|\\||\\(|\\)|\\[|\\]|\\{|\\}|\\\\|\\$|\\^|\\-)", "g"), Ya = /[',$£€¥%\u2009\u202F\u20BD\u20a9\u20BArfkɃΞ]/gi, M = function (a) { return !a || !0 === a || "-" === a ? !0 : !1; }, Nb = function (a) {
        var b = parseInt(a, 10);
        return !isNaN(b) &&
        isFinite(a) ? b : null;
    }, Ob = function (a, b) { Za[b] || (Za[b] = RegExp(Qa(b), "g")); return "string" === typeof a && "." !== b ? a.replace(/\./g, "").replace(Za[b], ".") : a; }, $a = function (a, b, c) { var d = "string" === typeof a; if (M(a))
        return !0; b && d && (a = Ob(a, b)); c && d && (a = a.replace(Ya, "")); return !isNaN(parseFloat(a)) && isFinite(a); }, Pb = function (a, b, c) { return M(a) ? !0 : !(M(a) || "string" === typeof a) ? null : $a(a.replace(Aa, ""), b, c) ? !0 : null; }, D = function (a, b, c) {
        var d = [], e = 0, f = a.length;
        if (c !== k)
            for (; e < f; e++)
                a[e] && a[e][b] && d.push(a[e][b][c]);
        else
            for (; e <
                   f; e++)
                a[e] && d.push(a[e][b]);
        return d;
    }, ja = function (a, b, c, d) { var e = [], f = 0, g = b.length; if (d !== k)
        for (; f < g; f++)
            a[b[f]][c] && e.push(a[b[f]][c][d]);
    else
        for (; f < g; f++)
            e.push(a[b[f]][c]); return e; }, Y = function (a, b) { var c = [], d; b === k ? (b = 0, d = a) : (d = b, b = a); for (var e = b; e < d; e++)
        c.push(e); return c; }, Qb = function (a) { for (var b = [], c = 0, d = a.length; c < d; c++)
        a[c] && b.push(a[c]); return b; }, qa = function (a) {
        var b;
        a: {
            if (!(2 > a.length)) {
                b = a.slice().sort();
                for (var c = b[0], d = 1, e = b.length; d < e; d++) {
                    if (b[d] === c) {
                        b = !1;
                        break a;
                    }
                    c = b[d];
                }
            }
            b = !0;
        }
        if (b)
            return a.slice();
        b = [];
        var e = a.length, f, g = 0, d = 0;
        a: for (; d < e; d++) {
            c = a[d];
            for (f = 0; f < g; f++)
                if (b[f] === c)
                    continue a;
            b.push(c);
            g++;
        }
        return b;
    };
    n.util = { throttle: function (a, b) { var c = b !== k ? b : 200, d, e; return function () { var b = this, g = +new Date, j = arguments; d && g < d + c ? (clearTimeout(e), e = setTimeout(function () { d = k; a.apply(b, j); }, c)) : (d = g, a.apply(b, j)); }; }, escapeRegex: function (a) { return a.replace($b, "\\$1"); } };
    var A = function (a, b, c) { a[b] !== k && (a[c] = a[b]); }, ca = /\[.*?\]$/, W = /\(\)$/, Qa = n.util.escapeRegex, va = h("<div>")[0], Wb = va.textContent !== k, Yb = /<.*?>/g, Oa = n.util.throttle, Rb = [], w = Array.prototype, ac = function (a) { var b, c, d = n.settings, e = h.map(d, function (a) { return a.nTable; }); if (a) {
        if (a.nTable && a.oApi)
            return [a];
        if (a.nodeName && "table" === a.nodeName.toLowerCase())
            return b = h.inArray(a, e), -1 !== b ? [d[b]] : null;
        if (a && "function" === typeof a.settings)
            return a.settings().toArray();
        "string" === typeof a ? c = h(a) : a instanceof h && (c = a);
    }
    else
        return []; if (c)
        return c.map(function () { b = h.inArray(this, e); return -1 !== b ? d[b] : null; }).toArray(); };
    s = function (a, b) {
        if (!(this instanceof
            s))
            return new s(a, b);
        var c = [], d = function (a) { (a = ac(a)) && (c = c.concat(a)); };
        if (h.isArray(a))
            for (var e = 0, f = a.length; e < f; e++)
                d(a[e]);
        else
            d(a);
        this.context = qa(c);
        b && h.merge(this, b);
        this.selector = { rows: null, cols: null, opts: null };
        s.extend(this, this, Rb);
    };
    n.Api = s;
    n.camelToHungarian = J;
    n.version = "1.10.18";
    n.settings = [];
    n.models = {};
    n.models.oSearch = { bCaseInsensitive: !0, sSearch: "", bRegex: !1, bSmart: !0 };
    n.models.oRow = { nTr: null, anCells: null, _aData: [], _aSortData: null, _aFilterData: null, _sFilterRow: null, _sRowStripe: "", src: null, idx: -1 };
    n.models.oColumn = { idx: null, aDataSort: null, asSorting: null, bSearchable: null, bSortable: null, bVisible: null, _sManualType: null, _bAttrSrc: !1, fnCreatedCell: null, fnGetData: null, fnSetData: null, mData: null, mRender: null, nTh: null, nTf: null,
        sClass: null, sContentPadding: null, sDefaultContent: null, sName: null, sSortDataType: "std", sSortingClass: null, sSortingClassJUI: null, sTitle: null, sType: null, sWidth: null, sWidthOrig: null };
    n.defaults = { aaData: null, aaSorting: [[0, "asc"]], aaSortingFixed: [], ajax: null, aLengthMenu: [10, 25, 50, 100], aoColumns: null, aoColumnDefs: null, aoSearchCols: [], asStripeClasses: null, bAutoWidth: !0, bDeferRender: !1, bDestroy: !1, bFilter: !0, bInfo: !0, bLengthChange: !0, bPaginate: !0, bProcessing: !1, bRetrieve: !1, bScrollCollapse: !1, bServerSide: !1,
        bSort: !0, bSortMulti: !0, bSortCellsTop: !1, bSortClasses: !0, bStateSave: !1, fnCreatedRow: null, fnDrawCallback: null, fnFooterCallback: null, fnFormatNumber: function (a) { return a.toString().replace(/\B(?=(\d{3})+(?!\d))/g, this.oLanguage.sThousands); }, fnHeaderCallback: null, fnInfoCallback: null, fnInitComplete: null, fnPreDrawCallback: null, fnRowCallback: null, fnServerData: null, fnServerParams: null, fnStateLoadCallback: function (a) {
            try {
                return JSON.parse((-1 === a.iStateDuration ? sessionStorage : localStorage).getItem("DataTables_" +
                    a.sInstance + "_" + location.pathname));
            }
            catch (b) { }
        }, fnStateLoadParams: null, fnStateLoaded: null, fnStateSaveCallback: function (a, b) { try {
            (-1 === a.iStateDuration ? sessionStorage : localStorage).setItem("DataTables_" + a.sInstance + "_" + location.pathname, JSON.stringify(b));
        }
        catch (c) { } }, fnStateSaveParams: null, iStateDuration: 7200, iDeferLoading: null, iDisplayLength: 10, iDisplayStart: 0, iTabIndex: 0, oClasses: {}, oLanguage: { oAria: { sSortAscending: ": activate to sort column ascending", sSortDescending: ": activate to sort column descending" },
            oPaginate: { sFirst: "First", sLast: "Last", sNext: "Next", sPrevious: "Previous" }, sEmptyTable: "No data available in table", sInfo: "Showing _START_ to _END_ of _TOTAL_ entries", sInfoEmpty: "Showing 0 to 0 of 0 entries", sInfoFiltered: "(filtered from _MAX_ total entries)", sInfoPostFix: "", sDecimal: "", sThousands: ",", sLengthMenu: "Show _MENU_ entries", sLoadingRecords: "Loading...", sProcessing: "Processing...", sSearch: "Search:", sSearchPlaceholder: "", sUrl: "", sZeroRecords: "No matching records found" }, oSearch: h.extend({}, n.models.oSearch), sAjaxDataProp: "data", sAjaxSource: null, sDom: "lfrtip", searchDelay: null, sPaginationType: "simple_numbers", sScrollX: "", sScrollXInner: "", sScrollY: "", sServerMethod: "GET", renderer: null, rowId: "DT_RowId" };
    n.defaults.column = { aDataSort: null, iDataSort: -1, asSorting: ["asc", "desc"], bSearchable: !0, bSortable: !0, bVisible: !0, fnCreatedCell: null, mData: null, mRender: null, sCellType: "td", sClass: "", sContentPadding: "", sDefaultContent: null, sName: "", sSortDataType: "std", sTitle: null, sType: null, sWidth: null };
    n.models.oSettings = { oFeatures: { bAutoWidth: null, bDeferRender: null, bFilter: null, bInfo: null, bLengthChange: null, bPaginate: null, bProcessing: null, bServerSide: null, bSort: null, bSortMulti: null, bSortClasses: null, bStateSave: null }, oScroll: { bCollapse: null, iBarWidth: 0, sX: null, sXInner: null, sY: null }, oLanguage: { fnInfoCallback: null }, oBrowser: { bScrollOversize: !1, bScrollbarLeft: !1, bBounding: !1, barWidth: 0 }, ajax: null, aanFeatures: [], aoData: [], aiDisplay: [], aiDisplayMaster: [], aIds: {}, aoColumns: [], aoHeader: [],
        aoFooter: [], oPreviousSearch: {}, aoPreSearchCols: [], aaSorting: null, aaSortingFixed: [], asStripeClasses: null, asDestroyStripes: [], sDestroyWidth: 0, aoRowCallback: [], aoHeaderCallback: [], aoFooterCallback: [], aoDrawCallback: [], aoRowCreatedCallback: [], aoPreDrawCallback: [], aoInitComplete: [], aoStateSaveParams: [], aoStateLoadParams: [], aoStateLoaded: [], sTableId: "", nTable: null, nTHead: null, nTFoot: null, nTBody: null, nTableWrapper: null, bDeferLoading: !1, bInitialised: !1, aoOpenRows: [], sDom: null, searchDelay: null, sPaginationType: "two_button",
        iStateDuration: 0, aoStateSave: [], aoStateLoad: [], oSavedState: null, oLoadedState: null, sAjaxSource: null, sAjaxDataProp: null, bAjaxDataGet: !0, jqXHR: null, json: k, oAjaxData: k, fnServerData: null, aoServerParams: [], sServerMethod: null, fnFormatNumber: null, aLengthMenu: null, iDraw: 0, bDrawing: !1, iDrawError: -1, _iDisplayLength: 10, _iDisplayStart: 0, _iRecordsTotal: 0, _iRecordsDisplay: 0, oClasses: {}, bFiltered: !1, bSorted: !1, bSortCellsTop: null, oInit: null, aoDestroyCallback: [], fnRecordsTotal: function () {
            return "ssp" == y(this) ? 1 * this._iRecordsTotal :
                this.aiDisplayMaster.length;
        }, fnRecordsDisplay: function () { return "ssp" == y(this) ? 1 * this._iRecordsDisplay : this.aiDisplay.length; }, fnDisplayEnd: function () { var a = this._iDisplayLength, b = this._iDisplayStart, c = b + a, d = this.aiDisplay.length, e = this.oFeatures, f = e.bPaginate; return e.bServerSide ? !1 === f || -1 === a ? b + d : Math.min(b + a, this._iRecordsDisplay) : !f || c > d || -1 === a ? d : c; }, oInstance: null, sInstance: null, iTabIndex: 0, nScrollHead: null, nScrollFoot: null, aLastSort: [], oPlugins: {}, rowIdFn: null, rowId: null };
    n.ext = x = { buttons: {},
        classes: {}, build: "bs4/dt-1.10.18", errMode: "alert", feature: [], search: [], selector: { cell: [], column: [], row: [] }, internal: {}, legacy: { ajax: null }, pager: {}, renderer: { pageButton: {}, header: {} }, order: {}, type: { detect: [], search: {}, order: {} }, _unique: 0, fnVersionCheck: n.fnVersionCheck, iApiIndex: 0, oJUIClasses: {}, sVersion: n.version };
    h.extend(x, { afnFiltering: x.search, aTypes: x.type.detect, ofnSearch: x.type.search, oSort: x.type.order, afnSortData: x.order, aoFeatures: x.feature, oApi: x.internal, oStdClasses: x.classes, oPagination: x.pager });
    h.extend(n.ext.classes, { sTable: "dataTable", sNoFooter: "no-footer", sPageButton: "paginate_button", sPageButtonActive: "current", sPageButtonDisabled: "disabled", sStripeOdd: "odd", sStripeEven: "even", sRowEmpty: "dataTables_empty", sWrapper: "dataTables_wrapper", sFilter: "dataTables_filter", sInfo: "dataTables_info", sPaging: "dataTables_paginate paging_", sLength: "dataTables_length", sProcessing: "dataTables_processing", sSortAsc: "sorting_asc", sSortDesc: "sorting_desc", sSortable: "sorting", sSortableAsc: "sorting_asc_disabled",
        sSortableDesc: "sorting_desc_disabled", sSortableNone: "sorting_disabled", sSortColumn: "sorting_", sFilterInput: "", sLengthSelect: "", sScrollWrapper: "dataTables_scroll", sScrollHead: "dataTables_scrollHead", sScrollHeadInner: "dataTables_scrollHeadInner", sScrollBody: "dataTables_scrollBody", sScrollFoot: "dataTables_scrollFoot", sScrollFootInner: "dataTables_scrollFootInner", sHeaderTH: "", sFooterTH: "", sSortJUIAsc: "", sSortJUIDesc: "", sSortJUI: "", sSortJUIAscAllowed: "", sSortJUIDescAllowed: "", sSortJUIWrapper: "", sSortIcon: "",
        sJUIHeader: "", sJUIFooter: "" });
    h.extend(n.ext.type.detect, [function (a, b) { var c = b.oLanguage.sDecimal; return $a(a, c) ? "num" + c : null; }, function (a) { if (a && !(a instanceof Date) && !Zb.test(a))
        return null; var b = Date.parse(a); return null !== b && !isNaN(b) || M(a) ? "date" : null; }, function (a, b) { var c = b.oLanguage.sDecimal; return $a(a, c, !0) ? "num-fmt" + c : null; }, function (a, b) { var c = b.oLanguage.sDecimal; return Pb(a, c) ? "html-num" + c : null; }, function (a, b) { var c = b.oLanguage.sDecimal; return Pb(a, c, !0) ? "html-num-fmt" + c : null; }, function (a) {
        return M(a) ||
        "string" === typeof a && -1 !== a.indexOf("<") ? "html" : null;
    }]);
    h.extend(n.ext.type.search, { html: function (a) { return M(a) ? a : "string" === typeof a ? a.replace(Mb, " ").replace(Aa, "") : ""; }, string: function (a) { return M(a) ? a : "string" === typeof a ? a.replace(Mb, " ") : a; } });
    var za = function (a, b, c, d) { if (0 !== a && (!a || "-" === a))
        return -Infinity; b && (a = Ob(a, b)); a.replace && (c && (a = a.replace(c, "")), d && (a = a.replace(d, ""))); return 1 * a; };
    h.extend(x.type.order, { "date-pre": function (a) { a = Date.parse(a); return isNaN(a) ? -Infinity : a; }, "html-pre": function (a) {
            return M(a) ?
                "" : a.replace ? a.replace(/<.*?>/g, "").toLowerCase() : a + "";
        }, "string-pre": function (a) { return M(a) ? "" : "string" === typeof a ? a.toLowerCase() : !a.toString ? "" : a.toString(); }, "string-asc": function (a, b) { return a < b ? -1 : a > b ? 1 : 0; }, "string-desc": function (a, b) { return a < b ? 1 : a > b ? -1 : 0; } });
    Da("");
    h.extend(!0, n.ext.renderer, { header: { _: function (a, b, c, d) {
                h(a.nTable).on("order.dt.DT", function (e, f, g, h) {
                    if (a === f) {
                        e = c.idx;
                        b.removeClass(c.sSortingClass + " " + d.sSortAsc + " " + d.sSortDesc).addClass(h[e] == "asc" ? d.sSortAsc : h[e] == "desc" ? d.sSortDesc :
                            c.sSortingClass);
                    }
                });
            }, jqueryui: function (a, b, c, d) {
                h("<div/>").addClass(d.sSortJUIWrapper).append(b.contents()).append(h("<span/>").addClass(d.sSortIcon + " " + c.sSortingClassJUI)).appendTo(b);
                h(a.nTable).on("order.dt.DT", function (e, f, g, h) {
                    if (a === f) {
                        e = c.idx;
                        b.removeClass(d.sSortAsc + " " + d.sSortDesc).addClass(h[e] == "asc" ? d.sSortAsc : h[e] == "desc" ? d.sSortDesc : c.sSortingClass);
                        b.find("span." + d.sSortIcon).removeClass(d.sSortJUIAsc + " " + d.sSortJUIDesc + " " + d.sSortJUI + " " + d.sSortJUIAscAllowed + " " + d.sSortJUIDescAllowed).addClass(h[e] ==
                        "asc" ? d.sSortJUIAsc : h[e] == "desc" ? d.sSortJUIDesc : c.sSortingClassJUI);
                    }
                });
            } } });
    var Vb = function (a) { return "string" === typeof a ? a.replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;") : a; };
    n.render = { number: function (a, b, c, d, e) {
            return { display: function (f) {
                    if ("number" !== typeof f && "string" !== typeof f)
                        return f;
                    var g = 0 > f ? "-" : "", h = parseFloat(f);
                    if (isNaN(h))
                        return Vb(f);
                    h = h.toFixed(c);
                    f = Math.abs(h);
                    h = parseInt(f, 10);
                    f = c ? b + (f - h).toFixed(c).substring(2) : "";
                    return g + (d || "") + h.toString().replace(/\B(?=(\d{3})+(?!\d))/g, a) + f + (e || "");
                } };
        }, text: function () { return { display: Vb }; } };
    h.extend(n.ext.internal, { _fnExternApiFunc: Lb, _fnBuildAjax: sa, _fnAjaxUpdate: lb, _fnAjaxParameters: ub, _fnAjaxUpdateDraw: vb, _fnAjaxDataSrc: ta, _fnAddColumn: Ea, _fnColumnOptions: ka, _fnAdjustColumnSizing: $, _fnVisibleToColumnIndex: aa, _fnColumnIndexToVisible: ba, _fnVisbleColumns: V, _fnGetColumns: ma, _fnColumnTypes: Ga, _fnApplyColumnDefs: ib, _fnHungarianMap: Z, _fnCamelToHungarian: J, _fnLanguageCompat: Ca, _fnBrowserDetect: gb, _fnAddData: O, _fnAddTr: na, _fnNodeToDataIndex: function (a, b) { return b._DT_RowIndex !== k ? b._DT_RowIndex : null; }, _fnNodeToColumnIndex: function (a, b, c) { return h.inArray(c, a.aoData[b].anCells); }, _fnGetCellData: B, _fnSetCellData: jb, _fnSplitObjNotation: Ja, _fnGetObjectDataFn: S, _fnSetObjectDataFn: N, _fnGetDataMaster: Ka, _fnClearTable: oa, _fnDeleteIndex: pa, _fnInvalidate: da, _fnGetRowElements: Ia, _fnCreateTr: Ha, _fnBuildHead: kb, _fnDrawHead: fa, _fnDraw: P, _fnReDraw: T, _fnAddOptionsHtml: nb, _fnDetectHeader: ea, _fnGetUniqueThs: ra, _fnFeatureHtmlFilter: pb, _fnFilterComplete: ga, _fnFilterCustom: yb,
        _fnFilterColumn: xb, _fnFilter: wb, _fnFilterCreateSearch: Pa, _fnEscapeRegex: Qa, _fnFilterData: zb, _fnFeatureHtmlInfo: sb, _fnUpdateInfo: Cb, _fnInfoMacros: Db, _fnInitialise: ha, _fnInitComplete: ua, _fnLengthChange: Ra, _fnFeatureHtmlLength: ob, _fnFeatureHtmlPaginate: tb, _fnPageChange: Ta, _fnFeatureHtmlProcessing: qb, _fnProcessingDisplay: C, _fnFeatureHtmlTable: rb, _fnScrollDraw: la, _fnApplyToChildren: I, _fnCalculateColumnWidths: Fa, _fnThrottle: Oa, _fnConvertToWidth: Eb, _fnGetWidestNode: Fb, _fnGetMaxLenString: Gb, _fnStringToCss: v,
        _fnSortFlatten: X, _fnSort: mb, _fnSortAria: Ib, _fnSortListener: Va, _fnSortAttachListener: Ma, _fnSortingClasses: wa, _fnSortData: Hb, _fnSaveState: xa, _fnLoadState: Jb, _fnSettingsFromNode: ya, _fnLog: K, _fnMap: F, _fnBindAction: Wa, _fnCallbackReg: z, _fnCallbackFire: r, _fnLengthOverflow: Sa, _fnRenderer: Na, _fnDataSource: y, _fnRowAttributes: La, _fnExtend: Xa, _fnCalculateEnd: function () { } });
    h.fn.dataTable = n;
    n.$ = h;
    h.fn.dataTableSettings = n.settings;
    h.fn.dataTableExt = n.ext;
    h.fn.DataTable = function (a) { return h(this).dataTable(a).api(); };
    h.each(n, function (a, b) { h.fn.DataTable[a] = b; });
    return h.fn.dataTable;
});
/*!
 DataTables Bootstrap 4 integration
 ©2011-2017 SpryMedia Ltd - datatables.net/license
*/
(function (b) { "function" === typeof define && define.amd ? define(["jquery", "datatables.net"], function (a) { return b(a, window, document); }) : "object" === typeof exports ? module.exports = function (a, d) { a || (a = window); if (!d || !d.fn.dataTable)
    d = require("datatables.net")(a, d).$; return b(d, a, a.document); } : b(jQuery, window, document); })(function (b, a, d, m) {
    var f = b.fn.dataTable;
    b.extend(!0, f.defaults, { dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        renderer: "bootstrap" });
    b.extend(f.ext.classes, { sWrapper: "dataTables_wrapper dt-bootstrap4", sFilterInput: "form-control form-control-sm", sLengthSelect: "custom-select custom-select-sm form-control form-control-sm", sProcessing: "dataTables_processing card", sPageButton: "paginate_button page-item" });
    f.ext.renderer.pageButton.bootstrap = function (a, h, r, s, j, n) {
        var o = new f.Api(a), t = a.oClasses, k = a.oLanguage.oPaginate, u = a.oLanguage.oAria.paginate || {}, e, g, p = 0, q = function (d, f) {
            var l, h, i, c, m = function (a) {
                a.preventDefault();
                !b(a.currentTarget).hasClass("disabled") && o.page() != a.data.action && o.page(a.data.action).draw("page");
            };
            l = 0;
            for (h = f.length; l < h; l++)
                if (c = f[l], b.isArray(c))
                    q(d, c);
                else {
                    g = e = "";
                    switch (c) {
                        case "ellipsis":
                            e = "&#x2026;";
                            g = "disabled";
                            break;
                        case "first":
                            e = k.sFirst;
                            g = c + (0 < j ? "" : " disabled");
                            break;
                        case "previous":
                            e = k.sPrevious;
                            g = c + (0 < j ? "" : " disabled");
                            break;
                        case "next":
                            e = k.sNext;
                            g = c + (j < n - 1 ? "" : " disabled");
                            break;
                        case "last":
                            e = k.sLast;
                            g = c + (j < n - 1 ? "" : " disabled");
                            break;
                        default: e = c + 1, g = j === c ? "active" : "";
                    }
                    e && (i = b("<li>", { "class": t.sPageButton + " " + g, id: 0 === r && "string" === typeof c ? a.sTableId + "_" + c : null }).append(b("<a>", { href: "#", "aria-controls": a.sTableId, "aria-label": u[c], "data-dt-idx": p, tabindex: a.iTabIndex, "class": "page-link" }).html(e)).appendTo(d), a.oApi._fnBindAction(i, { action: c }, m), p++);
                }
        }, i;
        try {
            i = b(h).find(d.activeElement).data("dt-idx");
        }
        catch (v) { }
        q(b(h).empty().html('<ul class="pagination"/>').children("ul"), s);
        i !== m && b(h).find("[data-dt-idx=" + i + "]").focus();
    };
    return f;
});
