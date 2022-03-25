<?php
    $page_name = "Log Masuk";
    # Starting session
    session_start();

    # Calling essential files
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
                        <!-- Login page title -->
                        <div class="mb-4 mt-1">
                            <span>Log Masuk</span>
                        </div>

                        <!-- Login form -->
                        <form action="login-process.php" method="POST">
                            <div class="row justify-content-center">
                                <div class="col-4 d-flex align-items-center justify-content-center">
                                    <p>Nombor KP</p>
                                </div>
                                <div class="col-7">
                                    <input class="input-box" type="text" name="nokp">
                                </div>
                            </div>
                            <div class="row justify-content-center mt-2">
                                <div class="col-4 d-flex align-items-center justify-content-center">
                                    <p>Kata Laluan</p>
                                </div>
                                <div class="col-7">
                                    <input class="input-box" type="password" name="katalaluan"><br>
                                </div>
                            </div>
                            <input class="btn btn-primary login rounded-10 mt-2" type="submit" value="Log Masuk">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>