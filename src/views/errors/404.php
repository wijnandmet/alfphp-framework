<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error 404</title>
    <style type="text/css">
        body {
            font-family: sans-serif;
            margin: 0;
        }
        main {
            max-width: 840px;
            margin: 0 auto;
        }
        thead {
            font-weight: 600;
        }
        p {
            color: red;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <main>
        <h1>404 Error</h1>

        <p><?php echo $error->getMessage();?></p>

        <table>
            <thead>
                <tr>
                    <td>File</td>
                    <td>Line</td>
                    <td>Class</td>
                    <td>Method</td>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($error->getTrace() as $error) {
                    echo '<tr>';
                    echo '<td>' . $error['file'] . '</td>';
                    echo '<td>' . $error['line'] . '</td>';
                    echo '<td>' . $error['class'] . '</td>';
                    echo '<td>' . $error['function'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>