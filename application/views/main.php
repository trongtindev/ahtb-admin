<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            overflow-x: hidden;
        }

        .navbar {
            margin-bottom: 10px;
        }

        .pull-left {
            float: left;
        }

        .pull-right {
            float: right;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .clearfix {
            clear: both;
        }

        .center {
            margin: auto;
            text-align: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-md">
            <a class="navbar-brand" href="/">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/npcs">NPCs</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/maps">Maps</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/items">Items</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/users">Users</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/servers">Servers</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/objects">Objects</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/settings">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?= $body ?>
    </div>
    <div class="footer mt-10"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>