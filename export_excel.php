<?php
require 'vendor/autoload.php';
require 'db.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$query = "SELECT * FROM tbl_visitor ORDER BY vid DESC";
$result = $conn->query($query);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header
$sheet->setCellValue('A1', 'Issue Date');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('C1', 'Mobile');
$sheet->setCellValue('D1', 'Address');
$sheet->setCellValue('E1', 'Floor ID');
$sheet->setCellValue('F1', 'Unit ID');
$sheet->setCellValue('G1', 'In Time');
$sheet->setCellValue('H1', 'Out Time');

// Add data
$rowNum = 2;
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue("A{$rowNum}", $row['issue_date']);
    $sheet->setCellValue("B{$rowNum}", $row['name']);
    $sheet->setCellValue("C{$rowNum}", $row['mobile']);
    $sheet->setCellValue("D{$rowNum}", $row['address']);
    $sheet->setCellValue("E{$rowNum}", $row['floor_id']);
    $sheet->setCellValue("F{$rowNum}", $row['unit_id']);
    $sheet->setCellValue("G{$rowNum}", $row['intime']);
    $sheet->setCellValue("H{$rowNum}", $row['outtime']);
    $rowNum++;
}

// Output Excel
$filename = 'visitor_list.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
