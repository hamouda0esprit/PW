
const chf_affCanvas = document.getElementById("chf_affCanvas");

const cdate = document.querySelectorAll(".cdate");
const collected = document.querySelectorAll(".collected");
const given = document.querySelectorAll(".given");
const diff = document.querySelectorAll(".diff");

var xcdateValues = [];
for(let i = 0;i<cdate.length;i++){
  xcdateValues.push(cdate[i].innerHTML);  
}
var collectedValues = [];
for(let i = 0;i<collected.length;i++){
    collectedValues.push(collected[i].innerHTML);  
}
var givenValues = [];
for(let i = 0;i<given.length;i++){
    givenValues.push(given[i].innerHTML);  
}
var diffValues = [];
for(let i = 0;i<diff.length;i++){
    diffValues.push(diff[i].innerHTML);  
}


new Chart(chf_affCanvas,{
    type: "line",
    data: {
      labels: xcdateValues,
      datasets: [{ 
        data: collectedValues,
        borderColor: "green",
        fill: false,
        label:"collected"
      },{ 
        data: givenValues,
        borderColor: "red",
        fill: false,
        label:"given"
      }, { 
        data: diffValues,
        borderColor: "blue",
        fill: false,
        label:"benefice"
      }]
    },
    options: {
      legend: {display: false}
    }
  })