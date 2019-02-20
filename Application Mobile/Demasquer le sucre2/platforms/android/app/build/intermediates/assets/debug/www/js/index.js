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

function scanBarcode() {

    cordova.plugins.barcodeScanner.scan(
        function (result) {
            /*   alert("We got a barcode\n" +
                     "Result: " + result.text + "\n" +
                     "Format: " + result.format + "\n" +
                     "Cancelled: " + result.cancelled);*/


            localStorage.setItem("flagScan", "True");
            localStorage.setItem("code", result.text);


            location.reload();


        },

        function (error) {
            alert("Scanning failed: " + error);
        }
    );
}

function deconnexion() {
    localStorage.removeItem("nom");
    localStorage.removeItem("code");
    localStorage.removeItem("temps");
    localStorage.removeItem("flagScan");
    localStorage.removeItem("sucre");
    localStorage.removeItem("morceaux");
    window.location.replace("index.html");

}





function reScanBarcode() {

    cordova.plugins.barcodeScanner.scan(
        function (result) {
            /*   alert("We got a barcode\n" +
                     "Result: " + result.text + "\n" +
                     "Format: " + result.format + "\n" +
                     "Cancelled: " + result.cancelled);*/


            localStorage.setItem("code", result.text);
            getSucre();




        },

        function (error) {
            alert("Scanning failed: " + error);
        }
    );
}


function getSucre() {
    $.ajax({

        type: "GET",
        url: 'http://172.31.7.30/api/code_barre.php',
        data: "code=" + localStorage.getItem("code"), 
        success: function (data) {
            if (typeof JSON.parse(data) == 'object') {
                var obj = JSON.parse(data);
                localStorage.setItem("morceaux", Math.round(parseFloat(obj.morceaux)));;
                var image = obj.url;
                window.location.replace("scan2.html");
            } else
                alert("Le produit n'existe pas dans la base!");
        }

    });

}