<?php
require_once "./include_conf.php";
include_once "./functions.php";

$graph      = isset($_GET['g'])  ? "&g=" . $_GET['g'] : "";
$metric     = isset($_GET['m']) ? "&m=" . $_GET['m'] : "";
$sourcetime = isset($_GET['st']) ? sanitize($_GET['st']) : NULL;
$env        = isset($_GET['env']) ? $_GET['env'] : $conf['graphite_default_env'];

$host       = isset($_GET['h']) ? $_GET['h'] : $conf['cluster_hostname'];
if ( $host == "\*" )
    $host = "*";

$cluster = isset($_GET['c']) ? sanitize($_GET['c']) : "*";
if ( $cluster == "\*" )
    $cluster = "*";

include_once "./header.php";

foreach ($conf["graph_all_periods_timeframes"] as $tf) {
    $graph_args = get_graph_domainname() . "/graph.php?${graph}${metric}&env=${env}&h=${host}&c=${cluster}&st=${tf}+ago";
    print "<a href=\"${graph_args}&z=xlarge\"><img src=\"${graph_args}&z=large\" /></a>";
}

include_once "./footer.php";
?>
