/* ------------------------------------------------------- */
/* Frogi-secure   Baron Corentin   2016                    */
/* Site : Frogi-secure distributeur                        */
/*                                                         */ 
/* Description du fichier : Fichier de fonction js         */
/*                                                         */
/* @Ce fichier contient les fonctions js utilisées par les */
/* page du site web.                                       */
/* ------------------------------------------------------- */


/**
 * Surligne les champs de recherches mal remplies
 * @param champ Le champ à vérifier
 * @param erreur yes/no indique si il y a une erreur
 */
function surligne(champ, erreur)    {
   if (erreur)
      champ.style.backgroundColor = "#fba";
   else
      champ.style.backgroundColor = "";
}

/**
 * Vérifie si le champ de recherche est bien rempli
 * @param champ Le champ à vérifier
 * @return false/true Indication si le champ est mal rempli
 */
function verif(champ)   {
 if (champ.value != "") {
   if(champ.value.length < 2 || champ.value.length > 25)    {//On a choisi comme limite de caractère 2<champ<25
      surligne(champ, true);//Si le champs est mal rempli on surligne
      return false;
   }
   else {
      surligne(champ, false);//Sinon on valide
      return true;
   }
 }else {surligne(champ, false); return true;}
}

/**
 * Vérifie si au moin un champ de recherche est rempli
 * @param f box de recherche qui contient tout les champs
 * @return false/true Indication si au moin un champ est rempli
 */
function verifAll(f)    {
 if (f.nom.value != "" || f.email.value!="" || f.temps.value!="" || f.vip.value!="" || f.start_date.value!="")
      return false;
    else return true;
}

/**
 * Fonction global qui appel les fonciton verifAll et verif pour vérifier si le formulaire de recherche est bien rempli
 * @param f box de recherche qui contient tout les champs
 * @return false/true Indication si le formulaire est bien rempli
 */
function verifForm(f)   {
   var nomOk = verif(f.nom);
   var emailOk = verif(f.email);
   var tempsOk = verif(f.temps);
   var dateOk = verif(f.start_date);
   if (verifAll(f)) {
      alert("Veuillez remplir au moins un champ");
      return false;
    }
   if (nomOk && serialOk && etabOk && dateOk)
      return true;
   else {
      alert("Veuillez remplir correctement les champs indiqués");
      return false;
   }
}

/**
 * Efface les champs déjà remplis du formulaire de recherche 
 */
function effacer() {
    document.getElementById('indexnom').value="";
    document.getElementById('indexemail').value="";
    document.getElementById('indexdate').value="";
    document.getElementById('indextemps').value="";
    document.getElementById('indexvip').value="";
    //document.getElementById('itemps').value="";
}

/**
 * change l'onglet affiché dans section_r2 (affiche le profil choisi par l'utilisateur)
 * @param name nom du profil que l'on veut afficher
 */
function change_onglet(name) {
    //on met l'ancien profil en display none et celui que l'on veut afficher en dislay block
    document.getElementById('onglet_'+anc_onglet).className = 'onglet_0 onglet';
    document.getElementById('onglet_'+name).className = 'onglet_1 onglet';
    document.getElementById('contenu_onglet_'+anc_onglet).style.display = 'none';
    document.getElementById('contenu_onglet_'+name).style.display = 'block';
    anc_onglet = name;
}

