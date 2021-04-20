<header>
    <h1>Hei, <?=$name?> ønsker å få kontakt med deg!</h1>
</header>
<main>
    <p><?=$body?></p>
    <? if(isset($extra)): ?>
        <p>Noe annet: <?=$extra?></p>
    <? endif; ?>
</main>
<footer>
    <p><?=$name?> kan kontaktes på <a href="mailto:<?=$replyto?>"><?=$replyto?></a></p>
</footer>
