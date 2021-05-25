// partie filtre

filterSelection("0") // Execute la fonction et montre les colonnes
function filterSelection(c) {
    var element, i;
    element = document.getElementsByClassName("filterDiv");
    // Ajoute la classe "Show" (d-block) sur les éléments sélectionnés, et l'enlève sur les éléments non séléctionnés
    for (i = 0; i < element.length; i++) {
        
        RemoveClass(element[i], "d-block");
        if (c=="0"){
            RemoveClass(element[i], "d-none");
            AddClass(element[i], "d-block");
        } else {
            if (element[i].classList.contains(c)) AddClass(element[i], "d-block");

            else AddClass(element[i], "d-none");
        }
        
    }
}

// Montre les éléments filtrés
function AddClass(element, name) {
    if(!element.classList.contains(name)){
        element.classList.add(name);
    }
}

// cache les éléments non sélectionnés
function RemoveClass(element, name) {
    if(element.classList.contains(name)){
        element.classList.remove(name);
    }
}

// Ajoute la classe "active" sur le bouton selectionné
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function () {
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
    });
}
