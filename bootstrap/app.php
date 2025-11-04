<?php
    // dd helper funcrtion
    

    if (!function_exists('dd')) {
        /**
         * Hacker-style debug dumper with Matrix theme, copy-to-clipboard, and file/line.
         * Designed for personal use — clean, fast, beautiful.
         */
        function dd(...$args): never
        {
            $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
            $file = $trace['file'] ?? 'unknown';
            $line = $trace['line'] ?? '0';
            $rel = ltrim(str_replace([$_SERVER['DOCUMENT_ROOT'] ?? '', '\\'], ['', '/'], $file), '/');
    
            echo '<!DOCTYPE html><html lang="en"><head>';
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
                .v{margin-bottom:16px;border:1px solid var(--dim);border-radius:6px;overflow:hidden}
                .vh{background:#001100;padding:8px 12px;display:flex;align-items:center;gap:8px;font-size:13px}
                .i{width:18px;height:18px;background:var(--fg);color:#000;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:bold}
                .vb{background:#000;padding:12px;overflow-x:auto}
                pre{margin:0;white-space:pre-wrap;word-wrap:break-word;font-size:13px}
                .str{color:#0f8}
                .int,.flt{color:#0ff}
                .bool{color:#f00}
                .nul{color:#f80}
                .arr{color:#0f8}
                .obj{color:#f0f}
                .key{color:#8f8}
                .cpy{background:var(--fg);color:#000;border:none;padding:1px 5px;border-radius:3px;font-size:10px;cursor:pointer;margin-left:6px}
                .cpy:hover{background:#0c0}
            </style></head><body><div class="dd">';
            
            echo '<div class="h"><div class="t">DEBUG</div><div class="f">' . htmlspecialchars($rel . ':' . $line) . '</div></div>';
            echo '<div class="c">';
    
            foreach ($args as $i => $val) {
                $n = $i + 1;
                $t = strtolower(gettype($val));
                $c = match($t) {
                    'string' => 'str', 'integer' => 'int', 'double' => 'flt',
                    'boolean' => 'bool', 'null' => 'nul', 'array' => 'arr', 'object' => 'obj',
                    default => 'str'
                };
                $exp = htmlspecialchars(var_export($val, true), ENT_SUBSTITUTE);
                $exp = preg_replace([
                    '/&quot;(.*?)&quot;/',
                    '/\b(true|false)\b/i',
                    '/\bnull\b/i',
                    '/=&gt;/',
                    '/\[(\d+)\]/',
                    '/([a-zA-Z_\x7f-\xff][\w\x7f-\xff]*)(?=\s*=>|\s*\{)/'
                ], [
                    '<span class="str">"$1"</span>',
                    '<span class="bool">$1</span>',
                    '<span class="nul">null</span>',
                    '<span style="color:#666">=></span>',
                    '[<span class="int">$1</span>]',
                    '<span class="key">$1</span>'
                ], $exp);
    
                echo '<div class="v"><div class="vh"><div class="i">' . $n . '</div>Var #' . $n . ' <span style="color:#666">(' . $t . ')</span>';
                echo '<button class="cpy" onclick="copy(this)" data-clip="' . htmlspecialchars(strip_tags($exp)) . '">COPY</button></div>';
                echo '<div class="vb"><pre>' . $exp . '</pre></div></div>';
            }
    
            echo '</div></div>';
            echo '<script>
                function copy(el){navigator.clipboard.writeText(el.dataset.clip).then(()=>{el.innerText="OK";setTimeout(()=>{el.innerText="COPY"},800)})}
            </script>';
            echo '</body></html>';
            exit;
        }
    }

    require_once("../config/app.php");
    require_once("../config/database.php");
    
    require_once("../routes/web.php");
    require_once("../routes/api.php");

    $users = \App\Models\Role::all()->where('id','>','1')->get();
    dd($users);

    $routing = new \System\Router\Routing();
    $routing->run();
    
?>