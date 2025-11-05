<?php
if (!function_exists('dd')) {
    function full_export($var, $depth = 0, $max_depth = 5, $max_items = 50, $max_length = 1000) {
        static $processed = [];
        $indent = str_repeat('  ', $depth);
        $type = gettype($var);

        if ($depth > $max_depth) return '...';

        // Prevent circular reference only for objects
        if ($type === 'object') {
            $hash = spl_object_hash($var);
            if (in_array($hash, $processed)) {
                return '**RECURSION**';
            }
            $processed[] = $hash;
        }

        switch ($type) {
            case 'array':
                if (empty($var)) return '[]';
                $count = count($var);
                $items = [];
                $i = 0;
                foreach ($var as $k => $v) {
                    if ($i++ >= $max_items) {
                        $items[] = "$indent  ... ($count items total)";
                        break;
                    }
                    $key = full_export($k, $depth + 1, $max_depth, $max_items, $max_length);
                    $val = full_export($v, $depth + 1, $max_depth, $max_items, $max_length);
                    $items[] = "$indent  $key => $val";
                }
                return "[\n" . implode(",\n", $items) . "\n$indent]";

            case 'object':
                $class = get_class($var);
                $props = [];
                $i = 0;
                
                try {
                    // Get ALL properties via reflection (protected, private)
                    $reflection = new ReflectionClass($var);
                    $properties = $reflection->getProperties();
                    
                    foreach ($properties as $property) {
                        if ($i++ >= $max_items) {
                            $props[] = "$indent  ... (more properties)";
                            break;
                        }
                        
                        $property->setAccessible(true);
                        $name = $property->getName();
                        $value = $property->getValue($var);
                        
                        // Add visibility indicator
                        if ($property->isPublic()) {
                            $visibility = '+';
                        } elseif ($property->isProtected()) {
                            $visibility = '#';
                        } else {
                            $visibility = '-';
                        }
                        
                        $key = $visibility . $name;
                        $val = full_export($value, $depth + 1, $max_depth, $max_items, $max_length);
                        $props[] = "$indent  \"$key\" => $val";
                    }

                    // Also get dynamic properties that aren't defined in class
                    $objectVars = (array) $var;
                    foreach ($objectVars as $key => $value) {
                        // Skip properties already processed via reflection
                        $cleanKey = preg_replace(['/^\x00.*\x00/', '/^\x00/'], '', $key);
                        if ($i >= $max_items) {
                            $props[] = "$indent  ... (more dynamic properties)";
                            break;
                        }

                        // Check if this is a dynamic property (not in reflection)
                        $isDynamic = true;
                        foreach ($properties as $property) {
                            if ($property->getName() === $cleanKey) {
                                $isDynamic = false;
                                break;
                            }
                        }

                        if ($isDynamic) {
                            $val = full_export($value, $depth + 1, $max_depth, $max_items, $max_length);
                            $props[] = "$indent  \"$cleanKey\" => $val";
                            $i++;
                        }
                    }

                } catch (Exception $e) {
                    $props[] = "$indent  \"error\" => \"Cannot inspect object: " . $e->getMessage() . "\"";
                }
                
                if (empty($props)) return "object($class) {}";
                return "object($class) {\n" . implode(",\n", $props) . "\n$indent}";

            case 'string':
                $str = addslashes($var);
                if (strlen($str) > $max_length) {
                    $str = substr($str, 0, $max_length) . '... (' . strlen($var) . ' chars)';
                }
                return '"' . $str . '"';

            case 'boolean': 
                return $var ? 'true' : 'false';
            case 'NULL': 
                return 'null';
            case 'integer': 
                return '(int) ' . $var;
            case 'double': 
                return '(float) ' . $var;
            default: 
                return '(' . $type . ') ' . var_export($var, true);
        }
    }

    function dd(...$args): never
    {
        // Temporary increase memory limit
        $originalMemoryLimit = ini_get('memory_limit');
        ini_set('memory_limit', '512M');
        set_time_limit(30);
        
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
        $file = $trace['file'] ?? 'unknown';
        $line = $trace['line'] ?? '0';
        $rel = ltrim(str_replace([$_SERVER['DOCUMENT_ROOT'] ?? '', '\\'], ['', '/'], $file), '/');

        echo '<!DOCTYPE html><html lang="en"><head>';
        echo '<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<title>DD • ' . htmlspecialchars($rel) . ':' . $line . '</title>';
        echo '<style>
            :root{--bg:#1a1a1a;--fg:#e0e0e0;--dim:#888;--border:#444;--shadow:rgba(0,0,0,.3)}
            *{margin:0;padding:0;box-sizing:border-box}
            body{font-family:"Fira Code","Courier New",monospace;background:var(--bg);color:var(--fg);padding:16px;line-height:1.6}
            .dd{max-width:1300px;margin:auto;background:var(--bg);border:1px solid var(--border);border-radius:8px;overflow:hidden;box-shadow:0 0 20px var(--shadow)}
            .header{background:#2a2a2a;padding:12px 16px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid var(--border);font-weight:600;font-size:14px}
            .title{color:var(--fg)}
            .file{color:var(--dim);font-size:11px}
            .content{padding:16px}
            .variable{margin-bottom:12px;border:1px solid var(--border);border-radius:6px;overflow:hidden}
            .var-header{background:#2a2a2a;padding:10px 12px;cursor:pointer;user-select:none;position:relative;display:flex;align-items:center;gap:8px;font-size:13px}
            .var-header::before{content:"▶";transition:transform .2s;font-size:10px}
            .variable[open] .var-header::before{transform:rotate(90deg)}
            .var-index{width:20px;height:20px;background:#666;color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:bold}
            .var-body{max-height:0;overflow:hidden;transition:max-height .4s ease;padding:0 12px;background:#1a1a1a}
            .variable[open] .var-body{max-height:5000px;padding:12px;overflow-x:auto}
            
            /* Collapsible styles for nested structures */
            .collapsible{position:relative}
            .collapsible-toggle{position:absolute;left:-15px;top:0;cursor:pointer;user-select:none;font-size:12px;color:#666;width:15px;text-align:center}
            .collapsible-toggle:hover{color:#888}
            .collapsible-content{margin-left:8px;border-left:1px solid #333;padding-left:12px}
            .collapsible.collapsed .collapsible-content{display:none}
            .collapsible.collapsed .collapsible-toggle::before{content:"+"}
            .collapsible:not(.collapsed) .collapsible-toggle::before{content:"-"}
            
            pre{margin:0;white-space:pre-wrap;word-wrap:break-word;font-size:12px;line-height:1.4;font-family:"Fira Code","Courier New",monospace;position:relative}
            .string{color:#4ec9b0}
            .integer{color:#b5cea8}
            .float{color:#b5cea8}
            .boolean{color:#569cd6}
            .null{color:#569cd6}
            .array{color:#4ec9b0}
            .object{color:#ce9178}
            .key{color:#9cdcfe}
            .visibility-public{color:#4ec9b0}
            .visibility-protected{color:#ffd700}
            .visibility-private{color:#f44747}
            .dynamic{color:#ce9178}
            .copy-btn{background:#666;color:#fff;border:none;padding:4px 8px;border-radius:3px;font-size:10px;cursor:pointer;margin-left:auto;font-weight:bold;transition:background .2s}
            .copy-btn:hover{background:#888}
            .warning{background:#442222;color:#ff6666;padding:8px;border-radius:4px;margin:8px 0;font-size:12px;border:1px solid #ff4444}
            summary{list-style:none}
            summary::-webkit-details-marker{display:none}
        </style></head><body><div class="dd">';
        
        echo '<div class="header"><div class="title">DEBUG OUTPUT</div><div class="file">' . htmlspecialchars($rel . ':' . $line) . '</div></div>';
        echo '<div class="content">';

        $first = true;
        foreach ($args as $i => $val) {
            try {
                $n = $i + 1;
                $type = strtolower(gettype($val));

                $raw = full_export($val);
                
                // Enhanced syntax highlighting
                $exp = htmlspecialchars($raw, ENT_SUBSTITUTE);
                
                // Add collapsible functionality to arrays and objects
                $exp = addCollapsible($exp);
                
                $exp = preg_replace([
                    // Strings
                    '/&quot;(.*?)&quot;/',
                    // Booleans
                    '/\b(true|false)\b/',
                    // Null
                    '/\bnull\b/',
                    // Array arrows
                    '/=&gt;/',
                    // Array indexes
                    '/\[(\d+)\]/',
                    // Public properties
                    '/&quot;\+([^&]*)&quot;\s*=&gt;/',
                    // Protected properties  
                    '/&quot;#([^&]*)&quot;\s*=&gt;/',
                    // Private properties
                    '/&quot;-([^&]*)&quot;\s*=&gt;/',
                    // Dynamic properties (no visibility prefix)
                    '/&quot;([a-zA-Z_][a-zA-Z0-9_]*)&quot;\s*=&gt;/',
                    // Integers
                    '/\(int\) (\d+)/',
                    // Floats
                    '/\(float\) ([\d.]+)/',
                ], [
                    '<span class="string">"$1"</span>',
                    '<span class="boolean">$1</span>',
                    '<span class="null">null</span>',
                    '<span style="color:#666">=></span>',
                    '[<span class="integer">$1</span>]',
                    '<span class="visibility-public">+$1</span><span style="color:#666">=></span>',
                    '<span class="visibility-protected">#$1</span><span style="color:#666">=></span>',
                    '<span class="visibility-private">-$1</span><span style="color:#666">=></span>',
                    '<span class="dynamic">$1</span><span style="color:#666">=></span>',
                    '<span class="integer">$1</span>',
                    '<span class="float">$1</span>'
                ], $exp);

                $plain = strip_tags($exp);

                echo '<details class="variable"' . ($first ? ' open' : '') . '>';
                echo '<summary class="var-header">
                        <div class="var-index">' . $n . '</div>
                        Variable #' . $n . ' <span style="color:#666">(' . $type . ')</span>
                        <button class="copy-btn" onclick="copyToClipboard(this)" data-clip="' . htmlspecialchars($plain, ENT_QUOTES) . '">COPY</button>
                      </summary>';
                echo '<div class="var-body"><pre>' . $exp . '</pre></div>';
                echo '</details>';

                $first = false;
            } catch (Throwable $e) {
                echo '<div class="warning">Error processing variable #' . ($i + 1) . ': ' . htmlspecialchars($e->getMessage()) . '</div>';
            }
        }

        echo '</div></div>';
        echo '<script>
                function copyToClipboard(el) {
                    const text = el.getAttribute("data-clip");
                    navigator.clipboard.writeText(text).then(() => {
                        const originalText = el.innerText;
                        el.innerText = "COPIED!";
                        setTimeout(() => {
                            el.innerText = originalText;
                        }, 1000);
                    }).catch(() => {
                        alert("Copy failed!");
                    });
                }
                
                // Collapsible functionality
                document.addEventListener("click", function(e) {
                    if (e.target.classList.contains("collapsible-toggle")) {
                        e.preventDefault();
                        const parent = e.target.closest(".collapsible");
                        parent.classList.toggle("collapsed");
                    }
                });
                
                // Auto-collapse large arrays/objects
                document.querySelectorAll(".collapsible").forEach(el => {
                    const content = el.querySelector(".collapsible-content");
                    if (content.textContent.length > 1000) {
                        el.classList.add("collapsed");
                    }
                });
              </script>';
        echo '</body></html>';
        
        // Restore original memory limit
        ini_set('memory_limit', $originalMemoryLimit);
        exit;
    }
    
    function addCollapsible($html) {
        // Add collapsible to arrays
        $html = preg_replace_callback('/(\s*)(\[[\s\S]*?\])(,?)(\s*)$/m', function($matches) {
            $indent = $matches[1];
            $content = $matches[2];
            $comma = $matches[3];
            $end = $matches[4];
            
            // Only make non-empty arrays/objects collapsible
            if (strlen(trim(strip_tags($content))) > 50) {
                return $indent . 
                       '<div class="collapsible">' .
                       '<span class="collapsible-toggle"></span>' .
                       '<div class="collapsible-content">' . $content . '</div>' .
                       '</div>' . $comma . $end;
            }
            
            return $matches[0];
        }, $html);
        
        // Add collapsible to objects
        $html = preg_replace_callback('/(\s*)(object\([^)]+\) \{[\s\S]*?\})(,?)(\s*)$/m', function($matches) {
            $indent = $matches[1];
            $content = $matches[2];
            $comma = $matches[3];
            $end = $matches[4];
            
            return $indent . 
                   '<div class="collapsible">' .
                   '<span class="collapsible-toggle"></span>' .
                   '<div class="collapsible-content">' . $content . '</div>' .
                   '</div>' . $comma . $end;
        }, $html);
        
        return $html;
    }
}
    require_once("../config/app.php");
    require_once("../config/database.php");
    
    require_once("../routes/web.php");
    require_once("../routes/api.php");

    $category = \App\Models\User::all();
    dd($category);  
    $routing = new \System\Router\Routing();
    $routing->run();
    
?>