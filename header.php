<!-- System Title -->
<header class="fixed-top" data-aos="zoom-in-down" data-aos-duration="1000">
    <div class="row">

        <div class="col-auto">
            <img src="assets/CSS/IMG/logo_enhanced.png" class="logo">
        </div>

        <div class="d-flex align-items-center col-xl-7 col-md-6">
            <nav class="nav-menu">
                <ul>
                    <!-- User Menus -->
                    <?php
                    # Menu Hakim
                    if (!empty($_SESSION['tahap']) and $_SESSION['tahap'] == "hakim"){
                        echo "
                            <li><a href='hakim-menu.php'>Menu Hakim</a></li>
                            <li><a href='peserta-list.php'>Senarai Peserta</a></li>
                            <li><a href='peserta-upload-form.php'>Daftar Peserta Baru</a></li>
                            <li><a href='hakim-list.php'>Senarai Hakim</a></li>
                            <li><a href='peserta-evaluation.php'>Penilaian Peserta</a></li>
                            <li><a href='individual-result.php'>Keputusan</a></li>
                            <li><a href='logout.php'>Logout</a></li>
                        ";
                    }
                    # Menu Peserta
                    elseif (!empty($_SESSION['tahap']) and $_SESSION['tahap'] == "peserta")
                    {
                        echo "
                            <li><a href='peserta-menu.php'>Menu Peserta</a></li>
                            <li><a href='logout.php'>Logout</a></li>
                        ";
                    }
                    # Menu Laman Utama
                    else
                    {
                        echo "
                            <li>
                                <a href='index.php'>Laman Utama</a>
                            </li>
                        ";
                    }
                    ?>
                </ul>
            </nav>
        </div>
        <?php 
            if(empty($_SESSION['tahap']))
            {
                echo "
                    <div class='col-auto d-flex align-items-center justify-content-end'>
                        <a class='btn btn-success fw-bold p-10 rounded-10' href='peserta-signup-form.php'>Daftar Peserta Baharu</a>
                        <a class='btn btn-primary fw-bold p-10 rounded-10 mx-3' href='login-form.php'>Log Masuk</a>
                    </div>
                ";
            }
        ?>
    </div>
</header>