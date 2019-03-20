<header class="masthead" style="background-image: url('/public/images/home-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>Famous Blog</h1>
                    <span class="subheading">Php blog</span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php if (empty($list)) : ?>
            <p>Список постов пуст</p>
            <?php else : ?>
            <?php foreach ($list as $value) : ?>
            <div class="post-preview">
                <a href="/post/<?php echo $value['id']; ?>">
                    <h2 class="post-title"><?php echo htmlspecialchars($value['name'], ENT_QUOTES); ?></h2>
                    <h5 class="post-subtitle"><?php echo htmlspecialchars($value['description'], ENT_QUOTES); ?></h5>
                </a>
                <p class="post-meta">ID: <?php echo $value['id']; ?></p>
            </div>
            <hr>
            <?php endforeach; ?>
            <div class="clearfix">
                <?php echo $pagination; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div> 