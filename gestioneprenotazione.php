<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
        $prezzi = ['antipasto' => 5, 'primo' => 6, 'secondo' => 7];
        $parcheggi = ['non_custodito' => 3, 'custodito' => 5, 'nessuno' => 0];
        $camerieri = ["Manuel", "Giulio", "Ugo", "Dario", "Francesco"];

        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $tavolo = $_POST['tavolo'];
        $orario = $_POST['orario'];
        $note = $_POST['note'];
        $pasti = isset($_POST['pasti']) ? $_POST['pasti'] : [];
        $parcheggio = $_POST['parcheggio'];

        if (empty($pasti) || (count($pasti) == 1 && in_array('antipasto', $pasti))) {
            echo "<h2>Errore nella prenotazione</h2>";
            echo "<p>Non è possibile ordinare solo l'antipasto.</p>";
            echo '<a href="prenotazione.html">Torna alla pagina di prenotazione</a>';
            exit;
        }

        $cameriere = $camerieri[array_rand($camerieri)];

        $prezzo = 0;
        foreach ($pasti as $pasto) {
            $prezzo += $prezzi[$pasto];
        }

        $sconto = (in_array('primo', $pasti) && in_array('secondo', $pasti)) ? 0.10 : 0;
        if (count($pasti) == 3) $sconto = 0.15;

        $prezzo_parcheggio = $parcheggi[$parcheggio];
        $prezzo_totale = $prezzo + $prezzo_parcheggio;
        $prezzo_totale -= $prezzo_totale * $sconto;

        $data_ora = date("d-m-Y H:i");
    ?>

    <h1>Resoconto Prenotazione</h1>
    <table border="1">
        <tr><th>Nome</th><td>
            <?php echo htmlspecialchars($nome); ?>
        </td></tr>
        <tr><th>Cognome</th><td>
            <?php echo htmlspecialchars($cognome); ?>
        </td></tr>
        <tr><th>Tavolo</th><td>
            <?php echo $tavolo; ?>
        </td></tr>
        <tr><th>Orario</th><td>
            <?php echo $orario; ?>
        </td></tr>
        <tr><th>Note</th><td>
            <?php echo htmlspecialchars($note); ?>
        </td></tr>
        <tr><th>Pasti Ordinati</th><td>
            <?php echo $pasti; ?>
        </td></tr>
        <tr><th>Parcheggio</th><td>
            <?php echo ucfirst(str_replace('_', ' ', $parcheggio)); ?>
        </td></tr>
        <tr><th>Cameriere Assegnato</th><td>
            <?php echo $cameriere; ?>
        </td></tr>
        <tr><th>Data e Ora Prenotazione</th><td>
            <?php echo $data_ora; ?>
        </td></tr>
        <tr><th>Prezzo Totale</th><td>€ 
            <?php echo number_format($prezzo_totale, 2, ',', '.'); ?>
        </td></tr>
    </table>

</body>
</html>
