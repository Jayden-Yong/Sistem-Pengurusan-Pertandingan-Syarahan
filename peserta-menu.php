<?php
    $page_name = "Menu Peserta";
    # Starting session
    session_start();

    # Calling essential files
    include('functions.php');
    include('guard-peserta.php');
    include('connectdb.php');
    include('head.php');
    include('header.php');

    # Group name assignment
    $group_name = "";
    if($_SESSION['kod'] == "MA")
    {
        $group_name = "Menengah Atas";
    }
    else
    {
        $group_name = "Menengah Rendah";
    }
?>

<!-- Welcome banner -->
<section id="welcome" class="d-flex justify-content-center align-items-center w-100 m-nav">
	<div class="container position-relative">
		<h3>Selamat Datang,</h3>
        <h1><?= $_SESSION['nama']?></h1>
	</div>
</section>

<div class="container mt-5">

    <!-- Contestant info box -->
    <div class="row">
        <div class="col-5 special-border">
            <span class="MP-title mx-2">Maklumat Peserta</span>

            <!-- Name -->
            <div class="row mb-2 mx-1">
                <div class="col-1 fs-4 d-flex align-items-center justify-content-center">
                    <i class="ri-user-line icon"></i>
                </div>
                <div class="col-auto fs-4 d-flex align-items-center justify-content-center">
                    <span class="fw-bold"><?=$_SESSION['nama']?></span>
                </div>
            </div>

            <!-- ID -->
            <div class="row mb-2 mx-1">
                <div class="col-1 fs-4 d-flex align-items-center justify-content-center">
                    <i class="ri-profile-line icon"></i>
                </div>
                <div class="col-auto fs-4 d-flex align-items-center justify-content-center">
                    <span class="fw-bold"><?=$_SESSION['nokp']?></span>
                </div>
            </div>

            <!-- Class -->
            <div class="row mb-2 mx-1">
                <div class="col-1 fs-4 d-flex align-items-center justify-content-center">
                    <i class="ri-home-line icon"></i>
                </div>
                <div class="col-auto fs-4 d-flex align-items-center justify-content-center">
                    <span class="fw-bold"><?=$_SESSION['tingkatan']?></span>
                </div>
            </div>

        </div>
        <!-- End of Info box -->

        <div class="col-1"></div>

        <!-- Contest Info -->
        <div class="col-6 special-border">
            <span class="MP-title mx-2">Maklumat Pertandingan</span>

            <!-- Contest Group -->
            <div class="row mb-2 mx-1">
                <div class="col-1 fs-4 d-flex align-items-center justify-content-center">
                    <i class="ri-trophy-line icon"></i>
                </div>
                <div class="col-auto fs-4 d-flex align-items-center justify-content-center">
                    <span class="fw-bold"><?=$_SESSION['kod']?> - <?=$group_name?></span>
                </div>
            </div>

            <!-- Total Contestants -->
            <div class="row mb-2 mx-1">
                <div class="col-1 fs-4 d-flex align-items-center justify-content-center">
                    <i class="ri-bar-chart-fill icon"></i>
                </div>
                <div class="col-auto fs-4 d-flex align-items-center justify-content-center">
                    <span class="fw-bold"><?php echo $total = total(); ?> jumlah peserta</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    # Competition group check
    if($_SESSION['kod'] == "MA")
    {
        # Retrieving competition status
        $status = check_hf();

        if($status != "Semua peserta telah dinilai.")
        {
        # Competition status display
        echo "
            <div class='container mt-5 mb-5 status-danger p-2'>
                <div class='text-center'>
                    ".$status."
            </div>
        ";
        }

        # If grading is complete
        if($status == "Semua peserta telah dinilai.")
        {
            # Competition status display
            echo "
                <div class='container mt-5 mb-5 status-success p-2'>
                    <div class='text-center status'>
                        ".$status."
                    </div>
                </div>
            ";

            $result = result();
            $nokp = $_SESSION['nokp'];
            $total_marks = total_marks($nokp);

            # Retrieve result table
            $retrieve_cmd = "SELECT peserta.Nama_Peserta, peserta.NoKP, tingkatan.Kod_Kumpulan, 
            peserta.Tingkatan, SUM(keputusan.Markah) AS jumlah FROM peserta 
            JOIN keputusan ON peserta.NoKP = keputusan.NoKP 
            JOIN tingkatan ON tingkatan.Tingkatan = peserta.Tingkatan WHERE tingkatan.Kod_Kumpulan = 'MA' 
            GROUP BY keputusan.NoKP ORDER BY jumlah DESC";

            $retrieve_result = mysqli_query($con,$retrieve_cmd);
            $bil = 1;

            while($m = mysqli_fetch_array($retrieve_result))
            {
                if($m['NoKP'] == $_SESSION['nokp'])
                {
                    if($bil == 1)
                    {
                        # Achievement display
                        echo "
                            <div class='container mb-5'>
                                <div class='row'>
                                    <div class='col-7 special-border text-center'>
                                        <span class='MP-title mx-2 d-block'>Keputusan</span>

                                        <div class='row mx-2 justify-content-center'>
                                            <div class='col-auto gold rounded-10'>
                                                Anda mendapat tempat ke ".$bil."
                                            </div>
                                        </div>";
                    }
                    elseif($bil == 2)
                    {
                        # Achievement display
                        echo "
                            <div class='container mb-5'>
                                <div class='row'>
                                    <div class='col-7 special-border text-center'>
                                        <span class='MP-title mx-2 d-block'>Keputusan</span>
                                        
                                        <div class='row mx-2 justify-content-center'>
                                            <div class='col-auto silver rounded-10'>
                                                Anda mendapat tempat ke ".$bil."
                                            </div>
                                        </div>";
                    }
                    elseif($bil == 3)
                    {
                        # Achievement display
                        echo "
                            <div class='container mb-5'>
                                <div class='row'>
                                    <div class='col-7 special-border text-center'>
                                        <span class='MP-title mx-2 d-block'>Keputusan</span>
                                        <div class='row mx-2 justify-content-center'>
                                            <div class='col-auto bronze rounded-10'>
                                                Anda mendapat tempat ke ".$bil."
                                            </div>
                                        </div>";
                    }
                    else
                    {
                        # Achievement display
                        echo "
                            <div class='container mb-5'>
                                <div class='row'>
                                    <div class='col-7 special-border text-center'>
                                        <span class='MP-title mx-2 d-block'>Keputusan</span>
                                        <div class='row mx-2 justify-content-center'>
                                            <div class='col-auto normal rounded-10'>
                                                Anda mendapat tempat ke ".$bil."
                                            </div>
                                        </div>";
                    }

                    # Dedicated result display
                    while($grade = mysqli_fetch_array($result))
                    {
                        echo "
                                    <div class='row mx-2 mb-2 justify-content-center'>
                                        <div class='col-5 d-flex aspects text-start'>
                                            ".$grade['Aspek']."
                                        </div>
                                        <div class='col-2 d-flex marks align-items-center justify-content-center'>
                                            ".$grade['Markah']." / ".$grade['Markah_Penuh']."
                                        </div>
                                    </div>
                            ";
                    }

                    echo "
                                    <div class='row mx-2 mb-2 justify-content-center'>
                                        <div class='col-5 d-flex aspects text-start'>
                                                Jumlah
                                        </div>
                                        <div class='col-2 d-flex marks align-items-center justify-content-center'>
                                            ".$total_marks." / 100
                                        </div>
                                    </div>
                                </div>
                                <div class='col-5 d-flex align-items-center justify-content-center'>
                    ";

                    # Medal display
                    if($bil == 1)
                    {
                        echo "
                                    <img class='medal' src='assets/CSS/IMG/gold.jpg'>
                        ";
                    }
                    elseif($bil == 2)
                    {
                        echo "
                                    <img class='medal' src='assets/CSS/IMG/silver.jpg'>
                        ";
                    }
                    elseif($bil == 3)
                    {
                        echo "
                                    <img class='medal' src='assets/CSS/IMG/bronze.jpg'>
                        ";
                    }
                    else
                    {
                        echo "
                                    <img class='medal' src='assets/CSS/IMG/cert.png'>
                        ";
                    }

                    echo "
                                </div>
                            </div>
                        </div>
                    ";
                }
                $bil++;
            }
        }
    }
    elseif($_SESSION['kod'] == "MR")
    {
        # Retrieving competition status
        $status = check_lf();

        if($status != "Semua peserta telah dinilai.")
        {
            # Competition status display
            echo "
                <div class='container mt-5 mb-5 status-danger p-2'>
                    <div class='text-center'>
                        ".$status."
                </div>
            ";
        }

        # If grading is complete
        if($status = "Semua peserta telah dinilai.")
        {
            # Competition status display
            echo "
                <div class='container mt-5 mb-5 status-success p-2'>
                    <div class='text-center status'>
                        ".$status."
                    </div>
                </div>
            ";

            $result = result();
            $nokp = $_SESSION['nokp'];
            $total_marks = total_marks($nokp);

            # Retrieve result table
            $retrieve_cmd = "SELECT peserta.Nama_Peserta, peserta.NoKP, tingkatan.Kod_Kumpulan, 
            peserta.Tingkatan, SUM(keputusan.Markah) AS jumlah FROM peserta 
            JOIN keputusan ON peserta.NoKP = keputusan.NoKP 
            JOIN tingkatan ON tingkatan.Tingkatan = peserta.Tingkatan WHERE tingkatan.Kod_Kumpulan = 'MR' 
            GROUP BY keputusan.NoKP ORDER BY jumlah DESC";

            $retrieve_result = mysqli_query($con,$retrieve_cmd);
            $bil = 1;

            while($m = mysqli_fetch_array($retrieve_result))
            {
                if($m['NoKP'] == $_SESSION['nokp'])
                {
                    if($bil == 1)
                    {
                        # Achievement display
                        echo "
                            <div class='container mb-5'>
                                <div class='row'>
                                    <div class='col-7 special-border text-center'>
                                        <span class='MP-title mx-2 d-block'>Keputusan</span>

                                        <div class='row mx-2 justify-content-center'>
                                            <div class='col-auto gold rounded-10'>
                                                Anda mendapat tempat ke ".$bil."
                                            </div>
                                        </div>";
                    }
                    elseif($bil == 2)
                    {
                        # Achievement display
                        echo "
                            <div class='container mb-5'>
                                <div class='row'>
                                    <div class='col-7 special-border text-center'>
                                        <span class='MP-title mx-2 d-block'>Keputusan</span>
                                        
                                        <div class='row mx-2 justify-content-center'>
                                            <div class='col-auto silver rounded-10'>
                                                Anda mendapat tempat ke ".$bil."
                                            </div>
                                        </div>";
                    }
                    elseif($bil == 3)
                    {
                        # Achievement display
                        echo "
                            <div class='container mb-5'>
                                <div class='row'>
                                    <div class='col-7 special-border text-center'>
                                        <span class='MP-title mx-2 d-block'>Keputusan</span>
                                        <div class='row mx-2 justify-content-center'>
                                            <div class='col-auto bronze rounded-10'>
                                                Anda mendapat tempat ke ".$bil."
                                            </div>
                                        </div>";
                    }
                    else
                    {
                        # Achievement display
                        echo "
                            <div class='container mb-5'>
                                <div class='row'>
                                    <div class='col-7 special-border text-center'>
                                        <span class='MP-title mx-2 d-block'>Keputusan</span>
                                        <div class='row mx-2 justify-content-center'>
                                            <div class='col-auto normal rounded-10'>
                                                Anda mendapat tempat ke ".$bil."
                                            </div>
                                        </div>";
                    }

                    # Dedicated result display
                    while($grade = mysqli_fetch_array($result))
                    {
                        echo "
                                    <div class='row mx-2 mb-2 justify-content-center'>
                                        <div class='col-5 d-flex aspects text-start'>
                                            ".$grade['Aspek']."
                                        </div>
                                        <div class='col-2 d-flex marks align-items-center justify-content-center'>
                                            ".$grade['Markah']." / ".$grade['Markah_Penuh']."
                                        </div>
                                    </div>
                            ";
                    }

                    echo "
                                    <div class='row mx-2 mb-2 justify-content-center'>
                                        <div class='col-5 d-flex aspects text-start'>
                                                Jumlah
                                        </div>
                                        <div class='col-2 d-flex marks align-items-center justify-content-center'>
                                            ".$total_marks." / 100
                                        </div>
                                    </div>
                                </div>
                                <div class='col-5 d-flex align-items-center justify-content-center'>
                    ";

                    # Medal display
                    if($bil == 1)
                    {
                        echo "
                                    <img class='medal' src='assets/CSS/IMG/gold.jpg'>
                        ";
                    }
                    elseif($bil == 2)
                    {
                        echo "
                                    <img class='medal' src='assets/CSS/IMG/silver.jpg'>
                        ";
                    }
                    elseif($bil == 3)
                    {
                        echo "
                                    <img class='medal' src='assets/CSS/IMG/bronze.jpg'>
                        ";
                    }
                    else
                    {
                        echo "
                                    <img class='medal' src='assets/CSS/IMG/cert.png'>
                        ";
                    }

                    echo "
                                </div>
                            </div>
                        </div>
                    ";
                }
                $bil++;
            }
        }
    }
    ?>
    <?php include('footer.php'); ?>