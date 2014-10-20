<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>APPLICATION ERROR</title>

    <style>
        body {
            margin: 0;
            padding: 30px;
            font: 12px/1.5 Helvetica,Arial,Verdana,sans-serif;
        }

        h1 {
            margin: 0;
            font-size: 48px;
            font-weight: normal;
            line-height: 48px;
        }

        strong {
            display: inline-block;
            width: 65px;
        }
    </style>
</head>
<body>
    <h1>APPLICATION ERROR</h1>
    <p>The application could not run because of the following error:</p>

    <h2>Details</h2>
    <div><strong>Type:</strong> <?= $type ?></div>
    <div><strong>Code:</strong> <?= $code ?></div>
    <div><strong>Message:</strong> <?= $message ?></div>
    <div><strong>File:</strong> <?= $file ?></div>
    <div><strong>Line:</strong> <?= $line ?></div>

    <h2>Trace</h2>
    <pre><?= $trace ?></pre>
</body>
</html>
