<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Joueur;
use AppBundle\Entity\Partie;
use AppBundle\Entity\Carte;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="joueur_homepage")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        return $this->render("joueur/index.html.twig", ['user' => $user]);
    }

    /**
     * @Route("/parties/", name="joueur_parties")
     */
    public function mesPartiesAction()
    {
        $user = $this->getUser();
        return $this->render("joueur/mesparties.html.twig", ['user' => $user]);
    }

    /**
     * @Route("/parties/add", name="joueur_parties_add")
     */
    public function addPartieAction()
    {
        $user = $this->getUser();
        // récupérer tous les joueurs existants
        $joueurs = $this->getDoctrine()->getRepository('AppBundle:Joueur')->findAll();
        return $this->render("joueur/addpartie.html.twig", ['user' => $user, 'joueurs' => $joueurs]);
    }

    /**
     * @Route("/classement", name="classement")
     */
    public function classementAction()
    {
        $user = $this->getUser();
        // récupérer tous les joueurs existants
        $joueurs = $this->getDoctrine()->getRepository('AppBundle:Joueur')->findBy(array(),array('joueurHighscore' => 'desc'));
        return $this->render("joueur/classement.html.twig", ['user' => $user, 'joueurs' => $joueurs]);
    }

    /**
     * @param Joueur $id
     * @Route("/inviter/{joueur}", name="creer_partie")
     */
    public function creerPartieAction(Joueur $joueur)
    {

        $user = $this->getUser();

        $find = $this->getDoctrine()->getRepository('AppBundle:Partie')->findBy(array('partieJ1' => $user, 'partieJ2' => $joueur));

        if ($find) {
            foreach ($find as $part){

                return $this->redirectToRoute('afficher_partie', array('id' => $part->getId()));
            }
        } else {

            $partie = new Partie();
            $partie->setPartieJ1($user);
            $partie->setPartieJ2($joueur);

            $em = $this->getDoctrine()->getManager();
            $em->persist($partie);
            $em->flush();


            //$situation = new Situation();
            //$partie->setPartie($partie);

            // récupérer les cartes
            $cartes = $this->getDoctrine()->getRepository('AppBundle:Cartes')->findAll();

            //on mélange les cartes
            shuffle($cartes);
            $t = array();

            for ($i = 0; $i < 8; $i++) {
                $t[] = $cartes[$i]->getId();
            }

            $partie->setPartieMainJ1(json_encode($t));

            $t = array();

            for ($i = 8; $i < 16; $i++) {
                $t[] = $cartes[$i]->getId();
            }

            $partie->setPartieMainJ2(json_encode($t));

            $t = array();

            for ($i = 16; $i < count($cartes); $i++) {
                $t[] = $cartes[$i]->getId();
            }

            $partie->setPartiePioche(json_encode($t));

            $tab_pioche = array();

            $tab_terrain = array('1' => array(), '2' => array(), '3' => array(), '4' => array(), '5' => array());
            //$tab_terrain = array(1 => [], 2 => [], 3 => [],4 => [],5 => []);

            $partie->setPartiePlateauJ1(json_encode($tab_terrain));

            $partie->setPartiePlateauJ2(json_encode($tab_terrain));

            $partie->setPartieDefausse(json_encode($tab_terrain));

            $partie->setPartieCartePosee(0);


            // Définition du tour
            $myId = $this->getUser()->getId();
            $joueur1Id = $partie->getPartieJ1()->getId();
            $joueur2Id = $partie->getPartieJ2()->getId();

            if ($myId == $joueur1Id) {
                $partie->setPartieTour(1);
            }

            if ($myId == $joueur2Id) {
                $partie->setPartieTour(2);
            }

            $em->persist($partie);
            $em->flush();

            $find = $this->getDoctrine()->getRepository('AppBundle:Partie')->findBy(array('partieJ1' => $user, 'partieJ2' => $joueur));

            // Redirect vers l'affichage de la partie
            foreach ($find as $part) {
                return $this->redirectToRoute('afficher_partie', array('id' => $part->getId()));
            }
        }
    }

//    /**
//     * @Route("/parties/verif/{partie}/{tour}", name="verif_partie")
//     */
//    public function VerifPartieAction( $partie,$tour){
//
//        $repopartie = $this
//            ->getDoctrine()
//            ->getManager()
//            ->getRepository('AppBundle:Partie_circus')
//        ;
//
//        $game = $repopartie->findOneBy(array('id' => $partie  ));
//
//        $touractuel = $game->getPartieTour();
//
//        if ( $touractuel == $tour ){
//
//            return new Response(
//                '',200
//            );
//        }
//        else {
//
//            return new Response(
//                'CHANGEMENT DE TOUR'
//            );
//        }
//    }

    /**
     * @param Partie $id
     * @Route("/partie/{id}", name="afficher_partie")
     */
    public function afficherPartieAction(Request $request, Partie $id)
    {
        //Utilisateur actif
        $useractif = $this->getUser();

        $find = $this->getDoctrine()->getRepository('AppBundle:Partie')->find($id);
        $user1 = $find->getPartieJ1();
        $user2 = $find->getPartieJ2();

        if ($user1 == $useractif || $user2 == $useractif){
            $partieId = $find->getId();
        }else{
            return $this->redirectToRoute('joueur_parties');
        }

        $em = $this->getDoctrine()->getManager();

        $partie = $em->getRepository('AppBundle:Partie')->find($id);

        $cartes = $em->getRepository('AppBundle:Cartes')->findAll();

        $pioche = array();

        $cartePioche = $partie->getPartiePioche();

        $cartePiocher = json_decode($cartePioche);

        $cartes2 = $this->getDoctrine()->getRepository('AppBundle:Cartes')->getAll();

        $unecarte = $em->getRepository('AppBundle:Cartes')->find(2);


        $myId = $useractif->getId();
        $joueur1Id = $partie->getPartieJ1()->getId();
        $joueur2Id = $partie->getPartieJ2()->getId();

        $mainJoueur1 = $partie->getPartieMainJ1();
        $mainJoueur2 = $partie->getPartieMainJ2();

        $joueur1Terrain = $partie->getPartiePlateauJ1();
        $joueur2Terrain = $partie->getPartiePlateauJ2();

        $partieDefausse = json_decode(json_encode($partie->getPartieDefausse()), true);

        $tourJoueur = $partie->getPartieTour();
        $cartePosee = $partie->getPartieCartePosee();

        $carteRestante = count($cartePiocher);

        $partieDateFin = $partie->getPartieDateFin();

        if($partieDateFin){
            $partieFin = true;

        }else{
            $partieFin = false;
        }


//        definition de la partie du joueur et de son adversaire
        if ($myId == $joueur1Id){

            $mesCartes = $mainJoueur1;
            $monTerrain =json_decode(json_encode($joueur1Terrain), true);

            $i=1;
            $totalPoint = 0;
            $nbBonnus= 0;
            $nbCartes = 0;
            $scoreJ1 = 0;
            foreach ($monTerrain as $terrain){

                foreach ($terrain as $point){
//                    dump(end($point));
                    if (end($point) == 1){

                        $nbBonnus++;

                        if ($nbBonnus > 1 ){
                            $totalPoint =$totalPoint-20;
                        }else{
                            $totalPoint = -40;
                        }

                    }else{
                        if ($nbCartes > 0){
                            if ($nbBonnus > 0){
                                switch ($nbBonnus){
                                    case 1 :
                                        $totalPoint =$totalPoint + (end($point)*2);
                                        break;
                                    case 2 :
                                        $totalPoint =$totalPoint + (end($point)*3);
                                        break;
                                    case 3 :
                                        $totalPoint =$totalPoint + (end($point)*4);
                                        break;
                                }

                            }else{
                                $totalPoint =$totalPoint + end($point);
                            }

                        }else{
                            $totalPoint = -20 + end($point);
                        }

                    }

                    $nbCartes ++;

                }

                array_push($monTerrain[$i], array('totalPoint' => $totalPoint, 'nbBonnus'=> $nbBonnus, 'nbCartes'=> $nbCartes));
                $scoreJ1 = $scoreJ1 + $totalPoint ;
                $totalPoint = 0;
                $nbBonnus =0;
                $nbCartes = 0;
//                dump($terrain);
                $i++;

            }

            $partie->setPartieScoreJ1($scoreJ1);


            $adversaireCartes = $mainJoueur2;
            $adversaireTerrain =json_decode(json_encode($joueur2Terrain), true);

            $i=1;
            $totalPoint = 0;
            $nbBonnus= 0;
            $nbCartes = 0;
            $scoreJ2 = 0;
            foreach ($adversaireTerrain as $terrain){

                foreach ($terrain as $point){
//                    dump(end($point));
                    if (end($point) == 1){

                        $nbBonnus++;

                        if ($nbBonnus > 1 ){
                            $totalPoint =$totalPoint-20;
                        }else{
                            $totalPoint = -40;
                        }

                    }else{
                        if ($nbCartes > 0){
                            if ($nbBonnus > 0){
                                switch ($nbBonnus){
                                    case 1 :
                                        $totalPoint =$totalPoint + (end($point)*2);
                                        break;
                                    case 2 :
                                        $totalPoint =$totalPoint + (end($point)*3);
                                        break;
                                    case 3 :
                                        $totalPoint =$totalPoint + (end($point)*4);
                                        break;
                                }

                            }else{
                                $totalPoint =$totalPoint + end($point);
                            }

                        }else{
                            $totalPoint = -20 + end($point);
                        }

                    }

                    $nbCartes ++;

                }

                array_push($adversaireTerrain[$i], array('totalPoint' => $totalPoint, 'nbBonnus'=> $nbBonnus, 'nbCartes'=> $nbCartes));
                $scoreJ2 = $scoreJ2 + $totalPoint ;
                $totalPoint = 0;
                $nbBonnus =0;
                $nbCartes = 0;
//                dump($terrain);
                $i++;


            }

            $partie->setPartieScoreJ2($scoreJ2);

            $em->flush();

            $numJoueur = 1;
            $me = $partie->getPartieJ1();

            if ($cartePosee == 0){
                $poseActive = true;
                $piocheActive = false;
            }elseif ($cartePosee == 1){
                $poseActive = false;
                $piocheActive = true;
            }

            if ($tourJoueur == 1){
                $montour = true;
            }else{
                $montour = false;
            }

            if ($partieFin == true){

                $bestScoreJ1 = $partie->getPartieJ1()->getJoueurHighscore();
                $bestScoreJ2 = $partie->getPartieJ2()->getJoueurHighscore();

                if ($bestScoreJ1 < $scoreJ1){

                    $partie->getPartieJ1()->setJoueurHighscore($scoreJ1);

                    $em->flush();
                }
                if ($bestScoreJ2 < $scoreJ2){

                    $partie->getPartieJ2()->setJoueurHighscore($scoreJ2);

                    $em->flush();
                }

            }

        }elseif ($myId == $joueur2Id){

            $mesCartes = $mainJoueur2;
            $monTerrain = json_decode(json_encode($joueur2Terrain), true);

            $i=1;
            $totalPoint = 0;
            $nbBonnus= 0;
            $nbCartes = 0;
            $scoreJ2 = 0;
            foreach ($monTerrain as $terrain){

                foreach ($terrain as $point){
//                    dump(end($point));
                    if (end($point) == 1){

                        $nbBonnus++;

                        if ($nbBonnus > 1 ){
                            $totalPoint =$totalPoint-20;
                        }else{
                            $totalPoint = -40;
                        }

                    }else{
                        if ($nbCartes > 0){
                            if ($nbBonnus > 0){
                                switch ($nbBonnus){
                                    case 1 :
                                        $totalPoint =$totalPoint + (end($point)*2);
                                        break;
                                    case 2 :
                                        $totalPoint =$totalPoint + (end($point)*3);
                                        break;
                                    case 3 :
                                        $totalPoint =$totalPoint + (end($point)*4);
                                        break;
                                }

                            }else{
                                $totalPoint =$totalPoint + end($point);
                            }

                        }else{
                            $totalPoint = -20 + end($point);
                        }

                    }

                    $nbCartes ++;

                }

                array_push($monTerrain[$i], array('totalPoint' => $totalPoint, 'nbBonnus'=> $nbBonnus, 'nbCartes'=> $nbCartes));
                $scoreJ2 = $scoreJ2 + $totalPoint ;
                $totalPoint = 0;
                $nbBonnus =0;
                $nbCartes = 0;
//                dump($terrain);
                $i++;


            }

            $partie->setPartieScoreJ2($scoreJ2);

            $em->flush();

            $adversaireCartes = $mainJoueur1;
            $adversaireTerrain = json_decode(json_encode($joueur1Terrain), true);

            $i=1;
            $totalPoint = 0;
            $nbBonnus= 0;
            $nbCartes = 0;
            $scoreJ1 = 0;
            foreach ($adversaireTerrain as $terrain){

                foreach ($terrain as $point){
//                    dump(end($point));
                    if (end($point) == 1){

                        $nbBonnus++;

                        if ($nbBonnus > 1 ){
                            $totalPoint =$totalPoint-20;
                        }else{
                            $totalPoint = -40;
                        }

                    }else{
                        if ($nbCartes > 0){
                            if ($nbBonnus > 0){
                                switch ($nbBonnus){
                                    case 1 :
                                        $totalPoint =$totalPoint + (end($point)*2);
                                        break;
                                    case 2 :
                                        $totalPoint =$totalPoint + (end($point)*3);
                                        break;
                                    case 3 :
                                        $totalPoint =$totalPoint + (end($point)*4);
                                        break;
                                }

                            }else{
                                $totalPoint =$totalPoint + end($point);
                            }

                        }else{
                            $totalPoint = -20 + end($point);
                        }

                    }

                    $nbCartes ++;

                }

                array_push($adversaireTerrain[$i], array('totalPoint' => $totalPoint, 'nbBonnus'=> $nbBonnus, 'nbCartes'=> $nbCartes));
                $scoreJ1 = $scoreJ1 + $totalPoint ;
                $totalPoint = 0;
                $nbBonnus =0;
                $nbCartes = 0;
//                dump($terrain);
                $i++;


            }

            $partie->setPartieScoreJ1($scoreJ1);

            $em->flush();


            $numJoueur = 2;
            $me = $partie->getPartieJ1();


            if ($cartePosee == 0){
                $poseActive = true;
                $piocheActive = false;
            }elseif ($cartePosee == 1){
                $poseActive = false;
                $piocheActive = true;
            }

            if ($tourJoueur == 2){
                $montour = true;
            }else {
                $montour = false;
            }

            if ($partieFin == true){

                $bestScoreJ1 = $partie->getPartieJ1()->getJoueurHighscore();
                $bestScoreJ2 = $partie->getPartieJ2()->getJoueurHighscore();

                if ($bestScoreJ1 < $scoreJ1){

                    $partie->getPartieJ1()->setJoueurHighscore($scoreJ1);

                    $em->flush();
                }
                if ($bestScoreJ2 < $scoreJ2){

                    $partie->getPartieJ2()->setJoueurHighscore($scoreJ2);

                    $em->flush();
                }

            }
        }

        $chat = $this->getDoctrine()->getRepository('AppBundle:Chat')->findBy(array('chatPartie' => $partie->getId()));

        $variablePartie = array('partieId'=>$partieId, 'pioche'=>$pioche, 'mesCartes'=>$mesCartes, 'monTerrain'=>$monTerrain, 'adversaireCartes'=> $adversaireCartes, 'adversaireTerrain' => $adversaireTerrain, 'montour' => $montour, 'numJoueur'=>$numJoueur,'poseActive' => $poseActive, 'piocheActive' => $piocheActive, 'partieDefausse' => $partieDefausse, 'carteRestante' => $carteRestante, 'partieFin' => $partieFin, 'scoreJ1' => $scoreJ1, 'scoreJ2' => $scoreJ2, 'me' => $me, 'chat' => $chat);


        //RECCUPERATION FORMULAIRES
        if ($request->isMethod('POST'))
        {

            $piocher = $request->request->get('piocher');

            $poser = $request->request->get('poser');

            $defausser = $request->request->get('defausser');

            $recuperer = $request->request->get('recuperer');


            //faire piocher le joueur
            if($piocher){


                $partiePioche = $partie->getPartiePioche();

                $tableauPioche = json_decode($partiePioche);

                $cartePiocher = array_pop($tableauPioche);

                $partie->setPartiePioche(json_encode($tableauPioche));

                $partie->setPartieCartePosee(0);

                if ($myId == $joueur1Id){

                    if (empty($tableauPioche)) {
                        $partie->setPartieDateFin(new \DateTime("now"));;

                        $em->flush();
                    }

                    array_push($mainJoueur1, $cartePiocher);

                    $partie->setPartieMainJ1(json_encode($mainJoueur1));

                    $partie->setPartieTour(2);

                    $em->flush();


                }elseif ($myId == $joueur2Id){

                    if (empty($tableauPioche)) {
                        $partie->setPartieDateFin(new \DateTime("now"));;

                        $em->flush();
                    }

                    array_push($mainJoueur2, $cartePiocher);

                    $partie->setPartieMainJ2(json_encode($mainJoueur2));

                    $partie->setPartieTour(1);

                    $em->flush();

                }

                $find = $this->getDoctrine()->getRepository('AppBundle:Partie')->findBy(array('partieJ1' => $user1, 'partieJ2' => $user2));

                // Redirect vers l'affichage de la partie
                return $this->redirectToRoute('afficher_partie', array('id' => $partieId));

            }

//          recuperer carte de la defausse
            if ($recuperer){


                $recupererId = $request->request->get('recupererId');
                $recupererCategorieId = $request->request->get('recupererCategorieId');

                $partieDefausse = json_decode(json_encode($partie->getPartieDefausse()), true);

//

                $partie->setPartieCartePosee(0);

                if ($myId == $joueur1Id){

                    array_push($mainJoueur1, $recupererId);

                    $partie->setPartieMainJ1(json_encode($mainJoueur1));


//                    $defausse = $partieDefausse[$recupererCategorieId];

//                    var_dump($defausse);
//                die();

                    $i=0;
                    while ($value = current($partieDefausse[$recupererCategorieId])) {
                        if ($value == $recupererId) {
                            array_splice($partieDefausse[$recupererCategorieId], $i, 1);
                        }
                        next($partieDefausse[$recupererCategorieId]);

                        $i++;
                    }

                    $partie->setPartieDefausse(json_encode($partieDefausse));


                    $partie->setPartieTour(2);

                    $em->flush();


                }elseif ($myId == $joueur2Id){

                    array_push($mainJoueur2, $recupererId);

                    $partie->setPartieMainJ2(json_encode($mainJoueur2));


//                    $defausse = $partieDefausse[$recupererCategorieId];

//                    var_dump($defausse);
//                die();

                    $i=0;
                    while ($value = current($partieDefausse[$recupererCategorieId])) {
                        if ($value == $recupererId) {
                            array_splice($partieDefausse[$recupererCategorieId], $i, 1);
                        }
                        next($partieDefausse[$recupererCategorieId]);

                        $i++;
                    }

                    $partie->setPartieDefausse(json_encode($partieDefausse));


                    $partie->setPartieTour(1);

                    $em->flush();

                }
                return $this->redirectToRoute('afficher_partie', array('id' => $partieId));



            }


//      le joueur pose une carte
            if ($poser){

                $cartePoserId = $request->request->get('cartePoserId');
                $cartePoserCategorie = $request->request->get('cartePoserCategorie');
                $cartePoserValeur = $request->request->get('cartePoserValeur');
                $cartePoserExtra = $request->request->get('cartePoserExtra');

                if ($myId == $joueur1Id){

                    $partieTerrain = $partie->getPartiePlateauJ1();

                    $partie->setPartieCartePosee(1);

                    $tab=json_decode(json_encode($partieTerrain), true);

                    $tabCat = $tab[$cartePoserCategorie];

                    if (!empty($tabCat)) {
                        $t = end($tabCat);
                        $lastValeur = end($t);

//                        die($lastValeur);
//                        if ($cartePoserExtra == 1) {

                        if ($lastValeur > $cartePoserValeur && $cartePoserExtra != 1) {

                            echo '<script>alert("Veuillez poser une carte de valeur supérieure");</script>';

                        } else {

                            if ($cartePoserValeur == 1 && $lastValeur == 1 || $cartePoserValeur > $lastValeur) {

//                                    die();
                                $cat = array($cartePoserId, $cartePoserValeur);

                                array_push($tab[$cartePoserCategorie], $cat);

                                $i = 0;
                                while ($value = current($mainJoueur1)) {
                                    if ($value == $cartePoserId) {
                                        array_splice($mainJoueur1, $i, 1);
                                    }
                                    next($mainJoueur1);

                                    $i++;
                                }

                                $partie->setPartiePlateauJ1(json_encode($tab));

                                $partie->setPartieMainJ1(json_encode($mainJoueur1));


                                $em->flush();

                                return $this->redirectToRoute('afficher_partie', array('id' => $partieId));
                            }
                        }
//                        }

                    }else{
                        $cat = array($cartePoserId, $cartePoserValeur);

                        array_push($tab[$cartePoserCategorie], $cat);

                        $i=0;
                        while ($value = current($mainJoueur1)) {
                            if ($value == $cartePoserId) {
                                array_splice($mainJoueur1, $i, 1);
                            }
                            next($mainJoueur1);

                            $i++;
                        }

                        $partie->setPartiePlateauJ1(json_encode($tab));

                        $partie->setPartieMainJ1(json_encode($mainJoueur1));


                        $em->flush();

                        return $this->redirectToRoute('afficher_partie', array('id' => $partieId));
                    }




                }elseif ($myId == $joueur2Id){

                    $partieTerrain = $partie->getPartiePlateauJ2();

                    $partie->setPartieCartePosee(1);


                    $tab=json_decode(json_encode($partieTerrain), true);

                    $tabCat = $tab[$cartePoserCategorie];

                    if (!empty($tabCat)) {
                        $t = end($tabCat);
                        $lastValeur = end($t);

//                        die($lastValeur);
//                        if ($cartePoserExtra == 1) {

                        if ($lastValeur > $cartePoserValeur && $cartePoserExtra != 1) {

                            echo '<script>alert("Veuillez poser une carte de valeur supérieure");</script>';

                        } else {

                            if ($cartePoserValeur == 1 && $lastValeur == 1|| $cartePoserValeur > $lastValeur) {

//                                    die();
                                $cat = array($cartePoserId, $cartePoserValeur);

                                array_push($tab[$cartePoserCategorie], $cat);

                                $i = 0;
                                while ($value = current($mainJoueur2)) {
                                    if ($value == $cartePoserId) {
                                        array_splice($mainJoueur2, $i, 1);
                                    }
                                    next($mainJoueur2);

                                    $i++;
                                }

                                $partie->setPartiePlateauJ2(json_encode($tab));

                                $partie->setPartieMainJ2(json_encode($mainJoueur2));


                                $em->flush();

                                return $this->redirectToRoute('afficher_partie', array('id' => $partieId));
                            }
                        }
//                        }

                    }else{
                        $cat = array($cartePoserId, $cartePoserValeur);

                        array_push($tab[$cartePoserCategorie], $cat);

                        $i=0;
                        while ($value = current($mainJoueur2)) {
                            if ($value == $cartePoserId) {
                                array_splice($mainJoueur2, $i, 1);
                            }
                            next($mainJoueur2);

                            $i++;
                        }

                        $partie->setPartiePlateauJ2(json_encode($tab));

                        $partie->setPartieMainJ2(json_encode($mainJoueur2));


                        $em->flush();

                        return $this->redirectToRoute('afficher_partie', array('id' => $partieId));
                    }

                }

            }

//          Defausser une carte au joueur

            if ($defausser){

                $cartePoserId = $request->request->get('cartePoserId');
//              $cartePoserValeur = $request->request->get('cartePoserValeur');
                $cartePoserCategorie = $request->request->get('cartePoserCategorie');

                if ($myId == $joueur1Id){

                    $defausseTerrain = $partie->getPartieDefausse();

                    $partie->setPartieCartePosee(1);


                    $tab=json_decode(json_encode($defausseTerrain), true);


//                  $cat = array($cartePoserId, $cartePoserValeur);

                    array_push($tab[$cartePoserCategorie], $cartePoserId);

                    $i=0;
                    while ($value = current($mainJoueur1)) {
                        if ($value == $cartePoserId) {
                            array_splice($mainJoueur1, $i, 1);
                        }
                        next($mainJoueur1);

                        $i++;
                    }

                    $partie->setPartieDefausse(json_encode($tab));

                    $partie->setPartieMainJ1(json_encode($mainJoueur1));

                    $em->flush();

                }elseif ($myId == $joueur2Id){

                    $defausseTerrain = $partie->getPartieDefausse();

                    $partie->setPartieCartePosee(1);


                    $tab=json_decode(json_encode($defausseTerrain), true);


//                  $cat = array($cartePoserId, $cartePoserValeur);

                    array_push($tab[$cartePoserCategorie], $cartePoserId);

                    $i=0;
                    while ($value = current($mainJoueur2)) {
                        if ($value == $cartePoserId) {
                            array_splice($mainJoueur2, $i, 1);
                        }
                        next($mainJoueur2);

                        $i++;
                    }

                    $partie->setPartieDefausse(json_encode($tab));

                    $partie->setPartieMainJ2(json_encode($mainJoueur2));

                    $em->flush();

                }
                return $this->redirectToRoute('afficher_partie', array('id' => $partieId));
            }
        }

        return $this->render(':joueur:afficherpartie.html.twig', ['cartes' => $cartes, 'cartes2' => $cartes2, 'unecarte' => $unecarte,'partie' => $partie, 'useractif'=> $useractif, 'variablePartie'=> $variablePartie]);


    }

    /**
     * @Route("/partie/verif/{partie}/", name="verif_partie")
     */
    public function VerifPartieAction($partie){

        $em = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Partie')
        ;

        $game = $em->findOneBy(array('id' => $partie));

        $touractuel = $game->getPartieTour();



//            return new Response(
//                '',200
//            );

        $response = new Response();
        $response->setContent(json_encode(array(
            'tour' => $touractuel,
        )));
        $response->headers->set('Content-Type', 'application/json');

        return $response;


//            return new Response(
//                'CHANGEMENT DE TOUR'
//            );

    }


}