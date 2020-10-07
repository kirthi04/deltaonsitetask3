<?php
session_start();
require 'C:\Users\Kiruthiga Selvam\vendor\autoload.php';
set_time_limit(500);
$session = new SpotifyWebAPI\Session(
  'CLIENT_ID',
  'CLIENT_SECRET',
  'REDIRECT_URI',
  $request
);


$api = new SpotifyWebAPI\SpotifyWebAPI();
$i=0;

if (isset($_GET['code'])) {
    $graph = array();
    function array_push_assoc($array,$key,$value){
        $array[$key] = $value;
        return $array;
           }
    function pushingtothearr($indexval,$keyval){
        $GLOBALS['graph'] = array_push_assoc($GLOBALS['graph'],$indexval,$keyval);
       // print_r(count($GLOBALS['graph']));
    }       
    
    $session->requestAccessToken($_GET['code']);
    $api->setAccessToken($session->getAccessToken());

  //  print_r($api->me());
    $idart =  $_SESSION['artist1'] ;
   
   // $artist = $api->getArtist($idart);

  //echo '<b>' . $artist->name . '</b>';
  $artists = $api->getArtistRelatedArtists($idart);
  foreach ($artists->artists as $artist) {
   // echo '<b>' . $artist->name . '</b> <br>';
    $iterate1[$i] = $artist->id;
    $i++;
}
pushingtothearr($idart,$iterate1);
$i=0;
  for($j=0;$j<(count($iterate1));$j++){
      $k=0;
    $artists = $api->getArtistRelatedArtists($iterate1[$j]);
    foreach ($artists->artists as $artist) {
      //echo '<b>' . $artist->name . '</b> <br>';
      $iterate2[$i] = $artist->id;
      $iteratek[$k] = $artist->id;
      $i++;
      $k++;
  }
  pushingtothearr($iterate1[$j],$iteratek);
  }
 
  $i=0;
 
  for($j=0;$j<(count($iterate2));$j++){
      $m=0;
    $artists = $api->getArtistRelatedArtists($iterate2[$j]);
    foreach ($artists->artists as $artist) {
     // echo '<b>' . $artist->name . '</b> <br>';
      $iterate3[$i] = $artist->id;
      $iteratem[$m] = $artist->id;
      $i++;
      $m++;
  }
  pushingtothearr($iterate2[$j],$iteratem);
  } 
  $i=0;
 /*
  for($j=0;$j<(count($iterate3));$j++){
      $n=0;
    $artists = $api->getArtistRelatedArtists($iterate3[$j]);
    foreach ($artists->artists as $artist) {
     // echo '<b>' . $artist->name . '</b> <br>';
      $iterate4[$i] = $artist->id;
      $iteraten[$n] = $artist->id;
      $i++;
      $n++;
  }
  pushingtothearr($iterate3[$j],$iteraten);
  } */  
} 
else {
    $options = [
        'scope' => [
            'user-read-email',
        ],
    ];

    header('Location: ' . $session->getAuthorizeUrl($options));
    die();
}

?>
<?php
  class Graph
  {
    protected $graph;
    protected $visited = array();
  
    public function __construct($graph) {
      $this->graph = $graph;
    }
 
    public function breadthFirstSearch($origin, $destination) {
    
      foreach ($this->graph as $vertex => $adj) {
        $this->visited[$vertex] = false;
      }
  
      $q = new SplQueue();
  
      $q->enqueue($origin);
      $this->visited[$origin] = true;
      $path = array();
      $path[$origin] = new SplDoublyLinkedList();
      $path[$origin]->setIteratorMode(
        SplDoublyLinkedList::IT_MODE_FIFO|SplDoublyLinkedList::IT_MODE_KEEP
      );
  
      $path[$origin]->push($origin);
  
      $found = false;
      while (!$q->isEmpty() && $q->bottom() != $destination) {
        $t = $q->dequeue();
  
        if (!empty($this->graph[$t])) {
          foreach ($this->graph[$t] as $vertex) {
            if (!$this->visited[$vertex]) {
              $q->enqueue($vertex);
              $this->visited[$vertex] = true;
              $path[$vertex] = clone $path[$t];
              $path[$vertex]->push($vertex);
            }
          }
        }
      }
  
      if (isset($path[$destination])) {
       echo"<div style=' margin-left: 300px; margin-top: 100px; border: 3px solid black; float: left; width: 600px; height: 400px ;  background-color: pink; '>
      <h1 style='text-align: center'> TO GET THE  ARTIST2 FROM ARTIST1 THE SHORTEST PATH IS:</h1> <br>";
        $sep = '';
        foreach ($path[$destination] as $vertex) {
          echo"<h2>";
            echo $sep, $vertex;
            echo"</h2>";
          $sep = '---->';
        }
        echo"</div>";
      }
      else {
        echo "<div style=' margin-left: 300px; margin-top: 200px; border: 3px solid black; float: left; width: 600px; height: 200px ;  background-color: pink; '>
        <h2>No route from $origin to $destination";
        echo"</h2></div>";
      }
    }
  }
  $g = new Graph($graph);
  $idart2 =  $_SESSION['artist2'] ;
    
$g->breadthFirstSearch($idart,$idart2);

?>