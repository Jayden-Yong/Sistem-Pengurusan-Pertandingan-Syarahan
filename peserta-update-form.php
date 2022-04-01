<?php
    $page_name = "Kemaskini";
    # Starting session
    session_start();

    # Calling essential files
    include('header.php');
    include('guard-hakim.php');
    include('functions.php');
    include('head.php');

    # GET variable check. If empty, revert to peserta-list.php
    if(empty($_GET))
    {
        die("<script>window.location.href='peserta-list.php';</script>");
    }
?>

<!-- Banner -->
<section id="list-banner" class="d-flex justify-content-center align-items-center w-100 m-nav" data-aos="zoom-in" data-aos-duration="800">
	<div class="container position-relative">
		<h1 data-aos="fade-left" data-aos-duration="1000">Kemaskini Data Peserta</h1>
	</div>
</section>

<div class="container mt-5 edit-title">
    <h3 data-aos="fade-left" data-aos-duration="700" data-aos-delay="500">Anda sedang mengemaskini data 
        <h1 data-aos="fade-left" data-aos-duration="800" data-aos-delay="700"><?=$_GET['nama']?></h1>
    </h3>
</div>

<div class="container mt-5 mb-5" data-aos="zoom-out" data-aos-duration="1000" data-aos-delay="1100">
    <div class="row">
        <div class="col-12 edit-border">
            <form action="peserta-update-process.php?nokp_lama=<?=$_GET['nokp']?>" method="POST">

                <!-- Name -->
                <div class="row mt-4 mb-4">
                    <div class="col-3 d-flex align-items-center">
                        <span class="edit">Nama</span>
                    </div>
                    <div class="col-9">
                        <input class="filter-box" type="text" name="nama" value="<?=$_GET['nama']?>" required>
                    </div>
                </div>

                <!-- ID -->
                <div class="row mb-4">
                    <div class="col-3 d-flex align-items-center">
                        <span class="edit">Nombor KP</span>
                    </div>
                    <div class="col-9">
                        <input class="filter-box" type="text" name="nokp" value="<?=$_GET['nokp']?>" required>
                    </div>
                </div>

                <!-- Class -->
                <div class="row mb-4">
                    <div class="col-3 d-flex align-items-center">
                        <span class="edit">Tingkatan</span>
                    </div>
                    <div class="col-9">
                        <select class="filter-box" name="tingkatan" required>
                            <option value="<?=$_GET['tingkatan']?>"><?=$_GET['tingkatan']?></option>
                            <?=class_list();?>
                        </select>
                    </div>
                </div>

                <!-- Password -->
                <div class="row mb-4">
                    <div class="col-3 d-flex align-items-center">
                        <span class="edit">Kata Laluan</span>
                    </div>
                    <div class="col-9">
                        <input class="filter-box" type="password" name="katalaluan" value="<?=$_GET['katalaluan']?>" required>
                    </div>
                </div>

                <!-- Submit button -->
                <div class="row text-end mb-4">
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">
                            <div class='row'>
                                <div class='col-3'>
                                    <i class='ri-refresh-line'></i>
                                </div>
                                <div class='col-1 fw-bold'>
                                    Kemaskini
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