<?php
        $db_host = "localhost";
        $db_user = "root";
        $db_pass = "";
        $db_name = "finals";

        $conn = new mysqli($db_host,$db_user,$db_pass,$db_name);

        if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
        }
        function sanitize($input){
                return strip_tags($input);
        }
        function display_error($error) {
                if (!empty($error)) {
                        echo '<p class="error" style="display: block;">' . htmlspecialchars($error) . '</p>';
                } else {
                        echo '<p class="error" style="display: none;"></p>';
                }
        }
?>
