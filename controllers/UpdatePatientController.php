<?php 
    class UpdatePatientController extends AbstractController {
        protected function makeModel() : Model {
            return new UpdatePatientModel(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            $v = new View();
            $v->registerTemplate(TEMPLATE_DIR . "/update_patient_template.php");
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

            if (isset($_POST) && isset($_POST["NationalID"])) {
                unset($_POST["newpatient"]);
                $validater = new ValidateController();
                $errors = $validater->validatePatient($_POST);
                if (!$validater->errorFree($errors, true)) {
                    // redisplay page with error messages
                    $this->view->importVar("error", $errors);
                    $this->view->importVar("patient", $_POST);
                } else {
                    $this->model = $this->makeModel();
                    if (isset($_SESSION) && isset($_SESSION["ogpatient"])) {
                        $currentpatient = $this->model->find(["NationalID" => $id])[0];
                        if ($_SESSION["ogpatient"] == $currentpatient) // good to go ... no concurrent editing
                            $this->editPatient($_POST);
                        else {
                            // inform user that patient has been edited since they started (and ask if they want to reload the changes)
                            $this->view->registerTemplate(TEMPLATE_DIR . "/update_sync_template.php");
                            $this->view->importVar("id", $id);
                        }
                        unset($_SESSION["ogpatient"]);
                    } else $this->editPatient($_POST); // no check for concurrency .... simply commit changes
                }
            } else if (isset($_GET) && isset($_GET["id"])) {
                //first time editing

                //get copy of patient and store in a var called original patient
                //save users changes to var called patient
                //upon validating that there are no errors load patient from db again and store in newPatient
                //if any values in 'original patien't are diff from 'new patient' ... cause user to not be able to save changes (other user has changed data since current user starting editing)
                //else all values match save var patient to db
                $this->model = $this->makeModel();
                $patient = $this->model->find(["NationalID" => $_GET["id"]])[0];
                $_SESSION["ogpatient"] = $patient;
                // separate AdmissionDate and AdmissionTime to make compatible for display in html
                $tokens = explode(" ", $patient["AdmissionDate"]);
                if (count($tokens) == 2) { // if Admission time was not previously set
                    $patient["AdmissionDate"] = $tokens[0];
                    $patient["AdmissionTime"] = $tokens[1];
                } else $patient["AdmissionDate"] = $tokens[0];
                $this->view->importVar("patient", $patient);
            }
            
            $this->view->display();
        }

        private function editPatient($post) {
            // merge AdmissionDate and AdmissionTime to make AdmissionDate (datetime for db)
            $post["AdmissionDate"] .= " " . $post["AdmissionTime"];
            unset($post["AdmissionTime"]);
            $result = $this->model->update($post);
            header("location: viewPatient.php?id=" . $post["NationalID"]);
        }
    }
?>