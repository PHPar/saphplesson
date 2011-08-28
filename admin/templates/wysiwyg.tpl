	<script type="text/javascript" src="../includes/jscript/wysiwyg.js"></script>
		<IF NAME="{Brwoser} eq FireFox">
			<script type="text/javascript" src="../includes/jscript/moziwyg.js"></script>
		</IF>
 <table align="center" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td>
<div id="Editor" style="text-align:right">

<table cellpadding="0" cellspacing="0" border="0">
<tr valign="bottom">
	<td colspan="2">



<div id="controlbar">

	<div oncontextmenu="return false" onselectstart="return false" onselect="return false" class="controlholder">
		<table cellpadding="0" cellspacing="1" border="0">
		<tr>
			<td style="position:relative">
			<div id="cmd_fontname">
			<select id="SaFont" name="SFont" onchange="do_format('fontname', false, this.options[this.selectedIndex].value);">
			<script type="text/javascript"> build_fontoptions(); </script>
			</select>
			</div>
			</td>
			<td style="position:relative">
			<div id="cmd_fontsize">
            <select id="SaSize" name="SFont" onchange="do_format('fontsize', false, this.options[this.selectedIndex].value);">
             <script type="text/javascript"> build_sizeoptions(); </script>
			</select>
			</div>
			</td>
			<td><img src="../images/toolbox/br.gif"></td>

			<td style="position:relative">
			<div class="imagebutton" style="left:0px" id="cmd_forecolor">
				<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td><img id="instantcolor" src="../images/toolbox/color.gif" alt="«··Ê‰" width="21" height="20"><img id="colorbar" style="display:none; background:black; <? If (CheckBrowser()=="IE"){?>position:absolute; top:15px;  right:5px;<? }ELSE{ ?>position:relative; top:-6px;  left:1px;<? } ?>" src="../images/clear.gif" width="16" height="4" alt=""></td>
					<td class="alt_pickbutton"><img src="../images/toolbox/menupop.gif" alt="› Õ «·ﬁ«∆„…" width="11" height="16"></td>
				</tr>
				</table>
			</div>
			<div oncontextmenu="return false" onselectstart="return false" onselect="return false" id="popup_forecolor" class="popupwindow" style="width:144px; height:90px; display:none; position:absolute; top:21px;">
			<table dir="ltr" id="colortable" cellpadding="0" cellspacing="0" border="0">
			<script type="text/javascript"> build_coloroptions(true); </script>
			<tr>
				<td colspan="8" style="height:4px"><div></div></td>
			</tr>
			</table>
			</div>
			</td>

			<td width="100%">&nbsp;</td>


			<td><img src="../images/toolbox/br.gif"></td>
			<td>
				<div dir=rtl  class="imagebutton" id="cmd_Decrease"><img src="../images/toolbox/resize_0.gif" width="21" height="9" alt=" ’€Ì— ’‰œÊﬁ «·‰’"></div>
				<div dir=rtl  class="imagebutton" id="cmd_Increase"><img src="../images/toolbox/resize_1.gif" width="21" height="9" alt=" ﬂ»Ì— ’‰œÊﬁ «·‰’"></div>
			</td>
		</tr>
		</table>
	</div>
	<div oncontextmenu="return false" onselectstart="return false" onselect="return false" class="controlholder">
		<table cellpadding="0" cellspacing="1" border="0">
		<tr>


			<td><div class="imagebutton" id="cmd_cut"><img src="../images/toolbox/cut.gif" alt="ﬁ’" width="21" height="20"></div></td>
			<td><div class="imagebutton" id="cmd_copy"><img src="../images/toolbox/copy.gif" alt="‰”Œ" width="21" height="20"></div></td>
			<td><div class="imagebutton" id="cmd_paste"><img src="../images/toolbox/paste.gif" alt="·’ﬁ" width="21" height="20"></div></td>
			<td><img src="../images/toolbox/br.gif"></td>
			<td><div class="imagebutton" id="cmd_undo"><img src="../images/toolbox/undo.gif" alt=" —«Ã⁄" width="21" height="20"></div></td>
			<td><div class="imagebutton" id="cmd_redo"><img src="../images/toolbox/redo.gif" alt=" ﬁœ„" width="21" height="20"></div></td>
			<td><img src="../images/toolbox/br.gif"></td>
			<td><div class="imagebutton" id="cmd_bold"><img src="../images/toolbox/bold.gif" alt="⁄—Ì÷" width="21" height="20"></div></td>
			<td><div class="imagebutton" id="cmd_italic"><img src="../images/toolbox/italic.gif" alt="„«∆·" width="21" height="20"></div></td>
			<td><div class="imagebutton" id="cmd_underline"><img src="../images/toolbox/underline.gif" alt="„”ÿ—" width="21" height="20"></div></td>
			<td><img src="../images/toolbox/br.gif"></td>
			<td><div class="imagebutton" id="cmd_createlink"><img src="../images/toolbox/createlink.gif" alt="«— »«ÿ  ‘⁄»Ì" width="21" height="20"></div></td>
			<td><div class="imagebutton" id="cmd_unlink"><img src="../images/toolbox/unlink.gif" alt="≈·€«¡ «·≈— »«ÿ" width="21" height="20"></div></td>
            <td><img src="../images/toolbox/br.gif"></td>
            <td><div class="imagebutton" id="cmd_wrap_marquee-r"><img src="../images/toolbox/mright.gif" alt="‰’ „ Õ—ﬂ ··Ì„Ì‰"></div></td>
			<td><div class="imagebutton" id="cmd_wrap_marquee-l"><img src="../images/toolbox/mleft.gif" alt="‰’ „ Õ—ﬂ ··Ì”«—"></div></td>
			<td><img src="../images/toolbox/br.gif"></td>
			<td><div class="imagebutton" id="cmd_removeformat"><img src="../images/toolbox/removeformat.gif" alt="≈·€«¡  ‰”Ìﬁ «·‰’" width="21" height="20"></div></td>

			<td width="100%">&nbsp;</td>
		</tr>
		</table>
	</div>
	<div oncontextmenu="return false" onselectstart="return false" onselect="return false" class="controlholder">
		<table cellpadding="0" cellspacing="0" border="0">
		<tr>

			<td><div class="imagebutton" id="cmd_justifyright"><img src="../images/toolbox/justifyright.gif" alt="„Õ«–«… ≈·Ï «·Ì„Ì‰" width="21" height="20"></div></td>
			<td><div class="imagebutton" id="cmd_justifycenter"><img src="../images/toolbox/justifycenter.gif" alt=" Ê”Ìÿ" width="21" height="20"></div></td>
			<td><div class="imagebutton" id="cmd_justifyleft"><img src="../images/toolbox/justifyleft.gif" alt="„Õ«–«… ≈·Ï «·Ì”«—" width="21" height="20"></div></td>
			<td><div class="imagebutton" id="cmd_justifyfull"><img src="../images/toolbox/justify.gif" alt="÷»ÿ"></div></td>
			<td><img src="../images/toolbox/br.gif"></td>

            <td><div class="imagebutton" id="cmd_insertimage"><img src="../images/toolbox/insertimage.gif" alt="≈œ—«Ã ’Ê—…" width="21" height="20"></div></td>
            <td><div class="imagebutton" id="cmd_youtube"><img src="../images/toolbox/youtube.gif" alt="≈œ—«Ã „ﬁÿ⁄ YouTube" width="21" height="20"></div></td>
            <td><div class="imagebutton" id="cmd_flash"><img src="../images/toolbox/flash.gif" alt="≈œ—«Ã „·› ›·«‘"></div></td>
            <td><div class="imagebutton" id="cmd_media"><img src="../images/toolbox/media.gif" alt="≈œ—«Ã „·› „ÌœÌ« »·«Ì—" width="21" height="20"></div></td>
            <td><div class="imagebutton" id="cmd_realplayer"><img src="../images/toolbox/rplayer.gif" alt="≈œ—«Ã „·› —Ì· »·«Ì—" width="21" height="20"></div></td>
            <td><img src="../images/toolbox/br.gif"></td>
			<td><div class="imagebutton" id="cmd_wrap_code"><img src="../images/toolbox/code.gif" alt="≈œ—«Ã ‘›—…" width="21" height="20"></div></td>

			<td><div class="imagebutton" id="cmd_wrap_vbasic"><img src="../images/toolbox/vbasic.gif" alt="≈œ—«Ã ‘›—… ›ÌÃÊ«· »Ì”ﬂ"></div></td>

			<td><div class="imagebutton" id="cmd_wrap_php"><img src="../images/toolbox/php.gif" alt="≈œ—«Ã ‘›—… php" width="21" height="20"></div></td>
            <td width="100%">&nbsp;</td>
		</tr>
		</table>
	</div>

</div>



	</td>
</tr>
<tr valign="top">
	<td class="controlbar">


	<input type="hidden" name="WYSIWYG_HTML" id="html_hidden_field" value="{lsn.less}">

	<IF NAME="{Brwoser} eq IE">

		<div id="htmlbox" class="wysiwyg" tabindex="1" style="width:540px; height:250px; padding:8px"></div>

	<ELSE>

		<iframe id="htmlbox" tabindex="1" style="width:540px; height:250px"></iframe>

	</IF>

	</td>
<td class="controlbar">
<!--<div id="smille">-->
<fieldset style="margin-bottom: 6px;">
	<legend>«·«» ”«„« </legend>
      <table cellpadding="4" cellspacing="0" border="0" align="center">
        <tr align="center" valign="bottom">
          <td>
          <div class="smille" onClick="icon(1,'w',this);">
          <img border="0" src="../images/icon/1.gif" width="17" height="17" alt="„» ”„"></div></td>
          <td>
          <div class="smille" onClick="icon(2,'w',this);">
          <img border="0" src="../images/icon/2.gif" width="17" height="17" alt="Ì€„“"></div></td>
          <td>
          <div class="smille" onClick="icon(3,'w',this);">
          <img border="0" src="../images/icon/3.gif" width="17" height="17" alt="„ ›«Ã∆"></div></td>
        </tr>
        <tr align="center" valign="bottom">
          <td>
          <div class="smille" onClick="icon(4,'w',this);">
          <img border="0" src="../images/icon/4.gif" width="17" height="17" alt="„»”Êÿ"></div></td>
          <td>
          <div class="smille" onClick="icon(5,'w',this);">
          <img border="0" src="../images/icon/5.gif" width="17" height="17" alt="„ Ê—ÿ"></div></td>
          <td>
          <div class="smille" onClick="icon(6,'w',this);">
          <img border="0" src="../images/icon/6.gif" width="17" height="17" alt="Õ“Ì‰"></div></td>
        </tr>
        <tr align="center" valign="bottom">
          <td>
          <div class="smille" onClick="icon(7,'w',this);">
          <img border="0" src="../images/icon/7.gif" width="17" height="17" alt="„⁄’»"></div></td>
          <td>
          <div class="smille" onClick="icon(8,'w',this);">
          <img border="0" src="../images/icon/8.gif" width="17" height="17" alt="›—Õ«‰"></div></td>
          <td>
          <div class="smille" onClick="icon(9,'w',this);">
          <img border="0" src="../images/icon/9.gif" width="17" height="17" alt="Ì»ﬂÌ"></div></td>
        </tr>
        <tr align="center" valign="bottom">
          <td>
          <div class="smille" onClick="icon(10,'w',this);">
          <img border="0" src="../images/icon/10.gif" width="17" height="17" alt="‰Ã„…"></div></td>
          <td>
          <div class="smille" onClick="icon(11,'w',this);">
          <img border="0" src="../images/icon/11.gif" width="17" height="17" alt="„Ì "></div></td>
          <td>
          <div class="smille" onClick="icon(12,'w',this);">
          <img border="0" src="../images/icon/12.gif" width="17" height="17" alt="Ì„œ ·”«‰Â"></div></td>
        </tr>
        <tr align="center" valign="bottom">
          <td>
          <div class="smille" onClick="icon(13,'w',this);">
          <img border="0" src="../images/icon/13.gif" width="17" height="17"></div></td>
          <td>
          <div class="smille" onClick="icon(14,'w',this);">
          <img border="0" src="../images/icon/14.gif" width="17" height="17"></div></td>
          <td>
          <div class="smille" onClick="icon(15,'w',this);">
          <img border="0" src="../images/icon/15.gif" width="17" height="17" alt="„Â—Ã"></div></td>
        </tr>
      </table></fieldset><!--</div>--></td>
</tr>
</table>
</td>
</tr></table>