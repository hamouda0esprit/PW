// JavaScript Document

 function validateForm() {
		alert("test");
        var type = document.getElementById("type").value;
        var commande = document.getElementById("Commande").value;
        var description = document.getElementById("description").value;

        if (type === "0" || commande === "0" || description.trim() === "") {
            alert("Please fill out all fields before submitting.");
            return false;
        }

        // You can add more complex validation logic if needed

        return true;
    }