<?php
$filename = "questions.txt";
$questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Phân nhóm câu hỏi
$grouped_questions = [];
$current_question = [];
foreach ($questions as $line) {
    if (strpos($line, "Câu") === 0) {
        if (!empty($current_question)) {
            $grouped_questions[] = $current_question;
        }
        $current_question = [];
    }
    $current_question[] = $line;
}
if (!empty($current_question)) {
    $grouped_questions[] = $current_question;
}

// Nếu người dùng nộp bài
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answers = [];
    foreach ($questions as $line) {
        if (strpos($line, "ANSWER:") !== false) {
            $answers[] = trim(substr($line, strpos($line, ":") + 1));
        }
    }

    $score = 0;
    foreach ($_POST as $key => $userAnswer) {
        $questionNumber = (int)filter_var($key, FILTER_SANITIZE_NUMBER_INT);
        if (isset($answers[$questionNumber - 1]) && $answers[$questionNumber - 1] === $userAnswer) {
            $score++;
        }
    }

    echo "<div class='alert alert-success text-center mt-4'>";
    echo "Bạn trả lời đúng <strong>$score</strong>/" . count($answers) . " câu.";
    echo "</div>";
    echo "<a href='index.php' class='btn btn-primary mt-3'>Làm lại</a>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Bài trắc nghiệm</title>
</head>
<body class="container mt-5">
    <h1 class="mb-4">Bài tập trắc nghiệm</h1>
    <form method="POST">
        <?php foreach ($grouped_questions as $index => $question): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <strong><?= htmlspecialchars($question[0]) ?></strong>
                </div>
                <div class="card-body">
                    <?php
                    // Hiển thị các đáp án
                    for ($i = 1; $i <= 4; $i++): 
                        $answer = substr($question[$i], 0, 1); // A, B, C, D
                    ?>
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="question<?= $index + 1 ?>" 
                                value="<?= $answer ?>" 
                                id="question<?= $index + 1 . $answer ?>">
                            <label class="form-check-label" for="question<?= $index + 1 . $answer ?>">
                                <?= htmlspecialchars($question[$i]) ?>
                            </label>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-primary">Nộp bài</button>
    </form>
</body>
</html>
