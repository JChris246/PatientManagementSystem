<?php 
    class ViewNotesController extends AbstractController {
        private $offset, $perpage = 5;

        protected function makeModel() : Model {
            return new ViewNotesModel(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            $v = new View();
            $v->registerTemplate(TEMPLATE_DIR . "/view_patient_notes_template.php");
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
            $this->model = $this->makeModel();

            if (isset($_GET["delete"])) { // delete the selected note (depends on the delete button u pressed)
                $result = $this->model->del([
                    "NoteID" => $_GET["nid"],
                    "NationalID" => $_GET["id"]
                ]);
                $this->loadNotes($_GET["id"]);
            } else if (isset($_GET["add"])) { // if user click button to add a note to patient .. give them the form to add
                $this->view->registerTemplate(TEMPLATE_DIR . "/add_patient_note_template.php");
                $this->view->importVar("id", $_GET["id"]);
                $this->view->importVar("index", $_GET["index"]);
            } else if (isset($_POST["note"]) && isset($_POST["addNote"]) && $_POST["addNote"] == "add") {
                // adding note from the form the user just entered
                date_default_timezone_set("America/Barbados");
                $lastEdit = $entryTime = date("Y-m-d") . " " .date("H:i");
                $result = $this->model->add([
                    "NoteID" => $_POST["index"],
                    "NationalID" => $_POST["id"],
                    "Note" => $_POST["note"],
                    "EntryTime" => $entryTime,
                    "LastEdit" => $lastEdit,
                    "Author" => $authenticator->getUserInfo("id"),
                    "LastAuthor" => $authenticator->getUserInfo("id")
                ]);
                if (isset($result["error"])) { // some error adding (sql error)
                    $this->view->registerTemplate(TEMPLATE_DIR . "/add_patient_note_template.php");
                    $this->view->importVar("note", $_POST["note"]);
                    $this->view->importVar("id", $_POST["id"]);
                    $this->view->importVar("index", $_POST["index"]);
                    $this->view->importVar("error", $result["error"]);
                } else // all things are ok (note added) ... return them to view notes 
                    $this->loadNotes($_POST["id"]);
            } else // Simply viewing the notes assigned to patient
                $this->loadNotes($_GET["id"]);

            $this->view->display();
        }

        private function loadNotes($id) {
            $allNotes = $this->model->find(["NationalID" => $id], "Note");
            $this->view->importVars($this->setupPaginationDetails(count($allNotes)));
            $this->view->importVar("notes", $this->model->findLimit(["NationalID" => $id], $this->offset, $this->perpage));
            $this->view->importVar("id", $id);
        }

        private function setupPaginationDetails($total) {
            //setup pagination details
            $balance = 3;
            $maxpage = ceil($total / $this->perpage);

            $page = isset($_GET) && isset($_GET["page"]) ? $_GET["page"] : 1;
            $page = $page < 1 || $page > $maxpage ? 1 : $page;
            $this->offset = ($page - 1) * $this->perpage;
            
            $forward = (($total - $this->offset) / $this->perpage) - 1 > 0 ? True : False;
            $left = $page - 1 > $balance ? $balance : $page - 1;
            $right = $maxpage - $page > $balance ? $balance : $maxpage - $page;

            //balance the current page in the middle
            if ($right < $balance && $left < $balance) {
                //not enough to balance
            } else {
                if ($right < $balance)
                    $left += $balance - $right;
                else if ($left < $balance) {
                    $right += $balance - $left;
                }
            }

            if ($total < 1)
                return ["empty" => "empty"];
            else return [
                "page" => $page,
                "forward" => $forward,
                "back" => $this->offset == 0 ? False : True,
                "right" => $right,
                "left" => $left
            ]; 
        }
    }
?>