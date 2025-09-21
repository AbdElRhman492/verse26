<?php
// api/student.php
header('Content-Type: application/json');
require_once __DIR__ . '/db.php';

$name = $_POST['name'] ?? null;
$phone = $_POST['phone'] ?? null;

if (!$name || !$phone) {
  echo json_encode(['status' => 'error', 'message' => 'الاسم ورقم التليفون مطلوبين']);
  exit;
}

try {
  $pdo->beginTransaction();

  $stmt = $pdo->prepare("INSERT INTO students (name, phone) VALUES (?, ?)");
  $stmt->execute([$name, $phone]);
  $student_id = $pdo->lastInsertId();

  $stmt = $pdo->prepare("INSERT INTO quiz_attempts (student_id, score, duration) VALUES (?, 0, 0)");
  $stmt->execute([$student_id]);
  $attempt_id = $pdo->lastInsertId();

  $pdo->commit();

  echo json_encode(['status' => 'ok', 'student_id' => $student_id, 'attempt_id' => $attempt_id]);
} catch (Exception $e) {
  $pdo->rollBack();
  echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
