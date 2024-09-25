<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    MyFinance
  </title>

  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.3/dist/apexcharts.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

  <!-- Favicon -->
  <link rel="icon" href="<?= $this->Url->build('/favicon.ico') ?>" type="image/x-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,
    400,600,700|Noto+Sans:300,400,500,600,700,800|PT+Mono:300,400,500,600,700" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/349ee9c857.js" crossorigin="anonymous"></script>

  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>
  <?= $this->fetch('script') ?>
</head>

<body class="g-sidenav-show  bg-gray-100">

  <div class="container-fluid py-4 px-5">
    <div class="row">
      <div class="col-md-12">
        <div class="d-md-flex align-items-center mb-3 mx-2">
          <div class="mb-md-0 mb-3">
            <h3 class="font-weight-bold mb-0">Bem-vindo(a), <?= $current_user['username'] ?>!</h3>
          </div>
        </div>
      </div>
    </div>

    <hr class="my-0">

    <div class="row mt-3">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0">
          <div class="card border shadow-xs mb-4">
            <div class="card-body text-start p-3 w-100">
              <div class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z"></path>
                  <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="w-100">
                    <p class="text-sm text-secondary mb-1">Receitas</p>
                    <h4 class="mb-2 font-weight-bold"><?= 'R$ ' . number_format($totalReceives, 2, ',', '.'); ?></h4>
                    <div class="d-flex align-items-center">
                      <span class="text-sm ms-1"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                        Ref. ao mês atual</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0">
          <div class="card border shadow-xs mb-4">
            <div class="card-body text-start p-3 w-100">
              <div class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                  <path fill-rule="evenodd" d="M7.5 5.25a3 3 0 013-3h3a3 3 0 013 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0112 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 017.5 5.455V5.25zm7.5 0v.09a49.488 49.488 0 00-6 0v-.09a1.5 1.5 0 011.5-1.5h3a1.5 1.5 0 011.5 1.5zm-3 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"></path>
                  <path d="M3 18.4v-2.796a4.3 4.3 0 00.713.31A26.226 26.226 0 0012 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 01-6.477-.427C4.047 21.128 3 19.852 3 18.4z"></path>
                </svg>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="w-100">
                    <p class="text-sm text-secondary mb-1">Despesas</p>
                    <h4 class="mb-2 font-weight-bold"><?= 'R$ ' . number_format($totalExpenses, 2, ',', '.'); ?></h4>
                    <div class="d-flex align-items-center">
                      <span class="text-sm ms-1"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                        Ref. ao mês atual</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0">
          <div class="card border shadow-xs mb-4">
            <div class="card-body text-start p-3 w-100">
              <div class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                  <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h12a3 3 0 013 3v12a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm4.5 7.5a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0v-2.25a.75.75 0 01.75-.75zm3.75-1.5a.75.75 0 00-1.5 0v4.5a.75.75 0 001.5 0V12zm2.25-3a.75.75 0 01.75.75v6.75a.75.75 0 01-1.5 0V9.75A.75.75 0 0113.5 9zm3.75-1.5a.75.75 0 00-1.5 0v9a.75.75 0 001.5 0v-9z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="w-100">
                    <p class="text-sm text-secondary mb-1">Lançamentos Crédito</p>
                    <h4 class="mb-2 font-weight-bold"><?= 'R$ ' . number_format($totalShoppingCards, 2, ',', '.'); ?></h4>
                    <div class="d-flex align-items-center">
                      <span class="text-sm ms-1"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                        Ref. ao mês atual</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card border shadow-xs mb-4">
            <div class="card-body text-start p-3 w-100">
              <div class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 005.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 00-2.122-.879H5.25zM6.375 7.5a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="w-100">
                    <p class="text-sm text-secondary mb-1">Saldo Mensal</p>
                    <h4 class="mb-2 font-weight-bold"><?= 'R$ ' . number_format($saldoMensal, 2, ',', '.'); ?></h4>
                    <div class="d-flex align-items-center">
                      <span class="text-sm ms-1"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                        Saldo Mensal</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-12">
      <div class="card shadow-xs border">
        <div class="card-header pb-0">
          <div class="d-sm-flex align-items-center mb-3">
            <div>
              <h6 class="font-weight-semibold text-lg mb-0">Evolução do Saldo</h6>
              <p class="text-sm mb-sm-0 mb-5">Aqui você consegue visualizar a evolução de seu saldo...</p>
            </div>
            <div class="ms-auto d-flex">
              <button type="button" class="btn btn-sm btn-white mb-0 me-2" id="saveAsPNG">
                Salvar como PNG
              </button>
            </div>
          </div>
        </div>
        <div class="card-body p-3 mt-5">
          <div class="chart mt-n6" id="chart-container">
            <canvas id="chart-line" class="chart-canvas" style="height: 200px; width: 100%;"></canvas>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('chart-line').getContext('2d');
        var chart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            datasets: [{
              label: 'Saldo Mensal',
              data: <?php echo json_encode(array_values($saldoMensalPorMes)); ?>,
              borderColor: 'rgba(75, 192, 192, 1)',
              backgroundColor: 'rgba(75, 192, 192, 0.2)',
              fill: true
            }]
          },
          options: {
            responsive: true,
            scales: {
              x: {
                beginAtZero: true
              },
              y: {
                beginAtZero: true
              }
            }
          }
        });

        document.getElementById('saveAsPNG').addEventListener('click', function() {
          html2canvas(document.getElementById('chart-container')).then(canvas => {
            const link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = 'chart.png';
            link.click();
          });
        });
      });
    </script>

</body>

</html>