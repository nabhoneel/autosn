$(document).ready(function() {
    $.ajax({
        url: "./chartData/monthwise_company_sales.php",
        dataType: 'json',
        success: function(data) {
            console.log(data);
            var months = [];
            var sales = [];
            $.each(data, function(index, element) {
                sales.push(element.sum);
                months.push(element.date);
            });

            var chartdata = {
                labels: months,
                datasets: [{
                    label: 'Sales (in ₹)',
                    backgroundColor: '#28a745',
                    borderColor: '#000',
                    borderWidth: 3,
                    pointRadius: 3,
                    data: sales
                }]
            };

            var ctx = $("#monthwise-sales");

            var lineGraph = new Chart(ctx, {
                type: 'line',
                data: chartdata,
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                fontSize: 14
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                fontSize: 11,
                                fontColor: '#000'
                            }
                        }]
                    },
                    legend: {
                        labels: {
                            fontColor: 'black',
                            fontFamily: 'monospace',
                            fontSize: 14,
                            fontStyle: 'bold'
                        }
                    },
                    title: {
                        fontSize: 16,
                        fontFamily: 'Raleway',
                        display: true,
                        text: 'Monthwise Sales'
                    }
                }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });

    $.ajax({
        url: "./chartData/sales_each_model.php",
        dataType: 'json',
        success: function(data) {
            console.log(data);
            var modelName = [];
            var sales = [];

            $.each(data, function(index, element) {
                sales.push(element["sum"]);
                modelName.push(element["model name"]);
            });

            var chartData = {
                labels: modelName,
                datasets: [{
                    label: "Overall sales",
                    backgroundColor: ["#3373b6","#3cba9f","#f19c15","#c45850", "#ccc"],
                    data: sales
                }]
            };

            var ctx = $("#sales-each-model");

            var pieChart = new Chart(ctx, {
                type: 'pie',
                data: chartData,
                options: {
                    title: {
                        display: true,
                        text: 'Total Sales (company wise)'
                    }
                }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
});
