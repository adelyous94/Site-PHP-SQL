<?php 
    require_once('modele/modele.class.php');
    class Controleur {
        private $unModele;

        public function __construct (){
            $this->unModele = new Modele();
        }

        /******************* Gestion des pays **********************/
        
        public function selectAllPays(){
            return $this->unModele->selectAllPays();
        }

        public function insertPays($tab){
            if ($this->verifDonnees($tab)) {
                $this->unModele->insertPays($tab);
                return true;
            }
            return false;
        }

        public function selectLikePays($filtre){
            return $this->unModele->selectLikePays($filtre);
        }

        public function deletePays($id_pays){
            $this->unModele->deletePays($id_pays);
        }

        public function selectWherePays($id_pays){
            return $this->unModele->selectWherePays($id_pays);
        }

        public function updatePays($tab){
            $this->unModele->updatePays($tab);
        }

        /******************* Gestion des projets **********************/

        public function selectAllProjets(){
            return $this->unModele->selectAllProjets();
        }

        public function insertProjet($tab){
            if ($this->verifDonnees($tab)) {
                $this->unModele->insertProjet($tab);
                return true;
            }
            return false;
        }

        public function selectLikeProjets($filtre){
            return $this->unModele->selectLikeProjets($filtre);
        }

        public function deleteProjet($id_projet){
            $this->unModele->deleteProjet($id_projet);
        }

        public function selectWhereProjet($id_projet){
            return $this->unModele->selectWhereProjet($id_projet);
        }

        public function updateProjet($tab){
            $this->unModele->updateProjet($tab);
        }

        /******************* Gestion des membres **********************/

        public function selectAllMembres(){
            return $this->unModele->selectAllMembres();
        }

        public function insertMembre($tab){
            if ($this->verifDonnees($tab)) {
                $this->unModele->insertMembre($tab);
                return true;
            }
            return false;
        }

        public function selectLikeMembres($filtre){
            return $this->unModele->selectLikeMembres($filtre);
        }

        public function deleteMembre($id_membre){
            $this->unModele->deleteMembre($id_membre);
        }

        public function selectWhereMembre($id_membre){
            return $this->unModele->selectWhereMembre($id_membre);
        }

        public function updateMembre($tab){
            $this->unModele->updateMembre($tab);
        }

        /******************* Gestion des donateurs **********************/

        public function selectAllDonateurs(){
            return $this->unModele->selectAllDonateurs();
        }

        public function insertDonateur($tab){
            if ($this->verifDonnees($tab)) {
                $this->unModele->insertDonateur($tab);
                return true;
            }
            return false;
        }

        public function selectLikeDonateurs($filtre){
            return $this->unModele->selectLikeDonateurs($filtre);
        }

        public function deleteDonateur($id_donateur){
            $this->unModele->deleteDonateur($id_donateur);
        }

        public function selectWhereDonateur($id_donateur){
            return $this->unModele->selectWhereDonateur($id_donateur);
        }

        public function updateDonateur($tab){
            $this->unModele->updateDonateur($tab);
        }

        /******************* Gestion des participations **********************/

        public function selectAllParticipations(){
            return $this->unModele->selectAllParticipations();
        }

        public function insertParticipation($tab){
            if ($this->verifDonnees($tab)) {
                $this->unModele->insertParticipation($tab);
                return true;
            }
            return false;
        }

        public function selectLikeParticipations($filtre){
            return $this->unModele->selectLikeParticipations($filtre);
        }

        public function deleteParticipation($id_membre, $id_projet){
            $this->unModele->deleteParticipation($id_membre, $id_projet);
        }

        public function selectWhereParticipation($id_membre, $id_projet){
            return $this->unModele->selectWhereParticipation($id_membre, $id_projet);
        }

        public function updateParticipation($tab){
            $this->unModele->updateParticipation($tab);
        }

        /******************* Gestion des dons **********************/

        public function selectAllDons(){
            return $this->unModele->selectAllDons();
        }

        public function insertDon($tab){
            if ($this->verifDonnees($tab)) {
                $this->unModele->insertDon($tab);
                return true;
            }
            return false;
        }

        public function selectLikeDons($filtre){
            return $this->unModele->selectLikeDons($filtre);
        }

        public function deleteDon($id_don){
            $this->unModele->deleteDon($id_don);
        }

        public function selectWhereDon($id_don){
            return $this->unModele->selectWhereDon($id_don);
        }

        public function updateDon($tab){
            $this->unModele->updateDon($tab);
        }

        /******************* Utilitaires **********************/

      /********* Gestion des users ************/

        public function verifConnexion($email, $mdp){
            //controle des données

            $tab = array("email"=>$email, "mdp"=>$mdp);

            $mdp = sha1($mdp); 
            
        if($this->verifDonnees($tab)){
            return $this->unModele->verifConnexion($email, $mdp);
            //retourne le user resultat 
        }else {
            return false; 
        }

        

        }

        public function verifDonnees($tab){
            $verif = true; 
            foreach ($tab as $cle => $valeur) {
                if($valeur == " " || $valeur == null){
                    $verif=false; 
                    break; 
                }
            }
            return $verif; 
        }
}

?>