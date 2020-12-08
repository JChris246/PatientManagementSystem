<?php 
    class DeletePatientController extends AbstractController {
        protected function makeModel() : Model {
            return new DeletePatientModel(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            $v = new View();
            $v->registerTemplate(TEMPLATE_DIR . "/delete_patient_template.php");
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
            
            if (isset($_GET) && isset($_GET["confirm"])) {
                $this->model = $this->makeModel();
                $result = $this->model->del(["NationalID" => isset($_GET["id"]) ? $_GET["id"] : "0"]);
                header("location: dashboard.php?message=" . $result);
            } else if (isset($_GET) && $_GET["id"]) {
                $this->view = $this->makeView();
                $this->view->importVars($user_info);
                $this->view->importVar("id", $_GET["id"]);

                $this->view->display();
            }
        }
    }
?>