<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <link rel="stylesheet" href="<?=base_url()?>static/css/style.css">
    <link rel="stylesheet" href="<?=base_url()?>static/css/normalize.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<header class="pg-header">
    <img src="http://contact.qnxg.net/static/img/logo2.png" id="logo">
    <span></span>
    <div id="dispatcher"></div>
</header>
<main id="wrapper">
    <section id="login" class="ctn-section">
        <form role="form" method="post" action="http://contact.qnxg.net/index.php/Login/login">
            <h2>通讯录</h2>
            <div class="ctn-wrapper">
                <div class="ctn-label">工号</div>
                <input class="ctn-text" type="text" name="username" >
            </div>
            <div class="ctn-wrapper">
                <div class="ctn-label">密码</div>
                <input class="ctn-text" type="password" name="password" >
            </div>
            <div class="ctn-wrapper">
                <input class="ctn-text ctn-btn" type="submit" value="登录" name="submit">
            </div>
            <div class="ctn-wrapper">
                <a class="ctn-text ctn-btn btn-y" href="<?=site_url('Activate/index')?>" type="submit">激活</a>
            </div>
        </form>
    </section>
</main>
</body>
</html>