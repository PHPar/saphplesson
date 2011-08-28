function editInit()
{
   if (fetch_object("controlbar"))
   {
	var divs = fetch_object("controlbar").getElementsByTagName("div");
	for (var i  = 0; i < divs.length; i++)
	{
	  var elm = divs[i];
	  switch (elm.className)
	  {
	     case "imagebutton":
	     {
		elm.onmouseover = elm.onmouseout = elm.onmouseup = elm.onmousedown = button_eventhandler;
	     }
	     break;
	  }
	}

	var divs = fetch_object("smille").getElementsByTagName("div");
	for (var i  = 0; i < divs.length; i++)
	{
	  var elm = divs[i];
	  switch (elm.className)
	  { 
	     case "smille":
	     {
	     if (is_ie)
	     {
	     	elm.style.cursor = "hand";
	     }
	     else
	     {
	     	elm.style.cursor = "pointer";
	     }
	     }
	     break;
	  }
	}
    }

}

function button_eventhandler(e, elm)
{

	e = do_an_e(e);

	switch (e.type)
	{
		case "mousedown":
		{
			format_control(elm ? elm : this, "button", "down");
		}
		break;

		case "mouseover":
		case "mouseup":
		{
			format_control(elm ? elm : this, "button", "hover");
		}
		break;

		default:
		{
			format_control(elm ? elm : this, "button", "normal");
		}
	}
}

function SelectedText() {
    var Slct,Slctd;
    document.newless.less.focus();
    if (is_ie){
        Slct = document.selection;
        Slctd = Slct.createRange();
    }else{
        var start_selection = document.newless.less.selectionStart;
        var end_selection = document.newless.less.selectionEnd;
        Slctd = (document.newless.less.value).substring(start_selection, end_selection);
    }
    return Slctd;
}

function ChangeCode(start,end){
    var SelectText = SelectedText();
        if (is_ie){
            SelectText.text = start + SelectText.text + end;
        }else{
            var start_selection = document.newless.less.selectionStart;
            var end_selection = document.newless.less.selectionEnd;
            var startless = (document.newless.less.value).substring(0, start_selection);
            var endless = (document.newless.less.value).substring(end_selection, document.newless.less.textLength);
            SelectText = start + SelectText + end;
            document.newless.less.value = startless + SelectText + endless;
        }
}

function Code(C)
{

    if (C==1)
    {
        ChangeCode("[B]","[/B]");
    }

    if (C==2)
    {
        ChangeCode("[I]","[/I]");
    }

    if (C==3)
    {
        ChangeCode("[U]","[/U]");
    }

    if (C==4)
    {
        ChangeCode("[CENTER]","[/CENTER]");
    }

    if (C==5)
    {
        ChangeCode("[RIGHT]","[/P]");
    }

    if (C==6)
    {
        ChangeCode("[JUSTIFY]","[/P]");
    }

    if (C==7)
    {
        ChangeCode("[CODE]","[/CODE]");
    }

    if (C==8)
    {
        ChangeCode("[VBASIC]","[/VBASIC]");
    }

    if (C==9)
    {
        ChangeCode("[PHP]","[/PHP]");
    }

    if (C==10)
    {
        ChangeCode("[MARQUEE-R]","[/MARQUEE]");
    }

    if (C==11)
    {
        ChangeCode("[MARQUEE-L]","[/MARQUEE]");
    }

    if (C==12)
    {
        var ColorName=document.newless.ColorList.value;
        document.newless.ColorList.value = "0"
        ChangeCode( "[color="+ColorName+"]","[/color]");
    }

    if (C==13)
    {
        var FontSize=document.newless.FontsList.options.selectedIndex;
        document.newless.FontsList.value = "1"
        ChangeCode("[SIZE="+FontSize+"]","[/SIZE]");
    }

    if (C==14)
    {
        FontName=document.newless.FontNamesList.value
        document.newless.FontNamesList.value = "1"
        ChangeCode("[FONT="+FontName+"]","[/FONT]");
    }

    if (C==15)
    {
        ChangeCode("[LEFT]","[/P]");
    }
}

function Saleh(CMD) {
  var SText = SelectedText();
  SText.execCommand(CMD);
}



function UrlCode()
{
	var N = prompt("≈œŒ· «”„ «·„Êﬁ⁄ (≈Œ Ì«—Ï","")
	var X = prompt("≈œŒ· Ê’·… «·„Êﬁ⁄","http://")

	if (X=="" | X==null | X=='http://') {return;}

	if(X.substr(0,4)!="http")
	{
	alert("»—Ã«¡ ≈œŒ«· „”«— «·„Êﬁ⁄ »ÿ—Ìﬁ… ’ÕÌÕ… \n http://Url");
	newless.less.focus();
	return;
	}

	if (N=="" | N==null)
	{
	newless.less.value=newless.less.value + "[url]"+X+"[/url]";
	newless.less.focus();
	}
	else
	{
	newless.less.value=newless.less.value + "[URL="+X+"]"+N+"[/URL]";
	newless.less.focus();
	}

}


function ImgCode()
{
    var lsnbox = document.newless.less;
    lsnbox.focus();
    var rng = SelectedText();
    X = new String(prompt("√œŒ· —«»ÿ «·’Ê—…:", "http://")).replace(/javascript:/gi, 'java_script:').replace(/"/g, '&quot;');

	if (X != "http://" && X != "" && X != "undefined" && X != 'null')
	{
        if(is_ie){
            var sel = document.selection;
            if (rng != null && (sel.type == "Text" || sel.type == "None"))
            {
                text = rng.text;
            }
        }
        if (rng != null && lsnbox.createTextRange)
        {
            lsnbox.caretPos = rng.duplicate();
        }

        if (typeof(lsnbox.createTextRange) != "undefined" && lsnbox.caretPos)
        {
            var caretPos = lsnbox.caretPos;
            caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? " [img]"+X+"[/img] " + ' ' : " [img]"+X+"[/img] ";
            caretPos.select();
        }
        else if (lsnbox.selectionStart || lsnbox.selectionStart == '0')
        {
            var start_selection = lsnbox.selectionStart;
            var end_selection = lsnbox.selectionEnd;

            var start = (lsnbox.value).substring(0, start_selection);
            var middle = " [img]"+X+"[/img] ";
            var end = (lsnbox.value).substring(end_selection, lsnbox.textLength);

            lsnbox.value = start + middle + end;
            lsnbox.focus();
            lsnbox.selectionStart = end_selection + middle.length;
            lsnbox.selectionEnd = start_selection + middle.length;
        }
        else
        {
            lsnbox.value += " [img]"+X+"[/img] ";
        }
    }

}

function RamCode()
{
	var X = prompt("≈œŒ· —«»ÿ «·„·›","http://")
	if (X!="" & X!=null)
    {
        newless.less.value=newless.less.value + "[RAM]"+X+"[/RAM]";
        newless.less.focus();
    }

}


function MidiCode()
{
	var X = prompt("≈œŒ· —«»ÿ «·„·›","http://")
	if (X!="" & X!=null)
    {
        newless.less.value=newless.less.value + "[sound]"+X+"[/sound]";
        newless.less.focus();
    }

}

function YouTubeCode()
{
    var lsnbox = document.newless.less;
    lsnbox.focus();
    var rng = SelectedText();
    X = new String(prompt("√œŒ· —«»ÿ «·„ﬁÿ⁄:", "http://www.youtube.com/watch?v=XXXXXXX")).replace(/javascript:/gi, 'java_script:').replace(/"/g, '&quot;');

	if (X != "http://" && X != "" && X != "undefined" && X != 'null')
	{
        X = X.replace("watch?v=", 'v/');
        if(is_ie){
            var sel = document.selection;
            if (rng != null && (sel.type == "Text" || sel.type == "None"))
            {
                text = rng.text;
            }
        }
        if (rng != null && lsnbox.createTextRange)
        {
            lsnbox.caretPos = rng.duplicate();
        }

        if (typeof(lsnbox.createTextRange) != "undefined" && lsnbox.caretPos)
        {
            var caretPos = lsnbox.caretPos;
            caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? " [flash width=425 height=344]"+X+"[/flash] " + ' ' : " [flash width=425 height=344]"+X+"[/flash] ";
            caretPos.select();
        }
        else if (lsnbox.selectionStart || lsnbox.selectionStart == '0')
        {
            var start_selection = lsnbox.selectionStart;
            var end_selection = lsnbox.selectionEnd;

            var start = (lsnbox.value).substring(0, start_selection);
            var middle = " [flash width=425 height=344]"+X+"[/flash] ";
            var end = (lsnbox.value).substring(end_selection, lsnbox.textLength);

            lsnbox.value = start + middle + end;
            lsnbox.focus();
            lsnbox.selectionStart = end_selection + middle.length;
            lsnbox.selectionEnd = start_selection + middle.length;
        }
        else
        {
            lsnbox.value += " [flash width=425 height=344]"+X+"[/flash] ";
        }
    }
}

function FlashCode()
{
	var X = prompt("≈œŒ· —«»ÿ «·›·«‘","http://")
	if (X!="" & X!=null)
    {
        var W = prompt("≈œŒ· ⁄—÷ „·› «·›·«‘ (≈Œ Ì«—Ï(","")
        var H = prompt("≈œŒ· ≈— ›«⁄ „·› «·›·«‘ (≈Œ Ì«—Ï(","")

        if (W>600) {W=600};
        if (H>600) {H=600};

        	if ((W=="" | W==null) & (H=="" | H==null))
        	{
        	newless.less.value=newless.less.value + "[flash="+X+"[/flash]";
        	newless.less.focus();
        	return;
        	}

        	if ((W!="" | W!=null) & (H=="" | H==null))
        	{
        	newless.less.value=newless.less.value + "[flash=\""+X+"\""+" width="+W+"[/flash]";
        	newless.less.focus();
        	return;
        	}

        	if ((W=="" | W==null) & (H!="" | H!=null))
        	{
        	newless.less.value=newless.less.value + "[flash=\""+X+"\""+" height="+H+"[/flash]";
        	newless.less.focus();
        	return;
        	}

        	if ((W!="" | W!=null) & (H!="" | H!=null))
        	{
        	newless.less.value=newless.less.value + "[flash=\""+X+"\""+" width="+W+" height="+H+"[/flash]";
        	newless.less.focus();
        	return;
        	}

    }

}

function formCheck(formobj){
var fieldRequired = Array("Writer", "mail", "lesstitle", "less","forumno");
var fieldDescription = Array("«·«”‹‹‹„", "«·»‹‹—Ì‹‹œ «·≈·ﬂ —Ê‰Ì", "⁄‰Ê«‰ «·œ—”", "«·‹‹‹œ—”","«·ﬁ”„");
var alertMsg = "«·—Ã«¡ «ﬂ„«· «·ÕﬁÊ· «· «·Ì…:\n";

	var l_Msg = alertMsg.length;

	for (var i = 0; i < fieldRequired.length; i++){
		var obj = formobj.elements[fieldRequired[i]];
		if (obj){
			switch(obj.type){
			case "select-one":
				if (obj.selectedIndex == -1 || obj.options[obj.selectedIndex].text == ""){
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
				break;
			case "select-multiple":
				if (obj.selectedIndex == -1){
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
				break;
			case "text":
			case "textarea":
				if (obj.value == "" || obj.value == null){
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
				break;
			default:
			}
			if (obj.type == undefined){
				var blnchecked = false;
				for (var j = 0; j < obj.length; j++){
					if (obj[j].checked){
						blnchecked = true;
					}
				}
				if (!blnchecked){
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
			}
		}
	}

	if (alertMsg.length == l_Msg){
		return true;
	}else{
		alert(alertMsg);
		return false;
	}
}