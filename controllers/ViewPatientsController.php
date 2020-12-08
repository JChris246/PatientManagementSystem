<?php 
    class ViewPatientsController extends AbstractController {
        private $offset, $perpage = 20;

        protected function makeModel() : Model {
            return new ViewPatientsModel(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            $v = new View();
            $v->registerTemplate(TEMPLATE_DIR . "/view_patients_template.php");
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
            
            $this->model = $this->makeModel();
            $this->view = $this->makeView();
            $this->view->importVars($user_info);

            // if search (simple) request came from view all patients
            if ((isset($_POST) && isset($_POST["SearchAll"])) || (isset($_GET) && isset($_GET["search"]))) {
                $search = isset($_POST["SearchAll"]) ? $_POST["SearchAll"] : $_GET["search"];
                $validator = new ValidateController();
                if ($validator->isNameValid($search)) { // avoid some sql injections
                    $results = $this->model->find(["FirstName" => $search], "Patient");
                    $this->view->importVars($this->setupPaginationDetails(count($results)));
                    $this->view->importVar("patients", $this->model->findLimit(["FirstName" => $search], $this->offset, $this->perpage));
                    $this->view->importVar("search", $search);
                } 
            // if search request came from advanced (all or my)
            } else if ((isset($_POST) && isset($_POST["advanced"])) || (isset($_GET) && isset($_GET["advanced"]))) {
                $validator = new ValidateController();
                $searchParams = [];
                $params = isset($_POST["advanced"]) ? $_POST : $_GET;
                unset($params["advanced"]);
                foreach($params as $key => $value)
                    if ($validator->isSearchSafe($value)) { //if search option has a value (and try to avoid some sql injection)
                        if ($key != "Sex" && $value != "any")
                            $searchParams = array_merge($searchParams, [$key => $value]);
                    } else
                        unset($params[$key]);
                if (isset($searchParams["page"]))
                    unset($searchParams["page"]);
                if (count($searchParams) < 1) { // no params passed, default to showing all
                    $this->view->importVars($this->setupPaginationDetails($this->model->count("Patient")["COUNT(*)"]));
                    $this->view->importVar("patients", $this->model->findAllLimit([], $this->offset, $this->perpage));
                } else {
                    $result = $this->model->findRegex($searchParams, "Patient");
                    $this->view->importVars($this->setupPaginationDetails(count($result)));
                    $this->view->importVar("patients", $this->model->findRegexLimit($searchParams, $this->offset, $this->perpage));
                    $this->view->importVar("advancedSearch", http_build_query(array_merge($params, ["advanced" => true])));
                }
            //if request came from view my patients  
            } else if (isset($_GET) && isset($_GET["my"])) {
                $patients = $this->model->findAllAssigned([
                    "FirstName" => $user_info["fname"],
                    "LastName" => $user_info["lname"],
                    "Role" => $user_info["role"],
                ]);
                $this->view->importVars($this->setupPaginationDetails(count($patients)));
                $this->view->importVar("patients", $this->model->findAllAssignedLimit([
                    "FirstName" => $user_info["fname"],
                    "LastName" => $user_info["lname"],
                    "Role" => $user_info["role"],
                ], $this->offset, $this->perpage));
                $this->view->importVar("my", True);
            } else { // Else simply display all patients (20 at a time)
                $this->view->importVars($this->setupPaginationDetails($this->model->count("Patient")["COUNT(*)"]));
                $this->view->importVar("patients", $this->model->findAllLimit([], $this->offset, $this->perpage));
            }

            $this->view->display();
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