<?php
    # Starting session
    session_start();

    # Essential files
    include('guard-hakim.php');

    # POST variable check
    if(!empty($_POST))
    {
        include('connectdb.php');

        # Data validation
        if(strlen($_POST['nokp']) != 12 or !is_numeric($_POST['nokp']))
        {
            die("
                <script>
                    alert('Ralat Nombor KP');
                    window.history.back();
                </script>
            ");
        }

        # Command (query) for updating peserta data
        $cmd = "UPDATE peserta SET
        Nama_Peserta = '".$_POST['nama']."',
        NoKP = '".$_POST['nokp']."',
        Tingkatan = '".$_POST['tingkatan']."',
        Kata_Laluan = '".$_POST['katalaluan']."' 
        WHERE NoKP = '".$_GET['nokp_lama']."'";

        $result = mysqli_query($con,$cmd) or die(mysqli_error($con));

        # Execution check
        if($result)
        {
            # Update success
            echo "
                <script>
                    alert('Kemaskini Berjaya');
                    window.location.href='peserta-list.php';
                </script>
            ";
        }
        else
        {
            # Update failed
            echo $result;
            #echo "
            #    <script>
            #        alert('Kemaskini Gagal');
            #        window.history.back();
            #    </script>
            #";
        }
    }
    else
    {
        # POST is not complete
        die("
            <script>
                alert('Sila lengkapkan data.');
                window.history.back();
            </script>
        ");
    }
?>