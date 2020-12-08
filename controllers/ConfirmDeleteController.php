<?php 
    class ConfirmDeleteController extends AbstractController {
        protected function makeModel() : Model {
            return new DeletePatientModel(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            $v = new View();
            $v->registerTemplate(TEMPLATE_DIR . "/confirm_delete_item_template.php");
            return $v;
        }

        public function start() {
            $authenticator = new AuthenticateController();
            $authenticator->start();
            if (!$authenticator->isUserLoggedIn())
                header("Location: index.php");

            $user_info = [
                "fname" => $authenticator->getUserInfo("fname"),
                "lname" => $authenticator->getUserInfo("lname"),
                "role" => $authenticator->getUserInfo("role"),
            ];

            $this->view = $this->makeView();
            $this->view->importVars($user_info);
            
            if (isset($_GET["delete"]))
                $this->processForm($_GET);
            else; // do nothing ... u accessed the page illegally ... find your way out :|             
        }

        private function processForm($info) {
            $forward = "";
            $back = "";
            $item = " this ";
            if ($info["delete"] == "note") {
                $forward = "viewNotes.php?delete=true";
                $back = "viewNotes.php?";
                $item .= "Note ";
            } else if($info["delete"] == "patient") {
                $forward = "viewHistory.php?delete=true&type=patient";
                $back = "viewHistory.php?type=patient&";
                $item .= "Patient History ";
            } else if($info["delete"] == "family") {
                $forward = "viewHistory.php?delete=true&type=family";
                $back = "viewHistory.php?type=family&";
                $item .= "Family History ";
            }
            $forward .= "&id=" . $info["id"] ."&nid=" . $info["nid"];
            $back .= "id=" . $info["id"];

            $this->view->importVar("forward", $forward);
            $this->view->importVar("back", $back);
            $this->view->importVar("item", $item);

            $this->view->display();
        }
    }
?>