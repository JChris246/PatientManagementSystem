<?php 
    class AdmitController extends AbstractController {

        protected function makeModel() : Model {
            return new UpdatePatientModel(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            $v = new View();
            $v->registerTemplate(TEMPLATE_DIR . "/admit_template.php");
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

            if (isset($_POST) && isset($_POST["id"])) {
                $this->process($_POST["id"]);
            } else if (isset($_GET) && isset($_GET["id"])) {
                $this->process($_GET["id"]);
            } else { // display box to enter id
                $this->view = $this->makeView();
                $this->view->display();
            }
        }

        private function process($id) {
            $this->model = $this->makeModel();

            $validator = new ValidateController();
            if (!$validator->isIdValid($id)) {
                $this->view = $this->makeView();
                $this->view->importVar("error", "Invalid National ID entered");
                $this->view->display();  
            } else {
                $patient = $this->model->find(["NationalID" => $id], "Patient");
                if (count($patient) < 1) {
                    $this->view = $this->makeView();
                    $this->view->importVar("error", "No Patient with that National ID found");
                    $this->view->display();
                } else {
                    $patient = $patient[0];
                    $patient["Active"] = 1;
                    $patient["AdmissionDate"] = date("Y-m-d") . " " . date("H:i");
                    if (strlen($patient["MaritalStatus"]) < 1)
                        $patient["MaritalStatus"] = "single";
                    $result = $this->model->update($patient, "Patient");
                    
                    header("location: viewPatient.php?id=" . $patient["NationalID"]);
                }
            }
        }
    }
?>