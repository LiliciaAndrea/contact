<body>
<header class="pg-header">
    <img src="<?=base_url()?>static/img/logo2.png" id="logo">
    <span></span>
    <form id="searched" action="<?=site_url('Search/index')?>" method="get" target="_blank">
        <label for="search">查找联系人</label>
        <input type="text" name="submitted" id="search">
        <!--<input type="hidden" name="role" value = '0'>
        <input type="hidden" name="sex" value = '0'>-->
    </form>
    <div id="dispatcher"></div>
</header>
<form action="<?=site_url('Login/update')?>" method="post">
<main id="wrapper">
    <?php
        if(isset($message['content'])){
          echo $message['content'];
        }
    ?>
    <section class="ctn-section">
        <header class="sec-header"><span>基本信息</span></header>
        <div class="ctn-wrapper">
            <div class="ctn-label">姓名</div>
            <div class="ctn-text"><?=$name?></div>
        </div>
        <div class="ctn-wrapper">
            <div class="ctn-label">岗位</div>
            <div class="ctn-text"><?=$role?></div>
        </div>
        <div class="ctn-wrapper">
            <div class="ctn-label">电话</div>
            <input class="ctn-text" type="text" name="phone" value="<?=$phone?>">
        </div>
    </section>
    <section class="ctn-section">
        <header class="sec-header"><span>社交平台信息</span></header>
        <div class="ctn-wrapper">
            <div class="ctn-label">QQ</div>
            <input class="ctn-text" type="text" name="qq" value="<?=$qq?>">
        </div>
        <div class="ctn-wrapper">
            <div class="ctn-label">邮箱</div>
            <input class="ctn-text" type="text" name="email" value="<?=$email?>">
        </div>
    </section>
    <section class="ctn-section">
        <header class="sec-header"><span>其他信息</span></header>
        <div class="ctn-wrapper">
            <div class="ctn-label">学号</div>
            <input class="ctn-text" type="text" name="stuid" value="<?=$stuid?>">
        </div>
        <div class="ctn-wrapper">
            <div class="ctn-label">专业</div>
            <input class="ctn-text" type="text" name="major" value="<?=$major?>">
        </div>
        <div class="ctn-wrapper">
            <div class="ctn-label">寝室</div>
            <input class="ctn-text" type="text" name="dormitory" value="<?=$dormitory?>">
        </div>
        <div class="ctn-wrapper">
            <input class="ctn-text ctn-btn"  type="submit" value="保存信息" >
        </div>
    </section>
</main>
</form>
</body>
</html>