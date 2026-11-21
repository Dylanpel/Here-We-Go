



//--------------------API Autocompletion-----------------------//

//--------------------code postal-----------------------//

const elcodepostal = document.getElementById("monInput");
const elresult = document.getElementById("result");
const elVilleInput = document.getElementById("villeInput");
const elDepartement = document.getElementById("departementInput");
const elId_ville = document.getElementById("id_ville");

elcodepostal.addEventListener("input", function () {
    const valInput = this.value;
    if (valInput.length === 0) {
        elresult.innerHTML = "";
        return;
    };

let xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET", `./models/autocompletion.php?codepostal=${valInput}`, true);

xmlhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      let myArr = JSON.parse(this.responseText);
      afficherVilles(myArr);
    }
    };

    xmlhttp.send();
});

function afficherVilles(arr) {
    elresult.innerHTML = "";
    
    arr.forEach(element => {
        let div = document.createElement("div");
        div.innerHTML = `<li class="list-group-item">${element.nom_ville} ${element.code_postal}</li>`

        div.addEventListener("click", function () {
            elcodepostal.value = element.code_postal;
            elVilleInput.value = element.nom_ville; 
            elDepartement.value = element.departement;
            elId_ville.value = element.id_ville;
            elresult.innerHTML = "";
        });

        elresult.appendChild(div);
    });
}

//--------------------ville-----------------------//  

elVilleInput.addEventListener("input", function () {
    const valInput = this.value;
    if (valInput.length === 0) {
    elresult.innerHTML = "";
    return;
  };
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET",`./models/autocompletion.php?ville=${valInput}`, true);
        
        xmlhttp.onreadystatechange = function () {
            
            if (this.readyState === 4 && this.status === 200) {
                let myArr = JSON.parse(this.responseText);
                afficherCodePostal(myArr);
            }
        };
        xmlhttp.send();
});

function afficherCodePostal(arr) {
  elresult.innerHTML = "";
    arr.forEach(element => {
        let div = document.createElement("div");
        div.innerHTML = `<li>${element.nom_ville} ${element.code_postal}</li>`;
        
        div.addEventListener("click", function () {
            elcodepostal.value = element.code_postal;
            elVilleInput.value = element.nom_ville; 
            elDepartement.value = element.departement;
            elId_ville.value = element.id_ville;
            elresult.innerHTML = "";
        });

    elresult.appendChild(div);
  });
}
//--------------------------------------//

// ----------- OEIL MOT DE PASSE --------- //

function togglePw(id, btn) {
    const input = document.getElementById(id);

    const icon = btn.querySelector('i');

    if (input.type === "password") {
        input.type="text";
        icon.className= "bi bi-eye-slash";
    } else {
        input.type="password";
        icon.className="bi bi-eye";
    }
}

// --------------------------------- //


// ------------ VALIDATION CGU ------------ //

let elmessage = document.getElementById("message");

function verification() {

    let elverif_prenom=document.getElementById("prenom").value;
    let elverif_nom=document.getElementById("nom").value;
    let elverif_date=document.getElementById("date").value;
    let elverif_email=document.getElementById("mail").value;
    let elverif_mdp=document.getElementById("mdp").value;
    let elverif_mdp2=document.getElementById("mdp2").value;
    let elverif_cp=document.getElementById("monInput").value;
    let elverif_ville=document.getElementById("villeInput").value;
    let elverif_departement=document.getElementById("departementInput").value;
    let elverif_cgu=document.getElementById("cgu").checked;
    let error = false;
    elmessage.textContent = "";

    if(elverif_prenom==""){
        elmessage.textContent="Veuillez renseignez le champ";
        error=true
    }

    if(elverif_nom==""){
        elmessage.textContent="Veuillez renseignez le champ";
        error=true
    }
    if(elverif_date==""){
        elmessage.textContent="Veuillez renseignez le champ";
        error=true
    }
    if(elverif_email==""){
        elmessage.textContent="Veuillez renseignez le champ";
        error=true
    }
    if(elverif_mdp==""){
        elmessage.textContent="Veuillez renseignez le champ";
        error=true
    }
    if(elverif_mdp2==""){
        elmessage.textContent="Veuillez renseignez le champ";
        error=true
    }
    if(elverif_cp==""){
        elmessage.textContent="Veuillez renseignez le champ";
        error=true
    }
    if(elverif_ville==""){
        elmessage.textContent="Veuillez renseignez le champ";
        error=true
    }
    if(elverif_departement==""){
        elmessage.textContent="Veuillez renseignez le champ";
        error=true
    }

    if(!elverif_cgu){
        elmessage.textContent="Veuillez acceptez les CGU";
        error=true
    }
    if(error) {
        return false;
    }
}
