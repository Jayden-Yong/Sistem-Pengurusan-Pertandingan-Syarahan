<?php
    $page_name = "Daftar Peserta";
    # Starting session
    session_start();

    # Calling essential files
    include('functions.php');
    include('head.php');
?>

<body class="loginbg">

    <div class="container d-flex justify-content-center mt-4 mb-4" data-aos="zoom-in-down" data-aos-duration="700">
        <img src="assets/CSS/IMG/logo_enhanced_transparent.png">
    </div>

    <div class="container" data-aos="zoom-out" data-aos-duration="700">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card rounded-20">
                    <div class="card-body text-center">

                        <!-- Page Title -->
                        <div class="mb-4 mt-1">
                            <h3>Pendaftaran Peserta Baharu</h3>
                        </div>

                        <!-- Borang Pendaftaran Peserta Baru -->
                        <form action="peserta-signup-process.php" method="POST">
                            <div class="row justify-content-center mb-2">
                                <div class="col-4 d-flex align-items-center justify-content-center">
                                    <p>Nama Peserta</p>
                                </div>
                                <div class="col-7">
                                    <input class="input-box" type="text" name="nama" required>
                                </div>
                            </div>
                            <div class="row justify-content-center mb-2">
                                <div class="col-4 d-flex align-items-center justify-content-center">
                                    <p>NoKP Peserta</p>
                                </div>
                                <div class="col-7">
                                    <input class="input-box" type="text" name="nokp" required>
                                </div>
                            </div>
                            <div class="row justify-content-center mb-2">
                                <div class="col-4 d-flex align-items-center justify-content-center">
                                    <p>Katalaluan</p>
                                </div>
                                <div class="col-7">
                                    <input class="input-box" type="password" name="katalaluan" required>
                                </div>
                            </div>
                            <div class="row justify-content-center mb-2">
                                <div class="col-4 d-flex align-items-center justify-content-center">
                                    <p>Tingkatan</p>
                                </div>
                                <div class="col-7">
                                    <select class="input-box" name="tingkatan" required>
                                        <option selected value disabled>Pilih</option>
                                        <!-- Retrieving class list -->
                                        <?php class_list(); ?>
                                    </select><br>
                                </div>
                            </div>
                            <input class="btn btn-primary login rounded-10 mt-2" type="submit" value="Daftar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>