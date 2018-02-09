/*var myChart = new Chart(ctx, {
    type: 'line',
    data: {
            labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
            datasets: [{
              label: 'apples',
              data: [12, 19, 3, 17, 6, 3, 7],
              backgroundColor: "rgba(153,255,51,0.4)"
            }, {
              label: 'oranges',
              data: [2, 29, 5, 5, 2, 3, 10],
              backgroundColor: "rgba(255,153,0,0.4)"
            }]
        },
    options: {
              title: {
                display: true,
                text: 'Custom Chart Title'
              }
            }
});*/

$(document).ready(function() {
    changeYear((new Date()).getFullYear());
});

function changeYear(year) {
    document.getElementById("chosenYear").value = year;$.ajax({
        url: "./chartData/salesComparison.php",
        method: "POST",
        data: {
            yr: year
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            var months = [];
            var sales = [];
            var monthnames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            $.each(data, function(index, element) {
                months.push(monthnames[element.month-1]);
                sales.push(element.amount);
            });

            var chartdata = {
                labels: months,
                datasets: [{
                    label: 'Sales (in ₹)',
                    backgroundColor: '#f45042',
                    borderColor: '#000',
                    borderWidth: 3,
                    pointRadius: 5,
                    data: sales
                }]
            };

            var ctx = $("#salesComparison");

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
                                fontSize: 14,
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
                        fontSize: 20,
                        fontFamily: 'Raleway',
                        display: true,
                        text: 'Sales Comparison'
                    }
                }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
}
