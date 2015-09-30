<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>千年弦歌 - 成员通讯录</title>

    <!-- CatUI Core CSS -->
    <link href="<?=base_url()?>static/cat.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
<!--     <link href="<?=base_url()?>static/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
 -->
    <!-- Custom CSS -->
<!--     <link href="<?=base_url()?>static/dist/css/sb-admin-2.css" rel="stylesheet">
 -->
    <!-- Custom Fonts -->
<!--     <link href="<?=base_url()?>static/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="cat">

    <div class="container">
        <div class="row">
            <div class="col-md-1-4"></div>
            <div class="col-md-1-2">
                <div class="card card-<?=$message['type']?>">
                            <div class="card-head blue">
                                <?=$message['title']?>
                            </div>
                            <div class="card-body">
                                <p><?=$message['content']?></p>
                                <br/>
                                <?php if(isset($user)){?>
                                    <h2><label>个人信息</label></h2>
                                    <p>工号(登陆名) : <?=$user['username']?></p>
                                    <p>学号 : <?=$user['stuid']?></p>
                                    <p>职位 : <?=$user['role']['name']?></p>
                                    <p>性别 : <?=sex_to_string($user['sex'])?></p>
                                    <h2><label>学院信息</label></h2>
                                    <p>学院 : <?=$user['college']?></p>
                                    <p>专业 : <?=$user['major']?></p>
                                    <p>班级 : <?=$user['class']?></p>
                                    <h2><label>联系方式</label></h2>
                                    <p>寝室地址 : <?=$user['dormitory']?></p>
                                    <p>手机号码 : <?=$user['phone']?></p>
                                    <p>QQ号码 : <?=$user['qq']?></p>
                                    <p>电子邮箱 : <?=$user['email']?></p>
                                <?php }?>
                            </div>
                            <div class="card-footer">
                                <?=$message['title']?>
                            </div>
                </div>
                <div class="row" style="text-align: center">
                        <a href="<?=site_url('Login/login')?>"><button type="button" class="button button-pill button-border-blue button-large">完成</button></a>
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
