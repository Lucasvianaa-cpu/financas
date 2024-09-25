<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Saldo</title>
    <style>
        .card {
            margin: 20px 0;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .form-group {
            margin-bottom: 1rem;
            flex: 1 1 auto;
        }

        .btn {
            width: 100%;
        }

        @media (max-width: 767px) {
            .form-group {
                flex: 1 1 100%;
            }
        }

        h2 {
            margin-top: 0;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        tfoot td {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h4>Relatório de Saldo</h4>

        <div class="card">
            <form method="post" action="" class="mb-4">
                <div class="form-row">
                    <div class="form-group col-12 col-md-2 mb-2">
                        <label for="start_date">Data Inicial:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="<?= h($startDate->format('Y-m-d')) ?>" />
                    </div>
                    <div class="form-group col-12 col-md-2 mb-2">
                        <label for="end_date">Data Final:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="<?= h($endDate->format('Y-m-d')) ?>" />
                    </div>
                    <div class="form-group col-12 col-md-2 mb-2" style="margin-top: 32px;">
                        <button type="submit" class="btn btn-dark">
                            <b>Buscar</b>
                        </button>
                    </div>
                    <div class="form-group col-12 col-md-2 mb-2" style="margin-top: 32px;">
                        <button type="button" id="generatePdf" class="btn btn-danger">
                            PDF <i class="fa-solid fa-file-pdf" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="form-group col-12 col-md-2 mb-2" style="margin-top: 32px;">
                        <button type="button" id="generateExcel" class="btn btn-success">
                            Excel <i class="fa-solid fa-file-excel" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card">
            <h4>Resumo</h4>
            <p><strong>Data de Início:</strong> <?= h($startDate->format('d/m/Y')) ?></p>
            <p><strong>Data de Fim:</strong> <?= h($endDate->format('d/m/Y')) ?></p>
            <p><strong>Total de Despesas:</strong> R$ <?= number_format($totalExpenses, 2, ',', '.') ?></p>
            <p><strong>Total de Recebimentos:</strong> R$ <?= number_format($totalReceives, 2, ',', '.') ?></p>
            <p><strong>Saldo Mensal:</strong> R$ <?= number_format($saldoMensal, 2, ',', '.') ?></p>
        </div>
    </div>
    <input type="hidden" name="total_expenses" value="<?= $totalExpenses ?>" />
    <input type="hidden" name="total_receives" value="<?= $totalReceives ?>" />
    <input type="hidden" name="saldo_mensal" value="<?= $saldoMensal ?>" />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>

    <script>
        document.getElementById('generatePdf').addEventListener('click', function() {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            const totalExpensesElem = document.querySelector('[name="total_expenses"]');
            const totalReceivesElem = document.querySelector('[name="total_receives"]');
            const saldoMensalElem = document.querySelector('[name="saldo_mensal"]');

            if (!totalExpensesElem || !totalReceivesElem || !saldoMensalElem) {
                alert('Alguns dados necessários não estão disponíveis.');
                return;
            }

            const docDefinition = {
                content: [{
                        text: 'Relatório de Saldo',
                        style: 'header'
                    },
                    {
                        text: `Período: ${startDate.split('-').reverse().join('/')} a ${endDate.split('-').reverse().join('/')}`,
                        style: 'subheader'
                    },
                    {
                        text: `Total de Despesas: R$ ${parseFloat(totalExpensesElem.value).toFixed(2).replace('.', ',')}`,
                        style: 'subheader'
                    },
                    {
                        text: `Total de Recebimentos: R$ ${parseFloat(totalReceivesElem.value).toFixed(2).replace('.', ',')}`,
                        style: 'subheader'
                    },
                    {
                        text: `Saldo Mensal: R$ ${parseFloat(saldoMensalElem.value).toFixed(2).replace('.', ',')}`,
                        style: 'subheader'
                    }
                ],
                styles: {
                    header: {
                        fontSize: 18,
                        bold: true,
                        margin: [0, 0, 0, 10]
                    },
                    subheader: {
                        fontSize: 14,
                        bold: true,
                        margin: [0, 0, 0, 10]
                    }
                }
            };

            pdfMake.createPdf(docDefinition).download('relatorio_saldo.pdf');
        });

        document.getElementById('generateExcel').addEventListener('click', function() {
            const wb = XLSX.utils.book_new();
            const ws_data = [];
            const headers = ["Descrição", "Valor"];
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            const period = `Período: ${startDate} a ${endDate}`;
            ws_data.push([period]);
            ws_data.push(headers);

            const totalExpensesElem = document.querySelector('[name="total_expenses"]');
            const totalReceivesElem = document.querySelector('[name="total_receives"]');
            const saldoMensalElem = document.querySelector('[name="saldo_mensal"]');

            if (!totalExpensesElem || !totalReceivesElem || !saldoMensalElem) {
                alert('Alguns dados necessários não estão disponíveis.');
                return;
            }

            ws_data.push(["Total de Despesas", `R$ ${parseFloat(totalExpensesElem.value).toFixed(2).replace('.', ',')}`]);
            ws_data.push(["Total de Recebimentos", `R$ ${parseFloat(totalReceivesElem.value).toFixed(2).replace('.', ',')}`]);
            ws_data.push(["Saldo Mensal", `R$ ${parseFloat(saldoMensalElem.value).toFixed(2).replace('.', ',')}`]);

            const ws = XLSX.utils.aoa_to_sheet(ws_data);
            XLSX.utils.book_append_sheet(wb, ws, "Relatório");
            XLSX.writeFile(wb, 'relatorio_saldo.xlsx');
        });
    </script>
</body>

</html>