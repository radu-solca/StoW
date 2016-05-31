<?php 
$rating = $story['RATING'];

// echo "($rating)";

// Make it integer:
$stars = round( $rating * 2, 0, PHP_ROUND_HALF_UP);

// Add full stars:
$i = 1;
while ($i <= $stars - 1) {
	$source=App::makeAbsolute("assets/img/star_f.png");
    echo '<img src="'.$source.'" />';
    $i += 2;
}
// Add half star if needed:
if ( $stars & 1 ) {
	$source=App::makeAbsolute("assets/img/star_h.png");
    echo '<img src="'.$source.'" />';
	$i += 2;
}
// Add empty stars if needed
while ($i <= 10){
	$source=App::makeAbsolute("assets/img/star_e.png");
    echo '<img src="'.$source.'" />';
    $i += 2;
}

 ?>