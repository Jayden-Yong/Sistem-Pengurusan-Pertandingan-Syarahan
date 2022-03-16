<?php
    # Starting session
    session_start();

    # Essential files
    include('guard-hakim.php');

    # POST variable check
    if(!empty($_POST))
    {
        include('connectdb.php');

        # Data validation for NoKP
        if(strlen($_POST['nokp']) != 12 or !is_numeric($_POST['nokp']))
        {
            die("
                <script>
                    alert('Ralat pada nombor kad pengenalan.');
                    window.location.href='hakim-register-form.php';
                </script>
            ");
        }

        # Command for automated ID genaration
        $cmd = "SELECT COUNT(*) AS bil FROM hakim";
        $result = mysqli_fetch_array(mysqli_query($con,$cmd));
        $bil = $result['bil'] + 1;
        $ID = "HA$bil";

        $result = mysqli_query($con,$cmd);

        # Command for registering new judge data
        $cmd = "INSERT INTO hakim (`IDHakim`,`NoKP_Hakim`,`Nama_Hakim`,`Kata_Laluan`) 
        VALUES ('$ID','".$_POST['nokp']."','".$_POST['nama']."','".$_POST['katalaluan']."')";

        $result = mysqli_query($con,$cmd);

        if($result)
        {
            # If registeration succeeded
            echo "
                <script>
                    alert('Pendaftaran berjaya.');
                    window.location.href='hakim-list.php';
                </script>
            ";
        }
        else
        {
            # If registeration failed
            echo "
                <script>
                    alert('Pendaftaran gagal.');
                    window.location.href='hakim-register-form.php';
                </script>
            ";
        }
    }
    else
    {
        # If POST is empty
        die("
            <script>
                alert('Sila lengkapkan data.');
                window.location.href='hakim-register-form.php';
            </script>
        ");
    }
?>