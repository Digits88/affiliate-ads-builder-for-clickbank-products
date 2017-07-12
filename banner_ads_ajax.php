		<?php
		
		require_once 'cURL_ajax.inc.php';
				
		$nos=0;
		$ref="";
		$descr="";
		
		$banner_size 	= $_POST["banner_size"];	
		$ref			= $_POST["ref"];		
		$kws			=$_POST["kws"];
		$hide_footer		=$_POST["hide_footer"];
		
		$kws=urlencode($kws);
		
		
		//$banner_size
		$banner_height = substr($banner_size,strpos($banner_size,"x")+1);
		$banner_width =substr($banner_size,0,strpos($banner_size,"x"));

	
		
		
		$url=mycbgenie_fetch_url_in_ajax ('http://clickbankproads.com/xmlfeed/wordpress_ads/ads.asp?width='. $banner_width.'&height='.$banner_height.'&nos='.$nos.'&kws='.$kws,$ref);


	   // $url = 'http://clickbankproads.com/xmlfeed/wordpress_ads/ads.asp?width='. $banner_width.'&height='.$banner_height.'&nos='.$nos.'&kws='.$kws;


		$json = json_decode(mycbgenie_ads_file_get_contents_curl($url,0,null,null));
		
		foreach ($json as $key=>$value) {
	
			
			foreach ($value as $key => $val) { 
			
			if ($key=='title') { $title= $val;}
			if ($key=='descr') { $descr= $val;}
			if ($key=='mdescr') { $mdescr= $val;}
			if ($key=='image_name') { $image_name= $val;}
			if ($key=='altimage') { $altimage= $val;}	
			if ($key=='ids') { $ids= $val;}						
			if ($key=='bannerurl') { $banner_url= $val;}						

			
				$title=htmlspecialchars($title);					
				$descr=htmlspecialchars($descr);					

			}
			$term_link	= "?action=mycbgenie_ads_view&id=".$ids;
			?>
			<a href="<?php echo ($term_link);?>" target="_blank" rel="nofollow">
			<img style='width:100%;max-width:<?php echo $banner_width; ?>px;' src='<?php echo ($banner_url);?>'  />
			</a>
			
			<?php		 
			

		}
		if($hide_footer!=1){
?>
			<div style="max-width:<?php echo $banner_width; ?>px;" align="right">
		
			<a style='text-decoration:none;' href='http://mycbgenie.com/?ref=<?php echo $ref;?>' target='_blank'>
			<font color=darkgrey size=1 >Clickbank Ads</font></a>
			</div>
			
		<?php } ?>