<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta content="ar-sa" http-equiv="Content-Language" />
  <meta content="text/html; charset=windows-1256" http-equiv="Content-Type" />
  <title>������� ������� | ����� ������ ������</title>
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
              parent.document.title = "����� ������ ������ - ���� ������";
          }
      }
  </script>
</head>

<body onload="set_title()" style="background-color: #F1F1F1">

<div class="PageTitle">
������ ����� ������
</div>
<br />

<div align="center" style="text-align:center;">
	    <table cellpadding="0" align="center" cellspacing="0" style="width: 90%">
	    	<tbody>
	    	<tr>
	    		<td class="Win_H"><img alt="" align="right" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td style="text-align: center;" class="Win_H" style="width: 30%">
	    		����� �����</td>
	    		<td style="text-align: center;" class="Win_H" style="width: 20%">
	    		��� �����</td>
	    		<td style="text-align: center;" class="Win_H" style="width: 15%">
	    		���� �������</td>
	    		<td style="text-align: center;" class="Win_H" style="width: 15%">
	    		������</td>
	    		<td style="text-align: center;color: #0000FF;" class="Win_H" style="width: 10%">
	    		�����</td>
	    		<td style="text-align: center;color: #FF0000;" class="Win_H" style="width: 10%">
	    		���</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
            <IF Name="{nfile}">
            <LOOP Name="{files}">
	    	<tr bgcolor="#F2F2F2|#DDDDDD" style="height:22px">
	    		<td class="Win_R">&nbsp;</td>
	    		<td style="text-align: right">
	    		&nbsp;<a href="lesson.php?action=show&id={{lessid}}">{{lesstitle}}</a>
	    		</td>
	    		<td style="text-align: right">
	    		&nbsp;{{AName}}
	    		</td>
	    		<td style="text-align: center">
	    		&nbsp;{{ACounter}}
	    		</td>
	    		<td style="text-align: center">
	    		&nbsp;{{Date}}
	    		</td>
	    		<td style="text-align: center">
	    		<a href="attach.php?action=download&id={{AID}}" target="_blank" class="Disabled">�����</a></td>
	    		<td style="text-align: center">
                    <a onclick="return confirm('�� ��� ����� �� ��� {{AName}}');" href="attach.php?action=delete&id={{AID}}" class="DelHref">���</a></td>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
            </LOOP>
            <ELSE>
	    	<tr bgcolor="#F2F2F2" style="height:22px">
	    		<td class="Win_R">&nbsp;</td>
                <td style="text-align: center" colspan="6">�� ���� ������ ������</td>
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
</div>
<br />
<div style="text-align: center;">
����� ������ ������ 4.0
<br />
<a href="http://www.saphplesson.org">http://www.saphplesson.org</a>
</div>
</body>

</html>