<?php
$tasks = [
    [
        'title'             => 'Wdrożenie systemu logowania JWT',
        'category'          => 'Praca',
        'priority'          => 'wysoki',
        'status'            => 'w trakcie',
        'estimated_minutes' => 240,
        'tags'              => ['backend', 'pilne'],
    ],
    [
        'title'             => 'Zakupy tygodniowe',
        'category'          => 'Dom',
        'priority'          => 'niski',
        'status'            => 'do zrobienia',
        'estimated_minutes' => 60,
        'tags'              => ['dom', 'zakupy'],
    ],
    [
        'title'             => 'Nauka CSS Grid i Flexbox',
        'category'          => 'Nauka',
        'priority'          => 'średni',
        'status'            => 'w trakcie',
        'estimated_minutes' => 90,
        'tags'              => ['frontend'],
    ],
    [
        'title'             => 'Wizyta kontrolna u lekarza',
        'category'          => 'Zdrowie',
        'priority'          => 'wysoki',
        'status'            => 'zakończone',
        'estimated_minutes' => 45,
        'tags'              => ['pilne'],
    ],
];

$valid_categories = ['Praca', 'Dom', 'Nauka', 'Zdrowie', 'Inne'];
$valid_priorities  = ['niski', 'średni', 'wysoki'];
$valid_statuses    = ['do zrobienia', 'w trakcie', 'zakończone'];
$all_tags          = ['pilne', 'zespół', 'backend', 'frontend', 'dom', 'zakupy'];

$errors = [];
$form = [
    'title'             => '',
    'category'          => '',
    'priority'          => '',
    'status'            => '',
    'estimated_minutes' => '',
    'tags'              => [],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title             = trim($_POST['title'] ?? '');
    $category          = trim($_POST['category'] ?? '');
    $priority          = trim($_POST['priority'] ?? '');
    $status            = trim($_POST['status'] ?? '');
    $estimated_minutes = trim($_POST['estimated_minutes'] ?? '');
    $tags              = $_POST['tags'] ?? [];

    $form = [
        'title'             => $title,
        'category'          => $category,
        'priority'          => $priority,
        'status'            => $status,
        'estimated_minutes' => $estimated_minutes,
        'tags'              => $tags,
    ];

    if ($title === '') {
        $errors[] = 'Tytuł nie może być pusty.';
    }

    if (!is_numeric($estimated_minutes) || (float)$estimated_minutes <= 0) {
        $errors[] = 'Szacowany czas musi być liczbą dodatnią.';
    }

    if (empty($tags)) {
        $errors[] = 'Musisz wybrać co najmniej jeden tag.';
    }

    if (!in_array($category, $valid_categories, true)) {
        $errors[] = 'Wartość pola Kategoria jest nieprawidłowa.';
    }

    if (!in_array($priority, $valid_priorities, true)) {
        $errors[] = 'Wartość pola Priorytet jest nieprawidłowa.';
    }

    if (!in_array($status, $valid_statuses, true)) {
        $errors[] = 'Wartość pola Status jest nieprawidłowa.';
    }

    if (empty($errors)) {
        $clean_tags = array_values(array_filter($tags, fn($t) => trim($t) !== ''));
        sort($clean_tags);

        $tasks[] = [
            'title'             => $title,
            'category'          => $category,
            'priority'          => $priority,
            'status'            => $status,
            'estimated_minutes' => (int)$estimated_minutes,
            'tags'              => $clean_tags,
        ];
    }
}

$total_tasks   = count($tasks);
$todo_count    = count(array_filter($tasks, fn($t) => $t['status'] === 'do zrobienia'));
$done_count    = count(array_filter($tasks, fn($t) => $t['status'] === 'zakończone'));
$total_minutes = array_sum(array_column($tasks, 'estimated_minutes'));
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Menedżer Zadań</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Segoe UI', Tahoma, sans-serif;
      font-size: 14px;
      background: #f0f4f9;
      color: #1e293b;
      line-height: 1.5;
    }
    a { color: inherit; text-decoration: none; }

    .page-header {
      background: #1a2535;
      color: #fff;
      padding: 0 24px;
      height: 56px;
      display: flex;
      align-items: center;
      font-size: 18px;
      font-weight: 700;
      letter-spacing: .3px;
      position: sticky;
      top: 0;
      z-index: 100;
    }
    .layout {
      display: grid;
      grid-template-columns: 290px 1fr;
      grid-template-areas: "sidebar main";
      min-height: calc(100vh - 56px);
    }
    .sidebar {
      grid-area: sidebar;
      background: #fff;
      border-right: 1px solid #e2e8f0;
      padding: 22px 18px 32px;
      position: sticky;
      top: 56px;
      height: calc(100vh - 56px);
      overflow-y: auto;
    }
    .main {
      grid-area: main;
      padding: 22px 26px 40px;
    }

    .sidebar h2 {
      font-size: 14px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .6px;
      color: #64748b;
      margin-bottom: 16px;
      padding-bottom: 10px;
      border-bottom: 2px solid #e8edf4;
    }
    .form-group { margin-bottom: 14px; }
    .form-group label {
      display: block;
      font-size: 12px;
      font-weight: 600;
      color: #475569;
      margin-bottom: 4px;
    }
    .form-group input[type="text"],
    .form-group select {
      width: 100%;
      padding: 8px 10px;
      border: 1px solid #cbd5e1;
      border-radius: 6px;
      font-family: inherit;
      font-size: 13px;
      background: #f8fafc;
      color: #1e293b;
      transition: border-color .15s;
    }
    .form-group input[type="text"]:focus,
    .form-group select:focus {
      outline: none;
      border-color: #2563eb;
      background: #fff;
    }
    .tags-group label.main-label {
      font-size: 12px;
      font-weight: 600;
      color: #475569;
      display: block;
      margin-bottom: 6px;
    }
    .tags-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4px 8px;
    }
    .tags-grid label {
      font-size: 12px;
      display: flex;
      align-items: center;
      gap: 5px;
      cursor: pointer;
      color: #334155;
    }
    .btn-submit {
      width: 100%;
      margin-top: 6px;
      padding: 10px;
      background: #2563eb;
      color: #fff;
      border: none;
      border-radius: 7px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      font-family: inherit;
      transition: background .15s;
    }
    .btn-submit:hover { background: #1d4ed8; }

    .errors {
      background: #fee2e2;
      border: 1px solid #fca5a5;
      border-radius: 8px;
      padding: 12px 16px;
      margin-bottom: 16px;
    }
    .errors p {
      font-size: 13px;
      font-weight: 600;
      color: #dc2626;
      margin-bottom: 6px;
    }
    .errors ul { padding-left: 18px; }
    .errors li { font-size: 12.5px; color: #b91c1c; margin-bottom: 3px; }

    .success-msg {
      background: #dcfce7;
      border: 1px solid #86efac;
      border-radius: 8px;
      padding: 10px 16px;
      margin-bottom: 16px;
      font-size: 13px;
      font-weight: 600;
      color: #15803d;
    }

    .stats-section { margin-bottom: 20px; }
    .stats-section h3 {
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .6px;
      color: #64748b;
      margin-bottom: 10px;
    }
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
    }
    .stat-card {
      background: #fff;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      padding: 14px 12px;
      text-align: center;
    }
    .stat-num {
      display: block;
      font-size: 24px;
      font-weight: 700;
      color: #1e293b;
      line-height: 1;
    }
    .stat-lbl {
      display: block;
      font-size: 11px;
      color: #64748b;
      margin-top: 4px;
    }

    .tasks-section h3 {
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .6px;
      color: #64748b;
      margin-bottom: 10px;
    }
    .task-table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 1px 4px rgba(0,0,0,.07);
    }
    .task-table thead {
      background: #1e293b;
      color: #e2e8f0;
    }
    .task-table th {
      padding: 11px 14px;
      font-size: 11px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: .5px;
      text-align: left;
    }
    .task-table td {
      padding: 10px 14px;
      font-size: 13px;
      border-bottom: 1px solid #f1f5f9;
      vertical-align: middle;
    }
    .task-table tr:last-child td { border-bottom: none; }
    .task-table tr:hover td { background: #f8fafc; }

    .badge {
      display: inline-block;
      padding: 2px 9px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 700;
      color: #fff;
      white-space: nowrap;
    }
    .badge-wysoki  { background: #dc2626; }
    .badge-sredni  { background: #d97706; }
    .badge-niski   { background: #16a34a; }

    .sbadge {
      display: inline-block;
      padding: 2px 9px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 600;
      white-space: nowrap;
    }
    .sbadge-todo     { background: #dbeafe; color: #1d4ed8; }
    .sbadge-progress { background: #fef3c7; color: #b45309; }
    .sbadge-done     { background: #d1fae5; color: #065f46; }

    .tag-list { font-size: 11.5px; color: #475569; }
  </style>
</head>
<body>

<header class="page-header">Menedżer Zadań</header>

<div class="layout">

  <aside class="sidebar">
    <h2>Dodaj zadanie</h2>

    <?php if (!empty($errors)): ?>
      <div class="errors">
        <p>Popraw następujące błędy:</p>
        <ul>
          <?php foreach ($errors as $err): ?>
            <li><?= htmlspecialchars($err) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="POST" action="">

      <div class="form-group">
        <label for="title">Tytuł zadania</label>
        <input type="text" id="title" name="title"
               placeholder="Wpisz tytuł..."
               value="<?= htmlspecialchars($form['title']) ?>" />
      </div>

      <div class="form-group">
        <label for="category">Kategoria</label>
        <select id="category" name="category">
          <option value="">-- wybierz --</option>
          <?php foreach ($valid_categories as $cat): ?>
            <option value="<?= htmlspecialchars($cat) ?>"
              <?= ($form['category'] === $cat) ? 'selected' : '' ?>>
              <?= htmlspecialchars($cat) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="priority">Priorytet</label>
        <select id="priority" name="priority">
          <option value="">-- wybierz --</option>
          <?php foreach ($valid_priorities as $pri): ?>
            <option value="<?= htmlspecialchars($pri) ?>"
              <?= ($form['priority'] === $pri) ? 'selected' : '' ?>>
              <?= htmlspecialchars($pri) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="status">Status</label>
        <select id="status" name="status">
          <?php foreach ($valid_statuses as $sta): ?>
            <option value="<?= htmlspecialchars($sta) ?>"
              <?= ($form['status'] === $sta) ? 'selected' : '' ?>>
              <?= htmlspecialchars($sta) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="estimated_minutes">Szacowany czas (minuty)</label>
        <input type="text" id="estimated_minutes" name="estimated_minutes"
               placeholder="np. 60"
               value="<?= htmlspecialchars($form['estimated_minutes']) ?>" />
      </div>

      <div class="form-group tags-group">
        <label class="main-label">Tagi zadania</label>
        <div class="tags-grid">
          <?php foreach ($all_tags as $tag): ?>
            <label>
              <input type="checkbox" name="tags[]"
                     value="<?= htmlspecialchars($tag) ?>"
                     <?= in_array($tag, $form['tags'], true) ? 'checked' : '' ?> />
              <?= htmlspecialchars($tag) ?>
            </label>
          <?php endforeach; ?>
        </div>
      </div>

      <button type="submit" class="btn-submit">Dodaj zadanie</button>

    </form>
  </aside>

  <main class="main">

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($errors)): ?>
      <div class="success-msg">✓ Zadanie zostało dodane pomyślnie.</div>
    <?php endif; ?>

    <section class="stats-section">
      <h3>Podsumowanie</h3>
      <div class="stats-grid">
        <div class="stat-card">
          <span class="stat-num"><?= $total_tasks ?></span>
          <span class="stat-lbl">Wszystkich zadań</span>
        </div>
        <div class="stat-card">
          <span class="stat-num"><?= $todo_count ?></span>
          <span class="stat-lbl">Do zrobienia</span>
        </div>
        <div class="stat-card">
          <span class="stat-num"><?= $done_count ?></span>
          <span class="stat-lbl">Zakończone</span>
        </div>
        <div class="stat-card">
          <span class="stat-num"><?= $total_minutes ?></span>
          <span class="stat-lbl">Łączny czas (min)</span>
        </div>
      </div>
    </section>

    <section class="tasks-section">
      <h3>Lista zadań (<?= $total_tasks ?>)</h3>
      <table class="task-table">
        <thead>
          <tr>
            <th>Tytuł</th>
            <th>Kategoria</th>
            <th>Priorytet</th>
            <th>Status</th>
            <th>Czas (min)</th>
            <th>Tagi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tasks as $task): ?>
            <?php
              $pri_class = match($task['priority']) {
                  'wysoki' => 'badge-wysoki',
                  'średni' => 'badge-sredni',
                  'niski'  => 'badge-niski',
                  default  => '',
              };
              $sta_class = match($task['status']) {
                  'do zrobienia' => 'sbadge-todo',
                  'w trakcie'    => 'sbadge-progress',
                  'zakończone'   => 'sbadge-done',
                  default        => '',
              };
              $tags_text = implode(', ', $task['tags']);
            ?>
            <tr>
              <td><?= htmlspecialchars($task['title']) ?></td>
              <td><?= htmlspecialchars($task['category']) ?></td>
              <td><span class="badge <?= $pri_class ?>"><?= htmlspecialchars($task['priority']) ?></span></td>
              <td><span class="sbadge <?= $sta_class ?>"><?= htmlspecialchars($task['status']) ?></span></td>
              <td><?= htmlspecialchars((string)$task['estimated_minutes']) ?></td>
              <td><span class="tag-list"><?= htmlspecialchars($tags_text) ?></span></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>

  </main>
</div>

</body>
</html>
