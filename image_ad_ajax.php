<?php
		require_once 'cURL_ajax.inc.php';
		
				
		$ref="";
		$rows=0;
		$cols=0;
		$nos=0;
		$no_of_products=0;
		$show_product_descr=1;
		$show_read_more_btn=1;
		$default_font_family=1;
		$im_width="0";
		$descr_color="";
		$term_link="";
		$descr="";
		
		
		$im_width =  $_POST["im_width"];	
		$show_product_descr =  $_POST["show_product_descr"];	
		$show_read_more_btn = $_POST["show_read_more_btn"];	
		$default_font_family	= $_POST["default_font_family"];	
		$fill_color = $_POST["fill_color"];	
		$border_color = $_POST["border_color"];	
		$link_color = $_POST["link_color"];	
		$kws= $_POST["kws"];
		$cols= abs($_POST["cols"]);			
		$rows = abs($_POST["rows"]);	
		$ref= $_POST["ref"];		

		$height_adjustment= $_POST["height_adjustment"];			
		$hide_footer= $_POST["hide_footer"];			

		$kws=urlencode($kws);
				
		if ($cols==1) { $mcg_padding="padding:0px;";}
		else{$mcg_padding="margin-top:30px; margin-left:30px; margin-right:30px;";}
			

		
		
?>
<div id='mcg_inner_div' align="center" style=" <?php echo $mcg_padding;?> margin-left: auto; width:auto;       margin-right: auto;  overflow:auto; "  >

<?php



				
		$no_of_products = $rows * $cols;
		//echo $no_of_products;	

		if ($no_of_products>=15 ){

			$nos= $no_of_products +18;
			
		}else if ($no_of_products>=10 ){
		
			$nos= $no_of_products +10;
			
		}else if ($no_of_products>=6 ){
		
			$nos= $no_of_products +5;
			
		}elseif ($no_of_products <=4 ){
		
			$nos= $no_of_products +3;
		}

		$nos=($no_of_products   )+ intval ($no_of_products * .75);

		
		$url=mycbgenie_fetch_url_in_ajax ('http://clickbankproads.com/xmlfeed/wordpress_ads/ads.asp?nos='.$nos.'&kws='.$kws,$ref);
		//echo 'ss'.$url;
//		$url= ('http://clickbankproads.com/xmlfeed/wordpress_ads/ads.asp?nos='.$nos.'&kws='.$kws);		

//$opts = array( 'http'=>array(  'header' => 'Connection: close' ));
  
//$context = stream_context_create($opts);

//$json = json_decode(file_get_contents($url, false, $context));



   

	$json = json_decode(mycbgenie_ads_file_get_contents_curl($url,0,null,null));
		
		$cnt=0;


				
foreach ($json as $key=>$value) {
	


			
			foreach ($value as $key => $val) { 
			
			if ($key=='title') { $title= $val;}
			if ($key=='descr') { $descr= $val;}
			if ($key=='mdescr') { $mdescr= $val;}
			if ($key=='image_name') { $image_name= $val;}
			if ($key=='altimage') { $altimage= $val;}	
			if ($key=='ids') { $ids= $val;}	
			
				$title=htmlspecialchars($title);					
				$descr=htmlspecialchars($descr);					

			}
			$term_link	= "?action=mycbgenie_ads_view&id=".$ids;
			if ($show_product_descr!=1){ $descr=''; $mcg_ht=0;} 
			else {
				
				if ($cols==1) 	{ $mcg_ht=30; }
				if ($cols==2) 	{ $mcg_ht=40; }					
				if ($cols==3)	{ $mcg_ht=65; }
				if ($cols==4)	{ $mcg_ht=85; }				
				if ($cols==5)	{ $mcg_ht=110; }
				if ($cols==6)   { $mcg_ht=130; }
				
			
				if ($default_font_family!=1) {
					$descr='<div align=justify style="padding-bottom:9px; padding-right:7px; margin:0px; "><font color="#'.$descr_color.'">'.$descr.'</font></div>';
				}else {
					$descr='<div align=justify style="padding-bottom:9px; padding-right:7px; margin:0px;">'.$descr.'</div>';
				}
				
			}

			if ($default_font_family!=1){
			
				$title="<div style='padding-bottom:5px;'><font style='text-decoration:underline; font-family:arial;   font-weight:bold; color:#".$link_color."' >".$title."</font></div>";
				
				 } 
			else {
				$title="<div style='padding-bottom:5px;'><font style='text-decoration:underline;' >".$title."</font></div>";
			}



			
			if ($image_name!="blank.gif"  && $no_of_products > $cnt) {
				
				



				if ($cols==1 			 ) $mcg_ht=$mcg_ht+35;
				if ($cols==2 			) { $mcg_ht=$mcg_ht+20;}					
				if ($cols==3 			) { $mcg_ht=$mcg_ht+35;}
				if ($cols==4 ) 			  { $mcg_ht=$mcg_ht+40;}				
				if ($cols==5 ) 			  { $mcg_ht=$mcg_ht+50;}
				if ($cols==6  ) 		  { $mcg_ht=$mcg_ht+60;}				


				$cnt=$cnt+1;
			

		$mcg_ht =$mcg_ht + $im_width + 30;

				$thumb = "http://cbproads.com/clickbankstorefront/v4/send_binary.asp?equal=skip&im=".$image_name."&resize=".$im_width;
				
				if ($cols==1) { $mcg_wd = 92; }
				if ($cols==2) { $mcg_wd = 45; }
				if ($cols==3) { $mcg_wd = 30; }
				if ($cols==4) { $mcg_wd = 22; }
				if ($cols==5) { $mcg_wd = 17; }
				if ($cols==6) { $mcg_wd = 14; }																				
				
				
			//	if ($cols==1) {	$bdr= 'border-bottom: 1px solid #ddd';}
				//else {	$bdr=	'border: 1px solid #ddd'; }
				
				//if ($cnt== $no_of_products && $cols==1) { $bdr="";}
				
				$bdr= 'border: 1px solid #ddd';
				$mcg_ht =$mcg_ht + 45;
				
				if ( !$show_read_more_btn) $mcg_ht=$mcg_ht-40;
				 $mcg_ht=$mcg_ht+floor($height_adjustment);
				

			?>	
				
					
			
				<div class="wrap_mcg_<?php echo $cols;?>"  style=" height:<?php echo $mcg_ht;?>px; <?php echo $bdr;?>"  align=center>

						<div  align=center style="position: absolute; bottom: 0;width:95%; margin-right:3px; padding-bottom:12px; " >
							<a rel="nofollow" href="<?php echo ($term_link);?>" target="_blank">
							<img src="<?php echo ($thumb); ?>"   width="<?php //echo $im_width?>"  />
							<b><?php echo $title ?></b>		
							</a>
							<?php echo $descr ?>	
							<?php if ($show_read_more_btn) {
							?>
							<input type="submit" style="border-radius:1px; max-width:81%; text-align:center;" value="Read More" 
								onClick="parent.open('<?php echo ($term_link);?>')" />
							<?php } ?>
						
						</div>

				</div>
		
<?php		 
			}


   
	
		}
		if ($hide_footer!=1) {

?>


						<div  style=" clear:left; margin:5px; " align=right>
						<a style='text-decoration:none;' href='http://mycbgenie.com/?ref=<?php echo $ref;?>' target='_blank'>
						<font color=darkgrey size=1 >Clickbank Ads</font></a></div>
		<?php }
		else{ echo '<div style="clear:left;"></div>'; } ?>
</div>
