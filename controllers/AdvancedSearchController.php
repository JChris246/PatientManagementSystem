<?php 
    class AdvancedSearchController extends AbstractController {
        protected function makeModel() : Model {
            //useless...but must return to satisfy return type
            return new Model(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            $v = new View();
            $v->registerTemplate(TEMPLATE_DIR . "/advanced_search_template.php");
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
            $this->view->display();
        }
    }
?>