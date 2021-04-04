<div class="col-md-3 barre_de_filtre">
    <div class="col-md-12">
        <h2>Catégories :</h2>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="actualite" id="actualite" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="actualite">Actualité</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="amour" id="amour" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="amour">Amour</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="art" id="art" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="art">Art</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="Bande dessinée" id="bd" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="bd">Bande dessinée</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="Bien-être" id="bien_etre" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="bien_etre">Bien-être</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="cuisine" id="cuisine" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="cuisine">Cuisine</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="culture" id="culture" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="culture">Culture</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="education" id="education" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="education">Éducation</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="histoire" id="histoire" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="histoire">Histoire</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="loisir" id="loisir" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="loisir">Loisir</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="policier" id="policier" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="policier">Policier</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="psychologie" id="psychologie" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="psychologie">Psychologie</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="sante" id="sante" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="sante">Santé</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="science" id="science" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="science">Science</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="Science-fiction" id="science_fiction" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="science_fiction">Science-fiction</label>
        </div>
        <div class="form-check">
            <input class="form-check-input category" type="checkbox" value="Vie pratique" id="vie_pratique" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="vie_pratique">Vie pratique</label>
        </div>
    </div>
    <div class="col-md-12">
        <h2>Tranche d'âge :</h2>
        <div class="form-check">
            <input class="form-check-input ageRange" type="checkbox" value="Enfants" id="dix" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="dix">Enfants : 0 à 14 ans</label>
        </div>
        <div class="form-check">
            <input class="form-check-input ageRange" type="checkbox" value="Adolescents" id="dix_huit" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="dix_huit">Adolescents : 15 à 24 ans</label>
        </div>
        <div class="form-check">
            <input class="form-check-input ageRange" type="checkbox" value="Adultes" id="vingt_cinq" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="vingt_cinq">Adultes : 25 à 64 ans</label>
        </div>
        <div class="form-check">
            <input class="form-check-input ageRange" type="checkbox" value="Ainés" id="soixante_cinq" onclick="filtreBooks(categories, agesRange, this)"/>
            <label class="form-check-label" for="soixante_cinq">Ainés : 65 ans et plus</label>
        </div>
    </div>
    <div class="col-md-12">
        <h2>Prix :</h2>
        <p class="affichage_prix_inferieur">Inférieur à <output class="affichage_prix_inferieur" id="prix">0</output>€</p>
        <input class="range_prix" type="range" value="0" max="30" step="1" oninput="prix.value = this.value"/>
    </div>
</div>

<script><!--
    var categories = [];
    var agesRange = [];

    function filtreBooks(categories, agesRange, input){
        if (input.checked){
            //alert(input.className);
            if(input.className.includes("category"))
                categories.push(input.value);
            if(input.className.includes("ageRange"))
                agesRange.push(input.value);
        }
        else{
            var index;
            if(input.className.includes("category")) {
                index = categories.indexOf(input.value);
                if (index > -1) {
                    categories.splice(index, 1);
                }
            }
            if(input.className.includes("ageRange")){
                index = agesRange.indexOf(input.value);
                if (index > -1) {
                    agesRange.splice(index, 1);
                }
            }
        }

        $.ajax({
            type: 'post',
            url: './include/bookFiltering.php',
            data: {categories : categories, agesRange : agesRange},
            success: function (response) {
                if (response !== "filtre:no") {
                    books = JSON.parse(response);
                    displayBooks(JSON.parse(response));
                }
            },
            error: function () {

            }
        });
        return false;
    }


    function displayBooks(books){
        var div = document.getElementById("bookSearched")
        if( div != null){
            while (div.firstChild){
                div.removeChild(div.firstChild);
            }
        }
        for (var i = 0; i < books.length; i++) {
            addBookToDiv(books[i],i);
        }
    }

    function addBookToDiv(book, id){
        var displaySpaceDiv = document.getElementById("bookSearched");
        var bookDiv = document.createElement('div');
        bookDiv.setAttribute('class', "col-md-4 livres" );
       // vehiculeDiv.setAttribute('id', id);
      //  vehiculeDiv.setAttribute('onclick', "showVehiculeDetails(this)");

        var title = document.createElement('p');
        title.innerText = book[1];
        //title.setAttribute('class',"text-center");
       // title.setAttribute('style',"font-size: max(1vw, 16px); vmin:1");

        var textContent = document.createElement('p');
        textContent.innerText = book[5];
        //textContent.setAttribute('class',"text-center");
        //textContent.setAttribute('style',"font-size: max(1vw, 16px);border-top: 1px solid #afafaf; margin-right: 25%; margin-left: 25%;");

        var bookImage = document.createElement('img');
        bookImage.setAttribute('src', book[6]);
        bookImage.setAttribute('style','width: 140px;height: 190px;');
        bookImage.setAttribute('alt','Livre');

        bookDiv.appendChild(title);
        bookDiv.appendChild(bookImage);
        bookDiv.appendChild(textContent);
        displaySpaceDiv.appendChild(bookDiv);
    }

//--></script>