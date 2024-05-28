// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example

// Obtener los nombre de los 5 productos
var productosNombreString = document.getElementById("ProductosNombre").value;
var productosNombreArray = productosNombreString.split(",");
console.log(productosNombreArray[0]);

// Obtener las cantidades de los 5 productos
var productosCantidadString = document.getElementById("ProductosCantidad").value;
var productosCantidadArray = productosCantidadString.split(",");
var productosCantidadIntArray = new Array(productosCantidadArray.length);
for (var i = 0; i < productosCantidadArray.length; i++) {
  productosCantidadIntArray[i] = parseInt(productosCantidadArray[i], 10);
}

//Pasar esas cantidades a porcentajes
var total = productosCantidadIntArray.reduce((acc, val) => acc + val, 0);
var porcentajes = productosCantidadIntArray.map(val => (val / total) * 100);
for (var i = 0; i < porcentajes.length; i++){
  porcentajes[i]=Math.round(porcentajes[i]);
}



//Grafico circular
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: [productosNombreArray[0], productosNombreArray[1], productosNombreArray[2], productosNombreArray[3], productosNombreArray[4]],
    datasets: [{
      data: [productosCantidadIntArray[0], productosCantidadIntArray[1], productosCantidadIntArray[2], productosCantidadIntArray[3], productosCantidadIntArray[4]],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#ff6384', '#ff9f40'], // Colores para cada producto
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#ff6384', '#ff9f40'], // Colores al pasar el mouse sobre cada porción
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
