<?php 
    class ViewPatientController extends AbstractController {
        protected function makeModel() : Model {
            return new ViewPatientsModel(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            $v = new View();
            $v->registerTemplate(TEMPLATE_DIR . "/view_patient_template.php");
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
            $this->view->importVar("patient", $this->model->find(["NationalID" => $_GET["id"]], "Patient")[0]);

            $this->view->display();
        }
    }
?>