/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
var app = {
    // Application Constructor
    initialize: function () {
        this.bindEvents();
    },
    // Bind Event Listeners
    //
    // Bind any events that are required on startup. Common events are:
    // 'load', 'deviceready', 'offline', and 'online'.
    bindEvents: function () {
        document.addEventListener('deviceready', this.onDeviceReady, false);
    },
    // deviceready Event Handler
    //
    // The scope of 'this' is the event. In order to call the 'receivedEvent'
    // function, we must explicitly call 'app.receivedEvent(...);'
    onDeviceReady: function () {
        app.receivedEvent('deviceready');
    },
    // Update DOM on a Received Event
    receivedEvent: function (id) {
        var parentElement = document.getElementById(id);
        var listeningElement = parentElement.querySelector('.listening');
        var receivedElement = parentElement.querySelector('.received');

        listeningElement.setAttribute('style', 'display:none;');
        receivedElement.setAttribute('style', 'display:block;');

        console.log('Received Event: ' + id);
    }
};
/*Fonction de scan des codes barres */
function scanBarcode() {

    cordova.plugins.barcodeScanner.scan(
        function (result) {

            /*Si le resultat égal à 13 alors le code barre est correct */
            if(result.text.length==13)
            {
            /*Nous mettons le flagScan à True */
            localStorage.setItem("flagScan", "True");
             /*Nous récuperons  le code barre */
            localStorage.setItem("code", result.text);
            }
            else 
            /*Sinon si le code barre > 0 donc nous avons une erreur de scan */
             if (result.text.length > 0)
             {
                 localStorage.setItem("flagScan", "False");
                 alert("le code barre "+result.text+" ne correspend pas au normes des codes barres, veuillez scanner le code de nouveau");
             }
               /* le cas code barre égal à 0 c'est le cas où on fait un retrour arriére avec la fleche sur le téléphone  */
             /* Dans tous les cans nous alons actualiser la page avec la mis à jours de notre Flag */
            location.reload();
        },

        function (error) {
            alert("Scanning failed: " + error);
        }
    );
}
/*La fonction de deconnexion supprime les variables globales  */
function deconnexion() {
    localStorage.removeItem("nom");
    localStorage.removeItem("code");
    localStorage.removeItem("temps");
    localStorage.removeItem("flagScan");
    localStorage.removeItem("morceaux");
    window.location.replace("index.html");

}



/*Fonction de scan à nouveau des codes barres */

function reScanBarcode() {

    cordova.plugins.barcodeScanner.scan(
        function (result) {

 /*Si le resultat égal à 13 alors le code barre est correct */
            if(result.text.length==13)
            {
            localStorage.setItem("code", result.text);
            getSucre();
            }
            else
           /*Sinon si le code barre > 0 donc nous avons une erreur de scan */
           {
              if (result.text.length > 0)
                {
                alert("le code barre "+result.text+" ne correspend pas au normes des codes barres, veuillez scanner le code de nouveau");
                
                }
             /* le cas code barre égal à 0 c'est le cas où on fait un retrour arriére avec la fleche sur le téléphone  */
                 location.reload();
            }   

        },

        function (error) {
            alert("Scanning failed: " + error);
        }
    );
}

/*Fonction qui récupère le sucre à partir de serveur */
function getSucre() {
    $.ajax({
       /*Initialisation de la requete ajax */
        type: "GET",
        url: 'http://172.31.7.30/api/code_barre.php',
        data: "code=" + localStorage.getItem("code"), 
        success: function (data) {
            /*On est sensé de récupérer un objet JSON */
            try  {
                /*Parse de l'objet  */
                var obj = JSON.parse(data);
                /*La variable globale Morceau reçoit les morceaux  */
                localStorage.setItem("morceaux", Math.round(parseFloat(obj.morceaux)));;
            /*Ancienne version on récupère l'url de l'image de openfoodfact  */
                var image = obj.url;
                /*redéraction */
                window.location.replace("scan2.html");
            } catch(e)
            {
                alert("Le produit n'existe pas dans la base!");
            }
        }

    });

}