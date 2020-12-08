<?php 
    class UpdateHistoryController extends AbstractController {
        protected function makeModel() : Model {
            return new UpdateHistoryModel(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            $v = new View();
            $v->registerTemplate(TEMPLATE_DIR . "/update_history_template.php");
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

            $type = isset($_POST) && isset($_POST["type"]) ? $_POST["type"] : $_GET["type"];
            $id_name = ($type == "patient") ? "HistoryID" : "FamilyID";
            $this->view->importVar("type", $type);
            $this->view->importVar("id_name", $id_name);
            $table = ($type == "patient" ? "Patient" : "Family") . "History";

            $id = isset($_POST) && isset($_POST["NationalID"]) ? $_POST["NationalID"] : $_GET["id"];
            $nid = isset($_POST) && isset($_POST[$id_name]) ? $_POST[$id_name] : $_GET["nid"];

            if (isset($_POST) && isset($_POST["NationalID"])) {
                $this->model = $this->makeModel();
                if (isset($_SESSION) && isset($_SESSION["oghistory"])) {
                    $currentHistory = $this->model->find([
                        "NationalID" => $id,
                        $id_name => $nid
                    ], $table)[0];
                    if ($_SESSION["oghistory"] == $currentHistory) // good to go ... no concurrent editing
                        $this->editHistory($_POST, $table);
                    else {
                        // inform user that note has been edited since they started (and ask if they want to reload the changes)
                        $this->view->registerTemplate(TEMPLATE_DIR . "/update_history_sync_template.php");
                        $this->view->importVar("id", $id);
                        $this->view->importVar("nid", $nid);
                        $this->view->importVar("type", $type);
                    }
                    unset($_SESSION["oghistory"]);
                } else $this->editHistory($_POST, $table); // no check for concurrency .... simply commit changes
            } else if (isset($_GET) && isset($_GET["id"])) {
                //first time editing

                //get copy of history and store in a var called original history
                //save users changes to var called history
                //upon validating that there are no errors load note from db again and store in newHistory
                //if any values in 'original history are diff from 'new history' ... cause user to not be able to save changes (other user has changed data since current user starting editing)
                //else all values match save var history to db
                $this->model = $this->makeModel();

                $history = $this->model->find([
                    "NationalID" => $_GET["id"],
                    $id_name => $nid
                ], $table)[0];
                $_SESSION["oghistory"] = $history;
                $this->view->importVar("history", $history);
            }
            
            $this->view->display();
        }

        private function editHistory($post, $table) {
            $type = $post["type"];
            unset($post["type"]);
            $result = $this->model->update($post, $table);
            header("location: viewHistory.php?id=" . $post["NationalID"] . "&type=" . $type);
        }
    }
?>