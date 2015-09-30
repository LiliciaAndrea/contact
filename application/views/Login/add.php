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
<form action="<?=site_url('Login/add')?>" method="post">
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
            <input class="ctn-text" type="text" name="name" value="">
        </div>
        <div class="ctn-wrapper">
            <div class="ctn-label">岗位</div>
            <select name="role">
                <?php foreach($role_kind as $role_item):?>
                    <option value="<?=$role_item['id']?>"><?=$role_item['name']?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="ctn-wrapper">
            <div class="ctn-label">电话</div>
            <input class="ctn-text" type="text" name="phone" value="">
        </div>
        <div class="ctn-wrapper">
            <input class="ctn-text ctn-btn"  type="submit" value="获取激活码" >
        </div>
    </section>
</main>
</form>
</body>
</html>