<!-- 
Name: Vera Korchemnaya
Description: 
    This is the main view for our application. It displays all the 
    cities that are in our table.
    I used a blade foreach loop to iterate through all the cities. 
    I also used the CDN to bring in stylesheets to be used by the table.
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cities</title>
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-icons.min.css">
</head>

<body>
    <div class="container">
        <h1>Cities in Washington</h1>
        <table class="table table-striped table-hover">
            <tr>
                <th>Name</th>
                <th>State</th>
                <th>Population 2000</th>
                <th>Population 2010</th>
                <th>Population 2020</th>
            </tr>
            @foreach ($city as $cities)
            <tr>
                <td>{{$cities->name}}</td>
                <td>{{$cities->state}}</td>
                <td>{{$cities->population_2000}}</td>
                <td>{{$cities->population_2010}}</td>
                <td>{{$cities->population_2020}}</td>

            </tr>
            @endforeach

        </table>
    </div>
</body>

</html>