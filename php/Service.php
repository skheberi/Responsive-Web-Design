<?php session_start() ?>
<?php
	if(!isset($_GET["id"]) && !isset($_GET["imgid"]) )
{
	$name=$_GET["Keyword"];
	//$type="user";
	$typp=$_GET["Type"];
	$cent=$_GET["latitude"].",".$_GET["longitude"];
	
	if($typp=='place')
	$str = 'search?q='.$name.'&type='.$typp.'&center='.$cent.'&fields=id,name,picture.width(700).height(700)';
	else
	$str = 'search?q='.$name.'&type='.$typp.'&fields=id,name,picture.width(700).height(700)';
	//echo $str;
	$_SESSION["data"]="Hello";
	

	
	//$search = $fb->get($str);

	
	 
    // $g_array = json_decode($var,true);

//	$search = $search->getGraphEdge()->asArray();

//	$var = json_encode($search);
//	echo $var;
	$g_url = 'https://graph.facebook.com/v2.8/'.$str.'&access_token=EAAYTn1a4YEsBAF91qjwmqmbICl6izzpHye1TYeHzRRlwQxwpI60Q6am0ZAEwzPkZB5ZCI9DJHDN2t6D0li0Ubuzsj9PnSbPxJCIZCKlf4oGZCFXYBMa6q6DarqKp6ROQckbts1iAtHQgyOYoPkVwZBbK28CEaAmZBQZD';
	//echo 'alert('.$g_url.')';
		$g_json = file_get_contents($g_url);
		
	echo $g_json;
}	



else if(isset($_GET["imgid"]))
{
	$varr=$_GET["imgid"];
	//echo $id;
$str = $varr."/picture?redirect=false";
	//$str2=$varr.'?fields=id,name,picture.width(700).height(700),albums.limit(5){name,photos.limit(2) {name, picture.width(700).height(700)}},posts.limit(5)';

	$g_url = 'https://graph.facebook.com/v2.8/'.$str.'&access_token=EAAYTn1a4YEsBAF91qjwmqmbICl6izzpHye1TYeHzRRlwQxwpI60Q6am0ZAEwzPkZB5ZCI9DJHDN2t6D0li0Ubuzsj9PnSbPxJCIZCKlf4oGZCFXYBMa6q6DarqKp6ROQckbts1iAtHQgyOYoPkVwZBbK28CEaAmZBQZD';
	//echo 'alert('.$g_url.')';
		$g_json = file_get_contents($g_url);
		
	echo $g_json;

}
else
{
	$varr=$_GET["id"];
	if($_GET["flagg"]=="true")
		$str=$varr.'?fields=id,name';
	//echo $id;
	else
$str = $varr.'?fields=id,name,picture.width(700).height(700),albums.limit(5){name,photos.limit(2){name,picture.width(700).height(700)}},posts.limit(5)';
	//$str2=$varr.'?fields=id,name,picture.width(700).height(700),albums.limit(5){name,photos.limit(2) {name, picture.width(700).height(700)}},posts.limit(5)';

	$g_url = 'https://graph.facebook.com/v2.8/'.$str.'&access_token=EAAYTn1a4YEsBAF91qjwmqmbICl6izzpHye1TYeHzRRlwQxwpI60Q6am0ZAEwzPkZB5ZCI9DJHDN2t6D0li0Ubuzsj9PnSbPxJCIZCKlf4oGZCFXYBMa6q6DarqKp6ROQckbts1iAtHQgyOYoPkVwZBbK28CEaAmZBQZD';
	//echo 'alert('.$g_url.')';

		$g_json = file_get_contents($g_url);
		$output="";
		
	//echo $g_json;
		$fullData = json_decode($g_json);
		if(isset($fullData->albums))
		{
			if(isset($fullData->albums->data))
			{

		foreach ($fullData->albums->data as $key) {
			# code...
			if(isset($key->photos->data))
			{
			foreach($key->photos->data as $key2)
			{
				if(isset($key2->id))
				{
				//$output.=$key2->id;
					$str = $key2->id."/picture?redirect=false";

					$g_url = 'https://graph.facebook.com/v2.8/'.$str.'&access_token=EAAYTn1a4YEsBAF91qjwmqmbICl6izzpHye1TYeHzRRlwQxwpI60Q6am0ZAEwzPkZB5ZCI9DJHDN2t6D0li0Ubuzsj9PnSbPxJCIZCKlf4oGZCFXYBMa6q6DarqKp6ROQckbts1iAtHQgyOYoPkVwZBbK28CEaAmZBQZD';

					//$g_json2=$g_url;
					$g_json2 = file_get_contents($g_url);
					$dat = json_decode($g_json2);
					$key2->url=$dat->data->url;
				}
			}



		}
	}
	}
	}
		$x=json_encode($fullData,true);
		echo $x;


}

?>