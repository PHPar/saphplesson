/////////////////////////////////////
//        SaphpLesson3.0           //
//       E-Mail:saphp@msn.com      //
//           sajava.js             //
/////////////////////////////////////

var userAgent = navigator.userAgent.toLowerCase();
var is_opera  = (userAgent.indexOf('opera') != -1);
var is_saf    = ((userAgent.indexOf('applewebkit') != -1) || (navigator.vendor == "Apple Computer, Inc."));
var is_webtv  = (userAgent.indexOf('webtv') != -1);
var is_ie     = ((userAgent.indexOf('msie') != -1) && (!is_opera) && (!is_saf) && (!is_webtv));
var is_ie4    = ((is_ie) && (userAgent.indexOf("msie 4.") != -1));
var is_moz    = ((navigator.product == 'Gecko') && (!is_saf));
var is_kon    = (userAgent.indexOf('konqueror') != -1);
var is_ns     = ((userAgent.indexOf('compatible') == -1) && (userAgent.indexOf('mozilla') != -1) && (!is_opera) && (!is_webtv) && (!is_saf));
var is_ns4    = ((is_ns) && (parseInt(navigator.appVersion) == 4));


var DOMtype = '';
if (document.getElementById)
{
	DOMtype = "std";
}
else if (document.all)
{
	DOMtype = "ie4";
}
else if (document.layers)
{
	DOMtype = "ns4";
}

var Objects = new Array();

function fetch_object(idname, forcefetch)
{
	if (forcefetch || typeof(Objects[idname]) == "undefined")
	{
		switch (DOMtype)
		{
			case "std":
			{
				Objects[idname] = document.getElementById(idname);
			}
			break;

			case "ie4":
			{
				Objects[idname] = document.all[idname];
			}
			break;

			case "ns4":
			{
				Objects[idname] = document.layers[idname];
			}
			break;
		}
	}
	return Objects[idname];
}

function do_an_e(eventobj)
{
	if (!eventobj || is_ie)
	{
		window.event.returnValue = false;
		window.event.cancelBubble = true;
		return window.event;
	}
	else
	{
		eventobj.stopPropagation();
		eventobj.preventDefault();
		return eventobj;
	}
}

function detect_caps_lock(e)
{
	e = (e ? e : window.event);

	var keycode = (e.which ? e.which : (e.keyCode ? e.keyCode : (e.charCode ? e.charCode : 0)));
	var shifted = (e.shiftKey || (e.modifiers && (e.modifiers & 4)));
	var ctrled = (e.ctrlKey || (e.modifiers && (e.modifiers & 2)));

	// if characters are uppercase without shift, or lowercase with shift, caps-lock is on.
	return (keycode >= 65 && keycode <= 90 && !shifted && !ctrled) || (keycode >= 97 && keycode <= 122 && shifted);
}

function tc(ico) {
    document.tic.src="images/icon/"+ico+".gif";
    document.newless.ico.value=ico ;
}

function icon(X,sys,elm)
{
    if (sys=="w"){
        if (typeof(document.selection) != "undefined" && document.selection.type != "Text" && document.selection.type != "None")
        {
            document.selection.clear();
        }
        htmlwindow.focus();
        if (is_ie)
        {
            smilieHTML = '<img src="'+ elm.getElementsByTagName("img")[0].src +'" border="0" alt="" SID="' + X + '" /> ';
            htmlbox.selection.createRange().pasteHTML(smilieHTML);
        }else{
            htmlbox.execCommand('InsertImage', false, elm.getElementsByTagName("img")[0].src);
            var smilies = htmlbox.getElementsByTagName("img");
            for (var i = 0; i < smilies.length; i++)
            {
                if (smilies[i].src == elm.getElementsByTagName("img")[0].src)
                {
                    if (smilies[i].getAttribute("SID") < 1)
                    {
                        smilies[i].setAttribute("SID", X);
                        smilies[i].setAttribute("border", "0");
                    }
                }
            }
        }
    }else{
        document.newless.less.focus();
        var rng = SelectedText();

        if(is_ie){
            var sel = document.selection;
            if (rng != null && (sel.type == "Text" || sel.type == "None"))
            {
                text = rng.text;
            }
        }
        if (rng != null && document.newless.less.createTextRange)
        {
            document.newless.less.caretPos = rng.duplicate();
        }

        if (typeof(document.newless.less.createTextRange) != "undefined" && document.newless.less.caretPos)
        {
            var caretPos = document.newless.less.caretPos;
            caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? " [icon]"+X+"[/icon] " + ' ' : " [icon]"+X+"[/icon] ";
            caretPos.select();
        }
        else if (document.newless.less.selectionStart || document.newless.less.selectionStart == '0')
        {
            var start_selection = document.newless.less.selectionStart;
            var end_selection = document.newless.less.selectionEnd;

            var start = (document.newless.less.value).substring(0, start_selection);
            var middle = " [icon]"+X+"[/icon] ";
            var end = (document.newless.less.value).substring(end_selection, document.newless.less.textLength);

            document.newless.less.value = start + middle + end;
            document.newless.less.focus();
            document.newless.less.selectionStart = end_selection + middle.length;
            document.newless.less.selectionEnd = start_selection + middle.length;
        }
        else
        {
            document.newless.less.value += " [icon]"+X+"[/icon] ";
        }
    }
}