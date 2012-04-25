<?php
include_once('functions.php');
$viewhost = $_GET['host'];
$viewport = @$_GET['port'];

$start = "";
if(isset($_GET['duration'])) {
    $start = "&duration=" . $_GET['duration'];
}


?>


<html>
<head>
<title>FITB - View port - <?php echo "$viewhost - $viewport" ?></title>
<link rel="stylesheet" href="fitb.css" type="text/css" media="screen" /> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
</head>

<body>
<?php include_once('header.php'); # includes the <div> for the header ?>
<div id="wrap">
    <?php include_once('side.php'); # includes the <div> for the side bar ?>
    <div id="main">
        <h2>View port - <?php echo "$viewhost - $viewport" ?></h2>
            <?php
            connectToDB();
            $result = pg_query('SELECT * FROM ports WHERE host="' . pg_escape_literal($viewhost). '" AND safename="' . pg_escape_literal($viewport) . '" ORDER BY lastpoll DESC, safename ASC');

            if(pg_num_rows($result) > 0) {

               while ($row = pg_fetch_assoc($result)) {
                    $staletag = "";
                    if ((time() - $row['lastpoll']) > $staleage) {
                        $staletag = "STALE: ";
                    }
                    $friendlytitle = urlencode("{$staletag}{$viewhost} - {$row['name']} ({$row['alias']})");
                    $basegraphurl = "graph.php?host={$viewhost}&rrdname={$viewhost}-{$row['safename']}&type={$row['graphtype']}{$start}&friendlytitle={$friendlytitle}";
                    echo '<a href="view' . $basegraphurl . '">';
                    echo '<img src="' . $basegraphurl . '&height=100&width=400" alt="'.$row['alias'].'"></a>';
                }
            } else {
                echo "This host does not exist, or it has not been polled yet. ";
            }
        ?>

    <div>
</div>


</body>
</html>
