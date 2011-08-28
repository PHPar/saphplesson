<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta content="ar-sa" http-equiv="Content-Language" />
  <meta content="text/html; charset=windows-1256" http-equiv="Content-Type" />
  <title>الاقسام | سكربت الدروس العربي</title>
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
الأقســـــام
</div>
<br />

<div align="center" style="text-align:center;">
    <form action="cat.php?action=updateorder" method="post">
	    <table cellpadding="0" align="center" cellspacing="0" style="width: 90%">
	    	<tbody>
	    	<tr>
	    		<td class="Win_H"><img alt="" height="39" align="right" src="images/win_hr.gif" width="19" /></td>
	    		<td style="text-align: center;" class="Win_H" style="width: 25%">
	    		القسم</td>
	    		<td style="text-align: center;" class="Win_H" style="width: 35%">
	    		الوصف</td>
	    		<td style="text-align: center;" class="Win_H" style="width: 10%">
	    		الدروس</td>
	    		<td style="text-align: center;" class="Win_H" style="width: 10%">
	    		الترتيب</td>
	    		<td style="text-align: center;color: #008000;" class="Win_H" style="width: 10%">
	    		تعديل</td>
	    		<td style="text-align: center;color: #FF0000;" class="Win_H" style="width: 10%">
	    		حذف</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
            <IF Name="{ncat}">
            <LOOP Name="{cats}">
	    	<tr bgcolor="#F2F2F2|#DDDDDD" style="height:22px">
	    		<td class="Win_R">&nbsp;</td>
	    		<td style="text-align: right">
	    		&nbsp;<a href="../({settings.SrchLink}?cat-{{id}}-1.html:showcat.php?id={{id}})" target="_blank">{{Title}}</a>
	    		</td>
	    		<td style="text-align: right">
	    		&nbsp;{{Description}}
	    		</td>
	    		<td style="text-align: center">
	    		&nbsp;{{NLess}}
	    		</td>
	    		<td style="text-align: center">
	    		<input value="{{COrder}}" type="text" name="order[{{id}}]" size="3">
	    		</td>
	    		<td style="text-align: center">
	    		<a href="cat.php?action=edit&id={{id}}" class="EditHref">تعديل</a></td>
	    		<td style="text-align: center">
                    <a onclick="return confirm('هل انت متأكد من حذف ({{Title}}) سيتم حذف جميع الدروس والاقسام المتفرعة منه');" href="cat.php?action=delete&id={{id}}" class="DelHref">حذف</a></td>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
            </LOOP>
            <ELSE>
	    	<tr bgcolor="#F2F2F2" style="height:22px">
	    		<td class="Win_R">&nbsp;</td>
                <td style="text-align: center" colspan="6">لا يوجد بيانات لعرضها</td>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
            </IF>
	    	<tr>
	    		<td class="Win_F"><img alt="" height="20" align="right" src="images/win_fr.gif" width="19" /></td>
	    		<td class="Win_F" colspan="6">&nbsp;</td>
	    		<td class="Win_F"><img alt="" height="20" align="left" src="images/win_fl.gif" width="15" /></td>
	    	</tr>
	    </tbody>
	    </table>
	    <br />
        <div style="text-align: center;">
            <input type="submit" id="Button" name="Submit" value="تحديث ترتيب الاقسام" />
            <input type="reset" id="Button" name="Rest" value="استعادة ترتيب الاقسام" />
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