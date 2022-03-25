<br>
<!-- Function for altering word size -->
<script>

    function altersize(times)
    {
        var size = document.getElementsByClassName('results');
        var current_size = size[0].style.fontSize || 18;

        if(times==2)
        {
            for (var i = 0; i < size.length; i++) 
            {
                size[i].style.fontSize = "18px";
            }
        }
        else
        {
            for (var i = 0; i < size.length; i++)
            {
                size[i].style.fontSize = (parseInt(current_size) + (times * 2)) + "px";
            }
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