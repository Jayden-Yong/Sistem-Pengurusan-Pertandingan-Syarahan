<?php
    # Starting session
    session_start();

    # Essential files
    include('guard-hakim.php');

    # GET variable check
    if(!empty($_GET))
    {
        include('connectdb.php');

        # Command for extermination based on NoKP
        $cmd = "DELETE FROM peserta WHERE NoKP = '".$_GET['nokp']."'";
        $result = mysqli_query($con,$cmd);

        if($result)
        {
            # Execution success
            echo "
                <script>
                    alert('Padam data berjaya');
                    window.location.href='peserta-list.php';
                </script>
            ";
        }
        else
        {
            # Execution failed
            echo "
                <script>
                    alert('Padam data gagal');
                    window.history.back();
                </script>
            ";
        }
    }
    else
    {
        die("
            <script>
                alert('Ralat! Akses secara terus.');
                window.location.href='peserta-list.php';
            </script>
        ");
    }
?>