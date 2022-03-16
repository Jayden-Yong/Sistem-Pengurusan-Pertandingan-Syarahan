<?php
    $page_name = "Pendaftaran Hakim";
    # Starting session
    session_start();

    # Essential files
    include('guard-hakim.php');
    include('head.php');
    include('header.php');
?>

<!-- Banner -->
<section id="list-banner" class="d-flex justify-content-center align-items-center w-100 m-nav">
	<div class="container position-relative">
		<h1>Pendaftaran Hakim Baru</h1>
	</div>
</section>

<div class="container mt-5 edit-title">
    <h3>Sila masukkan maklumat hakim baru.</h3>
</div>

<div class="container mt-3 mb-5">
    <div class="row">
        <div class="col-12 edit-border">
            <form action="hakim-register-process.php" method="POST">

                <!-- Name -->
                <div class="row mt-4 mb-4">
                    <div class="col-3 d-flex align-items-center">
                        <span class="edit">Nama</span>
                    </div>
                    <div class="col-9">
                        <input class="filter-box" type="text" name="nama" required>
                    </div>
                </div>

                <!-- ID -->
                <div class="row mb-4">
                    <div class="col-3 d-flex align-items-center">
                        <span class="edit">Nombor KP</span>
                    </div>
                    <div class="col-9">
                        <input class="filter-box" type="text" name="nokp" required>
                    </div>
                </div>

                <!-- Password -->
                <div class="row mb-4">
                    <div class="col-3 d-flex align-items-center">
                        <span class="edit">Kata Laluan</span>
                    </div>
                    <div class="col-9">
                        <input class="filter-box" type="password" name="katalaluan" required>
                    </div>
                </div>

                <!-- Submit button -->
                <div class="row text-end mb-4">
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">
                            <div class='row'>
                                <div class='col-3'>
                                    <i class='ri-user-add-line'></i>
                                </div>
                                <div class='col-1 fw-bold'>
                                    Daftar
                                </div>
                            </div>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>