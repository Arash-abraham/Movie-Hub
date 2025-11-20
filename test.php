<?php
    $content = '{% block  sd %}
                        <h1>hello</h1>
                {% endblock %} sadsadsadsasadsaddsa';

    preg_match_all("/\s*{%\s+block\s+([\w_]+)\s*%}(.*?){%\s+endblock\s*%}/s", $content, $matches, PREG_UNMATCHED_AS_NULL);

    print_r($matches);
?>