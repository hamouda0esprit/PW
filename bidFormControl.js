function control(id){
    var montant = document.querySelectorAll("#bid");
    var dateDepart = document.querySelectorAll("#dateDepart");
    var dateArrive = document.querySelectorAll("#dateArrive");
    if( isNaN(montant[id].value) || montant[id].value.length < 1){
        montant[id].classList.remove("normal");
        montant[id].classList.remove("correct");
        montant[id].classList.remove("error");
        montant[id].classList.add("error");
        return false;
    }else{
        montant[id].classList.remove("error");
        montant[id].classList.add("correct");
    }
    if( dateDepart[id].value > dateArrive[id].value || dateDepart[id].value.length == 0 || dateArrive[id].value.length == 0){
        dateDepart[id].classList.remove("normal");
        dateDepart[id].classList.remove("correct");
        dateDepart[id].classList.remove("error");
        dateDepart[id].classList.add("error");

        dateArrive[id].classList.remove("normal");
        dateArrive[id].classList.remove("correct");
        dateArrive[id].classList.remove("error");
        dateArrive[id].classList.add("error");
        return false;
    }else{
        dateDepart[id].classList.remove("error");
        dateDepart[id].classList.add("correct");
        
        dateArrive[id].classList.remove("error");
        dateArrive[id].classList.add("correct");
    }
}