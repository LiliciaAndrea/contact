<body>
<header class="pg-header">
    <img src="<?=base_url()?>static/img/logo2.png" id="logo">
    <span></span>
    <form id="searched" action="<?=site_url('Search/index')?>" method="get">
        <label for="search">查找联系人</label>
        <input type="text" name="submitted" id="search">
        <!--<input type="hidden" name="role" value = '0'>
        <input type="hidden" name="sex" value = '0'>-->
    </form>
    <div id="dispatcher"></div>
</header>       
<main id="wrapper">
    <section class="query-section">
        <header class="sec-header">
            <span>
                查询结果
                <span class="meta">(点姓名查看信息)</span>
            </span>
            <form action="<?=site_url('Search/index')?>" method="get">
                <select name="role">
                <option value="0">全部</option>
                <?php foreach($role_kind as $role_item):?>
                    <option value="<?=$role_item['id']?>"><?=$role_item['name']?></option>
                <?php endforeach;?>
                </select>
                <select name="sex">
                    <option value="0">全部</option>
                    <option value="1">男</option>
                    <option value="2">女</option>
                </select>
                <input type="hidden" name="submitted" >
                <input type="submit" name="Submit" value="查询">
            </form>
        </header>
        <div class="ctn-wrapper ctn-table ctn-table-head">
            <div class="ctn-text">
                姓名
            </div>
            <div class="ctn-text">
                电话
            </div>
            <div class="ctn-text">
                岗位
            </div>
        </div>
        <?php foreach ($content as $content_item): ?>
        <div class="ctn-wrapper ctn-table">
            <div class="ctn-text">
                <a href="<?php echo base_url().'index.php/Search/get_detail?id='.$content_item['id'];?>" target="_blank">
                    <?=$content_item['name']?>
                </a>
            </div>
            <div class="ctn-text">
                <?=$content_item['phone']?>
            </div>
            <div class="ctn-text">
                <?=$content_item['role']?>
            </div>
        </div>
        <?endforeach;?>
        <p>
                        <!--<a href="<?=base_url()?>index.php/Search/<?=$download?>">下载当前详细信息</a>-->
                        共<?=$page['count_page']?>页&nbsp当前第<?=$page['now_page']?>页&nbsp
                        <?php
                            if(isset($page['lpage1']))
                                echo '<a href="'.$page['url'].$page['lpage1'].'">'.'上一页'.'</a>';
                            if(isset($page['npage1']))
                               echo '<a href="'.$page['url'].$page['npage1'].'">'.'下一页'.'</a>'; 
                        ?>
                    </p>
    </section>
</main>
</body>
</html>