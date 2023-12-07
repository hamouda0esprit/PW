
const usageCanvas = document.getElementById("usageCanvas");

const date = document.querySelectorAll(".date");
const nbu = document.querySelectorAll(".nbu");

var xusageValues = [];
for(let i = 0;i<date.length;i++){
    xusageValues.push(date[i].innerHTML);  
}

var yusageValues = [];
for(let i = 0;i<nbu.length;i++){
  yusageValues.push(nbu[i].innerHTML);
}

var barColors = [
  "#0eb039",
];

new Chart(usageCanvas,{
    type: "bar",
    data: {
      labels: xusageValues,
      datasets: [{
        backgroundColor: barColors,
        data: yusageValues,
        label:"usage"
      }]
    },
    options: {
      legend: {display: false},
      title: {
        display: true,
        text: "site usage",
      }
    }
  })