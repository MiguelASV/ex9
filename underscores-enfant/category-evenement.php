<div id="primary" class="content-area">
    <h2>Nos événements importants cette année</h2>
    <main id="main" style="display: grid; grid-template-columns: repeat(3, 1fr); grid-template-rows: repeat(31, 1fr);">
    <?php
    
    while ( have_posts() ):
        the_post();
        $jour = get_the_date("j");
        $mois = (int)get_the_date("m");
        $gridArea = $jour. '/' . ($mois%3+1) . '/' . ($jour+1) . '/' . (($mois%3+1)+1);

        echo "<h3 style='grid-area:". $gridArea . "'>" . get_the_title() . " " . get_the_date('j m y') . "</h3>";

    endwhile;
    ?>
    </main>
</div>