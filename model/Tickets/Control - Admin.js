// script.js

// Function to save selection in localStorage
function saveSelection(elementId) {
    var selectedValue = document.getElementById(elementId).value;
    localStorage.setItem(elementId, selectedValue);
}

// Function to update selectedType from localStorage
function updateSelectedType() {
    var typeElement = document.getElementById('type');
    var savedType = localStorage.getItem('type');
    if (savedType) {
        typeElement.value = savedType;
    }
}

// Function to update selectedUser from localStorage
function updateSelectedUser() {
    var userElement = document.getElementById('User');
    var savedUser = localStorage.getItem('User');
    if (savedUser) {
        userElement.value = savedUser;
    }
}

// Function to update selectedCommande from localStorage
function updateSelectedCommande() {
    var commandeElement = document.getElementById('commande');
    var savedCommande = localStorage.getItem('Commande');
    if (savedCommande) {
        commandeElement.value = savedCommande;
    }
}

// Call the updateSelectedType, updateSelectedUser, and updateSelectedCommande functions on page load
window.onload = function () {
    updateSelectedType();
    updateSelectedUser();
    updateSelectedCommande();
};

document.addEventListener('DOMContentLoaded', function() {
    // Get references to the select and input elements
    var selectElement = document.getElementById('commande');
    var inputElement = document.getElementById('idDelivery');

    // Add an event listener to the select element
    selectElement.addEventListener('change', function() {
        // Copy the selected value to the input element
        inputElement.value = selectElement.value;
    });
});
