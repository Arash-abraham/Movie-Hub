<?php
    // dd helper funcrtion
    
    function dd(...$args)
    {
        $backtrace = debug_backtrace()[0];
        
        echo <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Debug Output - Laravel Style</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Segoe UI', 'SF Pro Display', -apple-system, BlinkMacSystemFont, sans-serif;
                background: #000000;
                min-height: 100vh;
                padding: 20px;
            }
            
            .debug-container {
                max-width: 95%;
                margin: 0 auto;
                background: #000000;
                border-radius: 12px;
                border: 2px solid #00ff00;
                box-shadow: 0 0 30px rgba(0, 255, 0, 0.4);
                overflow: hidden;
            }
            
            .debug-header {
                background: #000000;
                color: #ff0000;
                padding: 20px 25px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 2px solid #00ff00;
            }
            
            .debug-title {
                display: flex;
                align-items: center;
                gap: 10px;
                font-weight: 600;
                font-size: 18px;
                color: #ff0000;
            }
            
            .debug-file {
                background: #000000;
                color: #00ff00;
                padding: 6px 12px;
                border-radius: 4px;
                font-size: 13px;
                font-family: 'Monaco', 'Consolas', monospace;
                border: 1px solid #00ff00;
            }
            
            .debug-content {
                padding: 25px;
                background: #000000;
            }
            
            .variable-section {
                margin-bottom: 25px;
                border: 1px solid #00ff00;
                border-radius: 8px;
                overflow: hidden;
                background: #000000;
            }
            
            .variable-header {
                background: #000000;
                padding: 12px 16px;
                border-bottom: 1px solid #00ff00;
                font-weight: 600;
                color: #ff0000;
                display: flex;
                align-items: center;
                gap: 8px;
            }
            
            .variable-index {
                background: #ff0000;
                color: #000000;
                width: 24px;
                height: 24px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                font-weight: bold;
            }
            
            .variable-content {
                background: #000000;
                color: #00ff00;
                padding: 0;
                overflow-x: auto;
            }
            
            .variable-pre {
                padding: 20px;
                margin: 0;
                font-family: 'Monaco', 'Consolas', 'Fira Code', monospace;
                font-size: 14px;
                line-height: 1.5;
                tab-size: 4;
                background: #000000;
                color: #00ff00;
            }
            
            .debug-footer {
                background: #000000;
                padding: 15px 25px;
                border-top: 2px solid #00ff00;
                text-align: center;
                color: #ff0000;
                font-size: 13px;
            }
            
            .type-string { color: #00ff00; }
            .type-integer { color: #00ff00; }
            .type-float { color: #00ff00; }
            .type-boolean { color: #ff0000; }
            .type-null { color: #ff0000; }
            .type-array { color: #00ff00; }
            .type-object { color: #ff0000; }
        </style>
    </head>
    <body>
        <div class="debug-container">
            <div class="debug-header">
                <div class="debug-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ff0000" stroke-width="2">
                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Debug Output
                </div>
                <div class="debug-file">
                    {$backtrace['file']}:{$backtrace['line']}
                </div>
            </div>
            
            <div class="debug-content">
    HTML;
    
        foreach ($args as $index => $arg) {
            $variableNumber = $index + 1;
            echo <<<HTML
                <div class="variable-section">
                    <div class="variable-header">
                        <div class="variable-index">{$variableNumber}</div>
                        Variable #{$variableNumber}
                    </div>
                    <div class="variable-content">
                        <pre class="variable-pre">
    HTML;
            
            highlight_string("<?php\n" . var_export($arg, true));
            
            echo <<<HTML
                        </pre>
                    </div>
                </div>
    HTML;
        }
    
        echo <<<HTML
            </div>
            
            <div class="debug-footer">
                ⚡ Debug Console • arash-abraham
            </div>
        </div>
    </body>
    </html>
    HTML;
        
        die(1);
    }

    require_once("../config/app.php");
    require_once("../config/database.php");
    
    require_once("../routes/web.php");
    require_once("../routes/api.php");

    $categories = \App\Models\Category::paginate(2);

    $routing = new \System\Router\Routing();
    $routing->run();
    
?>