<div class="col-md-3 barre_de_filtre">
    <div class="col-md-12">
        <h2 class="searchTitle">Catégories :</h2>
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
        <h2 class="searchTitle">Tranche d'âge :</h2>
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
    <?php

        $bookDao = \dao\DAOFactory::getInstance()->getBookDao();
        $maxPrice = $bookDao->getMaxPrice();
    ?>
    <div class="col-md-12">
        <h2 class="searchTitle">Tranche de prix :</h2>
        <p class="affichage_prix_inferieur" style="width: 40%"><output class="affichage_prix_inferieur" id="prixInf">0</output>€</p>
        <p class="affichage_prix_inferieur" style="width: 40%; text-align: right"><output class="affichage_prix_inferieur" id="prixSup"><?php echo $maxPrice; ?></output>€</p>
        <div class="middle">
            <div class="multi-range-slider">
                <input type="range" id="input-left" min="0" max="<?php echo $maxPrice; ?>" value="0" oninput="prixInf.value = this.value"/>
                <input type="range" id="input-right" min="0" max="<?php echo $maxPrice; ?>" value="<?php echo $maxPrice; ?>" oninput="prixSup.value = this.value"/>

                <div class="slider">
                    <div class="track"></div>
                    <div class="range"></div>
                    <div class="thumb left"></div>
                    <div class="thumb right"></div>
                </div>
            </div>
        </div>
        <button class="btn valider" onclick="filtreBooks(categories, agesRange,this)" >Valider</button>
    </div>
</div>

<script><!--
    var categories = [];
    var agesRange = [];
    var prices = [];

    var inputLeft = document.getElementById("input-left");
    var inputRight = document.getElementById("input-right");

    var thumbLeft = document.querySelector(".slider > .thumb.left");
    var thumbRight = document.querySelector(".slider > .thumb.right");
    var range = document.querySelector(".slider > .range");

    function setLeftValue() {
        var _this = inputLeft,
            min = parseInt(_this.min),
            max = parseInt(_this.max);

        _this.value = Math.min(parseInt(_this.value), parseInt(inputRight.value) - 1);

        var percent = ((_this.value - min) / (max - min)) * 100;

        thumbLeft.style.left = percent + "%";
        range.style.left = percent + "%";
    }
    setLeftValue();

    function setRightValue() {
        var _this = inputRight,
            min = parseInt(_this.min),
            max = parseInt(_this.max);

        _this.value = Math.max(parseInt(_this.value), parseInt(inputLeft.value) + 1);

        var percent = ((_this.value - min) / (max - min)) * 100;

        thumbRight.style.right = (100 - percent) + "%";
        range.style.right = (100 - percent) + "%";
    }
    setRightValue();

    inputLeft.addEventListener("input", setLeftValue);
    inputRight.addEventListener("input", setRightValue);

    inputLeft.addEventListener("mouseover", function() {
        thumbLeft.classList.add("hover");
    });
    inputLeft.addEventListener("mouseout", function() {
        thumbLeft.classList.remove("hover");
    });
    inputLeft.addEventListener("mousedown", function() {
        thumbLeft.classList.add("active");
    });
    inputLeft.addEventListener("mouseup", function() {
        thumbLeft.classList.remove("active");
    });

    inputRight.addEventListener("mouseover", function() {
        thumbRight.classList.add("hover");
    });
    inputRight.addEventListener("mouseout", function() {
        thumbRight.classList.remove("hover");
    });
    inputRight.addEventListener("mousedown", function() {
        thumbRight.classList.add("active");
    });
    inputRight.addEventListener("mouseup", function() {
        thumbRight.classList.remove("active");
    });

    function filtreBooks(categories, agesRange, input){
        if(prices.length > 0){
            prices = [];
        }
        prices.push(document.getElementById("prixInf").value);
        prices.push(document.getElementById("prixSup").value);
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
            data: {categories : categories, agesRange : agesRange, prices : prices },
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
        bookDiv.setAttribute('onclick','location.href="./shoppingSpace.php?bookId='+id+'&source=searchSpace"')

        var title = document.createElement('p');
        title.innerText = book[1];
        title.setAttribute('class','displayTitleAndCategory');

        var author = document.createElement('p');
        author.innerText = book[2];
        author.setAttribute('class','displayAuthorAndPrice');

        var image = document.createElement('img');
        image.setAttribute('src', book[6]);
        image.setAttribute('alt','Livre');
        image.setAttribute('class','displayImage');

        var price = document.createElement('p');
        price.innerText = book[5];
        price.setAttribute('class','displayAuthorAndPrice');
        price.appendChild(document.createTextNode("€"));

        var category = document.createElement('p');
        category.innerText = book[8];
        category.setAttribute('class','displayTitleAndCategory');

        bookDiv.appendChild(title);
        bookDiv.appendChild(author);
        bookDiv.appendChild(image);
        bookDiv.appendChild(price);
        bookDiv.appendChild(category);
        displaySpaceDiv.appendChild(bookDiv);
    }

//--></script>