<?php
# Function for retrieving competitor list
function group_list()
{
    include('connectdb.php');
    $cmd = "SELECT * from tingkatan";
    $result = mysqli_query($con,$cmd);
    $list = "";
    while($m = mysqli_fetch_array($result))
    {
        echo "
            <option value='".$m['Kod_Kumpulan']."'>
                ".$m['Kod_Kumpulan']."
            </option>
        ";
    }
    return $list;
}

# Function for retrieving class list
function class_list()
{
    include('connectdb.php');
    $cmd = "SELECT * FROM tingkatan";
    $result = mysqli_query($con,$cmd);
    $list = "";
    while($m = mysqli_fetch_array($result))
    {
        echo "
                <option value='".$m['Tingkatan']."'>
                    ".$m['Tingkatan']."
                </option>
        ";
    }
    return $list;
}

# Function for retrieving dedicated aspect pending results
function pending()
{
    include('connectdb.php');
    $cmd = "SELECT COUNT(*) AS jumlah FROM keputusan
    WHERE IDPenilaian = '".$_SESSION['idaspek']."'
    AND Markah = 0";

    $result = mysqli_fetch_array(mysqli_query($con,$cmd));

    return $result['jumlah'];
}

# Function for retrieving overall contestants
function overall()
{
    include('connectdb.php');

    $cmd = "SELECT COUNT(*) AS jumlah FROM peserta";

    $result = mysqli_fetch_array(mysqli_query($con,$cmd));
    
    return $result['jumlah'];
}

# Function for retrieving total contestants
function total()
{
    include('connectdb.php');

    $cmd = "SELECT COUNT(*) AS jumlah FROM peserta 
    JOIN tingkatan ON tingkatan.Tingkatan = peserta.Tingkatan
    WHERE Kod_Kumpulan = '".$_SESSION['kod']."'";

    $result = mysqli_fetch_array(mysqli_query($con,$cmd));
    
    return $result['jumlah'];
}

# Function for retrieving dedicated result
function result()
{
    include('connectdb.php');

    $cmd = "SELECT * FROM keputusan 
    JOIN penilaian ON penilaian.IDPenilaian = keputusan.IDPenilaian
    WHERE NoKP = '".$_SESSION['nokp']."'";

    $result = mysqli_query($con,$cmd);

    return $result;
}

# Function for retrieving total marks
function total_marks($nokp)
{
    include('connectdb.php');
    $marks_cmd = "SELECT SUM(Markah) AS Jumlah FROM keputusan WHERE NoKP = '$nokp'";
    $marks_result = mysqli_query($con,$marks_cmd);

    $m = mysqli_fetch_array($marks_result);
    return $m['Jumlah'];
}

# Function for result completion check
# Higher form group
function check_hf()
{
    include('connectdb.php');

    # Command for retrieving total pending marks
    $pending_cmd = "SELECT COUNT(*) AS bil FROM keputusan 
    JOIN peserta ON peserta.NoKP = keputusan.NoKP 
    JOIN tingkatan ON tingkatan.Tingkatan = peserta.Tingkatan 
    WHERE Kod_Kumpulan = 'MA'";

    $pending_result = mysqli_query($con,$pending_cmd);
    $pending = mysqli_fetch_array($pending_result);

    # Command for retrieving registered marks
    $registered_cmd = "SELECT COUNT(*) AS bil FROM keputusan 
    JOIN peserta ON peserta.NoKP = keputusan.NoKP 
    JOIN tingkatan ON tingkatan.Tingkatan = peserta.Tingkatan 
    WHERE `Markah` > 0 AND tingkatan.Kod_Kumpulan = 'MA'";

    $registered_result = mysqli_query($con,$registered_cmd);
    $registered = mysqli_fetch_array($registered_result);

    if($registered['bil'] == $pending['bil'])
    {
        $status = "Semua peserta telah dinilai.";
    }
    else
    {
        $status = "
                    <span class='status'>
                        Penilaian peserta belum selesai.
                    </span>
                </div>
                <div class='text-center'>
                    <span class='status'>
                        Keputusan rasmi tidak dikeluarkan lagi.
                    </span>
                </div>
        ";
    }

    return $status;
}

# Lower form group
function check_lf()
{
    include('connectdb.php');

    # Command for retrieving total pending marks
    $pending_cmd = "SELECT COUNT(*) AS bil FROM keputusan 
    JOIN peserta ON peserta.NoKP = keputusan.NoKP 
    LEFT JOIN tingkatan ON tingkatan.Tingkatan = peserta.Tingkatan 
    WHERE tingkatan.Kod_Kumpulan = 'MR'";

    $pending_result = mysqli_query($con,$pending_cmd);
    $pending = mysqli_fetch_array($pending_result);

    # Command for retrieving registered marks
    $registered_cmd = "SELECT COUNT(*) AS bil FROM keputusan 
    JOIN peserta ON peserta.NoKP = keputusan.NoKP 
    LEFT JOIN tingkatan ON tingkatan.Tingkatan = peserta.Tingkatan 
    WHERE `Markah` > 0 AND tingkatan.Kod_Kumpulan = 'MR'";

    $registered_result = mysqli_query($con,$registered_cmd);
    $registered = mysqli_fetch_array($registered_result);

    if($registered['bil']==$pending['bil'])
    {
        $status = "Semua peserta telah dinilai.";
    }
    else
    {
        $status = "Penilaian peserta belum selesai.<br>
        Keputusan rasmi tidak dikeluarkan lagi";
    }

    return $status;
}

# Function for higher form leaderboard display
function leaderboard_hf()
{
    include('connectdb.php');

    # Table creation
    echo "<table class='table table-primary table-striped border-info border-2' width = '100%' border = '1' id = 'size'>
    <caption>".check_hf()."</caption>
    <tr>
        <td width='12%' class='text-center'>Kedudukan</td>
        <td width='38%'>Nama</td>
        <td width='20%'>Tingkatan</td>
        <td width='30%'>Jumlah Markah</td>
    </tr>";

    # Command for retrieving top 3 competitors
    $tophf_cmd = "SELECT peserta.Nama_Peserta, peserta.NoKP, tingkatan.Kod_Kumpulan, 
    peserta.Tingkatan, SUM(keputusan.Markah) AS jumlah FROM peserta 
    JOIN keputusan ON peserta.NoKP = keputusan.NoKP 
    JOIN tingkatan ON tingkatan.Tingkatan = peserta.Tingkatan WHERE tingkatan.Kod_Kumpulan = 'MA' 
    GROUP BY keputusan.NoKP ORDER BY jumlah DESC LIMIT 3";

    $retrieve = mysqli_query($con,$tophf_cmd);
    $bil = 0;

    # Inserting data
    while($m = mysqli_fetch_array($retrieve))
    {
        echo    "<tr>
                    <td class='text-center'>".++$bil."</td>
                    <td>".$m['Nama_Peserta']."</td>
                    <td>".$m['Tingkatan']."</td>
                    <td>".$m['jumlah']."</td>
                </tr>";
    }

    echo "</table>";
}

# Function for lower form leaderboard display
function leaderboard_lf()
{
    include('connectdb.php');

    # Table creation
    echo "<table class='table table-info table-striped border-primary border-2' width = '100%' border = '1' id = 'size'>
    <caption>".check_lf()."</caption>
    <tr>
        <td width='12%' class='text-center'>Kedudukan</td>
        <td width='38%'>Nama</td>
        <td width='20%'>Tingkatan</td>
        <td width='30%'>Jumlah Markah</td>
    </tr>";

    # Command for retrieving top 3 competitors
    $toplf_cmd = "SELECT peserta.Nama_Peserta, peserta.NoKP, tingkatan.Kod_Kumpulan, 
    peserta.Tingkatan, SUM(keputusan.Markah) AS jumlah FROM peserta 
    JOIN keputusan ON peserta.NoKP = keputusan.NoKP 
    JOIN tingkatan ON tingkatan.Tingkatan = peserta.Tingkatan WHERE tingkatan.Kod_Kumpulan = 'MR' 
    GROUP BY keputusan.NoKP ORDER BY jumlah DESC LIMIT 3";

    $retrieve = mysqli_query($con,$toplf_cmd);
    $bil = 0;

    # Inserting data
    while($m = mysqli_fetch_array($retrieve))
    {
        echo    "<tr>
                    <td class='text-center'>".++$bil."</td>
                    <td>".$m['Nama_Peserta']."</td>
                    <td>".$m['Tingkatan']."</td>
                    <td>".$m['jumlah']."</td>
                </tr>";
    }

    echo "</table>";
}