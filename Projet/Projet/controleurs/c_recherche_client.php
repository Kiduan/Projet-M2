<?php
    /* ------------------------------------------------------- */
    /* Frogi-secure   Baron Corentin   2016                    */
    /* Site : Frogi-secure distributeur                        */
    /*                                                         */ 
    /* Description du fichier : Controleur page de recherche   */
    /*                                                         */
    /* @Ce fichier permet en fonction de la saisie effectuée   */
    /*  de récupérer dans la BDD les clients dont la recherche */
    /*  demandée correspond. Il renvoit à la page v_recherche  */
    /*  les résultat en varialbe de session pour le traitement */
    /*  de l'affichage.                                        */
    /* ------------------------------------------------------- */

    $en=lireDonneeUrl('en');
    switch($en) {//si il a fait une recherche on a en=envoie dans l'url dans ce cas on lit les données en post et on lance les requete
        case 'envoie':
                $_SESSION['Rnom']=lireDonneePost('nom');
                $_SESSION['Retab']=lireDonneePost('etab');
                $_SESSION['Rserial']=lireDonneePost('serial');
                $_SESSION['Rserial']=str_replace(' ','',$_SESSION['Rserial']);
                if (lireDonneePost('start_date')!="")   {//palge horaire de 30 jours avec comme milieux la date rentrer par l'utilisateur
                    $_SESSION['RdateI']=date("Y-m-d", strtotime(lireDonneePost('start_date'))-3600*24*15);// 15 jours avant
                    $_SESSION['RdateS']=date("Y-m-d", strtotime(lireDonneePost('start_date'))+3600*24*15);//15 jours après
                }else {
                    $_SESSION['RdateI']="";
                    $_SESSION['RdateS']="";
                }
                $_SESSION['Retat']=lireDonneePost('etat');
                $_SESSION['Rmodel']=lireDonneePost('model');
                if ($_SESSION['Rnom'] == "" && $_SESSION['Retab']=="" && $_SESSION['Rserial']=="" &&  $_SESSION['RdateI'] &&  $_SESSION['RdateS'] && $_SESSION['Retat']=="" && $_SESSION['Rmodel']==""){//il n'a rien rentrer donc on force Retat et Rmodel à all 
                    //pour l'affichage
                    $_SESSION['Retat']="all";
                    $_SESSION['Rmodel']="all";
                }break;
    }
    if ($_SESSION['Rnom'] != "" || $_SESSION['Retab']!="" || $_SESSION['Rserial']!="" || $_SESSION['Retat']!="all" || $_SESSION['Rmodel']!="all" || $_SESSION['RdateI']!="" || $_SESSION['RdateS']!="")    {//si au moin un non nul
                    $pdoExetud = new PdoBDD("localhost", "test", "isen29", "frogi_client"); 
                    $ordre = lireDonneeUrl('ordre');
                    $tri = lireDonneeUrl('tri');
                    if ($tri)
                        $_SESSION['Tri'] = $tri;
                    if ($_SESSION['Tri'] != "no")   {//si un tri alors on tri la recherche sinon on prend tri=client et ordre=ASC par defaut
                        if ($ordre != "")  
                           $_SESSION['Liste']=$pdoExetud->recupRecherche($_SESSION['Id'], $_SESSION['Tri'], $ordre,$_SESSION['Rnom'],$_SESSION['Retab'],$_SESSION['Rserial'], $_SESSION['RdateI'], $_SESSION['RdateS'], $_SESSION['Retat'], $_SESSION['Rmodel']);
                        else  $_SESSION['Liste']=$pdoExetud->recupRecherche($_SESSION['Id'], $_SESSION['Tri'], "ASC",$_SESSION['Rnom'],$_SESSION['Retab'],$_SESSION['Rserial'], $_SESSION['RdateI'], $_SESSION['RdateS'], $_SESSION['Retat'], $_SESSION['Rmodel']);
                    }else    $_SESSION['Liste']=$pdoExetud->recupRecherche($_SESSION['Id'], "client", "ASC",$_SESSION['Rnom'],$_SESSION['Retab'],$_SESSION['Rserial'], $_SESSION['RdateI'], $_SESSION['RdateS'], $_SESSION['Retat'], $_SESSION['Rmodel']);
               }
?>