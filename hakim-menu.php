<?php
    $page_name = "Menu Hakim";
    # Starting session
    session_start();

    # Calling essential files
    include('functions.php');
    include('head.php');
    include('header.php');
    include('guard-hakim.php');
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
            <span class="MP-title mx-2">Maklumat Hakim</span>

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

            <!-- ID Hakim -->
            <div class="row mb-2 mx-1">
                <div class="col-1 fs-4 d-flex align-items-center justify-content-center">
                    <i class="ri-price-tag-3-line icon"></i>
                </div>
                <div class="col-auto fs-4 d-flex align-items-center justify-content-center">
                    <span class="fw-bold"><?=$_SESSION['id']?></span>
                </div>
            </div>

        </div>
        <!-- End of Info box -->

        <div class="col-1"></div>

        <!-- Contest Info -->
        <div class="col-6 special-border">
            <span class="MP-title mx-2">Maklumat Pertandingan</span>

            <!-- Responsible aspect -->
            <div class="row mb-2 mx-1">
                <div class="col-1 fs-4 d-flex align-items-center justify-content-center">
                    <i class="ri-auction-line icon"></i>
                </div>
                <div class="col-auto fs-4 d-flex align-items-center justify-content-center">
                    <span class="fw-bold"><?=$_SESSION['idaspek']?> - <?=$_SESSION['aspek']?></span>
                </div>
            </div>

            <!-- Total Contestants -->
            <div class="row mb-2 mx-1">
                <div class="col-1 fs-4 d-flex align-items-center justify-content-center">
                    <i class="ri-bar-chart-fill icon"></i>
                </div>
                <div class="col-auto fs-4 d-flex align-items-center justify-content-center">
                    <span class="fw-bold"><?php echo $total = overall(); ?> jumlah peserta</span>
                </div>
            </div>

            <!-- Pending Results -->
            <div class="row mb-2 mx-1">
                <div class="col-1 fs-4 d-flex align-items-center justify-content-center">
                    <?php
                        $pending = pending();

                        if($pending == 0)
                        {
                            echo "
                                <i class='ri-check-line icon-green'></i>
                            ";
                        }
                        else
                        {
                            echo "
                                <i class='ri-error-warning-line icon'></i>
                            ";
                        }
                    ?>
                </div>
                <div class="col-auto fs-4 d-flex align-items-center justify-content-center">
                    <?php
                        if($pending == 0)
                        {
                            echo "
                                <span class='fw-bold fc-green'>
                                    Semua peserta telah dinilai.
                                </span>
                            ";
                        }
                        else
                        {
                            echo "
                                <span class='fw-bold'>
                                    ".$pending." belum dinilai
                                </span>
                            ";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Task Display -->
    <div class="row mt-5 mb-5 special-border">
        <span class="MP-title mx-2">Tugas Hakim</span>

        <!-- Task 1 -->
        <div class="row mb-2 mx-1">
            <div class="col-1 fs-4 text-start">
                <i class="ri-play-list-add-line icon"></i>
            </div>
            <div class="col-auto fs-5 d-flex align-items-center justify-content-center">
                <span class="fw-bold">Setiap hakim boleh mendaftar peserta baharu dengan cara memuat naik data *txt peserta.</span>
            </div>
        </div>

        <!-- Task 2 -->
        <div class="row mb-2 mx-1">
            <div class="col-1 fs-4 text-start">
                <i class="ri-quill-pen-line icon"></i>
            </div>
            <div class="col-auto fs-5 d-flex align-items-center justify-content-center">
                <span class="fw-bold">Setiap hakim boleh menilai mana-mana peserta yang telah disenaraikan.</span>
            </div>
        </div>

        <!-- Task 3 -->
        <div class="row mb-2 mx-1">
            <div class="col-1 fs-4 text-start">
                <i class="ri-calendar-check-line icon"></i>
            </div>
            <div class="col-auto fs-5 d-flex align-items-center justify-content-center">
                <span class="fw-bold">Peserta terakhir akan dinilai dan diberikan markah pada hari terakhir pertandingan.</span>
            </div>
        </div>

    </div>
</div>

<?php include('footer.php'); ?>