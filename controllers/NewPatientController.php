<?php 

    class NewPatientController extends AbstractController {
        private $error = "";
        private static $clear = 2;

        protected function makeModel() : Model {
            return new NewPatientModel(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            $v = new View();
            $v->registerTemplate(TEMPLATE_DIR . "/new_patient_template.php");
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

            if (!isset($_POST["NationalID"])) { //at very min NationalID must exist to add
                $this->view->importVar("error", $this->error);

                //defaults here if you now landing on the page to start entering info
                date_default_timezone_set("America/Barbados");
                $this->view->importVar("datetime", [
                    "time" => date("H:i"),
                    "date" => date("Y-m-d")
                ]);
            } else if (isset($_POST["NationalID"])) { // post sent to add patient
                $this->model = $this->makeModel();
                $validater = new ValidateController();
                $errors = $validater->validatePatient($_POST);
                $dup = false;
                if (!$errors["NationalID"]) // check for duplicate id already existing
                    $dup = $this->handleDuplicateID($_POST["NationalID"]);
                if (!$validater->errorFree($errors)) {
                    // redisplay page with error messages
                    $this->view->importVar("error", $errors);
                    $this->view->importVar("patient", $_POST);
                } else {
                    if (!$dup) { // actually a new patient
                        // merge AdmissionDate and AdmissionTime to make AdmissionDate (datetime for db)
                        $_POST["AdmissionDate"] = $_POST["AdmissionDate"] . " " . $_POST["AdmissionTime"];
                        unset($_POST["AdmissionTime"]);
                        
                        $result = $this->model->add($_POST);
                        $this->model->addDoctor([
                            "PersonnelID" => $authenticator->getUserInfo("id"),
                            "NationalID" => $_POST["NationalID"],
                        ], "AssignedOfficial");
                        if (isset($result["success"]))
                            header("Location: viewPatient.php?id=" . $_POST["NationalID"]);
                        else $this->view->importVar("error", $result["error"]);
                    }
                }
            }

            $this->view->display();
        }

        private function handleDuplicateID(string $id) {
            // if patient already exist
            $p = $this->model->find(["NationalID" => $id]);
            if (count($p) > 0) { // if dup found redirect to page to handle accordingly
                $this->view->registerTemplate(TEMPLATE_DIR . "/add_dup_template.php");
                // If active Ask user if they want to view the patient
                // Else Ask the patient if they want to admit this patient
                $this->view->importVar("active", isset($p["Active"]) && $p["Active"] ? true : false);
                $this->view->importVar("id", $id);
                return true;
            }
            return false;
        }
    }
?>