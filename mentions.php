<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<style type="text/css">
.mention-container {width:100%; margin: 0px auto; padding: 0; }
.mention-article { border-bottom: 1px solid #c0c1c1;   padding: 15px 0px 15px 0px;  margin: 0px; clear: left;}
.mention-pic { float: left; padding: 5px 15px 10px 0px; border: 0px solid #000; margin: 0px;  }
    .mention-pic img { width:100%; } 
.mention-info { padding: 0px; margin: 0px; float: left; border: 0px solid #ff0000;   }
.mention-info p {margin: 0px; padding: 0px; line-height: 1.3em;}
.mention-info h2 { padding: 0px 0px 0px 0px;}
    .mention-info h2 small { clear:both; display:block;width:100%;} 
.mention-info h2 a { text-decoration: none; color: #003f7f;}
    span.datetime:before {
        content: " - ";
    }
    .tag.label {
        background: #004a71;
        color: #fff;
        margin: 4px 4px 4px 0;
        display: inline-block;
        border-radius: 5px;
        cursor: pointer;
        font-size: 10px;
        text-transform: uppercase;
        padding: 3px 8px;
        font-weight: bold;
        transition: .4s;  
    }
    .tag.label:hover { transition: .2s; background:#005a8c}
    p.tag-mentions { display: block;clear:both;margin-top:10px;}
    .tag-mentions .tag- {
        display: none !important;
    }
    @media (min-width:480px) {
    .show-all-tags {
        position: absolute;
        right: 35px;
        top: 35px;
        }
        .mention-info { width:70%;}
        .mention-pic  { width:30%;}
    }
    
</style>
</head>
<body>
<?php
//echo "<html><body><table>\n\n";
    $f = fopen("Forums and Reviews.csv", "r") or die();
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


echo "<div class=\"mention-container clearfix\">";
    echo "<div class=\"text-right\"><span class=\"tag text-right label label-info show-all-tags\" style=\"display: inline-block;\">Show All</span></div>";
foreach ($array as $go) {
    
    $postdate = '';
    if (trim($go[4]) != '') {
        $postdate = date("F j, Y", strtotime($go[4]) );
    }
    if ($go[5] != '') { // title not empty
        echo "<div class=\"mention-article clearfix tag-$go[2] tag-$go[3]\">";
        echo "<div class=\"mention-pic\">";
        if ($go[7] != '') { 
            echo "<a target=\"_blank\" href=\"". $go[1] 	."\"><img width='300px' height='240px' alt='". $go[5] ."' src='". $go[7]  ."'></a>";
        }
        echo "</div>"; 
        echo "<div class=\"mention-info\"><h2><a target=\"_blank\" href=\"". $go[1] 	."\">".  ($go[5])  . "</a> <small class=\"author\">".$go[0] ." <span class=\"datetime\">".$postdate ."</span></small></h2>";



        echo "<p>".$go[6] ." <a target=\"_blank\" class=\"readmore\" href=\"". $go[1] 	."\">". "Read&nbsp;more&nbsp;&raquo;"  . "</a></p>";
        echo "<p class='tag-mentions'><span class='tag tag-$go[2] label label-info'>".$go[2] . "</span><span class='tag tag-$go[3] label label-info'>" .$go[3]."</span></p>"; 

            echo "</div>"; 
        echo "</div>";
    }
}
echo "</div>\n";
?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    jQuery(function() {
        
        jQuery(".mention-article .tag").click(function() {
            //Do stuff when clicked
            jQuery('.mention-article').hide();
            jQuery('.show-all-tags').show();
            
            
            var get = jQuery.grep(this.className.split(" "), function(v, i){
                return v.indexOf('tag-') === 0;
            }).join();
            console.log('.mention-article .' + get);
            jQuery('.' + get).show();
            
        });
        
        jQuery('.show-all-tags').click(function() {
            jQuery('.mention-article').show();
            jQuery('.show-all-tags').hide();
        });
        jQuery('.show-all-tags').hide();
    });
    </script>

</body>