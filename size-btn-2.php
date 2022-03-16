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
        <div class="col-3">
            <input class="size-btn1" name="reSize2" type="button" value="&nbsp;-&nbsp;" onclick="altersize(-1)" />
            <input class="size-btn2" name="reSize1" type="button" value="RESET" onclick="altersize(2)" />
            <input class="size-btn3" name="reSize"  type="button" value="&nbsp;+&nbsp;" onclick="altersize(1)" />
        </div>
    </div>
</div>