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

    {{-- <div>
        @foreach ($headerQuestions as $headerQuestion)
            <div style="margin-bottom: 14.5px">
                <h5>
                    {{ $headerQuestion->hdq_name }}
                </h5>
                @foreach ($detailQuestions->where('hdq_id', $headerQuestion->hdq_id)->sortBy('dtq_sequence') as $detailQuestion)
                    <p>
                        {{ $detailQuestion->score }}. {{ $detailQuestion->dtq_name }}
                    </p>
                @endforeach
            </div>
        @endforeach
    </div> --}}

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

    <small>*<i>File ini <b>TIDAK</b> berasal dari badan atau tenaga profesional yang resmi. Harap hubungi tenaga
            profesional
            seperti psikolog untuk pemeriksaan lebih lanjut.</i></small>

</body>

</html>
