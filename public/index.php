<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livraria alexandria</title>

    <base href="http://<?=$_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"]?>">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/parsley.min.js"></script>

</head>
<body>
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index">
                <img src="images/logo.jpg" alt="Livraria Alexandria">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="index">Home</a>
                    </li>

                    <?php
                    $urlCategoria = "http://localhost/Livraria_Alexandria-main/public/apis/categoria.php";
                    $dadosCategoria = json_decode(file_get_contents($urlCategoria));
                    
                    foreach($dadosCategoria as $dados) {
                        ?>
                        <li class="nav-item">
                            <a href="categoria/index/<?=$dados->id?>" class="nav-link">
                                <?=$dados->descricao?>
                            </a>
                        </li>
                        <?php
                    }
                    
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="carrinho">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </li>

                    <?php
                        if (isset($_SESSION["cliente"])) {
                            ?>
                            <li class="nav-item">
                               <a class="nav-link" href="carrinho">
                                  <i class="fas fa-gift"></i>                      
                                </a>              
                            </li>
                            <li class="nav-item">
                               <a class="nav-link" href="carrinho/sair">
                                  <i class="fas fa-power-off"></i>                      
                                </a>              
                            </li>
                            <?php
                        } else {
                            ?>
                            <li class="nav-item">
                               <a class="nav-link" href="carrinho/finalizar">
                                  <i class="fas fa-user"></i>                      
                                </a>              
                            </li>
                            <?php
                        }

                    ?>
                </ul>

            </div>
        </div>
    </nav>
    <main class="container">
        <?php
            $param = "index";
            $img = "http://localhost/Livraria_Alexandria/public/images";

            if (isset($_GET["param"])) {
                $param = explode("/", $_GET["param"]);
            }

            $controller = $param[0] ?? "index";
            $acao = $param[1] ?? "index";
            $id = $param[2] ?? null;

            $controller = ucfirst($controller)."Controller";

            if (file_exists("../controllers/{$controller}.php")) {

                require "../controllers/{$controller}.php"; 

                $control = new $controller();
                $control->$acao($id, $img);     
                     
            } else {
                require "../views/index/erro.php";
                
            }
        ?>
        </main>
    
</body>
</html>