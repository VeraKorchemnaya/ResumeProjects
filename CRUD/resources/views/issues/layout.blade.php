<!-- 
    Name: Vera Korchemnaya
    Description: Layout Page
        - This is the mian layout for create, edit, show, and index
        - Creates a conhesive feel to the application
        - Includes the Spectre style sheets just once
        - Displays success messages
 -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comic Books</title>
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-icons.min.css">
</head>

<body>
    <div class="hero bg-dark hero-sm">
        <div class="hero-body">
            <h1>My Comic Book Collection</h1>
        </div>
    </div>

    <!-- Display success messages -->
    @if (session()->get('success'))
    <div class="toast toast-success">
        <span>{{session()->get('success')}}</span>
    </div>
    @endif

    <!-- Give the page some spacing -->
    <div class="container">
        <br>
        <!-- This is where content is inserted -->
        @yield('content')
        <br>
        <br>
    </div>

</body>

</html>