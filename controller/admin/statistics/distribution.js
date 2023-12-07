
const distribtionCanvas = document.getElementById("distribtionCanvas");

const dataDistribtion = document.querySelectorAll(".dataDistribution");
const labelDistribtion = document.querySelectorAll(".labelDistribution");

var xValues = [];
for(let i = 0;i<labelDistribtion.length;i++){
  xValues.push(labelDistribtion[i].innerHTML);  
}

var yValues = [];
for(let i = 0;i<dataDistribtion.length;i++){
  yValues.push(dataDistribtion[i].innerHTML);
}

var barColors = [
  "#0eb039",
  "#c7edc5"
];

new Chart(distribtionCanvas,{
    type: "pie",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      title: {
        display: true,
        text: ""
      }
    }
  })