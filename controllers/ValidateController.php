<?php
    class ValidateController extends AbstractController {
        private $loginError;

        protected function makeModel() : Model {
            return new ValidateModel(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            //useless...but must return to satisfy return type
            return new View();
        }

        public function start() {
            $this->model = $this->makeModel();

            if (array_key_exists('index', $_POST)) { //if post comes from index.php
                $_POST["username"] = trim($_POST["username"]);
                $_POST["pass"] = trim($_POST["pass"]);
                if ($_POST["index"] != "true") { //no js enabled
                    if (!$this->checkLogin($_POST) || !$this->areCredentialsValid($_POST)) {
                        $indexController = new IndexController();
                        $indexController->setError($this->loginError);
                        $indexController->setUser($_POST["username"]);
                        $indexController->start();
                    } else {
                        $auth = new AuthenticateController();
                        $auth->start();
                        $auth->LoginUser($_POST);
                    }
                } else { //got here means that js validated the input
                    if (!$this->areCredentialsValid($_POST)) {
                        $indexController = new IndexController();
                        $indexController->setError($this->loginError);
                        $indexController->setUser($_POST["username"]);
                        $indexController->start();
                    } else {
                        $auth = new AuthenticateController();
                        $auth->start();
                        $auth->LoginUser($_POST);
                    }
                }
            }
        }
    
        private function isPasswordValid(string $password): bool {
            if (strlen($password) < 8)
                return FALSE;
    
            //count alpha chars and nums
            $countA = 0;
            $countN = 0;  
    
            for($i = 0; $i < strlen($password); $i++) {
                if ($this->find(alphabet, $password[$i]))
                    $countA++;
                if ($this->find(nums, $password[$i]))
                    $countN++;
            }
            
            if (($countA < 1) || ($countN < 1))
                return FALSE;
            return TRUE; //if you made it this far, requirements met
        }

        public function isIdValid(string $id): bool {
            if (strlen($id) != 10)
                return false;
            for($i = 0; $i < strlen($id); $i++)
                if (!$this->find(nums, $id[$i]))
                    return false;
            return true;
        }

        public function isNameValid(string $name): bool {
            if (strlen($name) < 1)
                return false;
            for($i = 0; $i < strlen($name); $i++)
                if (!$this->find(alphabet, $name[$i]))
                    if ($name[$i] != '-')
                        return false;
            return true;
        }

        public function isValidRole(string $str): bool {
            if (strlen($str) < 1)
                return false;
            for($i = 0; $i < strlen($str); $i++)
                if (!$this->find(alphabet, $str[$i]))
                    if (!$this->find(nums, $str[$i]))
                        if ($str[$i] != '-')
                            return false;
            return true;
        }

        private function isAddressValid(string $addr): bool {
            if (strlen($addr) < 1)
                return false;
            for($i = 0; $i < strlen($addr); $i++) {
                if (!$this->find(alphabet2, $addr[$i]))
                    if (!$this->find(nums, $addr[$i]))
                        return false;
            }
            return true;
        }

        public function isSearchSafe(string $search): bool {
            if (strlen($search) < 1)
                return false;
            for($i = 0; $i < strlen($search); $i++)
                if (!$this->find(alphabet2, $search[$i]))
                    if (!$this->find(nums, $search[$i]))
                        return false;
            return true;
        }

        public function isBloodPressureValid(string $bp) : bool {
            if (strlen($bp) < 1)
                return false;
            for($i = 0; $i < strlen($bp); $i++)
                    if (!$this->find(nums, $bp[$i]))
                        if ($bp[$i] != '/')
                            return false;
            return true;
        }

        private function find(string $charset, string $search) : bool {
            $result = strpos($charset, $search);
            if ($result == 0)
                return true;
            else return $result;
        }

        private function checkLogin(array $user_info) {
            if (isset($user_info)) { //make sure data is not NULL
                //make sure username and pass were passed
                if (array_key_exists('username', $user_info) && array_key_exists('pass', $user_info)) {
                    if (isset($user_info['username']) && !$this->isValidRole($user_info['username'])) {
                        $this->loginError = "Invalid username entered";
                        return FALSE;
                    } else if (isset($user_info['pass']) && !$this->isPasswordValid($user_info['pass'])) {
                        $this->loginError = "Invalid password entered";
                        return FALSE;
                    } else
                        return true;
                } else {
                    $this->loginError = "Invalid login info";
                    return FALSE;
                }
            } else {
                $this->loginError = "No login info provided";
                return FALSE;
            }
        }

        public function checkNewUser(array $new_user) {
            $result = $this->checkDoctor($new_user);
            if (isset($result["error"]))
                return $result;
            else if (isset($new_user["Pass"]) && !$this->isPasswordValid($new_user["Pass"])) //validate password
                return ["error" => "Password should be at least 8 chars and contain letters and numbers"];
            else if (isset($new_user["confirmPass"]) && $new_user["Pass"] != $new_user["confirmPass"])
                return ["error" => "Passwords do not match"];
            else
                return ["Success" => "New User is Valid"];
        }

        public function checkDoctor(array $doctor) {
            if (isset($doctor["Role"]) && !$this->isValidRole($doctor["Role"])) //validate role
                return ["error" => "Invalid Role"];
            else if (isset($doctor["FirstName"]) && !$this->isNameValid($doctor["FirstName"])) //validate First Name
                return ["error" => "Invalid First Name"];
            else if (isset($doctor["LastName"]) && !$this->isNameValid($doctor["LastName"])) //validate Last Name
                return ["error" => "Invalid Last Name"];
            else return ["success" => "Success"];
        }

        private function areCredentialsValid(array $user_info): bool {
            $result = $this->model->find($user_info);

            if (isset($result["error"])) {
                $this->loginError = $result["error"];
                return false;
            } else
                return true;
        }

        public function errorFree(array $errors, $excludeAddTime=false) {
            foreach($errors as $k => $v)
                if ($v && $k != "AdmissionTime")
                    return false;
            return true;
        }

        public function validatePatient(array $post) : array {
            $required_fields = ["NationalID", "Sex", "FirstName", "LastName", "LastName", "OtherNames",
            "DOB", "Address", "Occupation", "PresentingProblems", "Symptoms", "Temperature",
            "Pulse", "Respiration", "BloodPressure", "SpO2", "Investigations", "Diagnosis", 
            "TreatmentPlan", "AdmissionDate", "AdmissionTime", "MaritalStatus"];

            $address_similar = ["Occupation", "PresentingProblems", "Symptoms", "Investigations", 
            "Diagnosis", "TreatmentPlan"];

            $errors = [];

            /* if (isset($post["newpatient"]) && $post["newpatient"] == "true") {
                //js enabled...fields can be assumed to be validated
                for($i = 0; $i < count($required_fields); $i++)
                    $errors = array_merge($errors, [$required_fields[$i] => false]);
            } else { */

                // perform basic validation
                for($i = 0; $i < count($required_fields); $i++)
                    if (!isset($post[$required_fields[$i]]) || strlen($post[$required_fields[$i]]) < 1)
                        $errors = array_merge($errors, [$required_fields[$i] => true]);
                    else $errors = array_merge($errors, [$required_fields[$i] => false]);

                $errors["FirstName"] = !$this->isNameValid($post["FirstName"]);
                $errors["LastName"] = !$this->isNameValid($post["LastName"]);
                $errors["Address"] = !$this->isAddressValid($post["Address"]);
                $errors["BloodPressure"] = !$this->isBloodPressureValid($post["BloodPressure"]);

                for($i = 0; $i < count($address_similar); $i++)
                    $errors[$address_similar[$i]] = !$this->isAddressValid($post[$address_similar[$i]]);

            // }
            return $errors;
        }
    }
?>