<?php $this->layout = false; ?>

<!DOCTYPE html> 
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        MyFinance - Controle de Finanças Pessoais
    </title>

    <!-- Favicon -->
    <link rel="icon" href="<?= $this->Url->build('/favicon.ico') ?>" type="image/x-icon">

    <!-- Css -->
    <?= $this->Html->css('corporate-ui-dashboard.css?v=1.0.0') ?>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,
    400,600,700|Noto+Sans:300,400,500,600,700,800|PT+Mono:300,400,500,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/349ee9c857.js" crossorigin="anonymous"></script>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>


  <body>

    <body class="bg-gray-100">
      <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
          <div class="col-12">
            <!-- End Navbar -->
          </div>
        </div>
      </div>
      <main class="main-content  mt-0">
        <section>
          <div class="page-header min-vh-100">
            <div class="container-fluid">
              <div class="row">
                <div class="col-xl-4 col-md-6 d-flex flex-column mx-auto">
                  <div class="card d-flex d-flex flex-column justify-content-center " style="padding-left: 60px; padding-right: 60px;">
                    
                      <img src="../img/logo/MyFinance.png" class="d-flex  justify-content" alt="...">
                    
                      <div class="card-header pb-0 text-left bg-transparent">
                        <h3 class="font-weight-black text-dark mt-3">Login</h3>
                        <p class="mb-0">Seja bem-vindo(a) ao MyFinance</p>
                      </div>
                      <div class="card-body">

                          <?= $this->Form->create(null, ['class' => '']) ?>

                          <div class="mb-3">
                              <?= $this->Form->control('email', ['label' => 'E-mail', 'type' => 'email', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Digite seu E-mail']); ?>
                          </div>
                          <div class="mb-3">
                              <?= $this->Form->control('password', ['type' => 'password','label' => 'Senha', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Digite sua senha']); ?>
                          </div>
                          <div class="text-center">
                            <?= $this->Form->button(__('Entrar'), ['class' => 'btn btn-dark w-100 mt-4 mb-3']) ?>
                          </div>
                        <?= $this->Form->end(); ?>
                      </div>
                    
                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                      <p class="mb-4 text-xs mx-auto">
                        Não tem uma conta ainda?
                        <a href="<?= $this->Url->build(['action' => 'adicionar']);?>" class="text-dark font-weight-bold">Registre-se</a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>

    <?= $this->Flash->render() ?>
    <div>
        <?= $this->fetch('content') ?>
    </div>


    <footer>
      <?= $this->Html->script('jquery.js'); ?>
        <?= $this->Html->script('popper.min.js'); ?>
        <?= $this->Html->script('bootstrap.min.js'); ?>
        <?= $this->Html->script('perfect-scrollbar.min.js'); ?>
        <?= $this->Html->script('smooth-scrollbar.min.js'); ?>
        <?= $this->Html->script('chartjs.min.js'); ?>
        <?= $this->Html->script('swiper-bundle.min.js'); ?>
        <?= $this->Html->script('corporate-ui-dashboard.min.js?v=1.0.0'); ?>

        <?= $this->Html->script('sweetalert2.all.min.js'); ?>

        <?= $this->element('alertas/mensagem'); ?>

    </footer>

    </body>

</html>

