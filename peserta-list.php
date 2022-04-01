<?php
    $page_name = "Senarai Peserta";
    # Starting session
    session_start();

    # Calling essential files
    include('header.php');
    include('guard-hakim.php');
    include('connectdb.php');
    include('functions.php');
    include('head.php');
?>

<!-- Banner -->
<section id="list-banner" class="d-flex justify-content-center align-items-center w-100 m-nav" data-aos="zoom-in" data-aos-duration="800">
	<div class="container position-relative">
		<h1 data-aos="fade-left" data-aos-duration="1000" data-aos-delay="500">Senarai Peserta</h1>
	</div>
</section>

<!-- Form for filtering competition group -->
<div class="container mt-5" data-aos="zoom-out" data-aos-duration="1000" data-aos-delay="1000">
    <div class="row justify-content-center">
        <div class="col-6">
            <form action="" method="POST">
                <div class="row justify-content-center">
                    <div class="col-10 align-items-center">
                        <select class="filter-box" name="kod_kumpulan">
                            <option selected value disabled>Carian Mengikut Kod Kumpulan</option>
                            <option value="MA">Menengah Atas</option>
                            <option value="MR">Menengah Rendah</option>
                        </select>
                    </div>
                    <div class="col-2 align-items-center">
                        <button class="search-btn" type="submit">
                            <i class='ri-search-line search'></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>         
    </div>
</div>

<div class="container mb-3 mt-4" data-aos="fade-down-right" data-aos-duration="1000" data-aos-delay="1500">
    <?php include('size-button.php'); ?>
</div>

<div class="container mb-5" data-aos="zoom-out" data-aos-duration="1000" data-aos-delay="1500">
    <table class="table-rounded td-gray" id="size">
        <tr>
            <td>Nama</td>
            <td>Nombor KP</td>
            <td>Tingkatan</td>
            <td>Kata Laluan</td>
            <td>Kod Kumpulan</td>
            <td>Tindakan</td>
        </tr>

        <?php
            # Additional condition for query (Filter function)
            $add = "";
            if(!empty($_POST['kod_kumpulan']))
            {
                $add = "AND tingkatan.Kod_Kumpulan = '".$_POST['kod_kumpulan']."'";
            }

            # Command for retrieving competitor list
            $list_cmd = "SELECT * FROM peserta, tingkatan 
            WHERE tingkatan.Tingkatan = peserta.Tingkatan $add 
            ORDER BY Kod_Kumpulan";

            $list_result = mysqli_query($con,$list_cmd);

            while($m = mysqli_fetch_array($list_result))
            {
                $data_get = array(
                    'nama' => $m['Nama_Peserta'],
                    'nokp' => $m['NoKP'],
                    'tingkatan' => $m['Tingkatan'],
                    'katalaluan' => $m['Kata_Laluan'],
                    'kod_kumpulan' => $m['Kod_Kumpulan'],
                );

                # List display
                echo "
                <tr>
                    <td>".$m['Nama_Peserta']."</td>
                    <td>".$m['NoKP']."</td>
                    <td>".$m['Tingkatan']."</td>
                    <td>".$m['Kata_Laluan']."</td>
                    <td>".$m['Kod_Kumpulan']."</td>
                    
                    <td><a class = 'btn btn-primary' href='peserta-update-form.php?".http_build_query($data_get)."'>
                            <div class='row'>
                                <div class='col-3'>
                                    <i class='ri-refresh-line'></i>
                                </div>
                                <div class='col-1 fw-bold'>
                                    Kemaskini
                                </div>
                            </div>
                        </a>
                        <a class = 'btn btn-danger mx-1' href='peserta-delete-process.php?nokp=".$m['NoKP']."' onClick=\"return confirm('Anda pasti anda ingin memadam data ini?')\">
                            <i class='ri-delete-bin-line'></i>
                        </a>
                    </td>

                </td>";
            }
        ?>
    </table>
</div>

<?php include('footer.php'); ?>