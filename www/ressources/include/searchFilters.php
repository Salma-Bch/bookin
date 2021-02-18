<div class="col-md-3 barre_de_filtre">
    <div class="col-md-12">
        <h2>Catégories :</h2>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="actualite" id="actualite" onclick="filtreVehicule(categories, agesRange, this)"/>
            <label class="form-check-label" for="actualite">Actualité</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="amour" id="amour" onclick="filtreVehicule(categories, agesRange, this)"/>
            <label class="form-check-label" for="amour">Amour</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="art" id="art" onclick="filtreVehicule(categories, agesRange, this)"/>
            <label class="form-check-label" for="art">Art</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="bd" id="bd" onclick="filtreVehicule(categories, agesRange, this)"/>
            <label class="form-check-label" for="bd">Bande dessinée</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="bien_etre" id="bien_etre" onclick="filtreVehicule(categories, agesRange, this)"/>
            <label class="form-check-label" for="bien_etre">Bien-être</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="cuisine" id="cuisine" onclick="filtreVehicule(categories, agesRange, this)"/>
            <label class="form-check-label" for="cuisine">Cuisine</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="culture" id="culture" onclick="filtreVehicule(categories, agesRange, this)"/>
            <label class="form-check-label" for="culture">Culture</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="education" id="education" onclick="filtreVehicule(categories, agesRange, this)"/>
            <label class="form-check-label" for="education">Éducation</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="histoire" id="histoire" onclick="filtreVehicule(categories, agesRange, this)"/>
            <label class="form-check-label" for="histoire">Histoire</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="loisir" id="loisir" onclick="filtreVehicule(categories, agesRange, this)"/>
            <label class="form-check-label" for="loisir">Loisir</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="policier" id="policier" onclick="filtreVehicule(categories, agesRange, this)"/>
            <label class="form-check-label" for="policier">Policier</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="psychologie" id="psychologie" onclick="filtreVehicule(categories, agesRange, this)"/>
            <label class="form-check-label" for="psychologie">Psychologie</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="sante" id="sante" onclick="filtreVehicule(categories, agesRange, this)"/>
            <label class="form-check-label" for="sante">Santé</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="science" id="science" onclick="filtreVehicule(categories, agesRange, this)"/>
            <label class="form-check-label" for="science">Science</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="science_fiction" id="science_fiction" onclick="filtreVehicule(categories, agesRange, this)"/>
            <label class="form-check-label" for="science_fiction">Science-fiction</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="vie_pratique" id="vie_pratique" onclick="filtreVehicule(categories, agesRange, this)"/>
            <label class="form-check-label" for="vie_pratique">Vie pratique</label>
        </div>
    </div>
    <div class="col-md-12">
        <h2>Tranche d'âge :</h2>
        <div class="form-check">
            <input class="form-check-input ageRange" type="checkbox" value="vie_pratique" id="dix"/>
            <label class="form-check-label" for="dix">-10 ans</label>
        </div>
        <div class="form-check">
            <input class="form-check-input ageRange" type="checkbox" value="vie_pratique" id="dix_huit"/>
            <label class="form-check-label" for="dix_huit">-18 ans</label>
        </div>
        <div class="form-check">
            <input class="form-check-input ageRange" type="checkbox" value="vie_pratique" id="vingt_cinq"/>
            <label class="form-check-label" for="vingt_cinq">-25 ans</label>
        </div>
        <div class="form-check">
            <input class="form-check-input ageRange" type="checkbox" value="vie_pratique" id="soixante_cinq"/>
            <label class="form-check-label" for="soixante_cinq">-65 ans</label>
        </div>
    </div>
    <div class="col-md-12">
        <h2>Prix :</h2>
        <p class="affichage_prix_inferieur">Inférieur à <output class="affichage_prix_inferieur" id="prix">0</output>€</p>
        <input class="range_prix" type="range" value="0" max="30" step="1" oninput="prix.value = this.value">
    </div>
</div>

<script>
    var categories = [];
    var agesRange = [];

    function filtreVehicule(categories, agesRange, input){
            categories.push(input.value);
        $.ajax({
            type: 'post',
            url: './ressources/include/bookFiltering.php',
            data: {categories : categories, agesRange : agesRange},
            success: function (response) {
                if (response !== "filtre:no") {

                    vehicules = JSON.parse(response);
                    alert(vehicules[0]);
                    //displayVehicules(JSON.parse(response));
                }
            },
            error: function () {

            }
        });
        return false;
    }

    function displayVehicules(vehicules){
        var div = document.getElementById("bookSearched")
        if( div != null){
            while (div.firstChild){
                div.removeChild(div.firstChild);
            }
        }
        for (i = 0; i < vehicules.length; i++) {
            addVehiculeToDiv(vehicules[i],i);
        }
    }

    function addVehiculeToDiv(vehicule, id){
        var div = document.getElementById("bookSearched");
        var vehiculeDiv = document.createElement('div');
        vehiculeDiv.setAttribute('class', "col-md-4 livres" );
       // vehiculeDiv.setAttribute('id', id);
      //  vehiculeDiv.setAttribute('onclick', "showVehiculeDetails(this)");

        var text = document.createElement('p');
        text.innerText = vehicule['title'];
        text.setAttribute('class',"text-center");
        text.setAttribute('style',"font-size: max(1vw, 16px); vmin:1");

        var text2 = document.createElement('p');
        text2.innerText = vehicule['price'];
        text2.setAttribute('class',"text-center");
        text2.setAttribute('style',"font-size: max(1vw, 16px);border-top: 1px solid #afafaf; margin-right: 25%; margin-left: 25%;");

        var img = document.createElement('img');
        img.setAttribute('src', vehicule['image_path']);
        img.setAttribute('style','width: 140px;height: 190px;');
        img.setAttribute('alt','Livre');
        vehiculeDiv.appendChild(text);
        vehiculeDiv.appendChild(img);
        vehiculeDiv.appendChild(text2);
        div.appendChild(vehiculeDiv);
    }

</script>