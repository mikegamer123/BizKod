<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Admin - dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
</head>
<body>

<header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow" style="background-color: #00aeef">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><img src="/storage/infostud_connect.png" class="img-fluid px-5" alt="infostud_connect logo"></a>
    <button class="navbar-dark bg-dark navbar-toggler d-md-none collapsed m-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon navbar-dark bg-dark"></span>
    </button>
    <input class="form-control form-control-dark w-100 m-2 p-2 border border-dark" type="text" placeholder="Search..." aria-label="Search">
    <div class="navbar-nav">
        <div class="nav-item text-nowrap p-2">
            <button class="btn btn-dark p-2">Sign out</button>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse" style="background-color: rgba(196,192,192,0.68)">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item rounded" style="background-color: #ed0c6e">
                        <a class="nav-link active" aria-current="page" href="/adminDashboard">
                            <b style="color: rgb(255,255,255)">Dashboard</b>
                        </a>
                    </li>
                    <li class="nav-item pt-4">
                        <a class="nav-link" href="./createUser">
                            <p style="color: #000000">Create user</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./user">
                            <p style="color: #000000">Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./review">
                            <p style="color: rgba(0,0,0,0.97)">Reviews</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./events.php">
                            <p style="color: #000000">Events</p>
                        </a>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <div>
                <div class="d-flex justify-content-center">
                    <h1 class="h2 py-4"><b>Reviews</b></h1>
                </div>
                <hr>


                <div class="row">
                    <div class="d-flex justify-content-center">
                        <div class="col-12 col-md-8 col-xl-6d">
                            <table class="table table-dark table-striped">
                                @foreach($reviews as $review)
                                <tr><td>{{\App\Models\POI::where("id",$review->poi_id)->first()->name}}</td><td>@for($i=0;$i<$review->rating;$i++)*@endfor</td><td>
                                    {{$review->comment}}</td></tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>


<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
</body>
</html>
