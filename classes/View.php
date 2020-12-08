<?php
    class View {
        private $vars = array();
        private $template = "";

        public function registerTemplate(string $filename) {
            if (empty($filename))
                trigger_error("View error: No file provided", E_USER_ERROR);
            elseif(!file_exists($filename))
                trigger_error("View error: File provided does not exist (" . $filename . ")", E_USER_ERROR);
            else $this->template = $filename;
        }

        public function importVar($name, $value) {
            /*$validator = new Validate();
            if (!$validator->valid($name))
                return false;*/
            $this->vars[$name] = $value;
        }

        public function importVars(array $variables) {
            if (empty($variables))
                trigger_error("Empty var array passed", E_USER_ERROR);
            
            /*$validator = new Validate();
            $stop = false;
            foreach($variables as $key => $value) {
                if (!$validator->valid($name)) {
                    $stop = true;
                    break;
                }
            }
            if ($stop)
                return false;*/
            $this->vars = array_merge($this->vars, $variables);
        }

        public function display() {
            extract($this->vars);
            require($this->template);
        }

        // get screen resolution of client (if javascript is on)
        public static function getResolution() {
            if (isset($_SESSION["screen_width"]) && isset($_SESSION["screen_height"]))
                return ["height" => $_SESSION["screen_height"], "width" => $_SESSION["screen_width"]];
            else if (isset($_REQUEST["width"]) && isset($_REQUEST["height"])) {
                $_SESSION["screen_width"] = $_REQUEST["width"];
                $_SESSION["screen_height"] = $_REQUEST["height"];
                header("Location: " . $_SERVER["PHP_SELF"]);
            } else 
                echo "<script type='text/javascript'>window.location = '" . $_SERVER["PHP_SELF"] . "?width=' + screen.width + '&height=' + screen.height;</script>";
        }

        public static function clearRes() {
            if (isset($_SESSION["screen_width"]))
                unset($_SESSION["screen_width"]);
            if (isset($_SESSION["screen_height"]))
                unset($_SESSION["screen_height"]);
        }
    }
?>