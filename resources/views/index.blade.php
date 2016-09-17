<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WSDL To PHP Classes</title>
    <link rel="stylesheet" href="<?php echo url('/'); ?>/libs/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="header">
        <h2>WSDL To PHP Classes</h2>
    </div>
    <div class="row">
        <div class=" col-md-7">
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
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="submit" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">Namespace</label>
                                <input name="namespaece" type="text" class="form-control" id="txtNamespace"
                                       aria-describedby="nameSpaceHelp"
                                       placeholder="Enter Namespace"
                                       value="<?php echo old('namespaece'); ?>">
                                <small id="nameSpaceHelp" class="form-text text-muted">Enter Name space
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">WSDL File</label>
                                <input id="wsdlfile" name="wsdlfile" type="file" placeholder="WSDL File"
                                       class="form-control input-md">
                                <small id="nameSpaceHelp" class="form-text text-muted">WSDL File
                                </small>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <input type="submit" value="submit" class="btn btn-primary pull-right">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>