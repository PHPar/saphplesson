<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta content="ar-sa" http-equiv="Content-Language" />
  <meta content="text/html; charset=windows-1256" http-equiv="Content-Type" />
  <title>الكلمات الممنوعة | سكربت الدروس العربي</title>
  <link href="style.css" rel="stylesheet" />
  <script type="text/javascript" language="javascript">
      function set_title()
      {
          if (document.title != '')
          {
              parent.document.title = document.title;
          }
          else
          {
              parent.document.title = "سكربت الدروس العربي - لوحة التحكم";
          }
      }
  </script>
</head>

<body onload="set_title()" style="background-color: #F1F1F1">

<div class="PageTitle">
الكلـــمـــات الممنـــوعة
</div>
<br />

<div align="center" style="text-align:center;">
	    <table cellpadding="0" align="center" cellspacing="0" style="width: 90%">
	    	<tbody>
	    	<tr>
	    		<td class="Win_H"><img alt="" height="39" align="right" src="images/win_hr.gif" width="19" /></td>
	    		<td style="text-align: center;" class="Win_H" style="width: 70%">
	    		الكلمة</td>
	    		<td style="text-align: center;color: #008000;" class="Win_H" style="width: 15%">
	    		تعديل</td>
	    		<td style="text-align: center;color: #FF0000;" class="Win_H" style="width: 15%">
	    		حذف</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
            <IF Name="{wnum}">
            <LOOP Name="{words}">
	    	<tr bgcolor="#F2F2F2|#DDDDDD" style="height:22px">
	    		<td class="Win_R">&nbsp;</td>
	    		<td style="text-align: right">
	    		&nbsp;{{WFind}}<br />
	    		</td>
	    		<td style="text-align: center">
	    		<a href="words.php?action=edit&id={{WID}}" class="EditHref">تعديل</a></td>
	    		<td style="text-align: center">
	    		<a onclick="return confirm('هل انت متأكد من حذف {{WFind}}');" href="words.php?action=delete&id={{WID}}" class="DelHref">حذف</a></td>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
            </LOOP>
            <ELSE>
	    	<tr bgcolor="#F2F2F2" style="height:22px">
	    		<td class="Win_R">&nbsp;</td>
                <td style="text-align: center" colspan="3">لا يوجد بيانات لعرضها</td>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
            </IF>
	    	<tr>
	    		<td class="Win_F"><img alt="" height="20" align="right" src="images/win_fr.gif" width="19" /></td>
	    		<td class="Win_F" colspan="3">&nbsp;</td>
	    		<td class="Win_F"><img alt="" align="left" height="20" src="images/win_fl.gif" width="15" /></td>
	    	</tr>
	    </tbody>
	    </table>
	    <br />
	    	<table cellpadding="0" align="center" cellspacing="0" style="width: 90%">
	    	<tbody>
	    	<tr>
	    		<td><img alt="" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td class="Win_H" style="width: 100%">
	    		<img alt="" height="39" src="images/win_ht.gif" style="vertical-align: middle;" width="16" />
	    		إضافة كلمة ممنوعة</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
	    	<tr>
	    		<td class="Win_R">&nbsp;</td>
	    		<td class="Win_C">
	    		<form action="words.php?action=add" method="post">
	    		<table cellpadding="0" cellspacing="3" style="width: 100%">
	    			<tbody>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						الكلمة &nbsp;:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 60%; height: 39px">
						<input class="TextBox" name="Word" type="text" />&nbsp;</td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						النص البديل &nbsp;:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 60%; height: 39px">
						<input class="TextBox" name="Alt" type="text" /></td>
	    			</tr>
	    		</tbody>
	    		</table>
	    		<br />
	    		<div style="text-align:center;">
	    		<input name="Submit1" type="submit" value="إضافة الكلمة" id="Button" />
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
سكربت الدروس العربي 4.0
<br />
<a href="http://www.saphplesson.org">http://www.saphplesson.org</a>
</div>

</body>

</html>