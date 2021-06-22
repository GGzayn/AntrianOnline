<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Report Loket / Hari</title>
  </head>
  <body>
  <table class="table table-bordered">
    <thead >
        <tr>
            <th>Nama Petugas</th>
            <th>Nama Loket</th>
            <th>Nama Layanan</th>
            <th>Loket Antrian</th>
            <th>Total Antrian/Hari</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
        <tr>

            <td>{{$row->nama_petugas}}</td>
            <td>{{$row->nama_loket}}</td>
            <td>{{$row->layanan->nama_layanan}}</td>
            <td>
                @if($row->loket_antrian == 1)
                Antrian Online
                @else
                Antrian Offline
                @endif
            </td>
            <td><b>{{$row->count_of_day}}</b></td>
        </tr>
        @endforeach

        </tfoot>
    </table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
  
