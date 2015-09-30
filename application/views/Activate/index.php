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
        <form role="form" method="post" action="http://contact.qnxg.net/index.php/Active/index">
            <h2>通讯录</h2>
            <div class="ctn-wrapper">
                <div class="ctn-label">姓名</div>
                <input class="ctn-text" type="text" name="name">
            </div>
            <div class="ctn-wrapper">
                <div class="ctn-label">激活码</div>
                <input class="ctn-text" type="text" name="code">
            </div>
            <div class="ctn-wrapper">
                <input class="ctn-text ctn-btn" type="submit" value="激活">
            </div>
            <div class="ctn-wrapper">
                <a href="<?=site_url('Login/login')?>" class="ctn-text ctn-btn btn-y" type="submit">登录</a>
            </div>
        </form>
    </section>
</main>
</body>
</html>