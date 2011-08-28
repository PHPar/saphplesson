<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="ar-sa" http-equiv="Content-Language" />
<meta content="text/html; charset=windows-1256" http-equiv="Content-Type" />
<title>لوحة التحكم | سكربت الدروس العربي</title>
<link href="style.css" rel="stylesheet" />
  <script type="text/javascript" language="javascript" src="../includes/jscript/global.js"></script>
	<script type="text/javascript">
	<!--
	function caps_check(e)
	{
		var detected_on = detect_caps_lock(e);
		var alert_box = fetch_object('cap_lock_alert');

		if (alert_box.style.display == '')
		{
			// box showing already, hide if caps lock turns off
			if (!detected_on)
			{
				alert_box.style.display = 'none';
			}
		}
		else
		{
			if (detected_on)
			{
				alert_box.style.display = '';
			}
		}
	}
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
	//-->
	</script>
</head>

<body onload="set_title()" style="background-color: #F1F1F1">

<p>&nbsp;</p>
<p>&nbsp;</p>
<p><br />&nbsp;</p>

<div style="text-align:center;">
	    <table cellpadding="0" align="center" cellspacing="0" style="width: 60%">
	    	<tbody>
	    	<tr>
	    		<td><img alt="" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td class="Win_H" style="width: 100%">
	    		<img alt="" height="39" src="images/win_ht.gif" style="vertical-align: middle;" width="16" />
	    		سكربت الدروس العربي - تسجيل الدخول</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
	    	<tr>
	    		<td class="Win_R">&nbsp;</td>
	    		<td class="Win_C" style="text-align: RIGHT;">
	    		<form action="login.php" method="post">
                <div id="cap_lock_alert" style="display: none" class="DIVOrange">
                Caps Lock قيد التشغيل</b><br>
					قد يؤدي تشغيل Caps Lock إلى إدخال
					كلمة المرور بشكل غير صحيح .<br>
					يجب ضغط Caps Lock لإيقافه قبل
					إدخال كلمة المرور.
                </div>
	    		<table cellpadding="0" cellspacing="3" style="width: 100%">
	    			<tbody>
	    			<tr>
	    				<td style="width: 25%; height: 39px">
						<span class="Win_Elem">
						اسم المستخدم &nbsp;:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 75%; height: 39px">
						<input class="TextBox" name="cp_username" type="text" />&nbsp;</td>
	    			</tr>
	    			<tr>
	    				<td style="width: 25%; height: 39px">
						<span class="Win_Elem">
						كلمة المرور &nbsp;:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 75%; height: 39px">
						<input onkeypress="caps_check(event)" class="TextBox" name="cp_password" type="password" />&nbsp;</td>
	    			</tr>
	    		</tbody>
	    		</table>
	    		<br />
	    		<div style="text-align:center;">
	    		<input name="Submit1" type="submit" value="تسجيل الدخول" id="Button" />
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