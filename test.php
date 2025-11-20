<?php
    $content = '{% block test %}test{% endblock %}';
    
    preg_match_all("/\s*{%\s+block\s+([\w_]+)\s*%}(.*?){%\s+endblock\s+\\1\s*%}/s", $content, $matches, PREG_UNMATCHED_AS_NULL);
    
    print_r($matches);
?>