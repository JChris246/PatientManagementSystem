<?php 
    class AddUserController extends AbstractController {
        protected function makeModel() : Model {
            return new AddUserModel(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            $v = new View();
            $v->registerTemplate(TEMPLATE_DIR . "/add_user_template.php");
            return $v;
        }

        public function start() {

            $this->view = $this->makeView();
            if (array_key_exists('add', $_POST)) { // if post comes from adduser.php
                if ($_POST["add"] != "true") { //no js enabled
                    $validator = new ValidateController();
                    $result = $validator->checkNewUser($_POST);
                    if (isset($result["error"])) {
                        $this->view->importVar("error", $result["error"]);
                        $this->view->importVar("user", $_POST);
                    } else $this->add($_POST);
                } else
                    $this->add($_POST);
            }

            $this->view->display();
        }

        private function add(array $post) {
            $this->model = $this->makeModel();
            $post["Pass"] = password_hash($post["Pass"], PASSWORD_BCRYPT);
            $result = $this->model->add($post);
            $this->view->registerTemplate(TEMPLATE_DIR . "/add_user_result_template.php");
            if (isset($result["error"]))
                $this->view->importVar("error", $result["error"]);
        }
    }
?>