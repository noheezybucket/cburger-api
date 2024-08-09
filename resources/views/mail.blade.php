<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">

        <div class="message">
            <p>Cher {{ $mailData['client_firstname']}} {{$mailData['client_lastname']}} ,</p>
            <p>Merci d’avoir fourni vos coordonnées, votre commande est prête !</p>
            <h4>Résumé de la commande</h4>
            <table>
                <thead>
                    <tr>
                        <th>Article</th>
                        <th>Prix</th>
                        <th>Statut</th>
                    </tr>

                </thead>

                <tbody>
                    <tr>
                        <td>
                            {{$mailData['burger']}}
                        </td>
                        <td>
                            {{$mailData['price']}}
                        </td>
                        <td>
                            {{$mailData['status']}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>