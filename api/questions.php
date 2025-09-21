<?php
// api/questions.php
header('Content-Type: application/json');
require_once __DIR__ . '/db.php';

$attempt_id = $_POST['attempt_id'] ?? null;
$categories = $_POST['categories'] ?? [];

if (!$attempt_id || empty($categories)) {
  echo json_encode(['status' => 'error', 'message' => 'لازم تختار قسم واحد على الأقل']);
  exit;
}

try {
  // عدد الأسئلة الكلي
  $totalQuestions = 20;

  // جلب أسئلة عشوائية من الكاتيجوريز المختارة
  $placeholders = implode(',', array_fill(0, count($categories), '?'));
  $stmt = $pdo->prepare("SELECT * FROM questions WHERE category_id IN ($placeholders) ORDER BY RAND() LIMIT $totalQuestions");
  $stmt->execute($categories);
  $questions = $stmt->fetchAll();

  if (!$questions) {
    echo json_encode(['status' => 'error', 'message' => 'لا توجد أسئلة متاحة في هذه الأقسام']);
    exit;
  }

  // نحفظ الأسئلة مؤقتًا في Session
  session_start();
  $_SESSION['quiz'][$attempt_id] = $questions;

  echo json_encode(['status' => 'ok', 'attempt_id' => $attempt_id]);
} catch (Exception $e) {
  echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
