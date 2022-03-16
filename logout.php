<?php
    # Starting session
    session_start();

    # Destroying session variable
    session_unset();

    # Stopping session
    session_destroy();

    echo "
    <script>
        window.location.href='index.php';
    </script>
    ";
?>