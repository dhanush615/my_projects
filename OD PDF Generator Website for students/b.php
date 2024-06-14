<?php
require_once('tcpdf/tcpdf.php'); // Include TCPDF library

// Create a new PDF instance
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document properties
$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('On-Duty Leave Application');
$pdf->SetSubject('Request for On-Duty Leave');

// Add a page
$pdf->AddPage();

// Function to generate the PDF content dynamically
function generatePDFContent($pdf, $postData) {
  // School letterhead (replace with your actual letterhead content)
  $pdf->Cell(0, 10, 'SRI KRISHNA ARTS AND SCIENCE COLLEGE, 0, 1, 'C', true);
  $pdf->Cell(0, 5, 'Kunniyamuthur, Coimbatore', 0, 1, 'C');
  $pdf->Cell(0, 10, date('d/m/Y'), 0, 1, 'C');  // Today's date

  // Subject line
  $pdf->Cell(0, 10, 'Subject: Request for On-Duty Leave for ' . $postData['eventName'], 0, 1, 'L', true);

  // Body of the letter (replace placeholders with user input)
  $pdf->Cell(0, 5, 'Respected Sir,', 0, 1, 'L');

  $pdf->Write(0, "My name is " . $postData['studentName'] . ". I am a student of class " . $postData['class'] . " (" . $postData['section'] . "). I've been chosen to compete in the " . $postData['eventName'] . " competitions, which will take place on " . $postData['eventDate'] . ".");

  $pdf->Write(0, "\nTo represent the school and take part in the competitions, I need an attested on-duty application. I humbly request that you grant me a leave of absence for this day and issue a genuine certificate and an application for on-duty status so that I won't lose my attendance. I will be grateful for your help.");

  $pdf->Write(0, "\nThanking You,\nYours Obediently,\n" . $postData['studentName'] . "\nRoll No. - " . $postData['rollNo'] . "\nDepartment: " . $postData['department'] . ", Degree: " . $postData['degree'] . ", Year: " . $postData['year'] . "\nClass- " . $postData['class'] . " (" . $postData['section'] . ")");

  // Add any additional content or formatting as needed
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Collect form data
  $postData = array(
    'studentName' => $_POST['studentName'],
    'eventName' => $_POST['eventName'],
    'eventDate' => $_POST['eventDate'],
    'rollNo' => $_POST['rollNo'],
    'department' => $_POST['department'],
    'degree' => $_POST['degree'],
    'year' => $_POST['year'],
    'class' => $_POST['class'],
    'section' => $_POST['section']
  );

  // Call the function to generate the PDF content
  generatePDFContent($pdf, $postData);

  // Output the PDF
  $pdf->Output('on_duty_leave_application.pdf', 'I'); // 'I' to display in browser, 'D' to download
}
?>
