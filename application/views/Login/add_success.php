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
            <div class="ctn-label">激活码</div>
            <div class="ctn-text"><?=$code?></div>
        </div>
        <div class="ctn-wrapper">
            <a class="ctn-text ctn-btn" href="<?=site_url('Login/index')?>" style="width: 60%">
                返回我的主页
            </a>
        </div>
    </section>
</main>
</body>
</html>