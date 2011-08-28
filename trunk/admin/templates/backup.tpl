<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta content="ar-sa" http-equiv="Content-Language" />
  <meta content="text/html; charset=windows-1256" http-equiv="Content-Type" />
  <title>تحميل نسخة احتياطية | سكربت الدروس العربي</title>
  <link href="style.css" rel="stylesheet" />
  <script language="javascript" type="text/javascript">
    function negateChoice(id,c){
    		var k=0;
    		while(id.elements[k])
    		{
                    if(id.elements[k].type=="checkbox" && id.elements[k].name!="SaDrop" && id.elements[k].name!="SelectAll"){
    				    id.elements[k].checked=c;
                        if(c){
                            UpdateSize(id.elements[k],id.elements[id.elements[k].value].value);
                        }else{
                            UpdateSize(id.elements[k],id.elements[id.elements[k].value].value,1);
                        }
                    }
    			k++;
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
    function UpdateSize(c,t,o){
        var SS,RR;
        if (c.checked==true){
          RR = document.getElementById("total").innerHTML;
          if(c.name=="SelectAll"){
            RR = 0;
          }
          var newsize = parseInt(RR) + parseInt(t);
          document.getElementById("total").innerHTML = parseInt(RR) + parseInt(t);
      }else{
          if(o){
             document.getElementById("total").innerHTML = 0;
          }else{
              RR = document.getElementById("total").innerHTML;
              document.getElementById("total").innerHTML = parseInt(RR)-parseInt(t);
          }
          if((document.getElementById("total").innerHTML * 1) > 0){
            alert(parseInt(document.getElementById("total").innerHTML));
            //document.getElementById("total").innerHTML = 0;
          }
      }
    }
    function ChangeMulti(X){
        if(X=="1"){
          document.Backup.filesno.disabled = true;
          document.Backup.filesno.value    = "1";
          document.Backup.type[0].disabled = false;
          document.Backup.type[2].disabled = false;
          document.Backup.type[0].checked = "checked";
        }else{
         if(X=="2"){
              document.Backup.filesno.disabled  = false;
              document.Backup.filesno.value     = "2";
         }else{
              document.Backup.filesno.disabled  = true;
              document.Backup.filesno.value     = "1";
         }
          document.Backup.type[1].checked = "checked";
          document.Backup.type[0].disabled = true;
          document.Backup.type[2].disabled = true;
        }
    }
  </script>
</head>

<body onload="set_title()" style="background-color: #F1F1F1">

<div class="PageTitle">
الجداول الموجودة في قاعدة البيانات
</div>
<br />

<div align="center" style="text-align:center;">
    <form action="backup.php" name="Backup" method="post">
	    <table cellpadding="0" align="center" cellspacing="0" style="width: 90%">
	    	<tbody>
	    	<tr>
	    		<td class="Win_H"><img alt="" height="39" align="right" src="images/win_hr.gif" width="19" /></td>
	    		<td style="text-align: center;" class="Win_H" style="width: 2%">
	    		<input type="checkbox" name="SelectAll" onclick="negateChoice(Backup,this.checked)" title="تحديد الكل" value="ALL" id="ALL" /></td>
	    		<td style="text-align: center;" class="Win_H" style="width: 45%">
	    		اسم الجدول</td>
	    		<td style="text-align: center;" class="Win_H" style="width: 20%">
	    		الحجم</td>
	    		<td style="text-align: center;" class="Win_H" style="width: 25%">
	    		عدد السجلات</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
            <LOOP Name="{table_row}">
	    	<tr bgcolor="#F2F2F2|#DDDDDD" style="height:22px">
	    		<td class="Win_R">&nbsp;</td>
                <td style="text-align: right"><input type="hidden" name="{{Name}}" value="{{SizeKB}}">
                <input ID='{{Name}}1' class="check_me" onclick="UpdateSize(this,{{Name}}.value)" type=checkbox name='{{Name}}2' value='{{Name}}' dir='rtl' /></td>
	    		<td style="text-align: right">
	    		&nbsp;<label FOR='{{Name}}1'>{{Name}}</Label>
	    		</td>
	    		<td style="text-align: right" dir="ltr">
	    		&nbsp;{{SizeKB}} KB
	    		</td>
	    		<td style="text-align: center" dir="ltr">
	    		&nbsp;{{Rows}}
	    		</td>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
            </LOOP>
	    	<tr bgcolor="#F2F2F2" style="height:22px">
	    		<td class="Win_R">&nbsp;</td>
                <td style="text-align: right">&nbsp;</td>
	    		<td style="text-align: right">
	    		&nbsp;اجمالي الحجم بدون ضغط
	    		</td>
	    		<td style="text-align: right" dir="ltr">
	    		<div dir="ltr" id="total">0</div>
	    		</td>
	    		<td style="text-align: center">
	    		&nbsp;
	    		</td>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
	    	<tr>
	    		<td class="Win_F"><img alt="" height="20" align="right" src="images/win_fr.gif" width="19" /></td>
	    		<td class="Win_F" colspan="4">&nbsp;</td>
	    		<td class="Win_F"><img alt="" height="20" align="left" src="images/win_fl.gif" width="15" /></td>
	    	</tr>
	    </tbody>
	    </table>
	    <table cellpadding="0" cellspacing="0" style="width: 90%" align="center">
	    	<tbody>
	    	<tr>
	    		<td><img alt="" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td class="Win_H" style="width: 100%">
	    		<img alt="" height="39" src="images/win_ht.gif" style="vertical-align: middle;" width="16" />
	    		تعدد الملفات</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
	    	<tr>
	    		<td class="Win_R">&nbsp;</td>
	    		<td class="Win_C" style="text-align: center;">
                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                        <tr>
                            <td bgcolor="#F2F2F2" width="33%">
                            <input type="radio" OnClick="ChangeMulti(this.value);" name="multi" value="1" checked id="fp4"><label for="fp4">ملف
                            واحد فقط .</label></td>
                            <td bgcolor="#DDDDDD" width="33%">
                            <input type="radio" OnClick="ChangeMulti(this.value);" name="multi" value="2" id="fp5"><label for="fp5">ملفين
                            أو أكثر</label>&nbsp;&nbsp;&nbsp;<input type="text" name="filesno" size="2" disabled="true" value="2" maxlength="2"> .</td>
                            <td bgcolor="#F2F2F2" width="33%">
                            <input type="radio" OnClick="ChangeMulti(this.value);" name="multi" value="3" id="fp6"><label for="fp6">
                            لكل جدول ملف .</label></td>
                        </tr>
                    </table>
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
	    <table cellpadding="0" cellspacing="0" style="width: 90%" align="center">
	    	<tbody>
	    	<tr>
	    		<td><img alt="" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td class="Win_H" style="width: 100%">
	    		<img alt="" height="39" src="images/win_ht.gif" style="vertical-align: middle;" width="16" />
	    		النوع</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
	    	<tr>
	    		<td class="Win_R">&nbsp;</td>
	    		<td class="Win_C" style="text-align: center;">
                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                        <tr>
                            <td bgcolor="#F2F2F2" width="33%">
                            <input type="radio" value="sql" name="type" id="fp1" checked><label for="fp1">SQL</label></td>
                            <td bgcolor="#DDDDDD" width="33%">
                            <input type="radio" value="zip" name="type" id="fp2"><label for="fp2">ZIP</label></td>
                            <td bgcolor="#F2F2F2" width="33%">
                            <input type="radio" value="gz" name="type" id="fp3"><label for="fp3">GZip</label></td>
                        </tr>
                    </table>
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
	    <table cellpadding="0" cellspacing="0" style="width: 90%" align="center">
	    	<tbody>
	    	<tr>
	    		<td><img alt="" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td class="Win_H" style="width: 100%">
	    		<img alt="" height="39" src="images/win_ht.gif" style="vertical-align: middle;" width="16" />
	    		خيارات اخرى</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
	    	<tr>
	    		<td class="Win_R">&nbsp;</td>
	    		<td class="Win_C" style="text-align: center;">
                    <input ID='SaDrop' checked="checked" type=checkbox name='SaDrop' value='1' dir='rtl'><label for='SaDrop'>إضافة حذف الجدول إذا كان موجود في البداية</label>
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
	    <br />
        <br />
        <div style="text-align: center;">
            <input type="submit" id="Button" name="GetBackUp" value="جلب النسخة الإحتياطية" />
        </div>
    </form>
</div>

<br />
<div style="text-align: center;">
سكربت الدروس العربي 4.0
<br />
<a href="http://www.saphplesson.org">http://www.saphplesson.org</a>
</div>

</body>

</html>