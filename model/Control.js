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

function insertDatetime() {
    // Get the current date and time from the user's computer
    var currentDatetime = new Date();
    var year = currentDatetime.getFullYear();
    var month = (currentDatetime.getMonth() + 1).toString().padStart(2, '0');
    var day = currentDatetime.getDate().toString().padStart(2, '0');
    var hours = currentDatetime.getHours().toString().padStart(2, '0');
    var minutes = currentDatetime.getMinutes().toString().padStart(2, '0');
	var seconds = currentDatetime.getSeconds().toString().padStart(2, '0');
    
    var formattedDatetime = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ":" + seconds;
//2023-11-20 13:27:50.000000
    // Set the formatted datetime in the input field
    document.getElementById("input_datetime").value = formattedDatetime;

    // Optionally, you can submit the form to a PHP script for database insertion
    // document.getElementById("datetimeForm").submit();
}