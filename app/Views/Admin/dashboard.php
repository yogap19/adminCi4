<?= $this->extend('Template/index'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row d-flex justify-content-evenly mb-3">
        <div class="col-2 mx-1 p-3 card shadow text-white" style="background: #1c4645;">
        Status 
        <div class="row">
         
        </div> 
        </div>
        <div class="col-2 mx-1 p-3 card shadow text-white" style="background: #1c4645;">Pemasukan <?= array_sum($pemasukanHarian) ; ?></div>
        <div class="col-2 mx-1 p-3 card shadow text-white" style="background: #1c4645;">Pengeluaran Barang</div>
        <div class="col-2 mx-1 p-3 card shadow text-white" style="background: #1c4645;">Pengeluaran Jasa</div>
    </div>

    <div class="card shadow my-3">
        <div class="m-3">
            <h3 class="text-center fw-bold">Data Barang</h3>
            <canvas id="dataHarian" height="70"></canvas>
        </div>
    </div>

    <div class="card shadow">
        <div class="m-3">
            <h3 class="text-center fw-bold">Transaksi Bulanan</h3>
            <canvas id="chartBulanan" height="70"></canvas>
        </div>
    </div>
    <div class="card shadow my-3">
        <div class="m-3">
            <h3 class="text-center fw-bold">Data Barang</h3>
            <canvas id="dataBarang" height="70"></canvas>
        </div>
    </div>
</div>

<script>

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }


    // chart Harian
    var lastOptions = {
        responsive: true,
        legend: {
            position: "bottom",
            labels: {
                usePointStyle: true,
                boxWidth: 6,
                fontColor: "#000"
            }
        },
        title: {
            display: true,
            text: ""
        },
        scales: {
            xAxes: [{
                time: {
                    unit: 'date'
                },
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    maxTicksLimit: 12,
                    fontColor: "#000"
                }
            }],
            yAxes: [{
                beginAtZero: true,
                ticks: {
                    maxTicksLimit: 5,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return number_format(value) + ' Rupiah ';
                    }
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }],
        },
        tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' Rupiah';
                }
            }
        },
    }
    var barLast = {
        labels: <?= json_encode($date) ; ?>,

        datasets: [
            {
                label: "Pemasukan",
                backgroundColor: "#4DD3A4",
                borderColor: "#4DD3A4",
                barThickness: 20,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= json_encode($pemasukanHarian) ; ?>
            },
            {
                label: "Pengeluaran",
                backgroundColor: "#FF6384",
                borderColor: "#FF6384",
                barThickness: 20,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= json_encode($pengeluaranHarian) ; ?>
            }
        ]
    };
    var ctx = document.getElementById("dataHarian").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: "bar",
        data: barLast,
        options: lastOptions
    });

    // chart bulanan
    var arsBln = document.getElementById("chartBulanan").getContext('2d');
    var myChart = new Chart(arsBln, {
        type: 'line',
        data: {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            datasets: [{
                label: 'Pemasukan Bulanan',
                data: <?= json_encode($pemasukanBulanan); ?>, 
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgb(28,200,138)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
            },
            {
                label: 'Pengeluaran Bulanan',
                data:  <?= json_encode($pengeluaranBulanan); ?>, 
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgb(255,99,132)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
            }
        ],
            
        },
        options: {
            responsive: true,
            legend: {
                display: false
            },
            title: {
                display: true,
                fontColor: "#000",
                text: ""
            },
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 5,
                    bottom: 15
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        fontColor: "#000",
                        maxTicksLimit: 12
                    }
                }],
                yAxes: [{
                    ticks: {
                        fontColor: "#000",
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return number_format(value) + ' Rp ';
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' Rupiah';
                    }
                }
            }
        }
    });

    // chart barang
    var lastOptions = {
        responsive: true,
        legend: {
            position: "bottom",
            labels: {
                usePointStyle: true,
                boxWidth: 6,
                fontColor: "#000"
            }
        },
        title: {
            display: true,
            text: ""
        },
        scales: {
            xAxes: [{
                time: {
                    unit: 'date'
                },
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    maxTicksLimit: 12,
                    fontColor: "#000"
                }
            }],
            yAxes: [{
                beginAtZero: true,
                ticks: {
                    maxTicksLimit: 5,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return number_format(value) + ' Barang ';
                    }
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }],
        },
        tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' Barang';
                }
            }
        },
    }
    var barLast = {
        labels: <?= json_encode($namaBarang) ; ?>,

        datasets: [
            {
                label: "Jumlah",
                backgroundColor: "#4E73DF",
                borderColor: "#4E73DF",
                barThickness: 20,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= json_encode($quantity) ; ?>
            },
        ]
    };
    var ctx = document.getElementById("dataBarang").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: "bar",
        data: barLast,
        options: lastOptions
    });
</script>
<?= $this->endSection(); ?>