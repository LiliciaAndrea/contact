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
    <link href="<?=base_url()?>static/cat.css" rel="stylesheet">

<!--     <link href="<?=base_url()?>static/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
 -->
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
    <style>
        label {
            height: 3rem;
            line-height: 3rem;
        }
    </style>
</head>

<body class="cat">

    <div class="container main">
        <div class="row cat-g" style="text-alian: left">
            <div class="col-md-1-4"></div>
            <div class="col-md-1-2">
            <?php
                // if(isset($message['type']) && isset($message['content'])){
                //     echo "<div class='>";
                //         echo "<div class='alert alert-{$message['type']}'>";
                //             echo $message['content'];
                //         echo "</div>";
                //     echo "</div>";
                // }
            ?>
            <form role="form" method="post" action="<?=site_url('Activate/regist')?>">
                <div class="card" style="margin-top:5%;">
                    <div class="card-head blue">
                        个人信息
                    </div>
                    <div class="card-body">
                            
                                <div class="form-group cat-g">
                                    <div class="col-md-1-3" style="text-align: right"><label>登陆密码(长度6-12位)</label></div>
                                    <div class="col-md-2-3">
                                    <input class="form-control" placeholder="登陆密码" name="password" type="password" value="" autofocus>
                                    </div>
                                </div>
                                <div class="form-group cat-g">
                                    <div class="col-md-1-3" style="text-align: right"><label>重复密码</label></div>
                                    <div class="col-md-2-3">
                                    <input class="form-control" placeholder="重复密码" name="rpassword" type="password" value="" autofocus>
                                    </div>

                                </div>
                                <div class="form-group cat-g">
                                    <div class="col-md-1-3" style="text-align: right"><label>学号</label></div>
                                    <div class="col-md-2-3">
                                    <input class="form-control" placeholder="学号" name="stuid" type="text" value="<?=set_value('stuid')?>">
                                    </div>

                                </div>
                                <div class="form-group cat-g">
                                    <div class="col-md-1-3" style="text-align: right"><label>性别</label></div>
                                    <div class="col-md-2-3">
                                        <select class="form-control" name="sex" value="<?=set_value('sex')?>">

                                            <option value="">请选择您的性别</option>
                                            <option value="1">男</option>
                                            <option value="2">女</option>
                                        </select>
                                    </div>
                                </div>
                    </div>
                </div>
                <div class="card" style="margin-top:5%;">
                    <div class="card-head blue">
                        学院信息
                    </div>
                    <div class="card-body">
                            
                                <div class="form-group cat-g">
                                    <div class="col-md-1-3" style="text-align: right"><label>学院</label></div>
                                    <div class="col-md-2-3">
                                    <input class="form-control" placeholder="学院" name="college" type="text" value="<?=set_value('college')?>">
                                    </div>

                                </div>
                                <div class="form-group cat-g">
                                    <div class="col-md-1-3" style="text-align: right"><label>专业</label></div>
                                    <div class="col-md-2-3">
                                    <input class="form-control" placeholder="专业" name="major" type="text" value="<?=set_value('major')?>">
                                    </div>

                                </div>
                                <div class="form-group cat-g">
                                    <div class="col-md-1-3" style="text-align: right"><label>班级</label></div>
                                    <div class="col-md-2-3">
                                    <input class="form-control" placeholder="班级" name="class" type="text" value="<?=set_value('class')?>">
                                    </div>

                                </div>
                            
                    </div>
                </div>
                <div class="card" style="margin-top:5%;">
                    <div class="card-head blue">
                        联系方式
                    </div>
                    <div class="card-body">
                            
                                <div class="form-group cat-g">
                                    <div class="col-md-1-3" style="text-align: right"><label>寝室地址</label></div>
                                    <div class="col-md-2-3">
                                    <input class="form-control" placeholder="寝室地址(精确到门牌号)" name="dormitory" type="text" value="<?=set_value('dormitory')?>">
                                </div>

                               </div>
                                <div class="form-group cat-g">
                                    <div class="col-md-1-3" style="text-align: right"><label>手机号码</label></div>
                                    <div class="col-md-2-3">
                                    <input class="form-control" placeholder="手机号码" name="phone" type="text" value="<?=set_value('phone')?>">
                                    </div>

                                </div>
                                <div class="form-group cat-g">
                                    <div class="col-md-1-3" style="text-align: right"><label>QQ号码</label></div>
                                    <div class="col-md-2-3">
                                    <input class="form-control" placeholder="QQ号码" name="qq" type="text" value="<?=set_value('qq')?>">
                                    </div>

                                </div>
                                <div class="form-group cat-g">
                                    <div class="col-md-1-3" style="text-align: right"><label>电子邮箱</label></div>
                                    <div class="col-md-2-3">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" value="<?=set_value('email')?>">
    </div>

                                </div>
                            
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-3" style="padding-bottom:20px;text-align:center">
                    <button type="submit" class="button button-pill button-border-blue button-large">提交注册</button>
                </div>
            </form>
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
