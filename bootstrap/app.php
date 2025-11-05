<?php
    if (!function_exists('dd')) {
        function full_export($var, $depth = 0, $max_depth = 30) {
            $indent = str_repeat('  ', $depth);
            $type = gettype($var);
    
            if ($depth > $max_depth) return '...';
    
            switch ($type) {
                case 'array':
                    if (empty($var)) return '[]';
                    $items = [];
                    foreach ($var as $k => $v) {
                        $key = full_export($k, $depth + 1, $max_depth);
                        $val = full_export($v, $depth + 1, $max_depth);
                        $items[] = "$indent  $key => $val";
                    }
                    return "[\n" . implode(",\n", $items) . "\n$indent]";
    
                case 'object':
                    $class = get_class($var);
                    $props = [];
                    foreach ((array)$var as $k => $v) {
                        $key = preg_replace(['/^\x00.*\x00/', '/^\x00.+\x00/'], ['', ''], $k);
                        $key = full_export($key, $depth + 1, $max_depth);
                        $val = full_export($v, $depth + 1, $max_depth);
                        $props[] = "$indent  \"$key\" => $val";
                    }
                    if (empty($props)) return "object($class) {}";
                    return "object($class) {\n" . implode(",\n", $props) . "\n$indent}";
    
                case 'string':
                    $str = addslashes($var);
                    if (strlen($str) > 1000) $str = substr($str, 0, 1000) . '...';
                    return '"' . $str . '"';
    
                case 'boolean': return $var ? 'true' : 'false';
                case 'NULL': return 'null';
                default: return var_export($var, true);
            }
        }
    
        function dd(...$args): never
        {
            $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
            $file = $trace['file'] ?? 'unknown';
            $line = $trace['line'] ?? '0';
            $rel = ltrim(str_replace([$_SERVER['DOCUMENT_ROOT'] ?? '', '\\'], ['', '/'], $file), '/');
    
            echo '<!DOCTYPE html><html lang="fa"><head>';
            echo '<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
            echo '<title>DD • ' . htmlspecialchars($rel) . ':' . $line . '</title>';
            echo '<style>
                :root{--bg:#000;--fg:#0f0;--dim:#080;--border:#0f0;--shadow:rgba(0,255,0,.3)}
                *{margin:0;padding:0;box-sizing:border-box}
                body{font-family:"Fira Code","Courier New",monospace;background:var(--bg);color:var(--fg);padding:16px;line-height:1.6}
                .dd{max-width:1100px;margin:auto;background:var(--bg);border:1px solid var(--border);border-radius:8px;overflow:hidden;box-shadow:0 0 20px var(--shadow)}
                .h{background:#001100;padding:10px 16px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid var(--border);font-weight:600;font-size:14px}
                .t{color:var(--fg)}
                .f{color:var(--dim);font-size:11px}
                .c{padding:16px}
                .v{margin-bottom:12px;border:1px solid var(--dim);border-radius:6px;overflow:hidden}
                .vh{background:#001100;padding:8px 12px;cursor:pointer;user-select:none;position:relative;display:flex;align-items:center;gap:8px;font-size:13px}
                .vh::before{content:"▶";transition:transform .2s;font-size:10px}
                .v[open] .vh::before{transform:rotate(90deg)}
                .i{width:18px;height:18px;background:var(--fg);color:#000;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:bold}
                .vb{max-height:0;overflow:hidden;transition:max-height .4s ease;padding:0 12px;background:#000}
                .v[open] .vb{max-height:2000px;padding:12px;overflow-x:auto}
                pre{margin:0;white-space:pre-wrap;word-wrap:break-word;font-size:13px;line-height:1.5}
                .str{color:#0f8}
                .int,.flt{color:#0ff}
                .bool{color:#f00}
                .nul{color:#f80}
                .arr{color:#0f8}
                .obj{color:#f0f}
                .key{color:#8f8}
                .cpy{background:var(--fg);color:#000;border:none;padding:2px 7px;border-radius:3px;font-size:10px;cursor:pointer;margin-left:auto;font-weight:bold}
                .cpy:hover{background:#0c0}
                summary{list-style:none}
                summary::-webkit-details-marker{display:none}
            </style></head><body><div class="dd">';
            
            echo '<div class="h"><div class="t">DEBUG</div><div class="f">' . htmlspecialchars($rel . ':' . $line) . '</div></div>';
            echo '<div class="c">';
    
            $first = true;
            foreach ($args as $i => $val) {
                $n = $i + 1;
                $t = strtolower(gettype($val));
    
                $raw = full_export($val);
                $exp = htmlspecialchars($raw, ENT_SUBSTITUTE);
                $exp = preg_replace([
                    '/&quot;(.*?)&quot;/',
                    '/\b(true|false)\b/i',
                    '/\bnull\b/i',
                    '/=&gt;/',
                    '/\[(\d+)\]/',
                    '/&quot;([^&]+)&quot;\s*=&gt;/'
                ], [
                    '<span class="str">"$1"</span>',
                    '<span class="bool">$1</span>',
                    '<span class="nul">null</span>',
                    '<span style="color:#666">=></span>',
                    '[<span class="int">$1</span>]',
                    '<span class="key">$1</span><span style="color:#666">=></span>'
                ], $exp);
    
                $plain = strip_tags($exp);
    
                echo '<details class="v"' . ($first ? ' open' : '') . '>';
                echo '<summary class="vh">
                        <div class="i">' . $n . '</div>
                        Var #' . $n . ' <span style="color:#666">(' . $t . ')</span>
                        <button class="cpy" onclick="copy(this)" data-clip="' . htmlspecialchars($plain, ENT_QUOTES) . '">COPY</button>
                      </summary>';
                echo '<div class="vb"><pre>' . $exp . '</pre></div>';
                echo '</details>';
    
                $first = false;
            }
    
            echo '</div></div>';
            echo '<script>
                    function copy(el){
                        navigator.clipboard.writeText(el.dataset.clip).then(()=>{
                            const orig = el.innerText;
                            el.innerText="OK";
                            setTimeout(()=>{el.innerText=orig},800);
                        }).catch(()=>{alert("کپی نشد!")});
                    }
                  </script>';
            echo '</body></html>';
            exit;
        }
    }
    require_once("../config/app.php");
    require_once("../config/database.php");
    
    require_once("../routes/web.php");
    require_once("../routes/api.php");

    $category = \App\Models\Category::all();
    dd($category);

    $routing = new \System\Router\Routing();
    $routing->run();
    
?>