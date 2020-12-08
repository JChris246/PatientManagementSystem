<?php 

    class DischargeController extends AbstractController {

        protected function makeModel() : Model {
            return new UpdatePatientModel(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        }

        protected function makeView() : View {
            $v = new View();
            $v->registerTemplate(TEMPLATE_DIR . "/discharge_template.php");
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

            if (isset($_POST) && isset($_POST["id"]))
                $this->process($_POST["id"]);
            else if (isset($_GET) && isset($_GET["id"]))
                $this->process($_GET["id"]);
            else { // display box to enter id
                $this->view = $this->makeView();
                $this->view->display();
            }
        }

        private function process($id) {
            $validator = new ValidateController();
            if (!$validator->isIdValid($id)) {
                $this->view = $this->makeView();
                $this->view->importVar("error", "Invalid National ID entered");
                $this->view->display();  
            } else {
                $patient = $this->model->find(["NationalID" => $id], "Patient")[0];
                $patient["Active"] = 0; // mark patient as out of hospital

                // in case this data is lacking, add it or update error will occur
                $patient["AdmissionDate"] = date("Y-m-d") . " " . date("H:i");
                if (strlen($patient["MaritalStatus"]) < 1)
                    $patient["MaritalStatus"] = "single";
                $this->model->update($patient, "Patient");
                $this->createPDF($patient);
            }
        }

        private function createPDF(array $patient) {
            require("fpdf182/fpdf.php");

            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->Image('imgs/Queen-Elizabeth-Hospital-Barbados_logo.png',10, 6, 90);
            $pdf->Ln(35);

            $pdf->SetFont('Arial', 'B', 18);
            $pdf->Cell(0, 0, 'Admission Discharge Summary', 0, 1, 'C');
            $pdf->Ln(25);
            $pdf->SetFont('Arial', '', 12);

            $frame = 0;
            date_default_timezone_set("America/Barbados");
            $diff = (new DateTime(date("Y/m/d")))->diff(new DateTime($patient["DOB"]));

            $pdf->Cell(50, 0, "National ID: " . $patient["NationalID"]);
            $pdf->Cell(130, 0, "Hospital No: " . $patient["HospitalRegNo"], $frame, 1, 'R'); $pdf->Ln(15);

            $pdf->Cell(65, 0, "Surname: " . $patient["LastName"], $frame); 
            $pdf->Cell(75, 0, "Date of Birth: " . $patient["DOB"], $frame, 0, 'C'); 
            $pdf->Cell(50, 0, "Age: " . $diff->y, $frame, 0, 'R'); $pdf->Ln(8);

            $pdf->Cell(65, 0, "First Name: " . $patient["FirstName"], $frame);
            $pdf->Cell(75, 0, "Marital Status: " . $patient["MaritalStatus"], $frame, 0, 'C');
            $pdf->Cell(50, 0, "Sex: " . $patient["Sex"], $frame, 0, 'R'); $pdf->Ln(8);

            $pdf->Cell(65, 0, "Other Names: " . $patient["OtherNames"], $frame, 1); $pdf->Ln(8);
            $pdf->Cell(120, 0, "Address: " . $patient["Address"], $frame, 1); $pdf->Ln(15);

            $pdf->Cell(120, 0, "Next of Kin: " . $patient["NextOfKin"], $frame, 1); $pdf->Ln(8);
            $pdf->Cell(120, 0, "Occupation: " . $patient["Occupation"], $frame, 1); $pdf->Ln(15);

            if (count(explode(" ", $patient["AdmissionDate"])) > 1) {
                $pdf->Cell(120, 0, "AdmissionDate: " . explode(" ", $patient["AdmissionDate"])[0], $frame, 1); $pdf->Ln(8);
                $pdf->Cell(120, 0, "AdmissionTime: " . explode(" ", $patient["AdmissionDate"])[1], $frame, 1); $pdf->Ln(15);
            } // else probably dont have date data for admission

            $pdf->Cell(120, 0, "Final Diagnosis: " . $patient["Diagnosis"], $frame, 1); $pdf->Ln(15);

            $pdf->Output();
        }
    }
?>