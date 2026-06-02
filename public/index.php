<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

use App\Controller\authController;
use App\Controller\EventoController;
use App\Controller\CategoriaController;

require_once('../controller/authController.php');
require_once('../controller/EventoController.php');
require_once('../controller/CategoriaController.php');
require_once('../controller/DashboardController.php');
require_once('../models/auth.php');
require_once('../models/Evento.php');
require_once('../models/Categoria.php');
require_once('../config/database.php');

$controller          = new authController();
$eventoController    = new EventoController();
$categoriaController = new CategoriaController();
$page = $_GET['p'] ?? "home";

$paginas_privadas = ['dashboard', 'meusEventos', 'gerenciar', 'editar', 'criar'];

if (in_array($page, $paginas_privadas) && !isset($_SESSION['usuario_id'])) {
    header("Location: index.php?p=login");
    exit;
}

switch($page){
    case 'cadastrar':
        $controller->criarUser();
        break;
    case 'logar':
        $controller->logar();
        break;
    case 'logout':
        $controller->logout();
        break;
    case 'salvar_evento':
        $eventoController->salvarEvento();
        break;
    case 'atualizar_evento':
        $eventoController->editarEvento();
        break;
    case 'deletar_evento':
        $eventoController->deletarEvento();
        break;
    case 'recuperarSenha':
        $controller->recuperarSenha();
        break;
    case 'salvar_categoria':
        $categoriaController->salvar();
        break;
    case 'deletar_categoria':
        $categoriaController->deletar();
        break;
}

$eventos    = [];
$evento     = null;
$categorias = [];

if ($page === 'home') {
    $eventos    = $eventoController->carregarHome();
    $categorias = $categoriaController->listar();
} elseif ($page === 'eventos') {
    $eventos    = $eventoController->carregarEventos();
    $categorias = $categoriaController->listar();
} elseif ($page === 'meusEventos') {
    $eventos = $eventoController->carregarMeusEventos();
} elseif ($page === 'editar') {
    $evento     = $eventoController->carregarEditar($_GET['id'] ?? 0);
    $categorias = $categoriaController->listar();
} elseif ($page === 'criar') {
    $categorias = $categoriaController->listar();
}

?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/css/login.css">
    <link rel="stylesheet" href="../public/css/home.css">
    <link rel="stylesheet" href="../public/css/dashboard.css">
    <link rel="stylesheet" href="../public/css/eventos.css">
    <link rel="stylesheet" href="../public/css/gerenciar_eventos.css">
    <link rel="stylesheet" href="../public/css/institucional.css">
    <title>PartyPal</title>
</head>
<body>
    <?php if ($page !== 'login'): ?>
    <header>
        <nav>
            <?php require_once('../public/menu.php'); ?>
        </nav>
    </header>
    <?php endif; ?>
    <main class="<?php echo $page === 'login' ? 'auth-main' : ''; ?>">
        <?php
            match($page){
                "home"        => require_once('../view/home.php'),
                "login"       => require_once('../view/login.php'),
                "dashboard"   => require_once('../view/dashboard.php'),
                "eventos"     => require_once('../view/eventos.php'),
                'contato'     => require_once('../view/contato.php'),
                'sobre'       => require_once('../view/sobre.php'),
                'meusEventos' => require_once('../view/meus_eventos.php'),
                'gerenciar'   => require_once('../view/gerenciar_categorias.php'),
                'editar'      => require_once('../view/editar_evento.php'),
                'detalhes'    => require_once('../view/detalhes_evento.php'),
                'criar'       => require_once('../view/criar_evento.php'),
                default       => require_once('../view/error404.php')
            };
        ?>
    </main>
</body>
</html>