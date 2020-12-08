<?php 
    class UpdateNoteController extends AbstractController {
        protected function makeModel() : Model {
            return new UpdateNoteModel(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            $v = new View();
            $v->registerTemplate(TEMPLATE_DIR . "/update_note_template.php");
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

            $id = isset($_POST) && isset($_POST["NationalID"]) ? $_POST["NationalID"] : $_GET["id"];
            $nid = isset($_POST) && isset($_POST["NoteID"]) ? $_POST["NoteID"] : $_GET["nid"];

            if (isset($_POST) && isset($_POST["NationalID"])) {
                $this->model = $this->makeModel();
                if (isset($_SESSION) && isset($_SESSION["ognote"])) {
                    $currentpatient = $this->model->find([
                        "NationalID" => $id,
                        "NoteID" => $nid
                        ])[0];
                    if ($_SESSION["ognote"] == $currentpatient) // good to go ... no concurrent editing
                        $this->editNote($_POST, $authenticator->getUserInfo("id"));
                    else {
                        // inform user that note has been edited since they started (and ask if they want to reload the changes)
                        $this->view->registerTemplate(TEMPLATE_DIR . "/update_note_sync_template.php");
                        $this->view->importVar("id", $id);
                        $this->view->importVar("nid", $nid);
                    }
                    unset($_SESSION["ognote"]);
                } else $this->editNote($_POST, $authenticator->getUserInfo("id")); // no check for concurrency .... simply commit changes
            } else if (isset($_GET) && isset($_GET["id"])) {
                //first time editing

                //get copy of note and store in a var called original note
                //save users changes to var called patient
                //upon validating that there are no errors load note from db again and store in newNote
                //if any values in 'original note are diff from 'new note' ... cause user to not be able to save changes (other user has changed data since current user starting editing)
                //else all values match save var note to db
                $this->model = $this->makeModel();
                $note = $this->model->find([
                    "NationalID" => $_GET["id"],
                    "NoteID" => $_GET["nid"]
                    ])[0];
                $_SESSION["ognote"] = $note;
                $this->view->importVar("note", $note);
            }
            
            $this->view->display();
        }

        private function editNote($post, $pid) {
            // update the last edit time and author
            date_default_timezone_set("America/Barbados");
            $post["LastEdit"] =  date("Y-m-d") . " " . date("H:i");
            $post["LastAuthor"] = $pid;
            $result = $this->model->update($post, "Note");
            header("location: viewNotes.php?id=" . $post["NationalID"]);
        }
    }
?>