<?php
    session_start();
    function connection() {
        global $dbLink;
        try {
            $dbLink = mysqli_connect('localhost', 'root', '');
            if (!$dbLink) {
                throw new Exception('Connection failed: ' . mysqli_connect_error());
            }
            
            if (!mysqli_select_db($dbLink, 'moive_db')) {
                throw new Exception('Database selection failed: ' . mysqli_error($dbLink));
            }

            mysqli_set_charset($dbLink, 'utf8');
        }
        catch (Exception $th) {
            print $th->getMessage();
            die();
        }
    }
    function sanitize($data) {
        return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
    }    
    function disconnect() {
        global $dbLink;
        mysqli_close($dbLink);
    }
    function hashPassword($ps) {
        $hashedPassword = md5(sha1(md5(base64_encode(md5(md5(sha1(sha1(md5($ps)))))))));
        return $hashedPassword;
    }
    function session() {
        if(!isset($_SESSION['admin_id'])) {
            header('Location:../html/404.html');
        }
    }
?>
