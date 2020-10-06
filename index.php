<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whois</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <div class="container">

        <header class="mt-3">
            <h1 class="text-center">Whois</h1>
            <p class="text-center">Find out domain nameservers and domain age.</p>
        </header>


        <main class="mt-5">

            <form action="" method="post" onsubmit="this.querySelector('#action').value = 'ok';">
                <input type="hidden" name="action" id="action" value="">
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="query">Domain</label>
                        <input type="text" name="query" id="query" class="form-control text-center" value="<?= htmlspecialchars($_POST['query'] ?? '') ?>" placeholder="domain.com" required>
                    </div>
                </div>
                <br>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary">
                </div>
            </form><br><br>

            <?php if ( !empty($_POST['action']) && $_POST['action'] == 'ok' && !empty($_POST['query']) ) { ?>

                <?php
                sleep(1); // Throttling calls a little ...
                $query = $_POST['query']; // 'devone.com';
                include './phpWhois.org/src/whois.main.php';
                $whois = new Whois();
                $result = $whois->Lookup($query,false);
                #echo '<pre>'; print_r($result); echo '</pre>';
                ?>

                <div id="results">
                    <table class="table table-striped border w-100">
                        <tr>
                            <th>Domain</th>
                            <th>Nameserver</th>
                            <th>Created</th>
                        </tr>
                        <tr>
                            <td><?= $result['regrinfo']['domain']['name'] ?? '' ?></td>
                            <td><?= implode('<br>', $result['regrinfo']['domain']['nserver'] ?? []) ?></td>
                            <td><?= $result['regrinfo']['domain']['created'] ?? '' ?></td>
                        </tr>
                    </table>
                </div>

            <?php } ?>

        </main>

    </div>

</body>
</html>