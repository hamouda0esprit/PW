

function hideBid(x) {
    if(document.getElementsByClassName("bidForm")[x].classList.contains("hide") == true){
        document.getElementsByClassName("bidForm")[x].classList.remove("hide");
        console.log("removed");
    }else{
        document.getElementsByClassName("bidForm")[x].classList.add("hide");
        console.log("added");
    }
}