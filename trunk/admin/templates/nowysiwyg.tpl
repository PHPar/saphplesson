<script type="text/javascript" src="../includes/jscript/normal.js"></script>
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
			<select name="FontNamesList" onchange="Code(14)">
			<option selected value='1'>[ ���� ]</option>
			<script type="text/javascript"> build_fontoptions(); </script>
			</select>
			</td>
			<td style="position:relative">
            <select name="FontsList" onchange="Code(13)">
            <option selected value='1'>[ ��� ���� ]</option>
             <script type="text/javascript"> build_sizeoptions(); </script>
			</select>
			</td>
			<td style="position:relative">
            <select name="ColorList" onchange="Code(12)">
            <option selected value='0'>[ ��� ���� ]</option>
             <script type="text/javascript"> build_coloroptions(false); </script>
			</select>
			</td>

			<td width="100%">&nbsp;</td>

		</tr>
		</table>
	</div>
	<div oncontextmenu="return false" onselectstart="return false" onselect="return false" class="controlholder">
		<table cellpadding="0" cellspacing="1" border="0">
		<tr>


			<td><div class="imagebutton" onClick="Saleh('cut')"><img src="../images/toolbox/cut.gif" alt="��" width="21" height="20"></div></td>
			<td><div class="imagebutton" onClick="Saleh('copy')"><img src="../images/toolbox/copy.gif" alt="���" width="21" height="20"></div></td>
			<td><div class="imagebutton" onClick="Saleh('paste')"><img src="../images/toolbox/paste.gif" alt="���" width="21" height="20"></div></td>
			<td><img src="../images/toolbox/br.gif"></td>
			<td><div class="imagebutton" onClick="Code(1)"><img src="../images/toolbox/bold.gif" alt="����" width="21" height="20"></div></td>
			<td><div class="imagebutton" onClick="Code(2)"><img src="../images/toolbox/italic.gif" alt="����" width="21" height="20"></div></td>
			<td><div class="imagebutton" onClick="Code(3)"><img src="../images/toolbox/underline.gif" alt="����" width="21" height="20"></div></td>
			<td><img src="../images/toolbox/br.gif"></td>
			<td><div class="imagebutton" onClick="UrlCode()"><img src="../images/toolbox/createlink.gif" alt="������ �����" width="21" height="20"></div></td>
            <td><img src="../images/toolbox/br.gif"></td>
            <td><div class="imagebutton" onClick="Code(10)"><img src="../images/toolbox/mright.gif" alt="�� ����� ������"></div></td>
			<td><div class="imagebutton" onClick="Code(11)"><img src="../images/toolbox/mleft.gif" alt="�� ����� ������"></div></td>

			<td width="100%">&nbsp;</td>
		</tr>
		</table>
	</div>
	<div oncontextmenu="return false" onselectstart="return false" onselect="return false" class="controlholder">
		<table cellpadding="0" cellspacing="0" border="0">
		<tr>

			<td><div class="imagebutton" onClick="Code(5)"><img src="../images/toolbox/justifyright.gif" alt="������ ��� ������" width="21" height="20"></div></td>
			<td><div class="imagebutton" onClick="Code(4)"><img src="../images/toolbox/justifycenter.gif" alt="�����" width="21" height="20"></div></td>
			<td><div class="imagebutton" onClick="Code(15)"><img src="../images/toolbox/justifyleft.gif" alt="������ ��� ������" width="21" height="20"></div></td>
			<td><div class="imagebutton" onClick="Code(6)"><img src="../images/toolbox/justify.gif" alt="���"></div></td>
			<td><img src="../images/toolbox/br.gif"></td>

            <td><div class="imagebutton" onClick="ImgCode()"><img src="../images/toolbox/insertimage.gif" alt="����� ����" width="21" height="20"></div></td>
            <td><div class="imagebutton" onClick="FlashCode()" ><img src="../images/toolbox/flash.gif" alt="����� ��� ����"></div></td>
            <td><div class="imagebutton" onClick="YouTubeCode()" ><img src="../images/toolbox/youtube.gif" alt="����� ���� �����"></div></td>
            <td><div class="imagebutton" onClick="MidiCode()"><img src="../images/toolbox/media.gif" alt="����� ��� ����� �����" width="21" height="20"></div></td>
            <td><div class="imagebutton" onClick="RamCode()"><img src="../images/toolbox/rplayer.gif" alt="����� ��� ��� �����" width="21" height="20"></div></td>
            <td><img src="../images/toolbox/br.gif"></td>
			<td><div class="imagebutton" onClick="Code(7)"><img src="../images/toolbox/code.gif" alt="����� ����" width="21" height="20"></div></td>

			<td><div class="imagebutton" onClick="Code(8)"><img src="../images/toolbox/vbasic.gif" alt="����� ���� ������ ����"></div></td>

			<td><div class="imagebutton" onClick="Code(9)"><img src="../images/toolbox/php.gif" alt="����� ���� php" width="21" height="20"></div></td>
            <td width="100%">&nbsp;</td>
		</tr>
		</table>
	</div>

</div>



	</td>
</tr>
<tr valign="top">
	<td class="controlbar">

<textarea name="less" style="width:540px; height:250px">{lsn.less}</textarea>

	</td>
<td class="controlbar">
<div id="smille">
<fieldset style="margin-bottom: 6px;">
	<legend>����������</legend>
      <table cellpadding="4" cellspacing="0" border="0" align="center">
        <tr align="center" valign="bottom">
          <td>
          <div class="smille" onClick="icon(1);">
          <img border="0" src="../images/icon/1.gif" width="17" height="17" alt="�����"></div></td>
          <td>
          <div class="smille" onClick="icon(2);">
          <img border="0" src="../images/icon/2.gif" width="17" height="17" alt="����"></div></td>
          <td>
          <div class="smille" onClick="icon(3);">
          <img border="0" src="../images/icon/3.gif" width="17" height="17" alt="������"></div></td>
        </tr>
        <tr align="center" valign="bottom">
          <td>
          <div class="smille" onClick="icon(4);">
          <img border="0" src="../images/icon/4.gif" width="17" height="17" alt="�����"></div></td>
          <td>
          <div class="smille" onClick="icon(5);">
          <img border="0" src="../images/icon/5.gif" width="17" height="17" alt="�����"></div></td>
          <td>
          <div class="smille" onClick="icon(6);">
          <img border="0" src="../images/icon/6.gif" width="17" height="17" alt="����"></div></td>
        </tr>
        <tr align="center" valign="bottom">
          <td>
          <div class="smille" onClick="icon(7);">
          <img border="0" src="../images/icon/7.gif" width="17" height="17" alt="����"></div></td>
          <td>
          <div class="smille" onClick="icon(8);">
          <img border="0" src="../images/icon/8.gif" width="17" height="17" alt="�����"></div></td>
          <td>
          <div class="smille" onClick="icon(9);">
          <img border="0" src="../images/icon/9.gif" width="17" height="17" alt="����"></div></td>
        </tr>
        <tr align="center" valign="bottom">
          <td>
          <div class="smille" onClick="icon(10);">
          <img border="0" src="../images/icon/10.gif" width="17" height="17" alt="����"></div></td>
          <td>
          <div class="smille" onClick="icon(11);">
          <img border="0" src="../images/icon/11.gif" width="17" height="17" alt="���"></div></td>
          <td>
          <div class="smille" onClick="icon(12);">
          <img border="0" src="../images/icon/12.gif" width="17" height="17" alt="��� �����"></div></td>
        </tr>
        <tr align="center" valign="bottom">
          <td>
          <div class="smille" onClick="icon(13);">
          <img border="0" src="../images/icon/13.gif" width="17" height="17"></div></td>
          <td>
          <div class="smille" onClick="icon(14);">
          <img border="0" src="../images/icon/14.gif" width="17" height="17"></div></td>
          <td>
          <div class="smille" onClick="icon(15);">
          <img border="0" src="../images/icon/15.gif" width="17" height="17" alt="����"></div></td>
        </tr>
      </table></fieldset></div></td>
</tr>
</table></table>