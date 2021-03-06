<?php
include_once 'lib/CSVAdapter.php';

$csvAdapter = new CSVAdapter("resources/eventlist.csv");

if (preg_match("/[0-9]+/", basename($_SERVER['REQUEST_URI']), $matches)) {
    $event = $csvAdapter -> getEvent($matches[0]);
        if ($event -> getId() == $matches[0]) {
            $artist = $event ->getArtist();
            $picture = $artist ->getPicturePath();
            echo '<div id = "event">';

            echo <<<EOT
<img src="$picture"></img>
EOT;
            echo '<p>';
            echo '<H1>' . $event -> getName() . '</H1>';
            echo '<H2>' . $event -> getStarttime() . '</H2>';
            echo '<p>' . $artist -> getDescription() . '</p>';
            echo '</div>';
            echo '</p>';
        }
} else {
    $eventList = $csvAdapter -> getEventList();
    foreach ($eventList as $event) {
        $artist = $event -> getArtist();
        echo '<a href="' . $_SERVER['REQUEST_URI'] . "/" . $event -> getId(). '">';
        echo '<div id = "event">';
        echo '<H1>' . $artist -> getName() . '</H1>';
        echo '<H2>' . $event -> getStarttime() . '</H2>';
        echo '<img src="' . $artist -> getThumbnailPath() . '"></img>';
        echo '<p>' . $artist -> getDescription() . '</p>';
        echo '</div>';
        echo '</a>';
    };

}