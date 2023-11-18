// JavaScript Document

 function validateForm() {
		//alert("test");
        var type = document.getElementById("type").value;
        var commande = document.getElementById("commande").value;
        var description = document.getElementById("description").value;
	 
        if (type === "0" || commande === "0" || description.trim() === "") {
            alert("Please fill out all fields before submitting.");
            return false;
        }

        return true;
 }


window.onload = function () {
	var type = document.getElementById("type").value;
	
	if(type != "0" && type !="Technical"){
			document.getElementsByClassName("commande").classList.add("hidden");
		}else{
			document.getElementsByClassName("commande").classList.remove("hidden");
	}
}