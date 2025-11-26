<?php
    use System\View\ViewBuilder;

    function view($dir , $vars = []) {
        $loader = new \Twig\Loader\FilesystemLoader(BASE_DIR . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'View');
        $twig = new \Twig\Environment($loader);
        
        $data = $vars;
        $path = str_replace('.','/',$dir);
        echo $twig->render($path.'.twig', $data);
    }

    if (!function_exists('dd')) {
        function full_export($var, $depth = 0, $max_depth = 5, $max_items = 50, $max_length = 1000) {
            static $processed = [];
            $indent = str_repeat('  ', $depth);
            $type = gettype($var);
    
            if ($depth > $max_depth) return "'...'";
    
            // Prevent circular reference only for objects
            if ($type === 'object') {
                $hash = spl_object_hash($var);
                if (in_array($hash, $processed)) {
                    return "'**RECURSION**'";
                }
                $processed[] = $hash;
            }
    
            switch ($type) {
                case 'array':
                    if (empty($var)) return "[]";
                    $count = count($var);
                    $items = [];
                    $i = 0;
                    foreach ($var as $k => $v) {
                        if ($i++ >= $max_items) {
                            $items[] = "$indent  // ... ($count items total)";
                            break;
                        }
                        $key = is_int($k) ? $k : "'$k'";
                        $val = full_export($v, $depth + 1, $max_depth, $max_items, $max_length);
                        $items[] = "$indent  $key => $val";
                    }
                    return "[\n" . implode(",\n", $items) . "\n$indent]";
    
                case 'object':
                    $class = get_class($var);
                    $props = [];
                    $i = 0;
                    
                    try {
                        // Get ALL properties via reflection
                        $reflection = new ReflectionClass($var);
                        $properties = $reflection->getProperties();
                        
                        foreach ($properties as $property) {
                            if ($i++ >= $max_items) {
                                $props[] = "$indent  // ... (more properties)";
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
                            
                            $key = "'$visibility$name'";
                            $val = full_export($value, $depth + 1, $max_depth, $max_items, $max_length);
                            $props[] = "$indent  $key => $val";
                        }
    
                        // Get dynamic properties
                        $objectVars = (array) $var;
                        foreach ($objectVars as $key => $value) {
                            $cleanKey = preg_replace(['/^\x00.*\x00/', '/^\x00/'], '', $key);
                            if ($i >= $max_items) {
                                $props[] = "$indent  // ... (more dynamic properties)";
                                break;
                            }
    
                            $isDynamic = true;
                            foreach ($properties as $property) {
                                if ($property->getName() === $cleanKey) {
                                    $isDynamic = false;
                                    break;
                                }
                            }
    
                            if ($isDynamic && !empty($cleanKey)) {
                                $val = full_export($value, $depth + 1, $max_depth, $max_items, $max_length);
                                $props[] = "$indent  '$cleanKey' => $val";
                                $i++;
                            }
                        }
    
                    } catch (Exception $e) {
                        $props[] = "$indent  'error' => 'Cannot inspect object: " . $e->getMessage() . "'";
                    }
                    
                    if (empty($props)) return "$class {}";
                    return "$class {\n" . implode(",\n", $props) . "\n$indent}";
    
                case 'string':
                    // Escape and truncate long strings
                    $str = addslashes($var);
                    if (strlen($str) > $max_length) {
                        $str = substr($str, 0, $max_length) . '... (' . strlen($var) . ' chars)';
                    }
                    return "'$str'";
    
                case 'boolean': 
                    return $var ? 'true' : 'false';
                case 'NULL': 
                    return 'null';
                case 'integer': 
                    return $var;
                case 'double': 
                    return $var;
                default: 
                    return var_export($var, true);
            }
        }
    
        function format_output($output) {
            // Clean up the output formatting
            $output = preg_replace('/\n\s+\n/', "\n", $output);
            $output = preg_replace('/,\s*\]/', "\n]", $output);
            $output = preg_replace('/,\s*\}/', "\n}", $output);
            return $output;
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
                :root {
                    --bg: #1a1a1a;
                    --fg: #e0e0e0;
                    --dim: #888;
                    --border: #444;
                    --shadow: rgba(0,0,0,.3);
                }
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }
                body {
                    font-family: "Fira Code", "Courier New", monospace;
                    background: var(--bg);
                    color: var(--fg);
                    padding: 16px;
                    line-height: 1.6;
                }
                .dd {
                    max-width: 1300px;
                    margin: auto;
                    background: var(--bg);
                    border: 1px solid var(--border);
                    border-radius: 8px;
                    overflow: hidden;
                    box-shadow: 0 0 20px var(--shadow);
                }
                .header {
                    background: #2a2a2a;
                    padding: 12px 16px;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    border-bottom: 1px solid var(--border);
                    font-weight: 600;
                    font-size: 14px;
                }
                .title {
                    color: var(--fg);
                }
                .file {
                    color: var(--dim);
                    font-size: 11px;
                }
                .content {
                    padding: 16px;
                }
                .variable {
                    margin-bottom: 16px;
                    border: 1px solid var(--border);
                    border-radius: 6px;
                    overflow: hidden;
                }
                .var-header {
                    background: #2a2a2a;
                    padding: 12px 16px;
                    cursor: pointer;
                    user-select: none;
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    font-size: 14px;
                    border-bottom: 1px solid transparent;
                }
                .variable[open] .var-header {
                    border-bottom-color: var(--border);
                }
                .var-header::before {
                    content: "▶";
                    transition: transform 0.2s;
                    font-size: 10px;
                    width: 12px;
                    text-align: center;
                }
                .variable[open] .var-header::before {
                    transform: rotate(90deg);
                }
                .var-index {
                    width: 24px;
                    height: 24px;
                    background: #666;
                    color: #fff;
                    border-radius: 4px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 12px;
                    font-weight: bold;
                }
                .var-body {
                    padding: 0;
                    background: #1a1a1a;
                    overflow-x: auto;
                }
                .variable:not([open]) .var-body {
                    display: none;
                }
                .variable[open] .var-body {
                    padding: 16px;
                }
                pre {
                    margin: 0;
                    white-space: pre-wrap;
                    word-wrap: break-word;
                    font-size: 13px;
                    line-height: 1.5;
                    font-family: "Fira Code", "Courier New", monospace;
                }
                
                .string { color: #4ec9b0; }
                .integer { color: #b5cea8; }
                .float { color: #b5cea8; }
                .boolean { color: #569cd6; }
                .null { color: #569cd6; }
                .array { color: #4ec9b0; }
                .object { color: #ce9178; }
                .key { color: #9cdcfe; }
                .visibility-public { color: #4ec9b0; }
                .visibility-protected { color: #ffd700; }
                .visibility-private { color: #f44747; }
                .dynamic { color: #ce9178; }
                .comment { color: #6a9955; font-style: italic; }
                .copy-btn {
                    background: #666;
                    color: #fff;
                    border: none;
                    padding: 6px 12px;
                    border-radius: 4px;
                    font-size: 11px;
                    cursor: pointer;
                    margin-left: auto;
                    font-weight: bold;
                    transition: background 0.2s;
                }
                .copy-btn:hover {
                    background: #888;
                }
                .warning {
                    background: #442222;
                    color: #ff6666;
                    padding: 12px;
                    border-radius: 4px;
                    margin: 8px 0;
                    font-size: 12px;
                    border: 1px solid #ff4444;
                }
                summary {
                    list-style: none;
                }
                summary::-webkit-details-marker {
                    display: none;
                }
            </style></head><body><div class="dd">';
            
            echo '<div class="header">';
            echo '<div class="title">DEBUG OUTPUT</div>';
            echo '<div class="file">' . htmlspecialchars($rel . ':' . $line) . '</div>';
            echo '</div>';
            echo '<div class="content">';
    
            $first = true;
            foreach ($args as $i => $val) {
                try {
                    $n = $i + 1;
                    $type = gettype($val);
    
                    $raw = full_export($val);
                    $raw = format_output($raw);
                    
                    // Apply syntax highlighting
                    $highlighted = htmlspecialchars($raw, ENT_SUBSTITUTE);
                    $highlighted = preg_replace([
                        // Strings
                        '/\'([^\']*)\'/',
                        // Booleans
                        '/\b(true|false)\b/',
                        // Null
                        '/\bnull\b/',
                        // Comments
                        '/\/\/.*$/m',
                        // Array indexes
                        '/\[(\d+)\]/',
                        // Object class names
                        '/(\w+(?:\\\\\w+)*)\s*\{/',
                        // Visibility indicators
                        '/\'\+([^\']*)\' =>/',
                        '/\'#([^\']*)\' =>/',
                        '/\'-([^\']*)\' =>/',
                    ], [
                        '<span class="string">\'$1\'</span>',
                        '<span class="boolean">$1</span>',
                        '<span class="null">null</span>',
                        '<span class="comment">$0</span>',
                        '[<span class="integer">$1</span>]',
                        '<span class="object">$1</span> {',
                        '<span class="visibility-public">\'+$1\'</span> =>',
                        '<span class="visibility-protected">\'#$1\'</span> =>',
                        '<span class="visibility-private">\'-$1\'</span> =>',
                    ], $highlighted);
    
                    $plain = strip_tags($raw);
    
                    echo '<details class="variable"' . ($first ? ' open' : '') . '>';
                    echo '<summary class="var-header">';
                    echo '<div class="var-index">' . $n . '</div>';
                    echo 'Variable #' . $n . ' <span style="color:#666">(' . $type . ')</span>';
                    echo '<button class="copy-btn" onclick="copyToClipboard(this)" data-clip="' . htmlspecialchars($plain, ENT_QUOTES) . '">COPY</button>';
                    echo '</summary>';
                    echo '<div class="var-body">';
                    echo '<pre>' . $highlighted . '</pre>';
                    echo '</div>';
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
                  </script>';
            echo '</body></html>';
            
            // Restore original memory limit
            ini_set('memory_limit', $originalMemoryLimit);
            exit;
        }

        function html($text) {
            return html_entity_decode($text);
        }

        function old($name) {
            if(isset($_SESSION['temporary_old'][$name])) {
                return $_SESSION['temporary_old'][$name];
            }
            else {
                return NULL;
            }
        }
    }

    function flash($name , $msg = NULL) {
        if(empty($msg)) {
            if($_SESSION['temporaryFlash'][$name]) {
                $temporary = $_SESSION['temporaryFlash'][$name];
                unset($_SESSION['temporaryFlash'][$name]);
                return $temporary;
            }
            else {
                return false;
            }
        }
        else {
            $_SESSION['flash'][$name] = $msg;
        }
    }

    function flashExists($name) {
        if(isset($_SESSION['temporaryFlash'][$name])) {
            return true;
        }
        else {
            return false;
        }
    }

    function allFlash() {
        if($_SESSION['temporaryFlash']) {
            $temporary = $_SESSION['temporaryFlash'];
            unset($_SESSION['temporaryFlash']);
            return $temporary;
        }
        else {
            return false;
        }
    }

    function error($name , $msg = NULL) {
        if(empty($msg)) {
            if($_SESSION['temporaryErrorFlash'][$name]) {
                $temporary = $_SESSION['temporaryErrorFlash'][$name];
                unset($_SESSION['temporaryErrorFlash'][$name]);
                return $temporary;
            }
            else {
                return false;
            }
        }
        else {
            $_SESSION['errorFlash'][$name] = $msg;
        }
    }

    function errorExists($name) {
        if(isset($_SESSION['temporaryErrorFlash'][$name])) {
            return true;
        }
        else {
            return false;
        }
    }

    function allErrors() {
        if($_SESSION['temporaryErrorFlash']) {
            $temporary = $_SESSION['temporaryErrorFlash'];
            unset($_SESSION['temporaryErrorFlash']);
            return $temporary;
        }
        else {
            return false;
        }
    }
?>