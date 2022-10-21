<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        crossorigin="anonymous">

    <style>
        body {

            background-color: #eee;
        }

        .card {

            background-color: #fff;
            padding: 15px;
            border: none;
        }

        .input-box {
            position: relative;
        }

        .input-box i {
            position: absolute;
            right: 13px;
            top: 15px;
            color: #ced4da;

        }

        .form-control {

            height: 50px;
            background-color: #eeeeee69;
        }

        .form-control:focus {
            background-color: #eeeeee69;
            box-shadow: none;
            border-color: #eee;
        }


        .list {

            padding-top: 20px;
            padding-bottom: 10px;
            display: flex;
            align-items: center;

        }

        .border-bottom {

            border-bottom: 2px solid #eee;
        }

        .list i {
            font-size: 19px;
            color: red;
        }

        .list small {

            color: #dedddd;
        }
    </style>
</head>

<body class="antialiased">
    <div class="container mt-5">

        <div class="row d-flex justify-content-center ">

            <div class="col-md-6">

                <div class="card">

                    <div class="input-box">
                        <input type="text" class="form-control">
                        <i class="fa fa-search"></i>
                    </div>


                    <div class="list border-bottom">

                        <i class="fa fa-fire"></i>
                        <div class="d-flex flex-column ml-3">
                            <span>Client communication policy</span>
                            <small>#politics - may - @max</small>
                        </div>
                    </div>


                    <div class="list border-bottom">

                        <i class="fa fa-yelp"></i>
                        <div class="d-flex flex-column ml-3">
                            <span>Major activity done</span>
                            <small>#news - nov - @settings</small>
                        </div>
                    </div>




                    <div class="list border-bottom">

                        <i class="fa fa-fire"></i>
                        <div class="d-flex flex-column ml-3">
                            <span>Calling to USA Clients</span>
                            <small>#entertainment - dec - @tunes</small>
                        </div>
                    </div>




                    <div class="list">

                        <i class="fa fa-weibo"></i>
                        <div class="d-flex flex-column ml-3">
                            <span>Client communication policy</span>
                            <small>#politics - may - @max</small>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</body>

</html>
