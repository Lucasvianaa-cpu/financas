<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        MyFinance
    </title>

    <link rel="icon" href="<?= $this->Url->build('/favicon.ico') ?>" type="image/x-icon">
    <?= $this->Html->css('corporate-ui-dashboard.css?v=1.0.0') ?>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,
    400,600,700|Noto+Sans:300,400,500,600,700,800|PT+Mono:300,400,500,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/349ee9c857.js" crossorigin="anonymous"></script>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <style>
        #preload-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 99999;
        }

        .spinner-container {
            text-align: center;
        }

        .dropdown-toggle:hover {
            box-shadow: none;
            border: none;
        }

        .dropdown-toggle:not(:focus) {
            outline: none;
            border: none;
        }

        .dropdown-toggle:not(:hover) {
            outline: none;
            border: none;
        }

        .dropdown-toggle:focus {
            box-shadow: none;
            border: none;
        }

        @media (max-width: 992px) {

            .dropdown.dropdown-hover:hover>.dropdown-menu,
            .dropdown .dropdown-menu.show {
                position: absolute;
            }
        }

        @media (min-width: 992px) {

            .dropdown.dropdown-hover:hover>.dropdown-menu,
            .dropdown .dropdown-menu.show {
                position: absolute;
                top: 40px;
            }
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-100">

    <div id="preload-overlay">
        <div class="spinner-container">
            <div class="spinner-border text-dark" role="status">
            </div>
        </div>
    </div>

    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start " id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand d-flex align-items-center m-0" target="_blank">
                <span class="font-weight-bold text-lg">MyFinance</span>
            </a>
        </div>
        <div class="collapse navbar-collapse px-4  w-auto vh-100" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">

                    <a class="nav-link " href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'dashboard']); ?>">
                        <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>dashboard</title>
                                <g id="dashboard" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="template" transform="translate(12.000000, 12.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                        <path class="color-foreground" d="M0,1.71428571 C0,0.76752 0.76752,0 1.71428571,0 L22.2857143,0 C23.2325143,0 24,0.76752 24,1.71428571 L24,5.14285714 C24,6.08962286 23.2325143,6.85714286 22.2857143,6.85714286 L1.71428571,6.85714286 C0.76752,6.85714286 0,6.08962286 0,5.14285714 L0,1.71428571 Z" id="Path"></path>
                                        <path class="color-background" d="M0,12 C0,11.0532171 0.76752,10.2857143 1.71428571,10.2857143 L12,10.2857143 C12.9468,10.2857143 13.7142857,11.0532171 13.7142857,12 L13.7142857,22.2857143 C13.7142857,23.2325143 12.9468,24 12,24 L1.71428571,24 C0.76752,24 0,23.2325143 0,22.2857143 L0,12 Z" id="Path"></path>
                                        <path class="color-background" d="M18.8571429,10.2857143 C17.9103429,10.2857143 17.1428571,11.0532171 17.1428571,12 L17.1428571,22.2857143 C17.1428571,23.2325143 17.9103429,24 18.8571429,24 L22.2857143,24 C23.2325143,24 24,23.2325143 24,22.2857143 L24,12 C24,11.0532171 23.2325143,10.2857143 22.2857143,10.2857143 L18.8571429,10.2857143 Z" id="Path"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                <li class="nav-item">
                    <a class="nav-link" href="#!" onclick="toggleSubMenu(event)">
                        <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-tags" aria-hidden="true" style="font-size: 20px; display: inline-block; text-align: center;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Categorias</span>
                    </a>
                    <ul class="sub-menu" style="display: none;">
                        <li><a class="nav-link" href="<?= $this->Url->build(['controller' => 'Categories', 'action' => 'add']); ?>">Cadastrar</a></li>
                        <li><a class="nav-link" href="<?= $this->Url->build(['controller' => 'Categories', 'action' => 'index']); ?>">Visualizar</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#!" onclick="toggleSubMenu(event)">
                        <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-minus-square" aria-hidden="true" style="font-size: 20px; display: inline-block; text-align: center;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Contas a Pagar</span>
                    </a>
                    <ul class="sub-menu" style="display: none;">
                        <li><a class="nav-link" href="<?= $this->Url->build(['controller' => 'Expenses', 'action' => 'add']); ?>">Cadastrar</a></li>
                        <li><a class="nav-link" href="<?= $this->Url->build(['controller' => 'Expenses', 'action' => 'index']); ?>">Visualizar</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#!" onclick="toggleSubMenu(event)">
                        <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-plus-square" aria-hidden="true" style="font-size: 20px; display: inline-block; text-align: center;"></i>

                        </div>
                        <span class="nav-link-text ms-1">Contas a Receber</span>
                    </a>
                    <ul class="sub-menu" style="display: none;">
                        <li><a class="nav-link" href="<?= $this->Url->build(['controller' => 'Receives', 'action' => 'add']); ?>">Cadastrar</a></li>
                        <li><a class="nav-link" href="<?= $this->Url->build(['controller' => 'Receives', 'action' => 'index']); ?>">Visualizar</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#!" onclick="toggleSubMenu(event)">
                        <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-credit-card-alt" aria-hidden="true" style="font-size: 20px; display: inline-block; text-align: center;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Meus Cartões</span>
                    </a>
                    <ul class="sub-menu" style="display: none;">
                        <li><a class="nav-link" href="<?= $this->Url->build(['controller' => 'creditCards', 'action' => 'add']); ?>">Cadastrar</a></li>
                        <li><a class="nav-link" href="<?= $this->Url->build(['controller' => 'creditCards', 'action' => 'index']); ?>">Visualizar</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#!" onclick="toggleSubMenu(event)">
                        <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 20px; display: inline-block; text-align: center;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Compras c/ Cartões</span>
                    </a>
                    <ul class="sub-menu" style="display: none;">
                        <li><a class="nav-link" href="<?= $this->Url->build(['controller' => 'ShoppingCards', 'action' => 'add']); ?>">Cadastrar</a></li>
                        <li><a class="nav-link" href="<?= $this->Url->build(['controller' => 'ShoppingCards', 'action' => 'index']); ?>">Visualizar</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#!" onclick="toggleSubMenu(event)">
                        <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trello" viewBox="0 0 16 16">
                                <path d="M14.1 0H1.903C.852 0 .002.85 0 1.9v12.19A1.902 1.902 0 0 0 1.902 16h12.199A1.902 1.902 0 0 0 16 14.09V1.9A1.902 1.902 0 0 0 14.1 0ZM7 11.367a.636.636 0 0 1-.64.633H3.593a.633.633 0 0 1-.63-.633V3.583c0-.348.281-.631.63-.633h2.765c.35.002.632.284.633.633L7 11.367Zm6.052-3.5a.633.633 0 0 1-.64.633h-2.78A.636.636 0 0 1 9 7.867V3.583a.636.636 0 0 1 .633-.633h2.778c.35.002.631.285.631.633l.01 4.284Z" />
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Relatórios</span>
                    </a>
                    <ul class="sub-menu" style="display: none;">
                        <li><a class="nav-link" href="<?= $this->Url->build(['controller' => 'Expenses', 'action' => 'reportsExpenseMonthly']); ?>">Despesas por Categoria</a></li>
                        <li><a class="nav-link" href="<?= $this->Url->build(['controller' => 'ShoppingCards', 'action' => 'reportsShopping']); ?>">Transações do Cartão</a></li>
                        <li><a class="nav-link" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'reportsSaldo']); ?>">Razão de Saldo</a></li>
                    </ul>
                </li>

                <li class="nav-item">

                    <a class="nav-link " href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'sair']) ?>">
                        <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                                <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Sair</span>
                    </a>
                </li>

            </ul>
        </div>
    </aside>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <nav class="navbar navbar-main navbar-expand-lg mx-5 px-0 shadow-none rounded" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-2">

                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">

                    </div>
                    <ul class="navbar-nav ">
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item ps-2 d-flex align-items-center">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $this->Html->image('perfil.png', [
                                        'width' => '40px',
                                        'height' => 'auto',
                                    ]); ?>
                                    <span class="nav-link-text ms-1"><?= $current_user['username'] ?></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                    <li>
                                        <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'sair']) ?>">Sair</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <?= $this->Flash->render() ?>
        <div>
            <?= $this->fetch('content') ?>
        </div>

    </main>

    <footer>
        <?= $this->Html->script('jquery.js'); ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <?= $this->Html->script('popper.min.js'); ?>
        <?= $this->Html->script('bootstrap.min.js'); ?>
        <?= $this->Html->script('perfect-scrollbar.min.js'); ?>
        <?= $this->Html->script('mascaras.js'); ?>
        <?= $this->Html->script('maskmoney.min.js'); ?>
        <?= $this->Html->script('smooth-scrollbar.min.js'); ?>
        <?= $this->Html->script('chartjs.min.js'); ?>
        <?= $this->Html->script('swiper-bundle.min.js'); ?>
        <?= $this->Html->script('corporate-ui-dashboard.min.js?v=1.0.0'); ?>
        <?= $this->Html->script('sweetalert2.all.min.js'); ?>
        <?= $this->element('alertas/mensagem'); ?>
        <?= $this->Html->script('style.js'); ?>

        <script>
            $(window).on('load', function() {
                $('#preload-overlay').fadeOut('slow', function() {
                    $(this).remove();
                });
            });
        </script>

        <script>
            function toggleSubMenu(event) {
                event.preventDefault();
                const subMenu = event.currentTarget.nextElementSibling;
                subMenu.style.display = (subMenu.style.display === 'none' || subMenu.style.display === '') ? 'block' : 'none';
            }
        </script>
    </footer>
</body>

</html>