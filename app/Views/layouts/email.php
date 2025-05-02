<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $this->renderSection('title') ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 30px;
        }
        .email-container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        a {
            color: #0066cc;
        }
        h2 {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <?= $this->renderSection('content') ?>
    </div>
</body>
</html>
