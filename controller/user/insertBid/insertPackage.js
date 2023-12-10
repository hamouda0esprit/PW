function conrtol(){
    var depart = document.getElementById("depart");
    var arrivee = document.getElementById("arrivee");
    var pictures = document.getElementById("pictures");
    var height = document.getElementById("height");
    var width = document.getElementById("width");
    var depth = document.getElementById("depth");
    var Weight = document.getElementById("Weight");
    var budget = document.getElementById("budget");
    var verified = true;

    if(depart.value.length <3){
        verified = false;
        depart.style.borderColor = "red";
    }else{
        depart.style.borderColor = "green";
    }
    if(arrivee.value.length <3){
        verified = false
        arrivee.style.borderColor = "red";
    }else{
        arrivee.style.borderColor = "green";
    }
    if(pictures.value.length ==0){
        verified = false
        pictures.style.color = "red";
    }else{
        pictures.style.color = "green";
    }
    if(height.value.length ==0 || isNaN(height.value)){
        verified = false
        height.style.borderColor = "red";
    }else{
        height.style.borderColor = "green";
    }
    if(width.value.length ==0 || isNaN(width.value)){
        verified = false
        width.style.borderColor = "red";
    }else{
        width.style.borderColor = "green";
    }
    if(depth.value.length ==0 || isNaN(depth.value)){
        verified = false
        depth.style.borderColor = "red";
    }else{
        depth.style.borderColor = "green";
    }
    if(Weight.value.length ==0 || isNaN(Weight.value)){
        verified = false
        Weight.style.borderColor = "red";
    }else{
        Weight.style.borderColor = "green";
    }
    if(budget.value.length ==0 || isNaN(budget.value)){
        verified = false
        budget.style.borderColor = "red";
    }else{
        budget.style.borderColor = "green";
    }
    return verified;
}