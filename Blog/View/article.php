<h1><?=$heading?></h1>
<hr>
<?=!empty($subheading) ? '<h4>'.$subheading.'</h4>' : ''?>
<div class="blog-content">
    <?=$body?>
</div>
<hr>
<div class="text-right">
    <span><a href="<?=$author_url?>"><?=$lastname?>, <?=$firstname?></a> - <?=(new DateTime($created))->format('d.m.Y H:i')?> <?=$updated != null ? '<span class="text-muted">(Endret: '.$updated.')</span>' : '';?></span>
</div>
