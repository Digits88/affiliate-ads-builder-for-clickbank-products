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
		$height_adjustment="0";
		$descr_color="";
		$term_link="";
		$kws="";
		$hide_footer="0";
		$descr="";

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
		$descr_color = $_POST["descr_color"];	
		$height_adjustment = $_POST["height_adjustment"];	
		$hide_footer = $_POST["hide_footer"];	
		
		
		$kws=urlencode($kws);
		$no_of_products = $rows * $cols;


		$nos=$no_of_products;
	


		$url=mycbgenie_fetch_url_in_ajax ('http://clickbankproads.com/xmlfeed/wordpress_ads/ads.asp?nos='.$nos.'&kws='.$kws, $ref);


		$json = json_decode(mycbgenie_ads_file_get_contents_curl($url,0,null,null));
		
		$cnt=0;
				
		foreach ($json as $key=>$value) {
		
		
		if ( $no_of_products > $cnt) {
		
			$cnt=$cnt+1;

	
			foreach ($value as $key => $val) { 
			
					if ($key=='title') { $title= $val;}
					if ($key=='descr') { $descr= $val;}
					if ($key=='mdescr') { $mdescr= $val;}
					if ($key=='image_name') { $image_name= $val;}
					if ($key=='altimage') { $altimage= $val;}	
					if ($key=='ids') { $ids= $val;}						
					if ($key=='siteurl') { $site_url= $val;}	
					
						$title=htmlspecialchars($title);					
						$descr=htmlspecialchars($descr);					
				
					}
					
					if (	(substr($descr, -1)!=".") && (substr($descr, -1)!="!")  )  $descr=$descr.".";
					$term_link	= "?action=mycbgenie_ads_view&id=".$ids;
					
					
					if ($show_product_descr!=1){ $descr='';} 
					else {

					
						if ($default_font_family!=1) {
						
							$descr='<div style="text-align:left; padding:0px; line-height:18px;"><font color="#'.$descr_color.'">'.$descr.'</font>';
								
								if ($show_read_more_btn==0) {$descr=$descr.'<br>
												<font style="text-decoration:none; font-size:11px; font-weight:normal; color:#'.$link_color.';">'.$site_url.'</font>
												</div>';} else {$descr=$descr.'</div>';}
						}else {

							$descr='<div style="text-align:left; padding:0px; padding-top:3px; line-height:18px;">'.$descr;
							
							 		if ($show_read_more_btn==0) {$descr=$descr.'<br>
												<a rel="nofollow" target=_blank href="'.$term_link.'">
												<font style="text-decoration:none; font-size:11px; font-weight:normal;">'.$site_url.'</font></a>
												</div>';} else {$descr=$descr.'</div>';}
									
						}
						
					}

					if ($default_font_family!=1){
					
						$title="<font style='text-decoration:underline; font-family:arial;  font-weight:bold; color:#".$link_color."' >".$title."</font>";
						//$site_url ="<font style='text-decoration:none; font-family:arial; font-size:11px; font-weight:normal; color:#".$link_color."' >".$site_url."</font>";
						
						 } 
					else {
						$title="<u>".$title."</u>";
						//$site_url="<font style='text-decoration:none; font-size:11px; font-weight:normal;'>".$site_url."</font>";
					}


					if ($cols==1 ) { $mcg_ht=140; }
					if ($cols==2 ) { $mcg_ht=160; }					
					if ($cols==3 ) { $mcg_ht=130; }
					if ($cols==4 ) { $mcg_ht=175; }				
					if ($cols==5 ) { $mcg_ht=190; }
					if ($cols==6 ) { $mcg_ht=220; }	
						
					if ( !$show_read_more_btn) $mcg_ht=$mcg_ht-40;
//echo $height_adjustment."-";
					 $mcg_ht=$mcg_ht+floor($height_adjustment);
//echo $mcg_ht."<br>";			
			?>
			
					<div class="wrap_text_mcg_<?php echo $cols; ?>"  style="height:<?php echo $mcg_ht;?>px; position: relative;  "  >

							<div  style="text-align:left;  ">
							<a rel="nofollow" href="<?php echo ($term_link);?>" target="_blank">

							<b><?php echo $title ?></b>		
							</a>
							
									<?php echo $descr ?>	
							</div>
							 <?php if ($show_read_more_btn) { ?>
									<div align=right style="position: absolute; bottom: 0; text-align:right; ">
									<input type="submit" style="border-radius:1px; max-width:100%; text-align:right; margin-bottom:3px;" 
										value="Read More &gt;&gt;" onClick="parent.open('<?php  echo ($term_link);?>')" />
								
									</div>
								<?php }else{  ?>
									
										
								 
								<?php }?>
					</div>
				
				
			<?php
			} //if count > no of products
		} //for loop outer
		
		if ($hide_footer!=1) {
		?>
				



				
					
					<div style="clear:left; padding:0px; padding-right:3px; margin:0px; height:auto; background:#<?php  echo $border_color;?> " align="right">
							<a style='text-decoration:none; margin:0px; padding:0px;' href='http://mycbgenie.com/?ref=<?php echo $ref;?>' target='_blank'>
							<font color=darkgrey size=1 >Clickbank Ads</font></a>
						</div>

		<?php }
		else{ echo '<div style="clear:left;"></div>'; } ?>
