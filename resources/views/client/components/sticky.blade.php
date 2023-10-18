<script>
    window.onscroll = function() {myFunction()};

    var header = document.getElementById("sticky_header");
    console.log(header);

    var sticky = header.offsetTop;

    function myFunction() {
        if (window.scrollY > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }
</script>
