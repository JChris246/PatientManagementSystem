<?php 

    class IndexController extends AbstractController {
        private $error = "";
        private $user = "";

        protected function makeModel() : Model {
            //useless...but must return to satisfy return type
            return new Model(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            $v = new View();
            $v->registerTemplate(TEMPLATE_DIR . "/index_template.php");
            return $v;
        }

        public function start() {
            $authenticator = new AuthenticateController();
            $authenticator->start();
            if ($authenticator->isUserLoggedIn())
                header("Location: dashboard.php");

            $this->view = $this->makeView();
            $this->view->importVar("error", $this->error);
            $this->view->importVar("user", $this->user);
            $this->view->display();
        }

        public function setError($error) {
            $this->error = $error;
        }

        public function setUser($user) {
            $this->user = $user;
        }
    }
?>