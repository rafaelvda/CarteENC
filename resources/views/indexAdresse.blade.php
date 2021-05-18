<!-- index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des adresses d'étudiant</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>  </head>
<body>
<div class="container">
    <br />
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br />
    @endif
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Numero</th>
            <th>Rue</th>
            <th>Ville</th>
            <th>Code Postale</th>
        </tr>
        </thead>
        <tbody>

        @foreach($adresse as $adresseE)
            <tr>
                <td>{{$adresseE['numero']}}</td>
                <td>{{$adresseE['rue']}}</td>
                <td>{{$adresseE['ville']}}</td>
                <td>{{$adresseE['codePostale']}}</td>


                <td><a href="{{action('AdresseController@edit', $adresseE['id'])}}" class="btn btn-warning">Modifier</a></td>
                <td>
                    <form action="{{action('AdresseController@destroy', $adresseE['id'])}}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger" type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
