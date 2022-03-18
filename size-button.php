<br>
<!-- Function for altering word size -->
<script>

    function altersize(times)
    {
        var size = document.getElementById('size');
        var current_size = size.style.fontSize || 1;

        if(times==2)
        {
            size.style.fontSize = "1em";
        }
        else
        {
            size.style.fontSize = (parseFloat(current_size) + (times * 0.2)) + "em";
        }
    }
</script>

<div class="container">
    <div class="row">
        <div class="col-auto d-flex align-items-center">
            <span class="size">Ubah saiz tulisan</span>
        </div>
        <div class="col-auto">
            <button class="size-btn d-flex align-items-center" onclick="altersize(-1)">
                <i class="ri-subtract-line"></i>
            </button>
        </div>
        <div class="col-auto">
            <button class="size-btn d-flex align-items-center" onclick="altersize(1)">
                <i class="ri-add-line"></i>
            </button>
        </div>
        <div class="col-auto">
            <button class="size-btn d-flex align-items-center" onclick="altersize(2)">
                <i class="ri-restart-line"></i>
            </button>
        </div>
    </div>
</div>