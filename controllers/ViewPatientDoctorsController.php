<?php 
    class ViewPatientDoctorsController extends AbstractController {
        protected function makeModel() : Model {
            return new ViewPatientDoctorModel(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            $v = new View();
            $v->registerTemplate(TEMPLATE_DIR . "/view_patient_doctor_template.php");
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

            if (isset($_GET["delete"])) { // if user clicks link to remove a doctor
                $result = $this->model->del([
                    "FirstName" => $_GET["f"],
                    "LastName" => $_GET["l"],
                    "Role" => $_GET["r"],
                    "NationalID" => $_GET["id"]
                ]);
                $this->loadDoctors($_GET["id"]);
            } else if (isset($_GET["add"])) { // if user click button to add a doctor to patient .. give them the form to add
                $this->view->registerTemplate(TEMPLATE_DIR . "/add_patient_doctor_template.php");
                $this->view->importVar("id", $_GET["id"]);
            } else if (isset($_POST["Role"])) { // if the user submitted from form adding new doctor
                $validator = new ValidateController();
                $result = $validator->checkDoctor($_POST);
                if (isset($result["error"])) { // one of the values in the form were invalid
                    $this->view->registerTemplate(TEMPLATE_DIR . "/add_patient_doctor_template.php");
                    $this->view->importVar("doctor", $_POST);
                    $this->view->importVar("id", $_POST["id"]);
                    $this->view->importVar("error", $result["error"]);
                } else { // form data was validated
                    $result = $this->model->add([
                        "Role" => $_POST["Role"],
                        "FirstName" => $_POST["FirstName"],
                        "LastName" => $_POST["LastName"],
                        "NationalID" => $_POST["id"]
                    ]);
                    if (isset($result["error"])) { // some error adding (no doctor by that descripton or sql error)
                        $this->view->registerTemplate(TEMPLATE_DIR . "/add_patient_doctor_template.php");
                        $this->view->importVar("doctor", $_POST);
                        $this->view->importVar("id", $_POST["id"]);
                        $this->view->importVar("error", $result["error"]);
                    } else // all things are ok (doctor added) ... return them to view doctors 
                        $this->loadDoctors($_POST["id"]);
                }
            } else // Simply viewing the doctors assigned to patient
                $this->loadDoctors($_GET["id"]);

            $this->view->display();
        }

        private function loadDoctors($id) {
            $this->view->importVar("doctors", $this->model->find(["NationalID" => $id]));
            $this->view->importVar("id", $id);
        }
    }
?>