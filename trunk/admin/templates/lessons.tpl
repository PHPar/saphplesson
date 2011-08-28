<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta content="ar-sa" http-equiv="Content-Language" />
  <meta content="text/html; charset=windows-1256" http-equiv="Content-Type" />
  <title>الدروس المفعّلة | سكربت الدروس العربي</title>
  <link href="style.css" rel="stylesheet" />
  <script language="javascript" type="text/javascript">
    function negateChoice(id,c){
    		var k=0;
    		while(id.elements[k])
    		{
                    if(id.elements[k].type=="checkbox"){
    				    id.elements[k].checked=c;
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
  </script>
</head>

<body onload="set_title()" style="background-color: #F1F1F1">

<div class="PageTitle">
الــدروس المفعّـــــلة
</div>
<br />

<div align="center" style="text-align:center;">
    <form action="lesson.php?action=event" name="lsns" method="post">
	    <table cellpadding="0" align="center" cellspacing="0" style="width: 90%">
	    	<tbody>
	    	<tr>
	    		<td class="Win_H"><img alt="" height="39" align="right" src="images/win_hr.gif" width="19" /></td>
	    		<td style="text-align: center;" class="Win_H" style="width: 2%">
	    		<input type="checkbox" name="SelectAll" onclick="negateChoice(lsns,this.checked)" title="تحديد الكل" value="ALL" id="ALL" /></td>
	    		<td style="text-align: center;" class="Win_H" style="width: 30%">
	    		عنوان الدرس</td>
	    		<td style="text-align: center;" class="Win_H" style="width: 20%">
	    		الكاتب</td>
	    		<td style="text-align: center;" class="Win_H" style="width: 15%">
	    		IP</td>
	    		<td style="text-align: center;" class="Win_H" style="width: 15%">
	    		تاريخ الدرس</td>
	    		<td style="text-align: center;color: #008000;" class="Win_H" style="width: 10%">
	    		تعديل</td>
	    		<td style="text-align: center;color: #FF0000;" class="Win_H" style="width: 10%">
	    		حذف</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
            <IF Name="{nlsn}">
            <LOOP Name="{lsns}">
	    	<tr bgcolor="#F2F2F2|#DDDDDD" style="height:22px">
	    		<td class="Win_R">&nbsp;</td>
                <td style="text-align: right">
                <input type="checkbox" name="l[{{lessid}}]" value="ALL" /></td></td>
	    		<td style="text-align: right">
	    		&nbsp;<img border="0" src="../images/icon/{{icon}}.gif" />&nbsp;<a href="lesson.php?action=show&id={{lessid}}">{{lesstitle}}</a>
	    		</td>
	    		<td style="text-align: right">
	    		&nbsp;<a href="mailto:{{mail}}">{{Writer}}</a>
	    		</td>
	    		<td style="text-align: center">
	    		&nbsp;{{IP}}
	    		</td>
	    		<td style="text-align: center">
	    		&nbsp;{{Date}}
	    		</td>
	    		<td style="text-align: center">
	    		<a href="lesson.php?action=edit&id={{lessid}}" class="EditHref">تعديل</a></td>
	    		<td style="text-align: center">
                    <a onclick="return confirm('هل انت متأكد من حذف {{lesstitle}} سيتم حذفه وحذف جميع تعليقاته');" href="lesson.php?action=delete&id={{lessid}}" class="DelHref">حذف</a></td>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
            </LOOP>
            <ELSE>
	    	<tr bgcolor="#F2F2F2" style="height:22px">
	    		<td class="Win_R">&nbsp;</td>
                <td style="text-align: center" colspan="7">لا يوجد بيانات لعرضها</td>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
            </IF>
	    	<tr>
	    		<td class="Win_F"><img alt="" height="20" align="right" src="images/win_fr.gif" width="19" /></td>
	    		<td class="Win_F" colspan="7">&nbsp;</td>
	    		<td class="Win_F"><img alt="" height="20" align="left" src="images/win_fl.gif" width="15" /></td>
	    	</tr>
	    </tbody>
	    </table>
	    <br />
        {pager}
        <br />
        <div style="text-align: center;">
            <input type="submit" id="Button" name="Delete" value="حذف الدروس المحددة" />
            <input type="submit" id="Button" name="UnActive" value="تعطيل الدروس المحددة" />
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