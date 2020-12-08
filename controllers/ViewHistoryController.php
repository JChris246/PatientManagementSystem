<?php 
    class ViewHistoryController extends AbstractController {
        private $offset, $perpage = 5;

        protected function makeModel() : Model {
            return new ViewHistoryModel(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            $v = new View();
            $v->registerTemplate(TEMPLATE_DIR . "/view_history_template.php");
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

            $type = isset($_GET["type"]) ? $_GET["type"] : $_POST["type"];
            $id_name = ($type == "patient") ? "HistoryID" : "FamilyID";
            $table = ($type == "patient" ? "Patient" : "Family") . "History";

            if (isset($_GET["delete"])) { // delete the selected item (depends on the delete button u pressed)
                $result = $this->model->del([
                    $id_name => $_GET["nid"],
                    "NationalID" => $_GET["id"]
                ], $table);
                $this->loadHistory($_GET["id"], $type, $table);
            } else if (isset($_GET["add"])) { // if user click button to add a item to patient .. give them the form to add
                $this->view->registerTemplate(TEMPLATE_DIR . "/add_history_template.php");
                $this->view->importVar("id", $_GET["id"]);
                $this->view->importVar("index", $_GET["index"]);
                $this->view->importVar("type", $type);
            } else if (isset($_POST["issue"]) && isset($_POST["addHistory"]) && $_POST["addHistory"] == "add") {
                // adding item from the form the user just entered
                $result = $this->model->add([
                    $id_name => $_POST["index"],
                    "NationalID" => $_POST["id"],
                    "Issue" => $_POST["issue"]
                ], $table);
                if (isset($result["error"])) { // some error adding (sql error)
                    $this->view->registerTemplate(TEMPLATE_DIR . "/add_history_template.php");
                    $this->view->importVar("index", $_POST["index"]);
                    $this->view->importVar("id", $_POST["id"]);
                    $this->view->importVar("issue", $_POST["issue"]);
                    $this->view->importVar("type", $type);
                    $this->view->importVar("error", $result["error"]);
                } else // all things are ok (note added) ... return them to view notes 
                    $this->loadHistory($_POST["id"], $type, $table);
            } else // Simply viewing the notes assigned to patient
                $this->loadHistory($_GET["id"], $type, $table);

            $this->view->display();
        }

        private function loadHistory($id, $type, $table) {
            $allHistory = $this->model->find(["NationalID" => $id], $table);
            $this->view->importVars($this->setupPaginationDetails(count($allHistory)));
            $this->view->importVar("history", $this->model->findLimit(["NationalID" => $id], $table, $this->offset, $this->perpage));
            $this->view->importVar("id", $id);
            $this->view->importVar("type", $type);
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