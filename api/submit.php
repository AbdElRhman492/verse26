<?php
// api/submit.php
header('Content-Type: application/json');
session_start();
require_once __DIR__ . '/db.php';

$attempt_id = $_POST['attempt_id'] ?? null;
$answers = $_POST['answers'] ?? [];

if (!$attempt_id || empty($answers)) {
  echo json_encode(['status' => 'error', 'message' => 'لازم تجاوب على كل الأسئلة']);
  exit;
}

try {
  $pdo->beginTransaction();

  if (!isset($_SESSION['quiz'][$attempt_id])) {
    throw new Exception("الكويز غير موجود");
  }
  $questions = $_SESSION['quiz'][$attempt_id];

  $score = 0;
  $total = count($questions);

  foreach ($questions as $q) {
    $qid = $q['id'];
    $studentAns = $answers[$qid] ?? null;

    if ($studentAns) {
      $isCorrect = ($studentAns === $q['correct_option']) ? 1 : 0;
      if ($isCorrect) $score++;

      $stmt = $pdo->prepare("INSERT INTO quiz_answers (attempt_id, question_id, student_answer, is_correct) VALUES (?, ?, ?, ?)");
      $stmt->execute([$attempt_id, $qid, $studentAns, $isCorrect]);
    }
  }

  $stmt = $pdo->prepare("UPDATE quiz_attempts SET score = ?, duration = ? WHERE id = ?");
  $duration = 0; // نقدر نحسبه بالوقت بعدين
  $stmt->execute([$score, $duration, $attempt_id]);

  $pdo->commit();

  unset($_SESSION['quiz'][$attempt_id]);

  echo json_encode(['status' => 'ok', 'attempt_id' => $attempt_id]);
} catch (Exception $e) {
  $pdo->rollBack();
  echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
