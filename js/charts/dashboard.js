$(document).ready(function() {
    $.ajax({
        url: "./chartData/allSalesComparison.php",
        dataType: 'json',
        success: function(data) {
            console.log(data);
            var months = [];
            var sales = [];
            var monthnames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            $.each(data, function(index, element) {
                sales.push(element.sum);
                months.push(monthnames[element.month-1].concat(" (", element.year, ")"));
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

            var ctx = $("#all-sales-comparison");

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
        url: "./chartData/salesPeopleComparison.php",
        dataType: 'json',
        success: function(data) {
            console.log(data);
            var seller = [];
            var sales = [];

            $.each(data, function(index, element) {
                sales.push(element.sum);
                seller.push(element.seller);
            });

            var chartdata = {
                labels: seller,
                datasets: [{
                    label: 'Sales (in ₹)',
                    backgroundColor: '#f45042',
                    borderColor: '#000',
                    borderWidth: 3,
                    pointRadius: 3,
                    data: sales
                }]
            };

            var ctx = $("#seller-comparison");

            var lineGraph = new Chart(ctx, {
                type: 'bar',
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
                        fontFamily: 'Raleway',
                        display: true,
                        text: 'Seller Comparison'
                    }
                }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });

    $.ajax({
        url: "./chartData/companyWiseComparison.php",
        dataType: 'json',
        success: function(data) {
            console.log(data);
            var companyName = [];
            var sales = [];

            $.each(data, function(index, element) {
                sales.push(element.sum);
                companyName.push(element.cname);
            });

            var chartData = {
                labels: companyName,
                datasets: [{
                    label: "Overall sales",
                    backgroundColor: ["#3373b6","#3cba9f","#f19c15","#c45850"],
                    data: sales
                }]
            };

            var ctx = $("#company-sales");

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
