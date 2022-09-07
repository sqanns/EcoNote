<?php declare(strict_types=1);?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoNote</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link href="/econote/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <header>
            <h1><span onclick="location.href='/econote/?action=explore';" style="cursor: pointer"><i class="far fa-clipboard"></i>Moje notatki</span></h1>
        </header>
        <main>
            <nav>
                <ul>
                    <li><a href="/econote/?action=explore">Lista Notatek</a></li>
                    <li><a href="/econote/?action=create">Nowa Notatka</a></li>
                </ul>
            </nav>
            <section>
                <?php include_once "templates/$page.php" ?>
            </section>
        </main>
        <footer>
            <p>EcoNotatki - Woźniak Wiktor</p>
        </footer>
    </div>
</body>
</html>