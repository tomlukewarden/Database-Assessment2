url = "char_data.php";
fetch(url)
    .then(response => response.json())
    .then(function (data) {
        const products = data.product_name;
        const totalSold = data.price;
        const barColors = ['#1A237E', "#D1C4E9", "#B39DDB", "#87CEEB", "#6200EA"];
        new Chart("myChart", {
            type: "doughnut", data: {
                datasets: [{
                    data: totalSold,
                    backgroundColor: barColors,
                }],
                labels: products,
            }
        });
    })
    .catch(error => console.error('Error fetching JSON:', error));

/*
var newValues = [" Coffee", "Pastries", "Merch", "Beverages", "Coffee Beans"]; var otherValues = [55, 49, 44,
    24, 15]; var barColors = ['#1A237E', "#D1C4E9", "#B39DDB", "#87CEEB", "#6200EA"];
new Chart("myChart", {
    type: "doughnut", data: {
        datasets: [{
            data: otherValues,
            backgroundColor: barColors
        }], labels: newValues
    }
});
*/
const xValues = [50, 60, 70, 80,
    90, 100, 110, 120, 130, 140, 150]; const yValues = [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];

new Chart("graph", {
    type: "line", data: {
        labels: xValues, datasets: [{
            fill: false,
            lineTension: 0, backgroundColor: "rgba(0,0,255,1.0)", borderColor: "rgba(0,0,255,0.1)"
            , data: yValues
        }]
    }, options: {
        legend: { display: false }, scales: {
            yAxes: [{
                ticks:
                    { min: 6, max: 16 }
            }],
        }
    }
}); 