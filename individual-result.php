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

<section id="list-banner" class="d-flex justify-content-center align-items-center w-100 m-nav" data-aos="zoom-in" data-aos-duration="800">
	<div class="container position-relative">
		<h1 data-aos="fade-left" data-aos-duration="1000" data-aos-delay="600">Keputusan</h1>
	</div>
</section>

<div class="container mt-5">
    <div class="row group alata" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="1000">
        <div class="col-1">
            <i class=" ri-trophy-line"></i>
        </div>
        <div class="col-auto">
            Menengah Atas
        </div>
        <?php
            $status = check_hf();

            if($status == "Semua peserta telah dinilai.")
            {
                echo "
                    <div class='col-auto text-white d-flex align-items-center mx-lg-4' data-aos='fade-left' data-aos-duration='1000' data-aos-delay='2200'>
                        <div class='row rounded-pill noti-box-done'>
                            <div class='col-auto alata check-icon'>
                                <i class='ri-check-line'></i>
                            </div>
                            <div class='col-auto alata stat d-flex align-items-center'>
                                ".$status."
                            </div>
                        </div>
                    </div>
                ";
            }
            else
            {
                echo "
                    <div class='col-auto text-white d-flex align-items-center mx-lg-4' data-aos='fade-left' data-aos-duration='1000' data-aos-delay='2200'>
                        <div class='row rounded-pill noti-box-pend'>
                            <div class='col-auto alata check-icon'>
                                <i class='ri-close-line'></i>
                            </div>
                            <div class='col-auto alata stat d-flex align-items-center'>
                                Penilaian peserta belum selesai.
                            </div>
                        </div>
                    </div>
                ";
            }
        ?>
    </div>
</div>

<div class="container mt-4 mb-5 special-border alata" data-aos="zoom-out" data-aos-duration="1000" data-aos-delay="1400">

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

<div class="container mt-5 mb-4" data-aos="fade-down-right" data-aos-duration="1000">
    <div class="row group alata">
        <div class="col-1">
            <i class=" ri-trophy-line"></i>
        </div>
        <div class="col-auto">
            Menengah Rendah
        </div>
        <?php
            $status = check_lf();

            if($status == "Semua peserta telah dinilai.")
            {
                echo "
                    <div class='col-auto text-white d-flex align-items-center mx-lg-4' data-aos='fade-left' data-aos-duration='1000' data-aos-delay='1200'>
                        <div class='row rounded-pill noti-box-done'>
                            <div class='col-auto alata check-icon'>
                                <i class='ri-check-line'></i>
                            </div>
                            <div class='col-auto alata stat d-flex align-items-center'>
                                ".$status."
                            </div>
                        </div>
                    </div>
                ";
            }
            else
            {
                echo "
                    <div class='col-auto text-white d-flex align-items-center mx-lg-4' data-aos='fade-left' data-aos-duration='1000' data-aos-delay='1200'>
                        <div class='row rounded-pill noti-box-pend'>
                            <div class='col-auto alata check-icon'>
                                <i class='ri-close-line'></i>
                            </div>
                            <div class='col-auto alata stat d-flex align-items-center'>
                                Penilaian peserta belum selesai.
                            </div>
                        </div>
                    </div>
                ";
            }
        ?>
    </div>
</div>

<div class="container mb-4 special-border alata" data-aos="zoom-out" data-aos-duration="1000">

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

<div class="container mt-2 mb-5" data-aos="zoom-out" data-aos-duration="1000"><?php include('size-btn-2.php') ?></div>

<?php include('footer.php'); ?>