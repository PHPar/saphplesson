<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta content="ar-sa" http-equiv="Content-Language" />
  <meta content="text/html; charset=windows-1256" http-equiv="Content-Type" />
  <title>����� ��� ���� | ����� ������ ������</title>
  <link href="style.css" rel="stylesheet" />
  <script type="text/javascript" language="javascript" src="../includes/jscript/global.js"></script>
  <script type="text/javascript" language="javascript">
      function set_title()
      {
          if (document.title != '')
          {
              parent.document.title = document.title;
          }
          else
          {
              parent.document.title = "����� ������ ������ - ���� ������";
          }
      }
  </script>
</head>

<body onload="set_title()" style="background-color: #F1F1F1">

<div class="PageTitle">
��������� ��� ������
</div>
<br />

<div align="center" style="text-align:center;">
	    	<table cellpadding="0" align="center" cellspacing="0" style="width: 90%">
	    	<tbody>
	    	<tr>
	    		<td><img alt="" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td class="Win_H" style="width: 100%">
	    		<img alt="" height="39" src="images/win_ht.gif" style="vertical-align: middle;" width="16" />
	    		����� ��� ����</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
	    	<tr>
	    		<td class="Win_R">&nbsp;</td>
	    		<td class="Win_C">
	    		<form action="lesson.php?action=add" onsubmit="return formCheck(this);" name="newless" method="post" enctype="multipart/form-data">
	    		<table cellpadding="0" cellspacing="3" style="width: 100%">
	    			<tbody>
	    			<tr>
	    				<td style="width: 25%; height: 39px">
						<span class="Win_Elem">
						��� ���� ����� &nbsp;:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 75%; height: 39px">
						<input class="TextBox" name="Writer" type="text" />&nbsp;</td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 25%; height: 39px">
						<span class="Win_Elem">
						������ ���������� &nbsp;:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 75%; height: 39px">
						<input class="TextBox" name="mail" type="text" dir="ltr" /></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 25%; height: 39px">
						<span class="Win_Elem">
						������ &nbsp;:&nbsp;</span><br />
                        <span style="color: #ff0000">���� http:// �� �������</span>
	    						</td>
	    				<td style="width: 75%; height: 39px">
						<input class="TextBox" name="site" type="text" dir="ltr" /></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 25%; height: 39px">
						<span class="Win_Elem">
						����� &nbsp;:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 75%; height: 39px">
                        <select class="TextBox" name="forumno" size="1">
                            <option selected="selected" value="0">�������� ��������</option>
                            <IF Name="{ncat}">
                            <LOOP Name="{cats}">
                            <option value="{{id}}">{{Title}}</option>
                            </LOOP>
                            </IF>
                        </select>
						</td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 25%; height: 39px">
						<span class="Win_Elem">
						����� ����� &nbsp;:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 75%; height: 39px">
						<input class="TextBox" name="lesstitle" type="text" />&nbsp;<input id="actv" type="checkbox" name="active" value="1" checked="checked" /><label for="actv">����� ��� ����� �</label></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 25%; height: 39px">
						<span class="Win_Elem">
						��� ����� &nbsp;:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 75%; height: 39px">
                        <table border="0" cellpadding="0" cellspacing="0" width="450">
                          <tr>
                            <td width="50">
                                <input id="1" type="radio" value="1" checked="checked" name="ico"><label id="l1" for="1"><img onclick="l1.click()" border="0" src="../images/icon/1.gif" width="17" height="17" alt="�����"></label></td>
                            <td width="50">
                                <input id="2" type="radio" value="2" name="ico"><label id="l2" for="2"><img onclick="l2.click()" border="0" src="../images/icon/2.gif" width="17" height="17" alt="����"></label></td>
                            <td width="50">
                                <input id="3" type="radio" value="3" name="ico"><label id="l3" for="3"><img onclick="l3.click()" border="0" src="../images/icon/3.gif" width="17" height="17" alt="������"></label></td>
                            <td width="50">
                                <input id="4" type="radio" value="4" name="ico"><label id="l4" for="4"><img onclick="l4.click()" border="0" src="../images/icon/4.gif" width="17" height="17" alt="�����"></label></td>
                            <td width="50">
                                <input id="5" type="radio" value="5" name="ico"><label id="l5" for="5"><img onclick="l5.click()" border="0" src="../images/icon/5.gif" width="17" height="17" alt="�����"></label></td>
                            <td width="50">
                                <input id="6" type="radio" value="6" name="ico"><label id="l6" for="6"><img onclick="l6.click()" border="0" src="../images/icon/6.gif" width="17" height="17" alt="����"></label></td>
                            <td width="50">
                                <input id="7" type="radio" value="7" name="ico"><label id="l7" for="7"><img onclick="l7.click()" border="0" src="../images/icon/7.gif" width="17" height="17" alt="����"></label></td>
                            <td width="50">
                                <input id="8" type="radio" value="8" name="ico"><label id="l8" for="8"><img onclick="l8.click()" border="0" src="../images/icon/8.gif" width="17" height="17" alt="�����"></label></td>
                            <td width="50">
                                <input id="9" type="radio" value="9" name="ico"><label id="l9" for="9"><img onclick="l9.click()" border="0" src="../images/icon/9.gif" width="17" height="17" alt="����"></label></td>
                          </tr>
                        </table>
						</td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 25%; height: 39px">
						<span class="Win_Elem">
						����� ����� &nbsp;:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 75%; height: 39px">
                        <div id="smille">
                        <center>
                        <script type="text/javascript" src="../includes/jscript/editor.js"></script>

                        <script type="text/javascript">
                        <!--
                        var fontoptions = new Array("Arial", "Arial Black", "Arial Narrow", "Book Antiqua", "Century Gothic", "Comic Sans MS", "Courier New", "Fixedsys", "Franklin Gothic Medium", "Garamond", "Georgia", "Impact", "Lucida Console", "Lucida Sans Unicode", "MS Sans Serif", "Palatino Linotype", "System", "Tahoma", "Times New Roman", "Trebuchet MS", "Verdana");
                        var sizeoptions = new Array(1, 2, 3, 4, 5, 6, 7);
                        var istyles = new Array(); istyles = { "pi_button_down" : [ "#98B5E2", "#000000", "0px", "1px solid #316AC5" ], "pi_button_hover" : [ "#C1D2EE", "#000000", "0px", "1px solid #316AC5" ], "pi_button_normal" : [ "#ECE9D8", "#000000", "1px", "none" ], "pi_button_selected" : [ "#E1E6E8", "#000000", "0px", "1px solid #316AC5" ], "pi_menu_down" : [ "#98B5E2", "#316AC5", "0px", "1px solid #316AC5" ], "pi_menu_hover" : [ "#C1D2EE", "#316AC5", "0px", "1px solid #316AC5" ], "pi_menu_normal" : [ "#FFFFFF", "#000000", "0px", "1px solid #FFFFFF" ], "pi_popup_down" : [ "#98B5E2", "#000000", "0px", "1px solid #316AC5" ] };
                        //-->
                        </script>
                        {TextBox}
                        <script type="text/javascript">
                        editInit();
                        </script>
                        </center>
                        </div>
                        </td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 25%; height: 39px">
						<span class="Win_Elem">
						����� ��� &nbsp;:&nbsp;</span><br />
                        <span class="GraySmall">���� ��� ����� �� �� {settings.ASize} ��������</span>
	    						</td>
	    				<td style="width: 75%; height: 39px">
						<input class="TextBox" name="Attach" type="file" /></td>
	    			</tr>
	    		</tbody>
	    		</table>
	    		<br />
	    		<div style="text-align:center;">
	    		<input name="Submit1" type="submit" value="����� �����" id="Button" />
	    		</div>
	    		</form>
	    		</td>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
	    	<tr>
	    		<td><img alt="" height="20" src="images/win_fr.gif" width="19" /></td>
	    		<td class="Win_F">&nbsp;</td>
	    		<td><img alt="" height="20" src="images/win_fl.gif" width="15" /></td>
	    	</tr>
	    </tbody>
	    </table>

</div>

<br />
<div style="text-align: center;">
����� ������ ������ 4.0
<br />
<a href="http://www.saphplesson.org">http://www.saphplesson.org</a>
</div>

</body>

</html>