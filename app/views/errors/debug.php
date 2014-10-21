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

        h2 {
            margin: 20px 0 10px;
        }

        p {
            margin: 0;
        }

        strong {
            display: inline-block;
            width: 65px;
        }

        code {
            display: block;
            border: solid 1px #CCC;
            overflow: auto;
            white-space: nowrap;
        }

        code .highlight {
            background: #FFFCDF;
        }

        code p span {
            display: inline-block;
            padding: 3px 10px;
            background-color: #EFEFEF;
            min-width: 26px;
            text-align: right;
        }

    </style>
</head>
<body>
    <h1>APPLICATION ERROR</h1>
    <p>The application could not run because of the following error:</p>

    <h2>Details</h2>
    <p><strong>Message:</strong> <?= $message ?></p>
    <p><strong>File:</strong> <?= $file ?></p>
    <p><strong>Line:</strong> <?= $line ?></p>

    <h2>Hightlight</h2>
    <code><?= $snippet ?></code>

    <h2>Trace</h2>
    <pre><?= $trace ?></pre>
</body>
</html>
