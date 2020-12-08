<?php 

    class LogOutController extends AbstractController {
        protected function makeModel() : Model {
            // useless...but must return to satisfy return type
            return new Model(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            // useless...but must return to satisfy return type
            return new View();
        }

        public function start() {
            $authenticator = new AuthenticateController();
            $authenticator->start();
            $authenticator->logOutUser();
        }
    }
?>