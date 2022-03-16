<?php
    $page_name = "Penilaian Peserta";
    # Starting session
    session_start();

    # Essential files
    include('guard-hakim.php');
    include('connectdb.php');
    include('functions.php');
    include('head.php');
    include('header.php');
?>

<!-- Banner -->
<section id="list-banner" class="d-flex justify-content-center align-items-center w-100 m-nav">
	<div class="container position-relative">
		<h1>Penilaian Peserta</h1>
	</div>
</section>

<!-- Search bar -->
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-6">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-10 align-items-center">
                        <input class="filter-box" type="text" name="nama" placeholder="Nama Peserta"/>
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

<div class="container mt-4">
    <h2 class="alata fw-bold">Senarai Peserta</h2>
</div>

<!-- Contestant list table -->
<div class="container mt-4 mb-5">
    <table class="table-rounded td-gray" id="size">
        <tr>
            <td>Nama</td>
            <td>Nombor KP</td>
            <td>Tingkatan</td>
            <td>Markah</td>
            <td>Penilaian</td>
        </tr>

        <?php
            # Additional criteria
            $add = "";
            if(!empty($_POST['nama']))
            {
                $add = "AND peserta.Nama_Peserta LIKE '%".$_POST['nama']."%'";
            }

            # Command for retrieving contestant list 
            $cmd = "SELECT * FROM peserta 
            LEFT JOIN tingkatan ON tingkatan.Tingkatan = peserta.Tingkatan
            LEFT JOIN keputusan ON keputusan.NoKP = peserta.NoKP
            LEFT JOIN penilaian ON penilaian.IDPenilaian = keputusan.IDPenilaian
            LEFT JOIN hakim ON hakim.IDHakim = penilaian.IDHakim
            WHERE penilaian.IDHakim = '".$_SESSION['id']."' $add";

            $result = mysqli_query($con,$cmd);

            # Assign retrieved data
            while($m=mysqli_fetch_array($result))
            {
                $data_get = array(
                    'nokp'      => $m['NoKP'],
                    'nama'      => $m['Nama_Peserta'],
                    'tingkatan' => $m['Tingkatan'],
                    'markah'    => $m['Markah'],
                    'id'        => $m['IDPenilaian'],
                    'kumpulan'  => $m['Kod_Kumpulan']
                );

                # Insert data into list
                echo "
                    <tr>
                        <td>".$m['Nama_Peserta']."</td>
                        <td>".$m['NoKP']."</td>
                        <td>".$m['Tingkatan']."</td>
                        <td>".$m['Markah']."</td>

                        <td>
                            <a class='btn btn-info text-light' href='peserta-evaluation-form.php?".http_build_query($data_get)."'>
                                <div class='row'>
                                    <div class='col-3'>
                                        <i class='ri-quill-pen-line'></i>
                                    </div>
                                    <div class='col-1 fw-bold'>
                                        Penilaian
                                    </div>
                                </div>
                            </a>
                        </td>
                    </tr>
                ";
            }
        ?>
    </table>
</div>

<?php include('footer.php'); ?>
