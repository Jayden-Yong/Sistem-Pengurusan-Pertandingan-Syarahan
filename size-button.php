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
        <div class="col-3">
            <input class="size-btn1" name="reSize2" type="button" value="&nbsp;-&nbsp;" onclick="altersize(-1)" />
            <input class="size-btn2" name="reSize1" type="button" value="RESET" onclick="altersize(2)" />
            <input class="size-btn3" name="reSize"  type="button" value="&nbsp;+&nbsp;" onclick="altersize(1)" />
        </div>
    </div>
</div>