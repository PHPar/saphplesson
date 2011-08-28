<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta content="ar-sa" http-equiv="Content-Language" />
  <meta content="text/html; charset=windows-1256" http-equiv="Content-Type" />
  <title>عرض التعليقات بواسطة الرقم | سكربت الدروس العربي</title>
  <link href="style.css" rel="stylesheet" />
    <script language="javascript" type="text/javascript">
        function isNumberKey(evt)
        {
           var charCode = (evt.which) ? evt.which : event.keyCode
           if (charCode > 31 && (charCode < 48 || charCode > 57))
              return false;

           return true;
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
    </script>
</head>

<body onload="set_title()" style="background-color: #F1F1F1">

<div class="PageTitle">
عـرض التعليقـات بواســطة رقـم الدرس
</div>
<br />

<div align="center" style="text-align:center;">
	    	<table cellpadding="0" align="center" cellspacing="0" style="width: 90%">
	    	<tbody>
	    	<tr>
	    		<td><img alt="" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td class="Win_H" style="width: 100%">
	    		<img alt="" height="39" src="images/win_ht.gif" style="vertical-align: middle;" width="16" />
	    		عرض التعليقات بواسطة رقم الدرس</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
	    	<tr>
	    		<td class="Win_R">&nbsp;</td>
	    		<td class="Win_C">
	    		<form action="comment.php" method="get">
	    		<table cellpadding="0" cellspacing="3" style="width: 100%">
	    			<tbody>
	    			<tr>
	    				<td style="width: 25%; height: 39px">
						<span class="Win_Elem">
						رقم الدرس &nbsp;:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 75%; height: 39px">
						<input onkeypress="return isNumberKey(event)" class="TextBox" name="id" type="text" />&nbsp;</td>
	    			</tr>
	    		</tbody>
	    		</table>
	    		<br />
	    		<div style="text-align:center;">
                <input type="hidden" name="action" value="cmnt">
	    		<input name="Submit1" type="submit" value="عرض التعليقات" id="Button" />
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