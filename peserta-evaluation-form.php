<?php
    $page_name = "Penilaian";
    # Starting session
    session_start();

    # GET variable check
    if(empty($_GET))
    {
        die("
            <script>
                window.location.href='peserta-evaluation.php';
            </script>
        ");
    }

    # Essential files
    include('guard-hakim.php');
    include('connectdb.php');
    include('head.php');
    include('header.php');
?>

<!-- Banner -->
<section id="list-banner" class="d-flex justify-content-center align-items-center w-100 m-nav">
	<div class="container position-relative">
		<h1><?=$_SESSION['idaspek']?> - <?=$_SESSION['aspek']?></h1>
	</div>
</section>

<?php
    # Command to retrieve certain contestant data
    #$cmd = "SELECT * FROM keputusan LEFT JOIN peserta 
    #WHERE peserta.NoKP = keputusan.NoKP AND keputusan.NoKP = '".$_GET['nokp']."'";

    #$result = mysqli_query($con,$cmd);
    #$p = mysqli_fetch_array($result);
?>

<div class="container mt-5 edit-title">
    <h3>Anda sedang menilai 
        <h1><?=$_GET['nama']?></h1>
    </h3>
</div>

<div class="container mt-4 mb-5">
    <form action="peserta-evaluation-process.php?nokp=<?=$_GET['nokp']?>&id=<?=$_GET['id']?>" method="POST">
        <table class="table-rounded td-gray">
            <tr>
                <td>Nama Peserta</td>
                <td><?=$_GET['nama']?></td>
            </tr>
            <tr>
                <td>Nombor KP Peserta</td>
                <td><?=$_GET['nokp']?></td>
            </tr>
            <tr>
                <td>Tingkatan</td>
                <td><?=$_GET['tingkatan']?></td>
            </tr>
        </table>
        
        <div class="row mt-5">
            <div class="col-7 edit-border edit-title">
                <h1>Penilaian</h1>

                <div class="row mt-3 mb-3">
                    <div class="col-6 rate">
                        <div class="row">
                            <div class="col-2 d-flex align-items-center">
                                <i class="ri-trophy-line"></i>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                Kod Kumpulan
                            </div>
                        </div>
                    </div>
                    <div class="col-6 detail">
                        <?=$_GET['kumpulan']?></td>
                    </div>
                </div>

                <?php
                    # Command for retrieving corresponding aspect data
                    $group_cmd = "SELECT * FROM penilaian WHERE IDPenilaian = '".$_GET['id']."'";
                    $group_result = mysqli_query($con,$group_cmd);
                    $aspect = mysqli_fetch_array($group_result);
                ?>

                <div class="row mb-3">
                    <div class="col-6 rate">
                        <div class="row">
                            <div class="col-2 d-flex align-items-center">
                                <i class="ri-auction-line"></i>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                Aspek Penilaian
                            </div>
                        </div>
                    </div>
                    <div class="col-6 detail">
                        <?=$_SESSION['idaspek']?> - <?=$_SESSION['aspek']?>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6 rate">
                        <div class="row">
                            <div class="col-2 d-flex align-items-center">
                                <i class="ri-percent-line"></i>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                Markah
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <input class="filter-box" type="number" name="markah" value="<?=$_GET['markah']?>" required>
                    </div>
                    <div class="col-4 detail d-flex align-items-center">
                        / <?=$aspect['Markah_Penuh']?>
                    </div>
                </div>

                <div class="row justify-content-center mt-5 mb-4">
                    <div class="col-8 text-center">
                        <button class="submit-btn" type="submit">
                            <div class="row">
                                <div class="col-3 d-flex align-items-center">
                                    <i class="ri-download-line"></i>
                                </div>
                                <div class="col-auto d-flex align-items-center">
                                    Simpan
                                </div>
                            </div>
                            
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-5 d-flex justify-content-center">
                <i class="ri-quill-pen-line quill"></i>
            </div>
        </div>
    </form>
</div>

<a href="peserta-evaluation.php">Senarai Nama Peserta</a>

<?php include('footer.php'); ?>