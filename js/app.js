$(document).ready(function(){
	$.ajax({
		url: "http://localhost/restaurant.nm/sales.php",
		data: "",
		dataType: 'json',
		method: "GET",
		success: function(data) {
			console.log(data);
			var player = [];
			var score = [];

			for(var i in data) {
				player.push("Week " + data[i].week);
				score.push(data[i].sum);
			}

			var chartdata = {
				labels: player,
				datasets : [
					{
						label: 'Inflow amount',
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: score
					}
				]
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});
