$(".sales-people").change(function() {
    changeYear((new Date()).getFullYear());

    $.ajax({
        url: "./ajaxLoad/assists_cards.php",
        method: "POST",
        data: {
            username: $('.sales-people').find(":selected").text()
        },
        success: function(data) {
            $("#assists-cards").html(data);
        },
        error: function(data) {
            console.log(data);
        }
    });

    $.ajax({
        url: "./ajaxLoad/sales_by_sales_people.php",
        method: "POST",
        data: {
            username: $('.sales-people').find(":selected").text()
        },
        success: function(data) {
            $("#sales-data").html(data);
        },
        error: function(data) {
            console.log(data);
        }
    });
});

function changeYear(year) {
    $.ajax({
        url: "./chartData/salesComparison.php",
        method: "POST",
        data: {
            yr: year,
            username: $('.sales-people').find(":selected").text()
        },
        dataType: 'json',
        success: function(data) {
            if(data == "") {
                $('#notifyModal').modal('show');
                var message = "There are no records of ".concat($('.sales-people').find(":selected").text(), " making any sale");
                $('#notify-modal-body').html(message);
                $("#salesComparison").attr('hidden', true);
                return;
            }
            $("#salesComparison").attr('hidden', false);
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
                        text: 'Monthly Sales by '.concat($('.sales-people').find(":selected").text())
                    }
                }
            });

            var backdrop_style = {
                "background-color": "white",
                "padding": "1em",
                "-webkit-box-shadow": "0px 0px 8px 2px rgba(9,24,43,0.13)",
                "-moz-box-shadow": "0px 0px 8px 2px rgba(9,24,43,0.13)",
                "box-shadow": "0px 0px 8px 2px rgba(9,24,43,0.13)",
                "border-radius": "0.4em",
                "margin-top": "2em"
            };
            $("#salesComparison").css(backdrop_style);
        },
        error: function(data) {
            console.log(data);
        }
    });
}
