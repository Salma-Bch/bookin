<div class="col-md-3 barre_de_filtre">
    <div class="col-md-12">
        <h2>Catégories :</h2>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="actualite" id="actualite"/>
            <label class="form-check-label" for="actualite">Actualité</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="amour" id="amour"/>
            <label class="form-check-label" for="amour">Amour</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="art" id="art"/>
            <label class="form-check-label" for="art">Art</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="bd" id="bd"/>
            <label class="form-check-label" for="bd">Bande dessinée</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="bien_etre" id="bien_etre"/>
            <label class="form-check-label" for="bien_etre">Bien-être</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="cuisine" id="cuisine"/>
            <label class="form-check-label" for="cuisine">Cuisine</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="culture" id="culture"/>
            <label class="form-check-label" for="culture">Culture</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="education" id="education"/>
            <label class="form-check-label" for="education">Éducation</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="histoire" id="histoire"/>
            <label class="form-check-label" for="histoire">Histoire</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="loisir" id="loisir"/>
            <label class="form-check-label" for="loisir">Loisir</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="policier" id="policier"/>
            <label class="form-check-label" for="policier">Policier</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="psychologie" id="psychologie"/>
            <label class="form-check-label" for="psychologie">Psychologie</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="sante" id="sante"/>
            <label class="form-check-label" for="sante">Santé</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="science" id="science"/>
            <label class="form-check-label" for="science">Science</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="science_fiction" id="science_fiction"/>
            <label class="form-check-label" for="science_fiction">Science-fiction</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="vie_pratique" id="vie_pratique"/>
            <label class="form-check-label" for="vie_pratique">Vie pratique</label>
        </div>
    </div>
    <div class="col-md-12">
        <h2>Tranche d'âge :</h2>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="vie_pratique" id="dix"/>
            <label class="form-check-label" for="dix">-10 ans</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="vie_pratique" id="dix_huit"/>
            <label class="form-check-label" for="dix_huit">-18 ans</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="vie_pratique" id="vingt_cinq"/>
            <label class="form-check-label" for="vingt_cinq">-25 ans</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="vie_pratique" id="soixante_cinq"/>
            <label class="form-check-label" for="soixante_cinq">-65 ans</label>
        </div>
    </div>
    <div class="col-md-12">
        <h2>Prix :</h2>
        <p class="affichage_prix_inferieur">Inférieur à <output class="affichage_prix_inferieur" id="prix">0</output>€</p>
        <input class="range_prix" type="range" value="0" max="30" step="1" oninput="prix.value = this.value">
    </div>
</div>