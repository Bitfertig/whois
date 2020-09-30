<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whois</title>
</head>
<body>

    <h1>Whois</h1>
    <p>Domain age and Nameserver.</p>


    <form action="" method="post" onsubmit="this.querySelector('#action').value = 'ok';">
        <input type="hidden" name="action" id="action" value="">
        <input type="text" name="query" value="<?= htmlspecialchars($_POST['query'] ?? '') ?>"><br>
        <input type="submit">
    </form>

<?php if ( !empty($_POST['action']) && $_POST['action'] == 'ok' && !empty($_POST['query']) ) { ?>

    <?php
    $query = $_POST['query']; // 'devone.com';
    include './phpWhois.org/src/whois.main.php';
    $whois = new Whois();
    $result = $whois->Lookup($query,false);
    #echo '<pre>'; print_r($result); echo '</pre>';
    ?>

    <div>
        <table>
            <tr>
                <th>Domain</th>
                <th>Created</th>
                <th>NServer</th>
            </tr>
            <tr>
                <td><?= $result['regrinfo']['domain']['name'] ?? '' ?></td>
                <td><?= $result['regrinfo']['domain']['created'] ?? '' ?></td>
                <td><?= implode('<br>', $result['regrinfo']['domain']['nserver'] ?? []) ?></td>
            </tr>
        </table>
    </div>

<?php } ?>


</body>
</html>