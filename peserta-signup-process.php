<?php
    # Starting session
    session_start();

    # Check POST existence
    if(!empty($_POST))
    {
        include('connectdb.php');

        # Data Validation : max and min length
        if(strlen($_POST['nokp']) < 8 or !is_numeric($_POST['nokp']))
        {
            # Error notification (Modal change in future)
            die("<scrpit>alert('Ralat pada nombor Kad Pengenalan');
            window.location.href='peserta-signup-form.php';</script>");
        }

        # Competiton group (code) verification
        $code_cmd = "SELECT Kod_Kumpulan FROM tingkatan WHERE `Tingkatan` = '".$_POST['tingkatan']."'";
        $code_result = mysqli_query($con,$code_cmd);
        $code = mysqli_fetch_assoc($code_result);

        # Command (Query) for inserting new competitor data
        $insert_cmd = "INSERT INTO peserta (`NoKP`,`Nama_Peserta`,`Tingkatan`,`Kata_Laluan`) 
        VALUES ('".$_POST['nokp']."','".$_POST['nama']."','".$_POST['tingkatan']."','".$_POST['katalaluan']."')";
        
        $result_insert = mysqli_query($con,$insert_cmd);

        # Command (Query) for inserting new competitor competiton details
        $insert_cmd = "INSERT INTO keputusan (`NoKP`,`IDPenilaian`) 
        VALUES ('".$_POST['nokp']."','P1'),('".$_POST['nokp']."','P2'),('".$_POST['nokp']."','P3'),
        ('".$_POST['nokp']."','P4'),('".$_POST['nokp']."','P5'),('".$_POST['nokp']."','P6')";

        $result_insert = mysqli_query($con,$insert_cmd);

        # Registeration status check
        if($result_insert)
        {
            die("<script>alert('Pendaftaran berjaya. Sila login untuk melihat keputusan.');
            window.location.href='index.php';</script>");
        }
        else
        {
            die("<script>alert('Pendaftaran gagal');
            window.location.href='peserta-signup-form.php';</script>");
        }
    }
    else
    {
        die("<script>alert('Sila lengkapkan maklumat berikut');
        window.location.href='peserta-signup-form.php';</script>");
    }
?>