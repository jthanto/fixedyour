<h1>Heiaaa bloggen</h1>

<? //todo: add categories ?>

<div>
    <p></p>
</div>

<div class="row">

<? foreach($posts as $idx => $post): ?>
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card">
            <img class="card-img-top" src="/img/blog/<?=$post['url']?>.jpg" alt="random image">
            <div class="card-body">
                <h3 class="card-heading"><?=$post['heading']?></h3>
                <p><?=$post['subheading'] ??''?></p>
                <div class="text-end">
                    <div><a href="/blog/article/<?=$post['url']?>">Les alt nå!</a></div>
                </div>
            </div>
            <div class="card-footer small">
                <div class="row">
                    <div class="col-6">
                        <span><?=(new DateTime($post['created']))->format('d.m.Y H:i')?></span><br>
                        <?=$post['updated'] != null ? '<span class="text-muted">'.(new DateTime($post['updated']))->format('d.m.Y H:i').'</span>' : '';?></span>
                    </div>
                    <div class="col-6 text-end">
                        <span><a href="<?=$post['author_url']?>"><?=$post['lastname']?>, <?=$post['firstname']?></a></span><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? endforeach; ?>

</div>

