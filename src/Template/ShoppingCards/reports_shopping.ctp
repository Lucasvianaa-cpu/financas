<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Transações de Cartão de Crédito</title>
    <style>
        .category-report {
            margin: 20px 0;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            margin: 20px 0;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
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

            .form-group.button-group {
                flex: 1 1 100%;
            }
        }

        h2,
        h4 {
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
        <h4 class="mb-4">Relatório de Transações de Cartão de Crédito</h4>

        <div class="card">
            <form method="post" action="" class="mb-4">
                <div class="form-row">
                    <div class="form-group col-12 col-md-2 mb-2">
                        <label for="start_date">Data Inicial:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="<?= $startDate->format('Y-m-d') ?>" />
                    </div>
                    <div class="form-group col-12 col-md-2 mb-2">
                        <label for="end_date">Data Final:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="<?= $endDate->format('Y-m-d') ?>" />
                    </div>
                    <div class="form-group col-12 col-md-2 mb-2 button-group d-flex align-items-end" style="margin-top: 32px;">
                        <button type="submit" class="btn btn-dark">
                            <b>Buscar</b> <i class="fa-solid fa-magnifying-glass text-white" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="form-group col-12 col-md-2 mb-2 button-group d-flex align-items-end" style="gap: 5px;">
                        <a id="generatePdf" class="btn btn-danger">PDF <i class="fa-solid fa-file-pdf" aria-hidden="true"></i></a>
                        <a id="generateExcel" class="btn btn-success mt-2">Excel <i class="fa-solid fa-file-excel" aria-hidden="true"></i></a>
                    </div>
                </div>
            </form>
        </div>

        <div class="card">
            <h4>Transações</h4>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Descrição</th>
                            <th>Valor</th>
                            <th>Total de Parcelas</th>
                            <th>Parcela Atual</th>
                            <th>Nome do Cartão de Crédito</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        <?php foreach ($shoppingCards as $shoppingCard): ?>
                            <tr>
                                <td><?= h($shoppingCard->date_shopping->format('d/m/Y')) ?></td>
                                <td><?= h($shoppingCard->description) ?></td>
                                <td><?= h(number_format($shoppingCard->value_total, 2, ',', '.')) ?></td>
                                <td><?= h($shoppingCard->parcel_number) ?></td>
                                <td><?= h($shoppingCard->parcel_actual ?: '1') ?></td>
                                <td><?= h($shoppingCard->credit_card->name) ?></td>
                            </tr>
                            <?php $total += $shoppingCard->value_total; ?>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"><strong>Total:</strong></td>
                            <td><?= h(number_format($total, 2, ',', '.')) ?></td>
                            <td colspan="4"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>

    <script>
        document.getElementById('generatePdf').addEventListener('click', function() {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            const rows = Array.from(document.querySelectorAll('tbody tr')).map(row => [
                row.cells[0].innerText,
                row.cells[1].innerText,
                row.cells[2].innerText,
                row.cells[3].innerText,
                row.cells[4].innerText,
                row.cells[5].innerText
            ]);

            let total = 0;
            rows.forEach(row => {
                const value = row[2].replace('.', '').replace(',', '.');
                total += parseFloat(value);
            });

            const formattedTotal = total.toFixed(2).replace('.', ',');

            const docDefinition = {
                content: [{
                        text: 'Relatório de Transações de Cartão de Crédito',
                        style: 'header'
                    },
                    {
                        text: `Período: ${startDate.split('-').reverse().join('/')} a ${endDate.split('-').reverse().join('/')}`,
                        style: 'subheader'
                    },
                    {
                        table: {
                            headerRows: 1,
                            widths: ['auto', '*', 'auto', 'auto', 'auto', '*'],
                            body: [
                                ['Data', 'Descrição', 'Valor', 'Número da Parcela', 'Parcela Atual', 'Nome do Cartão de Crédito'],
                                ...rows,
                                [{}, {},
                                    {
                                        text: `${formattedTotal}`,
                                        alignment: 'left',
                                        bold: true
                                    },
                                    {}, {}, {}
                                ]
                            ]
                        },
                        layout: 'lightHorizontalLines'
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
                    },
                    table: {
                        margin: [0, 5, 0, 15]
                    },
                    tableHeader: {
                        bold: true,
                        fontSize: 13,
                        color: 'black'
                    }
                }
            };

            pdfMake.createPdf(docDefinition).download('relatorio_transacoes.pdf');
        });



        document.getElementById('generateExcel').addEventListener('click', function() {
            const wb = XLSX.utils.book_new();
            const ws_data = [];
            const headers = ["Data", "Descrição", "Valor", "Número da Parcela", "Parcela Atual", "Nome do Cartão de Crédito"];
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            const period = `Período: ${startDate} a ${endDate}`;
            ws_data.push([period]);
            ws_data.push(headers);

            let total = 0;
            document.querySelectorAll('tbody tr').forEach(row => {
                const rowData = [
                    row.cells[0].innerText,
                    row.cells[1].innerText,
                    row.cells[2].innerText,
                    row.cells[3].innerText,
                    row.cells[4].innerText,
                    row.cells[5].innerText
                ];
                ws_data.push(rowData);
                total += parseFloat(row.cells[2].innerText.replace(',', '.'));
            });

            ws_data.push(['', '', `Total: ${total.toFixed(2).replace('.', ',')}`]);

            const ws = XLSX.utils.aoa_to_sheet(ws_data);
            XLSX.utils.book_append_sheet(wb, ws, "Relatório");
            XLSX.writeFile(wb, 'relatorio_transacoes.xlsx');
        });
    </script>
</body>

</html>