<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta content="ar-sa" http-equiv="Content-Language" />
  <meta content="text/html; charset=windows-1256" http-equiv="Content-Type" />
  <title>���� ������ | ����� ������ ������</title>
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
���������� ���� {SaphpUser}
</div>
<br />
<div align="center" style="text-align:center;">
        <IF Name="{settings.Sitemap}">
        <div class="DIVRed">
            �� ����� ��� ����� ������ ����� <a href="../({settings.SrchLink}?sitemap.xml:sitemap.php)" target="_blank">��� ��� ������</a>
        </div>
        <br />
        </IF>
	    <table cellpadding="0" cellspacing="0" style="width: 75%" align="center">
	    	<tbody>
	    	<tr>
	    		<td><img alt="" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td class="Win_H" style="width: 100%">
	    		<img alt="" height="39" src="images/win_ht.gif" style="vertical-align: middle;" width="16" />
	    		�������� ����</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
	    	<tr>
	    		<td class="Win_R">&nbsp;</td>
	    		<td class="Win_C" style="text-align: center;">
                <table style="width: 100%">
                	<tr>
                		<td style="width: 30%;text-align:right">��� �������� :</td>
                		<td dir="ltr" style="width: 20%;text-align:right"><strong>{num.admins}</strong></td>
                		<td style="width: 30%;text-align:right">��� ������� :</td>
                		<td dir="ltr" style="width: 20%;text-align:right"><strong>{num.cats}</strong></td>
                	</tr>
                	<tr>
                		<td style="width: 30%;text-align:right">��� ������ ������� :</td>
                		<td dir="ltr" style="width: 20%;text-align:right"><strong>{num.active}</strong></td>
                		<td style="width: 30%;text-align:right">��� ������ ����� �����&nbsp; :</td>
                		<td dir="ltr" style="width: 20%;text-align:right"><strong>{num.uctive}</strong></td>
                	</tr>
                	<tr>
                		<td style="width: 30%;text-align:right">��� ������ ������� :</td>
                		<td dir="ltr" style="width: 20%;text-align:right"><strong>{num.lsn}</strong></td>
                		<td style="width: 30%;text-align:right">��� ��������� :</td>
                		<td dir="ltr" style="width: 20%;text-align:right"><strong>{num.cmnts}</strong></td>
                	</tr>
                	<tr>
                		<td style="width: 30%;text-align:right">��� ������ :</td>
                		<td dir="ltr" style="width: 20%;text-align:right"><strong>{settings.counter}</strong></td>
                		<td style="width: 30%;text-align:right">��� ���������� :</td>
                		<td dir="ltr" style="width: 20%;text-align:right"><strong>{num.online}</strong></td>
                	</tr>
                	<tr>
                		<td style="width: 30%;text-align:right">��� ������� ������� :</td>
                		<td dir="ltr" style="width: 20%;text-align:right"><strong>{num.attach}</strong></td>
                		<td style="width: 30%;text-align:right">&nbsp;</td>
                		<td dir="ltr" style="width: 20%;text-align:right">&nbsp;</td>
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
        <IF Name="{Premission.8}">
        <br />
	    <table cellpadding="0" cellspacing="0" style="width: 75%" align="center">
	    	<tbody>
	    	<tr>
	    		<td><img alt="" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td class="Win_H" style="width: 100%">
	    		<img alt="" height="39" src="images/win_ht.gif" style="vertical-align: middle;" width="16" />
	    		����� ������</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
	    	<tr>
	    		<td class="Win_R">&nbsp;</td>
	    		<td class="Win_C" style="text-align: center;">
                <form action="index.php?action=updatenote" method="post">
                <br />
                    <textarea name="Notepad" style="width: 80%;height: 300px">{notepad}</textarea><br /><br />
                    <input type="submit" name="save" id="Button" value="���" />
                <br />
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
        </IF>
        <br />
	    <table cellpadding="0" cellspacing="0" style="width: 75%" align="center">
	    	<tbody>
	    	<tr>
	    		<td><img alt="" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td class="Win_H" style="width: 100%">
	    		<img alt="" height="39" src="images/win_ht.gif" style="vertical-align: middle;" width="16" />
	    		������� �� �������</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
	    	<tr>
	    		<td class="Win_R">&nbsp;</td>
	    		<td class="Win_C" style="text-align: right;">
                <table style="width: 100%">
                	<tr>
                		<td style="width: 20%">��� ������� :</td>
                		<td style="width: 80%">����� ������ ������ .</td>
                	</tr>
                	<tr>
                		<td style="width: 20%">����� ������� :</td>
                		<td style="width: 80%">&nbsp;4.0&nbsp;</td>
                	</tr>
                	<tr>
                		<td style="width: 20%">����� ������� :</td>
                		<td style="width: 80%"><a href="http://www.saleh.cc" target="_blank">���� �������</a> .</td>
                	</tr>
                	<tr>
                		<td style="width: 20%">���� ������� :</td>
                		<td style="width: 80%"><a href="http://www.ebda3sa.com" target="_blank">������� �������</a> .</td>
                	</tr>
                	<tr>
                		<td style="width: 20%">���� ������� :</td>
                		<td style="width: 80%">
                		<a href="http://www.saphplesson.org" target="_blank">http://www.saphplesson.org</a></td>
                	</tr>
                	<tr>
                		<td style="width: 20%">������ ������ :</td>
                		<td style="width: 80%"><a href="http://www.dt-live.com/" target="_blank">&nbsp;���� ��������
                		�������&nbsp;</a></td>
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
</div>
<br />
<div style="text-align: center;">
����� ������ ������ 4.0
<br />
<a href="http://www.saphplesson.org">http://www.saphplesson.org</a>
</div>
</body>

</html>