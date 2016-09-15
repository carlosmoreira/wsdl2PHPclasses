<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WSDL To PHP Classes</title>
    <link rel="stylesheet" href="<?php echo url('/'); ?>/libs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo url('/'); ?>/libs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo url('/'); ?>/libs/dropzone/dist/basic.css">
    <link rel="stylesheet" href="<?php echo url('/'); ?>/libs/dropzone/dist/dropzone.css">
    <script src="<?php echo url('/'); ?>/libs/dropzone/dist/min/dropzone.min.js"></script>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>WSDL To PHP Classes</h2>
    </div>
    <div class="row">
        <div class=" col-md-12">
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
            <form class="form-horizontal" action="submit" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Namespace</label>
                            <input name="wsdlfile" type="text" class="form-control" id="txtNamespace"
                                   aria-describedby="nameSpaceHelp"
                                   placeholder="Enter Namespace"
                            value="<?php echo old('wsdlfile'); ?>">
                            <small id="nameSpaceHelp" class="form-text text-muted">Enter Name space
                            </small>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">WSDL File</label>
                            <input id="wsdlfile" name="wsdlfile" type="file" placeholder="WSDL File"
                                   class="form-control input-md">
                            <small id="nameSpaceHelp" class="form-text text-muted">WSDL File
                            </small>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="submit" value="submit" class="btn btn-primary pull-right">
                        </div>
                    </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>