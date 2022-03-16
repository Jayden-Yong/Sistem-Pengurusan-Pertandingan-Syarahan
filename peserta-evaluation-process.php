<?php
    # Starting session
    session_start();

    # GET variable check
    if(empty($_GET))
    {
        die("
            <script>
                window.location.href='peserta-evaluation.php';
            </script>
        ");
    }

    include('connectdb.php');

    # Command for retrieving maximum aspect mark
    $cmd = "SELECT Markah_Penuh FROM penilaian WHERE IDPenilaian = '".$_GET['id']."'";
    $result = mysqli_query($con,$cmd);

    $full = mysqli_fetch_array($result);

    # Mark validation
    if(($_POST['markah'] > $full['Markah_Penuh'] or $_POST['markah'] < 0) 
    or !is_numeric($_POST['markah']))
    {
        die("
            <script>
                alert('Ralat pada data markah');
                window.history.back();
            </script>
        ");
    }

    # Inserting marks into database
    $cmd = "UPDATE keputusan SET
    Markah = '".$_POST['markah']."'
    WHERE NoKP = '".$_GET['nokp']."'
    AND IDPenilaian = '".$_GET['id']."'";

    $result = mysqli_query($con,$cmd);

    # Notification
    if($result)
    {
        echo "
            <script>
                alert('Markah berjaya disimpan.');
                window.location.href='peserta-evaluation.php';
            </script>
        ";
    }
    else
    {
        echo "
            <script>
                alert('Markah gagal disimpan.');
                window.history.back();
            </script>
        ";
    }
?>