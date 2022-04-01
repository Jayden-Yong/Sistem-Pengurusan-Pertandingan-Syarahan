<?php
    $page_name = "Senarai Hakim";
    # Starting session
    session_start();

    # Essential files
    include('guard-hakim.php');
    include('connectdb.php');
    include('head.php');
    include('header.php');
?>

<!-- Banner -->
<section id="list-banner" class="d-flex justify-content-center align-items-center w-100 m-nav" data-aos="zoom-in" data-aos-duration="800">
	<div class="container position-relative">
		<h1 data-aos="fade-left" data-aos-duration="1000" data-aos-delay="600">Senarai Hakim</h1>
	</div>
</section>

<div class="container mt-3 mb-3" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="1000">
    <?php include('size-button.php'); ?>
</div>

<div class="container mb-5 mt-4" data-aos="zoom-out" data-aos-duration="1000" data-aos-delay="1500">

    <!-- Hakim list table -->
    <table class="table-rounded td-gray" id="size">
        <tr>
            <td>ID Hakim</td>
            <td>Nama</td>
            <td>Nombor KP</td>
            <td>Kata Laluan</td>
        </tr>

    <?php
        # Command for retrieving hakim list
        $cmd = "SELECT * FROM hakim";
        $result = mysqli_query($con,$cmd);

        while($data = mysqli_fetch_array($result))
        {
            # Display data in table
            echo "
                <tr>
                    <td>".$data['IDHakim']."</td>
                    <td>".$data['Nama_Hakim']."</td>
                    <td>".$data['NoKP_Hakim']."</td>
                    <td>".$data['Kata_Laluan']."</td>
                </tr>
            ";
        }
    ?>

    </table>
    <a class="btn btn-primary mt-3" href="hakim-register-form.php">
        <div class="row">
            <div class="col-2 d-flex align-items-center">
                <i class="ri-add-line"></i>
            </div>
            <div class="col-auto fw-bold d-flex align-items-center">
                Daftar Hakim Baru
            </div>
        </div>
    </a>
</div>

<?php include('footer.php'); ?>