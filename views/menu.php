<?
$streams = $oo->children($uu->id);

?><ul id="streams"><?
foreach($streams as $s)
{
    $url = $s['url'];
    $name = $s['name1'];
    ?>
    <li><a href="<? echo $url; ?>"><? echo $name; ?></a></li><?
}
?></ul>