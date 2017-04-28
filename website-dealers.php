<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<style type="text/css">
.container {width:80%; margin: 0px auto; padding: 0; max-width:900px; }
 
    textarea { font-family: 'Courier New', monospace; width:100%;}
</style>
</head>
<body>
<?php
 
 
function format_phone_us($phone) {
  // note: making sure we have something
  if(!isset($phone{3})) { return ''; }
  // note: strip out everything but numbers 
  $phone = preg_replace("/[^0-9]/", "", $phone);
  $length = strlen($phone);
  switch($length) {
  case 7:
    return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
  break;
  case 10:
   return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
  break;
  case 11:
  return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "$1($2) $3-$4", $phone);
  break;
  default:
    return $phone;
  break;
  }
}


function format_phone_link($phone) {
  // note: making sure we have something
  if(!isset($phone{3})) { return ''; }
  // note: strip out everything but numbers 
  $phone = preg_replace("/[^0-9]/", "", $phone);
  $length = strlen($phone);
  switch($length) {
  case 7:
    return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
  break;
  case 10:
   return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $phone);
  break;
  case 11:
  return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3-$4", $phone);
  break;
  default:
    return $phone;
  break;
  }
}








//echo "<html><body><table>\n\n";
    $f = fopen("WebsiteListing4.csv", "r") or die();
$array;
$i = 0;
while (($line = fgetcsv($f)) !== false) {
        //echo "<tr>";
		
        foreach ($line as $cell) {
			if ($i != 0) {
                $array[$i][] = html_entity_decode($cell);
                //echo "<td>" . htmlspecialchars($cell) . "</td>";
				
			}
			
        }
		$i++;
        //echo "</tr>\n";
}
fclose($f);
//echo "\n</table></body></html>";
/*
echo "<pre>";
print_r($array);
echo "</pre>";
*/
//echo "<br><br>";


echo "<div class=\"container clearfix\">";
    
	
	foreach ($array as $go) {
		echo "<hr/>";
		$thisGoHTML = '';
		for ($i = 0; $i < count($go); $i++) {
			
			$thisGo = trim($go[$i]);
			if ($thisGo != '') {
				if ($i == 0) {
					$thisGoHTML .= "<strong>".$thisGo."</strong>";
				}
				else if (substr( $thisGo, 0, 1 ) === "(") {
					$thisGoHTML .= "<a target=\"_blank\" href=\"tel:+". format_phone_link($thisGo) 	."\">". format_phone_us($thisGo) ."</a>";
				}
				else if (substr( $thisGo, 0, 3 ) === "www") {
					$thisGoHTML .= "<a target=\"_blank\" href=\"http://". $thisGo 	."\">$thisGo</a>";
				} else {
					$thisGoHTML .= htmlentities($thisGo);
				}
				
				if ($i != ((count($go)-1))) {
						$thisGoHTML .= "<br/>";
				}
			
			
			} // end not empty		
			
		} // end loop
		echo "<div class='row'>";
		echo "<div class='col-sm-6'>".$thisGoHTML."</div>"; 
		echo "<div class='col-sm-6'>".'<textarea rows="6"><div class="col-sm-4 contact-box">'.$thisGoHTML.'</div></textarea>'."<button>Copy</button></div>"; 
			//echo '<textarea rows="6"><div class="col-sm-4 contact-box">'.$thisGoHTML.'</div></textarea>';
			echo "</div>";
	}

echo "</div>\n";
?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    jQuery(function() {
 			$("button").click(function(){
				$(this).parent('.col-sm-6').find("textarea").select();
				document.execCommand('copy');
			});
    });
    </script>

</body>