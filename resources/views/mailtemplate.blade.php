<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tutorial Laravel Mail | ayongoding.com</title>
</head>

<body>
    <p>Hallo <b>{{ $details['nama'] }}</b>Test Email 🙌</p>
    <table>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $details['nama'] }} >☠</td>
        </tr>
        <tr>
            <td>Website</td>
            <td>:</td>
            <td>{{ $details['website'] }}</td>
        </tr>
        <tr>
            <td>Komentar</td>
            <td>:</td>
            <td>{{ $details['Deskripsi'] }}</td>
        </tr>
    </table>
    <p>Terimakasih <b>{{ $details['nama'] }}</b> Email Anda Terkirim ✈</p>
</body>

</html>
