
function isCPF(e) {
    var t, a, o, n, r, s, e = e.replace(/[^\d]+/g, "");
    if (s = 1, e.length < 11)
        return!1;
    for (n = 0; n < e.length - 1; n++)
        if (e.charAt(n) != e.charAt(n + 1)) {
            s = 0;
            break
        }
    if (s)
        return!1;
    for (t = e.substring(0, 9), a = e.substring(9), o = 0, n = 10; n > 1; n--)
        o += t.charAt(10 - n) * n;
    if (r = 2 > o % 11 ? 0 : 11 - o % 11, r != a.charAt(0))
        return!1;
    for (t = e.substring(0, 10), o = 0, n = 11; n > 1; n--)
        o += t.charAt(11 - n) * n;
    return r = 2 > o % 11 ? 0 : 11 - o % 11, r != a.charAt(1) ? !1 : !0
}

function isCNPJ(c) {
    var b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

    if ((c = c.replace(/[^\d]/g, "")).length != 14)
        return false;

    if (/0{14}/.test(c))
        return false;

    for (var i = 0, n = 0; i < 12; n += c[i] * b[++i])
        ;
    if (c[12] != (((n %= 11) < 2) ? 0 : 11 - n))
        return false;

    for (var i = 0, n = 0; i <= 12; n += c[i] * b[i++])
        ;
    if (c[13] != (((n %= 11) < 2) ? 0 : 11 - n))
        return false;

    return true;

}
