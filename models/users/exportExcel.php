<?php

require_once "../../vendor/autoload.php";
require_once "../../config/connection.php";
require_once "functions.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$fileName = "userData.xlsx";

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$fields = array("ID", "First Name", "Last Name", "Email", "Username", "Role", "Date Registration");

$columnIndex = 'A';

foreach ($fields as $field) {
  $sheet->setCellValue($columnIndex . '1', $field);
  $sheet->getColumnDimension($columnIndex)->setWidth(20);
  $columnIndex++;
}

$users = getAllUsers();

$row = 2;

foreach ($users as $user) {
  $columnIndex = 'A';

  $lineData = array(
    $user->idUser,
    $user->firstName,
    $user->lastName,
    $user->email,
    $user->username,
    $user->name,
    $user->dateRegistration
  );

  foreach ($lineData as $data) {
    $sheet->setCellValue($columnIndex . $row, $data);
    $columnIndex++;
  }

  $row++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $fileName . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

exit();
