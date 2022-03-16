<?php
    # Integrated login form (User type verification)
    # Starting session
    session_start();

    # Checking POST existence in login-form.php
    if(!empty($_POST['nokp']) and !empty($_POST['katalaluan']))
    {
        include('connectdb.php');

        # Perform verification in peserta
        $verify_cmd = "SELECT * FROM peserta JOIN tingkatan ON tingkatan.Tingkatan = peserta.Tingkatan
        WHERE peserta.NoKP = '".$_POST['nokp']."' AND peserta.Kata_Laluan = '".$_POST['katalaluan']."'";

        $verify_result = mysqli_query($con,$verify_cmd);

        if(mysqli_num_rows($verify_result)==1)
        {
            # Fetch retrieved data
            $m = mysqli_fetch_array($verify_result);

            # Data assignment
            $_SESSION['nama'] = $m['Nama_Peserta'];
            $_SESSION['tingkatan'] = $m['Tingkatan'];
            $_SESSION['nokp'] = $m['NoKP'];
            $_SESSION['kod'] = $m['Kod_Kumpulan'];
            $_SESSION['tahap'] = "peserta";

            # Redirection to Peserta homepage
            echo "
            <script>
                window.location.href='peserta-menu.php';
            </script>
            ";
        }
        # If no matching data was found in peserta
        else
        {
            # Perform verification in hakim
            $verify_cmd = "SELECT * FROM hakim 
            JOIN penilaian ON penilaian.IDHakim = hakim.IDHakim
            WHERE NoKP_Hakim = '".$_POST['nokp']."' 
            AND Kata_Laluan = '".$_POST['katalaluan']."'";

            $verify_result = mysqli_query($con,$verify_cmd);

            if(mysqli_num_rows($verify_result)==1)
            {
                # Fetch retrieved data
                $m = mysqli_fetch_array($verify_result);

                # Data assignment
                $_SESSION['id'] = $m['IDHakim'];
                $_SESSION['nama'] = $m['Nama_Hakim'];
                $_SESSION['nokp'] = $m['NoKP_Hakim'];
                $_SESSION['idaspek'] = $m['IDPenilaian'];
                $_SESSION['aspek'] = $m['Aspek'];
                $_SESSION['tahap'] = "hakim";

                # Redirection to Hakim homepage
                echo "
                <script>
                    window.location.href='hakim-menu.php';
                </script>
                ";
            }
            # If no matching data was found in hakim
            else
            {
                die("
                <script>
                    alert('Login Gagal');
                    window.location.href='login-form.php';
                </script>
                ");
            }
        }
    }
    else
    {
        die("
        <script>
            alert('Sila masukkan NoKP dan Kata laluan');
            window.location.href='login-form.php';
        </script>
        ");
    }
?>