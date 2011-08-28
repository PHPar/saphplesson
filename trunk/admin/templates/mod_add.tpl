<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta content="ar-sa" http-equiv="Content-Language" />
  <meta content="text/html; charset=windows-1256" http-equiv="Content-Type" />
  <title>اضافة مشرف جديد | سكربت الدروس العربي</title>
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
إضــافــة مشــرف جديــد
</div>
<br />

<div align="center" style="text-align:center;">
	    	<table cellpadding="0" align="center" cellspacing="0" style="width: 90%">
	    	<tbody>
	    	<tr>
	    		<td><img alt="" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td class="Win_H" style="width: 100%">
	    		<img alt="" height="39" src="images/win_ht.gif" style="vertical-align: middle;" width="16" />
	    		إضافة مشرف جديد</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
	    	<tr>
	    		<td class="Win_R">&nbsp;</td>
	    		<td class="Win_C">
	    		<form action="moderator.php?action=add" method="post">
	    		<table cellpadding="0" cellspacing="3" style="width: 100%">
	    			<tbody>
	    			<tr>
	    				<td style="width: 25%; height: 39px">
						<span class="Win_Elem">
						اسم المستخدم &nbsp;:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 75%; height: 39px">
						<input class="TextBox" name="MName" type="text" />&nbsp;</td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 25%; height: 39px">
						<span class="Win_Elem">
						كلمة المرور &nbsp;:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 75%; height: 39px">
						<input class="TextBox" name="MPass" type="password" /></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 25%; height: 39px">
						<span class="Win_Elem">
						الصلاحيات &nbsp;:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 75%; height: 39px">
                    	<table style="width: 100%">
                    		<tr>
                    			<td style="width: 33%">
                    			<input id="f1" checked="checked" name="prem[1]" type="checkbox" value="1" />&nbsp;<label for="f1">التحكم
                    			بإعدادات الموقع .</label></td>
                    			<td style="width: 33%">
                    			<input id="f2" checked="checked" name="prem[2]" type="checkbox" value="1" /><label for="f2">التحكم
                    			بالكلمات الممنوعة .</label></td>
                    			<td style="width: 33%">
                    			<input id="f3" checked="checked" name="prem[3]" type="checkbox" value="1" /><label for="f3">التحكم
                    			بالمشرفين .</label></td>
                    		</tr>
                    		<tr>
                    			<td style="width: 33%">
                    			<input id="f4" checked="checked" name="prem[4]" type="checkbox" value="1" /><label for="f4">التحكم
                    			بالأقسام .</label></td>
                    			<td style="width: 33%">
                    			<input id="f5" checked="checked" name="prem[5]" type="checkbox" value="1" /><label for="f5">التحكم
                    			بالدروس .</label></td>
                    			<td style="width: 33%">
                    			<input id="f6" checked="checked" name="prem[6]" type="checkbox" value="1" /><label for="f6">التحكم
                    			بالتعليقات .</label></td>
                    		</tr>
                    		<tr>
                    			<td style="width: 33%">
                    			<input id="f7" checked="checked" name="prem[7]" type="checkbox" value="1" /><label for="f7">التحكم
                    			بالملفات المرفقة .</label></td>
                    			<td style="width: 33%">
                    			<input id="f8" checked="checked" name="prem[8]" type="checkbox" value="1" /><label for="f8">التحكم
                    			بالصيانة .</label></td>
                    			<td style="width: 33%">
                    			<input id="f9" checked="checked" name="prem[9]" type="checkbox" value="1" /><label for="f9">عرض
                    			المفكرة في رئيسية التحكم .</label></td>
                    		</tr>
                    	</table>
                        </td>
	    			</tr>
	    		</tbody>
	    		</table>
	    		<br />
	    		<div style="text-align:center;">
	    		<input name="Submit1" type="submit" value="إضافة المشرف" id="Button" />
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