<?php
    $page_name = "Keputusan";
    # Starting session
    session_start();

    # Essential files
    include('connectdb.php');
    include('functions.php');
    include('guard-hakim.php');
    include('head.php');
    include('header.php');
?>

<section id="list-banner" class="d-flex justify-content-center align-items-center w-100 m-nav">
	<div class="container position-relative">
		<h1>Keputusan</h1>
	</div>
</section>

<div class="container mt-5">
    <div class="row group alata">
        <div class="col-1">
            <i class=" ri-trophy-line"></i>
        </div>
        <div class="col-auto">
            Menengah Atas
        </div>
    </div>
</div>

<div class="container mt-4 mb-5 special-border alata">

    <div class="row column-title">
        <div class="col-2 text-center">
            #
        </div>
        <div class="col-3">
            Nama
        </div>
        <div class="col-2">
            Nombor KP
        </div>
        <div class="col-2">
            Tingkatan
        </div>
        <div class="col-3">
            Jumlah Markah
        </div>
    </div>

    <?php
        # Command to retrieve contestant results
        $cmd = "SELECT peserta.Nama_Peserta, peserta.NoKP, tingkatan.Kod_Kumpulan, 
        peserta.Tingkatan, SUM(keputusan.Markah) AS jumlah FROM peserta 
        JOIN keputusan ON peserta.NoKP = keputusan.NoKP 
        JOIN tingkatan ON tingkatan.Tingkatan = peserta.Tingkatan 
        WHERE Kod_Kumpulan = 'MA'
        GROUP BY keputusan.NoKP ORDER BY jumlah DESC";

        $result = mysqli_query($con,$cmd);
        $bil = 0;

        # Inserting retrieved data into table
        while($m = mysqli_fetch_array($result))
        {
            $rank = ++$bil;

            echo "
                <div class='row results'>
                    <div class='col-2 text-center'>
            ";

            if($rank == 1)
            {
                echo "
                        <i class='ri-award-fill first'></i>
                    </div>
                ";
            }
            elseif($rank == 2)
            {
                echo "
                        <i class='ri-award-fill second'></i>
                    </div>
                ";
            }
            elseif($rank == 3)
            {
                echo "
                        <i class='ri-award-fill third'></i>
                    </div>
                ";
            }
            else
            {
                echo "
                        <span class='rank'>".$rank."</span>
                    </div>
                ";
            }
            # Display data in table
            echo "
                    <div class='col-3 d-flex align-items-center'>
                        ".$m['Nama_Peserta']."
                    </div>
                    <div class='col-2 d-flex align-items-center'>
                        ".$m['NoKP']."
                    </div>
                    <div class='col-2 d-flex align-items-center'>
                        ".$m['Tingkatan']."
                    </div>
                    <div class='col-3 d-flex align-items-center'>
                        ".$m['jumlah']."
                    </div>
                </div>
            ";
        }
    ?>
</div>

<div class="container mb-4">
    <div class="row group alata">
        <div class="col-1">
            <i class=" ri-trophy-line"></i>
        </div>
        <div class="col-auto">
            Menengah Rendah
        </div>
    </div>
</div>

<div class="container mb-5 special-border alata">

    <div class="row column-title">
        <div class="col-2 text-center">
            #
        </div>
        <div class="col-3">
            Nama
        </div>
        <div class="col-2">
            Nombor KP
        </div>
        <div class="col-2">
            Tingkatan
        </div>
        <div class="col-3">
            Jumlah Markah
        </div>
    </div>

    <?php
        # Command to retrieve contestant results
        $cmd = "SELECT peserta.Nama_Peserta, peserta.NoKP, tingkatan.Kod_Kumpulan, 
        peserta.Tingkatan, SUM(keputusan.Markah) AS jumlah FROM peserta 
        JOIN keputusan ON peserta.NoKP = keputusan.NoKP 
        JOIN tingkatan ON tingkatan.Tingkatan = peserta.Tingkatan 
        WHERE Kod_Kumpulan = 'MR'
        GROUP BY keputusan.NoKP ORDER BY jumlah DESC";

        $result = mysqli_query($con,$cmd);
        $bil = 0;

        # Inserting retrieved data into table
        while($m = mysqli_fetch_array($result))
        {
            $rank = ++$bil;

            if($rank == 1)
            {
                echo "
                    <div class='row results' id='size'>
                        <div class='col-2 text-center'>
                            <i class='ri-award-fill first'></i>
                        </div>
                ";
            }
            elseif($rank == 2)
            {
                echo "
                    <div class='row results' id='size'>
                        <div class='col-2 text-center'>
                            <i class='ri-award-fill second'></i>
                        </div>
                ";
            }
            elseif($rank == 3)
            {
                echo "
                    <div class='row results' id='size'>
                        <div class='col-2 text-center'>
                            <i class='ri-award-fill third'></i>
                        </div>
                ";
            }
            else
            {
                echo "
                    <div class='row results' id='size'>
                        <div class='col-2 rank text-center'>
                            ".$rank."
                        </div>
                ";
            }
            # Display data in table
            echo "
                    <div class='col-3 d-flex align-items-center'>
                        ".$m['Nama_Peserta']."
                    </div>
                    <div class='col-2 d-flex align-items-center'>
                        ".$m['NoKP']."
                    </div>
                    <div class='col-2 d-flex align-items-center'>
                        ".$m['Tingkatan']."
                    </div>
                    <div class='col-3 d-flex align-items-center'>
                        ".$m['jumlah']."
                    </div>
                </div>
            ";
        }
    ?>
</div>

<caption><?php $status = check_hf(); echo $status; ?></caption>

<p class="mt-4"><?php include('size-btn-2.php') ?></p>


<?php include('footer.php'); ?>