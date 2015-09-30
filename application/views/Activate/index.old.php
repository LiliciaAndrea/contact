<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>千年弦歌 - 成员通讯录</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url()?>static/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?=base_url()?>static/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=base_url()?>static/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=base_url()?>static/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <?php
                if(isset($message['type']) && isset($message['content'])){
                    echo "<div class='login-panel'>";
                        echo "<div class='alert alert-{$message['type']}'>";
                            echo $message['content'];
                        echo "</div>";
                    echo "</div>";
                }
            ?>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">激活</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="<?=site_url('Activate/index')?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="姓名" name="name" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="激活码" name="code" type="text" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">验证</button>
                                <br/>
                                <a href="<?=site_url('Login/login')?>"><button class="btn btn-lg btn-primary btn-block" type="button">返回</button></a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?=base_url()?>static/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url()?>static/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=base_url()?>static/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url()?>static/dist/js/sb-admin-2.js"></script>

</body>

</html>
