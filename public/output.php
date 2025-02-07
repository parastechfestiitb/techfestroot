<?php
/** Adminer - Compact database management
 * @link https://www.adminer.org/
 * @author Jakub Vrana, https://www.vrana.cz/
 * @copyright 2007 Jakub Vrana
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
 * @version 4.7.3
 */
error_reporting(6135);
$Xc = !preg_match('~^(unsafe_raw)?$~', ini_get("filter.default"));
if ($Xc || ini_get("filter.default_flags")) {
    foreach (array(
        '_GET',
        '_POST',
        '_COOKIE',
        '_SERVER'
    ) as $X) {
        $Ki = filter_input_array(constant("INPUT$X"), FILTER_UNSAFE_RAW);
        if ($Ki)
            $$X = $Ki;
    }
}
if (function_exists("mb_internal_encoding"))
    mb_internal_encoding("8bit");
function connection()
{
    global $h;
    return $h;
}
function adminer()
{
    global $b;
    return $b;
}
function version()
{
    global $ia;
    return $ia;
}
function idf_unescape($v)
{
    $qe = substr($v, -1);
    return str_replace($qe . $qe, $qe, substr($v, 1, -1));
}
function escape_string($X)
{
    return substr(q($X), 1, -1);
}
function number($X)
{
    return preg_replace('~[^0-9]+~', '', $X);
}
function number_type()
{
    return '((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';
}
function remove_slashes($tg, $Xc = false)
{
    if (get_magic_quotes_gpc()) {
        while (list($z, $X) = each($tg)) {
            foreach ($X as $fe => $W) {
                unset($tg[$z][$fe]);
                if (is_array($W)) {
                    $tg[$z][stripslashes($fe)] = $W;
                    $tg[] =& $tg[$z][stripslashes($fe)];
                } else
                    $tg[$z][stripslashes($fe)] = ($Xc ? $W : stripslashes($W));
            }
        }
    }
}
function bracket_escape($v, $Pa = false)
{
    static $wi = array(':' => ':1', ']' => ':2', '[' => ':3', '"' => ':4');
    return strtr($v, ($Pa ? array_flip($wi) : $wi));
}
function min_version($cj, $Ee = "", $i = null)
{
    global $h;
    if (!$i)
        $i = $h;
    $oh = $i->server_info;
    if ($Ee && preg_match('~([\d.]+)-MariaDB~', $oh, $B)) {
        $oh = $B[1];
        $cj = $Ee;
    }
    return (version_compare($oh, $cj) >= 0);
}
function charset($h)
{
    return (min_version("5.5.3", 0, $h) ? "utf8mb4" : "utf8");
}
function script($zh, $vi = "\n")
{
    return "<script" . nonce() . ">$zh</script>$vi";
}
function script_src($Pi)
{
    return "<script src='" . h($Pi) . "'" . nonce() . "></script>\n";
}
function nonce()
{
    return ' nonce="' . get_nonce() . '"';
}
function target_blank()
{
    return ' target="_blank" rel="noreferrer noopener"';
}
function h($P)
{
    return str_replace("\0", "&#0;", htmlspecialchars($P, ENT_QUOTES, 'utf-8'));
}
function nl_br($P)
{
    return str_replace("\n", "<br>", $P);
}
function checkbox($C, $Y, $gb, $me = "", $vf = "", $lb = "", $ne = "")
{
    $I = "<input type='checkbox' name='$C' value='" . h($Y) . "'" . ($gb ? " checked" : "") . ($ne ? " aria-labelledby='$ne'" : "") . ">" . ($vf ? script("qsl('input').onclick = function () { $vf };", "") : "");
    return ($me != "" || $lb ? "<label" . ($lb ? " class='$lb'" : "") . ">$I" . h($me) . "</label>" : $I);
}
function optionlist($Af, $ih = null, $Ui = false)
{
    $I = "";
    foreach ($Af as $fe => $W) {
        $Bf = array(
            $fe => $W
        );
        if (is_array($W)) {
            $I .= '<optgroup label="' . h($fe) . '">';
            $Bf = $W;
        }
        foreach ($Bf as $z => $X)
            $I .= '<option' . ($Ui || is_string($z) ? ' value="' . h($z) . '"' : '') . (($Ui || is_string($z) ? (string) $z : $X) === $ih ? ' selected' : '') . '>' . h($X);
        if (is_array($W))
            $I .= '</optgroup>';
    }
    return $I;
}
function html_select($C, $Af, $Y = "", $uf = true, $ne = "")
{
    if ($uf)
        return "<select name='" . h($C) . "'" . ($ne ? " aria-labelledby='$ne'" : "") . ">" . optionlist($Af, $Y) . "</select>" . (is_string($uf) ? script("qsl('select').onchange = function () { $uf };", "") : "");
    $I = "";
    foreach ($Af as $z => $X)
        $I .= "<label><input type='radio' name='" . h($C) . "' value='" . h($z) . "'" . ($z == $Y ? " checked" : "") . ">" . h($X) . "</label>";
    return $I;
}
function select_input($Ka, $Af, $Y = "", $uf = "", $fg = "")
{
    $ai = ($Af ? "select" : "input");
    return "<$ai$Ka" . ($Af ? "><option value=''>$fg" . optionlist($Af, $Y, true) . "</select>" : " size='10' value='" . h($Y) . "' placeholder='$fg'>") . ($uf ? script("qsl('$ai').onchange = $uf;", "") : "");
}
function confirm($Oe = "", $jh = "qsl('input')")
{
    return script("$jh.onclick = function () { return confirm('" . ($Oe ? js_escape($Oe) : lang(0)) . "'); };", "");
}
function print_fieldset($u, $ve, $fj = false)
{
    echo "<fieldset><legend>", "<a href='#fieldset-$u'>$ve</a>", script("qsl('a').onclick = partial(toggle, 'fieldset-$u');", ""), "</legend>", "<div id='fieldset-$u'" . ($fj ? "" : " class='hidden'") . ">\n";
}
function bold($Xa, $lb = "")
{
    return ($Xa ? " class='active $lb'" : ($lb ? " class='$lb'" : ""));
}
function odd($I = ' class="odd"')
{
    static $t = 0;
    if (!$I)
        $t = -1;
    return ($t++ % 2 ? $I : '');
}
function js_escape($P)
{
    return addcslashes($P, "\r\n'\\/");
}
function json_row($z, $X = null)
{
    static $Yc = true;
    if ($Yc)
        echo "{";
    if ($z != "") {
        echo ($Yc ? "" : ",") . "\n\t\"" . addcslashes($z, "\r\n\t\"\\/") . '": ' . ($X !== null ? '"' . addcslashes($X, "\r\n\"\\/") . '"' : 'null');
        $Yc = false;
    } else {
        echo "\n}\n";
        $Yc = true;
    }
}
function ini_bool($Sd)
{
    $X = ini_get($Sd);
    return (preg_match('~^(on|true|yes)$~i', $X) || (int) $X);
}
function sid()
{
    static $I;
    if ($I === null)
        $I = (SID && !($_COOKIE && ini_bool("session.use_cookies")));
    return $I;
}
function set_password($bj, $N, $V, $F)
{
    $_SESSION["pwds"][$bj][$N][$V] = ($_COOKIE["adminer_key"] && is_string($F) ? array(
        encrypt_string($F, $_COOKIE["adminer_key"])
    ) : $F);
}
function get_password()
{
    $I = get_session("pwds");
    if (is_array($I))
        $I = ($_COOKIE["adminer_key"] ? decrypt_string($I[0], $_COOKIE["adminer_key"]) : false);
    return $I;
}
function q($P)
{
    global $h;
    return $h->quote($P);
}
function get_vals($G, $e = 0)
{
    global $h;
    $I = array();
    $H = $h->query($G);
    if (is_object($H)) {
        while ($J = $H->fetch_row())
            $I[] = $J[$e];
    }
    return $I;
}
function get_key_vals($G, $i = null, $rh = true)
{
    global $h;
    if (!is_object($i))
        $i = $h;
    $I = array();
    $H = $i->query($G);
    if (is_object($H)) {
        while ($J = $H->fetch_row()) {
            if ($rh)
                $I[$J[0]] = $J[1];
            else
                $I[] = $J[0];
        }
    }
    return $I;
}
function get_rows($G, $i = null, $o = "<p class='error'>")
{
    global $h;
    $yb = (is_object($i) ? $i : $h);
    $I  = array();
    $H  = $yb->query($G);
    if (is_object($H)) {
        while ($J = $H->fetch_assoc())
            $I[] = $J;
    } elseif (!$H && !is_object($i) && $o && defined("PAGE_HEADER"))
        echo $o . error() . "\n";
    return $I;
}
function unique_array($J, $x)
{
    foreach ($x as $w) {
        if (preg_match("~PRIMARY|UNIQUE~", $w["type"])) {
            $I = array();
            foreach ($w["columns"] as $z) {
                if (!isset($J[$z]))
                    continue 2;
                $I[$z] = $J[$z];
            }
            return $I;
        }
    }
}
function escape_key($z)
{
    if (preg_match('(^([\w(]+)(' . str_replace("_", ".*", preg_quote(idf_escape("_"))) . ')([ \w)]+)$)', $z, $B))
        return $B[1] . idf_escape(idf_unescape($B[2])) . $B[3];
    return idf_escape($z);
}
function where($Z, $q = array())
{
    global $h, $y;
    $I = array();
    foreach ((array) $Z["where"] as $z => $X) {
        $z   = bracket_escape($z, 1);
        $e   = escape_key($z);
        $I[] = $e . ($y == "sql" && is_numeric($X) && preg_match('~\.~', $X) ? " LIKE " . q($X) : ($y == "mssql" ? " LIKE " . q(preg_replace('~[_%[]~', '[\0]', $X)) : " = " . unconvert_field($q[$z], q($X))));
        if ($y == "sql" && preg_match('~char|text~', $q[$z]["type"]) && preg_match("~[^ -@]~", $X))
            $I[] = "$e = " . q($X) . " COLLATE " . charset($h) . "_bin";
    }
    foreach ((array) $Z["null"] as $z)
        $I[] = escape_key($z) . " IS NULL";
    return implode(" AND ", $I);
}
function where_check($X, $q = array())
{
    parse_str($X, $eb);
    remove_slashes(array(
        &$eb
    ));
    return where($eb, $q);
}
function where_link($t, $e, $Y, $xf = "=")
{
    return "&where%5B$t%5D%5Bcol%5D=" . urlencode($e) . "&where%5B$t%5D%5Bop%5D=" . urlencode(($Y !== null ? $xf : "IS NULL")) . "&where%5B$t%5D%5Bval%5D=" . urlencode($Y);
}
function convert_fields($f, $q, $L = array())
{
    $I = "";
    foreach ($f as $z => $X) {
        if ($L && !in_array(idf_escape($z), $L))
            continue;
        $Ha = convert_field($q[$z]);
        if ($Ha)
            $I .= ", $Ha AS " . idf_escape($z);
    }
    return $I;
}
function cookie($C, $Y, $ye = 2592000)
{
    global $ba;
    return header("Set-Cookie: $C=" . urlencode($Y) . ($ye ? "; expires=" . gmdate("D, d M Y H:i:s", time() + $ye) . " GMT" : "") . "; path=" . preg_replace('~\?.*~', '', $_SERVER["REQUEST_URI"]) . ($ba ? "; secure" : "") . "; HttpOnly; SameSite=lax", false);
}
function restart_session()
{
    if (!ini_bool("session.use_cookies"))
        session_start();
}
function stop_session($dd = false)
{
    $Ti = ini_bool("session.use_cookies");
    if (!$Ti || $dd) {
        session_write_close();
        if ($Ti && @ini_set("session.use_cookies", false) === false)
            session_start();
    }
}
function &get_session($z)
{
    return $_SESSION[$z][DRIVER][SERVER][$_GET["username"]];
}
function set_session($z, $X)
{
    $_SESSION[$z][DRIVER][SERVER][$_GET["username"]] = $X;
}
function auth_url($bj, $N, $V, $m = null)
{
    global $gc;
    preg_match('~([^?]*)\??(.*)~', remove_from_uri(implode("|", array_keys($gc)) . "|username|" . ($m !== null ? "db|" : "") . session_name()), $B);
    return "$B[1]?" . (sid() ? SID . "&" : "") . ($bj != "server" || $N != "" ? urlencode($bj) . "=" . urlencode($N) . "&" : "") . "username=" . urlencode($V) . ($m != "" ? "&db=" . urlencode($m) : "") . ($B[2] ? "&$B[2]" : "");
}
function is_ajax()
{
    return ($_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest");
}
function redirect($_e, $Oe = null)
{
    if ($Oe !== null) {
        restart_session();
        $_SESSION["messages"][preg_replace('~^[^?]*~', '', ($_e !== null ? $_e : $_SERVER["REQUEST_URI"]))][] = $Oe;
    }
    if ($_e !== null) {
        if ($_e == "")
            $_e = ".";
        header("Location: $_e");
        exit;
    }
}
function query_redirect($G, $_e, $Oe, $Eg = true, $Ec = true, $Pc = false, $ii = "")
{
    global $h, $o, $b;
    if ($Ec) {
        $Gh = microtime(true);
        $Pc = !$h->query($G);
        $ii = format_time($Gh);
    }
    $Bh = "";
    if ($G)
        $Bh = $b->messageQuery($G, $ii, $Pc);
    if ($Pc) {
        $o = error() . $Bh . script("messagesPrint();");
        return false;
    }
    if ($Eg)
        redirect($_e, $Oe . $Bh);
    return true;
}
function queries($G)
{
    global $h;
    static $yg = array();
    static $Gh;
    if (!$Gh)
        $Gh = microtime(true);
    if ($G === null)
        return array(
            implode("\n", $yg),
            format_time($Gh)
        );
    $yg[] = (preg_match('~;$~', $G) ? "DELIMITER ;;\n$G;\nDELIMITER " : $G) . ";";
    return $h->query($G);
}
function apply_queries($G, $S, $Ac = 'table')
{
    foreach ($S as $Q) {
        if (!queries("$G " . $Ac($Q)))
            return false;
    }
    return true;
}
function queries_redirect($_e, $Oe, $Eg)
{
    list($yg, $ii) = queries(null);
    return query_redirect($yg, $_e, $Oe, $Eg, false, !$Eg, $ii);
}
function format_time($Gh)
{
    return lang(1, max(0, microtime(true) - $Gh));
}
function remove_from_uri($Qf = "")
{
    return substr(preg_replace("~(?<=[?&])($Qf" . (SID ? "" : "|" . session_name()) . ")=[^&]*&~", '', "$_SERVER[REQUEST_URI]&"), 0, -1);
}
function pagination($E, $Lb)
{
    return " " . ($E == $Lb ? $E + 1 : '<a href="' . h(remove_from_uri("page") . ($E ? "&page=$E" . ($_GET["next"] ? "&next=" . urlencode($_GET["next"]) : "") : "")) . '">' . ($E + 1) . "</a>");
}
function get_file($z, $Tb = false)
{
    $Vc = $_FILES[$z];
    if (!$Vc)
        return null;
    foreach ($Vc as $z => $X)
        $Vc[$z] = (array) $X;
    $I = '';
    foreach ($Vc["error"] as $z => $o) {
        if ($o)
            return $o;
        $C  = $Vc["name"][$z];
        $qi = $Vc["tmp_name"][$z];
        $Ab = file_get_contents($Tb && preg_match('~\.gz$~', $C) ? "compress.zlib://$qi" : $qi);
        if ($Tb) {
            $Gh = substr($Ab, 0, 3);
            if (function_exists("iconv") && preg_match("~^\xFE\xFF|^\xFF\xFE~", $Gh, $Kg))
                $Ab = iconv("utf-16", "utf-8", $Ab);
            elseif ($Gh == "\xEF\xBB\xBF")
                $Ab = substr($Ab, 3);
            $I .= $Ab . "\n\n";
        } else
            $I .= $Ab;
    }
    return $I;
}
function upload_error($o)
{
    $Le = ($o == UPLOAD_ERR_INI_SIZE ? ini_get("upload_max_filesize") : 0);
    return ($o ? lang(2) . ($Le ? " " . lang(3, $Le) : "") : lang(4));
}
function repeat_pattern($dg, $we)
{
    return str_repeat("$dg{0,65535}", $we / 65535) . "$dg{0," . ($we % 65535) . "}";
}
function is_utf8($X)
{
    return (preg_match('~~u', $X) && !preg_match('~[\0-\x8\xB\xC\xE-\x1F]~', $X));
}
function shorten_utf8($P, $we = 80, $Oh = "")
{
    if (!preg_match("(^(" . repeat_pattern("[\t\r\n -\x{10FFFF}]", $we) . ")($)?)u", $P, $B))
        preg_match("(^(" . repeat_pattern("[\t\r\n -~]", $we) . ")($)?)", $P, $B);
    return h($B[1]) . $Oh . (isset($B[2]) ? "" : "<i>â€¦</i>");
}
function format_number($X)
{
    return strtr(number_format($X, 0, ".", lang(5)), preg_split('~~u', lang(6), -1, PREG_SPLIT_NO_EMPTY));
}
function friendly_url($X)
{
    return preg_replace('~[^a-z0-9_]~i', '-', $X);
}
function hidden_fields($tg, $Hd = array())
{
    $I = false;
    while (list($z, $X) = each($tg)) {
        if (!in_array($z, $Hd)) {
            if (is_array($X)) {
                foreach ($X as $fe => $W)
                    $tg[$z . "[$fe]"] = $W;
            } else {
                $I = true;
                echo '<input type="hidden" name="' . h($z) . '" value="' . h($X) . '">';
            }
        }
    }
    return $I;
}
function hidden_fields_get()
{
    echo (sid() ? '<input type="hidden" name="' . session_name() . '" value="' . h(session_id()) . '">' : ''), (SERVER !== null ? '<input type="hidden" name="' . DRIVER . '" value="' . h(SERVER) . '">' : ""), '<input type="hidden" name="username" value="' . h($_GET["username"]) . '">';
}
function table_status1($Q, $Qc = false)
{
    $I = table_status($Q, $Qc);
    return ($I ? $I : array(
        "Name" => $Q
    ));
}
function column_foreign_keys($Q)
{
    global $b;
    $I = array();
    foreach ($b->foreignKeys($Q) as $r) {
        foreach ($r["source"] as $X)
            $I[$X][] = $r;
    }
    return $I;
}
function enum_input($T, $Ka, $p, $Y, $vc = null)
{
    global $b;
    preg_match_all("~'((?:[^']|'')*)'~", $p["length"], $Ge);
    $I = ($vc !== null ? "<label><input type='$T'$Ka value='$vc'" . ((is_array($Y) ? in_array($vc, $Y) : $Y === 0) ? " checked" : "") . "><i>" . lang(7) . "</i></label>" : "");
    foreach ($Ge[1] as $t => $X) {
        $X  = stripcslashes(str_replace("''", "'", $X));
        $gb = (is_int($Y) ? $Y == $t + 1 : (is_array($Y) ? in_array($t + 1, $Y) : $Y === $X));
        $I .= " <label><input type='$T'$Ka value='" . ($t + 1) . "'" . ($gb ? ' checked' : '') . '>' . h($b->editVal($X, $p)) . '</label>';
    }
    return $I;
}
function input($p, $Y, $s)
{
    global $U, $b, $y;
    $C = h(bracket_escape($p["field"]));
    echo "<td class='function'>";
    if (is_array($Y) && !$s) {
        $Fa = array(
            $Y
        );
        if (version_compare(PHP_VERSION, 5.4) >= 0)
            $Fa[] = JSON_PRETTY_PRINT;
        $Y = call_user_func_array('json_encode', $Fa);
        $s = "json";
    }
    $Og = ($y == "mssql" && $p["auto_increment"]);
    if ($Og && !$_POST["save"])
        $s = null;
    $md = (isset($_GET["select"]) || $Og ? array(
        "orig" => lang(8)
    ) : array()) + $b->editFunctions($p);
    $Ka = " name='fields[$C]'";
    if ($p["type"] == "enum")
        echo h($md[""]) . "<td>" . $b->editInput($_GET["edit"], $p, $Ka, $Y);
    else {
        $wd = (in_array($s, $md) || isset($md[$s]));
        echo (count($md) > 1 ? "<select name='function[$C]'>" . optionlist($md, $s === null || $wd ? $s : "") . "</select>" . on_help("getTarget(event).value.replace(/^SQL\$/, '')", 1) . script("qsl('select').onchange = functionChange;", "") : h(reset($md))) . '<td>';
        $Ud = $b->editInput($_GET["edit"], $p, $Ka, $Y);
        if ($Ud != "")
            echo $Ud;
        elseif (preg_match('~bool~', $p["type"]))
            echo "<input type='hidden'$Ka value='0'>" . "<input type='checkbox'" . (preg_match('~^(1|t|true|y|yes|on)$~i', $Y) ? " checked='checked'" : "") . "$Ka value='1'>";
        elseif ($p["type"] == "set") {
            preg_match_all("~'((?:[^']|'')*)'~", $p["length"], $Ge);
            foreach ($Ge[1] as $t => $X) {
                $X  = stripcslashes(str_replace("''", "'", $X));
                $gb = (is_int($Y) ? ($Y >> $t) & 1 : in_array($X, explode(",", $Y), true));
                echo " <label><input type='checkbox' name='fields[$C][$t]' value='" . (1 << $t) . "'" . ($gb ? ' checked' : '') . ">" . h($b->editVal($X, $p)) . '</label>';
            }
        } elseif (preg_match('~blob|bytea|raw|file~', $p["type"]) && ini_bool("file_uploads"))
            echo "<input type='file' name='fields-$C'>";
        elseif (($gi = preg_match('~text|lob|memo~i', $p["type"])) || preg_match("~\n~", $Y)) {
            if ($gi && $y != "sqlite")
                $Ka .= " cols='50' rows='12'";
            else {
                $K = min(12, substr_count($Y, "\n") + 1);
                $Ka .= " cols='30' rows='$K'" . ($K == 1 ? " style='height: 1.2em;'" : "");
            }
            echo "<textarea$Ka>" . h($Y) . '</textarea>';
        } elseif ($s == "json" || preg_match('~^jsonb?$~', $p["type"]))
            echo "<textarea$Ka cols='50' rows='12' class='jush-js'>" . h($Y) . '</textarea>';
        else {
            $Ne = (!preg_match('~int~', $p["type"]) && preg_match('~^(\d+)(,(\d+))?$~', $p["length"], $B) ? ((preg_match("~binary~", $p["type"]) ? 2 : 1) * $B[1] + ($B[3] ? 1 : 0) + ($B[2] && !$p["unsigned"] ? 1 : 0)) : ($U[$p["type"]] ? $U[$p["type"]] + ($p["unsigned"] ? 0 : 1) : 0));
            if ($y == 'sql' && min_version(5.6) && preg_match('~time~', $p["type"]))
                $Ne += 7;
            echo "<input" . ((!$wd || $s === "") && preg_match('~(?<!o)int(?!er)~', $p["type"]) && !preg_match('~\[\]~', $p["full_type"]) ? " type='number'" : "") . " value='" . h($Y) . "'" . ($Ne ? " data-maxlength='$Ne'" : "") . (preg_match('~char|binary~', $p["type"]) && $Ne > 20 ? " size='40'" : "") . "$Ka>";
        }
        echo $b->editHint($_GET["edit"], $p, $Y);
        $Yc = 0;
        foreach ($md as $z => $X) {
            if ($z === "" || !$X)
                break;
            $Yc++;
        }
        if ($Yc)
            echo script("mixin(qsl('td'), {onchange: partial(skipOriginal, $Yc), oninput: function () { this.onchange(); }});");
    }
}
function process_input($p)
{
    global $b, $n;
    $v = bracket_escape($p["field"]);
    $s = $_POST["function"][$v];
    $Y = $_POST["fields"][$v];
    if ($p["type"] == "enum") {
        if ($Y == -1)
            return false;
        if ($Y == "")
            return "NULL";
        return +$Y;
    }
    if ($p["auto_increment"] && $Y == "")
        return null;
    if ($s == "orig")
        return (preg_match('~^CURRENT_TIMESTAMP~i', $p["on_update"]) ? idf_escape($p["field"]) : false);
    if ($s == "NULL")
        return "NULL";
    if ($p["type"] == "set")
        return array_sum((array) $Y);
    if ($s == "json") {
        $s = "";
        $Y = json_decode($Y, true);
        if (!is_array($Y))
            return false;
        return $Y;
    }
    if (preg_match('~blob|bytea|raw|file~', $p["type"]) && ini_bool("file_uploads")) {
        $Vc = get_file("fields-$v");
        if (!is_string($Vc))
            return false;
        return $n->quoteBinary($Vc);
    }
    return $b->processInput($p, $Y, $s);
}
function fields_from_edit()
{
    global $n;
    $I = array();
    foreach ((array) $_POST["field_keys"] as $z => $X) {
        if ($X != "") {
            $X                     = bracket_escape($X);
            $_POST["function"][$X] = $_POST["field_funs"][$z];
            $_POST["fields"][$X]   = $_POST["field_vals"][$z];
        }
    }
    foreach ((array) $_POST["fields"] as $z => $X) {
        $C     = bracket_escape($z, 1);
        $I[$C] = array(
            "field" => $C,
            "privileges" => array(
                "insert" => 1,
                "update" => 1
            ),
            "null" => 1,
            "auto_increment" => ($z == $n->primary)
        );
    }
    return $I;
}
function search_tables()
{
    global $b, $h;
    $_GET["where"][0]["val"] = $_POST["query"];
    $lh                      = "<ul>\n";
    foreach (table_status('', true) as $Q => $R) {
        $C = $b->tableName($R);
        if (isset($R["Engine"]) && $C != "" && (!$_POST["tables"] || in_array($Q, $_POST["tables"]))) {
            $H = $h->query("SELECT" . limit("1 FROM " . table($Q), " WHERE " . implode(" AND ", $b->selectSearchProcess(fields($Q), array())), 1));
            if (!$H || $H->fetch_row()) {
                $pg = "<a href='" . h(ME . "select=" . urlencode($Q) . "&where[0][op]=" . urlencode($_GET["where"][0]["op"]) . "&where[0][val]=" . urlencode($_GET["where"][0]["val"])) . "'>$C</a>";
                echo "$lh<li>" . ($H ? $pg : "<p class='error'>$pg: " . error()) . "\n";
                $lh = "";
            }
        }
    }
    echo ($lh ? "<p class='message'>" . lang(9) : "</ul>") . "\n";
}
function dump_headers($Ed, $Xe = false)
{
    global $b;
    $I  = $b->dumpHeaders($Ed, $Xe);
    $Nf = $_POST["output"];
    if ($Nf != "text")
        header("Content-Disposition: attachment; filename=" . $b->dumpFilename($Ed) . ".$I" . ($Nf != "file" && !preg_match('~[^0-9a-z]~', $Nf) ? ".$Nf" : ""));
    session_write_close();
    ob_flush();
    flush();
    return $I;
}
function dump_csv($J)
{
    foreach ($J as $z => $X) {
        if (preg_match("~[\"\n,;\t]~", $X) || $X === "")
            $J[$z] = '"' . str_replace('"', '""', $X) . '"';
    }
    echo implode(($_POST["format"] == "csv" ? "," : ($_POST["format"] == "tsv" ? "\t" : ";")), $J) . "\r\n";
}
function apply_sql_function($s, $e)
{
    return ($s ? ($s == "unixepoch" ? "DATETIME($e, '$s')" : ($s == "count distinct" ? "COUNT(DISTINCT " : strtoupper("$s(")) . "$e)") : $e);
}
function get_temp_dir()
{
    $I = ini_get("upload_tmp_dir");
    if (!$I) {
        if (function_exists('sys_get_temp_dir'))
            $I = sys_get_temp_dir();
        else {
            $Wc = @tempnam("", "");
            if (!$Wc)
                return false;
            $I = dirname($Wc);
            unlink($Wc);
        }
    }
    return $I;
}
function file_open_lock($Wc)
{
    $kd = @fopen($Wc, "r+");
    if (!$kd) {
        $kd = @fopen($Wc, "w");
        if (!$kd)
            return;
        chmod($Wc, 0660);
    }
    flock($kd, LOCK_EX);
    return $kd;
}
function file_write_unlock($kd, $Nb)
{
    rewind($kd);
    fwrite($kd, $Nb);
    ftruncate($kd, strlen($Nb));
    flock($kd, LOCK_UN);
    fclose($kd);
}
function password_file($j)
{
    $Wc = get_temp_dir() . "/adminer.key";
    $I  = @file_get_contents($Wc);
    if ($I || !$j)
        return $I;
    $kd = @fopen($Wc, "w");
    if ($kd) {
        chmod($Wc, 0660);
        $I = rand_string();
        fwrite($kd, $I);
        fclose($kd);
    }
    return $I;
}
function rand_string()
{
    return md5(uniqid(mt_rand(), true));
}
function select_value($X, $A, $p, $hi)
{
    global $b;
    if (is_array($X)) {
        $I = "";
        foreach ($X as $fe => $W)
            $I .= "<tr>" . ($X != array_values($X) ? "<th>" . h($fe) : "") . "<td>" . select_value($W, $A, $p, $hi);
        return "<table cellspacing='0'>$I</table>";
    }
    if (!$A)
        $A = $b->selectLink($X, $p);
    if ($A === null) {
        if (is_mail($X))
            $A = "mailto:$X";
        if (is_url($X))
            $A = $X;
    }
    $I = $b->editVal($X, $p);
    if ($I !== null) {
        if (!is_utf8($I))
            $I = "\0";
        elseif ($hi != "" && is_shortable($p))
            $I = shorten_utf8($I, max(0, +$hi));
        else
            $I = h($I);
    }
    return $b->selectVal($I, $A, $p, $X);
}
function is_mail($sc)
{
    $Ia = '[-a-z0-9!#$%&\'*+/=?^_`{|}~]';
    $fc = '[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';
    $dg = "$Ia+(\\.$Ia+)*@($fc?\\.)+$fc";
    return is_string($sc) && preg_match("(^$dg(,\\s*$dg)*\$)i", $sc);
}
function is_url($P)
{
    $fc = '[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';
    return preg_match("~^(https?)://($fc?\\.)+$fc(:\\d+)?(/.*)?(\\?.*)?(#.*)?\$~i", $P);
}
function is_shortable($p)
{
    return preg_match('~char|text|json|lob|geometry|point|linestring|polygon|string|bytea~', $p["type"]);
}
function count_rows($Q, $Z, $ae, $pd)
{
    global $y;
    $G = " FROM " . table($Q) . ($Z ? " WHERE " . implode(" AND ", $Z) : "");
    return ($ae && ($y == "sql" || count($pd) == 1) ? "SELECT COUNT(DISTINCT " . implode(", ", $pd) . ")$G" : "SELECT COUNT(*)" . ($ae ? " FROM (SELECT 1$G GROUP BY " . implode(", ", $pd) . ") x" : $G));
}
function slow_query($G)
{
    global $b, $si, $n;
    $m  = $b->database();
    $ji = $b->queryTimeout();
    $wh = $n->slowQuery($G, $ji);
    if (!$wh && support("kill") && is_object($i = connect()) && ($m == "" || $i->select_db($m))) {
        $ke = $i->result(connection_id());
        echo '<script', nonce(), '>
var timeout = setTimeout(function () {
	ajax(\'', js_escape(ME), 'script=kill\', function () {
	}, \'kill=', $ke, '&token=', $si, '\');
}, ', 1000 * $ji, ');
</script>
';
    } else
        $i = null;
    ob_flush();
    flush();
    $I = @get_key_vals(($wh ? $wh : $G), $i, false);
    if ($i) {
        echo script("clearTimeout(timeout);");
        ob_flush();
        flush();
    }
    return $I;
}
function get_token()
{
    $Ag = rand(1, 1e6);
    return ($Ag ^ $_SESSION["token"]) . ":$Ag";
}
function verify_token()
{
    list($si, $Ag) = explode(":", $_POST["token"]);
    return ($Ag ^ $_SESSION["token"]) == $si;
}
function lzw_decompress($Ta)
{
    $bc = 256;
    $Ua = 8;
    $nb = array();
    $Qg = 0;
    $Rg = 0;
    for ($t = 0; $t < strlen($Ta); $t++) {
        $Qg = ($Qg << 8) + ord($Ta[$t]);
        $Rg += 8;
        if ($Rg >= $Ua) {
            $Rg -= $Ua;
            $nb[] = $Qg >> $Rg;
            $Qg &= (1 << $Rg) - 1;
            $bc++;
            if ($bc >> $Ua)
                $Ua++;
        }
    }
    $ac = range("\0", "\xFF");
    $I  = "";
    foreach ($nb as $t => $mb) {
        $rc = $ac[$mb];
        if (!isset($rc))
            $rc = $qj . $qj[0];
        $I .= $rc;
        if ($t)
            $ac[] = $qj . $rc[0];
        $qj = $rc;
    }
    return $I;
}
function on_help($tb, $th = 0)
{
    return script("mixin(qsl('select, input'), {onmouseover: function (event) { helpMouseover.call(this, event, $tb, $th) }, onmouseout: helpMouseout});", "");
}
function edit_form($a, $q, $J, $Ni)
{
    global $b, $y, $si, $o;
    $Th = $b->tableName(table_status1($a, true));
    page_header(($Ni ? lang(10) : lang(11)), $o, array(
        "select" => array(
            $a,
            $Th
        )
    ), $Th);
    if ($J === false)
        echo "<p class='error'>" . lang(12) . "\n";
    echo '<form action="" method="post" enctype="multipart/form-data" id="form">
';
    if (!$q)
        echo "<p class='error'>" . lang(13) . "\n";
    else {
        echo "<table cellspacing='0' class='layout'>" . script("qsl('table').onkeydown = editingKeydown;");
        foreach ($q as $C => $p) {
            echo "<tr><th>" . $b->fieldName($p);
            $Ub = $_GET["set"][bracket_escape($C)];
            if ($Ub === null) {
                $Ub = $p["default"];
                if ($p["type"] == "bit" && preg_match("~^b'([01]*)'\$~", $Ub, $Kg))
                    $Ub = $Kg[1];
            }
            $Y = ($J !== null ? ($J[$C] != "" && $y == "sql" && preg_match("~enum|set~", $p["type"]) ? (is_array($J[$C]) ? array_sum($J[$C]) : +$J[$C]) : $J[$C]) : (!$Ni && $p["auto_increment"] ? "" : (isset($_GET["select"]) ? false : $Ub)));
            if (!$_POST["save"] && is_string($Y))
                $Y = $b->editVal($Y, $p);
            $s = ($_POST["save"] ? (string) $_POST["function"][$C] : ($Ni && preg_match('~^CURRENT_TIMESTAMP~i', $p["on_update"]) ? "now" : ($Y === false ? null : ($Y !== null ? '' : 'NULL'))));
            if (preg_match("~time~", $p["type"]) && preg_match('~^CURRENT_TIMESTAMP~i', $Y)) {
                $Y = "";
                $s = "now";
            }
            input($p, $Y, $s);
            echo "\n";
        }
        if (!support("table"))
            echo "<tr>" . "<th><input name='field_keys[]'>" . script("qsl('input').oninput = fieldChange;") . "<td class='function'>" . html_select("field_funs[]", $b->editFunctions(array(
                "null" => isset($_GET["select"])
            ))) . "<td><input name='field_vals[]'>" . "\n";
        echo "</table>\n";
    }
    echo "<p>\n";
    if ($q) {
        echo "<input type='submit' value='" . lang(14) . "'>\n";
        if (!isset($_GET["select"])) {
            echo "<input type='submit' name='insert' value='" . ($Ni ? lang(15) : lang(16)) . "' title='Ctrl+Shift+Enter'>\n", ($Ni ? script("qsl('input').onclick = function () { return !ajaxForm(this.form, '" . lang(17) . "â€¦', this); };") : "");
        }
    }
    echo ($Ni ? "<input type='submit' name='delete' value='" . lang(18) . "'>" . confirm() . "\n" : ($_POST || !$q ? "" : script("focus(qsa('td', qs('#form'))[1].firstChild);")));
    if (isset($_GET["select"]))
        hidden_fields(array(
            "check" => (array) $_POST["check"],
            "clone" => $_POST["clone"],
            "all" => $_POST["all"]
        ));
    echo '<input type="hidden" name="referer" value="', h(isset($_POST["referer"]) ? $_POST["referer"] : $_SERVER["HTTP_REFERER"]), '">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="', $si, '">
</form>
';
}
if (isset($_GET["file"])) {
    if ($_SERVER["HTTP_IF_MODIFIED_SINCE"]) {
        header("HTTP/1.1 304 Not Modified");
        exit;
    }
    header("Expires: " . gmdate("D, d M Y H:i:s", time() + 365 * 24 * 60 * 60) . " GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: immutable");
    if ($_GET["file"] == "favicon.ico") {
        header("Content-Type: image/x-icon");
        echo lzw_decompress("\0\0\0` \0„\0\n @\0´C„è\"\0`EãQ¸àÿ‡?ÀtvM'”JdÁd\\Œb0\0Ä\"™ÀfÓˆ¤îs5›ÏçÑAXPaJ“0„¥‘8„#RŠT©‘z`ˆ#.©ÇcíXÃþÈ€?À-\0¡Im? .«M¶€\0È¯(Ì‰ýÀ/(%Œ\0");
    } elseif ($_GET["file"] == "default.css") {
        header("Content-Type: text/css; charset=utf-8");
        echo lzw_decompress("\n1Ì‡“ÙŒÞl7œ‡B1„4vb0˜Ífs‘¼ên2BÌÑ±Ù˜Þn:‡#(¼b.\rDc)ÈÈa7E„‘¤Âl¦Ã±”èi1ÌŽs˜´ç-4™‡fÓ	ÈÎi7†³¹¤Èt4…¦ÓyèZf4°i–AT«VVéf:Ï¦,:1¦QÝ¼ñb2`Ç#þ>:7Gï—1ÑØÒs°™L—XD*bv<ÜŒ#£e@Ö:4ç§!fo·Æt:<¥Üå’¾™oâÜ\niÃÅð',é»a_¤:¹iï…´ÁBvø|Nû4.5Nfi¢vpÐh¸°l¨ê¡ÖšÜO¦‰î= £OFQÐÄk\$¥Óiõ™ÀÂd2Tã¡pàÊ6„‹þ‡¡-ØZ€Žƒ Þ6½£€ðh:¬aÌ,Ž£ëî2#8Ð±#’˜6nâî†ñJˆ¢h«t…Œ±Šä4O42ô½okÞ¾*r ©€@p@†!Ä¾ÏÃôþ?Ð6À‰r[ðLÁð‹:2Bˆj§!HbóÃPä=!1V‰\"ˆ²0…¿\nSÆÆÏD7ÃìDÚ›ÃC!†!›à¦GÊŒ§ È+’=tCæ©.C¤À:+ÈÊ=ªªº²¡±å%ªcí1MR/”EÈ’4„© 2°ä± ã`Â8(áÓ¹[WäÑ=‰ySb°=Ö-Ü¹BS+É¯ÈÜý¥ø@pL4Ydã„qŠøã¦ðê¢6£3Ä¬¯¸AcÜŒèÎ¨Œk‚[&>ö•¨ZÁpkm]—u-c:Ø¸ˆNtæÎ´pÒŒŠ8è=¿#˜á[.ðÜÞ¯~ mËy‡PPá|IÖ›ùÀìQª9v[–Q•„\n–Ùrô'g‡+áTÑ2…­VÁõzä4£8÷(	¾Ey*#j¬2]­•RÒÁ‘¥)ƒÀ[N­R\$Š<>:ó­>\$;–> Ì\r»„ÎHÍÃTÈ\nw¡N åwØ£¦ì<ïËGwàöö¹\\Yó_ Rt^Œ>Ž\r}ŒÙS\rzé4=µ\nL”%Jã‹\",Z 8¸ž™i÷0u©?¨ûÑô¡s3#¨Ù‰ :ó¦ûã½–ÈÞE]xÝÒs^8Ž£K^É÷*0ÑÞwÞàÈÞ~ãö:íÑiØþv2w½ÿ±û^7ãò7£cÝÑu+U%Ž{PÜ*4Ì¼éLX./!¼‰1CÅßqx!H¹ãFdù­L¨¤¨Ä Ï`6ëè5®™f€¸Ä†¨=Høl ŒV1“›\0a2×;Ô6†àöþ_Ù‡Ä\0&ôZÜS d)KE'’€nµ[X©³\0ZÉŠÔF[P‘Þ˜@àß!‰ñYÂ,`É\"Ú·Â0Ee9yF>ËÔ9bº–ŒæF5:üˆ”\0}Ä´Š‡(\$žÓ‡ë€37Hö£è M¾A°²6R•ú{MqÝ7G ÚC™Cêm2¢(ŒCt>[ì-tÀ/&C›]êetGôÌ¬4@r>ÇÂå<šSq•/åú”QëhmšÀÐÆôãôLÀÜ#èôKË|®™„6fKPÝ\r%tÔÓV=\" SH\$} ¸)w¡,W\0F³ªu@Øb¦9‚\rr°2Ã#¬DŒ”Xƒ³ÚyOIù>»…n†Ç¢%ãù'‹Ý_Á€t\rÏ„zÄ\\1˜hl¼]Q5Mp6k†ÐÄqhÃ\$£H~Í|ÒÝ!*4ŒñòÛ`Sëý²S tíPP\\g±è7‡\n-Š:è¢ªp´•”ˆl‹Bž¦î”7Ó¨cƒ(wO0\\:•Ðw”Áp4ˆ“ò{TÚújO¤6HÃŠ¶rÕ¥q\n¦É%%¶y']\$‚”a‘ZÓ.fcÕq*-êFWºúk„zƒ°µj‘Ž°lgáŒ:‡\$\"ÞN¼\r#ÉdâÃ‚ÂÿÐscá¬Ì „ƒ\"jª\rÀ¶–¦ˆÕ’¼Ph‹1/‚œDA) ²Ý[ÀknÁp76ÁY´‰R{áM¤Pû°ò@\n-¸a·6þß[»zJH,–dl B£ho³ìò¬+‡#Dr^µ^µÙeš¼E½½– ÄœaP‰ôõJG£zàñtñ 2ÇXÙ¢´Á¿V¶×ßàÞÈ³‰ÑB_%K=E©¸bå¼¾ßÂ§kU(.!Ü®8¸œüÉI.@ŽKÍxnþ¬ü:ÃPó32«”míH		C*ì:vâTÅ\nR¹ƒ•µ‹0uÂíƒæîÒ§]Î¯˜Š”P/µJQd¥{L–Þ³:YÁ2b¼œT ñÊ3Ó4†—äcê¥V=¿†L4ÎÐrÄ!ßBðY³6Í­MeLŠªÜçœöùiÀoÐ9< G”¤Æ•Ð™Mhm^¯UÛNÀŒ·òTr5HiM”/¬nƒí³T [-<__î3/Xr(<‡¯Š†®Éô“ÌuÒ–GNX20å\r\$^‡:'9è¶O…í;×k¼†µf –N'a¶”Ç­bÅ,ËV¤ô…«1µïHI!%6@úÏ\$ÒEGÚœ¬1(mUªå…rÕ½ïßå`¡ÐiN+Ãœñ)šœä0lØÒf0Ã½[UâøVÊè-:I^ ˜\$Øs«b\re‡‘ugÉhª~9Ûßˆb˜µôÂÈfä+0¬Ô hXrÝ¬©!\$—e,±w+„÷ŒëŒ3†Ì_âA…kšù\nkÃrõÊ›cuWdYÿ\\×={.óÄ˜¢g»‰p8œt\rRZ¿vJ:²>þ£Y|+Å@À‡ƒÛCt\r€jt½6²ð%Â?àôÇŽñ’>ù/¥ÍÇðÎ9F`×•äòv~K¤áöÑRÐW‹ðz‘êlmªwLÇ9Y•*q¬xÄzñèSe®Ý›³è÷£~šDàÍá–÷x˜¾ëÉŸi7•2ÄøÑOÝ»’û_{ñú53âút˜›_ŸõzÔ3ùd)‹C¯Â\$?KÓªP%ÏÏT&þ˜&\0P×NAŽ^­~¢ƒ pÆ öÏœ“Ôõ\r\$ÞïÐÖìb*+D6ê¶¦ÏˆÞíJ\$(ÈolÞÍh&”ìKBS>¸‹ö;z¶¦xÅoz>íœÚoÄZð\nÊ‹[Ïvõ‚ËÈœµ°2õOxÙVø0fû€ú¯Þ2BlÉbkÐ6ZkµhXcdê0*ÂKTâ¯H=­•Ï€‘p0ŠlVéõèâ\r¼Œ¥nŽm¦ï)((ô:#¦âòE‰Ü:C¨CàÚâ\r¨G\rÃ©0÷…iæÚ°þ:`Z1Q\n:€à\r\0àçÈq±°ü:`¿-ÈM#}1;èþ¹‹q‘#|ñS€¾¢hl™DÄ\0fiDpëL ``™°çÑ0y€ß1…€ê\rñ=‘MQ\\¤³%oq–­\0Øñ£1¨21¬1°­ ¿±§Ñœbi:“í\r±/Ñ¢› `)šÄ0ù‘@¾Â›±ÃI1«NàCØàŠµñO±¢Zñã1±ïq1 òÑüà,å\rdIÇ¦väjí‚1 tÚBø“°â’0:…0ðð“1 A2V„ñâ0 éñ%²fi3!&Q·Rc%Òq&w%Ñì\ràVÈ#Êø™Qw`‹% ¾„Òm*r…Òy&iß+r{*²»(rg(±#(2­(ðå)R@i›-  ˆž•1\"\0Û²Rêÿ.e.rëÄ,¡ry(2ªCàè²bì!BÞ3%Òµ,R¿1²Æ&èþt€äbèa\rL“³-3á Ö ó\0æóBp—1ñ94³O'R°3*²³=\$à[£^iI;/3i©5Ò&’}17²# Ñ¹8 ¿\"ß7Ñå8ñ9*Ò23™!ó!1\\\0Ï8“­rk9±;S…23¶àÚ“*Ó:q]5S<³Á#383Ý#eÑ=¹>~9Sèž³‘rÕ)€ŒT*aŸ@Ñ–ÙbesÙÔ£:-ó€éÇ*;, Ø™3!i´›‘LÒ²ð#1 +nÀ «*²ã@³3i7´1©ž´_•F‘S;3ÏF±\rA¯é3õ>´x:ƒ \r³0ÎÔ@’-Ô/¬ÓwÓÛ7ñ„ÓS‘J3› ç.Fé\$O¤B’±—%4©+tÃ'góLq\rJt‡JôËM2\rôÍ7ñÆT@“£¾)â“£dÉ2€P>Î°€Fià²´þ\nr\0ž¸bçk(´D¶¿ãKQƒ¤´ã1ã\"2t”ôôºPè\rÃÀ,\$KCtò5ôö#ôú)¢áP#Pi.ÎU2µCæ~Þ\"ä");
    } elseif ($_GET["file"] == "functions.js") {
        header("Content-Type: text/javascript; charset=utf-8");
        echo lzw_decompress("f:›ŒgCI¼Ü\n8œÅ3)°Ë7œ…†81ÐÊx:\nOg#)Ðêr7\n\"†è´`ø|2ÌgSi–H)N¦S‘ä§\r‡\"0¹Ä@ä)Ÿ`(\$s6O!ÓèœV/=Œ' T4æ=„˜iS˜6IO“ÊerÙxî9*Åº°ºn3\rÑ‰vƒCÁ`õšÝ2G%¨YãæáþŸ1™Ífô¹ÑÈ‚l¤Ã1‘\ny£*pC\r\$ÌnTª•3=\\‚r9O\"ã	Ààl<Š\rÇ\\€³I,—s\nA¤Æeh+Mâ‹!q0™ýf»`(¹N{c–—+wËñÁY£–pÙ§3Š3ú˜+I¦Ôj¹ºýŽÏk·²n¸qÜƒzi#^rØÀº´‹3èâÏ[žèºo;®Ë(‹Ð6#ÀÒŽ\":cz>ß£C2vÑCXÊ<P˜Ãc*5\nº¨è·/üP97ñ|F»°c0ƒ³¨°ä!ƒæ…!¨œƒ!‰Ã\nZ%ÃÄ‡#CHÌ!¨Òr8ç\$¥¡ì¯,ÈRÜ”2…Èã^0·á@¤2Œâ(ð88P/‚à¸Ý„á\\Á\$La\\å;càH„áHX„•\nÊƒtœ‡á8A<ÏsZô*ƒ;IÐÎ3¡Á@Ò2<Š¢¬!A8G<Ôj¿-Kƒ({*\r’Åa1‡¡èN4Tc\"\\Ò!=1^•ðÝM9O³:†;jŒŠ\rãXÒàL#HÎ7ƒ#TÝª/-´‹£pÊ;B Â‹\n¿2!ƒ¥Ít]apÎŽÝî\0RÛCËv¬MÂI,\rö§\0Hv°Ý?kTÞ4£Š¼óuÙ±Ø;&’ò+&ƒ›ð•µ\rÈXbu4Ý¡i88Â2Bä/âƒ–4ƒ¡€N8AÜA)52íúøËåÎ2ˆ¨sã8ç“5¤¥¡pçWC@è:˜t…ã¾´Öešh\"#8_˜æcp^ãˆâI]OHþÔ:zdÈ3g£(„ˆ×Ã–k¸î“\\6´˜2ÚÚ–÷¹iÃä7²˜Ï]\rÃxO¾nºpè<¡ÁpïQ®UÐn‹ò|@çËó#G3ðÁ8bA¨Ê6ô2Ÿ67%#¸\\8\rýš2Èc\ræÝŸk®‚.(’	Ž’-—J;î›Ñó ÈéLãÏ ƒ¼žWâøã§“Ñ¥É¤â–÷·žnû Ò§»æýMÎÀ9ZÐs]êz®¯¬ëy^[¯ì4-ºU\0ta ¶62^•˜.`¤‚â.Cßjÿ[á„ % Q\0`dëM8¿¦¼ËÛ\$O0`4²êÎ\n\0a\rA„<†@Ÿƒ›Š\r!À:ØBAŸ9Ù?h>¤Çº š~ÌŒ—6ÈˆhÜ=Ë-œA7XäÀÖ‡\\¼\r‘Q<èš§q’'!XÎ“2úT °!ŒD\r§Ò,K´\"ç%˜HÖqR\r„Ì ¢îC =Ží‚ æäŽÈ<c”\n#<€5Mø êEƒœyŒ¡”“‡°úo\"°cJKL2ù&£ØeRœÀWÐAÎTwÊÑ‘;åJˆâá\\`)5¦ÔÞœBòqhT3§àR	¸'\r+\":– Øðà.“ÑZM'|¬et:3%LÜË#Â‘f!ñhà×€eŒ³œÙ+Ä¼­Ná¹	Á½_’CXŠGî˜1†µi-Ã£zž\$’oK@O@TÒ=&‰0\$	àDA‘›¥ùùDàªSJèx9×FÈˆml¨Èp»GÕ­¤T6RfÀ@ƒa¾\rs´RªFgih]¥éf™.•7+Ñ<nhh’* ÈSH	P]¡ :Ò’¨Áa\"¨Õù¬2¦&R©)ùB¦PÊ™ÓH/õf {r|¨0^ÙhCAÌ0»@æMÎâç2“B”@©âzªUŠ‘¾O÷þ‰Cpp’å\\¾L«%è¬ð›„’y«çodÃ¥•‰´p3·Š7E¸—ÐÜA\\°ö†KƒÛXn‚Øi.ÐZ×Í óŸ˜s¡‰Gým^tIòY‘J’üÙ±•G1€£R¨³D’c–äà6•tMihÆä9ƒ»9gƒq—RL–ûMj-TQÍ6i«G_!í.½hªvÞûcN¨Œý¸—^üÑ0w@n|ý½×VûÜ«˜AÐ­ÃÀ3ú[Úû]Ž	s7õG†P@ :Ì1Ñ‚ØbØ µìÝŸ›’wÏ(i³ø:Òåz\\ûº;Óù´AéPU T^£]9Ý`UX+U î‹Q+‰ÃbÌÀñ*Ï”s¨¼€–—Î[ßÛ‰xkûF*ô‚ŽÝ§_w.òÅ6~òbÛÎmKì¾sIÞMKÉ}ï•Ò¥ÚøåeHÉ²ˆdµ*mdçlœQ°eHô2½ÔL¨ aÒ‚¯=…³sëPøaM\"apÃÀ:<á…äGB”\r2Ytx&L}}‘ßAÏÔ±N…GÐ¬za”öD4øtÔ4QÉvS©Ã¹S\rÎ;U¸ê¦éäý¸´Æ~’pBðƒ{¶ÑÆ,œ—¢O´ãt;ÇJ¡™ZC,&Yº:Y\"Ý#‰ÜãÄt:\n‘h8r¯¡îÚnéÔÈh>„>Zðø`&àaÞpY+¹x¬UÕýA¼<?ã”PxWÕ¡¯W™	i¬Ë.É\r`÷\$,Àú©Ò¾‹³V¥]ŒZr›ä§H³ˆ5Æf\\º-KÆ©¦v¼•Zçä®A¸Õ(§{3­o›ó¿¡l.¿ì¹JéÅ.ç\\t2æ;Ž¯ì2\0´Í>c+|ÁÐ*;-0înÂà[t@ÛÚ•ò¢¤=cQ\n.z‰•ÉwC&‡Ô@‘ù¦FæÕˆ‡Ž'cBS7_*rsÑ¨Ô?jð3@–ˆôÐ!ð.@7žsŠ]ÓªòL÷ÎGŸð@ÿÕ_­qÕ&uûØótª\nÕŽ´LßEÐT¤ð­}gG–þ¸îwëoö(*˜ªð†›Aí¯-¥Åù¢Õ3¿mk¾…÷°¶×¤«Ÿt·¢Sø¥Á(ûd±žAî~ïx\n×õô§kÕÏ£:DŸø+Ÿ‘ gãäh14 Öâ\n.øÏdê«–ãì’ öþéAlYÂ©jš©êŽjJœÇÅPN+b D°j¼¬€îÔ€DªÞPäì€LQ`Of–£@Ø}(ÅÂ6^nB³4Û`ÜeÀ\n€š	…trp!lV¤'}b‰*€r%|\nr\r#Ž°Ä@w®¼-ÔT.Vvâ8ìªæ\nmF¦/Èp¬Ï`úY0¬Ïâë­è€P\r8ÀY\r‡ØÝ¤’	ÀQ‡%EÎ/@]\0ÊÀ{@ÌQØá\0bR M\r†Ù'|¢è%0SDr¨È žf/–àÂÜb:Ü­¯¶ÞÃÂ%ß€æ3H¦x\0Âl\0ÌÅÚ	‘€Wàß%Ú\nç8\r\0}îDž„É1d#±x‚ä.€jEoHrÇ¢lbÀØÚ%tì¦4¸p„Àä%Ñ4’åÒk®z2\rñ£`îW@Â’ç%\rJ‚1€‚X ¤Ú1¾D6!°ô†*‡ä²{4<E¦‹k.më4Äò×€\r\nê^iÀ è³!n«²!2\$§ÈüÌ÷(îfñöÄìÄùk>Žï¢ÅËNú‚5\$Œàé2T¾,ÖLÄ‚¬ ¶ Z@ºí*Ð`^PðP%5%ªt‘HâWÀðonüö«E#föÒ<Ú2@K:Ìošùò’ÌÏ¦Í-èû2\\Wi+f›&Ñòg&²níLõ'eÒ|‚²´¿nK¥2ûrÚ¶Ëpá*.ánü²’Î¦‰‚‚*Ð+ªtBg* òžQ…1+)1hªŠî^‹`Q#ñØŽân*hòàòv¢Bãñ\0\\F\n†WÅr f\$ó=4\$G4ed b˜:J^!“0€‰_àû¦%2ÀË6³.F€ÑèÒºóEQÁ±‚²Îdts\"×„‘’B(`Ú\rÀš®c€R©°°ñV®²”óºXêâ:RŸ*2E*sÃ\$¬Ï+Á:bXlÌØtb‹á-ÄÂ›S>’ù-åd¢=äò\$Sø\$å2ÀÊ7“jº\"[Ì\"€È] [6“€SE_>åq.\$@z`í;ô4²3Ê¼ÅCSÕ*ïª[ÀÒÀ{DO´ÞªCJjå³šPò:'€ŽèÈ• QEÓ–æŽ`%rñ¯û7¯þG+hW4E*ÀÐ#TuFj•\n¾eùDô^æsš§r.ì‰ÅRkæ€z@¶@»…³Dâ`CÂV!Cæå•\0ñØÛŠ)3<ŽŽQ4@Ù3SP‡âZB³5F€Lä¨~G³5ÈÒ:ñÂÓ5\$XÑÔö}ÆžfŠËâIŽ€ó3S8ñ\0XÔ‚td³<\nbtNç Q¢;\rÜÑH‚ÕP\0Ô¯&\n‚žà\$VÒ\r:Ò\0]V5gV¦„òD`‡N1:ÓSS4Q…4³N•5u“5Ó`x	Ò<5_FHÜßõ}7­û)€SVíÌÄž#ê|‚Õ< Õ¼ÑË°£ ·\\ Ý-Êz2³\0ü#¡WJU6kv·µÎ#µÒ\rµì·¤§ÀûUõöiÕï_îõ^‚UVJ|Y.¨žÉ›\0u,ž€òðôæ°õ_UQD#µZJuƒXtñµ_ï&JO,Du`N\r5³Á`«}ZQM^mÌPìG[±Áa»bàNäž® ÖreÚ\n€Ò%¤4š“o_(ñ^¶q@Y6t;I\nGSM£3§×^SAYH hB±5 fN?NjWU•JÐÂøÖ¯YÖ³ke\"\\B1žØ…0º µenÐÄí*<¥O`S’L—\n‘Ú.gÍ5Zj¡\0R\$åh÷n÷[¶\\ÝíñrŒÊ,æ4ðœ° cP§pq@Rµrw>‹wCK‘…t¶ }5_uvh¤Ó`/Àúà\$ò–J)ÏRõ2Du73Öd\rÂ;­çw´ÝöHùI_\"4±rµ«®¦Ï¿+ê¿&0>É_-eqeDöÍVÔnŒÄf‹hüÂ\"ZÀ¨¶óZ¢WÌ6\\Lî¶·ê÷î·ke&ã~‡ààš…‘i\$Ï°´Mr×i*×ÄâÔç\0Ì.Q,¶¢8\r±È¸\$×­K‚ÈYƒ ÐioÍe%tÕ2ÿ\0äJýø~×ñ/I/.…e€€n«~x!€8´À|f¸hÛ„-H×åÏ&˜/„Æo‡­‡ø‚.K” Ë^jÜÀtµé>('L\r€àHsK1´e¤\0Ÿ\$&3²\0æin3í¨ oä“6ôÐ¶ø®÷ô§9Žj°¸àÈÚ1‰(b.”vC ÝŽ8ŒÙ:wi¬Ÿ\"®^wµQ©¥Åïz–o~Þ/„úÒ’÷–÷`Y2”D¬VúÆ³/kã8³¹7ZHø°Šƒ]2k2rœ¿ñ›ŠÏ¯h©=ˆT…ˆ]O&§\0ÄM\0Ö[8–‡È®…æ–â8&LÚVm vÀ±ê˜j„×šÇFåÄ\\™¶	™º¾&så€Q› \\\"òb€°	àÄ\rBsœIwž	žYéžÂN š7ÇC/*ÙË ¨\n\nÃH™[«š¹Ô*A˜ ñTEÏVP.UZ(tz/}\n2‚çyšS¢š,#É3âi°~W@yCC\nKT¿š1\"@|„zC\$ü€_CZjzHBºLVÔ,Kº£º„O—ÁÀPà@X…´…°‰¨ºƒ;DúWZšW¥aÙÀ\0ÞŠÂCG8–R  	à¦\n…„àŽºÐPÆA£è&Žšº é,ÚpfV|@N¨b¾\$€[‡I’Š­™âàð¦´àZ¥@Zd\\\"…|¢ƒ+¢Û®šìtzðo\$â\0[²èÞ±yƒE çë³É™®bhU1£‚,€r\$ãŒo8D§²‡F«ÆV&Ú5 h}ŽÂNÜÍ³&ºçµ•ef€Ç™Y™¸:»^z©VPu	W¹Z\"rÚ:ûhw˜µh#1¥´O¥äÃKâhq`å¦„óÄ§v| Ë§:wDúj…(W¢ºº­¨›ï¤»õ?;|Z—«%Š%Ú¡Är@[†ŠúÄB»&™»³˜›ú#ª˜©Ù£”:)ÂàY6û²–è&¹Ü	@¦	àœüIÄÒ!›©²»¶ Â»â2M„äO;²«ÑWÆ¼)êùCãÊFZâp!ÂÄa™Ä*FÄb¹I³ÃÍ¾àŒ¤#Ä¤9¡¦åçS©/SüA‰`zé•L*Î8»+¨ÌNù‹Ä-¸M•Ä-kd°®àLiÎJë‚Â·þJnÂÃbí Ó>,ÜV¶SP¯8´è>¶wïì\"E.îƒRz`Þ‹u_ÀèœôE\\ùÏÉ«Ð3Pç¬óÓ¥s]”•‰goVSƒ±ñ„\n ¤	*†\r»¸7)ªÊ„ümPWÝUÕ€ßÕÇ°¨·Þf”×Ü“iÿÆ…kÐŒ\rÄ('W`ÞBdã/h*†AÌlºMŽä€_\nÀèüú½µëOªäT‚5Ú&AÀ2Ã©`¸à\\RÑE\"_–_œ½.7¥Mœ6d;¶<?ÈÜ)(;¾û‰}K¸[«Åû»ÆZ?ÕyI ÷á1pªbu\0èéˆ²²Œ£{ó£Å\ri€û¦Eæ` ~\n‹ã=ýão„‡¨'ÊûáÉóv¨PÝyC\0‚\$Ñ8çTÖ/m1GT¨Ól”ä}oéeí=Gtb÷I/[0à%èo|ÒSyíÑÚØ^o¹Â;¾«æÏÈ@TÙbŽ*˜iÜÓÚPZT	‹þÓƒ\0\$êÅ>ÛìeõLþJ_ç7¢-RfŽ0\"à…­6g€øz\rÄa3›aÕ6+3ÜDBg‡3ÕY¶'Yàdüçx6I3_2}Õóè;ˆ „`ä@Ãbý«þ×Ïí {îC:SuM\nÄ¼‡ãSK\0ŸB;TÙ`Ö8÷Gˆ¶x‹IŽ`5€Ø#\"NÓÃ¯‡—Ò­ÿõv&œeð˜kDÈsq€˜.Fÿ˜Í<§ƒsñ’ h€e6üÓŸš¢*àbøiSÜŠÂ†Ì®…`çÒÙ‚ô×ý+\0±¤Ë5¸LLBT²Ä‚ÏwdXcôÍF×À1&Õ0Ð^ôP)\$\\8iûÀ¨ô(LÜïx)ˆn@°Cá÷?€\$€Yvy.\$(\0@p€u\rxo††°¸Àtb{á7Bžk\r©`Mt(í BTPÁ<¢G’\$Ú>Ü^pC*Öýé!.&žLxíš¾²Ñ\0]°4šË\0ðáÂ“PÃýaªšÑðÀ\näN…K†Ñ¦Üpã¢\$BË­@ÊëwVº¼¨¯f#¬Èrø§|YÇ/q‹ûYZÃVXB,wÜ„hF¨Gƒ¤ÂSg_?3,‹	sÐŠÊEµ#¸^š,Ð¡¦†Ù4¡R;’ÂÀJªæ,<…e(Vï#C€Êö`‚/8\rv‚qmpjBA›€´¶©ÅR@\nÐ­ñv¹w‹Ó^ªÈÜÀ7Œ­:á=JÐP¤ÄiŒ­êíyÉ¥¤á\0007E¥(IU2!¡ÒˆfŸC©íIì8G¦Â¢?e^`ðÅÁA]¡Ä™‡(pÓ}ÐÞ‡{Â!àFm(ñ”R°‘ BíïeÛ‚@Œ)¨‹,JO®„“ŽÞ\nð™\0Ð%]‚éw•LAÁxÇç9€Ú”Â˜«á¹ÉŒ,ÊbØ:Áø/QªHE|;‘ÿD¤äí±	Ú\$¦¨¡ƒ¡°oñbê+ß[@‚Ð!Ð›d€Q•Bª7ÅžER\n£yWÇ|ØEPJ+ƒ‹:ìX\0¯Ô· A\rnË†iÕê Œ¡ô„])qÔ<<jHyÜ’ \"!NàtÐD0FèÂŒ‰[ aŒ)'ËV}Q9\$Ñn@O9xŒXæ´”;è#Ñuƒ4 GÑA€±f.\\5£7bÞÅà\rz¤h¼~Õy\0„î“-é¿G\0/7K­·éò`+Ãö,Qã:Àµâ‡ƒsÀ^å54¦8Ý®y\0°µï¥ùrŠu„©©;‹,8ãä\0ˆˆ4t¿5\nÿ_‰ach… ý¿¡bZZË¿Èð–ødQqŽ±ËZ(ê%@–ñç!ªÿ@Éò%†Ð‘ãƒQé?Èôˆø¡‚Ck¥#ß	8 ¨þ|dXc£ªíÔÎ2U²Iß!¥^½-WïT9â¾àè@÷°«Û=¼\0Ò˜\$Â””†2Œ¨JœeÏ¤’t¬2€µ©‚K“T+¨þ\0œœð¤ ™\0ôÈ@<HœÄG¶Bd}‡·¢‰Úzb•ÀÈõ‘ö	^IãÝøòÂhSI-†æK£áJ„”Â\r%RºÉ\\&ŽhlNÐŠI1\nJÔ9n#¹4ÒKU1ÄvK³õ •haâm‰M#Š°¥¼¸;L˜*?ÎLe˜\n½ÈÂ(qìÕLGpˆŠê8` Hê©˜4T¥J`\"FM£%@Ê)QHÂgVO4Å)ó\$²®3\" •ƒëØ*í2ž0!•ƒo\0¼ØWMÁP°rbëL1qJà¶RÅ•°µ†‹,R\$ÁŽ3‘wŒô^Â*²{°AAfhŸUŠšYW\nŒ4‚©˜.Å2,ÑÐÿaÀZÄÙ”&=B?bµ@O/“Ý`IÅ¹änp‰¿	WPÌa0¥ü’`ë•xÐØYgH&qÀÀ‚ŠòxC©‚4ðÈ‰”èbXÃŒ.«€,èH/†8NàE-ç	 \"Õù2 l°¤R‹ô«ev\0§†€[’´g¨fr§‚îª¹¹\0PÙë,S„'€×pôÑ€Ôúù£ˆÀ.Â08”æ\"™‰¹5Ò¯g¬¬’±4âûÍ@\rFpKýQ´\0¼«³e@ølƒp?\0001€¤¨_ÀX>#²‹Œ‰<ˆH&(™µ¯…Ü /kD÷t¥ `\$\"ZÈ“6	©MŠX±@jX¯€ìÁ¿‹è lœÀE\0ÚÆ„ªt\0mœÔç\0^éÐ\$ì‚áSšÀ¤f®2°1\0\r /X§N6b˜Ÿô*`y›P¦PWÙÊŠt céfÒ ¡ÄpfÌÍ'ƒ:\0±Îti\rÌñÂT9µ\0®f‚› ´ÅO&<—Ãrc\n²	Ðf6!9ŽÌùÔÓà˜èP^+È¼Á¥âD³Oð¯†n´Éq•”EŒY‰\" n‰­%L˜Š#‘Áz\\ð'1:†íá -Ü‡|ŸV£ŠX¾…‡c¬ú&fÉ&õ^a¥1©˜ê’˜ºH5Q¬q5(>D”KÇØ¥IG³•J:ÃÆÐ¼JõŒÂ{¦Sd¯&´ñ«)	ö£Ke”@L wÁ-ê\\3æMì*QÈtŒ*÷ð§µ¤3BC¢ ›\$qsJ„<FÓÈxò8!QpFIŸÙ4€Þ)ð‡D,3ÿ-œæ©²±ÍÅ::Ñ!R¹¬\$SÂ ,Œ(!.³Q1\$N(†*ë¤ÇF•\0áGÕÊÓ8„Àˆ?N’’_X°Ì¨î6õÒL¡ñ#	„\0T3Dâá’6s›BhFu÷‡’J'’ù\neç °…ä'ÛV“ÅDp‡–D&)Ñ£ z@9\$Þ‹(Ë þ”ê—Ä¦YÍžÂä@1,zEJÈØìW0³¨\0duÕdP\"-MQ4Ü¦‘k•„¬GŸ	N›”ÖBò¬€¶½ð2‡ýDr_éþ\0÷Nµ½•ÎèÍ/˜ÓˆI¹>SA{”e9â›L­!W9YÛá„½ÒìÇð§ÕY½BÇb£šh©Äxø¦½;©àÓ„/íc^3½?àQÊv’£âü¦­>j=OÁ1‡þ¤Tõ¦t\\ÃBÂ-Ô^Å‡)SÕ÷)ãÊñF\rŒ„‹™HR©¹ ùÒ6I3+y6W’lxyA `)N˜(P¬ÐY/`¦x´]¤¯È˜¡IIÇUHÈc¾‘×ÈÉTÀg\\\r8—éR§ý:¡W¦ÒHe\\|ä’MyD¡T#ºCjÌ}ª¸“¹FÎÂ#¼HH@R`“Œ&‚d ZtÎÖ@ÒŒŒõY,)		nÕú¿ØE6!%/üÕó¦®±÷ªøë:Q?)ˆ¥ÐŸ ²tÜ†ù\0‹›u=às<ÈÀ˜%€R+ZÀ°\nSµ}r |Efu[zÜÉÄz?8TÍB„ØM\$¦ÅªÜ\\bvÂò©°\$äzÕWõIÕ€ŽŠOu\\È¡Ö<Àx  Îã+àüØà|.0I+èU0 Då[4\0/„Ž\0|`½&é –”éÓY¥ªÜöê³!¥MŠEZp.‰ù:u¡hýwMW%æm:cÀNœÒkê[á`€éLS[R!ø‡U9_ÑX&”§¯qtë]š×’2¶UsY¥w—|¤0©\rê–„Íkä:ò¯2Æõ®5l\rb\0Ý×tãußw˜}E¢¹A‰ßn8älœ3zâ®Å 'ÊZ&àR@€œÉM¹PÊ’]èû\nú¬\">(L˜ØG Û*vDéQADüñ<Š»u¤\0\níË	Zv0Å®zl(ÌV\\ˆüHBö´2Á\0ÅHpà´9B£0HbÐàpY\$™›cRÀÀ–€0Å@Z}~ÀÎ±Eª›‰ç‹§H\n\rÚ¹¥åžíw\$îešÌ\r(q ˆ!ª\\ñ3ÀLXÈÀýÔb\n¡Ò\\âÒÂ„{gi¥9é­Z8äw‘#¶n9Å„Š3”!–»a¥µ5maéÚ¹:ã¶ÙÅTä2p&Ü`^Lå¹‹Ûn…¨ÂÝp6»‰ÿ]s°[Ò,–e½›o‹W	®¶ü¶á¬\rà¾p.N4j:ksˆ^¡\\#¡@_›ÞCãpB–±½ ò)°	×ÎR0º“b~íÄÒZ’(:¬bLC,	”QBï&\"[¨Þ.QÃìªUß#jÚáp¡*¢mdŠDZÔ¬@[„€ŽÖv×M[>‚g!©s,Ç£UrÕ–ép¬jtÉPBf¦Ï-Ý¦\0`ž3Òù„À-¼XUB´ƒ‡A¥*¡€Ÿ@ONõü\\VSÄ4.²þ	rîÊ–M\"£hÞÊŒØOÍi«å£ŒÀ@Z²[Öà(¯8/(@ºÈW²²W‹ ƒ¡IYeyE¨zbëV®o8¤€€Èx‰¼åˆ¯.´Á’nx\$\nµ8¡Å\n<îÜ™ ô³¸¬Rƒd!ËŠ-öU5’@{YÐÚøA\n½;Ì*KRáÏqCP-ô3jYÓßMÝk«•`ˆ&ž^5\0ðìl«RV\r«’á’\rKê´M’mƒ#@…„!°Þ³¥‚“gƒ@…5: ¿•œÂigP:ÙÜ3·úO}õ¨'ZÛ×DôX¥áÀß\0‰8ÀhºÄWwäç¥ý8	±îü‘h_Tè`g¶Í¶Ü«’ÃÞH	9›”æ0XûÌBž-J-gCü(ËätãÛ\$•!Š^nù*HD¦!\n:¡Éˆt—&ë'jÉè£îŒGúe'óVr7Y²íÔcjÑ…*¤–~€uzU¸i@d’±\\P\r\rIp\0`Ð€ºÃ);’Ið¸g„]W4/Ž@ðÏîÙ)” L ôˆùaî§×Ä-2oº•\"ñaŽ†´ Ý/rŽ\\p L\rÍÈýˆÚ¨À'ø /ÁúŠHPáïÃ~¾À\nû‡9^`˜u;ÚkŠÀ˜Ü£Ú¾àmˆJ\$ ür:k\rT9Y¦*.l„,Zm\râBýÓqJ|a”èôØ¨KêôV@úd”¼þ#ºó\$Îª¸š äBkÍ ‘àaI”¶ý[¤€ØòÑøâ±G×Æà˜êu\n	C†WÀ+ÐÍ‚Ìm7ÏkÐ8õÖíò{…0ÇG¥ÈîáBÚŠ¶í¡žÀ¼v›Þ^ogq¹Ê=±Ãa×Äá—j‚f}„õÈ#8s%Á¨õÅÄ9<‚  ÖêÈR< hþäsÚõ“«9 œqÛKüw]\\±Ä¸Jt’žÁŽÂ ë˜æ(æ:M¢1ð87bß¬u©NPü8àcƒ'ñÊ\nßò¤;l­ªS+£Ž/Sò¬Çœ¬åMu)Ê~!ÔÖèeßüHFŒ_Âa²f8æ]| u@`ˆ!3wã5àù*gYNE.Ök·r°j8t#ã*|ìÂ«ÕÌ´ÀÃ!a×wìÉeq>®p:EÆKæ'à-°š÷¤i\$…äáŠÀ11¬&¶\ntÑàt¨Ó\$(Y¨ÍPsX^ÒV×\r©b	c¤‚;›vàf¹†uSÍàs|›¨fáýªÝ)¦1Ø[666'} ¶p’êPy@´qÕÕÊº’îì´…Ï¸¿¡Ój¦AòUÕÎÚtÖCÓ%™+f~îøÎÏ)W]&üjœzC'ÝÏ•ˆ‡\$ãÞô¡Rô(i¼œ+ðFÉÑaSzS¥Q¹œavç>Y¹|žgOEŸÐ€ŒhZä€Ð+ãÙ j[ßABtÈ°×YFœ”'à|\r˜KfàèäÞ×iPÙt¨JKvì_ˆpÚ`ð¸§yŒ,åèW\"áÎøA€¿KØû@t°(6ÓÅ,ô´I@p	@Ðô£\r ½S;ºD	nh4g ŽÓÇIZÐ)¾4¢ ÚŸH´ÐX¾Æi¸²QBÁº2ôõ‰K×	ía 4ER`™©\"ªa¢Ð^lóR(ìÕç%¸‹_‚r2Ö¸kªå\\.¿NnsÙ§YÇ\"\rëGºl—mâçBDÔÔ`p\r=•F;êIOF9®s3-n–Œ€Aà-µj…-ÓV1/h¶•4±¼A&ÂÆ\\Áy—v­Õú3_¬Dê	zÖ]Àäí[’¡ék\$5Ršs{u«||à‹WD›TÎÃÊK›É‰Ð€)¸\n„åŠì‹p¤ÂuœÀ\n¡Bk”­ê¦l€œ¿| ò£]£{	\rÒNL š5‘Zü„§¯ Žœ „ˆ:J!ÿü°âÝ?Ô§“ØŠu}‡®DN×” a\\À4;a¶¾=HJè+?db¹ #vy 'e;0ïöhX¾î…uÀ¸K¢?7`PuO²“ªÃ˜^§×‰¹©&Åfv»ä]]¢~ÔR|«¸ò=X¨3£À@Ø§´ÙçŒú“jTÚJ´ÒvpOõÇ„ì'm®aµþÛ_&H…ïµTƒd{Xù,ÖVµ5¬ËäÙmÏZZËŽKÑÙd)•Èî‹<ªP\nK4¡N¬­ÒØ»ÝŸ\n×â–et—ÍÅR>iõ¦E’@º(}3è\$ÎÔŠw\"¢ªaiÝ\n´x9,¢Þð)	ÍkåmÚÏcG`æ2@Ô®ÓÉCr\"R=Ó.Õy…&ÝˆPçºÀ½n»G\0|<^±™H½†´ûL’2ðCŽjƒàŠ–®Ò~õ·’aP i½ŒZrGf÷‚\rØ\rBÕ’òÈ”l¥2u’ƒy4;@Hý\rqœí÷‡I–ÔieÃX\"Ls^ßX©²¹Üe\nÌ=›äÕ¡ñVÌFCÓºä>7\$¡ë^ø\$’“\0ïp‚&©€Y˜énöA“žŽñw¹¢#\"ž»Ù:èì?‹Á÷kf….P›«­`blËZó\$Ä³µœÂ3l'[\r£ç&,\0ªm“*@òàª¼é8;fk%u&Þ€ð§·ð‘UJc“—@îÅiöMKÅP«Á*<²p~ö2k‡l´ßÖ8Iœ\$1˜I¹«(Np°Ì-f:®à<«Î\$èAWúØL¶9žz	²g\0í(†>ô0ô^Yq®î\\m¤àzÙuÀÊZl‘ƒ¼ã.àøÏ…M÷rK'{ñãz•›_Ç9K¤jx_eîäøûGÌò-%‰ÃX™/±dáÞ\$á,é<KROùi‡ÝçÉ!(Ò:‘n!ñÊÚ»U)*…‹Ì­V“ÌìVmü¸ž’Y’uËÉÇUc9Ü‘¤Æ¹)½žKk“½äÒQyS«„…Ž¦’IaËç|Ð»2œ˜…ˆÚx0³œD1Ž¬\rlÙDLMãówÓ(;d°Â•;\$Ð©Îx;OBkÔ^Þ„òÕf–Ú6©k³[:‰MÐ€{ç~ÄÓƒyäîþž…œH¡î[OÕôêãb_G@Ôì°¬æÕqöæ¥¶yÒ‡”8ˆFäHö‡(yjûs\"›\\É%üÒw1NÕÒk¼Zâ«ê#S 0üN-€tZ°§@œ@\"`J5êw0IÇÆ@^,ØDwÐc9Fù\$!˜|qc'?S«Æ‰IŠù \\,RIÊ¼,î‰®HÖejú”E2–}fê×N×Ë®k¥¦qÄ‰êö¹!s.¶R\\;Ëëç2°±½Î”9ôç¼ÄNý²l“ÐxË2«Ñ–ô¸•ÃóvmIeIÊZz‚Øæ°ÚÄÎŒKÌ`õpï.na4<*4›d¹Ã¿ôÉv#©1Ü“+9¹ÝÐq`oLü¡\0ë˜A-‚¬Ö	­jõ}ð”q~Wä™€Ý\0€¢ÚH@sœÛ­ê—UÂ×}ÒWP	û¨žë¤^ö)œûâ4FYÌm€\n]É{í{T¢W¾w%o8D@¾:6¯¯£§«’F_àª¦¹­\"‹ï¤uª/ø;ÁGçð`	‚† \"/ððžé	ô-ay“í\"æ^ªÒQÖ7”†N|‚°­ÉdæRh8TMyíà¨âžûÐNä¾>ñD2<\0˜S@Ùý@=ò7¦˜ºÊæ†8šè)Tœü£hÕnÑš\0w(]¤Ö¹r†Ü•÷;ÄÞØ±‡Ïã!îÍ\$\n P @¨P<È–4²B£œ€æÎP!ˆé‡MãpS‰b¤MºˆôÔú\r4!û¨“JŒÁs¼å(±i(I8]}‘¢Ðò ;·¥§³T2ý÷FŒjý@|ú:ð0ú\$#ŠÍÜ…ÎpŠy¯ò¤„·qåEgéè\0¶I3§kÎ«0§oJÐ -Í·¯L¢)ý¨t®\"çk{BnCZºÅÿÎR?hà¢z7íeS+PoÚ<Xu\rb£Rú€NÂ‡ì:iEEñh¤PâQAL{ Q~ë)Ð¨í-i†Ý‰ù˜QD¬Íº[¦{`ÎQv½þ;Ÿ€¨oàpç§ˆ¾<¤ìŽàpõâÒëDwôZ€Ä¡t{© }èm³\\_`ÈqvF€Z@®×sf_/ŠáNîŠø#^µ§ÆŸ¶¿»2ìèq¥à~hŸŽ|Xÿ4‡¯ÆDü:ñÉü½ìŠ	Ù©”OHY\"Ži¿ù ~Ž;S|Ò7ùÈHnÏó@üð.¿@Ì>†‹_¢žT_WúJ‰à‡ô²7}5C¡¼ú‹ö;óäZý¬ÿHVæ†½ìôËïã^hÊ}Ê/–{×ä=D;¿òZóüœ­©hCˆ'‚¯}úøUâ>_‰5ØÆ–jü?;óÐüPuð±üOÌ@Ëòÿ·~¸E¥ÇçÏüjR·´14	·ÜR¡ôà;}Aã¦ƒH~¸\$êXµ~oª£ƒŸÛƒû¯³úØõ(µ_ÕEï÷¿¬Cê*£þ0¹þp2Ðè(d_¥þ¿ß=œ\"áQÓúºÅË¹õ ZO[|Óùßíb7öë1ùßì#e@åóúv hTâ›ö?èõ‚¦oY–j.àú5(Rk~ÐŸŠ ˜?ìe=põØ¡×Š£\0˜†Î=vx.Ïú=b©ÉK²ì«²fïƒ…¸ØWK@\0V€OÁL\0Vúâ­¨aÀL–*™ ^„@oÀOÃ†À^þðL¢¢¹šjJ^@mÄ Àvä€ËnólïKºõ‚÷»êD¾²ŸCV/S‡\0ùò}M&8ƒÓß°/¢~¾Ã\"À¬2ÚØ^âîˆ6HƒÁ—<ÿá&‡€Ä„0`é€fxò™í7€žkJ †€àHZìt<ö“MïU&îTáæa>dX±m¤ÔXä‚V€ößN&2-äžéò~ž<ËMð@&T\$àßãÒ]¸#P=ÀšØD\r7µbÓxSM7¢6Š‚\$	÷¥ªx‰âlð@ü­Ì	4Þá3ÌÏ~ä—P#¡»—öpÐ`Ü„Ögú¨‡ \$€c(\0Á\\Ö;û€\"V!ˆq`È>&X#‚6Fh!aQ€Êù\rð?`F(Á ÒÞÁ[í‘ÁÌx€€\0utAÓ†¤Véý'õÁžú‹èi\"5£?ïMmÈ°Aºððx=FÑpp˜Ád^ÁÐWCdp„AÛ çõ?ô´¤ì%X¬Â\"‹Ãì\"\\¹&˜áŸFìÑ‰@¥f0Ž†K¡Œe€z9ãÂ B`Ó“OõŠ2í7B@2 ");
    } elseif ($_GET["file"] == "jush.js") {
        header("Content-Type: text/javascript; charset=utf-8");
        echo lzw_decompress("v0œF£©ÌÐ==˜ÎFS	ÐÊ_6MÆ³˜èèr:™E‡CI´Êo:C„”Xc‚\ræØ„J(:=ŸE†¦a28¡xð¸?Ä'ƒi°SANN‘ùðxs…NBáÌVl0›ŒçS	œËUl(D|Ò„çÊP¦À>šE†ã©¶yHchäÂ-3Eb“å ¸b½ßpEÁpÿ9.Š˜Ì~\nŽ?Kb±iw|È`Ç÷d.¼x8EN¦ã!”Í2™‡3©ˆá\r‡ÑYŽÌèy6GFmYŽ8o7\n\r³0¤÷\0DbcÓ!¾Q7Ð¨d8‹Áì~‘¬N)ùEÐ³`ôNsßð`ÆS)ÐOé—·ç/º<xÆ9Žo»ÔåµÁì3n«®2»!r¼:;ã+Â9ˆCÈ¨®‰Ã\n<ñ`Èó¯bè\\š?`†4\r#`È<¯BeãB#¤N Üã\r.D`¬«jê4ÿŽŽpéar°øã¢º÷>ò8Ó\$Éc ¾1Écœ ¡c êÝê{n7ÀÃ¡ƒAðNÊRLi\r1À¾ø!£(æjÂ´®+Âê62ÀXÊ8+Êâàä.\rÍÎôƒÎ!x¼åƒhù'ãâˆ6Sð\0RïÔôñOÒ\n¼…1(W0…ãœÇ7qœë:NÃE:68n+ŽäÕ´5_(®s \rã”ê‰/m6PÔ@ÃEQàÄ9\n¨V-‹Áó\"¦.:åJÏ8weÎq½|Ø‡³XÐ]µÝY XÁeåzWâü Ž7âûZ1íhQfÙãu£jÑ4Z{p\\AUËJ<õ†káÁ@¼ÉÃà@„}&„ˆL7U°wuYhÔ2¸È@ûu  Pà7ËA†hèÌò°Þ3Ã›êçXEÍ…Zˆ]­lá@MplvÂ)æ ÁÁHW‘‘Ôy>Y-øYŸè/«›ªÁî hC [*‹ûFã­#~†!Ð`ô\r#0PïCË—f ·¶¡îÃ\\î›¶‡É^Ã%B<\\½fˆÞ±ÅáÐÝã&/¦O‚ðL\\jF¨jZ£1«\\:Æ´>N¹¯XaFÃAÀ³²ðÃØÍf…h{\"s\n×64‡ÜøÒ…¼?Ä8Ü^p\"ë°ñÈ¸\\Úe(¸PƒNµìq[g¸Árÿ&Â}PhÊà¡ÀWÙí*Þír_sËP‡hà¼àÐ\nÛËÃomõ¿¥Ãê—Ó#§¡.Á\0@épdW ²\$Òº°QÛ½Tl0† ¾ÃHdHë)š‡ÛÙÀ)PÓÜØHgàýUþ„ªBèe\r†t:‡Õ\0)\"Åtô,´œ’ÛÇ[(DøO\nR8!†Æ¬ÖšðÜlAüV…¨4 hà£Sq<žà@}ÃëÊgK±]®àè]â=90°'€åâøwA<‚ƒÐÑaÁ~€òWšæƒD|A´††2ÓXÙU2àéyÅŠŠ=¡p)«\0P	˜s€µn…3îr„f\0¢F…·ºvÒÌG®ÁI@é%¤”Ÿ+Àö_I`¶ÌôÅ\r.ƒ N²ºËKI…[”Ê–SJò©¾aUf›Szûƒ«M§ô„%¬·\"Q|9€¨Bc§aÁq\0©8Ÿ#Ò<a„³:z1Ufª·>îZ¹l‰‰¹ÓÀe5#U@iUGÂ‚™©n¨%Ò°s¦„Ë;gxL´pPš?BçŒÊQ\\—b„ÿé¾’Q„=7:¸¯Ý¡Qº\r:ƒtì¥:y(Å ×\nÛd)¹ÐÒ\nÁX; ‹ìŽêCaA¬\ráÝñŸP¨GHù!¡ ¢@È9\n\nAl~H úªV\nsªÉÕ«Æ¯ÕbBr£ªö„’­²ßû3ƒ\ržP¿%¢Ñ„\r}b/‰Î‘\$“5§PëCä\"wÌB_çŽÉUÕgAtë¤ô…å¤…é^QÄåUÉÄÖj™Áí Bvhì¡„4‡)¹ã+ª)<–j^<Lóà4U* õBg ëÐæè*nÊ–è-ÿÜõÓ	9O\$´‰Ø·zyM™3„\\9Üè˜.oŠ¶šÌë¸E(iåàžœÄÓ7	tßšé-&¢\nj!\rÀyœyàD1gðÒö]«ÜyRÔ7\"ðæ§·ƒˆ~ÀíàÜ)TZ0E9MåYZtXe!Ýf†@ç{È¬yl	8‡;¦ƒR{„ë8‡Ä®ÁeØ+ULñ'‚F²1ýøæ8PE5-	Ð_!Ô7…ó [2‰JËÁ;‡HR²éÇ¹€8pç—²Ý‡@™£0,Õ®psK0\r¿4”¢\$sJ¾Ã4ÉDZ©ÕI¢™'\$cL”R–MpY&ü½Íiçz3GÍzÒšJ%ÁÌPÜ-„[É/xç³T¾{p¶§z‹CÖvµ¥Ó:ƒV'\\–’KJa¨ÃMƒ&º°£Ó¾\"à²eo^Q+h^âÐiTð1ªORäl«,5[Ý˜\$¹·)¬ôjLÆU`£SË`Z^ð|€‡r½=Ð÷nç™»–˜TU	1Hyk›Çt+\0váD¿\r	<œàÆ™ìñjG”ž­tÆ*3%k›YÜ²T*Ý|\"CŠülhE§(È\rÃ8r‡×{Üñ0å²×þÙDÜ_Œ‡.6Ð¸è;ãü‡„rBjƒO'Ûœ¥¥Ï>\$¤Ô`^6™Ì9‘#¸¨§æ4Xþ¥mh8:êûc‹þ0ø×;Ø/Ô‰·¿¹Ø;ä\\'( î„tú'+™òý¯Ì·°^]­±NÑv¹ç#Ç,ëvð×ÃOÏiÏ–©>·Þ<SïA\\€\\îµü!Ø3*tl`÷u\0p'è7…Pà9·bsœ{Àv®{·ü7ˆ\"{ÛÆrîaÖ(¿^æ¼ÝE÷úÿë¹gÒÜ/¡øžUÄ9g¶î÷/ÈÔ`Ä\nL\n)À†‚(Aúað\" žçØ	Á&„PøÂ@O\nå¸«0†(M&©FJ'Ú! …0Š<ïHëîÂçÆù¥*Ì|ìÆ*çOZím*n/bî/ö®Ôˆ¹.ìâ©o\0ÎÊdnÎ)ùŽi:RŽÎëP2êmµ\0/vìOX÷ðøFÊ³ÏˆîŒè®\"ñ®êöî¸÷0õ0ö‚¬©í0bËÐgjðð\$ñné0}°	î@ø=MÆ‚0nîPŸ/pæotì€÷°¨ð.ÌÌ½g\0Ð)o—\n0È÷‰\rF¶é€ b¾i¶Ão}\n°Ì¯…	NQ°'ðxòFaÐJîÎôLõéðÐàÆ\rÀÍ\r€Öö‘0Åñ'ð¬Éd	oepÝ°4DÐÜÊ¦q(~ÀÌ ê\r‚E°ÛprùQVFHœl£‚Kj¦¿äN&­j!ÍH`‚_bh\r1Ž ºn!ÍÉŽ­z™°¡ð¥Í\\«¬\rŠíŠÃ`V_kÚÃ\"\\×‚'Vˆ«\0Ê¾`ACúÀ±Ï…¦VÆ`\r%¢’ÂÅì¦\rñâƒ‚k@NÀ°üBñíš™¯ ·!È\n’\0Z™6°\$d Œ,%à%laíH×\n‹#¢S\$!\$@¶Ý2±„I\$r€{!±°J‡2HàZM\\ÉÇhb,‡'||cj~gÐr…`¼Ä¼º\$ºÄÂ+êA1ðœE€ÇÀÙ <ÊL¨Ñ\$âY%-FDªŠd€Lç„³ ª\n@’bVfè¾;2_(ëôLÄÐ¿Â²<%@Úœ,\"êdÄÀN‚erô\0æƒ`Ä¤Z€¾4Å'ld9-ò#`äóÅ–…à¶Öãj6ëÆ£ãv ¶àNÕÍf Ö@Ü†“&’B\$å¶(ðZ&„ßó278I à¿àP\rk\\§—2`¶\rdLb@Eöƒ2`P( B'ã€¶€º0²& ô{Â•“§:®ªdBå1ò^Ø‰*\r\0c<K|Ý5sZ¾`ºÀÀO3ê5=@å5ÀC>@ÂW*	=\0N<g¿6s67Sm7u?	{<&LÂ.3~DÄê\rÅš¯x¹í),rîinÅ/ åO\0o{0kÎ]3>m‹”1\0”I@Ô9T34+Ô™@e”GFMCÉ\rE3ËEtm!Û#1ÁD @‚H(‘Ón ÃÆ<g,V`R]@úÂÇÉ3Cr7s~ÅGIói@\0vÂÓ5\rVß'¬ ¤ Î£PÀÔ\râ\$<bÐ%(‡Ddƒ‹PWÄîÐÌbØfO æx\0è} Üâ”lb &‰vj4µLS¼¨Ö´Ô¶5&dsF Mó4ÌÓ\".HËM0ó1uL³\"ÂÂ/J`ò{Çþ§€ÊxÇYu*\"U.I53Q­3Qô»J„”g ’5…sàúŽ&jÑŒ’Õu‚Ù­ÐªGQMTmGBƒtl-cù*±þ\rŠ«Z7Ôõó*hs/RUV·ðôªBŸNËˆ¸ÃóãêÔŠài¨Lk÷.©´Ätì é¾©…rYi”Õé-Sµƒ3Í\\šTëOM^­G>‘ZQjÔ‡™\"¤Ž¬i”ÖMsSãS\$Ib	f²âÑuæ¦´™å:êSB|i¢ YÂ¦ƒà8	vÊ#é”Dª4`‡†.€Ë^óHÅM‰_Õ¼ŠuÀ™UÊz`ZJ	eçºÝ@Ceíëa‰\"mób„6Ô¯JRÂÖ‘T?Ô£XMZÜÍÐ†ÍòpèÒ¶ªQv¯jÿjV¶{¶¼ÅCœ\rµÕ7‰TÊžª úí5{Pö¿]’\rÓ?QàAAÀèŽ‹’Í2ñ¾ “V)Ji£Ü-N99f–l JmÍò;u¨@‚<FþÑ ¾e†j€ÒÄ¦I‰<+CW@ðçÀ¿Z‘lÑ1É<2ÅiFý7`KG˜~L&+NàYtWHé£‘w	Ö•ƒòl€Òs'gÉãq+Lézbiz«ÆÊÅ¢Ð.ÐŠÇzW²Ç ùzd•W¦Û÷¹(y)vÝE4,\0Ô\"d¢¤\$Bã{²Ž!)1U†5bp#Å}m=×È@ˆwÄ	P\0ä\rì¢·‘€`O|ëÆö	œÉüÅõûYôæJÕ‚öE×ÙOuž_§\n`F`È}MÂ.#1á‚¬fì*´Õ¡µ§  ¿zàucû€—³ xfÓ8kZR¯s2Ê‚-†’§Z2­+ŽÊ·¯(åsUõcDòÑ·Êì˜ÝX!àÍuø&-vPÐØ±\0'LïŒX øLÃ¹Œˆo	Ýô>¸ÕŽÓ\r@ÙPõ\rxF×üE€ÌÈ­ï%Àãì®ü=5NÖœƒ¸?„7ùNËÃ…©wŠ`ØhX«98 Ìø¯q¬£zãÏd%6Ì‚tÍ/…•˜ä¬ëLúÍl¾Ê,ÜKa•N~ÏÀÛìú,ÿ'íÇ€M\rf9£w˜!x÷x[ˆÏ‘ØG’8;„xA˜ù-IÌ&5\$–D\$ö¼³%…ØxÑ¬Á”ÈÂ´ÀÂŒ]›¤õ‡&o‰-39ÖLù½zü§y6¹;u¹zZ èÑ8ÿ_•Éx\0D?šX7†™«’y±OY.#3Ÿ8 ™Ç€˜e”Q¨=Ø€*˜™GŒwm ³Ú„Y‘ù ÀÚ]YOY¨F¨íšÙ)„z#\$eŠš)†/Œz?£z;™—Ù¬^ÛúFÒZg¤ù• Ì÷¥™§ƒš`^Úe¡­¦º#§“Øñ”©Žú?œ¸e£€M£Ú3uÌåƒ0¹>Ê\"?Ÿö@×—Xv•\"ç”Œ¹¬¦*Ô¢\r6v~‡ÃOV~&×¨^gü šÄ‘Ùž‡'Î€f6:-Z~¹šO6;zx²;&!Û+{9M³Ù³d¬ \r,9Öí°ä·WÂÆÝ­:ê\rúÙœùã@ç‚+¢·]œÌ-ž[gž™Û‡[s¶[ižÙiÈq››y›éxé+“|7Í{7Ë|w³}„¢›£E–ûW°€Wk¸|JØ¶å‰xmˆ¸q xwyjŸ»˜#³˜e¼ø(²©‰¸ÀßžÃ¾™†ò³ {èßÚ y“ »M»¸´@«æÉ‚“°Y(gÍš-ÿ©º©äí¡š¡ØJ(¥ü@ó…;…yÂ#S¼‡µY„Èp@Ï%èsžúoŸ9;°ê¿ôõ¤¹+¯Ú	¥;«ÁúˆZNÙ¯Âº§„š k¼V§·u‰[ñ¼x…|q’¤ON?€ÉÕ	…`uœ¡6|­|X¹¤­—Ø³|Oìx!ë:¨œÏ—Y]–¬¹Ž™c•¬À\r¹hÍ9nÎÁ¬¬ë€Ï8'—ù‚êà Æ\rS.1¿¢USÈ¸…¼X‰É+ËÉz]ÉµÊ¤?œ©ÊÀCË\r×Ë\\º­¹ø\$Ï`ùÌ)UÌ|Ë¤|Ñ¨x'ÕœØÌäÊ<àÌ™eÎ|êÍ³ç—â’Ìé—LïÏÝMÎy€(Û§ÐlÐº¤O]{Ñ¾×FD®ÕÙ}¡yu‹ÑÄ’ß,XL\\ÆxÆÈ;U×ÉWt€vŸÄ\\OxWJ9È’×R5·WiMi[‡Kˆ€f(\0æ¾dÄšÒè¿©´\rìMÄáÈÙ7¿;ÈÃÆóÒñçÓ6‰KÊ¦Iª\rÄÜÃxv\r²V3ÕÛßÉ±.ÌàRùÂþÉá|Ÿá¾^2‰^0ß¾\$ QÍä[ã¿D÷áÜ£å>1'^X~t1\"6Lþ›+þ¾Aàžeá“æÞåI‘ç~Ÿåâ³â³@ßÕ­õpM>Óm<´ÒSKÊç-HÉÀ¼T76ÙSMfg¨=»ÅGPÊ°›PÖ\r¸é>Íö¾¡¥2Sb\$•C[Ø×ï(Ä)žÞ%Q#G`uð°ÇGwp\rkÞKe—zhjÓ“zi(ôèrO«óÄÞÓþØT=·7³òî~ÿ4\"ef›~íd™ôíVÿZ‰š÷U•-ëb'VµJ¹Z7ÛöÂ)T‘£8.<¿RMÿ\$‰žôÛØ'ßbyï\n5øƒÝõ_ŽàwñÎ°íUð’`eiÞ¿J”b©gðuSÍë?Íå`öážì+¾Ïï Mïgè7`ùïí\0¢_Ô-ûŸõ_÷–?õF°\0“õ¸X‚å´’[²¯Jœ8&~D#Áö{P•Øô4Ü—½ù\"›\0ÌÀ€‹ý§ý@Ò“–¥\0F ?* ^ñï¹å¯wëÐž:ð¾uàÏ3xKÍ^ów“¼¨ß¯‰y[Ôž(žæ–µ#¦/zr_”g·æ?¾\0?€1wMR&M¿†ù?¬St€T]Ý´Gõ:I·à¢÷ˆ)‡©Bïˆ‹ vô§’½1ç<ôtÈâ6½:W{ÀŠôx:=Èî‘ƒŒÞšóø:Â!!\0x›Õ˜£÷q&áè0}z\"]ÄÞo•z¥™ÒjÃw×ßÊÚÁ6¸ÒJ¢PÛž[\\ }ûª`S™\0à¤qHMë/7B’€P°ÂÄ]FTã•8S5±/IÑ\rŒ\n îO¯0aQ\n >Ã2­j…;=Ú¬ÛdA=­p£VL)Xõ\nÂ¦`e\$˜TÆ¦QJÍó®ælJïŠÔîÑy„IÞ	ä:ƒÑÄÄBùbPÀ†ûZÍ¸n«ª°ÕU;>_Ñ\n	¾õëÐÌ`–ÔuMòŒ‚‚ÂÖm³ÕóÂLwúB\0\\b8¢MÜ[z‘&©1ý\0ô	¡\r˜TÖ×› €+\\»3ÀPlb4-)%Wd#\nÈårÞåMX\"Ï¡ä(Ei11(b`@fÒ´­ƒSÒóˆjåD†bf£}€rï¾‘ýD‘R1…´bÓ˜AÛïIy\"µWvàÁgC¸IÄJ8z\"P\\i¥\\m~ZR¹¢vî1ZB5IŠÃi@x”†·°-‰uM\njKÕU°h\$o—ˆJÏ¤!ÈL\"#p7\0´ P€\0ŠD÷\$	 GK4eÔÐ\$\nGä?ù3£EAJF4àIp\0«×FŽ4±²<f@ž %q¸<kãw€	àLOp\0‰xÓÇ(	€G>ð@¡ØçÆÆ9\0TÀˆ˜ìGB7 - €žøâG:<Q™ #Ã¨ÓÇ´û1Ï&tz£á0*J=à'‹J>ØßÇ8q¡Ð¥ªà	€OÀ¢XôF´àQ,ÀÊÐ\"9‘®pä*ð66A'ý,y€IF€Rˆ³TˆÏý\"”÷HÀR‚!´j#kyFÀ™àe‘¬z£ëéÈðG\0Žp£‰aJ`C÷iù@œT÷|\n€Ix£K\"­´*¨Tk\$c³òÆ”aAh€“! \"úE\0OdÄSxò\0T	ö\0‚žà!FÜ\n’U“|™#S&		IvL\"”“…ä\$hÐÈÞEAïN\$—%%ù/\nP†1š“²{¤ï) <‡ð L å-R1¤â6‘¶’<@O*\0J@q¹‘Ôª#É@Çµ0\$tƒ|’]ã`»¡ÄŠA]èÍìPá‘€˜CÀp\\pÒ¤\0™ÒÅ7°ÄÖ@9©bmˆr¶oÛC+Ù]¥JrÔfü¶\rì)d¤’Ñœ­^hßI\\Î. g–Ê>¥Í×8ŒÞÀ'–HÀf™rJÒ[rçoã¥¯.¹v„½ï#„#yR·+©yËÖ^òù›†F\0á±™]!É•ÒÞ”++Ù_Ë,©\0<@€M-¤2WòâÙR,c•Œœe2Ä*@\0êP €Âc°a0Ç\\PÁŠˆO ø`I_2Qs\$´w£¿=:Îz\0)Ì`ÌhŠÂ–Áƒˆç¢\nJ@@Ê«–\0šø 6qT¯å‡4J%•N-ºm¤Äåã.É‹%*cnäËNç6\"\rÍ‘¸òè—ûŠfÒAµÁ„põMÛ€I7\0™MÈ>lO›4ÅS	7™cÍì€\"ìß§\0å“6îps…–ÄÝåy.´ã	ò¦ñRKð•PAo1FÂtIÄb*ÉÁ<‡©ý@¾7ÐË‚p,ï0NÅ÷: ¨N²m ,xO%è!‚Úv³¨˜ gz(ÐM´óÀIÃà	à~yËö›h\0U:éØOZyA8<2§²ð¸ÊusÞ~lòÆÎEð˜O”0±Ÿ0]'…>¡ÝÉŒ:ÜêÅ;°/€ÂwÒôäì'~3GÎ–~Ó­äþ§c.	þ„òvT\0cØt'Ó;P²\$À\$ø€‚Ð-‚s³òe|º!•@dÐObwÓæc¢õ'Ó@`P\"xôµèÀ0O™5´/|ãU{:b©R\"û0…Ñˆk˜Ðâ`BD\nk€Pãc©á4ä^ p6S`Ü\$ëf;Î7µ?lsÅÀß†gDÊ'4Xja	A‡…E%™	86b¡:qr\r±]C8ÊcÀF\n'ÑŒf_9Ã%(¦š*”~ŠãiSèÛÉ@(85 T”Ë[þ†JÚ4I…l=°ŽQÜ\$dÀ®hä@D	-Ù!ü_]ÉÚH–ÆŠ”k6:·Úò\\M-ÌØðò£\r‘FJ>\n.‘”qeGú5QZ´†‹' É¢ž½Û0ŸîzP–à#Å¤øöÖéràÒít½’ÒÏËŽþŠ<QˆT¸£3D\\¹„ÄÓpOE¦%)77–Wt[ºô@¼›Žš\$F)½5qG0«-ÑW´v¢`è°*)RrÕ¨=9qE*K\$g	‚íA!åPjBT:—Kû§!×÷H“ R0?„6¤yA)B@:Q„8B+J5U]`„Ò¬€:£ðå*%Ip9ŒÌ€ÿ`KcQúQ.B”±Ltbª–yJñEê›Té¥õ7•ÎöAmÓä¢•Ku:ŽðSji— 5.q%LiFºšTr¦Ài©ÕKˆÒ¨z—55T%U•‰UÚIÕ‚¦µÕY\"\nSÕm†ÑÄx¨½Ch÷NZ¶UZ”Ä( Bêô\$YËV²ã€u@è”»’¯¢ª|	‚\$\0ÿ\0 oZw2Ò€x2‘ûk\$Á*I6IÒn• •¡ƒI,€ÆQU4ü\n„¢).øQôÖaIá]™À èLâh\"øf¢ÓŠ>˜:Z¥>L¡`n˜Ø¶Õì7”VLZu”…e¨ëXúè†ºB¿¬¥B‰º’¡Z`;®ø•J‡]òÑ€žäS8¼«f \nÚ¶ˆ#\$ùjM(¹‘Þ¡”„¬a­Gí§Ì+Aý!èxL/\0)	Cö\nñW@é4€ºáÛ©• ŠÔRZƒ®â =˜Çî8“`²8~â†hÀìP °\r–	°žìD-FyX°+Êf°QSj+Xó|•È9-’øs¬xØü†ê+‰VÉcbpì¿”o6HÐq °³ªÈ@.€˜l 8g½YMŸÖWMPÀªU¡·YLß3PaèH2Ð9©„:¶a²`¬Æd\0à&ê²YìÞY0Ù˜¡¶SŒ-—’%;/‡TÝBS³PÔ%fØÚý• @ßFí¬(´Ö*Ñq +[ƒZ:ÒQY\0Þ´ëJUYÖ“/ý¦†pkzÈˆò€,´ðª‡ƒjÚê€¥W°×´e©JµFèýVBIµ\r£ÆpF›NÙ‚Ö¶™*Õ¨Í3kÚ0§D€{™Ôø`q™•Ò²Bqµe¥D‰cÚÚÔVÃE©‚¬nñ×äFG E›>jîèÐú0g´a|¡Shì7uÂÝ„\$•†ì;aô—7&¡ë°R[WX„ÊØ(qÖ#Œ¬P¹Æä×–Ýc8!°H¸àØVX§ÄŽ­jøÊZŽô‘¡¥°Q,DUaQ±X0‘ÕÕ¨ÀÝËGbÁÜlŠBŠt9-oZü”L÷£¥Â­åpË‡‘x6&¯¯MyÔÏsÒ¿–èð\"ÕÍ€èR‚IWU`c÷°à}l<|Â~Äw\"·ðvI%r+‹Rà¶\n\\ØùÃÑ][‹Ñ6&Á¸ÝÈ­Ãa”ÓºìÅj¹(Ú“ðTÑ“À·C'Š…´ '%de,È\n–FCÅÑe9C¹NäÐ‚-6”UeÈµŒýCX¶ÐV±ƒ¹ýÜ+ÔR+ºØ”Ë•3BÜÚŒJð¢è™œ±æT2 ]ì\0PèaÇt29Ï×(i‹#€aÆ®1\"S…:ö· ˆÖoF)kÙfôòÄÐª\0ÎÓ¿þÕ,ËÕwêƒJ@ìÖVò„Žµéq.e}KmZúÛïå¹XnZ{G-»÷ÕZQº¯Ç}‘Å×¶û6É¸ðµÄ_žØÕ‰à\nÖ@7ß` Õï‹˜C\0]_ ©Êµù¬«ï»}ûGÁWW: fCYk+éÚbÛ¶·¦µ2S,	Ú‹Þ9™\0ï¯+þWÄZ!¯eþ°2ûôà›—í²k.OcƒÖ(vÌ®8œDeG`Û‡ÂŒöL±õ“,ƒdË\"CÊÈÖB-”Ä°(þ„„„p÷íÓp±=àÙü¶!ýk’ØÒÄ¼ï}(ýÑÊB–kr_Rî—Ü¼0Œ8a%Û˜L	\0é†Àñ‰b¥²šñÅþ@×\"ÑÏr,µ0TÛrV>ˆ…ÚÈQŸÐ\"•rÞ÷P‰&3báP²æ- x‚Ò±uW~\"ÿ*èˆžŒNâh—%7²µþK¡Y€€^A÷®úÊC‚èþ»p£áîˆ\0ð..`cÅæ+ÏŠâGJ£¤¸H¿À®E‚…¤¾l@|I#AcâÿD…|+<[c2Ü+*WS<ˆràãg¸ÛÅ}‰Š>iÝ€!`f8ñ€(c¦èÉQý=fñ\nç2Ñc£h4–+q8\na·RãBÜ|°R“×ê¿ÝmµŠ\\qÚõgXÀ –ÏŽ0äXä«`nîF€îìŒO pÈîHòCƒ”jd¡fµßEuDV˜bJÉ¦¿å:±ï€\\¤!mÉ±?,TIa˜†ØaT.L€]“,JŒ?™?Ï”FMct!aÙ§RêF„Gð!¹Aõ“»rrŒ-pŽXŸ·\r»òC^À7áð&ãRé\0ÎÑf²*àA\nõÕ›Háã¤yîY=Çúè…l€<‡¹AÄ_¹è	+‘ÎtAú\0B•<Ay…(fy‹1Îc§O;pèÅá¦`ç’4Ð¡Mìà*œîf†ê 5fvy {?©àË:yøÑ^câÍuœ'‡™€8\0±¼Ó±?«ŠgšÓ‡ 8BÎ&p9ÖO\"zÇõžrs–0ºæB‘!uÍ3™f{×\0£:Á\n@\0ÜÀ£pÙÆ6þv.;àú©„Êb«Æ«:J>Ë‚‰é-ÃBÏhkR`-ÜñÎðawæxEj©…÷Árž8¸\0\\Áïô€\\¸Uhm› ý(mÕH3Ì´í§S™“Áæq\0ùŸNVh³Hy	—»5ãMÍŽe\\g½\nçIP:Sj¦Û¡Ù¶è<Ž¯Ñxó&ŒLÚ¿;nfÍ¶cóq›¦\$fð&lïÍþi³…œàç0%yÎž¾tì/¹÷gUÌ³¬dï\0e:ÃÌhïZ	Ð^ƒ@ç ý1€Ïm#ÑNów@ŒßOððzGÎ\$ò¨¦m6é6}ÙÒÒ‹šX'¥I×i\\QºY€¸4k-.è:yzÑÈÝH¿¦]ææxåGÏÖ3ü¿M\0€£@z7¢„³6¦-DO34Þ‹\0ÎšÄùÎ°t\"Î\"vC\"JfÏRÊžÔúku3™MÎæ~ú¤ÓŽ5V à„j/3úƒÓ@gG›}Dé¾ºBÓNq´Ù=]\$é¿I‡õÓž”3¨x=_j‹XÙ¨fk(C]^jÙMÁÍF«ÕÕ¡ŒàÏ£CzÈÒVœÁ=]&ž\r´A<	æµÂÀÜãç6ÙÔ®¶×´Ý`jk7:gÍî‘4Õ®áë“YZqÖftu|hÈZÒÒ6µ­iã€°0 ?éõéª­{-7_:°×ÞtÑ¯íck‹`YÍØ&“´éIõlP`:íô j­{hì=Ðf	àÃ[byž¢Ê€oÐ‹B°RS—€¼B6°À^@'4æø1UÛDq}ìÃNÚ(Xô6j}¬cà{@8ãòð,À	ÏPFCàð‰Bà\$mv˜¨Pæ\"ºÛLöÕCS³]›ÝàEÙÞÏlU†Ñfíwh{o(—ä)è\0@*a1GÄ ( D4-cØóP8£N|R›†âVM¸°×n8G`e}„!}¥€Çp»‡Üòý@_¸ÍÑnCtÂ9ŽÑ\0]»u±î¯s»ŠÝ~èr§»#Cn p;·%‹>wu¸ÞnÃwû¤Ýžê.âà[ÇÝhT÷{¸Ýå€¼	ç¨Ë‡·JðÔÆ—iJÊ6æ€O¾=¡€‡ûæßE”÷Ù´‘ImÛïÚV'É¿@â&‚{ª‘›òö¯µ;íop;^–Ø6Å¶@2ç¯lûÔÞNï·ºMÉ¿r€_Ü°ËÃ´` ì( yß6ç7‘¹ýëîÇ‚“7/Ápðe>|ßà	ø=½]Ðocû‘á&åxNm£‰çƒ»¬ào·GÃN	p—‚»˜x¨•Ã½Ýðƒy\\3àø‡Â€'ÖI`râG÷]Ä¾ñ7ˆ\\7Ú49¡]Å^p‡{<Zá·¸q4™uÎ|ÕÛQÛ™àõp™ýši\$¶@oxñ_<Àæ9pBU\"\0005— iä×‚»¸Cûp´\nôi@‚[ãœÆ4¼jÐ„6bæP„\0Ÿ&F2~ŽÀù£¼ïU&š}¾½¿É˜	™ÌDa<€æzx¶k£ˆ‹=ùñ°r3éË(l_”…FeF›ž4ä1“K	\\ÓŽldî	ä1H\r½€ùp!†%bGæXfÌÀ'\0ÈœØ	'6Àžps_›á\$?0\0’~p(H\n€1…W:9ÕÍ¢¯˜`‹æ:hÇB–èg›BŠk©ÆpÄÆót¼ìˆEBI@<ò%Ã¸Àù` êŠyd\\Y@D–P?Š|+!„áWÀø.:ŸLe€v,Ð>qóAÈçº:ž–îbYéˆ@8Ÿd>r/)ÂBç4ÀÐÎ(·Š`|é¸:t±!«‹Á¨?<¯@ø«’/¥ S’¯P\0Âà>\\æâ |é3ï:VÑuw¥ëçx°(®²Ÿœ4€ÇZjD^´¥¦Lý'¼ìÄC[×'ú°§®éjÂº[ E¸ó uã°{KZ[s„ž€6ˆ‚S1Ìz%1õc™£B4ˆB\n3M`0§;çòÌÂ3Ð.”&?¡ê!YAÀI,)ðå•l†W['ÆÊIÂ‡Tjƒè>F©¼÷S§‡ BÐ±Pá»caþÇŒuï¢NÝÏÀøHÔ	LSôî0”ÕY`ÂÆÈ\"il‘\rçB²ëã/Œôãø%P€ÏÝN”Gô0JÆX\n?aë!Ï3@MæF&Ã³Öþ¿,°\"î€èlbô:KJ\rï`k_êb÷üAáÙÄ¯Ìü1ÑI,ÅÝîüˆ;B,×:ó¾ìY%¼J ŽŠ#v”€'†{ßÑÀã„ž	wx:\ni°¶³’}cÀ°eN®Ñï`!wÆ\0ÄBRU#ØSý!à<`–&v¬<¾&íqOÒ+Î£¥sfL9QÒBÊ‡„ÉóäbÓà_+ï«*€Su>%0€Ž™©…8@l±?’L1po.ÄC&½íÉ BÀÊqh˜¦ó­’Ážz\0±`1á_9ð\"–€è!\$øŒ¶~~-±.¼*3r?øÃ²Àd™s\0ÌõÈ>z\nÈ\0Š0 1Ä~‘ô˜Jð³ðú”|SÞœô k7gé\0ŒúKÔ d¶ÙaÉîPgº%ãw“DôêzmÒûÈõ·)¿‘ñŠœj‹Û×Âÿ`k»ÒQà^ÃÎ1üŒº+Îåœ>/wbüGwOkÃÞÓ_Ù'ƒ¬-CJ¸å7&¨¢ºðEñ\0L\r>™!ÏqÌîÒ7ÝÁ­õoŠ™`9O`ˆàƒ”ö+!}÷P~EåNÈc”öQŸ)ìá#ûï#åò‡€ì‡ÌÑøÀ‘¡¯èJñÄz_u{³ÛK%‘\0=óáOŽX«ß¶Cù>\n²€…|wá?ÆF€Åê„Õa–Ï©UÙåÖb	N¥YïÉhŠ½»é‘/úû)ÞGÎŒ2ü™¢K|ã±y/Ÿ\0éä¿Z”{éßP÷YG¤;õ?Z}T!Þ0ŸÕ=mN¯«úÃfØ\"%4™aö\"!–ÞŸúºµ\0çõï©}»î[òçÜ¾³ëbU}»Ú•mõÖ2±• …ö/tþî‘%#.ÑØ–Äÿse€Bÿp&}[ËŸŽÇ7ã<aùKýïñ8æúP\0™ó¡g¼ò?šù,Ö\0ßßˆr, >¿ŒýWÓþïù/Öþ[™qýk~®CÓ‹4ÛûGŠ¯:„€X÷˜Gúr\0ÉéŸâ¯÷ŸL%VFLUc¯Þä‘¢þŽHÿybP‚Ú'#ÿ×	\0Ð¿ýÏì¹`9Ø9¿~ïò—_¼¬0qä5K-ÙE0àbôÏ­üš¡Žœt`lmêíËÿbŒàÆ˜; ,=˜ 'S‚.bÊçS„¾øCc—ƒêëÊAR,„ƒíÆXŠ@à'…œ8Z0„&ìXnc<<È£ð3\0(ü+*À3·@&\r¸+Ð@h, öò\$O’¸„\0Å’ƒèt+>¬¢‹œbª€Ê°€\r£><]#õ%ƒ;Nìsó®ÅŽ€¢Êð*»ïcû0-@®ªLì >½Yp#Ð-†f0îÃÊ±aª,>»Ü`ÆÅàPà:9ŒŒo·ð°ov¹R)e\0Ú¢\\²°Áµ\nr{Ã®X™ÒøÎ:A*ÛÇ.Dõº7Ž»¼ò#,ûN¸\rŽE™Ô÷hQK2»Ý©¥½zÀ>P@°°¦	T<ÒÊ=¡:òÀ°XÁGJ<°GAfõ&×A^pã`©ÀÐ{ûÔ0`¼:ûð€);U !Ðe\0î£½Ïc†p\r‹³ ‹¾:(ø•@…%2	S¯\$Y«Ý3é¯hCÖì™:O˜#ÏÁLóï/šé‚ç¬k,†¯Kåoo7¥BD0{ƒ¡jó ìj&X2Ú«{¯}„RÏx¤ÂvÁä÷Ø£À9Aë¸¶¾0‰;0õá‘à-€5„ˆ/”<Üç° ¾NÜ8E¯‘—Ç	+ãÐ…ÂPd¡‚;ªÃÀ*nŸ¼&²8/jX°\rš>	PÏW>Kà•O’¢VÄ/”¬U\n<°¥\0Ù\nIk@Šºã¦ƒ[àÈÏ¦Â²œ#Ž?€Ùã%ñƒ‚èË.\0001\0ø¡kè`1T· ©„¾ë‚Él¼šÀ£îÅp®¢°Á¤³¬³…< .£>íØ5ŽÐ\0ä»	O¬>k@Bn¾Š<\"i%•>œºzÄ–ç“ñáºÇ3ÙPƒ!ð\rÀ\"¬ã¬\r ‰>šadàöó¢U?ÚÇ”3P×Áj3£ä°‘>;Óä¡¿>žt6Ë2ä[ÂðÞ¾M\r >°º\0äìP®‚·Bè«Oe*Rn¬§œy;« 8\0ÈËÕoæ½0ýÓøiÂøþ3Ê€2@Êýà£î¯?xô[÷€ÛÃLÿaŽ¯ƒw\ns÷ˆ‡ŒA²¿x\r[Ñaª6Âclc=¶Ê¼X0§z/>+šª‰øW[´o2ÂøŒ)eî2þHQPéDY“zG4#YD…ö…ºp)	ºHúpŽ˜&â4*@†/:˜	á‰T˜	­Ÿ¦aH5‘ƒëh.ƒA>œï`;.Ÿ­îY“Áa	Âòút/ =3…°BnhD?(\n€!ÄBúsš\0ØÌDÑ&D“J‘)\0‡jÅQÄyŽhDh(ôK‘/!Ð>®h,=Ûõ±†ãtJ€+¡Sõ±,\"M¸Ä¿´NÑ1¿[;øÐ¢Š¼+õ±#<ìŒI¤ZÄŸŒP‘)ÄáLJñDéìP1\$Äîõ¼Q‘>dO‘¼vé#˜/mh8881N:øZ0ZŠÁèT •BóCÇq3%°¤@¡\0Øï\"ñXD	à3\0•!\\ì8#h¼vìibÏ‚T€!dª—ˆÎüV\\2óÀSëÅÅ’\nA+Í½pšxÈiD(ìº(à<*öÚ+ÅÕE·ÌT®¾ BèS·CÈ¿T´æÙÄ e„Aï’\"á|©u¼v8ÄT\0002‘@8D^ooƒ‚ø÷‘|”Nù˜ô¥ÊJ8[¬Ï3ÄÂõîJz×³WL\0¶\0ž€È†8×:y,Ï6&@”À E£Ê¯Ý‘h;¼!f˜¼.Bþ;:ÃÊÎ[Z3¥™Â«‚ðn»ìëÈ‘­éA¨’ÓqP4,„óºXc8^»Ä`×ƒ‚ôl.®üº¢S±hÞ”°‚O+ª%P#Î¡\n?ÛÜIB½ÊeË‘O\\]ÎÂ6ö#û¦Û½Ø(!c) Nõ¸ºÑ?EØ”B##D íDdo½åPAª\0€:ÜnÂÆŸ€`  ÚèQ„³>!\r6¨\0€‰V%cbHF×)¤m&\0B¨2Ií5’Ù#]ú˜ØD>¬ì3<\n:MLðÉ9CñÊ˜0ãë\0“¨(á©H\nþ€¦ºM€\"GR\n@éø`[Ãó€Š˜\ni*\0œð)ˆü€‚ìu©)¤«Hp\0€Nˆ	À\"€®N:9qÛ.\r!´JÖÔ{,Û'æÙŠ4…B†úÇlqÅ¨ŸXc«Â4ß‹N1É¨5«WmÇ3\nÁF€„`­'‘ˆÒŠxàƒ&>z>N¬\$4?ó›ÃïÂ(\nì€¨>à	ëÏµPÔ!CqÍŒ¼Œp­qGLqqöG²yÍH.«^àž\0zÕ\$€AT9Fs†Ð…¢D{ía§øcc_€GÈz†)ó³‡ Ü}QÆÅhóÌHBÖ¸<‚y!L­“€Û!\\‚²ˆî ø'’H(‚ä-µ\"ƒin]Äžˆ³­\\¨!Ú`M˜H,gÈŽí»*ÒKfë*\0ò>Â€6¶ˆà6ÈÖ2óhJæ7Ù{nqÂ8àßôÉHÕ#cHã#˜\r’:¶–7Ê8àÜ€Z²˜ZrD£þß²`rG\0äl\n®Iˆi\0<±äãô\0Lg…~¨ÃE¬Û\$¹ÒP“\$Š@ÒPÆ¼T03ÉHGH±lÉQ%*\"N?ë%œ–	€Î\nñCrWÉC\$¬–pñ%‰uR`ÀË%³òR\$–<‘`ÖIfxª¯÷\$/\$„”¥\$œš’O…(‹Ë\0æË\0RY‚*Ù/	ê\rÜœC9€ï&hhá=IÓ'\$–RRIÇ'\\•a=EÔ„òuÂ·'Ì™wIå'T’€€‘üÿ©¾ãK9%˜d¢´·‚!ü”ÀÊÊÀÒj…ì¡íÓÊ&Ðæ„vÌŸ²\\=<,œEùŒ`ÛYÁò\\Ÿ²‚¤*b0>²r®à,d–pdŒŒÌ0DD Ì–`â,T ­1Ý% P‘ž¤/ø\ròb¹(Œ£õJÑèÍîT0ò``Æ¾ÞèíóJ”t©’©ÊŸ((dÇÊªáh+ <Éˆ+H%i‡Èô‹²•#´`­ ÚÊÑ'ô£B>t˜¯J€Z\\‘`<Jç+hR·ÊÔ8î‰€àhR±,J]gò¨Iä•è0\n%J¹*ÐY²¯£JwDœ°&Ê–D±®•ÉÐœªR§K\"ß1Qò¨Ë ”²AJKC,ä´mV’»Ž²›ÊÙ-±òÏKI*±r¨ƒ\0ÇL³\"ÆKb(üªóJ:qKr·dùÊŸ-)ÁžË†#Ô¸²Þ¸[ºA»@•.[–Ò¨Ê¼ß4º¡¯.™1ò®J½.Ì®¦u#J“‡Ág\0Æãò‘§£<Ë&”’ðK¤+½	M?Í/d£Ê%'/›¿2YÈä>­\$Í¬lº\0†©+ø—Á‰}-tº’Í…*ê‰Rä\$ß”òÌK».´Á­óJHûÊ‰‡2\r„¿B‚½(PÍÓÌ6\"ü–nf†\0#Ð‡ ®Í%\$ÄÊ[€\nÐnoLJ°ŒÅÓÂe'<¯ó…‡1KíÁyÌY1¤Çs¥0À&zLf#üÆ³/%y-²Ë£3-„Â’ÍK£L¶ÎÉ×0œ³’ë¸[,¤ËÌµ,œ±’«„§0”±Ó(‹.DÀ¡@ÏÁ2ïL+.|£’÷¤É2è(³L¥*´¹S:\0Ù3´ÌíóG3lÌÁaËl³@L³3z4­Ç½%Ì’ÍLÝ3»…³¼!0Š33=Lù4|È—¡à+\"°Êé4´Ëå7Ë,\$¬SPM‘\\±Î?JŠY“Ì¡¹½+(Âa=K¨ì4œ¤³CÌ¤<Ð…=\$,»³UJ]5h³W &tÖI%€é5¬Ò³\\M38g¢Í5HŠN?W1Hš±^ÊÙÔ¸“YÍ—Ø Í.‚N3MŸ4Ã…³`„Ži/P‰7ÖdM>šd¯/LRÎÜâ=K‘60>¯I\0[ðõ\0ßÍ\r2ôÔòZ@Ï1„Û2ÿ°7È9äFG+ä¯ÒœÅ\r)àhQtL}8\$ÊBeC#Á“r*HÈÛ«Ž-›Hý/ØËÒ6Èß\$øRC9ÂØ¨!‚€Å7ük/PË0Xr5ƒ¡3D„¼<TÁÔ’q¯Kô©³nÎH§<µFÿ:1SLÎrÀ%(ÿu)¸Xr—1Ñ€nJÃIÌ´S£\$\$é.Î‡9Ôé²IÎŸÒ3 ¨LÃl”“¯Î™9äÅC•N #Ô¡ó\$µ/ÔésÉ9«@6Êt“²®Nñ9¼´·NÉ:¹’Â¡7ó Ó¬Í:DáÓÁM)<#–ÓÃM}+ñ2ÎNþñ²›O&„ð¢JNy*ŒòòÙ¸[;ñóÎO\"mÚÄóÅMõ<c Â´‚°±8¬K²,´ÓÇN£=07s×JE=Tá³ÆO<Ôô³£Jé=D“Ó:ÏC<Ì“àË‰=äèó®KÊ»Ì³ÈL3¬÷­„LTÐ€3ÊS,œ.¨ÿÏq-Œñsç7Í>‚?ó¼7O;Ü `ùOA9´óñÏ»\$œüÁOÑ;ìý`9ÎnÇIAŒxpÜöE=O¹<ü²5ÏÎ„ý2¸O?d´Ž„´Œ`NòiOÿ>Œþ3½P	?¤òÔOžmœúSðMôË¬·†=¹(ãdã¤AÈ­9“‘\0í#üä²@ƒ­9DŽÁÉ&ÜýòŠ‚?œ “Ði9»\nà/€ñAÝóòÈ­A¤ýSËPo?kuN5¨~4ÜãÆ6††Ø=ò–Œ“*@(®N\0\\Û”dGåüp#è¤> 0À«\$2“4z )À`ÂW˜ð +\0Š‘80£è¦• ¤ª”äz\"TÐä0Ô:\0Š\ne \$€ŽrM”=¡r\n²N‰P÷Cmt80ðú #¤ØJ= &ÐÆ3\0*€Bú6€\"€ˆéèú€#Ì>˜	 (Q\nŒðê´8Ñ1C\rt2ƒECˆ\n`(Çx?j8N¹\0¨È[À¤QN>£©à'\0¬x	cêªð\nÉ3×Chü`&\0²Ð´8Ñ\0ø\näµ¦úO`/€„¢A`#ÐìXcèÐÏD ÿtR\n>¼ÔdÑBòD´LÐÄÌõ‰äÐÍDt4ÐÖ j”pµGAoQoG8,-sÑÖðÔK#‡);§E5´TQÑGÐ4Ao\0 >ðtMÓD8yRG@'PõC°	ô<PõCå\"”K\0’xüÔ~\0ªei9Ðìœv))ÑµGb6‰€±H\r48Ñ@‚M‰:€³FØtQÒ!H•”{R} ôURpÍÔO\0¥I…t8¤ØðûÎÇ[D4FÑD#ÊÑ+D½'ôMÊ•À>RgIÕ´ŠQïJ¨””UÒ)EmàüTZ­Eµ'ãê£iEÝ´£ÒqFzAªº>ý)T‹Q3HÅ#TLÒqIjNT½¼…&CøÒhX\nT›ÑÙK\0000´5€ˆ¢JHÑ\0“FE@'Ñ™Fp´hS5F\"ÎoÑ®e%aoS E)  €“DU «Q—FmÎÑ£M´ÑÑ²e(tnÒ “U1Ü£~>\$ñßÇ‚’­(hÕÇ‘Güy`«\0’ê 	ƒíG„ò3Ô5Sp(ýõPãGí\$”œ#¤¨	©†©N¨\nôV\$ö]ÔœPÖ=\"RÓ¨?Lzt·ƒ1L\$\0ÔøG~å ,‰KNý=”ëÒGMÅ”…¤NS€)ÑáO]:ÔŠS}Ý81àRGe@Cí\0«OPðSõNÍ1ôÝT!P•@ÑÝS€ðÿÕS‰G`\nÉ:€“P°j”7R€ @3üÑ\n‘ üã÷â£”DÓ æúLÈÏ¼Ž 	èë\0ùQ5ôµ©CPúµSMP´v4†º?h	hëT‡D0úÑÖàõ>&ÒITxôO¼?•@U¤÷R8@%Ô–ŒõK‰€§NåKãóRyE­E#ýù @ýÃøä%Là«Q«Q¨µ£ª?N5\0¥R\0úÔTëFåÔ”RŸSí!oTEÂC(Ï¶ÈýÄµ\0„?3iîSS@U÷QeMµƒ	KØ\n4PÕCeS”‘\0NC«P‚­Oõ! \"RTûõ€S¥NÕÁU5OU>UiIÕPU#UnKPô£UYTè*ÕC«U¥/\0+º¸Å)ÈÚ:ReAà\$\0øŽ¤xòÇWDº3Ãêà`üÚüçU5ÒIHUY”ô:°P	õe\0–MJi€ƒµÃýQø>õ@«T±C{›ÕuÑì?Õ^µv\0WR]U}Cöê1-5+Uä?í\rõW<¸?5•JU-SXüÕLÔß \\tÕ?ÒsMÕb„ÕƒVÜt§TŒ>ÂMU+Ö	EÅcˆÏÔ9Nm\rRÇƒCý8ŽSÇX•'RÒéXjCI#G|¥!QÙGh•tðQ¸ý )<¹YÐ*ÔÐRmX0üôö½M£›õOQßYýhÀ«ßduÕ¤ÕZ(ýAo#¥NlyN¬V€Z9IÕºM•¦V«ZuOÕ…TÕTÅEÕ‡Ö·SÍeµµÖÊ\nµXµªSÛQERµ³ÔÙ[MF±VçO=/õ­¨>õgÕ¹TíVoUT³Z’N€*T\\*ÃïÐ×S-pµSÕÃVÕq€ÒM(ÏQ=\\-UUUV­C•Ä×ZØ\nu’V\$?M@UÎWJ\r\rUÐÔ\\å'U×W]…W”£W8ºN '#h=oCóÐýF(üé:9ÕYu•†¤÷V-UÓ9Ÿ]ÒC©:U¿\\\nµqW—™à(TT?5Páª\$ R3ÕâºŸC}`>\0®E]ˆ#Rêà	ƒÿ#R¥)²W–’:`#óGõ)4ŠRÀý;õáViD%8À)Ç“^¥Qõé#”h	´HÂŽX	ƒþ\$Nýx´š#i xûÔ’XRõ€'Ô9`m\\©†¨\nEÀ¦Q±`¥bu@×ñN¥dT×#YYý„µ®GV]j5#?L¤xt/#¬”å#é…½O­PÕëQæ¢6•££Ï^í† €šŽðüÖØM\\R5t´Óšpà*€ƒXˆV\"WÅD€	oRALm\rdGN	ÕÖÀú6”p\$PåºŸE5Ôý†©Tx\n€+€‹C[¨ôVŽŒýÖ8U•Du}Ø»F\$.ªËQ-;4È€±NX\n.XñbÍ•\0¯b¥)–#­NýG4KØÐZS”^×´M¶8Øód­\"C‚¬>ÅÕdHe\nöY8¥Ñ.ê ú°ˆÒFúD”½W1cZ6”›QâKHü@*\0¿^¸úÖ\\QßF‚4U3Y|‘=˜Ó¤éE›ÔÛ¤¦?-™47YƒPm™hYw_\ršVe×±M˜±ßÙe(0¶ÔFÕ\r !ÒPUI•uÑ7Qå•CèÑŽ?0ÿµÝgu\rqà¤§Y-Qèó°èú=g\0…\0M#÷U×S5Zt®ÖŸae^•\$>²ArV¯_\r;tî¬’¨”HW©Zí@HÕØhzDèÚ\0«S2Jµ HIåO 'ÇeígÉ6¹[µR”<¸?È /ÒKM¤ö–Ø\n>½¤HáZ!iˆö¤ŸTX6–Ò×iºC !Ó›g½à ÒG }Q6žÑ4>äwà!Ú™C}§VBÖ>åªUQÚ‘jª8cïUTàû–'<‚>ÈýõôHC]¨VšÑ7jj3v¥¤å`0ÃèÈ23ö°Ðòxû@U—k \n€:Si5žÕ#Yì-wî”ÕàéM?céÒMQÅGQÕÑƒb`•ò\0Ž@õËÒ§\0M¥à)ZrKXûÖŸÙWl­²öÍlå³TM×D\r4—QsS¥40ÑsQÌõmYãh•d¶ÂC`{›V€gEÈ\n–»XkÕà'Óè,4ú¼¹^í¢6Æ#<4éNXnM):¹·OM_6d€–æõ¸Ãõ[\"KU²nžÖ?l´x\0&\0¿R56ŸT~> ô†Õ¸?”Jnž€’ ˆÏZ/iÒ6ôÎÚglÍ¦ÖUÛáF}´.ž£¼JLöCTbMŽ4ÍÓcLõTjSD’}JtŒ€Z›ªµÇ:±L­€´d:‰Ez”Ê¤ª>ÖV\$2>­µŽ¢[ãpâ6öÔRŽ9uêW.?•1®£RHužèÛR¸?58Ô®¤íDÝÆuƒ£çpûcìZà?œr×» Eaf°}5wY´ëå‚Ï’ÒêÅW‚wT[Sp7'Ô_aEk \"[/i¥¿#ÿ\$;m…fØ£WOüô”ÔFò\r%\$Íju-t#<Å!·\n:«KEA£íÒÑ]À\nUæQ­KEÀ #€¿Xå¨÷5[Ê>ˆ`/£ÍDµÊÖ­VEpà)åI%ÏqßÜûníx):¤§le¢´Õ[eÕ\\•eV[j…–£éÑ7 -+ÖßGWEwt¯WkEÅ~uìQ/mõ#ÔW—`ýyu“Ç£DÝAö'×±\r±•Õ™OD )ZM^€³u-|v8]‹g½‘hö×ÅLà–W\0øÈû6ËX†‘=YÔd½Q­7Ï“”Ï9£çÍ²r <ÃÖêD³ºB`c 9¿’È`D¬=wx©I%ä,á„¬†è²àêƒj[ÑšÖíßOÿ‹´ ``ŽÅ|¸òòÆÞø¤Œ˜¼í.Ì	AOŠÀÄ	·‰@å@ 0h2í\\âÐ€M{eã€9^>ô•â@7\0òôË‚W’€ò\$,íÉÅš¡@Ø€Òâ•å×w^fmå‰,\0ÏyD,×^X€.¯Ö†©7ã·›Ã×2ÝÅf;¥€6«\n”¤Ž…^ŸzC©×§mz…én–^ˆô”&LFFê,°ö[€¥eÈõaXy9h€!:zÍ9còQ9bÅ !€¦µGw_WÉg¥9©ÓS+t®ÚápÝtÉƒ\nm+–œÞÙ_ð	¡ª\\¼’k5£ÒÜ]Æ4ˆ_h•9 Ù÷N…—Å]%|¥ˆ7ËÖœŽ];”ï|ñµ ßXýÍ9Õ|åñ×ÌG¢“¨[×Ô\0‘}Uñ”çßMCI:ÒqO¨VÔƒa\0\rñRÍ6Ï€Ã\0ø@H¢ÅP+rìS¤Wãè€øp7äI~p/ø HÏ^Ýê²ü¤¬E§-%û¥Ì»Í&.ÎÄ+¸JÑ’;:³¶«!“ýÐNð	Æ~öª‰€/“WÄÂ!„BèL+Â\$ðíq§=ü¿+Ñ`/Æ„e„\\±ÒÏxÀpE‘lpSÂJSÝ¢½ö6à‡_¹(Å¯©Äéb\\OÆÊ&ì¼\\Ð59\0ûÂ€9nñøD¸{¡\$á¸‹K‘v2	d]èv…CÕþÅÕ?tf|WÜ:£Ô¨p&¿àLn„Îè³žî{;ˆçÚGR9øT.y¹üïI8€¹´\rl° ú	Tè n”3¼öðT.ƒ9´è3› š¼Zès¡¯ÑÒGñþŽˆ:	0£¦£zè­Ý.Œ]ÀçÄ£Q›?àgT»%ñ™ÕxŒÕŒ.„šÔÇn<ì£-â8BË³,Bòì˜rgQþ¢íßó„ÉŽ`Úá2é„:îµ½{…gëÄs„øgóZ¿•… ×Œ<æ×w{¦˜ƒbU9ˆ	`5`4„\0BxMpð‘8qnahé†@Ø¼í†-â(—>S|0®…¾¥…3á8h\0Ñ«µCÔzLQž@¶\n?†¸`AÀ >2šÂ,÷á˜ñN&Œ«xˆl8sah1è|˜B‡É‡DxBÞ#V—‹V–×Š`Wâa'@›‡¬	X_?\nì¾  •_â. ØP¼r2®bUarÀI¸~áñ…S“àú\0×…\" 2€ÖþÀ>b;…vPh{[°7a`Ë\0êË²j—oŒ~·ûþvÍÙ|fv†4[½\$¶«{ó¯P\rvæBKGbpëÈÅø™–OŠ5Ý 2\0j÷Ù„LŽ€î)ÇmáÈV¡ejBB.'R{C¤ïV'`Ø‚ ‰Ž%­Ç€Ð\$ Oå\0˜`‚’«4 ÌNò>;4£³¢/ÌÏ€´À*Âø\\5„ÅÁ!†û`X*Þ%îÄNÍ3SõAMôþËÆ”,þ1¬²®í\\¯²caÏ§ ³ù@Ø¬Ëƒ¸B/„¬Íø0`óv2ï¡„§Œ`hDÅJO\$ç…@p!9˜!¥\n1ø7pB,>8F4¯åf Ï€:“ñ7Â„î3›£3…¿à°T8—=+~Øn«Îâ\\Äe¸<br·þ øFØ²° ¹C¡N‹:c€:Ôl–<\r›ã\\3à>ñ˜‡À6ONnŠä!;áñ@›twë^Fé€Là;€×º,^aÈ\ra\"ÞÀÚ®'ú:„vàJe4Ã×;•ñ_d\r4\rÌ:ÛüÀ¬S˜à2€[c€„XÿÊ¦Pl˜\$¹Þ£i“wåd#ŽB šb›Î×¤õ’™`:†€Ï~ <\0Ñ2Ù·—‘RŒÂÆPÈ\r¸J8D¡t@ìEŽè\0\rÍœ6öóäÞ7•½ä˜YÏ£ú\"åäÀš\rüƒ¦Àš3ƒ¡.˜+«z3±;_ÊŸvLÝäÓwJ¿94ÀIJa,A¦ñˆ¯;ƒs?ÖN\nR‡!Ž§Ý†Om…sÈ_æà-zÛ­w„€ÛzÜ­7¡ÍÅzî÷–M”ˆ€o¿”¥æ\0¢ƒa”ÅÝ¹4å8èPfñYå?”òi—–eBÎSà1\0ÉjDTeK”®UYSå?66R	¦cõ6Ry[c÷”°5Ù]BÍ”ÖRù_eA)&ù[å‡•XYRW–6VYaeU•fYeåw•ŽU¹båw”Eë°Ê†;z¤^W«9–ä×§äÝ–õë\0<Þ˜èeê9SåÎ¤daª	”_-îá‰L×8Ç…ÍQöèTH[!<p\0£”Py5ˆ|—#ê‘P³	×9vàš2Â|Ç¸áfao†á,j8×\$A@kñƒ¿ŽaË‘½bócñÈf4!4¨‘¶cr,;™‘æ‘öbÆ=€Â;\0°øÅº…˜†cdÃæX¾bìx™a™Rx0Aãh£+wðxN[˜ÜB·pÚƒ¿w™TÀ8T%™šMšl2à‡½¡šð—}¡Ès.kY„˜0\$/èfU€=þØs„gKÃ¡ˆM› õ?ÿ›ç`4c.Ôø!¡&€åˆ†g°ûfà/þf1=¯›V AE<#Ì¹¡f\n») Šë›Npò“ã`.\"\"»Açœ¤ã—üq¸X“ Ù¬:aÉ8™¹f¯™Vsó‹G™ÞrŽ:æVÞÆcÔgVl™g=`ã“WŽËýyÒgUÀË™ªáº¼îeT= ã€á€Æx 0â M¼@ˆ»šÂ%Îºb½œþw™ÆfÛÙOøç­˜Ü*0¯…®|tá°%±™PÈÍpæúgKžù¬?pô@JÀ<BÙŸ#­`1„î9þ2çg¶!3~ØÜçînläÅfŠØVhù¬Ž.Ñ€à…aCÑù•?³Šû-à1œ68>A¤ˆaÈ\r—¦y‹0 Öi‘J«} à¹© Ðz:\r¡)‘Sþ‚¡@¢åh@äöƒY¹ã´mCEg¡cyÏ†‚<õàÍh@¼@«zh<WÙÄ`Â•¨±:zOãÎÖ\rÍêW«“°V08Ùf7™(Gyƒ²`St#ï„f†#ƒ²œC(9ÈÂ˜Ø€dùææ8T:¯»Œ0ºè qµ  79·á£phAgÜ6Š.ãæ7Fr™bä ÈjšèA5î…†ƒá¡a1úÚh•ZCh:–%¹ÎgU¢ðD9ÖÅÉˆ„×¹Ïé0~vTi;VvSš„wœØ\rÎƒ?àÇf²£…ÿ¥nŠÏ›iY™ìaº¬3 Î‡9Õ,\n™Ãr‘‰,/,@.:èY>&…šFÑ)ú™¶}šb£€èiOÝiæš:dèAŒn˜šc=¤L9O’h{¦ 8hY.’ÙÀ®¾‡®‡…œüÇ\r¬Ö‡£À›Šé1Q¯U	”C‘hô†eÿO‰›°+2oÌÎìÞN‹˜÷§øzpè¢(þ]Óh€å¢Z|¬O¡cÑzDáþ;õT\0j¡\0…8#>ÎŽÁ=bZ8Fjóìé;íÞºTé…¡w®Í)¦ýøN`æë¨¤Ã…B{ûƒz\ró¡c“Óè|dTG“iœ/ûú!i†Ê0±¼ø'`Z:ŠCHï(8Âê`V¥™Úãöª\0Üê§©†£WïßÇª˜ÕzgG¾‘…ƒ½²-[ÃÐ	iœêN\rqºé«n„„“o	Æ¥fEJý¡apb¹ê}6£…Õ=o¤–„,tèY+ö®EC\rÖPx4=¼¾™Ù@‡‰¦.†‘F£[¡zqçÜèX6:FG¨ #°û\$@&­ab¤þhE:²ƒå¬ä`¶S­1—1g1©þ„2uhY‹¬_:Bß¡dcï–*ÿ­†\0úÆ—FYFœ:Ë£ªn„ØÌ=Û¨H*Z¼Mhk/ëƒ¡žzÙ¹ï‹´]šÁh@ôæ©Øã1\0˜øZKùž¢ëÎÆè^+º,vfós®š>ˆ¤’Oã|èÀÊsÃ\0Öœ5öXé‹îÑ¯F„÷n¿Aˆr]|ÏIi4è…þ ØÂC° h@Ø¹´Ÿž–cß¥¨6smOÃå‰™›gX¬V2¦6g?~ÖÃYÕÑ°†súcl \\RŠ\0Œ¨cœA+Œ1°„›ùÌé\n(ÑúÃÌ^368cz:=z÷‚(äø ;è£¨ñsüF¶@`;ì€,>yTßï&–•d½L×Ÿœÿ%Òƒ-ëCHL8\r‡Çbû°°£úMj]4Ym9üÛüÐZÚBøïP}<ŸûàX²¯‰Ì¥á+gÅ^ØMÞ + B_Fd¬X„ø‹lówÈ~î\râ½‹è\":ÔêqA1X¾ìæ²Ðø¯3ÖÎ“Eáh±4ßZZÂó¸& …ææ1~!Nfã´öo—ˆ™\nMeÜà¬„îëXIÎ„íG@V*X¯†;µY5{Vˆ\nè»ÏTéz\rF 3}m¶Ôp1í[€>©tèe¶w™Ÿæë@VÖz#‚2Äï	iôôÎ{ã9ƒ‚pÌ»gh‘Šæ+[elU‰¦ÛAßÙ¶Ó¼i1Ä!Œ¾ommµ*Kà‡ê}¶°!íÆ³í¡®Ý{me·f`“—mè˜CÛz=žnÞ:}g° T›mLu1FÜÚ}=8¸ZáíèOžÛmFFMf¤…OO€ðîáÀ‹ƒèøß/¼éõ¸Þ“šå€þV™oqj³²èn!+½òµüZ¨ËI¹.Ì9!nG¹\\„›3a¹~…O+Îå::îK@Œ\nÚ@ƒ‘¤Hph‘´\\BÄõdmfvCèžÓPÛ\" æ½Û.nW&–ên¢øHYþ+\r¶“Äz÷i>MfqÛ¤î­ºùÝQc‚[­H+æÀo¤Ñ*ú1'¤÷#ÄEw€D_Xí)>Ðs£„-~\rT=½£žà÷ˆà- íy§m§¹æð{„hóŸÌjÚMè)€^ž¹ïÀ'@Vå¡+iÈîÎò›Ÿåµ†É;F“ D[Îb!¼¾´B	¦¤:MP‹îóÛ­oC¼vAE?éC²IiYÍ„#þp¶P\$kâJÞq½.É07œþöxˆl¦sC|ï½¾bo–2äXª>Mô\rl&»Ç:2ã~ÛÑcQ²îò²æoÑÞdá‚-þèUÜRo‚YšnM;’n©#–ß\0–P¾fðÚPo×¿(CÚv<Ê¬ø[òoÛ¸”šû×fÑ¿ÖüÁ;ßáº–õ[úYŸ.o®Up¿®pUŒø”.ž ©B!'\0‹òã<Tñ:1±À¾ šã¤î<„›ðnˆîF³ðƒI¢Ç”´‚V0ÊÇRO8‰wøÎ,aFú¼É¥¹[´ÎŸ…ñYOù«‰€/\0™Ùox÷ÇQð?§°:Ù‹ëÆè`h@:ƒ«¿öÑ/Mím¼x:Û°c1¤Öàû¯ív²;„‚è^æØÆ@®õ@£úð½ÂÇ\n{¯¼Âî‹à;ç‘´B¼í¸8‘º gå’ä\\*gåyC)Û„E^ýOÄh	¡³¦Aƒu>Æèü@àDÌ†Yæ¼í›â`o»<>Àƒp‰™ŠÄ·’q,Y1Q¨Áß¸†/qgŒ\0+\0âæå‡Dÿƒç?¶þ î©Úßîk:ù\$©û¬í×¥6~I¥…=@ŽíÑ!¾ùvÚzOñš²â+ÍõÆ9Çi³–›¼aïð†êû…gòðôî¿—¹ÿ?š0Gn˜q²]{Ò¸,FáÃøO¡â„Þ <_>f+¢,ñÌ	»Ôñ±&ôœ†ðíÂ·¼yêÇ©Oü:¬UÂ¯ˆLÆ\nÃÃºI:2³¿-;_Ä¢È|%éå´¿!Îõfž\$¦ˆ†Xr\"Kniîñ—ÀÐ\$8#›g¤t-›€r@LÓåœè@S£<‘rN\nD/rLdQkà£“”ªõÄîeðåäãÐ­åø\n=4)ƒB˜”Ë×šôÌZ-|Hb¡†‘HkÊ*	ÖQ!Ð'êG ž›Ybt!¿Ê(n,ìP³OfqÑ+X“Y±ÿ‚ë\"b F6ÖÌr fò\"ÒÜ³!N¡ó^¼¦r±B_(í\"¨KÊ_-<µò *Q÷ò¨Ù/,)H\0„‰²rç\"z2(¹tÙ‡.F>†‡#3â®Ø¦268shÙ þ¨Æ‘I1Sn20¶çÊ-«4’ÚÇ2Aœs(¬4ä¼Ë¶Š\0ÆÝ#„årþK'ËÍ·G'—7&\n>xßüÜJØGO8,ó…0¼â‹ù8”ÑÓ\0óW9’ÝIˆ?:3nº\r-w:³ÂÌÅ×;3È‰”!Ï;³Üêƒ˜˜Z’RMƒ+>ÖÜðÊé0/=R…'1Ï4Õ8ûÑÏmÿ%È¥}Ï‡9»;‚=ÏnQöã=ÏhhLõ·GÏkWÎ\rô	%Ø4ÒœsñÎ–J€3sÛ4—@™U‚%\$ÜÑN;Ì?4­»óNÚÏ2|ÊóZÚ3Øh\0Ï3“5€^Àxi2d\r|ûM·Ê£bh|Ý#vÇ` \0”ê®äàû\$\r2h#ú¤?³ˆI\n’¼+o-œŠ?6`á¹½¿.\$µšøKY%ØÂJ?¦c°RN#K:°KáELÁ>:Á¥@ŒãjP‘Ìn_t&slm’'æÐ©É¸Óœ²Œ½—ã;6Û—HU5#ìQ7U ýWYÜU bNµ–Wû_ûª©;TCø[Ý<Ú–>ÅÇõ‰WýCUÔ6X#`MI:tùÓµ€ö	u#`­fu«\$«t­öXó`f<Ô;båghöÑÕ9×7ØS58õ¬Ý#^–-õ\0êÀúîÕ¹R*Ö'£¨(õðõqZå££êX¹QÝFUvÔW GWíñÓTêÇWô~Ú­^§WöÄÁÕýJ=_Ø—bmÖÝbV\\l·/ÚMÕÿTmTOXuÊ=_ýITvvu‹a\rL_ÕqR/]]mÒsu=H=uÑg o\\UÕ…gM×	XVU À%õhý¡53U™\\=¡öQßØM¹v‡€¡gåmàõue¡ˆÙûhÿbÝMÝGCeO5®ÔÖO5…ÔYÙi=eÕ	GTURvOa°*ÝivWX•J5<õ¯bu ]ˆ×Öðúµ<õÃÙÕ\$u3v#×'eöuÑR5m•Šv‹D5.vŽŒõW=ŸU_å(´\\VØÏ_<õ÷SÍn)Ü1M%QháZ‡T…f5EÕ'ÕÍW½ŠvÅUmiÕ‚UÔÕ]aW©U§dRváÙ-YUZuÙUV—UiRV™õ³ÓÇ[£íZMU§\\=Âv{ÛXýµ¼wQ÷huHvÇ×gqÝ´w!Úoqt¢U{TGqý{÷#^G_ubQ„êå•i9Qb>ÚNUdº±k…½5hPÙmu[•\0¦êÅ_¶é[õY-ðô÷rõÈÕ(ÖCrMeýJõ!h?QrX3 xÿÈÏ#‡÷xÖ<Û{u5~ƒíÑ-ÝuŽëYyQ\r-”î\0ùuÕ£uuÙ¿pUÚ…•)–PåÜ\r<u«S›0ÝÉw¹ß-iÝóÔ!ÌÖŠøB÷áÆd]ùèÅ‡ÔÆEêðvlmQÝ6k¼ÒJ´ˆwí¦ÄžØÃãŒED¶UÙR“ev:XßcØNW}`-¨tÓH#e„bº±u€ãó	~B7ê ?ƒ	OPœCWµ×SEÍ•V>¶“×UÛ7ßžç‰Ôám»Ó‚¬zÿ=µƒÍØ1º™ƒ+ ¹mÃI,>µX7àä] .‡½*	^îŠã°N…º.èÎ/\"„˜)Ð	…¯‚sž®|à¤çÓŸÐlÁ}ã¸ŽÍç!óîƒ‘5n±p„j£¾h’}½èðm“EázHÂaO0d=A|wëß³ãë×šÎìu²œŸvùØ¼G€x#®…b”cSðo-‰ùtOm`C‹ò^MŒÅ@ë´h­n\$k´`þ`HD^PEà[äŒ]¹¨rR¸mž=‚.ñÙ‡>Ayi‚ \"ú€ò	Ö·oã-,.œ\nq+À¥åfXdŠ«¶ã*ß½ˆKÎØƒ'Üê Ð%aôÿ‡ù9pûæ—øKLM„à!þ,èÊËŽ¨ŒzX#˜Vá†uH%!Àœ63œJ¾ryÕíùq_èu	úWù±‡Æ|@3b1åÈ7|~wï±³þíA7“ÒÂ›è™	¼™9cS&{ãäÒ%VxðïkZO‰×w‰Ur?®„’ªN Î|…CÉ#Å°õåÕ¯ ¹/ú™9ftŽEw¸CÁºa¦^\0øO<þW¦{Yã=éŸeë˜ýnÉ„ígyf0h@ìSÝ\0:C©´^€¸VgpE9:85Ã3æÞ§áºð@»áŽj_ª[Þ+«êÇ©xƒ^“ê®†~@Ñ‡Wª¸ãã“œ†9x—FC˜¿­.ãšçöük^IŽû¡pU9üØSŸØ÷½—œ\$óóø\r4´…ù\0ÎèO°ã‘Ä)L[Âp?ì.PECSìI1nm{Å?žPîWAß²Á;€ñìD°;SºaKføò›%?´XõÞ+¤B>½ù9¿¯ÙGj˜cžz‘AÍŽ÷:êa³n0bJ{o¥·!3À­!'’ØKÃÅíùÔ}ã\\èÎ3Wøê5îxÏÉÁL;ƒ2Î¶n—a;²í×ºXÓ›]Éoºœxû{ä¦5Þ™jX÷ˆð—¶vÓšéãqÞÊEE{Ñ€4Á¾öÄ{íÙç	Ì\nöÊ>ù™aï¯·¾üì§ïØLûÔûåïÿ½ûìñ'ð½Þé{ë\n‰—>JøßŒŒá¸Ó—†÷YÏ\rOÊ½ð‘t¯ÿû¥-OÃ¦ü4Ôÿ9Fü;ð§Á»ÔüGðøIªFßì1ÂoÿßóñO²¾éa{w—0Ó»ï¤Æ¯;ñ”„‘lüoñàJÐTb\rwÇ2®Jµþ=D#ònÁ:ÉyñûSø^ã,.¿?(ÈI\$¯ÊÆ¯í¨á3÷Ãsð4MÊaCRÉÆÍGÌ‘œúIß°n<ûzyÑXN¾ð?õâ.Ãî=—àñ´DÇ¼\r›žØé\nÕó¨\roõý\nÐŸCl%ÁÍYÎû¥ß°ÏàGÑþÚ}#VÐ%ý(ÔÿÒà3æÉ˜ržð};ôû×¿GÉÌnö[ª{¥¹–“_<m4[	I¥¢À¼q°µ?ð0cVýnms„³nMõõˆ\"Nj1õw?@ì\$1¦þ>ðÒ^øÕû¥ö\\Ì{nÂ\\Ìžé7Ÿ„¿ÙŸic1ïÚÿhooê·?j<GöxŸlÏù©Sèr}ÍÃÚ|\"}•÷/Ú?sç¬tIäåê¼&^ý1eóÓtãô,*'F¸ß=/Fkþ,95rVâáøàÀºì‘ˆÛo9Íø/FÀ–_†~*^×ã{ÐIÆö¯ã_ƒ‚²Œ“^n„øþNŸŠ~øáÅAí¦‘d©åñþUøwäqY±åî´T¸2ÀéGä?‡&–§æô:yùè%Ÿ–Xç˜JÛCþd	WèßŽ~úG!†´J}›—¤úìùõÄB-Óï±;îûœhÃ*ó¼R´ìöE¶ ~âæó.«~Éçæ SAqDVxÂîÍ='íÉEÙ(^Šû¢~›ùø¿›çòéçïo7~‚M[§Qãî(³Üy¸ùnPÑ>[WX{qÔaÏ¤ÆÉý.&NÚ3]ñúHYïÝûƒëÛ[¶ÁÙ&ü8?Ñ3„‹›¦¶§Ý†Ú»¶á#Œ¦ÎBðe6ë…@–“[°¤£ûàÐG\rÎ+ý§}ü˜÷ÁÿÏ_Ýç7–|N„§«Þ4~(zÁ~“»¹ï§%›–?±ßÓÈ[¹ø1žSª]xØköÑKxO^éA€‰rZ+ºÿ»½*ÂWö¯kþwD(¹ø»R:æý\0•§íù'¤Šó“m!OÐ\näÅuè‚Æó.[ PÆ!¹²}×Ïm Ûï1pñuüâ,T©çL 	Â€0}â&PÙ¥\n€=Dÿ=¾ñÐ\rÂšA/·o@äü2ãt 6àDK³¶\0ÈÂƒq†7„l ¼ðBêŠúÌ(ƒ;[ñˆkr\r‘;#‘ÃäƒlÅ”\r³<}zb+ÔÐOñ[€WrXƒ`Z Å£†Pm'Fn ¼‰îSpß-°\0005À`d¨Ø÷P„ÁÚÇ¾·Û;²Ìn\0‚5fïP„¿EJäwûÛ ¹.?À;¶§NòÞ¥,;Æ¦Ï-[7·ÞeþÚiÅâ-“ÖîdÙŽ<[~”6k:&Ð.7‡]\0ó©ûë–ù/µ59 ñÁ@eT:ç…˜¯3ÅdsÝú5äœ5f\0ÐPµöHB–•í°½º8JÔLS\0vI\0ˆ™Ç7DmÆaž3e×íŽ?B³ª\$´.E‹ÐfË@ªnúƒ‰bòGbÁÏq3Ÿ|üšPaËˆøÏ¯X7Tg>Â.ÚpØï™’5¸«AHÅµ’Š3Sð,˜Á@Ô#&wµî3†ôm[ÏÀòIíÑ¥Ó^“Ì¤J1?©gTá½#ÏS±=_„‚_±	«£ÉVq/CÛ¾·Ý€Î|ËôáþD ƒg>Ü„õëé 6\rŠ7}q”ÆÅ¤‹JGïB^î†\\g´Ýõüœ&%­Ø[ª2IxÃ¬ªñ6\03]Á3Œ{É@RUàÙMö v<å1Š¿‘¾sz±uP’5ŸªF:Òiî|À`­qÓ÷†V| »¦\nkâ}Ð'|Žgd†!¨8¦ <,ëP7˜m¦»||»ÿ¶IŽAÓ]BB ÏFö0XÏú³	ŠDÖß`W µÁqm¦OL‘	ì¸.Í(Áp‚¼Òä¶\"!‹ýª\0âÍAïÃô‡‰ÁV€–7kƒŒM¸\$ÓN0\\Õ§ƒ\"‹f‘á Çëñ È\0uqž—,Œ 5ÆãA6×pÎÎÈ\nðÎjY³7[pK°ð4;lœ5n©Á@â\\fûÐl	¦‚MöùûPÁç3®—C HbÐŒ©¸cEpP‰ÚÐ4eooeù{\r-àš2.ÔÖ¥½ŒP50uÁ²°G}Äâ\0îËõ¨<\röœ!¸œ~Êýµ¾óñ¹\n7F®d¶ýà“œ>·Ôa¢Ù%ºc6Ôž§õMÀ¥|òàd‹û·ìOÓ_¨?J„æªC0Ä>ÐÁ&7kM4ª`%fílðÎ˜B~¢wxÑÚZGéP†2¯à0ü=ž*pð†@ˆBeÈ”ØÏ|2Ä\r³?q¸Ð8í¸ë±ñÍÐŠ(·yráö 0àî>œ>ÀE?wÜ|r]Ö%AvàýÁÅä@Ž+ÝXÁªAgâÉÛÿsû®CÐûAXmNÒú4\0\rÚÍ½8JÝJðÇ¸DÒšó´:=	•ðó‡ëÆS™4¯ñF;	¬\\&Öè†P!6%\$iäxi4c½0Bá;62=ÚÛ1ÂùÌˆPCØåÂƒmËÍ“dpc+Ò5Šå\$/rCR†`£MQ¤6(\\á2A ¦¹\\ªŒlGòl¬\0Bq°¤P¯r²ûøBµ‰ê›Ñ‚¹_6LlË!BQŽ‰IÂŽGÀåÜØðXRbs¡]B—Hržã˜`ÎX‹ä\$på±8ð„•	nbR,Â±…L \"ÂE%\0’aYB¦sœ…ÍD,!Æ×Ï›pN9RbG·4ÆþM¬Œt…¸œ¬jUô¤À§y\0ìÝ%\$.˜iL!xÂìÒ“Å(Ä.‘)6T(’I…ìa%ÒKÈ]mÄt¥ô…ú&‚óG7ÇITMóBú\rzaÂØ])vaˆ%œ†²41TÁjÍ¹(!…¬Þ¡¨\\\\ÆWÂÜ\\t\$¤0Åæ%á”\0aK\$èTšF(YàC@‚ºHÏŽÐHã€nD’dÃ†Wp˜ÉhZ¯'áZC,/Ž¡\$û¦£—J¡FB¨uÜ¬Q:Î¥ÂAö‰:-a#”ì=jb¨§lÕUg;{R°€Uº±EWnÔUa»Vâî•Nj¬§u‹GÉ*¨yÖ¹%ÝÒ@Åï*Ìä«ÕYxê±_ó²§z€]ë)v\"£çRÕåL¯VIvê=`›¾'ª°UÝ) S\r~R˜•™\ni”Å)5S¦åD49~Êb”;)3‡,¦9M3¯HsJkTœÃœ‡(¢†ú—uJ‰][\$uf¨íob£µ¹\n.,îYÜµ9j1'µŒ!ö1\$J¶‘gÚ¤ÕŸÄ†U0­ÓZuah£±·cH¥,ÃYt²ñKbö5—ë5–’/dY¬³AUšÒ…©‹[W>¨_Vÿ\rˆ‘*·õ©j£§-T±… zÖYÊd•c®m‡Ò¹±Ø:¹€üË[Ut-{ªµýl	£i+a)».[º•_:Ú5žähƒò­WÂ§Ém»¥%JI‘´[T«h>š®µ·°•™;ËXÌºdêÂŸS›d‰Væ;\rÆ±!Nˆ“K&—AˆJu4B…ÁdgÎ¢.Vp¢ámb‹…)ÇV!U\0Gä¸¨“`‹Ð­\\…qâŸ7Qöb«VL¥Þ:äÕ‚úƒó¬Z.­Nò˜Ä*–ÔU]Z´læzë…Îöù®ÇR D1IŸåÂ£Ñr:\0<1~;#ÀJbà¦ÊM˜yÝ+™Û”/\"Ï›j<3æ#“–ÌŒêñ¡…:P.}êe÷ïòD\"qÙyJýGŒû·sopŒ¯²þXŒ\rÝ³d–Þ\rxJ%–í‰ÏÆ¼O:%yyãÅ,‡”%{Î3<îXÃ¸ÏÌ÷¯zÂEÎz(\0 €D_÷½Ÿ.2+Ög®bºcÚxìpgÞ¨Áß|9CPŽûî˜48U	Q§/Aq®ÝQ¼(4 7e\$D“‰v:ŒV¡b×ûN4[ùˆiv°Àê2ñ\r•X1¼˜AJ(<PlFÐ\0¾¨€\\zÝ)ÑçšW€(ü4ôÈÃÚï¢ p•™ÓõÊ`µÇ\r³da6”¯üOÖímña´}qÅ`ÂÀ6Pƒ'hàç3§|š’îÃf jÈÿAæƒz‰ø£+ŒDŒUWøDíþÞ5ÅÄ%#é°x“3{«¶L\r-Í™]:jd×P	jüf½q:Z÷\"sadÒ)óGØ3	¤+ðŠr„NKö1Qþ½ç†x=>û\"¤°-á:ÊFÍõœIÙƒ*í@ÔŸÇy»Tí\\Uè¨ãŠY~ÂŠ‰Žäâš‚3Då€Á™ã¨f,s¢8HV¯'Ét9v(:ÖB9ñ\\Zš¡…(‘&‚E8¯ƒÍW\$X\0»\nŒž9«WBÀ’bÁÃ66j9Ð âÊˆ„ƒ?,š¬| ùa¾g1²\nPs \0@%#K„¸€ \r\0Å§\0çˆÀ0ä?ÀÅ¡,ä\0ÔhµÑh€\08\0l\0Ö-ÜZ±jbàÅ¬\0p\0Þ-Ùf`ql¢ä€0\0i-Ü\\ps¢è€7‹e\"-ZðlbßEÑ,ä\0ÈÌ]P ¢ÚE¶‹b\0Ú/,Zðà\rÀ\0000‹[f-@\rÓ¯EÚ‹Ï/„Z8½‘~\"ÚÅÚ‹­ö.^ÒÎQw€ÅÏ‹‚\0Ö/t_È¼ÀâèEð‹Ö\0æ0d]µ€búÅ¤‹|\0ÈÄ\\Ø¼‚¢íE¤\0af0tZÀÑnJô\0l\0Î0L^˜´Qj@ÅáŒJˆ´^¸¹q#F(Œ1º/ì[µ1Š¢ãÆŒIæ.Ü^8»\0[ŒqØÌ[Ã‘l\"åÆ Œ€\0æ0,dè¶À€Æ\rŒÌ„cøµ{cEÁ\0oâ0¬]°\0\rc%ÅÛ‹—ðˆ8½w¢åÆZ‹µ-Ä\\ºñ{ãÅÖ‹Gª/\\bp„…@1Æ\0a²1ù‹ÈÏÑsã!Å¨Œ/î/Ì]8¹‘~c\"ÅÛ‹Åþ2ôcÎ‘m£\"€9Œqš/\\^fQ~cÆ_‹£Î-\$iž\"Ö\0003ŒË¬¤fXºqx#\09Œ—Z.´i¸ÈŒ@FˆŒ‰3tZHÉ \rcK€b\0j’/DjøÉ1¨ââÆIh´aÈñv€Æ©OZ4œZòÌÑ‚#YE¨\0i–.hHÒÑsX/F<‹Ï†.äjøËñ­bèÆÍ\0mV/d\\èØñ‹b÷E³‹£ž3T^(ÝÑˆcKFR‹Õù‚ô]X¶q½¢øÅà—’6Ô]hÓñžc6EÄ‹ó66Üh‘Ÿãn\0005sn/dn¸Ô`\r\"ÑFŒ³Ú-D`ÈÕ‘‹ãN€2‹Y”¤bxÀñ”#\\Åë‹‡V3x·1x€FxŒ¾\0Ê6Œb°q£ƒÇ!Žž8|^‚ÌÑubåÆàÕ-ôrØäq¼ã:ÆéŽ%ö0Œppñ”#Ç‹¢\0Æ6ÔfÕÑÇ¢âÅ¬dÒ0„qH´±¾£\$Ç@‹qò-¼^B4±¦\"ú\08Ž1ª/lnxÏ‘ âêG3:0tjhÒ~@Æ¼Ž¥¦3¤vHÆñ¹bÜG(Že„4gØºqÂã2Æ1ŒÉ-ŒnXËñº\"ãF<Qž1\\j¸¸1®ãÈEÇ‹Çä³4m¨Õñªã[ô‹nÁz7üyhÞ1§#ÆÞŽ/‚3\\xÐqÍKG‚ŒÿÆ6äo˜Ñ1{£°FJ×š6¼lXéqâ£„Æu©Þ9œr(¿1Òã‡Gc\0Åf:„rX½ #ÐÅ½\0iÞ<\\}×ñåbîF½\0sÖ7Üy2ÌÑæ#uFe›\">4iØÅ¿âÔÆçŒé\n<{¸ã‘£âÆ‰ŒJ;¬]ØÄ1Å#ÎÆ0ÙJ;4^èÂD½ãóÇ®‹Ÿ¨³4i¨À(H#ÚÆEŒx–/¤nøû1ðã/Ç¡‹åj6,l˜Û1tã/\0005%ï0„]xü‘¶£GG5!’0¤€¨×ñÚâé–rŒq¢2Ì¨Þ‘ÎãNFPo\"4ô_˜·1×dÇ%‹e ²3¬s8é‘üã†G5Ž“ æ6Ô[Hë“cØHjYš;ô[è¾‘˜bë! Žyò@Ä\\¸½qØ#WHN‡Ž;ÌcÆQèã:Ç-%ª.œkXÆ‘ý£ÚGÍŒÏ†1Df¨ß‘ºcWFl¡!‚0ü€™²c EÜ©Ž;l˜Ñq\"ëF©ß¢7\\\\¨ùñâ£ÔÆO‹qþ.T|\"?‘ñã™ÆE³f9TyYÑ©ãSG1ûÂA\$f9R\n\"ÞÆxŒ¹>Bœ…HÚñß¤\0ÇŒ¶:\$e¹1œ£³F?=º3Tu)\nq¹béÇ~ËÎ<TøÎ±Ðc‰H.‘m~CôwHÊ±¸#/ÈI]~3ä^ˆºÑ„#§Æ>‘Y®4Œ^¸ÎQjcÊÇKŒ1\"Ò8¬|6Ñåc\"ÇB‘µ\"b4ãèæ%œ¢ÔÈG\0e\"’/t‹¨´1r£1Æe!v2„yÀ±õä<Ç †8\\o¨ÊÑ’#tÅÑ\rz@´}HÂ‘èbïÆèy î1Ì\\¨ðëdeGŽÁZ3Œ~ér)ã1È¿‹Û†Bl~H½²:£dF£‘-Î?”k8´qèc(FÍ‹ŠKÞ5|myñ€c1Æ<’*@´jØáò1ãÛÅ¾Œ‹>I´ZèÍQjä•È2ŒÉ\$0¤‹hµQˆäVFTŒ	\$ÆAl~öqÚ£È±Ž\$Ö>\\pÙ\rq‚\$/Èu%ï!®Jq \$ ãtE²‹GN-Tq)ò\"¢ÛHÊŒË¦=ì–XÉ2-£H’«š8\\nˆµRW\$HŒë\"¢C\\_¹\0»d\$Çf‘³\".D„u	'Q£zEíŒÙ&0toˆóqjãúÆ¿Œ³R@d—øÉä£ùÇu##¶LLkÉ*qó\$*GÄ‘iÎ@TŠi‘lãòEª‘ƒÎ5Œ˜¾r\\d–I–‘µ\"/ÌZÉ0’j\$TÅþŒz5Ld3’£ëÉ’oÂ.Tq¹!1{£Æ‹åÖ9œZ¸¾QÕbÓFŒwJ94nˆÒÄÖä{É(“-Ž8·2h¤uÈé“;\$†-Dkøårs£‡Hž™#¡‚ôY7ò\"Ø/E¿’Ó 	\$j¢^ò-£]Ç7Ž[\"N\$’èÂ‘“¤WÈ‘¯Ö/]à\$²+€1Ga/&IDnøÂ’@\$åÆ!‹ç\$Î-Œk!Q¨âùÊ)(N/\$t¸Ý¹äëÆOKzP´tXÜò[\0’GŽ’w(*K\$vˆË1ócÉ'“ÞGÌžIòxd­È\n“AÒ8\\rX·Òa£÷I”iNœI%\$½ã’Æ_‘÷ª6¤fçQþ#–ÈI”5#ŽF´—ØºñÏ#³Eâ’•\"î3\$¢IÜc‡Hˆ‹ÝvR|ùQ€¤cE¸ñ:R„eº±hä¶EÎfK`8þr.#·E³s®0L…˜üRä†F©‹·!\nC\$`Èöñ´\$ôH?’ËnPÜe™!ñš¥@F'”¿–/œ‡¸¶ÄÖäÿÊ”¯%ÂN,hÈÌrF\$öÈþŒÇ3´tøæÒ€¥Åæ’!1<„ÉCQÏ%ÉÃ’¹æJäZØf.Ý6Å†œ·±C‰¥ÊÔœ.²[þ™BÒ¿xëàƒè\0NRn`šÈùY\n’%+N¨IMs:Ã¹Ydƒef¬B[¶°ÝnÆ¹YŠòm¨ÁR®×’ûÉY¯ÚC„XŒëÛj³çU+Vk,¯\0Pëýb@e²¹¥x¬„V¾ºyT¤7ˆuî«[Jï•È±\nD¯§eR¿¬mx&°lÀ\0)Œ}ÚJ¼,\0„IØZÆµ\$k!µ¨ñYb²Áœ°€RÂ‡e/Q¾Àk°5.Áe‘­5•À¨žW‘`ª¥\0)€Yv\"VÂ\0•Ã\n‡%—å–`Yn¯Õ¡aôÔxÃ†Q!,õ`\"‰	_.Ÿå©Æ–tm\$•\"“²J«¤ÖÀ§ŽvÆ%‰M9j‚°	æ–§Ä*³KpÖ”’;\\R ¼ü3(§õŠ^¯:}–Èï|>Âµa-'U%w*‰#>¤@Ì¬e–Jÿ¤;Pw/+¹á5E\rjn¡ÐÃd–ô¢^[ú¯§cÎ°¥uËz\\Ø1mi\"x‚„påÃ;£ÌîˆæˆP)äøªÇ#„±Ø’¡…Ë!Aª;¨ß	4ì³a{`aV{KUàÊ8ã¨Ÿ0''o€2ˆ¨¢ycÌ¸9]Ké@ºÒ—^ðlBˆâOrëÔã,du¤¾8¤?õ‰€Õ%¼gB»ˆî‚ÆYn+ã%c¬e\0Œ°ñà¤±Yr@fì‹(]Ö¼¨\nbizîÖn€SS2£ÁGdBPjŠ¹Ö@€(—È¥¦!à-çv²´eÚ*c\0„ª4Jæç‚’ùÕÙ,“UÈ	dºÉeðj'TˆH]ÔŠÔG!œ)u‹ÕÖ¯Ÿ•Ò¯ùZËB5ûÌ“WŽ‰0\n±á¡ÔR«ÁW…\\¦Q jÄ^rÊ%lÌ˜3,ÒYy×Éf3&Ì•ÜŽÕQ:Ïµ2„mÉR)”T€¾(KRÁ 0ªÊ”@«ìY´¢Y:£Ùe3\r%´¨°Tö%­X”Á¹‡STÔ.J\\ë0ÙhôÄ…ŠD!Ä:—uæêÉU\"¾ÅÁo+7–\"„µ“f'º­R\0°‘ÞJõ2S–2è#nm »ÁIåŠœý\"Xü³²[Ö€Ñì} J¨¯c¼9p0ªüÕQ»(U\0£xDEW‚Œ.LõÁ=<BÔ0+½)ZS V;â\\âµI{5I‘AôÖÃ,dW²uè5Ew\n\$%Ò…ˆ½2i_\$ÈÙ+ìæO,Œ¬‡íX‹´Õ‘Jg&J¡úG’º%\\J“·b.ÄÝ^L‹TòFlŒè–¹]k#f@L·G€ÄT¼Ù—ÒÍHÏÌ\"–q1SÌ°ù‰jVÉ(Î™„ìZVzßÅ†³,§ÊèG.1Fû±gNÊ;×1ÃŠV¬¦5EÍò5`ò\0Ctè=F\ná¹›Î±•K‡þ™Ö\0­ÛŠ±%¨ËD]Q\$\r\0‡3J\\,Í™š³<T4*£™Á.ÒYK²D«QƒéLïS%,ŠgÔÇåª§Ö<Ëë™u0–ôÍUÄ‰Ö*x(©åNÂ’Yv!þ¥yÍ	wÅ4fdª¥rG•‰M \$äê‰^;ºéîÝæˆ)<Pã]DÒ%%Ó;ÔjÊåšI0æaÓu^Jp—[)¦v©3RhRúEöÀ\næ–L_š#5|Ü¾Õm3Pñ*¨\\Y51X’’	i³N—Èñ\$\"°ºaü­õh*KUÝÌïV8¨åuò±%&„ræ¯Ëš ²5oŒÕçg³;ÝrMl[Æ¨ögœ³ùª’·UÍq™ê¹šh|ÔeO2·f MlW2AP„×¹˜’ÍÀÍv~eD¬eñ3UÓ«l‡E62iüÎõìÓUbÌï˜¬«õUŒ¬©¨îøýªVðêiI!\$i¨Ê­&Z:½–xm!Å†“.ÖOÍfwÒ¯!”ÌÓkÝ¤Íƒ™6b\"«I™J]]:T™6ÒVrú¹}’ÜÇ«]™®±‘U¢Ž	ys7fÔMÅ™ÿ3ˆŒÜÎYœó:T_MÍw%3ÆnÏ¥\nÎæz*™í3âhƒ·	»`U–²Lÿš‡,¥Û„Ð5¨óvfƒ»Ã›Ù42_Q‰¼hÝÇÍuD§\no£¹)¤ÄœÕ«M9¿7foÛ¼©¤rÖÝÇÎWB~iTÝeyQTâN\nšd¦pr§#›óM§;’˜…4æpª¼„têÿ–(;š›³5	|¬àÇ‚Š­',AV7Ü”ÔåUAö&ìÍRœP¯\"äÕy‡Ò·•‰) [ŠnÌÕñ-3V•Ë,?œs6ºpŠù†3ŽfµÎAšÛ9k|ÝÉ®S†f¬*@œ•5Þg¼¾É¿2·Í}œŒ®þUüÝ™‘ðùæHÎF›l%®pÂ«Ie³be—MÙSO\rŽ[¼æi²3fÉÎLVá®rÙu®Š¾¥ÛNA›:î%r„Úy3Q_Ì¸›W.ÑÕÈ^Sl@&ÌÁ5ÖYlÂÌ1åæÎ}VxêžgÊ…§^SnÕÌÍQ!:5×ZÞiZCÔˆ:¿›•3qgé%DáõÝª{U¡3’tZ¹`ûÓu%w:ÉZQ:QìÏÇW fî‡í›¿9Jplê)Ö3xÔvÌþK7žb#«ù½«çX+Jš(¢Âh´ìP*Ó´«Î›þ¢!×”ìÅSLçh*'¤¨\npBù™ÚªgNÊ§8BuÒªéÂŽ¯çÎŒ½8niêˆIÍs¸USÍIš‡;vvÚ³UõsR•7Nu×8©H|íéÅÓ·§ÌŽœ«8òq´ÕÙÞ+'ÑßÍ`œx¢9Rˆ	Õ®ºçMaR8úxä)¸'!Ïœ;±U¬×YÖ“’ÝsNIg:ÕKTëy¯3®gŽÍYìëÊkäãÉÜ³n'LO(œ¿3šw4ñ4î»¦ÇÏœÚêþl¬ñÎJ½–ªw½9Ý\\ìç•óóhf(¢_~ìòà}9Nö¦Õ\0–´åb\"¢Yé¤ƒTh,Úž¤@ú±D¡û€\$€Iž·;ŽeüèUÊn¨³ž·,¹OªÆ	Xÿg´-ÀžÉ+>ti'G‚öŽlª%\0­8âVBËU1«ye\0KTÆ4ûÁÈm’ºV2)\r]I/\rFù…ÔXˆ×Àß¨ña·­GŠÂ¹ò*ˆ§»žÿ>ERì÷ðî®¥ž‡ÑZ›-)I\$®¹íç:¦aË\0¾FybaÙg«w§­(ß_@§v}öiõÊ³î€S^Ë25DÔ³Ð	ÈôURO±ŸJHÖ\\ØisðfÆËKšN±€qi÷Sg×OÂŸ\n²F~|«µÏ*@gR€_Q<9sÜ¬3i+Ø—².Cw²²ê|‚øyË6aìOÜY9¶Œ¶É–\nëÔ½-([®±†_ˆ}íSû]c¤S=Â¤ÎÙþÎÍÔYÎàU-> <ú©µ\n<ÖsOôQ4F¦^}\0007uäk(/‹ŸÛ/5{Lÿ9µ\0§¬Ð &³Š[<ÏõŸsÛ\0&Íè#…@hÌéª3©V}ÐH¢Š*Üw+]'DÐ& @§Ö])µè;TGe3\\Îên®ÑßËd\$:¦uN4Åyktê-dR!7–­Ée4(P!•Ÿ-þ9À4ç_PMGbÄ±w…«ØÉ6O§S¦F‚âí)§Šyh0+€ž²§qT|·Š+uÔÿÎ+ A¬?òÞ	öTè3.q 41T´¸e›€\n:P ø¯–{Tî\n³ëh?«šTïAùS£­*«åÒ+åu¥>ú\\ê¾ZéíÊîYì·¢wEJö%·’s—L±¾dªšyÀ+\rCèœß¡'Añl,Òyå3þç²ËÍ—`º	_*ÑPû ThKDV²·–~5	à0´+á¼,š-?­]œºò3ëÖKå—`¯^†¸¤I42(]ªwž.æ†rÄÊËê]¬\nYÆ¨B†£­Ð	³í–}Ð‹R ¾ÉgØ}:H§ðJÄWP²ê„\"Þµ—ðôV\\¬<——? >½å—áÿ§Ü¬Ý†¿=¦…:Ÿ\n0×è\\+ñS–´æfÝUŒ³í‰U,…WCÖˆè•On¨òÎ…¢§.†e9|R÷I'©[×/º²ÄÙü2ù›«QžÓBn:ÆIõ\nö§g¼9Æ\rü,ÓR6³ýçÒQ\$XÝ+¸>–©±`\nù)/_8QiÔùµê—=‡êv?5v\0 \n¨çÉLG¥Dmˆw\\ëFÖŒ‡Ñ¢¯ÁdêŸµ}s‰\"‘ÃYv¤|â™J*´9h­¡Ñ@XEUÑ*Þ(oQ]\$Bžˆ,ûéÜƒ•KTœv¤AptCÉƒ\n×C,/˜<¡­Ú™EW‹-VïP¡¢=Wÿ*%Kê—-Q`9	(Êú59Ó€èm)ËX¸¨@ç2ø ýT@ˆÛ\nS–¯‘bd×EÎ´a€+€DXîá|UÚ	‹	’¡F® 2ú%5\nj•m«€WÙ+xêKŒæVÌ3#„¶CTÃek¤™–&Î,£l¬jbd7)Ó“\"\n+ìPüºb’èIŠ@è3Ñ•ÜµjUÒÌEsÞÔ)D¢fë’ƒõŠû•ÇPZ3AÎŒÕ\nwThð—²ªÛ˜Å4Zäª<Êuß©ßdqâËŠu(÷ž“bKG±à¥éÀnÓTï®ˆ]z¨f%#3IËfS¨®&}µ@D†@++ù¤Aíhª¿\nªï€U—Þ¥|B¡;”…UmÑÙU…E•N¥!ôx2±1Ò\0§GmvH~õÁHèTê)öW®³YNý\"åk5©ÑvT#=µÚ¥Ê<\n}‘#R3YƒHÅRÍIÍ³Ü¦;ÌÑRl£1léuB%TQJî™*ºêˆÙ'ºEë0i¬dw,¥zÊÍ¥:\$†¦;Í? üîj‘¿)§ô)ÔÊ\$32J}Å&‡[³\$¨õÌ¤;DnýE×´À+0ÛaZ{¨èC èû€(¤ê:“¸ ÚO@hø²D£æ\0¡‰`PTou“³ÄïF®\rQv‚û¨˜o½Ü¡\$Sîö+˜Ò#7À¤Izr…pk DW”ˆFsÍ9™ Qê  Ð°1€gÀÅ#•\0\\Là\$Ø 3€g©XŽyôy œ-3h›ÀþÃ!†nXèô]+±—	É€c\0È\0¼bØÅ\0\r‰ü‡-{ž\0ºQ(ðQÔ\$s€0…ºém(°[RuòVÆ÷ÒØ>Æ¼+àJ[©6à‘ÒàJ\0Ö—ú\\´¶ã,Òé‚Kš3ý.ê]a_\0RòJ Æ—`š^Ô¶ClRÛIKî–ù\n \$®nÅÒä¥ïKj–©\n€šÁ©~/¥ªmn˜].ª`ô¿ijÒâ¦#K¾˜f:`\0…éŒ€6¦7Kâ–¨zcôÂ\0’Òõ¦/K®–­/ªdôÄé‡FE\0aLŽ˜¤dZ`ƒJé†S‘ÏÊ™…2ØÍ4Î@/Æ(Œ‹Lò™õ0ª`´Ä©†€_ŽLþ™]4ZhôÐ©šSD¦M˜…4:cÑé‹SR¥×M—E4šiò€éžSG¦EMj˜å4zdÔÕ©–SFKLª›%4ªeÔÏ%\$ÓlKM2–õ1ÈÚ”Ôi¦Ó©MV›­.¸Ú”Öi´Ó©Lz›/ˆ÷ôÛ£Ó„¦ÑMæ›,`Š_ôàimSŠ¦gMÆœ€jg‘òéÇÓ5¦9.›…9j_òéºS¥µ.›Å9ê_±òé¾Sˆ¦‹.œ7Úrò)ÉÓ%§[2m8ºuTæé™S±§3M:]3ºq”èänÓ±§KNˆ1|^ÒktÏ\"ÒÓH§gKjž-;zcñiÎÓš§–\r<ê_²-iÊÓ¸¥ñ\"ÖžU.¹´óiëRÚ‘kOFží=:\\ôÏ\$ZÓ©§MLE­5úxôø©ÂÓ»_\"Öœ=<\0ñtéÙSç¦9OÒž­1Š~”öi²Óô§¹Oêí>ê~qœ)òF¸¨’ =6:~ÔõãJÔ‘ÏP:ŸÍ=¨åTÿ)¢Æ«§ÿPJ8õ@êwôô©÷Ç*§ÍOÊ5]>ªt÷£•T\n§å!\" 6Y	)€ÈH¨/Pªž…3É	éð†/‘P~ àù	ªÓ®¨!\"ŸC’ÌÔýj¡ ¨eNJ¡üˆêˆñÔ*%Ô4¦1Q¡ÅCZ‡Q‘jTBQ.¢\rE)\0004Ëê\$€2¨SM+å<j„t¿j0Ô,¦9Q†¡}F\0\$±s©žTa¨KÎ£]Ecj*€'K»M¾—MGx½ÕRÇT1¦#Qê¡¥GªŠ5ª:Ôz¨Lš¡4u6z•\"j\"TˆKuNÖ£ýGÚg\$jFSÜ¨ïQ2¤¥Høîµ\"êMTƒ©%R¤•HzŽÕ\$ª,Ôw¨Re.\$rªzµ)©ÛÔ¦©-Qö ÍJ„¹‘Êª@Ô°©=R&/IÊ•1†*]T³‹À7¼˜¾QÒåD&Ó©qN¦_(´q²c[TwŒQRôå´œJš\0nâ÷T­¨û.¦˜956cÔÜŒÕSz¥H˜Á•7ªRÔ}ŽSr8¥NŠšÕ\"bÖTè§ÁQÞ5MNŠ–õ#ãçÔè©ESÂ§-H˜Á7\"ÜTü©_Sê§}GØÌ•?*yÔ©‹‡Sò§½P*Ÿ5#âöÔÜÏT:§]PÊŸõC*€Ô‰‹T:¨-K8Æ5Cª„ÕªR¦--MÈ¾•HªˆÕ ª'T‚¨­HøËõHªŒÔÑ‹×TŠ¨íRª£õ,âéÔÜ‹GTÚ©-SJ¤õM*”Ô©‹UTÚ©mMH¸õMª˜Õ>ªgSD³5MÈÂ•RªœÕHªwU\"©íK8ÕÕRª ÔÚŒ¡U*ª-U*¨ànÂ¾TÙIR­,t¢Z«ÕêY¶IUF«51ª¬µW)vÕk‹_KÆ«pJ«5Zj­Å¯©R4r\n¬^jIÓCKº„‚ª}UÊ“_ª°Ô›ªãO¬=N·R*¯F-ª½Rž¬%Wš‹Õcê¦Õ\\ŽaV>«EYj–µdªªÔÃ«UÎ¬µWXÍ5*ÈÕ‹’¹Uy‚õZŠ°1kã™Õ¨«7Vš¬R\\HÍ5h*ÖU¢©ÏUÆ§M[Š²±kêvÕ¸«3Vò­}[(ä5WªzÕ¸«iB­Oº®1¯ê¯Tý«—V®;­[øîµpRæGu«;T@0>\0‚ê/I³ªÿW`í]¦ô\0ªîÆ8«¿PŠ¯]ÈÍ1m*ïÕÇyUz¨mW¡õ|ªÝ“[«¡Ö¯…]J¬ÑˆêøU±««ö¯…Z*¤5\\j‘Ö«ëZªô`ZÁ5~ª®Eì¬Wú«4ZšÁ5h£QÕ^‹cXZ®•Sú®1o«Vª¹U&«TºÄ5}cU^›Xš°dm*³±’kUu¥«SfG=[¹õjäsÕ¿‘ÏX¦Kc\n®iRâHç«i#ž±uWt»µª½¥º«»XÂÕcÄ¹•«U†¬”rÚ¢õUZ‹Õ‡ƒNE¢¬‘Xº¬…4ÚÈudê·Eä¬eV^²íKÉànâòV8‹sXÂ¥ÍfÇõ/ÂhJ³-J]Ó‚…™ÓÎÁÕzO›±<Eh‰\$å‹“·¡ó\0Kœë<bw„ñ…>·”øNž\")]b£	â+zê.cS.¢iFç	ã£µQNQ«éV*ªéÛÎúÞO[X¤nxŠ¤P	k­§oNø£}<aOò§Iß“Áh·ºšT;òrñ‰‰¤ƒVD6Qß;zŠ]j×~'’:ë–[Ivôó7^Ê‘§ÖÁžjëºw[«ùæîºçœÊÅ†¥:u ÅDs#¦¿Î\\wµ<n|*á‰hëmÎKv;YÒˆ±Ú3á]Œ«^#—Zªj¥gy³jÄ§Y,”%;3¾³ÊÚù×.ÈW\"‘Ã\$Ù3>gÚœºÏÓÏ¦ªVTóZj¥hYÝjžkD*!šh&XzËiª•¥+GV—­\"¥æ¸Z:Ò¤§+‡NoG¥Zjj¥iÉ]ÊžkOÐ_­Ö¬ÔmjIª•¨§t¯–#½[âj\rnŠãê©×Ðn™ßZ¥_,Õé†ógÎÄš©:¹¼Å9‰Áÿ«[L2®W=TÔ×0®ãf¶\0P®U6\ns%7isYæ?£¿uá3¾’½nb5¡«Ÿ»šX|G~l•&×k¤¥·M§ †¯ú¶ŒÏy¡S–É)Î]œÜ­r·¶Ù¸µ¸æìÖê›Å?Õ}u'n0W-Î¹®æb·´ÇªìõŸk?»vQý7…Ü}p\nìõÀ’ÍÙ®Z*»9)Êá5Þ•ZW­-ZB¸²Œ:ìõã«ŠW\0WZfp•GpõîÍÙ®:Fpú¤ŠäUÙëSN/™Ï\\©Ü%s9¬S{§ ×8®ÏZÍasÊÛ“’+¢N^®“9™MÕ{…P5Óç ×Q®ÔîJº¢«y§õÕè;œÚîz¸ƒÂÕYÚV Ä3—:ïœDÅIŠÃ+ç‡ý¯£19M;º¥Œ’ô¨“V´®š\rQ{êÉÕ®•¶Å+£ƒFCLÄ¹ŠN¥–©Ôˆ\\ùÞ)\$iŒŽÛN'\0¦°PŠÂšõÊÇ]XÌ^s1òf&Š\"'<OøóšÌ¡ËL\0¹\"‡@Ö”¥%ä6úÂUAõ1ýi(zÌèÝ€\rÒÕ‚ä±ÈbZÀ”+IQOï3€ºË\r=*Ä‰ ‰)ñ¨!Áž Ð`ª¼h°ˆ,Ð«mGPCËA Ù²íƒA„Œ(ZÅ°%ƒtì,h/Á‰ˆi–Èk¬«¡XEJ6ð±„IDèÈ¬\"›\nïaU- ›«\nvŽy°_€ÄÂÂ›Ú«¯k	a½B<ÇVÂƒÛD»/P»ôaîÁ)9Lã¶(Z‚°8êvvÃ¹Øk	§oÐZXkäÑå§|´&°.Âæ±C¹’Øá°`€1€]7&Ä™+™H¤CBcX“B7xXó|1“€0¦ãaš6š°ubpJLÇ…–(·š÷mbl8I¶*Rö—@tk0€—¡¯ÅxXÛÁÓ;ÁÅ al]4s°t¿íÅªð0§c‡'´ælß`8MŒ8‘ÀÃ€D4w`p?@706gÌˆ~K±\r‚Û “P´…Ùbh€\"&¯\nìq‘PDÈÐÎó\$Ð(Í0QP<÷°àÀã¬Q!X´…xúÔ5€ˆR·`w/2°2#ŠÀ¸Ž `¬»‘1†/ˆÜ\r¡Ö:Â²–±¢£B7öV7ZŒ›gMYúH3È „ÙbÎ	ZÁÓJÅöGâwÙgl^Æ-‘R-!Íl“7Ì²Lõ†Æ°<1 íQC/Õ²h¼à)ÏWž6C	÷*dˆþ6]VK!mì…ØÜã€05G\$–R˜µ4¯±=Cw&[æ«YP²›dÉš³')VK,¨5eÈ\rÞÊè†K+ï1„X)bÛe)ÄâuF2A#EÑ&g~‘e¡y’fp5¨lYl²Ôœ5õƒö¿Ö\nÂŠÙm}`‚(¬M Pl9Yÿfø±ýÖ]€Vl-4ŽÃ©¦«ÂÁ>`À•/û³fPE™i‹\0k™vÆ\0ßfhS0±&ÍÂ¦lÍ¼¢#fuåÌû5	i%ÿ:Fd€ö9Ž™Ø€G<ä	{ö}ìÂs[7\0á¬Îž3íft:+.È”–p >ØÕ±£@!Pas6q,À³—1bÇ¬Å‹ãZK°ê±Ü-ú“ar`•?RxXÁé‘¡ÏVïú˜#Ä¤ÔzÂ; ÀD€•¾H²Á1¥’6D`žþYê`÷RÅPÖ‹>-Æ!\$Ùù³ì×~Ï€ÐÅà`>Ùï³õhÔ0ô1†À¬–&\0Ãh—ëûI–wlûZ„\$“\\\r¡8¶~,\nºo_áÀB2D´–ƒa1ê³àÇ©=¢v<ÏkF´p``”kBF¶6 ÄÖ²—hÆÉT TÖŽ	‡@?drÑå‰€JÀH@1°G´dnÁÒw‡Æ%äÚJGšÒ0bðTf]m(Øk´qg\\í½ó¸–¬ë°ê ÈÑˆ3vk'ý^d´¨AXÿ™~ÇW™VsÂ*¼Ê±æd´ûM À¬@?²ÄÓ}§6\\–m9<Î±i”Ý§›ˆÔ¬h½^s}æ-¦[Kœs±qãbÎÓ-“öOORm8\$ÞywÄì##°Œ@â·\0ôÒØ¤ 5F7ö¨ƒ X\nÓÀ|JË/-S™W!fÇ† 0¶,w½¨D4Ù¡RU¥T´ž’îÕðZXÇ=í`‰W\$@âÔ¥(‹XG§‹ÒŠµ—a>Ö*ûY¶²ˆ\n³ü\nŒìš!«[mjœµŠ0,mu¬W@ FXúÚÎòðü=­ (¦ý­b¿ý<!\n\"”ª83Ã'¦‚(R™Ý\n>”ù@¨W¦r!L£HÅkÌ\rˆE\nWÆÞ\r¢‚'FHœ\$£‹ääÀm„È=ÔÛ¥{LY—…&ÑÜ£_\0ŽÆüÝ#¢ä”€[„9\0¤\"ÔÒ@8ÄiKª¹ö0Ùl‰ÑÐp\ngî‚Û'qbF–Øyá«cl@9Û(#JU«Ý²ƒ{io­‘¥.{ÔÍ³4ÞVÍŠVnFÉxðÑüzÎ QàÞž\$kSa~Ê¨0s@£À«%…y@•À5HŽ†NÎÍ¦´@†x’#	Ü« /\\¥Ö?<hÚ‚ù…¼ITŒ :3Ã\n%—¸");
    } else {
        header("Content-Type: image/gif");
        switch ($_GET["file"]) {
            case "plus.gif":
                echo "GIF89a\0\0\0001îîî\0\0€™™™\0\0\0!ù\0\0\0,\0\0\0\0\0\0!„©ËíMñÌ*)¾oú¯) q•¡eˆµî#ÄòLË\0;";
                break;
            case "cross.gif":
                echo "GIF89a\0\0\0001îîî\0\0€™™™\0\0\0!ù\0\0\0,\0\0\0\0\0\0#„©Ëí#\naÖFo~yÃ._wa”á1ç±JîGÂL×6]\0\0;";
                break;
            case "up.gif":
                echo "GIF89a\0\0\0001îîî\0\0€™™™\0\0\0!ù\0\0\0,\0\0\0\0\0\0 „©ËíMQN\nï}ôža8ŠyšaÅ¶®\0Çò\0;";
                break;
            case "down.gif":
                echo "GIF89a\0\0\0001îîî\0\0€™™™\0\0\0!ù\0\0\0,\0\0\0\0\0\0 „©ËíMñÌ*)¾[Wþ\\¢ÇL&ÙœÆ¶•\0Çò\0;";
                break;
            case "arrow.gif":
                echo "GIF89a\0\n\0€\0\0€€€ÿÿÿ!ù\0\0\0,\0\0\0\0\0\n\0\0‚i–±‹ž”ªÓ²Þ»\0\0;";
                break;
        }
    }
    exit;
}
if ($_GET["script"] == "version") {
    $kd = file_open_lock(get_temp_dir() . "/adminer.version");
    if ($kd)
        file_write_unlock($kd, serialize(array(
            "signature" => $_POST["signature"],
            "version" => $_POST["version"]
        )));
    exit;
}
global $b, $h, $n, $gc, $oc, $yc, $o, $md, $sd, $ba, $Td, $y, $ca, $pe, $tf, $eg, $Lh, $xd, $si, $yi, $U, $Mi, $ia;
if (!$_SERVER["REQUEST_URI"])
    $_SERVER["REQUEST_URI"] = $_SERVER["ORIG_PATH_INFO"];
if (!strpos($_SERVER["REQUEST_URI"], '?') && $_SERVER["QUERY_STRING"] != "")
    $_SERVER["REQUEST_URI"] .= "?$_SERVER[QUERY_STRING]";
if ($_SERVER["HTTP_X_FORWARDED_PREFIX"])
    $_SERVER["REQUEST_URI"] = $_SERVER["HTTP_X_FORWARDED_PREFIX"] . $_SERVER["REQUEST_URI"];
$ba = ($_SERVER["HTTPS"] && strcasecmp($_SERVER["HTTPS"], "off")) || ini_bool("session.cookie_secure");
@ini_set("session.use_trans_sid", false);
if (!defined("SID")) {
    session_cache_limiter("");
    session_name("adminer_sid");
    $Rf = array(
        0,
        preg_replace('~\?.*~', '', $_SERVER["REQUEST_URI"]),
        "",
        $ba
    );
    if (version_compare(PHP_VERSION, '5.2.0') >= 0)
        $Rf[] = true;
    call_user_func_array('session_set_cookie_params', $Rf);
    session_start();
}
remove_slashes(array(
    &$_GET,
    &$_POST,
    &$_COOKIE
), $Xc);
if (get_magic_quotes_runtime())
    set_magic_quotes_runtime(false);
@set_time_limit(0);
@ini_set("zend.ze1_compatibility_mode", false);
@ini_set("precision", 15);
$pe = array(
    'en' => 'English',
    'ar' => 'Ø§Ù„Ø¹Ø±Ø¨ÙŠØ©',
    'bg' => 'Ð‘ÑŠÐ»Ð³Ð°Ñ€ÑÐºÐ¸',
    'bn' => 'à¦¬à¦¾à¦‚à¦²à¦¾',
    'bs' => 'Bosanski',
    'ca' => 'CatalÃ ',
    'cs' => 'ÄŒeÅ¡tina',
    'da' => 'Dansk',
    'de' => 'Deutsch',
    'el' => 'Î•Î»Î»Î·Î½Î¹ÎºÎ¬',
    'es' => 'EspaÃ±ol',
    'et' => 'Eesti',
    'fa' => 'ÙØ§Ø±Ø³ÛŒ',
    'fi' => 'Suomi',
    'fr' => 'FranÃ§ais',
    'gl' => 'Galego',
    'he' => '×¢×‘×¨×™×ª',
    'hu' => 'Magyar',
    'id' => 'Bahasa Indonesia',
    'it' => 'Italiano',
    'ja' => 'æ—¥æœ¬èªž',
    'ka' => 'áƒ¥áƒáƒ áƒ—áƒ£áƒšáƒ˜',
    'ko' => 'í•œêµ­ì–´',
    'lt' => 'LietuviÅ³',
    'ms' => 'Bahasa Melayu',
    'nl' => 'Nederlands',
    'no' => 'Norsk',
    'pl' => 'Polski',
    'pt' => 'PortuguÃªs',
    'pt-br' => 'PortuguÃªs (Brazil)',
    'ro' => 'Limba RomÃ¢nÄƒ',
    'ru' => 'Ð ÑƒÑÑÐºÐ¸Ð¹',
    'sk' => 'SlovenÄina',
    'sl' => 'Slovenski',
    'sr' => 'Ð¡Ñ€Ð¿ÑÐºÐ¸',
    'ta' => 'à®¤â€Œà®®à®¿à®´à¯',
    'th' => 'à¸ à¸²à¸©à¸²à¹„à¸—à¸¢',
    'tr' => 'TÃ¼rkÃ§e',
    'uk' => 'Ð£ÐºÑ€Ð°Ñ—Ð½ÑÑŒÐºÐ°',
    'vi' => 'Tiáº¿ng Viá»‡t',
    'zh' => 'ç®€ä½“ä¸­æ–‡',
    'zh-tw' => 'ç¹é«”ä¸­æ–‡'
);
function get_lang()
{
    global $ca;
    return $ca;
}
function lang($v, $kf = null)
{
    if (is_string($v)) {
        $hg = array_search($v, get_translations("en"));
        if ($hg !== false)
            $v = $hg;
    }
    global $ca, $yi;
    $xi = ($yi[$v] ? $yi[$v] : $v);
    if (is_array($xi)) {
        $hg = ($kf == 1 ? 0 : ($ca == 'cs' || $ca == 'sk' ? ($kf && $kf < 5 ? 1 : 2) : ($ca == 'fr' ? (!$kf ? 0 : 1) : ($ca == 'pl' ? ($kf % 10 > 1 && $kf % 10 < 5 && $kf / 10 % 10 != 1 ? 1 : 2) : ($ca == 'sl' ? ($kf % 100 == 1 ? 0 : ($kf % 100 == 2 ? 1 : ($kf % 100 == 3 || $kf % 100 == 4 ? 2 : 3))) : ($ca == 'lt' ? ($kf % 10 == 1 && $kf % 100 != 11 ? 0 : ($kf % 10 > 1 && $kf / 10 % 10 != 1 ? 1 : 2)) : ($ca == 'bs' || $ca == 'ru' || $ca == 'sr' || $ca == 'uk' ? ($kf % 10 == 1 && $kf % 100 != 11 ? 0 : ($kf % 10 > 1 && $kf % 10 < 5 && $kf / 10 % 10 != 1 ? 1 : 2)) : 1)))))));
        $xi = $xi[$hg];
    }
    $Fa = func_get_args();
    array_shift($Fa);
    $hd = str_replace("%d", "%s", $xi);
    if ($hd != $xi)
        $Fa[0] = format_number($kf);
    return vsprintf($hd, $Fa);
}
function switch_lang()
{
    global $ca, $pe;
    echo "<form action='' method='post'>\n<div id='lang'>", lang(19) . ": " . html_select("lang", $pe, $ca, "this.form.submit();"), " <input type='submit' value='" . lang(20) . "' class='hidden'>\n", "<input type='hidden' name='token' value='" . get_token() . "'>\n";
    echo "</div>\n</form>\n";
}
if (isset($_POST["lang"]) && verify_token()) {
    cookie("adminer_lang", $_POST["lang"]);
    $_SESSION["lang"]         = $_POST["lang"];
    $_SESSION["translations"] = array();
    redirect(remove_from_uri());
}
$ca = "en";
if (isset($pe[$_COOKIE["adminer_lang"]])) {
    cookie("adminer_lang", $_COOKIE["adminer_lang"]);
    $ca = $_COOKIE["adminer_lang"];
} elseif (isset($pe[$_SESSION["lang"]]))
    $ca = $_SESSION["lang"];
else {
    $va = array();
    preg_match_all('~([-a-z]+)(;q=([0-9.]+))?~', str_replace("_", "-", strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"])), $Ge, PREG_SET_ORDER);
    foreach ($Ge as $B)
        $va[$B[1]] = (isset($B[3]) ? $B[3] : 1);
    arsort($va);
    foreach ($va as $z => $xg) {
        if (isset($pe[$z])) {
            $ca = $z;
            break;
        }
        $z = preg_replace('~-.*~', '', $z);
        if (!isset($va[$z]) && isset($pe[$z])) {
            $ca = $z;
            break;
        }
    }
}
$yi = $_SESSION["translations"];
if ($_SESSION["translations_version"] != 1761515769) {
    $yi                               = array();
    $_SESSION["translations_version"] = 1761515769;
}
function get_translations($oe)
{
    switch ($oe) {
        case "en":
            $g = Cº£N	ÉS‡%RªÊ9W¹XƒèÈj¾X	F±”IŠ@Ž·“ÆïË©-d •\$õª«Räƒ\$Õê¿…(T²˜SJqO*D©  .U\nª\$TsÍÆ°h\$‘Ð F‡ü7’0ššá=©4›(ŸÍzw=G²%’š‡é¢>nUí'¸¡I3BŒ`9>ÄhHCfknyÜº(AûÙl…4¸4šƒK0ÆE„Ê[ÍúB?Ïhô·bj€H\n-Èb|\n\n\0)\$D‘<’Lh‰Bô\rÆýŒ×¢dq2¤…»ã@yÉ‰3……è7<— kcù°!°Ã>‚üO	ñ#g¹>ºÈôëƒ2	lù(S>É\"QiS+ÀÏ&Œ~M)%d´—›ä6…Oì±0’<’œpÈOŠz}&°²HcÆZØ\$H\$‘A‹¹!–õìó@@C‰³*\$Á“á#ÑÙdxñÏâ|{Œ«çrëÀ´É\0žÂ£W/T)U5hÒBZ³Á±P×´_¡%9ÁÉE’î@XÁ%)¥œÃ2G‰TT)´’H‚Œ™#ÁRI´åÂÜéx ˆÌƒ¥\"üPÕ±i;/M'\0£\\L©je	á8P T *­‚\0ˆB`E¬Mz¯s}\r:Z¥‘-\n¥sN0gg<±±”&›çÑÀ%!¼ÕËjŠ9ØTuZ˜Ùi-ž]Lôï7ã,bÍRHÇÁž©fÄ\\2Æ²Í±\"ŽxN˜P0n|Ÿ9¢‚²'(ý	 ó8~Ha>JrD“þ`Ã¨g\rBIID!‘Òbc’<ñ[Òbál•zUˆåMµ'KíÌ““h!K¡ÎØ÷”H[Zh„Œ´<¢vHVºÙ\nÁ¥l]…¼^ÙxxC-i\n–»ò†B™Iöì@dVÕKòn„Ú¨†z¦K(T-,9Wüï‹I•JB*ó`ÎKZ/	ìï1Etg,Z‰NHL\"˜Ó`‡¤o(‚l%JÂMF»³¯¨¾'iÊŒB\r¿ƒ0Ì6NRLÇDB ÞMpò¯–tûFŒØ^s1·t„!Íº\n×p»7}K€´`O-Ìdüâ>OÝ…6t¬¼P‘cý_W×6W’P½ŽØpÒˆb˜¤#2ãx×#Á\"Ö2ðI]xPÝÉôLïÜtZP*1nª}\\Ú¯Í7Ô«õ ×@™}«I1T­/LÓtí>¨Cº£N	ÉS‡%RªÊ9W¹XƒèÈj¾X	F±”IŠ@Ž·“ÆïË©-d •\$õª«Räƒ\$Õê¿…(T²˜SJqO*D©  .U\nª\$TsÍÆ°h\$‘Ð F‡ü7’0ššá=©4›(ŸÍzw=G²%’š‡é¢>nUí'¸¡I3BŒ`9>ÄhHCfknyÜº(AûÙl…4¸4šƒK0ÆE„Ê[ÍúB?Ïhô·bj€H\n-Èb|\n\n\0)\$D‘<’Lh‰Bô\rÆýŒ×¢dq2¤…»ã@yÉ‰3……è7<— kcù°!°Ã>‚üO	ñ#g¹>ºÈôëƒ2	lù(S>É\"QiS+ÀÏ&Œ~M)%d´—›ä6…Oì±0’<’œpÈOŠz}&°²HcÆZØ\$H\$‘A‹¹!–õìó@@C‰³*\$Á“á#ÑÙdxñÏâ|{Œ«çrëÀ´É\0žÂ£W/T)U5hÒBZ³Á±P×´_¡%9ÁÉE’î@XÁ%)¥œÃ2G‰TT)´’H‚Œ™#ÁRI´åÂÜéx ˆÌƒ¥\"üPÕ±i;/M'\0£\\L©je	á8P T *­‚\0ˆB`E¬Mz¯s}\r:Z¥‘-\n¥sN0gg<±±”&›çÑÀ%!¼ÕËjŠ9ØTuZ˜Ùi-ž]Lôï7ã,bÍRHÇÁž©fÄ\\2Æ²Í±\"ŽxN˜P0n|Ÿ9¢‚²'(ý	 ó8~Ha>JrD“þ`Ã¨g\rBIID!‘Òbc’<ñ[Òbál•zUˆåMµ'KíÌ““h!K¡ÎØ÷”H[Zh„Œ´<¢vHVºÙ\nÁ¥l]…¼^ÙxxC-i\n–»ò†B™Iöì@dVÕKòn„Ú¨†z¦K(T-,9Wüï‹I•JB*ó`ÎKZ/	ìï1Etg,Z‰NHL\"˜Ó`‡¤o(‚l%JÂC	\0‚€—ëé0däûO²Y„S¶^=FË¼‚HLw]Ù@Â!0¢lÝùOXŽÀ„ð–¤~Q\$N:ðÂÀ•Ëó›ËA.½˜2¡…Ìa›2Æ3ÓÌç”ù­Ø…ß’³UúÍ—‹7°]”ñæXÇè/-èL¼]t°f‰Ä¦å&Q	Á§	wL‚:GóÓŒ<ˆáÆ0AjhrJ`(+†PÄo?'<)1mdÄÈpHGd¿Å’a5ØlÍY\n€ ’Ë9egÙ*j”Ã‹hI3¤ÀÅ“ë4vYyÈ–{H°˜£Å5,ÙXûoi¤«¸É»/×‰ó£ÏµìãPCŒ*ní¿¼rÔ–{Õ¢nðËfç‹cÞˆæ»šœŽ,0aL2[P#‹gQÑ®FÆ3®´²‰ø¥~âåü¼AnlXz¿hŸY‚¾Üxæ°§‚ò†+bö\r§d3ªôIn®\r¢Ô-ýfÃ%ÞvU´óíï¿ÎÉ®ÑóÝ½µºD~ÆrÏ¦Ù>Ô,Þù—ñŒ)¸5'ÑúB³ý{§îŽ¥À'dçð‡”Ë0‡´1KN]—x4bdMs‚ØÇ:,\\Ì±T‰ít×»Á²œfdïÚ›à÷7àúò–aÆ‚\n©Ý:ZåX˜€Õ/-„<Ç\0´¶LZŒ\\p1MªëÜŸêÉ¦;S¶!‡LÊˆ®‹ä\n›_î[OùDæWÕVÞg0^Â•—ì^GûOt‚Ò]Pó¸;Ïá†ŠÛÚû}'FÀ4¿Œ™ošàð~jYþ—ä;cüÞ†…z8ÆÞÕñXµ5~Íãg£ôÃÿ¶ÿœ\\)¯à-ØÁª¯þÆFõ\0ÄÔ5P/ Š5æJbÊ	ê»£‚Ã\")*œî#bðNÀÛÒ%\0îP<ëØßHÇp:êîÍ\0If¿…ªt&.ºð`•\0ÞO ÈZDdgÄÊþ@20n£ÆV£ è!#²,Ž`b,zùìò/ðXPš˜°ýÐ¤6pœÿP%j/°¦_oF©°¾r¥õ	ðC„0þÐ\\Œpk	PÀêoj4ì\$Ã\$*ý\$ÞŒ&ÃOìüñ…«\n®§\rŽRÃ)b1,\n„G0\n£yÐî%°>&0¶J°Õ\nÍŒ<D\0K°Tá\0Ž¥…þ£ ìzCN]ð„µì\rhÒÌÑPµdü²ãpÞXð©B#Ã~ÉéŒ#\"â- –1t\\M©®øÎ­]ñ„ä±fó/\0`†B\0Øj\r Æ\rmvP.#0‰ ÒÇ6/'žŒV\n ¨ÀZz5Âî9¬üÎ/ì%©>mÒÍ¼³.£LˆŒb&G#0p«Â˜åºo€›‘¼º\0Ø«\$&6¢óbœ.äÖÄ)NV¢ïÇ²4²rJrV©8´äÄ\$fKC£!+^\nå'¤abòß‚çîNê%šbîÐ¾ÒZö\rà±­ö»2]¦ ¾Ž¶’vÞ èriQð³f 6\$â½íÛ(\nŒ¾+jo,¸ohurC0LƒNé @¯vd®Fº¯&y+NßìR0«`O`ê%êÈ¯²–Z\"Ø\"vl« =È2r äbÆŒ92\n5C0)†T²DÃ0+¸Ê°‚üâÐ»àËëjk°ro€‚)¢ÔÅÄDKÞ ZMLþÉø*M3Ó@—’‚ê3FÀ";
            break;
        case "ar":
            $g = "ÙC¶P‚Â²†l*„\r”,&\nÙA¶í„ø(J.™„0Se\\¶\r…ŒbÙ@¶0´,\nQ,l)ÅÀ¦Âµ°¬†Aòéj_1CÐM…«e€¢S™\ng@ŸOgë¨ô’XÙDMë)˜°0Œ†cA¨Øn8Çe*y#au4¡ ´Ir*;rSÁUµdJ	}‰ÎÑ*zªU@¦ŠX;ai1l(nóÕòýÃ[Óy™dÞu'c(€ÜoF“±¤Øe3™Nb¦ êp2NšS¡ Ó³:LZúz¶PØ\\bæ¼uÄ.•[¶Q`u	!Š­Jyµˆ&2¶(gTÍÔSÑšMÆxì5g5¸K®K¦Â¦àØ÷á—0Ê€(ª7\rm8î7(ä9\rã’f\"7NÂ9´£ ÞÙ4Ãxè¶ã„Žxæ;Á#\"ž¸¿…Š´¥2É°W\"J\nî¦¬BŽê'hkÀÅ«b¦Diâ\\@ªêÊp¬•êyf ­’9ŽÊÚV¨?‘TXW¡‰¡FÃÇ{â¹3)\"ªW9Ï|Á¨eRhU±¬Òªû1ÆÁPˆ>¨ê„\"o{ì\"7î^¥¶pL\n7OM*˜OÔÊ<7cpæ4ôRflN°SJ²‚\\EÒÜVÈJ„+ï#ÅòƒÜ‡Jrª ž>³J­–(ê†¶\$(™R‚Mèúv„GI£÷§»¦¸Å¥r°ìWjÕ|‚\"véÇ¥< ŒƒkÕ”(ÓÂãœ3\r„Æ1¶T[×nÚ°hÅ´£¸ÒÞ³ð¸ÂÔÃÑ\0ä2\0ywÊ3¡Ð:ƒ€æáxïƒ…Ã\r£iÁPHÎŒ£p_ŽpüB„J`|6Á-+Ô3A#kuF\rÁà^0‡ÊzCÓÜªÖì„ÌÃå™s“j©Q8º²¥šµu,15ú‚ÀXrZTÆ–ª²në\"@P®0ŽCsÔ3£(ÉZ(þfý¥²\$¶ƒÉÚöŸ:ä†Yk«ò—Uôš<—ØÂ:¸ì0ƒ¨ÊûÅ‹Ýl’SR¢²¸èiÂZ—)¦v›kR<ñ‘Jº#[èq77WSI°Y<ÑŒ´lúMT„´ÑK§ÄÏ#oci@£cÂ7SéœŠbˆ˜µ!Åjhã;[3¬!{cTº•ª\\!>6}äTTÙoÒ1lkÀÈ¦g®[½¾·H…­rÇ™`yÙrê1‘¶aÏæ]Ï7Öê(v›Ÿp†Ã½6¼+û²ÕqyjÍ—«g<™‚ Bld5ï=‡‚ÔÐr°ã@Õ\r(oÁ˜6-3\n~3ÔX°“¤ y¨dA¸<‚\0ê¢ƒªß\\!™¼\0ØÃ9êkÔ:(ZC8a=@‚!µ @´ƒpu7` 9‚’žIÈh²)… ŒA\n¡\$¥ê\nÐ\\ªˆj&HhÁòâË’Ko!¥±+4Jó¼\$(ÆœåxÑYtrHJÐÆ—ÒÙ¡9¢@Í(\\¸ƒ8 Z!/PÆ£TXdZ‹ÜÐ¯¥ø¿˜`Œ„0©ÃC“b ½	(\0èÉÀ>”¬Œõ²fPSßÙ{ä%—‚ä†ÀŒ*âò4\\ È\"WV%ê+ØDPVKI&a5›¹Å²ó@¡à8•ôˆ—²ø’Ëõ°ÁX8wa,,7 `\\Ã˜ƒPê%E¨Ö0Æ‚Hm¼6±é+ò|ˆá•v5³kÃkcÈqB¹ìÊ‹©2¤¤ý¬s¦¬µ(1˜„“0¨\r*Þ”ê4. Øìƒ¥BÏV¶C4ÎCÉŠÃGe\ráÊ]FôÚQ‚6g¨ s^{–øÑê6G-º,•b_\nÛ£}¤9,³#R„`E§ìÁØ	QI-GHU\$ú“0†£g(c”ëŽš£Xk€ekhj	3~…Wu\ráÞµ÷ÓÙtÉYq`ªÅ¶š°	°©¢Ôa}DCf»Ãš\\Ö<ƒ„J^Uy5°îoƒhˆá¤3¯ðAHi©¥vÁÕ(ò|PÅ|ÄÅm¶£¨òíIÔ Å¢”särÔŠË‹õô­#5€Ièd»O„Ì\$‘ ògÖ¨ikk`±üošú-ø9¡pÌ‚lŠœ‹RÇ @Ç\rÐ…5­ètØ¨òÙÖk–@'…0¨BÈ‹Î¯øÀÛµ\"¨YÙ{R- ¢Blâª•èªµ8‡œûî×ƒVO\$ÄÕiôJš+}ïÒ×Fp ¹ÙxnÂ— b³€Þ„À@«@ 5«¼#@ ·Cs[\r3Én.¼Ov.hr4ˆ(öœttUElÁ+D!ç&Å€ÍÛy\0('„à@B€D!P\"äÌœ(L¹QOÇU€Ø*N]T(’¡U…4é`pxPåb€J`&GJÙ²_²O‹”Â%Â%&)‘mÒºG&)(Ÿ!\0‘nq(5ÝèZê°A+ùA°1ÑP“a`Kóó‡K»F3\$F¦Ù»ÉÑ-æ³öNù<ZXh˜ù´lMX9ö:ÍTüOá†«Å¬ŒKˆAïEŠÍAƒ©ôÒåã¤KÍ¤îëš‡lp¶OŽuP¬YŒÑ‹•zzŒí\$“’˜ÐÉ³ør\$9Í3¢h`\n\0\na¤=7ú¿<¢S\na”×Ö*ÔðÉ(|04[×Èµ¤\"ìË7HŸAÝÚÖÍheäÑ•´ÎÿÎÆd‘6æÆ{¯1ü[‰?wò‰%šT/I¢æÜÞªj9)K¹¹“ŒˆÜÎ£ zá™º¼ÜNóæJpš?Fw¿jÎ9PÈ\nÅ4QHùô×åÊäOlr'óÇÖþÞÞ«TfR¬ð¨C	\0‚éðD)+‚°Ý¢\$äšhSâo“¬Ò~ÚžˆÀ¼f¶\\Ï{×U±¨Ê¤ÒR{Å„h„à¼ÅëŸ6Ð(:eE¾\$¬J\r‚2eå·¤&ÜAœ:%Îç‘²h2>,4§…ÂŸÅ\"¦Î‹Š_Mä\"?P\\|#oðÅWÄ£OÒümêG~Ê>™	î½Y\"A3ãdÈâ^¸5Ÿr?¤J£?Àš<þò¨!/1*qS\$€ ê>ÉE…±Nª£’³é)÷¹‘¥e†¤R«¿ÇRn¶b¡F9Ap  òÏ&|GúÂ†|„¾|#ÞxN.gäHg&”/m*ß\$€µæ˜\$S©Ž.Cöu@Ú„`\"gè†]¨¸0BÒÂ~X·PQM°iç0në\rT–® üÅviN\$&Æple\":ìÆwnT-¢ØÄÖn„ª\"˜ìz(e@4ð&xÈíHð˜×»	¤¹,	PÒ÷#ôxí°?Ž5æÈ+\$žâPâðl¾«Bü¨Í%5°oOòyM\\Ô­`ÓÍ¨–‡ô0ïØy…v¨â>ÇÊ€m8ÔÍ0}qÔ‡Ñ\r†ˆ¡Ñ:|íu08ªMùGµç«°o\r§§\rèÙAnÓäT\"bBuÏrîê§~+g åêò&\\òÀ#.MˆíÏÐ®Xþžñ’Èh1hã©âkî]0{çúTCŽåqÀ1¥j)ìô!±<U<«\$Päÿ\">/¡P˜/Ämær0m’öcŽgNIÅê*±ñIx11úüB\0î	*î‡*.fÁñèäDÃžÀŽ\$ŒF—bäÜ<m’/r!&ÂDíü1«î[Na‚ªCó\0ÎDä…|äÎpyŒÀH‚cqGf€ÏSPZ-²‰mS¬¿)	a‡¹(pQ(ÈºE¡WRƒ-Â¯)Gù*+*È>ó+mÇr£,Ã”gb'\0gôl‰fuÅNiGˆ9	Ï\$.Ic\0Ñ}OöÒð;b³¡\r+É(N›0‘])rÀ(313'„0/32Prubú~ƒ%-ó<Ds2³9+ó=3 2,ûZ«„Ù/Äc0\\ICðó34S^¢se(3a65	7sA-=8qVRÄ6n³ pé,pÜ!d›Q6æ%S5ÎbsÄ‹7Ÿ;.g9Q„(.vý“®u;S§9g?= L‡£*¢&ÜsY’hTƒ³\r;®\$JSï<˜UøS¨è.Gœts:áÇ¯BÐfÕ-ãæÕNE²ó³2ÖätfÌ#5ƒm,ß/bQí‚Ený\"J¤qFË-ô8ç\"\"t'Ã¢iÏ/®P)4>@†‡ Øk¾\r Æ\re@…Þofú7ˆT\ràÈ\r Ì…¥Ö&`ŒÅ Ú´„.´†\n ¨ÀZþ‘ôŽ=pBîëxýc7ï+'â«\r¢FòÍ@Âpˆi 	´I\0òá‡vn&grrE't'¦\\çÇÆPpLï7ÐÒáUP–?4	€ÞÄ8°£r8/—Qt¶=‚è%+SHâ·ƒì3å.ú†y/Ízðêhó?Ñ¢I¬ì:Ð0PyU(@LYTõ_>s&S)À¨P#f4CH³àÊb%	NZNG¢åU§L;‹^KÂ²hDÜF0\0ÿUgW.\"U\"iÑl0çJpaT)õ¸ªPïY\r\nñL.P‘ðÅZ\nÅ¼ ê\r­Á64Ü\nIcŽ&ÇS£¤øÈTŒûUc'Ëm¨Ó´..häÏŒêÐ”BÀ\rìvãV7e56\r»_RRVªKOôþéh?’¶K@	\0t	 š@¦\n`";
            break;
        case "bg":
            $g = "ÐP´\r›EÑ@4°!Awh Z(&‚Ô~\n‹†faÌÐNÅ`Ñ‚þDˆ…4ÐÕü\"Ð]4\r;Ae2”­a°µ€¢„œ.aÂèúrpº’@×“ˆ|.W.X4òå«FPµ”Ìâ“Ø\$ªhRàsÉÜÊ}@¨Ð—pÙÐ”æB¢4”sE²Î¢7fŠ&EŠ, Ói•X\nFC1 Ôl7còØMEo)_G×ÒèÎ_<‡GÓ­}†Íœ,kë†ŠqPX”}F³+9¤¬7i†£Zè´šiíQ¡³_a·–—ZŠË*¨n^¹ÉÕS¦Ü9¾ÿ£YŸVÚ¨~³]ÐX\\Ró‰6±õÔ}±jâ}	¬lê4v±ø=ˆè†3	´\0ù@D|ÜÂ¤‰³[€’ª’^]#ðs.Õ3d\0*ÃXÜ7Žãp@2ŽCÞ9(‚ Â:#Â9Œ¡\0È7Œ£˜AŽˆèê8\\z8Fc˜ïŒ‹ŠŒä—m XúÂÉ4™;¦rÔ'HS†˜¹2Ë6A>éÂ¦”6Ëÿ5	êÜ¸®kJ¾®&êªj½\"Kºüª°Ùß9‰{.äÎ-Ê^ä:‰*U?Š+*>SÁ3z>J&SKêŸ&©›ÞhR‰»’Ö&³:ŠãÉ’>I¬J–ªLãHƒHç‘ªÜEq8ÝZVÑÕs[Œ£Àè2Ã˜Ò7Ø«ŠùÎ­j /t°âZâÁ.ðñ OÐõmÕ5”cCmÒ¨L¦X#äŒÄ³8éÂQ‘¢B«Å¤C*5\\ ÒÊ°˜‚2\r£HÝFÑÄuGÒ„#ÇØÃpÏ†FÑ|cÆ£¸Ò:\rxëŒ!ˆ9ÈÒDžd#@ä2ŒÁèD4ƒ à9‡Ax^;çpÃ€`Q@]Œá}ˆäy(ä2áÜ\r±\\kÑXÛØãpxŒ!òãn9)‹-	;ë%Úï^\rÁ©jÊ£äú]U8{Ä²ìòüí»{vÒîM;Äò@O;D¯Kb¾¬UrÑ\nãä7`C:<ŒˆkT´¢`O)Ë(3J>M+È{’žPHìhtTÍ4¡ù í¢S¡P3	ô÷8µi¢q~¢¶¯c+3ÜÁC%~#ŽéÃpo	Üší×Þ8+“…¿‰yqj‘L\"‘=¤Êw„”V²H¬y‰4ªG²Ùú(:Úº,ýyÞ­\"ú•#í‹óÂw¦DX\nA€Re+§’n@Þ‹n{%4•ä×‰Je;Éd²&•yVqèAL(„Â—!)?FL¯A.ôùÖPÇ¹¼®föx!ƒ—BÅpý•àÛ¡p¼n+²\n‘%èâ©[{Z½Êqañ`9ëVœHŽçùè!°Õw¬õ¶tÎê4ÉH„4(L	\$\\x€Ã/WsaoÆ¥Ü¸%bœiTA!DÈ”©ž4&l6@äéN‹Â;æl ôÜ/KŠ~‡%ÓÃˆ\0S4\r4ÇhÏ<S€HÐQ&*¤¡3Ó’|È¡ö†d4Á/I“Êô sª0–xáÎ8 sf˜±’2¶€LWQ0A»»Y&W¤©y“\nMÁ=\nÍ©Õ]’•zÊ‰>¢åYß\$ÇîWËÑi,œ¬´KDP§Ò°•O*í|„ù2öôwKì.¢8šâ×	)¼Š°ïÊ&é<LªXKC˜tžÒh*xÔ¥=\"P´á…R]Ø–ÇmI9˜(P4BŽšˆrÕˆ±5þÀXrIád,`ÈÁ@ eL±—3dÍ³8ìéžR~šCFêì:5V’©ÛTbM]¬¬¢þ€¨[¡ÏÍqÈiKI‰:RK§+ê ê7˜Bx¥—ÃzÕU9ø(X'ƒ+3º”Ò¶ZËÙ‹3f¬Ýœ³º@ÏšB\rÍ	a,EŒ²KKA¨XÕSð–* >–HèÓOIO2¡¡§ñ|;¹ –bây3mòµ¶ÕêñãÙT­z°CÚŽ@Ï³g4¦¨îÇ¸^¹S°å^ÎÑDjÃiêÈh6À@‘¨pEd6†W*C2Ã£AÌ:°æ ƒ­¾\r¼3°+vÆÃ@ cˆÕYÜP@Ù]'\rÔô0†ÀæsÏL&X«<©#„	x¼<cf-°ÐT§yp …ëAó•D¦sHAn%æ¥š0¨IQDk!†:zÄ®ÐodAÈ4‡`Ò­C=ÆdI	+\$vÙ½D—o ¹ÂläëÄQp-4›Ð\$T‚4L4\"†žŽ™sHŒ<]k·‘Cppcì‰\"¤vnÃ@iwe€†vaoÑ®Ga†ŽT”mQJ’Éž6ô.ejSž–¼é(˜{_\$î	,ºˆôž`ÝÆ\$R±5ºã{%¤\nyK3ÜÊD^yO\në”GXîÒ¹¡JÀ·}žÒ+ jñTŸpXËÚ“\0ü\\	…‹F_BÈDV8ÒòH¼R—%\$–:LùÈ¯™!=òŠˆq±k+.”4Fx,ë\\X·meJ‰7 &ùûÅ%Ú™JÃi%çw/œ•K±[mBêTšßÔ³%s©aròèZÉ¡ÆÒA*`r»&	/)q‰øOš°—àuù[A­œmJj	‹×Ïû>sèèZ4+p³‹¢] FéŒÈ(°j®'ð7DV\\÷Z=r“…ô«VÌxUªm:A '§‰ýŠÊPì;¸wYâD°6s Dðx€ž4Äiæu¿ÙÍäF++¶©ˆ>lq§\$3~H:hbºì‹d5ë§EO¶Ç\r ±~ËÓU(•ô½*üÝÔj)ñXdu­wXàM™ìÆ{-û7Pí1WµÌ„êL vÚ3f¹<Eiêµ<á€ïbAY¸\"ïU¹Ê‹¹„Ò­etˆ ¿øä^Ý¡áËiÐ\0‘ˆœÓŒÊÆ5\\BïÇâ?ÊË„Ñ°MÏÙôÊ 87›*.\0óEnG,YÔnè÷n\$†³3Ëèç?¤ó§Ó\nŽ/<î&œóÔ€u¶¸!IAºó.ÆÝ“àb7 âû#aàü*78Eç?ƒªê_\">)¶ã…ü›–Fó·g9†Ú+üŠ5çÀB#<°ÎV+Èd0Oð‰î +«³Ã6³HvlM Ù\0ôAê\0u‡.Iúé2ïåœ?\"F!.Ö7D©êPFí®®èP [£¥@‚\n€¨ †	\0@ êE\0ÒG&elNG«˜a@äXd’Tí4%¼”._sÇ6à@#*8ÁhsPªQ(FâÑ«H©IêJ)ä'\"²Iç7\nÊ–Ñ„+<ì)q…+	Ð¾]H‚yÐ²6GøN…Ù\rBÁ\r­Ð9ÅØ„žüí]	c€óˆ–mPèú‰ãñ'‰qPâ{MQì+ñ2êoÕñD½çúmäQpPúK¾M¸p-€qc	âjzPÐ‹ÂÕ°Ò5-@Ôá|.!</öä-ö[NØ%ÑšLÉøMÂÖôÑJ%±1òÜÑ¨Z	yi¤3‚ «fö)àHŒ\$mÑÇ	#zÛÂ>¦ô;N.3Ãü÷mºè/Œ*†­¤‚Brâ§Î@Bjà(¾—§ªÀ°¬àúŽ \"bâB²upÁ!‚®˜ïRöã èî|ƒjñ.´ N¸ª¨t{\"bì1Hïf­+’-.¼R®Á%¢ã%H.Ô-%ë0oR’#ÒûRVû’Zs‰ŠNˆÌêïÁH´â–oòX]’MvwÂ¼(G¼O)DJLÒ´ÖÆ±À8 ˆE@à±b/…Öü\r–8Ž2ÎØh¬AÒ˜‚«bœE\$Œ§*Å+´ûïÐ×ìÍ\$EØá+H7GLâ¢Ç.ˆR+çF,ÀPxðîT³\0S)gú]H¢¬\r|”RtÿN‘&cÐ.34†s8ŽN²¢2vQ,Å#Çn2~JÑÁ3²‰!±–ˆ‚q)-E6N¡4ðQ6ò.²¯0“blÏ›(mu!¯!4.0–èì×r5MóHk7“Ž~“¥\"³©8“sb‘ÂÂºõ“}(­µ<b¼Úè`á0>xæÖ&PôL#óe53Ÿ\råÕ=+=M­'Îõ=ëñ>!a>p­QÔÒðÖ+²QŽŽÿŸ;“ù/‰4DÒß¥Bç%Ó»0RzÔóÂßÂ¡rs:“ríÂ£;ã1®.ÀÊ°áçbwDÎï ï‚<(ºµc|µÉ^:ëêc@}Blª§LÎå¼8kX]ƒôJÔ3ó@fÄ„[/Í\n	~¾E.Û1VNxwx”S;CÁCHñ&Ïhƒ3ÒŽôfCüé\0Ž]\0èaJB¼äÏ€û÷C”''‰##qKOµ3ó›B³òúîd]“?DòLÅ•(èÐî`žõ\0tîØQKú{8R`ŽâgBÇcQ§³µ0¡³—8t=Oª\$ˆuDÏi%Q.ïEè)ÔÅMÈx4îïUgÛQÎß /—Vé ¾Ao’P:ar7'Çåîšd¨çIª6K ;e²½®%Ôm@tGBS™B’e9ó{ZÃe3•PUNÔôAVt\\TK=:ò}VoçV±~zhÀ?¥_Mµâ×“mõÓ@ˆ‡VX4á	^‡«èË:Õw-SÛ_•¯]RØÒ#I¢¶Œ†¸\$‰¬MðBµTÃP’Q<2óPïac(ce[c­WTS]ðbÐùd¬lx-?eSV+Ô>³µð‡Nâ«3d˜ôvhŒ•+`=¶GböehR®Œ“\rP4:\$Iý[°Ü—T¶Wa[OÎÿ_2PuÿvŽlH8ïÿP v±fó¥SÒk\0¥Q;O•Ì!VßmmU]e•c^xü¦ýn`ótÙ6Çp6ñjU‘&5sT5~çÐ\\[ë.Îµ5m“j§šô,ÆÌmnõ;õeå¼Æ—& 7+:·o±â¢2\0¯Ç_¢ ôâ’ Bõd\")ñBig=Îø@uÈÕbøAPÝwíRrÎ·_iwxu½AÇQ1È#°¨”’£ µˆçèÀ.ä…	fQ²:qWO4ÔBµi³|nqUyb¹Ùyì\$ÀØbú:bbèG\nð§i¶S>K!G—;\\·¦Q„ØÜ÷IwKDè\0ª\n€Œ pI½Ï`kÑ#sësÑVÞ‰B~7Ñ>•}Ô˜ÆHÇƒñÁz–˜i4½¢+qÑpã‹)Ò„ƒVv‡n>#÷¬ÅeŸ@ãöYÖø¤+èNš\"tX^ªX;Öþo®¢íD°ùâfQ%JÇOòxÄâwD³3¤TŽ®y†Ítkøƒ(Iµ|†óéÆÝV#&ïjÛ×•0¸áèÆ4ª%/¶Ô8í/çèë²;*LwŽtÏ^Ê±\$9‚‘¾7¡LÒY9\$uj‘&¸ÿŽ®­’¥Ø“ãj›M:Ô#“x…K5%Pî|5§Av×³P”W÷†™\0A%¦‰a öò'2®+3¹m—ˆï—Õ\"üí£Q¼SÎÈ]¸^ooaîˆ9OZtbHJnu§úåZ”9D½ÓÌuìOÙ¼A–»‹¢ÿÇšÙ<á‰u›<×´_H\rhç\n´3Ô8ŽÆ‚/†/îs<Ó>r¾@ÞÄPì8Xv^AV•h2ÝÈ¬Ö¢ö\\ÇtâA%Z5Ý×­q‚>8\0";
            break;
        case "bn":
            $g = "àS)\nt]\0_ˆ 	XD)L¨„@Ð4l5€ÁBQpÌÌ 9‚ \n¸ú\0‡€,¡ÈhªSEÀ0èb™a%‡. ÑH¶\0¬‡.bÓÅ2n‡‡DÒe*’D¦M¨ŠÉ,OJÃ°„v§˜©”Ñ…\$:IK“Êg5U4¡Lœ	Nd!u>Ï&¶ËÔöå„Òa\\­@'Jx¬ÉS¤Ñí4ÐP²D§±©êêzê¦.SÉõE<ùOS«éékbÊOÌafêhb\0§Bïðør¦ª)—öªå²QŒÁWð²ëE‹{K§ÔPP~Í9\\§ël*‹_W	ãÞ7ôâÉ¼ê 4NÆQ¸Þ 8'cI°Êg2œÄO9Ôàd0<‡CA§ä:#Üº¸%3–©5Š!n€nJµmk”Åü©,qŸÁî«@á­‹œ(n+LÝ9ˆx£¡ÎkŠIÁÐ2ÁL\0I¡Î#VÜ¦ì#`¬æ¬ž‡B›Ä4Ã:žÐ ª,X‘¶í2À§§Î,(_)ìã7*¬\n£pÖóãp@2ŽCÞ9.¢#ó\0Œ#›È2\rï‹Ê7Ž‰ì8Móèá:Žc¼Þ2@LŠÚ ÜS6Ê\\4ÙGÊ‚\0Û/n:&Ú.Ht½·Ä¼/­”0˜¸2î´”ÉTgPEtÌ¥LÕ,L5HÁ§­ÄLŒ¶G«ãjß%±ŒÒR±t¹ºÈÁ-IÔ04=XK¶\$Gf·Jzº·R\$a`(„ªžçÙ+b0ÖÈˆÿ@/râùMóXÝv¼”íãNŒ£Ãô7cHß~Q(L¬\$±‹wKR´ÂÜWF5\"‰,Ô•â_-÷eRÚëÆ–­Š¼SÒ8u*P©å\nÙÃ•‘8§Ää½XTAÔ©Jªä–åàP‚2\r²dØOÓÍ>Žsý#Æøß²n‘ NcêòãKøïO£ÑBPÃÈæ´4C(Ì„C@è:˜t…ã¾ä9æ}8Mã8^2Á}9Ð´8^.AðÛ7¼’`Í7¯Íü7xÂ`(gd±7DzÂ·+Â/FQñé§åÅ1A8Õ“IËÁiÒ®\"ñ)Eô/Ñ)øT9tUÔ±MãŽ/i‚¸è½Ð78<šÚ5´~‚B¸Â9\rÒ`Î„£%=kàO³í¸¶ä\nÐ@åË¢—¸¸Ý!kR{{JàTùLÑ84«sEq•\\ÝÇ¶kˆ‘0¥]u6`ÂCb}Á„6PÊ¶ˆÃ›wnxè%CŠÔÙÔ|d\rò¾åd^ú9Uë¡s—„@AaJ,­—²ü¢àÓ0¬Ìâ­¶¯á©0|êTÕ®r…ë1ìä)sn„,!€\$D*õ*&\n#ôpƒ¿†\n @l>kÐ0Â’HQ	€µJj¹Vh§ŒÙ¢u–ï‚”Bh1’²rØgqpƒnÅ–baI«„°‰0txQ1&®áúÈ1 Þ|MC	SHÁLÉŽ+(T,¨µ©Y#y©Š„ôŒ%hòmÅÃwìqEÁ% SÔtHwÆ`°Êá>îM»É7†SÉ\${%:&QØâÇ„Œ‚ BêšA<E®ÁåsD¬Â‡ wNûÓ<¼3`ØÏ”K8Ä°S1Inyçq¡¸<‚\0ê¿«Jiš\0ØÃ:Lm€:)ÚC8aI€‚½özƒ©úÌ¨’·&ä§)… Œ°ÔY­-Ä@¦–hœaEq+‚hÎB‡N‹Ç©œS’s;@ˆÔ¬1‡îéY°\nf>N,9NæšÁ; é±°5þ¿C#?lG²¶vÒÚÛkon-ÍºÔ6ð›Ó|éáy‡GàÁõ\\qÉ5È¹5`Ër›/n’òÝž\"jÈ[”¾¬Š1{lrM\"lÍÈ¥£nÜ¥8S‚ju?Tõ¿¸¼šÃÀp\r-•D6ÇS[Cjm¹¸7 îÝ°nM€¹¼·¶ú¾WÚý_î\rÂ„ÚpmoÒ²ƒåÞ-“W{GÒÜÖâTlvÎ³›x2´ÐÄ3uFYuaa•|wuÍ/›#N#I«Ëü5PÙƒä	²ž['´C5‹OÓÉÀOHµ=çÊjj§ðù†ƒÈÃ\r²ŽÊ[0Óš‰:N¢X”B£M\nUjuÔ“Ã³¦€H\n\"WCFYTlr‰&ß˜\0P\\M%Fä\r¢Öi˜É‹)Á\rÚ ÇWšu¼='¬öžðÊö”\0r‡Èÿ'¶³wÃxwÆê\$Ï%zì+“R¹“]{ìÙh!òkAÍA´ºšã‰\rÁÂ„µ·\0×^Ðw?¡Œ4[€ÒÛP ¼7ÔòEàê¨sïJ&€°¢,/GáD&xf¿ Y¢[ #+(cÅH)¨{ÐEØH]`M½y;f˜%]2b3Åû»nÊM{©€d6JØSzcI'y —´ÐÉ|·gôù6Pãƒš}É¸6ÔBÏòÊjsÝ;_\\z Ï‚‰Y	D ;¹0/0€O\naP‡Iˆ@UhìÃ“:åa¡L…<¢ :8EéHhçtú)EƒºVEZp\\(†F´¿ýC\0Š¶¤˜)^l_¸¿;­€on­<1fp@ã ØÔÆ´‚¦‹ïh4ÚöŽÕ¸V¼Ö!Èñ§í¬”j™+4D ®ˆuâ2ee-È†2aƒ¢vÌ|n­Õ·»óQ¡–Ã#,Û±ŒÏ¢\\½£ä(,’ŸCÎ\$XÐ´°¤v`ÄÞ\nÁ“·*Ã—àŒà„j(z>9bÙÑÊé…`BÃ§¼¢Ã«­xî÷kDiŠmÎz©î¯¯»²¨öùHrP J+(Ý]Ÿš*Ò&+½LBñ1‹{™šL¶9ùÚÚýö<ç/’?Ó ÁyãJÁ\"(¦sèœš•È¨¦[ël¼J™IL)Q:…È.öÀ§pŽÏ’ËáÎQLD2i|‡glHQÈÙòTDc·²’ú+\$”j«F\\gÎ«MŸ'ÝJ#+)uø÷¯Ó)\$4‡¨‹-}	áL2žì_àòQð‰SÃL.T¢¬ëi˜”\nR±òM‹þ›ïÜ{CØ îu¥Ð)püÉJf\$\"îÄý(8öëä€ïåD¥Ç‚vhüëNÃe¼yd¾F'€Ì8Æ2ãä0ä%˜\rºñ%êÍÉgøÝ¥Ï¶ÝÎy\$ˆê§P‘oüyÁL†‚ðŠÈÔ°Ð@åÄºIÊîÃ0J.püîÒTj)ä{B0)O]oÖUƒ<£bˆR0Êè:óNìåz‡HôÎ”’pz ¨\n€‚`\roô›L|OÀàÇ#ôQùïf‰È†—®ÌŠ—iÈÒP\n#g´àAªî~{Ç´@±<vÞQHÌW½ÐEút\nfñjô.1BwÑF•‡øbvÎï¦ŒâÝÂš(Ë‹ª0p8PF‰q]‘z(ïoª¨DÓpZ1tÓ1”ðo604‡…	(G¨ˆÃLÞ'4ÞkŒs#µîŒq‚Œñ†dQŠûÑhñc‰±“‘°/q@àèÄŒ‘ÇÑR’p@Ó#ª,äO„§j_\neêkÂ‰'i ˜â®0MÀî\$(-%Z¤QXüûQå#Çzå‚ô,,ö™â¼¹ÏÍ Ô«¢œqö¦ÑDéq\$XrâÜ£BžÉIs'+’öñÁ\$¥X%Bå’L!Ç>/tÄ`yårxå\";Xÿ®É'ÊÜÄÇXåŽ2læ-‡Œ5Pí*°Ä7Oš6çV/¦/%Ò`åG2ˆpz@¢jw°Ú¥ðHc2ï’Zùçš‘\nð-L¦¯\n-ÏjiÑ´üç–R#s	‡Œ2@å£nÅ•&±^¯²Z¥Ñ2'w2“\r¯\0ÐŽ¨‡.Am1‘a'd-ÏÎw¯1ù1M3±–V‘´¦“gÑZv«¡5±­JkïË6IKÏA\n2i8“u&ó‘61r/O’ç§Õ\rE*Hæêé.#\rs†©MÀà]â5òŠï†¸òcJß(Ð4çïpîÓÚå0b–Â0ƒ.‹}Î»4Ð8a=4	 È÷/‘‘8Sž®Ó1Ð,ìa 5hNç%Ì\0Pé3š0®šKàR‚ÒŽ­¶ó„0ÇŽÿo¸ÿ³9\"%øñîñ?ç‹0èbèåÏ3d-Aó]3ÓyDÏhúÔR’1UGÓ‹1³?FI4òõ!“Ôxrk3s¡F–ì¥™²k6´X3SqEòbV3w6˜“éW&¯>Š“†ñ¡Ls§L©Û‘\$2ûAÉƒLÛ:ES/0Á0ò¯Ò?I¢¦±šXrÕ(ƒ¯C’\n,CÈG!EÑU1Ñ€CÓ;¤.w´©B•'¿?;MT;gËQ²³èî,•95ó¦,åƒÓœ•tW!t¼}«B4¯UÌ8…ñãò(;4×GôÜU5tVO/V4ÓJÔ‚~©jÀÅ 7!PÆD0­.[•2\\ÒÀ¢ÚÚ¯Z…XRz-‚jxÑ\"LHð¯tg'U®Rõ²}5[eM*é;@é€QÕ¤!Õ_)j}ïr&U¼åòxëC	Œ,Y’±	ÅM8Šû,†!•ˆä`H)q>áM]¥ £”w“í&	ëää”75u	C'p#8»/Õ—W›euâ¾ÿUhJ³sY“`K6c9”NõoS¶ruÖyYMöó2á\r5ý]Ög&óVÕWH`-Ö¦oeTêÐõ7XTõV¤øÆhiX4“U…Skµ<TJ5€Ô¤¯\r½j´h•m¯Ç0ðÃ\"CŠÜMôGù,¨['öð/ôñ½L6\$&1\$hR¤)5i-3ðu¹f´]göÉW!=‹—Nue–}iõ‡sývÀfÖ[hZ-ˆ1sueAeNÖçhÍÄ5b¢`îhÄlûJéA¶°ó˜AïŽ†5“l6ÙvOºw×l#\nc‡tÖ‹O¥ÐèŠc\\à}®bÎR^ ÔUfŽÉV¯ÑJ·\rj¦æS¹·µn5YwÃt.ÚÒ·²wö­w”§ôØñWÄU7Èx÷Í~Óww_w¥O}¢ºJ7ö¤7ÐßWcb²=\\V—6Ô[K÷ÁO3ŽU)4-Ø—AP÷>úw×kx\\)	cÒt‘2ÿ‚¢[tµc/Ëí :×·i“oiÖµ‚s{xð…×ûs·a~˜gF/e…–/p÷›…8ylwï†­1†ò/vÕsØU‡ð‡ˆH™g¸Ÿ\r®qlÓ´VéTb„(÷'{¶mEö]j6	‹°‹s“ƒ€WrØ‹pèç˜†˜³ˆ×ÙqÞ@²Is4ÿdí/*¸ïj…/z3ÎM•AQÄô‚¡QUHTUM“k÷OrñûõN„yA5|»’6áƒxéƒÍ¼ä®R*,ÿVBÂR!UóA“í¿mŸSóÙ“Ù#2Iyó-‘WR«Ro iú\r€VØ`Ò`Ö¸kH£ö@Þ€ÒÉÚjÂêÎ\r¬ÞO¬Ö `ª\n€Œ p^Jš„š.¹m^•!µG“•LaiYYù%”Y…7™+–ùÛ-YÞ+õJ!Ùå+9é”8çžóa7Ó–8ï&Ó£ŠòË¡\\Í(–D(a€›šyª2%‰]\n·u‡IœQÑ#>'@GB1cîÔ}ó®êÈ£~7ÿ&®l 2\\'ÿdÃp÷cà˜àG´pì ?\0Zrn§¬ôMC%ÇL™ÙPò–ê®š2DÝ'T{R£!'cnj!ÂŒ8²Ò;VÅ Ú«:µKç±ðízº®øë:“¬\"j8’± ºÑ”šÕ6u…ø{Ó”xh¦åè>CÂ<lÔ¦ù™€à«Æ{e¡yZ\$:ööwQz¿­iL!ÈR W/âÜÂ‰;ŽRïl—-pî•ÔB9‰T)N]'õ Ï†024>éˆ¢)ærï™©eQž:à\nÆ’ ê\r·Ú8˜÷¤Hó–6:Óî.³è§–oS>‘¿\"Ÿ«\"ñ«lzù\0~u½DôhïÎÉ`ÎÏ»ö@cª(šÆí	w8Ÿ­£N\rî:ãÔ?X|·Ž}PËpÔD¹a—Ñ‘oÍÆƒwÖ@	\0t	 š@¦\n`";
            break;
        case "bs":
            $g = "D0ˆ\r†‘Ìèe‚šLçS‘¸Ò?	EÃ34S6MÆ¨AÂt7ÁÍpˆtp@u9œ¦Ãx¸N0šŽÆV\"d7žŽÆódpÝ™ÀØˆÓLüAH¡a)Ì….€RL¦¸	ºp7Áæ£L¸X\nFC1 Ôl7AG‘„ôn7‚ç(UÂlŒ§¡ÐÂb•˜eÄ“Ñ´Ó>4‚Š¦Ó)Òy½ˆFYÁÛ\n,›Î¢A†f ¸-†“±¤Øe3™NwÓ|œáH„\r]øÅ§—Ì43®XÕÝ£w³ÏA!“D‰–6eào7ÜY>9Ž‚àqÃ\$ÑÐÝiMÆpVÅtb¨q\$«Ù¤Ö\n%Üö‡LITÜk¸ÍÂ)Èä¹ªúþ0ŽhèÞÕ4	\n\n:Ž\nÀä:4P æ;®c\"\\&§ƒHÚ\ro’4 á¸xÈÐ@‹ó,ª\nl©E‰šjÑ+)¸—\nŠšøCÈr†5 ¢°Ò¯/û~¨Ž°Ú;.ˆã¼®Èjâ&²f)|0B8Ê7±ƒ¤›,¢þÓÅ­Zæþ'íº¦Ä£”Êþ8Ü9#|æ—	›Á=\r¨»ú™ŽQâè9ÇÄl:âÉâbr¢ª‹ÊÜ€«\n@ÃFŠû,\n‹hÔ£4cS=,##«MÉÄ¸BœBÆ1µS£Æ&ðÅ!¼@43Ul\"9Âp¨XˆÐÉŒÁèD4ƒ à9‡Ax^;ÚpÃQ(¯è\\¹Œá{œŽ”(9xD¦‡Ãjæ„(£2æ6£ó¨Üã|ÁKûú‚R(úFR¯pÃ+;2ðê5Žˆ`ê2²4ÓQ ÎÓŒ˜fºb-²W…‰Ã{,‚ÅTh®0¡ª(Î9¢1=n5€HK•&+ö]˜e˜ô±’JL\r#„xÆ\rËõ Ž©\0ZÑ­¯Jý#Œ£0Â:ƒ-œº%ôºB0êûŒl;ÁIÁ‰ê4Ž`œ¼0ŒòÀÄÓ5£8É²\nYˆH¦+•Â\rCªjèëj1Ì®£\$NF5ë´ò.5²hvü“C£hàÓ±ÍôÓ¢âˆ™KˆÒ<¹‰Þ°”ÀŒN_aøn=3wêýFôýKˆôŒ£n#]ø‡fPö¸YŠPv¨V«ÄÐ\"')ß0*§cÓÊ')xÂ¶9+ï/…õt‡‹×Ìßø PÓ|°Æ£@³,ÞH„\rã0ÌªÉpŸ·ÓôÀÞÖÞpò“Îc­^¬C3P A¼3”Pæ°Òóûm„¢œSöËÁ£h¡”0RK‚pe2ÉXï@†ÂFsˆX)R²vÌ¢ x…À‚Ü±.\n¤¤2ž’Œ‰”ñ–Gtûš¸^IÕg\n…QŸÕ†Ó²t;©¹b™Å²–bÎZIju¬¶\"ÛKuo“‚~}²æÑyxž5è½‰pV`b„€ Tè§‘ì ÅLŒ¬5:rQ\nF°–€ šŠOê¿X+‘8 erÄXÑ=e¬Õž´VšÕZñ9E¨¸–òq9ÉÒ0®pæ‚K’4í\0:Fp|›Òê¼Dä‚©5Ø„	T0#G8:!ræGßbê!dÕ/ÄLHk3kä‚š¦½ÈB®Œí]ÀØ¢?°¼Æ\"pÂˆ:nUOý`@žK ,ÌWeô4€æL` fLî´Ò]Ã™./Eðœ)%šñ?h™I€•Èph„¡ (w¶¤Ê«^ Ä¢\\Ó±VgÑYÊÃFiM9©Dê°Õ›D«fpoò —Á¦/ŽòzáLNS&qM\\m\\*ÂNEØƒƒEK‡sfè†ë2hË:šz%ÊUà»CöI—€kN‹À6é ‘¨5+1¬6)†7§y˜¦¹âyH¨y3E4¢uQ1Ct«6f¬É‡êj€f?èn\"-”ÜlŽtê%‘èÙQåÂjjY“('¸‚\0žÂ¤ýxÕ~[¢<A_É\\D.¹IœR‘6e„!&O’àAœànÄ(†*åäGd;4•˜—>š~ÛoZêÒh @ÜÔ.4Ö’w‚\0Œ(+žQ\n°â×š÷1C’€7-ž«²zÞ„l1!L¶‡b6iÐ	á8P T €2äQ(s&iYO‘°Â\n@Uã\"„À‹z¯eî=Ér«¦+í~	€z4Žqœ†Ò¬ô°PvB%µ.–Ð¾.×ä88“ òÁ…v^0¸×‹¢(uâc¬¾ñQ8ywY;˜2m¥ÞxJ>É=Éä[ž\$ö¦mñž|WÃW…S@·;wrê²n=¡^CNpÖhú°œí—“â{lÈ¹~a,¡6(§Òo+¨š™°¡A(1HE…1”0rvHAT\rù¤¦ß›å\rpÑ»·|Ëõ0åÓØz:AÉA7ž_Ûñq<Ç õ=÷€¼\r\nÇËÇù³;ÈŠDæ”2‡|LÄÌ¦‡0dò×té˜»º\rP8îÕ&ªôC4ÆýØ±†ëˆ!oÄë7’‡~R(f'`k0ß²N\n˜SE™¯“ÊJM£Y]ä|&Š¶p¼7mÐ®bb<×I{Øˆô÷0À¨C	\0‚»/´úèúA¥Ìƒ¡d²•E\n,3h10¸ Á)2FQ™ð²=Ãgc61RbQ!ˆä65¯&Tå‡'dqVšÅ¿àx§\"âí{Ru0ànãèžvd>Fê5ñ?äÜ¡r­±ÆE	¡ãœÀçs>Í¹'vEÂy\"çˆ\$Äèg¦ú‘Â]8'!¯ t._S¹7XâœÛ®C^ƒÆúÿ10\\7¬-Ïû7^ã¼Æ>˜NæbSÉ†Bü;²‚1xJ9\$%M,ò­.›Ñß4\$˜íx‘àÊ¡¹©üþ¦Hˆ\nlœà€™†+  Ãqq‡8‚xòDÂÂÕIEKðº^üøÿ`%QÖk9Îº±_±: ùŸ%</ÎËCï?Õlÿ˜Lös]ë#N~uò·ÊåßŸp¦È|É«ñ‹†§p¨åûwËù¤kï~Døþ¡Îüº¯ð_¹Ú ÁnÁliÌl\"·¹‹k¬ÅúÒ\$Ó(´ãèÂãþÊ\"â†¼³â°ÜÐj©ÒR0@¬ÿÀÉ\0	-\\ªC²Èƒ\nkÃž!Äpg­hGFn'†t  PŒ2.Ëð”# Lx³¤È¥üŒ~˜dý¢Ø¤49Ælùða\núGHû°n{L„üð:'Ïª%ÇÀÓMŒ2ðžý°Šþ\r,x0”ý/žn ôÝLL'OÈä@äÛâ~èÎB\$Î”ç.MÍ\ný°Ê¢€Ã\r(æÐÖwP@0ÝbM\"íƒ*ý°îÒ+¦Ød8ºâ‡	OÆ\rÑ\n#M‰p<'Ñº± äP®9ÅðtB¬:†º'±:gt!ÔSC6mcè¦@ˆD…iÔ×bL 1JxI{p4oÂ Ž8.güÑj ¥®ŸåâÇ¢FåÑ_Ì1Ø«°Muþ„°ý<Ù‡ŠÖqd\rÆn-PDð£	cNb‘±£)ßG¤Ç)}íÂm&æ8‘Ãb ÜQêÖqÃ‘óÉˆ×ÍzÖJ\r ê&á íÆn¦â(cRcàSB.Ecõ)ü`„hòîc˜M»ÏÛ\nOœ2í½Q%	Ô%ÒN.ÒÆ,ç€&¸0æ ¦\"-€ÞVU­´†fkg&Ò~0ÒrË#(aLLI‚>ªÄ„%çÇìƒ¢\$É©¨/‘ûräƒˆ!Ç!Kº8ÇÆg	ñÐ%Ä…%îb%Òp8’ž†š( Ò=\$‚g­­£ƒ*Oœ~M¡2·%QÒ	òÿ/· qÓ-í0²‹ ÍŸ/Mf¼Iç‘!~>%!Ì¯-¦PCi3RSqÜC³2=ÒÙÀìÐð.2Zgg¥c	â±äˆ‚tËNTH¸–®6ãTì“th®×6Òón-8\"@*ÂÖ@`ä4&^1FÖ7è 9£R¼çN:ÑŽUNnél‘;fB Õ;(úd¼\r€VºÓLÚ)\09qÅ‚\\Ë†‚\"PB	¢ ª\n€Œ pM‘Æêîin,¾jQŽ!¤\$ô%t.UB.˜¤¨\"€ƒ6²çÆjçjzÍVac\r¢|¼P*+#Ã3Ä>ó‚ö˜säø£6cÏú´Äj+£ÙdTD\rãÒÊE\n´tSäúúñt-hN´Çd¶ágXj-¸ûíVœÌˆ%&’Ð?t¤%t¨Ëjèö~-UK”gT}At´Ñ\$‰fGÕ;ÀÞè0ÓiM´ÆL‘âbƒ©†Ï#G]ã7…áîÃ	Œp5¶#\0ÞDL40rÛ£(âHÔ`êI,9NgÆ­x'íC9ˆLÂ8kã\r®z‚ßOc&Åô[CpÊ!l˜u”€ô5ZkÏ†1bà`‚äP\0î.‚*h1 ¤@„Õ «>/óüIâ¬";
            break;
        case "ca":
            $g = "E9j˜€æe3NCðP”\\33AD“iÀÞs9šLFÃ(€Âd5MÇC	È@e6Æ“¡àÊr‰†´Òdš`gƒI¶hp—›L§9¡’Q*–K¤Ì5LŒ œÈS,¦W-—ˆ\rÆù<òe4ž&\"ÀPÀb2£a¸àr\n1e€£yÈÒg4›Œ&ÀQ:¸h4ˆ\rC„à ’M†¡’Xa‰› ç+âûÀàÄ\\>RñÊLK&ó®ÂvŽÖÄ±ØÓ3ÐñÃ©ÂptŽ0Y\$lË1\"Pò ƒ„ådøé\$ŒÄš`o9>UÃ^yÅ==äÎ\n)ínÔ+OoŸŠ§M|°õ*›u³¹ºNr9]xé†ƒ{d­Žˆ3j‹P(àÿcºê2&\"›: £ƒ:…\0êö\rrh‘(¨ê8‚Œ£ÃpÉ\r#{\$¨j¢¬¤«#Ri*úÂ˜ˆhû´¡B Ò8BDÂƒªJ4²ãhÄÊn{øè°K« !/28,\$£Ã #Œ¯@Ê:.Îj0·Ñ`@º¤ëÔÊ¨Ìé4ÙÄèÌU¦Pê¿&ÂJûÒ)¥ít9I0ˆ9ÈË°!ÅSüí2!@Ôš\$ÃHÆ4¦ŒZ¡£&fðSƒM<Õ¨#Üí€P‚2&Õ:M\0Àc|BD\n0ŒcB7èõ\"þ¿ãºX44•»WAÃÉ‡‰ ÐÊÁèD4ƒ à9‡Ax^;Ûr?V¥árê3…îÐ_£HÈ„Jˆ|6®¨êò3.©óÙxÂB)@Ë\\Å+Õ\"£I¢j/E`N¡Ì¨Æ:!L†Ç%l.š5È\$7â”µ2š1,[.ÒßÊœ+¤´­y&„£ @1-À–åùŒyD\rƒ¨Ú½G±ü)CËÉ­Jl¦M[ÃoBönxÊ3,T\n;/c¨ËP#˜TÈÉ/9ÕC;=\\TTø†—° Rh8ÈÃb;\réHØ6\rúhŸe;L†	]\rÊ3œ&ejmT‰‘RñˆeÊ2RÜDÕVOZîæÄLˆâÂÀVî22\0¦(‰‹¤—«à˜Þ;‹SC§§ ‰8­3…Ž{`Êôˆl¤>û(}³Ò€wÑ/—õhï[\n\rk^„F¨š*º¤€PŠ<VÌ‡r2÷y£‘uOÿYI9â¥ÚêÏK=ÌàÙ0MJ’££xÌ3Cµ;€¡ŒqUO‡² ÞW	ðn(hÉ0åtF1Ša!¼¼\$2˜ aá„¼œcìÍj  9‚’bÿƒYÚ)… ƒ±C¨@?àäÀ‘˜n5Ä”“•eêb’;÷oä7*rx¨ßÉø_ä’˜3äAW¡&B‡x*µÀÌ<#%“,Ó´’ÔZËam-Àî·•ay\\+r†à^€KÒ÷ŒÀˆFƒøw—Êû&\$ÍM‘†ÊiŠèp\r!Èþ@òë ²–SÈªxcyþ7™t ÔcØe…‘Yg´ø²µVºÙ[kuoÆ\"a2p;IÊ5®â(…º¨Ž ù3#tÇ\r™50„ã ¥J©É8/`Ûr]Ë’¤DèTVJyŽÉÎ\"‘ÕqÂraˆŽ”\0åJ.!šE er§ KrUa£éD(FlÊ7ãØ^Ó¢90ò‰9ü`ŒÉ„0ÊA•ÔâÀH(P	@ƒô“Ø  D jE”©¾Gê!ÄÀèW\r`i5ÆÂI· AQ©ZVDy¹†ðï\$‘Äí;J^xBˆTMÓ Tv“@æ‚ÕÔœëÈ7\$²\$xw0Œ4Rîµy¹m¨t\"	ÌÒn\$²Ò\$”çIÐ 'µHR*‹ADhÊ šbHˆy4”9— E6ßg=!2ŽØ€’£óW\"tž§gØ1·Cþn©\n61ÌÙ<zÂ˜T Êxûâ0M¦¬JI5bÂÂl*’LðY¢Ê–„ðÌq”aôiáCÂVBcâ—Tu™öÖ·0†°o#êø1w<è\nC–†`€#J©™q=VÒÖ»…6A0Pè^\$%%N“_É‚IVÕ)ðž\0U\n …@Šæ®ÀD¡0\"ÝåSÔÓùg,ìÈê¸â–8r r¸Ê'RKÉÃš\r|É* ÌB©):çdç0gÞ¤_[¯­dÑÕSÃFO!–O›\"ó\nE+‘N¨*d\r„*¤ý{¶ã)%úÖoæÂ–C»©ñö%uÁ1;E kªœ\"à(+\$w*\$U!X—©Ñf‹Òf))„°´M(ã¹O T¨´{Ïá›='*Ù@Ì“JˆºP5²9\0¨öÑâM_1Sæ®ŸÉ¸‡€ñÓ*øÞ\r.Ã\$Ü˜„ÓøKÔÂÍl¸×PïCý{f@aˆÖú‰X+v,zW£ÃÂMÊ%§‚97üØÙt@fÐ¹*¹ÚŠÑµDþ“u\0ÔÇÚgÚDþôƒss#SÌ(ªÐ&íqzŸÀÜbI¡Ô4š×whiB%kºC	ñ«cdü)³@ïB”=#ðš!éNmHÈ3@^k.|æ€2³=äó7¢MQõ£2\\ÐÙ0…ÖÑFŽ†Y¦ó}\$×I; è€NûP›ô®¯þN2ÔBœ¨os>úH*ðÔ!ÒxÏ»£p	ùYD¼X’\\¦i·gà“ŒD’ÕGåû­õ›.WÌì×6Ë\rªoþL‰íT?!ßXE‰H+\n\0&pÉÓƒuÕR\\¥\"M<(DÕ¼ª;ÌŸI¹ur(Á7ã­ÚüÑ¡‰étllQúá/ULB>&“~]TJw›@0c@M\nÙ:)ºTûŸä“BCèbÉ0çL!Â)Ì µb5S‡Ò´˜x……‘Îˆx0éaíµ VÉyÏ¨3GL—ä,›ì	¬ôÛ:¸7†Èpß©äZLÂúçµ*yš³¹eM|c{§çÇdKÂ‹¨zÝ<|ÂHWý‡µpˆ~L9Q!Ù ´ “š›í€(V™@/:\"'ÿºA9®]SÆ±¼5 RPÒÁZÓ\nbgÂœí.(Ã,gt`@Pn…x%€ê€RI/d÷Œ@øÌ`xÌd(o’ŸHdSü%/ú02R\r©Ø{0ÄpLÄÐ*áŽFxpX{æ	Dé/\\v‡ƒ—'z|¯‚3O†áÏn|‡n‘rØp^h­‡\0äÙ\"ôá<}\n°ÿŠâvšxpž=¢ã @áD™ˆ?„é0n÷ËÒÕ(’TÐ‚'0¬ùƒ	\rW‡u\núj-T‚ô°‚\n½P6Bê.èD0& AZ4Ãì™\"²¾ì9CØH\0æC-Ô½fç\0ÈvŽZ‚ÐàCŒ³œ³E %êVS\nˆÅF‰~¹@‡øÑHqÆÓäsëüÖ@ðÅñ\0½_oúxf2ˆ_\r,Bc\rÐUQ’Å§°Åñ†2Ð÷¯H­šáñ0}ñ”ù†A¯oñœÚq¬ØÄ;MxÕ„ÈzÎÊÃ&j‚L„K¢•[±©	Ð¡\rðÉ…5¤«±õÉvdxhë&Ë2(ìpWChñÊÅòº²&ê2’Lì9Ä}PÂKèþØÑ§ç† àâ;†{\$ Ë\$áy%2W€ø²]&d¥Œû2o%T¥’.`RM'ÒWH(ñ\"B’ª²’N’Ò’‘\0’‚1¥\$cÆôjÕÃõ0baR²#ò·2[+ÎÆOòvÔ,›+ínÚHõCÙ+E\0\n‡nZç¥’­šH¨s+Ë2ô.Ò–˜í«0\0	üæÙ@…R²†à„0^?†\"@¦i!â˜E ÷mhïŒ³2ãò€àæ\"äqÍÚeÈD¢âH/€ƒ3Òù†h÷3oõ±ƒ6/LUèü‚\nê †L\0ØjúRÅ|ê&¨ûµ&¢J¦è& ŒybjB„\nšŠt\n ¨ÀZÒ#WP¸G¡3ð¦Þ±6³ÀA3Å#î>IŠÎyèìL¢Å†šÑr-Ž%Èl4z#Ö= è=ïn×#×‘V1Î´šÓl0¢L*èjb÷+g\n¶eàs£n2';£¾\ng‚pˆHøG¥dD†Ý#î&ÈOóGð0ÑÖõÃdd09±(d,×aNù”^ÍÏ6§òTp7”u£íÔ]HF,Î7Â\n0cP©(D ÃØ&Íƒôu1†fæÐ(«4Ý4sHí\"ú¢dpÐ q\$D³,gLGŸ\r\0000|d0&æ\r\"jóžDlxW\0êgKõJ\$<UBôC´2ˆ.Çe?/Ì2\0003‘ÖÓ´ksŠ†Öï°gmŸF”Fåòt|.‹’âì7A'~\r\$x	¤PÀƒ-¥àhä\0keR	\0@š	 t\n`¦";
            break;
        case "cs":
            $g = "O8Œ'c!Ô~\n‹†faÌN2œ\ræC2i6á¦Q¸Âh90Ô'Hi¼êb7œ…À¢i„ði6È†æ´A;Í†Y¢„@v2›\r&³yÎHs“JGQª8%9¥e:L¦:e2ËèÇZt¬@\nFC1 Ôl7APèÉ4TÚØªùÍ¾j\nb¯dWeH€èa1M†³Ì¬«šN€¢´eŠ¾Å^/Jà‚-{ÂJâpßlPÌDÜÒle2bçcèu:F¯ø×\rŽÈbÊ»ŒP€Ã77šàLDn¯[?j1F¤»7ã÷»ó¶òI61T7r©¬Ù{‘FÁE3i„õ­¼Ç“^0òbbâ©îp@c4{Ì2²&·\0¶£ƒr\"‰¢JZœ\r(æŒ¥b€ä¢¦£k€:ºCPèŽ)Ëz˜=\n Ü1µc(Ö*\nšª99*Ó^®¯ÀÊ:4ƒÐÆ2¹î“Yƒ˜Öa¯£ ò8 QˆF&°XÂ?­|\$ß¸ƒ\n!\r)èäÓ<i©ŠRB8Ê7±xä4Æ‚ÐÂ5¢¥ô/jºPà'#dÎ¬Âãpô§Í0×¼c+è0²¦<¨ÑàÛ<ŽJ\0å²º‚	R3\$?Ã\0\n°Ò4;åæÞŽq ©BŒ.úú8RÔÂDí'‹¸‚2\r²ˆË@HÉ«ˆåHLÈ­xá„£f¶!\0Å=ApÂã~£0z\r è8aÐ^ŽöÈ\\0Õ•rT”ŒáxÆ9…ã„œ9ŽéHÈ„J€|;&±˜A(ŒÉKÊ1¦¡à^0‡ÉX­Žn=}#‹C{àóSƒ¢–5µê](7CkH77¨•0ÔaøŽ&Þ¶lÖ:¡í[Â‰7#0Á÷C*£%„0ÂÀN[—ÂÃÎe—Y€è¹¼hÈê8£*GàP—.'ƒ¥NLB`	0øä2Ë£s+eëñˆ&°B&7\rëûÝj=0ê7\rqžš3êc;™_ø½|\rc\$D\r#´ò‹[Œ:­Ž\r6	‰ƒ\"\"GŒÙ_¦í1¤¹ëytgQ/Ì=?\n\"bnË•³ ôl#(íÐ1l¢Üã8“JÞàt‘B=9Â†!×bŠ;ñAH÷øèœÒÝÐÑÞ<}ÙRò×´&€\$-*	#l\nÅˆ£Ç¦÷wîŠ.×sM¨ØÒb …âø~<Ž;`DÝC‰J3<3Ê•‰ã%MM24­pV¨NÐ@[\0h#DI‡2æ ¥S* Ó,€õS9±ÐÕ¡³~ÌÕhn6Ø¿¢jÿIô\0\rðà@XH»÷„ÖA9  v‚È‘—A“`a`ë „þ\0À3‚`0¯~À±BªEl-ˆDCg‰°3DD6Òh/KñÁ'€€!…0¤p ~¡”í´Î½Cm0M.	¶dý´F‰Ý†#H¦Ðv8\\Ê1óøML\$7äI\n–ºªàÊ¯«!e †¦³–‚ÒZ‹Yl-¥¹\"Vør\\+Œ†@ÞGƒ i“ë°+pÒÃ¤BÁ•}/Â:uÉ9\rEM)¹>OÑørUUdJe0ELéŽˆ@V¡(œƒb¨tlESDMa\"	HÒà€Ë³ö²V\\YëEi­U®¶CºÛ[¨\nLÉµÈœ	ä¶\rË±w=àNÚª+Bò´?ô^DÊaPY\0<“y’FÒ\$îZ9Õ0ÝÁpñ®©!zI	Á:U\"¤•„\"°ƒ«v˜e»ã€º•í%/£‘¦˜O¸5Eu[¼U;G|LUƒHH j\r\$¬¼—ºƒÃÑÚJÂf\$øç'œ\n1ôùA3€¬ÉIÆŠçà\0@¨B´‹G0PTJ\rRÄH52&V×Qo\$`2†z¤Öi9)qÈIRª\"NÛSñZ¦Ò‰Mí8f•ÇUD„ƒis1är‡E‘bÊiGœŠReŠ‚Èâ]Nd•„ ò\"\"\"Aç-žR^g	›]®ê¦,+ID	Ñ5Œ!iô¤Î@f\"OÙ²àÔû‹óI‡Æ=n4DUÈ’F(U:D-åŽæQ¯‚Eæ¶ˆ,éê\"¬Oî”xB€O\naQä—ûfÕUBg`iª&ÛYƒ\0‹{a)ˆx3ÎN¥F¥©°Æó?SÀV((î,7:II9V±\"¾Å¦r<H	°\r¡¾š‚\0Œ*Á¿&LãHHœÈÚ…‘D¬!†õZø­´…®¨ÌóBH’£úX,hÒšE(¥ˆiåÄõœVôY&\r¨'cònÊâ^d T¸£NƒAÆJùä“·_Ò\nlä˜’`òRÈ2ÈsËfÁ^“¦yØ9òAFƒ^Sþìì\"WùÁaYùúDî ayæ÷fœÜì£Øxo?¬òžé:FqJ úoX9b “E¡M5Z¬U¬¯WiQPÆñSÄpÜSSoÓˆ'†(Üþqi=eIP*=Óc\n	C(¦,)ÚáMKù‹	éîÒ\0ýsË¹¨Ò¡æÌòúÞ1å%dµ¥õC‰«}­„dì20öäÐõ²Gj-Ø<e'nÆÉ\"QÜ‰-D€PCƒà(-;‡ò¥²¡ÍÄäØïSˆÐÒøgê¿)oƒŽÂ¯·Pê|Öø°DÝŒk.\0eí„tn5â~›ðÌÙÜ‰Ï„Ë]œä’ïCËÙx ‚B·“ZPQ Dl'¬¨C	^ß’jžk}Þ'åœœ‰<_ÃÓ f`¼¯³8øÝƒ[72Êâ>³nÕ kgyÐži‡„Ú˜9K§±õ‘”m4yðÒ	–Ò<At9n‹¯Ç{A»'XìÙÔ6OÞÔÄð.Çz\"uÎén;bïhÌH¾ù]Ã#LÏÁöòçO™•Vòš\"7Ð‡±…²!»ÍõÔ9â;·cñ‘ö3?Jè§ï¨ì=÷Õv_[é¢€þÊ<{^ôm¸Êð%Â8bIÓÑ#÷U®”ŒÃ‚wË\$ZÏæ¢x]mQ«¢UçzÅ;ˆ˜qTùúfpÊJ>ûêkØ–§>ôIÚIŠãƒð{ñ³`îÒØ\\@þì¢Q‰N6\$¾n\0ò82# @ì7§Nˆæd£~í~ltÆ÷'VLŽø7äÆ5í®JÌ#Ä'P6\"¡¢~7y-j69ˆ’bp\\Ü0TïãKðak>:ŽRÐpZ3LŒc£H*B7‹lÆÆ°kHßf¼¾\$|ØðhaLô7¢  à¤b\0È4‚„¶\0È'p¨ägøH,ŠÎô\"pÈ\r†@	¾l\$‚Üb²Ÿ®ÐïÏ\"4¬øh…vÝB²ý¦|h\0Æ\0PälšL€RÇÐÐÎLÞÄdÏ¬yð2äí\0±~´ Ôj°G'”Îd}T¨IQ'0ï ¦Ú0|#0g£J\râ§—>'‘\\|‡y0tû„ÄM£ÐAÎ4 ¢\"¶&V¹îÐ‚qJí*OŽãÄgR7ãÎM°0ììí&ð”íÄøð­ãqƒQ§‚=ÑU/&ðQ¸ÁlHÄÌPßÁï‘Wæ'° ß¬U11íñóQ=@Ü%mÚÝæD/£~¦¢2øBåä@æk¢b¢ŽBêZk+ÊdH°GÀàY<rÈ?#J^È&~9ª\"\"l±¥zY¤£eæ\rÍÈ7ÐftJÞ'Ë×\"º+0Ã±úßŒRßíäŠÌs0zÞì1l¦8òI\r¼Û‘å’š5åÂyðJnR'´'…ý+NVbÍ¸äNH™‘\n²«Ãäj×qI0w-2Æ\$‘;+ÑA'líCz£2âÐGµ/2Ô#/ˆLCˆÂ/’häh@–L®G	ÆÌ¤<Ø¦º<æ¶Fî3ëñ1ç,òß2±Á3s.Ñ¿U 2·-êÝ\0@ãæÐ9²5q2ÆwÍ7³Tm#6Rú¢B¿Aàì>24/ÆŠ\ndD(?ˆ«3,õ-ò\rsŒ^RçqM8¢y:+3ðK/:„?6òèS“¹5õ*rÍ9cJ%sÇóHÔ³(ó„øår8àUóÉ’>Ž>Ñ÷³Ðà.+3¥ “ÜáöPóq>T\0Uä„„,RÖø€ªFÎ^´*“Í?4&Q4+)óüQ\\G R#êþ5Ó:aäÚ2\$ÄGgf=<´\0ë1á‹o]àæî4fŸ´j“íŠð)†ÑhqFb5GãGFæÀí“^AO.hÂ2ÃÐfg.\rf¨9ôl24fªo.Öò‘×G‘®5b„4QµLfíôŠ³â5L”¼òQ·M\$ùIà†a@Øc¼(gÁÉ¶1ò(…a…^©£ðFdÏ;DLürq%&²\$ˆôGaf“Ï¨&Àª\n€Œ p³«>^g¤®R]M\rLOhÃu<Öt…dûTB5T€ä6-g.ÛNQØ¨Åd\"¢/E:š†{`dNuæ®Bþ? gð2 –#t/Äx‚Kàl|Bd*Lî ëÕŒ1 è3O¤\$lª«lÜùL Åâ|S­\"º¦L¹-¸J€†(20^z³ Üa‘®}@-Ì÷=\rm^hVì´ƒD}_UæïŽü(€à&¦RÆó_v	9Uó^G7a£>”#Ê(PETÖb4únD‚n-¸`Cü9FðA†P”\$p˜×\"ˆ™†æÀB…e­Ó&²g€¬'J\"bŒ\räZ3m\0á-„),:i¢<ï¶.=\0´CÆÓ(y•°lg›_\rî¨ŒÄlÈ“ÂšJ*š|àÔuþËé`Öhõüly<'\$S Ü1‡’Šà@I¢@@";
            break;
        case "da":
            $g = "E9‡QÌÒk5™NCðP”\\33AAD³©¸ÜeAá\"©ÀØo0™#cI°\\\n&˜MpciÔÚ :IM’¤ŽJs:0×#‘”ØsŒB„S™\nNF’™MÂ,¬Ó8…P£FY8€0Œ†cA¨Øn8‚Ž†óh(Þr4™Í&ã	°I7éS	Š|l…IÊFS%¦o7l51Ór¥œ°‹È(‰6˜n7ˆôé13š/”)‰°@a:0˜ì\n•º]—ƒtœŽe²ëåæó8€Íg:`ð¢	íöåh¸‚¶B\r¤gºÐ›°•ÀÛ)Þ0Å3Ëh\n!Ž¦pQTÜk7Îô¸WXå'\"h.¦Þe9ˆ<:œtá¸=‡3½œÈ“».Ø@;)CbÒœ)ŠXÂˆ¤bDŸ¡MBˆ£©*ZHÀ¾	8¦:'«ˆÊì;Møè<Žøœ—9ã“Ð\rî#j˜ŒŽÂÖÂEBpÊ:Ñ Öæ¬‘ºÐÇ)ëªð¡¾+<!#\n#ˆ€ÉC(ðšÈ0ß(¤âbžšÅB˜ò¨,¢šEP~¶Ãr&7¤OôV:=j\0&8«\\b(!LŠ.74(úÕ3# Úµ¨C#Þø¾h+ìü#Æø Ë‹>=CØŒãHè4\rã«B0¿/Ûú9`@SƒBz3¡ÐËŽ˜t…ã½d\$3ú.ó¬ã8^¥ïÐæþ?ÁxD¢ÃjÎŒ-m¸äÈ¦2˜xŒ!òN+0ƒcj2=@P¬§ °àê5Žƒ¬TaÍ\"0;\r#(î\\—3RŸBpòÐ¶¸+Œ#ÜµŒãš2æ2!.&·ð–7£è´>*Dþ6¹óÅò¿ˆ4ÔZ¸iî*Ãƒ(Ì0Ž£cB;-£¬?jÖ°#\"·\0Ó)º(¥dc¥öàŠiÓ¸4Ë8æ²3Iû¦Ü/ùØ‘CxÓ?°Â¢šœ\rÎ‘BC\$2@Îa¥Ýã`Z9Œl)Š\"`Z5¬“µv«´ÌÙ]—(ÈÒÛe%7]»º09¡,ˆ'º±ºÀŒ3\\Úøq\0P ´]ÂÔ¿‰#kî9K\0PŠ•òì7Ël VóÅ±ÂÏÆÛwöM4Ë>Òã0Í®ª“{Š:Æ\" ßÎÃÊ9(Ž´U3d¡ôµŽu9ß#8Âµ¸Ê[SC(P9…)8ª3:ZÒÐˆb˜¤#«¥…¡_°JVeb²«‹Àk¸òÆ‰8¨42I[l‘ƒª6©õ[¥DÒ™\$DRLÈ•J«ŠµW«f­T¸Jé^(\"Ø³CrÂÐxÐ/Åž´PÒŒfiÜ¦pÕEÁv4/¥8T2ý4)ÈŒ˜‚NJJ€rmi 2ŸçP¡y:†@¹QªUOUb®V\nÈ;«DýAr¹Wp…'%¥VsÎT”–!8>A €ç–2DÿÒañYF|Ð†rtÞ2%YfJ3Â•\nÔ0ps®¶ 4hßÚ¨¥pÆuý£>á\0 R¦­€‘ˆôüáŸÉaC<%~ñóÇ)jUK“	Ù±c¦m<’ÚÉ9p1p2.„›¥‘s~‘¼ŠÀ²pNŒ¹›@\$\0Zî%±>(@SI%ŽÂ™C—jÒ™’ð˜\"Óª\\ˆe.LÎŸ¸¡Kiåñí=Ç¼\\ž2q0'%¶voäiQ#'ÅN3ô¢ÞŠ—Y¸8)¥:¯Ôû\0á 4†0ÑJ«’²šU2BÉQ,%Æ}‹àÌO™ÐaL¤`7¦\0o\\3égÏÖ sB„Ëy.¸¾°\nP'š—[„ô8²¤Ž±/€fŠ°ÆGÏm:>'è¹Q‡üxS\nŠA6M\nJB©9› €½5@CkVi’jª)ÂîP©\\¿'dõ°Ò‘\"n\$qBVhkLq\rfHŽâAË™8HÍ¡µ Ô+\0F\nA—,Ò#ÂSõ/•ð˜ñÏ‡(\\s(š˜!KñÁ„à@B€D!P\"ÚP@(L¶±3°ÔïH“0P_2¥,&DÌ++-§rà\nd^IO‘Ë&¬¼6/9és.qF!5!»;õeonÔô·¥&j\nb/ú\"jþVÒÕZêEI¸7\nh]ÛqÇYE‡4s²ù•×ˆè&ÅÂ¿’U&…`é\"Xu91&4È\r2Ý\$¯èj\\¡Üóha·Cšû¨¦_ÍH•››!i¡u¬éd4‡¤?6³Õ[W\r`áuÞé¾>Ž\"Œ%‰\\±3\0]©m.•×ˆMQ€\$D¬¿·ÓJœš™	d•¬Ñ†)KvFaä”3 Ôm¬É|³–y‡–€Îoò˜lÊ¢ã+¡ÂÒoÜru‰áã´v^Ï«&4¼³¬À”Ôk&\"«ºâ\\û†H…Œ@¨BHöÑŸ^F)º‡´Gý—†PÔg«zÊ>Â;—\$ ¿Á\0/*ÌÞ²ÁXŠÆ1²ÚÀÆcs\0€'„µE©5QŒ?9=t\"þ@N®lÆ;šk­õN¦(ZpRëÝ,PñKmŒQ­žòh%¦²vº’½ì0É¬¶0KÚ mÝa·ö.´ÜDN;´æ oþ)xŽ‘òBËîFõ¯óBûd÷\rP	G²dÊ¢ ®CËL\0¶Ãa`—Í±%låŒ8?Wß¥‹s©Ü¤TÛq†²•Ë9APZº_¶¹«Cá6‘uè@o²7¼äŸ–rê¬ÉQ½Ô2¤Þa¶“úÄ\\¨òsÌúª5“C>n“Yú,ô2ÜÏ‘ô;|–1cK)°À¯™jé˜¹\"Ëtæ´€@‰Í|“@_û?n…aÏ«²Å@ºQQpÈs.ð›Ò2SDh–ÚÍ’0\n0Éq\$@¥xÛ‡vúü¼„£ÞŒÿä rù6ÛøäÝpz/e8æýOÀy{¿Ó&£~½MÄD~Ì¼¬6‡×u/aêýo/4^§§=_óÌ,‰ ‡M‘©uYÙ›;¤\0œðL~.øŽcãë’@~Xi×ÞÌì´ÏºYBæ3ô}Öofÿs­óîeŸÑg	\r÷¿ªd¶–_IÅ¬9A¶[oÄÛ¯2@‚\nfÃž¬¯¥Di3ÄrÃJ.lÍ˜ŒžlOúðÀÜTCŠtb\n,ƒxdB¢'£â3°)‚œˆ'jüË4Ëbð%*oEàÊNFÊŒ¬Ü¦ðÌz]OjïëÐ[pt÷OÆê|otþoH½ädì|ÏoR™OÔõïÈ\$àÏœê0y\nP¨­¯FöâNÊH\$ÜÐ#B\rÀCä6í¦Î\r…4k\$À[I2”§	É*eTùå\0ê0‚ðìú/v\\ËÑpžöÐ¢n¥Üxƒ¾„oÃò¾‚ø\\D?Clf1ª\rå bzÎän\\Plâš†ïDüO*… ×Ð¹ÑJ)QBïÏØ½¼(VJ+ÜteFb0ñqrD®£Ñ;:\nŒ¼Ìw1ŒÌë,õüQ¢…©Q¢EQ‰ðfF0§	­>LQ›+Ñ;¯T@\r	±¨ð´c40Ñ\08IÁiÀ)'&EQŒ1i¢\r…\$.MA«ê“KìSNfÜ’\0Q‚„Ar`–a­@,dØ-À‚ÒÔê’ÍxûMžÜ’.û2ûkÐd8\r€V\rd\rmv¨×®îŽéË\"BŽ–p	%…´à¨Àp|©Ä;äÐ_‚N×\r”šžs®tÜr„ù\"„*K´OzÕÊÜ×PZÂ1‰12/bfíäT7®PD+Ã~¦»%æÛþ4Â,5X/­ kƒ–‰ôtl„Ã)–lìCè9€'Â1FJ¿Änê®”B\"‚ /\$pÄm‹D½€Änú`+Æßë›såEõ0ó\$¯&m€àïèc)21Äéó1234/æ&#\"¾ò0ŒF±¬våüg«:¬¢2l+>	 ÞëGñ&®Cîôjs€k0­òè\nBB¿¢tÃê;‡	5‚Ú)æ0-‹›.à¨º¬Þ£ô'¤U\"s0À2±ö£ŠÆ¾+Û<eæLó>/ê®@î-–KÑg;ŸÂf·,žÔ¤i¢F\".\r@";
            break;
        case "de":
            $g = "S4›Œ‚”@s4˜ÍSü%ÌÐpQ ß\n6L†Sp€ìoŽ‘'C)¤@f2š\r†s)Î0a–…À¢i„ði6˜M‚ddêb’\$RCIœäÃ[0ÓðcIÌè œÈS:–y7§a”ót\$Ðt™ˆCˆÈf4†ãÈ(Øe†‰ç*,t\n%ÉMÐb¡„Äe6[æ@¢”Âr¿šd†àQfa¯&7‹Ôªn9°Ô‡CÑ–g/ÑÁ¯* )aRA`€êm+G;æ=DYÐë:¦ÖŽQÌùÂK\n†c\n|j÷']ä²C‚ÿ‡ÄâÁ\\¾<,å:ô\rÙ¨U;IzÈd£¾g#‡7%ÿ_,äaäa#‡\\ç„Î\n£pÖ7\rãº:†Cxäª\$kðÂÚ6#zZ@Šxæ:Ž„§Žxæ;ÁC\"f!1J*Ž£nªªÅ.2:¨ºÏÛ8âQZ®¦ŽŽ,…\$	˜´î£0èí0£søÎŽHØÌ€ÇKäZõ‹C\nTõ¨m{žÇìS€³C'¬ã¤9\r`PŽ2ãlÂº±ªš¿-ê€æAIàÝ8 Ñ„ë£Ã„\$šf&G¢FŽC‚/0Úí¡ƒ²ã\"Èëˆ¡DéÐãuB`Þ3  U.9ÃðÚö»Ì`‚2\r¨\nÂpªCTÓv1Œij7íÛcÑ0€îÅ\r{ùaCµE225¡àÂÐ¸c0z+ã à9‡Ax^;Ür5X¯p\\3…èà_fÕ2H^*!ðÛ)ƒpÍ'1Ê@ã}1mØë³R›”:C«z:º´S:¢½b²´;„ÒäKêþÛâ¥&.ïËã(ëY²ãšF=B»®ØšˆCÊH„¹†d–½‰ÒIŒÅ«ÄÓ5>,8 ¿ƒxZ\$ÀNMŠ×;G1©éBœ·²l¸A‡¦(ò@Ïz4¤X‚3¨Ã(Î‘ìÛ”:¹f6­J*å\$í@Rüóbõ²ÍÍŒÏ£ Ù‹%š¿­ë¬@:O8ÇE;bˆ˜‰yý2\rû¶ú’ê´8ÓN1tø×ŽãîSœô‘OL…õcÌÛ±Œ¿D—uƒÔµsh’6×1Êõˆ£Çzá=xÓ8õÉ'aÐQTÊ\"NßOÛkXÙ„;jÒ€ cxÌ3\r•’f ŒSPØ±‚Ót;+^@å{¥c`ßTU ÜŠÝvØ……ÁHÈ0pA-Åß‘Ó@„È	P a4€ŸÂQ< \$ä6àúˆóí Ä1øwäýèä?×þP`o€‡=¨‹à\\\r`0@4A Ý	˜C\naH#\0¨Í1àXEë”XL‰H1² Á|R2’Té<>‹-»¢_å0ÿE(:pÊò@A”Ö†D<AÒ¯\\ŠÌ˜¤ržh‹ù2IjU¬¶Û[«}p®5d¹ƒ’è#`½Ì'uô—x>;Œ\\Ž¬sÙù+ñ=“úËc3#a¡ˆ–âPkq€H½ÅHoÑ¡\"NdÔó Z©×iOGîN\0ÂdûýŽ¡j­u³–òàë‰XGð\\¹ä e])øŽ(	¼˜>waÀ·´·ˆ¤ >%í#\0š˜VI5©Y	œ`äN[QO7 €œ¶Òf€N¡N2-ù`ž“ª@P¡M_6”æXs7ˆåö²^‰˜T!jîCÒâ‹ø œËÞs†RC1ÔVêñ_hœ“ö¡ÁÒÒBÉ“P g\rô#’t Œ¢²9#Cñ¤ %8>·LKÙ±Vg†x‡C\"gøŸTÒ›JrGAAQ ‚Y‘ðäh¤d9\$ì1£•€âÃ}.±ªQj\$†Ó™MB¼§ÓÔE§|C‘–\0ƒ)ß8ehëÙ|6†Â`èS¿ª”	UŸ…êâèY-v,ó¢\nôì(¥}Ø‚ãØžMÄœ“x)‰ñ@ ÕÜ=%\"vŠA\0F•VY™þ¡t€Ê§”æCAH!f+‘È[7	m£^ÇÞº•ÓVÖˆìjà€–F/Í qÄ¨­£Hh\"RŸ”Ü™…\0žÂ -jÊüÎ²ŒÊSý51p=My¶l^ÐG(å\$¥§KP¤¤\róºÇ~÷¾€AoUÒ06¡Ê¯bŠÃ+ñƒ4¬¤æÕ\rˆ5çºÄÉ^'=D•˜F\n@Ð‘rTF!á q›5£a?•øªŽñ\rÍrfšPdvŽ^*ƒ\0ÏŒ	.A8P T¸ì¡P˜r9zöø0¦¤¿“bJRçÝ5OBáhOõ„‚nOI“	ÇâÂ£×˜àDxÄù·WdóŽxgˆˆä3°›äk¿Äpù’Àóöp–ìR0m\0è¢“¯0J™™ÕPøO0\n\nÆ4§†HØ’uÍ¥9¤ådŠ}Jµ0éÓŠ¾TZÀ¯˜ÖÐØ·“†7Ç\0„@\\pFd;6Ú.ù‹¬ƒY:\rq:k´6K»ÉgÃ>ŸGWªÖÆ²™Ê¹çBfMN¦•|&tÐPï¤˜žºce¼4ƒe£·)\r:9Ô±€«l þAiö€¡†!+\\Æ8ÌÈãbwdì¸2&L*FÈ\\x)E%‡W€f¡¤Ñ¢£*ÍB*\nhK]eÑ2s’7n²ªóÀŒŸM\0~’23:¯%ã¶ ¨C	\0€8É£fnÎkBÊá\r×¸JK}¬E\nÌ)áWÈ®\"mf €–.–ÉY;4 l”Í#6†ºA0 Ú–™x\roOS¬˜Î#÷¥È	èý%>ºdzÿaê}ª™ÞÌ‚^ú4/0%Ê†ÙÐæÕWrèÓ¢¹>×Ö¢ðo%q‚õÈíÜÔé~øv³<Se²>;¯yŒüê†OýÔƒöøg]Ž'[M<[nABsÆ¿\\ÒÎ“	3i¸H—z¦)d˜_T#mèLa…\$Ö©)°ÐÜh²YŒ	Ì2ÔôfÃœæ]G(<åqlí:æ#Rú”þÉÎŽzÂ&\0¤;LÿÔ;(wýW02±dSûû'FÉ\$Á²íã\$ÏçŒcø#dìÙ£â¡-v Ð\nýoì+pÜpþnX0,þÌjRµÜƒ¸9©\\¥€VM\$iÂþjjGlÄ¨A àNBÊdrëÜ5åL0ðbm,ÎÊ\n„žðl1FÒe\"¶wMÔÝ‚Yï<ÜÄú ¨g£–÷\0@\0˜Ë\0RÉìœÍå°Í¯ðt,á^Ž%-°(¶”zììÐ0®þpŠcÏî3ç¦ý/úþ‡ûãWkP\r°ÐzPóÚcìþhŽ—Ö\nN@¦P°ó ìöOÎì¢þìîò&@ùOçxî1êƒ6îÑ&ï	rßMVÆB0ß£h'p°Ï´Åí÷,kpõÐÝL\r±P%QT0jÑ0ÎÏà¢dc¤®\rè0\0æC¯¢‘z#¢>6<HBS èEª #ZBj\0Už£Ký-_†/@A	\0ðFâ²öD¾Z¨\n½°ƒ¦\r±ŸG|…‘aíùloGMìßTÉB‚á®=Cb@Êb‘\0þ±nóÒ!Ð(ÍŒü÷F'ðøÏò'Z1ŠhsŽ5#R,;ìÿ\$\"‹\$rÒNärU­%²D­P\$\\­Pø>§SCà#`	J,M¬Ð†«Ph@òº·p1‘0ä2Iÿ)±5q\rî?*ƒ°Ìxìþk¤¡²jÑ€ÞÛ©,2¼pä+g–\n\r¢Ï©'#	pZ#dæ\nC\"`ÖlðK&\\ŸŽj#€õé:ý°îRþo²5-Pû/ÆG1W\",ÿ1“\0Ý¦A2S.y²¯Ü¡1±+Rc3Ð[,2å#Ç–á.:±[\$°Å50R!JàÓ_4ƒ6nVsI6…g3²[F¼SrPä‚šå+5R+*FFD‘6Y9nS9³m+‚f	!`É*îB1 ä´#Ö\nàÒE&“æ^Ù,e|þ‚œ\rä2,¥<ÒÚÆÓÔ“ØËbf	gän®–§kšÉ¥6®ï ;N–%4\r#L'qFíhf\r€W?®jä¬0£°üª„Nl\0\$Š`‡´FÑºN`ª\n€Œ p4 Þ‰Et6‚&nÅ3Võï#=ñ@Fqj#´c@±q(Àî´Ðv‡Ð\$î€öÌ>2mîß#R×pmÃüŠnù3˜ºç´¿Î*tcr6)IÆ»\$'C\"ZÚâREH¢#'ÐT,@R\nn-ÄÂFvLêP:Ž0ãMÅ#ôo‚àW@PaÂqâH0#N‹ðvŒÌ°Ï/ú#© uOçaN±\\ÏÐžYOÔçQ°#³ØG%c6Ä#¡\"rúkS£”U‚ÔpB/m\0(Í|)mÒ#`ñU‹èM¬`\$¥f0¯\r\r\00031BM­&`ëŒµSMŠ®âtQ­‹-ƒ#<ƒRC¤Ø……CNãIO&\rÔø°¦ivcã,S­P(¬¨âÓKa\\5ÆrµÖÀÞ¿\0î¶DÛ2ÏPÞc¦š‡ }Oœ%Ž0#ƒI7à/b";
            break;
        case "el":
            $g = "ÎJ³•ìô=ÎZˆ &rÍœ¿g¡Yè{=;	EÃ30€æ\ng%!åè‚F¯’3–,åÌ™i”¬`Ìôd’L½•I¥s…«9e'…A×ó¨›='‡‹¤\nH|™xÎVÃeH56Ï@TÐ‘:ºhÎ§Ïg;B¥=\\EPTD\r‘d‡.g2©MF2AÙV2iì¢q+–‰Nd*S:™d™[h÷Ú²ÒG%ˆÖÊÊ..YJ¥#!˜Ðj6Ž2Ö>h\n¬QQ34dÎ%Y_Èìý\\RkÉ_®šU¬[\n•ÉOWÕx¤:ñXÈ +˜\\­g´©+¶[JæÞyžó\"ŠÝô‚Eb“w1uXK;rÒÊàh›ÔÞs3ŠD6%ü±œ®…ï`þY”J¶F((zlÜ¦&sÒÂ’/¡œ´•Ð2®‰/%ºA¶[ï7°œ[¤ÏJXë¦	ÃÄ‘®KÚº‘¸mëŠ•!iBdABpT20Œ:º%±#š†ºq\\¾5)ªÂ”¢*@I¡‰âªÀ\$Ð¤·‘¬6ï>Îr¸™Ï¼Žgfyª/.JŒ®?ˆ*ÃXÜ7Žãp@2ŽCÞ9)B Â:#Â9Œ¡\0È7Œ£˜A5Žˆðê8\n8Oc˜ï9ŒŒ)A\"‰\\=.‘ÈQ®èZä§¾Pä¾ªÚ*¨Šô\0ª¹‹\\Nž—J«(ì*k[Â°ëbÜÆ(lŠ²Ê1Q#\nM)Æ¥™äl–Ìh¤ÊªÂFtŠ.KM@\$ºË@Jyn”ÅÑ¼™/Jîò`•¼ð3N¡•Š¶B¡òÛzö,/ƒƒHç<“ëNsxÝ~_ÔŒ£Àè2Ã˜Ò7á¬)6Tª¼`gvN+o©îMÙÁÏªžæ ¨;ñ‹¦«Úg6vv6N…ÓXµ¸¹\$\$ÎûÍn¬Åë ^¤É”±ÍìÌgŠúqOÃi6…¢*ó0‚2\r£HÝ8OÔBPÔE#Ç@áÃpÏ°OÓ¼ó=Ï£¸Ò:\rxëBŒ!9ÑÔ€X›¨Ð9£0z\r è8aÐ^Žüh\\0êš´àNc8_†û¾ò9xDÁÃlç>êÃ4æ6ÎøxÜã|ß²K‘v³Ï\"\\‘±Ùz•\$¸ú§ï¯gç}ÖOd>/¤”S±³Rø§Ð†‹y«ç\nùˆ\\9/ðv<N¬Ñ2z‡9ô©Ÿ,ºB¸Â9\rÚ°Î„£ @18Xøþ­ ª°of´E#>l]Œ©²jìË‘±ZFDÿ—¥ [bÖCoiÞ»ôNì‰)åDœ=²Ó‘\0v)q#â@ÄÎÉUH¥p‡ƒzÅÒÈ¸‚Ì½!4\n-ºÐ‚†HÂ¥’RË¡Ã.Lù!A6Ž)±º…i„Õ¨¼ZB4¤AWÃíÒ!9EÖ\"Gx3”›Ó\"ŠtÜ•€uqYˆfMuÆ€@	\$*„ˆü)…˜HbD>Ðj/“\$*”|0Îýå=ˆŒÓFs7\$*âB=tö^q(è5ŽÃæ.H˜áö…h­p•I'ŠÔcºJ9%”ˆ…•Å¸h•d&ŽX©&`I‘“‡¼¬›¥-Å“8gdõÜ–X8Ï×ÀB’}Ž’{¡!õ„Á°:\"@\$Ž©J,”„ÅÔÈ² hdá¢½£»Ï™œsA²NÐÜ\$“1a%*éá3ÊÑ‘2ÇYç‘R\n¯Ð±ÙbÓ‰¨4h& ›ÛÅAÍ1Y»a-	H¬:óuÂIžkp	„S¼”­÷þYg¥.‰*5åvÅ\rÁ^y3þ6šè\$äj4„ÌSKC©å¢â‰AE] â°Â¥•bDŠ7…j¨”’Ð†ÂF˜LdýÄº© {ç&…qŽ’jvdÐCÊ «Â™ˆ¤‹2ÛH•w–ä\\R‚ h)¥A:`ä«elíMªµpäÞÃaÁ‘¬7Ð@ßÜƒp®Ä¸·Ü{‘¯ÎP99g0ŸØtuNxY‡RÙc®0¢]VGpuK™Q£è¥½ÃÄ®÷’â^´´€±JÓWê! Xû\"’LYŠÊ‰ñP“3ØÌêØ‚gÄ8'áœCŠqŽ9ÈW×&å\\¸nrì)†0æ çpIH­PŸRä³ÏÝ¡ÈLd,}]Í?PEIžâ÷‰*)*´‹Æ•ÊL;g“½/°)b8…JòŸi3\$CÛ5óùþ•ÂäpÞÝc%3%âI\\B}l6iˆÜcóO¡Á8W`Ú_aÌ.»‡0êØ› f¸¤6ðÎÕ±3o\r\0¸'Õ÷‹Á\0cp7Y Â™…6fÖ”iÜH×q“?*Õ˜Bž¸Qbª@*´…a2!7ìOÅ}cR)ð¬–[Ì@\$\0@\n)vç€¤=ÔrºIYi;…å¦r”ØƒWvi³d@ÞÝƒiÁ¥~†|`Ý”R‚_J7·LP›1ƒ° ©d•»:B‰‰%v4æC˜ž,qptŠ	º‡5ØÁ@Èºä7æÝ”js˜˜4ÇÚ¨gp¸«\"b’kÈe0¢”ÉÂ(]ÞÒ§*%ÅŠ¤Z×>H¥ˆ¸+o)Cíˆ€!Efb1HÝ0”™‰7eÑLEàpïEÊ0Úü´TAUIC³&U¤þšÄb-´ñ«¹„šppA_•(5n´šZ‚Å&áüÕ¨þ¬«GfJv°w¯JQ)‡Bµ8 \n<)…I„'	<hvÉ/uàµF˜÷>ûÚ‡Ãž3{’*ð}qÂÚÐà”4CŠÜ4“ç¸xIå/äë\r½gÐæë»DÉ‡G—fb©oÔ&m¢¨\"A\0F\n™ÚØ#ž§\n¦ô4\$8ýu˜ýÃ{ƒ;dNV1Q\\oùé‰Z»© î.\\—H¬V:–!—D‰†ZD˜¦-¡:“Fsb~E\$	!ä„”Ö‘v	•¤3’@¡ôñ#ÏæRÏ/¼ÜÔ&Çª»k”¬Æ^É¦Öx¨r¡_*Gq‹»êV…i¥½»‰mÅ”{¬¿7O5¦ÏÛ‰Í=û6ž÷è ï§¶~´áû”Ê±Œu#Ü2\n£K©)Ì(ŸÀ¿ÁÛ²Ë–’ÊßCÂõØMf*'j­/à–éX\"ª*LÁ\0o2ã°]%¸8Å<ÃÈÞæº'çþ*¯ˆË®ËI¸8ä\$¢¢¢4§r{@t¾NÌ ®ÐDðBIiÌ-lèÎÃ‹Lh¯{Îf5el#ïN{¤D¦ÑÄ€ÜälJ&.æ\r¶\$bÒ÷áœÚ„*øM¸/+üf¯€ÿÈ2ðˆ¾Õ\"èþä°KAœý°W®„”®E	©¢Ynwg¶¥Dx(æÀPÚäˆBRpŠE‰.)²…çª¼§–ëÛƒÐ&a\$ŽF[édªŠ¶(ð˜€'’‘Ãê’¦Œ	/)\0ùo(¢ÁïœFïïB*¨¶/æ5\nJÐ‹ïŒŸÐjùI½E•7	†’õæ˜¸‰FiË˜IÂ  ëT¦išŠ\" -§Ð\$T…b7Pôõ®>¨ˆ”Ft˜­O\0†G\0ÈºÌZçÅ @‚\n€¨ †	\0@ êN\0ÒP&Àp\r8P¬lkÀäae\"„²ëÃÚÛ¤€-¤¿(j\0^2~Lä+X~ñüVƒ´*	DW#ˆ\\‘ðálàª¯þcd0\$ÏäJŸ´+‚z¡±ð7Š dt\"Šˆ£RER\r'Ä›âG!ìÑ\"!\"r*ÕbÚê4ž/÷#ª&…,¹D¨<|ËE‚;1VŽG†¾É½*,§\"W­\$‘ï\$ÒlËÈ„ðr9%¡œJ2òGÄ(²š“06/gñ* ÒW&²­+¶Ë1z Å¢Re¸—(Ÿ\noÅ ’¹v,Í±ÅtŸp·JNG(ü1ì!Ì.E¾¥ÂáÊG/Y/E(¤ãÖÃäbÌQ<—çtd‡úF2~!‚†¢®î@*d.úöLL Å-01(äm1òø÷†>ÞeBãƒZ âvÌ£\$Œã,YFL‹çÁ\$ëüý\"p%q„–À°¦H„ö'Ï7‰@‹á2Û¬,]AD,ÞHi.F.Êã…0s9€éôi¼|„¯9§ˆÐy\$šÿB´sË=dX}W\r2˜BÓÜ³á\nð¹=\n*…\"ò?Ž--\$>æ°êEïër=¤0þ4@£ÒüB·§¬TD/@”@Ô\"{´&UÃ—¨EdCCx0¯^wKî—´\$‹å¼-Éáh-\"ËxŒ ¦X÷D`„ääè€[ÓžÁ± ½©àñO\$)ðÈIojeN)”•HrÀ3*ÌÿÉB‰BëÍC2h¤iYHÏeÛ)FdÉäÎâÊù\"Ô4šö²\$Ïé4/î2óCoF˜Tæ^¢„öÐ9*“ßN)ÉvôD“c£?ðôè÷iCKKóôˆÄ”†W=TëAÔOR„@™‚çD0Q}QU6òU+SËïB´¹\r#?/-SU+HƒüI\"ç!²S,•\0²^¤²b\$rg?2mòA+5fy5j—Ò‹*2UWuz*u#2!&§ñX’\r'UL›ÉiÒÂÈâÈ¼1Á_Ad­=”ïT²GâÛ!gw[ëxñQÑ>Õ[OÓ[u×[³”ðÕÃ1&wPïÝTtMP4¬ßä.¨2æ«\"³Îví®T±)©ú;ØÀ¯\nDdŠ@tú¿.@“N'LBµ°Ùb„I(’{7JäâPË(É`Ì2´Ób[EÅbÃÞÂvQc+ó;¯]Œ DÐi´ðððjC]Ñ;\\P‰E´Lö#(HàImO¶öhÉN/¬z'„çuåK•éT–	VpØxå\\“åNÕ%>·\rÒ‡_õC`4½UÑ¤“Vä“¶ËkˆçJbáhâf¶ÑS5Ï`’îŒoôµBÓnuì*×\r0—DÒ—0`V×uðü\$×@Qš”0ï`+<Ïp÷>-Kt&\"¸ÃNB÷Y*êZ!4VN€¿6º>µÀ?Ú5sVÐ*ŒcókU*µ•N”pu'<•ixŒ\rk÷^µKXñ©îuT§TW]·H—7]è}td] ÷·¯©ä«Ô&/7Ãt6ã|æ…µDpÖër‘«S÷Îfs¿}pª*fK#\n´ç\"ÇKVA	HÔ©åâ\$(ìÁSróÈÞ˜ëéõt—­n×GzÆê‡f£ø)sÁyÕYlW“•V×Ëƒ˜'˜~…ÙtWîDØƒØX9	E@âg€©ÃxÕÍ‚p+xurXaD˜H‘—|Áˆ”ùé1}¸ccø—SŽ´JNØ{n•³Šd4öõU„*¼ø‹ŠVŠ—ñˆu`xK|xPÛ3&Q[JWÙzöïV÷Ué+t@åËGÇsË“C†XL†7‡x¬ÿ|\$Ñ®ß6[„X¿{6	@ùeÌÑ—'~W-‹}ÁŒÑ—§VÆ<Þ3ÎSd¿xŽò*y_—Êˆ¹Žð#jG)ð‹£Ž­òDÁy\\ rË–2Ã–dW–¦,Xi¢‹8ÖLÕªÃFTõ•Š¹³³ê7Z1Où`!2Ã³ú}²Êò/&U§—‡å?“ÎK/ˆRCí*eLiª\r€V`ØØÀ×&åN¾´sIW8U›!‹·3^ƒò<’”ì6%{dlíËS/ä:fCìŠxFÀª\n€Œ p)@I#Òp2nâ!t?\n3˜ò?Zú7@\"Ý@„vÿ’v&ÌúG\\D1Jx–ø(KkÔYCÈ¿„Ø¼‘ðýI<ëÊGF.Íî{÷ö‹ñ®ú‘gUŠsaéÔ ¢T\r¿;º‰˜L.\"æíùù^kÏŸê±ŸLÇMc\nÊ·]p|½ªn\$ÑäK¨ÝL–„˜èÜ\$‘1ê¡rh5sc¤Å,d38ä\\ö®¿1SbÍa]@Ä>{çG\rÙ:fh59`'oã°úk±8wO“ç Â)`{!°Å™²i~¦\nGG7Kû7`¨G¦ÛA¶Õ=ÛJþ[;”hUÂ~'ª¯È}‘¸5´°éE»@CÄsöÍk´«•è‡ñ8Ùh&y­Îƒ{ïÅ³Ûb÷¥:(ôb÷´Ù‘Ÿ¹hã­è£ºøvgVWLÛ²wV~ÊÒŽécÁG¤4ªXÜÙŸ\n‰%%Y:Y‹;ˆëÄ¤Z+vâãŸIE›Žõ¬d¬®G-æB2HCXK1ƒ£J}9ÇÿNU•¹Á¢+\$\rù´YÆK@ÞÄàí\"ahmƒ©ãƒêÝÈ-ŠA™ÚŸšÖ!6¶CÐ–Ã±I[Å4(´R5f%€";
            break;
        case "es":
            $g = "Â_‘NgF„@s2™Î§#xü%ÌÐpQ8Þ 2œÄyÌÒb6D“lpät0œ£Á¤Æh4âàQY(6˜Xk¹¶\nx’EÌ’)tÂe	Nd)¤\nˆr—Ìbæè¹–2Í\0¡€Äd3\rFÃqÀän4›¡U@Q¼äi3ÚL&È­V®t2›„‰„ç4&›Ì†“1¤Ç)Lç(N\"-»ÞDËŒMçQ Âv‘U#vó±¦BgŒÞâçSÃx½Ì#WÉÐŽu”ëŽ@­¾æR <ˆfóqÒÓ¸•prƒqß¼än£3t\"O¿B7›À(§Ÿ´™æ¦É%ËvIÁ›ç ¢©ÏU7ê‡{Ñ”å9Mšó	Šü‘9ÍJ¨: íbMðæ;­Ã\"h(-Á\0ÌÏ­Á`@:¡¸Ü0„\n@6/Ì‚ðê.#R¥)°ÊŠ©8â¬4«	 †0¨pØ*\r(â4¡°«Cœ\$É\\.9¹**a—CkìŽB0Ê—ÃŽÐ· P„óHÂ“”Þ¯PÊ:F[*ˆ‘ƒú„\nPA¯3:E5B3R­£Î#0&F	@æ0#¤#?ÐÌ<×OÓØ¦û4®svöÈ®x†âLúw*ˆOü;\0005ò`˜7®#s ß%NŠ9REŒª ŒƒjÒûC£|7À’ á¥£ÆŒ£ËR[¿”\nD;#¤¦:Àä9Ápl,CƒC3¡Ð:ƒ€æáxïm…Ñ¥T7>ÁrÜ3…ëÈ_cÙ#È„JP|6­ÉÒ3-ÉËŒâxÂ&‚´`Ü<ƒÓQDcK>#´‹’Ë£è…Ê¬Â°éSJâ,Ã7í¤ª'£*-2³ž+¥+BÕ=„£ @1+À–åùŠ2Qã`ê6ÆÑÂ9œKÎ*S#	#pÆÆIN*.0ØR\nã8`Pˆ2Âc¨ÙËžC„2Ì@Œ:èÑ-Á=±L¤i&Qîk4˜e<ç9©*‰÷TÚÝ¨coµ;ƒ(<UNí6µX#®]/ÄüÄÖÛfÝ&êÉ¼Üƒ°ôõœ¹¨¸¦(‰€Uá®·qZe„bxâUJÐTÅÒcxª8ä/X†Æ7èÏ`2½hnœÒù}-AÓ3Ø Ò4ÈLK=‰)*Ü”7b(ñ±˜ËŽÌò­}ÞÐ’`ˆ!&£Ÿw*²“Ë.jíÛ4Î%)Þ3Ï%Á>Õ\"T„#Ûm<*\réèÂ78;ˆ­•ÀfjÈ}Næ…“Á!œ0–“¨šYrßX”0RMÀk2A)… Œu±<‡8\0¬ÈCcYWeäÒ›ðØGUâ…Rä±z ÚÕš3;ÄeÇ¤z\\ÃK5Çâ†*J~ƒxø‘¨jÏ U|û!eDGŠ*Y†ug­¦µVºÙ[aÝnª•V~Wå\rÀ½¸öÄ»ôm8Å©|¯²h¡ß«n8HÑ†£@Â…’\n&L-£‘ô8‘ 4ô72d`ñx%K¡.£ IŒAÀ‚-¬æ©–¢Ö[in-èÎ¸ƒ’ä\\ÉÌ¼§XÖ»C˜>y!À´éAòi#I)a#T	Ì\$h û9ƒ¸~ƒ(b2DeæÓúi–~#H€?FÄFbYDaÍˆ,\0ØK&Q>ÐÕ%2àÂ¤’€\"È^§fêÁ\rÅ¹”p¤ÑÜ\r%ÌÌó<peb\$~ÄTð¶8‡¦¢\"•³\\\08oz¸‚”\nJA Æ9‘ÂÐH\nË@\rË‚m«¤ühÉ‹Å5¹‘¤`-›á¼;œ¢h£!ÉÀä\\1È¤6•¸s\"å¤áŸtžJ&ÉŒ\$djC •oÖò\rÁÁb´%Ypw&¾`¦ËÉQhb¼ån`â gƒ#I€OÉ%\$Få\$	Š°X1„¨@•H\$\"Ó%²o3\$‰‡“6‡X50V¼²å…KÌc· hH†Ø¥—*ª%êž‘ÚÂlª±¨Aá<)…Hc\\‰Élà€Å¿²‡	RÐd¡èÃ¤\"pN‰âk%¬í¾¡ú&j91®Q7R©=—DÑóÖ´/-}nCˆ¸6“Å´`©D-q#yDžaÙCÕc‘ ?,âŸ©XÚ{8h‚äÐ0ƒvC\nVû„´B‘‰»'… ¥€¨mU)_6vˆ¶\nÁ„ˆ(’/c8…Å‡†@Ã…ÉDÍÅ˜Óv`oQ->ò„b“úCQÏ&Ç•\r›·QOáŒ0¨…¸Æ0àÂM1º;uPÀ2žE¿4£¾EIø‹‚nö8vŽßä4öžÃ½2 ¤À¬ÐÓr{ D¡ƒ…cíKÑJRé]©B*r¾¡T\n=!êD\nV!OLçDEášóÊZÆ1½=ß}!ê7zª ·ç/Uê‡\$,9-ã<Žó^ó±C…¦ŠG‚i¯>Óí€œ«¶vÃ¸\n_ÌcEÐ0Äkj¨.±ŠôÅ¬™»u.å©LÂÒsØ“­1\r—H“>H¯z6L´t”¶}bq,%TqªEMCuô\$AÂb¿¶úw¢®I«ÕL€§†ë9å;‰0\"š”žÏÛ«zFþœóžB T¿! ;rÞj_MŠV(åÓbj}ëù,¡©'¬Fš±(!ì¸•¶høL°ofl»Œ2döÚR#WEÜ01ðã\\…¸»Æã\$´3TvÎ€O â<†æHÿŸ*ãÜ³—#òhcÍJ:#é£…óS~Êƒ:H³‡ª×C¦hB)y¹(rë‘ŽIÉåEÇ¤á¾óžß[\n!ê½’ób5Ö¹u)½]æ7óÊ`wyŽfº#Ÿ,ÞXa¾¹Ô§•eƒ™ž\$C›L€æ‡Ž²‰-Æ\$¨b„Ü”Ey%TÔ1K¢kÛ\røAñ¥KslÓ“g÷##°—åDQôgá›„„òÛK{QËýMæœ¶:`’c\$|EW#(H½×+^”Ãûÿ‚É“T>Ù’GªJñ¤~ƒ?áì#]ôËìøÏ˜ÿà¼qZ˜óžV//ÂýhÎR_®èmµ\"%ÑÂ¤µœC~I¼ïôÉŒßýì´%& Ñ/Ê^\$öÖ\rp©†`‚lã0gÏDÖãVæ€gFxC€P…çÃ Rû£JÌªÇ+Ü÷¯ØûŒžxd1‚¨ÂO¥ÇSµpJÊÉ€cMjúçº{ï Èï~wM5ðvÓ'pC«¨t	RÐÃªæn¬èÎNç:!ŽxÇÈHæ. äP–ì¨üå8çC/\n/˜3\0†§Ê¾]PW-d7o‰ðÄÙ.²vl	„BÁÐ*Î\"Ü×bô8&òŽo™Bô:Èf« æ^öG ÞBÂ†œ\$^ i2CHŒ­p#F\$JËãpú×ã€HPž\"åž>Î¤Ÿlûm.ñ'¨ˆàÜFPÞqCìg¯žPm|-‚Ö£vØ¤ˆ(FÍV%ØúÏ¹ðÊú0m|ûæbÄòJ­ÚÝpr÷Èuæ•0ˆ)­Ü¤æŽÏA‡L¨qq—²îâÐÄDš-&pÃ%ƒ†\$¢B™§0DcìÜÌ¸9MÕ¬‹ÈtÜíÒUQ¡f8÷ñý±¶åíièl*ñ¾ËmÑ Ã¶iL¤zjúlörÌ¦4r&0rqpw¦²üÒH…\$PîKq‹O¹%FBì1’É2W&Rø¯¹\"\\!jêr.;%„÷\$q÷O›}°Ú³Q'ò˜gí–Ú­/Ø‡R¢Ù¥Ò*Äa*R³!/'C*í¬ñqu,r»+GpgñÂ9íêD²©!Râ'±¼ø¨u.²’&€/ÀÐøˆ.JD¬ñê–qð7fi\"LºRæ\nsê„ÈS¯KØþÓeÃ\$OÂP.†§“.%gq	Îç¢fãs@–Èa4p¥2€†L\0Øjz0Ê\"ÿÌŠ»bæB2¤#lH^&€Œ»Hn²iÂÀª\n€Œ qƒ†0bÔ&ŽRd° \$Š'4³ž÷j\\îçâªH:èo Òl˜…Ä8ü1n/€È®ô¡Å)cØ8ÃÈ©ój/-´w±ñ#j¬TŽrˆT)ìº“(SjÜ^?Œ4FƒÂÜÂ\nS¤ªI®(3Îä/˜ÏÉhKãŸƒfÑi*ó6Î¦¢Œ“cJIbô¡&=´08i0É\rZ¡2Š÷ÂüûB#C<‘i”2J\$8ÅTNùÂú#C‚bäôJÄ0uÇ²½ÂõD¦OÃvpl8pÌ ut˜p§\$P 0Æü J.CÈûÓÏ:¼ï@êgl>qqrCfÐÂJ!ƒü7dµ*Cvöiöô¬\\Me\"wÐ[H¬[¥E#v\rëÔâÞÒ2‚ì,H±±œ>¢X^P:\"là	\0@š	 t\n`¦";
            break;
        case "et":
            $g = "K0œÄóa”È 5šMÆC)°~\n‹†faÌF0šM†‘\ry9›&!¤Û\n2ˆIIÙ†µ“cf±p(ša5œæ3#t¤ÍœÎ§S‘Ö%9¦±ˆÔpË‚šN‡S\$ÔX\nFC1 Ôl7AGHñ Ò\n7œ&xTŒØ\n*LPÚ|ž ¨Ôê³jÂ\n)šNfS™Òÿ9àÍf\\U}:¤“RÉ¼ê 4NÒ“q¾Uj;FŒ¦| €éž:œ/ÇIIÒÍÃ ³RœË7…Ãí°˜a¨Ã½a©˜±¶†t“áp­Æ÷Aßš¸'#<ž{ËÐ›Œà¢]§†îa½È	×ÀU7ó§sp€Êr9Zf¤CÆ)2ô¹Ó¤WR•ŽOèà€ŽcºÒ½Š	êö±jx²¿©Ò2¡nóv)\nZ€ÞŽ£~2§,X÷#j*D(Ò2<pÂß,…â<1E`Pœ:£Ô  Îâ†88#(ìç!jD0´`P„¶Œ#+%ãÖ	èéJAH#Œ£xÚñ‹Rþ\"0K’ KKÜ7LÉJŽSCÜ<5ƒrt7ÎÉ¨™F¢\n/ÃÈ\nL7í<œ)½ìÜœ€EÍðÜ“,ðKâ‚SðÉ@\$h°˜7­ˆ«ÁBS‚Þ:È<¾†¡”­.”N/Ë÷B¿Ã„\0þŒ#ÆÂ'NÐ@ßµk“îêÐËV‰T	,`@7ã@ä2ŒÁèD4ƒ à9‡Ax^;ÛrHë=árÒ3…ð _±6@^)ðÚ´¥(PÌ´¯¨Ó<xÂ&¢²FÞ1”ºë8*“~Â¨£Z¦¢,âjúß²I Êþ…°’\"ŠòÖª7íŠŽa®¡­@Tö9·èHä5 P¯&ÑîÒ, ðò¤æl:,â³Äê.ò<8;’ô¾70Òm*óK×û6?ª‰\nH@P‰h#® 2C`ë–»¬’/áS¼ñÏj•À	ã¢t2CF&•%ŒÓä¬[2žë£ (\r#Hä¿Å	Îx•\r#XÖ£.\r…ÆÚÐØÓM¨¨ÆÆ0ˆ˜ŠšíØ+yk,Ô‹ecnÞ'êlØ¾c•Üþ2Ð;~6¿\"³E…ä´Û=äj%+Ùö¹\0Öñ\r Q†J­j4z\$°J©Ï¤³÷Á†Ø.OL :°„Àw^ÅìZ„œÊ²òjR7ŒÃ26žÏTâ8—ƒc|¸PŽ+^ÒvªÙ\\f´^²vYI†\0ÎFOi\nC\n˜…`Ê\n˜)6½/R¦S\nAe 6¼{IZ*0Æ‘®/G´×ÑRý8/è™?eÀGE¨n'¦£\"vöNAóN%Ï‚\0‚ªÉèrYA<¢œVa˜YëEi­U®¶VÚÝ[ê±qEÊyùMŒñ<.°}—±Ú_+ìÚ+…îžíI•HJ‚hl~Ð°¡›¶@§Ã)5&æ÷¬eÒÓ˜ppD,µ›Ö’ÔZËam-Àî·¢Bá\\q}r§D(ãì`ùè\nÑÃ¤kÉÉ/šàÞAÍ;þxà€©£Þ½IëH¦&7¨ò)š\$„Sœô:}J¤>%*Ö2Õ‚™s–ÁÊ!%òC1¬N%\n˜äãÑl™ËÓ7\"*Rø k<†4€ÒLƒ™5¥@§—¢ðFP d;ÆD¢BJÓ:4dpÓ±9AÂ€H\nÝ	¡YaR¡Hƒ@(!§‚zÙâº–!ÀÐ#I/Û¹0@€þ+¹ Ã¼Œzˆx5–•žÙLsß¥AQ¹,ùh@˜:VòÐöšåâƒæÈDrÌÃAÅ-kQÙÌåÞt‚'éz“Â[ÍñWaÉ!‘â\na‹ÔA0œÿ52“tñA\$Š“,	)¤¦…ÎZF³ÃŒ0?¡˜ø†Ø&S>=¡Ž=:í?ëA5\n<)…@[Lcþ©‘ÀÎö¶Ôƒ•b\rpà·*Ï)’+³„Â²¬û?ZIPh\0´Á± èe+{—=¦¦=L3~8 \nnj š&¹;Á\0F\n”-€ËG¢Ýå¥{¯¤V~Ù”žKÒ‰.§ Çˆ„SÃ:¡å-AHÜ˜ño	á8P T­²ò@Š-êIìüË¨òNßÒlèLª’)þâ\\Y_ÄÌª2dÊp!Ômm¦: ò>a	[uÁ‡˜ß“\"E„H+Ô«Ô6âà‚Ô¼ÈvL	Ú“U,ø\"tq=ÓèÅµ¼wè:ý&Dr™;VLÿ^Þ#Å\rüø¶èÝV¯² pL4ã‡Z²ùûŒMê)³àtšR\rÂ“Ú„Ðµß+ÚÖO)@@‚Ø^²Ñ\n­~³´¿A‹™o.9¥˜ôËh«Ñ‚Óð‚Ñ„zwaáà\npp˜ÁðæñðØaªSjËœÞAÍeé=¸Gº[ÂID(±Û›òC	Ë3AÄ¾µ)jÔvy“± -já/güàœTâÈ8(L%¬Ò\$µ©IV­š½*@¤B8G¡I-9ÑxNŸ˜k¹ïä5b.½þ<P¦}0ÄXÈòyÚÄ\"…`Š‚ SKX½œs”Œ3û½!P „0+Ê\$4¯º’+„¬›½*s¸%Ï”cÜ®M)¡ä@ƒ‚ðAÁjÃÛìµ+¢_ÙFYA´—ìÚÁAøJ+¹h½„½\\”ê	TC¤Õœ¤\rø®ˆ3\"&Gô5°SCX&K8—îxíT.S‹yg.`Õ„îs£ÀžÉ9ý>!Ü‹Â6Gpy!\$d•µôdVJjñ„Hý0”b­\0H¹âˆ«“ù¿tk™ÖÝ>aç¢4òó~ëKxP˜%éˆLþJIãl,@ŒèŽ×ÝÓé¾kÑÑ¿‡S2n5)%î\$³çŒa\rø|;*u«1Ï™ÑÕ|O­A-Á2Äß9¿+/	—žf²Š¼Î.;ÙNd—\r™ó³Íb¨Äý/žr~¯•5¸õ–ß²#—Ø³ãU2 Ô)iÑžä¿}t€vÛV>!Á4õ\$Ït½R)7èdÔkóÊ—Ö¿·Ý(\nC§âÞ~’'VF™z£ÛèOì}¬üóHé‚tiš¼hŒø÷ÛQ\"œQFKA:ÿnGjôXôLòÆ'†Ä…3\0j?¢<G)\nÈ.`/oý\0ïhç÷Lx~w&w‚8ýBüñrñHz|6dŒ^ô‚ö\ngÊwNóOnŸPW°MoZ/¯`ã®|/à Ç­©Ë¼éçý&â°Tã)ôãˆd«¢ÕB9ÐÆxJ˜Õ¤ºŒt1Ð ?¯\\!¦ÔíRÕžüðB%	Dô³£X¤ˆ'E¨3cÞ*‰l˜BìD)D…êH†›&Q+ þ)YPÜà:^ri€.IˆÐ#Šøî0ÒäR¿¥t4\$VãËc%¢uâÔ^°—	«¦,í>€Z¼/ÀÆPk†~;eübD¨bÆ00^kp»,eÆ*bæ3nXôpêµ1c+\rn5\rüb1ƒ20\r²RíýbÐÛxÛK\rñ¥Ñ«ãŒM0É1Šô­*\"±¼yÐ²mpßÀçâ\rºÛà¨Üf¼ð\0˜%é€<\0’àqî±òñæžÁy±¯\npšÚL|Ú¤ãPSòæ/ÌÅqÅ®y­¦å\"‰c†ˆ&Èú%Qï3ò7!‡±b€ÃÓ\$„ñè^Ÿð}#„œ.(‡ƒB\$ƒ!Ñ¨ç€•'Ò=ïK(gqR1\$b«\"þ{2œh\$dþQ‰!ð\n‘(°-\$äbhrV3ÒºþMXûÍvg„§(#-tÕçÚõ1‰ŽxÌiÿ-rÍ+Q®LÕÒÍ-¦Q‘.rÈ×€P×Í€ØMˆR¤“Ñ°E¬(7Ò«(/JQ“Â²Ý)Ppç“\$Ý20(:x	\r\\,Éì\0 &ä‹&²xg^­Ã°y&£‘ê#5\0\\,*Pä£’6—bf‘eSk\0€–öàÜh¯òã†þíbþ	°6ÆTe„W	M–ûñÐõÃ0Q\"dÂ\r€V\rbfdŒ!¢–·Ñ¾?©¤‚@ª\n€Œ pMh˜\$£´&©J@â¤#†ráMôÌØkŒf†çh/#'Bl•àÒÀòŸ€ÞÚ€¢þû³°°Ó´î(€ÝB£Ù Ò~©†]êlW¬n\$‡>dÀÊnNZ#ã·‰pe²°ì†>ÖLkL6ù3wG(Í’*ýà€ÐeÖô³vžËÂ´Q¤²¬*ïOGpÊ!\0Þ˜I\nlgH”—1òÒö\$Ú C23jšB‚x\$íDô«1Æ\"5„Xm¯Þ¥¨é'Š9IJ”ä(¬›\0©Z%/ðÀ*ÖüB9O'_Ä<á\"†¾à¤ãMum”À\$Æ~,äü&Oâmà–OÂ ‚6¿Ì²±GÔ€Ô‡I#L)ñ³ÀÇš<'JJ\råâÔ5’z/Íb0mâ\rÅnƒ%*7ÃlDüžÄ^+ÀxâÞ	\0@š	 t\n`¦";
            break;
        case "fa":
            $g = "ÙB¶ðÂ™²†6Pí…›aTÛF6í„ø(J.™„0SeØSÄ›aQ\n’ª\$6ÔMa+XÄ!(A²„„¡¢Ètí^.§2•[\"S¶•-…\\ŽJ§ƒÒ)Cfh§›!(iª2o	D6›\n¾sRXÄ¨\0Sm`Û˜¬›k6ÚÑ¶µm­›kvÚá¶¹6Ò	¼C!ZáQ˜dJÉŠ°X¬‘+<NCiWÇQ»Mb\"´ÀÄí*Ì5o#™dìv\\¬Â%ZAôüö#—°g+­…¥>m±c‘ùƒ[—ŸPõvræsö\r¦ZUÍÄs³½/ÒêH´r–Âæ%†)˜NÆ“qŸGXU°+)6\r‡ž*«’<ª7\rcpÞ;Á\0Ê9Cxä ƒè0ŒCæ2„ Þ2Ža:#c¨à8APàá	c¼2+d\"ý„‚”™%e’_!ŒyÇ!m›‹*¹TÚ¤%BrÙ ©ò„9«jº²„­S&³%hiTå-%¢ªÇ,:É¤%È@¥5ÉQbü<Ì³^‡&	Ù\\ðªˆzÐÉë\" Ã7‰2”ç¡JŠ&Y¹â Ò9Âd(¡„T7P43CPƒ(ð:£pæ4ô”RÊHR@ÒÓ¹\nÒ¤lœÆ¨ª,¾¥²ïªbÅÎä#®é¼©5DŽÆŒòZÂV3úC³U\nË^–2zK3 Ôø‚2\r¯d\nÂðÌ7Ãñ@0Œc1I½¶œ+B”(;# Ð7Ž°àÂDcœK…\0ysÊ3¡Ð:ƒ€æáxï…Ã\r‘eApPÎÒ!}ÓuŽC ^(aðÛB`Í\r°u(7xÂ9QìÐÁÈ6W]£¤3dî\$¨jBÁÇì»ÞåªÒÜî3MÓ<Þ\$¬kúáŒ	D¿U3‚W§ÀP®0ŽCsØ3£(ÈògeP©jš%@ý8o¼¶°°ºÂ½\"%l´š>™ÛzÁIódë£ó2Hl—Ùb¸´–ÒÔ} \$Ì¸•¥[~± ;)2DB:…–3S£¨\nÓÈS0ƒå*›B0È\"Ÿ¼è‰TÀ z™+¾ï+¯Î6èsðYÎèFÝÕç®nÐ¿5@)Š\"c•\$%—,Çu.‹µ<;1ÞíZÅÎµs“ùÖXžeóFdÝñì§¨Úæ)Aêû»Ÿ˜FVê‡žþ9ì\"‡õ»O].8«7†þõ)Á³«û2†|æÕ¡]|¤ ©2€ˆžûÜ&\ré‘¸\0ƒ l6È’Š\"¬MÊéIˆÁàÃ’`_ÁªX	Åš”n©Lx#Ä¥é¼ŒH„aBjf8AaCä4D”ý\"¢BoRÛ7‡\$ª(HWK<(8p¨ABÃ>mØsãbµˆi\r¡ÃÍ)É^3È‚W`øC\naH#\0èÃZ‘‰\$ó9H¶ýˆp.XfN¬`CEÉ2v0|ú›3¯ÈóD\$¬âŠÂJ•¡ÉjAP4\0†X¸rÕlp@±ÖHn@ë´1©U&ZïÅy¯Uî¾WÚý_áÝ€°94ÁC“a(YDF6ÃÁô´cGµŽ±ò¶Ò²RFfí¢ÓnWÑ†0`•xæXc©Ø5É@Ø¼’~`V	Š& ÈGÔVNª»6‰J9+æx¡Úî^Éz/eð¾—âþ`\nL p\\Á˜@na\n=H©5*ÃØ‹t'o¢;£!/Aò§~0˜ÁX5:J’ÅF¸©Áöè_d} èÂ‚CšÉJF¤šb N¹˜‘R1\n-Il¥Aà\r°\$(<‘\r¡•©†Ì¤\$s«Uk†`ëM`oç²˜®ÑƒBPì5å(t¶!±\$@ø×L¢¤‰¡18´\\ìŠYÖhÐ¸Â6„l–\"@P	Ba¥j2ð(Ü1œ\$ 0R“q¬ˆ0p•›o5Â•“AŽ[-˜Îºi=j3ÓÅÐˆPÊCA½sS4O\n±Æá£qY	ŸU¢UE–/ Af—8sDkZ× UÄÅCpp\\«¡\"fLC@iu=d†uïMP¥·ª¡†JS•ÊIK)¤‘4&VNLÊÊ8‰ìÍ´ëRôáŽS1Nƒ:SÊãizjî„’4W\"\r-Mg¡0ÜÔ×š^AÄ:¡„8Hm’ò¹eÛt\nêJªiÙ[ždš2º€Š¥—MÔÄTÉlãŽ0½Â2j	BŸ3<G	²LcŒÜBG\$·œñ#4\\RËI'°ôrô›¶×{Œ×7P€#þq\"J+ÄáÞÌ8Mš6,­†UÂ°Œ+¤Þq¤M÷*³Ã[	Ùe³™¹–RY¢ùžƒê´Ÿ)£= Íu§1i ÓŠˆl‚xNT(@‚.pÎA\"„À‹žÊ¥ËmqÌV%MEÕJ¥M	´ðÌ(;uÕ¶s?CÈ™S£\"?D~“’˜	^!ôÓfps§¢™^u'Àùjˆt®0ò8n²2¶øà§„µë	+\rX d;Ä‘GÚ²]]®u‹({_c¼í’žaù&g¡ê£^Aøº:JlÉ‹cÊÖŠ‰\rÄ¡B¬TØ‰à¹*­Ö½’@¢©ˆÆ±Y+\rÔÊ²ñÜÅ\rßÐg[›³Z?Í¹½£¹¼ÌÌÜ#‘ŠIGzê&ø«Ú¼ágÄ@À–`L5ªLRý••íN›)ã¦ðÆ;fƒl:`O‰e9¬lo¶°¯å\\ë£wâÌwå¯(Ï¶w4Y`ÖdÇ9¡Tæ¦üj5|vSzPªt€Õ])?No}b±aæèÜLùNjOÁÕñ>z	f¾–vÿqÅ¬¹Ü*†ü@á¥-;]}Pò ‚ƒ¬štuÓ¹aÝ ‹50^[\"±¦\$m^ø¤ÇàH/H6†7HˆåâH[Û&r…ƒ”ž÷FVUQ •ùLNXM]a°óL 5!àý!ôÈëËgÂœúODó&vê­ÉyÈ™y	Ûå/€škÖÚ;[N“Hà”ÏÄQ!¹eï(Cö’ã¦[úš3ÙsÍ¦g¾.„†ûUb¾[š;ñ‰„	›rókß»áMPèù×ˆÎysj!\"W´&ˆ ^â‚ÇMªSÃÈúˆ¢-,*'Jôö©Ñ\0¦ŠdÃÆ¼NJgãˆ×ð9GþtÎv;hŸŽ\ntÍ–?2Ð0'nïBr\"<dï8Þ¼&†ð@ˆA àHà~ß£JÌdt(x2cMK¾OBlåˆOâUpXÓ‡B{ÎP\"NfG#rÿ'¦‘ôã†ÀæôåF¶FÀ@\r&àSÅ>Ù­`ì­|fÈö­˜elÙÐÐ‡°ùBœ~mn€Pà×®`80IÌ|ÍžÔç“ÌDö§¶âëI@¢‘çøºñ%qË§¥ñ¢\$£è~‰°K‚¾nñ%Ð\0hdËl˜tçººp2.½ðe-óiÃ¯x)Í°%qUŽ„{I4daOkd¡¢Ä51ýÑ‚#ŒÒ£‘±\rB%C,:ŒQ S&ºÌÊB?\$aŠÿp°°®Q„è‰\nN7â?®*M”3Ž|é§ˆÐdläH„‹ÑŽÿPüeQòmq€‘LÂ…±ž{Qìí™Ìm©­ÇL²ìPI±Ør\"Ç1!!¡ Qözr.€§ö\".Ðì20?†…dbþŠÐ¯øI®\$Dî¤–ŠCöp¤¸ù©ÀùòÔf°@ú;\"‘ùÒ„ùÒ\nš’9¬D{®o(‡¦.N\\LMìÒ“D‚<²C‡µ*NÔT0%ÍúÊgâØ,kò´ü’9R×rGæk*-)p©ò×+rG/2Ð¼2ÚäP³r\r.Îx‹Íñ-24õC&pN¥2\rm†êµ’ï³#1¨w0R”šòé)³1	ÓJ\$é#æ6G1\$’@mÒ¾º’ÿ5LcÒ:‰êS	©¯5ÏË3PJÞ±ÄÉ\$ÔJî\$ú‡Ù4äºó' ƒtÄ§æs±\rªOQP1ïÇ72`ºQäÓÅ`t°ëBpkg\0S˜7ã^ŠÐ!\0n\$1ròÏ‚¯þÐç×·Ì.Ìó:mdÄüÌ´Åäª è@Øl¸@ÖTêó PdÛ¿&g€HÀª\n€Œ pjˆ<Ç/Zñ¯2Ë©§o1çà3K£ø‹mL½öŽ!bq@jFÇ/ñ0£º\"T mtÛ“bä„b!'X â•\ntY\0ë·FfÖü\rÞI¦âã?B®ÖH÷BMú2ånÊª8›âV¤Ê@\$Ã¸Ñgq5’|øÌ¨ù-rhâAD6¥Vqe^,æb*àÐ¤ULÊV¬°ð4äÑ¸ØFÓ°â¯táM&„îÝ°PUÔ×!õDÔæÔÃ~€”ÞØu\r\nLK n<ÿn–päÐ5daL[P0X,&þÑ‡J8zt‡7NR)afw?CmK‘jéSŠV´r{r¤wâQ*\nx\$èGáZ1OŠÂðW'U&CµÑ•Sa9'ê*4ê8”BÅðÜ‹QNèrêTéCÇoO¨ôÆî\ràì@àî²%!K²æì„ÚØz‡3JMÈ4ƒ~„8";
            break;
        case "fi":
            $g = "O6N†³x€ìa9L#ðP”\\33`¢¡¤Êd7œÎ†ó€ÊiƒÍ&Hé°Ã\$:GNaØÊl4›eðp(¦u:œ&è”²`t:DH´b4o‚Aùà”æBšÅbñ˜Üv?Kš…€¡€Äd3\rFÃqÀät<š\rL5 *Xk:œ§+dìÊnd“©°êj0ÍI§ZA¬Âa\r';e²ó K­jI©Nw}“G¤ø\r,Òk2h«©ØÓ@Æ©(vÃ¥²†a¾p1IõÜÝˆ*mMÛqzaÇM¸C^ÂmÅÊv†Èî;¾˜cšãž„å‡ƒòù¦èðP‘F±¸´ÀK¶u¶Ò©¸Ön7ç—3‘¼å5\"p&#T@Œ£˜@øˆ’â8>Ð*V9Žc»ì2&¯AHõ5ÃPÞ”§aœ¤ÃÔÛ£Xæä¶j’Œ©iã82¡Pcf&®n(Ó@;ÒÔŒšx´#ƒN	ÃªdúŽ€P Ò½0|0³ì@„µ)Ó¸¼\nÑŠã(Þ™‰Ó\"1oÛ:§)c’<ÛŒSûCPÊ<‹¼F¦i¨˜: SˆÙBRØ9CèÒ^6±Â‚X—&Ä\$õ=qÒb4¦Écú0¶è¢,°Ãs”òP\r€È:BBXÙ'ƒ€ò9-pÖ4Ó­êî.ì@‚29äÍ\0@P\$8A”\n0ŒcÃ8@Ž¥Ûú2„»N4\ríŽAplâ:4C(Ì„CB€8aÐ^Ž÷H\\“Ö«˜\\ûázîÚ°pä2áœ\r¯µ˜ŒÏ²¢)à^0‡É¨¬–4ïõ“ Fís®Ð7c(Á´HèÜ¶\rcÍé­¸ÂR×¶,@ª:Äj/<Bº7'c:&Œxì:9¦lÙR8ž,*1ì|óËi•5ˆ-¶Ã¨²xèÉ R\0e@ì7XZ~êB5^5à’(‚3ŒöèÏ¦\r3åE‹0ÌýV–9Bd<ÓÏX²X»Œ¨:5H\nPóp2ÄJ%JÓ§˜¨‘hÑðÉ‹	jB\n¾/ÚzÙ\roNŽ›\n\"`Z‚hÈÚÜƒ±	K˜Û1:¢ JE(”ô©ÆFãtKv\rÅ/ÕSCk©3í\"ŠŒ'.+\"Ü¼ïÇ¶òÏÛÓ.Pˆ!<îÃƒëx°Ù.êH\n7ŒÃ52…ª\"MB5c\0:ÓáúŒ±#HÓJïrb™˜#U{E‘Än’Ø{Ÿ1°('!T¢ÐF‹bØ)\$|Î“‡xŸƒ:V®¹—üP\r.&)÷“ÇäÈÃ+õÜä¿£FDŒY©€\n¶˜°ó•9ëE\",È€]aMf°LÑASc\r›ÄA 2“6œS\nA·¢RÑ.0¶DCÖÙ\n4©ô8Š‰¨UOaÍUÂÄ…á#ù\r%D4)DD\nfeÄ+5Ú–ÀcN„Œ¹­•¶·Vúá\\k•s®îºÕ¡v>ëÁyà^F\r»‘ÀˆI€ÌX3&¡%ü©¢\nAÃtDSPš@ÐP¡»£.æþ§äCš’–&ð«¢´ÎjI	1?²Æ)- @·òà\\AÑr.eÐº—dŠ]áÉx¯4ÞœCrs’kíÃ§3&Aòm©p7†B@uQÛ€E†-À2•Lª³DrnN‘²‚ªÑIX%\$j“˜[#bÌXIf†“˜Ì.AÊ8“&jC4®@Ëa†bûxgC+8:‚‡	é2n¸¶ŽK©‹›¶Pr‚i§…E\r<H€H\nr’\"EKÁAN&h¬,Ç*„ÓŠ84È2|\0 †ýÃ(cpK#?ƒ(g\"ëQ #€ÐºÇ9‡Ä‹°¥Y\"1Õ@±•óÂÖöTÃ¤ù[ ‚«‘ÐæJÖlGt`‡¤½PzÍ\r¤1Ñc×\0Y”Uf3`uP‰wi¥ÜžœÆèP‹¹1cæ-§ó\\Iúy1H%ŸÒÈÚ±M¤Ô%Çµ\"ªyç¨ÕŠF>µ\nšbÚ:È•l‰Às/¨~ÖÚôFÍÓ³î~èœ’\0 Â˜T«&ÊŠBèe)ƒÅ6Æ¹dºt˜í,ñúXáÉ«‘ÔÈApf\r!œœ’&Žê9—d‘ RL²P19±MÌ¾ŠU\n` ÁP(¢xaŸÙÏtæ’+ˆÊŒ%d´—“^Jjñsi‹ƒàäŠAchk<'\0ª A\n©aÐˆB`EÄlõÝÌBF!%\$£Ò3„e\0( Ö\$CXŸkþ5GTœ½\"lûƒ•ÏbÙ‘3,«2T²HÇ„å%0êÊ± 4°•¢W˜¥\$ŒñA%<‡VÃ¡þu]Ü»'—óhP>§UOäHÅÝqA0„ÈKƒ’sI¶˜S*h‡©±ÕÃ)µì'i)ŠnZTýFÄt[4Nk*±UÀ‚ÚãpÌ—kæ´D®Ü£#kN\"žïgCô*ùo.ÊÉ\\ûÎí„È\rŽ1ãµë6†ÄÜâéºEtÕËdS&bb«‹h£i:lƒ.\r6@ZÅ&ˆ8JÌ^Úì‚,>íÀ±2§3¤Õ(”dEY0h]¬(zNÑù¹%k‰!\0~[‹³Òˆãgâ ¨BHÅ<¤vÖbº·JñÕÝ7éò§%êœéÖjÁ=œ³Zžc‚_\rå¿Š]ö¤%\$ê§“¸5ÊtW,<½Úþc×&\r&››R'9bƒy¾·GØÓ§¸mÉ«:c¼ç–ó(5Ô¹R©5\\ì:Æ²la 1ˆo¨XÓ‘ÚŸsnyŽD×á§Ÿ¦Pµ>\r&NK2Ii¬]ª—¸“ægoÌ8³L)+ü¢0v‹ŽÒ)Í©Dæ‹©ìô½á¬ø_ƒZ?vEh›ôÆFzöPTûG–n0€bû¨»\n“ÏMX(H9=0ÜšJÆÙ	Ä8×a·>þêPhTO/º0{ôñ=E'Cé­7¢ådð™€¤ùŸRìÅð ÁQy&Êxœ3E™~Ñ±ž%ùæm†äq¾1_¨\\“­PeÜOú‡ÚCzs\$‡µ\$æH¯òm\"xÆ /äH­ŒÙ Ê2oºuÏÀØ­Žœ£Nh%xR\0¦Æh¶|(&P\$€Ç¬wF¿,ÆPO²÷ðD#«òÆ4‹‡•O¨ÎFiã(\"£C¯¿í`žJ¨\"ˆè°z\$°jø„\"zC…Ï¦B#D·NÄÞæ`vš`êæ	¼èhùNl-í0¢.Ó\n¬æN‚äp´ø§ˆÛL(Û¯®ÌO\r#®<PÖ'pf~0•Í7\rM¸C+òüðŠHÚ‡À7î{OâÅ¢>£ÊX %˜´ÊÜ8ðrÍd/„|1\nð04\rÂC\"ƒ‚°3\"vÙ¢@7Ëª[,Z\\}ÂR‡%°=cÔh1>ˆ\"-0æQN|wï¶Ï2Üc©,ØHc«›P€üÑC]±Ž×Î·ÊNÇf÷-­ô-ø!PÛÐññ³+òûÑŠûMö€pUðÙbS­ú1Ž5ñØ!LxOg\"`˜ðÆ¨\"kJ0Âl.®V†P¤õÂX€€¯ˆ3eKoÍ Íñðípñ!£°jüÍ–¡ÃÜl'Zc%¨Îb.'¼ÍÈàkæ	\$Jœ#2>¸¬d\$Å\\#Q)Ç\0%É¢e1•\rÐð\nrbNRiÍ'\0×&Lë(=ò,uÊÝ'2f\r#ã«'òtR€hBAï†ù²^‹Šè±Õ%ò–vdy§Ú\r-Ï’&ÏÌÛä˜XëP-\rÂERx0RŒÜ²Å-0éÇf&ë-ìxI£i#ÆFå5Ò©	dl¨Ü’Ù0Åàƒ]ÐŒT#úˆ€É ° R\0šU!l7nP< Ø1Æu\$ìèe\$ö.QÆä²;%ê\$±ñd\"Ob˜0îDm¤d;Ã5£ÇðÈgLÖOP•`q®~¥ÐË7¨Š:©V¨Äº\r€V6åÈ€B:´0’À'tÎŽ¼íbŽGdoÃÀ¨‰€p›l½Cg#L¥„/ÓPäãT(3Òù¯¶Ë)r(\"Í69Bn\\HŠH£†0³e1£]?£Š0ä8'de@,ò0äD@\"ö5ƒ]:Dì?BJ…-Èº£\$ô\$/,fàè‚diÍLqíâüâþÀô(zëfž\"Ð-ClðtH{bxDl¡EÏªZKò „|×OÂ/Ã}&±¸üÔkF–ˆ_§	Ge¤7Ñ©Ïb%˜º¦H/Ìî	 ÞýŽ˜ßãôpp8\"pT´p¦²,ºeBM ¯”1Ìž»¦¥H‚b\$Lx6îVtÜ7 äÓ¥6>Ã\0ö´Y3‚ÚÉì’5Â6œ‹G›6Ôü¹æ‰G% \rí\0èbÒ}(/£r@ÊÂÐ÷ŽI¥*#à";
            break;
        case "fr":
            $g = "ÃE§1iØÞu9ˆfS‘ÐÂi7\n¢‘\0ü%ÌÂ˜(’m8Îg3IˆØeæ™¾IÄcIŒÐi†DÃ‚i6L¦Ä°Ã22@æsY¼2:JeS™\ntL”M&Óƒ‚  ˆPs±†LeCˆÈf4†ãÈ(ìi¤‚¥Æ“<BŽ\n LgSt¢gMæCLÒ7Øj“–?ƒ7Y3™ÔÙ:NŠÐxI¸Na;OB†'„™,f“¤&Bu®›L§K¡†  õØ^ó\rf“Îˆ¦ì­ôç½9¹g!uz¢c7›Ž‘¬Ã'Œíöz\\Î®îÁ‘Éåk§ÚnñóM<ü®ëµÒ3Œ0¾ŒðÜ3» Pªí›*ÃXÜ7ŽìÊ±º€Pˆ0°írP2\rêT¨³£‚B†µpæ;¥Ã#D2ŽªNÕŽ°\$®;	©C(ð2#K²„ªŠº²¦+ŠòŠç­\0P†4&\\Â£¢ ò8)Qj€ùÂ‘C¢'\rãhÄÊ£°šëD¬2Bü4Ë€P¤Î£êìœ²É¬IÄ%*,á¨%ÊðÜä*hLû=ÆÑÂIªïšŽŠcËža•\rÐ)¡KqEÃœ«K±JŠ“¤s …*IK²72hÌNÓšÂ‘ÓàÀŽ•k¶­V.ËX†(l+µ2# Úˆ&Ä47Ãƒ¬<—*/Ú‘¢8@žŒ¢ÍRí ÐƒÙµG…\0xž¨Ì„CCx8aÐ^Ž÷ˆ\\0ØV#¨—áxÊ7íjGC ^*ðÚ—%€Ì—(oÜã|/Ê˜˜60ÝT5V*­LQ‚zú0C£q21Lc®Æa\0í\0å5~0ž°é8,­HØ2cc&û€P®0ŽCu¢Ž„£\$ø1 C ¤ézj:!ãeO2IÒ„,è{*ÈlÙS Zql³XŽ0¬£ÊÑ\nº22oÔ[Iç£.™Y0®ˆŒìîñÛ\0003ìC=rø\n[¶B›1í2YËãy†\\B ä®[S°ï4û‰‰ci2	ŽÌ¶Œƒª}BØëà)Œc3OŽ–âP6f”Ô2í&U/Šbˆ˜½g<›£}¾O£˜åiŠz1T”ü1Õ(ï‘ ¦CšmŸŒ26Ä˜0ˆç¯±û=`ÑìT½ Aæq¦5ŽUB‡&»çÅ@ÏU#üc\"³¢!ûyc\nO³è}O=ö%Ð„¤ÞùCO¤“´ÀgÎ‰£!ñÝ”¥¶y|0¤è\"3°ÆÑ²²r%Œ8*X>aJ*;gŽ]m‡W¢¸Hš&©žÎSk¦Z¦E=4¥†‘ih.H7ÂU?	á*ƒÐ¶•âFa™«7à‚š”ÜJ]r<‡ÇqE“ ¨ÃZû)… ŒyË*)'T+\"„U\r¨n ÐÍ–gšòE0&h2dÐ‘I\$„°¶XIø X0ü†.>I\nI]\\i…s.…Ôbî^ÉzHÅî—Êûï=Á°0})ÙÿbH)E ®‘°pM\n¥p©hÞjÈ4MÊÕ}«tƒâ¬9GÀƒ©âP¿ŸJÓHRÉ±Y&¹C*ç]+­v®õâ×šõo ¹|/¥øêÉÙ`lú³æÇ/MT«Ï*b'E¶§ÓØa&Ž½Ù’ˆâl¦:¼uÒõ¢’ƒ\rÙÛ51Ô„¾™^dbòbZn¨-’‚ùçÈrÆé¥O\"WLècYáÌ3âbËé™[*ÔŸP¥4nˆQ•)*¸£‡3”×Ú‡3%„±³—leÙiI)ôÂpÃÀ YN1è‚\0PU¡¦+æ09’ŒbÜ nò%ØšÇÞP+óiN0„Ÿ8¨²™AA•*¹x«•Ã…dØƒªšCI	df´…žzJÂCppE«y€4 îMÉ´Ä/‹ªˆWr›ŸLÃAihÊÌBˆK¨m„É óžJLœÈ2q²7OóV›ƒ;@&õI†–\\i\"¡§5&­'èædÈQ»KæUÜÁR¥^ªô‹^Ë„£’é\n¯!¡ÅKæµùÁÅOQB€O\naPŸB@@àu::©¬TºTjß1?ŸåHØÜv: 5 ´W`žÆ—H bÄ<|Ð|š \0äàÕ-?\nŠÔ{VSV^pÌ¸DRÊÙ0w¡1·\0Œ*	æ¦(¥/£³(e·¼”>ä¥ˆCœÄ%:^óþ¤Ia!Ú*€‚xNT(@‚.(ÅA\"„À‹ŒºY|¤ôì5hAŽl“¥mÁ„6©zNÝÝRá<80â:NAŽµX7žâ „¬Ë´?Œ¸§P’œ!Ã-\n…9®?èþ&Wš…îñJ\"¤¼\$R°B`±ÎBï§Ãµ\nÃ¥°C§°–=ZÝ]Sy	RÀG¢ö•Kþ%1çg:çR%ÜÊ”l„\0¦ÖäÔŒ4\rÎ6Á…d©SØ:OD\$»“Ôc8) ¾Z®³+e_l#Ïí¤”j¢¨š§•ïIElè„•~±\"\"¸œ*j\"CçúF(æ67ASXsìÌ©:†äÍÑÑ|O“9”|êhŽíŽÐ&P4îc\$ÇtòÙ¥œÈðž›ÎA»{)3†BÒ1%fÛäèåe¤ˆTæÐx3âÉ˜±\"ûqã'å/~|\$á»‰ŸÒpfR€rW²÷ÔìÞùMKqbÑ†\"C²0­.ém Ç_õøS*o‚…@¨BHñÉ”¦ˆJÝBYd¾²„PäeMÅé5äöÚBè*EÚP/`˜Á ÊÓÚRé1ÛÛT¾ ò-U+LÔ†:…F”€s\\-C±?öÊƒMn.³ŽÐåûSíÛ·†>ãÜû^!=ß[Ýö(`™iØ\rªõOÅ>þ`è¹:jUÝvpñÚwY(5ŒøaQK»|ï´ïÐT_GÛ½/q¥þ€Ç¹Õ‡ÅØÏu~„´—ó–@åa+÷†ƒS©ÿ~L*Yœ !§˜±Ø9„‘NhÂØ`dhÍ‹¦úm´+†PÄt¼ÿ€÷ÿ\0ð^Ÿç~A™u¦Ä ô­¾ÉÐ#ˆ “¶F3û¸ \n	\n(½ëÌÖ?c‹êöñ†V'`Ng¦~—©”NÛí\n\"¯\0í¯,þ'°)ˆ1o0œã´ž-\0¶ Ýéš'gjO0,-Ö+Ãò?jÝÈCï/jôPf¥#'ä°È'gæl˜¯ÞmbNâŒ\nrÆäh ˆ¹Â¨\"À hƒ¶Û\"`5££\n.LÉÌ€ÇfÝ\nhEÄ¬#­ŒÞÐ2ï8‹ÄžBâVß„lkl|àPÇÇF7\r»ð`ÒŒö€°PCÍÁâxÍ)’Ò¬øèÐvŽ&¹–ÍçÖõÐvl0{ñÏ°Spk*\"{ðúÐŒ‹wgÆ|÷q +7g½¢‡ëa1D\$<¢N?®¨å‡ÿÐ0òï¯ë®Æ%dˆQ¦©SP.HOZc±‚÷OBhÐÐ`Ä‹`Ã§\\á¡P±±yŒÙNðTáŽiPlÎÌxáQ°Ãñ·PùSBÇ¦®ÏB8ßîü˜Ë¸•+àC™O:±¬„È¡T¥\0é\r%Â(L6€@.Øs.r\"È3ª!F«í*ü­CÌc-Ï¦ÄÃÒâJ‹ RÏèBHŒ3‘Ç.Ùäò.íÞeÐ2Î,¿‚QÌ&_1Á'ñÍÐ]KÊÝ1»pn\"ãQ'ð2nbgQºÐpÿOƒ*ŽdÙr±qeS*²¯±lQVàŽ0…rÍ,ï)Îq-²½*Òá	‡°éðW…ìHÄÿÆ¨2%*&Òº20\$	ÌÝpa‰(²µñÔ3Qu(c(R‘2D¥rÓ\$‹-‡Ìan8aÏàïfÓc¾dîo'Bfo“E.ST=Œ«4æ¾k'Ô2§bRñÝíxã“)3#7C»7’‹)“‚2sv®±»£&æD#“‘8n5Î8N\$t\r\r3ÑB˜rJ‹-QE3Ó²kS©-³¿;0rî6ã³·Ð˜g,â.8LN£9s->N4âSì+²—<S›4Žs>sÛ?£'4?sêýà¨ÙeØN_-ìNø\$¤@¥4 Sïi£ò¸FNwCý,Só\0Ô*J”A<1\"'@?qJås2L€ŽÃÆ‚p¢Œ.¹6\r8®Pvhƒ6wk6õ4p†(&þ4vüô|*\\HÌ|1æ Šçb!Íª4Œ¢î¹¦É?ÍSJÉzPLÿqeI †,@ØlH\r-x5r-*\\mŽ¢6óŸ¢si\núè1!²R*2ïÎ81c8OÌV\n€Œ póOrŠÁâïNèñLýOQâ,‡‡ê\$BHO%>Ýí°oK3FUç[4G\nvµNC¢@d¦}+°vn>\0ETÀD5ƒ‡¦d8‹e*4ÜÃ\$”ª\rˆ'ˆ/Æˆ~lO\n'ær¢hÒbºƒ:3ä(OÃ¶ö¢•4½RV,C²w/Nbc4‰g,Ì’Ž d|!5©Qñˆ±ÓI,ï[¢•[õ#CuÇ]•¦Ô5ÐU[hŠ;e‡&´’Þoî*2~#§\nq\rd.¤ËÕÌÙÅ:ýçB?ì”mâ•\$%UaðçbBc\rmúª›\0ÏD­Þ'oÓÌêÅšsÌ,0þ\r…1à¬=5jMK2èã¢ˆ€ÜèŒ°ÌlÊ+¬ÏM‰v±±)b„ºË0\0uÔ1àÞ `îrbÚÓ’U@%ÈóB-¦lƒØƒÃæD\rÀ";
            break;
        case "gl":
            $g = "E9jÌÊg:œãðP”\\33AADãy¸@ÃTˆó™¤Äl2ˆ\r&ØÙÈèa9\râ1¤Æh2šaBàQ<A'6˜XkY¶x‘ÊÌ’l¾c\nNFÓIÐÒd•Æ1\0”æBšM¨³	”¬Ýh,Ð@\nFC1 Ôl7AF#‚º\n7œ4uÖ&e7B\rÆƒÞb7˜f„S%6P\n\$› ×£•ÿÃ]EŽFS™ÔÙ'¨M\"‘c¦r5z;däjQ…0˜Î‡[©¤õ(°Àp°% Â\n#Ê˜þ	Ë‡)ƒA`çY•‡'7T8N6âBiÉR¹°hGcKÀáz&ðQ\nòrÇ“;ùTç*›uó¼Z•\n9M†=Ó’¨4Êøè‚Ž£‚KŽæ9ŽëÈÈš\nÊX0ŽÐêäŽ¬\náŽkðÒ²CI†Y²J¨æ¬¥‰r¸¤*Ä4¬‰ †0¨mø¨4£pê†–Ê{Z‰\\.ê\r/ œÌ\rªR8?i:Â\rË~!;	DŠ\nC*†(ß\$Žƒ‘†V·â\$`0£é\n¬•%,ÐDÓdâ±Dê+OSt9Bœ`Ò§3ê”Ôª«Ý\"<‚+0ÁR¨ØòÁI\n¨áŽ’]7­“()IÍ01©A\0ÆŠÓ-È ŒŠe0”Àì@ËÌØÔ[ÖCoäÑH„º›(Žµ›]Á®0XŒ(ÐÍŒÁèD4ƒ à9‡Ax^;ÛtiU)Arò3…ì\0_Øp^*ÁðÚ¼ºãpÌ¼§*r*ã|š\nc*@1Œr*ûV?’Xƒu½ój9­’ß‰£{¢·\rKta¸z\\Ü7ò&7Â«\nA\$Ô¨+¥ë>£ @1-(”åyk8QC`ê6¯ Tnæ’û\0“¯O#\"1³y+\\X2ú§T`P¬ºÂI*¦2ŒÕ+É|ßwê*ÇˆÐÍû²@P‚3³c<i%ˆP¸ÆÇ¢ª¢\r¦®4ÜÊ¨c@èçã,ó1©Žø˜Š¨\ržT¨&ó¥O~DQ €mtÂWQ¤‰Žá°ÍëžÓÜ ¦(‰€TÐÊ[3ªÊâ£N ”ˆUå'€Ï/NÜŽ#¨Ë@ˆlÛ¬9ö=›~€w)Î§•õT—X\n\rCUÉbJIY1â(ñ±ý¨ËŒ0ü»ýIxT¬ø\"\\_qÙP(6³7ìû*Ñð°íGL(‰L°ŽC9ÄÒgtŽìðë½Ÿµª§Ö‹ÛÇl„0”\"BWØé€*¬©U4¸i\$‰¿ÄtH_ûíD\n\nÀH A+LÂ½¦tÃ\\\naL)h(ˆlGÀ¸PÝkØ„p•¿×XTÉZï)fy+ô üz\$&ƒÖÀ¨‹p1Cä‡b BêÝT-Àä±ßY(d¥d¥˜³–‚ÒZ‹Ylu´ªNÂÝ[ë„7ò _W”u@ú;ŸÃÖ½²2FŒ&\$«ƒ• ÙBA™\n!%h–Ü‡ˆ¡õ¨Â:_Ca§;õÉ–Ö\$ u†‘•eµHÐ´VšÕZëemÇó×t0	Ú=.—”û?2\0 @O…J•p‰­ž„&¨	I)g‰¼“@‚‡bkô‚áŠÆ€”Aª1ÈpšB`®\r’þW¦ªLÍI•’K*!˜Òœ†­C˜f3À †s±8Ã h&ó|÷¤•DfÊ!‚A±<>„@‡“«ô\"g­˜B¦‚¨D³š@€(€ AC{ÐC€€`RnMáSFl‘â@ŒˆªŸ)Æ›’°àñ‰\0gKR(“?¥\\Õ˜lH!Ý-#*\0`èaFq!ÄRÂä,•=\\ºÑó±2*	âo£®‡bb	TR}®Ðà°VAÊô4\"©~C:Ðed†|Á€ÃŒXxT5Êä’¥ù?(.ýµ¼´:éMGÈžŠH¹Jk{FMIá|Ã³í\rà‘FC³XÂØ˜ý›x—ÑvWCì/EÆèW¦r“MhP	áL*52rþ#d<MÖ%™@mÉR:‡òÄ·™cLÜáÒF(.êÐÂÚú\$DÈA‡c:ŽjE%®‚6ý²4„œ“²W(F\n”\\ë¼²LÔ,ÉT%fMB–ha±¦–AÈ¾§ÀðÃ<mg ÙUd:\n:ÄT¶\"lBT\n¡&´B•	á8P T¸ “`„ÂRÂK\n@Š.À¤R9LÍÙÎ,‡A@”4ÀB“Ë€)¡Õ-„ðár[6l×\0åØ*Åâ¡%èºd‹ãb¡{<*£êOûÙ5²lóªSâò©Ø d(ì«„:õà½{Ká})–´¿ÁX‡JQK;gPðsRKOI8ªRðÞ­R[O/I½™LÓŠTˆ\"ÅX'vz!€©·TEÄò©Eh¹Vg´©³Å×£tÒYÆm»ð±~/Ñ¯¿º’Ž`Ù€Ãv\nU3«¸N‰ã4.¡Ž\"V±›¨VT\$iTÊ»ÇÀaj|1†m9?˜Uâv©·8{1‰ë7,oÆ:\$¹™ºæ.JSÛV­Ä½·¨ @NÁäÛ×íÅ˜hsmñ¢7Ñ2Ò3^¡t.îÈ†49ÌVÎeOSfVNÌÌŽÍ®ÓËÁ€¥…‚•SàE¾,…%Ú„øôÂ‡ˆ­ˆ*L¹/F˜”I\$gU‰&§®,9‚ûqLéŸ7ìÀ‚^Ê¹©\reD·WótS«øºw3É8±)•‚\nÇfðØ5U4pÁp	RüÇ¢ŽŒh:LçôBuåé¸ÆÈ±„\r:zÙ£ó^‡º¹(&ŒÂ0ô4]ÕµçXŠ·/X®£Û:2²}Ã£ÑµGÝ×vq}ñ '‡5úb|–ï0”•²ŽÐ¯1'ÈÿÇØ.Ì!›]`ýËÔrƒ•í2¡x÷{ñ)§‰x>Óã})wÆ‡¡6‘fÖàù÷TìÜ4FXyjK		ý—¦šêK·´qg=Œ0ì§˜JüJ—Ùµ£EM×NL\"—<Pš&˜þ—Úvoð«¿¡ö\"[•7ÄÓëý#w­)ò^ýß¨Äš&}Cÿ¡¿]jTÊ´ô‚ÕŠ^K@Ê¬¬ªd˜!@àDÂök.kbR\$§ˆ%.løÆOñ‚\\¡Oü]„ø#>)LÆNâB5­Â1¥j›¤pƒðJÛ†zfÆp0 PH Üp,x¬VgÌÀØo¢9#\nzç~Î„ðK\"¾I/ÐÐ|ulÖfƒ7°zÏ€ý†tÂ]	‡€Ë,òO\r„UPŠ„G¾wOãg`Øð bÅFü0ÃËÞÖã*c]o¤ `@a\nVë.–5NšëÃêPÛ°áDªéNwÊ°éÎ±Îþmâ\$+æ/°Ç\nPË…D¾Câ•”þQ!-çÉžŠ\\¾§~/-ÊIæê¥hš‚,2h€—ã8]bo%Ž(iÌEíÐ%+¥j·_ìÓ­ÒIè|{PâjŠ¬\rÊ‚ªf§<OâdFQ%c~c#é¬Ý-t\r« y­ôÞ\0ßæ\n\"‹\n†\$\$ïÍQÄÙ°¾þqÆËî0%1×0µÀÊâe+±ÃQèŠ‡¥æ‘ìÛèk1.7\$ƒ G¦´OH~¤fÚ`‚qä¾—7<±àÝ0ÌÏÊæüo¸lP>!R2!R6ú±Òû#NÏð\$Œ‘ƒpk±Œ¡MÖ75%2\r¢XkÊ&Òf(oªgPRwë†ÿæ¦B£>ùñÌþb×Š€‚RJý2’vR^Ëòc\n’Ÿ)r¥*²£ gå)R¢â1\$Âœ#rš—ÒÆúÒ°¿q^g’m,ò/pF¤MúÞâóñ.-øßÅ,¢„ÞÃÑ/rWÃpLÒç/ëÝ&Ó	/KÜ\n‡fg’\nâ’ß\nŠh2í2C:ˆ²ø‹S/2€	&\0ÈáÐæÓr62¤²B­Øff÷X\rîÆ(bœ4.}5cZˆBÁ6FPd1æ`E*\$å‚-7¯¶hîºéèŒçÏ¨‚Åq‡òFDÂ\r€Vhdj0C6—Ò‚j.ÎKCH\$Pò¢ çr¤pTrXp‡ÖÂ ¨ÀZtëbDò.îñèæ£DþÂ.#\$r¤ÂB|MÉ\rQ¿%“L_Cb;ù;Ï\n=ÏÒ†NÒÑË0ßÉ-'n4 A;cò×@ätJò*‡@lÃÆx‹LÛt3â‚K8íÓÕ\"'\$<(ðBÌª!@Äða­\"ÌxC´x¥\0àDACH—HMiÐuG4‚ÿ\$ðÇÂœ)ŽHðDÌÔ TxIñÖO†ÒÔ¦S}IlÿŒslvRl´O†ÿM‡QpoB\0A õ/­ú\rêJM2E ù#JM†6ã*)06Ç£\"\".”ßÃ+Fâd1ô|ÉBTX)ôÖÉÂ”g´ŠmŒžâô;åó+Êƒ®¬:#~\"‡\nyh)ÆÎB¾\rÀ";
            break;
        case "he":
            $g = "×J5Ò\rtè‚×U@ Éºa®•k¥Çà¡(¸ffÁPº‰®œƒª Ð<=¯RÁ”\rtÛ]S€FÒRdœ~žkÉT-tË^q ¦`Òz\0§2nI&”A¨-yZV\r%žÏS ¡`(`1ÆƒQ°Üp9ª'“˜ÜâKµ&cu4ü£ÄQ¸õª š§K*u\rÎ×u—I¯ÐŒ4÷ MHã–©|õ’œBjsŒ¼Â=5–â.ó¤-ËóuF¦}ŠƒD 3‰~G=¬“`1:µFÆ9´kí¨˜)\\÷‰ˆN5ºô½³¤˜Ç%ð (ªn5›çsp€Êr9ÎBàQÂt0˜Œ'3(€Èo2œÄ£¤dêp8x¾§YÌîñ\"O¤©{Jé!\ryR… îi&›£ˆJ º\nÒ”'*®”Ã*Ê¶¢-Â Ó¯HÚvˆ&j¸\nÔA\n7t®.|—£Ä¢6†'©\\hž-,JökÅ(;’†Æ)ˆˆ4ŽoHØö©aÄï\rÒt ùJrˆÊ<ƒ(Ü9#|¿2‹[W!§ë!¥ëTØ‚Bœ-iÚq5éÜÁÂLd€¡.jÅÈtCA¨f¹L×§³êö ŒƒhÒ7;ïsàù>³ðýÆ1¾3\0Ü3Ó¯sÎô½ohî4Žƒ@Þ:¾£@þoô\0åd4C(Ì„C@è:˜t…ã½”4&ï…ÏÎËÁ}i[C ^)aðÚñ=´˜Ìñ\r¯<Â7xÂ@HcšÞÏ‰3‹²h<œ!‰\\ð—ßH2EÅø…IÃ¢èF¤Â\r%ÀP®0ŽCu&3£A(É!1’<Õ¦³ÄO\"03Tð€¦iªˆ©\$ÈtŽ‡Q«ãpÛPk\\Ýa„äw¹n‚ •¤´Z{ÑPzµOk Tæéi9-÷¢qó¢kx 9Ó‚À¦kÃ¸FÈâ!¨Û \"	€Æ©,Ñäíz} éê@„¤B˜¢&lPI.×7uû<šóÚW>ÞjÛ¿§ilîà\rb\rÄµøóÌÂÒUçk_\r„-h‚!¹Hœëµ¡„‚6žÑ}6‚¸.Ð‰ð<¿	Í<ªk	Éº7sXC ØÀÇºê¦\$È†£Þ%?N“!7†ŸÀ§œºwŸ°lê[y§p:V–¥û5pƒÇÞ–	²v8²šé²¸›@h‡9©ãÌ«^ÿºˆõ¨ƒ P Éz \$L\n†PHˆ„%H	éÍO	õŽ¿Ôu	q«5I)@äÊ	‰i­-]x¯–ÂX‹d, î³tZ!Éi­SÞ•C¢ç[`ø˜<ÒL'WJë@D\$‚sNNAj¤tÒ=ò`^ø“§CŒkß‘³ äì‡/ LÍ,ƒêý`¬5Š±ÖJË‚‹<ñ­%¨–¢\\KÉ1-µºò	)ˆO¤ìQÃ|AŠ2pj&!—öPü:nj1è\$BÿØ!Ãle­¥¢ÂÖKP9'd½¨…@Ð{Tô1L@U†ÀØí}q‡ ÚX¸aÉv‡0ê§Õf²|6ðÎ¤äâ¬\r\0VžÔ›)Á\0cW¡‘/CÂš.‹ø“GC\\D!ìsâŒ\0\0()`¤ÓHF¢Ó”pÅQËÀÞ¬ÃiÁ¥'†yP¬ÏÑòI‡Ì7«<våBsŒ°É(”ó q3sîÒKõÂ|•s?Š€K‰{CCppV\nÌþŸõ³'@iríIu…(ma„:žÄÉ\"#ò\$á5CMLìR-Hð ÂX%(dÑý˜hzðÉ~ïÅS‰T„R¤qà›bzK[*‰'t	Ç\"Ì5ÌDDôšŠ\"ÉI4yäÕº‡‚€O\naRš‘ÂJCŒA~UÈÌººdˆ€2U¹ÓÂ9X!#¥,¯2câ%W~D”†3äàIÁhF\n“`“1,¢N~HÈ&§s›‘ÐŸÆtÓ£W\rÐÍŽO0?\"=WÆföµš¶Ôk¡ë&Œ\nÇÄ2ÔN\"«[eæ£ÀG¨¡flÓ2N”Àš{.LI¤¹°úÌ\$†FíÎ],v/Í?Xò_U\$5ÚOdÁ¯'5^Ifë½ÊÝ»Êý£yÎÝÁ9‹ºá“)=rˆ\$€ÀƒŒŽ	p©Ð‡2£E“¡-Od¤¥ Z´Òš“ZlXC˜†—€›Á¨`µâVñíC=-iá¶Y´‡U19¤ö&@î­1~æéÈ'zI‰ìun…ù<óV‚Ì\n‹Do§‚¦JßC·FL\räw Ø0.,Ï·ã¢@PÊ5ö‰üCçw–â# O÷&j\$„jLÎYX9U¡VòHÃyk— ‘Xõ]S1v½z^ûîã\r‚+‚\r Ä•9H‚T\n!„†Pð^ÔŽ%©½\"9#¡deü\"Œ\\‚\r7šã@ &WL.DZ9 Ò@˜Ipù³]#„@—È±*Fê+'¤‡c Ói„4†áE£­a©ŽAš¢\"d@`:!ºå¨Rµ‡]¨ %È(Ì¦’†BL+¢±·œ×Ìí\rQmt{u\r™-ÔH°±Ú…]\rmX‰|e´1:W+›-Éé–ØL†	7€íð25Oðè¦«4@ZQs„õ…2ps^Qâd6<[³CÄ’K\nÁÙc/‚´	„\n09ô?y!ÊÝuB¼Ú›˜0m#³%¸2YR:Ë‹Q-ELÅ¡ì..ô°D<!Á‘<.ê(I§ã´ßgQPO	«¡/B“²KÓ»×›[»tQ£ÌaeÌp…‹7„M¸vŽî8^ZL\rÑ/ëXŽgîíš××s2]ûrsåvo§ƒ¾Ýþ&x9iÉ&åÛ÷ÈsvƒÎ|{¸@þ7M!’Ôê·“)-mÿ†yò«Ø¾±ê<“ZìÓN2à—2V—»Þ£~5ý³ª¾rëûõî—‡†Ëñæ\"vÊbkÚjð6E¬ÏÇÇEq6½Iõ«?ÎêæžùÍ‘oâ>Ñ’ÏÖµ†¼ˆX£ó.Þ´ööÂ¯{s5¹1ÏÞC®Ó0(ºrñ+ò'¹UÃïÜ²Ì«tü­ú_âL‹\r°¼«¯\0†@ïXÕ°ÇpÏ:-ðA'‹ÏBLý°öÎ¾fP7\0íûB ý¯„9l˜íöÐXn(CŸÇ^ÉHn#n\"@môìI Æú^­ÎÒj0M¦ôP€ð:ô0~0o-fàoæ¬á‹TÊÄs˜Ø/1°žµ,GŠ«\n†ƒ\nÃ¢cá\$ã¬ B 9«J0\$ô7òPºðÖh‡.ç(Áîds.hÿ¤0(Ð0ù#t 0Åo/\nG\0°¸^ÄæÎª°:jæ¼I,ÑK®Š¢×°\$ËðRÌÑ2Ëð+zÍ6‡ê°1°^õä„AQDä6‘-ÉAq69nP:1lîñÂŠ0n2~æÊÓëø&\nžÜ´væÌ5ÂZ:lÖ	\$k® #ìU„ãlî‡°ÖÍpD\"Rœ`ä“àVQ,Vh+\\0E6ã6ÄÔ6Ê´±#\$Ý„88kŽ¨ªì&€@V\0Ì qH˜ÖG¨t£P@qÆfq&æÇ.}pfáÑ\$)íÔcH	qW-qú2DÕ­.%äx}‚@`c:Ü1zÂˆˆƒð„,Ï`FL#Ç\0'0ÅÞ\$ÇŽiIú\$ÍxÔF\n4é‘.æ0Û©ÿ'²ÖjRC2…'RˆòrŽ/-„#ÆbÙÎ:îyãO\n2s)‡ä/P y‘¦hä ý„Ä®MñÞk²L^Ž°\\üt°¯Ü‹2g’pÑû+‡Š æšpÏ÷EâodØ.2!(â#lEÈ‰êVñ/¯\$â]í¾Pm¿0€\ràì;àî\$ºjM²#bÇŽ\$*›¨€vRea ";
            break;
        case "hu":
            $g = "B4žŽ†ó˜€Äe7Œ£ðP”\\33\r¬5	ÌÞd8NF0Q8Êm¦C|€Ìe6kiL Ò 0ˆÑCT¤\\\n ÄŒ'ƒLMBl4Áfj¬MRr2X)\no9¡ÍD©±†©:OF“\\Ü@\nFC1 Ôl7AL5å æ\nL”“LtÒn1ÁeJ°Ã7)ž£F³)Î\n!aOL5ÑÊíx‚›L¦sT¢ÃV\r–*DAq2QÇ™¹dÞu'c-LÞ 8'cI³'…ëÎ§!†³!4Pd&é–nM„J•6þA»•«ÁpØ<W>do6N›è¡ÌÂ\næõº\"a«}Åc1Å=]ÜÎ\n*JÎUn\\tó(;‰1º(6B¨Ü5Ãxî73ãä7ŽI¸ˆß8ãZ’7*”9·c„¥àæ;Áƒ\"ný¿¯ûÌ˜ÐR¥ £XÒ¬ŽL«çŽŠzdš\rè¬«jèÀ¥mcÞ#%\rTJŸ˜eš^•£€ê·ÈÚˆ¢D<cHÈÎ±º(Ù-âCÿ\$Mð#Œ©*’Ù;â\"‚â6Ñ`A3ãtàÖ©“˜å9£Â²7cHß@&âb‚í§\rèè1\"ŠÜ ÁMc\"\r’0ôÿI˜%%4“D·ÔaCG1	B®8: PŠ6¾Œ ô=’))ˆ-\nî¢Àá\rJPÂ1Œl-7é…sP@;ÅãCOa6ô@9`@&#B3¡Ð:ƒ€æáxïu…Ã\rl…A°`Î¡|:9Ãñ^)ðÛ5«¸Í\r­õ7xÂ&â Ã`Œ#bKŽƒê5¥Lk¾'*ì”‰–i æÌ/nóàŠ/©ŽA‘dŽë¾a“CRB««0\0¯‡ÏrÞŒˆ2h:9æ|¢hD5€PžÃbC†O&Éï&ÊŒãËúˆ#ª‚ŽŠäž©È53ê\"£0Â:¥!\0íˆŽ£(%¶oûø; PŒ:ÀcÓ\$iÀÎ3©<ÆŠíëŽFúÔC•¥\0\npe›X¡ž®·¯)XÖÂ\rÒà×*Å“ ÒR‚0ÏŠXµ¶“»‘Ë¶â×£Â7Gâˆ™jŽ]šò2C;G÷ŽMAEÑ®V‚e¨«¾)ªø*%\$åŒÎ]ù©Œv¤ZL_•áÔTu{êBƒdÚ>ƒ8Ò:ßûè’6Øß:·ˆ£ÇÛ“¯‹ôuš{µ“]ÕŠ[Â Bz‚¥‚€¤\\›’3n¤¤ÇcPÃÍhoÁ˜ ¢nÜ¢¨>¡P7šö\nhÁxCcfÐŽƒ{æPiŠ‡’`Ã	wÉ¡ÒîÖƒ((`¤›Œ1¤J¹£f¤ 0¦‚10J\rä=!f\0K-°23ÓÊîbP tçÌ0¡¤jÊã†ºjBN‰<÷k\r—‚Új\r@—4ö·\rJß\\+r®uÒºÃºí]äh/%èy\$NÍuA¯°}\"˜2Èa,,ã·€ÖL‘\n)FØ5%ðè¶Œ©¶9Ê¹XsÈ.ƒS¹8çñ-UðµÙê}¤¤\"%¶·cÒâ\\‹™t.¥Ø»£„„ËÕ>§õ#WàsÏ¬8i2\$˜>NFHÍsrNŒ\$3C„jœ”ld´˜!\$2 IÊ!ÒÆ`è¬„räUÎÉZ5‘Œ”#™DÎN1ð3dÀ1ÈÄ´iè6i‡#\$ÏCf•°b¯ˆM=¡L2ZhàÓ¼d\0c–§\$4±æMÂqw/1‘¤dÝ­!2}ª™óèâŒáž/kþ5È€H\n‘Rs¬\n\nb+d|›„5B§ìm fÁñ›SnÏ_i8Jñˆ± î\\¡ì?¦!dÿH>\n†l¤C2\nLCšX°Í¦’rZÈ…gœÆiëŽVê2Ùêß'dôÿ¼b´gTòR\rå)±,°ã¡%õÞ™óa :E„Ü\$‘òiÕÊZ5È]Èœ„R‹me(3 ²AÕº{­È 1±*‡iˆ*Ì4Æ#’,ÖPP	áL*b+#Î\\ä‡:¬+Ï(å%š-¦×KOõ’Š‹)<sþUž‘‹ð:¿ ƒvÄ—rÊUè7lLªsj£ €#JvìÙé=}³h™ZåzF”•œ.s¹¶ÐîÌ˜y æ°ç€«ZPYÒ9nlÇ¡l|ÎŽiM07‡¦Mcáaòaš+‚ˆBC¤M(87¦øÛÛtUÆuÑªò(»žš”\$çÐÆÊØ•Q)\"Øì<’ß¢\\;Uzã?åFPJzŠ{§\nÉ†ðÄÚòŽN{Ð·G¶­rÑÂzá•ìã“°dÁ¾\ríô+òbÅ›}bÖÅÛCH*’+i&ÍÅµNB†}-æ&šÍÝ“Á¡ªà»©ÙCo¡L€¶êŒû!Â?2Óô¹dH‹]Zˆ9.Q=ø_Ï¾#Tt &zm(w#¬t¤¿FR‚Hn.aârëtŸ^{!‰¬”ï„d¬œ Cžèl6êpDÀÁ²‘½”Ê˜T6Mü\r·;“ÞÖÆûaí„ƒfoœÛûmäöqº¶•Ÿ@\n\nMh»æµUPÍyxmÙ\"·50U…ž5{Xã/…@¨BH§U›ˆ!hÕêCu`ý—õ§)W[hèwhÐy_hDX94{É92½A˜÷Œ”w\$xÔ	„-Ñ­¸ÈZCk[\\:q¢îVW .8ø5ñ®^rÕìaæh#š½Žp9ÑKäüô£óò’z-ãnO¤ó#Í\n¿65\\ä0ó¾¦žùñÎêô‚‘gžÃÓšAª%\\»“ MùJ7Û¢òî8rÉ¾m=‹§ãÒz‹ÕŠ-á\"Q…²ËmÅCÆã¿ u“‹k­¦×¨jƒ€Ðr3¬Ø2†#¦¤UÁQG%1»yV´vö'qý|å ‡{wÀPC;×nñb)p'°Û'ËÚëSã…Ï¦GËàÁ% a W’'Ì¬†g…ÉXl5ˆØå3[û„'ÛÏSïu<crÇÓ/l¦—iÿÒN[öxè`›~­\"õŸÀe“¢Û ëgì?ÁR?%þ c\"üƒK\rƒ\$cÂ”ãC”0†ú„ÃÂ˜!€ aæºoEpb\n+C@.X ÒÅÌâÄPEŒ>Ä,‘íz%`.ívœçz~Íã¶GÍr×ffjLih–ÃÀP(Â€RÖp' ÊGþý¬¬ýð’]ÇˆÉã sÌNžIóÌ›\n'¼Ìoöÿ°°¬¦2-šþˆ¾yO	Œ®óÇª~â°)»°ÖþfÐ‹ã¯c0?-æk¯l2`Ñî¢çŽÐê®Ôè (dw°ú íîÎ<‘è±Ð÷ÑŽU#eh¾ÚnÀ¬¨©	­QŒŒq>Ø&El±LÚ‚‚WÃ®AC»Â\niàNl8CD/x‰d\n/C0IÆFQ|GLœ`Ö[BcRG\"FšÍjÙ\"Z¸lj±”[CÆ÷¦ÖÆGô±e„QDíJRàÒ5£u±W­¦wm•æf~£¾Í°jO`Ãq¤Ã®Üg¦'0\0cÑP ‘Túr)0ÐýæÀ2ø‹æ9!’ÌlÊËå`ëíó!-Q0Ôr‚Ÿ\"íñ#Òÿ ‹\$l•#ìŒ;òN#òHÿ2*dÀ–+@ÈOÃÁT¢N2§&Â‚\$2c:B¶úf-R4FÒðÇ ¢s)d\$¨¾næòonþrVÈ):-‘M„ÑLr’ÐQ\"‡ôz`Š\r’·+°Øb¬É,§¶\nÌ L£”VC–%ð*í&A‡ô<ì«\r#/Rå-pÝ0Ë0ÏOêq¤02°¼&M1Rö“ra-ÆL>0y)&Ÿ“- ôý3-3Sö3>kòÈc¾þ\r¾Wû!F*¯MÁ#òœ\$3ROr¤a³g%S;íµ5Åq4§¦Ú¹%­òúlvRÍþI30*\rúHî6ë9E*ßÄÆà3j?Cø3rkETY	ßãîrrm.#WghF;,Ò“`Ê»ïÂ/îS<ìÐk‘‘=ƒ2ËÞÌóÓ>b~¼:‚î\0@¬V%o˜ëägŽY>†’hOºúÎÓ…ALJG4ínSAt%îÖ÷&*\r€V¶°F¸YFÖ\r†Úšåþ€ÒÈ\\EânËâœV Hd\n ¨ÀZêŽtPYñ«ôCcÿ>Ñ\0†gÙHHT}H¥ƒH-P#Â@\$BH\$¸'ææ;frYOâJÃÀ\"ôRß@¤TÁC€ôï 0äHRãþ¡zùãª<cƒíÒ;«0D.áRøÆÈÂ({%\n\rëÒ_êÊQC¾	”ýGcÞ;z@´;FSA†ùc§©jß&>kC¸ËñæýŒv0Ä\"ÛêÕâ~¯~<‡<3iã3©óT\"ûTd¬'Â,ûU@Ò5G5u@Nâ\n5Iæ èˆÃ¦º†Í\\·•D+€<r+&û&bÝµ2ÒEšv€š±nV	®4Ö°rØ¤ù‡‡Mu;F›&Å†­â	àáW¦\" #þÈ\"?<Î”R‡<\0”5fHß€ÙS…›SÆ’ÎjÝTãÇUÂ¹0ÂY¢Ö5ó;í˜\"¬Šp€ÞR@î6B²Gó¬\"Ö‚²\r³Á¥ÝHfKa\"ãÂÖløWàt\r Ú";
            break;
        case "id":
            $g = "A7\"É„Öi7ÁBQpÌÌ 9‚Š†˜¬A8N‚i”Üg:ÇÌæ@€Äe9Ì'1p(„e9˜NRiD¨ç0Çâæ“Iê*70#d@%9¥²ùL¬@tŠA¨P)l´`1ÆƒQ°Üp9Íç3||+6bUµt0ÉÍ’Òœ†¡f)šNf“…×©ÀÌS+Ô´²o:ˆ\r±”@n7ˆ#IØÒl2™æü‰Ôá:cŽ†‹Õ>ã˜ºM±“p*ó«œÅö4Sq¨ëŽ›7hAŸ]ªÖl¨7»Ý÷c'Êöû£»½'¬D…\$•óHò4äU7òz äo9KH‘«Œ¯d7æò³žxáèÆNg3¿ È–ºC“¦\$sºáŒ**J˜ŽŒHÊ5ŽmÜ½¨éb\\š©Ïª’­Ë èÊ,ÂR<ÒŽðÏ¹¨\0Î•\"IÌO¸A\0îƒA©rÂBS»Â8Ê7£°úÔ\"/M;¤@@HÐ¬’™É(ñ	/k,,õŒË€äßÂ#(Ú×%l¶(DÑCœ€­N»ˆÙ.\0Pš•Ž£\\Ý8\"Ñ(ä6§(ð Œƒj”\"ïŠnù¢³ð¡c`½§H@öŽlpî4´lB6¿Oãüâ4C(Ì„C@è:˜t…ã½\\(sðÜ”Ï@Î£Á}2þŽC ^)ðÚô1È@ÌôO\n‚Êã|–Š¸Ò’ÑàP™i£H„?8Á²ØªÁ¤«ƒVË»ÖúŒ¸.@PŠ7HI2d:Bºd77¨ˆJ2\$Ô£š%ãdÄhøÜË@P’ðÔ8\"V4„xé #KÐ\"TCê6#c´:Œ U¢´\0PŒŒëÜö3Ô)L!Ç&<@Ì’BïŽMºüÜŽ¹«Zë®ˆ œQrŸ¢(šãÈB†](Ø3úT8cÉB¸\$¢˜¢&Câæ¯mƒ[s\$¬×jìˆ€×/9¢ëlŽ{\\ð×nL›Ú¢ƒ(Ë3ŽÕ½T ûË{u³¦šîï69¢ …ºm€Páid8Ä¶Ã±)“7ŒÃ2ÓY¥¢^·Ëb ÞÈæÈ@¾´M3bú€Þ3¡9õC\nF„åîŽ!\r¸ÊaJ[Ómj†)ŠB2ž¶\"	 \\	cK(6õm ÎXó¾/ë)iC½éûXÙÒxì[Â›û½]íÏ•’QNr²)@SÌUCQÔµ=RªÕj¯V)üô«epyð@Ë* }˜‰Y‹8ºbÃzS‘‘ÄèÔÐi%©½.“5v’Xxrj„ÿ©Õ>þÕ\"¦U\n©V*àî¬ìV¡É[«”¤•IeWë\$š³0Á ˜>IÉ4õðÃàókw§ä”3<Rqd†ÅH¡CÍIº4\r!™ô˜àÂàb22í<“™\"P÷Hêø)e@:Õ~ÝƒO_ÎÐ ©3FSÃAŽ&\$t8YÃJ	BÁDž`s‚K¨M†\0	Á:eÁ’- PRL*Ht2Ê¬ãA½3†I½™s2WÃ„„ÜÒ¨D¿ƒ¼°%¡² `	ˆhŒª…ÞÆ FTS½(&b†ã¨~IZšW¨ÈÒ2JŸƒ:¦&’\0Ç6,¤K uCm@2Á•¨Cj\nÔ§'„ j§D™{l¸ž“òrôÐ\n@Á¤5”*KBI& ¯…¤H€4ª„8±Ä\"÷;Ø~0nÆ¿”\n&ädÍ£Ø€O\naQ¡‡\"ŠùÉ¡1=/Qœ¢æ£Êp1)Ø“Ò¢v¨CYP!åˆ7`ÒH)‚Mâ‚g—ñC(Kåíµ ˜÷%p 2Ä#I0NWÁÀPêRˆ\$ ˜U \n	d„1°ÆY‹EdÁ<'\0ª A\nVÀ@(LµÌàÂži_õúÀ”IChººª’Ô+úà«æ…Êúgág,ÌéC¬âé„¿*S¥Ú\n>r—'f.Ï-(»›9ì%Í¼¶cJµRÂZ•…Œ˜\0 ¬a‹N5ÅÁ‘¬J*ªIÁ‘‰#¤´˜)	Ìú‘e\"`ÝØ:B©€‘”ÓZ¿+U¸.\$¼‡¦;)[ÂLb4K¢tÎ«°Šë=\$æhL¢	'²Â©ÊÑjã6ˆµt°{˜„ý’iM×Nƒs©Rå\\É ÝYJïj©ø1¯ l’%Ã‹Á½”¦\"ªy5§Iò2%F€PR6ä!uÓZzÓk†Š„ˆî'°¨C	\0‚†µc6æŒxo>Š9þ‚>'#e¿Ø8eZøàƒ,®ã(À²»µ,6)Ç~`òý%D¨ñšÌ\"ÿ(ÈnD\raÕ®ÄâNÚ	´(µßœ¦¬M•©iì»<“œöŽq9á;Ë]?³ÎÈ‰àEí•3äLÉ	êÐØ¬™ù=Ø™„«áÉ1!ršMÔŽ¤Pä1]´užŽ>•:2\"­>2•ï9†›OâFQC¦1\r(Ì‚ì˜^ÃA~.«²U)ÚÛ×Rì2šAZ»á\"ö–b|YÓEß¶ŠBIò³ˆ_4=.[Sn2ëXu^=ãÝ›•—UÁ¼w^äµL¹¯¢[a}ãDuFWÕÉ˜ƒ\n3;Áó‡*B™þM/L¼Y½ƒÄJƒ&àH™q’Ô¸; -yï°Ó½¯²\"^„ß`ËÁWA¬h\$|Ùvæš­½§Û{ÑlZÒ]i‹‡%Ðtüœ•_ÉÉ´¶Ç ï®‡¿bÇ?é†ònQ›‚›uè[[Ÿu–ÙÖ÷å´.k§¾®´s´ÀxÈ»´9ÔËb'2ù™|fƒK~3]Ý¹º±ázÌûû=ÞŠ²wùUÙw®÷ðûø~«Óûb_µxúâ\0@F(1|ê‘Ä¼´ˆ8 \rLÆO'¢žŸ/{ÇÍ¥ÞMÈê~->‡¡cL©¶ŸÞr0•O†+9¾ÝM9èù¬I0¡F°I¹3ià{>ùÚÇ@îß…¾jä(> 4õ—m5çÓ5¡xß\"ÿ/Üú?x½ñÉ(eÆÖÍlÿ\$ôX½˜½dÃý0Ê*¦j¬š;\rAàiÏø-NØw¸üâ[o¶ñîÌñP ýÏ\"m'`#æLm#&·‰8p¯Á&JM/Á¥#æ\0åhÜ#ä¼0bÒábPÿïÌÚãÕ+kNÂßÆ'Ï ñFÒ¹…BØÏÁÿ#K°iÂnûÞm/Fåoè#pžbDÈÄpfçÐª\r,;«í0·	.Ä/>Ã°¢ÌF^\$h^Ø5¤ÈÇ†c	°L£¹ŒÝ\r¤OpÁLX ÈLbÆfvjÄZ9,»Ã7­hÔ¢hâüwæ.	5§~Ší¦ïšÍ¢Zd>\r€V¢ð´\"ÂÊ©f4|ãDuœŒgTR‚ZÊ¢Ùê§x\n ¨ÀZ–ÂñR#ìøî£		pp'‡\0=, wD`ö+^qÝ Ì,biÆCêÙ‚Ì;dŸÃ&ÄÂŠP±¨\$jŽÎÂ,7\"@²Eè(¦!\rÀ	€Þ©E†˜…«B†:¤(¦`Kð ÃHKoü|ìÚõÌZøhÙ\"Ä,†¤Ô\0ð'&hí“ Íäû‚bsíðøàðrû€Þ O\0ØÝ-äóÂûIJÔJ`Ê‡±@š‚ÐØ±btÇšgãjhNZÁX^lÎ~Ëë|Œàê#\$/Â\0¿C‰\0Iø&00iø-Eù „V;Å£!IüŠKlo\n?ÐØiBHÙKô5 ÞL@î2ƒCp‚Ñ\0ÈFggìâFjr1+ðBDj2\0";
            break;
        case "it":
            $g = "S4˜Î§#xü%ÌÂ˜(†a9@L&Ó)¸èo¦Á˜Òl2ˆ\rÆóp‚\"u9˜Í1qp(˜aŒšb†ã™¦I!6˜NsYÌf7ÈXj\0”æB–’c‘éŠH 2ÍNgC,¶Z0Œ†cA¨Øn8‚ŽÇS|\\oˆ™Í&ã€NŒ&(Ü‚ZM7™\r1ã„Išb2“M¾¢s:Û\$Æ“9†ZY7Dƒ	ÚC#\"'j	ž¢ ‹ˆ§!†© 4NzØS¶¯ÛfÊ  1É–³®Ïc0ÚÎx-T«E%¶ šü­¬Î\n\"›&V»ñ3½Nwâ©¸×#;ÉpPC”´‰¦¹Î¤&C~~Ft†hÎÂts;Ú’ÞÔÃ˜#Cbš¨ª‰¢l7\r*(æ¤©j\n ©4ëQ†P%¢›”ç\r(*\r#„#ÐCvŒ­£`N:Àª¢Þ:¢ˆˆó®MºÐ¿N¤\\)±PŽ2è¤.¿SZ¨ÁÐ¨-ƒ›\"Èò(Ê<@©ªI¥ÍTT€*c*r×°L°äìÅ0Ð û¿#É½Ô1B*Ý¯£Ô\r	ƒzÔ’Žr7MðÐ‚2\r«[Œ½­[ÞøŽ˜äø#ÆÃ¹Á4½A\0î•ÌÌÐX‰€Ð9£0z\r è8aÐ^Žõˆ\\0ÐÊ´áz*¾ÉÜÊ2áŒ\r«C‚7ËBrÝ¤à^0‡Éh¬Õ7®ô=RmØi±hÓk¦\n˜åˆü¼/Kâ`Î*w:ò½¢Mbé/ÂrÈ;#Üµ7àP®ˆApÎ†„£ @1* ‚àøJ¢‡\rãbH¶Cpíú!Ç©šÍ6´+XÇRcWè‰RŒ#¨Øø6C`ë\r\nwÔä’/Â3—Á`Î3ÔŒni\rlú³¬cpã•B|ÌêKÒRŠ£H´èéÅBc3Ã7A_¢vfPä¦¥#ÝˆOo`@)Š\"`0³L+¶ÚÝ×MâÒ®SS†]‚ú†pÌ¶!Ô—û-6|{º=;¸ Í³¬(’6ÑK“ 9ò+÷\0002¦ªê¿q´4\"M¿8ih¿dòû É\"	Þ3Î”ø–ˆ¬\$67£Øòã±s3dÁ%;Žtû•ÝŒ,jÖyxe7MÁ@æ¥¢ Þ5¢¡\0†)ŠB2œ’å#KØÂÖÎ&b`ˆï£LÇ;,\$cRŒÑÍÊô7\n{G§cªeñ«Y!ÈÑVûÏ0J|Ü b5	“TŠ™T*¥X«•‚²V)[‡%r®ÏalY¹`ƒèBiŽrÎZUHvø­@aSì•‘ äMI‰\"^ïù¼¢©éø?E@<!åH~Õ¢‚jTªµZ«ÕˆwVjÕ>AØ?	zQ@ëa¸ðàHÔ*È(#å2Á	9{0ú§¦Ä›ÉhL\$' t>WÁ˜0æ—2>JÍ1UCheI8F¥ˆù.†dÁ@2(Áƒf‡çÅß·€GËRáÐ4ˆæDÉ­4Ý–Ô¨íbÑ\$A\$<*C†EŒ(N0çüŸ \"BªRA\0€(€ ¢©§“)*ƒA%¬`7'É¤Mm3„€Ï0g\"jÍQNQˆ7‡yG2â9NKyï‚ÂFŸü|y†­pŸeó	,œXáÁ)Å}Ã¹©o±”Æ*–Hg‘¸d§\rêE‚Kë\r/((0ÌeV2’E‰½Ö ¢’BÃÉ‘&,CÊøÐjMZ¤hhŽ@Û\"¢ƒžD”1±#†j&Éö3Ô7ÐtHˆßD¼	áL*>@¤øˆ¤y”Ý‘†JÆ¨«ê&*‘U“l^ŸÊÈ1‹™Ñ`êè%4lIZ)&c;i(6œ„`©/Û&NF6RTzCé‚™f¤æ ø~Ÿ\0Q¹^l'„à@B€D!P\"´Zü(L¶·£ÙBÄXšõ±Êp9J”¿Z“j«a¢‡haB7\r-Mœ“–Ïší>&¾Ô£Ô@U?\r«ÜÂ£eÊ|ç‡–ÙÏ¤óáD,tÈlÛrài½Æ:\$TÜ™’ÿ	ªÛ\"¦?#^\\‹0V0Ré\"*ØÉNeÂ…Òö_”dØ›¥}4&äŠ¤Í‹QhbŒb½§46\\Ë«,[ìñÏD®¾¤4£:ý¤7G9mÑw\$Eo©G9Ÿpw[rŒÂ…Kð½øn/D©¼.õÕ<0Ù…\njá>´Y’ýªrýo+ªøZ6‚`e1„•ì”6ZLò_´6¿šp`’©Þ‘É=âZ~b9¦_¡ed«b¦”Ð2ÒÁ4-§.“\nl\nP „0)3ôVŽŸ#é7Î€r<†]ÍæV±³à€ƒ°bÒX^vŸ¨iÚ†RUP\rJÌ.ì'„µ>Ã3¼ð‡æôàŸsús–º7èMQsÓTXú,È[,‰Ù‰!µ²‘ƒJƒÃ(g¡¥RÖ õFªFJ]ýžsq‚weGTê³Ou©‡‡™÷Y%U| w!¤=öJ,F\nc<ºt%~V3Ö¦IÒ»ì¶×\0ä——ðeGoÐäy¶&«Ú×^šŸ¡š–6\\K†È\0Ît·yäÄD]ö/Ð ÉŽ)…ÅkÅrª¥ûrÙ\r¾:p‹aÆ\rªòoˆráŽÓ‡lôŠpŽ!,¾ëÎ¥¾£xÞmX­Êõ?-Ç	„¢äÀŠ/'6–.üCAX¶–„f¥¥-d®ÚÐdA“‹[÷!€®‚nìýå§Û¡5¾hÄ‘q€Ä1—#võX¶  7ñ‰LÒ`\nUš«€ô§>¥)¸jÞ)R\"Hû^ÜnªW•vÎÐN:­ê‡˜¿	ÄÝ}7wÇ	Õ9&J®wQ-…, Ÿ\rÅtYpËL³¢£æ.Z;Ç\"…ä|aèÐúfB½8vÊ¡-ÉŠ“‚kÂ»[ðõxÈ3ã@ÊîùzäÏÖúþêü#“ùë¾@9âFœmÈÑS:š<EòNçV#	eþš³(c¹–Aûê\"×†ã›&©UêÈÃŸ’nËeUü(~eKtãêíqc{ßoÈW¢FÄõ5|â&™\"üÇl\\-O„²%¶JÂ`÷%ÔópµNÔ:[„b÷éÀs ]¬¤Ú°ð\0ŠÊhÒï/-žðg0ãNohð_‹ÐRÙì2èl–Ê žö«@#ˆ~Kœ×¾u¬žóÏ!n@ó¯Ðï„óð(Ã¯#¦f¾ÐN&4\rå…Íb`xâ¾Ì®¹Ð¤”pªGÊâC@\$òKŠFþ.üãðe°Î[HäØepÐñuž®ÚrË8pòb£æ'ÄB%mLD¤NL/axCþDv4#J@Q\nO°ßÐ@úÑçDEq ½UcwñÑ	„4\nŒ~€€ãQL1Œs1Ohyä.fìÑNh«*\".Åú\n±\r(y%N­qî¨x	tC\$Ïêð¡¬ˆÅbù¦~a¢ÖÏ0ÞÑÑ°¹å!b©©–ë¢üa‡–\"âä-Ã\0‡êLCÂþ#ƒdÍ¶ª\$ Xï*_FBÑÂ”1l‘¨éá.*þ`Œ\$c”\r€V¥¢\rmÜÔFR¢\$ò€‘Œ/ äbOTAËf*iÿ `ª\n€Œ pIr/FÕÍ2&\nÖ>×Òô§!%ÏRK‹†…Ís,.©IX1bP%G\$ÅllGÔé2.;ƒ¶y‰0-r!(ì‡Èl\$*F*b1\"mZ%ÀÞ«¥Š¨G+h9ÎŒy&‘‚d/ÑÚ0B1l’,Ï‚sIl!œ!‹°ŽbÆ,­<%Ê'hç.%Ú4é/©-²õ.10òCÒï0N9/s.q„Iäâ@5c(ûBè{*j7eÁÃöÿñ:gÂ`O’ß-ÂÜ/d%Æ¦³e²³VìpÜûî¶Ê¤:BèFìöºBE†Š©³6³€‚-…¬³‰˜²ì0§î˜6rêrKP\rëTykMnænó›11€0@î\"+ÿ  º„Å€‚jòg%ÚÛ1@	\0t	 š@¦\n`";
            break;
        case "ja":
            $g = "åW'Ý\nc—ƒ/ É˜2-Þ¼O‚„¢á™˜@çS¤N4UÆ‚PÇÔ‘Å\\}%QGqÈB\r[^G0e<	ƒ&ãé0S™8€r©&±Øü…#AÉPKY}t œÈQº\$‚›Iƒ+ÜªÔÃ•8¨ƒB0¤é<†Ìh5\rÇSRº9P¨:¢aKI ÐT\n\n>ŠœYgn4\nê·T:Shiê1zR‚ xL&ˆ±Îg`¢É¼ê 4NÆQ¸Þ 8'cI°Êg2œÄMyÔàd05‡CA§tt0˜¶ÂàS‘~­¦9¼þ†¦s­“=”×O¡\\‡£Ýõë• ït\\‹…måŠt¦T™¥BÐªOsW«÷:QP\n£pÖ×ãp@2ŽCÞ99‚#‚äŒ#›X2\ríËZ7Ž\0æß\\28B#˜ïŒŽbB ÄÒ>Âh1\\se	Ê^§1ReêLr?h1Fë ÄzP ÈñB*š¨*Ê;@‘‡1.”%[¢¯,;L§¤±­’ç)Kª…2þAÉ‚\0MåñRr“ÄZzJ–zK”§12Ç#„‚®ÄeR¨›iYD#…|Î­N(Ù\\#åR8ÐèáU8NB#Œä¶ÒHAÀãu8Ö*4øåO£Ã„7cHßVDÔ\n>\\£„B¨CÌåú8†i‰\\œåA\\t”/Ê>¦W³ìË3–Ç) Fª„gD¯ä[×5ÜÎ\\ª‰yX*åšzXáÎMEª9o\\qq# Ú4Ð@A\nBÍt3\rŽèåŒ#ÆÜÕ£pÎ7¼1B-`î4¸6\0ØD1ä2\0y„Ê3¡Ð:ƒ€æáxï•…Ã\råzAt3…ã(ÜÄœEá¢\r°[YzÐXÚàÕÃpxŒ!õc\\Y\$~ž”äYÒ@=á&Ž³9\$ ‘'16Z/¶«¬%vÁ±l‡I@BœäÙ]G„áÌD\0P®0ŽCuè3ÉA(ÈOª½m1L”ÅYÒhçCZ¹Fs’´¤QMg)\0ù\$	psOÉÒKG4éÈ²vuls„áÎZNiv]œÄ!GGVO ø‘»s)1Ýy	.ËålÃ1ÅÇI*[È«ÉJî PŒ:ƒcwQÃCÂ7B˜¢&#üy=Ç&\\‰-=»œïºHæ¡_WDy_V„¾Rl;ú¥ýÑ<ÚßÒÓOô˜ˆ1<xÏ)çjY¬ÑP*O‹y\\\$pN­UlGË\0‚QJþ\nAfÊî›9JMÕ»Á!ûÈûñ~jÌB§\0 !tNyÐØ‘¤4Ì!)ðÌƒc0V+°”ôÌä o5í7@U`u`L3=@@xg^ÍŒÃˆœC8a^€‚1¸ @¼Ãpu8@ 9‚“˜zÄhæ¨ü@Š †ÂFVª-òÑÊ!è€'8¥¡™ŸJCH¨n‘õÚJDGVÁPÔ #tÑU8u`¬xÆ„ÆC¯U¡‘{1³PÇ™\"dŒ™”2¦XË¤òflÕ›¡EDK=ÒÙ¤0f–ÓQ0‚d¨¼ÁPÜci'Â~¦%p ˆ)]r:	vâ-´‡H2(@¤g†P‰ÂTìå±t€icÈ•1ÉPÈY%dì¥•‡vZË×¬²LÑ›3UTÍ•j¯g¬ü\$†Ðàmƒk6’ü)êÄ\\¼Œá„5´4>‚\"e\n˜3\rBÌR92	1>'™Z.©\r\"H“vFICXÀeÂ¯=ê‚\0Äk‚“%Á†Í8ÔR`lê*½h±38†ì4ÀæhH s®…Â™ÌFÉ#dpŽ’3Æ€²bx@PEÕm£Tn:ÉD‡“:Ã0¦\"•D¦Žˆ2Ä“\$ˆ]5”Ñ„5^½C¸`Æì×›fmM¸epkø:£Œ…ØÕ\ráÞÉFñqc™RDºj.åÅK¡í—a!Í08ÈŽ#C\rÁÂ51FtÅœw8¡Œ4FpÒÙ68u6©4NbkM©¼GŠúáXQ>(Ž\$Ä~î‰*ÖtË´IlhA¡Â|Æ%JI‡(¢!	t–*Q7&õåA\$‹˜vKƒ_Hi›QŠn˜ðq¦å†dAf\nžØ `Ç•L²è€ÜÀ Â˜T}Ëe(j I¸!‚G%»Ë†ÚŠº)e4A«Ð,)JF¥\$0A>§‡@¨©®ô]LA6é>@¥szw´ôXeÌ\"›[ð@÷‚` Ö@F‚ Pa¹Á†š‡£&À÷ð9´^E –\"ÀBê!E;ªwÃ”];pž\0U\n …@Š³¸ &\\ü^SÎZ”Gˆ+·¢œ‹Ëy¸çŠã»1è=b(æ‹„ä|E!AÚvÐGKG\n’Új+s?\rTý/AïÔd²\"#«aN¯€BIÎ¹÷C6o}*‘ilbu´\$oP–­é†¯ÏYöÂŸ46N9ÄP¶Â9\nÔT„ÇqÄ<Mmé+@P­•v·£”“#Vþä*%RÑ‘á+& ‚˜Ædsçä(6tväp¿BH£ŠbNÅ¥ÔW&^5ì5ÂáÃë#ä]D\"2T•Ilˆc€TàœUZ ‡«%•CHeåQ­ˆ6º¯`ü„%ÕØ#1+ÍÀ¼HÍ©ü6Çp¶ÔsñWÂÊ¼¸~zþµkÍ­{L@¨ö¬„øæ?Žõ\"bÚzkYkIÿÅãÔB²]ä|W—žy„Ùy¼ç•‡t \\rŽ)\nó°lWà²ÚŠiÙ\"õ»l¼úC	\0ƒ ŽRn›á¬¿kòÊYÕËbêíÌAyRL“ƒàƒÌ‚7ãàÂ–kÄ\0Mi6o!ŒÆo¿™±!µ©\">“Öb\">‹Dâ|‹XÁÖ#bk7ìž‡É^‚íK±>Ïã@2ó(;¤«ªQJ¼\"ˆµ÷f­U¯õÒiH\$­§í¨oºî«°Œüf’BÂª~Y\"ÜR?š#ÐeKøþŒüMÞÿÏ²øÏJÿˆòïæmA@‡T+!Ê&ì§c\0âþüâÎ‚ð¡bO!ZlÌÁ¡b6öÁ¤£°2\$2†ÜnäÖ#à>ON¼g\"mæâò\$mÌÅÀöP\"@ç0v¤#,3nÖÎb0~ÁÊâÂGPpà†Í	çîõÐ–öPšhBGnø„°¶ùpº„- ø‡QîâLç2shZA@àI ~Z%ª/ÁGíô£îâ#Ž¸€°ñIŒ™ìwQ£ÍÄ]í sCæuîrI²mÆ\"1æÄ\\qG®G”y‰º®¢òYâ0ì×'ä[phÖp©	pÕ1JÕq.Yð¢&ð ¼/”ÖèN[1ZÖöï¤ý0¹hUÑgQˆ`Z§Ç\n¥gö#î?kº<3Ñ’ë±‹QŽöa\"ÊáâÂ*‹²€®àìp¡¢™1n¼¯VôÑ²lqœé,ÙG±¶ÍÕhônŽõï“qäéf¢„pÂo¬GrÖƒ.„#îˆ¯«ÂmG\"´„SÜŽ¢ZI  Ð‚ãªÈ4BÎÄñXènŠqq*çOz0¯~Q„0d®+é²RA#Ã	\$/~¼JÌ¾MEŽ¦n\næN€É%Gìë.Xk‘ùÑÿ\n¡å®^WÆ¿Ò£R§)ÒÙQ+1ƒ+n\\kÒ¼=Ðk\nrÁ’‘Ò½1ú?Q||Á¦ª.¡jAÈC(Á^ÁÊcò ¢oÊÃgÖ:1ÄZ±Ë\r2	.#íçÉæÉ21É2s„§Ìt¤éòÞ%‰§mÀ#ˆèç]3k¶n’\n„Ï»4E|Ü3K,¦îÙá‘.Q±WÁc2gë*òÏ é7Sx\$Î³8Ï7qÍ7²×ór#ó‘\r!s)837’Ê#ˆŽWÄÒW«”MÒ5“9;\"?;q¼ÒË—;ñ¦*W-1q<„ÐMSÑ;Äã:S°Y“äM“ès®R® êÑOÓÄì.«)ñµ=Â©@‚?@—ƒÏÓý@°>Ô#Ap*ÓdOgF'‚®î…jïµ@#ç>îòõ®}D”C³4	\"© É1s\$]è‚3ô0a0=aFh#áÐF¼\$ÈŒÓ@´ŠðÙ¾nxÏ.òò/Ó˜ƒI¦wEÄuLr¡EägIax4/O„~Ð}œhp\r€VÁàÒ`ÖSäa ìªì±ˆÎ\rëðÈœb˜Ì¨\r©4C*nµìò\n€Œ pT)B¿9‘Ú §ì‚a‚§uHC+R‹	Â°~Î\"×áÃìB°‚Î:d^Žs69Ãð\\2mé2h6UP2#&!on.¡lEL)aT%ð.|êæ¦>õuz Á~=cÚ#„TÜz'ôš1ÂõAjÌÁ9°°‡ {C…B/Ð°#v§Ÿ[¯S\"N÷\"8+A¬àÕÍ\n3ÃA\0¨Tct5#V¸FlSàà—æäÄKZÆÐò2¨ógLG[ÕdÆ¥ò0ÒÜ%ÅQ6çmb\"ìÅÌ@3B»`\nÆ ê\rµ–:MáÔdÄÕ¦„ÎàB†%h5TS\n\"ê.òWa\$äLFºü‘rØÑvZg=\\Äæö€yç]/0\rìÌãd8S§8óyá7pÕ,k°2¤¾ÒÄôDÅOk¡\0";
            break;
        case "ka":
            $g = "áA§ 	n\0“€%`	ˆj‚„¢á™˜@s@ô1Žˆ#Š		€(¡0¸‚\0—ÉT0¤¶Vƒš åÈ4´Ð]AÆäÒÈýC%ƒPÐjXÎPƒ¤Éä\n9´†=A§`³h€Js!Oã”éÌÂ­AŽG¤	‰,žI#¦Í 	itA¨gâ\0PÀb2£a¸às@U\\)ó›]'V@ôh]ñ'¬IÕ¹.%®ªÚ³˜©:BÄƒÍÎ èUM@TØëzøÆ•¥duS­*w¥ÓÉÓyØƒyOµÓd©(æâOÆNoê<©h×t¦2>\\r˜ƒÖ¥ôú™Ï;‹7HP<6Ñ%„I¸žm£s£wi\\Î:®äì¿\r£Pÿ½®3ZH>Úòó¾Š{ªA¶É:œ¨½P\"9 jtÍ>°Ë±M²s¨»<Ü.ÎšJõlóâ»*-;.«£JØÒAJKŒ· èáZÿ§mÎO1K²ÖÓ¿Žê¢2mÛp²¤©ÊvK…²^ÞÉ(Ó³.ÎÓä¯´êO!Fä®L¦ä¢Úª¬R¦´íkÿºj“AŠŠ«/9+Êe¿ó|Ï#Êw/\nâ“°Kå+·Ê!LÊÉn=,ÔJ\0ïÍ­u4A¿‰ÌðÝ¥N:<ô ÉL a.¯sZ’Â*ªÍ(+õ‘9X?I<Å[R²óLÇ(•D%/ü(¸·iÜäÐÎÔ¬tÙÇÚñ9£ª‰H«0í?§‘Ý©ÍjAc)Î¥’ÝÏWÊøÚ±Ùq:öÝ«#.©+tÖÅö¢Kp36bÌ“×qÅAÞlÓ\0ºëX@ ŒƒhÒ7£”«wŠCÿRÌ¨óp¡.ÉÝÛB2•ZnêJ(ö¢JàÂ\rÊ3¡Ð:ƒ€æáxïŸ…Ã#‰â¡pÞ9áxÊ7ã€Â9Žc¾Ž2á¾@*N¦‡xÂ8*­åÝZvë»õ+¯ ¹M®€Î—6ªÎñíAAÑ[þÖC¶3<ãm”öÛq§;ã]c9èæ·6èãu)R›º•CR4…a\"C%þ´ÝtýŸOXŠSQ@64ÑnªÅKjÑ\nNÖÔµOµ*©9'^ÆŽ=áÐõwžÅv”ö5¸)íK['Ã´±?ñ\$µ3wÎþIkr);ùCÕ(ç§c?Þ§‰cy¾J¤£Ò•dø¿’%EqHåCÒ¨;ïñ)WïéL(\nÅ'²ZZr§ëƒ]/dþ“E¢êùI''ÅÌ,ÆÎ·›€>Çäæ¾ÒžVHS\n!1‹—‚v÷X#q@J¨ããœ…Rr€l†XŽA‡‹2çt'|œ¾H^ÞÉ¼2…EHÞ”èhµ!aJ…ÉùfC÷R€Ž¹B~kº¬w.ü\n!I[l…Î”þ³\"™Uc†!8úƒÑd	wË€.(Ê€¡òÊ\\KÅæ¡Ø“®%®áÉåÌ±Iz²v\nUÀ°Z±RA²A°èAÂ¼s\\Ù»5¤ìW¤ônßzã‡…)W›5Fq—kØ~‹aw ¥ìUWÁÉþ?¿Sþ«Á+šeGYH#cNuâlb7h¼0¦‚3v\$Ó¡ùDIYt‚‚\rÓ‘èBYIÇ,ÎŒ†ÇCùž9%*&¡‰fQ\$¬NYŠ–”F@M:í>\$å87ÒƒŠ˜aí\rŠ1i±)¬‘/‘\0®¦LƒN£€ŽÚ@¹O\"ZÒ(ì¹˜3&hÍ™Ã:gŒù 4&%;Z3HiM02ðÜC i¢ÍU¬8I-*Ê|5Ï)®µóN§`y£å,ÙÏç¼Ê²ŒVQ4¦Ö@çÓ’Lf)( Å°âJS‹)QíÔG×µ \nÝ#ÎrK'Ôµ\$¨» ‰÷+'ÅU”t˜³6jÍÙË;g¬ü;´ØÑZ;Iim(<F–èÓLjÁÎŽªªhd›Áe¤ ùá–U+:U…97êB«R¨ŽuÏŒ6ŸÑ·bìx‚[«ë›…àIHòM.È>”TŠW,©rÂ‘ää§R\"A1ß¥…#Ó¦ªV´â;¬@)öl·3Ž»fã‚r¢EH/QÊ}0£ÑÔ	)¦¯¬“¨´LåœqU2R™½¶Vo£õ›Ë:ªWó)`ºUd[â9v#Ïu/à@\n\nø)4ëmÀšØŸSÝº#õ>>.ºš¬éüZH*ow¤äÒŽG	R|™bm°“8Ý›{è·%˜½i£k¿0ë²•—vµÒÓ”YxÐíË\\„–Y‹…{¬óE(½@r<þÜ}“Xª9aÇèÖË;Ÿ‰s\rvÀž»J™¡\$¶\rÔZ„Q‡c¤~'v¢T3OiA…Úh°rÌwÜûžâŽïÌâ‰3íäcìB‡±V/1Žm9›ç››¹³”|!r5nb~xS\n–aßLop9%Î7lÐSÍ5£#…%éÉ©²V’ºÉ&*Ô|ñž³ãÄÏÌ‹@L= ¿ˆPÈ)³B-Á§:`9Ç…V,²\nvlž-)U^‚ Pbêgh«ˆÄ”tLòŸ[i˜¥}D”ŽC8¾'.:{Ž†<€?·[/+ùD“F\\ *¤ˆgªÌ}tƒÅòÆP1Ó‘ÔZ-¿Ù´ä ü³ôµ»@Ù‰7žn4Zú(.Ù±Hã½{å,b»­8@VØÔÈE«DºÀò\$Ì`'Jîl-¶#Æ¦I¬>/¿£\$-˜q„ÙÂ}C(\rYÿS§N,X¹ Èå¨N¦Íô_µ¸é-NèJÛ½ðt¯€H×U\\ì-T¹¹éaK“{2²•?–øUsò¿·xU@Çh	Ó—mVq÷³4;û¿žl±°Ë¨,ÑÝFÃwŽÿo¸\"î%¢.+ãÖÇ~*h-›S,Ìwëg1èWÊ|4^r,{z©µ™µÊ~±7xúáCrÜ«Æt)*ß¼A)\n/—„tói‘Í­=w×|Ù=  *W\$vÛ‘õÙÜ)¿n=a³±Î;Òñ@]DÁ9† ›ßv-ó#åÏ?äðŸqÎ»wÞAý—lL³*W¹ò?2a§·ä¾ûìÏ‘ŸùdÁ\0PA\nP „0ÅâlËR¹UDar•an™Uº¾Õo8pðm\"¥oäuªÆ¥• @âùÆŽ¯Àr¯æª­|´®š^<?â<pÎ:+ÉTB²¤\r˜ÂO@ÜHé¤¼“‰Þ'{Ë\náì‹ÃŒp&*¬p^üé ì¹©äü£vJ°>'œè«°¸Mf«+¸l–*§>'b°óìãîZºíšw+\\)EJ½Å	ŽˆU…Æî,Xí™	íð6â€»dÈW†Þ/:YÎw\n0ÒÕÈ¾Ž‹ÿŽ°)FÆö&òÐ\0÷H/(8ÉBëÍ|EÎlò	ìÃgí	‰+	\r¥ÄI­ÒÅ‘ôEŒV§¿ðâ-\\ã†ú4ñ4=¬bTÈèÛã]#c ö¥rq‚NÎ‘Tñ\$9zãN–ã£NìNüÕë‡#Ñ._°Öébr#ÌKm¨ðÉ8ój|Å%Ä)ÎòEªx*„)/®\\oèy-û	%„ü+â\"ª¯2.ÄÄ}‘Y§žò\rž#‹4yë…o1®NÎ­èõoÆì±Œ(4o­2òH¯‰ê4ïŽµ)\nª€çzÆÆ˜µbª¼€SÑ˜[È‚â¦Ñ@pädäQ,è‰¾ÙŽ\n\$Ò:ˆDÃïˆã\$²0°²P”ª©#ˆfïEõè,ïr_&¨	&L¨ÒßòI&r%Ð0ñb\\í£)\nŸ¯´í\"ìÐo/Ä`ìPu<¥ÌÚ.7q€‡Ž1=\nÐDè…ô¢”ôçï&¢”ãro)2Îè‘—-DUbŸ²e,Âi-O.ƒ{'.KGó)ì“¦±B°Èçè½£{¯êÖ\$I…*Aí™	¿\"žNIáçPå‚ò§3wÅ½ª¦?âA\n\"J²³\")ñÞˆ¶ðr]-{2¤Ø„EÒ°j)H˜d¦:Ï­ùM.÷.OLÔÌ\\w3ƒÂˆ½È#±è¸hb\\Q*öÍÙO´¶Í8È¨—Ò‰+’-ä41Hšæ¨S#2lø²‚ÜºëÓ»’í=rÆZ³Ë=çˆò¯Í>eŒú§|žÏ³’Ø§q¿/!?ÓòûX»Óã<3Ôït\"@,E0Ut\"d´(Ü3]ÎÙ?¥+BBCgî†ï'?‘ÐâZd›0´S0(zƒE\"7a5q6ðÄõ4bÇF´å	K+k@b‰#r‘H*£Hfí+-}+²rª.Ò¯I´‹AªYBóè(SUK'§?Cw:dJoH‘zŒÿCðçFCpzB‰LÅL”˜ðoDÔâŒt_1siGó]Eß«)+P‘q¡=Û1…\r~‘T„2ôŸ%4å>•ñ¤Q”ôS“Q¤GQð€ô.`@U+6oSKC³÷KFÊtUµ4Œx³Å/yU#K5&ïu\0007e/O•w!UCRTôÔ¢žöo=59XÓ15o/“Y“ðH5o'NööuŽÿ•UL10õ°}[TÑDõY(2Y–1uæÉ0§„ÙVTœ5ØüPù^5&g)L]É6Á´-W#NþFËâÆò-µQJ´ìv´÷íìE…FPˆ\\ETSŽ&0aN–]#N~TBÛO´)Æ”÷G°x\\R_Z5±G0rÉ+H¸Ø§êœøE*³*ò †Ž\0Øq\"rP¹5Çö}M°”T×@‹(wË/2GPAîºÐÖ\\,\n ¨— pÕM\\ØêŠ]k/^!qv‹°©6£Ùï¸Ïï¼ÆfÞ¼›hh²µ´qLEŒÍ°Á2µXÉ4›æÓdPðÑg‡0î|)éU5Ãfv×Tvlaè®ôi<êz~€aÁ„{´<o¡„uèT8ºõT¾pq5vüíeÅtmi	pŠ?Ìðe¾R©Èt+M/ãþ¸§#»1yëî¿SéwŽŽ‰¾Ÿ‹á0Çxl,é¿j![j–«Q‡:\rMV2Ý^w£®¶AåTØlÝ5bì[o¤ˆâ<Ç·lo»6µc;sÜrI|ò½âðÂÔF„NM],ˆ½Â€øí6üWC5Èš3ÌpyW÷i•VålxR¸w¦KÕ'Óš*²®(Âùòbtã®–#{è|N0ñNÀcÚO¨1Gš7MHç3,k|ÞÅUd—xø˜`æ/œÎK\n)É¬°¨Ï\0Ðóx“‡âR·jd2\ràìb î@Ò­Õ;PˆÛIrÛÕ¾ùøÅvJ¦%*FÎè `";
            break;
        case "ko":
            $g = "ìE©©dHÚ•L@Ž¥’ØŠZºÑh‡Rå?	EÃ30Ø´D¨Äc±:¼“!#Ét+­Bœu¤Ódª‚<ˆLJÐÐøŒN\$¤H¤’iBvrìZÌˆ2Xê\\,S™\n…%“É–‘å\nÑØžVAá*zc±*ŠžD‘ú°0Œ†cA¨Øn8È¡´R`ìM¤iëóµXZ:×	JÔêÓ>€Ð]¨åÃ±N‘¿ —µô,Š	v%çqU°Y7Dƒ	ØÊ 7Ä‘¤ìi6LæS˜€é²:œ†¦¼èh4ïN†æ‚ìP +ê[ÿG§bu,æÝ”#±êô“Ê^ÇhA?“IRéòÙ(êX E=i¤ÜgÌ«z	Ëú[*KŒÉXvEH*Ã[b;Á\0Ê9Cxä ˆŽ#˜0ŽmxÈ7·€Þ:›‚8BQ\0ác¼\$22KÙ„¨È12Jºa X/…*RP\n± ÑN„ÁH©ŽjºˆÐ¬I^\\#ÄñÇ­lˆu•Œ©<H40	ÙÀ…J¾ö:¤bv“ªþDsÿ!¾\"ÿ&²Ó‘ÖB DS*M‘‡jœƒM Tn±PPˆä¹ÌBPpÝDµê¥9Qc(ðâÃ˜Ò7Ó*	ÖU)q;+‘¥‚´v‘Â­!ò<ÑuØB&”å/ÇÓ¶­e4ì\\‡[âu–DDÐ\\T•4›TUHtèE’º^uì©;dH¤	ÔZÀev…â\\™Üv¥­d# ÚûAá7¶1D8Dƒ”@0ŒcyM>á\0ÃwBÃ0×ŽãKŽÔÞíœQC X—øÐ9£0z\r è8aÐ^Žù\\0ÝWd'	áxÊ7ñ8çÅaxDªÃl\$×¾Ã4\$6¸”ØÜã}OTµ=SA[‡aBXJå™i¼å™\0†©^1zŽ¦Yj¨9[O•/9NF&%\$n\nãä7>Ã<’Œ9`ÆYsÒþKÀ5zþ^’‡YRL»´Æu‘äÉØS¯ƒä\"b£ê6D°Â6£*þBiQ åAØœ/ìº!Ž‘DÊåQP˜”©*u”fîýãö³j²Äµ.o	2r¨ZÒòõ767Ô„B1Œ#sæ(‰9T–”Îï/:Ï“£Yµe¡­j‹ý vE!ÖS‘¹ñ _/Ïôw¤@z][O¤«ùÅ:„ŠÙŠŠWF%§¸ÙÌ1ˆ1BQ±6A'\0`ëh«-T¬EœW–€\n…YV¾GÌú»™s`)È#NjWóQ˜3ÅØ§–šÕ,ÇtMˆ0y²g¸<‚\0ê¦Cªù_a™Ç‚\0ØÃ9öl<:(zC8a>À‚)·\0@ºÃpu8  9‚“žaø»b@™„0¦‚1Îd@‹\0\\yÈ	\nj&&ŽÁFJZBH‰¸d%a¤6\n†±›Öt¥ªüàtÅ„ÃÃœSA‘v±VÅ³cLq2DÉ\$s'L¥•‚ô6£Ã£>f@úS³ÓîÐÏ†TB“—ÎÙŒç¡!žxb¹Òy!Oü „Ô0qT£.f5€àX¢,bJL1v2ÆØëd!Ý‘²PÜƒÁs(eL±K)…4§“4	!´8ÚÊÃ¤°Ê.w°vâoâ¸a\rlá øw<%”´F©\\&ƒ¦\$7\r½|J•8(lyˆ×‡!ç{q!šd\"‚¾™|Dy\$ Ö\nqÍõD!†w‚\0Ç4g€iraÌÉ#4jÑÉ 4IPÓ\0’4<`€@Râˆòx‚äLF2€ŠS,„x³ÓÄ¬Ôäßr¥~ÏƒhmÁº­Åz‡CzrPò÷¢A¼;Ö8¿SETbŒ’ú?.zƒÙÁ½_áÍ¯¨¨ƒN;8\rÁÂ-0¦^Ãˆw9Œ4EpÒØÈ ¢”¤×¼ÉNx LÎýaˆ£ÈþˆñIe,š,dMêh¥„x‘x@Ò™¤2\$»TyËê½@s	!Ð’GCÌ(¥¸¯BÊç¹È7¬P8¹Pæˆ2\r²2o.ÛƒCGC4¦´\"svPB€O\naPóÁ1h³*Bw-b°­§áziLåYWT”ÒžTmµ«‚î¤ÑÔ,QÂ/QjÌR&Tv_*h¦·t\">BsTóiÁˆì‘Y+›Ðš°‚n¿Â0T¨5¸†™Ø‰b¥ÐºW9ä&_ÄÈ¸bØ¦Aç\\ìO	À€*…\0ˆB EXè@Š.Azäy&«Õn,«K%b±O™×€Vœ¾³Eýùþ Ä	¿;|b_ãqŒk’ó,È,÷°(ž%¶Í¢_<ÜªÖ{æ¶é|ý\n9l*±@{pQîç›óRa óÁ,ísÄHòÝ²À(°Iz³2¯}°*&št\0ìÌhþ)%ˆwE**Œ>ŸTÛMªTZUÔ¤‘—ËY/FÇj¥ŠŒnìZ´\n1gÌ4‡§-V'dZrÁL2›š·XÏÉûÍÂ¹8:û¡Æ™ÊlfâmÃ(wi­>\0À–°%2ø‰\$ËakÁ!b«_SU;Ä–¹¦¶'ôûá˜ÇãWÝžòéòp8Ë_ö™Àí×=§¿/-•¶+OÎÉø“@uy\0Tc¬QŠÚ\"ÒöMIådhç¸€“\ncºV\0ä\0¨BH5†”:Ú}Æ^u–·ñ~¸°S¾#ÉÛè¬Án/Ÿt©žÞÐÉ*ÛH¬ñ0;RjLžõSŸÔDI&Î|£¥\"ù2«°4èÑõÓM‡g?·Z€.¤%­nJÝ×¦ÌLÁé\$‘•‹ô&2§Ü¥“’²ZKÉ‰>)GjTãCÞo†‚VjÔîž¿6G»h¡Š¤ùÂ\rã-^²ð©,NÐOBÿú/Bjˆ©_±\"e—°²Ù±a\"‘³WG?:—V\$É±“2¦\\½5õ@ŽóáûëžeüäÅëQ°°Ýâ-Ì÷PT“^l@ÍÏ§6çü™÷?ýî¨i·6M1}e­‹ßÏ×¿Oòn„«J@ÿ.ûïò1&²W…|nãää§fàH4B àI0ð®>TÉj*ð*/ÂŽÉ°¤æÆAÝå ÐáÖëF¸þãLÝmÜÞôKªˆÊäš\$æ10\näÍÍíÏaýXJÐt¾\nÒN…\0‹úÿ†æA|2¡.óÑlî‚å[Æl¯þýð„Í­!\nN¶ðRþ°‚óGÆÛ×Ð€ýÎõ‡ÚƒðÎ¿NcŸ°ÝTþÐÔúŒ`2¡r×Î8ãÎ@GeŽâ°ä*n–3ï±.·/ÐßldÆ‚ßëôÏÎ\rPöß±\"ÏKWPWñÑ0ƒÐ¬Ì	ð\0000fäãÎ)mD\"V+Á:)‡pÂN ìØÑâ¤ã%bU„\0,Ë^¥BÎ‡¤!Ú÷â<l¨âP=l™LÀ¡3¸\niB¼,+Á+1‡íùlþ0Ý8ÞFðágç-ÈGÁñ-Šq\r¥ÃMKñ®ÿÑMMan*Oú‚ˆý° ÿÏ1÷²ðîJòlé†Ã0D%©s\"ÌX¬`;¡\"j{#©î>+rlòLä\râJî;\$îVè§<'…äÞHƒ£%§:ì’c ‰‡'rR€%„p2'1xVD†¡\0:P¿bÀ,!R™)Ñ5Cã*gjópíQìïr¶V’[*’šÞ†iŠ\n@®TÀÄÎM.4ýqë!®öLÔKb<³N…)/¡2¾óRèWDÉ/ÚV;,rÿ-s)ÜV2~ôá,\0î‘)*Rú2Sà³#ò½.Má1ÐàáÓ<)ì'“/4Ò\"(!DãåˆäŽQ.¤Éí¥-30ÅråRÎ@C\n’]GñÎÆƒBvSŒ-¬ç<ÁéBÒåÆÓPª¶ãàFŒü#Ò.ã†È°ÖSÁf³n“\nn¸ÚÓ¿#&àÐãàûo»3‚‚hš\r€V» Ò`ÖQ„_ç\$rƒŒ‡@Þ¸`Ì‡¦( ŒÃ Ú‘\$@²h¦\n ¨ÀZ’+†>ïÁíÔûøü#Ã\$jïôú0sM&«P1ÔP@›A ÓAe†¦däùC,3ÎâDÿGÏ˜	€ÞÂ†l…C†9`HÆHm¢DÄ`+ÂÉ\"\n¤Îu>øã¶Q¬ay\0(Ghš‡ç˜8³IEQÊú0Â%g”Ç3ÎWÇLOæû¢ÏÑ,\n… 7£X5Ë\$¦VQ€à•%ÖÛÔRØCßLÏ -„lGLuC\0äí¤lƒp^{ðhKÁ.@a8u®˜\nÅð ê\r¢þ)# âTLJám#Ç8¦Å®i¡jáènTÌ8‡,'ëlJ¥¬à\\l˜1'6“3ÐG \rì\\ãj8²s*¥ZNbPËopL¯@òEnH`tÆaB>\0";
            break;
        case "lt":
            $g = "T4šÎFHü%ÌÂ˜(œe8NÇ“Y¼@ÄWšÌ¦Ã¡¤@f‚\râàQ4Âk9šM¦aÔçÅŒ‡“!¦^-	Nd)!Ba—›Œ¦S9êlt:›ÍF €0Œ†cA¨Øn8‚©Ui0‚ç#IœÒn–P!ÌD¼@l2›Ž‘³Kg\$)L†=&:\nb+ uÃÍül·F0j´²o:ˆ\r#(€Ý8YÆ›œË/:EŽ§ÝÌ@t4M´æÂHI®Ì'S9¾ÿ°Pì¶›hñ¤å§b&NqÑÊõ|‰J˜ˆPVãuµâo¢êü^<k49`¢Ÿ\$Üg,—#H(—,1XIÛ3&ðU7òçsp€Êr9Xä„C	ÓX 2¯k>Ë6ÈcF8,c @ˆŽc˜î±Œ‰#Ö:½®ÃLÍ®.X@º”0XØ¶#£rêY§#šzŸ¥ê\"Œá©*ZH*©Cü†ŠÃäÐ´#RìÓ(‹Ê)h\"¼°<¯ãý\r·ãb	 ¡¢ ì2C+ü³¦Ï\nÎ5ÉHhŽ2ãl¤²)`Pˆ›5‹„J,o²ÐÖ²©ÔÐßÍÃ(ð¹ÉHß:¤‚›–Å ŽâŽ2¥nãï'¬‘¤m)KP§%ñŠ_\ré¬š¤ËÃtvôK`(P£HÔ:»ëø  4#²]Ó´û¾•-BÈ6¬ï¸A(0(çÁ!\0Â1ŒlúRï×U›úÿŽl¨îì„0Áj\0yf\r0Ì„C@è:˜t…ã½Ä5}b9ËÎ®!|gŽC ^'AðÚ±²«8Ì±¥hìîã|’#£Æ5¸ƒ%(¸Ê¢•\"ë!˜0ë„¥Xäí¯+ÚúÞ²=˜Ã¸‹‚ä¸(sf¥¥ìPÂ®-B¼m;èhJ2K² 9¾r‚è&{œgC¢ìî)`àº!¨óK«‹ü¡¢êÐ„HÜ1¸Ô¨é1©\0êŽc©`ê2X.¿ˆÕ\0Ö1ÓÃ~ª3¸Úá0‰#*¸Š¯ìÝn9B’4¯Ï*WG­ƒRT‹˜ðå BbUé±‹†‹3‹4h2 #šV†í£`ØÕÍˆ`Æ0Îà¢&­,6mþ+ØäëPãž÷c+çYát´ILe\"_8á£Ã˜Æ4PØ§‰Ž±¿“åù®`‰àÒã\r2K¥þW™@ÓƒK6Îî(h’6ÁºÔ\"¥Lfîz’ß©eÈ…j>íÌB¸õ	ýmg”Ž8dQ±•\rá˜3ÅbÁ¡)UAœ¿…@ÞE‰Xn.µ:‡Ux¯ƒ3c-á¼³'U¢Á ÙÈ,èlú³å`š¸eÌ¡\$¤ñË;A%á)… ŒiÃy-˜'PLÐ±•%%ÙäõøÜžù5NØ\$nrÉ Jb¤¼þÁ%@Ñ•†X”œ5\0Ü‘y“>\$½}›ò]A®…çÝh†4îJC\"²ZfIk-…´·òà\\AÝr.b„ºRì\rÀ¼ö–…ý\"Á>‘®Ðï°žLûå\r¥XKÙÔ`{¤Ã‰Ù_%pË2²FIU\"²]è=xŸ`ð\rñz”±íj¶ü¶Öêß\\+rÇ9—ZíNIÑ;IêùÃpkÒX&t¼jŒ@¬!´ÒÃ”jRb	#²\"’ˆysæè‘àÄÅN!‚hÎ4™Uw#ÁÇtLäÊÎÚ—™ÀaÅÌß«x>ƒa£\$P–|¬ƒNó`aKÀ®¦¤Xb&-eµfM@CHo£e¸¡ä0eÐÜ¬œé-.£° ‚£è‰‚‚u\r@PCNå1¢Ï6ŒËâ3…½ ´KÍQ—Ynˆ7‡ytC¡¹6‡\$z Ê‚Ì½âŠ•4h*<ÃŒ†âá\"*öPõòƒƒWY¨6Z3€îj^\\Û,«j~Vj(ìC)\$\nÆøÂ#9¶IÉI+%¤¼¸;UXj;E(º#³°ŒI´¥TdÔšÊ“LNy&AY»T‚–(ng Õ`âÙÎ?!¶8Èedj\$K‡š¢\"g‰ PVEìÚJ`žÂ¥Y.&4<÷/’¼ª¸OêÇ†²0®ƒ‘éY¶Räšb*ƒ1eb¤\r»Å`pÏìêCV`@zî}M\"\\«1[ŠêÈýCc¥€`©Lb:}\näìÚ¤ºC÷5åp±¥BqI:SSœ<ÂY>ÚC¡h®(´#šW1gu\r|)´–—'Vk²¸=Q9®~q\nåJŽ|æ†Ç4C‰qþ“©>¾B%Î\";véÇ‘¹â+ï˜r+¢8G”z€.¥Q³y*sªG}f?…*ö^Ùû{\ríÂ^DKCƒ.Q¡M”|•ØN[l¥ç†·£š_ÎXe*p7«Ðçb“Û/%¨%–sü¬åQl¸–Ü¡ aIžpJjaL±Ág¹äéMª˜¾pIzAGº/J0\\%…øLÁ¸¬µÇè‡Þâ~M¢>ˆb ‹…=/Y—'gãÊCò’¿h.™ï”ÉaA(ÀiÕlápv{!º™“êƒ›hœ²}w¬ÞíPK€PÅ±¥R\0JËdnJ»Z?JE\r×<°ƒ¶x‹)÷H›—œL2g˜¸¯Ì®\\Í™b’~KÞ)=ä:ø°ÈntW¡’í·#\0+ˆ™ØO¯]üÕ·á›Ÿ“ŽQ¨í„¨C	\0‚Óï\$lúº§„¹Ð^Ýk¯ID¸¥6†|Ês>eÌÀ9´3¦ŸO>çf0YžþdìVaâ\$ÌÿY\"Nñë÷::™è àz9.é\"¿¥˜R™)ºyG#ÝK un°/‡Z:}w¦ö4QÖgdÏF6‘¬Î—KQ#®íÏ;—rÎ;×i6]¬ŠtÂ™Ï¼|Š+Â˜XÑâ:Ï}ð¯ÃW¯¨\\š\n?!ÝÐ§s„¼Å„øÎ#²1è=@ÝÏªð,\0”%!^‘,¦t9ëý\"\nÞ\\8ó±‰¬é„xÏá¸«Ëö“ÞÄãM”s\\º`,&áÇq´Ýû~Û>TŒ0xç§û«7·Þ\n5÷: sMÊßŒ~˜\\õBÍÖ¥Ë_~öP%ÿ'Pþºœ¶ oÚÿmšËÌRÄlXqÂÂ/\"+€Û\0Kn%üÆmPqPzÃòJ Ä€7Ã†b\rƒ¸;\0ädDO°7dD3\$ÅDDÅ\rpËÍž\"PÀâ\"ü¢:5í¬gG¥ÃÆ˜\0Ps\"l,ÊÄMHRlâË‡¶Y¬Â;èËP–Íoðœ‘\n\$ÄÍGˆÿØÍí|âŒ¯	ûïôO(\0£®¨ÉîšízÿÐ½ÐÛŽàòÏ(w/K¶ënØëîäçòîL0îá†-O/†pèplì'êÑ/&ò¢s.¦ÈdIKÀÀmÒ<kJÁ/T\"/æü#pÝQ:a?‘DÀ‘8%íÚ¯Ðº}J4ÛM¸J‡07â:Ü¨{°	Ø,†rž<k\"#¤#¤„ç:Éë‰Qv\$£©Ý	ZB…bÏƒd©~ÊÂâ«q >ÂŠ(çQI‘<i±’ÒOðdÏàSEGÊÆÍÎ±l>#\rŽcí•ïÌ¯QññBõ­dUïÂÍ¬Þ¤Ñð;câ+m\r,üõ²\"’ â\${§âü/°c¹Íõ Çå#±ìS…Ê°âÂTiB,#Î!²\"ò‹Tçt6c¡#òáq!÷\rM}ñP×'‚Ý |xÎÄ#æÜnã·(€æa\n©&°ðbÏ€ý¯{(å=*2Uë)æ.9€+k°zià¦F0Ñé0H0Ü}RÏ\r(\$’”8…Š¹Ã™\$àF-ßÌ¿!Ïè«’ñ-/Ã-ñ‚G²¬~QŒÝâÈßê¹0íå/2)1mâP²üõ³\0004óß./*íî>ñì	„–-RZJ¤jFãlQ/¼,3/qù4„r&GƒÑ11ï5“M2qb\0ÒÀä/ÂÕ(Âyì¥)Œ f&/æ|32³0\" sŠê®}9ìÀè``Ãg)Ž­8òœòS§9‘M-ÂDŒsŒgnoÊD	Æ¯;…EU¬÷1ÞêÇŽËSÔ%óØî€†`ÀØ`ÆÀÆ\rdÐ>®ìlÃ*kî& Ìƒc²'«ä\r¬b®¨V\n ¨ÀZÔŽË*âI=Tôì|ðô8#Ô<Èó¯>NæD”G\rb#2K¥˜€LÐ#ÑØþâ	¥#7 òp ò+æ8Æ4Ü€œ,bØ/e`8­ÆcƒaC¡3d*¹T|96«Æà°r Þ½eî«ãJ, ™K42Sb\\Q„ªAŒÜÛ¤hL‘X ôlldÔ¯ø{†r ìs0uÓPÏÌÈþÍPËãîÈÃB£Tù\0H`\"©pSóKPTã/1BÌ€¨L¤2džŸ‹b\rårm†\$•NC¤cÍ’O¦òof9‡õFtúmG\0ä«†Dˆ|Ðvs\\J³<&Ôê%ä1P/ÄêƒÊF Æ ê\r 	õ.VÚ=À‚-XóÓïÁ%†&Çp\n”ðD%EOì}DL€ÇA\n¹lä~Ì‹[&¡PíÈ\råâÈ.e\"¤´ k²IŒ`à\n2)ÐÍÇî?àä";
            break;
        case "ms":
            $g = "A7\"„æt4ÁBQpÌÌ 9‚‰§S	Ð@n0šMb4dØ 3˜d&Áp(§=G#Âi„Ös4›N¦ÑäÂn3ˆ†“–0r5ÍÄ°Âh	Nd))WFÎçSQÔÉ%†Ìh5\rÇQ¬Þs7ÎPca¤T4Ñ fª\$RH\n*˜¨ñ(1Ô×A7[î0!èäi9É`J„ºXe6œ¦é±¤@k2â!Ó)ÜÃBÉ/ØùÆBk4›²×C%ØA©4ÉJs.g‘¡@Ñ	´Å“œoF‰6ÓsB–œïØ”èe9NyCJ|yã`J#h(…GƒuHù>©TÜk7Îû¾ÈÞr’‘\"¦ÑÌË:7™Nqs|[”8z,‚Žc˜î÷ªî*Œ<âŒ¤h¨êÞ7Î„¥)©Z¦ªÁ\"˜èÃ­BR|Ä ‰ðÎ3¼€Pœ7·ÏzÞ0°ãZÝ%¼ÔÆp¤›Œê\nâÀˆã,Xç0àPˆÄ>ƒcî¥x@ŸI2[÷'Iƒ(ðçÉ‚ÒÄ¤Ò€äŒ¸¨; \n*Œ›0\"szŽ4PŒB[æ(Ãb(íGŠ\nŒÝ C£ª&\réË’¿T¾£lÄô# ÚÔºÃôþ?Ã¬(cÆý&	Â†>o«î;# Ð7Ž¨´Øƒ@Ð@XˆÐ9£0z\r è8aÐ^Žö\\¢Qãs =ã8^Ÿð%Z9xD¥ÃkÞûµ#3Þ–¡HxŒ!òJ(\r+lfùÌƒ\n\n (H;¢5´C’ðá —T`›Þj8@Ö.ÀP’ç¦Œ0ê\nñƒTœ\"!(ÈÂ.x…aŽz\"%ó³»5Xœ†À‰r‚4¡5Hß\\¨Ìè0¨ËuÉsB3€˜L‘2EZ\$3ó!Ç Rw£j[8\nn“&3ƒpêè°\"B‰8Œ­ªèœ(Nz_F%ëp’ß<-ÜÛ£)æQFKãB„)Š\"`ß¨ R`Ü0+ÍôÚÇ¹C?_0ƒ0–»È£ý»º¢žùz§Öæêã¬ÒbÎ³ì¯\0ŽC \"¥üg!GÚë¯îùt‚M¾C…Ê4¸ƒd?F (ìÝ'#xÌ3-¶2KC2ó2)y\nŽ„ë	¯N¢76ŽC…ÄÎ”jå#sBr¤uzaøKÖN3²Ê+{ã x…‹R¤¢ ÞÌ7b¦)ÁÂ#@\\6p^Ä7OÃ“\n÷ÇŽlôË(Þ§gã3´`aNt&ÏtèPIH3	|ŒDNybX§AW¼6ï[‰»4&X‚f­Uº¹Wjõ_¬î°Ôr>%e†à^I\r%¥i-R|-[ë„Ù£,sÐztRÊ¥ç2WŠ¡ÞCµk´’§\$üÉßôOÄµó&eôŒt}pv«ep®•â¾X	bB¥–RÌJÉa-Bå¦Áñã#ƒà@×¹I?pl´PÎSÑ€:†Éï–’BnÏ±0D¡É;¢â¼Hf0t4pÂÖé»T°“Ù¶ƒ‘œaa„3÷är”ÒœÁÔ†ÅjA¤TÏšJ¡CîÕ¤8~Ä6%Âà\\¡¿jØÞÌ)€H\nÕú‚‚”\ndqh,ÊyóË¨U—×˜¨XÝ™‚¦Q¯ îÏ>`ÒTdq='òMªH™Í:L”:`ýº¢\n¦Íy»TË`7E•êP:Ð–! 4†2£Ã:¹€Ò[†¤I+”OsQ5­AÓ0eNË6&8IÜêFMöDbàH©ÌC\0(%1ò†êgyŽÏ½øÈµŠŸŠ°TA(TD)2©RÐy¹3ùòlR2s\n<)…H«#C¼?HÁõ±ÐÆ¹Nb} gÍ	ÒvâaÏOÆÖ=ª`˜¨e íè‹‘’6GW+ìl³1OÔ\"üŒã»2Á*L´hmÅyª&Y6¦roLW(jt3€ ÆÅJ4™A<'\0ª A\nÉÙPˆB`E³h©5™v*Lí\$TM¨µ%‡†qëNG‹á•ºEð&*úœ'ÚS#¨’\n_Q2Y?‚c¦ñz3Ç!'{véB{T>jÏÓt\\Uˆ\$ìº Ñ;-©Hs-ÉÍ·G)oÒ«ItŸ²`à{¤K1µ•ª×’dühˆˆV:(¥¨ôcëÔÁ›“\"eG¥\nñ”è£DˆŒßâ”—Iònåè¶€ ‡d!‘i¥Ž\\6bPœCJ_-çAÑ2À”„Ž#~4ÔÅôuÆ½ etPDøÖgÀM©Âx]xlÖµð’@dmÅ ÔÃ†¦ÐMñÐÃÕÝ|d4^Ö U‰2ÄÔØÙO”ÝøÉëÑ­å“¤ºUIBQM}2šWýjÛ\" ()*“RÌL<ã3Õ&ó9V·Ó€Q§@<ÀbªqdÑ¤à’£»\"½L qÏaÈ<¶ÁŽ0¨äˆç¬ùŸ 'e—“r\\MÕ{0È’S Ê]%ñƒ«m„Ð?G¦ÉrŽvIh­.OC–™‘ÚsYiðÜìõŽžM)…ê2\"DÈ­m#D©r‘*ØF6]p#äí±Q3âŽQ-†0%:¸ØPÂšj3Ê{âtös6‘Þ:V]¯º\\—ìŠé]g05nöäã‚ž§^÷2ýºFêsI‘Õ_æBí/¢vAHmœšDF0s5¨’ðÄ™Ã‘œy³ãÒ?Æ\$uÝ·ZqÓ]È	Ý¯\$¼™”p^2oÈ©%MQQ¯aÜi›Âs%\rÈ·b{½Jƒ™\n;n5RÃ3wˆÒ©]=És5WÓ:3\$e+û þ]#¹U,Dgïäf4Å\0(3Êa‚›Runƒq½IÏ”žEÉ5ý×íWg¶š\"‚üˆÁ-Å÷bò>ÛÌ\"×rsWO¿Q~°pÍ“í½¾vb¨©ßÛ×‰Å}·¬ö—©‡sm'êüy}C±t¥OÔÚ¢Äë•&§†»˜¢v¼¥bò¯›\r=g×zl§c=—€‰¶œš¬’ü‘¢ÉiÝ!38dL™•_}oÂc\$(U~EÈ29à'c™Â ?¼7Ÿ\rPwßœNÎ‰U*S]û_Oc1á®øKÜÀ…BüŒ2Úú,Ì[y~Ïeåq…»}»ÖkC¶]oôáïtFëÐÿ#´€¬äð¯öñýœ¯(ñàpÐ õBxò-þx(:«ÎM\r,æ\"bŒØcè1º!Ô©\"Œ&Šò?Gâcïˆ2Š2B\$~ÍŒÜŸP-Žâó)a,]Ï4òbßéVaÜÈb¾\0Ê5¥å¢8eâÝ	ËÞ,ð–hî´c @\nCœhïÚhìÃÿ®âýÃ¢fÏsÉïïP^0¾o-“\rÆm\níI0Äåo™O	\rLc0à\"ÐûÌÊËÃöñpîf/MqÏ*Ëð‡	»PþD±Ë@šFÄÊÎ0íÜA±çð'ßN±I-\0f”i*€Íà„€£¼>l:b¦ÎÚÝ‚õ©\\0& >ÈðKçj>Äì:'ÞØb|!\r\$T®ä\rJßD¸d>\r€VbÚg~˜Te @ƒX¢C*â3‰ÆTWÈþ,Äh\n ¨ÀZJÔOBí«\0q©²QåÌ(NjÐ-pÓ\$ÈÈ£ª	„›€¾¨äUpÔµñ¾ÕÈú2\"ît¨çö(„è£GHðŒ(Œ«V_\\ …ä¶*„ÖQŠvÑ_Xãð,gæââNJÃdtGRîW&NÚB'c&î<öPu'ŽOÀÞ6&n9&Dh6§X_p§Šµ®æ§\rÍêO¨~£än‹ iârë¬‚Î‚Åh±jÎ \nÉ.«P	¤M(rŠ;²Ø˜fP1€­;¢4-ÒÙ%È 2j9‰¼½+²œ&R;RÅ2æ0 ÞÃ ã9âßÐç%eÒ0ƒ’ð ä>Ã~qÇÎ";
            break;
        case "nl":
            $g = "W2™N‚¨€ÑŒ¦³)È~\n‹†faÌO7Mæs)°Òj5ˆFS™ÐÂn2†X!ÀØo0™¦áp(ša<M§Sl¨ÞeŽ2³tŠI&”Ìç#y¼é+Nb)Ì…5!Qäò“q¦;å9¬Ô`1ÆƒQ°Üp9 &pQ¼äi3šMÐ`(¢É¤fË”ÐY;ÃM`¢¤þÃ@™ß°¹ªÈ\n,›à¦ƒ	ÚXn7ˆs±¦å©4'S’‡,:*R£	Šå5'œt)<_u¼¢ÌÄã”ÈåFÄœ¡†íöìÃ'5Æ‘¸Ã>2ããœÂžvõt+CNñþ6D©Ï¾ßÌG#©§U7ô~	Ê˜rš‘({S	ÎX2'ê›@Žm`à» cƒú9Žë°Èš½OcÜ.Náãc¶™(ð¢jðæ*ƒš°­%\n2Jç c’2DÌb’²O[Ú†JPÊ™ËÐÒa•hl8:#‚HÉ\$Ì#\"ý‰ä:À¼Œ:ô01p@Ž,	š,' NK¿ãj»Œ Pˆ©6«”J.Ò|Ò–*³c8ÃÑ\0Ò±F\"b>’ÉoØÄþ¤ƒÌø2 P¦†¸‘¬%n°ÃBŠãÆ4l3OÔ\0\$ÉxÎí°èðÔŠ9ãr91\rƒ  Œƒjô†ºPA¢°4RCIÔÕÃ¥L¿ÁÆØ³H¯pdè‡Ž¸ÑÁèEJÐt…ã½´&5röü.Ã8^™…öE”â…áª#R²ô3.Ãj‡;Áà^0‡Ðƒ Ï\rÊ›ü¹i\\\\æ1«*:=˜ê:Ž@P¬¯õÂOs<Íª;‰\rØ£˜'+Ã®\"4¥tƒ¨®ÔÈ°J”ŒCÊVäéU#‰pÌÂÆH³(‡0ÌCrLêUc«UY§“ïSLÃ(Ì0Ž£b;#`ë2‰q#£v©1²K\"-'îZêâi´4†²\"Ì—ÈÉC2ÈÎTd5¤¡\n3¥u^¯#êŒ#hÛ%ƒ˜ÆÞŠbˆ™65£•%J.»K\"7·õ-0ÁPÆ5CRt#®ñCÒðÈŠ|­ä^Zô˜þX;òyBËI¨”ØÛŽX\"\"‡e‚bÃf1Ð²-w ÿLÂ)ÓŒ P×©iXk2‚º‰`Þ3lõzj*äõA‚ô	8ò‚_£¨Ç]Y#6“¹#kÐæèáØÂ3ÊŠ*ôª%6ö|2…˜RÜTÈèÈ¼¦‚1>9`¸r“Xa!À9²<¬a]¬yé½R6vÒ¹\$7˜Ã8|Jœ Šð3‚X·ˆiÑià4œ`@³H2ÐZKQk-…´Öâ­Uë€9.%È€°t^‹¤Dæ©—²øzlDÿ,’¼TJ™Ämøgœ\$cÅDÀ’Ç¬eÉº|8ë™œT:íRª;€Ág´hfSáªÙ[kv‚åÂ¸ÃrãCéj!® æ‚K¯.Lä:D|šÓÄ%,ýÞCW‘{gDÕCÄâHè	ùDƒ*J!ä„BHù†\n„\\5vxÛÑ#4D6&\"RC3V¯}]¾'t§ŸzÃ\rªR5K.&Lè4´Ôb_Îu‰–dR‚þÈà \n (Ftí%É¦=Éüê\0PU_¸\nfá¸½µuzÏÍi4¦š\$TÍš´i¤¼ÄÁÒ13ÜÛä//å,¯Òk(Û\$PWÁÍ+¨¹/	azøÑ ¸ÊJC¹²Rn€¼)BB§øš“rrNÉê¥I'\rý\"F‹pt€4ØJUI¨I\"äÍ(Z¬Êq&r,Ù4\\Z{qÅ0žÂxwB\n(c%ëØ›4G	¨P	áL*×|uÍ™P)e6•@S\\Ÿz¥§d¾zoUÓa8”´\$àTáXnG¡†/0ÊM^]Bæ°—“|Ÿãphõ5S®‚¤Õ+eE×«v@*a§AÈâPŒ]ƒ)x(¤1A\0¨Va™b\"á8P T¶Œ@Š-ªLÄ—†Õ¡BÔ—ì\nÛ€ ˜LÛ¢e71	#…d2†ÍŽ'ê€'†ÚØ].laÇˆò6C™=ßÔùªéþŽ8÷I%Î#˜8ÐuÑÝÆúG][·»×™Ý†¼\ncàTHÐ+IŠ`Üá&I¬š(ÔBQ\"q‘3JjMi–‰UY'Tïé\\ÄG‚ 4Z1'1›ÚˆcÉ…PÁ¤…N\$ÃBÛª‡`­U@kÅuˆ»ùU/ñÓ9j:kË»MÃ“´Ò†PîÃ˜†0jl±‡ƒ\"§	–>(ª•É„\"˜s!?/¡‰ ³#eé@g³a•õwxÁºŸ¿Æ3,‘ÃŽ©r¸\n\n@““2 Gˆ\nzÐÇ°Ü ¼Šb¾(í†\$pŠ¿¡tj)«Á{›(T\n!„€APj\"W	YZ Pàí£SSX´D òD	H/`ÊöXJL©‘\n-?KF@X	ùÅ:,´ÊÁ—\r{©P	Ôd5ížÐéª«Ô~“Q†+Ãpv%úFf¸@ÈáaÂÖÄ¨–fÓ.Ët«Û@²Ð9–u­µÁÅÚCêE,ßÖÔÚÜìê•UšöqÌOJ¹†ðîEŠÊ+E5ð˜L6×¼¦-¯»äÙí‚H¤ô©&·Ô¢Ÿë(C@Q\0\\â\"¢JJ®÷áût¨cU£é1²SâÅ×ƒó0%ˆÈ—ù´ŽÉ™Rá%HÿÀ‚’Š™#KØýÒ@å‰öÒ›æª”Ž,ŠUÎ”\"q5KîåÁÓÎ`ù·8èÎåŒsÓûÏú;çŽ[XO÷son¯âÅlçÆ`ï×w°D)ÁûrìYôºÎ1H…q·gíñ>Þ©©½²é­³§ÓzJ™­³fDô72V\n@PN9êò¹ÃuyÏX\$ê“ðÛy,êyÀ5óÿ%æ°W|\$²QÏ¯¤xïÎs÷;êÈã˜sPr\næÍRdo€oWA“:î=²5Ö\rZ¸çùÝ·î}ß½ßÙ·à?„p²÷ÅçùBÌå Ag:Oƒ¿RÍ}|©Þùõ–³wìy¿¤V28-IêÄŽ†¿ÎdÁ8M0¢pèBƒ`fC•¡\"\$i@\r@Ü:%`#B2bôÈ.T§­È2ýÂ³oÞ™#êþ\"ËÂ:5ä„?ã÷\"NüL¢Êm.É\":0B:ºg,fðKj;´2&ÆÏÀï¬qNõ0fb/Ìê°n½¦¼ÎìÌXI?¤„&°|gP€ŒÎ¦ü.:ÏŽ•ïBõ°‰	ŒˆÉÃ™¥ŒÊÍ\0;‚Lv.,q…6å\\mn¾`efôÄ25@Þ\r#¾ÎOtÎ„­NrùÜôó	Pä÷„­/Œjfªnç%\nØù0òÉ¥’Éðú¸x÷çèÌ'TI£ªðŒPÀÊÑ¬Ù«¨õ‡‘, ÐôõÑ*iñ.ƒ/d/:Pñ:%‘JTQJÌ ¨f¯³Ns/ýéÿQV<ÑeºVàèÑ~ËïC	@©oXüì¸/½ñ\nË˜ÏÐ°kÀ¨'DË\nÌø=Ñ0lB,ûëQ½QÀTñ”/ã8bU@¤X®´1¢&i\$Ç†!f¼e£G\r¢¦5.Ö1ðÎqžƒ\"Jq<¯€ÒWNe§Þ5Fv/ ¦âæÒÓ†@Pbôm¹\"`Ú*p“@†a\0Ø`Ö#ÂBq„:8N¾îçœ'¢d!M˜92àŒ4ÂX'fâ•GÞ\n ¨ÀZž…göTÂjÕŽ49\"R#~±§b -´ÛB(²ˆú\r|ò%q6#4(\">\$0HwB _ëÒÅ\0š\rçöÍ.uB„î\0æC\"BCŒÐ\$ E-C”DÙ%@Ë%’N8£aB>öc.	ê“¬ªë|Þ°Ö·)öx£xÏ&ê¸Ä”š(\$†’g`èÇB:0°›*ä(–0s1)âŠ8‚\\EFh¦÷2ã„sP§+Ñ6ê\$•)Ð341¹5äÞ*c8‹F8R'Lg3³P83Bb,k‘â}ÂŠ»e4ãÉöL§FnK€n®ò TÆë9à¬2§R×ƒ˜¾ Æae\n¸btÆCüá\0‚:ÀØPR”ÃÆt)“6a ¿ÂV/«~T\r4b†@NºWQG~L³ï1b,f à+ÐR\rëÂ.ìC\"f|†Î‚ä7ÎöŸ¢TJ 	\0t	 š@¦\n`";
            break;
        case "no":
            $g = "E9‡QÌÒk5™NCðP”\\33AAD³©¸ÜeAá\"a„ætŒÎ˜Òl‰¦\\Úu6ˆ’xéÒA%“ÇØkƒ‘ÈÊl9Æ!B)Ì…)#IÌ¦á–ZiÂ¨q£,¤@\nFC1 Ôl7AGCy´o9Læ“q„Ø\n\$›Œô¹‘„Å?6B¥%#)’Õ\nÌ³hÌZárºŒ&KÐ(‰6˜nW˜úmj4`éqƒ–e>¹ä¶\rKM7'Ð*\\^ëw6^MÒ’a„Ï>mvò>Œät á4Â	õúç¸ÝjÍûÞ	ÓL‹Ôw;iñËy›`N-1¬B9{ÅSq¬Üo;Ó!G+D¤ˆa:]£Ñƒ!¼Ë¢óóŽgY£œ8#Ã˜î´‰H¬Ö‹R>OÖÔìœ6Lb€Í¨ƒš¥)‰2,û¥\"˜èÐ8îü…ƒÈàÀ	É€ÚÀ=ë @å¦CHÈï­†LÜ	Ìè;!NðŽ2¬¬ÒÇ*²óÆh\n—%#\n,›&£Â@7 Ã|°Ú*	¬)*ŠÌÁR¬ð<HRÚ;\rÀP¡\0ÀŒsàù(-Ë–Þ­“h …2(¸Üç\rŽZØ# Ú¶(o«î?(+ø8?ÐˆÆ1¾è2å S˜Äù„¸Ò:\rxêç!\09ÀP X•(ÐŸÁèD4&Ã€æáxï]…Ì]‹ŽArÐ3…êX_SÕ#È„J(|6­ÂØ3-Šg-xÂ@Éûz2N`P¬¨ ±Ä:®°ŠÔµc°Ò2ŽàUÖÕ#‹`·‰ÃËˆÅB¸Â9\rË`Î9¡£\$<¤\0HKƒXCî‰ô>\n‘PËˆ\r±|ÿ°\rF7­ƒZ}ŒpÊ3#¨ØçËpë‹Àã`ÎÈªZ5KL\0¦0ã*^P:`+“»Ã@ì´3£k2 d¢›üÀWèKS‹Šy\$„âŠr>Ùì`\$2C\$¡f­‹^¼£˜ÆÉ0\"ˆ˜k,úúM0à‹Hëwy]¥4ùï—¢\n5C+\"	é,ýpœ0Ã9^Ï˜çÆðâ‚Ów/+[\0\$´ƒ~À©o=’ñ.Ü}³¶ UÁÈÎ¢ „Àòœ}Ç‚HÄF2…©˜Ø	ØòÜ5\"åÃ6ÆªÎÃ;{QâƒxÞO·Ò*ýÒt¨Í•#”±UÄwÓl0­Œ*‰ƒWõÊaJR*ŒãÈØ¿Râ¦)ÝÈß©h@Á5.áL‰ƒ#!Â›0C¢yL\$bHAƒ%!P45sDµuRÆõB«òªÃZ Æ0€ªÐ@«Ù:²VÑ[+…t¯òˆX+\rb†à^}Kj×†ÀˆCƒàÀ–ÊÛ%#L³œ¨Ãa;9ý;PÜ‚X€Nïø80ÜÂ¡)%eD9Õ\nl1*,ªÅ\\¬!RµVêå]‡uz¡¡’ÂKc%T®–aÚÎsÀ¼²BAòEåÆä™\r)§€„ìÕ˜ÃþŸ‘K‹-Ö\"‡FÒ	Ù6#´á‡dtjÜ™áŒ*ŠX&fT”:S¤Ñ„V Â/`Á„3%åõUC×\rdµ”Å<¨	”¨lðŒ3‹\$ƒInCF¹”ÅF»²u.35¡9\nN…Äš¡@\$\0[3Ñ±?(&¸PSQ«2€¥Î(<€†–ˆ¸c&j]°Òæ)s”‡øÑ.E[”w/¯­ö¾øž`T½`kMj‘æq ¡R#&‰R‡4\0¥ ZA¸8*5L€PÊS¡ 4†0ÐôÁÎ.ób²’ƒ‰a.&E¶`ÌOÚ)½3Jû\0¢iKŠ-¢!’RHˆyxEùƒ(ÙÆÁ•ä'ÁÅ— °Ì{	Œ†T°¦5Pf\nä@Ì¤B>i\\Ä.R4¿÷| e€Ö–4×JZ«/¢Í‚{8‹¤¥C-Á-`Îºht\"/Äú#Ox\$cˆ k2DprDI¥g !M·ÒM.×r¥ÁP(#4ðçZ|.•^Š¤ÌRÊC#–A¹¢@g\\ùihA<'\0ª A\nÄ[ÐˆB`E¸lA‰'êt›—üÄKÉ­6„Â—^nfwYåN•}É4\r‘a’;Åyº7Î€@z\nq”Ë¬yÅ:!ˆ*@C	0Ìì	&ÌVûN®•Åßê›aAU\$éeÿ2oË:>+¡‚%*{CÁÒL´ ‚nMéÁ4R‹	‰Þ'’\nYpÉEAÙz®TðTkGÔ°&(]«Ú_\r!é‹Î÷:ù®Ë2d¡ö^gØûŸÌv4Á/L”2î^‰w¯©ŽIq1„µÐ7Ó–ë¡\$íx&šbÞ¼ÎDù7®è’Û\"ûmÄ-áP´¼¢¤nsUÞDe©§°äŸd‘)m`¾¶V|¥\rd¡IQÃ%äíRóqæé\"s­p‚ Aa UB»è¡«©Ê=§ VhI97ÇÞ*“Â‚[ØX å_X˜ ÈÂ˜6¶0.€F¤aÎ	á-UëS©2îD&,€xÙµþÁbë“På.ÊÙ•ÄÆâÆ[	ö 'h“Ç‘¬l–Ð›\0žl –µÀ Ý2ïr›ý§»È˜j‘†ä4¨sœ{»)*‘‘Ò?¸—àÓÌã‘˜#:I¬“Æ(‚Úã\0Ã(b®‰šÏjœT÷Ñ<B†²8_I.¨-îÍ1ÎRIÚú]-½Š²bäà®Eü€Ð.¶¹ê 7ñXþ€c:å­³”ŠÃ0‰æ	åƒe::\$š’y]{—B†R×§[êÝx€Ùwcúáxº€)hbÑÉ\nÿ‰˜¿#Š†Hbo7åB‡”4€ûÑ3}ôëxù»ZYK¼ëe¦´†:û}’~8–¢”Ws'\rpÆ®}ôSsŽ¯ô~Õý±þˆù”ËîIM1„ŠþÊìÙ:Wg’~³ÒyÂˆ]Œê>ªIµ^sð»+Šè¿àœï|e‰NÏ-ú2yûê6ªû”›\$4ì¸\$~¢ˆé?_ìë¢¶~îÛf™¸2gåî:Íþ¶.Ù´BÕþ}âÓ7ÿb~÷Ìùo¢Ìgp´Ç ÌË¹¢†“ƒN‚¢\ng„^ÀÏ,¥V‘Ð4é<Gb„)‚ØÌ\r4ðwfã@ÜUdh­\$0i#ˆdâ¤'ÃDÍ)¢ž‹‡ÿfzý¯ü-ìÊ­^çÍ+ºÍFó,¨^5ªùÎ†ø„Ê°\0.´6ƒlQ‹ÈÊEâ­ þœÑé\$÷Àú¼Oð\0ùP§â„ÒÏ\rDD_æš\r…Fd LÅÄå	t\rØ'Ä.•¦Z:ÏÂOÎ±±\$/mB‡\nOå\rJfÏKQ;`Þ( Èwæ.À‡NzãË\$ÛC	‘-\0/…Ð7æ,0\"œv¯{	°@×ÊtÐÎ0Qb)q[	ÄÍ9qq\rqh?Q|K(bÑæ*EiÑ‹‚e1@9Ð&bŒê8ð¹ª*N“.Ñ#ApÙ¬¼Ïlì:Ñ¢3ìø0\0¨FÆ¾ì\0DÄÓÐÎMIÑê÷1^l\0æ3-&.êÚžÉðsC¬Î‚œAçtSf°Ö1DR©ª¿æûòÁ%*(d%\"PÎ	f\$`¢d\rãâeeÒ4d­ŒûaJÛR(ÚÈIòT’`†D`Ø`ÖA\"ä îŠÚ‘‡ƒX€Î.c#V­ ª\n€ŒrŸ#Ê\rì’%2N\rútnšÞ/Í*KP·)&×8áè.gP6PÑ¢~±%€CŠç‘ñcŒ!@Zó‚1'ƒO'ÎCîNñk`:dEêê\\#j‹ƒœ+nK¦.	ÿmÂcÆîº5Ï^¿%>T€ìn'>ìS#õJ¼pÎí#b¾ÏM2n àñ“,¯c\\øqìsR¿4\$Bf2,é³Ç0\r\njŠ­-T^Ìr%R@íëé.ÌˆâeÞÀÑJÚä¾“q\$€êfg6\"Ü*:-«ÆÌ ¦p¢,„\0:²G2†JÓ9MR2Q­/FbóÈ‹!4£\0§‚âÒ¼1mRFÊ,#¤ô8bÖ“DjFâ.\r ";
            break;
        case "pl":
            $g = "C=D£)Ìèeb¦Ä)ÜÒe7ÁBQpÌÌ 9‚Šæs‘„Ý…›\r&³¨€Äyb âù”Úob¯\$Gs(¸M0šÎg“i„Øn0ˆ!ÆSa®`›b!ä29)ÒV%9¦Å	®Y 4Á¥°I°€0Œ†cA¨Øn8‚ŽX1”b2ž„£i¦<\n!GjÇC\rÀÙ6\"™'C©¨D7™8kÌä@r2ÑŽFFÌï6ÆÕŽ§éÞZÅB’³.Æj4ˆ æ­UöˆiŒ'\nÍÊév7v;=¨ƒSF7&ã®A¥<éØ‰ÞÐçrÔèñZÊ–pÜók'“¼z\n*œÎº\0Q+—5Æ&(yÈõà7ÍÆü÷är7œ¦ÄC\rðÄ0Žc+D7 ©`Þ:#ØàüÁ„\09ŽïÈÈ©¿{–<eàò¤ m(Ü2ŒéZäüNxÊ÷! t*\nšªÃ-ò´‡«€P¨È Ï¢Ü*#‚°j3<‘Œ Pœ:±;’=Cì;ú µ#õ\0/J€9I¢š¤B8Ê7É# ä»0êÊú6@J€@ü¸ê\0Å4EƒœÖ9N.8ðƒÃ˜Ò7Ï)°˜¬¸@P¤ÄÊmcþ€BœNšOc ¾ˆûÒ\$@	HÞ¼2›D9#Cv6\rã;=9nhÂº¹kãY\0ŽcUJ Œ‹¬?:4p+ç<C„9AÆ1 ³ÐÜ3„\nÿ@:\rxë^¡p|\"É…\0x €Ì„C@è:˜t…ã½Ì5Œ­…ÏÈÎ¢|9Â^*ò^È7ÃpÌü§£¤ö7xÂ*cxÖ0¦4Ü³1£[Žµ«ó`-.±JŽhf\$îT¸ÂÐbª%J'>ˆ ÉˆÐÃ,JÃ:2Œ‰3:9¦l58YÎjÿçŒ¨î	cxÙ\$(´{¢L‚ø÷B\rž•‰#pÆÈI.]^(ðãF6¥Ú\"ÁxZbÃ«âÓ­Â\n9WÈ%=b,X3ŒƒÒ£\rŠÒ)ÁŒ(žÍq\n1Òóúê:0éHë¡0â0€R\0á¾|‰õ'£:‚†%0üB…Åžù»¨ú‚ÿ5îkï@B˜¢&P8îÊê›œ÷äXÕ±MÈÇOw¹ çá¥ÏëÀ:vå›ÜŒy\rè¿¹²‡S¯80Èh‚íQã¤…Ih@P’6×|`Š}>_›çõƒeKCØÔç†Ãˆ^˜ÑäñŒàôˆ…:`(6&#ÊAH9	Ma˜3\$>M‚¸yT\nˆÃ#D†IY-¯NºC*>‡x0­V: ùÆAn –—2‚Î•’Ï9`¸Á`É\n¸eƒoØ4Aág!©.Ð˜ÎB“Y\nÔ‰ SPÁ+,ðó\r!´8ƒPqáÃè€¨aªˆ¢Â¤ùPKf°Ä:`œCÞÙŠX;\"œÈ€ aL)`\\œE‹¦²6‡2RPâÿA´:†Æ^\\¢CÝ‚J,:’V‚Û	'ä<ý·£–I#`…Ï\rD\$¬’'„¦<7‡£ºÃLàoBÂek-…´·òà\\K‘suÓ(OÒî^A°š2€À“â÷ÆŒ¾¡2ÁX96QJ´ Æ×=„£JpMQ†”/\"Ila‚ñÌ”‚”¬Ñœ”´'DJætá1Ýk‚²VÚÝ[ë…q®UÏ-×\\¹K¼8KÀÊÈ‚z˜+à9ƒãd_Bhk&5L€|P£øs\rÃB‚ÂbP¹PZ¥õg¹5ŠQ%…’jçž(tƒ&°Å4}\$ ¦ ¡\0 6\níb†9€Ši\r°“ \"¤If¡„3tèx•úÁÒª­PVaª§ÍS &®iZqv\rÌÌ©H‰_ú(u@(b‹µÒ‡ËgDÈ¡’Sp †	y1&eÙÃ8:‚ÉMJOy*IX\\ýŠô\0Sib4gXLŠN1D\r‚ð´Ñ´ÐÃþ;•2†¨³H%-%¦ŽS4dùIã8e!¦5’¢hÃA„”éý¯Â²±HÂXö­ \$¬ZÐjÒBE4˜ª]C:Þ¨·0Â[)8PE¬ü%(¿E‰É;p”NŠ’\$¤¦¹•/à€-é.sÓ‰6	D ^û!PŒ¤Ð(Õ‘„ÄŸr”æi*säMaNMgÈ7¡Gÿ4ò\"\$öJX¸îÆ\nÝð\rá‰W	’œæžÄUhð‚SMa2N³\r×\0ÌU¯Á«\"Ò5‰±EF*¦¥ÙÊ,L/­ðär@ªV€C’Œ³Ïø¸‚\0Œ+¾Lf©N„>˜²CÃi6	mÁÒå€ZÌæ;ŽÀ¹”\0ÖùB»¤ (82Bæ]TáÍHõtæâØÚ±0cL9LÜZÑšAºÏ’™Ï²úºÄh‚qíuÍ„ðàÛ9‰1tŽÊƒuv°yã4!Þq»…K¦.š¦¦PY’“Àx%±Ì¤ø¸°2V¡ÈS^Å—9T_	MÏ\n¦“ÁØ‰ìB™xñ÷;‚¶ÂSÉþ:@Þ°›åw¸¬·2øaÈWcª®\$ê¦¤†Ï¢‰ÅOÈÕ8@ÉÈoEe@øÖ&Êg\n„Ë™=ªó9–FÆ¹4crˆQœÖíM÷9Þ)’w’iáÓI4ÛiÇl›1ƒú‰ëiQeÏ±Æ<pŽè\n\nxÈòŠ7âEj¡‘§ŠhR·,'Fèb‹˜¹mT¸C(†ÅŒžCtñn\\.Xn¿­	!¬‘è·£«ãÞ2KD\n¤\\d.×må]­žiC¨r F¦©¶¶åLUjL‡ñ&óý&Ian¸¾: @B T!\$ÆKC»=¤z“„+\0©«ºuä|:‘6jÊó:ehIŸó\"„ƒÏ•òfOi?H#iÀð–zH¶\"ZµM»Þ»þKË™8¡ç»¯ >Š¸IÃ\$Ã/¨ÅZ¹3_6`½z>ö++Ù§ÏGí¤—§Íä<ú¿}ëu!—á”/ŠPS	ô¾ãë{BŸ”ýƒ°†›ÏíÂßCñŸ½…ß\nÝ€ŸÉíÿ7×Â?«Åk	\"ý†qA¥{üÐÈˆZŸ¢˜#B8Ìp*«@µ\$¯á\nNB0QiDäD^MLDP<\0ä§†L\nã\0BH7dÄ \"zŒæÍŒÜK(näF›cT‚BŒ\$ÐV0@	\0?\$È‚\$¤l\$¸0#8Ï \"\rc¾êæXÖÊJD0<B>U(žPO¡	Mq	„¦b@ê'Î4´âm	\$MN7	dƒŠtå0¨êB‚ÎðžÃÉÖßbü(0Ã\n°à÷o°ßèþC˜?.6(ÌÏ§Vßƒ`tÈþ4i<kl>lô@oÊ-Î¼„8*\$\n^8CN‹ñ…x9&äÐlüAÑ64ã`\nñ*(ìô|ÀÜæBw¦ùoTæ”ûOh¦Ž\rªVjÑg4\$\rf~­•Ó	ÌL/þÐ‡¬Ö(y‘\\ù°ý,B‡°ã\rôZpû\r „S1„ƒ±«/SÚ\ng¨A¿	Õð£Ž&z±ÏðøÀ	•±Yæ\n «p:\r®D»®Àb‘Ï\r1ôY¢êøÏtùxõ†Xüqü†ò\0Öñ¬ì09 †šPèý2óëò!2%r+ ñ^ûï,e†„ËN„ËÌ#ñÑÐ¡%P8è`Ä¯Ñë1ï&D¥%‘êYñ±JØæÃ*çü:.¾Tüo†()BÊ*\$ç\$DV«„’tc„-eªAb%ª€PZCŽbG\nF@e)JÏñn…£òS*,-¢²¼Kb”x\$[DN\"g·&rY\rÂˆXÒŽ„nxdaéM')QpÓîHcìý 1í®E1nMÑÒU0Úä`äc®JÌs)cÝ2\0ªyŒcs2ãæ@9ŽÐë	‚W2¬<× òí+6‰R\\DR/6e5qÏ5³=°ç­763T%­ŠyÂä³s8æJJ(rf˜% Æ=C€8Çá„acÄ“„íG>‘äP©ÅdÊïëÅ#³)&ØB’8ì2=	pç!!<‘ÿ=°å?.^Ê\ri0f4•3Êì%K4'Þ.S÷?´	4tæBìdÜò®Q#\"&†¬Û“Î×sÓB@×BƒO>’#7³ QT7/-1Òq2ò@4GB´4S4W?¤yQß5Ã„§D{'´@7.+8bŠ~–‚.›'tk=nèÃºém%ÓG””'ÎGRJòé”–éÔƒ8àóH£Þ ©5.ÕÇÂ|bG'´‘ÊîRo\"ôÔCNâHb­ã¤SŽ*)Àešu\"Ý>R:{C;+„ÈáFH3u!ŠÔ£#jóš22­)ýU§Ä\r5\"QoægU*|RR0ã6*§S„c1ûRLû¬í§!/Ÿ!hk\"òL÷èŸV3áQ’NBU>dÄ\r€V\rbª#èù§4£bN mÆ9œ;¢’ËCÊìt)’ÚOBLCb”-‚ø!Ë_,`ª\n€Œ p&Ò22rn,ªA¸óO¡%°–À5Ì}ÑOˆi\\o£5ˆ]\\æ¸u%:ŒÂ@‡e,#L³ÀÄ#¦½¢ä~&/8¤éåYG\n¥5Žª\$£‘E‹XòprD.;¦¸sH!¥T¨#–XX±b5d;í¬?“\"\0è#ãÔ×çŸ`ó£¾åüŒ2\\ @ÞBc\nOg‰gUÚÍK QahDáî\"(Ãh‹6‚ß–‰\n­u\rbÖ‡’Z„p·^RüNR¨ó51ƒt‚#žn¨øYCŸfµ.Š§âWÅ<\n`×µ PIJÎhØ…6æ_dpÍŒ®2\rGŽ-Äþ¼â‚ÿÍõ‚à-k°´nƒ\"€\$W(Q(ÒauèÒÝ¶|›ŒTëK:JÄ>PÅ3•tƒ>f˜6‡\ràìQdÆ ô5C†äR‰‹ì‰€ž{\0Úº¤¦OBÜ% ";
            break;
        case "pt":
            $g = "T2›DŒÊr:OFø(J.™„0Q9†£7ˆj‘ÀÞs9°Õ§c)°@e7&‚2f4˜ÍSIÈÞ.&Ó	¸Ñ6°Ô'ƒI¶2d—ÌfsXÌl@%9§jTÒl 7Eã&Z!Î8†Ìh5\rÇQØÂz4›ÁFó‘¤Îi7M‘ZÔž»	&))„ç8&›Ì†™ŽX\n\$›Žpy­ò1~4× \"‘–ï^Î&ó¨€Ða’V#'¬¨Ùž2œÄHÉÔàd0ÂvfŒÎÏ¯œÎ²ÍÁÈÂâK\$ðSy¸éxáË`†\\[\rOZãôx¼»ÆNë-Ò&À¢ž¢ðgM”[Æ<“‹7ÏESž<ªn5›çstœä›IÀˆÜ°l0Ê)\r‹T:\"m²<„#¬0æ;®ƒ\"p(.\0ÌÔC#«&©äÃ/ÈK\$a–°R ©ªª`@5(LÃ4œcÈš)ÈÒ6Qº`7\r*Cd8\$­«žõ¡jCŒ‹CjPå§ã”r!/\nê¹\nN ÊãŒ¯ˆÊñ%r‹2ßÀê‚\\–¥BžÙC3R¹k‹\$œ	ŒËŠ1-¢[„\r@íÄ„ò éT”ŠÌT\$A#2JéD'Ò½@PÒ€ŠçJÎ0š€®”‹”‚2t¨ ŒƒjðƒÁ|ýAƒœºAƒÆƒ\$:°C;#¢~:Ö°ŠA\nC Xˆ ÐÎŒÁèD4ƒ à9‡Ax^;ÛtmU\rÈ8\\ºázPŽ•2á (Ìè@¼Ë¢xç¹¡à^0‡ÉÀ¦’Œ£ìåS3â>ñ9M‹Åb²°Ä±lk”•+ÑÎ Æ&8J¼9a˜pœ7ŽÈÌºÏ¶€P®–HpÎŠ£ @1(H–åù‹bcxØ:¯1Ò=œLNt´¸²pÆÎÉÎr2 ØŠ„çŒkˆ2Ãc¨Ù-ÙÜ¿µøšÇˆÙã­fõ@Ó±Å(  ›xk8¸cfáV\rƒ{½‰öLÚãFú;bƒ9ÒüóU!)Êvž§õkg9®BÆŒ[Ø“W­z&Ç\rÚx7)\0¦(‰€SïC;´Çâø’[ACôÄm(u8ÌØ9îo†ºã]¬r\"öƒª‚PeBõûSZ4ˆÚï(	#lÁ8Â(ñç±ýºV–×¬(_u¾%\"OO{ßLîI(jî3FÒ¥8Þ3Ï]Âœ •Àå2i°*\rêzQ’ªÜØ‡0ÌÕu.æIež(\0C8a/Ìþ³EÀ±((`¥úðÖJ\0C\naH#A@ìPYHÀM’£”K×³V%…ÄÕæ’WÔCú2ä%ûÓps²WÌ›““N~\r’õ%¨y]*…ÀAÖ[Q2IV,ÓL´’ÔZËam-Àî·•J«@+‘sà^RÊøŒÀˆFƒry×Òü_Ð¾•ÀàMQ°aYh=\r!ÄØ§5ˆ¡4ÃCÅŒ„Ð©~Žæu,ÅšÕZëem­Õ¿—r\\«9’„êsWjïy¡À×Ãxâ“x IËÅ7ý×šHØž’€èN	²\$…´¨BH@˜R£9å¸ÃÄd­£P XM— yg’s.!šCD(‡É4\n‚ka´}Rq‘’Ø•†ÉŠEŒ¸hF2u¹\0œJB!x’vKÄ@PA¯PÜ PTI'+ÈÄÅ‡2<	 lF‡5p†3žÊ¥qxæ¼3B:­\r‘½V\rÉŸ³¨N|äbN<Œ—ˆN(aHa~„ÍyÕHºH4›ÐP8,IºæQ¼&R¨»-I›LÌr¤à(œ3œQ²(%¢¼cžq#¤Â\$¤W1‹HP­Ô6ÈN’!–É¦b„’\$M\"H(,‰’†\\°éney\rb£Þ?¡º¡úàà…CA@'…0¨¯*q<N®¼t¬ç* K¡:²\\oœÛ‰­!†±8vbÌìÃ©Ç07L•©\"o4U¥Ì\"	HÑ²»EÙÏ:4ò<.*O¢zËŠ+Ï–5ÔøÖÐäI84äÙ0«EcÁj.N7œÐÂp \n¡@\"¨n½Ù&[¾£'?ºlñ±ûÒÂ,bŠUž2ufKO\r¡²˜¶¼^Ii¬bÌ¢fÈbéJÄ¦à{„pZ¾\r!á.*žŽ`°šT‚pð‘ëÞªç­ûÏØæ×X«RøˆŠ=c•†]r‡O,UGÆíR€V†e’—Ä`Š@\n\nÄ™r ¥I¹JÐœT£Ó¦¡}Ÿè¨\0¤ó\\ëQ(Ù#*„èÜUÆg!°0ÒGa3!\njE/³—C]!!%Ò…ÝãºÃ”¢«ƒreÖleÄ¨2‡|„fs8Äë4#‘†#\\á1fîÄÇÒE¤UÅ×.´T6¥^–”1íšÿœ ‡rÐ=Î'·A‡M7EC‘Ô˜¤Ùêò`ê¤µ9Ð\$¼³É™Ei¸r+ØÜ—&×Ì\\7SD‘¥D¡ñtKR\nHã]à¨BH\rÌº §Û[pyô|ôŸò2^m\"²jèåšòÂÍ2z\rìÍ—oA‹NnêJeq€¬Hò²÷žÞD3&7^€K9€[¬¿oÜŠ~õà[ß‚pj¶Eg‚!ˆüÕ’ÌŸÃ‰a8f‘K}*@âI·ãmáç0ÿðhoP÷¦éjÉì‰ò~Ê£É²j<´Áròpô¹ÆpkÎ²)(Õ¡Ê1¥,ñô‚™N¹—P,«U\$n}m¸@Ddï(¥&U	—Uq]v«ÐîCo=!ã Û~ÂS,M„ÇDEAÏ‰coá ›®ð”BzÀeÕ¨åk‚cÂ)‹V®O:ñ3hIñ\$>ˆ¬”f\"ÆaW|é¨î™O3£/=…ç­fCå˜ÁŽô¾ƒ2N\"WéosÄ7Ú4dý‹ÑtAF±/CÌJ”!6	¼†ßLu¢î?þObˆÁÆ9ù›7S:E4~˜A^¡‰qp¨ŽÊ:Ò÷ù/Þ½Ð\n9ëˆ\rà¦ô%üa‹=%¥Xc¢4„g	Bb8úá¶ŽõïæýïìªO¸óæÏ'|DBJôn|Lôÿð~•Cõ0ÔçÌMòæn>çpà\$|î*Èná06áŽRßÐ>â/ð|ãdšn,4+”5\rRïfT*Ã¦ò/Hþp05-Uèñ.õPxÕ\na€Áp ô©r9†v/,BMbì„†+Í@—Ã6;ÇIÀæ(Ãfü–Fð|/âjDüm\$\$é\0 ntgKÙ\n.®¡â¶²íìñå  âP`KMS‹“°k	\rXG/X´pâÔmF¿ÍhüÄr\nÄô ‚qioå±\"õÏögp%¦(0CÒÙ\$çñH(*û¨Š±S2ÔB[Él.M¢…‘Rh¢DkÇ\"(¦p+úåTb2ËIHàÃŒØê²(±jþ1O-‘†•P,ó1”:‘¤ñð–qVvKvlN¢Ô1ºÒª%-•Ç®CQÀ;nÆÑ—ï¾#Åk\$2PÌúèˆQàaThÂWÐvŽq÷°õæ_òÑ%q;JÛ!0õð² %b)\"·P#a‘{Á\"R@gí\\.Ía 6ÖÂ[rS\$ÅYc!‚[\$ ÎÖO†¿&rT'\"gñhiCæÚg^M’4ó «(D•‘X'ŽyE)2`@0ÀÐÎ Þ¡äráJ²ÖéGŒf‘ÜÇ‡¯I²ÀmŒp6O|òIŠfêÀeÃô•Ã/oŒ1æhX#7HáòNFx¤h<@Øjø\r&æHDˆ€Ä^B3ŒãÂNñ@Â¦êE‡,\r¤<Aƒ¦@ª\n€Œ q\rF¢1fTäPBàk‚é(Tæ0êªSZéî.š#„xNª­¬Q'%w±1€òñ¬Èù¯k&Rƒ)Ó²çä\rr•Ì ‚ô‡ŽBÊË`eÅâx‘D	“®<ë(HÑÁtjâŠÂ®JË#ãæK²Ôc†Œç @ýÜ1Âƒ…N6SØCBè'p(QC~„Ð6PŒ0ˆ@j(îÜš{,Ó?D¬˜‹?ìÎ5ô‰š„\0ÞžUSBÏMAks&Ô6&àLäþx¢°D“ØÀïn¾ïÔÃGŠpËðQÐÐ ÇÄ]#¬#\$òÃ:óMä\"Œtm¤Bºô2Ì%N/\$1ì†.§Tñ³¢Ñsæu<ˆÁp`¬Öær‡J î.§!\0ë’ÖJ*sM?e	-pvt@Ï?`";
            break;
        case "pt-br":
            $g = "V7˜Øj¡ÐÊmÌ§(1èÂ?	EÃ30€æ\n'0Ôfñ\rR 8Îg6´ìe6¦ã±¤ÂrG%ç©¤ìoŠ†i„ÜhŽXjÁ¤Û2LŽSI´pá6šN†šLv>%9§\$\\Ön 7F£†Z)Î\r9†Ìh5\rÇQØÂz4›ÁFó‘¤Îi7M‘‹ªË„&)A„ç9\"™*RðQ\$Üs…šNXHÞÓfƒˆF[ý˜å\"œ–MçQ Ã'°S¯²ÓfÊs‚Ç§!†\r4gà¸½¬ä§‚»føæÎLªo7TÍÇY|«%Š7RA\\¾i”A€Ì_f³¦Ÿ·¯ÀÁDIA—›\$äóÐQTç”*›fãyÜÜ•M8äœˆóÇ;ÊKnØŽˆ³v¡‰9ŽëàÈœŠà@35ðÐêÌªz7­ÂÈƒ2æk«\nÚº¦„R†Ï4	È†0Œ‰XÂ\r)qŒÌ¨‘\$	Ct9Žªú½#%ÐÚ…¤O\\ç(”v!0Rò\nC,rã+æ÷/±ØˆÏ¸Žò°˜¦ÐÄÚ„\\55ÄéXæ¼²éÈ˜Ï±H¸§> ñØ¦…¥ªK6ûI%–í¥mp!A\$J\"+£+3b`Þ¿¿êxäžÉZ#\"£P¦SpþA²@áA£Æ…\$oH@0Ä0ÅHŽê’€:Ö0’G\nŽC X•ÀÐÑŒÁèD4ƒ à9‡Ax^;ÛtqS¡arø3…éX^8Bv È„JÀ|£´nøÜ3/‰ê¦èxÂ8ÏhÇ<:­ê’‹‰©Êê¶ï-€:ÊÕ ØƒSZ’#xV‚4Ø>'\rêüºÒ¼«Ð®—ÏJ.Œ\0Ä< ÀNI“e\r¸!ã`êÀÇ‰_1º2ÒôËmžè£‚\r€ù¨j˜Æ½=àë…áÌê2Ñ­öè2‚6fa”ñV]R:Æ´‹Š\r8Ç„2‰£š!a\0Ø€°@PŸbÇLÜsž¶èS£¨OjFÔ\n\$‚ÄëÐƒ¯b:°Ø”±S{¼9ŒiöoP*¢˜¢&L[Ä>îc( áh[«HDÍsâ\\ôÚ9í ‡2ôýLv\"õ|GÑtM'Òl)°Ò6#Ëü¢\$µƒ(\"7Õ¥É‡ÆUßCÛÊ\" „vw1}_ŒÞÍµMb^ï\rã0Ì60+Œ0³IÐÞ §ÃÌBËŽµ›n9ŒÚ^ÕM¼;Ë÷#?ÐÌqdª`PPÁI9\n¼5’°@Â˜RË¸;7ÈRAp RÄ´ê‘Åà§ÚY//&Ä»3òÎyÉ)½dÆ…\$£\$o`Q®?Fâ¢îƒ8 T«p9,vŽeÊ£iY&µf,å ´–¢Ö[Ým*gÊ€Öúá\rÀ¼¤˜çÁ>Š¦øô¯Uî¾I…,ÀÍ#€Â±Ð‚C¤Áµ†vžQü„ª‰ó\0 šc˜bÂBˆXÃFCF…ÖBÊˆ«=h­5ªµÖÊÛ‰ëx9.ÄbÐ]©àk	¢ð>N&á'‡B€ÉC£ì§}©å@¨Ž1»/†ý\\ˆÂŠÑøe6êšàÄîÌœ'A ï+(®ë‡…i9AôžÉCf0µZ?Gí`\n½“ÇÅ“Ã¼ÝÉÑ%Á°Ç™Â8œNç@Œ(ÔD®)†E’X\0 ‚xS¤€RJ‹232AÌ²N±ÐT!ŒéC™BH\r›»6Ì•Xƒ„«»‡?©xœŸDRp„pÀAQCÃ1!gxáJÕÈB—tÔ]ÁÁ`G¥Í0c\r\0€¨†u¡0äô×(~:…©6—ñÞ(E£NŠtðR\$¦*I\rˆ]S Ê&p›“\nw	“TÝ	\$T<š´HUa%r€à›ƒFÚ24ä\"Äù¨ÃkDxá.@ÏB€O\naQ\\˜¥\$OSº”+—Ìèd¤8˜œ6úG*õWŽŠÞ¯š2¦]›ü?H1¹+Q¹6jjó?æíµ£‹)-áË’	ˆn…0â\\0Tž\$ù’”ea)+Qó¬AÈ“ 6^k‰:&4Äú»ÆR.ÑÜ<\\œ<'\0ª A\n·\\ÐˆB`Eºda1«“žÌ™£Iíü(ñ†(¤éæo„ø 6àà×¥‚¤2MLÀ“\0àiÊ)GŽÌe´«*‹~íê·Wa¤<¤ºQíêR.‰\$J;Š¥!T€Ú·ü\rxiVõÚ3/–¤öp¦z]ä9üDèÒŠ{,Õ„æ”B´\"(dœÏ½LVv‚±bp¬©6­Ø(ý\\N#;ç‰XJiÿVŽQñöJ!Ðê>BñÙˆa£dèÅ˜ÔüCÓPfµËAò¤Ã†mê»%qƒèúC'1Ý†M¼À—­peà(+òÅ—`lGcFÒ­+\r\$ºD6òüAÏ[0	Î©‹å¡ñ\0C¸yØ08pc):/¡ž»‡\".×/¡Õ<¥ûR€  T	ò¢mF\0005ÂZo@PF^&ûó¤cž¡'h]ºLJLC:TP*†h/¨-ïÖ\\¬(£Ô@\$pÀœ÷àÂÑÛ+å¥•š68iÙS%ÜÉðÓâC ’7†Ìë3,}Êi7a2Ç¹JàÌ6ý~,›ÌÅÝíº·Á¦H“'~/òr§1ÉöÐ§üŠ8!/',®ï\nüê	Ol|\\4t¿*Æþã›½¥§Ò,yäq˜Ürk-5›¹æ[ÑL”b¤hé’²¬ê“2¼ÎêAËMdÎº.ŒSe‰÷Mòã’´\$CÒ\$#‡…B—ÅH‹ÊùUë‰˜pÊ¤ÛÔçg¾võyXi¡q¡Ì¤ây˜\rÃ&Ò¬ \rÚ‚B|bÌ¾´|—mž×¢&'ØŽÇPÞRF×‚“†Ýã·<òFû*æ\rûåØÞùMkÃ\r3.‚ 'z\\zBTù>Â~¬Æù4`˜œ0öywA{b™}ÕâRgÖ\0¢(LÞ1mfŒÜ.@Èšùë4áÂM‘àÑ±ÕÄ¼©ß]ð®÷×k½0½|¢øË‚y¸Ðš1ÁòyD}É¨f½ÔŽŠßØÍï¸*Ç‚›¸Iì&Â¬RŒ0öì8÷OS\0LF÷ÃF?„žöPÄì.÷Æz%ÐÄ'žÅ\nþ<÷OÍ¥÷ÀÃ\0ï-çc/]¯?Ç]M*óí4'ƒ(\nM|0.ã.€CDñãNVíöò­ý~ÞNg-îó#pá*›¯S#`Ó«\n¸¤­PÂPšÓh4¸m>Œ°\\÷0¬ð±\nˆÔ§/\nÎjf&f1Æþ/?çl,Í&RBN!ÂëJh6âŽ ¤z\råŽG)f0î²DOêý‚TRé{\r/ò–%%Cø9Â8Ýnm÷¥ö°Q\0îÑ·ÐœÓµ\nDvözÁ\$?‹ö2J2skæÄ‘\rl&Ï¬w°;ñ`0¯]gû\0A£;Ð,ÂMŽµÌvòàŠØJðH'0?Ï4öð^—Q–TQš÷ð,òÆ\r:±‹F^uˆ5ƒ*,!Zjmr(Æ^ŒÅH#Œž’Íø¾Ï˜P‡6±jÛ±‘0/PmD­ñæõ¯%Pê¦jïÈÑ#ª¾ì\\2HL/Q‚~¢Ã ±ƒ!\nŸ!oæoâìùfþ²ÂùÏRPbh `Ýð©Ð¿#Ä’RBµñ}RM\$EñŸ\nÒ¬R?%/§“&’O%\$vñ ©²FÉ°JõR%oQ&b¦fÑƒ)\"õ'ÍFÔ²ƒoU)æÓ&ãR¦Õ’«ï€òÇ8bb`\n’¨3mPÄÅ+C6\n‚fÑ¶h.Ù%„që(R±.—R¥.Òå+‘ª' 1ÀÐK‘úfòBKÂ2§‚KÇÒer\$Åï|abƒ\rÒÅ©šHÜ1\"¡ÎeæÖ¾¢\"d±”#0nà2†V*CCð~ß³'5.ò\$¬!•\0„l< Øjâ\r&Ð\"ÀÞEÚ#’.CEÉ\ns1@ZmbrËZ\r¤>A£¥ ª\n€Œ qæŽ2Hpãnó/|¶Î‰2PŽß,16#¾é0–áã\n#Â@\$DîŸêÄÃæ¨ªÏT÷„wê0\$¸1¯¼\"óŠ?¦ÊÇÀÖcô:Ã&¾Î,¦€ßtã8+|SKL]…&1L–\räp=-\\(e8ÐatabŒÀÃnå«o(pCqPÙ2â\nFfq¤J+tO>“ÆýìÂ)ºõcj7°1ˆhèÈÛ ƒF/YFb%|04^Ðr5£^;Ôx?àÞ¦*,ÂBí\0ËÃ«âD?Ap4,ÙE\0×Î¼½b~þŒ.Ë‹oí¾f vÈk8O`ì4só	øV@êDFÝJo=,ƒÊÃ(Ç\"û#6K³†2’ÅE£(`,Q\"bX§P4Àf\0á?ø@î/¥G%²l%ÍN®ã²GoRJª24Ggú/€Â";
            break;
        case "ro":
            $g = "S:›Ž†VBlÒ 9šLçS¡ˆƒÁBQpÌÍŽ¢	´@p:\$\"¸Üc‡œŒf˜ÒÈLšL§#©²>e„LÎÓ1p(/˜Ìæ¢i„ðiL†ÓIÌ@-	NdùéÆe9%´	‘È@n™hõ˜|ôX\nFC1 Ôl7AFsy°o9B&ã\rÙ†Ž7FÔ°É82`uøÙÎZ:LFSa–zE2`xHx(’n9ÌÌ¹Äg’IŽf;ÌÌÓ=,›ãfƒî¾oÞNÆœ©ž° :n§N,èh¦ð2YYéNû;Ò¹ÆÎê ˜AÌføìë×2ær'-KŸ£ë û!†{Ðù:<íÙ¸Î\nd& g-ð(˜¤0`P‚ÞŒ Pª7\rcpÞ;°)˜ä¼'¢#É-@2\ríü­1Ã€à¼+C„*9ŽëÀÈžˆË¨Þ„ ¨:Ã/a6¡îÂò2¡Ä´J©E\nâ„›,Jhèë°ãPÂž¿#Jh¼ÂéÂV9#÷ŠƒJA(0ñèÞ\r,+‚¼´Ñ¡9P“\"õ òøÚ.ÒÈàÁ/q¸) „ÛÊ#Œ£xÚ2ŽlÒ¦¹iÂ¤/Òø1G4=CÇc,zîiëþ¬À¢œŒ2®’t™Ì¬BpÌð\nºê0BÃ1T\nÏÐ,è˜7Œñºp8&j(ÝIHí(‚¥¯iœ/©ÐÚáÃã’µ*ªãšû#¼&ÁÂÃ»446Vz?Ä£ÈâX4<ƒ0z\r è8aÐ^Ž÷¨\\¥)•øä/8_Iñ¥pŒxD©Ãjðœ/c2ð¢ËîàxŒ!óšÊ²³ÐÎˆ2¥‚„P#¬¬†U‚hÞÌ¥ÉCÔò õ`WY.N4å.»\"É‰¨¿´\rbºœANûJ+Æãrö3Žh˜ÉDcC éc~5BT0ÌìåªÏÙ‚ò:ê¯\"a+¥ƒ\nC?1Lèˆ2ŒÛ0Ø­ËèëLãÓ¢# #Z4ÀC;É\\¼šª×K¾¾70î”AÂ°í[ÈÕÆµ;þ¦ò3©\r¦£®ø«E¨¼\r‰¶oµzÃ¤(‰\0ã¹ŽCÈÆŒnG9¼îŽM”\r9SWÊ6²wy§zëµcE9Vo“ÓD!­8ÎŠ~’‹ßåè<ºâÀ¢ƒtÞ¼Æø\$Íñ:\"o+æãoVnÊLàû“H„ézÕcBÊîÏHÛÓA±#jéD`Ì)=	\$˜¸¨ÍÂ¾(ÈÐ2%¢Ã1C\rŠàø.EÃ\n¹F(Å¨C¼@Á@s\$ô!…0¤Ž\0o\rjH„>BC¼À<(f‰ÃEª¢ØkÐ fœ1­z\r¢)Ñ	-0Îù&kí£ÓW—0 ]\r±u®ÕÞ¼WšõëÝb/¥øønè`¾1äôt1M‰±XŸ\rŠ¡!\$-RÄqŠ\\ˆ>+‡3®Ž¼]c&F#“ÐIèMB§ío°4LŽŸJN<0î0Æ5Ô»rð^KÑ{/…Š¾×ìq_áá“¸Á˜CäU?(úŠ‰NOç“ÃÛáª!W­a`1yÑ‘Ê¡‰Ï‰z‰r»/\rÄ÷”G°i;€m:S®ÉœBOí,0†i8c¢iXƒj´qÎßw	þ%CwKê•4ÈéLJ	jL¨X1fÔ4™#xuÚ0c æáH£Ù¬pÜ[JµÀÜ¯ç\nÔ8&ä4›´ÒßQN9+(¾Á°ï(Õ\n9Kª’*b¼îÚ\"Aá°–P¢pß¢BÁ›ÆŠ”âXÑW†¦ã°ÀÜH\nà“áÜä;XL×lçŸ)I³zF“14&Å£‘äºIYé­K…5´hrŽIc+\$q/šw&ƒQx1 â.M’\r--e>NIäuô(– ò=e}[0!Ž\r¡cŽrQ¾“%`0†¢†xS\n”Å²×4QO\$;\n…åÊ'’QH9 EªýáMfÌQ	I/ Ë}*L:ÅŽá.!iQ†Wµ(§	;Gô\nD¦°Œ¥Øo)KVÅp¦ë\nÚ97d°#@ G,<6D&Æ§âr‰Úûj¯(ƒ©ä¯ÀQÛ§ˆ´î3üKS¼Jh&ÆÆLÍóme€¦+æc|¬bÞÕXœó–>Îe7¢è‰¡œëÖ†Tñ\n¾­-¤„ÜC‡I0 ¯-\$üŸ³ú«ž{Û4f,½·*­0˜1í«\"8Fë‘Z¿áÊ¯ \$ö…µl/·\$?Ed’1,e­H¬EN‘½\r­êdñ P¬Læ{š*@ê`Ä¢Ã-‘	%@\$]ò¤€¢1{P&*çfLÞ_Óz©ÕöµËæA¯¬2L`é&\nÕ“y!nð†Cð~°™zÇ\\½³È•±Ìš?t6šž@nÃ(wNá–Ó2òáB¦ƒ.Æ|Ã‡‚ß+5=EïVêó¤C&»ø\ráÁâ3=e†[6=OH™PbfÖM+k²`˜«¤àVÁfÅä3à@\n>Ë\rÛ51‚œ2ãÎº¼ˆs06¬|—I‘Ùp(§q¹W½•&¯M„µ¼·²sòxE'm^¼4Õ¡Þq×¦‰‡g&€‚ Aa!×;eQ!·C‹1S\0ŽØ„É£\r˜ ÀØ·bÒ\0/‚´8æ~ÓÚ_%gÆ¸aËpÑrB^UZ‰ÅùxÄ®¡\0ž\\Lù€xæFGšRj¹ZPçL¥YUóN@®½Ohœs—Ñ	ì%ãÝ¡˜ ]Ê8o@»Ë«s4¥\"p\n}\r[Cò´ƒÃ»Ig‰Mßã²ÙÙ€eD©˜•¾îŽM>©gï©Ít#:/=é'É\nß¨uyâUkêç_»ÐÉÆ»ã.ž\n€L8ÓcÉ#gùî0eY/5ªÂA_9âÉ‡Ê³Æþ‘’§®(¯!	“7‘1Ï¶|>â{ºçZQšø&Û•ŸrhÔ?Æ+GÀ™¶‘õQCúG¬ýÐ-RÎ>Ñ-÷…_;Þ¼¾ù”ü9~ã?%,}ìåœ·Ä¿¯2ÆÀÅîÝiÆÔAäæ*B\$Ï\ntxo0ÂÀÒ„ÒR@êÀ§440†øU+zÁæÀÕ‚ÄÕêàÈÆéoÌ›¯ÐKB†Ö2þ¬üºMÚærÂdþ-¼K èg,t~lz¡oÄ®kþFï\rl’{…ªý‰ý‡(Ç,a¬|ûcXÆpˆxj'·ÎxÇ'ªyG®ûprø®¨l°n+P’úÃš0¯Ë\n0²%x2£¢0º”ºcì¦*íâJŽjèêÒgðÆ®p¡\0\rØì®ˆÜ\$FI£Sã\\ÇðÛp@kØ§¬Ð½ã¯\nÏ|4p°…‘ØÑ\$=PŸ°À½k÷0>J…é˜®¼šI¨ é®#€ÒQ&*ðÔ¡>M°DK…b h<<‘ZšÃÀ,cÄº]#\\\rÁŠc®;((©mZ&ì( [,äÇ1¸Î«-ý\rT¨ã¶×bxå„ÃM…&°3¤ðÔ¦¼sQ:¿Q?f]°¸ý¯qä­LË±êüp¿çØ4€@e‘æÔçßE\$s\"ýoÆÈj!\røXQ<ƒ.ßr\$Blûb”pes\"Íz¿CÁ#\rúÉl˜²HPò\$íH\$#¤Á†@ä;'*'æ2p£¦:¤8o(ÿ‡pp-ß„©/z÷ðw(#Âd’ˆü‘áò‘qú®qþÓ0Êòê Æe\$CÕ2’JŒ— H2\$ë‹+çŸ+ækPD&ÃÈ\$Q6/&øAW\rö  ÂAw)qîÇ2á.E%.’í)r§2öc2ærë.ñÞçq?g}0`Ç0¢.ÒÈ:ó22D³-2ñ¬ˆ…Ž}Ä´6àê“2«4\ry 'žþãno‹V!L\"rŠÌžÚ“_#q\"³g5Ä‡0M4’´8hTPÚstM²MîÕ%\"@Ä¾¦®6¹6S˜T³Ÿ6ÏÙ‚z\n³šà„Ç:þ' B§”ÑÒžõÃJ\nzˆ< Bfêb®@PÚ?eòÎˆK+…+°8®säN£>±Ê¨Xƒe~:&x†#\"&Æ ýÓ°ý’š:îlépëàƒ?\"µ…\rÎL5ÈXP Øk(w ×pÆÍž&…ª‚1<H\$r\r ê®c&©`@\n ¨ÀZ;i,î²i`ä­–¼EœëÎÁH\"McÞ|´‹4#‚<ªFi&0ÍÎF/ç\$&hvDðÏä|CÂ3G\nÿ4N#ë¤1b])“cè–#‹=;¢lšƒ‚,êá\n\"e,ºF–aN\"8¥XVâ”håP„\$êBjMÅXîßU1Ftý#+pÚ‰`äõó\r\$Á‹o:îÌûqS”,¸	Éõ7R‘í3ŒŠûã*)Ãh6Ã&†vMÍDñ½T-ç ‘ôXrj¦ÌcìFþd°KU|;®ˆsP›X¤¿Xì“†ô&#¤DGB2dÐg”6LŒ°‰p@žheðÖ/::&­E\"êÏ±ÖFã:sÌöJ	¢Bã‚8mã®~D‘d^E‚k•JÀÞ½ î/'‡.0 Ë2MÞoÂ;%c€mRÅ€@	\0t	 š@¦\n`";
            break;
        case "ru":
            $g = "ÐI4QbŠ\r ²h-Z(KA{‚„¢á™˜@s4°˜\$hÐX4móEÑFyAg‚ÊÚ†Š\nQBKW2)RöA@Âapz\0]NKWRi›Ay-]Ê!Ð&‚æ	­èp¤CE#©¢êµyl²Ÿ\n@N'R)û‰\0”	Nd*;AEJ’K¤–©îF°žÇ\$ÐVŠ&…'AAæ0¤@\nFC1 Ôl7c+ü&\"IšIÐ·˜ü>Ä¹Œ¤¥K,q¡Ï´Í.ÄÈu’9¢ê †ì¼LÒ¾¢,&²NsDšM‘‘˜ÞÞe!_Ìé‹Z­ÕG*„r;i¬«9Xƒàpdû‘‘÷'ËŒ6ky«}÷VÍì\nêP¤¢†Ø»N’3\0\$¤,°:)ºfó(nB>ä\$e´\n›«mz”û¸ËËÃ!0<=›–”ÁìS<¡lP…*ôEÁióä¦–°;î´(P1 W¥j¡tæ¬EŒB¨Ü5Ãxî7(ä9\rã’Ž\"# Â1#˜ÊƒxÊ9„hè‹Ž£€á*Ìã„º9Žò¨Èº“\nc³\n*JÒ\\ÇiT\$°ÉSè[ ³ŠÚ,¢D;Hdnú*Ë’êR-eÚ:hBÅª€Â0ÈS<Y1i«þå¸îfŒ®ï£8šºE<ÃÉv¶;A S»J\nþŒ’•“sA<Éxh‘õâˆä&„:Â±Ã•lDÆ9†&†¹=HíX¢ Ò9Ëcd¾¹¬¢7[¶üÉq\\(ð:£pæ4÷sÿV×51qcE´Âó!šx„-É0§X2ò¨‘‰“ß_!ªŠhõ•K„#*ú²ŸÃP#fBµ/Ä8Œ“ÎrZðÄìð(Íf³BÈ6#t¥0LS\$Í4MS`@0ŒcÇwÃ>w0K2Ü»/ŽãHè4\rã¬Î0„pç8NA`@j@ä2ŒÁèD4ƒ à9‡Ax^;ípÃ—æ2]*Œá}ÚêZ ä2áä\r²¬¿˜ŒÒ¨Û,ÞpxŒ!òê€È²<}ˆ¹ÓZå:TÚl@&.#	Ìxd³Á‘<!G5ùYZDÉ¡¬ÈlMÊ¿FƒvíÈ+©X¹Y;¯z4.`®0ŽCvb3£(ÈÕ§I¨ãyëõåøý—’Ä½ìÞ®Êi~Œ“KÊŸÐ!íÊ‡H#\$ƒê)Øe’ÃÔÎE5Vür=;Ô£\$ºÀåYT{];Òê|ð²!4ÉÙ8å¢)	‰>)b¦¯q ù‰{¤jÊFäªüD¨¨ˆç¤µIRÖ3Î©©Y\">„Å#\$>‰ Ðe4§Œo¹¸!¥-¬ejÈ—Ëª|ÄøÃ…½¢€Y‡=ÙŸÑ‚˜Q	€µÝžt HÉ%1%-Ì´S¢%BçMÕ¹÷]ÞjAd¨á\"mó­QîˆÁš3¸°Üéw:Òž,Ôv}'¬Ö’	ln‹Ìqˆ=sÜúI*Ê‚Îx§§xLFEiÃNÈÌ\$fL„t‰‡ðh»Xó!N¼ˆcQ½Ž@… cñ #*Æ•„ rH†Ù`–%\\HÏ™üX&	8²¨Ÿ*\"7Š-ö”èC š,(+%”ÆØ1ÈUgÝÈÌ3HHq*ƒXä\$döŸJd<\$ü¡•óIô!âåˆ0\\Wì¤QŽJ>™4O\$Õ…DD‡áŸ@º›ÉüXN6Œœæ%MN—q;\n)\rïF•9èM„\\÷Ÿ3.}½éŸ?ËÜÓ&2†kÊÉ³AæáÃ¡lf‡N:#9Š¬è(3¨ŸÚé(ÜÏžFÆ»s¸GáúŸ@¬4©bÆÂ˜RÀ¶˜¹#åC™	‰ŠÎœè˜\"rIHdx%HÀ¯(’W1ˆ^…q@R÷%PÈ1¼e.öŠ0Iì‚ h)-28ä«@hL¹˜3 äÕƒñ]á‘™µ€@Öšã^l\r‰²6fÐÛSl°Í¼97æ˜W tp­äZÐ\\;‰Tj–…!ª’}Ñl|(*x¦Ap Žq^8mZ/£ÜÊiáë!\"d\"˜7mYw ¥Ô¤¨ª(Bâ¡Ù9LMWKt.§\rŽ²\ru¯¶ÆÙ[;imv·7ä›’ë]«½x·–ö4Üˆ¥5=Sš)jAôÏ1†¸‡6­O©Œ-e5 ¶9Dw(HdD”G–\nœ/´(6ÚDD”,i\\or¥ÉAÚ|ëõx\r	}žZ%âHl\r€€1%ðà”«ðm¯0†eÙ_Ã˜ug¬ü3\\Vxgf8¡¥€@ÒÒúÜÆ@€1µ»­a\rÌºSÊ‘É:ŒC¯é[T4ILA1;6ý'ä5JX™™mÐ»¥KÈýH(hXú!û•\"Á\0(.@¤£„5âÌƒ¢h97µäC°i[ÁŸµØ™Úe\rí?\$ìg•Hm[:\n½„È÷Þ}º—êÁ…¹J™›¦ôºl”zò”›údjÍ73àAòF·\rÁÁ§5Þœ[¾(\r¤1äf`Û,Kúä1†Kª½Ì6	Ï9¹3É<†…B¦——ÞK\"&O¾~JIÛRZ·\$1Òê|Né*eîL±Jê’#\"T¦W#«´Ù0eˆ¿Ì!¢¡‚%D°ì!L ‰X °¶Ãð´6©n-PÄË#WiræQÚ¤³ôÖ'3.&fHÂ*?\0 Â˜TŠ‘¶‚Zj€TdË¢—è©ò|´XÏ`ÑVè^J¬»¥r&,soŽwªZÖrä«ròr}	|ô–ÐT¼›#ñ\"3aÄ)²ÒþÖ‰žrÊ}wnJàdQÉtç(,qF)r_IäH*€uÙ_’²qQSËÖi<gl¡°âéRŒ˜;‘Wˆì>½ÐÎt™Ñƒ\"²‰¼4||ª%ÏmˆÈŸôl‰ÀO˜¼/G½‡;c\"}ŸP=IÃr›!õ9©GÑÕm'¥WBF\"GÔÑ˜îaü.!9ÌHÆ\">}´PÿIr3¼Î:Z9{ê?vñåKèò,º±d‚«9¤Ø¥eCR‘¥¶•	ë£H¨àŸ#%‰BÿBÊãÔÿÉ@²4%ötdŒ\$CÏšûÒFêœ„ˆ®›…ˆ~‚\0(«dâäKú(\\	\0 ª‰lË%ôîZ.IvXé˜ßÎØ8pEÁ Ç¤§„\\#+â_M@e)µ#žôÈæaâî?i–v¨ž¾ZZÁ\0H.ß¨Æþî=ï¾ýOÄŒŒ¼ÓEòaÌdèúùê)Gƒè¾ewÛÐ¨çLóðXuOTti\rð‰ŽzP’–HÊ'Ì‡‚Ž0*t,6žK\\“BO	dê3É\"DøÊ˜Œ‡Yg^Z/Œ•bû„l™‰‚*ÅLÃÁUÆ/H&-.dhÐZî°/F¡ìn¼w%7\"Øí ˜ŒÎ*‡Þþ1x#%(¬	&¢2®<ÔyÂKJëIAîì)4ëˆA\n¡°XÉV,P1\0&2ù-Fa\"XÔ¥fö ‚\n€¨ †	¨á‡à8î—ŠÎ*2óFHòÂl\$á.¦BçãXí†PŠ® Ê\"GŽãy‹rµ‚@z;!q!Ò_gê%©Èáçvú…·Az·Ò|Î0	áÐ0a¤Gìá±à<r3Âº+ò:âäšbÂ.'£\$…êQ\"ÒâÇOÒ^!Ò<ŒÄnFå\$r,^¥jÓ¬Ü¨þ,h‘—­ß&B(ò‘%H¯*‰*Â:“jØ=Éï+1ÞŠæ0–’ªFÊÚ­C³,\"I,ro'’VCÒ¸‘ÈÎÍ)è(2Û’Þ€’»¨È†m@@²\"¡%\"\\&%„\\/‚ªï(ˆe%þ(²*\$(\"&\"Y ìR²è‡/!©'ÒÊFB?ó\$ñª2 RŽðRÅÀ‡-è€«g5±2§á//¢Cï1ávdßQÀônp)±þ{îäÇÚOÌÖzJÞ`Qb!‰'ð¢3Ðw	ŠŽChNo¤0o™0ò’w¢RþkæFðÇ;Ã°eDPœ¯Juˆ.³\$¢N“^…¬\nX/=óÚUZ‰©Jcè/å.ü3K?Pv“ü*”\0¾‘)@g³@£{@î§¢ƒÎi<¢6öï\\¢©G	1NU%Z‡T”±N~ÍÂ,Ú›'úÕˆ\0t(„¨ú\"0˜bì	)³ƒ[F±OBâdöOˆ¬Ða°øb-V\$/x‹§=Èw4\$äÄ'²UN!IC¸ÛSTƒâÏ\$4‡ˆ/mG¯pø†*roúæ¬3B#<SØœÆbíÒ÷	±óê­d30rŒ9'îý´É\0ôÍNT\0ó”‚@“ÊýÎL´ã?æ1#èÏ<…FHÿ@/éQ‰?P3`¸+d6‰c<¡CSÅ&TRB\0*‚XðèÈ4,õEO#,±–8'6\$­,“àAÕ=u(´òŸMM©Top=r/êëUa&ÓE>SQ	¥Vò­-õuTë…U/eXXU^c.3Ï…kLâÙYr‰Y¡|ò6òB›Ì:/,õ¼RÔÔ*2a\\‚…\\Å ê*§ÕÛSÇÁ#•å-ÕëõÕ_ý	@‘\"ëKÎBbØÂñŸNÏ’OñÛ\$=%šUu•‹x¸ê€&&ð§9`'æè²«§®S\"Lï“Ðþ\$ËyÑ¹*OÏ0i,“¦1aD+&£ž…:ˆ´Õ¦;\\¤A]ï3¬Nâ„ãòÃ\r‡c?ˆ5Q'\$«/Ãr»D3³ïMtOÊSY’Õ,OSk0íkƒ]YU!<e`öÉko@÷6ÑPù\\u'ö­m§c?p“èZY§ßn*Mvé\0¯oÕÛkõÃl2ûp–ú8¶ÏTï/5)lHË&s`—ow	P(éBwqÇUBì>¾a|{Žº(A\rtÂBBÐëšÌi4R4Q‹ŒS«pUÕˆ•¡m4×<·uU°Ýw·V×A—‡?·Š@w`—'M—+As\"Sú€QjSƒ­Èó×8v	H;Hc|VìAÕƒw“c±¼T	mihü˜ètU@AWt83µ%\0·!UÝp6ßSW%Oƒ×RÆOO:u…8\0=Ø€‚Ç!\nS¯ŠëØ(Ì8RÔ›Qtó{oNtX’×ûƒc“­ºÚc¥€–ë\0bo…2ÌÞ#­9€8A†T£CõÞuÅçB‰0#ß~Ö*N—“z·{w7}sÃ‰±E:H(µó]õùŠbš‚qJ!uó„tŸ^8µ¸º-6nHÛ‰W-g/‹q\\!xfWÄ1¸É2•BtCoŒ5sVWþÞµiA^`íYØ98¿l²¡øwx[ƒ¹à—¡\0âêµçmJPÇ{×Ü+_L“:³Þ+ssT¹%²#•U—˜0a¤Uw[÷e%Òï•·Û*Yô\"šQÝvynžs–<.§º\$cDÈQŽHÈ +fñ2m6Ù:¹gA6Á\$9['Á–UN¶øÁ*ÉVRs›™{_XH·ùÅ[ƒ»/Òì«¥4ir\r€VR©…”›¦‹ÂºäáEeD¸NËþÞçÐÀBÁ9®EÅ&R¬+ag]e¥^Ö ðÅLS@ª\nŠ¦”ðjÁcÐÕ22Ì2—hË£ˆM“UT/zBZç\"&jD`zMf„;“yÐxò&r2™p2E\rFž‰\$ù6\\5Ìßi©I	XLŽd|«8vŒÚV³;QTš„0á|üÔLònÎ·Â÷#\\Ã\nßû–N­àAÚDø-6Ó/1hÐùJËO­<Ós‚eúZè?³U…X *aX†:¶“ÃcjâéÅ}@ôãåYQ½¢h~cL.°óiÑŸ±Æ\r…­²T¡²ºŠâ˜Ü²K™cc³³÷³û›ºuIïíA»‰ÌÌ3—£³¢›Kµ»=C…Y›È­\rÖÝ„è./0µ«Ct9ICÁD^”¦@€®†+öEeÏÿVè”§í´z©ò¸h>ÌðÙ¬GXÚr&:Û# Áy¹ûdÛpÓ¦y\"Z(†þ›ß¶Äb)ÛïrËj¥¢d::›îúå„ú¶AÈ6tºìë5Ô/ù®IY|\nûP¦»;áª@ÞÄ¤í]—óx3…l¿’8'Bg‡Ã€<Gx)”255\r¼7å~¦ÊÁ";
            break;
        case "sk":
            $g = "N0›ÏFPü%ÌÂ˜(¦Ã]ç(a„@n2œ\ræC	ÈÒl7ÅÌ&ƒ‘…Š¥‰¦Á¤ÚÃP›\rÑhÑØÞl2›¦±•ˆ¾5›ÎrxdB\$r:ˆ\rFQ\0”æB”Ãâ18¹”Ë-9´¹H€0Œ†cA¨Øn8‚Ž)èÉDÍ&sLêb\nb¯M&}0èa1gæ³Ì¤«k02pQZ@Å_bÔ·‹Õò0 _0’’É¾’hÄÓ\rÒY§83™Nb¤„êpŽ/ÆƒN®þbœa±ùaWw’M\ræ¹+o;I”³ÁCv˜Í\0­ñ¿!À‹·ôF\"<Âlb¨XjØv&êg¦0•ì<šñ§“—zn5èÎæá”ä9\"iHˆ0¶ãæ¦ƒ{T‹ã¢×£C”8@Ã˜î‰Œ‰H¡\0oÚž>ód¥«z’=\nÜ1¹HÊ5©£š¢£*Š»j­+€P¤2¤ï`Æ2ºŒƒÆä¶Iøæ5˜eKX<ŽÈbæ6 Pˆ˜+Pú,ã@ÀP„º¦’à)ÅÌ`Ž2ãhÊ:32³jÀ'ˆA¦mÂ˜§Nh¤ð«¶Cpæ4óòR- I˜Û'\ncÊ³\$¨süžŽ@P ÏHElˆŸÀPÕ\$´À-²¬64ba?¨ƒœª*NMM%4µ-NœÅÀP‚2\r««üA0[Gp‚'#~9ÏãpÎà×”øÅ)ƒ¸Ò:\rõˆB–D.9`@\"É Ê3¡Ð:ƒ€æáxïw…ËårŒAr&3…éÈ_lÂÐÀ^)ÁðÚ‰©‹¨Ì‰½c¥\0007xÂ%\"´™)9Uä±*Ð«Øà<3`ê5Žˆ‚ôÍCs€\r	úù’VŠ#nÁ(¨'9	Ú4Ýr¨®ŽäÖRŒž5€N¡ ƒ ó£h:Z;!Ã¡ˆ](Æ\n’`%Í)ÎBPÒ\"êÖ„LV9¹(é+\\cê6AÕpë bC†(ÆÃ«ð1Ö¢Ï´îŠöùå%òøåCXÉéúzùP“d\\22@Pô¡+C‚à&%Öœ­©²ËY>9°×¾J»ÈØ65“‚˜9ŒcÜ‡\n\"e°¶¹Èô¸Ž‰²<Æmî³xÉ½Yk–ØÔõ™RcÖJàvE™b]êåTº^šì•/]šÛ­²pžµ¦²1“J¢HÛíb(ñö>~·~ååìeäU¬!{~—º•C³ª¨Æ7\"gJI)¼3`Ø®‰HOŠÈPªƒ&y!=a¸<‚ô°V1ªa™·‚@]òÞMt0†pÂ]A0hëÍ±†PPÁI)	Äe*Bt/MaÃ' €!…0¤p ‚GX˜­2˜ÁÃmmé„£Fr`ŒTÐUZÂÖCeT¤„;-‚äfƒ©)\n†€ü¸¡–JËVëÌÿ-äXŸƒK‹\"‹€.%È¹—Bê]‹¹x/%t½Wºù\rÀ½“6 Wø>‘¨ó°ÖTaD¬ððÂ·•Œ[+.¼š!Ä=b¸a%\$®Q‘Eø¶Ú	W¥´!•¾¸[D\\ë¥u®ÕÞ×Š¸ëØ9/…ôŸ	Ê’\09ƒçÔ	Ãj’Àù9&¥¨Fâ =a­‚¡3ýÚô˜Yj/²Rt’¢’\"Áˆ<”BjMÉÊIA ¦,Y“«hQxÿEÔÐCf6DR,xG	a<0ZKPÖOB*š\0c–­x½†ÄdeÙ}3ðž6ÐÉ’\0NEÈ‘^9ƒ_9Á×2Å1 È„NC²bôéQ°õGEm<`€èr‚#…,©²iM8e5-ö³jƒ#«\ráÝÃ¨x)D¡@ÔÅ¾Â GÌk?ÌÕ‘`æ…ü1?‹Q‚†ààØÖÂ–\0€;›Jj®C:çŸt4¦;êÉHB&îÝ <bë%¤¼˜ÁÈÍaÐ™Èžþš³sÇBÑÐ¬v/JaZ‡Êq)	\$,<™åyj'-jTöÐ[™Y™\0!øç!ëáüdÐÚž…\rJw<ð“Å0’PP	áL*1aB_ìÃ%<1:çó‚N”U³Vr>‘µ~RQPf.aÔâˆÐÊ­;hd	Ú(‹²ƒÓ@7—Å˜‹˜ \nnÖÙ‘ò˜bˆ°F\n@à†æ‚KŸd1AÖÑ4Ú¥Z‰HC¡=R0ÖOÈ…‡-DLäc“H\0PO	À€*…\0ˆB EÄ8Œ\"P˜qK3-§ †5&¨ìq“ÊÆˆP’ÍbJçÅÓ¡J¡YÆ‹éØ¤ˆñ;‡xð#È†ÍSz\"j¶Œ‘”IÖAxäÝ™D¶4c!Ýg-‚…ógð¨PÎ|-›†”æ\nÎc|óÈùå÷šžSÔ/Èàf|òzT(aCå¬7¬wK”'2Ij&\$ÆŸì*EŠp:NHý\0‘7ÉÔ~‘”ì©%ˆ8%Iiàž¢»•Rhó>Wd­B¡€f‡ô*ë†ª8œTDKˆs‚l&›0Ux|’HcÜ=r­ê+­‘)<EÁÝI÷\nÊõ‰0o§tœñv!Ë.®,<mðÈ€U@EÄý–n?’ŽXcÂaêáq}†DkX#ÁœÔ‡\$œ¨÷¬ß{õIM÷d×¡þowF6™•“^‚3K#B¢VD“‚©·Œ)+1wâï™:”Þê[f²¥l Aa [\rœ‚àU©X!ÁöUZ€¡Ù¤¥ÿ[v‚ÊóG3(\$5´Ã1FL'Fèe¨!³Æî¬\$aZ®²2¡Vñu8œê&½R†À'§;“ÙÔcƒê±œ2²“Ö³w\\Îi+¯–Õa{#¸ê©v¨ÍÒûy7\$=ÊÄS^ëØtÈ%%æŒ™wÉÙƒÔ&hjðË`{QñP4Ê 4tÏ;‚þSÍÒ<ƒO‡¡ð^™Ù@ÐSZŸ=ž(ùùSçÊ@Ü†IåŠ)Sd~û1CH>	GÆŸ ¥ÆblN':ƒ\$(²2¤QÓ—“ª„H›!ÿ¨¤I­åeè#E\"11S¸QqtÂ¥4¬ÿÜ}pHFãY¦Ö\$8Änr£\$¯Ö9`ì<\$Ö(-ªg	Ö&ã²#Ö bìCOÈLØJF+C¾ÖÊcpxFrO´;#vž!BMdÛp.\"Â6Î-‡ÐPÛB°0ð<Û-g~P`Ç'.Œ§ê(œ\"~HàÞáŠhZ¬(¤p”Wäœ„\0b À¤ G¸ƒ–¥ÎL‚G( ØIÀœÆhÊ#pº\r†d	¼A¤œlÍÈƒ®àŠ¦Jž!RD˜­MÈf@¦ÆÆªjx‡A`SÇJ@gÀyPtÍð\\øð{‡’ pV°†K¢`Í1ÐFDyÑ1\rðmgúQ‘­…P<\nm•è1Aü{Ñ/ðN=#ÃCn*†Eâùêd.²°q>ó¦‚ì¬ÐNÇAt\$±=¤¨.Ñ‚ôq>î‘ŠîÍï”âÑ›‘¡ñ¦ðpâõÏ`Š±°``ìÂ-æÞ¬0Cñ¬æ±ÔÂ‘ØÞñÜ±áqêÞZE1Ûîµ|±ÜàÞ\rFjIB,«¢!ljj`à­)Ò/i´b­X&dˆbf¨€i@à[Âfh2Ò<W2\"ÆíÍÉÒ§iØ(‡¼IRá-Æ*å˜#guD•Kž\"Ò*\"Äl+*b\$ñûíðÝE0f¡Bu°dg-ÚÕL’b¢³\"F¬Ú­®i±…jg’¯HÎR\r*ÆU+¨Ïr\n‡æ#,Ç¯-­,c¨ãB„(‘/+ð_Î2;òâ9qc+Qg.ëy.P †	.Ãž8'/†2gªä‰0òþx€Ã\08f¶P\$\\jà–\$Á}P’ÚªJEK'Qþ c¤¦&×q™ÒæØ2ÁÓQq=/‹…3añW,ñ@Ü€„†ö\r&e7OÙ6‘šÏLø(“xtó|ãòÖvó„øgÊ\$¦ž¦d–\rbzEr-5qÎqf\nd_:çQóo0q[;âs<2öë³\\ GžU3Í;‰1ƒ–@ó­<ó’k0¥ réÒ¶kë sÆ§QèÚ®ä8A9Gç:mô.mû+ÓY.³úU”Wr”ß”(ó1Y@s€~Ž?Ô@Ô>R\$ K²ý/-ª¥*RâAÓ·,%'ENGE}rµ@tcEnKF´-TPbF\$ÁC'N)qvÚ¯žr¯ÐI1DƒÓ@¼ÎhíXïTôf>P3BÙ¨@ŽïD5Ô¢ð¯_K®*oh	b@•#hä~\r‚‚Q «J'+J*2\$_âB9	 'ÍLŒ\"M€Ø`Öãòº&²ÁZ8Â‚[Æ@\"m:D~Dt(Ž ¿É´¯äŒ*ÔÄ€¨ÀZúEb6<ï0uŒXq%‘Ìñ\0ÛJìÝU\$%'QËÎïJâCVFžó\rõ\\öp~Â**ª\\#¢>Œˆ€ƒ&	µJÄœ\nÊn¢FIÃ_\0’ ¥†J)#dh‚C	°ÔŒÔdº’pìõª<Õ,	‹êh&m¾JµÐ/ƒÎj,å)Â4JdJ‡êÓ¤³Uìè†±0g<D˜ÌbÝ;c1‹å‚\rÆÇƒP.ÍÐŒnÊs'VSµPzÛ\"p5c@'©öˆ`ÞW-nC5ÿ)¨XŒÒ¯Yàó*æ+'‹­Iƒ¥?Ó¨\nË/+ªÑ£g’j¨ÈªPW#T5¤téžX ê¥|vKp~q\0‚&p¿jc\ndTM9#|u¬1†ë`‚ßZöÊl¶­KÏ]±8ò,¯lìµ2¶(Õ‡9üâ<6S«<\n¶v`¬Æ§enÎK‚	\0@š	 t\n`¦";
            break;
        case "sl":
            $g = "S:D‘–ib#L&ãHü%ÌÂ˜(6›à¦Ñ¸Âl7±WÆ“¡¤@d0\rðY”]0šŽÆXI¨Â ™›\r&³yÌé'”ÊÌ²Ñª%9¥äJ²nnÌSé‰†^ #!˜Ðj6Ž ¨!„ôn7‚£F“9¦<l‹IŽ†”Ù/*ÁL†QZ¨v¾¤Çc”øÒc—–MçQ Ã3Ž›àg#N\0Øe3™Nb	P€êp”@s†ƒNnæbËËÊfƒ”.ù«ÖÃèé†Pl5MBÖz67Q ­†»fnœ_îT9÷n3‚‰'£QŠ¡¾Œ§©Ø(ªp]/…Sq®ÐwäNG(Õ.St0œàFC~k#?9çü)ùÃâ9ŽèÐÈ—Š`æ4¡c<ý¼MÊ¨é¸Þ2\$ðšRžÁ÷%Jp@©*‰²^Á;Žô1!Ž¸Ö¹\r#‚øb”,0J`è:£¢øBÜ0ŽH`& ©„#Œ£xÚ2Žƒ’!*èËÃLÚ4Aòš+R¬°< #t7ÌMS¶\r­{J€¸hŠ_!ƒ\\LðÅLTÉA(\$iz³F(Ò›0¤ô*5£R<ÉÐl|h Œ“J¡.¾²Ðü?HÒ~0Œc5Ã8@›´/ƒäé ÐÅÓhÿ\0ŽC\$&í`Ê3¡Ð:ƒ€æáxïa…Íµ\$õÈÐÎÁá{ü9À^)ò2‚¸ã246¥#LÈã|—ºk«(ÂÃ¢Z\nxÖ0¤I0ô3µ£ Ä´Šh Ë%¶O\0ÎËŒŽ%õ~.K¢ì´‰Ã|3}R2`+ÈeBŠ„° Ä˜Ž€N*bãRçbØÀÓc˜Æâ%C`à2Œ`P©B\\•®c“œŒŒƒ-É<	š2ŽÈZÖãê6'úØ:ÏW+Ô¾Ã«Ê1ÐsÐ´2C­ã:Nº¾\rj0äž'N%44Ñ+#l˜ùø&A	\$h\"\rãeãE¥Š¦ˆàhzˆØ63’Ò(1¡nõÞÞŠbˆ˜µˆ89µvÁé6.=_*Š\rÚÒ*§Ú\rÏÈsÎ';nd£Ôõ¹ôó¼;\rñ+§ØD½\0éÑ`«¬ýËîbM}ÆƒK©§ZFlÅ1’¢3ÉÒ —‰ã%“>YpÞÉ[ƒpòÏLC­;OŒÚ8@-³&ûc\"Ú6˜Ý\$: !@æÄzíBAìåÝüˆb˜¤p ]§\\ÜB¶ƒmhé\0rƒÃY­ˆÊ(BnC›+:äx—…CyLÜ3ÊQ)ŽPcLˆœ¥ÕhcH*¸WJñ_,„±1nY)fà^}ñ%L‹LDº¨WâLÄØ¢#ÀKaV€Hôx@v-\nF=2KÂiñ )ug­b—Ñqz€0½[C%v¯UúÁXaÝb©t–HrYk42¦˜áòÔ`ø\$†Ðàe×àt‰ ù/\$°èªÐ¡[…’3ÔöY¢Bh0ÞsäQ×&áˆ’d”Ã;m©f¹ÕFâÈU-ýŽDãÕZ!š1‘G¼§–ƒápÚ*™hÈs),2ôÍId¼!Sz}\r\n\"ÅIü¡5ÐãOài\rVl°©;\0‚@P\0 ¤’:I”[°7¼—„4ÈT%ÐJ0Ë€Ê…Øt3f”ûª6þÃ¼ÿ~¤åB&ëIs.s«b‚Iãü§Ž<È8áÁø*å ¬ w4Žq¦Î®å­pbˆ„âbÏ„l :èÈ4’+<Š1œg€Ü)@¾‘\"AóÒ)“Ø«ØQ4!Ly-®B&LY'\r(QK¨`Ý\$M!› ¡Å¦à@a„ÑÞd€ÆH< ‡øÌÁGìN‰äßBó˜=p Â˜T€!iì†£®Æ3hÕž.”1A‰3=©V\0Úœ¤e9ÐØ\ny4… ²@m•-€Ä„Ê¿MH€&á*N¢…E6dþ°\$¥‰œxeÆè“³pZø\n:¡¡'¢ºš5\rð:–EÎuR‘Á¸²d²àá”Ì?Æ¶GÔjÝ[º4	¤…8ÒKuÉA»#Éöœ0 HØa<ÄšT³d\nð/Z.DŸ[èl£PP³L“%]L%ByçIáÜrÌçÝ\n@rØâ&y–dÃ|ÀdëåÊè\n—Y\0·¥ôõÈ˜RÒ^_UÆl!ro]gDê)²\n˜úzr	àtÄ8¬'‡2f¼@PZ”†Å¡…FeÎ#ÂOSÚC?ôË³, ,-ðä‰H½1ê-Ò-ÈÀJZyÈHPÀPî»%C\0/˜ùÝ#@“UÎa¯sFÈ·3Öõ]™Aš†§&¾Ü­à&&pÝlnHK“»”Õ8—ÆéxH¡Ða±8®É.BÙ£ã-ÉÈéÉ\0A5š9s.`(#-²S˜	ðo®ëÊÉ©lÙ<x%s™ôèœTxT\n!„€AWyöyTü‡\nB‰þ]äát<\"f½‹ãåa˜Cá&Î\$­Sh˜]¦v®ÏÌ±x¹( Ä1onH¢‚ Î§\$ÞPlÝ¬aÊ°	]»—o*}ÁC,Oëcî}ºœÙTCYswµ@]¼ƒ~ô“Ôønó¸÷Þý;£5Ó›ýÀÉÇ%Ü#…mþ¾7Ñ³ß“ÿnœñy©ÔMãHÃ¢2L\\=t&ûÒzîAÄ8ö~Lˆî(ñƒÁÂ¸; ÜQo*rx¹á&c|ÿ‘ìŽƒÍú!’èÜì…%N—Âziuéý©pÎuÒ:©’êûÑrtÒøÜI?=ÜŠÒâ@¼J(l ¾«{ÜJkåI‘ÏJ–~Z	y½¾»å8¶æSJO¢Æ\\:9àÒ1;1˜¯&à\"Lh{Î.j©]„_jïî(ŒùëÔÕµ3\nGù¯˜`KÚ›oø²ÈîTð®DÊ\rÕ¹†“ú~OP™RÅþòGŽT‹ÿÃeØÿv,\0°Vùy—•reùºàïÌåPaÛ¤±tH§É%’T&LXe]Q¢0—–ïhcØ©]¦´=3’tº3ôþÄ™þÐÿBìÿ„ô\nÂô-\\ÌìÜ@â(êN*r¨:E£\$h êe`ÆcènÂF#ÀR&¸ÄþÅ	@ùï¢¿D‰Â\nO(²!o¤E\0ûmXûð]íþäï¾5g€åPHÉXwçPÞïºPntï›¯¯¯B'Kr	btpƒ”	HpÀÔ&V\rn(àÝ®Ùíã	á	â\n+€%P«\nðlà\"æån\n\r.ÐœåPÅ\npÈ(pÍê¸0ÔÙî7\rË+\n\nkmEŒAêrœNTÝÍžƒ¬úÏëp°tÉÌCw‚ú°÷kgko°€tJrì§`H\"L6†¨7dÔ&Te‰B<#f‘ÑF0Êä]F6BJ	â¦.bl\$±V5°\"9ƒj™¬êå1P¹ñ6„AE»¦ØÒån=DIë°ÐÙ,ýaÎq†&ïÄŠ,î`Œô7qŠeŒÀ_éÿÐ°“QÌBGyÛpa1>æÐƒqÖÔ¤&(qÀ1Þ)oÊÍÑÑñ0nM‘:ûÄ5LÖòò(qìw+ ääÉ¦~%†bï†ZùNÌ	;\rc\rç\"HEÛ\n’ùÑÝ!mAnô”­’Y\$ò]q=%Œ(äâL|&¦Pg2Â±§%ävÒ%'€Öj€ÔóR%QNP.y†`É\0Ö&`Üp‘úúÞúR©*Ê1!0…²ºAò¾™1/+†â‡+Ò”ÁE\r*²È-&^þÛÒY.rm!Q1'&3†a(’Ý­^-'nö‹ê·²öÑSN2Ò=“0ÒÁ²øà3\$s(mXz“2ÐƒºG’\rr†Dó”'1.P/Q2’Í\$æ5¤ë%î?’XÉ¢x/cb-2i)«®žBøz ìuDÓ#.Á¢Ž Ø˜ÚêX\"Òésš3P»:NìS˜Â#5\r€fS’å0´Â\$Â_	„È·Œì\nrD?Ãvb³Gs×ñ9jIŽ2îP“Ó§>ÏzÞ3õ°çÂõÓóñ\r<f‘Æž¤š\r€V¶Óž0\n»ÉÎ£~·¢^Ë@”/¸¥#h\n ¨ÀZ±*ä&:ðv£>®3ŽƒE‘Þz“ûEí§;À«FDâñÚôb»‡*œsÆåƒ\"Â0#EöäC«qºOK¶/`Ì \nBìS…mIC	þ<dN€Ã|gNî±L%PŒ-Æøü+CB£%à˜\rë0Zãæ=æßMÂöT&P6,r6Ã‚F€†.Í.,Í2ÓìÈÉ4K¯ìPd©½NP¢5ââx- û'tâðwGu,2ã61Ã .©ºJM'T@o§Pƒh_ÌÄk¡Bgñb(ƒÀp,Ê\rÊüÀ­\0\"x«ÃÀœ°AVêáBÌÚ9…°ÉÌÑMB+Û@¬S€êG\0	õDn#¸m ‚-ç…=Oh¶/@ÔCZ0ˆ‚\"b¯ìì½é&6D2k\0ê•'S7ËÒ½r3RŒì© äã( ,.®OBòÑµÎÒ8Gcò·KÂ";
            break;
        case "sr":
            $g = "ÐJ4‚í ¸4P-Ak	@ÁÚ6Š\r¢€h/`ãðP”\\33`¦‚†h¦¡ÐE¤¢¾†Cš©\\fÑLJâ°¦‚þe_¤‰ÙDåeh¦àRÆ‚ù ·hQæ	™”jQŸÍÐñ*µ1a1˜CV³9Ôæ%9¨P	u6ccšUãPùíº/œAèBÀPÀb2£a¸às\$_ÅàTù²úI0Œ.\"uÌZîH‘™-á0ÕƒAcYXZç5åV\$Q´4«YŒiq—ÌÂc9m:¡MçQ Âv2ˆ\rÆñÀäi;M†S9”æ :q§!„éÁ:\r<ó¡„ÅËµÉ«èx­b¾˜’xš>Dšq„M«÷|];Ù´RT‰R×Ò”=q0ø!/kVÖ è‚NÚ)\nSü)·ãHÜ3¤<Å‰ÓšÚÆ¨2EÒH•2	»è×Š£pÖáŽãp@2ŽCÞ9(B#¬ï#›‚2\rîs„7Ž‰¦8FráŽc¼f2-dâš“²EâšD°ÌN·¡+1 –³¥ê§ˆ\"¬…&,ën² kBÖ€«ëÂÅ4 Š;XM ‰ò`ú&	Épµ”I‘u2QÜÈ§sÖ²>èk%;+\ry H±SÊI6!,¥ª,RÆÕ¶”ÆŒ#Lq NSFl\$„šd§@ä0¼–\0Pˆí»ÎX@´œ^7V®\rq]W(ðëÃ˜Ò7Ø«Z•+-ïý™7—ûXŒNH½*ÐªÒÈ_>\rR’)Jt@›.-ƒ:¨*ôd¹2Í	!?W§35PhLSÎùN·ƒëT# Û	Fy8rç!È¡\0Â1Œnu	áXn1G.î4»-Ü‚0¸²D”9`@cƒ@ä2ŒÁèD4ƒ à9‡Ax^;æpÃ`¤f3…ã(ÜÈãœ“%…áÐ\r±›ƒ	Ñ˜ÚëXãpxŒ!óDÆ3¬ý§L]Kjhÿ{#4TÐM\0‹¼³ý\\‹«QR¥¯YÁrÞÞÙË{38Ï'ûq ¢6Ê]}Ü¢¸Â9\rÐÎ‘„£\"Ï¼è`Æñê,ËÉñÛç\"—¼ÖºN§*É\$ûEóÍZ32ÚÆ ¥áj{W£\nùÔ=&P0Ž£d‚;#`ê2ÂºÆù­ÑÅ#ÊOä2n³?ììþö±*¢¾þÝÔÕ+Ø²uŽøÉ(&è–ìý¤?o;º³·Y0ÁÕMì›C>W´J<µ==ÁMóûéí	™¢òÊñ?éý¼(gbJIªT[ÄøƒÂ\\ÌÙ‹kH,0¢šO4©u¼½¢ÂV¨\n'‡Œò›rpÝÉ“qr«œŠ§TžºÛÚå¸6d<j›ð¤|f•Àt†‰¼oÂ¢ ”·4c£]M¦.Å ¤3ŠÝà•¤SÊ‹1/`ûA²ßD\$r\rb&Úó•@DD’\")µæd—CÃC\0)Ý#rnØS'W!˜3Æ\0ZÄò[Vt*óˆÓÃpyÕb‡VÃƒ3¹°7†t\$ÙtR(0†pÂ„ r‹ü7S®\n˜)-e±¦uNœÐHC\naH#A”Àˆ#b.ÍÕ¸¥‚êèyR!\"‘R×\r‰>5ˆl®ÂùmÊT7È¨ç´Ðå\"ØxgöR#DÖBÆŒ’ÖNÊY[-eìÅ™³Vo7YÐrgŒø£Åx‹EÓÙ¨!6¦ÕK[åˆžÂ#\0\\f>¸q`Èz„^*5,PXÊcaB	¨äëÍv‚ÐÙ/À4²t˜ÈÙ,çeL±—3dÍ»6g¹ævÏYúÂX‹d4VŽChp9aµŸIþ•¹Ï¨ŒeÇ@ÓÃ[KHÈÂDTTšøâYtU‰<Še–L[”Îm¨mçEÐ‚¨3Ë!ÓD4>@ bá°6\0ÄpC‚0šÕÇÍGRhRFºÉI,‹˜¹Ù:´‘ˆ&¨¡¥Þ‡2ÖfùLŒÑ.4=¢‰Bb]Kén‹‹C©àâ €(€¡f êì.)ŠµCjÙÞ‹¥!¬ŠhçÃ©Çä£˜\\rDAÐç´~Æë o÷\"U“)\\ƒI©µ1‘^ÖÄ`ÒÎ{i†Ê\\vZXn™Ž´&>ãƒ¹Úa¢§†ÎË+±Ø±Ü#¢×.£s²*©dšÁ·ýAÖñ Æ¹Ç©ÞÞbyR%P±¨kW/ð™—\n'd¢JÄ°sd­5\0 ’HCÌx¥Ç0RDÏªiÚ9ìœ8»ðæC22\r³n™°Ð‹ƒ”GV.ç\$s›Õ*rJ\n\"Öð¦-,g&xm'\"Z²WTd±e8LÖî¢ëT¥b2è,¡ª¡PÙÓÌC%WW³ÿ\"SÛvðÚˆ’r©%ÝËø‹Žœ”fìD1_`A Àf¸À€ä±ÀŒ-xa\rÎ84ÔÆ9\røí#€K×·Ja?‰’vVåj/¿4£%	ž O	À€*…\0ˆB E\0¢ˆ‘,<¶ÍR_'™*ÔâT,H\nÖ@€\"P˜uÎ»×¯p‰@¥.,Uyzdd·ó¸Å–l(Ù°EÏžaq_{\nµ{)7êeÔ10\0¼¶laù­æX(çÅVÞ%´*íÑ¾4R¶4ÔMÆk¢ÉcJÚõyLØÇYåý±†8isòS—­“‚!b\rn•\r°¡6ÖäjñÅ­*ü»Å¼9‡yØ¢Â¾=É8Ì0‰‹Ì“î&ó—É&*´½©uÀ9TÕë|’º†ÖBˆéÏÄ&)+\0uRh¹¥&nÚÛ_„8ÒpÞµ%êÑ%ö}È‰t.%7«–‚H'¶2~Ú†.e½Óì_,|0)†ôð-íA”Ï\0)†S—p.DUBê\r¨èÛ‚m¥ ¡s'V*4u‘…”ÝýÇÊ×u\\—ŽŠ	‚FŸCÑ¼B£)ê_×LBØH@ALMÄÌ(AŠ;{¾¢!¨­JSÂzŸ·¨‹bVýä/æ©<š%Ö!Ýq'37%.„*O9÷Péå¥4¬2›ÛÑúž½\r›R°,™Ø·Ùå¶Ù~·\\@‚Â@ Æ¾e8s‚ÅÆ”:ä˜}Ãò¬‡äƒÊû&Ö#§àAÃd…'1kC¨jp'´50À‚'i’)	˜)®JS*Æ*¦Dr†áÊ.àƒô* \\(¥®Çê™c¬Ñì+'†ªäpZ-ÃöÂ¬5P8&ál™H€T0tmn°}ÎÀ6ðXã0]£²ãbØõ0ãáÊîáj(PT·,¹	‚-0q\n\$ŠÐ¥1\r„Ê÷ð\rðo	ðIpÍ\np\rbêËŠ'Pù	ÐF[‘hÂ‚ñQñ 	*ÓdâF\$ªê‰h>¡­âÜ…¼)ÌàAÐs­ô%ú+ÂÀ-äÐ<.Dá¦v%&-±BNp„dâ&Ab­Z±ll/˜T¬ì1ryâHâQ\råØ‹­¦Ém¬{Ç­ÂCÈæ\",ß#ëQ©\0âÈlÖOôM®ÞPåžC„,tÌî&ÀÕfö(ëfìq\0ääLÔcpé±âìJ?¯,Ô1ö.1w«´çQòï'†¡Ð³±ìçò^Jïq.ËãM!2'!‘è€‚d‡±ðº­ÎÕè½!n[ÃX­G£:Z1ˆLßRP<ÍÈN,Ò.ÊÀVDd\n’#’^ß„ Œ¯Ó(N'#VÊ2(l%&äï'! úr€ö.Ð…±ü?ƒLOoHQe»Bà„g<áâ–×‹L=§ì>M»(Î˜3\rÎ]/”Ëñç²þH92ÔŒŽrÊRÞ&¯ÞâRfT2h*Ð½-n@ãj	²<âGß0:ã”ä3\n&²/*Ð/ƒr1’„r#2²*øFñ\$æ-s91ò,1’12kþIâ p-ý5Rÿ3¦Ð\"Å>P«qènp‰Ò~ŠÑñ	†Û6Má6¯ZäR©7a“Mþ»s{³~¬hVð8p53ñ </€~„ÔÂ,ó.äÒä#3´UÇ±íJÔóÃ%=<’1-Høs¿3æ„ºåh@1H lÍè*“öRÀ.Ž´úR¨3ñ>1ÓÈ\"QbdLäC3üˆÔ\0Ié›@gbr´+r¢'“@_1¯h_Ø‚b*ô-gÒ´âÚ¬/Ô!¦¾ä¢?®U=óÏ>3¼=ol÷DotH^q×*ñnýDØoÓ–nöL1é2#Y w(t…3×3.SIòJ#i>…KC´¬ÜÎ(Q°‡I4‚{0^<ô§<t¬ÞæèüÎkIsM2SÜ-‘L%ÏKS?1)Ž†£â»T×L¨NÛÏÜò´öü´ü=^Pè‰„FúCþLï›c´Â0~ÈÊ¬ÃëµOÀüGï4KJ’B\$Ã8;=sO\"5G:»#´·>òõˆRlÁxçüÞ‡ÖŒ(gON‚-ÎˆFØæO»>ÃÞ5f=§‘AâqX‡¥Wn†…#ñHÉ‚Î(oB\$è²ŽÎåtºµµ©‰X4¹[ÂŸTÔáJÕ`÷o\"‹Kñ 5ÕØtb{[qï>èE6aNÒ?Oto%Zñn5ŒÜ~_çH	ù¯^’!JÖ\"OŸ\\Ô›‹aV#U”ï<ôó8câ)Ö,@Hû•—XT‡cÖ!d¡)fðS”åLÎZïå^ua“5JÄIf-«bSÛJÄ©gC_ScBH°E>ÃTU8>TÇ7‚œÃÏŠQ“VQ°\$×µž ÐÜ{më<+jŒäè°ôÄ\rk3’r–¸è‘y£Ûl\$´T\$×d¡Q†ÓmÐ q®mP\$peå/(’ôS#0cGö+^LŽq:ó­p1p1älÑûpÃM †“@Øng4=ubÍBïRÂ¯I‡Nb„Í\r êÆëò¼Íh\n€Œ pWiÀÅd'\rS§JVÐÄ&ÊÂ¶ÿvkCkèJîVý¨<Ö®Ø—º´«’¨KJïEJJTFŒ\0	 ÞÅ`Ì/Š%·4C—<â¡fîP¬zCò©”ÞÂ²¨p,Ï)‡+rùŸ¬&0nwqÑ}ò[F‘ð1	wI({On,e¸T²dnœôŽôAv¿ïÞ3¡mgj×L'P„×¨Ü™b’4ÐÓ‚T{ð„RÊ0•ôg\"X¸.5¸ƒ˜7„˜'ƒ×Îuóf‡ƒXG!X:@´—„8À·R’î‰wTx4\$„%2VxR\\~’ÈÞè³­Ý‰µJõäý+Ñ8Üc>ŒÐå1³	TUc@\nÆ ê\r¶Ÿ:eTþ¢¬Énª‡ÎÊ˜1i5¢¶¥)ï±&'áŽ8/}d\n%“b\"t\nÛó‹-³“ØDî4²üî`ÞÓàî8ã¯[8gŽá@%Bà¦ì†w9men˜.`";
            break;
        case "ta":
            $g = "àW* øiÀ¯FÁ\\Hd_†«•Ðô+ÁBQpÌÌ 9‚¢Ðt\\U„«¤êô@‚W¡à(<É\\±”@1	| @(:œ\r†ó	S.WA•èhtå]†R&Êùœñ\\µÌéÓI`ºD®JÉ\$Ôé:º®TÏ X’³`«*ªÉúrj1k€,êÕ…z@%9«Ò5|–Udƒß jä¦¸ˆ¯CˆÈf4†ãÍ~ùL›âg²Éù”Úp:E5ûe&­Ö@.•î¬£ƒËqu­¢»ƒW[•è¬\"¿+@ñm´î\0µ«,-ô­Ò»[Ü×‹&ó¨€Ða;Dãx€àr4&Ã)œÊs<´!„éâ:\r?¡„Äö8\nRl‰¬Êüž¬Î[zR.ì<›ªË\nú¤8N\"ÀÑ0íêä†AN¬*ÚÃ…q`½Ã	&°BÎá%0dB•‘ªBÊ³­(BÖ¶nK‚æ*Îªä9QÜÄB›À4Ã:¾ä”ÂNr\$ƒÂÅ¢¯‘)2¬ª0©\n*Ã[È;Á\0Ê9Cxä¯³ü0ŽoÈ7½ïÞ:\$\ná5O„à9ŽóPÈàEÈŠ ˆ¯ŒR’ƒ´äZÄ©’\0éBnzÞéAêÄ¥¬J<>ãpæ4ãrŽ€K)T¶±Bð|%(D‹ëFF¸“\r,t©]T–jrõ¹°¢«DÉø¦:=KW-D4:\0´•È©]_¢4¤bçÂ-Ê,«W¨B¾G \rÃz‹Ä6ìO&ËrÌ¤Ê²pÞÝñÕŠ€I‰´GÄÎ=´´:2½éF6JrùZÒ{<¹­î„CM,ös|Ÿ8Ê7£-ÕB#öÿ=‹ûá5LÃv8ñSÙ<2Ô-ERTN6ˆ¶iJéáÍ‚\n·—\nq?bb˜ò9¾ãm–«ªÅ¢¬L©Ë\rÖ\ns;Â9hyz«Z•©Iâ¬ã¨+÷&aXÇJRR¥BÙ³ƒ¶Ñ¶Û™å½ÖEt¬–Itº­&E¶ðŠ[jŽándF§…Ä©@ Œƒl‘3„œêòOœõ>Æ1½õ“Êñ³pÅ8<C¸Òü»“ÀÂóOôä2\0yÓÊ3¡Ð:ƒ€æáxïß…Ê/7LátÔ3…ùP_?t„L\0|6ÍO3MCkí–xÂP›F×·0¤S`T†n¥©»záæ1\"˜pPÊR•ººU¥q~ë}^ßTC…}ÇÃ.òRNÖÌ|¨!i@bt‘À®~0I´‘ÄýRáÕ@4§/ôÜWS\rAª¥J#¥pªŸ‚W\ná„9äÉ%ˆÉ}³¡¡,`&õÀòá› ‡­©‚Îu:!BB!®¡‚pƒá9È+â>·6³Ûr'ŽÌ0‡PØž°a\rÔ2•ó„½ŸJº)J5Ã`êƒte„„å õîDW2–B`  †pÎìƒ;ÛT­3Ã´¤¸sH\\mð§–ôj¼¢gˆ±fGeüu‰ÓGi0	5èdIZ±e\\¥(IÈ	IËN,¢‡ØSß\"ÞÁ°6FHa\rÉ(„Â‘' “:[†æ3ø#%r’êDB\"Úä”xG°(ÒIóB¼ €®5¯Ñ\\¿Ø­—Ü]’2Mt¥6×ÜQ“‘VJ‰NÜTÒÒè\\¾ÆgÄ¢%‹y\\¨6tC§í)gq]ïÖ`.d\r,dêû ¤ø”‚ƒæ<Ý”­aÍÇß\$‰6¢3Ñ(\"Y¦ÒÂI§O*MxG J‚0M¾4CßiÕèêx¤ó‹=¢T7“êi7µ¼±JsúuMú1CX7ª&‡0	·¢ørGlîÂÃÄÃ0f\rŽ,àø~Í<\n¼ò½ ÜAorN]Ì†h¼\ngIÍÖ±w+ R@ ¯0áá‡Sî\n˜)+Á)… ŒR\r™†žs­u+æ4Z((@‚ädÂÌÓHsV¡Ê·ù!•š7Yèb(¶gWjtå‰åž`Gy¬£ŠE^Ze½.Q«i#\n¥ƒ¦\$¯C¾˜OƒØU¥Íp@âgu¡Rª0ÈãyÞvNÑÛ;‡tïóÀxN-5¼w’zsdQÉR½\0}xžÚI{¯}\0ÔánÕR­ZVIi0¢#Jm“U¢þØ–úYf¬­³ÌêXä˜à'\r¦¨jÐÔà}îÌyÎ­3€à]’ƒuÎÂé»Wnî]Û½wáÝà¸›¸ñƒ“ÈyL¡Pª;ÊôC˜>¤%Ó2 ézÁóUÒC3åŽÃkzÉõ3Ölm{e}ïD64¤	˜ˆ›RpdFÅ—È\\Ði|&Ö~`Ôlo–¼‰•ÑK@@pL÷	ŠÃ0Â°‚y­6·KZã^]ù>! ñ0ÂÅA\0cÃ8Ø4Æ çj\$²™R\0£2 ænÅr’-¡SÉ†oLx A@\$šÛ\$›„WL2Šu3W1?0Tëéƒ²‚¥x‘ÆŸÊyÏIë=¡–§°äûNÎšZðï¯E¶÷èTå’ÞÔ²‚!‘JÁrßZcµ~`vUèø:pæŸœÅzL§åëàá_CÍuPÌ;Ÿ Æ1Øiîß3ŸŒù bêq8¶G’ú?kNVCL\"OÈëklh5[Q\$3'f›¾2#.…]&ìá0•tnÒÂžKí–Ô\n(¾¸ÙfËòžßÈ†Õ`\\uLm;UË÷‹®<‰ŠðI#áäî8ÐÓÜ eXøýdc#@™4†Û‰ž%ÃÜ‰”1”4ãžö~=Çp†ý6¸<ÍŠëð¨…\0žÂ¢žëaµŽE4fmö7æpOì«¨¤‚6‚6G\0rùœÀlÍ>~µ–‚‹˜ƒ6ò¡ÊA&PÉ†.´<:W±Ú®oÛªŸ=—)” ”2ŠçòN^ô½tS§ÁSOK¨fi¿¯Iã¦1N„š}¨&1V“ê3§B¦îBM•ó—l–á‚xNT(@‚(\nù €\"P˜~ƒu•ñ¹>„u/Ê4¾\$­F¯×ÜkZ¿©EøYŸØ²gÒ¿“)Ô¥Ï*Rm__1ë-àFh§JL4¥d0EŽFCªš÷gÐ‘nlïf+â`Õ¡)PípQîP‰¯ònBk‰š`¤…¤I‰V±i²Éé€û© ÉïÒ^c\\ÙJÀÙˆêï‚|*r¥Éž¾0X“P£ôÿJà\$^Êî<fI@lÊfÚä0CÇÏ\n˜äÇÚþðQ	dxŸpPýe,¿PLž¯øîmP‘ÏÆáO\0ð œ‚Þ²N½Äb\0¬…\n?ãÞhbædBnbS\"ÎÓ&˜? è«#càY‹îÙã/ tÇCòM êÞ`@Ó<Ñ¦VT¦<8ä¶¾ôW°/£\0ƒät9®Fb~\nGfv@æ\r†øcx&ÏŒ\"+¨KÿÂ˜€¦\r ôŒ­b4êüŒ¦š=ˆâ×µ0œãFðqï\$t jæ†‘šX	ò*¢¢\0’\rÈÂ«hf\nmÞ4ÀÂ°L>ÄÎÐª·hf=@ÊéŠK°4,‰…Á\\‚ê…1 }jø0ã+žð\0ˆÑôæ°\rÑþòØ›Ä¨aÇæ£2 ¦ÉèJO*·rËOxŠ¥Ô‹:¤ò),²¬„ª¢è~€b\$ì¸G+úûéÂ•BZÆêÑ&ðŽ¡`ÊRP¨‘–3ÊÑ£dr+á,kõÛ¢~Ç²>Æ†R„,¥‰T´dm'0Þ ø}fÆÑø§•†ÌÚj¢òüÊeÂ®‘Â8Ïž\n€‚`‘¤êªÍ†O à×ÃîPr„Sp°AãíQè^2Z%/Ò9¢6†j1«c2>†èfí…ª÷îí,0¾F±èÖþ­.~î	p²\".:fç\"úu¨q2ÍKIÆ¿O-n§ä²€\\37ó]40ü®Û6³P„K°Ð‚Ž@3Y2®þûÈŽø\r«ò.›	þ…†fF¨\"‘8sí ˆpš\"‘w<I›°}s¢ï+Úîæ+Ó[-³,‹ã3éa83DãÓHAn?3¯6ä„²³)&s9>{134	¡;ð8³«AŽ?S´•Ó¸§q´B²€	`t`@M îŽ‰èVñƒGÎ+‹m!Øó¢ˆ(ÐDqJC\n:TN¬+vÁbE‚Š#FGJZÊ…4Ð‰?ìºGHò•Œ—Bp©\$S› “|ÒJnE(I^FžÙJ–üËá´RB0”HCPÌ³‚¦[4-¬¼_Dp\"¤©ËAŽ%ðý#j/MBÎp0Êã3Žˆp\\QoLNjÚˆM3zµÆ6PNCfð †=ˆXhmø_sÂGÇÛ=‡Ì8jo°„Ã˜%ÖnPS6Ó‘5K*KÙ4ðÒ‡3÷S•\0àÏUL»;’8\ngTsP¤‚Ò²nãEAôöÀ\rö‡uhŸ\n^•I\$sûBõg@ƒT#è/6(8^—:Õ‰YËyZ‹7µ§ST£>IåH5q[5K7¹@º¦ì‡4+å¾ <.´ÆþåxWÅ/FN1RÀP‹`Ì‹¨¾òÿF&ãFdbc\$Ò<#R”,ôRlNÓ_M!:/îFv'#Ì˜W5ß'W(¡tòþã[a9ó3bÂÆQõ©NŽ9S³Ñ]#dÓ/&‹8û¨—ere\0@\n€òÍPð©Ï¹2C¨'õA-*|¦¢©ÆcÎá%“›	µ\"4å*ê8™µeft	.ã%pwiuÝ4­eñßf3…\\Ôf–£fÔ-j0Z¾5o\\U•6“ýmU…,V¿?I¬±Ó¦€õ¯B»kª„¢Ê‹i6³jV·56ØŸ±•LJ©Ý-Škq©qõ£pÈ#qD¨w,ã2pVíY–¹Yè\"p\"¿*–ÕkdncO5pw^n4Žý1¦“—26O6	­6vþæ5JVúX3ur«%)Wv6¤Õ7V¡UÉXHˆws;\"wµ3ÕÌå´q\0‰ý<±H¶c{wT•MR÷²;{=nïHVÓYµÏs×ÕfÕ>VQDÕZ×O[émwí#VÏ2=hõÀC3~5Ë€6òÒeLÊ:WD˜ˆXhÒk0‹ãd²}Ò!%Ø]Ò1RÄ‚µvë~VïÎ¿\nç	7ÀQ\0ÌLæTsfùÒäÒ©&1P	äA¨Ñ8“ù?ûXtËÎÞ&O‚.¿‚´0û´%„TT´8!\$wó‰”‹{vp´â±ØYXÓº±ÏºfmL’•úùàƒgà²\n\0ŠÒ­%yÈŸ‡®¿‡ê¸†ÿ¨xÀ¯u}r9@‘õ]7ë]iP1˜%S\$§·ØûX,Ôx0ŸÉÄ}x‚u~ÔñâAHFð]p(z”‰€WTHY/×‡q˜“–ñV±Û”7M”ewsÝzw9p¹>€—ñC\$…-u7õÇò´™²º±ò¾i`Š< Ü+Y7k÷	[NC—¶¥—æÄfù…˜™{ôo–9™TåÿB#šéšllÒ¶çtƒpuƒ•·+p87¹¢QjÀ4€Q˜yÃšÔU™É›ÙØ¶ùážY‹œY]÷²«˜'\"Õ v‘b††ÒBø%&ýpÖn8ÉxÖ¢¿\r';Õê’¥¥|´ý™5=—ZJ—oy«ã™K›ë“÷]€7`¾94B•OvÙ¥r­v7•¹snš=·S[hÜŽÇž™Ifj)ÂatiÛt™#€§íiž_—š‰¨Îë©9q\\9ÉªŽeaÌ\n z‰iEboÁtWO§—!€y~º¬ùÇªu¥=[xµt{¬ú_mS§¹›®ò¬É¯«…©›#úó°naª*i®Y\rgGÊShWßT6µHyOTÊ»LÏ²`ËŸÚs«zç³U³ZÆž˜¸üYá³Ò©iÍ´è—±zq«[\"²MOðŒ÷Ø·²ºÓ”ÛKmƒ…&S}»wx(;œ×«ä…¸Xó·Wö)ã c´šý›[—·	\rÛ©÷ùZº‡ºò·;‰¯¹ºÿ—z\nûEì•¹Ó—ÕéŸ*U€rF©W*Ñ;K[y§{}¾Å¤ZÆ\\Uz/¾¯üjÛñ¸Ó©®‰¿Ñ4Y«á(ÜiS/û£½/~{ª+ÀNøšCSY¦É#R(­`sî£ã½p·@2½ª¥½>8Ó3z+›ƒV®·X€§—Q­w‘ÅÔke7½Æ8\rºJ˜Ôˆ3Mœô%¤—ÐÜ'õT»?¢\$-RkB‡OÆSwIéSÆÓ÷JsãnwSù»É2_~·É7±šÕ›”ÀÙWcèwÍwkY\0Ønª\r Æ\r`AOhÈÖÌv\rïÊÐtb¼ÏN\r±OÐÜO–\n€Œ pd+˜ñä“>™‰×ÜÒ\n7-üå«¶Vö9«Å‚RaÚéX\\×I·¹v]A²+ÔhCÔ²ýW–œ)ÝUºýÎÙ€Y‘ÉP´™\nkäýRAºßSÈE…°þ;è	½\r=Ua£÷e…àÊ\r¤BÄ¢+âm|•Ä‰ÕN;»f u½¾H7'ÕÙÜûU—ÌU†•V'T7E½\nÛcê?½ö(¨_ÁtLï÷jW‹ÐÕ±&æï8¸ZWv 4|a)²G×Ø.è¨îí–ys£š'åés/ñÅ|Wã)ÐAbc¹9ÐìY>UØiW¡Ëf”+™Žª;]²•¾Ù?â×;åIãœ-ÇU¶\n†F>¾<-êe\\þ5;‡·ó›æoƒ„„¿¨Ó{²[¤ûmÍ.:¾äãoƒ=Ÿý‰(â\0‘ç¾U ŠI'-\\‡vâ[ÖXóï(´MÀ@ÇdŒ»¬¶Pæ`ê ÛÚ×7S¼)\"¢~	þ qQwhfâ\\JÌC@S¤aÙ)àí¡‰åX„>	+œŠQBËëO…ªâ~\n€åäQÈhrš\"7…0ÒÇŒ\nv|ÖüAEÆÙ\$8¾Sü#¦^žTšŸæÊv@Þiàî=ï´ÿHŸÝ– hš¿X”—‰âþÊn˜J-þYû†áÅU÷þÎDà	\0t	 š@¦\n`";
            break;
        case "th":
            $g = "à\\! ˆMÀ¹@À0tD\0†Â \nX:&\0§€*à\n8Þ\0­	EÃ30‚/\0ZB (^\0µAàK…2\0ª•À&«‰bâ8¸KGàn‚ŒÄà	I”?J\\£)«Šbå.˜®)ˆ\\ò—S§®\"•¼s\0CÙWJ¤¶_6\\+eV¸6r¸JÃ©5kÒá´]ë³8õÄ@%9«9ªæ4·®fv2° #!˜Ðj6Ž5˜Æ:ïi\\ (µzÊ³y¾W eÂj‡\0MLrS«‚{q\0¼×§Ú|\\Iq	¾në[­Rã|¸”é¦›©ž7;ZÁá4	=j„¸´Þ.óùê°Y7Dƒ	ØÊ 7Ä‘¤ìi6LæS˜€èù£€È0Žxè4\r/èè0ŒOËÚ¶í‘p—²\0@«-±p¢BP¤,ã»JQpXD1’™«jCb¹2ÂÎ±;èó¤…—\$3€¸\$\rü6¹ÃÐ¼J±¶+šçº.º6»”Qó„Ÿ¨1ÚÚå`P¦ö#pÎ¬¢ª²P.åJVÝ!ëó\0ð0@Pª7\roˆî7(ä9\rã’°\"@`Â9½ã Þþ>xèpá8Ïã„î9ŽóˆÉ»iúØƒ+ÅÌÂ¿¶)Ã¤Œ6MJÔŸ¥1lY\$ºO*U @¤ÅÅ,ÇÓ£šœ8nƒx\\5²T(¢6/\n5’Œ8ç» ©BNÍH\\I1rlãH¼àÃ”ÄY;rò|¬¨ÕŒIMä&€‹3I £hð§¤Ë_ÈQÒB1£·,Ûnm1,µÈ;›,«dƒµE„;˜€&iüdÇà(UZÙb­§©!N’ P‰ÁÍ|N3hÝŒ½ìF89cc(ñÃ˜Ò7å0{ÉRÉIéF¬§ñ\$!-_H¡[–”Ž¨«+ùqƒ»÷\r”äÒsÐ…fŠLX\\5˜€_Î»6‘bw”¸v°»Ö;¥šÇMÊ ¯Öˆg˜çîn¾ál+†É›ÃN³*©œ¢ Œƒl«7ÔøøÏôáAŽSøÂ1ŒoæU+:ŒS»Þ;0;ÓÅ>t=9`@rC@ä2ŒÁèD4ƒ à9‡Ax^;öpÃ¾ïó”â3…ã(ÜÐÃEá\r³‹ß*ŒÓˆÛecpxŒ!ó‹}£®û··ëWÄÝ;u‚™2*Þ\nÀÕYûhòáÖÌ³c1öMäÕÆ!qLS¥?Û~…2vßsè8,ÈÓ£ôÆþ’9ÂY'n.Ap®Î°\n\ná„9äªÃ™!„˜å!¢\\Ð!ßK(p£AÐKš…f\$†sÑ¹kaÉ¸´²ÚËjN6Ï•´,•¦áâ'hpà‹F,êu\r‰ü;ØC+K&!‚œ„O	ÈX	\\õÕTÂ'ê`P•’lJê»_+|º\"c¶FŽ“…äüì¬‡Ñ\rÛBlÈ´žœ†ô¨ÚÊ¥+&>´9\ná÷.äíd“Õ0VØIqB+T•—ÆÚÖá]S¥vIPƒaþd\n\0001†Ý›Qj‹¥ 0¢Ú²*ˆex–ä*…å‹ï.ÉÀìÕWK\nLoue=ø_/ŸìvïÑ,ˆyH+Ï+*ÀŽË3æˆaJAŽh<õS\$DÀ.oqYµÉ¦J%°˜	I†Ü˜ãZ«}²*Îs‡5 ã€°:˜â³8”äE³˜\")·7fÔ/ŠohD°äAê‚‡¼7†`Ìúž‰)†(Ò\0ÍÑ¹\n¼ù<ðÜA\0ue!ÕÆ8àÍ\0l\rá*‡7D•(!œ0¥PAO,oÁ¸: PPÁK×‘,>ˆ[\0C\naH#AÃª\\j/;fÂ@žS<ŸµkeA0ÏÖ[Ñ*ásÑ§´ÙÎDm–9Ö…“¦0Y¬CØšëÍdÕÇ†p@ß*ntA–2 Èà!ëtî¥Õº×^ì]›µvö%Ý'xïzzcáÑè¼P}hž‚VzoT¬7ôUMO|h°ž¬’	^Íˆ§U5ÉG“•¸ÛÉëqlt~ºOÃxt‘du;o«’°SºdáºÚ€itê-Ñº[&êc®vÉÚwlîrnÎíÞ»öLÊS,x¯\$†Ðà~Ck¾–¬1»òæ Ùÿ<5¼µ\n›©5úYõåòÕ³\n‹êæ}¦VÚöY_fƒ‘v‘–0%b=áÁ7X+óÃfºJ–8×…Kå\r2¦‰±Ì sý†C˜a¿ €1Ý»ôbr¿:—Çœô5Xl/š“ é˜ÈkZ2B£Uð%N“¹ÁW‚€H\n\0€€RªP¤ÉVôÀC¹°“ö˜'(ª•pÙeéÃp\\ÿ#è}Áú°mÄCú‚SëŠÄ¼;ç´XžñcªçJ¬¤ª¸wÏ0\n¯É¹åŸ×\$Ô3§é±¼°Ü*+xN~\r‡t70iî°b,n{å-„¨>B<’úf)áV±ñåsÂXTêY*«ÒØ]Ž°¬«Œæ¹7nàM½R)u¤i\$..R¾+\$’‡“ÒàCLpŠß`]8qŠÍ?†dàl=èpu6:dž1¾€PÇïCàÊÆýs	p¬¢wÏ„[JÙ]'¥We‹‚ìi–æÎ!J¤™í,Æ¬ó0–ƒ›QY!BQ½.|,©æÙlüÜ‰‡\nÂU¿i:¬VƒJ„*„óíùJ›\r2vîGVê©[+Á\0fÏ €û¹ Œ2Ü¦ƒa¦û(J»w~äG¹9J±^–!3lDEí—åZs1ÁŒuÁ\n.Âp \n¡@\"¨{?i&^ß\nM­[^«8MÞ&×9ù›2N³špQdÕ„ò%LxY•#—ZN]¯Ö*Kˆ_\r8ô	¶­±X¤ÙTÒz}uê?îxPÔ_ŽÜdÌÓXiÒÁ¸ŸëÿÓUÝÿ¢²!\0Ñµ§Gí}\"Õ=¦ˆ˜©gÝ¯3n\rJò•¼\\P¯¿´Löš¾Ž_ü¡ðÚl\nó„ÿ_\$¦æ†µ¿/fpÅhËÙ*Z’lÁDd„þíà&A×)\rE†Ü£@_õµg-˜‰ìS8|JÐâ¢\nþ/ü(æœØBú¬Â²üHbìfÒŽÌ†/-¤\r ôŠ,à¾ÊŠŠ+\\?,6ÏobK@æ›‰²ªÏr;‰Š«lÒ+ ºL€£2ƒcî î^	dÄIo`%Ê.b`˜çø—eF€D<'ÆC†„+°‚8Åv,c</„œÐ„àÊž¶©r2'ã©™Ï.Ú¥f&hêT²\\N ë¨â+\$(S„|â#¾ñHgh?Ãêãö¡äDS£ÂŒåˆý#ºüoj;ïnäîëÃ¾ž¨EâŒ8ÊBû\$^à\"¸aÅv8\"ÙÁp ÉÙ\nb&úIà}ŒlB,ÍdjÀíÀ¨ †	\0@ÝDÜ\r\$ø¢mÅ‡PêÎV6èâÉÍ{ÐXXæ¨ @ã1JI°t[&æ'eî\\D&qn¹°¢€ËrU#°0è6÷Qxm	Ü…\"æüCŠÑm¬Ž±œ•Q‰’1æmˆE±–þb&+ˆïqžå£Âø±´…é5©ôùœ[fÑ”DFŒk ˜é‡2àè2;ä9b·	â¾9C( ïì‡áq!Ð\"#&Xq±gèÂ,žæ’W#Ö‚î9šgf{\rò(‚@ÊDðêg\0èF5\0èØ‡–BJ:XD`…v¶ÆÑÄ)'Eþ[‚vð\"ä[Š6[‚~G#\0L6b\0ðk‰)†x9²ŸÅ´;¨ˆ%&it™PàD£‘\$P–ÊØ©Åf‘bórFI‘²~¨vøËrAñÔ‡GèQÇÐeé•Ñø~å€%æDóGüüESÅ¸ó0!NAä²n©ô8CQ.Ï’|Û-	…p*|“-¥7§ì€s|Ž:Ñ¥2ð~ï+‘“Jëð–ÉŽD÷Ï€jÉ„Xïn•¥)Ðä'oz]@ˆN\0àWÀ~+2¬žåˆB…:‹…F+gÆSs’É“™3W)S6’3ŽñIm9eã7C[.®:Ix8É}	#63Ç3óïò‡/º‡0•¬EŽúE¨LË‘oò\"àRðpösm-¯pT«DE.¢¡5E¸™ˆBF…;šúÓpÑ3S4\rpúhBtR4å—=“<I“<°Œ~£ÂùÓnöÔ-1Ë[É½#ô.”/= §F%FD”ÉoOF´GFê11³A°‡<¹#0GÏ”Ž“Â1GecêÐ+³+Jí\r²J\\ã‚_È8;qGJÒ’ñðÉ‰8<dN°‘.¶D¦}íF”\\êÐÇ\"”ÙD3o4\r¬H°¶™t‘E•N”ÖïtÚ8ÔÞ~ÔãG©2´4œõçìà/2R/Œ®t‰\nÎ0Óâ&sìVd8„È€«£ÂX\$ÄBRECÂÆ9§ÇN©­5Bâ‡²Úïz’5M	3W	ˆ®t˜†¸g•;ðõ;'ÑSÄD„…F*U2ú®T´ÓJâÉPÔðôÐ¢êÓ:àƒWSHøRÌ\\dQ.:ÚÕŒ~µS2*»J°»<tþ~uõÔæ;§óLU/AR5U_^tö­5ŸtDùSVuÐ~ñ\$†1+2q1²ç25…ñ& o¶ ´í_rU]tKHóÏa¥¹aèÛÖ^“CGµãH‡ëbõc67`Ö#ò_d5ƒe0w`ðyeˆA7•ÂVs~žÃ¢6íb	f–ÖF¦)*š[”x<#VwVfVÂU \nG6oô…\$å_ö£jkÓj´d‰uHÖOI4çjJ‹j–AC3EQÕïRûd´]ÓÎ	>\rÌæe”ImïÍEæN€êtñ8ôöä¥Vê”ö\\4öö\röûoè£/r®9¥¼B•:.{Rƒ0–™>ãrµÑYnƒßlöNw8Š=k”v}UýQôl·:ÓVAkÐ´ÖálV±tg}uÖ)VÝlgPSJWYt—qQwQ2”}+†È[—#tkS –×ˆžö_yÃ,â¦+rò^¢r7X5y7¢‘>\\t²Âf˜\në÷L­7CkÔÕWÙuöÛkõÛo5á~ÖpÏ_·dwëv)•w©šãÄÝ{÷€ðîaÑÚ_6a–Wa0FCWÊi\$Óm€-oÍI1ÜhñC|ìÕHå›=·xØCƒL×k\0NàÑÑ	:Òâ;íŒ.¢îb´š[„²S¨¬àô¼ûÑÖü˜ã2ç(¤Dóuã'&tLafƒI¾ÒÕke\rIR~°°VakˆrßI¶gN4È“4Íb8š;ezjp\r€VÞÀÒ`Öãrª{3[zõ½3hÎ5¢°Î†\r«Oí\\§Àª\n€Œ pcËˆ/®8ÔÃw)Ú…ëcQÀ-O‰}Vh«5Ø¾|‚fÍ 	 ß‘@Ì.¬ñ¥fVp9õB 	Õf£·{”]øZ6˜X²)Kó3{8ä9Øè¬÷ÂB(w€5ÙvNfþ£\"ÍÀ˜\rîvy'NrdY–vè.…‰\0Kõ\$¸6}-Ð 'r,0‡,–'4™;mXN·@P§@€Ê©/#ZöÎT¨T‰Áq%ƒh‡É/ÔSB”Xøv3“_y„!N`¨dú=ƒÜÕ ÊwÆ8HoÐfÁvfTJ÷W–HÏg†œ%ˆ+¹÷µO=óf’4UW©Ësö8I.éŠšP zTïyPE©;³ãWF%ó£5š9Âà4¦ŽY\"à\nÇ ê\rµÀH¥g{bÔS¤(Id[ÂzÐp:#š¹‚zfÈá\"®Ä;¶’;è÷%™€1£¶gl›o>––<³žH\\JüC™ûC¯¯Wí®ð/U®H‹p‡ðm@\rî¨ãê@·u£ù¸²Wbº|v=eº>…øƒ¤;hq²–@	\0t	 š@¦\n`";
            break;
        case "tr":
            $g = "E6šMÂ	Îi=ÁBQpÌÌ 9‚ˆ†ó™äÂ 3°ÖÆã!”äi6`'“yÈ\\\nb,P!Ú= 2ÀÌ‘H°€Äo<N‡XƒbnŸ§Â)Ì…'‰ÅbæÓ)ØÇ:GX‰ùœ@\nFC1 Ôl7ASv*|%4š F`(¨a1\râ	!®Ã^¦2Q×|%˜O3ã¥Ðßv§‡K…Ês¼ŒfSd†˜kXjyaäÊt5ÁÏXlFó:´Ú‰i–£x½²Æ\\õFša6ˆ3ú¬²]7›ŽF	¸Óº¿™AE=é”É 4É\\¹KªK:åL&àQTÜk7Îð8ñÊKH0ãFžºfe9ˆ<8S™Ôàp’áNÃ™ÞJ2\$ê(@:NØèŸ\rƒ\n„ŸŒŽÚl4£î0@5»0J€Ÿ©	¢/Ž‰Š¦©ã¢„îS°íBã†:/’B¹l-ÐPÒ45¡\n6»iA`ÐƒH ª`PŽ2ê`éƒHæÆµÐJÝ\rÒ‚ˆøÊpÊ<C£ràŽi8™'C±{¨9Ã£k–:ÃªžÕB®Ú} P¡\rðH+%áÞõÂò4 4¬¬JbãJƒ=#\"7#ÊˆÞø>C{èû?“\n0Œl˜æƒ\rÃ8@‹Á¯SØ×ãHè4\rê‚.ýÓïðä2\0x‹Ê3¡Ð:ƒ€æáxïc…Ã\r#ÁrJ3…éˆ_X?¯ø^(¡ðÚ’µÈÌ’Çƒ Òà‡xÂ\$óâ>ˆ¬Ø,Œ#‚|Á–,m4#Ò2492+ÀÚ¼6ÊOÜNœþÇ'Š’¨²à·}	ÆE‹R*¢Ð\\é„£\"lÁ€N3-H—<¸+t[w¤£¬Ô'Ž’KÒ4³\r4 ÏpTŸzBØ	?|ŠwiNÎÖƒ\$”h%ßÌ¢DåfC43E8Å.ˆò:å¨+fœ À°°1 -HšÏ¥‚p±òÊËF­ËÔ¹c‡ió–(‰œ“´C\rÜ5¹­MÔãÔÐ¼/`xiŠO\$X†B\0WÆ„Èë†®Ÿ¸®•ê²ñ»¬ê”¥m•ò”³sè‚5îH’|²ÁJWÖàëŸ-Ì:iu×ÂîÂ …Éq‘àöÝÃd–d:š£'^O§Ý.=\$þJ|5ùþAÃ„0Â=A<ªv9eU76Ô‚˜ƒ.—Œç!v=Ž&`‹Žn‡¸Œ£[†ŸI´4D#ºäA(aL)`RQŸ8!Ô‚ƒi‹¯üÃ¢NËËå=nÁ‡—ÂþZ1'ÄF¨õ\"…Cð*dùé™“6Kë \ra­›¢:GÍ·\nå]«Õ~°VÅXáÝd¬µ I–zÑ\rÀ¼™¥UÄpV¸>=pÌX–WÚâô5âð²¯Ñx—*çƒïò‡4Z|93\r:«PØ^ fCÈuÿ ¢0 âñ^Ha!¥P@YCHfWGÆáx®ŸdrŽTÀ†ÄæPÓËt(mD–D(ˆ¯òÀXKc,…•¢€rZI-¥Ô¿ÖÀsÈ¦8è›cH>BiÅÃF¸BnHêø`FèÐÉ2[	óð\$Í¨O™ej`œ9¡\r©Ì50ØÉ„Æº‰÷b,a1RÒýó\nwÞõÌdD]¯ÁNÿI#ä„ÉºÄ IÂª\rÈz—R\$|#á!R(€ r(âEäŽ0PQ`{P3mMu”ÂœTQUHaå†9,KùC‹s53ÂëÒÔF.B	cº\$Œó¤f|G B\r3M˜ ù¯6CI'\n -ÓâþÙ“3\$\rU­ÐÜ\n‚ÔVLh;µ\0ÆŽgWäØ×TÐAGƒ©í\$î’˜’ú•ëß|-jF±D¨Ë,ç~ €&Gˆô@Ð\n#Ô-	 ©ùJ‰9Š33ªZ³'¡«ØŽéjtOiÆ4aˆž3w½œûŸ¹ê½¹ª^Éx3@'…0¨kHùV´È<œw¾[,Ûí*\$](ýhHÙDª€ã‡PòÓc•bç/£8T,l@\n”’Ë|øC ´H>\06ð¤ŠUo´\"ðä™é¬Õ\rùõM¥=6¢kŽ#r.BÀ7]Dú£Jªý1pà•q(%†„Âp \n¡@\"¨A\0(	9]ÇÃŽiŒ  •O+Ø{AH\nÀH\"„À‹ðN#¡› Ä\0S:†\\2ÈË‘YMÙ;·3>®•ð;¡é6\\àÖréº9'LÅÄ\nÜð9Ad:ß„VoÒCvqÎeT[`,ï½¦Ž™9Å\nÓÙ/p¬\\¡d‚G*awnuÃ¼F~æÝâõvìÌÌÃ,\nø Óÿ\n‰ðÖ^×ÈD—ä,øÈåø/h:JêÕPZ’§ÚN8äÃB\\\$q&Á/ºý¿\n„÷ÚQ¼¿/Býå	šsµ¾Í˜œšœ“Ã‚zg°Þ9¤,¯M 59tð“„ÓÒKËa9À€#¯¸Ìš¶(¶Ðá¹#RâÑõhi˜”í çBÜ{r&™*ãüD®óãÛGL\"<ûäo¤\0ÉE¹²d=Ø¸ŒÆë’²]zÒÊJ^µ Ÿ†&N& ²ÍÅö	è&p¹¢^œFô¸N_:<C	U™¾m—ÁÉ\rÔÒe…5žPlC=-9‚ò®ÇÜôc¬}eö!ÊŽ_cp‘y¾7GïíÈ®Z1rÓÊp‰ŸHÄç¿.=ÅyœÞ„¼ØSóOÎ´é>ç˜ç—tQÐ‰†h³½:¿£:<f[{0¥Õ\0±§óÒ&ìßœ ƒ›Éká×z‹ñ~}Pús.ÓÒÈ¿myýÂ9æ“×¡Ì¯õÒª¤„RI©#pü‰!«ü,Ä8® 6p¦›w G¨;†PÄD<ÁO>·`‹:/R£zíìÐ\$r>Y\\ÊO*9ÔæÚ”¢Lfd^¾)|L¼²@T(T\$D ¾Eý£±0Dúb¾Šo9QŒæLÊôLÓ‰Ã¢Zã_=Ú‘š~íÂÚ×Oìÿ_ÃNÌ“ÙÍÃ§U¶Ë\\Ó6b,æ½\"æxH¹\nÈ¸ô‹ÝlŽí/€„#P\0šeó\0oþ_Ìrw¬(goì:mª#­¦R/ÄÜb@ùð\"KdüE¢ð5FH¡ÄÇ ê*`êÃ%ÍGÍŒÊûåÒO¬âpË -²`°.Í,áLä¹Çpý()¼sÐfPoÈx(ÌÊÍ'&}æˆç°’Tq0„ùîþ‹ƒ¦ßåf7Øé¢¦bÇàên|åî‚˜ªè 7.o®v(†4êÃ\nëÊÍ-Ê¾\rÎÝ/¼ÌïŸ¨¼;mÐnP‚žpöÜÐý–„0š\$í¸¸ƒ~¨ŒFoLbbåF'Ë¤X‘ã\"#«„GŽÜV±Wq 8&.ä#žt¢l;\$Ù‚†7éºÑAÌº¢ÄCj>)¾gZÛâmí Âlúa¬`8*9M’Ùp°iqŠØðóèØÈÏQ|‘_M•‘¦ÃN	®µC0jƒñ·pyG\"àq¿ „ÔÍdd¬€vG¢ÞG‰¦7.ì'È“Dë\rµÑ»É\n/Æùòüð˜ýF‚;â*\\dÛ%Þ#Iöør!!f†:1… ³\"DÓ!êHåÖ’\$/½í:ÂWö¦=ÔI²SŠ`µ²!&/Œ‘òTü{‘«'m\"…%­Þ§²\0ûÛ†øMá%±Ë(é‡&J…)q²Qð;‘Ô.BÎ)/®—Ž&QÃ+§<N’¡¯Zƒ¶BÌu F˜ @]Râ4,L-‰”!f4`lî…Ü(*ä~NX5’ø\$C€…)•00<,OFZÖ0´c.c1hå˜òN³Óê³/O¬°&¨þ¨ã Æ2èl3‚6^R\0@d–\r€VŸ‚þb+8ôâj\n ¨ÀZô„ŒŽÜ™NËLP¼åÖ½)¾ï®å3n2óµÊQÌÀû¬Ü&\"STtÄ|H\"Êèc§\$BòÐ\rÂO²e4É8&S¶6f6*d,Ÿ‡¤(ha+É~¥­'À\"ìº»c“\"+¸ R0:c˜'¼xfK'cr…\0ê]ÍTÂÈ›Ç1T€¿KŽü¢åNÃ1ŠØÓÏÖO(ý,1D\rÔ k|¸Q\"B#É&tGC~ñQ\0%óBnBË­.@šRÂKÉóPHÚ\":Çƒea>m&Ì‹Çú¾À¬8†TO@žÄ \"ô\0Š5'’#@ô_ÂøÂe Š7©Kc\rç`xÃÔÇ\0µRËâ~\"ô*Ô„jÊ&GC„ô\rçtâ>C²P›\$j\r`ì§dƒ\nÏlŒiæ\"@";
            break;
        case "uk":
            $g = "ÐI4‚É ¿h-`­ì&ÑKÁBQpÌÌ 9‚š	Ørñ ¾h-š¸-}[´¹Zõ¢‚•H`Rø¢„˜®dbèÒrbºh d±éZí¢Œ†Gà‹Hü¢ƒ Í\rõMs6@Se+ÈƒE6œJçTd€Jsh\$g\$æG†­fÉj> ”žCˆÈf4†ãÌj¾¯SdRêBû\rh¡åSEÕ6\rVG!TI´ÂV±‘ÌÐÔ{Z‚L•¬éòÊ”i%QÏB×ØÜvUXh£ÚÊZ<,›Î¢A„ìeâÈÒv4›¦s)Ì@tåNC	Ót4zÇC	‹¥kK´4\\L+U0\\F½>¿kCß5ˆAø™2@ƒ\$M›à¬4é‹TA¥ŠJ\\G¾ORú¾èò‚¶	‹.©%\nKþ§B›Œ4Ã;\\’µ\r'¬²TÏSX5¢¨Ü5¹C¸Ü£ä7ŽIàˆî¼£æäƒ{ªäã¢0íä”8HC˜ï‹Y\"Õ–Š:’F\n*Xˆ#.h2¬B²Ù)¤7)¢ä¦©‹ŠQ\$¹¢D&jÊÆ,ÃšÖ¶¬Kzº¡%Ë»JÜ·s\$PhI*ÑS2g4MZ\rè‚\nô›BX#D£&Ï.i³%.Ô0£|LµTRöOI•@hhr@=”©\0®Á‚#ÄòºSèAGu€ä,öåa£Ã¼7cHßh-e\nO2¯‰¡kMr¨Û­)ŠSHTIjfB£Vµ`…ÖÑ4ÈLí…,ÉèÑ>É«)ŒF#DÅpD¨kgtThM¯…ì˜—;ršFêöM+¡# ÛG!‹#¹RPç&IÁ\0Â1Œn­£äØô€1HN@î4¼”0¹’Œ¦9“yœ\rÊ3¡Ð:ƒ€æáxï§…Ã5ŽG±àÎŒ£p_(r”¨„K8|6ÇŽD@3Gƒk»i\rÁà^0‡ËZ©–1|1D¥¨†Kæ‚Sˆ¿¢¼Õ¨ª¡]pj¸ß`[¼ÆY¤tAiÅS\\n\$Ø´	#fÑâí«þ’ªûòcG¨ P®0ŽCt@3£!(È‚4^õÝ‚sˆv|ÙR­ñew)©\"@†ËèÕ©—þn‡%Ì÷K#D„(˜y|fÉN]êß_s¿˜‡×ºÂ:’Pì0ƒ¨Ëî›¶¶5~!¢Ñ®„¿¢ûBŸèÜïs¿F›ªK\"0¨‘jºW/^oXÇ’rêB	[!îušpL“ÛàU.}\0”‘`gHq@pN\$h	Ex‚3ä\r‡]c‘€ÆCr\n!1’·H ˆÐ²SFðÄ¢u´JO¢±B.QÆ4îÛñO)dÅÆ°CÒâÊL>&É¤B‘Ô8¶É¡RQH¨ÅS7ÅÑ‹Ë~Ä…Ç×3^Ðõƒ’CØý†€†[æÁ¸cXûÄªdð&E‚a¡êb9Í?1¢ç]‹¢Œ°J5@„ºc¶Viº•˜ùC\n8'\rÔ€Þƒ0lcÉÐÐ¨Î[j\rÁäU YC*ÏÀÞÑ\0sL!Ð9JÀÂÃ\n 	Ú±°ÜNð(`¤µ™£v¦“j„t\0€!…0¤¡|y€¸‚È\"WSÁF.ŠTFàU\"PÑ\$%±o)D¯	1JYÂM[ôSRkxª“À¨qQ™Öm,:²°ÎÌÆG)„1­5¢ë?8	¢4fÒšcNj\rJ…5PäÕÚÈ/H«:6ÆÀ©kD-¹¸-TÅMÌ5N0È’T¸TDbaEÐ	-)òê—Ó\n–š>qÓÑe>–é0‹å•ÑÔÖOjB;Ë-®5æxŽÀp\r-	*‚\n\$ÐZEhí%¥´ÖžÚ‹S\rÈä5f°Ö–jÏZ+M°6 ’CÒ\r­d:RÀ|°«Û5uç`6 ÖÙ’z9•Uò—1Bº%ÏÒ**d4—	g`SÛ¹þtQhÐ§²!?ƒAÈdô•i‚f!Xb9ÁÐ:öëÃfªi.XµÙg\nå´¸FìÌð{BF\r{Ž®WÀÒúñ™’IÒ\$§ƒf¬La7Çô¤¦ñn€H\n\0´þ\\ÔòóÐ(,à¦ Î²NSòYWEÌè#\nˆ§Odÿ/\$B‰<kNµ†:JË,!Í9çDé†W^“Ct:Ç‰\$3{PÃ¾™¤8ýÉcdäJE•>Ë!HªJ} G-˜ë3€æ”LÃFç³àá2Ë]gn¼;žÆ,(iíZ«|r!}¥­Q„Ònœ‚…b¢G¢„TòjûƒÄÞáŠf¼§*‰ÈÐ*ûÅÅdWÒšSp´¥Š{MÒñ*§QM=ÑWg\"}'\$‹‡“„ÇƒK¯d\$a¬Ø3Âušq}AÍ%dvhEjc¸±†9líöJPôDÂczŠRìDÊ(«B@,Xr¢—`'…0©ddbÌ‘>ðfú‹–tþ¡*„ÏéœØ÷\n;þÕöEaeqŠú‰¹ð„©%„¤Hy8*h»?±.p3¼/Fçj[5&Z±Ð \npÌlƒ8ÁP(2`ÜëÃMxd¬Ónè|øŽ:=A®~Ê½ì4¢Š5îS/Bæ\$*JÈ4nAOðh/sL&!é'ÑÈŽfÁÈ!”h=!64#Éá·*wÈ¦šˆYû4h0ÚñÕ/¯zßW(¾\r¸:CUš-äV?–š‰:à?Aéè¨ Œ•È3LÑ]{®»Ï¬Ç@Š-ùö7„Lm¹ rš2È–ÿ†âjV_êCTˆ[.‚Ôõ*sÎð	b×_tøêÑ+§DÙ!ç<RŒÝ³®°¾ŒäMðº?GñùÒüÅ8ÐÊŽÌF¬\n‰téôl{¯vnÝÝN×8úÙE¨Ë;ì&È\"*·½ØT@ºñ¾dh\"Úœl¢Ö?nû¾å¹\"Ö²ú!ÐÒŸ]û¯!õ…0Êt¯öé½’\\¢çLO0ãñŒ¢UºŽn<¢÷¼èPïÓ\\F7NMF2h¸\$r!¥0…B%Ü¬F?òdèÀù\"¢\$]Ýá¡M›J?€rÊ/\"·†î%-èœ8a¨r-ôxÈØrÖ[OúæÇ/.v§UkªÌê*d¸þØŒHvÃŽ°oBØœâˆ%äˆ\"þp<)Åòï¢K'Qn¢¨¢ŽÊÃŽÞ\$ÉˆäÊ(F5…Nc\0¨\n€‚`\rúŽ“¬I`àÁ¼J¦ö[ð0QHÊ¨éZäoGjâôv§ûbšGr7À[0ÇåÊ§~Ò†ÈŒìMæ4ómú.„ð©ÌÖŠƒ\"OÅwøÀ\r‡G\rì.U°ä©Ðè(OVÞÂ?( .0çÇ\$Ó‘Ü@Pá\r,Â¡3'¿§_\rxwÌ&3eÀoð°G|‰kÎLq8\\Ä'‡k\nèob›\"”ð«ÑÁ}QsÈnŸi±;qƒâ?‡uÈŒÌQxxq—Ñ†é±j5 ˜Ý-ØG`î#10A'š&\$BÂaFA®\0‰‰`œÅœB\n¦C@RQ¬ƒ!j=	ô]b]efPØmŽùM4n¢… wÚ)Ñ>*QÔ-Áv>CVQì¼>\npïdÎÌ¤r/jçI´ÈGzÊÅ³#Âª4%²#CFRˆñDX¦ª’ýE´4ÐZ@ÒJè'Ñ^.¾41fD‚bõñŸ'ÇI(\nw(QFý0øÒ±2(%“)ièB’aòoºöoÀÒƒ*¤Æì’žxÏ¼éèäê£VK’›h<-odÀñr¨6ä* %L&äÒèsÌoG*\r\\aæ\njƒ\$†ªd#Ä6S/8ÒÄ*€„vú\"A 4Äê¨Žžˆã#S0tD²{…›Ë7.…ó4ð„ƒÓ0ƒ%0ÏÂ)/Ú„Oßræ¼â·)Ä5-Å.s`Ø„Ò„ˆÂzŽBAãFœ PËN\\\$®`.94¥f_ÒH©Ž»+í3,2‹®µ:.°\\ó¨¼âèÅ4‚ïNRór_¥Äî,`sºãîàRRÆ\\3´í³¹6²Öº³Ê‹˜íˆ)Œ/,SîŒ3ò©“öž’êœóß@­@RÒÖÐõ>Êœž\rð\$¤¾6„®ìÁ'5\nŒ§C ŽPZ³	,L1‹¤Ñ=gE’Ÿt*SñyC&û!+C£ODÔ,Ñ£D/DÓo-”ET\n´\$Ót^\\b1<™ð^Ll¦R““éDóqAíæ!mëé¡\0­ò24M:Â‹;¦ Ô«\0gB2´²ôuA±%JQ	\0000íLT°ôµ>”=Óþäæl:0ì.òÌ;g.)¢®.¢W%u>;f¨'èÊÄ6²Ä*sôñ#ÄÇOŽ¾nôŠý3b.§>o5Ã¦\"ç.ƒt7°,Éê|½ÉÈ¾5%9P<PbìŽâÒ´ØÞÔ®ßà^¡ þíp1®<o¾snýŠø®(º‡­=„U;é_‚\0\$¯²rTÏEîncìr/·Kr‰K³ßZ•ŸZôå&íKÏ\\.äqõ¬7p£4)[Ç:óß5Õ+ÔŸGt(òEUå@q\\\r>õ…#)ñOUãõÉRÄà+§:ê*jpø]ÒYg”&ONèHÖ.‚„ûJe 'O].H€çbˆn\nï”Òÿ]Ž+\"ÖöIFg?T6ÔÑ\\VYvKDaBÈ_”éMUþÿd\$‡âGös¶&Ò9FT?eó€‹.ãV†(‹`–Ÿ3–[irÿ,‡¼­3OV4+\"â½ëãNñ9ÀPkßeýMVbð;VgË5õgvgµím¶Ê³VÏbÖÓ^vg=öŽîHémËÒEMën6¨‹vÈÖópÖÐœ–µPôŸK‹;>çrVçYÃpf‹•y5Çj£ñsðLõªVÕ]×-QoÕ¥MAEu‚½=tæòµíp2MvAq0stwtSƒ&ðÕï]NH]÷¥/awS[SïxÐxË|\\3Jy^×œ^7^—¥f75_´Ô¤O6CH×fÖ\\å•‹4¥õ&Ò}+»hû{¯kç½”—C”Œ¥ñ/Er«×éc‘&wU/CÐ/wåÒÍåýQs€nýG€xU_y&(tM5yb‘Ëö‘Xt¬ËgSëM\"•Dr¢8\r„W©^±MI…<S?•é„˜[I÷‚\0†—€Øulï,9o²%3X{ì4Bš8Gƒ¢têRŽÍ¾\rª\nIL|˜@ª\n€Œ pXª‡WOóïTä7Â<Ž…w8SÉG±)®Õ{“ÂZî‡;É\r4s8ßŒÔíŽoŒ[â@\$T2‹Pà’¥GtrÊö‰@š\rø¸ÀòA¡daÃt%2Z>¤J@õ`[U©w±NÃVa)ÙŽ.Sïà&ËÌ=X’‹”<C8‡c¢x	€ÞÚÆÈhF\\<€–¤upnèhŠx£!*ð5Y«œ£êNÎÀ×'œ²ßWéÃ·¦1\$6nqrÙü~U•.æ)\\Y—/¹¯…Y()¯W—Çv«X¾DÐámk?,’¹¨R@?uŠÙÛ+ráž'\\Ï´ØB4	®¹:¨õ}/¡ŒS<³\$X=MdÔsäOK¢A¢ÔSxüs|ïâ\0ÿ3”'*4=¡°Êïà¬dàê Û¢9è½ƒ}˜Ù2~ðåÚe‚adŽ+¥â}õ©F1ßX=&„+XŽ‹vËˆãý£g¼1 ŒÉðî®tîöÃ&´U±Úf\ríâãœ;ÖÉÖôCEäðS?œ02û%Q	ax@² ";
            break;
        case "vi":
            $g = "Bp®”&á†³‚š *ó(J.™„0Q,ÐÃZŒâ¤)vƒŽ@Tf™\nípj£pº*ÃV˜ÍÃC`á]¦ÌrY<•#\$b\$L2–€@%9¥ÅIÄô×ŒÆÎ“„œ§4Ë…€¡€Äd3\rFÃqÀät9N1 QŠE3Ú¡±hÄj[—J;±ºŠo—ç\nÓ(©Ubµ´da¬®ÆIÂ¾Ri¦Då\0\0A)÷XÞ8@q:žg!ÏC½_#yÃÌ¸™6:‚¶ëÑÚ‹Ì.—òŠšíK;×.ð›­Àƒ}FŽÊÍ¼S06ÂÁ½†¡Œ÷\\ÝÅv¯ëàÄN5°ªn5›çx!”är7œ¥ÄC	ÐÂ1#˜Êõã(æÍã¢&:Žƒóæ;¿#\"\\! %:8!KÚHÈ+°Úœ0RÐ7±®úwC(\$F]“áÒ]“+°æ0Ž¡ÒŽ9©jjP ˜eî„Fdš²c@êœãJ*Ì#ìÓŠX„\n\npEÉš44…K\nÁd‹Âñ”È@3Êè&È!\0Úï3ZŒì0ß9Ê¤ŒHƒLn1\r?!\0Ê7?ôwBTXÊ<”8æ4Åäø0Ë(œT4BBšš-KdØPÌÉ’pS°ÉZ&ÉÁ;˜qê& %l§ %Kr!˜Å\n&œF/c,6J;rb!¾Ã¥hàòƒ, ÙVej”Eñ-@]Õó8ÓLBÈ6»o´	APçAÃ”0Œc\rI®ÊÈþ¿ð;(èÞ:Ýá\"9Âp¨XŠÐ9£0z\r è8aÐ^ŽøÈ\\0Üw+ôüŒá}àx(ä2á\r¯ÌíŒÏÈÚþÒƒpxŒ!ò\\,®„Ë³4íŠ‚h	K)Ft†Ì @§Ž¶a†V\rÏK”Ø-ó«éB¸Â9\rÎØÎŠ£\"ò<Ò!@æÉ èÝNêÄ‹—I¢`™0Öª¤œJ’´h¶˜lp6AC°Â6£(ž1BT„§Jv7oL2pJ®ÈñGgŠš›¦5¸%û½°VŠ]•3É†Q7,tW¥Ã«gÍ	}Ú6’C¨ç(,Ó P\$ƒµª¼­ôê‹LïÑ¬ê(Ž¦S;Å·FžBö¶qÝbR¦Ó\"˜¢&CÆz\rÃ436üJ¤‚¦\"|Œ?Û<òé æ™g¬*˜@ƒyŒÍ¶‹¦ŽGKKÉú\0§ j…Ù¬¤‚­sÂ³IB¸JéÅ¤¸Ûßø¡€&Ä¶5z¯Ñë2­\0“ˆŽ¼0¯˜Å8@ä‚Êÿ\r}†ðÌ– n¥,4áBÛÍLãZ‘0ÂI¡E\$…=¸—ÃNôUòYxh6\"ÖEÅf#§ª.•ˆœf›+nˆ(7PÂK“bBtàA2ÐPßRÑ84Åô‚™’Ê×{ñ˜1%f‘ºaÔ—,„Ú¿Žú\n 3ÄE0Ð;1Q¡ÕzµÄ¹\"r`áJ†È¹˜H al5‡±&ÅX»ìmŽÊ\\Èná‘3DPÊAô¼QÑ±3vrK‚€h\r*¨¢\n¦vŠi;H		‹ðé£\nyoFnH1B‘Õ ºVÍ=«§U5ª\nw¤µ„0¦Ã˜ƒbŒYŒ1¦9(´·L…‘¨õ\"”œ¿eAÌsÔA…	2™¡¶cçðGÖô+tâF‡¥€Ð…Ñlj\$D½N4Á¬D@kÂb\"€@¿`l/(8i4C+f!™H¨ÕÖ¼W˜f´¨6ôÐAá&ˆ\rÓ\nÃ%8n˜ŽKB¢èÐºCI¹`#\$H[\rV Ïü¡n‚‚€H\nÑÐ™¢<%àA8HDÊ\0”„.Š\"c˜…Ø:@àƒIÚP!ž˜°\$Óòé‡t¤ùÓ—§\$U5±>‘0ÀA`JsB+ÊÇ•`ÐËÃpp`		!FOIæU\n\\ˆÒº†AQÂˆŽ…FUœ¢Ú-R*Ólè˜\\DŽHAÙV‹±F‚©9w‰Î6¦oDít-E\0¡šìEÅIÄ?‰·™\r\"‹\$¸\$‘ óƒ\$¦°H76b;`Xa¨@È(3ƒ§'ØõCh”õVD„káû…kÌ’<Q	`/\n<)…H®wÞù9\"?ÑöçÛ¹3#¶ôÂQH·'aÒmÛEÚ¡3)ð_é¾ŽîÙŸ¸•B1Ñ®Hð¶\0 ˆ€»`©XÎ|ÜG>\0Âe|rV\rûX²1\$8ø©‚Óq›åµ¬¦ä‚bÉ%±µòq6ò,I\$™ßU\$²\n£H@û™ÉLK!¸¤a’X»!\n˜]ˆÖªÖÌIÔ8K=\$š˜èA	V\\-\n©¹çb>AÆi-dl2aDœwrÔ	‘ñ¸ý9Þ@»`ƒ,Š.G³t~oÕ9À¥ÔÈsSyÈ_•f“ˆLû¡Íå¤Ð•\"/’æLËË‘£¥\n+\rcŸÊIšëfÖ‚±=zŽ*­|nŠ)ÓEîï=”Þ(ò-	{FÈ—“\$MI¹9!®tV¥–æN3s‹ˆÐÆË³9Èi%Uj%t“Gú}–úÄUôíPîbÚ‰³Ä\rV¬½Â<\"j¡Æi†½È¾\0‹Î:cÍ%THí¬ÕŽ^psñ\$|”“¦IoÒ‰Íõ*£‘7ZÈÑNœ»Eõ\"¼˜Ô.\$º™2š´%ÿ\\Ð3VJ‘Ì“5P‰š!€*³l­ÜhBT\n!„ˆ¯¼D<¼k±ØlŠB7bMP»½íØ!öôià€‡ s d“­º[bÄâN{¥\$£-äÏl,ì•Ž=œir,ÑI<b²‡’[Û%SC\$º4n¼ø	œÓr\n1w¬LÈ1Qˆó¶´>F¹QøäQÿãŠOsËUI.EÉÛJ7Œ}N{OÓö¬nQ&ºS17ªN\nª\ngºñ8{ý¿å0²|'¬»ü¢^:ÊNõ|Äâ_¢n’½\n9\"·qe¦šPÊ»¥‚¥ï—¦Ý+#D‚mÊD£*+oÑ#Ì@m­Ø©í‘¿%ìûß%Û÷û	à~çÞHïøÒ‚·¡FÃm:°ífk ÇÏ&âR9¢Ð2§rÁ&ÒJ¨«É¤OM\$ÛÀˆ?P)\0~I’ufˆ™F°Ab-JBÃo:Ë„9ÉTÉFðZ0,FaÛï¨á6M°\nÛ0…6Î.à®'C¼·šÌÇˆmfõM6öD®ÿ-,ü¤…\0-ŠËýä„*èDÓGéBi\08~Ì	ÐÒ¨Ü¨ßŒL€'÷PÐ#°Ô0â¢\\íÀIÎÔTÏ?\0\\¦GÝ\rbHïc\"ï£ˆÃË	/ï/Ï.+ý¡#\0Ã5â\\\"Ñ\$É\$æ¹…°‰\0£ž<Á\"'lrtå´H\r¬ãïžVFžºæE‹þï\n¿	N8î¶1««ŠÇ&~¿ˆ[\r#¦&JËÂJ*¬LHñE1JþƒduN~Ñ.:Î1dÊÄ”jF©\0‘P­Q>jñCmôjb	°1â,ß)¹ÑÍÐêG¨\0œ‘èK1Ýà9.vhpò}‘ºpÙ Qr|òÓ¨Q râ\"o’ç§-rçŽÀþ^ANðãr	nL:&–NAvI¬ iòFn€Æ`àÈ‚Œö’Qçr\$’j\\²rvˆI- ðØòÃŠ\rŒZâJá.„•M“\"ðÊëí½E}í'bö9ÃVOŒÌP±('°Ê2	²ÌPÐûeí+¢Õ(2ŽVÊ-R €2ÈLÌÅ&lç‰,H/ˆûò*èT<èXXÒã/åŽý\$…xäç,î	1m1°é‹žãNCrý26äR›3S.}e\\\$„Ð\\Á\",íPàè“BÌÅe1Æ®<«V[2r5E¹6Q Ž0nËL™Í‹§4Î†Œ%P‚X0Ì('sŠ5fª)ˆ:­MÏ#sù‰*:àÂÇ« YâùAw:ÂlÑxªo%RÚ%ÀœC¡J €†-\nTÇ'H™í„Mw&ü\$ÐG¯…1bHÙóvWÂõcJIEr €ª\n€Œ q\rÛ,ÌíXl‡mÐÅ¢@†”#0gZ5è¥0Ý\"LRÑ+‘p/Át]N	>ðÓ(SD™r«ƒ6(£jqfznÌã,†åå06dæYèî„­IÀ¨z§®Ì Öåˆ<Ú\r&%S|Fa/øÿlšòP‡;G¤\rÚHHÿ¤Úÿ/Is©Jë}Â\$ƒqJê9Ã~jÈÍç=!c„vóEcJqô¾IO }#x­#ÎÚªÂm²Â´ph –Â\"i91½BKûíjÊ(ï„êçìÚÆb'8¹`@}PZ*Ì\"IèèŽÀäKîÍ^0 ˜Ù*­\$íüÏÅ–\$§v ¨NÈ3O44jÏ¨!Vâ‚IÃ±KK¢@ÞÃìêðR2¹-äÂåì2µ¯²S‚3¥¶[³FÐå-¼4b¢";
            break;
        case "zh":
            $g = "æA*ês•\\šr¤îõâ|%ÌÂ:\$\nr.®„ö2Šr/d²È»[8Ð S™8€r©!T¡\\¸s¦’I4¢b§r¬ñ•Ð€Js!J¥“É:Ú2r«STâ¢”\n†Ìh5\rÇSRº9QÉ÷*-Y(eÈ—B†­+²¯Î…òFZI9PªYj^F•X9‘ªê¼Pæ¸ÜÜÉÔ¥2s&Ö’Eƒ¡~™Œª®·yc‘~¨¦#}K•r¶s®Ôûkžõ|¿iµ-rÙÍ€Á)c(¸ÊC«Ý¦#*ÛJ!A–R\nõk¡P€Œ/Wît¢¢ZœU9ÓêWJQ3ÓWãq¨*é'Os%îdbÊ¯C9Ô¿Mnr;NáPÁ)ÅÁZâ´'1Tœ¥‰*†J;’©§)nY5ªª®¨’ç9XS#%’ÊîœÄAns–%ÙÊO-ç30¥*\\OœÄ¹lt’å¢0]Œñ6r‘²Ê^’-‰8´å\0Jœ¤Ù|r—¥ÊS0Œ9„),„•ò²,‘´¯,Ápi+\r‘»F²–eÛb‡%ÊPœ¤Ë½D¥ºF­/Ãô@¥¯[r½Ë)3¤«úJ´<¡E# Ú4Ã(ät—dÂlR>•›ñÁ\\È.Dáû¿/ÚrÐOi&†àÂ\rÊ3¡Ð:ƒ€æáxïa…Ã\r%JRÁpÞ9áxÊ7ã€Â9Žc½–2áŽ:e1ÌA§ANš³çIX…ã|GI\0DœÄYS1,ZZLÇ9H]6\$™ÌO]FJ7\r&—Øã‚®Éi,X¥Ùuz=Ž‘ZS¤‰‡Œ8tId€K¬±LW–eEÍ9Tr‘PDO\\Ä}ÛLÓg)\0^]·}âTÉíév“x9 D%¤8s–’’N]œÄ\"†^‘§9zW%¤s]fÌ²¡®:Da&ÇIâ\\V×Åô]2Ä„!fD#°ECGmþl)Š\"f2nŒIœ¥ã°Ý58V	ŠPt+M—'1Q:™´â\\—)›q•qÌSGD¨–²›lú^8=9ÊC­¾\"]M|íIÐ7­\\–ò|.»Ÿ^@PØ:Ijs”Óqt_œ…Ñ«œôwYCQaHX¤dV.LC<C¦\$Õ`ÿ(Øì€C\$’ØH×26WÌëÄjÃ‘\0†)ŠB0@“”‡9F)O÷Ôg(+¸š—aÊ#_iK\r¸E	÷šŠa‚|tD€ÙÝR*MJ‡'¾+Å¸èt	‘\"Q,'b±Y+El®Ò¼WËa,EJËY«<†@Þƒt\r0ýlƒãf`¾!‚ t±bOH¡£¤NŠ\"\"Aâé]d`^	£¦j»ÛFp|[¿öÔyW#(©?´,,£œå*«Un®UÚ½Wëa‡uŠ±àêÊY‹9hPðxsˆkAm5¹RAÑeu&2HäE˜•&È0W1Ì,Àä\"rˆÁ,†Åø…Š(¨H%ÓºHbð¯§ÄùŸS+E æb5¹”UQ,ðaq6.HŒUn¬VžÈÐ¢HHŽABœº¿ÇÜdU4‘LÅÁR¯<}UX \n (&I\$“|®,£ÅxÔFŒ5&æxOa)R\0°NDÊqV+à£1¦‰˜{i/ŽÁÌ¸Ú NYsAàð–qÌ(ãß3ðW‘Æ„&(\0¯Œ´Z*!Ò(„ÄË-i4PÑl¸Eø‡%ÄÀ™OlN	ÒÂ¸Z¯Fjÿa\0åflÀP%t6èøœ1ÆõRQ!v# ÚÈPˆk\$ˆ‚Œ†Y£‰›.\"ŒSŠ¥\\(ð¦Ê­&,¼R\nz€ž„8(\"EÎ¥¨E)*Š¨©|tˆVªÕÛûø¡(t’sÈ \"õ1ÁP(òB(	û'o0¦ã^IæœNIÑ;wP`ÐØ¤Ç•¬Qtè+ÅÈ\n	á8P T¶ªÖ@Š-²-\"´KÓ±jžËHKÒà‘*/Ô ¦g¢&(Ú“†qf©¿0&ŒEEÝÕw`²Šqvt+ðvG¹\r¡t€sÄÌ¹­W¼.åà¼¯´uÎfõ»D|9Å@‹di®\0‰†jYDQ¾ªÄ=,?¡ÙÐ„í‚1û »8Â„ÚAÉ]è(ôð‰°Hs9¢ÜÎÑAiíMü­¥›aB9Ås\$÷¸åœÛÐtb¤õ“.iÝ<ÄË)˜3:Bƒ¤ã¤ÃZ`¢pª)Ç°¼ƒÉhº”Mª1@!ÜU©ÂÝW¢chÄ£X\\Lb'S½|Ý€§Ë‚G/‘6.ˆ0š\"L_Oc	BÝYh¢î¡ÊÛ±!~/Ó`y'”;V+˜0¸·º¢6Z(ËbC	˜ñ1Dcth¯ÈN°ò‰–8x ÒóT–éE4æ©ƒ™ö+\0JÇué@XŽYvcfÂ§.\0RDÞDLÔ3X–jt²'K–žó˜#Ms5LnÇ×k´Ë¶û¢bq=@¤€‘m›c‰¶o*Ó'E+-IÅ˜YÃ¼Ã(bÜ‰Ï/YQm…ðº(S>ç*E°å5(V´áv![Jù_zTô‘ÁÄz\"ÂâU^’ò^Ëëu\"/Þcœt.lÆ1…ãa™£9ÆrmåWHàò\\„¸çÅæ‘dV	Ë9JaØcû„‚|ÈrèG3u4+…#:g—œè%p~sX8Œ_Œ™t‰JëDGIÍä´³²Ò…ùp¹Èâò–V›ÑB*é¬Ž%Ük.…4W-<äŠ‹¯Ì±}ñäO©¿§¾åÌswd]`_¹õÛú%éÆŽW‘w—sá9Yðb<þ‹€³¶xP‚?mA_wu6¨×{kVjááx½éÊö“–÷ÖèòÏ æž£”¼”ÈÇ(’™Y6‹½ÄÒ9eL«0XqSLi\$&Q:s½…“«¨@½¦OddÜJ¡BÔ5<=®Ò2%;ÝUnËÜüô2iM¢´™3't×ÖKMy²	§·õœr“½+ÇŒ#Õ:ÿÞ/“G4þþÐ©ÁtÏ‚Rñ/L`Œö)¯êbP\n%Õ\0as&àæg_ÂÒpÂÚ-åú2dàç,ÍFi¢\$éx4áÎ­,ïè!ZÎëòòoJr£LòñŽñ%ï\$kÁhM ýÊbÏšõpvhlÀ{p€3Ï°a<øŽÆåC òfG\0ìÐk£\0P]\n„Ó/OU¦®OÙÏû	\nPÉF	‚uðÕOäÌl½¦Ëj©0fÿLÅ¤í\r,ºNÐÖbPéã¼ßpGP%\rÃ Ð0å\r\$HDÐÍán*àZ`Ð Èò0Vl	ìÀã(-!tëÀ×ÃB¾ëòÛCbÀíúü\" H\"Ò§¨ÁB|\"ÊqTJQH¢ŽL€-V ­ZÕçÜ@g€\rƒz€ä˜æ á 4.„GÉªë\$&ÚOš•iˆ; ª\n€Œ p6Á,Oâ®×ÍB¼ÊD8)Þ#b:½Æ~:mÂa¯Ð«Ð!(4Âä!^áãp;(2 Cn/¬ÖÍ©îýÁ^ŸvCjôzhC4{§:-2!¬Z¬(¨JJfš\"Z!\0.p.ÆèBî¢Ìæ¯Àò‹°æöCI¡m%øånlñ!x*lq&¢X4obG¯æÇÏŽ4j\"iLƒ\".vnzs®Ì¹.¼ÈN¹)nÐÏÃ\$¤pDMžíÄ\\Î‰`¬ Æ ê\r®Ô\$2pÎ_ì–ÁG#£Æ`BbO’G\$£¤²T»Éò@‚“Ëë.²î»2âmà\ràìRÀî@Ò‘AHòÒ˜øãè{‚ÄríaL";
            break;
        case "zh-tw":
            $g = "ä^¨ê%Ó•\\šr¥ÑÎõâ|%ÌÂ:\$\ns¡.ešUÈ¸E9PK72©(æP¢h)Ê…@º:i	%“Êcè§Je åR)Ü«{º	Nd TâPˆ£\\ªÔÃ•8¨CˆÈf4†ãÌaS@/%Èäû•N‹¦¬’Ndâ%Ð³C¹’É—B…Q+–¹Öê‡Bñ_MK,ª\$õÆçu»ÞowÔfš‚T9®WK´ÍÊW¹•ˆ§2mizX:P	—*‘½_/Ùg*eSLK¶Ûˆú™Î¹^9×HÌ\rºÛÕ7ºŒZz>‹ êÔ0)È¿Nï\nÙr!U=R\n¤ôÉÖ^¯ÜéJÅÑTçO©](ÅI–Ø^Ü«¥]EÌJ4\$yhr•ä2^?[ ô½eCžr‘º^[#åk¢Ö‘g1'¤)ÌT'9jB)#›,§%')näªª»hV’èùdô=OaÐ@§IBO¤òàs¥Â¦K©¤¹Jºç12A\$±&ë8mQd€¨ÁlY»r—%ò\0J£1Ä¡ÌDÇ)*OÌŠTÍ4L°Ô9DÚB+ê°üµáÎY—qbë…Òè©*ÁÊ\\gA2‡@1DµOÙVŒ%Ú^R©¥pr\$)ÏLÓ`P‚2\r£HÜ2ŽGI@H&P±pF¿ð	h™SQÍ1äM#¦¤%*þ!„`x0„@ä2ŒÁèD4ƒ à9‡Ax^;ÛpÃTUU`\\7ŽC8^2Áxà0Žc˜ïpxD¥ÇAR’d)ÐSmRøQ”!à^0‡Ápt%Ä4CÏ˜BWœå!u2Þëåsþ\\¤¥îKOX¦,J3æ:æ1•uDM•ÏZS¤‰‡Œ\0Ä<Žƒ(P9…*iXBJ˜Ty<EAvtåÄC×\$Y+‚GŒfWÖ-jÕ‚`Ä™—åéÊ^ø6C¤¦’â†¸…Ùvs„|¨s—¹IÌGOÞºžªD1TaÌ\\yÊzŸ àP¨2 @t’¥»öS%ÚR\0N%Ä+¼63ÖæAœÄ~º)Š\"`A–—»KÂs\$œš¸6±f=‹Øt»¯ä<Ã&¿b—X]áðVEÜ¸Ž'Ø÷8›Dž'ÉséRœ¾Y]%ÝáÏßvÍ”÷êÒÏ°þ{L—­â®¦\rƒ äË•I6Q0DÑÈ]ÌµGMyôÁvùŠc í6X Ž(ibŽ„RYŠÃ¤HQ|#H‡«ÈS?\"4BÁ)… Œ o\rkÀ@eóB£†¨˜—áÊ%…r'üE&ÅHóÑ8„ã V	Ò\0EB§U*¬9@W| à…ÅC\"kDŠÇY+-f¬õ¢´Öª×[+n!­åÀ¸— /¼7èc\"îÃ˜F±X/ˆ`ˆ-ý‰a9Òº®\$0D¯æ\0À‚˜e]1 7:4W\0RDF„êÐÄ¿56eˆúš@¨)'ù€ŠK)f,å ´–¢Ö[Ým-Èˆ·×\nã\\®!š†àç!rð„ÉÈr‹+òqÌ`ŽŽ\\\$È3œSÊ€B¼Ñ,e¤ƒŒŽŒ_£‘A…«MI°ö\"qZ)ÐreC•c3Ç,5‡è4s‰´„\$!6ÂH¡¡4üßÀåã”O‹s)ˆÚ%éÑ¢3gH»KêÕÎ‹H4@PLÓé¡ùú!#‰J’AY’òbLÍP£nb•Î\"XÁ£ž‚‚|A…ƒ:Äˆè¢%™ƒ\n„(¥X*ýI¡Z\0.åœs\nx±WÑŸ>¢^Ža0+ÊŽ‰QŽ§Kù-ƒ”MÒBXx…²90˜\"hM’æÂÕ ˆ\"QgPœ§%©BTsg D¦ÐS!Ì'„àæ3,Í—Yä'¢ÝPªK1b ¤Péâq&ˆ‘Í5ãÐé¢ˆË\0žÂ  R¢‘\\”\0ßÄÙC¥/U3±Äq\\UrMË¨zÛUëÐ¨¨M¤ù5\0B0T\nì‘2€P‘ó 	„àÞ×ñÈ¡T8åQ5&GÕr€%‡ ¾b4Z”Ñ@(JU	á8P T *í‚\0ˆB`E¼LéžÒ¤\$hç&d¸G¹Ä‚ØoóqŽ8]9¨ÉŒAŠ1‡<è3ªNÈ¨»:ÂàEà’0)ß¸™<\$eÿÁ’lìOÃÛšH­ü\$eŸVv/EÞšü4x„È•âA\nÝ€—c²øÒ\$0\"Ä\0æ¥ÂÕˆ‘]aI¸ÕTú¶(E\n–”5:¢4JýŸÄLÈY>ÈÁ`aUõ1º×`X%W~¢«aDh0dW\$I*Õ©ÝÃØN‰\\,°žªz|ÈDŠ™ŒÆÊ°–)¢©\nf8_žë™ÐœZ\n&¶˜›Ðš^h‹¤9…Ð#¡‰—^È0\rp—Bé›¨x…8¸…W)E='}¨u‰Sª}PÑ– x…âB~´ô^5¶»|±xºk¯¼è±m KÞ\$zh. #q‚Õ¢\0 ·„*†1ñ^VRØm!RûÉÁ‚|ùŸQTxA+1à˜Y¡B#	tõ2›DRí0@ÂZÅÜ;˜Fô\$/Eˆéâý×Õ|\$](»•\nzOmÎm\$8 l#;n­Ï®Ý›LÚpíÐàÐ€¶ÝxÙAosÙ9ãÄ„‘ÉXð\$ÇDÑ¢N Óh/ŽuÈŠ ¬G‰,(\rÇPÜÏRqÜŸÁwY&)í`]mÔ” ¹]y¢ˆ—/TtÃvÝ>ÄÈÒ¡ø)¢áá\"0`Ì-HrÃ¤A§±SÍÙ8®’¼¦iãÀK‘Y¥4æ%“NXcs»‰‰9½Õ”W>ð,¹><½äõ%tK ðº\nÙaÍL\"ü[·¶WÂù(=†„sOV Vµ,Ôx(?;­€Fõ”v]`ˆô‡ž_K~<©.-=Á)±]¡t;ò÷53ô~ÎÒ¤q¿n>>ï)|ÝŒ•ðX¿åS™À/Æïã—Çý\"[â=³ úÞÓåŠL¿œþŸÕÎ/áyÿâ]¯†üŽèÚ	j#Ô¾¸Æ¯¶t\rÏ¼™‰”þ»ã}ÿ¸íÌ\$¹ë¢ºajájvÓ«©\0Ï¨Ä°\0‰ Ñí\"Æ!ÊCˆÒP5„\"©šUÁ%án3‰Êœê¢OzõŠ›ÎìÒ¬b·:™ên§#\\Ñm7¢>œŒ.{_â¨›ÃhÓpÓË«p2ËãÄÃH4Í21ƒD½¤ªûhc&6OP\0	°Ïª6oÂÄ°¨ÏÐ¬¹ÏìþQL9\rxm!m\0ÏÑ\r-}\rÐÖªðÚMz×ðØpä`a,Åæ&w!:!ÁÌæº›Â„Î'éæ7b¨ÿìÖþMu\r²\"¦ ðáÁ[Ì\\nÉ!aÊk-lÒárUÂ~*‘.ØJßF¹EòUãq*¨G‚Gæ€ùP°Æ#-‡A/P×Lcñ‚ìcÑ}ÃÁÏÌúïÄ±™†/‘]‘pÍfˆÔM²Ô‘€v\rQeOMk0éq²Õ-JÄ±ÓÚIdšIð÷ãÀœdlGºdì0‘ñ°ôA‘î£,	Ð\r\0Ê‚1­t)¡ÇãFz!DííæC@Þi`P@R³I¢DJìécÄ†az#pkA\n. C0²Bé’&5ÎøíABA1OøßdN gÌ\rƒ—'Ã¢9í¢'ã\\jD¤2ÐDâM‰œ*\0\0ª\n€Œ p8¤‡–¦. žê®Â‚8if\n`åäKÆ+Ð`k¬ëãŒ0ñö8®ÂÕÇƒ\0ržªì°Snä€f/ªbÍ(ô)ªÔžA:3\nur.§r¯hoåD,ïïáÐ¡Á3*%¬¾äÁlåHLö-o»W!c’Öò'­±PÀÐ	¼v!Ìl¦Î%Íó\r€/†¿¢0÷f–q§7êvè¡,\"î6šªÅˆâ\nÀÂ`ê Úø¢è\0·ÓZôjîÒF2Ý†<žARës&z/3, £¤&˜,G=lC4`ÞÅXàä\r&j%Ñ„B2Mp%Â®Á›¢èñâøÁL";
            break;
    }
    $yi = array();
    foreach (explode("\n", lzw_decompress($g)) as $X)
        $yi[] = (strpos($X, "\t") ? explode("\t", $X) : $X);
    return $yi;
}
if (!$yi) {
    $yi                       = get_translations($ca);
    $_SESSION["translations"] = $yi;
}
if (extension_loaded('pdo')) {
    class Min_PDO extends PDO
    {
        var $_result, $server_info, $affected_rows, $errno, $error;
        function __construct()
        {
            global $b;
            $hg = array_search("SQL", $b->operators);
            if ($hg !== false)
                unset($b->operators[$hg]);
        }
        function dsn($lc, $V, $F, $Af = array())
        {
            try {
                parent::__construct($lc, $V, $F, $Af);
            }
            catch (Exception $Cc) {
                auth_error(h($Cc->getMessage()));
            }
            $this->setAttribute(13, array(
                'Min_PDOStatement'
            ));
            $this->server_info = @$this->getAttribute(4);
        }
        function query($G, $Gi = false)
        {
            $H           = parent::query($G);
            $this->error = "";
            if (!$H) {
                list(, $this->errno, $this->error) = $this->errorInfo();
                if (!$this->error)
                    $this->error = lang(21);
                return false;
            }
            $this->store_result($H);
            return $H;
        }
        function multi_query($G)
        {
            return $this->_result = $this->query($G);
        }
        function store_result($H = null)
        {
            if (!$H) {
                $H = $this->_result;
                if (!$H)
                    return false;
            }
            if ($H->columnCount()) {
                $H->num_rows = $H->rowCount();
                return $H;
            }
            $this->affected_rows = $H->rowCount();
            return true;
        }
        function next_result()
        {
            if (!$this->_result)
                return false;
            $this->_result->_offset = 0;
            return @$this->_result->nextRowset();
        }
        function result($G, $p = 0)
        {
            $H = $this->query($G);
            if (!$H)
                return false;
            $J = $H->fetch();
            return $J[$p];
        }
    }
    class Min_PDOStatement extends PDOStatement
    {
        var $_offset = 0, $num_rows;
        function fetch_assoc()
        {
            return $this->fetch(2);
        }
        function fetch_row()
        {
            return $this->fetch(3);
        }
        function fetch_field()
        {
            $J            = (object) $this->getColumnMeta($this->_offset++);
            $J->orgtable  = $J->table;
            $J->orgname   = $J->name;
            $J->charsetnr = (in_array("blob", (array) $J->flags) ? 63 : 0);
            return $J;
        }
    }
}
$gc = array();
class Min_SQL
{
    var $_conn;
    function __construct($h)
    {
        $this->_conn = $h;
    }
    function select($Q, $L, $Z, $pd, $Cf = array(), $_ = 1, $E = 0, $pg = false)
    {
        global $b, $y;
        $ae = (count($pd) < count($L));
        $G  = $b->selectQueryBuild($L, $Z, $pd, $Cf, $_, $E);
        if (!$G)
            $G = "SELECT" . limit(($_GET["page"] != "last" && $_ != "" && $pd && $ae && $y == "sql" ? "SQL_CALC_FOUND_ROWS " : "") . implode(", ", $L) . "\nFROM " . table($Q), ($Z ? "\nWHERE " . implode(" AND ", $Z) : "") . ($pd && $ae ? "\nGROUP BY " . implode(", ", $pd) : "") . ($Cf ? "\nORDER BY " . implode(", ", $Cf) : ""), ($_ != "" ? +$_ : null), ($E ? $_ * $E : 0), "\n");
        $Gh = microtime(true);
        $I  = $this->_conn->query($G);
        if ($pg)
            echo $b->selectQuery($G, $Gh, !$I);
        return $I;
    }
    function delete($Q, $zg, $_ = 0)
    {
        $G = "FROM " . table($Q);
        return queries("DELETE" . ($_ ? limit1($Q, $G, $zg) : " $G$zg"));
    }
    function update($Q, $O, $zg, $_ = 0, $M = "\n")
    {
        $Zi = array();
        foreach ($O as $z => $X)
            $Zi[] = "$z = $X";
        $G = table($Q) . " SET$M" . implode(",$M", $Zi);
        return queries("UPDATE" . ($_ ? limit1($Q, $G, $zg, $M) : " $G$zg"));
    }
    function insert($Q, $O)
    {
        return queries("INSERT INTO " . table($Q) . ($O ? " (" . implode(", ", array_keys($O)) . ")\nVALUES (" . implode(", ", $O) . ")" : " DEFAULT VALUES"));
    }
    function insertUpdate($Q, $K, $ng)
    {
        return false;
    }
    function begin()
    {
        return queries("BEGIN");
    }
    function commit()
    {
        return queries("COMMIT");
    }
    function rollback()
    {
        return queries("ROLLBACK");
    }
    function slowQuery($G, $ji)
    {
    }
    function convertSearch($v, $X, $p)
    {
        return $v;
    }
    function value($X, $p)
    {
        return (method_exists($this->_conn, 'value') ? $this->_conn->value($X, $p) : (is_resource($X) ? stream_get_contents($X) : $X));
    }
    function quoteBinary($bh)
    {
        return q($bh);
    }
    function warnings()
    {
        return '';
    }
    function tableHelp($C)
    {
    }
}
$gc["sqlite"]  = "SQLite 3";
$gc["sqlite2"] = "SQLite 2";
if (isset($_GET["sqlite"]) || isset($_GET["sqlite2"])) {
    $kg = array(
        (isset($_GET["sqlite"]) ? "SQLite3" : "SQLite"),
        "PDO_SQLite"
    );
    define("DRIVER", (isset($_GET["sqlite"]) ? "sqlite" : "sqlite2"));
    if (class_exists(isset($_GET["sqlite"]) ? "SQLite3" : "SQLiteDatabase")) {
        if (isset($_GET["sqlite"])) {
            class Min_SQLite
            {
                var $extension = "SQLite3", $server_info, $affected_rows, $errno, $error, $_link;
                function __construct($Wc)
                {
                    $this->_link       = new SQLite3($Wc);
                    $cj                = $this->_link->version();
                    $this->server_info = $cj["versionString"];
                }
                function query($G)
                {
                    $H           = @$this->_link->query($G);
                    $this->error = "";
                    if (!$H) {
                        $this->errno = $this->_link->lastErrorCode();
                        $this->error = $this->_link->lastErrorMsg();
                        return false;
                    } elseif ($H->numColumns())
                        return new Min_Result($H);
                    $this->affected_rows = $this->_link->changes();
                    return true;
                }
                function quote($P)
                {
                    return (is_utf8($P) ? "'" . $this->_link->escapeString($P) . "'" : "x'" . reset(unpack('H*', $P)) . "'");
                }
                function store_result()
                {
                    return $this->_result;
                }
                function result($G, $p = 0)
                {
                    $H = $this->query($G);
                    if (!is_object($H))
                        return false;
                    $J = $H->_result->fetchArray();
                    return $J[$p];
                }
            }
            class Min_Result
            {
                var $_result, $_offset = 0, $num_rows;
                function __construct($H)
                {
                    $this->_result = $H;
                }
                function fetch_assoc()
                {
                    return $this->_result->fetchArray(SQLITE3_ASSOC);
                }
                function fetch_row()
                {
                    return $this->_result->fetchArray(SQLITE3_NUM);
                }
                function fetch_field()
                {
                    $e = $this->_offset++;
                    $T = $this->_result->columnType($e);
                    return (object) array(
                        "name" => $this->_result->columnName($e),
                        "type" => $T,
                        "charsetnr" => ($T == SQLITE3_BLOB ? 63 : 0)
                    );
                }
                function __desctruct()
                {
                    return $this->_result->finalize();
                }
            }
        } else {
            class Min_SQLite
            {
                var $extension = "SQLite", $server_info, $affected_rows, $error, $_link;
                function __construct($Wc)
                {
                    $this->server_info = sqlite_libversion();
                    $this->_link       = new SQLiteDatabase($Wc);
                }
                function query($G, $Gi = false)
                {
                    $Ue          = ($Gi ? "unbufferedQuery" : "query");
                    $H           = @$this->_link->$Ue($G, SQLITE_BOTH, $o);
                    $this->error = "";
                    if (!$H) {
                        $this->error = $o;
                        return false;
                    } elseif ($H === true) {
                        $this->affected_rows = $this->changes();
                        return true;
                    }
                    return new Min_Result($H);
                }
                function quote($P)
                {
                    return "'" . sqlite_escape_string($P) . "'";
                }
                function store_result()
                {
                    return $this->_result;
                }
                function result($G, $p = 0)
                {
                    $H = $this->query($G);
                    if (!is_object($H))
                        return false;
                    $J = $H->_result->fetch();
                    return $J[$p];
                }
            }
            class Min_Result
            {
                var $_result, $_offset = 0, $num_rows;
                function __construct($H)
                {
                    $this->_result = $H;
                    if (method_exists($H, 'numRows'))
                        $this->num_rows = $H->numRows();
                }
                function fetch_assoc()
                {
                    $J = $this->_result->fetch(SQLITE_ASSOC);
                    if (!$J)
                        return false;
                    $I = array();
                    foreach ($J as $z => $X)
                        $I[($z[0] == '"' ? idf_unescape($z) : $z)] = $X;
                    return $I;
                }
                function fetch_row()
                {
                    return $this->_result->fetch(SQLITE_NUM);
                }
                function fetch_field()
                {
                    $C  = $this->_result->fieldName($this->_offset++);
                    $dg = '(\[.*]|"(?:[^"]|"")*"|(.+))';
                    if (preg_match("~^($dg\\.)?$dg\$~", $C, $B)) {
                        $Q = ($B[3] != "" ? $B[3] : idf_unescape($B[2]));
                        $C = ($B[5] != "" ? $B[5] : idf_unescape($B[4]));
                    }
                    return (object) array(
                        "name" => $C,
                        "orgname" => $C,
                        "orgtable" => $Q
                    );
                }
            }
        }
    } elseif (extension_loaded("pdo_sqlite")) {
        class Min_SQLite extends Min_PDO
        {
            var $extension = "PDO_SQLite";
            function __construct($Wc)
            {
                $this->dsn(DRIVER . ":$Wc", "", "");
            }
        }
    }
    if (class_exists("Min_SQLite")) {
        class Min_DB extends Min_SQLite
        {
            function __construct()
            {
                parent::__construct(":memory:");
                $this->query("PRAGMA foreign_keys = 1");
            }
            function select_db($Wc)
            {
                if (is_readable($Wc) && $this->query("ATTACH " . $this->quote(preg_match("~(^[/\\\\]|:)~", $Wc) ? $Wc : dirname($_SERVER["SCRIPT_FILENAME"]) . "/$Wc") . " AS a")) {
                    parent::__construct($Wc);
                    $this->query("PRAGMA foreign_keys = 1");
                    return true;
                }
                return false;
            }
            function multi_query($G)
            {
                return $this->_result = $this->query($G);
            }
            function next_result()
            {
                return false;
            }
        }
    }
    class Min_Driver extends Min_SQL
    {
        function insertUpdate($Q, $K, $ng)
        {
            $Zi = array();
            foreach ($K as $O)
                $Zi[] = "(" . implode(", ", $O) . ")";
            return queries("REPLACE INTO " . table($Q) . " (" . implode(", ", array_keys(reset($K))) . ") VALUES\n" . implode(",\n", $Zi));
        }
        function tableHelp($C)
        {
            if ($C == "sqlite_sequence")
                return "fileformat2.html#seqtab";
            if ($C == "sqlite_master")
                return "fileformat2.html#$C";
        }
    }
    function idf_escape($v)
    {
        return '"' . str_replace('"', '""', $v) . '"';
    }
    function table($v)
    {
        return idf_escape($v);
    }
    function connect()
    {
        global $b;
        list(, , $F) = $b->credentials();
        if ($F != "")
            return lang(22);
        return new Min_DB;
    }
    function get_databases()
    {
        return array();
    }
    function limit($G, $Z, $_, $D = 0, $M = " ")
    {
        return " $G$Z" . ($_ !== null ? $M . "LIMIT $_" . ($D ? " OFFSET $D" : "") : "");
    }
    function limit1($Q, $G, $Z, $M = "\n")
    {
        global $h;
        return (preg_match('~^INTO~', $G) || $h->result("SELECT sqlite_compileoption_used('ENABLE_UPDATE_DELETE_LIMIT')") ? limit($G, $Z, 1, 0, $M) : " $G WHERE rowid = (SELECT rowid FROM " . table($Q) . $Z . $M . "LIMIT 1)");
    }
    function db_collation($m, $qb)
    {
        global $h;
        return $h->result("PRAGMA encoding");
    }
    function engines()
    {
        return array();
    }
    function logged_user()
    {
        return get_current_user();
    }
    function tables_list()
    {
        return get_key_vals("SELECT name, type FROM sqlite_master WHERE type IN ('table', 'view') ORDER BY (name = 'sqlite_sequence'), name");
    }
    function count_tables($l)
    {
        return array();
    }
    function table_status($C = "")
    {
        global $h;
        $I = array();
        foreach (get_rows("SELECT name AS Name, type AS Engine, 'rowid' AS Oid, '' AS Auto_increment FROM sqlite_master WHERE type IN ('table', 'view') " . ($C != "" ? "AND name = " . q($C) : "ORDER BY name")) as $J) {
            $J["Rows"]     = $h->result("SELECT COUNT(*) FROM " . idf_escape($J["Name"]));
            $I[$J["Name"]] = $J;
        }
        foreach (get_rows("SELECT * FROM sqlite_sequence", null, "") as $J)
            $I[$J["name"]]["Auto_increment"] = $J["seq"];
        return ($C != "" ? $I[$C] : $I);
    }
    function is_view($R)
    {
        return $R["Engine"] == "view";
    }
    function fk_support($R)
    {
        global $h;
        return !$h->result("SELECT sqlite_compileoption_used('OMIT_FOREIGN_KEY')");
    }
    function fields($Q)
    {
        global $h;
        $I  = array();
        $ng = "";
        foreach (get_rows("PRAGMA table_info(" . table($Q) . ")") as $J) {
            $C     = $J["name"];
            $T     = strtolower($J["type"]);
            $Ub    = $J["dflt_value"];
            $I[$C] = array(
                "field" => $C,
                "type" => (preg_match('~int~i', $T) ? "integer" : (preg_match('~char|clob|text~i', $T) ? "text" : (preg_match('~blob~i', $T) ? "blob" : (preg_match('~real|floa|doub~i', $T) ? "real" : "numeric")))),
                "full_type" => $T,
                "default" => (preg_match("~'(.*)'~", $Ub, $B) ? str_replace("''", "'", $B[1]) : ($Ub == "NULL" ? null : $Ub)),
                "null" => !$J["notnull"],
                "privileges" => array(
                    "select" => 1,
                    "insert" => 1,
                    "update" => 1
                ),
                "primary" => $J["pk"]
            );
            if ($J["pk"]) {
                if ($ng != "")
                    $I[$ng]["auto_increment"] = false;
                elseif (preg_match('~^integer$~i', $T))
                    $I[$C]["auto_increment"] = true;
                $ng = $C;
            }
        }
        $Bh = $h->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = " . q($Q));
        preg_match_all('~(("[^"]*+")+|[a-z0-9_]+)\s+text\s+COLLATE\s+(\'[^\']+\'|\S+)~i', $Bh, $Ge, PREG_SET_ORDER);
        foreach ($Ge as $B) {
            $C = str_replace('""', '"', preg_replace('~^"|"$~', '', $B[1]));
            if ($I[$C])
                $I[$C]["collation"] = trim($B[3], "'");
        }
        return $I;
    }
    function indexes($Q, $i = null)
    {
        global $h;
        if (!is_object($i))
            $i = $h;
        $I  = array();
        $Bh = $i->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = " . q($Q));
        if (preg_match('~\bPRIMARY\s+KEY\s*\((([^)"]+|"[^"]*"|`[^`]*`)++)~i', $Bh, $B)) {
            $I[""] = array(
                "type" => "PRIMARY",
                "columns" => array(),
                "lengths" => array(),
                "descs" => array()
            );
            preg_match_all('~((("[^"]*+")+|(?:`[^`]*+`)+)|(\S+))(\s+(ASC|DESC))?(,\s*|$)~i', $B[1], $Ge, PREG_SET_ORDER);
            foreach ($Ge as $B) {
                $I[""]["columns"][] = idf_unescape($B[2]) . $B[4];
                $I[""]["descs"][]   = (preg_match('~DESC~i', $B[5]) ? '1' : null);
            }
        }
        if (!$I) {
            foreach (fields($Q) as $C => $p) {
                if ($p["primary"])
                    $I[""] = array(
                        "type" => "PRIMARY",
                        "columns" => array(
                            $C
                        ),
                        "lengths" => array(),
                        "descs" => array(
                            null
                        )
                    );
            }
        }
        $Eh = get_key_vals("SELECT name, sql FROM sqlite_master WHERE type = 'index' AND tbl_name = " . q($Q), $i);
        foreach (get_rows("PRAGMA index_list(" . table($Q) . ")", $i) as $J) {
            $C            = $J["name"];
            $w            = array(
                "type" => ($J["unique"] ? "UNIQUE" : "INDEX")
            );
            $w["lengths"] = array();
            $w["descs"]   = array();
            foreach (get_rows("PRAGMA index_info(" . idf_escape($C) . ")", $i) as $ah) {
                $w["columns"][] = $ah["name"];
                $w["descs"][]   = null;
            }
            if (preg_match('~^CREATE( UNIQUE)? INDEX ' . preg_quote(idf_escape($C) . ' ON ' . idf_escape($Q), '~') . ' \((.*)\)$~i', $Eh[$C], $Kg)) {
                preg_match_all('/("[^"]*+")+( DESC)?/', $Kg[2], $Ge);
                foreach ($Ge[2] as $z => $X) {
                    if ($X)
                        $w["descs"][$z] = '1';
                }
            }
            if (!$I[""] || $w["type"] != "UNIQUE" || $w["columns"] != $I[""]["columns"] || $w["descs"] != $I[""]["descs"] || !preg_match("~^sqlite_~", $C))
                $I[$C] = $w;
        }
        return $I;
    }
    function foreign_keys($Q)
    {
        $I = array();
        foreach (get_rows("PRAGMA foreign_key_list(" . table($Q) . ")") as $J) {
            $r =& $I[$J["id"]];
            if (!$r)
                $r = $J;
            $r["source"][] = $J["from"];
            $r["target"][] = $J["to"];
        }
        return $I;
    }
    function view($C)
    {
        global $h;
        return array(
            "select" => preg_replace('~^(?:[^`"[]+|`[^`]*`|"[^"]*")* AS\s+~iU', '', $h->result("SELECT sql FROM sqlite_master WHERE name = " . q($C)))
        );
    }
    function collations()
    {
        return (isset($_GET["create"]) ? get_vals("PRAGMA collation_list", 1) : array());
    }
    function information_schema($m)
    {
        return false;
    }
    function error()
    {
        global $h;
        return h($h->error);
    }
    function check_sqlite_name($C)
    {
        global $h;
        $Mc = "db|sdb|sqlite";
        if (!preg_match("~^[^\\0]*\\.($Mc)\$~", $C)) {
            $h->error = lang(23, str_replace("|", ", ", $Mc));
            return false;
        }
        return true;
    }
    function create_database($m, $d)
    {
        global $h;
        if (file_exists($m)) {
            $h->error = lang(24);
            return false;
        }
        if (!check_sqlite_name($m))
            return false;
        try {
            $A = new Min_SQLite($m);
        }
        catch (Exception $Cc) {
            $h->error = $Cc->getMessage();
            return false;
        }
        $A->query('PRAGMA encoding = "UTF-8"');
        $A->query('CREATE TABLE adminer (i)');
        $A->query('DROP TABLE adminer');
        return true;
    }
    function drop_databases($l)
    {
        global $h;
        $h->__construct(":memory:");
        foreach ($l as $m) {
            if (!@unlink($m)) {
                $h->error = lang(24);
                return false;
            }
        }
        return true;
    }
    function rename_database($C, $d)
    {
        global $h;
        if (!check_sqlite_name($C))
            return false;
        $h->__construct(":memory:");
        $h->error = lang(24);
        return @rename(DB, $C);
    }
    function auto_increment()
    {
        return " PRIMARY KEY" . (DRIVER == "sqlite" ? " AUTOINCREMENT" : "");
    }
    function alter_table($Q, $C, $q, $ed, $vb, $wc, $d, $Na, $Xf)
    {
        global $h;
        $Si = ($Q == "" || $ed);
        foreach ($q as $p) {
            if ($p[0] != "" || !$p[1] || $p[2]) {
                $Si = true;
                break;
            }
        }
        $c  = array();
        $Lf = array();
        foreach ($q as $p) {
            if ($p[1]) {
                $c[] = ($Si ? $p[1] : "ADD " . implode($p[1]));
                if ($p[0] != "")
                    $Lf[$p[0]] = $p[1][0];
            }
        }
        if (!$Si) {
            foreach ($c as $X) {
                if (!queries("ALTER TABLE " . table($Q) . " $X"))
                    return false;
            }
            if ($Q != $C && !queries("ALTER TABLE " . table($Q) . " RENAME TO " . table($C)))
                return false;
        } elseif (!recreate_table($Q, $C, $c, $Lf, $ed, $Na))
            return false;
        if ($Na) {
            queries("BEGIN");
            queries("UPDATE sqlite_sequence SET seq = $Na WHERE name = " . q($C));
            if (!$h->affected_rows)
                queries("INSERT INTO sqlite_sequence (name, seq) VALUES (" . q($C) . ", $Na)");
            queries("COMMIT");
        }
        return true;
    }
    function recreate_table($Q, $C, $q, $Lf, $ed, $Na, $x = array())
    {
        global $h;
        if ($Q != "") {
            if (!$q) {
                foreach (fields($Q) as $z => $p) {
                    if ($x)
                        $p["auto_increment"] = 0;
                    $q[]    = process_field($p, $p);
                    $Lf[$z] = idf_escape($z);
                }
            }
            $og = false;
            foreach ($q as $p) {
                if ($p[6])
                    $og = true;
            }
            $jc = array();
            foreach ($x as $z => $X) {
                if ($X[2] == "DROP") {
                    $jc[$X[1]] = true;
                    unset($x[$z]);
                }
            }
            foreach (indexes($Q) as $ie => $w) {
                $f = array();
                foreach ($w["columns"] as $z => $e) {
                    if (!$Lf[$e])
                        continue 2;
                    $f[] = $Lf[$e] . ($w["descs"][$z] ? " DESC" : "");
                }
                if (!$jc[$ie]) {
                    if ($w["type"] != "PRIMARY" || !$og)
                        $x[] = array(
                            $w["type"],
                            $ie,
                            $f
                        );
                }
            }
            foreach ($x as $z => $X) {
                if ($X[0] == "PRIMARY") {
                    unset($x[$z]);
                    $ed[] = "  PRIMARY KEY (" . implode(", ", $X[2]) . ")";
                }
            }
            foreach (foreign_keys($Q) as $ie => $r) {
                foreach ($r["source"] as $z => $e) {
                    if (!$Lf[$e])
                        continue 2;
                    $r["source"][$z] = idf_unescape($Lf[$e]);
                }
                if (!isset($ed[" $ie"]))
                    $ed[] = " " . format_foreign_key($r);
            }
            queries("BEGIN");
        }
        foreach ($q as $z => $p)
            $q[$z] = "  " . implode($p);
        $q  = array_merge($q, array_filter($ed));
        $di = ($Q == $C ? "adminer_$C" : $C);
        if (!queries("CREATE TABLE " . table($di) . " (\n" . implode(",\n", $q) . "\n)"))
            return false;
        if ($Q != "") {
            if ($Lf && !queries("INSERT INTO " . table($di) . " (" . implode(", ", $Lf) . ") SELECT " . implode(", ", array_map('idf_escape', array_keys($Lf))) . " FROM " . table($Q)))
                return false;
            $Di = array();
            foreach (triggers($Q) as $Bi => $ki) {
                $Ai   = trigger($Bi);
                $Di[] = "CREATE TRIGGER " . idf_escape($Bi) . " " . implode(" ", $ki) . " ON " . table($C) . "\n$Ai[Statement]";
            }
            $Na = $Na ? 0 : $h->result("SELECT seq FROM sqlite_sequence WHERE name = " . q($Q));
            if (!queries("DROP TABLE " . table($Q)) || ($Q == $C && !queries("ALTER TABLE " . table($di) . " RENAME TO " . table($C))) || !alter_indexes($C, $x))
                return false;
            if ($Na)
                queries("UPDATE sqlite_sequence SET seq = $Na WHERE name = " . q($C));
            foreach ($Di as $Ai) {
                if (!queries($Ai))
                    return false;
            }
            queries("COMMIT");
        }
        return true;
    }
    function index_sql($Q, $T, $C, $f)
    {
        return "CREATE $T " . ($T != "INDEX" ? "INDEX " : "") . idf_escape($C != "" ? $C : uniqid($Q . "_")) . " ON " . table($Q) . " $f";
    }
    function alter_indexes($Q, $c)
    {
        foreach ($c as $ng) {
            if ($ng[0] == "PRIMARY")
                return recreate_table($Q, $Q, array(), array(), array(), 0, $c);
        }
        foreach (array_reverse($c) as $X) {
            if (!queries($X[2] == "DROP" ? "DROP INDEX " . idf_escape($X[1]) : index_sql($Q, $X[0], $X[1], "(" . implode(", ", $X[2]) . ")")))
                return false;
        }
        return true;
    }
    function truncate_tables($S)
    {
        return apply_queries("DELETE FROM", $S);
    }
    function drop_views($ej)
    {
        return apply_queries("DROP VIEW", $ej);
    }
    function drop_tables($S)
    {
        return apply_queries("DROP TABLE", $S);
    }
    function move_tables($S, $ej, $bi)
    {
        return false;
    }
    function trigger($C)
    {
        global $h;
        if ($C == "")
            return array(
                "Statement" => "BEGIN\n\t;\nEND"
            );
        $v  = '(?:[^`"\s]+|`[^`]*`|"[^"]*")+';
        $Ci = trigger_options();
        preg_match("~^CREATE\\s+TRIGGER\\s*$v\\s*(" . implode("|", $Ci["Timing"]) . ")\\s+([a-z]+)(?:\\s+OF\\s+($v))?\\s+ON\\s*$v\\s*(?:FOR\\s+EACH\\s+ROW\\s)?(.*)~is", $h->result("SELECT sql FROM sqlite_master WHERE type = 'trigger' AND name = " . q($C)), $B);
        $mf = $B[3];
        return array(
            "Timing" => strtoupper($B[1]),
            "Event" => strtoupper($B[2]) . ($mf ? " OF" : ""),
            "Of" => ($mf[0] == '`' || $mf[0] == '"' ? idf_unescape($mf) : $mf),
            "Trigger" => $C,
            "Statement" => $B[4]
        );
    }
    function triggers($Q)
    {
        $I  = array();
        $Ci = trigger_options();
        foreach (get_rows("SELECT * FROM sqlite_master WHERE type = 'trigger' AND tbl_name = " . q($Q)) as $J) {
            preg_match('~^CREATE\s+TRIGGER\s*(?:[^`"\s]+|`[^`]*`|"[^"]*")+\s*(' . implode("|", $Ci["Timing"]) . ')\s*(.*?)\s+ON\b~i', $J["sql"], $B);
            $I[$J["name"]] = array(
                $B[1],
                $B[2]
            );
        }
        return $I;
    }
    function trigger_options()
    {
        return array(
            "Timing" => array(
                "BEFORE",
                "AFTER",
                "INSTEAD OF"
            ),
            "Event" => array(
                "INSERT",
                "UPDATE",
                "UPDATE OF",
                "DELETE"
            ),
            "Type" => array(
                "FOR EACH ROW"
            )
        );
    }
    function begin()
    {
        return queries("BEGIN");
    }
    function last_id()
    {
        global $h;
        return $h->result("SELECT LAST_INSERT_ROWID()");
    }
    function explain($h, $G)
    {
        return $h->query("EXPLAIN QUERY PLAN $G");
    }
    function found_rows($R, $Z)
    {
    }
    function types()
    {
        return array();
    }
    function schemas()
    {
        return array();
    }
    function get_schema()
    {
        return "";
    }
    function set_schema($eh)
    {
        return true;
    }
    function create_sql($Q, $Na, $Mh)
    {
        global $h;
        $I = $h->result("SELECT sql FROM sqlite_master WHERE type IN ('table', 'view') AND name = " . q($Q));
        foreach (indexes($Q) as $C => $w) {
            if ($C == '')
                continue;
            $I .= ";\n\n" . index_sql($Q, $w['type'], $C, "(" . implode(", ", array_map('idf_escape', $w['columns'])) . ")");
        }
        return $I;
    }
    function truncate_sql($Q)
    {
        return "DELETE FROM " . table($Q);
    }
    function use_sql($k)
    {
    }
    function trigger_sql($Q)
    {
        return implode(get_vals("SELECT sql || ';;\n' FROM sqlite_master WHERE type = 'trigger' AND tbl_name = " . q($Q)));
    }
    function show_variables()
    {
        global $h;
        $I = array();
        foreach (array(
            "auto_vacuum",
            "cache_size",
            "count_changes",
            "default_cache_size",
            "empty_result_callbacks",
            "encoding",
            "foreign_keys",
            "full_column_names",
            "fullfsync",
            "journal_mode",
            "journal_size_limit",
            "legacy_file_format",
            "locking_mode",
            "page_size",
            "max_page_count",
            "read_uncommitted",
            "recursive_triggers",
            "reverse_unordered_selects",
            "secure_delete",
            "short_column_names",
            "synchronous",
            "temp_store",
            "temp_store_directory",
            "schema_version",
            "integrity_check",
            "quick_check"
        ) as $z)
            $I[$z] = $h->result("PRAGMA $z");
        return $I;
    }
    function show_status()
    {
        $I = array();
        foreach (get_vals("PRAGMA compile_options") as $_f) {
            list($z, $X) = explode("=", $_f, 2);
            $I[$z] = $X;
        }
        return $I;
    }
    function convert_field($p)
    {
    }
    function unconvert_field($p, $I)
    {
        return $I;
    }
    function support($Rc)
    {
        return preg_match('~^(columns|database|drop_col|dump|indexes|descidx|move_col|sql|status|table|trigger|variables|view|view_trigger)$~', $Rc);
    }
    $y  = "sqlite";
    $U  = array(
        "integer" => 0,
        "real" => 0,
        "numeric" => 0,
        "text" => 0,
        "blob" => 0
    );
    $Lh = array_keys($U);
    $Mi = array();
    $yf = array(
        "=",
        "<",
        ">",
        "<=",
        ">=",
        "!=",
        "LIKE",
        "LIKE %%",
        "IN",
        "IS NULL",
        "NOT LIKE",
        "NOT IN",
        "IS NOT NULL",
        "SQL"
    );
    $md = array(
        "hex",
        "length",
        "lower",
        "round",
        "unixepoch",
        "upper"
    );
    $sd = array(
        "avg",
        "count",
        "count distinct",
        "group_concat",
        "max",
        "min",
        "sum"
    );
    $oc = array(
        array(),
        array(
            "integer|real|numeric" => "+/-",
            "text" => "||"
        )
    );
}
$gc["pgsql"] = "PostgreSQL";
if (isset($_GET["pgsql"])) {
    $kg = array(
        "PgSQL",
        "PDO_PgSQL"
    );
    define("DRIVER", "pgsql");
    if (extension_loaded("pgsql")) {
        class Min_DB
        {
            var $extension = "PgSQL", $_link, $_result, $_string, $_database = true, $server_info, $affected_rows, $error, $timeout;
            function _error($zc, $o)
            {
                if (ini_bool("html_errors"))
                    $o = html_entity_decode(strip_tags($o));
                $o           = preg_replace('~^[^:]*: ~', '', $o);
                $this->error = $o;
            }
            function connect($N, $V, $F)
            {
                global $b;
                $m = $b->database();
                set_error_handler(array(
                    $this,
                    '_error'
                ));
                $this->_string = "host='" . str_replace(":", "' port='", addcslashes($N, "'\\")) . "' user='" . addcslashes($V, "'\\") . "' password='" . addcslashes($F, "'\\") . "'";
                $this->_link   = @pg_connect("$this->_string dbname='" . ($m != "" ? addcslashes($m, "'\\") : "postgres") . "'", PGSQL_CONNECT_FORCE_NEW);
                if (!$this->_link && $m != "") {
                    $this->_database = false;
                    $this->_link     = @pg_connect("$this->_string dbname='postgres'", PGSQL_CONNECT_FORCE_NEW);
                }
                restore_error_handler();
                if ($this->_link) {
                    $cj                = pg_version($this->_link);
                    $this->server_info = $cj["server"];
                    pg_set_client_encoding($this->_link, "UTF8");
                }
                return (bool) $this->_link;
            }
            function quote($P)
            {
                return "'" . pg_escape_string($this->_link, $P) . "'";
            }
            function value($X, $p)
            {
                return ($p["type"] == "bytea" ? pg_unescape_bytea($X) : $X);
            }
            function quoteBinary($P)
            {
                return "'" . pg_escape_bytea($this->_link, $P) . "'";
            }
            function select_db($k)
            {
                global $b;
                if ($k == $b->database())
                    return $this->_database;
                $I = @pg_connect("$this->_string dbname='" . addcslashes($k, "'\\") . "'", PGSQL_CONNECT_FORCE_NEW);
                if ($I)
                    $this->_link = $I;
                return $I;
            }
            function close()
            {
                $this->_link = @pg_connect("$this->_string dbname='postgres'");
            }
            function query($G, $Gi = false)
            {
                $H           = @pg_query($this->_link, $G);
                $this->error = "";
                if (!$H) {
                    $this->error = pg_last_error($this->_link);
                    $I           = false;
                } elseif (!pg_num_fields($H)) {
                    $this->affected_rows = pg_affected_rows($H);
                    $I                   = true;
                } else
                    $I = new Min_Result($H);
                if ($this->timeout) {
                    $this->timeout = 0;
                    $this->query("RESET statement_timeout");
                }
                return $I;
            }
            function multi_query($G)
            {
                return $this->_result = $this->query($G);
            }
            function store_result()
            {
                return $this->_result;
            }
            function next_result()
            {
                return false;
            }
            function result($G, $p = 0)
            {
                $H = $this->query($G);
                if (!$H || !$H->num_rows)
                    return false;
                return pg_fetch_result($H->_result, 0, $p);
            }
            function warnings()
            {
                return h(pg_last_notice($this->_link));
            }
        }
        class Min_Result
        {
            var $_result, $_offset = 0, $num_rows;
            function __construct($H)
            {
                $this->_result  = $H;
                $this->num_rows = pg_num_rows($H);
            }
            function fetch_assoc()
            {
                return pg_fetch_assoc($this->_result);
            }
            function fetch_row()
            {
                return pg_fetch_row($this->_result);
            }
            function fetch_field()
            {
                $e = $this->_offset++;
                $I = new stdClass;
                if (function_exists('pg_field_table'))
                    $I->orgtable = pg_field_table($this->_result, $e);
                $I->name      = pg_field_name($this->_result, $e);
                $I->orgname   = $I->name;
                $I->type      = pg_field_type($this->_result, $e);
                $I->charsetnr = ($I->type == "bytea" ? 63 : 0);
                return $I;
            }
            function __destruct()
            {
                pg_free_result($this->_result);
            }
        }
    } elseif (extension_loaded("pdo_pgsql")) {
        class Min_DB extends Min_PDO
        {
            var $extension = "PDO_PgSQL", $timeout;
            function connect($N, $V, $F)
            {
                global $b;
                $m = $b->database();
                $P = "pgsql:host='" . str_replace(":", "' port='", addcslashes($N, "'\\")) . "' options='-c client_encoding=utf8'";
                $this->dsn("$P dbname='" . ($m != "" ? addcslashes($m, "'\\") : "postgres") . "'", $V, $F);
                return true;
            }
            function select_db($k)
            {
                global $b;
                return ($b->database() == $k);
            }
            function quoteBinary($bh)
            {
                return q($bh);
            }
            function query($G, $Gi = false)
            {
                $I = parent::query($G, $Gi);
                if ($this->timeout) {
                    $this->timeout = 0;
                    parent::query("RESET statement_timeout");
                }
                return $I;
            }
            function warnings()
            {
                return '';
            }
            function close()
            {
            }
        }
    }
    class Min_Driver extends Min_SQL
    {
        function insertUpdate($Q, $K, $ng)
        {
            global $h;
            foreach ($K as $O) {
                $Ni = array();
                $Z  = array();
                foreach ($O as $z => $X) {
                    $Ni[] = "$z = $X";
                    if (isset($ng[idf_unescape($z)]))
                        $Z[] = "$z = $X";
                }
                if (!(($Z && queries("UPDATE " . table($Q) . " SET " . implode(", ", $Ni) . " WHERE " . implode(" AND ", $Z)) && $h->affected_rows) || queries("INSERT INTO " . table($Q) . " (" . implode(", ", array_keys($O)) . ") VALUES (" . implode(", ", $O) . ")")))
                    return false;
            }
            return true;
        }
        function slowQuery($G, $ji)
        {
            $this->_conn->query("SET statement_timeout = " . (1000 * $ji));
            $this->_conn->timeout = 1000 * $ji;
            return $G;
        }
        function convertSearch($v, $X, $p)
        {
            return (preg_match('~char|text' . (!preg_match('~LIKE~', $X["op"]) ? '|date|time(stamp)?|boolean|uuid|' . number_type() : '') . '~', $p["type"]) ? $v : "CAST($v AS text)");
        }
        function quoteBinary($bh)
        {
            return $this->_conn->quoteBinary($bh);
        }
        function warnings()
        {
            return $this->_conn->warnings();
        }
        function tableHelp($C)
        {
            $ze = array(
                "information_schema" => "infoschema",
                "pg_catalog" => "catalog"
            );
            $A  = $ze[$_GET["ns"]];
            if ($A)
                return "$A-" . str_replace("_", "-", $C) . ".html";
        }
    }
    function idf_escape($v)
    {
        return '"' . str_replace('"', '""', $v) . '"';
    }
    function table($v)
    {
        return idf_escape($v);
    }
    function connect()
    {
        global $b, $U, $Lh;
        $h  = new Min_DB;
        $Ib = $b->credentials();
        if ($h->connect($Ib[0], $Ib[1], $Ib[2])) {
            if (min_version(9, 0, $h)) {
                $h->query("SET application_name = 'Adminer'");
                if (min_version(9.2, 0, $h)) {
                    $Lh[lang(25)][] = "json";
                    $U["json"]      = 4294967295;
                    if (min_version(9.4, 0, $h)) {
                        $Lh[lang(25)][] = "jsonb";
                        $U["jsonb"]     = 4294967295;
                    }
                }
            }
            return $h;
        }
        return $h->error;
    }
    function get_databases()
    {
        return get_vals("SELECT datname FROM pg_database WHERE has_database_privilege(datname, 'CONNECT') ORDER BY datname");
    }
    function limit($G, $Z, $_, $D = 0, $M = " ")
    {
        return " $G$Z" . ($_ !== null ? $M . "LIMIT $_" . ($D ? " OFFSET $D" : "") : "");
    }
    function limit1($Q, $G, $Z, $M = "\n")
    {
        return (preg_match('~^INTO~', $G) ? limit($G, $Z, 1, 0, $M) : " $G" . (is_view(table_status1($Q)) ? $Z : " WHERE ctid = (SELECT ctid FROM " . table($Q) . $Z . $M . "LIMIT 1)"));
    }
    function db_collation($m, $qb)
    {
        global $h;
        return $h->result("SHOW LC_COLLATE");
    }
    function engines()
    {
        return array();
    }
    function logged_user()
    {
        global $h;
        return $h->result("SELECT user");
    }
    function tables_list()
    {
        $G = "SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = current_schema()";
        if (support('materializedview'))
            $G .= "
UNION ALL
SELECT matviewname, 'MATERIALIZED VIEW'
FROM pg_matviews
WHERE schemaname = current_schema()";
        $G .= "
ORDER BY 1";
        return get_key_vals($G);
    }
    function count_tables($l)
    {
        return array();
    }
    function table_status($C = "")
    {
        $I = array();
        foreach (get_rows("SELECT c.relname AS \"Name\", CASE c.relkind WHEN 'r' THEN 'table' WHEN 'm' THEN 'materialized view' ELSE 'view' END AS \"Engine\", pg_relation_size(c.oid) AS \"Data_length\", pg_total_relation_size(c.oid) - pg_relation_size(c.oid) AS \"Index_length\", obj_description(c.oid, 'pg_class') AS \"Comment\", " . (min_version(12) ? "''" : "CASE WHEN c.relhasoids THEN 'oid' ELSE '' END") . " AS \"Oid\", c.reltuples as \"Rows\", n.nspname
FROM pg_class c
JOIN pg_namespace n ON(n.nspname = current_schema() AND n.oid = c.relnamespace)
WHERE relkind IN ('r', 'm', 'v', 'f')
" . ($C != "" ? "AND relname = " . q($C) : "ORDER BY relname")) as $J)
            $I[$J["Name"]] = $J;
        return ($C != "" ? $I[$C] : $I);
    }
    function is_view($R)
    {
        return in_array($R["Engine"], array(
            "view",
            "materialized view"
        ));
    }
    function fk_support($R)
    {
        return true;
    }
    function fields($Q)
    {
        $I  = array();
        $Da = array(
            'timestamp without time zone' => 'timestamp',
            'timestamp with time zone' => 'timestamptz'
        );
        $Fd = min_version(10) ? "(a.attidentity = 'd')::int" : '0';
        foreach (get_rows("SELECT a.attname AS field, format_type(a.atttypid, a.atttypmod) AS full_type, d.adsrc AS default, a.attnotnull::int, col_description(c.oid, a.attnum) AS comment, $Fd AS identity
FROM pg_class c
JOIN pg_namespace n ON c.relnamespace = n.oid
JOIN pg_attribute a ON c.oid = a.attrelid
LEFT JOIN pg_attrdef d ON c.oid = d.adrelid AND a.attnum = d.adnum
WHERE c.relname = " . q($Q) . "
AND n.nspname = current_schema()
AND NOT a.attisdropped
AND a.attnum > 0
ORDER BY a.attnum") as $J) {
            preg_match('~([^([]+)(\((.*)\))?([a-z ]+)?((\[[0-9]*])*)$~', $J["full_type"], $B);
            list(, $T, $we, $J["length"], $xa, $Ga) = $B;
            $J["length"] .= $Ga;
            $fb = $T . $xa;
            if (isset($Da[$fb])) {
                $J["type"]      = $Da[$fb];
                $J["full_type"] = $J["type"] . $we . $Ga;
            } else {
                $J["type"]      = $T;
                $J["full_type"] = $J["type"] . $we . $xa . $Ga;
            }
            if ($J['identity'])
                $J['default'] = 'GENERATED BY DEFAULT AS IDENTITY';
            $J["null"]           = !$J["attnotnull"];
            $J["auto_increment"] = $J['identity'] || preg_match('~^nextval\(~i', $J["default"]);
            $J["privileges"]     = array(
                "insert" => 1,
                "select" => 1,
                "update" => 1
            );
            if (preg_match('~(.+)::[^)]+(.*)~', $J["default"], $B))
                $J["default"] = ($B[1] == "NULL" ? null : (($B[1][0] == "'" ? idf_unescape($B[1]) : $B[1]) . $B[2]));
            $I[$J["field"]] = $J;
        }
        return $I;
    }
    function indexes($Q, $i = null)
    {
        global $h;
        if (!is_object($i))
            $i = $h;
        $I  = array();
        $Uh = $i->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = " . q($Q));
        $f  = get_key_vals("SELECT attnum, attname FROM pg_attribute WHERE attrelid = $Uh AND attnum > 0", $i);
        foreach (get_rows("SELECT relname, indisunique::int, indisprimary::int, indkey, indoption , (indpred IS NOT NULL)::int as indispartial FROM pg_index i, pg_class ci WHERE i.indrelid = $Uh AND ci.oid = i.indexrelid", $i) as $J) {
            $Lg                = $J["relname"];
            $I[$Lg]["type"]    = ($J["indispartial"] ? "INDEX" : ($J["indisprimary"] ? "PRIMARY" : ($J["indisunique"] ? "UNIQUE" : "INDEX")));
            $I[$Lg]["columns"] = array();
            foreach (explode(" ", $J["indkey"]) as $Pd)
                $I[$Lg]["columns"][] = $f[$Pd];
            $I[$Lg]["descs"] = array();
            foreach (explode(" ", $J["indoption"]) as $Qd)
                $I[$Lg]["descs"][] = ($Qd & 1 ? '1' : null);
            $I[$Lg]["lengths"] = array();
        }
        return $I;
    }
    function foreign_keys($Q)
    {
        global $tf;
        $I = array();
        foreach (get_rows("SELECT conname, condeferrable::int AS deferrable, pg_get_constraintdef(oid) AS definition
FROM pg_constraint
WHERE conrelid = (SELECT pc.oid FROM pg_class AS pc INNER JOIN pg_namespace AS pn ON (pn.oid = pc.relnamespace) WHERE pc.relname = " . q($Q) . " AND pn.nspname = current_schema())
AND contype = 'f'::char
ORDER BY conkey, conname") as $J) {
            if (preg_match('~FOREIGN KEY\s*\((.+)\)\s*REFERENCES (.+)\((.+)\)(.*)$~iA', $J['definition'], $B)) {
                $J['source'] = array_map('trim', explode(',', $B[1]));
                if (preg_match('~^(("([^"]|"")+"|[^"]+)\.)?"?("([^"]|"")+"|[^"]+)$~', $B[2], $Fe)) {
                    $J['ns']    = str_replace('""', '"', preg_replace('~^"(.+)"$~', '\1', $Fe[2]));
                    $J['table'] = str_replace('""', '"', preg_replace('~^"(.+)"$~', '\1', $Fe[4]));
                }
                $J['target']      = array_map('trim', explode(',', $B[3]));
                $J['on_delete']   = (preg_match("~ON DELETE ($tf)~", $B[4], $Fe) ? $Fe[1] : 'NO ACTION');
                $J['on_update']   = (preg_match("~ON UPDATE ($tf)~", $B[4], $Fe) ? $Fe[1] : 'NO ACTION');
                $I[$J['conname']] = $J;
            }
        }
        return $I;
    }
    function view($C)
    {
        global $h;
        return array(
            "select" => trim($h->result("SELECT pg_get_viewdef(" . $h->result("SELECT oid FROM pg_class WHERE relname = " . q($C)) . ")"))
        );
    }
    function collations()
    {
        return array();
    }
    function information_schema($m)
    {
        return ($m == "information_schema");
    }
    function error()
    {
        global $h;
        $I = h($h->error);
        if (preg_match('~^(.*\n)?([^\n]*)\n( *)\^(\n.*)?$~s', $I, $B))
            $I = $B[1] . preg_replace('~((?:[^&]|&[^;]*;){' . strlen($B[3]) . '})(.*)~', '\1<b>\2</b>', $B[2]) . $B[4];
        return nl_br($I);
    }
    function create_database($m, $d)
    {
        return queries("CREATE DATABASE " . idf_escape($m) . ($d ? " ENCODING " . idf_escape($d) : ""));
    }
    function drop_databases($l)
    {
        global $h;
        $h->close();
        return apply_queries("DROP DATABASE", $l, 'idf_escape');
    }
    function rename_database($C, $d)
    {
        return queries("ALTER DATABASE " . idf_escape(DB) . " RENAME TO " . idf_escape($C));
    }
    function auto_increment()
    {
        return "";
    }
    function alter_table($Q, $C, $q, $ed, $vb, $wc, $d, $Na, $Xf)
    {
        $c  = array();
        $yg = array();
        if ($Q != "" && $Q != $C)
            $yg[] = "ALTER TABLE " . table($Q) . " RENAME TO " . table($C);
        foreach ($q as $p) {
            $e = idf_escape($p[0]);
            $X = $p[1];
            if (!$X)
                $c[] = "DROP $e";
            else {
                $Yi = $X[5];
                unset($X[5]);
                if (isset($X[6]) && $p[0] == "")
                    $X[1] = ($X[1] == "bigint" ? " big" : " ") . "serial";
                if ($p[0] == "")
                    $c[] = ($Q != "" ? "ADD " : "  ") . implode($X);
                else {
                    if ($e != $X[0])
                        $yg[] = "ALTER TABLE " . table($C) . " RENAME $e TO $X[0]";
                    $c[] = "ALTER $e TYPE$X[1]";
                    if (!$X[6]) {
                        $c[] = "ALTER $e " . ($X[3] ? "SET$X[3]" : "DROP DEFAULT");
                        $c[] = "ALTER $e " . ($X[2] == " NULL" ? "DROP NOT" : "SET") . $X[2];
                    }
                }
                if ($p[0] != "" || $Yi != "")
                    $yg[] = "COMMENT ON COLUMN " . table($C) . ".$X[0] IS " . ($Yi != "" ? substr($Yi, 9) : "''");
            }
        }
        $c = array_merge($c, $ed);
        if ($Q == "")
            array_unshift($yg, "CREATE TABLE " . table($C) . " (\n" . implode(",\n", $c) . "\n)");
        elseif ($c)
            array_unshift($yg, "ALTER TABLE " . table($Q) . "\n" . implode(",\n", $c));
        if ($Q != "" || $vb != "")
            $yg[] = "COMMENT ON TABLE " . table($C) . " IS " . q($vb);
        if ($Na != "") {
        }
        foreach ($yg as $G) {
            if (!queries($G))
                return false;
        }
        return true;
    }
    function alter_indexes($Q, $c)
    {
        $j  = array();
        $hc = array();
        $yg = array();
        foreach ($c as $X) {
            if ($X[0] != "INDEX")
                $j[] = ($X[2] == "DROP" ? "\nDROP CONSTRAINT " . idf_escape($X[1]) : "\nADD" . ($X[1] != "" ? " CONSTRAINT " . idf_escape($X[1]) : "") . " $X[0] " . ($X[0] == "PRIMARY" ? "KEY " : "") . "(" . implode(", ", $X[2]) . ")");
            elseif ($X[2] == "DROP")
                $hc[] = idf_escape($X[1]);
            else
                $yg[] = "CREATE INDEX " . idf_escape($X[1] != "" ? $X[1] : uniqid($Q . "_")) . " ON " . table($Q) . " (" . implode(", ", $X[2]) . ")";
        }
        if ($j)
            array_unshift($yg, "ALTER TABLE " . table($Q) . implode(",", $j));
        if ($hc)
            array_unshift($yg, "DROP INDEX " . implode(", ", $hc));
        foreach ($yg as $G) {
            if (!queries($G))
                return false;
        }
        return true;
    }
    function truncate_tables($S)
    {
        return queries("TRUNCATE " . implode(", ", array_map('table', $S)));
        return true;
    }
    function drop_views($ej)
    {
        return drop_tables($ej);
    }
    function drop_tables($S)
    {
        foreach ($S as $Q) {
            $Ih = table_status($Q);
            if (!queries("DROP " . strtoupper($Ih["Engine"]) . " " . table($Q)))
                return false;
        }
        return true;
    }
    function move_tables($S, $ej, $bi)
    {
        foreach (array_merge($S, $ej) as $Q) {
            $Ih = table_status($Q);
            if (!queries("ALTER " . strtoupper($Ih["Engine"]) . " " . table($Q) . " SET SCHEMA " . idf_escape($bi)))
                return false;
        }
        return true;
    }
    function trigger($C, $Q = null)
    {
        if ($C == "")
            return array(
                "Statement" => "EXECUTE PROCEDURE ()"
            );
        if ($Q === null)
            $Q = $_GET['trigger'];
        $K = get_rows('SELECT t.trigger_name AS "Trigger", t.action_timing AS "Timing", (SELECT STRING_AGG(event_manipulation, \' OR \') FROM information_schema.triggers WHERE event_object_table = t.event_object_table AND trigger_name = t.trigger_name ) AS "Events", t.event_manipulation AS "Event", \'FOR EACH \' || t.action_orientation AS "Type", t.action_statement AS "Statement" FROM information_schema.triggers t WHERE t.event_object_table = ' . q($Q) . ' AND t.trigger_name = ' . q($C));
        return reset($K);
    }
    function triggers($Q)
    {
        $I = array();
        foreach (get_rows("SELECT * FROM information_schema.triggers WHERE event_object_table = " . q($Q)) as $J)
            $I[$J["trigger_name"]] = array(
                $J["action_timing"],
                $J["event_manipulation"]
            );
        return $I;
    }
    function trigger_options()
    {
        return array(
            "Timing" => array(
                "BEFORE",
                "AFTER"
            ),
            "Event" => array(
                "INSERT",
                "UPDATE",
                "DELETE"
            ),
            "Type" => array(
                "FOR EACH ROW",
                "FOR EACH STATEMENT"
            )
        );
    }
    function routine($C, $T)
    {
        $K            = get_rows('SELECT routine_definition AS definition, LOWER(external_language) AS language, *
FROM information_schema.routines
WHERE routine_schema = current_schema() AND specific_name = ' . q($C));
        $I            = $K[0];
        $I["returns"] = array(
            "type" => $I["type_udt_name"]
        );
        $I["fields"]  = get_rows('SELECT parameter_name AS field, data_type AS type, character_maximum_length AS length, parameter_mode AS inout
FROM information_schema.parameters
WHERE specific_schema = current_schema() AND specific_name = ' . q($C) . '
ORDER BY ordinal_position');
        return $I;
    }
    function routines()
    {
        return get_rows('SELECT specific_name AS "SPECIFIC_NAME", routine_type AS "ROUTINE_TYPE", routine_name AS "ROUTINE_NAME", type_udt_name AS "DTD_IDENTIFIER"
FROM information_schema.routines
WHERE routine_schema = current_schema()
ORDER BY SPECIFIC_NAME');
    }
    function routine_languages()
    {
        return get_vals("SELECT LOWER(lanname) FROM pg_catalog.pg_language");
    }
    function routine_id($C, $J)
    {
        $I = array();
        foreach ($J["fields"] as $p)
            $I[] = $p["type"];
        return idf_escape($C) . "(" . implode(", ", $I) . ")";
    }
    function last_id()
    {
        return 0;
    }
    function explain($h, $G)
    {
        return $h->query("EXPLAIN $G");
    }
    function found_rows($R, $Z)
    {
        global $h;
        if (preg_match("~ rows=([0-9]+)~", $h->result("EXPLAIN SELECT * FROM " . idf_escape($R["Name"]) . ($Z ? " WHERE " . implode(" AND ", $Z) : "")), $Kg))
            return $Kg[1];
        return false;
    }
    function types()
    {
        return get_vals("SELECT typname
FROM pg_type
WHERE typnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema())
AND typtype IN ('b','d','e')
AND typelem = 0");
    }
    function schemas()
    {
        return get_vals("SELECT nspname FROM pg_namespace ORDER BY nspname");
    }
    function get_schema()
    {
        global $h;
        return $h->result("SELECT current_schema()");
    }
    function set_schema($dh)
    {
        global $h, $U, $Lh;
        $I = $h->query("SET search_path TO " . idf_escape($dh));
        foreach (types() as $T) {
            if (!isset($U[$T])) {
                $U[$T]          = 0;
                $Lh[lang(26)][] = $T;
            }
        }
        return $I;
    }
    function create_sql($Q, $Na, $Mh)
    {
        global $h;
        $I  = '';
        $Tg = array();
        $nh = array();
        $Ih = table_status($Q);
        $q  = fields($Q);
        $x  = indexes($Q);
        ksort($x);
        $bd = foreign_keys($Q);
        ksort($bd);
        if (!$Ih || empty($q))
            return false;
        $I = "CREATE TABLE " . idf_escape($Ih['nspname']) . "." . idf_escape($Ih['Name']) . " (\n    ";
        foreach ($q as $Tc => $p) {
            $Uf   = idf_escape($p['field']) . ' ' . $p['full_type'] . default_value($p) . ($p['attnotnull'] ? " NOT NULL" : "");
            $Tg[] = $Uf;
            if (preg_match('~nextval\(\'([^\']+)\'\)~', $p['default'], $Ge)) {
                $mh   = $Ge[1];
                $Ah   = reset(get_rows(min_version(10) ? "SELECT *, cache_size AS cache_value FROM pg_sequences WHERE schemaname = current_schema() AND sequencename = " . q($mh) : "SELECT * FROM $mh"));
                $nh[] = ($Mh == "DROP+CREATE" ? "DROP SEQUENCE IF EXISTS $mh;\n" : "") . "CREATE SEQUENCE $mh INCREMENT $Ah[increment_by] MINVALUE $Ah[min_value] MAXVALUE $Ah[max_value] START " . ($Na ? $Ah['last_value'] : 1) . " CACHE $Ah[cache_value];";
            }
        }
        if (!empty($nh))
            $I = implode("\n\n", $nh) . "\n\n$I";
        foreach ($x as $Kd => $w) {
            switch ($w['type']) {
                case 'UNIQUE':
                    $Tg[] = "CONSTRAINT " . idf_escape($Kd) . " UNIQUE (" . implode(', ', array_map('idf_escape', $w['columns'])) . ")";
                    break;
                case 'PRIMARY':
                    $Tg[] = "CONSTRAINT " . idf_escape($Kd) . " PRIMARY KEY (" . implode(', ', array_map('idf_escape', $w['columns'])) . ")";
                    break;
            }
        }
        foreach ($bd as $ad => $Zc)
            $Tg[] = "CONSTRAINT " . idf_escape($ad) . " $Zc[definition] " . ($Zc['deferrable'] ? 'DEFERRABLE' : 'NOT DEFERRABLE');
        $I .= implode(",\n    ", $Tg) . "\n) WITH (oids = " . ($Ih['Oid'] ? 'true' : 'false') . ");";
        foreach ($x as $Kd => $w) {
            if ($w['type'] == 'INDEX') {
                $f = array();
                foreach ($w['columns'] as $z => $X)
                    $f[] = idf_escape($X) . ($w['descs'][$z] ? " DESC" : "");
                $I .= "\n\nCREATE INDEX " . idf_escape($Kd) . " ON " . idf_escape($Ih['nspname']) . "." . idf_escape($Ih['Name']) . " USING btree (" . implode(', ', $f) . ");";
            }
        }
        if ($Ih['Comment'])
            $I .= "\n\nCOMMENT ON TABLE " . idf_escape($Ih['nspname']) . "." . idf_escape($Ih['Name']) . " IS " . q($Ih['Comment']) . ";";
        foreach ($q as $Tc => $p) {
            if ($p['comment'])
                $I .= "\n\nCOMMENT ON COLUMN " . idf_escape($Ih['nspname']) . "." . idf_escape($Ih['Name']) . "." . idf_escape($Tc) . " IS " . q($p['comment']) . ";";
        }
        return rtrim($I, ';');
    }
    function truncate_sql($Q)
    {
        return "TRUNCATE " . table($Q);
    }
    function trigger_sql($Q)
    {
        $Ih = table_status($Q);
        $I  = "";
        foreach (triggers($Q) as $_i => $zi) {
            $Ai = trigger($_i, $Ih['Name']);
            $I .= "\nCREATE TRIGGER " . idf_escape($Ai['Trigger']) . " $Ai[Timing] $Ai[Events] ON " . idf_escape($Ih["nspname"]) . "." . idf_escape($Ih['Name']) . " $Ai[Type] $Ai[Statement];;\n";
        }
        return $I;
    }
    function use_sql($k)
    {
        return "\connect " . idf_escape($k);
    }
    function show_variables()
    {
        return get_key_vals("SHOW ALL");
    }
    function process_list()
    {
        return get_rows("SELECT * FROM pg_stat_activity ORDER BY " . (min_version(9.2) ? "pid" : "procpid"));
    }
    function show_status()
    {
    }
    function convert_field($p)
    {
    }
    function unconvert_field($p, $I)
    {
        return $I;
    }
    function support($Rc)
    {
        return preg_match('~^(database|table|columns|sql|indexes|descidx|comment|view|' . (min_version(9.3) ? 'materializedview|' : '') . 'scheme|routine|processlist|sequence|trigger|type|variables|drop_col|kill|dump)$~', $Rc);
    }
    function kill_process($X)
    {
        return queries("SELECT pg_terminate_backend(" . number($X) . ")");
    }
    function connection_id()
    {
        return "SELECT pg_backend_pid()";
    }
    function max_connections()
    {
        global $h;
        return $h->result("SHOW max_connections");
    }
    $y  = "pgsql";
    $U  = array();
    $Lh = array();
    foreach (array(
        lang(27) => array(
            "smallint" => 5,
            "integer" => 10,
            "bigint" => 19,
            "boolean" => 1,
            "numeric" => 0,
            "real" => 7,
            "double precision" => 16,
            "money" => 20
        ),
        lang(28) => array(
            "date" => 13,
            "time" => 17,
            "timestamp" => 20,
            "timestamptz" => 21,
            "interval" => 0
        ),
        lang(25) => array(
            "character" => 0,
            "character varying" => 0,
            "text" => 0,
            "tsquery" => 0,
            "tsvector" => 0,
            "uuid" => 0,
            "xml" => 0
        ),
        lang(29) => array(
            "bit" => 0,
            "bit varying" => 0,
            "bytea" => 0
        ),
        lang(30) => array(
            "cidr" => 43,
            "inet" => 43,
            "macaddr" => 17,
            "txid_snapshot" => 0
        ),
        lang(31) => array(
            "box" => 0,
            "circle" => 0,
            "line" => 0,
            "lseg" => 0,
            "path" => 0,
            "point" => 0,
            "polygon" => 0
        )
    ) as $z => $X) {
        $U += $X;
        $Lh[$z] = array_keys($X);
    }
    $Mi = array();
    $yf = array(
        "=",
        "<",
        ">",
        "<=",
        ">=",
        "!=",
        "~",
        "!~",
        "LIKE",
        "LIKE %%",
        "ILIKE",
        "ILIKE %%",
        "IN",
        "IS NULL",
        "NOT LIKE",
        "NOT IN",
        "IS NOT NULL"
    );
    $md = array(
        "char_length",
        "lower",
        "round",
        "to_hex",
        "to_timestamp",
        "upper"
    );
    $sd = array(
        "avg",
        "count",
        "count distinct",
        "max",
        "min",
        "sum"
    );
    $oc = array(
        array(
            "char" => "md5",
            "date|time" => "now"
        ),
        array(
            number_type() => "+/-",
            "date|time" => "+ interval/- interval",
            "char|text" => "||"
        )
    );
}
$gc["oracle"] = "Oracle (beta)";
if (isset($_GET["oracle"])) {
    $kg = array(
        "OCI8",
        "PDO_OCI"
    );
    define("DRIVER", "oracle");
    if (extension_loaded("oci8")) {
        class Min_DB
        {
            var $extension = "oci8", $_link, $_result, $server_info, $affected_rows, $errno, $error;
            function _error($zc, $o)
            {
                if (ini_bool("html_errors"))
                    $o = html_entity_decode(strip_tags($o));
                $o           = preg_replace('~^[^:]*: ~', '', $o);
                $this->error = $o;
            }
            function connect($N, $V, $F)
            {
                $this->_link = @oci_new_connect($V, $F, $N, "AL32UTF8");
                if ($this->_link) {
                    $this->server_info = oci_server_version($this->_link);
                    return true;
                }
                $o           = oci_error();
                $this->error = $o["message"];
                return false;
            }
            function quote($P)
            {
                return "'" . str_replace("'", "''", $P) . "'";
            }
            function select_db($k)
            {
                return true;
            }
            function query($G, $Gi = false)
            {
                $H           = oci_parse($this->_link, $G);
                $this->error = "";
                if (!$H) {
                    $o           = oci_error($this->_link);
                    $this->errno = $o["code"];
                    $this->error = $o["message"];
                    return false;
                }
                set_error_handler(array(
                    $this,
                    '_error'
                ));
                $I = @oci_execute($H);
                restore_error_handler();
                if ($I) {
                    if (oci_num_fields($H))
                        return new Min_Result($H);
                    $this->affected_rows = oci_num_rows($H);
                }
                return $I;
            }
            function multi_query($G)
            {
                return $this->_result = $this->query($G);
            }
            function store_result()
            {
                return $this->_result;
            }
            function next_result()
            {
                return false;
            }
            function result($G, $p = 1)
            {
                $H = $this->query($G);
                if (!is_object($H) || !oci_fetch($H->_result))
                    return false;
                return oci_result($H->_result, $p);
            }
        }
        class Min_Result
        {
            var $_result, $_offset = 1, $num_rows;
            function __construct($H)
            {
                $this->_result = $H;
            }
            function _convert($J)
            {
                foreach ((array) $J as $z => $X) {
                    if (is_a($X, 'OCI-Lob'))
                        $J[$z] = $X->load();
                }
                return $J;
            }
            function fetch_assoc()
            {
                return $this->_convert(oci_fetch_assoc($this->_result));
            }
            function fetch_row()
            {
                return $this->_convert(oci_fetch_row($this->_result));
            }
            function fetch_field()
            {
                $e            = $this->_offset++;
                $I            = new stdClass;
                $I->name      = oci_field_name($this->_result, $e);
                $I->orgname   = $I->name;
                $I->type      = oci_field_type($this->_result, $e);
                $I->charsetnr = (preg_match("~raw|blob|bfile~", $I->type) ? 63 : 0);
                return $I;
            }
            function __destruct()
            {
                oci_free_statement($this->_result);
            }
        }
    } elseif (extension_loaded("pdo_oci")) {
        class Min_DB extends Min_PDO
        {
            var $extension = "PDO_OCI";
            function connect($N, $V, $F)
            {
                $this->dsn("oci:dbname=//$N;charset=AL32UTF8", $V, $F);
                return true;
            }
            function select_db($k)
            {
                return true;
            }
        }
    }
    class Min_Driver extends Min_SQL
    {
        function begin()
        {
            return true;
        }
    }
    function idf_escape($v)
    {
        return '"' . str_replace('"', '""', $v) . '"';
    }
    function table($v)
    {
        return idf_escape($v);
    }
    function connect()
    {
        global $b;
        $h  = new Min_DB;
        $Ib = $b->credentials();
        if ($h->connect($Ib[0], $Ib[1], $Ib[2]))
            return $h;
        return $h->error;
    }
    function get_databases()
    {
        return get_vals("SELECT tablespace_name FROM user_tablespaces");
    }
    function limit($G, $Z, $_, $D = 0, $M = " ")
    {
        return ($D ? " * FROM (SELECT t.*, rownum AS rnum FROM (SELECT $G$Z) t WHERE rownum <= " . ($_ + $D) . ") WHERE rnum > $D" : ($_ !== null ? " * FROM (SELECT $G$Z) WHERE rownum <= " . ($_ + $D) : " $G$Z"));
    }
    function limit1($Q, $G, $Z, $M = "\n")
    {
        return " $G$Z";
    }
    function db_collation($m, $qb)
    {
        global $h;
        return $h->result("SELECT value FROM nls_database_parameters WHERE parameter = 'NLS_CHARACTERSET'");
    }
    function engines()
    {
        return array();
    }
    function logged_user()
    {
        global $h;
        return $h->result("SELECT USER FROM DUAL");
    }
    function tables_list()
    {
        return get_key_vals("SELECT table_name, 'table' FROM all_tables WHERE tablespace_name = " . q(DB) . "
UNION SELECT view_name, 'view' FROM user_views
ORDER BY 1");
    }
    function count_tables($l)
    {
        return array();
    }
    function table_status($C = "")
    {
        $I  = array();
        $fh = q($C);
        foreach (get_rows('SELECT table_name "Name", \'table\' "Engine", avg_row_len * num_rows "Data_length", num_rows "Rows" FROM all_tables WHERE tablespace_name = ' . q(DB) . ($C != "" ? " AND table_name = $fh" : "") . "
UNION SELECT view_name, 'view', 0, 0 FROM user_views" . ($C != "" ? " WHERE view_name = $fh" : "") . "
ORDER BY 1") as $J) {
            if ($C != "")
                return $J;
            $I[$J["Name"]] = $J;
        }
        return $I;
    }
    function is_view($R)
    {
        return $R["Engine"] == "view";
    }
    function fk_support($R)
    {
        return true;
    }
    function fields($Q)
    {
        $I = array();
        foreach (get_rows("SELECT * FROM all_tab_columns WHERE table_name = " . q($Q) . " ORDER BY column_id") as $J) {
            $T  = $J["DATA_TYPE"];
            $we = "$J[DATA_PRECISION],$J[DATA_SCALE]";
            if ($we == ",")
                $we = $J["DATA_LENGTH"];
            $I[$J["COLUMN_NAME"]] = array(
                "field" => $J["COLUMN_NAME"],
                "full_type" => $T . ($we ? "($we)" : ""),
                "type" => strtolower($T),
                "length" => $we,
                "default" => $J["DATA_DEFAULT"],
                "null" => ($J["NULLABLE"] == "Y"),
                "privileges" => array(
                    "insert" => 1,
                    "select" => 1,
                    "update" => 1
                )
            );
        }
        return $I;
    }
    function indexes($Q, $i = null)
    {
        $I = array();
        foreach (get_rows("SELECT uic.*, uc.constraint_type
FROM user_ind_columns uic
LEFT JOIN user_constraints uc ON uic.index_name = uc.constraint_name AND uic.table_name = uc.table_name
WHERE uic.table_name = " . q($Q) . "
ORDER BY uc.constraint_type, uic.column_position", $i) as $J) {
            $Kd                  = $J["INDEX_NAME"];
            $I[$Kd]["type"]      = ($J["CONSTRAINT_TYPE"] == "P" ? "PRIMARY" : ($J["CONSTRAINT_TYPE"] == "U" ? "UNIQUE" : "INDEX"));
            $I[$Kd]["columns"][] = $J["COLUMN_NAME"];
            $I[$Kd]["lengths"][] = ($J["CHAR_LENGTH"] && $J["CHAR_LENGTH"] != $J["COLUMN_LENGTH"] ? $J["CHAR_LENGTH"] : null);
            $I[$Kd]["descs"][]   = ($J["DESCEND"] ? '1' : null);
        }
        return $I;
    }
    function view($C)
    {
        $K = get_rows('SELECT text "select" FROM user_views WHERE view_name = ' . q($C));
        return reset($K);
    }
    function collations()
    {
        return array();
    }
    function information_schema($m)
    {
        return false;
    }
    function error()
    {
        global $h;
        return h($h->error);
    }
    function explain($h, $G)
    {
        $h->query("EXPLAIN PLAN FOR $G");
        return $h->query("SELECT * FROM plan_table");
    }
    function found_rows($R, $Z)
    {
    }
    function alter_table($Q, $C, $q, $ed, $vb, $wc, $d, $Na, $Xf)
    {
        $c = $hc = array();
        foreach ($q as $p) {
            $X = $p[1];
            if ($X && $p[0] != "" && idf_escape($p[0]) != $X[0])
                queries("ALTER TABLE " . table($Q) . " RENAME COLUMN " . idf_escape($p[0]) . " TO $X[0]");
            if ($X)
                $c[] = ($Q != "" ? ($p[0] != "" ? "MODIFY (" : "ADD (") : "  ") . implode($X) . ($Q != "" ? ")" : "");
            else
                $hc[] = idf_escape($p[0]);
        }
        if ($Q == "")
            return queries("CREATE TABLE " . table($C) . " (\n" . implode(",\n", $c) . "\n)");
        return (!$c || queries("ALTER TABLE " . table($Q) . "\n" . implode("\n", $c))) && (!$hc || queries("ALTER TABLE " . table($Q) . " DROP (" . implode(", ", $hc) . ")")) && ($Q == $C || queries("ALTER TABLE " . table($Q) . " RENAME TO " . table($C)));
    }
    function foreign_keys($Q)
    {
        $I = array();
        $G = "SELECT c_list.CONSTRAINT_NAME as NAME,
c_src.COLUMN_NAME as SRC_COLUMN,
c_dest.OWNER as DEST_DB,
c_dest.TABLE_NAME as DEST_TABLE,
c_dest.COLUMN_NAME as DEST_COLUMN,
c_list.DELETE_RULE as ON_DELETE
FROM ALL_CONSTRAINTS c_list, ALL_CONS_COLUMNS c_src, ALL_CONS_COLUMNS c_dest
WHERE c_list.CONSTRAINT_NAME = c_src.CONSTRAINT_NAME
AND c_list.R_CONSTRAINT_NAME = c_dest.CONSTRAINT_NAME
AND c_list.CONSTRAINT_TYPE = 'R'
AND c_src.TABLE_NAME = " . q($Q);
        foreach (get_rows($G) as $J)
            $I[$J['NAME']] = array(
                "db" => $J['DEST_DB'],
                "table" => $J['DEST_TABLE'],
                "source" => array(
                    $J['SRC_COLUMN']
                ),
                "target" => array(
                    $J['DEST_COLUMN']
                ),
                "on_delete" => $J['ON_DELETE'],
                "on_update" => null
            );
        return $I;
    }
    function truncate_tables($S)
    {
        return apply_queries("TRUNCATE TABLE", $S);
    }
    function drop_views($ej)
    {
        return apply_queries("DROP VIEW", $ej);
    }
    function drop_tables($S)
    {
        return apply_queries("DROP TABLE", $S);
    }
    function last_id()
    {
        return 0;
    }
    function schemas()
    {
        return get_vals("SELECT DISTINCT owner FROM dba_segments WHERE owner IN (SELECT username FROM dba_users WHERE default_tablespace NOT IN ('SYSTEM','SYSAUX'))");
    }
    function get_schema()
    {
        global $h;
        return $h->result("SELECT sys_context('USERENV', 'SESSION_USER') FROM dual");
    }
    function set_schema($eh)
    {
        global $h;
        return $h->query("ALTER SESSION SET CURRENT_SCHEMA = " . idf_escape($eh));
    }
    function show_variables()
    {
        return get_key_vals('SELECT name, display_value FROM v$parameter');
    }
    function process_list()
    {
        return get_rows('SELECT sess.process AS "process", sess.username AS "user", sess.schemaname AS "schema", sess.status AS "status", sess.wait_class AS "wait_class", sess.seconds_in_wait AS "seconds_in_wait", sql.sql_text AS "sql_text", sess.machine AS "machine", sess.port AS "port"
FROM v$session sess LEFT OUTER JOIN v$sql sql
ON sql.sql_id = sess.sql_id
WHERE sess.type = \'USER\'
ORDER BY PROCESS
');
    }
    function show_status()
    {
        $K = get_rows('SELECT * FROM v$instance');
        return reset($K);
    }
    function convert_field($p)
    {
    }
    function unconvert_field($p, $I)
    {
        return $I;
    }
    function support($Rc)
    {
        return preg_match('~^(columns|database|drop_col|indexes|descidx|processlist|scheme|sql|status|table|variables|view|view_trigger)$~', $Rc);
    }
    $y  = "oracle";
    $U  = array();
    $Lh = array();
    foreach (array(
        lang(27) => array(
            "number" => 38,
            "binary_float" => 12,
            "binary_double" => 21
        ),
        lang(28) => array(
            "date" => 10,
            "timestamp" => 29,
            "interval year" => 12,
            "interval day" => 28
        ),
        lang(25) => array(
            "char" => 2000,
            "varchar2" => 4000,
            "nchar" => 2000,
            "nvarchar2" => 4000,
            "clob" => 4294967295,
            "nclob" => 4294967295
        ),
        lang(29) => array(
            "raw" => 2000,
            "long raw" => 2147483648,
            "blob" => 4294967295,
            "bfile" => 4294967296
        )
    ) as $z => $X) {
        $U += $X;
        $Lh[$z] = array_keys($X);
    }
    $Mi = array();
    $yf = array(
        "=",
        "<",
        ">",
        "<=",
        ">=",
        "!=",
        "LIKE",
        "LIKE %%",
        "IN",
        "IS NULL",
        "NOT LIKE",
        "NOT REGEXP",
        "NOT IN",
        "IS NOT NULL",
        "SQL"
    );
    $md = array(
        "length",
        "lower",
        "round",
        "upper"
    );
    $sd = array(
        "avg",
        "count",
        "count distinct",
        "max",
        "min",
        "sum"
    );
    $oc = array(
        array(
            "date" => "current_date",
            "timestamp" => "current_timestamp"
        ),
        array(
            "number|float|double" => "+/-",
            "date|timestamp" => "+ interval/- interval",
            "char|clob" => "||"
        )
    );
}
$gc["mssql"] = "MS SQL (beta)";
if (isset($_GET["mssql"])) {
    $kg = array(
        "SQLSRV",
        "MSSQL",
        "PDO_DBLIB"
    );
    define("DRIVER", "mssql");
    if (extension_loaded("sqlsrv")) {
        class Min_DB
        {
            var $extension = "sqlsrv", $_link, $_result, $server_info, $affected_rows, $errno, $error;
            function _get_error()
            {
                $this->error = "";
                foreach (sqlsrv_errors() as $o) {
                    $this->errno = $o["code"];
                    $this->error .= "$o[message]\n";
                }
                $this->error = rtrim($this->error);
            }
            function connect($N, $V, $F)
            {
                global $b;
                $m  = $b->database();
                $zb = array(
                    "UID" => $V,
                    "PWD" => $F,
                    "CharacterSet" => "UTF-8"
                );
                if ($m != "")
                    $zb["Database"] = $m;
                $this->_link = @sqlsrv_connect(preg_replace('~:~', ',', $N), $zb);
                if ($this->_link) {
                    $Rd                = sqlsrv_server_info($this->_link);
                    $this->server_info = $Rd['SQLServerVersion'];
                } else
                    $this->_get_error();
                return (bool) $this->_link;
            }
            function quote($P)
            {
                return "'" . str_replace("'", "''", $P) . "'";
            }
            function select_db($k)
            {
                return $this->query("USE " . idf_escape($k));
            }
            function query($G, $Gi = false)
            {
                $H           = sqlsrv_query($this->_link, $G);
                $this->error = "";
                if (!$H) {
                    $this->_get_error();
                    return false;
                }
                return $this->store_result($H);
            }
            function multi_query($G)
            {
                $this->_result = sqlsrv_query($this->_link, $G);
                $this->error   = "";
                if (!$this->_result) {
                    $this->_get_error();
                    return false;
                }
                return true;
            }
            function store_result($H = null)
            {
                if (!$H)
                    $H = $this->_result;
                if (!$H)
                    return false;
                if (sqlsrv_field_metadata($H))
                    return new Min_Result($H);
                $this->affected_rows = sqlsrv_rows_affected($H);
                return true;
            }
            function next_result()
            {
                return $this->_result ? sqlsrv_next_result($this->_result) : null;
            }
            function result($G, $p = 0)
            {
                $H = $this->query($G);
                if (!is_object($H))
                    return false;
                $J = $H->fetch_row();
                return $J[$p];
            }
        }
        class Min_Result
        {
            var $_result, $_offset = 0, $_fields, $num_rows;
            function __construct($H)
            {
                $this->_result = $H;
            }
            function _convert($J)
            {
                foreach ((array) $J as $z => $X) {
                    if (is_a($X, 'DateTime'))
                        $J[$z] = $X->format("Y-m-d H:i:s");
                }
                return $J;
            }
            function fetch_assoc()
            {
                return $this->_convert(sqlsrv_fetch_array($this->_result, SQLSRV_FETCH_ASSOC));
            }
            function fetch_row()
            {
                return $this->_convert(sqlsrv_fetch_array($this->_result, SQLSRV_FETCH_NUMERIC));
            }
            function fetch_field()
            {
                if (!$this->_fields)
                    $this->_fields = sqlsrv_field_metadata($this->_result);
                $p          = $this->_fields[$this->_offset++];
                $I          = new stdClass;
                $I->name    = $p["Name"];
                $I->orgname = $p["Name"];
                $I->type    = ($p["Type"] == 1 ? 254 : 0);
                return $I;
            }
            function seek($D)
            {
                for ($t = 0; $t < $D; $t++)
                    sqlsrv_fetch($this->_result);
            }
            function __destruct()
            {
                sqlsrv_free_stmt($this->_result);
            }
        }
    } elseif (extension_loaded("mssql")) {
        class Min_DB
        {
            var $extension = "MSSQL", $_link, $_result, $server_info, $affected_rows, $error;
            function connect($N, $V, $F)
            {
                $this->_link = @mssql_connect($N, $V, $F);
                if ($this->_link) {
                    $H = $this->query("SELECT SERVERPROPERTY('ProductLevel'), SERVERPROPERTY('Edition')");
                    if ($H) {
                        $J                 = $H->fetch_row();
                        $this->server_info = $this->result("sp_server_info 2", 2) . " [$J[0]] $J[1]";
                    }
                } else
                    $this->error = mssql_get_last_message();
                return (bool) $this->_link;
            }
            function quote($P)
            {
                return "'" . str_replace("'", "''", $P) . "'";
            }
            function select_db($k)
            {
                return mssql_select_db($k);
            }
            function query($G, $Gi = false)
            {
                $H           = @mssql_query($G, $this->_link);
                $this->error = "";
                if (!$H) {
                    $this->error = mssql_get_last_message();
                    return false;
                }
                if ($H === true) {
                    $this->affected_rows = mssql_rows_affected($this->_link);
                    return true;
                }
                return new Min_Result($H);
            }
            function multi_query($G)
            {
                return $this->_result = $this->query($G);
            }
            function store_result()
            {
                return $this->_result;
            }
            function next_result()
            {
                return mssql_next_result($this->_result->_result);
            }
            function result($G, $p = 0)
            {
                $H = $this->query($G);
                if (!is_object($H))
                    return false;
                return mssql_result($H->_result, 0, $p);
            }
        }
        class Min_Result
        {
            var $_result, $_offset = 0, $_fields, $num_rows;
            function __construct($H)
            {
                $this->_result  = $H;
                $this->num_rows = mssql_num_rows($H);
            }
            function fetch_assoc()
            {
                return mssql_fetch_assoc($this->_result);
            }
            function fetch_row()
            {
                return mssql_fetch_row($this->_result);
            }
            function num_rows()
            {
                return mssql_num_rows($this->_result);
            }
            function fetch_field()
            {
                $I           = mssql_fetch_field($this->_result);
                $I->orgtable = $I->table;
                $I->orgname  = $I->name;
                return $I;
            }
            function seek($D)
            {
                mssql_data_seek($this->_result, $D);
            }
            function __destruct()
            {
                mssql_free_result($this->_result);
            }
        }
    } elseif (extension_loaded("pdo_dblib")) {
        class Min_DB extends Min_PDO
        {
            var $extension = "PDO_DBLIB";
            function connect($N, $V, $F)
            {
                $this->dsn("dblib:charset=utf8;host=" . str_replace(":", ";unix_socket=", preg_replace('~:(\d)~', ';port=\1', $N)), $V, $F);
                return true;
            }
            function select_db($k)
            {
                return $this->query("USE " . idf_escape($k));
            }
        }
    }
    class Min_Driver extends Min_SQL
    {
        function insertUpdate($Q, $K, $ng)
        {
            foreach ($K as $O) {
                $Ni = array();
                $Z  = array();
                foreach ($O as $z => $X) {
                    $Ni[] = "$z = $X";
                    if (isset($ng[idf_unescape($z)]))
                        $Z[] = "$z = $X";
                }
                if (!queries("MERGE " . table($Q) . " USING (VALUES(" . implode(", ", $O) . ")) AS source (c" . implode(", c", range(1, count($O))) . ") ON " . implode(" AND ", $Z) . " WHEN MATCHED THEN UPDATE SET " . implode(", ", $Ni) . " WHEN NOT MATCHED THEN INSERT (" . implode(", ", array_keys($O)) . ") VALUES (" . implode(", ", $O) . ");"))
                    return false;
            }
            return true;
        }
        function begin()
        {
            return queries("BEGIN TRANSACTION");
        }
    }
    function idf_escape($v)
    {
        return "[" . str_replace("]", "]]", $v) . "]";
    }
    function table($v)
    {
        return ($_GET["ns"] != "" ? idf_escape($_GET["ns"]) . "." : "") . idf_escape($v);
    }
    function connect()
    {
        global $b;
        $h  = new Min_DB;
        $Ib = $b->credentials();
        if ($h->connect($Ib[0], $Ib[1], $Ib[2]))
            return $h;
        return $h->error;
    }
    function get_databases()
    {
        return get_vals("SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb')");
    }
    function limit($G, $Z, $_, $D = 0, $M = " ")
    {
        return ($_ !== null ? " TOP (" . ($_ + $D) . ")" : "") . " $G$Z";
    }
    function limit1($Q, $G, $Z, $M = "\n")
    {
        return limit($G, $Z, 1, 0, $M);
    }
    function db_collation($m, $qb)
    {
        global $h;
        return $h->result("SELECT collation_name FROM sys.databases WHERE name = " . q($m));
    }
    function engines()
    {
        return array();
    }
    function logged_user()
    {
        global $h;
        return $h->result("SELECT SUSER_NAME()");
    }
    function tables_list()
    {
        return get_key_vals("SELECT name, type_desc FROM sys.all_objects WHERE schema_id = SCHEMA_ID(" . q(get_schema()) . ") AND type IN ('S', 'U', 'V') ORDER BY name");
    }
    function count_tables($l)
    {
        global $h;
        $I = array();
        foreach ($l as $m) {
            $h->select_db($m);
            $I[$m] = $h->result("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES");
        }
        return $I;
    }
    function table_status($C = "")
    {
        $I = array();
        foreach (get_rows("SELECT ao.name AS Name, ao.type_desc AS Engine, (SELECT value FROM fn_listextendedproperty(default, 'SCHEMA', schema_name(schema_id), 'TABLE', ao.name, null, null)) AS Comment FROM sys.all_objects AS ao WHERE schema_id = SCHEMA_ID(" . q(get_schema()) . ") AND type IN ('S', 'U', 'V') " . ($C != "" ? "AND name = " . q($C) : "ORDER BY name")) as $J) {
            if ($C != "")
                return $J;
            $I[$J["Name"]] = $J;
        }
        return $I;
    }
    function is_view($R)
    {
        return $R["Engine"] == "VIEW";
    }
    function fk_support($R)
    {
        return true;
    }
    function fields($Q)
    {
        $wb = get_key_vals("SELECT objname, cast(value as varchar) FROM fn_listextendedproperty('MS_DESCRIPTION', 'schema', " . q(get_schema()) . ", 'table', " . q($Q) . ", 'column', NULL)");
        $I  = array();
        foreach (get_rows("SELECT c.max_length, c.precision, c.scale, c.name, c.is_nullable, c.is_identity, c.collation_name, t.name type, CAST(d.definition as text) [default]
FROM sys.all_columns c
JOIN sys.all_objects o ON c.object_id = o.object_id
JOIN sys.types t ON c.user_type_id = t.user_type_id
LEFT JOIN sys.default_constraints d ON c.default_object_id = d.parent_column_id
WHERE o.schema_id = SCHEMA_ID(" . q(get_schema()) . ") AND o.type IN ('S', 'U', 'V') AND o.name = " . q($Q)) as $J) {
            $T             = $J["type"];
            $we            = (preg_match("~char|binary~", $T) ? $J["max_length"] : ($T == "decimal" ? "$J[precision],$J[scale]" : ""));
            $I[$J["name"]] = array(
                "field" => $J["name"],
                "full_type" => $T . ($we ? "($we)" : ""),
                "type" => $T,
                "length" => $we,
                "default" => $J["default"],
                "null" => $J["is_nullable"],
                "auto_increment" => $J["is_identity"],
                "collation" => $J["collation_name"],
                "privileges" => array(
                    "insert" => 1,
                    "select" => 1,
                    "update" => 1
                ),
                "primary" => $J["is_identity"],
                "comment" => $wb[$J["name"]]
            );
        }
        return $I;
    }
    function indexes($Q, $i = null)
    {
        $I = array();
        foreach (get_rows("SELECT i.name, key_ordinal, is_unique, is_primary_key, c.name AS column_name, is_descending_key
FROM sys.indexes i
INNER JOIN sys.index_columns ic ON i.object_id = ic.object_id AND i.index_id = ic.index_id
INNER JOIN sys.columns c ON ic.object_id = c.object_id AND ic.column_id = c.column_id
WHERE OBJECT_NAME(i.object_id) = " . q($Q), $i) as $J) {
            $C                                   = $J["name"];
            $I[$C]["type"]                       = ($J["is_primary_key"] ? "PRIMARY" : ($J["is_unique"] ? "UNIQUE" : "INDEX"));
            $I[$C]["lengths"]                    = array();
            $I[$C]["columns"][$J["key_ordinal"]] = $J["column_name"];
            $I[$C]["descs"][$J["key_ordinal"]]   = ($J["is_descending_key"] ? '1' : null);
        }
        return $I;
    }
    function view($C)
    {
        global $h;
        return array(
            "select" => preg_replace('~^(?:[^[]|\[[^]]*])*\s+AS\s+~isU', '', $h->result("SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = SCHEMA_NAME() AND TABLE_NAME = " . q($C)))
        );
    }
    function collations()
    {
        $I = array();
        foreach (get_vals("SELECT name FROM fn_helpcollations()") as $d)
            $I[preg_replace('~_.*~', '', $d)][] = $d;
        return $I;
    }
    function information_schema($m)
    {
        return false;
    }
    function error()
    {
        global $h;
        return nl_br(h(preg_replace('~^(\[[^]]*])+~m', '', $h->error)));
    }
    function create_database($m, $d)
    {
        return queries("CREATE DATABASE " . idf_escape($m) . (preg_match('~^[a-z0-9_]+$~i', $d) ? " COLLATE $d" : ""));
    }
    function drop_databases($l)
    {
        return queries("DROP DATABASE " . implode(", ", array_map('idf_escape', $l)));
    }
    function rename_database($C, $d)
    {
        if (preg_match('~^[a-z0-9_]+$~i', $d))
            queries("ALTER DATABASE " . idf_escape(DB) . " COLLATE $d");
        queries("ALTER DATABASE " . idf_escape(DB) . " MODIFY NAME = " . idf_escape($C));
        return true;
    }
    function auto_increment()
    {
        return " IDENTITY" . ($_POST["Auto_increment"] != "" ? "(" . number($_POST["Auto_increment"]) . ",1)" : "") . " PRIMARY KEY";
    }
    function alter_table($Q, $C, $q, $ed, $vb, $wc, $d, $Na, $Xf)
    {
        $c  = array();
        $wb = array();
        foreach ($q as $p) {
            $e = idf_escape($p[0]);
            $X = $p[1];
            if (!$X)
                $c["DROP"][] = " COLUMN $e";
            else {
                $X[1]      = preg_replace("~( COLLATE )'(\\w+)'~", '\1\2', $X[1]);
                $wb[$p[0]] = $X[5];
                unset($X[5]);
                if ($p[0] == "")
                    $c["ADD"][] = "\n  " . implode("", $X) . ($Q == "" ? substr($ed[$X[0]], 16 + strlen($X[0])) : "");
                else {
                    unset($X[6]);
                    if ($e != $X[0])
                        queries("EXEC sp_rename " . q(table($Q) . ".$e") . ", " . q(idf_unescape($X[0])) . ", 'COLUMN'");
                    $c["ALTER COLUMN " . implode("", $X)][] = "";
                }
            }
        }
        if ($Q == "")
            return queries("CREATE TABLE " . table($C) . " (" . implode(",", (array) $c["ADD"]) . "\n)");
        if ($Q != $C)
            queries("EXEC sp_rename " . q(table($Q)) . ", " . q($C));
        if ($ed)
            $c[""] = $ed;
        foreach ($c as $z => $X) {
            if (!queries("ALTER TABLE " . idf_escape($C) . " $z" . implode(",", $X)))
                return false;
        }
        foreach ($wb as $z => $X) {
            $vb = substr($X, 9);
            queries("EXEC sp_dropextendedproperty @name = N'MS_Description', @level0type = N'Schema', @level0name = " . q(get_schema()) . ", @level1type = N'Table',  @level1name = " . q($C) . ", @level2type = N'Column', @level2name = " . q($z));
            queries("EXEC sp_addextendedproperty @name = N'MS_Description', @value = " . $vb . ", @level0type = N'Schema', @level0name = " . q(get_schema()) . ", @level1type = N'Table',  @level1name = " . q($C) . ", @level2type = N'Column', @level2name = " . q($z));
        }
        return true;
    }
    function alter_indexes($Q, $c)
    {
        $w  = array();
        $hc = array();
        foreach ($c as $X) {
            if ($X[2] == "DROP") {
                if ($X[0] == "PRIMARY")
                    $hc[] = idf_escape($X[1]);
                else
                    $w[] = idf_escape($X[1]) . " ON " . table($Q);
            } elseif (!queries(($X[0] != "PRIMARY" ? "CREATE $X[0] " . ($X[0] != "INDEX" ? "INDEX " : "") . idf_escape($X[1] != "" ? $X[1] : uniqid($Q . "_")) . " ON " . table($Q) : "ALTER TABLE " . table($Q) . " ADD PRIMARY KEY") . " (" . implode(", ", $X[2]) . ")"))
                return false;
        }
        return (!$w || queries("DROP INDEX " . implode(", ", $w))) && (!$hc || queries("ALTER TABLE " . table($Q) . " DROP " . implode(", ", $hc)));
    }
    function last_id()
    {
        global $h;
        return $h->result("SELECT SCOPE_IDENTITY()");
    }
    function explain($h, $G)
    {
        $h->query("SET SHOWPLAN_ALL ON");
        $I = $h->query($G);
        $h->query("SET SHOWPLAN_ALL OFF");
        return $I;
    }
    function found_rows($R, $Z)
    {
    }
    function foreign_keys($Q)
    {
        $I = array();
        foreach (get_rows("EXEC sp_fkeys @fktable_name = " . q($Q)) as $J) {
            $r =& $I[$J["FK_NAME"]];
            $r["db"]       = $J["PKTABLE_QUALIFIER"];
            $r["table"]    = $J["PKTABLE_NAME"];
            $r["source"][] = $J["FKCOLUMN_NAME"];
            $r["target"][] = $J["PKCOLUMN_NAME"];
        }
        return $I;
    }
    function truncate_tables($S)
    {
        return apply_queries("TRUNCATE TABLE", $S);
    }
    function drop_views($ej)
    {
        return queries("DROP VIEW " . implode(", ", array_map('table', $ej)));
    }
    function drop_tables($S)
    {
        return queries("DROP TABLE " . implode(", ", array_map('table', $S)));
    }
    function move_tables($S, $ej, $bi)
    {
        return apply_queries("ALTER SCHEMA " . idf_escape($bi) . " TRANSFER", array_merge($S, $ej));
    }
    function trigger($C)
    {
        if ($C == "")
            return array();
        $K = get_rows("SELECT s.name [Trigger],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(s.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(s.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing],
c.text
FROM sysobjects s
JOIN syscomments c ON s.id = c.id
WHERE s.xtype = 'TR' AND s.name = " . q($C));
        $I = reset($K);
        if ($I)
            $I["Statement"] = preg_replace('~^.+\s+AS\s+~isU', '', $I["text"]);
        return $I;
    }
    function triggers($Q)
    {
        $I = array();
        foreach (get_rows("SELECT sys1.name,
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing]
FROM sysobjects sys1
JOIN sysobjects sys2 ON sys1.parent_obj = sys2.id
WHERE sys1.xtype = 'TR' AND sys2.name = " . q($Q)) as $J)
            $I[$J["name"]] = array(
                $J["Timing"],
                $J["Event"]
            );
        return $I;
    }
    function trigger_options()
    {
        return array(
            "Timing" => array(
                "AFTER",
                "INSTEAD OF"
            ),
            "Event" => array(
                "INSERT",
                "UPDATE",
                "DELETE"
            ),
            "Type" => array(
                "AS"
            )
        );
    }
    function schemas()
    {
        return get_vals("SELECT name FROM sys.schemas");
    }
    function get_schema()
    {
        global $h;
        if ($_GET["ns"] != "")
            return $_GET["ns"];
        return $h->result("SELECT SCHEMA_NAME()");
    }
    function set_schema($dh)
    {
        return true;
    }
    function use_sql($k)
    {
        return "USE " . idf_escape($k);
    }
    function show_variables()
    {
        return array();
    }
    function show_status()
    {
        return array();
    }
    function convert_field($p)
    {
    }
    function unconvert_field($p, $I)
    {
        return $I;
    }
    function support($Rc)
    {
        return preg_match('~^(comment|columns|database|drop_col|indexes|descidx|scheme|sql|table|trigger|view|view_trigger)$~', $Rc);
    }
    $y  = "mssql";
    $U  = array();
    $Lh = array();
    foreach (array(
        lang(27) => array(
            "tinyint" => 3,
            "smallint" => 5,
            "int" => 10,
            "bigint" => 20,
            "bit" => 1,
            "decimal" => 0,
            "real" => 12,
            "float" => 53,
            "smallmoney" => 10,
            "money" => 20
        ),
        lang(28) => array(
            "date" => 10,
            "smalldatetime" => 19,
            "datetime" => 19,
            "datetime2" => 19,
            "time" => 8,
            "datetimeoffset" => 10
        ),
        lang(25) => array(
            "char" => 8000,
            "varchar" => 8000,
            "text" => 2147483647,
            "nchar" => 4000,
            "nvarchar" => 4000,
            "ntext" => 1073741823
        ),
        lang(29) => array(
            "binary" => 8000,
            "varbinary" => 8000,
            "image" => 2147483647
        )
    ) as $z => $X) {
        $U += $X;
        $Lh[$z] = array_keys($X);
    }
    $Mi = array();
    $yf = array(
        "=",
        "<",
        ">",
        "<=",
        ">=",
        "!=",
        "LIKE",
        "LIKE %%",
        "IN",
        "IS NULL",
        "NOT LIKE",
        "NOT IN",
        "IS NOT NULL"
    );
    $md = array(
        "len",
        "lower",
        "round",
        "upper"
    );
    $sd = array(
        "avg",
        "count",
        "count distinct",
        "max",
        "min",
        "sum"
    );
    $oc = array(
        array(
            "date|time" => "getdate"
        ),
        array(
            "int|decimal|real|float|money|datetime" => "+/-",
            "char|text" => "+"
        )
    );
}
$gc['firebird'] = 'Firebird (alpha)';
if (isset($_GET["firebird"])) {
    $kg = array(
        "interbase"
    );
    define("DRIVER", "firebird");
    if (extension_loaded("interbase")) {
        class Min_DB
        {
            var $extension = "Firebird", $server_info, $affected_rows, $errno, $error, $_link, $_result;
            function connect($N, $V, $F)
            {
                $this->_link = ibase_connect($N, $V, $F);
                if ($this->_link) {
                    $Qi                 = explode(':', $N);
                    $this->service_link = ibase_service_attach($Qi[0], $V, $F);
                    $this->server_info  = ibase_server_info($this->service_link, IBASE_SVC_SERVER_VERSION);
                } else {
                    $this->errno = ibase_errcode();
                    $this->error = ibase_errmsg();
                }
                return (bool) $this->_link;
            }
            function quote($P)
            {
                return "'" . str_replace("'", "''", $P) . "'";
            }
            function select_db($k)
            {
                return ($k == "domain");
            }
            function query($G, $Gi = false)
            {
                $H = ibase_query($G, $this->_link);
                if (!$H) {
                    $this->errno = ibase_errcode();
                    $this->error = ibase_errmsg();
                    return false;
                }
                $this->error = "";
                if ($H === true) {
                    $this->affected_rows = ibase_affected_rows($this->_link);
                    return true;
                }
                return new Min_Result($H);
            }
            function multi_query($G)
            {
                return $this->_result = $this->query($G);
            }
            function store_result()
            {
                return $this->_result;
            }
            function next_result()
            {
                return false;
            }
            function result($G, $p = 0)
            {
                $H = $this->query($G);
                if (!$H || !$H->num_rows)
                    return false;
                $J = $H->fetch_row();
                return $J[$p];
            }
        }
        class Min_Result
        {
            var $num_rows, $_result, $_offset = 0;
            function __construct($H)
            {
                $this->_result = $H;
            }
            function fetch_assoc()
            {
                return ibase_fetch_assoc($this->_result);
            }
            function fetch_row()
            {
                return ibase_fetch_row($this->_result);
            }
            function fetch_field()
            {
                $p = ibase_field_info($this->_result, $this->_offset++);
                return (object) array(
                    'name' => $p['name'],
                    'orgname' => $p['name'],
                    'type' => $p['type'],
                    'charsetnr' => $p['length']
                );
            }
            function __destruct()
            {
                ibase_free_result($this->_result);
            }
        }
    }
    class Min_Driver extends Min_SQL
    {
    }
    function idf_escape($v)
    {
        return '"' . str_replace('"', '""', $v) . '"';
    }
    function table($v)
    {
        return idf_escape($v);
    }
    function connect()
    {
        global $b;
        $h  = new Min_DB;
        $Ib = $b->credentials();
        if ($h->connect($Ib[0], $Ib[1], $Ib[2]))
            return $h;
        return $h->error;
    }
    function get_databases($cd)
    {
        return array(
            "domain"
        );
    }
    function limit($G, $Z, $_, $D = 0, $M = " ")
    {
        $I = '';
        $I .= ($_ !== null ? $M . "FIRST $_" . ($D ? " SKIP $D" : "") : "");
        $I .= " $G$Z";
        return $I;
    }
    function limit1($Q, $G, $Z, $M = "\n")
    {
        return limit($G, $Z, 1, 0, $M);
    }
    function db_collation($m, $qb)
    {
    }
    function engines()
    {
        return array();
    }
    function logged_user()
    {
        global $b;
        $Ib = $b->credentials();
        return $Ib[1];
    }
    function tables_list()
    {
        global $h;
        $G = 'SELECT RDB$RELATION_NAME FROM rdb$relations WHERE rdb$system_flag = 0';
        $H = ibase_query($h->_link, $G);
        $I = array();
        while ($J = ibase_fetch_assoc($H))
            $I[$J['RDB$RELATION_NAME']] = 'table';
        ksort($I);
        return $I;
    }
    function count_tables($l)
    {
        return array();
    }
    function table_status($C = "", $Qc = false)
    {
        global $h;
        $I  = array();
        $Nb = tables_list();
        foreach ($Nb as $w => $X) {
            $w     = trim($w);
            $I[$w] = array(
                'Name' => $w,
                'Engine' => 'standard'
            );
            if ($C == $w)
                return $I[$w];
        }
        return $I;
    }
    function is_view($R)
    {
        return false;
    }
    function fk_support($R)
    {
        return preg_match('~InnoDB|IBMDB2I~i', $R["Engine"]);
    }
    function fields($Q)
    {
        global $h;
        $I = array();
        $G = 'SELECT r.RDB$FIELD_NAME AS field_name,
r.RDB$DESCRIPTION AS field_description,
r.RDB$DEFAULT_VALUE AS field_default_value,
r.RDB$NULL_FLAG AS field_not_null_constraint,
f.RDB$FIELD_LENGTH AS field_length,
f.RDB$FIELD_PRECISION AS field_precision,
f.RDB$FIELD_SCALE AS field_scale,
CASE f.RDB$FIELD_TYPE
WHEN 261 THEN \'BLOB\'
WHEN 14 THEN \'CHAR\'
WHEN 40 THEN \'CSTRING\'
WHEN 11 THEN \'D_FLOAT\'
WHEN 27 THEN \'DOUBLE\'
WHEN 10 THEN \'FLOAT\'
WHEN 16 THEN \'INT64\'
WHEN 8 THEN \'INTEGER\'
WHEN 9 THEN \'QUAD\'
WHEN 7 THEN \'SMALLINT\'
WHEN 12 THEN \'DATE\'
WHEN 13 THEN \'TIME\'
WHEN 35 THEN \'TIMESTAMP\'
WHEN 37 THEN \'VARCHAR\'
ELSE \'UNKNOWN\'
END AS field_type,
f.RDB$FIELD_SUB_TYPE AS field_subtype,
coll.RDB$COLLATION_NAME AS field_collation,
cset.RDB$CHARACTER_SET_NAME AS field_charset
FROM RDB$RELATION_FIELDS r
LEFT JOIN RDB$FIELDS f ON r.RDB$FIELD_SOURCE = f.RDB$FIELD_NAME
LEFT JOIN RDB$COLLATIONS coll ON f.RDB$COLLATION_ID = coll.RDB$COLLATION_ID
LEFT JOIN RDB$CHARACTER_SETS cset ON f.RDB$CHARACTER_SET_ID = cset.RDB$CHARACTER_SET_ID
WHERE r.RDB$RELATION_NAME = ' . q($Q) . '
ORDER BY r.RDB$FIELD_POSITION';
        $H = ibase_query($h->_link, $G);
        while ($J = ibase_fetch_assoc($H))
            $I[trim($J['FIELD_NAME'])] = array(
                "field" => trim($J["FIELD_NAME"]),
                "full_type" => trim($J["FIELD_TYPE"]),
                "type" => trim($J["FIELD_SUB_TYPE"]),
                "default" => trim($J['FIELD_DEFAULT_VALUE']),
                "null" => (trim($J["FIELD_NOT_NULL_CONSTRAINT"]) == "YES"),
                "auto_increment" => '0',
                "collation" => trim($J["FIELD_COLLATION"]),
                "privileges" => array(
                    "insert" => 1,
                    "select" => 1,
                    "update" => 1
                ),
                "comment" => trim($J["FIELD_DESCRIPTION"])
            );
        return $I;
    }
    function indexes($Q, $i = null)
    {
        $I = array();
        return $I;
    }
    function foreign_keys($Q)
    {
        return array();
    }
    function collations()
    {
        return array();
    }
    function information_schema($m)
    {
        return false;
    }
    function error()
    {
        global $h;
        return h($h->error);
    }
    function types()
    {
        return array();
    }
    function schemas()
    {
        return array();
    }
    function get_schema()
    {
        return "";
    }
    function set_schema($dh)
    {
        return true;
    }
    function support($Rc)
    {
        return preg_match("~^(columns|sql|status|table)$~", $Rc);
    }
    $y  = "firebird";
    $yf = array(
        "="
    );
    $md = array();
    $sd = array();
    $oc = array();
}
$gc["simpledb"] = "SimpleDB";
if (isset($_GET["simpledb"])) {
    $kg = array(
        "SimpleXML + allow_url_fopen"
    );
    define("DRIVER", "simpledb");
    if (class_exists('SimpleXMLElement') && ini_bool('allow_url_fopen')) {
        class Min_DB
        {
            var $extension = "SimpleXML", $server_info = '2009-04-15', $error, $timeout, $next, $affected_rows, $_result;
            function select_db($k)
            {
                return ($k == "domain");
            }
            function query($G, $Gi = false)
            {
                $Rf = array(
                    'SelectExpression' => $G,
                    'ConsistentRead' => 'true'
                );
                if ($this->next)
                    $Rf['NextToken'] = $this->next;
                $H             = sdb_request_all('Select', 'Item', $Rf, $this->timeout);
                $this->timeout = 0;
                if ($H === false)
                    return $H;
                if (preg_match('~^\s*SELECT\s+COUNT\(~i', $G)) {
                    $Ph = 0;
                    foreach ($H as $de)
                        $Ph += $de->Attribute->Value;
                    $H = array(
                        (object) array(
                            'Attribute' => array(
                                (object) array(
                                    'Name' => 'Count',
                                    'Value' => $Ph
                                )
                            )
                        )
                    );
                }
                return new Min_Result($H);
            }
            function multi_query($G)
            {
                return $this->_result = $this->query($G);
            }
            function store_result()
            {
                return $this->_result;
            }
            function next_result()
            {
                return false;
            }
            function quote($P)
            {
                return "'" . str_replace("'", "''", $P) . "'";
            }
        }
        class Min_Result
        {
            var $num_rows, $_rows = array(), $_offset = 0;
            function __construct($H)
            {
                foreach ($H as $de) {
                    $J = array();
                    if ($de->Name != '')
                        $J['itemName()'] = (string) $de->Name;
                    foreach ($de->Attribute as $Ja) {
                        $C = $this->_processValue($Ja->Name);
                        $Y = $this->_processValue($Ja->Value);
                        if (isset($J[$C])) {
                            $J[$C]   = (array) $J[$C];
                            $J[$C][] = $Y;
                        } else
                            $J[$C] = $Y;
                    }
                    $this->_rows[] = $J;
                    foreach ($J as $z => $X) {
                        if (!isset($this->_rows[0][$z]))
                            $this->_rows[0][$z] = null;
                    }
                }
                $this->num_rows = count($this->_rows);
            }
            function _processValue($rc)
            {
                return (is_object($rc) && $rc['encoding'] == 'base64' ? base64_decode($rc) : (string) $rc);
            }
            function fetch_assoc()
            {
                $J = current($this->_rows);
                if (!$J)
                    return $J;
                $I = array();
                foreach ($this->_rows[0] as $z => $X)
                    $I[$z] = $J[$z];
                next($this->_rows);
                return $I;
            }
            function fetch_row()
            {
                $I = $this->fetch_assoc();
                if (!$I)
                    return $I;
                return array_values($I);
            }
            function fetch_field()
            {
                $je = array_keys($this->_rows[0]);
                return (object) array(
                    'name' => $je[$this->_offset++]
                );
            }
        }
    }
    class Min_Driver extends Min_SQL
    {
        public $ng = "itemName()";
        function _chunkRequest($Gd, $wa, $Rf, $Gc = array())
        {
            global $h;
            foreach (array_chunk($Gd, 25) as $jb) {
                $Sf = $Rf;
                foreach ($jb as $t => $u) {
                    $Sf["Item.$t.ItemName"] = $u;
                    foreach ($Gc as $z => $X)
                        $Sf["Item.$t.$z"] = $X;
                }
                if (!sdb_request($wa, $Sf))
                    return false;
            }
            $h->affected_rows = count($Gd);
            return true;
        }
        function _extractIds($Q, $zg, $_)
        {
            $I = array();
            if (preg_match_all("~itemName\(\) = (('[^']*+')+)~", $zg, $Ge))
                $I = array_map('idf_unescape', $Ge[1]);
            else {
                foreach (sdb_request_all('Select', 'Item', array(
                    'SelectExpression' => 'SELECT itemName() FROM ' . table($Q) . $zg . ($_ ? " LIMIT 1" : "")
                )) as $de)
                    $I[] = $de->Name;
            }
            return $I;
        }
        function select($Q, $L, $Z, $pd, $Cf = array(), $_ = 1, $E = 0, $pg = false)
        {
            global $h;
            $h->next = $_GET["next"];
            $I       = parent::select($Q, $L, $Z, $pd, $Cf, $_, $E, $pg);
            $h->next = 0;
            return $I;
        }
        function delete($Q, $zg, $_ = 0)
        {
            return $this->_chunkRequest($this->_extractIds($Q, $zg, $_), 'BatchDeleteAttributes', array(
                'DomainName' => $Q
            ));
        }
        function update($Q, $O, $zg, $_ = 0, $M = "\n")
        {
            $Wb = array();
            $Vd = array();
            $t  = 0;
            $Gd = $this->_extractIds($Q, $zg, $_);
            $u  = idf_unescape($O["`itemName()`"]);
            unset($O["`itemName()`"]);
            foreach ($O as $z => $X) {
                $z = idf_unescape($z);
                if ($X == "NULL" || ($u != "" && array(
                    $u
                ) != $Gd))
                    $Wb["Attribute." . count($Wb) . ".Name"] = $z;
                if ($X != "NULL") {
                    foreach ((array) $X as $fe => $W) {
                        $Vd["Attribute.$t.Name"]  = $z;
                        $Vd["Attribute.$t.Value"] = (is_array($X) ? $W : idf_unescape($W));
                        if (!$fe)
                            $Vd["Attribute.$t.Replace"] = "true";
                        $t++;
                    }
                }
            }
            $Rf = array(
                'DomainName' => $Q
            );
            return (!$Vd || $this->_chunkRequest(($u != "" ? array(
                $u
            ) : $Gd), 'BatchPutAttributes', $Rf, $Vd)) && (!$Wb || $this->_chunkRequest($Gd, 'BatchDeleteAttributes', $Rf, $Wb));
        }
        function insert($Q, $O)
        {
            $Rf = array(
                "DomainName" => $Q
            );
            $t  = 0;
            foreach ($O as $C => $Y) {
                if ($Y != "NULL") {
                    $C = idf_unescape($C);
                    if ($C == "itemName()")
                        $Rf["ItemName"] = idf_unescape($Y);
                    else {
                        foreach ((array) $Y as $X) {
                            $Rf["Attribute.$t.Name"]  = $C;
                            $Rf["Attribute.$t.Value"] = (is_array($Y) ? $X : idf_unescape($Y));
                            $t++;
                        }
                    }
                }
            }
            return sdb_request('PutAttributes', $Rf);
        }
        function insertUpdate($Q, $K, $ng)
        {
            foreach ($K as $O) {
                if (!$this->update($Q, $O, "WHERE `itemName()` = " . q($O["`itemName()`"])))
                    return false;
            }
            return true;
        }
        function begin()
        {
            return false;
        }
        function commit()
        {
            return false;
        }
        function rollback()
        {
            return false;
        }
        function slowQuery($G, $ji)
        {
            $this->_conn->timeout = $ji;
            return $G;
        }
    }
    function connect()
    {
        global $b;
        list(, , $F) = $b->credentials();
        if ($F != "")
            return lang(22);
        return new Min_DB;
    }
    function support($Rc)
    {
        return preg_match('~sql~', $Rc);
    }
    function logged_user()
    {
        global $b;
        $Ib = $b->credentials();
        return $Ib[1];
    }
    function get_databases()
    {
        return array(
            "domain"
        );
    }
    function collations()
    {
        return array();
    }
    function db_collation($m, $qb)
    {
    }
    function tables_list()
    {
        global $h;
        $I = array();
        foreach (sdb_request_all('ListDomains', 'DomainName') as $Q)
            $I[(string) $Q] = 'table';
        if ($h->error && defined("PAGE_HEADER"))
            echo "<p class='error'>" . error() . "\n";
        return $I;
    }
    function table_status($C = "", $Qc = false)
    {
        $I = array();
        foreach (($C != "" ? array(
            $C => true
        ) : tables_list()) as $Q => $T) {
            $J = array(
                "Name" => $Q,
                "Auto_increment" => ""
            );
            if (!$Qc) {
                $Te = sdb_request('DomainMetadata', array(
                    'DomainName' => $Q
                ));
                if ($Te) {
                    foreach (array(
                        "Rows" => "ItemCount",
                        "Data_length" => "ItemNamesSizeBytes",
                        "Index_length" => "AttributeValuesSizeBytes",
                        "Data_free" => "AttributeNamesSizeBytes"
                    ) as $z => $X)
                        $J[$z] = (string) $Te->$X;
                }
            }
            if ($C != "")
                return $J;
            $I[$Q] = $J;
        }
        return $I;
    }
    function explain($h, $G)
    {
    }
    function error()
    {
        global $h;
        return h($h->error);
    }
    function information_schema()
    {
    }
    function is_view($R)
    {
    }
    function indexes($Q, $i = null)
    {
        return array(
            array(
                "type" => "PRIMARY",
                "columns" => array(
                    "itemName()"
                )
            )
        );
    }
    function fields($Q)
    {
        return fields_from_edit();
    }
    function foreign_keys($Q)
    {
        return array();
    }
    function table($v)
    {
        return idf_escape($v);
    }
    function idf_escape($v)
    {
        return "`" . str_replace("`", "``", $v) . "`";
    }
    function limit($G, $Z, $_, $D = 0, $M = " ")
    {
        return " $G$Z" . ($_ !== null ? $M . "LIMIT $_" : "");
    }
    function unconvert_field($p, $I)
    {
        return $I;
    }
    function fk_support($R)
    {
    }
    function engines()
    {
        return array();
    }
    function alter_table($Q, $C, $q, $ed, $vb, $wc, $d, $Na, $Xf)
    {
        return ($Q == "" && sdb_request('CreateDomain', array(
            'DomainName' => $C
        )));
    }
    function drop_tables($S)
    {
        foreach ($S as $Q) {
            if (!sdb_request('DeleteDomain', array(
                'DomainName' => $Q
            )))
                return false;
        }
        return true;
    }
    function count_tables($l)
    {
        foreach ($l as $m)
            return array(
                $m => count(tables_list())
            );
    }
    function found_rows($R, $Z)
    {
        return ($Z ? null : $R["Rows"]);
    }
    function last_id()
    {
    }
    function hmac($Ca, $Nb, $z, $Cg = false)
    {
        $Wa = 64;
        if (strlen($z) > $Wa)
            $z = pack("H*", $Ca($z));
        $z  = str_pad($z, $Wa, "\0");
        $ge = $z ^ str_repeat("\x36", $Wa);
        $he = $z ^ str_repeat("\x5C", $Wa);
        $I  = $Ca($he . pack("H*", $Ca($ge . $Nb)));
        if ($Cg)
            $I = pack("H*", $I);
        return $I;
    }
    function sdb_request($wa, $Rf = array())
    {
        global $b, $h;
        list($Cd, $Rf['AWSAccessKeyId'], $gh) = $b->credentials();
        $Rf['Action']           = $wa;
        $Rf['Timestamp']        = gmdate('Y-m-d\TH:i:s+00:00');
        $Rf['Version']          = '2009-04-15';
        $Rf['SignatureVersion'] = 2;
        $Rf['SignatureMethod']  = 'HmacSHA1';
        ksort($Rf);
        $G = '';
        foreach ($Rf as $z => $X)
            $G .= '&' . rawurlencode($z) . '=' . rawurlencode($X);
        $G = str_replace('%7E', '~', substr($G, 1));
        $G .= "&Signature=" . urlencode(base64_encode(hmac('sha1', "POST\n" . preg_replace('~^https?://~', '', $Cd) . "\n/\n$G", $gh, true)));
        @ini_set('track_errors', 1);
        $Vc = @file_get_contents((preg_match('~^https?://~', $Cd) ? $Cd : "http://$Cd"), false, stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'content' => $G,
                'ignore_errors' => 1
            )
        )));
        if (!$Vc) {
            $h->error = $php_errormsg;
            return false;
        }
        libxml_use_internal_errors(true);
        $rj = simplexml_load_string($Vc);
        if (!$rj) {
            $o        = libxml_get_last_error();
            $h->error = $o->message;
            return false;
        }
        if ($rj->Errors) {
            $o        = $rj->Errors->Error;
            $h->error = "$o->Message ($o->Code)";
            return false;
        }
        $h->error = '';
        $ai       = $wa . "Result";
        return ($rj->$ai ? $rj->$ai : true);
    }
    function sdb_request_all($wa, $ai, $Rf = array(), $ji = 0)
    {
        $I  = array();
        $Gh = ($ji ? microtime(true) : 0);
        $_  = (preg_match('~LIMIT\s+(\d+)\s*$~i', $Rf['SelectExpression'], $B) ? $B[1] : 0);
        do {
            $rj = sdb_request($wa, $Rf);
            if (!$rj)
                break;
            foreach ($rj->$ai as $rc)
                $I[] = $rc;
            if ($_ && count($I) >= $_) {
                $_GET["next"] = $rj->NextToken;
                break;
            }
            if ($ji && microtime(true) - $Gh > $ji)
                return false;
            $Rf['NextToken'] = $rj->NextToken;
            if ($_)
                $Rf['SelectExpression'] = preg_replace('~\d+\s*$~', $_ - count($I), $Rf['SelectExpression']);
        } while ($rj->NextToken);
        return $I;
    }
    $y  = "simpledb";
    $yf = array(
        "=",
        "<",
        ">",
        "<=",
        ">=",
        "!=",
        "LIKE",
        "LIKE %%",
        "IN",
        "IS NULL",
        "NOT LIKE",
        "IS NOT NULL"
    );
    $md = array();
    $sd = array(
        "count"
    );
    $oc = array(
        array(
            "json"
        )
    );
}
$gc["mongo"] = "MongoDB";
if (isset($_GET["mongo"])) {
    $kg = array(
        "mongo",
        "mongodb"
    );
    define("DRIVER", "mongo");
    if (class_exists('MongoDB')) {
        class Min_DB
        {
            var $extension = "Mongo", $server_info = MongoClient::VERSION, $error, $last_id, $_link, $_db;
            function connect($Oi, $Af)
            {
                return @new MongoClient($Oi, $Af);
            }
            function query($G)
            {
                return false;
            }
            function select_db($k)
            {
                try {
                    $this->_db = $this->_link->selectDB($k);
                    return true;
                }
                catch (Exception $Cc) {
                    $this->error = $Cc->getMessage();
                    return false;
                }
            }
            function quote($P)
            {
                return $P;
            }
        }
        class Min_Result
        {
            var $num_rows, $_rows = array(), $_offset = 0, $_charset = array();
            function __construct($H)
            {
                foreach ($H as $de) {
                    $J = array();
                    foreach ($de as $z => $X) {
                        if (is_a($X, 'MongoBinData'))
                            $this->_charset[$z] = 63;
                        $J[$z] = (is_a($X, 'MongoId') ? 'ObjectId("' . strval($X) . '")' : (is_a($X, 'MongoDate') ? gmdate("Y-m-d H:i:s", $X->sec) . " GMT" : (is_a($X, 'MongoBinData') ? $X->bin : (is_a($X, 'MongoRegex') ? strval($X) : (is_object($X) ? get_class($X) : $X)))));
                    }
                    $this->_rows[] = $J;
                    foreach ($J as $z => $X) {
                        if (!isset($this->_rows[0][$z]))
                            $this->_rows[0][$z] = null;
                    }
                }
                $this->num_rows = count($this->_rows);
            }
            function fetch_assoc()
            {
                $J = current($this->_rows);
                if (!$J)
                    return $J;
                $I = array();
                foreach ($this->_rows[0] as $z => $X)
                    $I[$z] = $J[$z];
                next($this->_rows);
                return $I;
            }
            function fetch_row()
            {
                $I = $this->fetch_assoc();
                if (!$I)
                    return $I;
                return array_values($I);
            }
            function fetch_field()
            {
                $je = array_keys($this->_rows[0]);
                $C  = $je[$this->_offset++];
                return (object) array(
                    'name' => $C,
                    'charsetnr' => $this->_charset[$C]
                );
            }
        }
        class Min_Driver extends Min_SQL
        {
            public $ng = "_id";
            function select($Q, $L, $Z, $pd, $Cf = array(), $_ = 1, $E = 0, $pg = false)
            {
                $L  = ($L == array(
                    "*"
                ) ? array() : array_fill_keys($L, true));
                $yh = array();
                foreach ($Cf as $X) {
                    $X      = preg_replace('~ DESC$~', '', $X, 1, $Fb);
                    $yh[$X] = ($Fb ? -1 : 1);
                }
                return new Min_Result($this->_conn->_db->selectCollection($Q)->find(array(), $L)->sort($yh)->limit($_ != "" ? +$_ : 0)->skip($E * $_));
            }
            function insert($Q, $O)
            {
                try {
                    $I                    = $this->_conn->_db->selectCollection($Q)->insert($O);
                    $this->_conn->errno   = $I['code'];
                    $this->_conn->error   = $I['err'];
                    $this->_conn->last_id = $O['_id'];
                    return !$I['err'];
                }
                catch (Exception $Cc) {
                    $this->_conn->error = $Cc->getMessage();
                    return false;
                }
            }
        }
        function get_databases($cd)
        {
            global $h;
            $I  = array();
            $Sb = $h->_link->listDBs();
            foreach ($Sb['databases'] as $m)
                $I[] = $m['name'];
            return $I;
        }
        function count_tables($l)
        {
            global $h;
            $I = array();
            foreach ($l as $m)
                $I[$m] = count($h->_link->selectDB($m)->getCollectionNames(true));
            return $I;
        }
        function tables_list()
        {
            global $h;
            return array_fill_keys($h->_db->getCollectionNames(true), 'table');
        }
        function drop_databases($l)
        {
            global $h;
            foreach ($l as $m) {
                $Pg = $h->_link->selectDB($m)->drop();
                if (!$Pg['ok'])
                    return false;
            }
            return true;
        }
        function indexes($Q, $i = null)
        {
            global $h;
            $I = array();
            foreach ($h->_db->selectCollection($Q)->getIndexInfo() as $w) {
                $Zb = array();
                foreach ($w["key"] as $e => $T)
                    $Zb[] = ($T == -1 ? '1' : null);
                $I[$w["name"]] = array(
                    "type" => ($w["name"] == "_id_" ? "PRIMARY" : ($w["unique"] ? "UNIQUE" : "INDEX")),
                    "columns" => array_keys($w["key"]),
                    "lengths" => array(),
                    "descs" => $Zb
                );
            }
            return $I;
        }
        function fields($Q)
        {
            return fields_from_edit();
        }
        function found_rows($R, $Z)
        {
            global $h;
            return $h->_db->selectCollection($_GET["select"])->count($Z);
        }
        $yf = array(
            "="
        );
    } elseif (class_exists('MongoDB\Driver\Manager')) {
        class Min_DB
        {
            var $extension = "MongoDB", $server_info = MONGODB_VERSION, $error, $last_id;
            var $_link;
            var $_db, $_db_name;
            function connect($Oi, $Af)
            {
                $lb = 'MongoDB\Driver\Manager';
                return new $lb($Oi, $Af);
            }
            function query($G)
            {
                return false;
            }
            function select_db($k)
            {
                $this->_db_name = $k;
                return true;
            }
            function quote($P)
            {
                return $P;
            }
        }
        class Min_Result
        {
            var $num_rows, $_rows = array(), $_offset = 0, $_charset = array();
            function __construct($H)
            {
                foreach ($H as $de) {
                    $J = array();
                    foreach ($de as $z => $X) {
                        if (is_a($X, 'MongoDB\BSON\Binary'))
                            $this->_charset[$z] = 63;
                        $J[$z] = (is_a($X, 'MongoDB\BSON\ObjectID') ? 'MongoDB\BSON\ObjectID("' . strval($X) . '")' : (is_a($X, 'MongoDB\BSON\UTCDatetime') ? $X->toDateTime()->format('Y-m-d H:i:s') : (is_a($X, 'MongoDB\BSON\Binary') ? $X->bin : (is_a($X, 'MongoDB\BSON\Regex') ? strval($X) : (is_object($X) ? json_encode($X, 256) : $X)))));
                    }
                    $this->_rows[] = $J;
                    foreach ($J as $z => $X) {
                        if (!isset($this->_rows[0][$z]))
                            $this->_rows[0][$z] = null;
                    }
                }
                $this->num_rows = $H->count;
            }
            function fetch_assoc()
            {
                $J = current($this->_rows);
                if (!$J)
                    return $J;
                $I = array();
                foreach ($this->_rows[0] as $z => $X)
                    $I[$z] = $J[$z];
                next($this->_rows);
                return $I;
            }
            function fetch_row()
            {
                $I = $this->fetch_assoc();
                if (!$I)
                    return $I;
                return array_values($I);
            }
            function fetch_field()
            {
                $je = array_keys($this->_rows[0]);
                $C  = $je[$this->_offset++];
                return (object) array(
                    'name' => $C,
                    'charsetnr' => $this->_charset[$C]
                );
            }
        }
        class Min_Driver extends Min_SQL
        {
            public $ng = "_id";
            function select($Q, $L, $Z, $pd, $Cf = array(), $_ = 1, $E = 0, $pg = false)
            {
                global $h;
                $L = ($L == array(
                    "*"
                ) ? array() : array_fill_keys($L, 1));
                if (count($L) && !isset($L['_id']))
                    $L['_id'] = 0;
                $Z  = where_to_query($Z);
                $yh = array();
                foreach ($Cf as $X) {
                    $X      = preg_replace('~ DESC$~', '', $X, 1, $Fb);
                    $yh[$X] = ($Fb ? -1 : 1);
                }
                if (isset($_GET['limit']) && is_numeric($_GET['limit']) && $_GET['limit'] > 0)
                    $_ = $_GET['limit'];
                $_  = min(200, max(1, (int) $_));
                $vh = $E * $_;
                $lb = 'MongoDB\Driver\Query';
                $G  = new $lb($Z, array(
                    'projection' => $L,
                    'limit' => $_,
                    'skip' => $vh,
                    'sort' => $yh
                ));
                $Sg = $h->_link->executeQuery("$h->_db_name.$Q", $G);
                return new Min_Result($Sg);
            }
            function update($Q, $O, $zg, $_ = 0, $M = "\n")
            {
                global $h;
                $m  = $h->_db_name;
                $Z  = sql_query_where_parser($zg);
                $lb = 'MongoDB\Driver\BulkWrite';
                $ab = new $lb(array());
                if (isset($O['_id']))
                    unset($O['_id']);
                $Mg = array();
                foreach ($O as $z => $Y) {
                    if ($Y == 'NULL') {
                        $Mg[$z] = 1;
                        unset($O[$z]);
                    }
                }
                $Ni = array(
                    '$set' => $O
                );
                if (count($Mg))
                    $Ni['$unset'] = $Mg;
                $ab->update($Z, $Ni, array(
                    'upsert' => false
                ));
                $Sg               = $h->_link->executeBulkWrite("$m.$Q", $ab);
                $h->affected_rows = $Sg->getModifiedCount();
                return true;
            }
            function delete($Q, $zg, $_ = 0)
            {
                global $h;
                $m  = $h->_db_name;
                $Z  = sql_query_where_parser($zg);
                $lb = 'MongoDB\Driver\BulkWrite';
                $ab = new $lb(array());
                $ab->delete($Z, array(
                    'limit' => $_
                ));
                $Sg               = $h->_link->executeBulkWrite("$m.$Q", $ab);
                $h->affected_rows = $Sg->getDeletedCount();
                return true;
            }
            function insert($Q, $O)
            {
                global $h;
                $m  = $h->_db_name;
                $lb = 'MongoDB\Driver\BulkWrite';
                $ab = new $lb(array());
                if (isset($O['_id']) && empty($O['_id']))
                    unset($O['_id']);
                $ab->insert($O);
                $Sg               = $h->_link->executeBulkWrite("$m.$Q", $ab);
                $h->affected_rows = $Sg->getInsertedCount();
                return true;
            }
        }
        function get_databases($cd)
        {
            global $h;
            $I  = array();
            $lb = 'MongoDB\Driver\Command';
            $tb = new $lb(array(
                'listDatabases' => 1
            ));
            $Sg = $h->_link->executeCommand('admin', $tb);
            foreach ($Sg as $Sb) {
                foreach ($Sb->databases as $m)
                    $I[] = $m->name;
            }
            return $I;
        }
        function count_tables($l)
        {
            $I = array();
            return $I;
        }
        function tables_list()
        {
            global $h;
            $lb = 'MongoDB\Driver\Command';
            $tb = new $lb(array(
                'listCollections' => 1
            ));
            $Sg = $h->_link->executeCommand($h->_db_name, $tb);
            $rb = array();
            foreach ($Sg as $H)
                $rb[$H->name] = 'table';
            return $rb;
        }
        function drop_databases($l)
        {
            return false;
        }
        function indexes($Q, $i = null)
        {
            global $h;
            $I  = array();
            $lb = 'MongoDB\Driver\Command';
            $tb = new $lb(array(
                'listIndexes' => $Q
            ));
            $Sg = $h->_link->executeCommand($h->_db_name, $tb);
            foreach ($Sg as $w) {
                $Zb = array();
                $f  = array();
                foreach (get_object_vars($w->key) as $e => $T) {
                    $Zb[] = ($T == -1 ? '1' : null);
                    $f[]  = $e;
                }
                $I[$w->name] = array(
                    "type" => ($w->name == "_id_" ? "PRIMARY" : (isset($w->unique) ? "UNIQUE" : "INDEX")),
                    "columns" => $f,
                    "lengths" => array(),
                    "descs" => $Zb
                );
            }
            return $I;
        }
        function fields($Q)
        {
            $q = fields_from_edit();
            if (!count($q)) {
                global $n;
                $H = $n->select($Q, array(
                    "*"
                ), null, null, array(), 10);
                while ($J = $H->fetch_assoc()) {
                    foreach ($J as $z => $X) {
                        $J[$z] = null;
                        $q[$z] = array(
                            "field" => $z,
                            "type" => "string",
                            "null" => ($z != $n->primary),
                            "auto_increment" => ($z == $n->primary),
                            "privileges" => array(
                                "insert" => 1,
                                "select" => 1,
                                "update" => 1
                            )
                        );
                    }
                }
            }
            return $q;
        }
        function found_rows($R, $Z)
        {
            global $h;
            $Z  = where_to_query($Z);
            $lb = 'MongoDB\Driver\Command';
            $tb = new $lb(array(
                'count' => $R['Name'],
                'query' => $Z
            ));
            $Sg = $h->_link->executeCommand($h->_db_name, $tb);
            $ri = $Sg->toArray();
            return $ri[0]->n;
        }
        function sql_query_where_parser($zg)
        {
            $zg = trim(preg_replace('/WHERE[\s]?[(]?\(?/', '', $zg));
            $zg = preg_replace('/\)\)\)$/', ')', $zg);
            $oj = explode(' AND ', $zg);
            $pj = explode(') OR (', $zg);
            $Z  = array();
            foreach ($oj as $mj)
                $Z[] = trim($mj);
            if (count($pj) == 1)
                $pj = array();
            elseif (count($pj) > 1)
                $Z = array();
            return where_to_query($Z, $pj);
        }
        function where_to_query($kj = array(), $lj = array())
        {
            global $b;
            $Nb = array();
            foreach (array(
                'and' => $kj,
                'or' => $lj
            ) as $T => $Z) {
                if (is_array($Z)) {
                    foreach ($Z as $Jc) {
                        list($ob, $wf, $X) = explode(" ", $Jc, 3);
                        if ($ob == "_id") {
                            $X  = str_replace('MongoDB\BSON\ObjectID("', "", $X);
                            $X  = str_replace('")', "", $X);
                            $lb = 'MongoDB\BSON\ObjectID';
                            $X  = new $lb($X);
                        }
                        if (!in_array($wf, $b->operators))
                            continue;
                        if (preg_match('~^\(f\)(.+)~', $wf, $B)) {
                            $X  = (float) $X;
                            $wf = $B[1];
                        } elseif (preg_match('~^\(date\)(.+)~', $wf, $B)) {
                            $Pb = new DateTime($X);
                            $lb = 'MongoDB\BSON\UTCDatetime';
                            $X  = new $lb($Pb->getTimestamp() * 1000);
                            $wf = $B[1];
                        }
                        switch ($wf) {
                            case '=':
                                $wf = '$eq';
                                break;
                            case '!=':
                                $wf = '$ne';
                                break;
                            case '>':
                                $wf = '$gt';
                                break;
                            case '<':
                                $wf = '$lt';
                                break;
                            case '>=':
                                $wf = '$gte';
                                break;
                            case '<=':
                                $wf = '$lte';
                                break;
                            case 'regex':
                                $wf = '$regex';
                                break;
                            default:
                                continue 2;
                        }
                        if ($T == 'and')
                            $Nb['$and'][] = array(
                                $ob => array(
                                    $wf => $X
                                )
                            );
                        elseif ($T == 'or')
                            $Nb['$or'][] = array(
                                $ob => array(
                                    $wf => $X
                                )
                            );
                    }
                }
            }
            return $Nb;
        }
        $yf = array(
            "=",
            "!=",
            ">",
            "<",
            ">=",
            "<=",
            "regex",
            "(f)=",
            "(f)!=",
            "(f)>",
            "(f)<",
            "(f)>=",
            "(f)<=",
            "(date)=",
            "(date)!=",
            "(date)>",
            "(date)<",
            "(date)>=",
            "(date)<="
        );
    }
    function table($v)
    {
        return $v;
    }
    function idf_escape($v)
    {
        return $v;
    }
    function table_status($C = "", $Qc = false)
    {
        $I = array();
        foreach (tables_list() as $Q => $T) {
            $I[$Q] = array(
                "Name" => $Q
            );
            if ($C == $Q)
                return $I[$Q];
        }
        return $I;
    }
    function create_database($m, $d)
    {
        return true;
    }
    function last_id()
    {
        global $h;
        return $h->last_id;
    }
    function error()
    {
        global $h;
        return h($h->error);
    }
    function collations()
    {
        return array();
    }
    function logged_user()
    {
        global $b;
        $Ib = $b->credentials();
        return $Ib[1];
    }
    function connect()
    {
        global $b;
        $h = new Min_DB;
        list($N, $V, $F) = $b->credentials();
        $Af = array();
        if ($V . $F != "") {
            $Af["username"] = $V;
            $Af["password"] = $F;
        }
        $m = $b->database();
        if ($m != "")
            $Af["db"] = $m;
        if (($Ma = getenv("MONGO_AUTH_SOURCE")))
            $Af["authSource"] = $Ma;
        try {
            $h->_link = $h->connect("mongodb://$N", $Af);
            if ($F != "") {
                $Af["password"] = "";
                try {
                    $h->connect("mongodb://$N", $Af);
                    return lang(22);
                }
                catch (Exception $Cc) {
                }
            }
            return $h;
        }
        catch (Exception $Cc) {
            return $Cc->getMessage();
        }
    }
    function alter_indexes($Q, $c)
    {
        global $h;
        foreach ($c as $X) {
            list($T, $C, $O) = $X;
            if ($O == "DROP")
                $I = $h->_db->command(array(
                    "deleteIndexes" => $Q,
                    "index" => $C
                ));
            else {
                $f = array();
                foreach ($O as $e) {
                    $e     = preg_replace('~ DESC$~', '', $e, 1, $Fb);
                    $f[$e] = ($Fb ? -1 : 1);
                }
                $I = $h->_db->selectCollection($Q)->ensureIndex($f, array(
                    "unique" => ($T == "UNIQUE"),
                    "name" => $C
                ));
            }
            if ($I['errmsg']) {
                $h->error = $I['errmsg'];
                return false;
            }
        }
        return true;
    }
    function support($Rc)
    {
        return preg_match("~database|indexes|descidx~", $Rc);
    }
    function db_collation($m, $qb)
    {
    }
    function information_schema()
    {
    }
    function is_view($R)
    {
    }
    function convert_field($p)
    {
    }
    function unconvert_field($p, $I)
    {
        return $I;
    }
    function foreign_keys($Q)
    {
        return array();
    }
    function fk_support($R)
    {
    }
    function engines()
    {
        return array();
    }
    function alter_table($Q, $C, $q, $ed, $vb, $wc, $d, $Na, $Xf)
    {
        global $h;
        if ($Q == "") {
            $h->_db->createCollection($C);
            return true;
        }
    }
    function drop_tables($S)
    {
        global $h;
        foreach ($S as $Q) {
            $Pg = $h->_db->selectCollection($Q)->drop();
            if (!$Pg['ok'])
                return false;
        }
        return true;
    }
    function truncate_tables($S)
    {
        global $h;
        foreach ($S as $Q) {
            $Pg = $h->_db->selectCollection($Q)->remove();
            if (!$Pg['ok'])
                return false;
        }
        return true;
    }
    $y  = "mongo";
    $md = array();
    $sd = array();
    $oc = array(
        array(
            "json"
        )
    );
}
$gc["elastic"] = "Elasticsearch (beta)";
if (isset($_GET["elastic"])) {
    $kg = array(
        "json + allow_url_fopen"
    );
    define("DRIVER", "elastic");
    if (function_exists('json_decode') && ini_bool('allow_url_fopen')) {
        class Min_DB
        {
            var $extension = "JSON", $server_info, $errno, $error, $_url;
            function rootQuery($bg, $Ab = array(), $Ue = 'GET')
            {
                @ini_set('track_errors', 1);
                $Vc = @file_get_contents("$this->_url/" . ltrim($bg, '/'), false, stream_context_create(array(
                    'http' => array(
                        'method' => $Ue,
                        'content' => $Ab === null ? $Ab : json_encode($Ab),
                        'header' => 'Content-Type: application/json',
                        'ignore_errors' => 1
                    )
                )));
                if (!$Vc) {
                    $this->error = $php_errormsg;
                    return $Vc;
                }
                if (!preg_match('~^HTTP/[0-9.]+ 2~i', $http_response_header[0])) {
                    $this->error = $Vc;
                    return false;
                }
                $I = json_decode($Vc, true);
                if ($I === null) {
                    $this->errno = json_last_error();
                    if (function_exists('json_last_error_msg'))
                        $this->error = json_last_error_msg();
                    else {
                        $_b = get_defined_constants(true);
                        foreach ($_b['json'] as $C => $Y) {
                            if ($Y == $this->errno && preg_match('~^JSON_ERROR_~', $C)) {
                                $this->error = $C;
                                break;
                            }
                        }
                    }
                }
                return $I;
            }
            function query($bg, $Ab = array(), $Ue = 'GET')
            {
                return $this->rootQuery(($this->_db != "" ? "$this->_db/" : "/") . ltrim($bg, '/'), $Ab, $Ue);
            }
            function connect($N, $V, $F)
            {
                preg_match('~^(https?://)?(.*)~', $N, $B);
                $this->_url = ($B[1] ? $B[1] : "http://") . "$V:$F@$B[2]";
                $I          = $this->query('');
                if ($I)
                    $this->server_info = $I['version']['number'];
                return (bool) $I;
            }
            function select_db($k)
            {
                $this->_db = $k;
                return true;
            }
            function quote($P)
            {
                return $P;
            }
        }
        class Min_Result
        {
            var $num_rows, $_rows;
            function __construct($K)
            {
                $this->num_rows = count($K);
                $this->_rows    = $K;
                reset($this->_rows);
            }
            function fetch_assoc()
            {
                $I = current($this->_rows);
                next($this->_rows);
                return $I;
            }
            function fetch_row()
            {
                return array_values($this->fetch_assoc());
            }
        }
    }
    class Min_Driver extends Min_SQL
    {
        function select($Q, $L, $Z, $pd, $Cf = array(), $_ = 1, $E = 0, $pg = false)
        {
            global $b;
            $Nb = array();
            $G  = "$Q/_search";
            if ($L != array(
                "*"
            ))
                $Nb["fields"] = $L;
            if ($Cf) {
                $yh = array();
                foreach ($Cf as $ob) {
                    $ob   = preg_replace('~ DESC$~', '', $ob, 1, $Fb);
                    $yh[] = ($Fb ? array(
                        $ob => "desc"
                    ) : $ob);
                }
                $Nb["sort"] = $yh;
            }
            if ($_) {
                $Nb["size"] = +$_;
                if ($E)
                    $Nb["from"] = ($E * $_);
            }
            foreach ($Z as $X) {
                list($ob, $wf, $X) = explode(" ", $X, 3);
                if ($ob == "_id")
                    $Nb["query"]["ids"]["values"][] = $X;
                elseif ($ob . $X != "") {
                    $ei = array(
                        "term" => array(
                            ($ob != "" ? $ob : "_all") => $X
                        )
                    );
                    if ($wf == "=")
                        $Nb["query"]["filtered"]["filter"]["and"][] = $ei;
                    else
                        $Nb["query"]["filtered"]["query"]["bool"]["must"][] = $ei;
                }
            }
            if ($Nb["query"] && !$Nb["query"]["filtered"]["query"] && !$Nb["query"]["ids"])
                $Nb["query"]["filtered"]["query"] = array(
                    "match_all" => array()
                );
            $Gh = microtime(true);
            $fh = $this->_conn->query($G, $Nb);
            if ($pg)
                echo $b->selectQuery("$G: " . json_encode($Nb), $Gh, !$fh);
            if (!$fh)
                return false;
            $I = array();
            foreach ($fh['hits']['hits'] as $Bd) {
                $J = array();
                if ($L == array(
                    "*"
                ))
                    $J["_id"] = $Bd["_id"];
                $q = $Bd['_source'];
                if ($L != array(
                    "*"
                )) {
                    $q = array();
                    foreach ($L as $z)
                        $q[$z] = $Bd['fields'][$z];
                }
                foreach ($q as $z => $X) {
                    if ($Nb["fields"])
                        $X = $X[0];
                    $J[$z] = (is_array($X) ? json_encode($X) : $X);
                }
                $I[] = $J;
            }
            return new Min_Result($I);
        }
        function update($T, $Dg, $zg, $_ = 0, $M = "\n")
        {
            $Zf = preg_split('~ *= *~', $zg);
            if (count($Zf) == 2) {
                $u = trim($Zf[1]);
                $G = "$T/$u";
                return $this->_conn->query($G, $Dg, 'POST');
            }
            return false;
        }
        function insert($T, $Dg)
        {
            $u                    = "";
            $G                    = "$T/$u";
            $Pg                   = $this->_conn->query($G, $Dg, 'POST');
            $this->_conn->last_id = $Pg['_id'];
            return $Pg['created'];
        }
        function delete($T, $zg, $_ = 0)
        {
            $Gd = array();
            if (is_array($_GET["where"]) && $_GET["where"]["_id"])
                $Gd[] = $_GET["where"]["_id"];
            if (is_array($_POST['check'])) {
                foreach ($_POST['check'] as $eb) {
                    $Zf = preg_split('~ *= *~', $eb);
                    if (count($Zf) == 2)
                        $Gd[] = trim($Zf[1]);
                }
            }
            $this->_conn->affected_rows = 0;
            foreach ($Gd as $u) {
                $G  = "{$T}/{$u}";
                $Pg = $this->_conn->query($G, '{}', 'DELETE');
                if (is_array($Pg) && $Pg['found'] == true)
                    $this->_conn->affected_rows++;
            }
            return $this->_conn->affected_rows;
        }
    }
    function connect()
    {
        global $b;
        $h = new Min_DB;
        list($N, $V, $F) = $b->credentials();
        if ($F != "" && $h->connect($N, $V, ""))
            return lang(22);
        if ($h->connect($N, $V, $F))
            return $h;
        return $h->error;
    }
    function support($Rc)
    {
        return preg_match("~database|table|columns~", $Rc);
    }
    function logged_user()
    {
        global $b;
        $Ib = $b->credentials();
        return $Ib[1];
    }
    function get_databases()
    {
        global $h;
        $I = $h->rootQuery('_aliases');
        if ($I) {
            $I = array_keys($I);
            sort($I, SORT_STRING);
        }
        return $I;
    }
    function collations()
    {
        return array();
    }
    function db_collation($m, $qb)
    {
    }
    function engines()
    {
        return array();
    }
    function count_tables($l)
    {
        global $h;
        $I = array();
        $H = $h->query('_stats');
        if ($H && $H['indices']) {
            $Od = $H['indices'];
            foreach ($Od as $Nd => $Hh) {
                $Md     = $Hh['total']['indexing'];
                $I[$Nd] = $Md['index_total'];
            }
        }
        return $I;
    }
    function tables_list()
    {
        global $h;
        $I = $h->query('_mapping');
        if ($I)
            $I = array_fill_keys(array_keys($I[$h->_db]["mappings"]), 'table');
        return $I;
    }
    function table_status($C = "", $Qc = false)
    {
        global $h;
        $fh = $h->query("_search", array(
            "size" => 0,
            "aggregations" => array(
                "count_by_type" => array(
                    "terms" => array(
                        "field" => "_type"
                    )
                )
            )
        ), "POST");
        $I  = array();
        if ($fh) {
            $S = $fh["aggregations"]["count_by_type"]["buckets"];
            foreach ($S as $Q) {
                $I[$Q["key"]] = array(
                    "Name" => $Q["key"],
                    "Engine" => "table",
                    "Rows" => $Q["doc_count"]
                );
                if ($C != "" && $C == $Q["key"])
                    return $I[$C];
            }
        }
        return $I;
    }
    function error()
    {
        global $h;
        return h($h->error);
    }
    function information_schema()
    {
    }
    function is_view($R)
    {
    }
    function indexes($Q, $i = null)
    {
        return array(
            array(
                "type" => "PRIMARY",
                "columns" => array(
                    "_id"
                )
            )
        );
    }
    function fields($Q)
    {
        global $h;
        $H = $h->query("$Q/_mapping");
        $I = array();
        if ($H) {
            $Ce = $H[$Q]['properties'];
            if (!$Ce)
                $Ce = $H[$h->_db]['mappings'][$Q]['properties'];
            if ($Ce) {
                foreach ($Ce as $C => $p) {
                    $I[$C] = array(
                        "field" => $C,
                        "full_type" => $p["type"],
                        "type" => $p["type"],
                        "privileges" => array(
                            "insert" => 1,
                            "select" => 1,
                            "update" => 1
                        )
                    );
                    if ($p["properties"]) {
                        unset($I[$C]["privileges"]["insert"]);
                        unset($I[$C]["privileges"]["update"]);
                    }
                }
            }
        }
        return $I;
    }
    function foreign_keys($Q)
    {
        return array();
    }
    function table($v)
    {
        return $v;
    }
    function idf_escape($v)
    {
        return $v;
    }
    function convert_field($p)
    {
    }
    function unconvert_field($p, $I)
    {
        return $I;
    }
    function fk_support($R)
    {
    }
    function found_rows($R, $Z)
    {
        return null;
    }
    function create_database($m)
    {
        global $h;
        return $h->rootQuery(urlencode($m), null, 'PUT');
    }
    function drop_databases($l)
    {
        global $h;
        return $h->rootQuery(urlencode(implode(',', $l)), array(), 'DELETE');
    }
    function alter_table($Q, $C, $q, $ed, $vb, $wc, $d, $Na, $Xf)
    {
        global $h;
        $vg = array();
        foreach ($q as $Oc) {
            $Tc      = trim($Oc[1][0]);
            $Uc      = trim($Oc[1][1] ? $Oc[1][1] : "text");
            $vg[$Tc] = array(
                'type' => $Uc
            );
        }
        if (!empty($vg))
            $vg = array(
                'properties' => $vg
            );
        return $h->query("_mapping/{$C}", $vg, 'PUT');
    }
    function drop_tables($S)
    {
        global $h;
        $I = true;
        foreach ($S as $Q)
            $I = $I && $h->query(urlencode($Q), array(), 'DELETE');
        return $I;
    }
    function last_id()
    {
        global $h;
        return $h->last_id;
    }
    $y  = "elastic";
    $yf = array(
        "=",
        "query"
    );
    $md = array();
    $sd = array();
    $oc = array(
        array(
            "json"
        )
    );
    $U  = array();
    $Lh = array();
    foreach (array(
        lang(27) => array(
            "long" => 3,
            "integer" => 5,
            "short" => 8,
            "byte" => 10,
            "double" => 20,
            "float" => 66,
            "half_float" => 12,
            "scaled_float" => 21
        ),
        lang(28) => array(
            "date" => 10
        ),
        lang(25) => array(
            "string" => 65535,
            "text" => 65535
        ),
        lang(29) => array(
            "binary" => 255
        )
    ) as $z => $X) {
        $U += $X;
        $Lh[$z] = array_keys($X);
    }
}
$gc["clickhouse"] = "ClickHouse (alpha)";
if (isset($_GET["clickhouse"])) {
    define("DRIVER", "clickhouse");
    class Min_DB
    {
        var $extension = "JSON", $server_info, $errno, $_result, $error, $_url;
        var $_db = 'default';
        function rootQuery($m, $G)
        {
            @ini_set('track_errors', 1);
            $Vc = @file_get_contents("$this->_url/?database=$m", false, stream_context_create(array(
                'http' => array(
                    'method' => 'POST',
                    'content' => $this->isQuerySelectLike($G) ? "$G FORMAT JSONCompact" : $G,
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'ignore_errors' => 1
                )
            )));
            if ($Vc === false) {
                $this->error = $php_errormsg;
                return $Vc;
            }
            if (!preg_match('~^HTTP/[0-9.]+ 2~i', $http_response_header[0])) {
                $this->error = $Vc;
                return false;
            }
            $I = json_decode($Vc, true);
            if ($I === null) {
                $this->errno = json_last_error();
                if (function_exists('json_last_error_msg'))
                    $this->error = json_last_error_msg();
                else {
                    $_b = get_defined_constants(true);
                    foreach ($_b['json'] as $C => $Y) {
                        if ($Y == $this->errno && preg_match('~^JSON_ERROR_~', $C)) {
                            $this->error = $C;
                            break;
                        }
                    }
                }
            }
            return new Min_Result($I);
        }
        function isQuerySelectLike($G)
        {
            return (bool) preg_match('~^(select|show)~i', $G);
        }
        function query($G)
        {
            return $this->rootQuery($this->_db, $G);
        }
        function connect($N, $V, $F)
        {
            preg_match('~^(https?://)?(.*)~', $N, $B);
            $this->_url = ($B[1] ? $B[1] : "http://") . "$V:$F@$B[2]";
            $I          = $this->query('SELECT 1');
            return (bool) $I;
        }
        function select_db($k)
        {
            $this->_db = $k;
            return true;
        }
        function quote($P)
        {
            return "'" . addcslashes($P, "\\'") . "'";
        }
        function multi_query($G)
        {
            return $this->_result = $this->query($G);
        }
        function store_result()
        {
            return $this->_result;
        }
        function next_result()
        {
            return false;
        }
        function result($G, $p = 0)
        {
            $H = $this->query($G);
            return $H['data'];
        }
    }
    class Min_Result
    {
        var $num_rows, $_rows, $columns, $meta, $_offset = 0;
        function __construct($H)
        {
            $this->num_rows = $H['rows'];
            $this->_rows    = $H['data'];
            $this->meta     = $H['meta'];
            $this->columns  = array_column($this->meta, 'name');
            reset($this->_rows);
        }
        function fetch_assoc()
        {
            $J = current($this->_rows);
            next($this->_rows);
            return $J === false ? false : array_combine($this->columns, $J);
        }
        function fetch_row()
        {
            $J = current($this->_rows);
            next($this->_rows);
            return $J;
        }
        function fetch_field()
        {
            $e = $this->_offset++;
            $I = new stdClass;
            if ($e < count($this->columns)) {
                $I->name    = $this->meta[$e]['name'];
                $I->orgname = $I->name;
                $I->type    = $this->meta[$e]['type'];
            }
            return $I;
        }
    }
    class Min_Driver extends Min_SQL
    {
        function delete($Q, $zg, $_ = 0)
        {
            return queries("ALTER TABLE " . table($Q) . " DELETE $zg");
        }
        function update($Q, $O, $zg, $_ = 0, $M = "\n")
        {
            $Zi = array();
            foreach ($O as $z => $X)
                $Zi[] = "$z = $X";
            $G = $M . implode(",$M", $Zi);
            return queries("ALTER TABLE " . table($Q) . " UPDATE $G$zg");
        }
    }
    function idf_escape($v)
    {
        return "`" . str_replace("`", "``", $v) . "`";
    }
    function table($v)
    {
        return idf_escape($v);
    }
    function explain($h, $G)
    {
        return '';
    }
    function found_rows($R, $Z)
    {
        $K = get_vals("SELECT COUNT(*) FROM " . idf_escape($R["Name"]) . ($Z ? " WHERE " . implode(" AND ", $Z) : ""));
        return empty($K) ? false : $K[0];
    }
    function alter_table($Q, $C, $q, $ed, $vb, $wc, $d, $Na, $Xf)
    {
        foreach ($q as $p) {
            if ($p[1][2] === " NULL")
                $p[1][1] = " Nullable({$p[1][1]})";
            unset($p[1][2]);
        }
    }
    function truncate_tables($S)
    {
        return apply_queries("TRUNCATE TABLE", $S);
    }
    function drop_views($ej)
    {
        return drop_tables($ej);
    }
    function drop_tables($S)
    {
        return apply_queries("DROP TABLE", $S);
    }
    function connect()
    {
        global $b;
        $h  = new Min_DB;
        $Ib = $b->credentials();
        if ($h->connect($Ib[0], $Ib[1], $Ib[2]))
            return $h;
        return $h->error;
    }
    function get_databases($cd)
    {
        global $h;
        $H = get_rows('SHOW DATABASES');
        $I = array();
        foreach ($H as $J)
            $I[] = $J['name'];
        sort($I);
        return $I;
    }
    function limit($G, $Z, $_, $D = 0, $M = " ")
    {
        return " $G$Z" . ($_ !== null ? $M . "LIMIT $_" . ($D ? ", $D" : "") : "");
    }
    function limit1($Q, $G, $Z, $M = "\n")
    {
        return limit($G, $Z, 1, 0, $M);
    }
    function db_collation($m, $qb)
    {
    }
    function engines()
    {
        return array(
            'MergeTree'
        );
    }
    function logged_user()
    {
        global $b;
        $Ib = $b->credentials();
        return $Ib[1];
    }
    function tables_list()
    {
        $H = get_rows('SHOW TABLES');
        $I = array();
        foreach ($H as $J)
            $I[$J['name']] = 'table';
        ksort($I);
        return $I;
    }
    function count_tables($l)
    {
        return array();
    }
    function table_status($C = "", $Qc = false)
    {
        global $h;
        $I = array();
        $S = get_rows("SELECT name, engine FROM system.tables WHERE database = " . q($h->_db));
        foreach ($S as $Q) {
            $I[$Q['name']] = array(
                'Name' => $Q['name'],
                'Engine' => $Q['engine']
            );
            if ($C === $Q['name'])
                return $I[$Q['name']];
        }
        return $I;
    }
    function is_view($R)
    {
        return false;
    }
    function fk_support($R)
    {
        return false;
    }
    function convert_field($p)
    {
    }
    function unconvert_field($p, $I)
    {
        if (in_array($p['type'], array(
            "Int8",
            "Int16",
            "Int32",
            "Int64",
            "UInt8",
            "UInt16",
            "UInt32",
            "UInt64",
            "Float32",
            "Float64"
        )))
            return "to$p[type]($I)";
        return $I;
    }
    function fields($Q)
    {
        $I = array();
        $H = get_rows("SELECT name, type, default_expression FROM system.columns WHERE " . idf_escape('table') . " = " . q($Q));
        foreach ($H as $J) {
            $T                   = trim($J['type']);
            $if                  = strpos($T, 'Nullable(') === 0;
            $I[trim($J['name'])] = array(
                "field" => trim($J['name']),
                "full_type" => $T,
                "type" => $T,
                "default" => trim($J['default_expression']),
                "null" => $if,
                "auto_increment" => '0',
                "privileges" => array(
                    "insert" => 1,
                    "select" => 1,
                    "update" => 0
                )
            );
        }
        return $I;
    }
    function indexes($Q, $i = null)
    {
        return array();
    }
    function foreign_keys($Q)
    {
        return array();
    }
    function collations()
    {
        return array();
    }
    function information_schema($m)
    {
        return false;
    }
    function error()
    {
        global $h;
        return h($h->error);
    }
    function types()
    {
        return array();
    }
    function schemas()
    {
        return array();
    }
    function get_schema()
    {
        return "";
    }
    function set_schema($dh)
    {
        return true;
    }
    function auto_increment()
    {
        return '';
    }
    function last_id()
    {
        return 0;
    }
    function support($Rc)
    {
        return preg_match("~^(columns|sql|status|table)$~", $Rc);
    }
    $y  = "clickhouse";
    $U  = array();
    $Lh = array();
    foreach (array(
        lang(27) => array(
            "Int8" => 3,
            "Int16" => 5,
            "Int32" => 10,
            "Int64" => 19,
            "UInt8" => 3,
            "UInt16" => 5,
            "UInt32" => 10,
            "UInt64" => 20,
            "Float32" => 7,
            "Float64" => 16,
            'Decimal' => 38,
            'Decimal32' => 9,
            'Decimal64' => 18,
            'Decimal128' => 38
        ),
        lang(28) => array(
            "Date" => 13,
            "DateTime" => 20
        ),
        lang(25) => array(
            "String" => 0
        ),
        lang(29) => array(
            "FixedString" => 0
        )
    ) as $z => $X) {
        $U += $X;
        $Lh[$z] = array_keys($X);
    }
    $Mi = array();
    $yf = array(
        "=",
        "<",
        ">",
        "<=",
        ">=",
        "!=",
        "~",
        "!~",
        "LIKE",
        "LIKE %%",
        "IN",
        "IS NULL",
        "NOT LIKE",
        "NOT IN",
        "IS NOT NULL",
        "SQL"
    );
    $md = array();
    $sd = array(
        "avg",
        "count",
        "count distinct",
        "max",
        "min",
        "sum"
    );
    $oc = array();
}
$gc = array(
    "server" => "MySQL"
) + $gc;
if (!defined("DRIVER")) {
    $kg = array(
        "MySQLi",
        "MySQL",
        "PDO_MySQL"
    );
    define("DRIVER", "server");
    if (extension_loaded("mysqli")) {
        class Min_DB extends MySQLi
        {
            var $extension = "MySQLi";
            function __construct()
            {
                parent::init();
            }
            function connect($N = "", $V = "", $F = "", $k = null, $gg = null, $xh = null)
            {
                global $b;
                mysqli_report(MYSQLI_REPORT_OFF);
                list($Cd, $gg) = explode(":", $N, 2);
                $Fh = $b->connectSsl();
                if ($Fh)
                    $this->ssl_set($Fh['key'], $Fh['cert'], $Fh['ca'], '', '');
                $I = @$this->real_connect(($N != "" ? $Cd : ini_get("mysqli.default_host")), ($N . $V != "" ? $V : ini_get("mysqli.default_user")), ($N . $V . $F != "" ? $F : ini_get("mysqli.default_pw")), $k, (is_numeric($gg) ? $gg : ini_get("mysqli.default_port")), (!is_numeric($gg) ? $gg : $xh), ($Fh ? 64 : 0));
                $this->options(MYSQLI_OPT_LOCAL_INFILE, false);
                return $I;
            }
            function set_charset($db)
            {
                if (parent::set_charset($db))
                    return true;
                parent::set_charset('utf8');
                return $this->query("SET NAMES $db");
            }
            function result($G, $p = 0)
            {
                $H = $this->query($G);
                if (!$H)
                    return false;
                $J = $H->fetch_array();
                return $J[$p];
            }
            function quote($P)
            {
                return "'" . $this->escape_string($P) . "'";
            }
        }
    } elseif (extension_loaded("mysql") && !((ini_bool("sql.safe_mode") || ini_bool("mysql.allow_local_infile")) && extension_loaded("pdo_mysql"))) {
        class Min_DB
        {
            var $extension = "MySQL", $server_info, $affected_rows, $errno, $error, $_link, $_result;
            function connect($N, $V, $F)
            {
                if (ini_bool("mysql.allow_local_infile")) {
                    $this->error = lang(32, "'mysql.allow_local_infile'", "MySQLi", "PDO_MySQL");
                    return false;
                }
                $this->_link = @mysql_connect(($N != "" ? $N : ini_get("mysql.default_host")), ("$N$V" != "" ? $V : ini_get("mysql.default_user")), ("$N$V$F" != "" ? $F : ini_get("mysql.default_password")), true, 131072);
                if ($this->_link)
                    $this->server_info = mysql_get_server_info($this->_link);
                else
                    $this->error = mysql_error();
                return (bool) $this->_link;
            }
            function set_charset($db)
            {
                if (function_exists('mysql_set_charset')) {
                    if (mysql_set_charset($db, $this->_link))
                        return true;
                    mysql_set_charset('utf8', $this->_link);
                }
                return $this->query("SET NAMES $db");
            }
            function quote($P)
            {
                return "'" . mysql_real_escape_string($P, $this->_link) . "'";
            }
            function select_db($k)
            {
                return mysql_select_db($k, $this->_link);
            }
            function query($G, $Gi = false)
            {
                $H           = @($Gi ? mysql_unbuffered_query($G, $this->_link) : mysql_query($G, $this->_link));
                $this->error = "";
                if (!$H) {
                    $this->errno = mysql_errno($this->_link);
                    $this->error = mysql_error($this->_link);
                    return false;
                }
                if ($H === true) {
                    $this->affected_rows = mysql_affected_rows($this->_link);
                    $this->info          = mysql_info($this->_link);
                    return true;
                }
                return new Min_Result($H);
            }
            function multi_query($G)
            {
                return $this->_result = $this->query($G);
            }
            function store_result()
            {
                return $this->_result;
            }
            function next_result()
            {
                return false;
            }
            function result($G, $p = 0)
            {
                $H = $this->query($G);
                if (!$H || !$H->num_rows)
                    return false;
                return mysql_result($H->_result, 0, $p);
            }
        }
        class Min_Result
        {
            var $num_rows, $_result, $_offset = 0;
            function __construct($H)
            {
                $this->_result  = $H;
                $this->num_rows = mysql_num_rows($H);
            }
            function fetch_assoc()
            {
                return mysql_fetch_assoc($this->_result);
            }
            function fetch_row()
            {
                return mysql_fetch_row($this->_result);
            }
            function fetch_field()
            {
                $I            = mysql_fetch_field($this->_result, $this->_offset++);
                $I->orgtable  = $I->table;
                $I->orgname   = $I->name;
                $I->charsetnr = ($I->blob ? 63 : 0);
                return $I;
            }
            function __destruct()
            {
                mysql_free_result($this->_result);
            }
        }
    } elseif (extension_loaded("pdo_mysql")) {
        class Min_DB extends Min_PDO
        {
            var $extension = "PDO_MySQL";
            function connect($N, $V, $F)
            {
                global $b;
                $Af = array(
                    PDO::MYSQL_ATTR_LOCAL_INFILE => false
                );
                $Fh = $b->connectSsl();
                if ($Fh) {
                    if (!empty($Fh['key']))
                        $Af[PDO::MYSQL_ATTR_SSL_KEY] = $Fh['key'];
                    if (!empty($Fh['cert']))
                        $Af[PDO::MYSQL_ATTR_SSL_CERT] = $Fh['cert'];
                    if (!empty($Fh['ca']))
                        $Af[PDO::MYSQL_ATTR_SSL_CA] = $Fh['ca'];
                }
                $this->dsn("mysql:charset=utf8;host=" . str_replace(":", ";unix_socket=", preg_replace('~:(\d)~', ';port=\1', $N)), $V, $F, $Af);
                return true;
            }
            function set_charset($db)
            {
                $this->query("SET NAMES $db");
            }
            function select_db($k)
            {
                return $this->query("USE " . idf_escape($k));
            }
            function query($G, $Gi = false)
            {
                $this->setAttribute(1000, !$Gi);
                return parent::query($G, $Gi);
            }
        }
    }
    class Min_Driver extends Min_SQL
    {
        function insert($Q, $O)
        {
            return ($O ? parent::insert($Q, $O) : queries("INSERT INTO " . table($Q) . " ()\nVALUES ()"));
        }
        function insertUpdate($Q, $K, $ng)
        {
            $f  = array_keys(reset($K));
            $lg = "INSERT INTO " . table($Q) . " (" . implode(", ", $f) . ") VALUES\n";
            $Zi = array();
            foreach ($f as $z)
                $Zi[$z] = "$z = VALUES($z)";
            $Oh = "\nON DUPLICATE KEY UPDATE " . implode(", ", $Zi);
            $Zi = array();
            $we = 0;
            foreach ($K as $O) {
                $Y = "(" . implode(", ", $O) . ")";
                if ($Zi && (strlen($lg) + $we + strlen($Y) + strlen($Oh) > 1e6)) {
                    if (!queries($lg . implode(",\n", $Zi) . $Oh))
                        return false;
                    $Zi = array();
                    $we = 0;
                }
                $Zi[] = $Y;
                $we += strlen($Y) + 2;
            }
            return queries($lg . implode(",\n", $Zi) . $Oh);
        }
        function slowQuery($G, $ji)
        {
            if (min_version('5.7.8', '10.1.2')) {
                if (preg_match('~MariaDB~', $this->_conn->server_info))
                    return "SET STATEMENT max_statement_time=$ji FOR $G";
                elseif (preg_match('~^(SELECT\b)(.+)~is', $G, $B))
                    return "$B[1] /*+ MAX_EXECUTION_TIME(" . ($ji * 1000) . ") */ $B[2]";
            }
        }
        function convertSearch($v, $X, $p)
        {
            return (preg_match('~char|text|enum|set~', $p["type"]) && !preg_match("~^utf8~", $p["collation"]) && preg_match('~[\x80-\xFF]~', $X['val']) ? "CONVERT($v USING " . charset($this->_conn) . ")" : $v);
        }
        function warnings()
        {
            $H = $this->_conn->query("SHOW WARNINGS");
            if ($H && $H->num_rows) {
                ob_start();
                select($H);
                return ob_get_clean();
            }
        }
        function tableHelp($C)
        {
            $De = preg_match('~MariaDB~', $this->_conn->server_info);
            if (information_schema(DB))
                return strtolower(($De ? "information-schema-$C-table/" : str_replace("_", "-", $C) . "-table.html"));
            if (DB == "mysql")
                return ($De ? "mysql$C-table/" : "system-database.html");
        }
    }
    function idf_escape($v)
    {
        return "`" . str_replace("`", "``", $v) . "`";
    }
    function table($v)
    {
        return idf_escape($v);
    }
    function connect()
    {
        global $b, $U, $Lh;
        $h  = new Min_DB;
        $Ib = $b->credentials();
        if ($h->connect($Ib[0], $Ib[1], $Ib[2])) {
            $h->set_charset(charset($h));
            $h->query("SET sql_quote_show_create = 1, autocommit = 1");
            if (min_version('5.7.8', 10.2, $h)) {
                $Lh[lang(25)][] = "json";
                $U["json"]      = 4294967295;
            }
            return $h;
        }
        $I = $h->error;
        if (function_exists('iconv') && !is_utf8($I) && strlen($bh = iconv("windows-1250", "utf-8", $I)) > strlen($I))
            $I = $bh;
        return $I;
    }
    function get_databases($cd)
    {
        $I = get_session("dbs");
        if ($I === null) {
            $G = (min_version(5) ? "SELECT SCHEMA_NAME FROM information_schema.SCHEMATA ORDER BY SCHEMA_NAME" : "SHOW DATABASES");
            $I = ($cd ? slow_query($G) : get_vals($G));
            restart_session();
            set_session("dbs", $I);
            stop_session();
        }
        return $I;
    }
    function limit($G, $Z, $_, $D = 0, $M = " ")
    {
        return " $G$Z" . ($_ !== null ? $M . "LIMIT $_" . ($D ? " OFFSET $D" : "") : "");
    }
    function limit1($Q, $G, $Z, $M = "\n")
    {
        return limit($G, $Z, 1, 0, $M);
    }
    function db_collation($m, $qb)
    {
        global $h;
        $I = null;
        $j = $h->result("SHOW CREATE DATABASE " . idf_escape($m), 1);
        if (preg_match('~ COLLATE ([^ ]+)~', $j, $B))
            $I = $B[1];
        elseif (preg_match('~ CHARACTER SET ([^ ]+)~', $j, $B))
            $I = $qb[$B[1]][-1];
        return $I;
    }
    function engines()
    {
        $I = array();
        foreach (get_rows("SHOW ENGINES") as $J) {
            if (preg_match("~YES|DEFAULT~", $J["Support"]))
                $I[] = $J["Engine"];
        }
        return $I;
    }
    function logged_user()
    {
        global $h;
        return $h->result("SELECT USER()");
    }
    function tables_list()
    {
        return get_key_vals(min_version(5) ? "SELECT TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME" : "SHOW TABLES");
    }
    function count_tables($l)
    {
        $I = array();
        foreach ($l as $m)
            $I[$m] = count(get_vals("SHOW TABLES IN " . idf_escape($m)));
        return $I;
    }
    function table_status($C = "", $Qc = false)
    {
        $I = array();
        foreach (get_rows($Qc && min_version(5) ? "SELECT TABLE_NAME AS Name, ENGINE AS Engine, TABLE_COMMENT AS Comment FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() " . ($C != "" ? "AND TABLE_NAME = " . q($C) : "ORDER BY Name") : "SHOW TABLE STATUS" . ($C != "" ? " LIKE " . q(addcslashes($C, "%_\\")) : "")) as $J) {
            if ($J["Engine"] == "InnoDB")
                $J["Comment"] = preg_replace('~(?:(.+); )?InnoDB free: .*~', '\1', $J["Comment"]);
            if (!isset($J["Engine"]))
                $J["Comment"] = "";
            if ($C != "")
                return $J;
            $I[$J["Name"]] = $J;
        }
        return $I;
    }
    function is_view($R)
    {
        return $R["Engine"] === null;
    }
    function fk_support($R)
    {
        return preg_match('~InnoDB|IBMDB2I~i', $R["Engine"]) || (preg_match('~NDB~i', $R["Engine"]) && min_version(5.6));
    }
    function fields($Q)
    {
        $I = array();
        foreach (get_rows("SHOW FULL COLUMNS FROM " . table($Q)) as $J) {
            preg_match('~^([^( ]+)(?:\((.+)\))?( unsigned)?( zerofill)?$~', $J["Type"], $B);
            $I[$J["Field"]] = array(
                "field" => $J["Field"],
                "full_type" => $J["Type"],
                "type" => $B[1],
                "length" => $B[2],
                "unsigned" => ltrim($B[3] . $B[4]),
                "default" => ($J["Default"] != "" || preg_match("~char|set~", $B[1]) ? $J["Default"] : null),
                "null" => ($J["Null"] == "YES"),
                "auto_increment" => ($J["Extra"] == "auto_increment"),
                "on_update" => (preg_match('~^on update (.+)~i', $J["Extra"], $B) ? $B[1] : ""),
                "collation" => $J["Collation"],
                "privileges" => array_flip(preg_split('~, *~', $J["Privileges"])),
                "comment" => $J["Comment"],
                "primary" => ($J["Key"] == "PRI"),
                "generated" => preg_match('~^(VIRTUAL|PERSISTENT|STORED)~', $J["Extra"])
            );
        }
        return $I;
    }
    function indexes($Q, $i = null)
    {
        $I = array();
        foreach (get_rows("SHOW INDEX FROM " . table($Q), $i) as $J) {
            $C                  = $J["Key_name"];
            $I[$C]["type"]      = ($C == "PRIMARY" ? "PRIMARY" : ($J["Index_type"] == "FULLTEXT" ? "FULLTEXT" : ($J["Non_unique"] ? ($J["Index_type"] == "SPATIAL" ? "SPATIAL" : "INDEX") : "UNIQUE")));
            $I[$C]["columns"][] = $J["Column_name"];
            $I[$C]["lengths"][] = ($J["Index_type"] == "SPATIAL" ? null : $J["Sub_part"]);
            $I[$C]["descs"][]   = null;
        }
        return $I;
    }
    function foreign_keys($Q)
    {
        global $h, $tf;
        static $dg = '(?:`(?:[^`]|``)+`|"(?:[^"]|"")+")';
        $I  = array();
        $Gb = $h->result("SHOW CREATE TABLE " . table($Q), 1);
        if ($Gb) {
            preg_match_all("~CONSTRAINT ($dg) FOREIGN KEY ?\\(((?:$dg,? ?)+)\\) REFERENCES ($dg)(?:\\.($dg))? \\(((?:$dg,? ?)+)\\)(?: ON DELETE ($tf))?(?: ON UPDATE ($tf))?~", $Gb, $Ge, PREG_SET_ORDER);
            foreach ($Ge as $B) {
                preg_match_all("~$dg~", $B[2], $zh);
                preg_match_all("~$dg~", $B[5], $bi);
                $I[idf_unescape($B[1])] = array(
                    "db" => idf_unescape($B[4] != "" ? $B[3] : $B[4]),
                    "table" => idf_unescape($B[4] != "" ? $B[4] : $B[3]),
                    "source" => array_map('idf_unescape', $zh[0]),
                    "target" => array_map('idf_unescape', $bi[0]),
                    "on_delete" => ($B[6] ? $B[6] : "RESTRICT"),
                    "on_update" => ($B[7] ? $B[7] : "RESTRICT")
                );
            }
        }
        return $I;
    }
    function view($C)
    {
        global $h;
        return array(
            "select" => preg_replace('~^(?:[^`]|`[^`]*`)*\s+AS\s+~isU', '', $h->result("SHOW CREATE VIEW " . table($C), 1))
        );
    }
    function collations()
    {
        $I = array();
        foreach (get_rows("SHOW COLLATION") as $J) {
            if ($J["Default"])
                $I[$J["Charset"]][-1] = $J["Collation"];
            else
                $I[$J["Charset"]][] = $J["Collation"];
        }
        ksort($I);
        foreach ($I as $z => $X)
            asort($I[$z]);
        return $I;
    }
    function information_schema($m)
    {
        return (min_version(5) && $m == "information_schema") || (min_version(5.5) && $m == "performance_schema");
    }
    function error()
    {
        global $h;
        return h(preg_replace('~^You have an error.*syntax to use~U', "Syntax error", $h->error));
    }
    function create_database($m, $d)
    {
        return queries("CREATE DATABASE " . idf_escape($m) . ($d ? " COLLATE " . q($d) : ""));
    }
    function drop_databases($l)
    {
        $I = apply_queries("DROP DATABASE", $l, 'idf_escape');
        restart_session();
        set_session("dbs", null);
        return $I;
    }
    function rename_database($C, $d)
    {
        $I = false;
        if (create_database($C, $d)) {
            $Ng = array();
            foreach (tables_list() as $Q => $T)
                $Ng[] = table($Q) . " TO " . idf_escape($C) . "." . table($Q);
            $I = (!$Ng || queries("RENAME TABLE " . implode(", ", $Ng)));
            if ($I)
                queries("DROP DATABASE " . idf_escape(DB));
            restart_session();
            set_session("dbs", null);
        }
        return $I;
    }
    function auto_increment()
    {
        $Oa = " PRIMARY KEY";
        if ($_GET["create"] != "" && $_POST["auto_increment_col"]) {
            foreach (indexes($_GET["create"]) as $w) {
                if (in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"], $w["columns"], true)) {
                    $Oa = "";
                    break;
                }
                if ($w["type"] == "PRIMARY")
                    $Oa = " UNIQUE";
            }
        }
        return " AUTO_INCREMENT$Oa";
    }
    function alter_table($Q, $C, $q, $ed, $vb, $wc, $d, $Na, $Xf)
    {
        $c = array();
        foreach ($q as $p)
            $c[] = ($p[1] ? ($Q != "" ? ($p[0] != "" ? "CHANGE " . idf_escape($p[0]) : "ADD") : " ") . " " . implode($p[1]) . ($Q != "" ? $p[2] : "") : "DROP " . idf_escape($p[0]));
        $c  = array_merge($c, $ed);
        $Ih = ($vb !== null ? " COMMENT=" . q($vb) : "") . ($wc ? " ENGINE=" . q($wc) : "") . ($d ? " COLLATE " . q($d) : "") . ($Na != "" ? " AUTO_INCREMENT=$Na" : "");
        if ($Q == "")
            return queries("CREATE TABLE " . table($C) . " (\n" . implode(",\n", $c) . "\n)$Ih$Xf");
        if ($Q != $C)
            $c[] = "RENAME TO " . table($C);
        if ($Ih)
            $c[] = ltrim($Ih);
        return ($c || $Xf ? queries("ALTER TABLE " . table($Q) . "\n" . implode(",\n", $c) . $Xf) : true);
    }
    function alter_indexes($Q, $c)
    {
        foreach ($c as $z => $X)
            $c[$z] = ($X[2] == "DROP" ? "\nDROP INDEX " . idf_escape($X[1]) : "\nADD $X[0] " . ($X[0] == "PRIMARY" ? "KEY " : "") . ($X[1] != "" ? idf_escape($X[1]) . " " : "") . "(" . implode(", ", $X[2]) . ")");
        return queries("ALTER TABLE " . table($Q) . implode(",", $c));
    }
    function truncate_tables($S)
    {
        return apply_queries("TRUNCATE TABLE", $S);
    }
    function drop_views($ej)
    {
        return queries("DROP VIEW " . implode(", ", array_map('table', $ej)));
    }
    function drop_tables($S)
    {
        return queries("DROP TABLE " . implode(", ", array_map('table', $S)));
    }
    function move_tables($S, $ej, $bi)
    {
        $Ng = array();
        foreach (array_merge($S, $ej) as $Q)
            $Ng[] = table($Q) . " TO " . idf_escape($bi) . "." . table($Q);
        return queries("RENAME TABLE " . implode(", ", $Ng));
    }
    function copy_tables($S, $ej, $bi)
    {
        queries("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");
        foreach ($S as $Q) {
            $C = ($bi == DB ? table("copy_$Q") : idf_escape($bi) . "." . table($Q));
            if (($_POST["overwrite"] && !queries("\nDROP TABLE IF EXISTS $C")) || !queries("CREATE TABLE $C LIKE " . table($Q)) || !queries("INSERT INTO $C SELECT * FROM " . table($Q)))
                return false;
            foreach (get_rows("SHOW TRIGGERS LIKE " . q(addcslashes($Q, "%_\\"))) as $J) {
                $Ai = $J["Trigger"];
                if (!queries("CREATE TRIGGER " . ($bi == DB ? idf_escape("copy_$Ai") : idf_escape($bi) . "." . idf_escape($Ai)) . " $J[Timing] $J[Event] ON $C FOR EACH ROW\n$J[Statement];"))
                    return false;
            }
        }
        foreach ($ej as $Q) {
            $C  = ($bi == DB ? table("copy_$Q") : idf_escape($bi) . "." . table($Q));
            $dj = view($Q);
            if (($_POST["overwrite"] && !queries("DROP VIEW IF EXISTS $C")) || !queries("CREATE VIEW $C AS $dj[select]"))
                return false;
        }
        return true;
    }
    function trigger($C)
    {
        if ($C == "")
            return array();
        $K = get_rows("SHOW TRIGGERS WHERE `Trigger` = " . q($C));
        return reset($K);
    }
    function triggers($Q)
    {
        $I = array();
        foreach (get_rows("SHOW TRIGGERS LIKE " . q(addcslashes($Q, "%_\\"))) as $J)
            $I[$J["Trigger"]] = array(
                $J["Timing"],
                $J["Event"]
            );
        return $I;
    }
    function trigger_options()
    {
        return array(
            "Timing" => array(
                "BEFORE",
                "AFTER"
            ),
            "Event" => array(
                "INSERT",
                "UPDATE",
                "DELETE"
            ),
            "Type" => array(
                "FOR EACH ROW"
            )
        );
    }
    function routine($C, $T)
    {
        global $h, $yc, $Td, $U;
        $Da = array(
            "bool",
            "boolean",
            "integer",
            "double precision",
            "real",
            "dec",
            "numeric",
            "fixed",
            "national char",
            "national varchar"
        );
        $_h = "(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";
        $Fi = "((" . implode("|", array_merge(array_keys($U), $Da)) . ")\\b(?:\\s*\\(((?:[^'\")]|$yc)++)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s,]+)['\"]?)?";
        $dg = "$_h*(" . ($T == "FUNCTION" ? "" : $Td) . ")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$Fi";
        $j  = $h->result("SHOW CREATE $T " . idf_escape($C), 2);
        preg_match("~\\(((?:$dg\\s*,?)*)\\)\\s*" . ($T == "FUNCTION" ? "RETURNS\\s+$Fi\\s+" : "") . "(.*)~is", $j, $B);
        $q = array();
        preg_match_all("~$dg\\s*,?~is", $B[1], $Ge, PREG_SET_ORDER);
        foreach ($Ge as $Qf) {
            $C   = str_replace("``", "`", $Qf[2]) . $Qf[3];
            $q[] = array(
                "field" => $C,
                "type" => strtolower($Qf[5]),
                "length" => preg_replace_callback("~$yc~s", 'normalize_enum', $Qf[6]),
                "unsigned" => strtolower(preg_replace('~\s+~', ' ', trim("$Qf[8] $Qf[7]"))),
                "null" => 1,
                "full_type" => $Qf[4],
                "inout" => strtoupper($Qf[1]),
                "collation" => strtolower($Qf[9])
            );
        }
        if ($T != "FUNCTION")
            return array(
                "fields" => $q,
                "definition" => $B[11]
            );
        return array(
            "fields" => $q,
            "returns" => array(
                "type" => $B[12],
                "length" => $B[13],
                "unsigned" => $B[15],
                "collation" => $B[16]
            ),
            "definition" => $B[17],
            "language" => "SQL"
        );
    }
    function routines()
    {
        return get_rows("SELECT ROUTINE_NAME AS SPECIFIC_NAME, ROUTINE_NAME, ROUTINE_TYPE, DTD_IDENTIFIER FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = " . q(DB));
    }
    function routine_languages()
    {
        return array();
    }
    function routine_id($C, $J)
    {
        return idf_escape($C);
    }
    function last_id()
    {
        global $h;
        return $h->result("SELECT LAST_INSERT_ID()");
    }
    function explain($h, $G)
    {
        return $h->query("EXPLAIN " . (min_version(5.1) ? "PARTITIONS " : "") . $G);
    }
    function found_rows($R, $Z)
    {
        return ($Z || $R["Engine"] != "InnoDB" ? null : $R["Rows"]);
    }
    function types()
    {
        return array();
    }
    function schemas()
    {
        return array();
    }
    function get_schema()
    {
        return "";
    }
    function set_schema($dh)
    {
        return true;
    }
    function create_sql($Q, $Na, $Mh)
    {
        global $h;
        $I = $h->result("SHOW CREATE TABLE " . table($Q), 1);
        if (!$Na)
            $I = preg_replace('~ AUTO_INCREMENT=\d+~', '', $I);
        return $I;
    }
    function truncate_sql($Q)
    {
        return "TRUNCATE " . table($Q);
    }
    function use_sql($k)
    {
        return "USE " . idf_escape($k);
    }
    function trigger_sql($Q)
    {
        $I = "";
        foreach (get_rows("SHOW TRIGGERS LIKE " . q(addcslashes($Q, "%_\\")), null, "-- ") as $J)
            $I .= "\nCREATE TRIGGER " . idf_escape($J["Trigger"]) . " $J[Timing] $J[Event] ON " . table($J["Table"]) . " FOR EACH ROW\n$J[Statement];;\n";
        return $I;
    }
    function show_variables()
    {
        return get_key_vals("SHOW VARIABLES");
    }
    function process_list()
    {
        return get_rows("SHOW FULL PROCESSLIST");
    }
    function show_status()
    {
        return get_key_vals("SHOW STATUS");
    }
    function convert_field($p)
    {
        if (preg_match("~binary~", $p["type"]))
            return "HEX(" . idf_escape($p["field"]) . ")";
        if ($p["type"] == "bit")
            return "BIN(" . idf_escape($p["field"]) . " + 0)";
        if (preg_match("~geometry|point|linestring|polygon~", $p["type"]))
            return (min_version(8) ? "ST_" : "") . "AsWKT(" . idf_escape($p["field"]) . ")";
    }
    function unconvert_field($p, $I)
    {
        if (preg_match("~binary~", $p["type"]))
            $I = "UNHEX($I)";
        if ($p["type"] == "bit")
            $I = "CONV($I, 2, 10) + 0";
        if (preg_match("~geometry|point|linestring|polygon~", $p["type"]))
            $I = (min_version(8) ? "ST_" : "") . "GeomFromText($I, SRID($p[field]))";
        return $I;
    }
    function support($Rc)
    {
        return !preg_match("~scheme|sequence|type|view_trigger|materializedview" . (min_version(8) ? "" : "|descidx" . (min_version(5.1) ? "" : "|event|partitioning" . (min_version(5) ? "" : "|routine|trigger|view"))) . "~", $Rc);
    }
    function kill_process($X)
    {
        return queries("KILL " . number($X));
    }
    function connection_id()
    {
        return "SELECT CONNECTION_ID()";
    }
    function max_connections()
    {
        global $h;
        return $h->result("SELECT @@max_connections");
    }
    $y  = "sql";
    $U  = array();
    $Lh = array();
    foreach (array(
        lang(27) => array(
            "tinyint" => 3,
            "smallint" => 5,
            "mediumint" => 8,
            "int" => 10,
            "bigint" => 20,
            "decimal" => 66,
            "float" => 12,
            "double" => 21
        ),
        lang(28) => array(
            "date" => 10,
            "datetime" => 19,
            "timestamp" => 19,
            "time" => 10,
            "year" => 4
        ),
        lang(25) => array(
            "char" => 255,
            "varchar" => 65535,
            "tinytext" => 255,
            "text" => 65535,
            "mediumtext" => 16777215,
            "longtext" => 4294967295
        ),
        lang(33) => array(
            "enum" => 65535,
            "set" => 64
        ),
        lang(29) => array(
            "bit" => 20,
            "binary" => 255,
            "varbinary" => 65535,
            "tinyblob" => 255,
            "blob" => 65535,
            "mediumblob" => 16777215,
            "longblob" => 4294967295
        ),
        lang(31) => array(
            "geometry" => 0,
            "point" => 0,
            "linestring" => 0,
            "polygon" => 0,
            "multipoint" => 0,
            "multilinestring" => 0,
            "multipolygon" => 0,
            "geometrycollection" => 0
        )
    ) as $z => $X) {
        $U += $X;
        $Lh[$z] = array_keys($X);
    }
    $Mi = array(
        "unsigned",
        "zerofill",
        "unsigned zerofill"
    );
    $yf = array(
        "=",
        "<",
        ">",
        "<=",
        ">=",
        "!=",
        "LIKE",
        "LIKE %%",
        "REGEXP",
        "IN",
        "FIND_IN_SET",
        "IS NULL",
        "NOT LIKE",
        "NOT REGEXP",
        "NOT IN",
        "IS NOT NULL",
        "SQL"
    );
    $md = array(
        "char_length",
        "date",
        "from_unixtime",
        "lower",
        "round",
        "floor",
        "ceil",
        "sec_to_time",
        "time_to_sec",
        "upper"
    );
    $sd = array(
        "avg",
        "count",
        "count distinct",
        "group_concat",
        "max",
        "min",
        "sum"
    );
    $oc = array(
        array(
            "char" => "md5/sha1/password/encrypt/uuid",
            "binary" => "md5/sha1",
            "date|time" => "now"
        ),
        array(
            number_type() => "+/-",
            "date" => "+ interval/- interval",
            "time" => "addtime/subtime",
            "char|text" => "concat"
        )
    );
}
define("SERVER", $_GET[DRIVER]);
define("DB", $_GET["db"]);
define("ME", preg_replace('~^[^?]*/([^?]*).*~', '\1', $_SERVER["REQUEST_URI"]) . '?' . (sid() ? SID . '&' : '') . (SERVER !== null ? DRIVER . "=" . urlencode(SERVER) . '&' : '') . (isset($_GET["username"]) ? "username=" . urlencode($_GET["username"]) . '&' : '') . (DB != "" ? 'db=' . urlencode(DB) . '&' . (isset($_GET["ns"]) ? "ns=" . urlencode($_GET["ns"]) . "&" : "") : ''));
$ia = "4.7.3";
class Adminer
{
    var $operators;
    function name()
    {
        return "<a href='https://www.adminer.org/'" . target_blank() . " id='h1'>Adminer</a>";
    }
    function credentials()
    {
        return array(
            SERVER,
            $_GET["username"],
            get_password()
        );
    }
    function connectSsl()
    {
    }
    function permanentLogin($j = false)
    {
        return password_file($j);
    }
    function bruteForceKey()
    {
        return $_SERVER["REMOTE_ADDR"];
    }
    function serverName($N)
    {
        return h($N);
    }
    function database()
    {
        return DB;
    }
    function databases($cd = true)
    {
        return get_databases($cd);
    }
    function schemas()
    {
        return schemas();
    }
    function queryTimeout()
    {
        return 2;
    }
    function headers()
    {
    }
    function csp()
    {
        return csp();
    }
    function head()
    {
        return true;
    }
    function css()
    {
        $I  = array();
        $Wc = "adminer.css";
        if (file_exists($Wc))
            $I[] = "$Wc?v=" . crc32(file_get_contents($Wc));
        return $I;
    }
    function loginForm()
    {
        global $gc;
        echo "<table cellspacing='0' class='layout'>\n", $this->loginFormField('driver', '<tr><th>' . lang(34) . '<td>', html_select("auth[driver]", $gc, DRIVER, "loginDriver(this);") . "\n"), $this->loginFormField('server', '<tr><th>' . lang(35) . '<td>', '<input name="auth[server]" value="' . h(SERVER) . '" title="hostname[:port]" placeholder="localhost" autocapitalize="off">' . "\n"), $this->loginFormField('username', '<tr><th>' . lang(36) . '<td>', '<input name="auth[username]" id="username" value="' . h($_GET["username"]) . '" autocomplete="username" autocapitalize="off">' . script("focus(qs('#username')); qs('#username').form['auth[driver]'].onchange();")), $this->loginFormField('password', '<tr><th>' . lang(37) . '<td>', '<input type="password" name="auth[password]" autocomplete="current-password">' . "\n"), $this->loginFormField('db', '<tr><th>' . lang(38) . '<td>', '<input name="auth[db]" value="' . h($_GET["db"]) . '" autocapitalize="off">' . "\n"), "</table>\n", "<p><input type='submit' value='" . lang(39) . "'>\n", checkbox("auth[permanent]", 1, $_COOKIE["adminer_permanent"], lang(40)) . "\n";
    }
    function loginFormField($C, $zd, $Y)
    {
        return $zd . $Y;
    }
    function login($Ae, $F)
    {
        if ($F == "")
            return lang(41, target_blank());
        return true;
    }
    function tableName($Sh)
    {
        return h($Sh["Name"]);
    }
    function fieldName($p, $Cf = 0)
    {
        return '<span title="' . h($p["full_type"]) . '">' . h($p["field"]) . '</span>';
    }
    function selectLinks($Sh, $O = "")
    {
        global $y, $n;
        echo '<p class="links">';
        $ze = array(
            "select" => lang(42)
        );
        if (support("table") || support("indexes"))
            $ze["table"] = lang(43);
        if (support("table")) {
            if (is_view($Sh))
                $ze["view"] = lang(44);
            else
                $ze["create"] = lang(45);
        }
        if ($O !== null)
            $ze["edit"] = lang(46);
        $C = $Sh["Name"];
        foreach ($ze as $z => $X)
            echo " <a href='" . h(ME) . "$z=" . urlencode($C) . ($z == "edit" ? $O : "") . "'" . bold(isset($_GET[$z])) . ">$X</a>";
        echo doc_link(array(
            $y => $n->tableHelp($C)
        ), "?"), "\n";
    }
    function foreignKeys($Q)
    {
        return foreign_keys($Q);
    }
    function backwardKeys($Q, $Rh)
    {
        return array();
    }
    function backwardKeysPrint($Qa, $J)
    {
    }
    function selectQuery($G, $Gh, $Pc = false)
    {
        global $y, $n;
        $I = "</p>\n";
        if (!$Pc && ($hj = $n->warnings())) {
            $u = "warnings";
            $I = ", <a href='#$u'>" . lang(47) . "</a>" . script("qsl('a').onclick = partial(toggle, '$u');", "") . "$I<div id='$u' class='hidden'>\n$hj</div>\n";
        }
        return "<p><code class='jush-$y'>" . h(str_replace("\n", " ", $G)) . "</code> <span class='time'>(" . format_time($Gh) . ")</span>" . (support("sql") ? " <a href='" . h(ME) . "sql=" . urlencode($G) . "'>" . lang(10) . "</a>" : "") . $I;
    }
    function sqlCommandQuery($G)
    {
        return shorten_utf8(trim($G), 1000);
    }
    function rowDescription($Q)
    {
        return "";
    }
    function rowDescriptions($K, $fd)
    {
        return $K;
    }
    function selectLink($X, $p)
    {
    }
    function selectVal($X, $A, $p, $Kf)
    {
        $I = ($X === null ? "<i>NULL</i>" : (preg_match("~char|binary|boolean~", $p["type"]) && !preg_match("~var~", $p["type"]) ? "<code>$X</code>" : $X));
        if (preg_match('~blob|bytea|raw|file~', $p["type"]) && !is_utf8($X))
            $I = "<i>" . lang(48, strlen($Kf)) . "</i>";
        if (preg_match('~json~', $p["type"]))
            $I = "<code class='jush-js'>$I</code>";
        return ($A ? "<a href='" . h($A) . "'" . (is_url($A) ? target_blank() : "") . ">$I</a>" : $I);
    }
    function editVal($X, $p)
    {
        return $X;
    }
    function tableStructurePrint($q)
    {
        echo "<div class='scrollable'>\n", "<table cellspacing='0' class='nowrap'>\n", "<thead><tr><th>" . lang(49) . "<td>" . lang(50) . (support("comment") ? "<td>" . lang(51) : "") . "</thead>\n";
        foreach ($q as $p) {
            echo "<tr" . odd() . "><th>" . h($p["field"]), "<td><span title='" . h($p["collation"]) . "'>" . h($p["full_type"]) . "</span>", ($p["null"] ? " <i>NULL</i>" : ""), ($p["auto_increment"] ? " <i>" . lang(52) . "</i>" : ""), (isset($p["default"]) ? " <span title='" . lang(53) . "'>[<b>" . h($p["default"]) . "</b>]</span>" : ""), (support("comment") ? "<td>" . h($p["comment"]) : ""), "\n";
        }
        echo "</table>\n", "</div>\n";
    }
    function tableIndexesPrint($x)
    {
        echo "<table cellspacing='0'>\n";
        foreach ($x as $C => $w) {
            ksort($w["columns"]);
            $pg = array();
            foreach ($w["columns"] as $z => $X)
                $pg[] = "<i>" . h($X) . "</i>" . ($w["lengths"][$z] ? "(" . $w["lengths"][$z] . ")" : "") . ($w["descs"][$z] ? " DESC" : "");
            echo "<tr title='" . h($C) . "'><th>$w[type]<td>" . implode(", ", $pg) . "\n";
        }
        echo "</table>\n";
    }
    function selectColumnsPrint($L, $f)
    {
        global $md, $sd;
        print_fieldset("select", lang(54), $L);
        $t     = 0;
        $L[""] = array();
        foreach ($L as $z => $X) {
            $X = $_GET["columns"][$z];
            $e = select_input(" name='columns[$t][col]'", $f, $X["col"], ($z !== "" ? "selectFieldChange" : "selectAddRow"));
            echo "<div>" . ($md || $sd ? "<select name='columns[$t][fun]'>" . optionlist(array(
                -1 => ""
            ) + array_filter(array(
                lang(55) => $md,
                lang(56) => $sd
            )), $X["fun"]) . "</select>" . on_help("getTarget(event).value && getTarget(event).value.replace(/ |\$/, '(') + ')'", 1) . script("qsl('select').onchange = function () { helpClose();" . ($z !== "" ? "" : " qsl('select, input', this.parentNode).onchange();") . " };", "") . "($e)" : $e) . "</div>\n";
            $t++;
        }
        echo "</div></fieldset>\n";
    }
    function selectSearchPrint($Z, $f, $x)
    {
        print_fieldset("search", lang(57), $Z);
        foreach ($x as $t => $w) {
            if ($w["type"] == "FULLTEXT") {
                echo "<div>(<i>" . implode("</i>, <i>", array_map('h', $w["columns"])) . "</i>) AGAINST", " <input type='search' name='fulltext[$t]' value='" . h($_GET["fulltext"][$t]) . "'>", script("qsl('input').oninput = selectFieldChange;", ""), checkbox("boolean[$t]", 1, isset($_GET["boolean"][$t]), "BOOL"), "</div>\n";
            }
        }
        $cb = "this.parentNode.firstChild.onchange();";
        foreach (array_merge((array) $_GET["where"], array(
            array()
        )) as $t => $X) {
            if (!$X || ("$X[col]$X[val]" != "" && in_array($X["op"], $this->operators))) {
                echo "<div>" . select_input(" name='where[$t][col]'", $f, $X["col"], ($X ? "selectFieldChange" : "selectAddRow"), "(" . lang(58) . ")"), html_select("where[$t][op]", $this->operators, $X["op"], $cb), "<input type='search' name='where[$t][val]' value='" . h($X["val"]) . "'>", script("mixin(qsl('input'), {oninput: function () { $cb }, onkeydown: selectSearchKeydown, onsearch: selectSearchSearch});", ""), "</div>\n";
            }
        }
        echo "</div></fieldset>\n";
    }
    function selectOrderPrint($Cf, $f, $x)
    {
        print_fieldset("sort", lang(59), $Cf);
        $t = 0;
        foreach ((array) $_GET["order"] as $z => $X) {
            if ($X != "") {
                echo "<div>" . select_input(" name='order[$t]'", $f, $X, "selectFieldChange"), checkbox("desc[$t]", 1, isset($_GET["desc"][$z]), lang(60)) . "</div>\n";
                $t++;
            }
        }
        echo "<div>" . select_input(" name='order[$t]'", $f, "", "selectAddRow"), checkbox("desc[$t]", 1, false, lang(60)) . "</div>\n", "</div></fieldset>\n";
    }
    function selectLimitPrint($_)
    {
        echo "<fieldset><legend>" . lang(61) . "</legend><div>";
        echo "<input type='number' name='limit' class='size' value='" . h($_) . "'>", script("qsl('input').oninput = selectFieldChange;", ""), "</div></fieldset>\n";
    }
    function selectLengthPrint($hi)
    {
        if ($hi !== null) {
            echo "<fieldset><legend>" . lang(62) . "</legend><div>", "<input type='number' name='text_length' class='size' value='" . h($hi) . "'>", "</div></fieldset>\n";
        }
    }
    function selectActionPrint($x)
    {
        echo "<fieldset><legend>" . lang(63) . "</legend><div>", "<input type='submit' value='" . lang(54) . "'>", " <span id='noindex' title='" . lang(64) . "'></span>", "<script" . nonce() . ">\n", "var indexColumns = ";
        $f = array();
        foreach ($x as $w) {
            $Mb = reset($w["columns"]);
            if ($w["type"] != "FULLTEXT" && $Mb)
                $f[$Mb] = 1;
        }
        $f[""] = 1;
        foreach ($f as $z => $X)
            json_row($z);
        echo ";\n", "selectFieldChange.call(qs('#form')['select']);\n", "</script>\n", "</div></fieldset>\n";
    }
    function selectCommandPrint()
    {
        return !information_schema(DB);
    }
    function selectImportPrint()
    {
        return !information_schema(DB);
    }
    function selectEmailPrint($tc, $f)
    {
    }
    function selectColumnsProcess($f, $x)
    {
        global $md, $sd;
        $L  = array();
        $pd = array();
        foreach ((array) $_GET["columns"] as $z => $X) {
            if ($X["fun"] == "count" || ($X["col"] != "" && (!$X["fun"] || in_array($X["fun"], $md) || in_array($X["fun"], $sd)))) {
                $L[$z] = apply_sql_function($X["fun"], ($X["col"] != "" ? idf_escape($X["col"]) : "*"));
                if (!in_array($X["fun"], $sd))
                    $pd[] = $L[$z];
            }
        }
        return array(
            $L,
            $pd
        );
    }
    function selectSearchProcess($q, $x)
    {
        global $h, $n;
        $I = array();
        foreach ($x as $t => $w) {
            if ($w["type"] == "FULLTEXT" && $_GET["fulltext"][$t] != "")
                $I[] = "MATCH (" . implode(", ", array_map('idf_escape', $w["columns"])) . ") AGAINST (" . q($_GET["fulltext"][$t]) . (isset($_GET["boolean"][$t]) ? " IN BOOLEAN MODE" : "") . ")";
        }
        foreach ((array) $_GET["where"] as $z => $X) {
            if ("$X[col]$X[val]" != "" && in_array($X["op"], $this->operators)) {
                $lg = "";
                $xb = " $X[op]";
                if (preg_match('~IN$~', $X["op"])) {
                    $Jd = process_length($X["val"]);
                    $xb .= " " . ($Jd != "" ? $Jd : "(NULL)");
                } elseif ($X["op"] == "SQL")
                    $xb = " $X[val]";
                elseif ($X["op"] == "LIKE %%")
                    $xb = " LIKE " . $this->processInput($q[$X["col"]], "%$X[val]%");
                elseif ($X["op"] == "ILIKE %%")
                    $xb = " ILIKE " . $this->processInput($q[$X["col"]], "%$X[val]%");
                elseif ($X["op"] == "FIND_IN_SET") {
                    $lg = "$X[op](" . q($X["val"]) . ", ";
                    $xb = ")";
                } elseif (!preg_match('~NULL$~', $X["op"]))
                    $xb .= " " . $this->processInput($q[$X["col"]], $X["val"]);
                if ($X["col"] != "")
                    $I[] = $lg . $n->convertSearch(idf_escape($X["col"]), $X, $q[$X["col"]]) . $xb;
                else {
                    $sb = array();
                    foreach ($q as $C => $p) {
                        if ((preg_match('~^[-\d.' . (preg_match('~IN$~', $X["op"]) ? ',' : '') . ']+$~', $X["val"]) || !preg_match('~' . number_type() . '|bit~', $p["type"])) && (!preg_match("~[\x80-\xFF]~", $X["val"]) || preg_match('~char|text|enum|set~', $p["type"])))
                            $sb[] = $lg . $n->convertSearch(idf_escape($C), $X, $p) . $xb;
                    }
                    $I[] = ($sb ? "(" . implode(" OR ", $sb) . ")" : "1 = 0");
                }
            }
        }
        return $I;
    }
    function selectOrderProcess($q, $x)
    {
        $I = array();
        foreach ((array) $_GET["order"] as $z => $X) {
            if ($X != "")
                $I[] = (preg_match('~^((COUNT\(DISTINCT |[A-Z0-9_]+\()(`(?:[^`]|``)+`|"(?:[^"]|"")+")\)|COUNT\(\*\))$~', $X) ? $X : idf_escape($X)) . (isset($_GET["desc"][$z]) ? " DESC" : "");
        }
        return $I;
    }
    function selectLimitProcess()
    {
        return (isset($_GET["limit"]) ? $_GET["limit"] : "50");
    }
    function selectLengthProcess()
    {
        return (isset($_GET["text_length"]) ? $_GET["text_length"] : "100");
    }
    function selectEmailProcess($Z, $fd)
    {
        return false;
    }
    function selectQueryBuild($L, $Z, $pd, $Cf, $_, $E)
    {
        return "";
    }
    function messageQuery($G, $ii, $Pc = false)
    {
        global $y, $n;
        restart_session();
        $_d =& get_session("queries");
        if (!$_d[$_GET["db"]])
            $_d[$_GET["db"]] = array();
        if (strlen($G) > 1e6)
            $G = preg_replace('~[\x80-\xFF]+$~', '', substr($G, 0, 1e6)) . "\nâ€¦";
        $_d[$_GET["db"]][] = array(
            $G,
            time(),
            $ii
        );
        $Dh                = "sql-" . count($_d[$_GET["db"]]);
        $I                 = "<a href='#$Dh' class='toggle'>" . lang(65) . "</a>\n";
        if (!$Pc && ($hj = $n->warnings())) {
            $u = "warnings-" . count($_d[$_GET["db"]]);
            $I = "<a href='#$u' class='toggle'>" . lang(47) . "</a>, $I<div id='$u' class='hidden'>\n$hj</div>\n";
        }
        return " <span class='time'>" . @date("H:i:s") . "</span>" . " $I<div id='$Dh' class='hidden'><pre><code class='jush-$y'>" . shorten_utf8($G, 1000) . "</code></pre>" . ($ii ? " <span class='time'>($ii)</span>" : '') . (support("sql") ? '<p><a href="' . h(str_replace("db=" . urlencode(DB), "db=" . urlencode($_GET["db"]), ME) . 'sql=&history=' . (count($_d[$_GET["db"]]) - 1)) . '">' . lang(10) . '</a>' : '') . '</div>';
    }
    function editFunctions($p)
    {
        global $oc;
        $I = ($p["null"] ? "NULL/" : "");
        foreach ($oc as $z => $md) {
            if (!$z || (!isset($_GET["call"]) && (isset($_GET["select"]) || where($_GET)))) {
                foreach ($md as $dg => $X) {
                    if (!$dg || preg_match("~$dg~", $p["type"]))
                        $I .= "/$X";
                }
                if ($z && !preg_match('~set|blob|bytea|raw|file~', $p["type"]))
                    $I .= "/SQL";
            }
        }
        if ($p["auto_increment"] && !isset($_GET["select"]) && !where($_GET))
            $I = lang(52);
        return explode("/", $I);
    }
    function editInput($Q, $p, $Ka, $Y)
    {
        if ($p["type"] == "enum")
            return (isset($_GET["select"]) ? "<label><input type='radio'$Ka value='-1' checked><i>" . lang(8) . "</i></label> " : "") . ($p["null"] ? "<label><input type='radio'$Ka value=''" . ($Y !== null || isset($_GET["select"]) ? "" : " checked") . "><i>NULL</i></label> " : "") . enum_input("radio", $Ka, $p, $Y, 0);
        return "";
    }
    function editHint($Q, $p, $Y)
    {
        return "";
    }
    function processInput($p, $Y, $s = "")
    {
        if ($s == "SQL")
            return $Y;
        $C = $p["field"];
        $I = q($Y);
        if (preg_match('~^(now|getdate|uuid)$~', $s))
            $I = "$s()";
        elseif (preg_match('~^current_(date|timestamp)$~', $s))
            $I = $s;
        elseif (preg_match('~^([+-]|\|\|)$~', $s))
            $I = idf_escape($C) . " $s $I";
        elseif (preg_match('~^[+-] interval$~', $s))
            $I = idf_escape($C) . " $s " . (preg_match("~^(\\d+|'[0-9.: -]') [A-Z_]+\$~i", $Y) ? $Y : $I);
        elseif (preg_match('~^(addtime|subtime|concat)$~', $s))
            $I = "$s(" . idf_escape($C) . ", $I)";
        elseif (preg_match('~^(md5|sha1|password|encrypt)$~', $s))
            $I = "$s($I)";
        return unconvert_field($p, $I);
    }
    function dumpOutput()
    {
        $I = array(
            'text' => lang(66),
            'file' => lang(67)
        );
        if (function_exists('gzencode'))
            $I['gz'] = 'gzip';
        return $I;
    }
    function dumpFormat()
    {
        return array(
            'sql' => 'SQL',
            'csv' => 'CSV,',
            'csv;' => 'CSV;',
            'tsv' => 'TSV'
        );
    }
    function dumpDatabase($m)
    {
    }
    function dumpTable($Q, $Mh, $ce = 0)
    {
        if ($_POST["format"] != "sql") {
            echo "\xef\xbb\xbf";
            if ($Mh)
                dump_csv(array_keys(fields($Q)));
        } else {
            if ($ce == 2) {
                $q = array();
                foreach (fields($Q) as $C => $p)
                    $q[] = idf_escape($C) . " $p[full_type]";
                $j = "CREATE TABLE " . table($Q) . " (" . implode(", ", $q) . ")";
            } else
                $j = create_sql($Q, $_POST["auto_increment"], $Mh);
            set_utf8mb4($j);
            if ($Mh && $j) {
                if ($Mh == "DROP+CREATE" || $ce == 1)
                    echo "DROP " . ($ce == 2 ? "VIEW" : "TABLE") . " IF EXISTS " . table($Q) . ";\n";
                if ($ce == 1)
                    $j = remove_definer($j);
                echo "$j;\n\n";
            }
        }
    }
    function dumpData($Q, $Mh, $G)
    {
        global $h, $y;
        $Ie = ($y == "sqlite" ? 0 : 1048576);
        if ($Mh) {
            if ($_POST["format"] == "sql") {
                if ($Mh == "TRUNCATE+INSERT")
                    echo truncate_sql($Q) . ";\n";
                $q = fields($Q);
            }
            $H = $h->query($G, 1);
            if ($H) {
                $Vd = "";
                $Za = "";
                $je = array();
                $Oh = "";
                $Sc = ($Q != '' ? 'fetch_assoc' : 'fetch_row');
                while ($J = $H->$Sc()) {
                    if (!$je) {
                        $Zi = array();
                        foreach ($J as $X) {
                            $p    = $H->fetch_field();
                            $je[] = $p->name;
                            $z    = idf_escape($p->name);
                            $Zi[] = "$z = VALUES($z)";
                        }
                        $Oh = ($Mh == "INSERT+UPDATE" ? "\nON DUPLICATE KEY UPDATE " . implode(", ", $Zi) : "") . ";\n";
                    }
                    if ($_POST["format"] != "sql") {
                        if ($Mh == "table") {
                            dump_csv($je);
                            $Mh = "INSERT";
                        }
                        dump_csv($J);
                    } else {
                        if (!$Vd)
                            $Vd = "INSERT INTO " . table($Q) . " (" . implode(", ", array_map('idf_escape', $je)) . ") VALUES";
                        foreach ($J as $z => $X) {
                            $p     = $q[$z];
                            $J[$z] = ($X !== null ? unconvert_field($p, preg_match(number_type(), $p["type"]) && !preg_match('~\[~', $p["full_type"]) && is_numeric($X) ? $X : q(($X === false ? 0 : $X))) : "NULL");
                        }
                        $bh = ($Ie ? "\n" : " ") . "(" . implode(",\t", $J) . ")";
                        if (!$Za)
                            $Za = $Vd . $bh;
                        elseif (strlen($Za) + 4 + strlen($bh) + strlen($Oh) < $Ie)
                            $Za .= ",$bh";
                        else {
                            echo $Za . $Oh;
                            $Za = $Vd . $bh;
                        }
                    }
                }
                if ($Za)
                    echo $Za . $Oh;
            } elseif ($_POST["format"] == "sql")
                echo "-- " . str_replace("\n", " ", $h->error) . "\n";
        }
    }
    function dumpFilename($Ed)
    {
        return friendly_url($Ed != "" ? $Ed : (SERVER != "" ? SERVER : "localhost"));
    }
    function dumpHeaders($Ed, $Xe = false)
    {
        $Nf = $_POST["output"];
        $Kc = (preg_match('~sql~', $_POST["format"]) ? "sql" : ($Xe ? "tar" : "csv"));
        header("Content-Type: " . ($Nf == "gz" ? "application/x-gzip" : ($Kc == "tar" ? "application/x-tar" : ($Kc == "sql" || $Nf != "file" ? "text/plain" : "text/csv") . "; charset=utf-8")));
        if ($Nf == "gz")
            ob_start('ob_gzencode', 1e6);
        return $Kc;
    }
    function importServerPath()
    {
        return "adminer.sql";
    }
    function homepage()
    {
        echo '<p class="links">' . ($_GET["ns"] == "" && support("database") ? '<a href="' . h(ME) . 'database=">' . lang(68) . "</a>\n" : ""), (support("scheme") ? "<a href='" . h(ME) . "scheme='>" . ($_GET["ns"] != "" ? lang(69) : lang(70)) . "</a>\n" : ""), ($_GET["ns"] !== "" ? '<a href="' . h(ME) . 'schema=">' . lang(71) . "</a>\n" : ""), (support("privileges") ? "<a href='" . h(ME) . "privileges='>" . lang(72) . "</a>\n" : "");
        return true;
    }
    function navigation($We)
    {
        global $ia, $y, $gc, $h;
        echo '<h1>
', $this->name(), ' <span class="version">', $ia, '</span>
<a href="https://www.adminer.org/#download"', target_blank(), ' id="version">', (version_compare($ia, $_COOKIE["adminer_version"]) < 0 ? h($_COOKIE["adminer_version"]) : ""), '</a>
</h1>
';
        if ($We == "auth") {
            $Nf = "";
            foreach ((array) $_SESSION["pwds"] as $bj => $ph) {
                foreach ($ph as $N => $Wi) {
                    foreach ($Wi as $V => $F) {
                        if ($F !== null) {
                            $Sb = $_SESSION["db"][$bj][$N][$V];
                            foreach (($Sb ? array_keys($Sb) : array(
                                ""
                            )) as $m)
                                $Nf .= "<li><a href='" . h(auth_url($bj, $N, $V, $m)) . "'>($gc[$bj]) " . h($V . ($N != "" ? "@" . $this->serverName($N) : "") . ($m != "" ? " - $m" : "")) . "</a>\n";
                        }
                    }
                }
            }
            if ($Nf)
                echo "<ul id='logins'>\n$Nf</ul>\n" . script("mixin(qs('#logins'), {onmouseover: menuOver, onmouseout: menuOut});");
        } else {
            if ($_GET["ns"] !== "" && !$We && DB != "") {
                $h->select_db(DB);
                $S = table_status('', true);
            }
            echo script_src(preg_replace("~\\?.*~", "", ME) . "?file=jush.js&version=4.7.3");
            if (support("sql")) {
                echo '<script', nonce(), '>
';
                if ($S) {
                    $ze = array();
                    foreach ($S as $Q => $T)
                        $ze[] = preg_quote($Q, '/');
                    echo "var jushLinks = { $y: [ '" . js_escape(ME) . (support("table") ? "table=" : "select=") . "\$&', /\\b(" . implode("|", $ze) . ")\\b/g ] };\n";
                    foreach (array(
                        "bac",
                        "bra",
                        "sqlite_quo",
                        "mssql_bra"
                    ) as $X)
                        echo "jushLinks.$X = jushLinks.$y;\n";
                }
                $oh = $h->server_info;
                echo 'bodyLoad(\'', (is_object($h) ? preg_replace('~^(\d\.?\d).*~s', '\1', $oh) : ""), '\'', (preg_match('~MariaDB~', $oh) ? ", true" : ""), ');
</script>
';
            }
            $this->databasesPrint($We);
            if (DB == "" || !$We) {
                echo "<p class='links'>" . (support("sql") ? "<a href='" . h(ME) . "sql='" . bold(isset($_GET["sql"]) && !isset($_GET["import"])) . ">" . lang(65) . "</a>\n<a href='" . h(ME) . "import='" . bold(isset($_GET["import"])) . ">" . lang(73) . "</a>\n" : "") . "";
                if (support("dump"))
                    echo "<a href='" . h(ME) . "dump=" . urlencode(isset($_GET["table"]) ? $_GET["table"] : $_GET["select"]) . "' id='dump'" . bold(isset($_GET["dump"])) . ">" . lang(74) . "</a>\n";
            }
            if ($_GET["ns"] !== "" && !$We && DB != "") {
                echo '<a href="' . h(ME) . 'create="' . bold($_GET["create"] === "") . ">" . lang(75) . "</a>\n";
                if (!$S)
                    echo "<p class='message'>" . lang(9) . "\n";
                else
                    $this->tablesPrint($S);
            }
        }
    }
    function databasesPrint($We)
    {
        global $b, $h;
        $l = $this->databases();
        if ($l && !in_array(DB, $l))
            array_unshift($l, DB);
        echo '<form action="">
<p id="dbs">
';
        hidden_fields_get();
        $Qb = script("mixin(qsl('select'), {onmousedown: dbMouseDown, onchange: dbChange});");
        echo "<span title='" . lang(76) . "'>" . lang(77) . "</span>: " . ($l ? "<select name='db'>" . optionlist(array(
            "" => ""
        ) + $l, DB) . "</select>$Qb" : "<input name='db' value='" . h(DB) . "' autocapitalize='off'>\n"), "<input type='submit' value='" . lang(20) . "'" . ($l ? " class='hidden'" : "") . ">\n";
        if ($We != "db" && DB != "" && $h->select_db(DB)) {
            if (support("scheme")) {
                echo "<br>" . lang(78) . ": <select name='ns'>" . optionlist(array(
                    "" => ""
                ) + $b->schemas(), $_GET["ns"]) . "</select>$Qb";
                if ($_GET["ns"] != "")
                    set_schema($_GET["ns"]);
            }
        }
        foreach (array(
            "import",
            "sql",
            "schema",
            "dump",
            "privileges"
        ) as $X) {
            if (isset($_GET[$X])) {
                echo "<input type='hidden' name='$X' value=''>";
                break;
            }
        }
        echo "</p></form>\n";
    }
    function tablesPrint($S)
    {
        echo "<ul id='tables'>" . script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");
        foreach ($S as $Q => $Ih) {
            $C = $this->tableName($Ih);
            if ($C != "") {
                echo '<li><a href="' . h(ME) . 'select=' . urlencode($Q) . '"' . bold($_GET["select"] == $Q || $_GET["edit"] == $Q, "select") . ">" . lang(79) . "</a> ", (support("table") || support("indexes") ? '<a href="' . h(ME) . 'table=' . urlencode($Q) . '"' . bold(in_array($Q, array(
                    $_GET["table"],
                    $_GET["create"],
                    $_GET["indexes"],
                    $_GET["foreign"],
                    $_GET["trigger"]
                )), (is_view($Ih) ? "view" : "structure")) . " title='" . lang(43) . "'>$C</a>" : "<span>$C</span>") . "\n";
            }
        }
        echo "</ul>\n";
    }
}
$b = (function_exists('adminer_object') ? adminer_object() : new Adminer);
if ($b->operators === null)
    $b->operators = $yf;
function page_header($li, $o = "", $Ya = array(), $mi = "")
{
    global $ca, $ia, $b, $gc, $y;
    page_headers();
    if (is_ajax() && $o) {
        page_messages($o);
        exit;
    }
    $ni = $li . ($mi != "" ? ": $mi" : "");
    $oi = strip_tags($ni . (SERVER != "" && SERVER != "localhost" ? h(" - " . SERVER) : "") . " - " . $b->name());
    echo '<!DOCTYPE html>
<html lang="', $ca, '" dir="', lang(80), '">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<title>', $oi, '</title>
<link rel="stylesheet" type="text/css" href="', h(preg_replace("~\\?.*~", "", ME) . "?file=default.css&version=4.7.3"), '">
', script_src(preg_replace("~\\?.*~", "", ME) . "?file=functions.js&version=4.7.3");
    if ($b->head()) {
        echo '<link rel="shortcut icon" type="image/x-icon" href="', h(preg_replace("~\\?.*~", "", ME) . "?file=favicon.ico&version=4.7.3"), '">
<link rel="apple-touch-icon" href="', h(preg_replace("~\\?.*~", "", ME) . "?file=favicon.ico&version=4.7.3"), '">
';
        foreach ($b->css() as $Kb) {
            echo '<link rel="stylesheet" type="text/css" href="', h($Kb), '">
';
        }
    }
    echo '
<body class="', lang(80), ' nojs">
';
    $Wc = get_temp_dir() . "/adminer.version";
    if (!$_COOKIE["adminer_version"] && function_exists('openssl_verify') && file_exists($Wc) && filemtime($Wc) + 86400 > time()) {
        $cj = unserialize(file_get_contents($Wc));
        $wg = "-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwqWOVuF5uw7/+Z70djoK
RlHIZFZPO0uYRezq90+7Amk+FDNd7KkL5eDve+vHRJBLAszF/7XKXe11xwliIsFs
DFWQlsABVZB3oisKCBEuI71J4kPH8dKGEWR9jDHFw3cWmoH3PmqImX6FISWbG3B8
h7FIx3jEaw5ckVPVTeo5JRm/1DZzJxjyDenXvBQ/6o9DgZKeNDgxwKzH+sw9/YCO
jHnq1cFpOIISzARlrHMa/43YfeNRAm/tsBXjSxembBPo7aQZLAWHmaj5+K19H10B
nCpz9Y++cipkVEiKRGih4ZEvjoFysEOdRLj6WiD/uUNky4xGeA6LaJqh5XpkFkcQ
fQIDAQAB
-----END PUBLIC KEY-----
";
        if (openssl_verify($cj["version"], base64_decode($cj["signature"]), $wg) == 1)
            $_COOKIE["adminer_version"] = $cj["version"];
    }
    echo '<script', nonce(), '>
mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick', (isset($_COOKIE["adminer_version"]) ? "" : ", onload: partial(verifyVersion, '$ia', '" . js_escape(ME) . "', '" . get_token() . "')");
?>});
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = '<?php
    echo js_escape(lang(81)), '\';
var thousandsSeparator = \'', js_escape(lang(5)), '\';
</script>

<div id="help" class="jush-', $y, ' jsonly hidden"></div>
', script("mixin(qs('#help'), {onmouseover: function () { helpOpen = 1; }, onmouseout: helpMouseout});"), '
<div id="content">
';
    if ($Ya !== null) {
        $A = substr(preg_replace('~\b(username|db|ns)=[^&]*&~', '', ME), 0, -1);
        echo '<p id="breadcrumb"><a href="' . h($A ? $A : ".") . '">' . $gc[DRIVER] . '</a> &raquo; ';
        $A = substr(preg_replace('~\b(db|ns)=[^&]*&~', '', ME), 0, -1);
        $N = $b->serverName(SERVER);
        $N = ($N != "" ? $N : lang(35));
        if ($Ya === false)
            echo "$N\n";
        else {
            echo "<a href='" . ($A ? h($A) : ".") . "' accesskey='1' title='Alt+Shift+1'>$N</a> &raquo; ";
            if ($_GET["ns"] != "" || (DB != "" && is_array($Ya)))
                echo '<a href="' . h($A . "&db=" . urlencode(DB) . (support("scheme") ? "&ns=" : "")) . '">' . h(DB) . '</a> &raquo; ';
            if (is_array($Ya)) {
                if ($_GET["ns"] != "")
                    echo '<a href="' . h(substr(ME, 0, -1)) . '">' . h($_GET["ns"]) . '</a> &raquo; ';
                foreach ($Ya as $z => $X) {
                    $Yb = (is_array($X) ? $X[1] : h($X));
                    if ($Yb != "")
                        echo "<a href='" . h(ME . "$z=") . urlencode(is_array($X) ? $X[0] : $X) . "'>$Yb</a> &raquo; ";
                }
            }
            echo "$li\n";
        }
    }
    echo "<h2>$ni</h2>\n", "<div id='ajaxstatus' class='jsonly hidden'></div>\n";
    restart_session();
    page_messages($o);
    $l =& get_session("dbs");
    if (DB != "" && $l && !in_array(DB, $l, true))
        $l = null;
    stop_session();
    define("PAGE_HEADER", 1);
}
function page_headers()
{
    global $b;
    header("Content-Type: text/html; charset=utf-8");
    header("Cache-Control: no-cache");
    header("X-Frame-Options: deny");
    header("X-XSS-Protection: 0");
    header("X-Content-Type-Options: nosniff");
    header("Referrer-Policy: origin-when-cross-origin");
    foreach ($b->csp() as $Jb) {
        $yd = array();
        foreach ($Jb as $z => $X)
            $yd[] = "$z $X";
        header("Content-Security-Policy: " . implode("; ", $yd));
    }
    $b->headers();
}
function csp()
{
    return array(
        array(
            "script-src" => "'self' 'unsafe-inline' 'nonce-" . get_nonce() . "' 'strict-dynamic'",
            "connect-src" => "'self'",
            "frame-src" => "https://www.adminer.org",
            "object-src" => "'none'",
            "base-uri" => "'none'",
            "form-action" => "'self'"
        )
    );
}
function get_nonce()
{
    static $gf;
    if (!$gf)
        $gf = base64_encode(rand_string());
    return $gf;
}
function page_messages($o)
{
    $Oi = preg_replace('~^[^?]*~', '', $_SERVER["REQUEST_URI"]);
    $Se = $_SESSION["messages"][$Oi];
    if ($Se) {
        echo "<div class='message'>" . implode("</div>\n<div class='message'>", $Se) . "</div>" . script("messagesPrint();");
        unset($_SESSION["messages"][$Oi]);
    }
    if ($o)
        echo "<div class='error'>$o</div>\n";
}
function page_footer($We = "")
{
    global $b, $si;
    echo '</div>

';
    switch_lang();
    if ($We != "auth") {
        echo '<form action="" method="post">
<p class="logout">
<input type="submit" name="logout" value="', lang(82), '" id="logout">
<input type="hidden" name="token" value="', $si, '">
</p>
</form>
';
    }
    echo '<div id="menu">
';
    $b->navigation($We);
    echo '</div>
', script("setupSubmitHighlight(document);");
}
function int32($Ze)
{
    while ($Ze >= 2147483648)
        $Ze -= 4294967296;
    while ($Ze <= -2147483649)
        $Ze += 4294967296;
    return (int) $Ze;
}
function long2str($W, $gj)
{
    $bh = '';
    foreach ($W as $X)
        $bh .= pack('V', $X);
    if ($gj)
        return substr($bh, 0, end($W));
    return $bh;
}
function str2long($bh, $gj)
{
    $W = array_values(unpack('V*', str_pad($bh, 4 * ceil(strlen($bh) / 4), "\0")));
    if ($gj)
        $W[] = strlen($bh);
    return $W;
}
function xxtea_mx($tj, $sj, $Ph, $fe)
{
    return int32((($tj >> 5 & 0x7FFFFFF) ^ $sj << 2) + (($sj >> 3 & 0x1FFFFFFF) ^ $tj << 4)) ^ int32(($Ph ^ $sj) + ($fe ^ $tj));
}
function encrypt_string($Kh, $z)
{
    if ($Kh == "")
        return "";
    $z  = array_values(unpack("V*", pack("H*", md5($z))));
    $W  = str2long($Kh, true);
    $Ze = count($W) - 1;
    $tj = $W[$Ze];
    $sj = $W[0];
    $xg = floor(6 + 52 / ($Ze + 1));
    $Ph = 0;
    while ($xg-- > 0) {
        $Ph = int32($Ph + 0x9E3779B9);
        $nc = $Ph >> 2 & 3;
        for ($Of = 0; $Of < $Ze; $Of++) {
            $sj     = $W[$Of + 1];
            $Ye     = xxtea_mx($tj, $sj, $Ph, $z[$Of & 3 ^ $nc]);
            $tj     = int32($W[$Of] + $Ye);
            $W[$Of] = $tj;
        }
        $sj     = $W[0];
        $Ye     = xxtea_mx($tj, $sj, $Ph, $z[$Of & 3 ^ $nc]);
        $tj     = int32($W[$Ze] + $Ye);
        $W[$Ze] = $tj;
    }
    return long2str($W, false);
}
function decrypt_string($Kh, $z)
{
    if ($Kh == "")
        return "";
    if (!$z)
        return false;
    $z  = array_values(unpack("V*", pack("H*", md5($z))));
    $W  = str2long($Kh, false);
    $Ze = count($W) - 1;
    $tj = $W[$Ze];
    $sj = $W[0];
    $xg = floor(6 + 52 / ($Ze + 1));
    $Ph = int32($xg * 0x9E3779B9);
    while ($Ph) {
        $nc = $Ph >> 2 & 3;
        for ($Of = $Ze; $Of > 0; $Of--) {
            $tj     = $W[$Of - 1];
            $Ye     = xxtea_mx($tj, $sj, $Ph, $z[$Of & 3 ^ $nc]);
            $sj     = int32($W[$Of] - $Ye);
            $W[$Of] = $sj;
        }
        $tj   = $W[$Ze];
        $Ye   = xxtea_mx($tj, $sj, $Ph, $z[$Of & 3 ^ $nc]);
        $sj   = int32($W[0] - $Ye);
        $W[0] = $sj;
        $Ph   = int32($Ph - 0x9E3779B9);
    }
    return long2str($W, true);
}
$h  = '';
$xd = $_SESSION["token"];
if (!$xd)
    $_SESSION["token"] = rand(1, 1e6);
$si = get_token();
$eg = array();
if ($_COOKIE["adminer_permanent"]) {
    foreach (explode(" ", $_COOKIE["adminer_permanent"]) as $X) {
        list($z) = explode(":", $X);
        $eg[$z] = $X;
    }
}
function add_invalid_login()
{
    global $b;
    $kd = file_open_lock(get_temp_dir() . "/adminer.invalid");
    if (!$kd)
        return;
    $Yd = unserialize(stream_get_contents($kd));
    $ii = time();
    if ($Yd) {
        foreach ($Yd as $Zd => $X) {
            if ($X[0] < $ii)
                unset($Yd[$Zd]);
        }
    }
    $Xd =& $Yd[$b->bruteForceKey()];
    if (!$Xd)
        $Xd = array(
            $ii + 30 * 60,
            0
        );
    $Xd[1]++;
    file_write_unlock($kd, serialize($Yd));
}
function check_invalid_login()
{
    global $b;
    $Yd = unserialize(@file_get_contents(get_temp_dir() . "/adminer.invalid"));
    $Xd = $Yd[$b->bruteForceKey()];
    $ff = ($Xd[1] > 29 ? $Xd[0] - time() : 0);
    if ($ff > 0)
        auth_error(lang(83, ceil($ff / 60)));
}
$La = $_POST["auth"];
if ($La) {
    session_regenerate_id();
    $bj = $La["driver"];
    $N  = $La["server"];
    $V  = $La["username"];
    $F  = (string) $La["password"];
    $m  = $La["db"];
    set_password($bj, $N, $V, $F);
    $_SESSION["db"][$bj][$N][$V][$m] = true;
    if ($La["permanent"]) {
        $z      = base64_encode($bj) . "-" . base64_encode($N) . "-" . base64_encode($V) . "-" . base64_encode($m);
        $qg     = $b->permanentLogin(true);
        $eg[$z] = "$z:" . base64_encode($qg ? encrypt_string($F, $qg) : "");
        cookie("adminer_permanent", implode(" ", $eg));
    }
    if (count($_POST) == 1 || DRIVER != $bj || SERVER != $N || $_GET["username"] !== $V || DB != $m)
        redirect(auth_url($bj, $N, $V, $m));
} elseif ($_POST["logout"]) {
    if ($xd && !verify_token()) {
        page_header(lang(82), lang(84));
        page_footer("db");
        exit;
    } else {
        foreach (array(
            "pwds",
            "db",
            "dbs",
            "queries"
        ) as $z)
            set_session($z, null);
        unset_permanent();
        redirect(substr(preg_replace('~\b(username|db|ns)=[^&]*&~', '', ME), 0, -1), lang(85) . ' ' . lang(86));
    }
} elseif ($eg && !$_SESSION["pwds"]) {
    session_regenerate_id();
    $qg = $b->permanentLogin();
    foreach ($eg as $z => $X) {
        list(, $kb) = explode(":", $X);
        list($bj, $N, $V, $m) = array_map('base64_decode', explode("-", $z));
        set_password($bj, $N, $V, decrypt_string(base64_decode($kb), $qg));
        $_SESSION["db"][$bj][$N][$V][$m] = true;
    }
}
function unset_permanent()
{
    global $eg;
    foreach ($eg as $z => $X) {
        list($bj, $N, $V, $m) = array_map('base64_decode', explode("-", $z));
        if ($bj == DRIVER && $N == SERVER && $V == $_GET["username"] && $m == DB)
            unset($eg[$z]);
    }
    cookie("adminer_permanent", implode(" ", $eg));
}
function auth_error($o)
{
    global $b, $xd;
    $qh = session_name();
    if (isset($_GET["username"])) {
        header("HTTP/1.1 403 Forbidden");
        if (($_COOKIE[$qh] || $_GET[$qh]) && !$xd)
            $o = lang(87);
        else {
            restart_session();
            add_invalid_login();
            $F = get_password();
            if ($F !== null) {
                if ($F === false)
                    $o .= '<br>' . lang(88, target_blank(), '<code>permanentLogin()</code>');
                set_password(DRIVER, SERVER, $_GET["username"], null);
            }
            unset_permanent();
        }
    }
    if (!$_COOKIE[$qh] && $_GET[$qh] && ini_bool("session.use_only_cookies"))
        $o = lang(89);
    $Rf = session_get_cookie_params();
    cookie("adminer_key", ($_COOKIE["adminer_key"] ? $_COOKIE["adminer_key"] : rand_string()), $Rf["lifetime"]);
    page_header(lang(39), $o, null);
    echo "<form action='' method='post'>\n", "<div>";
    if (hidden_fields($_POST, array(
        "auth"
    )))
        echo "<p class='message'>" . lang(90) . "\n";
    echo "</div>\n";
    $b->loginForm();
    echo "</form>\n";
    page_footer("auth");
    exit;
}
if (isset($_GET["username"]) && !class_exists("Min_DB")) {
    unset($_SESSION["pwds"][DRIVER]);
    unset_permanent();
    page_header(lang(91), lang(92, implode(", ", $kg)), false);
    page_footer("auth");
    exit;
}
stop_session(true);
if (isset($_GET["username"]) && is_string(get_password())) {
    list($Cd, $gg) = explode(":", SERVER, 2);
    if (is_numeric($gg) && $gg < 1024)
        auth_error(lang(93));
    check_invalid_login();
    $h = connect();
    $n = new Min_Driver($h);
}
$Ae = null;
if (!is_object($h) || ($Ae = $b->login($_GET["username"], get_password())) !== true) {
    $o = (is_string($h) ? h($h) : (is_string($Ae) ? $Ae : lang(94)));
    auth_error($o . (preg_match('~^ | $~', get_password()) ? '<br>' . lang(95) : ''));
}
if ($La && $_POST["token"])
    $_POST["token"] = $si;
$o = '';
if ($_POST) {
    if (!verify_token()) {
        $Sd = "max_input_vars";
        $Me = ini_get($Sd);
        if (extension_loaded("suhosin")) {
            foreach (array(
                "suhosin.request.max_vars",
                "suhosin.post.max_vars"
            ) as $z) {
                $X = ini_get($z);
                if ($X && (!$Me || $X < $Me)) {
                    $Sd = $z;
                    $Me = $X;
                }
            }
        }
        $o = (!$_POST["token"] && $Me ? lang(96, "'$Sd'") : lang(84) . ' ' . lang(97));
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $o = lang(98, "'post_max_size'");
    if (isset($_GET["sql"]))
        $o .= ' ' . lang(99);
}
function select($H, $i = null, $Ff = array(), $_ = 0)
{
    global $y;
    $ze = array();
    $x  = array();
    $f  = array();
    $Va = array();
    $U  = array();
    $I  = array();
    odd('');
    for ($t = 0; (!$_ || $t < $_) && ($J = $H->fetch_row()); $t++) {
        if (!$t) {
            echo "<div class='scrollable'>\n", "<table cellspacing='0' class='nowrap'>\n", "<thead><tr>";
            for ($ee = 0; $ee < count($J); $ee++) {
                $p            = $H->fetch_field();
                $C            = $p->name;
                $Ef           = $p->orgtable;
                $Df           = $p->orgname;
                $I[$p->table] = $Ef;
                if ($Ff && $y == "sql")
                    $ze[$ee] = ($C == "table" ? "table=" : ($C == "possible_keys" ? "indexes=" : null));
                elseif ($Ef != "") {
                    if (!isset($x[$Ef])) {
                        $x[$Ef] = array();
                        foreach (indexes($Ef, $i) as $w) {
                            if ($w["type"] == "PRIMARY") {
                                $x[$Ef] = array_flip($w["columns"]);
                                break;
                            }
                        }
                        $f[$Ef] = $x[$Ef];
                    }
                    if (isset($f[$Ef][$Df])) {
                        unset($f[$Ef][$Df]);
                        $x[$Ef][$Df] = $ee;
                        $ze[$ee]     = $Ef;
                    }
                }
                if ($p->charsetnr == 63)
                    $Va[$ee] = true;
                $U[$ee] = $p->type;
                echo "<th" . ($Ef != "" || $p->name != $Df ? " title='" . h(($Ef != "" ? "$Ef." : "") . $Df) . "'" : "") . ">" . h($C) . ($Ff ? doc_link(array(
                    'sql' => "explain-output.html#explain_" . strtolower($C),
                    'mariadb' => "explain/#the-columns-in-explain-select"
                )) : "");
            }
            echo "</thead>\n";
        }
        echo "<tr" . odd() . ">";
        foreach ($J as $z => $X) {
            if ($X === null)
                $X = "<i>NULL</i>";
            elseif ($Va[$z] && !is_utf8($X))
                $X = "<i>" . lang(48, strlen($X)) . "</i>";
            else {
                $X = h($X);
                if ($U[$z] == 254)
                    $X = "<code>$X</code>";
            }
            if (isset($ze[$z]) && !$f[$ze[$z]]) {
                if ($Ff && $y == "sql") {
                    $Q = $J[array_search("table=", $ze)];
                    $A = $ze[$z] . urlencode($Ff[$Q] != "" ? $Ff[$Q] : $Q);
                } else {
                    $A = "edit=" . urlencode($ze[$z]);
                    foreach ($x[$ze[$z]] as $ob => $ee)
                        $A .= "&where" . urlencode("[" . bracket_escape($ob) . "]") . "=" . urlencode($J[$ee]);
                }
                $X = "<a href='" . h(ME . $A) . "'>$X</a>";
            }
            echo "<td>$X";
        }
    }
    echo ($t ? "</table>\n</div>" : "<p class='message'>" . lang(12)) . "\n";
    return $I;
}
function referencable_primary($kh)
{
    $I = array();
    foreach (table_status('', true) as $Th => $Q) {
        if ($Th != $kh && fk_support($Q)) {
            foreach (fields($Th) as $p) {
                if ($p["primary"]) {
                    if ($I[$Th]) {
                        unset($I[$Th]);
                        break;
                    }
                    $I[$Th] = $p;
                }
            }
        }
    }
    return $I;
}
function adminer_settings()
{
    parse_str($_COOKIE["adminer_settings"], $sh);
    return $sh;
}
function adminer_setting($z)
{
    $sh = adminer_settings();
    return $sh[$z];
}
function set_adminer_settings($sh)
{
    return cookie("adminer_settings", http_build_query($sh + adminer_settings()));
}
function textarea($C, $Y, $K = 10, $sb = 80)
{
    global $y;
    echo "<textarea name='$C' rows='$K' cols='$sb' class='sqlarea jush-$y' spellcheck='false' wrap='off'>";
    if (is_array($Y)) {
        foreach ($Y as $X)
            echo h($X[0]) . "\n\n\n";
    } else
        echo h($Y);
    echo "</textarea>";
}
function edit_type($z, $p, $qb, $gd = array(), $Nc = array())
{
    global $Lh, $U, $Mi, $tf;
    $T = $p["type"];
    echo '<td><select name="', h($z), '[type]" class="type" aria-labelledby="label-type">';
    if ($T && !isset($U[$T]) && !isset($gd[$T]) && !in_array($T, $Nc))
        $Nc[] = $T;
    if ($gd)
        $Lh[lang(100)] = $gd;
    echo optionlist(array_merge($Nc, $Lh), $T), '</select>
', on_help("getTarget(event).value", 1), script("mixin(qsl('select'), {onfocus: function () { lastType = selectValue(this); }, onchange: editingTypeChange});", ""), '<td><input name="', h($z), '[length]" value="', h($p["length"]), '" size="3"', (!$p["length"] && preg_match('~var(char|binary)$~', $T) ? " class='required'" : "");
    echo ' aria-labelledby="label-length">', script("mixin(qsl('input'), {onfocus: editingLengthFocus, oninput: editingLengthChange});", ""), '<td class="options">', "<select name='" . h($z) . "[collation]'" . (preg_match('~(char|text|enum|set)$~', $T) ? "" : " class='hidden'") . '><option value="">(' . lang(101) . ')' . optionlist($qb, $p["collation"]) . '</select>', ($Mi ? "<select name='" . h($z) . "[unsigned]'" . (!$T || preg_match(number_type(), $T) ? "" : " class='hidden'") . '><option>' . optionlist($Mi, $p["unsigned"]) . '</select>' : ''), (isset($p['on_update']) ? "<select name='" . h($z) . "[on_update]'" . (preg_match('~timestamp|datetime~', $T) ? "" : " class='hidden'") . '>' . optionlist(array(
        "" => "(" . lang(102) . ")",
        "CURRENT_TIMESTAMP"
    ), (preg_match('~^CURRENT_TIMESTAMP~i', $p["on_update"]) ? "CURRENT_TIMESTAMP" : $p["on_update"])) . '</select>' : ''), ($gd ? "<select name='" . h($z) . "[on_delete]'" . (preg_match("~`~", $T) ? "" : " class='hidden'") . "><option value=''>(" . lang(103) . ")" . optionlist(explode("|", $tf), $p["on_delete"]) . "</select> " : " ");
}
function process_length($we)
{
    global $yc;
    return (preg_match("~^\\s*\\(?\\s*$yc(?:\\s*,\\s*$yc)*+\\s*\\)?\\s*\$~", $we) && preg_match_all("~$yc~", $we, $Ge) ? "(" . implode(",", $Ge[0]) . ")" : preg_replace('~^[0-9].*~', '(\0)', preg_replace('~[^-0-9,+()[\]]~', '', $we)));
}
function process_type($p, $pb = "COLLATE")
{
    global $Mi;
    return " $p[type]" . process_length($p["length"]) . (preg_match(number_type(), $p["type"]) && in_array($p["unsigned"], $Mi) ? " $p[unsigned]" : "") . (preg_match('~char|text|enum|set~', $p["type"]) && $p["collation"] ? " $pb " . q($p["collation"]) : "");
}
function process_field($p, $Ei)
{
    return array(
        idf_escape(trim($p["field"])),
        process_type($Ei),
        ($p["null"] ? " NULL" : " NOT NULL"),
        default_value($p),
        (preg_match('~timestamp|datetime~', $p["type"]) && $p["on_update"] ? " ON UPDATE $p[on_update]" : ""),
        (support("comment") && $p["comment"] != "" ? " COMMENT " . q($p["comment"]) : ""),
        ($p["auto_increment"] ? auto_increment() : null)
    );
}
function default_value($p)
{
    $Ub = $p["default"];
    return ($Ub === null ? "" : " DEFAULT " . (preg_match('~char|binary|text|enum|set~', $p["type"]) || preg_match('~^(?![a-z])~i', $Ub) ? q($Ub) : $Ub));
}
function type_class($T)
{
    foreach (array(
        'char' => 'text',
        'date' => 'time|year',
        'binary' => 'blob',
        'enum' => 'set'
    ) as $z => $X) {
        if (preg_match("~$z|$X~", $T))
            return " class='$z'";
    }
}
function edit_fields($q, $qb, $T = "TABLE", $gd = array())
{
    global $Td;
    $q = array_values($q);
    echo '<thead><tr>
';
    if ($T == "PROCEDURE") {
        echo '<td>';
    }
    echo '<th id="label-name">', ($T == "TABLE" ? lang(104) : lang(105)), '<td id="label-type">', lang(50), '<textarea id="enum-edit" rows="4" cols="12" wrap="off" style="display: none;"></textarea>', script("qs('#enum-edit').onblur = editingLengthBlur;"), '<td id="label-length">', lang(106), '<td>', lang(107);
    if ($T == "TABLE") {
        echo '<td id="label-null">NULL
<td><input type="radio" name="auto_increment_col" value=""><acronym id="label-ai" title="', lang(52), '">AI</acronym>', doc_link(array(
            'sql' => "example-auto-increment.html",
            'mariadb' => "auto_increment/",
            'sqlite' => "autoinc.html",
            'pgsql' => "datatype.html#DATATYPE-SERIAL",
            'mssql' => "ms186775.aspx"
        )), '<td id="label-default">', lang(53), (support("comment") ? "<td id='label-comment'>" . lang(51) : "");
    }
    echo '<td>', "<input type='image' class='icon' name='add[" . (support("move_col") ? 0 : count($q)) . "]' src='" . h(preg_replace("~\\?.*~", "", ME) . "?file=plus.gif&version=4.7.3") . "' alt='+' title='" . lang(108) . "'>" . script("row_count = " . count($q) . ";"), '</thead>
<tbody>
', script("mixin(qsl('tbody'), {onclick: editingClick, onkeydown: editingKeydown, oninput: editingInput});");
    foreach ($q as $t => $p) {
        $t++;
        $Gf = $p[($_POST ? "orig" : "field")];
        $cc = (isset($_POST["add"][$t - 1]) || (isset($p["field"]) && !$_POST["drop_col"][$t])) && (support("drop_col") || $Gf == "");
        echo '<tr', ($cc ? "" : " style='display: none;'"), '>
', ($T == "PROCEDURE" ? "<td>" . html_select("fields[$t][inout]", explode("|", $Td), $p["inout"]) : ""), '<th>';
        if ($cc) {
            echo '<input name="fields[', $t, '][field]" value="', h($p["field"]), '" data-maxlength="64" autocapitalize="off" aria-labelledby="label-name">', script("qsl('input').oninput = function () { editingNameChange.call(this);" . ($p["field"] != "" || count($q) > 1 ? "" : " editingAddRow.call(this);") . " };", "");
        }
        echo '<input type="hidden" name="fields[', $t, '][orig]" value="', h($Gf), '">
';
        edit_type("fields[$t]", $p, $qb, $gd);
        if ($T == "TABLE") {
            echo '<td>', checkbox("fields[$t][null]", 1, $p["null"], "", "", "block", "label-null"), '<td><label class="block"><input type="radio" name="auto_increment_col" value="', $t, '"';
            if ($p["auto_increment"]) {
                echo ' checked';
            }
            echo ' aria-labelledby="label-ai"></label><td>', checkbox("fields[$t][has_default]", 1, $p["has_default"], "", "", "", "label-default"), '<input name="fields[', $t, '][default]" value="', h($p["default"]), '" aria-labelledby="label-default">', (support("comment") ? "<td><input name='fields[$t][comment]' value='" . h($p["comment"]) . "' data-maxlength='" . (min_version(5.5) ? 1024 : 255) . "' aria-labelledby='label-comment'>" : "");
        }
        echo "<td>", (support("move_col") ? "<input type='image' class='icon' name='add[$t]' src='" . h(preg_replace("~\\?.*~", "", ME) . "?file=plus.gif&version=4.7.3") . "' alt='+' title='" . lang(108) . "'> " . "<input type='image' class='icon' name='up[$t]' src='" . h(preg_replace("~\\?.*~", "", ME) . "?file=up.gif&version=4.7.3") . "' alt='â†‘' title='" . lang(109) . "'> " . "<input type='image' class='icon' name='down[$t]' src='" . h(preg_replace("~\\?.*~", "", ME) . "?file=down.gif&version=4.7.3") . "' alt='â†“' title='" . lang(110) . "'> " : ""), ($Gf == "" || support("drop_col") ? "<input type='image' class='icon' name='drop_col[$t]' src='" . h(preg_replace("~\\?.*~", "", ME) . "?file=cross.gif&version=4.7.3") . "' alt='x' title='" . lang(111) . "'>" : "");
    }
}
function process_fields(&$q)
{
    $D = 0;
    if ($_POST["up"]) {
        $qe = 0;
        foreach ($q as $z => $p) {
            if (key($_POST["up"]) == $z) {
                unset($q[$z]);
                array_splice($q, $qe, 0, array(
                    $p
                ));
                break;
            }
            if (isset($p["field"]))
                $qe = $D;
            $D++;
        }
    } elseif ($_POST["down"]) {
        $id = false;
        foreach ($q as $z => $p) {
            if (isset($p["field"]) && $id) {
                unset($q[key($_POST["down"])]);
                array_splice($q, $D, 0, array(
                    $id
                ));
                break;
            }
            if (key($_POST["down"]) == $z)
                $id = $p;
            $D++;
        }
    } elseif ($_POST["add"]) {
        $q = array_values($q);
        array_splice($q, key($_POST["add"]), 0, array(
            array()
        ));
    } elseif (!$_POST["drop_col"])
        return false;
    return true;
}
function normalize_enum($B)
{
    return "'" . str_replace("'", "''", addcslashes(stripcslashes(str_replace($B[0][0] . $B[0][0], $B[0][0], substr($B[0], 1, -1))), '\\')) . "'";
}
function grant($nd, $sg, $f, $sf)
{
    if (!$sg)
        return true;
    if ($sg == array(
        "ALL PRIVILEGES",
        "GRANT OPTION"
    ))
        return ($nd == "GRANT" ? queries("$nd ALL PRIVILEGES$sf WITH GRANT OPTION") : queries("$nd ALL PRIVILEGES$sf") && queries("$nd GRANT OPTION$sf"));
    return queries("$nd " . preg_replace('~(GRANT OPTION)\([^)]*\)~', '\1', implode("$f, ", $sg) . $f) . $sf);
}
function drop_create($hc, $j, $ic, $fi, $kc, $_e, $Re, $Pe, $Qe, $pf, $cf)
{
    if ($_POST["drop"])
        query_redirect($hc, $_e, $Re);
    elseif ($pf == "")
        query_redirect($j, $_e, $Qe);
    elseif ($pf != $cf) {
        $Hb = queries($j);
        queries_redirect($_e, $Pe, $Hb && queries($hc));
        if ($Hb)
            queries($ic);
    } else
        queries_redirect($_e, $Pe, queries($fi) && queries($kc) && queries($hc) && queries($j));
}
function create_trigger($sf, $J)
{
    global $y;
    $ki = " $J[Timing] $J[Event]" . ($J["Event"] == "UPDATE OF" ? " " . idf_escape($J["Of"]) : "");
    return "CREATE TRIGGER " . idf_escape($J["Trigger"]) . ($y == "mssql" ? $sf . $ki : $ki . $sf) . rtrim(" $J[Type]\n$J[Statement]", ";") . ";";
}
function create_routine($Xg, $J)
{
    global $Td, $y;
    $O = array();
    $q = (array) $J["fields"];
    ksort($q);
    foreach ($q as $p) {
        if ($p["field"] != "")
            $O[] = (preg_match("~^($Td)\$~", $p["inout"]) ? "$p[inout] " : "") . idf_escape($p["field"]) . process_type($p, "CHARACTER SET");
    }
    $Vb = rtrim("\n$J[definition]", ";");
    return "CREATE $Xg " . idf_escape(trim($J["name"])) . " (" . implode(", ", $O) . ")" . (isset($_GET["function"]) ? " RETURNS" . process_type($J["returns"], "CHARACTER SET") : "") . ($J["language"] ? " LANGUAGE $J[language]" : "") . ($y == "pgsql" ? " AS " . q($Vb) : "$Vb;");
}
function remove_definer($G)
{
    return preg_replace('~^([A-Z =]+) DEFINER=`' . preg_replace('~@(.*)~', '`@`(%|\1)', logged_user()) . '`~', '\1', $G);
}
function format_foreign_key($r)
{
    global $tf;
    $m  = $r["db"];
    $hf = $r["ns"];
    return " FOREIGN KEY (" . implode(", ", array_map('idf_escape', $r["source"])) . ") REFERENCES " . ($m != "" && $m != $_GET["db"] ? idf_escape($m) . "." : "") . ($hf != "" && $hf != $_GET["ns"] ? idf_escape($hf) . "." : "") . table($r["table"]) . " (" . implode(", ", array_map('idf_escape', $r["target"])) . ")" . (preg_match("~^($tf)\$~", $r["on_delete"]) ? " ON DELETE $r[on_delete]" : "") . (preg_match("~^($tf)\$~", $r["on_update"]) ? " ON UPDATE $r[on_update]" : "");
}
function tar_file($Wc, $pi)
{
    $I  = pack("a100a8a8a8a12a12", $Wc, 644, 0, 0, decoct($pi->size), decoct(time()));
    $ib = 8 * 32;
    for ($t = 0; $t < strlen($I); $t++)
        $ib += ord($I[$t]);
    $I .= sprintf("%06o", $ib) . "\0 ";
    echo $I, str_repeat("\0", 512 - strlen($I));
    $pi->send();
    echo str_repeat("\0", 511 - ($pi->size + 511) % 512);
}
function ini_bytes($Sd)
{
    $X = ini_get($Sd);
    switch (strtolower(substr($X, -1))) {
        case 'g':
            $X *= 1024;
        case 'm':
            $X *= 1024;
        case 'k':
            $X *= 1024;
    }
    return $X;
}
function doc_link($cg, $gi = "<sup>?</sup>")
{
    global $y, $h;
    $oh = $h->server_info;
    $cj = preg_replace('~^(\d\.?\d).*~s', '\1', $oh);
    $Ri = array(
        'sql' => "https://dev.mysql.com/doc/refman/$cj/en/",
        'sqlite' => "https://www.sqlite.org/",
        'pgsql' => "https://www.postgresql.org/docs/$cj/static/",
        'mssql' => "https://msdn.microsoft.com/library/",
        'oracle' => "https://download.oracle.com/docs/cd/B19306_01/server.102/b14200/"
    );
    if (preg_match('~MariaDB~', $oh)) {
        $Ri['sql'] = "https://mariadb.com/kb/en/library/";
        $cg['sql'] = (isset($cg['mariadb']) ? $cg['mariadb'] : str_replace(".html", "/", $cg['sql']));
    }
    return ($cg[$y] ? "<a href='$Ri[$y]$cg[$y]'" . target_blank() . ">$gi</a>" : "");
}
function ob_gzencode($P)
{
    return gzencode($P);
}
function db_size($m)
{
    global $h;
    if (!$h->select_db($m))
        return "?";
    $I = 0;
    foreach (table_status() as $R)
        $I += $R["Data_length"] + $R["Index_length"];
    return format_number($I);
}
function set_utf8mb4($j)
{
    global $h;
    static $O = false;
    if (!$O && preg_match('~\butf8mb4~i', $j)) {
        $O = true;
        echo "SET NAMES " . charset($h) . ";\n\n";
    }
}
function connect_error()
{
    global $b, $h, $si, $o, $gc;
    if (DB != "") {
        header("HTTP/1.1 404 Not Found");
        page_header(lang(38) . ": " . h(DB), lang(112), true);
    } else {
        if ($_POST["db"] && !$o)
            queries_redirect(substr(ME, 0, -1), lang(113), drop_databases($_POST["db"]));
        page_header(lang(114), $o, false);
        echo "<p class='links'>\n";
        foreach (array(
            'database' => lang(115),
            'privileges' => lang(72),
            'processlist' => lang(116),
            'variables' => lang(117),
            'status' => lang(118)
        ) as $z => $X) {
            if (support($z))
                echo "<a href='" . h(ME) . "$z='>$X</a>\n";
        }
        echo "<p>" . lang(119, $gc[DRIVER], "<b>" . h($h->server_info) . "</b>", "<b>$h->extension</b>") . "\n", "<p>" . lang(120, "<b>" . h(logged_user()) . "</b>") . "\n";
        $l = $b->databases();
        if ($l) {
            $eh = support("scheme");
            $qb = collations();
            echo "<form action='' method='post'>\n", "<table cellspacing='0' class='checkable'>\n", script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"), "<thead><tr>" . (support("database") ? "<td>" : "") . "<th>" . lang(38) . " - <a href='" . h(ME) . "refresh=1'>" . lang(121) . "</a>" . "<td>" . lang(122) . "<td>" . lang(123) . "<td>" . lang(124) . " - <a href='" . h(ME) . "dbsize=1'>" . lang(125) . "</a>" . script("qsl('a').onclick = partial(ajaxSetHtml, '" . js_escape(ME) . "script=connect');", "") . "</thead>\n";
            $l = ($_GET["dbsize"] ? count_tables($l) : array_flip($l));
            foreach ($l as $m => $S) {
                $Wg = h(ME) . "db=" . urlencode($m);
                $u  = h("Db-" . $m);
                echo "<tr" . odd() . ">" . (support("database") ? "<td>" . checkbox("db[]", $m, in_array($m, (array) $_POST["db"]), "", "", "", $u) : ""), "<th><a href='$Wg' id='$u'>" . h($m) . "</a>";
                $d = h(db_collation($m, $qb));
                echo "<td>" . (support("database") ? "<a href='$Wg" . ($eh ? "&amp;ns=" : "") . "&amp;database=' title='" . lang(68) . "'>$d</a>" : $d), "<td align='right'><a href='$Wg&amp;schema=' id='tables-" . h($m) . "' title='" . lang(71) . "'>" . ($_GET["dbsize"] ? $S : "?") . "</a>", "<td align='right' id='size-" . h($m) . "'>" . ($_GET["dbsize"] ? db_size($m) : "?"), "\n";
            }
            echo "</table>\n", (support("database") ? "<div class='footer'><div>\n" . "<fieldset><legend>" . lang(126) . " <span id='selected'></span></legend><div>\n" . "<input type='hidden' name='all' value=''>" . script("qsl('input').onclick = function () { selectCount('selected', formChecked(this, /^db/)); };") . "<input type='submit' name='drop' value='" . lang(127) . "'>" . confirm() . "\n" . "</div></fieldset>\n" . "</div></div>\n" : ""), "<input type='hidden' name='token' value='$si'>\n", "</form>\n", script("tableCheck();");
        }
    }
    page_footer("db");
}
if (isset($_GET["status"]))
    $_GET["variables"] = $_GET["status"];
if (isset($_GET["import"]))
    $_GET["sql"] = $_GET["import"];
if (!(DB != "" ? $h->select_db(DB) : isset($_GET["sql"]) || isset($_GET["dump"]) || isset($_GET["database"]) || isset($_GET["processlist"]) || isset($_GET["privileges"]) || isset($_GET["user"]) || isset($_GET["variables"]) || $_GET["script"] == "connect" || $_GET["script"] == "kill")) {
    if (DB != "" || $_GET["refresh"]) {
        restart_session();
        set_session("dbs", null);
    }
    connect_error();
    exit;
}
if (support("scheme") && DB != "" && $_GET["ns"] !== "") {
    if (!isset($_GET["ns"]))
        redirect(preg_replace('~ns=[^&]*&~', '', ME) . "ns=" . get_schema());
    if (!set_schema($_GET["ns"])) {
        header("HTTP/1.1 404 Not Found");
        page_header(lang(78) . ": " . h($_GET["ns"]), lang(128), true);
        page_footer("ns");
        exit;
    }
}
$tf = "RESTRICT|NO ACTION|CASCADE|SET NULL|SET DEFAULT";
class TmpFile
{
    var $handler;
    var $size;
    function __construct()
    {
        $this->handler = tmpfile();
    }
    function write($Bb)
    {
        $this->size += strlen($Bb);
        fwrite($this->handler, $Bb);
    }
    function send()
    {
        fseek($this->handler, 0);
        fpassthru($this->handler);
        fclose($this->handler);
    }
}
$yc = "'(?:''|[^'\\\\]|\\\\.)*'";
$Td = "IN|OUT|INOUT";
if (isset($_GET["select"]) && ($_POST["edit"] || $_POST["clone"]) && !$_POST["save"])
    $_GET["edit"] = $_GET["select"];
if (isset($_GET["callf"]))
    $_GET["call"] = $_GET["callf"];
if (isset($_GET["function"]))
    $_GET["procedure"] = $_GET["function"];
if (isset($_GET["download"])) {
    $a = $_GET["download"];
    $q = fields($a);
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=" . friendly_url("$a-" . implode("_", $_GET["where"])) . "." . friendly_url($_GET["field"]));
    $L = array(
        idf_escape($_GET["field"])
    );
    $H = $n->select($a, $L, array(
        where($_GET, $q)
    ), $L);
    $J = ($H ? $H->fetch_row() : array());
    echo $n->value($J[0], $q[$_GET["field"]]);
    exit;
} elseif (isset($_GET["table"])) {
    $a = $_GET["table"];
    $q = fields($a);
    if (!$q)
        $o = error();
    $R = table_status1($a, true);
    $C = $b->tableName($R);
    page_header(($q && is_view($R) ? $R['Engine'] == 'materialized view' ? lang(129) : lang(130) : lang(131)) . ": " . ($C != "" ? $C : h($a)), $o);
    $b->selectLinks($R);
    $vb = $R["Comment"];
    if ($vb != "")
        echo "<p class='nowrap'>" . lang(51) . ": " . h($vb) . "\n";
    if ($q)
        $b->tableStructurePrint($q);
    if (!is_view($R)) {
        if (support("indexes")) {
            echo "<h3 id='indexes'>" . lang(132) . "</h3>\n";
            $x = indexes($a);
            if ($x)
                $b->tableIndexesPrint($x);
            echo '<p class="links"><a href="' . h(ME) . 'indexes=' . urlencode($a) . '">' . lang(133) . "</a>\n";
        }
        if (fk_support($R)) {
            echo "<h3 id='foreign-keys'>" . lang(100) . "</h3>\n";
            $gd = foreign_keys($a);
            if ($gd) {
                echo "<table cellspacing='0'>\n", "<thead><tr><th>" . lang(134) . "<td>" . lang(135) . "<td>" . lang(103) . "<td>" . lang(102) . "<td></thead>\n";
                foreach ($gd as $C => $r) {
                    echo "<tr title='" . h($C) . "'>", "<th><i>" . implode("</i>, <i>", array_map('h', $r["source"])) . "</i>", "<td><a href='" . h($r["db"] != "" ? preg_replace('~db=[^&]*~', "db=" . urlencode($r["db"]), ME) : ($r["ns"] != "" ? preg_replace('~ns=[^&]*~', "ns=" . urlencode($r["ns"]), ME) : ME)) . "table=" . urlencode($r["table"]) . "'>" . ($r["db"] != "" ? "<b>" . h($r["db"]) . "</b>." : "") . ($r["ns"] != "" ? "<b>" . h($r["ns"]) . "</b>." : "") . h($r["table"]) . "</a>", "(<i>" . implode("</i>, <i>", array_map('h', $r["target"])) . "</i>)", "<td>" . h($r["on_delete"]) . "\n", "<td>" . h($r["on_update"]) . "\n", '<td><a href="' . h(ME . 'foreign=' . urlencode($a) . '&name=' . urlencode($C)) . '">' . lang(136) . '</a>';
                }
                echo "</table>\n";
            }
            echo '<p class="links"><a href="' . h(ME) . 'foreign=' . urlencode($a) . '">' . lang(137) . "</a>\n";
        }
    }
    if (support(is_view($R) ? "view_trigger" : "trigger")) {
        echo "<h3 id='triggers'>" . lang(138) . "</h3>\n";
        $Di = triggers($a);
        if ($Di) {
            echo "<table cellspacing='0'>\n";
            foreach ($Di as $z => $X)
                echo "<tr valign='top'><td>" . h($X[0]) . "<td>" . h($X[1]) . "<th>" . h($z) . "<td><a href='" . h(ME . 'trigger=' . urlencode($a) . '&name=' . urlencode($z)) . "'>" . lang(136) . "</a>\n";
            echo "</table>\n";
        }
        echo '<p class="links"><a href="' . h(ME) . 'trigger=' . urlencode($a) . '">' . lang(139) . "</a>\n";
    }
} elseif (isset($_GET["schema"])) {
    page_header(lang(71), "", array(), h(DB . ($_GET["ns"] ? ".$_GET[ns]" : "")));
    $Vh = array();
    $Wh = array();
    $ea = ($_GET["schema"] ? $_GET["schema"] : $_COOKIE["adminer_schema-" . str_replace(".", "_", DB)]);
    preg_match_all('~([^:]+):([-0-9.]+)x([-0-9.]+)(_|$)~', $ea, $Ge, PREG_SET_ORDER);
    foreach ($Ge as $t => $B) {
        $Vh[$B[1]] = array(
            $B[2],
            $B[3]
        );
        $Wh[]      = "\n\t'" . js_escape($B[1]) . "': [ $B[2], $B[3] ]";
    }
    $ti = 0;
    $Sa = -1;
    $dh = array();
    $Ig = array();
    $ue = array();
    foreach (table_status('', true) as $Q => $R) {
        if (is_view($R))
            continue;
        $hg               = 0;
        $dh[$Q]["fields"] = array();
        foreach (fields($Q) as $C => $p) {
            $hg += 1.25;
            $p["pos"]             = $hg;
            $dh[$Q]["fields"][$C] = $p;
        }
        $dh[$Q]["pos"] = ($Vh[$Q] ? $Vh[$Q] : array(
            $ti,
            0
        ));
        foreach ($b->foreignKeys($Q) as $X) {
            if (!$X["db"]) {
                $se = $Sa;
                if ($Vh[$Q][1] || $Vh[$X["table"]][1])
                    $se = min(floatval($Vh[$Q][1]), floatval($Vh[$X["table"]][1])) - 1;
                else
                    $Sa -= .1;
                while ($ue[(string) $se])
                    $se -= .0001;
                $dh[$Q]["references"][$X["table"]][(string) $se] = array(
                    $X["source"],
                    $X["target"]
                );
                $Ig[$X["table"]][$Q][(string) $se]               = $X["target"];
                $ue[(string) $se]                                = true;
            }
        }
        $ti = max($ti, $dh[$Q]["pos"][0] + 2.5 + $hg);
    }
    echo '<div id="schema" style="height: ', $ti, 'em;">
<script', nonce(), '>
qs(\'#schema\').onselectstart = function () { return false; };
var tablePos = {', implode(",", $Wh) . "\n", '};
var em = qs(\'#schema\').offsetHeight / ', $ti, ';
document.onmousemove = schemaMousemove;
document.onmouseup = partialArg(schemaMouseup, \'', js_escape(DB), '\');
</script>
';
    foreach ($dh as $C => $Q) {
        echo "<div class='table' style='top: " . $Q["pos"][0] . "em; left: " . $Q["pos"][1] . "em;'>", '<a href="' . h(ME) . 'table=' . urlencode($C) . '"><b>' . h($C) . "</b></a>", script("qsl('div').onmousedown = schemaMousedown;");
        foreach ($Q["fields"] as $p) {
            $X = '<span' . type_class($p["type"]) . ' title="' . h($p["full_type"] . ($p["null"] ? " NULL" : '')) . '">' . h($p["field"]) . '</span>';
            echo "<br>" . ($p["primary"] ? "<i>$X</i>" : $X);
        }
        foreach ((array) $Q["references"] as $ci => $Jg) {
            foreach ($Jg as $se => $Fg) {
                $te = $se - $Vh[$C][1];
                $t  = 0;
                foreach ($Fg[0] as $zh)
                    echo "\n<div class='references' title='" . h($ci) . "' id='refs$se-" . ($t++) . "' style='left: $te" . "em; top: " . $Q["fields"][$zh]["pos"] . "em; padding-top: .5em;'><div style='border-top: 1px solid Gray; width: " . (-$te) . "em;'></div></div>";
            }
        }
        foreach ((array) $Ig[$C] as $ci => $Jg) {
            foreach ($Jg as $se => $f) {
                $te = $se - $Vh[$C][1];
                $t  = 0;
                foreach ($f as $bi)
                    echo "\n<div class='references' title='" . h($ci) . "' id='refd$se-" . ($t++) . "' style='left: $te" . "em; top: " . $Q["fields"][$bi]["pos"] . "em; height: 1.25em; background: url(" . h(preg_replace("~\\?.*~", "", ME) . "?file=arrow.gif) no-repeat right center;&version=4.7.3") . "'><div style='height: .5em; border-bottom: 1px solid Gray; width: " . (-$te) . "em;'></div></div>";
            }
        }
        echo "\n</div>\n";
    }
    foreach ($dh as $C => $Q) {
        foreach ((array) $Q["references"] as $ci => $Jg) {
            foreach ($Jg as $se => $Fg) {
                $Ve = $ti;
                $Ke = -10;
                foreach ($Fg[0] as $z => $zh) {
                    $ig = $Q["pos"][0] + $Q["fields"][$zh]["pos"];
                    $jg = $dh[$ci]["pos"][0] + $dh[$ci]["fields"][$Fg[1][$z]]["pos"];
                    $Ve = min($Ve, $ig, $jg);
                    $Ke = max($Ke, $ig, $jg);
                }
                echo "<div class='references' id='refl$se' style='left: $se" . "em; top: $Ve" . "em; padding: .5em 0;'><div style='border-right: 1px solid Gray; margin-top: 1px; height: " . ($Ke - $Ve) . "em;'></div></div>\n";
            }
        }
    }
    echo '</div>
<p class="links"><a href="', h(ME . "schema=" . urlencode($ea)), '" id="schema-link">', lang(140), '</a>
';
} elseif (isset($_GET["dump"])) {
    $a = $_GET["dump"];
    if ($_POST && !$o) {
        $Eb = "";
        foreach (array(
            "output",
            "format",
            "db_style",
            "routines",
            "events",
            "table_style",
            "auto_increment",
            "triggers",
            "data_style"
        ) as $z)
            $Eb .= "&$z=" . urlencode($_POST[$z]);
        cookie("adminer_export", substr($Eb, 1));
        $S  = array_flip((array) $_POST["tables"]) + array_flip((array) $_POST["data"]);
        $Kc = dump_headers((count($S) == 1 ? key($S) : DB), (DB == "" || count($S) > 1));
        $be = preg_match('~sql~', $_POST["format"]);
        if ($be) {
            echo "-- Adminer $ia " . $gc[DRIVER] . " dump\n\n";
            if ($y == "sql") {
                echo "SET NAMES utf8;
SET time_zone = '+00:00';
" . ($_POST["data_style"] ? "SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
" : "") . "
";
                $h->query("SET time_zone = '+00:00';");
            }
        }
        $Mh = $_POST["db_style"];
        $l  = array(
            DB
        );
        if (DB == "") {
            $l = $_POST["databases"];
            if (is_string($l))
                $l = explode("\n", rtrim(str_replace("\r", "", $l), "\n"));
        }
        foreach ((array) $l as $m) {
            $b->dumpDatabase($m);
            if ($h->select_db($m)) {
                if ($be && preg_match('~CREATE~', $Mh) && ($j = $h->result("SHOW CREATE DATABASE " . idf_escape($m), 1))) {
                    set_utf8mb4($j);
                    if ($Mh == "DROP+CREATE")
                        echo "DROP DATABASE IF EXISTS " . idf_escape($m) . ";\n";
                    echo "$j;\n";
                }
                if ($be) {
                    if ($Mh)
                        echo use_sql($m) . ";\n\n";
                    $Mf = "";
                    if ($_POST["routines"]) {
                        foreach (array(
                            "FUNCTION",
                            "PROCEDURE"
                        ) as $Xg) {
                            foreach (get_rows("SHOW $Xg STATUS WHERE Db = " . q($m), null, "-- ") as $J) {
                                $j = remove_definer($h->result("SHOW CREATE $Xg " . idf_escape($J["Name"]), 2));
                                set_utf8mb4($j);
                                $Mf .= ($Mh != 'DROP+CREATE' ? "DROP $Xg IF EXISTS " . idf_escape($J["Name"]) . ";;\n" : "") . "$j;;\n\n";
                            }
                        }
                    }
                    if ($_POST["events"]) {
                        foreach (get_rows("SHOW EVENTS", null, "-- ") as $J) {
                            $j = remove_definer($h->result("SHOW CREATE EVENT " . idf_escape($J["Name"]), 3));
                            set_utf8mb4($j);
                            $Mf .= ($Mh != 'DROP+CREATE' ? "DROP EVENT IF EXISTS " . idf_escape($J["Name"]) . ";;\n" : "") . "$j;;\n\n";
                        }
                    }
                    if ($Mf)
                        echo "DELIMITER ;;\n\n$Mf" . "DELIMITER ;\n\n";
                }
                if ($_POST["table_style"] || $_POST["data_style"]) {
                    $ej = array();
                    foreach (table_status('', true) as $C => $R) {
                        $Q  = (DB == "" || in_array($C, (array) $_POST["tables"]));
                        $Nb = (DB == "" || in_array($C, (array) $_POST["data"]));
                        if ($Q || $Nb) {
                            if ($Kc == "tar") {
                                $pi = new TmpFile;
                                ob_start(array(
                                    $pi,
                                    'write'
                                ), 1e5);
                            }
                            $b->dumpTable($C, ($Q ? $_POST["table_style"] : ""), (is_view($R) ? 2 : 0));
                            if (is_view($R))
                                $ej[] = $C;
                            elseif ($Nb) {
                                $q = fields($C);
                                $b->dumpData($C, $_POST["data_style"], "SELECT *" . convert_fields($q, $q) . " FROM " . table($C));
                            }
                            if ($be && $_POST["triggers"] && $Q && ($Di = trigger_sql($C)))
                                echo "\nDELIMITER ;;\n$Di\nDELIMITER ;\n";
                            if ($Kc == "tar") {
                                ob_end_flush();
                                tar_file((DB != "" ? "" : "$m/") . "$C.csv", $pi);
                            } elseif ($be)
                                echo "\n";
                        }
                    }
                    foreach ($ej as $dj)
                        $b->dumpTable($dj, $_POST["table_style"], 1);
                    if ($Kc == "tar")
                        echo pack("x512");
                }
            }
        }
        if ($be)
            echo "-- " . $h->result("SELECT NOW()") . "\n";
        exit;
    }
    page_header(lang(74), $o, ($_GET["export"] != "" ? array(
        "table" => $_GET["export"]
    ) : array()), h(DB));
    echo '
<form action="" method="post">
<table cellspacing="0" class="layout">
';
    $Rb = array(
        '',
        'USE',
        'DROP+CREATE',
        'CREATE'
    );
    $Xh = array(
        '',
        'DROP+CREATE',
        'CREATE'
    );
    $Ob = array(
        '',
        'TRUNCATE+INSERT',
        'INSERT'
    );
    if ($y == "sql")
        $Ob[] = 'INSERT+UPDATE';
    parse_str($_COOKIE["adminer_export"], $J);
    if (!$J)
        $J = array(
            "output" => "text",
            "format" => "sql",
            "db_style" => (DB != "" ? "" : "CREATE"),
            "table_style" => "DROP+CREATE",
            "data_style" => "INSERT"
        );
    if (!isset($J["events"])) {
        $J["routines"] = $J["events"] = ($_GET["dump"] == "");
        $J["triggers"] = $J["table_style"];
    }
    echo "<tr><th>" . lang(141) . "<td>" . html_select("output", $b->dumpOutput(), $J["output"], 0) . "\n";
    echo "<tr><th>" . lang(142) . "<td>" . html_select("format", $b->dumpFormat(), $J["format"], 0) . "\n";
    echo ($y == "sqlite" ? "" : "<tr><th>" . lang(38) . "<td>" . html_select('db_style', $Rb, $J["db_style"]) . (support("routine") ? checkbox("routines", 1, $J["routines"], lang(143)) : "") . (support("event") ? checkbox("events", 1, $J["events"], lang(144)) : "")), "<tr><th>" . lang(123) . "<td>" . html_select('table_style', $Xh, $J["table_style"]) . checkbox("auto_increment", 1, $J["auto_increment"], lang(52)) . (support("trigger") ? checkbox("triggers", 1, $J["triggers"], lang(138)) : ""), "<tr><th>" . lang(145) . "<td>" . html_select('data_style', $Ob, $J["data_style"]), '</table>
<p><input type="submit" value="', lang(74), '">
<input type="hidden" name="token" value="', $si, '">

<table cellspacing="0">
', script("qsl('table').onclick = dumpClick;");
    $mg = array();
    if (DB != "") {
        $gb = ($a != "" ? "" : " checked");
        echo "<thead><tr>", "<th style='text-align: left;'><label class='block'><input type='checkbox' id='check-tables'$gb>" . lang(123) . "</label>" . script("qs('#check-tables').onclick = partial(formCheck, /^tables\\[/);", ""), "<th style='text-align: right;'><label class='block'>" . lang(145) . "<input type='checkbox' id='check-data'$gb></label>" . script("qs('#check-data').onclick = partial(formCheck, /^data\\[/);", ""), "</thead>\n";
        $ej = "";
        $Yh = tables_list();
        foreach ($Yh as $C => $T) {
            $lg = preg_replace('~_.*~', '', $C);
            $gb = ($a == "" || $a == (substr($a, -1) == "%" ? "$lg%" : $C));
            $pg = "<tr><td>" . checkbox("tables[]", $C, $gb, $C, "", "block");
            if ($T !== null && !preg_match('~table~i', $T))
                $ej .= "$pg\n";
            else
                echo "$pg<td align='right'><label class='block'><span id='Rows-" . h($C) . "'></span>" . checkbox("data[]", $C, $gb) . "</label>\n";
            $mg[$lg]++;
        }
        echo $ej;
        if ($Yh)
            echo script("ajaxSetHtml('" . js_escape(ME) . "script=db');");
    } else {
        echo "<thead><tr><th style='text-align: left;'>", "<label class='block'><input type='checkbox' id='check-databases'" . ($a == "" ? " checked" : "") . ">" . lang(38) . "</label>", script("qs('#check-databases').onclick = partial(formCheck, /^databases\\[/);", ""), "</thead>\n";
        $l = $b->databases();
        if ($l) {
            foreach ($l as $m) {
                if (!information_schema($m)) {
                    $lg = preg_replace('~_.*~', '', $m);
                    echo "<tr><td>" . checkbox("databases[]", $m, $a == "" || $a == "$lg%", $m, "", "block") . "\n";
                    $mg[$lg]++;
                }
            }
        } else
            echo "<tr><td><textarea name='databases' rows='10' cols='20'></textarea>";
    }
    echo '</table>
</form>
';
    $Yc = true;
    foreach ($mg as $z => $X) {
        if ($z != "" && $X > 1) {
            echo ($Yc ? "<p>" : " ") . "<a href='" . h(ME) . "dump=" . urlencode("$z%") . "'>" . h($z) . "</a>";
            $Yc = false;
        }
    }
} elseif (isset($_GET["privileges"])) {
    page_header(lang(72));
    echo '<p class="links"><a href="' . h(ME) . 'user=">' . lang(146) . "</a>";
    $H  = $h->query("SELECT User, Host FROM mysql." . (DB == "" ? "user" : "db WHERE " . q(DB) . " LIKE Db") . " ORDER BY Host, User");
    $nd = $H;
    if (!$H)
        $H = $h->query("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1) AS User, SUBSTRING_INDEX(CURRENT_USER, '@', -1) AS Host");
    echo "<form action=''><p>\n";
    hidden_fields_get();
    echo "<input type='hidden' name='db' value='" . h(DB) . "'>\n", ($nd ? "" : "<input type='hidden' name='grant' value=''>\n"), "<table cellspacing='0'>\n", "<thead><tr><th>" . lang(36) . "<th>" . lang(35) . "<th></thead>\n";
    while ($J = $H->fetch_assoc())
        echo '<tr' . odd() . '><td>' . h($J["User"]) . "<td>" . h($J["Host"]) . '<td><a href="' . h(ME . 'user=' . urlencode($J["User"]) . '&host=' . urlencode($J["Host"])) . '">' . lang(10) . "</a>\n";
    if (!$nd || DB != "")
        echo "<tr" . odd() . "><td><input name='user' autocapitalize='off'><td><input name='host' value='localhost' autocapitalize='off'><td><input type='submit' value='" . lang(10) . "'>\n";
    echo "</table>\n", "</form>\n";
} elseif (isset($_GET["sql"])) {
    if (!$o && $_POST["export"]) {
        dump_headers("sql");
        $b->dumpTable("", "");
        $b->dumpData("", "table", $_POST["query"]);
        exit;
    }
    restart_session();
    $Ad =& get_session("queries");
    $_d =& $Ad[DB];
    if (!$o && $_POST["clear"]) {
        $_d = array();
        redirect(remove_from_uri("history"));
    }
    page_header((isset($_GET["import"]) ? lang(73) : lang(65)), $o);
    if (!$o && $_POST) {
        $kd = false;
        if (!isset($_GET["import"]))
            $G = $_POST["query"];
        elseif ($_POST["webfile"]) {
            $Ch = $b->importServerPath();
            $kd = @fopen((file_exists($Ch) ? $Ch : "compress.zlib://$Ch.gz"), "rb");
            $G  = ($kd ? fread($kd, 1e6) : false);
        } else
            $G = get_file("sql_file", true);
        if (is_string($G)) {
            if (function_exists('memory_get_usage'))
                @ini_set("memory_limit", max(ini_bytes("memory_limit"), 2 * strlen($G) + memory_get_usage() + 8e6));
            if ($G != "" && strlen($G) < 1e6) {
                $xg = $G . (preg_match("~;[ \t\r\n]*\$~", $G) ? "" : ";");
                if (!$_d || reset(end($_d)) != $xg) {
                    restart_session();
                    $_d[] = array(
                        $xg,
                        time()
                    );
                    set_session("queries", $Ad);
                    stop_session();
                }
            }
            $_h = "(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";
            $Xb = ";";
            $D  = 0;
            $vc = true;
            $i  = connect();
            if (is_object($i) && DB != "")
                $i->select_db(DB);
            $ub = 0;
            $_c = array();
            $Tf = '[\'"' . ($y == "sql" ? '`#' : ($y == "sqlite" ? '`[' : ($y == "mssql" ? '[' : ''))) . ']|/\*|-- |$' . ($y == "pgsql" ? '|\$[^$]*\$' : '');
            $ui = microtime(true);
            parse_str($_COOKIE["adminer_export"], $ya);
            $mc = $b->dumpFormat();
            unset($mc["sql"]);
            while ($G != "") {
                if (!$D && preg_match("~^$_h*+DELIMITER\\s+(\\S+)~i", $G, $B)) {
                    $Xb = $B[1];
                    $G  = substr($G, strlen($B[0]));
                } else {
                    preg_match('(' . preg_quote($Xb) . "\\s*|$Tf)", $G, $B, PREG_OFFSET_CAPTURE, $D);
                    list($id, $hg) = $B[0];
                    if (!$id && $kd && !feof($kd))
                        $G .= fread($kd, 1e5);
                    else {
                        if (!$id && rtrim($G) == "")
                            break;
                        $D = $hg + strlen($id);
                        if ($id && rtrim($id) != $Xb) {
                            while (preg_match('(' . ($id == '/*' ? '\*/' : ($id == '[' ? ']' : (preg_match('~^-- |^#~', $id) ? "\n" : preg_quote($id) . "|\\\\."))) . '|$)s', $G, $B, PREG_OFFSET_CAPTURE, $D)) {
                                $bh = $B[0][0];
                                if (!$bh && $kd && !feof($kd))
                                    $G .= fread($kd, 1e5);
                                else {
                                    $D = $B[0][1] + strlen($bh);
                                    if ($bh[0] != "\\")
                                        break;
                                }
                            }
                        } else {
                            $vc = false;
                            $xg = substr($G, 0, $hg);
                            $ub++;
                            $pg = "<pre id='sql-$ub'><code class='jush-$y'>" . $b->sqlCommandQuery($xg) . "</code></pre>\n";
                            if ($y == "sqlite" && preg_match("~^$_h*+ATTACH\\b~i", $xg, $B)) {
                                echo $pg, "<p class='error'>" . lang(147) . "\n";
                                $_c[] = " <a href='#sql-$ub'>$ub</a>";
                                if ($_POST["error_stops"])
                                    break;
                            } else {
                                if (!$_POST["only_errors"]) {
                                    echo $pg;
                                    ob_flush();
                                    flush();
                                }
                                $Gh = microtime(true);
                                if ($h->multi_query($xg) && is_object($i) && preg_match("~^$_h*+USE\\b~i", $xg))
                                    $i->query($xg);
                                do {
                                    $H = $h->store_result();
                                    if ($h->error) {
                                        echo ($_POST["only_errors"] ? $pg : ""), "<p class='error'>" . lang(148) . ($h->errno ? " ($h->errno)" : "") . ": " . error() . "\n";
                                        $_c[] = " <a href='#sql-$ub'>$ub</a>";
                                        if ($_POST["error_stops"])
                                            break 2;
                                    } else {
                                        $ii = " <span class='time'>(" . format_time($Gh) . ")</span>" . (strlen($xg) < 1000 ? " <a href='" . h(ME) . "sql=" . urlencode(trim($xg)) . "'>" . lang(10) . "</a>" : "");
                                        $_a = $h->affected_rows;
                                        $hj = ($_POST["only_errors"] ? "" : $n->warnings());
                                        $ij = "warnings-$ub";
                                        if ($hj)
                                            $ii .= ", <a href='#$ij'>" . lang(47) . "</a>" . script("qsl('a').onclick = partial(toggle, '$ij');", "");
                                        $Hc = null;
                                        $Ic = "explain-$ub";
                                        if (is_object($H)) {
                                            $_  = $_POST["limit"];
                                            $Ff = select($H, $i, array(), $_);
                                            if (!$_POST["only_errors"]) {
                                                echo "<form action='' method='post'>\n";
                                                $jf = $H->num_rows;
                                                echo "<p>" . ($jf ? ($_ && $jf > $_ ? lang(149, $_) : "") . lang(150, $jf) : ""), $ii;
                                                if ($i && preg_match("~^($_h|\\()*+SELECT\\b~i", $xg) && ($Hc = explain($i, $xg)))
                                                    echo ", <a href='#$Ic'>Explain</a>" . script("qsl('a').onclick = partial(toggle, '$Ic');", "");
                                                $u = "export-$ub";
                                                echo ", <a href='#$u'>" . lang(74) . "</a>" . script("qsl('a').onclick = partial(toggle, '$u');", "") . "<span id='$u' class='hidden'>: " . html_select("output", $b->dumpOutput(), $ya["output"]) . " " . html_select("format", $mc, $ya["format"]) . "<input type='hidden' name='query' value='" . h($xg) . "'>" . " <input type='submit' name='export' value='" . lang(74) . "'><input type='hidden' name='token' value='$si'></span>\n" . "</form>\n";
                                            }
                                        } else {
                                            if (preg_match("~^$_h*+(CREATE|DROP|ALTER)$_h++(DATABASE|SCHEMA)\\b~i", $xg)) {
                                                restart_session();
                                                set_session("dbs", null);
                                                stop_session();
                                            }
                                            if (!$_POST["only_errors"])
                                                echo "<p class='message' title='" . h($h->info) . "'>" . lang(151, $_a) . "$ii\n";
                                        }
                                        echo ($hj ? "<div id='$ij' class='hidden'>\n$hj</div>\n" : "");
                                        if ($Hc) {
                                            echo "<div id='$Ic' class='hidden'>\n";
                                            select($Hc, $i, $Ff);
                                            echo "</div>\n";
                                        }
                                    }
                                    $Gh = microtime(true);
                                } while ($h->next_result());
                            }
                            $G = substr($G, $D);
                            $D = 0;
                        }
                    }
                }
            }
            if ($vc)
                echo "<p class='message'>" . lang(152) . "\n";
            elseif ($_POST["only_errors"]) {
                echo "<p class='message'>" . lang(153, $ub - count($_c)), " <span class='time'>(" . format_time($ui) . ")</span>\n";
            } elseif ($_c && $ub > 1)
                echo "<p class='error'>" . lang(148) . ": " . implode("", $_c) . "\n";
        } else
            echo "<p class='error'>" . upload_error($G) . "\n";
    }
    echo '
<form action="" method="post" enctype="multipart/form-data" id="form">
';
    $Ec = "<input type='submit' value='" . lang(154) . "' title='Ctrl+Enter'>";
    if (!isset($_GET["import"])) {
        $xg = $_GET["sql"];
        if ($_POST)
            $xg = $_POST["query"];
        elseif ($_GET["history"] == "all")
            $xg = $_d;
        elseif ($_GET["history"] != "")
            $xg = $_d[$_GET["history"]][0];
        echo "<p>";
        textarea("query", $xg, 20);
        echo script(($_POST ? "" : "qs('textarea').focus();\n") . "qs('#form').onsubmit = partial(sqlSubmit, qs('#form'), '" . remove_from_uri("sql|limit|error_stops|only_errors") . "');"), "<p>$Ec\n", lang(155) . ": <input type='number' name='limit' class='size' value='" . h($_POST ? $_POST["limit"] : $_GET["limit"]) . "'>\n";
    } else {
        echo "<fieldset><legend>" . lang(156) . "</legend><div>";
        $td = (extension_loaded("zlib") ? "[.gz]" : "");
        echo (ini_bool("file_uploads") ? "SQL$td (&lt; " . ini_get("upload_max_filesize") . "B): <input type='file' name='sql_file[]' multiple>\n$Ec" : lang(157)), "</div></fieldset>\n";
        $Id = $b->importServerPath();
        if ($Id) {
            echo "<fieldset><legend>" . lang(158) . "</legend><div>", lang(159, "<code>" . h($Id) . "$td</code>"), ' <input type="submit" name="webfile" value="' . lang(160) . '">', "</div></fieldset>\n";
        }
        echo "<p>";
    }
    echo checkbox("error_stops", 1, ($_POST ? $_POST["error_stops"] : isset($_GET["import"])), lang(161)) . "\n", checkbox("only_errors", 1, ($_POST ? $_POST["only_errors"] : isset($_GET["import"])), lang(162)) . "\n", "<input type='hidden' name='token' value='$si'>\n";
    if (!isset($_GET["import"]) && $_d) {
        print_fieldset("history", lang(163), $_GET["history"] != "");
        for ($X = end($_d); $X; $X = prev($_d)) {
            $z = key($_d);
            list($xg, $ii, $qc) = $X;
            echo '<a href="' . h(ME . "sql=&history=$z") . '">' . lang(10) . "</a>" . " <span class='time' title='" . @date('Y-m-d', $ii) . "'>" . @date("H:i:s", $ii) . "</span>" . " <code class='jush-$y'>" . shorten_utf8(ltrim(str_replace("\n", " ", str_replace("\r", "", preg_replace('~^(#|-- ).*~m', '', $xg)))), 80, "</code>") . ($qc ? " <span class='time'>($qc)</span>" : "") . "<br>\n";
        }
        echo "<input type='submit' name='clear' value='" . lang(164) . "'>\n", "<a href='" . h(ME . "sql=&history=all") . "'>" . lang(165) . "</a>\n", "</div></fieldset>\n";
    }
    echo '</form>
';
} elseif (isset($_GET["edit"])) {
    $a  = $_GET["edit"];
    $q  = fields($a);
    $Z  = (isset($_GET["select"]) ? ($_POST["check"] && count($_POST["check"]) == 1 ? where_check($_POST["check"][0], $q) : "") : where($_GET, $q));
    $Ni = (isset($_GET["select"]) ? $_POST["edit"] : $Z);
    foreach ($q as $C => $p) {
        if (!isset($p["privileges"][$Ni ? "update" : "insert"]) || $b->fieldName($p) == "" || $p["generated"])
            unset($q[$C]);
    }
    if ($_POST && !$o && !isset($_GET["select"])) {
        $_e = $_POST["referer"];
        if ($_POST["insert"])
            $_e = ($Ni ? null : $_SERVER["REQUEST_URI"]);
        elseif (!preg_match('~^.+&select=.+$~', $_e))
            $_e = ME . "select=" . urlencode($a);
        $x  = indexes($a);
        $Ii = unique_array($_GET["where"], $x);
        $_g = "\nWHERE $Z";
        if (isset($_POST["delete"]))
            queries_redirect($_e, lang(166), $n->delete($a, $_g, !$Ii));
        else {
            $O = array();
            foreach ($q as $C => $p) {
                $X = process_input($p);
                if ($X !== false && $X !== null)
                    $O[idf_escape($C)] = $X;
            }
            if ($Ni) {
                if (!$O)
                    redirect($_e);
                queries_redirect($_e, lang(167), $n->update($a, $O, $_g, !$Ii));
                if (is_ajax()) {
                    page_headers();
                    page_messages($o);
                    exit;
                }
            } else {
                $H  = $n->insert($a, $O);
                $re = ($H ? last_id() : 0);
                queries_redirect($_e, lang(168, ($re ? " $re" : "")), $H);
            }
        }
    }
    $J = null;
    if ($_POST["save"])
        $J = (array) $_POST["fields"];
    elseif ($Z) {
        $L = array();
        foreach ($q as $C => $p) {
            if (isset($p["privileges"]["select"])) {
                $Ha = convert_field($p);
                if ($_POST["clone"] && $p["auto_increment"])
                    $Ha = "''";
                if ($y == "sql" && preg_match("~enum|set~", $p["type"]))
                    $Ha = "1*" . idf_escape($C);
                $L[] = ($Ha ? "$Ha AS " : "") . idf_escape($C);
            }
        }
        $J = array();
        if (!support("table"))
            $L = array(
                "*"
            );
        if ($L) {
            $H = $n->select($a, $L, array(
                $Z
            ), $L, array(), (isset($_GET["select"]) ? 2 : 1));
            if (!$H)
                $o = error();
            else {
                $J = $H->fetch_assoc();
                if (!$J)
                    $J = false;
            }
            if (isset($_GET["select"]) && (!$J || $H->fetch_assoc()))
                $J = null;
        }
    }
    if (!support("table") && !$q) {
        if (!$Z) {
            $H = $n->select($a, array(
                "*"
            ), $Z, array(
                "*"
            ));
            $J = ($H ? $H->fetch_assoc() : false);
            if (!$J)
                $J = array(
                    $n->primary => ""
                );
        }
        if ($J) {
            foreach ($J as $z => $X) {
                if (!$Z)
                    $J[$z] = null;
                $q[$z] = array(
                    "field" => $z,
                    "null" => ($z != $n->primary),
                    "auto_increment" => ($z == $n->primary)
                );
            }
        }
    }
    edit_form($a, $q, $J, $Ni);
} elseif (isset($_GET["create"])) {
    $a  = $_GET["create"];
    $Vf = array();
    foreach (array(
        'HASH',
        'LINEAR HASH',
        'KEY',
        'LINEAR KEY',
        'RANGE',
        'LIST'
    ) as $z)
        $Vf[$z] = $z;
    $Hg = referencable_primary($a);
    $gd = array();
    foreach ($Hg as $Th => $p)
        $gd[str_replace("`", "``", $Th) . "`" . str_replace("`", "``", $p["field"])] = $Th;
    $If = array();
    $R  = array();
    if ($a != "") {
        $If = fields($a);
        $R  = table_status($a);
        if (!$R)
            $o = lang(9);
    }
    $J           = $_POST;
    $J["fields"] = (array) $J["fields"];
    if ($J["auto_increment_col"])
        $J["fields"][$J["auto_increment_col"]]["auto_increment"] = true;
    if ($_POST)
        set_adminer_settings(array(
            "comments" => $_POST["comments"],
            "defaults" => $_POST["defaults"]
        ));
    if ($_POST && !process_fields($J["fields"]) && !$o) {
        if ($_POST["drop"])
            queries_redirect(substr(ME, 0, -1), lang(169), drop_tables(array(
                $a
            )));
        else {
            $q  = array();
            $Ea = array();
            $Si = false;
            $ed = array();
            $Hf = reset($If);
            $Ba = " FIRST";
            foreach ($J["fields"] as $z => $p) {
                $r  = $gd[$p["type"]];
                $Ei = ($r !== null ? $Hg[$r] : $p);
                if ($p["field"] != "") {
                    if (!$p["has_default"])
                        $p["default"] = null;
                    if ($z == $J["auto_increment_col"])
                        $p["auto_increment"] = true;
                    $ug   = process_field($p, $Ei);
                    $Ea[] = array(
                        $p["orig"],
                        $ug,
                        $Ba
                    );
                    if ($ug != process_field($Hf, $Hf)) {
                        $q[] = array(
                            $p["orig"],
                            $ug,
                            $Ba
                        );
                        if ($p["orig"] != "" || $Ba)
                            $Si = true;
                    }
                    if ($r !== null)
                        $ed[idf_escape($p["field"])] = ($a != "" && $y != "sqlite" ? "ADD" : " ") . format_foreign_key(array(
                            'table' => $gd[$p["type"]],
                            'source' => array(
                                $p["field"]
                            ),
                            'target' => array(
                                $Ei["field"]
                            ),
                            'on_delete' => $p["on_delete"]
                        ));
                    $Ba = " AFTER " . idf_escape($p["field"]);
                } elseif ($p["orig"] != "") {
                    $Si  = true;
                    $q[] = array(
                        $p["orig"]
                    );
                }
                if ($p["orig"] != "") {
                    $Hf = next($If);
                    if (!$Hf)
                        $Ba = "";
                }
            }
            $Xf = "";
            if ($Vf[$J["partition_by"]]) {
                $Yf = array();
                if ($J["partition_by"] == 'RANGE' || $J["partition_by"] == 'LIST') {
                    foreach (array_filter($J["partition_names"]) as $z => $X) {
                        $Y    = $J["partition_values"][$z];
                        $Yf[] = "\n  PARTITION " . idf_escape($X) . " VALUES " . ($J["partition_by"] == 'RANGE' ? "LESS THAN" : "IN") . ($Y != "" ? " ($Y)" : " MAXVALUE");
                    }
                }
                $Xf .= "\nPARTITION BY $J[partition_by]($J[partition])" . ($Yf ? " (" . implode(",", $Yf) . "\n)" : ($J["partitions"] ? " PARTITIONS " . (+$J["partitions"]) : ""));
            } elseif (support("partitioning") && preg_match("~partitioned~", $R["Create_options"]))
                $Xf .= "\nREMOVE PARTITIONING";
            $Oe = lang(170);
            if ($a == "") {
                cookie("adminer_engine", $J["Engine"]);
                $Oe = lang(171);
            }
            $C = trim($J["name"]);
            queries_redirect(ME . (support("table") ? "table=" : "select=") . urlencode($C), $Oe, alter_table($a, $C, ($y == "sqlite" && ($Si || $ed) ? $Ea : $q), $ed, ($J["Comment"] != $R["Comment"] ? $J["Comment"] : null), ($J["Engine"] && $J["Engine"] != $R["Engine"] ? $J["Engine"] : ""), ($J["Collation"] && $J["Collation"] != $R["Collation"] ? $J["Collation"] : ""), ($J["Auto_increment"] != "" ? number($J["Auto_increment"]) : ""), $Xf));
        }
    }
    page_header(($a != "" ? lang(45) : lang(75)), $o, array(
        "table" => $a
    ), h($a));
    if (!$_POST) {
        $J = array(
            "Engine" => $_COOKIE["adminer_engine"],
            "fields" => array(
                array(
                    "field" => "",
                    "type" => (isset($U["int"]) ? "int" : (isset($U["integer"]) ? "integer" : "")),
                    "on_update" => ""
                )
            ),
            "partition_names" => array(
                ""
            )
        );
        if ($a != "") {
            $J           = $R;
            $J["name"]   = $a;
            $J["fields"] = array();
            if (!$_GET["auto_increment"])
                $J["Auto_increment"] = "";
            foreach ($If as $p) {
                $p["has_default"] = isset($p["default"]);
                $J["fields"][]    = $p;
            }
            if (support("partitioning")) {
                $ld = "FROM information_schema.PARTITIONS WHERE TABLE_SCHEMA = " . q(DB) . " AND TABLE_NAME = " . q($a);
                $H  = $h->query("SELECT PARTITION_METHOD, PARTITION_ORDINAL_POSITION, PARTITION_EXPRESSION $ld ORDER BY PARTITION_ORDINAL_POSITION DESC LIMIT 1");
                list($J["partition_by"], $J["partitions"], $J["partition"]) = $H->fetch_row();
                $Yf                    = get_key_vals("SELECT PARTITION_NAME, PARTITION_DESCRIPTION $ld AND PARTITION_NAME != '' ORDER BY PARTITION_ORDINAL_POSITION");
                $Yf[""]                = "";
                $J["partition_names"]  = array_keys($Yf);
                $J["partition_values"] = array_values($Yf);
            }
        }
    }
    $qb = collations();
    $xc = engines();
    foreach ($xc as $wc) {
        if (!strcasecmp($wc, $J["Engine"])) {
            $J["Engine"] = $wc;
            break;
        }
    }
    echo '
<form action="" method="post" id="form">
<p>
';
    if (support("columns") || $a == "") {
        echo lang(172), ': <input name="name" data-maxlength="64" value="', h($J["name"]), '" autocapitalize="off">
';
        if ($a == "" && !$_POST)
            echo script("focus(qs('#form')['name']);");
        echo ($xc ? "<select name='Engine'>" . optionlist(array(
            "" => "(" . lang(173) . ")"
        ) + $xc, $J["Engine"]) . "</select>" . on_help("getTarget(event).value", 1) . script("qsl('select').onchange = helpClose;") : ""), ' ', ($qb && !preg_match("~sqlite|mssql~", $y) ? html_select("Collation", array(
            "" => "(" . lang(101) . ")"
        ) + $qb, $J["Collation"]) : ""), ' <input type="submit" value="', lang(14), '">
';
    }
    echo '
';
    if (support("columns")) {
        echo '<div class="scrollable">
<table cellspacing="0" id="edit-fields" class="nowrap">
';
        edit_fields($J["fields"], $qb, "TABLE", $gd);
        echo '</table>
</div>
<p>
', lang(52), ': <input type="number" name="Auto_increment" size="6" value="', h($J["Auto_increment"]), '">
', checkbox("defaults", 1, ($_POST ? $_POST["defaults"] : adminer_setting("defaults")), lang(174), "columnShow(this.checked, 5)", "jsonly"), (support("comment") ? checkbox("comments", 1, ($_POST ? $_POST["comments"] : adminer_setting("comments")), lang(51), "editingCommentsClick(this, true);", "jsonly") . ' <input name="Comment" value="' . h($J["Comment"]) . '" data-maxlength="' . (min_version(5.5) ? 2048 : 60) . '">' : ''), '<p>
<input type="submit" value="', lang(14), '">
';
    }
    echo '
';
    if ($a != "") {
        echo '<input type="submit" name="drop" value="', lang(127), '">', confirm(lang(175, $a));
    }
    if (support("partitioning")) {
        $Wf = preg_match('~RANGE|LIST~', $J["partition_by"]);
        print_fieldset("partition", lang(176), $J["partition_by"]);
        echo '<p>
', "<select name='partition_by'>" . optionlist(array(
            "" => ""
        ) + $Vf, $J["partition_by"]) . "</select>" . on_help("getTarget(event).value.replace(/./, 'PARTITION BY \$&')", 1) . script("qsl('select').onchange = partitionByChange;"), '(<input name="partition" value="', h($J["partition"]), '">)
', lang(177), ': <input type="number" name="partitions" class="size', ($Wf || !$J["partition_by"] ? " hidden" : ""), '" value="', h($J["partitions"]), '">
<table cellspacing="0" id="partition-table"', ($Wf ? "" : " class='hidden'"), '>
<thead><tr><th>', lang(178), '<th>', lang(179), '</thead>
';
        foreach ($J["partition_names"] as $z => $X) {
            echo '<tr>', '<td><input name="partition_names[]" value="' . h($X) . '" autocapitalize="off">', ($z == count($J["partition_names"]) - 1 ? script("qsl('input').oninput = partitionNameChange;") : ''), '<td><input name="partition_values[]" value="' . h($J["partition_values"][$z]) . '">';
        }
        echo '</table>
</div></fieldset>
';
    }
    echo '<input type="hidden" name="token" value="', $si, '">
</form>
', script("qs('#form')['defaults'].onclick();" . (support("comment") ? " editingCommentsClick(qs('#form')['comments']);" : ""));
} elseif (isset($_GET["indexes"])) {
    $a  = $_GET["indexes"];
    $Ld = array(
        "PRIMARY",
        "UNIQUE",
        "INDEX"
    );
    $R  = table_status($a, true);
    if (preg_match('~MyISAM|M?aria' . (min_version(5.6, '10.0.5') ? '|InnoDB' : '') . '~i', $R["Engine"]))
        $Ld[] = "FULLTEXT";
    if (preg_match('~MyISAM|M?aria' . (min_version(5.7, '10.2.2') ? '|InnoDB' : '') . '~i', $R["Engine"]))
        $Ld[] = "SPATIAL";
    $x  = indexes($a);
    $ng = array();
    if ($y == "mongo") {
        $ng = $x["_id_"];
        unset($Ld[0]);
        unset($x["_id_"]);
    }
    $J = $_POST;
    if ($_POST && !$o && !$_POST["add"] && !$_POST["drop_col"]) {
        $c = array();
        foreach ($J["indexes"] as $w) {
            $C = $w["name"];
            if (in_array($w["type"], $Ld)) {
                $f  = array();
                $xe = array();
                $Zb = array();
                $O  = array();
                ksort($w["columns"]);
                foreach ($w["columns"] as $z => $e) {
                    if ($e != "") {
                        $we   = $w["lengths"][$z];
                        $Yb   = $w["descs"][$z];
                        $O[]  = idf_escape($e) . ($we ? "(" . (+$we) . ")" : "") . ($Yb ? " DESC" : "");
                        $f[]  = $e;
                        $xe[] = ($we ? $we : null);
                        $Zb[] = $Yb;
                    }
                }
                if ($f) {
                    $Fc = $x[$C];
                    if ($Fc) {
                        ksort($Fc["columns"]);
                        ksort($Fc["lengths"]);
                        ksort($Fc["descs"]);
                        if ($w["type"] == $Fc["type"] && array_values($Fc["columns"]) === $f && (!$Fc["lengths"] || array_values($Fc["lengths"]) === $xe) && array_values($Fc["descs"]) === $Zb) {
                            unset($x[$C]);
                            continue;
                        }
                    }
                    $c[] = array(
                        $w["type"],
                        $C,
                        $O
                    );
                }
            }
        }
        foreach ($x as $C => $Fc)
            $c[] = array(
                $Fc["type"],
                $C,
                "DROP"
            );
        if (!$c)
            redirect(ME . "table=" . urlencode($a));
        queries_redirect(ME . "table=" . urlencode($a), lang(180), alter_indexes($a, $c));
    }
    page_header(lang(132), $o, array(
        "table" => $a
    ), h($a));
    $q = array_keys(fields($a));
    if ($_POST["add"]) {
        foreach ($J["indexes"] as $z => $w) {
            if ($w["columns"][count($w["columns"])] != "")
                $J["indexes"][$z]["columns"][] = "";
        }
        $w = end($J["indexes"]);
        if ($w["type"] || array_filter($w["columns"], 'strlen'))
            $J["indexes"][] = array(
                "columns" => array(
                    1 => ""
                )
            );
    }
    if (!$J) {
        foreach ($x as $z => $w) {
            $x[$z]["name"]      = $z;
            $x[$z]["columns"][] = "";
        }
        $x[]          = array(
            "columns" => array(
                1 => ""
            )
        );
        $J["indexes"] = $x;
    }
    echo '
<form action="" method="post">
<div class="scrollable">
<table cellspacing="0" class="nowrap">
<thead><tr>
<th id="label-type">', lang(181), '<th><input type="submit" class="wayoff">', lang(182), '<th id="label-name">', lang(183), '<th><noscript>', "<input type='image' class='icon' name='add[0]' src='" . h(preg_replace("~\\?.*~", "", ME) . "?file=plus.gif&version=4.7.3") . "' alt='+' title='" . lang(108) . "'>", '</noscript>
</thead>
';
    if ($ng) {
        echo "<tr><td>PRIMARY<td>";
        foreach ($ng["columns"] as $z => $e) {
            echo select_input(" disabled", $q, $e), "<label><input disabled type='checkbox'>" . lang(60) . "</label> ";
        }
        echo "<td><td>\n";
    }
    $ee = 1;
    foreach ($J["indexes"] as $w) {
        if (!$_POST["drop_col"] || $ee != key($_POST["drop_col"])) {
            echo "<tr><td>" . html_select("indexes[$ee][type]", array(
                -1 => ""
            ) + $Ld, $w["type"], ($ee == count($J["indexes"]) ? "indexesAddRow.call(this);" : 1), "label-type"), "<td>";
            ksort($w["columns"]);
            $t = 1;
            foreach ($w["columns"] as $z => $e) {
                echo "<span>" . select_input(" name='indexes[$ee][columns][$t]' title='" . lang(49) . "'", ($q ? array_combine($q, $q) : $q), $e, "partial(" . ($t == count($w["columns"]) ? "indexesAddColumn" : "indexesChangeColumn") . ", '" . js_escape($y == "sql" ? "" : $_GET["indexes"] . "_") . "')"), ($y == "sql" || $y == "mssql" ? "<input type='number' name='indexes[$ee][lengths][$t]' class='size' value='" . h($w["lengths"][$z]) . "' title='" . lang(106) . "'>" : ""), (support("descidx") ? checkbox("indexes[$ee][descs][$t]", 1, $w["descs"][$z], lang(60)) : ""), " </span>";
                $t++;
            }
            echo "<td><input name='indexes[$ee][name]' value='" . h($w["name"]) . "' autocapitalize='off' aria-labelledby='label-name'>\n", "<td><input type='image' class='icon' name='drop_col[$ee]' src='" . h(preg_replace("~\\?.*~", "", ME) . "?file=cross.gif&version=4.7.3") . "' alt='x' title='" . lang(111) . "'>" . script("qsl('input').onclick = partial(editingRemoveRow, 'indexes\$1[type]');");
        }
        $ee++;
    }
    echo '</table>
</div>
<p>
<input type="submit" value="', lang(14), '">
<input type="hidden" name="token" value="', $si, '">
</form>
';
} elseif (isset($_GET["database"])) {
    $J = $_POST;
    if ($_POST && !$o && !isset($_POST["add_x"])) {
        $C = trim($J["name"]);
        if ($_POST["drop"]) {
            $_GET["db"] = "";
            queries_redirect(remove_from_uri("db|database"), lang(184), drop_databases(array(
                DB
            )));
        } elseif (DB !== $C) {
            if (DB != "") {
                $_GET["db"] = $C;
                queries_redirect(preg_replace('~\bdb=[^&]*&~', '', ME) . "db=" . urlencode($C), lang(185), rename_database($C, $J["collation"]));
            } else {
                $l  = explode("\n", str_replace("\r", "", $C));
                $Nh = true;
                $qe = "";
                foreach ($l as $m) {
                    if (count($l) == 1 || $m != "") {
                        if (!create_database($m, $J["collation"]))
                            $Nh = false;
                        $qe = $m;
                    }
                }
                restart_session();
                set_session("dbs", null);
                queries_redirect(ME . "db=" . urlencode($qe), lang(186), $Nh);
            }
        } else {
            if (!$J["collation"])
                redirect(substr(ME, 0, -1));
            query_redirect("ALTER DATABASE " . idf_escape($C) . (preg_match('~^[a-z0-9_]+$~i', $J["collation"]) ? " COLLATE $J[collation]" : ""), substr(ME, 0, -1), lang(187));
        }
    }
    page_header(DB != "" ? lang(68) : lang(115), $o, array(), h(DB));
    $qb = collations();
    $C  = DB;
    if ($_POST)
        $C = $J["name"];
    elseif (DB != "")
        $J["collation"] = db_collation(DB, $qb);
    elseif ($y == "sql") {
        foreach (get_vals("SHOW GRANTS") as $nd) {
            if (preg_match('~ ON (`(([^\\\\`]|``|\\\\.)*)%`\.\*)?~', $nd, $B) && $B[1]) {
                $C = stripcslashes(idf_unescape("`$B[2]`"));
                break;
            }
        }
    }
    echo '
<form action="" method="post">
<p>
', ($_POST["add_x"] || strpos($C, "\n") ? '<textarea id="name" name="name" rows="10" cols="40">' . h($C) . '</textarea><br>' : '<input name="name" id="name" value="' . h($C) . '" data-maxlength="64" autocapitalize="off">') . "\n" . ($qb ? html_select("collation", array(
        "" => "(" . lang(101) . ")"
    ) + $qb, $J["collation"]) . doc_link(array(
        'sql' => "charset-charsets.html",
        'mariadb' => "supported-character-sets-and-collations/",
        'mssql' => "ms187963.aspx"
    )) : ""), script("focus(qs('#name'));"), '<input type="submit" value="', lang(14), '">
';
    if (DB != "")
        echo "<input type='submit' name='drop' value='" . lang(127) . "'>" . confirm(lang(175, DB)) . "\n";
    elseif (!$_POST["add_x"] && $_GET["db"] == "")
        echo "<input type='image' class='icon' name='add' src='" . h(preg_replace("~\\?.*~", "", ME) . "?file=plus.gif&version=4.7.3") . "' alt='+' title='" . lang(108) . "'>\n";
    echo '<input type="hidden" name="token" value="', $si, '">
</form>
';
} elseif (isset($_GET["scheme"])) {
    $J = $_POST;
    if ($_POST && !$o) {
        $A = preg_replace('~ns=[^&]*&~', '', ME) . "ns=";
        if ($_POST["drop"])
            query_redirect("DROP SCHEMA " . idf_escape($_GET["ns"]), $A, lang(188));
        else {
            $C = trim($J["name"]);
            $A .= urlencode($C);
            if ($_GET["ns"] == "")
                query_redirect("CREATE SCHEMA " . idf_escape($C), $A, lang(189));
            elseif ($_GET["ns"] != $C)
                query_redirect("ALTER SCHEMA " . idf_escape($_GET["ns"]) . " RENAME TO " . idf_escape($C), $A, lang(190));
            else
                redirect($A);
        }
    }
    page_header($_GET["ns"] != "" ? lang(69) : lang(70), $o);
    if (!$J)
        $J["name"] = $_GET["ns"];
    echo '
<form action="" method="post">
<p><input name="name" id="name" value="', h($J["name"]), '" autocapitalize="off">
', script("focus(qs('#name'));"), '<input type="submit" value="', lang(14), '">
';
    if ($_GET["ns"] != "")
        echo "<input type='submit' name='drop' value='" . lang(127) . "'>" . confirm(lang(175, $_GET["ns"])) . "\n";
    echo '<input type="hidden" name="token" value="', $si, '">
</form>
';
} elseif (isset($_GET["call"])) {
    $da = ($_GET["name"] ? $_GET["name"] : $_GET["call"]);
    page_header(lang(191) . ": " . h($da), $o);
    $Xg = routine($_GET["call"], (isset($_GET["callf"]) ? "FUNCTION" : "PROCEDURE"));
    $Jd = array();
    $Mf = array();
    foreach ($Xg["fields"] as $t => $p) {
        if (substr($p["inout"], -3) == "OUT")
            $Mf[$t] = "@" . idf_escape($p["field"]) . " AS " . idf_escape($p["field"]);
        if (!$p["inout"] || substr($p["inout"], 0, 2) == "IN")
            $Jd[] = $t;
    }
    if (!$o && $_POST) {
        $bb = array();
        foreach ($Xg["fields"] as $z => $p) {
            if (in_array($z, $Jd)) {
                $X = process_input($p);
                if ($X === false)
                    $X = "''";
                if (isset($Mf[$z]))
                    $h->query("SET @" . idf_escape($p["field"]) . " = $X");
            }
            $bb[] = (isset($Mf[$z]) ? "@" . idf_escape($p["field"]) : $X);
        }
        $G  = (isset($_GET["callf"]) ? "SELECT" : "CALL") . " " . table($da) . "(" . implode(", ", $bb) . ")";
        $Gh = microtime(true);
        $H  = $h->multi_query($G);
        $_a = $h->affected_rows;
        echo $b->selectQuery($G, $Gh, !$H);
        if (!$H)
            echo "<p class='error'>" . error() . "\n";
        else {
            $i = connect();
            if (is_object($i))
                $i->select_db(DB);
            do {
                $H = $h->store_result();
                if (is_object($H))
                    select($H, $i);
                else
                    echo "<p class='message'>" . lang(192, $_a) . "\n";
            } while ($h->next_result());
            if ($Mf)
                select($h->query("SELECT " . implode(", ", $Mf)));
        }
    }
    echo '
<form action="" method="post">
';
    if ($Jd) {
        echo "<table cellspacing='0' class='layout'>\n";
        foreach ($Jd as $z) {
            $p = $Xg["fields"][$z];
            $C = $p["field"];
            echo "<tr><th>" . $b->fieldName($p);
            $Y = $_POST["fields"][$C];
            if ($Y != "") {
                if ($p["type"] == "enum")
                    $Y = +$Y;
                if ($p["type"] == "set")
                    $Y = array_sum($Y);
            }
            input($p, $Y, (string) $_POST["function"][$C]);
            echo "\n";
        }
        echo "</table>\n";
    }
    echo '<p>
<input type="submit" value="', lang(191), '">
<input type="hidden" name="token" value="', $si, '">
</form>
';
} elseif (isset($_GET["foreign"])) {
    $a = $_GET["foreign"];
    $C = $_GET["name"];
    $J = $_POST;
    if ($_POST && !$o && !$_POST["add"] && !$_POST["change"] && !$_POST["change-js"]) {
        $Oe = ($_POST["drop"] ? lang(193) : ($C != "" ? lang(194) : lang(195)));
        $_e = ME . "table=" . urlencode($a);
        if (!$_POST["drop"]) {
            $J["source"] = array_filter($J["source"], 'strlen');
            ksort($J["source"]);
            $bi = array();
            foreach ($J["source"] as $z => $X)
                $bi[$z] = $J["target"][$z];
            $J["target"] = $bi;
        }
        if ($y == "sqlite")
            queries_redirect($_e, $Oe, recreate_table($a, $a, array(), array(), array(
                " $C" => ($_POST["drop"] ? "" : " " . format_foreign_key($J))
            )));
        else {
            $c  = "ALTER TABLE " . table($a);
            $hc = "\nDROP " . ($y == "sql" ? "FOREIGN KEY " : "CONSTRAINT ") . idf_escape($C);
            if ($_POST["drop"])
                query_redirect($c . $hc, $_e, $Oe);
            else {
                query_redirect($c . ($C != "" ? "$hc," : "") . "\nADD" . format_foreign_key($J), $_e, $Oe);
                $o = lang(196) . "<br>$o";
            }
        }
    }
    page_header(lang(197), $o, array(
        "table" => $a
    ), h($a));
    if ($_POST) {
        ksort($J["source"]);
        if ($_POST["add"])
            $J["source"][] = "";
        elseif ($_POST["change"] || $_POST["change-js"])
            $J["target"] = array();
    } elseif ($C != "") {
        $gd            = foreign_keys($a);
        $J             = $gd[$C];
        $J["source"][] = "";
    } else {
        $J["table"]  = $a;
        $J["source"] = array(
            ""
        );
    }
    echo '
<form action="" method="post">
';
    $zh = array_keys(fields($a));
    if ($J["db"] != "")
        $h->select_db($J["db"]);
    if ($J["ns"] != "")
        set_schema($J["ns"]);
    $Gg = array_keys(array_filter(table_status('', true), 'fk_support'));
    $bi = ($a === $J["table"] ? $zh : array_keys(fields(in_array($J["table"], $Gg) ? $J["table"] : reset($Gg))));
    $uf = "this.form['change-js'].value = '1'; this.form.submit();";
    echo "<p>" . lang(198) . ": " . html_select("table", $Gg, $J["table"], $uf) . "\n";
    if ($y == "pgsql")
        echo lang(78) . ": " . html_select("ns", $b->schemas(), $J["ns"] != "" ? $J["ns"] : $_GET["ns"], $uf);
    elseif ($y != "sqlite") {
        $Sb = array();
        foreach ($b->databases() as $m) {
            if (!information_schema($m))
                $Sb[] = $m;
        }
        echo lang(77) . ": " . html_select("db", $Sb, $J["db"] != "" ? $J["db"] : $_GET["db"], $uf);
    }
    echo '<input type="hidden" name="change-js" value="">
<noscript><p><input type="submit" name="change" value="', lang(199), '"></noscript>
<table cellspacing="0">
<thead><tr><th id="label-source">', lang(134), '<th id="label-target">', lang(135), '</thead>
';
    $ee = 0;
    foreach ($J["source"] as $z => $X) {
        echo "<tr>", "<td>" . html_select("source[" . (+$z) . "]", array(
            -1 => ""
        ) + $zh, $X, ($ee == count($J["source"]) - 1 ? "foreignAddRow.call(this);" : 1), "label-source"), "<td>" . html_select("target[" . (+$z) . "]", $bi, $J["target"][$z], 1, "label-target");
        $ee++;
    }
    echo '</table>
<p>
', lang(103), ': ', html_select("on_delete", array(
        -1 => ""
    ) + explode("|", $tf), $J["on_delete"]), ' ', lang(102), ': ', html_select("on_update", array(
        -1 => ""
    ) + explode("|", $tf), $J["on_update"]), doc_link(array(
        'sql' => "innodb-foreign-key-constraints.html",
        'mariadb' => "foreign-keys/",
        'pgsql' => "sql-createtable.html#SQL-CREATETABLE-REFERENCES",
        'mssql' => "ms174979.aspx",
        'oracle' => "clauses002.htm#sthref2903"
    )), '<p>
<input type="submit" value="', lang(14), '">
<noscript><p><input type="submit" name="add" value="', lang(200), '"></noscript>
';
    if ($C != "") {
        echo '<input type="submit" name="drop" value="', lang(127), '">', confirm(lang(175, $C));
    }
    echo '<input type="hidden" name="token" value="', $si, '">
</form>
';
} elseif (isset($_GET["view"])) {
    $a  = $_GET["view"];
    $J  = $_POST;
    $Jf = "VIEW";
    if ($y == "pgsql" && $a != "") {
        $Ih = table_status($a);
        $Jf = strtoupper($Ih["Engine"]);
    }
    if ($_POST && !$o) {
        $C  = trim($J["name"]);
        $Ha = " AS\n$J[select]";
        $_e = ME . "table=" . urlencode($C);
        $Oe = lang(201);
        $T  = ($_POST["materialized"] ? "MATERIALIZED VIEW" : "VIEW");
        if (!$_POST["drop"] && $a == $C && $y != "sqlite" && $T == "VIEW" && $Jf == "VIEW")
            query_redirect(($y == "mssql" ? "ALTER" : "CREATE OR REPLACE") . " VIEW " . table($C) . $Ha, $_e, $Oe);
        else {
            $di = $C . "_adminer_" . uniqid();
            drop_create("DROP $Jf " . table($a), "CREATE $T " . table($C) . $Ha, "DROP $T " . table($C), "CREATE $T " . table($di) . $Ha, "DROP $T " . table($di), ($_POST["drop"] ? substr(ME, 0, -1) : $_e), lang(202), $Oe, lang(203), $a, $C);
        }
    }
    if (!$_POST && $a != "") {
        $J                 = view($a);
        $J["name"]         = $a;
        $J["materialized"] = ($Jf != "VIEW");
        if (!$o)
            $o = error();
    }
    page_header(($a != "" ? lang(44) : lang(204)), $o, array(
        "table" => $a
    ), h($a));
    echo '
<form action="" method="post">
<p>', lang(183), ': <input name="name" value="', h($J["name"]), '" data-maxlength="64" autocapitalize="off">
', (support("materializedview") ? " " . checkbox("materialized", 1, $J["materialized"], lang(129)) : ""), '<p>';
    textarea("select", $J["select"]);
    echo '<p>
<input type="submit" value="', lang(14), '">
';
    if ($a != "") {
        echo '<input type="submit" name="drop" value="', lang(127), '">', confirm(lang(175, $a));
    }
    echo '<input type="hidden" name="token" value="', $si, '">
</form>
';
} elseif (isset($_GET["event"])) {
    $aa = $_GET["event"];
    $Wd = array(
        "YEAR",
        "QUARTER",
        "MONTH",
        "DAY",
        "HOUR",
        "MINUTE",
        "WEEK",
        "SECOND",
        "YEAR_MONTH",
        "DAY_HOUR",
        "DAY_MINUTE",
        "DAY_SECOND",
        "HOUR_MINUTE",
        "HOUR_SECOND",
        "MINUTE_SECOND"
    );
    $Jh = array(
        "ENABLED" => "ENABLE",
        "DISABLED" => "DISABLE",
        "SLAVESIDE_DISABLED" => "DISABLE ON SLAVE"
    );
    $J  = $_POST;
    if ($_POST && !$o) {
        if ($_POST["drop"])
            query_redirect("DROP EVENT " . idf_escape($aa), substr(ME, 0, -1), lang(205));
        elseif (in_array($J["INTERVAL_FIELD"], $Wd) && isset($Jh[$J["STATUS"]])) {
            $ch = "\nON SCHEDULE " . ($J["INTERVAL_VALUE"] ? "EVERY " . q($J["INTERVAL_VALUE"]) . " $J[INTERVAL_FIELD]" . ($J["STARTS"] ? " STARTS " . q($J["STARTS"]) : "") . ($J["ENDS"] ? " ENDS " . q($J["ENDS"]) : "") : "AT " . q($J["STARTS"])) . " ON COMPLETION" . ($J["ON_COMPLETION"] ? "" : " NOT") . " PRESERVE";
            queries_redirect(substr(ME, 0, -1), ($aa != "" ? lang(206) : lang(207)), queries(($aa != "" ? "ALTER EVENT " . idf_escape($aa) . $ch . ($aa != $J["EVENT_NAME"] ? "\nRENAME TO " . idf_escape($J["EVENT_NAME"]) : "") : "CREATE EVENT " . idf_escape($J["EVENT_NAME"]) . $ch) . "\n" . $Jh[$J["STATUS"]] . " COMMENT " . q($J["EVENT_COMMENT"]) . rtrim(" DO\n$J[EVENT_DEFINITION]", ";") . ";"));
        }
    }
    page_header(($aa != "" ? lang(208) . ": " . h($aa) : lang(209)), $o);
    if (!$J && $aa != "") {
        $K = get_rows("SELECT * FROM information_schema.EVENTS WHERE EVENT_SCHEMA = " . q(DB) . " AND EVENT_NAME = " . q($aa));
        $J = reset($K);
    }
    echo '
<form action="" method="post">
<table cellspacing="0" class="layout">
<tr><th>', lang(183), '<td><input name="EVENT_NAME" value="', h($J["EVENT_NAME"]), '" data-maxlength="64" autocapitalize="off">
<tr><th title="datetime">', lang(210), '<td><input name="STARTS" value="', h("$J[EXECUTE_AT]$J[STARTS]"), '">
<tr><th title="datetime">', lang(211), '<td><input name="ENDS" value="', h($J["ENDS"]), '">
<tr><th>', lang(212), '<td><input type="number" name="INTERVAL_VALUE" value="', h($J["INTERVAL_VALUE"]), '" class="size"> ', html_select("INTERVAL_FIELD", $Wd, $J["INTERVAL_FIELD"]), '<tr><th>', lang(118), '<td>', html_select("STATUS", $Jh, $J["STATUS"]), '<tr><th>', lang(51), '<td><input name="EVENT_COMMENT" value="', h($J["EVENT_COMMENT"]), '" data-maxlength="64">
<tr><th><td>', checkbox("ON_COMPLETION", "PRESERVE", $J["ON_COMPLETION"] == "PRESERVE", lang(213)), '</table>
<p>';
    textarea("EVENT_DEFINITION", $J["EVENT_DEFINITION"]);
    echo '<p>
<input type="submit" value="', lang(14), '">
';
    if ($aa != "") {
        echo '<input type="submit" name="drop" value="', lang(127), '">', confirm(lang(175, $aa));
    }
    echo '<input type="hidden" name="token" value="', $si, '">
</form>
';
} elseif (isset($_GET["procedure"])) {
    $da          = ($_GET["name"] ? $_GET["name"] : $_GET["procedure"]);
    $Xg          = (isset($_GET["function"]) ? "FUNCTION" : "PROCEDURE");
    $J           = $_POST;
    $J["fields"] = (array) $J["fields"];
    if ($_POST && !process_fields($J["fields"]) && !$o) {
        $Gf = routine($_GET["procedure"], $Xg);
        $di = "$J[name]_adminer_" . uniqid();
        drop_create("DROP $Xg " . routine_id($da, $Gf), create_routine($Xg, $J), "DROP $Xg " . routine_id($J["name"], $J), create_routine($Xg, array(
            "name" => $di
        ) + $J), "DROP $Xg " . routine_id($di, $J), substr(ME, 0, -1), lang(214), lang(215), lang(216), $da, $J["name"]);
    }
    page_header(($da != "" ? (isset($_GET["function"]) ? lang(217) : lang(218)) . ": " . h($da) : (isset($_GET["function"]) ? lang(219) : lang(220))), $o);
    if (!$_POST && $da != "") {
        $J         = routine($_GET["procedure"], $Xg);
        $J["name"] = $da;
    }
    $qb = get_vals("SHOW CHARACTER SET");
    sort($qb);
    $Yg = routine_languages();
    echo '
<form action="" method="post" id="form">
<p>', lang(183), ': <input name="name" value="', h($J["name"]), '" data-maxlength="64" autocapitalize="off">
', ($Yg ? lang(19) . ": " . html_select("language", $Yg, $J["language"]) . "\n" : ""), '<input type="submit" value="', lang(14), '">
<div class="scrollable">
<table cellspacing="0" class="nowrap">
';
    edit_fields($J["fields"], $qb, $Xg);
    if (isset($_GET["function"])) {
        echo "<tr><td>" . lang(221);
        edit_type("returns", $J["returns"], $qb, array(), ($y == "pgsql" ? array(
            "void",
            "trigger"
        ) : array()));
    }
    echo '</table>
</div>
<p>';
    textarea("definition", $J["definition"]);
    echo '<p>
<input type="submit" value="', lang(14), '">
';
    if ($da != "") {
        echo '<input type="submit" name="drop" value="', lang(127), '">', confirm(lang(175, $da));
    }
    echo '<input type="hidden" name="token" value="', $si, '">
</form>
';
} elseif (isset($_GET["sequence"])) {
    $fa = $_GET["sequence"];
    $J  = $_POST;
    if ($_POST && !$o) {
        $A = substr(ME, 0, -1);
        $C = trim($J["name"]);
        if ($_POST["drop"])
            query_redirect("DROP SEQUENCE " . idf_escape($fa), $A, lang(222));
        elseif ($fa == "")
            query_redirect("CREATE SEQUENCE " . idf_escape($C), $A, lang(223));
        elseif ($fa != $C)
            query_redirect("ALTER SEQUENCE " . idf_escape($fa) . " RENAME TO " . idf_escape($C), $A, lang(224));
        else
            redirect($A);
    }
    page_header($fa != "" ? lang(225) . ": " . h($fa) : lang(226), $o);
    if (!$J)
        $J["name"] = $fa;
    echo '
<form action="" method="post">
<p><input name="name" value="', h($J["name"]), '" autocapitalize="off">
<input type="submit" value="', lang(14), '">
';
    if ($fa != "")
        echo "<input type='submit' name='drop' value='" . lang(127) . "'>" . confirm(lang(175, $fa)) . "\n";
    echo '<input type="hidden" name="token" value="', $si, '">
</form>
';
} elseif (isset($_GET["type"])) {
    $ga = $_GET["type"];
    $J  = $_POST;
    if ($_POST && !$o) {
        $A = substr(ME, 0, -1);
        if ($_POST["drop"])
            query_redirect("DROP TYPE " . idf_escape($ga), $A, lang(227));
        else
            query_redirect("CREATE TYPE " . idf_escape(trim($J["name"])) . " $J[as]", $A, lang(228));
    }
    page_header($ga != "" ? lang(229) . ": " . h($ga) : lang(230), $o);
    if (!$J)
        $J["as"] = "AS ";
    echo '
<form action="" method="post">
<p>
';
    if ($ga != "")
        echo "<input type='submit' name='drop' value='" . lang(127) . "'>" . confirm(lang(175, $ga)) . "\n";
    else {
        echo "<input name='name' value='" . h($J['name']) . "' autocapitalize='off'>\n";
        textarea("as", $J["as"]);
        echo "<p><input type='submit' value='" . lang(14) . "'>\n";
    }
    echo '<input type="hidden" name="token" value="', $si, '">
</form>
';
} elseif (isset($_GET["trigger"])) {
    $a  = $_GET["trigger"];
    $C  = $_GET["name"];
    $Ci = trigger_options();
    $J  = (array) trigger($C) + array(
        "Trigger" => $a . "_bi"
    );
    if ($_POST) {
        if (!$o && in_array($_POST["Timing"], $Ci["Timing"]) && in_array($_POST["Event"], $Ci["Event"]) && in_array($_POST["Type"], $Ci["Type"])) {
            $sf = " ON " . table($a);
            $hc = "DROP TRIGGER " . idf_escape($C) . ($y == "pgsql" ? $sf : "");
            $_e = ME . "table=" . urlencode($a);
            if ($_POST["drop"])
                query_redirect($hc, $_e, lang(231));
            else {
                if ($C != "")
                    queries($hc);
                queries_redirect($_e, ($C != "" ? lang(232) : lang(233)), queries(create_trigger($sf, $_POST)));
                if ($C != "")
                    queries(create_trigger($sf, $J + array(
                        "Type" => reset($Ci["Type"])
                    )));
            }
        }
        $J = $_POST;
    }
    page_header(($C != "" ? lang(234) . ": " . h($C) : lang(235)), $o, array(
        "table" => $a
    ));
    echo '
<form action="" method="post" id="form">
<table cellspacing="0" class="layout">
<tr><th>', lang(236), '<td>', html_select("Timing", $Ci["Timing"], $J["Timing"], "triggerChange(/^" . preg_quote($a, "/") . "_[ba][iud]$/, '" . js_escape($a) . "', this.form);"), '<tr><th>', lang(237), '<td>', html_select("Event", $Ci["Event"], $J["Event"], "this.form['Timing'].onchange();"), (in_array("UPDATE OF", $Ci["Event"]) ? " <input name='Of' value='" . h($J["Of"]) . "' class='hidden'>" : ""), '<tr><th>', lang(50), '<td>', html_select("Type", $Ci["Type"], $J["Type"]), '</table>
<p>', lang(183), ': <input name="Trigger" value="', h($J["Trigger"]), '" data-maxlength="64" autocapitalize="off">
', script("qs('#form')['Timing'].onchange();"), '<p>';
    textarea("Statement", $J["Statement"]);
    echo '<p>
<input type="submit" value="', lang(14), '">
';
    if ($C != "") {
        echo '<input type="submit" name="drop" value="', lang(127), '">', confirm(lang(175, $C));
    }
    echo '<input type="hidden" name="token" value="', $si, '">
</form>
';
} elseif (isset($_GET["user"])) {
    $ha = $_GET["user"];
    $sg = array(
        "" => array(
            "All privileges" => ""
        )
    );
    foreach (get_rows("SHOW PRIVILEGES") as $J) {
        foreach (explode(",", ($J["Privilege"] == "Grant option" ? "" : $J["Context"])) as $Cb)
            $sg[$Cb][$J["Privilege"]] = $J["Comment"];
    }
    $sg["Server Admin"] += $sg["File access on server"];
    $sg["Databases"]["Create routine"] = $sg["Procedures"]["Create routine"];
    unset($sg["Procedures"]["Create routine"]);
    $sg["Columns"] = array();
    foreach (array(
        "Select",
        "Insert",
        "Update",
        "References"
    ) as $X)
        $sg["Columns"][$X] = $sg["Tables"][$X];
    unset($sg["Server Admin"]["Usage"]);
    foreach ($sg["Tables"] as $z => $X)
        unset($sg["Databases"][$z]);
    $bf = array();
    if ($_POST) {
        foreach ($_POST["objects"] as $z => $X)
            $bf[$X] = (array) $bf[$X] + (array) $_POST["grants"][$z];
    }
    $od = array();
    $qf = "";
    if (isset($_GET["host"]) && ($H = $h->query("SHOW GRANTS FOR " . q($ha) . "@" . q($_GET["host"])))) {
        while ($J = $H->fetch_row()) {
            if (preg_match('~GRANT (.*) ON (.*) TO ~', $J[0], $B) && preg_match_all('~ *([^(,]*[^ ,(])( *\([^)]+\))?~', $B[1], $Ge, PREG_SET_ORDER)) {
                foreach ($Ge as $X) {
                    if ($X[1] != "USAGE")
                        $od["$B[2]$X[2]"][$X[1]] = true;
                    if (preg_match('~ WITH GRANT OPTION~', $J[0]))
                        $od["$B[2]$X[2]"]["GRANT OPTION"] = true;
                }
            }
            if (preg_match("~ IDENTIFIED BY PASSWORD '([^']+)~", $J[0], $B))
                $qf = $B[1];
        }
    }
    if ($_POST && !$o) {
        $rf = (isset($_GET["host"]) ? q($ha) . "@" . q($_GET["host"]) : "''");
        if ($_POST["drop"])
            query_redirect("DROP USER $rf", ME . "privileges=", lang(238));
        else {
            $df = q($_POST["user"]) . "@" . q($_POST["host"]);
            $ag = $_POST["pass"];
            if ($ag != '' && !$_POST["hashed"] && !min_version(8)) {
                $ag = $h->result("SELECT PASSWORD(" . q($ag) . ")");
                $o  = !$ag;
            }
            $Hb = false;
            if (!$o) {
                if ($rf != $df) {
                    $Hb = queries((min_version(5) ? "CREATE USER" : "GRANT USAGE ON *.* TO") . " $df IDENTIFIED BY " . (min_version(8) ? "" : "PASSWORD ") . q($ag));
                    $o  = !$Hb;
                } elseif ($ag != $qf)
                    queries("SET PASSWORD FOR $df = " . q($ag));
            }
            if (!$o) {
                $Ug = array();
                foreach ($bf as $lf => $nd) {
                    if (isset($_GET["grant"]))
                        $nd = array_filter($nd);
                    $nd = array_keys($nd);
                    if (isset($_GET["grant"]))
                        $Ug = array_diff(array_keys(array_filter($bf[$lf], 'strlen')), $nd);
                    elseif ($rf == $df) {
                        $of = array_keys((array) $od[$lf]);
                        $Ug = array_diff($of, $nd);
                        $nd = array_diff($nd, $of);
                        unset($od[$lf]);
                    }
                    if (preg_match('~^(.+)\s*(\(.*\))?$~U', $lf, $B) && (!grant("REVOKE", $Ug, $B[2], " ON $B[1] FROM $df") || !grant("GRANT", $nd, $B[2], " ON $B[1] TO $df"))) {
                        $o = true;
                        break;
                    }
                }
            }
            if (!$o && isset($_GET["host"])) {
                if ($rf != $df)
                    queries("DROP USER $rf");
                elseif (!isset($_GET["grant"])) {
                    foreach ($od as $lf => $Ug) {
                        if (preg_match('~^(.+)(\(.*\))?$~U', $lf, $B))
                            grant("REVOKE", array_keys($Ug), $B[2], " ON $B[1] FROM $df");
                    }
                }
            }
            queries_redirect(ME . "privileges=", (isset($_GET["host"]) ? lang(239) : lang(240)), !$o);
            if ($Hb)
                $h->query("DROP USER $df");
        }
    }
    page_header((isset($_GET["host"]) ? lang(36) . ": " . h("$ha@$_GET[host]") : lang(146)), $o, array(
        "privileges" => array(
            '',
            lang(72)
        )
    ));
    if ($_POST) {
        $J  = $_POST;
        $od = $bf;
    } else {
        $J         = $_GET + array(
            "host" => $h->result("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', -1)")
        );
        $J["pass"] = $qf;
        if ($qf != "")
            $J["hashed"] = true;
        $od[(DB == "" || $od ? "" : idf_escape(addcslashes(DB, "%_\\"))) . ".*"] = array();
    }
    echo '<form action="" method="post">
<table cellspacing="0" class="layout">
<tr><th>', lang(35), '<td><input name="host" data-maxlength="60" value="', h($J["host"]), '" autocapitalize="off">
<tr><th>', lang(36), '<td><input name="user" data-maxlength="80" value="', h($J["user"]), '" autocapitalize="off">
<tr><th>', lang(37), '<td><input name="pass" id="pass" value="', h($J["pass"]), '" autocomplete="new-password">
';
    if (!$J["hashed"])
        echo script("typePassword(qs('#pass'));");
    echo (min_version(8) ? "" : checkbox("hashed", 1, $J["hashed"], lang(241), "typePassword(this.form['pass'], this.checked);")), '</table>

';
    echo "<table cellspacing='0'>\n", "<thead><tr><th colspan='2'>" . lang(72) . doc_link(array(
        'sql' => "grant.html#priv_level"
    ));
    $t = 0;
    foreach ($od as $lf => $nd) {
        echo '<th>' . ($lf != "*.*" ? "<input name='objects[$t]' value='" . h($lf) . "' size='10' autocapitalize='off'>" : "<input type='hidden' name='objects[$t]' value='*.*' size='10'>*.*");
        $t++;
    }
    echo "</thead>\n";
    foreach (array(
        "" => "",
        "Server Admin" => lang(35),
        "Databases" => lang(38),
        "Tables" => lang(131),
        "Columns" => lang(49),
        "Procedures" => lang(242)
    ) as $Cb => $Yb) {
        foreach ((array) $sg[$Cb] as $rg => $vb) {
            echo "<tr" . odd() . "><td" . ($Yb ? ">$Yb<td" : " colspan='2'") . ' lang="en" title="' . h($vb) . '">' . h($rg);
            $t = 0;
            foreach ($od as $lf => $nd) {
                $C = "'grants[$t][" . h(strtoupper($rg)) . "]'";
                $Y = $nd[strtoupper($rg)];
                if ($Cb == "Server Admin" && $lf != (isset($od["*.*"]) ? "*.*" : ".*"))
                    echo "<td>";
                elseif (isset($_GET["grant"]))
                    echo "<td><select name=$C><option><option value='1'" . ($Y ? " selected" : "") . ">" . lang(243) . "<option value='0'" . ($Y == "0" ? " selected" : "") . ">" . lang(244) . "</select>";
                else {
                    echo "<td align='center'><label class='block'>", "<input type='checkbox' name=$C value='1'" . ($Y ? " checked" : "") . ($rg == "All privileges" ? " id='grants-$t-all'>" : ">" . ($rg == "Grant option" ? "" : script("qsl('input').onclick = function () { if (this.checked) formUncheck('grants-$t-all'); };"))), "</label>";
                }
                $t++;
            }
        }
    }
    echo "</table>\n", '<p>
<input type="submit" value="', lang(14), '">
';
    if (isset($_GET["host"])) {
        echo '<input type="submit" name="drop" value="', lang(127), '">', confirm(lang(175, "$ha@$_GET[host]"));
    }
    echo '<input type="hidden" name="token" value="', $si, '">
</form>
';
} elseif (isset($_GET["processlist"])) {
    if (support("kill") && $_POST && !$o) {
        $le = 0;
        foreach ((array) $_POST["kill"] as $X) {
            if (kill_process($X))
                $le++;
        }
        queries_redirect(ME . "processlist=", lang(245, $le), $le || !$_POST["kill"]);
    }
    page_header(lang(116), $o);
    echo '
<form action="" method="post">
<div class="scrollable">
<table cellspacing="0" class="nowrap checkable">
', script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});");
    $t = -1;
    foreach (process_list() as $t => $J) {
        if (!$t) {
            echo "<thead><tr lang='en'>" . (support("kill") ? "<th>" : "");
            foreach ($J as $z => $X)
                echo "<th>$z" . doc_link(array(
                    'sql' => "show-processlist.html#processlist_" . strtolower($z),
                    'pgsql' => "monitoring-stats.html#PG-STAT-ACTIVITY-VIEW",
                    'oracle' => "../b14237/dynviews_2088.htm"
                ));
            echo "</thead>\n";
        }
        echo "<tr" . odd() . ">" . (support("kill") ? "<td>" . checkbox("kill[]", $J[$y == "sql" ? "Id" : "pid"], 0) : "");
        foreach ($J as $z => $X)
            echo "<td>" . (($y == "sql" && $z == "Info" && preg_match("~Query|Killed~", $J["Command"]) && $X != "") || ($y == "pgsql" && $z == "current_query" && $X != "<IDLE>") || ($y == "oracle" && $z == "sql_text" && $X != "") ? "<code class='jush-$y'>" . shorten_utf8($X, 100, "</code>") . ' <a href="' . h(ME . ($J["db"] != "" ? "db=" . urlencode($J["db"]) . "&" : "") . "sql=" . urlencode($X)) . '">' . lang(246) . '</a>' : h($X));
        echo "\n";
    }
    echo '</table>
</div>
<p>
';
    if (support("kill")) {
        echo ($t + 1) . "/" . lang(247, max_connections()), "<p><input type='submit' value='" . lang(248) . "'>\n";
    }
    echo '<input type="hidden" name="token" value="', $si, '">
</form>
', script("tableCheck();");
} elseif (isset($_GET["select"])) {
    $a  = $_GET["select"];
    $R  = table_status1($a);
    $x  = indexes($a);
    $q  = fields($a);
    $gd = column_foreign_keys($a);
    $nf = $R["Oid"];
    parse_str($_COOKIE["adminer_import"], $za);
    $Vg = array();
    $f  = array();
    $hi = null;
    foreach ($q as $z => $p) {
        $C = $b->fieldName($p);
        if (isset($p["privileges"]["select"]) && $C != "") {
            $f[$z] = html_entity_decode(strip_tags($C), ENT_QUOTES);
            if (is_shortable($p))
                $hi = $b->selectLengthProcess();
        }
        $Vg += $p["privileges"];
    }
    list($L, $pd) = $b->selectColumnsProcess($f, $x);
    $ae = count($pd) < count($L);
    $Z  = $b->selectSearchProcess($q, $x);
    $Cf = $b->selectOrderProcess($q, $x);
    $_  = $b->selectLimitProcess();
    if ($_GET["val"] && is_ajax()) {
        header("Content-Type: text/plain; charset=utf-8");
        foreach ($_GET["val"] as $Ji => $J) {
            $Ha  = convert_field($q[key($J)]);
            $L   = array(
                $Ha ? $Ha : idf_escape(key($J))
            );
            $Z[] = where_check($Ji, $q);
            $I   = $n->select($a, $L, $Z, $L);
            if ($I)
                echo reset($I->fetch_row());
        }
        exit;
    }
    $ng = $Li = null;
    foreach ($x as $w) {
        if ($w["type"] == "PRIMARY") {
            $ng = array_flip($w["columns"]);
            $Li = ($L ? $ng : array());
            foreach ($Li as $z => $X) {
                if (in_array(idf_escape($z), $L))
                    unset($Li[$z]);
            }
            break;
        }
    }
    if ($nf && !$ng) {
        $ng  = $Li = array(
            $nf => 0
        );
        $x[] = array(
            "type" => "PRIMARY",
            "columns" => array(
                $nf
            )
        );
    }
    if ($_POST && !$o) {
        $nj = $Z;
        if (!$_POST["all"] && is_array($_POST["check"])) {
            $hb = array();
            foreach ($_POST["check"] as $eb)
                $hb[] = where_check($eb, $q);
            $nj[] = "((" . implode(") OR (", $hb) . "))";
        }
        $nj = ($nj ? "\nWHERE " . implode(" AND ", $nj) : "");
        if ($_POST["export"]) {
            cookie("adminer_import", "output=" . urlencode($_POST["output"]) . "&format=" . urlencode($_POST["format"]));
            dump_headers($a);
            $b->dumpTable($a, "");
            $ld = ($L ? implode(", ", $L) : "*") . convert_fields($f, $q, $L) . "\nFROM " . table($a);
            $rd = ($pd && $ae ? "\nGROUP BY " . implode(", ", $pd) : "") . ($Cf ? "\nORDER BY " . implode(", ", $Cf) : "");
            if (!is_array($_POST["check"]) || $ng)
                $G = "SELECT $ld$nj$rd";
            else {
                $Hi = array();
                foreach ($_POST["check"] as $X)
                    $Hi[] = "(SELECT" . limit($ld, "\nWHERE " . ($Z ? implode(" AND ", $Z) . " AND " : "") . where_check($X, $q) . $rd, 1) . ")";
                $G = implode(" UNION ALL ", $Hi);
            }
            $b->dumpData($a, "table", $G);
            exit;
        }
        if (!$b->selectEmailProcess($Z, $gd)) {
            if ($_POST["save"] || $_POST["delete"]) {
                $H  = true;
                $_a = 0;
                $O  = array();
                if (!$_POST["delete"]) {
                    foreach ($f as $C => $X) {
                        $X = process_input($q[$C]);
                        if ($X !== null && ($_POST["clone"] || $X !== false))
                            $O[idf_escape($C)] = ($X !== false ? $X : idf_escape($C));
                    }
                }
                if ($_POST["delete"] || $O) {
                    if ($_POST["clone"])
                        $G = "INTO " . table($a) . " (" . implode(", ", array_keys($O)) . ")\nSELECT " . implode(", ", $O) . "\nFROM " . table($a);
                    if ($_POST["all"] || ($ng && is_array($_POST["check"])) || $ae) {
                        $H  = ($_POST["delete"] ? $n->delete($a, $nj) : ($_POST["clone"] ? queries("INSERT $G$nj") : $n->update($a, $O, $nj)));
                        $_a = $h->affected_rows;
                    } else {
                        foreach ((array) $_POST["check"] as $X) {
                            $jj = "\nWHERE " . ($Z ? implode(" AND ", $Z) . " AND " : "") . where_check($X, $q);
                            $H  = ($_POST["delete"] ? $n->delete($a, $jj, 1) : ($_POST["clone"] ? queries("INSERT" . limit1($a, $G, $jj)) : $n->update($a, $O, $jj, 1)));
                            if (!$H)
                                break;
                            $_a += $h->affected_rows;
                        }
                    }
                }
                $Oe = lang(249, $_a);
                if ($_POST["clone"] && $H && $_a == 1) {
                    $re = last_id();
                    if ($re)
                        $Oe = lang(168, " $re");
                }
                queries_redirect(remove_from_uri($_POST["all"] && $_POST["delete"] ? "page" : ""), $Oe, $H);
                if (!$_POST["delete"]) {
                    edit_form($a, $q, (array) $_POST["fields"], !$_POST["clone"]);
                    page_footer();
                    exit;
                }
            } elseif (!$_POST["import"]) {
                if (!$_POST["val"])
                    $o = lang(250);
                else {
                    $H  = true;
                    $_a = 0;
                    foreach ($_POST["val"] as $Ji => $J) {
                        $O = array();
                        foreach ($J as $z => $X) {
                            $z                 = bracket_escape($z, 1);
                            $O[idf_escape($z)] = (preg_match('~char|text~', $q[$z]["type"]) || $X != "" ? $b->processInput($q[$z], $X) : "NULL");
                        }
                        $H = $n->update($a, $O, " WHERE " . ($Z ? implode(" AND ", $Z) . " AND " : "") . where_check($Ji, $q), !$ae && !$ng, " ");
                        if (!$H)
                            break;
                        $_a += $h->affected_rows;
                    }
                    queries_redirect(remove_from_uri(), lang(249, $_a), $H);
                }
            } elseif (!is_string($Vc = get_file("csv_file", true)))
                $o = upload_error($Vc);
            elseif (!preg_match('~~u', $Vc))
                $o = lang(251);
            else {
                cookie("adminer_import", "output=" . urlencode($za["output"]) . "&format=" . urlencode($_POST["separator"]));
                $H  = true;
                $sb = array_keys($q);
                preg_match_all('~(?>"[^"]*"|[^"\r\n]+)+~', $Vc, $Ge);
                $_a = count($Ge[0]);
                $n->begin();
                $M = ($_POST["separator"] == "csv" ? "," : ($_POST["separator"] == "tsv" ? "\t" : ";"));
                $K = array();
                foreach ($Ge[0] as $z => $X) {
                    preg_match_all("~((?>\"[^\"]*\")+|[^$M]*)$M~", $X . $M, $He);
                    if (!$z && !array_diff($He[1], $sb)) {
                        $sb = $He[1];
                        $_a--;
                    } else {
                        $O = array();
                        foreach ($He[1] as $t => $ob)
                            $O[idf_escape($sb[$t])] = ($ob == "" && $q[$sb[$t]]["null"] ? "NULL" : q(str_replace('""', '"', preg_replace('~^"|"$~', '', $ob))));
                        $K[] = $O;
                    }
                }
                $H = (!$K || $n->insertUpdate($a, $K, $ng));
                if ($H)
                    $H = $n->commit();
                queries_redirect(remove_from_uri("page"), lang(252, $_a), $H);
                $n->rollback();
            }
        }
    }
    $Th = $b->tableName($R);
    if (is_ajax()) {
        page_headers();
        ob_start();
    } else
        page_header(lang(54) . ": $Th", $o);
    $O = null;
    if (isset($Vg["insert"]) || !support("table")) {
        $O = "";
        foreach ((array) $_GET["where"] as $X) {
            if ($gd[$X["col"]] && count($gd[$X["col"]]) == 1 && ($X["op"] == "=" || (!$X["op"] && !preg_match('~[_%]~', $X["val"]))))
                $O .= "&set" . urlencode("[" . bracket_escape($X["col"]) . "]") . "=" . urlencode($X["val"]);
        }
    }
    $b->selectLinks($R, $O);
    if (!$f && support("table"))
        echo "<p class='error'>" . lang(253) . ($q ? "." : ": " . error()) . "\n";
    else {
        echo "<form action='' id='form'>\n", "<div style='display: none;'>";
        hidden_fields_get();
        echo (DB != "" ? '<input type="hidden" name="db" value="' . h(DB) . '">' . (isset($_GET["ns"]) ? '<input type="hidden" name="ns" value="' . h($_GET["ns"]) . '">' : "") : "");
        echo '<input type="hidden" name="select" value="' . h($a) . '">', "</div>\n";
        $b->selectColumnsPrint($L, $f);
        $b->selectSearchPrint($Z, $f, $x);
        $b->selectOrderPrint($Cf, $f, $x);
        $b->selectLimitPrint($_);
        $b->selectLengthPrint($hi);
        $b->selectActionPrint($x);
        echo "</form>\n";
        $E = $_GET["page"];
        if ($E == "last") {
            $jd = $h->result(count_rows($a, $Z, $ae, $pd));
            $E  = floor(max(0, $jd - 1) / $_);
        }
        $hh = $L;
        $qd = $pd;
        if (!$hh) {
            $hh[] = "*";
            $Db   = convert_fields($f, $q, $L);
            if ($Db)
                $hh[] = substr($Db, 2);
        }
        foreach ($L as $z => $X) {
            $p = $q[idf_unescape($X)];
            if ($p && ($Ha = convert_field($p)))
                $hh[$z] = "$Ha AS $X";
        }
        if (!$ae && $Li) {
            foreach ($Li as $z => $X) {
                $hh[] = idf_escape($z);
                if ($qd)
                    $qd[] = idf_escape($z);
            }
        }
        $H = $n->select($a, $hh, $Z, $qd, $Cf, $_, $E, true);
        if (!$H)
            echo "<p class='error'>" . error() . "\n";
        else {
            if ($y == "mssql" && $E)
                $H->seek($_ * $E);
            $uc = array();
            echo "<form action='' method='post' enctype='multipart/form-data'>\n";
            $K = array();
            while ($J = $H->fetch_assoc()) {
                if ($E && $y == "oracle")
                    unset($J["RNUM"]);
                $K[] = $J;
            }
            if ($_GET["page"] != "last" && $_ != "" && $pd && $ae && $y == "sql")
                $jd = $h->result(" SELECT FOUND_ROWS()");
            if (!$K)
                echo "<p class='message'>" . lang(12) . "\n";
            else {
                $Ra = $b->backwardKeys($a, $Th);
                echo "<div class='scrollable'>", "<table id='table' cellspacing='0' class='nowrap checkable'>", script("mixin(qs('#table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true), onkeydown: editingKeydown});"), "<thead><tr>" . (!$pd && $L ? "" : "<td><input type='checkbox' id='all-page' class='jsonly'>" . script("qs('#all-page').onclick = partial(formCheck, /check/);", "") . " <a href='" . h($_GET["modify"] ? remove_from_uri("modify") : $_SERVER["REQUEST_URI"] . "&modify=1") . "'>" . lang(254) . "</a>");
                $af = array();
                $md = array();
                reset($L);
                $Bg = 1;
                foreach ($K[0] as $z => $X) {
                    if (!isset($Li[$z])) {
                        $X = $_GET["columns"][key($L)];
                        $p = $q[$L ? ($X ? $X["col"] : current($L)) : $z];
                        $C = ($p ? $b->fieldName($p, $Bg) : ($X["fun"] ? "*" : $z));
                        if ($C != "") {
                            $Bg++;
                            $af[$z] = $C;
                            $e      = idf_escape($z);
                            $Dd     = remove_from_uri('(order|desc)[^=]*|page') . '&order%5B0%5D=' . urlencode($z);
                            $Yb     = "&desc%5B0%5D=1";
                            echo "<th>" . script("mixin(qsl('th'), {onmouseover: partial(columnMouse), onmouseout: partial(columnMouse, ' hidden')});", ""), '<a href="' . h($Dd . ($Cf[0] == $e || $Cf[0] == $z || (!$Cf && $ae && $pd[0] == $e) ? $Yb : '')) . '">';
                            echo apply_sql_function($X["fun"], $C) . "</a>";
                            echo "<span class='column hidden'>", "<a href='" . h($Dd . $Yb) . "' title='" . lang(60) . "' class='text'> â†“</a>";
                            if (!$X["fun"]) {
                                echo '<a href="#fieldset-search" title="' . lang(57) . '" class="text jsonly"> =</a>', script("qsl('a').onclick = partial(selectSearch, '" . js_escape($z) . "');");
                            }
                            echo "</span>";
                        }
                        $md[$z] = $X["fun"];
                        next($L);
                    }
                }
                $xe = array();
                if ($_GET["modify"]) {
                    foreach ($K as $J) {
                        foreach ($J as $z => $X)
                            $xe[$z] = max($xe[$z], min(40, strlen(utf8_decode($X))));
                    }
                }
                echo ($Ra ? "<th>" . lang(255) : "") . "</thead>\n";
                if (is_ajax()) {
                    if ($_ % 2 == 1 && $E % 2 == 1)
                        odd();
                    ob_end_clean();
                }
                foreach ($b->rowDescriptions($K, $gd) as $Ze => $J) {
                    $Ii = unique_array($K[$Ze], $x);
                    if (!$Ii) {
                        $Ii = array();
                        foreach ($K[$Ze] as $z => $X) {
                            if (!preg_match('~^(COUNT\((\*|(DISTINCT )?`(?:[^`]|``)+`)\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\(`(?:[^`]|``)+`\))$~', $z))
                                $Ii[$z] = $X;
                        }
                    }
                    $Ji = "";
                    foreach ($Ii as $z => $X) {
                        if (($y == "sql" || $y == "pgsql") && preg_match('~char|text|enum|set~', $q[$z]["type"]) && strlen($X) > 64) {
                            $z = (strpos($z, '(') ? $z : idf_escape($z));
                            $z = "MD5(" . ($y != 'sql' || preg_match("~^utf8~", $q[$z]["collation"]) ? $z : "CONVERT($z USING " . charset($h) . ")") . ")";
                            $X = md5($X);
                        }
                        $Ji .= "&" . ($X !== null ? urlencode("where[" . bracket_escape($z) . "]") . "=" . urlencode($X) : "null%5B%5D=" . urlencode($z));
                    }
                    echo "<tr" . odd() . ">" . (!$pd && $L ? "" : "<td>" . checkbox("check[]", substr($Ji, 1), in_array(substr($Ji, 1), (array) $_POST["check"])) . ($ae || information_schema(DB) ? "" : " <a href='" . h(ME . "edit=" . urlencode($a) . $Ji) . "' class='edit'>" . lang(256) . "</a>"));
                    foreach ($J as $z => $X) {
                        if (isset($af[$z])) {
                            $p = $q[$z];
                            $X = $n->value($X, $p);
                            if ($X != "" && (!isset($uc[$z]) || $uc[$z] != ""))
                                $uc[$z] = (is_mail($X) ? $af[$z] : "");
                            $A = "";
                            if (preg_match('~blob|bytea|raw|file~', $p["type"]) && $X != "")
                                $A = ME . 'download=' . urlencode($a) . '&field=' . urlencode($z) . $Ji;
                            if (!$A && $X !== null) {
                                foreach ((array) $gd[$z] as $r) {
                                    if (count($gd[$z]) == 1 || end($r["source"]) == $z) {
                                        $A = "";
                                        foreach ($r["source"] as $t => $zh)
                                            $A .= where_link($t, $r["target"][$t], $K[$Ze][$zh]);
                                        $A = ($r["db"] != "" ? preg_replace('~([?&]db=)[^&]+~', '\1' . urlencode($r["db"]), ME) : ME) . 'select=' . urlencode($r["table"]) . $A;
                                        if ($r["ns"])
                                            $A = preg_replace('~([?&]ns=)[^&]+~', '\1' . urlencode($r["ns"]), $A);
                                        if (count($r["source"]) == 1)
                                            break;
                                    }
                                }
                            }
                            if ($z == "COUNT(*)") {
                                $A = ME . "select=" . urlencode($a);
                                $t = 0;
                                foreach ((array) $_GET["where"] as $W) {
                                    if (!array_key_exists($W["col"], $Ii))
                                        $A .= where_link($t++, $W["col"], $W["val"], $W["op"]);
                                }
                                foreach ($Ii as $fe => $W)
                                    $A .= where_link($t++, $fe, $W);
                            }
                            $X  = select_value($X, $A, $p, $hi);
                            $u  = h("val[$Ji][" . bracket_escape($z) . "]");
                            $Y  = $_POST["val"][$Ji][bracket_escape($z)];
                            $pc = !is_array($J[$z]) && is_utf8($X) && $K[$Ze][$z] == $J[$z] && !$md[$z];
                            $gi = preg_match('~text|lob~', $p["type"]);
                            if (($_GET["modify"] && $pc) || $Y !== null) {
                                $ud = h($Y !== null ? $Y : $J[$z]);
                                echo "<td>" . ($gi ? "<textarea name='$u' cols='30' rows='" . (substr_count($J[$z], "\n") + 1) . "'>$ud</textarea>" : "<input name='$u' value='$ud' size='$xe[$z]'>");
                            } else {
                                $Be = strpos($X, "<i>â€¦</i>");
                                echo "<td id='$u' data-text='" . ($Be ? 2 : ($gi ? 1 : 0)) . "'" . ($pc ? "" : " data-warning='" . h(lang(257)) . "'") . ">$X</td>";
                            }
                        }
                    }
                    if ($Ra)
                        echo "<td>";
                    $b->backwardKeysPrint($Ra, $K[$Ze]);
                    echo "</tr>\n";
                }
                if (is_ajax())
                    exit;
                echo "</table>\n", "</div>\n";
            }
            if (!is_ajax()) {
                if ($K || $E) {
                    $Dc = true;
                    if ($_GET["page"] != "last") {
                        if ($_ == "" || (count($K) < $_ && ($K || !$E)))
                            $jd = ($E ? $E * $_ : 0) + count($K);
                        elseif ($y != "sql" || !$ae) {
                            $jd = ($ae ? false : found_rows($R, $Z));
                            if ($jd < max(1e4, 2 * ($E + 1) * $_))
                                $jd = reset(slow_query(count_rows($a, $Z, $ae, $pd)));
                            else
                                $Dc = false;
                        }
                    }
                    $Pf = ($_ != "" && ($jd === false || $jd > $_ || $E));
                    if ($Pf) {
                        echo (($jd === false ? count($K) + 1 : $jd - $E * $_) > $_ ? '<p><a href="' . h(remove_from_uri("page") . "&page=" . ($E + 1)) . '" class="loadmore">' . lang(258) . '</a>' . script("qsl('a').onclick = partial(selectLoadMore, " . (+$_) . ", '" . lang(259) . "â€¦');", "") : ''), "\n";
                    }
                }
                echo "<div class='footer'><div>\n";
                if ($K || $E) {
                    if ($Pf) {
                        $Je = ($jd === false ? $E + (count($K) >= $_ ? 2 : 1) : floor(($jd - 1) / $_));
                        echo "<fieldset>";
                        if ($y != "simpledb") {
                            echo "<legend><a href='" . h(remove_from_uri("page")) . "'>" . lang(260) . "</a></legend>", script("qsl('a').onclick = function () { pageClick(this.href, +prompt('" . lang(260) . "', '" . ($E + 1) . "')); return false; };"), pagination(0, $E) . ($E > 5 ? " â€¦" : "");
                            for ($t = max(1, $E - 4); $t < min($Je, $E + 5); $t++)
                                echo pagination($t, $E);
                            if ($Je > 0) {
                                echo ($E + 5 < $Je ? " â€¦" : ""), ($Dc && $jd !== false ? pagination($Je, $E) : " <a href='" . h(remove_from_uri("page") . "&page=last") . "' title='~$Je'>" . lang(261) . "</a>");
                            }
                        } else {
                            echo "<legend>" . lang(260) . "</legend>", pagination(0, $E) . ($E > 1 ? " â€¦" : ""), ($E ? pagination($E, $E) : ""), ($Je > $E ? pagination($E + 1, $E) . ($Je > $E + 1 ? " â€¦" : "") : "");
                        }
                        echo "</fieldset>\n";
                    }
                    echo "<fieldset>", "<legend>" . lang(262) . "</legend>";
                    $dc = ($Dc ? "" : "~ ") . $jd;
                    echo checkbox("all", 1, 0, ($jd !== false ? ($Dc ? "" : "~ ") . lang(150, $jd) : ""), "var checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$dc' : checked); selectCount('selected2', this.checked || !checked ? '$dc' : checked);") . "\n", "</fieldset>\n";
                    if ($b->selectCommandPrint()) {
                        echo '<fieldset', ($_GET["modify"] ? '' : ' class="jsonly"'), '><legend>', lang(254), '</legend><div>
<input type="submit" value="', lang(14), '"', ($_GET["modify"] ? '' : ' title="' . lang(250) . '"'), '>
</div></fieldset>
<fieldset><legend>', lang(126), ' <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="', lang(10), '">
<input type="submit" name="clone" value="', lang(246), '">
<input type="submit" name="delete" value="', lang(18), '">', confirm(), '</div></fieldset>
';
                    }
                    $hd = $b->dumpFormat();
                    foreach ((array) $_GET["columns"] as $e) {
                        if ($e["fun"]) {
                            unset($hd['sql']);
                            break;
                        }
                    }
                    if ($hd) {
                        print_fieldset("export", lang(74) . " <span id='selected2'></span>");
                        $Nf = $b->dumpOutput();
                        echo ($Nf ? html_select("output", $Nf, $za["output"]) . " " : ""), html_select("format", $hd, $za["format"]), " <input type='submit' name='export' value='" . lang(74) . "'>\n", "</div></fieldset>\n";
                    }
                    $b->selectEmailPrint(array_filter($uc, 'strlen'), $f);
                }
                echo "</div></div>\n";
                if ($b->selectImportPrint()) {
                    echo "<div>", "<a href='#import'>" . lang(73) . "</a>", script("qsl('a').onclick = partial(toggle, 'import');", ""), "<span id='import' class='hidden'>: ", "<input type='file' name='csv_file'> ", html_select("separator", array(
                        "csv" => "CSV,",
                        "csv;" => "CSV;",
                        "tsv" => "TSV"
                    ), $za["format"], 1);
                    echo " <input type='submit' name='import' value='" . lang(73) . "'>", "</span>", "</div>";
                }
                echo "<input type='hidden' name='token' value='$si'>\n", "</form>\n", (!$pd && $L ? "" : script("tableCheck();"));
            }
        }
    }
    if (is_ajax()) {
        ob_end_clean();
        exit;
    }
} elseif (isset($_GET["variables"])) {
    $Ih = isset($_GET["status"]);
    page_header($Ih ? lang(118) : lang(117));
    $aj = ($Ih ? show_status() : show_variables());
    if (!$aj)
        echo "<p class='message'>" . lang(12) . "\n";
    else {
        echo "<table cellspacing='0'>\n";
        foreach ($aj as $z => $X) {
            echo "<tr>", "<th><code class='jush-" . $y . ($Ih ? "status" : "set") . "'>" . h($z) . "</code>", "<td>" . h($X);
        }
        echo "</table>\n";
    }
} elseif (isset($_GET["script"])) {
    header("Content-Type: text/javascript; charset=utf-8");
    if ($_GET["script"] == "db") {
        $Qh = array(
            "Data_length" => 0,
            "Index_length" => 0,
            "Data_free" => 0
        );
        foreach (table_status() as $C => $R) {
            json_row("Comment-$C", h($R["Comment"]));
            if (!is_view($R)) {
                foreach (array(
                    "Engine",
                    "Collation"
                ) as $z)
                    json_row("$z-$C", h($R[$z]));
                foreach ($Qh + array(
                    "Auto_increment" => 0,
                    "Rows" => 0
                ) as $z => $X) {
                    if ($R[$z] != "") {
                        $X = format_number($R[$z]);
                        json_row("$z-$C", ($z == "Rows" && $X && $R["Engine"] == ($Bh == "pgsql" ? "table" : "InnoDB") ? "~ $X" : $X));
                        if (isset($Qh[$z]))
                            $Qh[$z] += ($R["Engine"] != "InnoDB" || $z != "Data_free" ? $R[$z] : 0);
                    } elseif (array_key_exists($z, $R))
                        json_row("$z-$C");
                }
            }
        }
        foreach ($Qh as $z => $X)
            json_row("sum-$z", format_number($X));
        json_row("");
    } elseif ($_GET["script"] == "kill")
        $h->query("KILL " . number($_POST["kill"]));
    else {
        foreach (count_tables($b->databases()) as $m => $X) {
            json_row("tables-$m", $X);
            json_row("size-$m", db_size($m));
        }
        json_row("");
    }
    exit;
} else {
    $Zh = array_merge((array) $_POST["tables"], (array) $_POST["views"]);
    if ($Zh && !$o && !$_POST["search"]) {
        $H  = true;
        $Oe = "";
        if ($y == "sql" && $_POST["tables"] && count($_POST["tables"]) > 1 && ($_POST["drop"] || $_POST["truncate"] || $_POST["copy"]))
            queries("SET foreign_key_checks = 0");
        if ($_POST["truncate"]) {
            if ($_POST["tables"])
                $H = truncate_tables($_POST["tables"]);
            $Oe = lang(263);
        } elseif ($_POST["move"]) {
            $H  = move_tables((array) $_POST["tables"], (array) $_POST["views"], $_POST["target"]);
            $Oe = lang(264);
        } elseif ($_POST["copy"]) {
            $H  = copy_tables((array) $_POST["tables"], (array) $_POST["views"], $_POST["target"]);
            $Oe = lang(265);
        } elseif ($_POST["drop"]) {
            if ($_POST["views"])
                $H = drop_views($_POST["views"]);
            if ($H && $_POST["tables"])
                $H = drop_tables($_POST["tables"]);
            $Oe = lang(266);
        } elseif ($y != "sql") {
            $H  = ($y == "sqlite" ? queries("VACUUM") : apply_queries("VACUUM" . ($_POST["optimize"] ? "" : " ANALYZE"), $_POST["tables"]));
            $Oe = lang(267);
        } elseif (!$_POST["tables"])
            $Oe = lang(9);
        elseif ($H = queries(($_POST["optimize"] ? "OPTIMIZE" : ($_POST["check"] ? "CHECK" : ($_POST["repair"] ? "REPAIR" : "ANALYZE"))) . " TABLE " . implode(", ", array_map('idf_escape', $_POST["tables"])))) {
            while ($J = $H->fetch_assoc())
                $Oe .= "<b>" . h($J["Table"]) . "</b>: " . h($J["Msg_text"]) . "<br>";
        }
        queries_redirect(substr(ME, 0, -1), $Oe, $H);
    }
    page_header(($_GET["ns"] == "" ? lang(38) . ": " . h(DB) : lang(78) . ": " . h($_GET["ns"])), $o, true);
    if ($b->homepage()) {
        if ($_GET["ns"] !== "") {
            echo "<h3 id='tables-views'>" . lang(268) . "</h3>\n";
            $Yh = tables_list();
            if (!$Yh)
                echo "<p class='message'>" . lang(9) . "\n";
            else {
                echo "<form action='' method='post'>\n";
                if (support("table")) {
                    echo "<fieldset><legend>" . lang(269) . " <span id='selected2'></span></legend><div>", "<input type='search' name='query' value='" . h($_POST["query"]) . "'>", script("qsl('input').onkeydown = partialArg(bodyKeydown, 'search');", ""), " <input type='submit' name='search' value='" . lang(57) . "'>\n", "</div></fieldset>\n";
                    if ($_POST["search"] && $_POST["query"] != "") {
                        $_GET["where"][0]["op"] = "LIKE %%";
                        search_tables();
                    }
                }
                $ec = doc_link(array(
                    'sql' => 'show-table-status.html'
                ));
                echo "<div class='scrollable'>\n", "<table cellspacing='0' class='nowrap checkable'>\n", script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"), '<thead><tr class="wrap">', '<td><input id="check-all" type="checkbox" class="jsonly">' . script("qs('#check-all').onclick = partial(formCheck, /^(tables|views)\[/);", ""), '<th>' . lang(131), '<td>' . lang(270) . doc_link(array(
                    'sql' => 'storage-engines.html'
                )), '<td>' . lang(122) . doc_link(array(
                    'sql' => 'charset-charsets.html',
                    'mariadb' => 'supported-character-sets-and-collations/'
                )), '<td>' . lang(271) . $ec, '<td>' . lang(272) . $ec, '<td>' . lang(273) . $ec, '<td>' . lang(52) . doc_link(array(
                    'sql' => 'example-auto-increment.html',
                    'mariadb' => 'auto_increment/'
                )), '<td>' . lang(274) . $ec, (support("comment") ? '<td>' . lang(51) . $ec : ''), "</thead>\n";
                $S = 0;
                foreach ($Yh as $C => $T) {
                    $dj = ($T !== null && !preg_match('~table~i', $T));
                    $u  = h("Table-" . $C);
                    echo '<tr' . odd() . '><td>' . checkbox(($dj ? "views[]" : "tables[]"), $C, in_array($C, $Zh, true), "", "", "", $u), '<th>' . (support("table") || support("indexes") ? "<a href='" . h(ME) . "table=" . urlencode($C) . "' title='" . lang(43) . "' id='$u'>" . h($C) . '</a>' : h($C));
                    if ($dj) {
                        echo '<td colspan="6"><a href="' . h(ME) . "view=" . urlencode($C) . '" title="' . lang(44) . '">' . (preg_match('~materialized~i', $T) ? lang(129) : lang(130)) . '</a>', '<td align="right"><a href="' . h(ME) . "select=" . urlencode($C) . '" title="' . lang(42) . '">?</a>';
                    } else {
                        foreach (array(
                            "Engine" => array(),
                            "Collation" => array(),
                            "Data_length" => array(
                                "create",
                                lang(45)
                            ),
                            "Index_length" => array(
                                "indexes",
                                lang(133)
                            ),
                            "Data_free" => array(
                                "edit",
                                lang(46)
                            ),
                            "Auto_increment" => array(
                                "auto_increment=1&create",
                                lang(45)
                            ),
                            "Rows" => array(
                                "select",
                                lang(42)
                            )
                        ) as $z => $A) {
                            $u = " id='$z-" . h($C) . "'";
                            echo ($A ? "<td align='right'>" . (support("table") || $z == "Rows" || (support("indexes") && $z != "Data_length") ? "<a href='" . h(ME . "$A[0]=") . urlencode($C) . "'$u title='$A[1]'>?</a>" : "<span$u>?</span>") : "<td id='$z-" . h($C) . "'>");
                        }
                        $S++;
                    }
                    echo (support("comment") ? "<td id='Comment-" . h($C) . "'>" : "");
                }
                echo "<tr><td><th>" . lang(247, count($Yh)), "<td>" . h($y == "sql" ? $h->result("SELECT @@storage_engine") : ""), "<td>" . h(db_collation(DB, collations()));
                foreach (array(
                    "Data_length",
                    "Index_length",
                    "Data_free"
                ) as $z)
                    echo "<td align='right' id='sum-$z'>";
                echo "</table>\n", "</div>\n";
                if (!information_schema(DB)) {
                    echo "<div class='footer'><div>\n";
                    $Xi = "<input type='submit' value='" . lang(275) . "'> " . on_help("'VACUUM'");
                    $zf = "<input type='submit' name='optimize' value='" . lang(276) . "'> " . on_help($y == "sql" ? "'OPTIMIZE TABLE'" : "'VACUUM OPTIMIZE'");
                    echo "<fieldset><legend>" . lang(126) . " <span id='selected'></span></legend><div>" . ($y == "sqlite" ? $Xi : ($y == "pgsql" ? $Xi . $zf : ($y == "sql" ? "<input type='submit' value='" . lang(277) . "'> " . on_help("'ANALYZE TABLE'") . $zf . "<input type='submit' name='check' value='" . lang(278) . "'> " . on_help("'CHECK TABLE'") . "<input type='submit' name='repair' value='" . lang(279) . "'> " . on_help("'REPAIR TABLE'") : ""))) . "<input type='submit' name='truncate' value='" . lang(280) . "'> " . on_help($y == "sqlite" ? "'DELETE'" : "'TRUNCATE" . ($y == "pgsql" ? "'" : " TABLE'")) . confirm() . "<input type='submit' name='drop' value='" . lang(127) . "'>" . on_help("'DROP TABLE'") . confirm() . "\n";
                    $l = (support("scheme") ? $b->schemas() : $b->databases());
                    if (count($l) != 1 && $y != "sqlite") {
                        $m = (isset($_POST["target"]) ? $_POST["target"] : (support("scheme") ? $_GET["ns"] : DB));
                        echo "<p>" . lang(281) . ": ", ($l ? html_select("target", $l, $m) : '<input name="target" value="' . h($m) . '" autocapitalize="off">'), " <input type='submit' name='move' value='" . lang(282) . "'>", (support("copy") ? " <input type='submit' name='copy' value='" . lang(283) . "'> " . checkbox("overwrite", 1, $_POST["overwrite"], lang(284)) : ""), "\n";
                    }
                    echo "<input type='hidden' name='all' value=''>";
                    echo script("qsl('input').onclick = function () { selectCount('selected', formChecked(this, /^(tables|views)\[/));" . (support("table") ? " selectCount('selected2', formChecked(this, /^tables\[/) || $S);" : "") . " }"), "<input type='hidden' name='token' value='$si'>\n", "</div></fieldset>\n", "</div></div>\n";
                }
                echo "</form>\n", script("tableCheck();");
            }
            echo '<p class="links"><a href="' . h(ME) . 'create=">' . lang(75) . "</a>\n", (support("view") ? '<a href="' . h(ME) . 'view=">' . lang(204) . "</a>\n" : "");
            if (support("routine")) {
                echo "<h3 id='routines'>" . lang(143) . "</h3>\n";
                $Zg = routines();
                if ($Zg) {
                    echo "<table cellspacing='0'>\n", '<thead><tr><th>' . lang(183) . '<td>' . lang(50) . '<td>' . lang(221) . "<td></thead>\n";
                    odd('');
                    foreach ($Zg as $J) {
                        $C = ($J["SPECIFIC_NAME"] == $J["ROUTINE_NAME"] ? "" : "&name=" . urlencode($J["ROUTINE_NAME"]));
                        echo '<tr' . odd() . '>', '<th><a href="' . h(ME . ($J["ROUTINE_TYPE"] != "PROCEDURE" ? 'callf=' : 'call=') . urlencode($J["SPECIFIC_NAME"]) . $C) . '">' . h($J["ROUTINE_NAME"]) . '</a>', '<td>' . h($J["ROUTINE_TYPE"]), '<td>' . h($J["DTD_IDENTIFIER"]), '<td><a href="' . h(ME . ($J["ROUTINE_TYPE"] != "PROCEDURE" ? 'function=' : 'procedure=') . urlencode($J["SPECIFIC_NAME"]) . $C) . '">' . lang(136) . "</a>";
                    }
                    echo "</table>\n";
                }
                echo '<p class="links">' . (support("procedure") ? '<a href="' . h(ME) . 'procedure=">' . lang(220) . '</a>' : '') . '<a href="' . h(ME) . 'function=">' . lang(219) . "</a>\n";
            }
            if (support("sequence")) {
                echo "<h3 id='sequences'>" . lang(285) . "</h3>\n";
                $nh = get_vals("SELECT sequence_name FROM information_schema.sequences WHERE sequence_schema = current_schema() ORDER BY sequence_name");
                if ($nh) {
                    echo "<table cellspacing='0'>\n", "<thead><tr><th>" . lang(183) . "</thead>\n";
                    odd('');
                    foreach ($nh as $X)
                        echo "<tr" . odd() . "><th><a href='" . h(ME) . "sequence=" . urlencode($X) . "'>" . h($X) . "</a>\n";
                    echo "</table>\n";
                }
                echo "<p class='links'><a href='" . h(ME) . "sequence='>" . lang(226) . "</a>\n";
            }
            if (support("type")) {
                echo "<h3 id='user-types'>" . lang(26) . "</h3>\n";
                $Vi = types();
                if ($Vi) {
                    echo "<table cellspacing='0'>\n", "<thead><tr><th>" . lang(183) . "</thead>\n";
                    odd('');
                    foreach ($Vi as $X)
                        echo "<tr" . odd() . "><th><a href='" . h(ME) . "type=" . urlencode($X) . "'>" . h($X) . "</a>\n";
                    echo "</table>\n";
                }
                echo "<p class='links'><a href='" . h(ME) . "type='>" . lang(230) . "</a>\n";
            }
            if (support("event")) {
                echo "<h3 id='events'>" . lang(144) . "</h3>\n";
                $K = get_rows("SHOW EVENTS");
                if ($K) {
                    echo "<table cellspacing='0'>\n", "<thead><tr><th>" . lang(183) . "<td>" . lang(286) . "<td>" . lang(210) . "<td>" . lang(211) . "<td></thead>\n";
                    foreach ($K as $J) {
                        echo "<tr>", "<th>" . h($J["Name"]), "<td>" . ($J["Execute at"] ? lang(287) . "<td>" . $J["Execute at"] : lang(212) . " " . $J["Interval value"] . " " . $J["Interval field"] . "<td>$J[Starts]"), "<td>$J[Ends]", '<td><a href="' . h(ME) . 'event=' . urlencode($J["Name"]) . '">' . lang(136) . '</a>';
                    }
                    echo "</table>\n";
                    $Bc = $h->result("SELECT @@event_scheduler");
                    if ($Bc && $Bc != "ON")
                        echo "<p class='error'><code class='jush-sqlset'>event_scheduler</code>: " . h($Bc) . "\n";
                }
                echo '<p class="links"><a href="' . h(ME) . 'event=">' . lang(209) . "</a>\n";
            }
            if ($Yh)
                echo script("ajaxSetHtml('" . js_escape(ME) . "script=db');");
        }
    }
}
page_footer();