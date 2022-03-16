<?php
    if(isset($_POST['btn-upload']))
    {
        include('connectdb.php');

        # Retrieve temp file name
        $tempname = $_FILES["data_peserta"]["tmp_name"];

        # Retrieve file name
        $filename = $_FILES["data_peserta"]["name"];

        # Retrieve file type
        $filetype = pathinfo($filename,PATHINFO_EXTENSION);

        # File test
        if($_FILES["data_peserta"]["size"] > 0 AND $filetype == "txt")
        {
            # Open file
            $peserta_data_file = fopen($tempname,"r");

            # Retrieve data from file
            while(!feof($peserta_data_file))
            {
                # Retrieve data in line form
                $getlinedata = fgets($peserta_data_file);

                # Break line based on criteria
                $breakline = explode("|",$getlinedata);

                list($nokp,$nama_peserta,$tingkatan,$katalaluan) = $breakline;

                # SQL command for inserting data
                $cmd = "INSERT INTO peserta (`NoKP`,`Nama_Peserta`,`Tingkatan`,`Kata_Laluan`) 
                VALUES ('$nokp','$nama_peserta','$tingkatan','$katalaluan')";

                $result = mysqli_query($con,$cmd);

                echo "
                    <script>
                        alert('Import file data selesai.');
                        window.location.href='peserta-list.php';
                    </script>
                ";
            }

            fclose($peserta_data_file);
        }
        else
        {
            # If not txt file
            echo "
                <script>
                    alert('Hanya fail berformat txt sahaja dibenarkan.');
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
                window.location.href='peserta-upload-form.php';
            </script>
        ");
    }
?>