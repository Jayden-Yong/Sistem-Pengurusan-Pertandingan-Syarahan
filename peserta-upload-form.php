<?php
    $page_name = "Daftar Peserta Baru";
    # Starting session
    session_start();

    # Essential files
    include('guard-hakim.php');
    include('connectdb.php');
    include('head.php');
    include('header.php');
?>

<!-- Banner -->
<section id="list-banner" class="d-flex justify-content-center align-items-center w-100 m-nav" data-aos="fade-down" data-aos-duration="1000">
	<div class="container position-relative">
		<h1 data-aos="fade-left" data-aos-duration="1000">Muat Naik Data Peserta</h1>
	</div>
</section>

<!-- Form for file upload -->
<div class="container mt-5 mb-5" data-aos="zoom-out" data-aos-duration="1000">
    <div class="row">
        <div class="col-12 edit-border edit-title upload">
            <form action="peserta-upload-process.php" method="POST" enctype="multipart/form-data">
                <h3>Sila pilih fail txt yang ingin dimuat naik.</h3>
                <div class="row mt-4">
                    <div class="col-4">
                        <input type="file" name="data_peserta">
                    </div>
                    <div class="col-8">
                        <button class="file-btn" type="submit" name="btn-upload">Muat Naik</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>