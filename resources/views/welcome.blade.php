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
    <h2><a href="/">Work With Us</a></h2>
</div>

<div class="content">
    <div class="claim">
        <h1>El software de reclutamiento que une grandes empresas y talento humano</h1>
        <p>Encuentra y contrata a la persona adecuada para cada trabajo.</p>
        <a href="{{config('app.ADMIN_URL') }}/register" class="register button">Regístrate</a>
    </div>
    <div class="hint">
        <h3>Work With Us es la forma más fácil para que los equipos de HR puedan gestionar los procesos de contratación.</h3>

        <div class="columns">
            <div class="column">
                <img src="/assets/icons/lupa.png" alt="lupa">
                <div>
                    <h5 style="color: #00b7cd;">FUENTE & IMÁN</h5>
                </div>
                <div>
                    <h2>Encuentra y atrae al talento</h2>
                </div>
            </div>
            <div class="column">
                <img src="/assets/icons/equipo.png" alt="equipo">
                <div>
                    <h5 style="color: #4385e0;">EVALÚA & COLABORA</h5>
                </div>
                <div>
                    <h2>Apóyate en el equipo de HR y avanza con los candidatos ideales.</h2>
                </div>
            </div>
            <div class="column">
                <img src="/assets/icons/calendario.png" alt="calendario">
                <div>
                    <h5 style="color: #4d52b1;">AUTOMATIZA & CONTRATA</h5>
                </div>
                <div>
                    <h2>Haz la mejor contratación en la mitad de tiempo.</h2>
                </div>

            </div>
        </div>
    </div>
    <div class="cta">

    </div>

</div>

<footer class="siteFooter">
    <div class="container">
        <div class="footerRow">
            <div class="titleFooter">
                <h4>Work With Us</h4>
                <ul>
                    <li><a href="{{config('app.ADMIN_URL') }}/login">Login</a></li>
                    <li><a href="{{config('app.ADMIN_URL') }}/register">Regístrate</a></li>

                </ul>
            </div>
        </div>
    </div>
</footer>

<script>
    window.onscroll = function () {
        myFunction()
    };

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
