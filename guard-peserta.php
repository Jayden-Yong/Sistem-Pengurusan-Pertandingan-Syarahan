<?php
    # Variable check on session['tahap']
    if($_SESSION['tahap'] != "peserta")
    {
        die("
        <script>
            alert('Sila login.');
            window.location.href='logout.php';
        </script>
        ");
    }
?>