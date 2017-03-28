<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WSDL To PHP Classes</title>
    <link rel="stylesheet" href="<?php echo url('/'); ?>/libs/bootstrap/dist/css/bootstrap.min.css">
    <style>
        body{
            background-image: url('images/lightbg.jpg');
            background-size: cover;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">WSDL To PHP Classes</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../navbar-fixed-top/">Contact Me</a></li>
                <li><a href="../navbar-fixed-top/">Project On GitHub</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

    <div class="row header">
        <div class="col-md-offset-2 col-md-8">
            <h2 style="font-family: cursive;">WSDL To PHP Classes</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <p>Upload your WSDL file only. We will generate your classes and return back a downloadable zip file.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="panel panel-default">
                <form action="submit" method="POST" enctype="multipart/form-data">
                    <div class="panel-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">Namespace</label>
                                <input name="namespaece" type="text" class="form-control" id="txtNamespace"
                                       aria-describedby="nameSpaceHelp"
                                       placeholder="Enter Namespace"
                                       value="<?php echo old('namespaece'); ?>"
                                       required>
                                <small id="nameSpaceHelp" class="form-text text-muted">Enter Name space
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">WSDL File</label>
                                <input id="wsdlfile" name="wsdlfile" type="file" placeholder="WSDL File"
                                       class="form-control input-md" required>
                                <small id="nameSpaceHelp" class="form-text text-muted">WSDL File
                                </small>
                            </div>

                        </div>
                    </div>
                    <br><br>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <input type="submit" value="Generate Classes" class="btn btn-primary pull-right">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="container-fluid" style="padding: 0px;">
    <style>
        .bd-footer {
            padding: 4rem 0;
            margin-top: 4rem;
            font-size: 85%;
            text-align: center;
            background-color: #f7f7f7;
        }
    </style>
    <footer class="bd-footer">
        <div class="container">
            <p>All Rights Reserved. Copyright @ 2017</p>
            <p>www.wsdltoclass.com</p>

        </div>
    </footer>
</div>

</body>
</html>