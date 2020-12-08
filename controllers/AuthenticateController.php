<?php
    class AuthenticateController extends AbstractController {

        protected function makeModel() : Model {
            return new AuthenticateModel(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            //useless...but must return to satisfy return type
            return new View();
        }

        public function start() {
            $this->model = $this->makeModel();
            session_start();
        }

        public function loginUser(array $post) {
            $result = $this->model->find($post);

            if (!isset($result["error"])) {
                date_default_timezone_set("America/Barbados");
                $session_user = array(
                    "fname" => $result["FirstName"],
                    "lname" => $result["LastName"],
                    "role" => $result["Role"],
                    "id" => $result["PersonnelID"],
                    /*the time the user logged in (format yyyy/dd/mm hh:mm:ss)*/
                    "time" => date("Y/m/d H:i:s"),
                );
                
                $_SESSION["current_user"] = $session_user;
                header("Location: dashboard.php");
            }
        }

        public function logOutUser() {
            $_SESSION["current_user"] = null;
            header("Location: index.php");
        }

        public function isUserLoggedIn() : bool {
            return (isset($_SESSION) && isset($_SESSION["current_user"]));
        }

        public function getUserInfo(string $field) : string {
            switch ($field) {
                case "fname":
                case "lname":
                case "role":
                case "time":
                case "id":
                    return $_SESSION["current_user"][$field];
                default:
                    return null;
            }
        }
    }
?>