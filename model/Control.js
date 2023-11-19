// JavaScript Document

 function validateForm() {
		//alert("test");
        var type = document.getElementById("type").value;
        var commande = document.getElementById("commande").value;
        var description = document.getElementById("description").value;
	 
        if (type === "0" || (commande === "0" && type != "Technical") || description.trim() === "") {
            alert("Please fill out all fields before submitting.");
            return false;
        }

        return true;
 }


function HideClass() {
	var type = document.getElementById("type").value;
	var commande = document.getElementById("commande");
	
	if(type == "0" || type =="Technical"){
			document.querySelectorAll(".commande")[0].classList.add("hidden");
			commande.selectedIndex = 0;
		
			var event = new Event('change');
            commande.dispatchEvent(event);
		}else{
			document.querySelectorAll(".commande")[0].classList.remove("hidden");
	}
}