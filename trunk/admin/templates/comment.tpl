<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta content="ar-sa" http-equiv="Content-Language" />
  <meta content="text/html; charset=windows-1256" http-equiv="Content-Type" />
  <title>��������� | ����� ������ ������</title>
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
            parent.document.title = "����� ������ ������ - ���� ������";
        }
    }
  </script>
</head>

<body onload="set_title()" style="background-color: #F1F1F1">



<div align="center" style="text-align:center;">
    <div class="PageTitle">
        ��� ������� ����� ({lsn.lesstitle})
    </div>
    <br />
    <form action="comment.php?action=delete" name="cmnts" method="post">
	    <table cellpadding="0" align="center" cellspacing="0" style="width: 90%">
	    	<tbody>
	    	<tr>
	    		<td class="Win_H"><img alt="" align="right" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td style="text-align: center;" class="Win_H" style="width: 2%">
	    		<input type="checkbox" name="SelectAll" onclick="negateChoice(cmnts,this.checked)" title="����� ����" value="ALL" id="ALL" /></td>
	    		<td style="text-align: center;" class="Win_H" style="width: 25%">
	    		���� �������</td>
	    		<td style="text-align: center;" class="Win_H" style="width: 35%">
	    		�������</td>
	    		<td style="text-align: center;" class="Win_H" style="width: 20%">
	    		���� ������</td>
	    		<td style="text-align: center;" class="Win_H" style="width: 20%">
	    		����� �������</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
            <IF Name="{ncmnt}">
            <LOOP Name="{cmnts}">
	    	<tr bgcolor="#F2F2F2|#DDDDDD" style="height:22px">
	    		<td class="Win_R">&nbsp;</td>
                <td style="text-align: right">
                <input type="checkbox" name="c[{{CID}}]" value="ALL" id="i[{{CID}}]" /></td></td>
                <label for="i[{{CID}}]">
	    		<td style="text-align: right">
	    		&nbsp;{{CName}}
	    		</td>
	    		<td style="text-align: center">
	    		&nbsp;{{Cmnt}}
	    		</td>
	    		<td style="text-align: center">
	    		&nbsp;<a href="mailto:{{CMail}}">{{CMail}}</a>
	    		</td>
	    		<td style="text-align: center">
	    		&nbsp;{{Date}}
	    		</td>
                </label>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
            </LOOP>
            <ELSE>
	    	<tr bgcolor="#F2F2F2" style="height:22px">
	    		<td class="Win_R">&nbsp;</td>
                <td style="text-align: center" colspan="5">�� ���� ������� ��� ����� ������</td>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
            </IF>
	    	<tr>
	    		<td class="Win_F"><img alt="" align="right" height="20" src="images/win_fr.gif" width="19" /></td>
	    		<td class="Win_F" colspan="5">&nbsp;</td>
	    		<td class="Win_F"><img alt="" align="left" height="20" src="images/win_fl.gif" width="15" /></td>
	    	</tr>
	    </tbody>
	    </table>
	    <br />
        <div style="text-align:center">
            <input type="submit" name="Submit" id="Button" value="��� ��������� �������" />
        </div>
    </form>
</div>

<br />
<div style="text-align: center;">
����� ������ ������ 4.0
<br />
<a href="http://www.saphplesson.org">http://www.saphplesson.org</a>
</div>

</body>

</html>