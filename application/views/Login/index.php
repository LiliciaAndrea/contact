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
            <div class="ctn-text"><?=$phone?></div>
        </div>
    </section>
    <section class="ctn-section">
        <header class="sec-header"><span>社交平台信息</span></header>
        <div class="ctn-wrapper">
            <div class="ctn-label">QQ</div>
            <div class="ctn-text"><?=$qq?></div>
        </div>
        <div class="ctn-wrapper">
            <div class="ctn-label">邮箱</div>
            <div class="ctn-text"><?=$email?></div>
        </div>
    </section>
    <section class="ctn-section">
        <header class="sec-header"><span>其他信息</span></header>
        <div class="ctn-wrapper">
            <div class="ctn-label">学号</div>
            <div class="ctn-text"><?=$stuid?></div>
        </div>
        <div class="ctn-wrapper">
            <div class="ctn-label">专业</div>
            <div class="ctn-text"><?=$major?></div>
        </div>
        <div class="ctn-wrapper">
            <div class="ctn-label">寝室</div>
            <div class="ctn-text"><?=$dormitory?></div>
        </div>
        <div class="ctn-wrapper">
            <a class="ctn-text ctn-btn" href="<?=base_url()?>index.php/Login/update">
                修改信息
            </a>
        </div>
    </section>
    <?php if(isset($pid_detail['name'])) {?>
    <section class="ctn-section">
        <header class="sec-header">
            <span>
                推荐人信息
                <span class="meta"><!--(点击姓名查看信息)--></span>
            </span>
        </header>
        <div class="ctn-wrapper ctn-table">
            <div class="ctn-text">
            <a href="<?php echo base_url().'index.php/Search/get_detail?id='.$pid_detail['id'];?>" target="_blank">
                 <?=$pid_detail['name']?>
            </a>
            </div>
            <div class="ctn-text">
                 <?=$pid_detail['role']?>
            </div>
        </div>
    </section>
    <?php } ?>
    <section class="ctn-section">
        <header class="sec-header">
            <span>
                已推荐人信息
                <span class="meta"><!--(点击姓名查看信息)--></span>
            </span>
        </header>
        <?php foreach($pin_detail as $pin_item):?>
        <div class="ctn-wrapper ctn-table">
            <div class="ctn-text">
                <?php if($pin_item['id']!=0){ echo '<a href="'.site_url('Search/get_detail').'?id='.$pin_item['id'].'" target="_blank">';} ?> 
                    <?=$pin_item['name']?>
                <?php if($pin_item['id']!=0){ echo '</a>';} ?>
            </div>
            <div class="ctn-text">
                <?=$pin_item['code']?>
            </div>
        </div>
    <?php endforeach;?>
        <div class="ctn-wrapper">
            <a class="ctn-text ctn-btn" href="<?=site_url('Login/add')?>" style="width: 60%">
                添加推荐
            </a>
        </div>
    </section>
</main>
</body>
</html>