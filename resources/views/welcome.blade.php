<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<div class="header" id="myHeader">
    <h2>Work With Us</h2>
</div>

<div class="content">
    <div class="claim">
        <h1>El software de reclutamiento que une grandes empresas y talento humano</h1>
        <p>Encuentra y contrata a la persona adecuada para cada trabajo.</p>
        <a href="{{config('app.ADMIN_URL') }}/register" class="register button">Regístrate</a>
    </div>
    <div class="hint">
        <h3>Work With Us es la forma más fácil para que los equipos de HR puedan gestionar...</h3>

    </div>
    <div class="cta">
        3
    </div>

</div>

<script>
    window.onscroll = function() {myFunction()};

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }
</script>

</body>
</html>
