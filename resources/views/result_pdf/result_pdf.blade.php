<!DOCTYPE html>
<html>

<head>
    <title>Hasil Kuesioner BDI-ii - {{ $user->name }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <h1>Hasil Kuesioner BDI-ii</h1>
    <p>{{ $date }}</p>

    <p>Name: {{ $user->name }}</p>
    <p>Total Skor: {{ $totalScore }}</p>

    <table class="table table-bordered">
        <tr>
            <th>ITEM</th>
            <th>RESPONSE</th>
            <th>RATING</th>
        </tr>
        @foreach ($detailDiagnosisResult as $ddr)
            <tr>
                <td>{{ $ddr->hdq_sequence }}. {{ $ddr->hdq_name }}</td>
                <td>{{ $ddr->dtq_name }}</td>
                <td>{{ $ddr->score }}</td>
            </tr>
        @endforeach
    </table>

    <small>*<i>Website hanya merekomendasikan dan menyediakan resources. Harap hubungi tenaga
            profesional
            seperti psikolog untuk pemeriksaan lebih lanjut dan berikan file ini apabila diperlukan.</i></small>

</body>

</html>
