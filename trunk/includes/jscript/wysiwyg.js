/*if (is_saf)
{
	alert("·« Ì„ﬂ‰ «” Œœ«„ «·„Õ——");
}*/

var popupopen = false;

var controla = false;

var css_off = false;

var opacity = 0;

var ie_use_fader = 0;

var currentfont = "";
var currentsize = "";
var currentcolor = "";

var elm = new Object();
var htmlwindow = new Object();
var htmlbox = new Object();

var popupcontrols = new Array(
	"forecolor",
	"fontname",
	"fontsize",
	"smilie"
);

var contextcontrols = new Array(
	"bold",
	"italic",
	"underline",
	"justifyleft",
	"justifycenter",
	"justifyright",
	"justifyfull"
);

var controlexists = new Array();
controlexists = {
	"fontname"            : false,
	"fontsize"            : false,
	"forecolor"           : false,
	"bold"                : false,
	"italic"              : false,
	"underline"           : false,
	"justifyright"        : false,
	"justifycenter"       : false,
	"justifyleft"         : false,
	"justifyfull"         : false,
	"insertorderedlist"   : false,
	"insertunorderedlist" : false
}

var nofirekeys = new Array(
	9,                       // Tab
	16,17,18,19,20,          // Shift, Ctrl, alt, Pause/Break, Capslock
	27,                      // Escape
	33,34,35,36,37,38,39,40, // Page Up, Page Down, Home, End, Left, Up, Right, Down
	45,                      // Insert
	91, 93,                  // Windows / Context
	112,113,114,115,116,117, // F1 - F6
	118,119,120,121,122,123, // F7 - F12
	144,145                  // NumLock, ScrollLock
);

function formCheck(formobj){
var fieldRequired = Array("Writer", "mail", "lesstitle","forumno");
var fieldDescription = Array("«·«”‹‹‹„", "«·»‹‹—Ì‹‹œ «·≈·ﬂ —Ê‰Ì", "⁄‰Ê«‰ «·œ—”","«·ﬁ”„");
var alertMsg = "«·—Ã«¡ «ﬂ„«· «·ÕﬁÊ· «· «·Ì…:\n";

	var l_Msg = alertMsg.length;

	for (var i = 0; i < fieldRequired.length; i++){
		var obj = formobj.elements[fieldRequired[i]];
		if (obj){
			switch(obj.type){
			case "select-one":
				if (obj.selectedIndex == 0 || obj.options[obj.selectedIndex].text == ""){
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
		if (is_ie)
		{
			if (typeof(htmlwindow.innerHTML) == "undefined")
			{
				alert("«·—Ã«¡ «·«‰ Ÿ«— Õ Ï Ì „  Õ„Ì· «·„Õ——");
				return false;
			}
			formobj.WYSIWYG_HTML.value = htmlwindow.innerHTML;
		}
		else
		{
			formobj.WYSIWYG_HTML.value = htmlbox.body.innerHTML;
	        }
		return true;
	}else{
		alert(alertMsg);
		return false;
	}
}

function validatePost(tForm)
{
	if (is_ie)
	{
		if (typeof(htmlwindow.innerHTML) == "undefined")
		{
			alert("«·—Ã«¡ «·«‰ Ÿ«— Õ Ï Ì „  Õ„Ì· «·„Õ——");
			return false;
		}
		tForm.WYSIWYG_HTML.value = htmlwindow.innerHTML;
	}
	else
	{
		tForm.WYSIWYG_HTML.value = htmlbox.body.innerHTML;
	}

	return true;
}

function editInit()
{

	if (editor_loaded)
	{
		return;
	}

    editor_loaded = true;

    var starttime = new Date();

	for (key in controlexists)
	{
		controlexists[key] = object_exists("cmd_" + key);
	}

	var i = 0;
	for (colorkey in coloroptions)
	{
		colorindex[i++] = coloroptions[colorkey];
	}

    set_unselectable(fetch_object("controlbar"));

	var divs = fetch_object("controlbar").getElementsByTagName("div");
	for (i  = 0; i < divs.length; i++)
	{
		elm = divs[i];
		switch (elm.className)
		{
			case "imagebutton":
			{
				elm.cmd = elm.id.substr(4);
				elm.controlstate = "normal";
				if (typeof(elm.firstChild.alt) != "undefined")
				{
					elm.firstChild.title = elm.firstChild.alt;
				}
				elm.onmouseover = elm.onmouseout = elm.onmouseup = elm.onmousedown = button_eventhandler;
				elm.onclick = button_click;
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

	var color = 0;
	var font = 0;
	var size = 0;

	var tds = fetch_object("controlbar").getElementsByTagName("td");
	for (i = 0; i < tds.length; i++)
	{
		elm = tds[i];
		switch (elm.className)
		{
			case "ocolor":
			{
				elm.formatoption = elm.firstChild.style.background = colorindex[color];
				elm.id = "color_" + colorindex[color++].toLowerCase();
				//elm.title = elm.formatoption.replace(/([a-z]{1})([A-Z]{1})/g, "$1 $2");
                elm.title = colorarabic[color];
				elm.onmouseover = elm.onmouseout = elm.onmousedown = elm.onmouseup = select_eventhandler;
				elm.onclick = select_click;
			}
			break;
		}
	}

	if (controlexists['forecolor'])
	{
		var instantcolor = fetch_object("instantcolor");
		var colorbar = fetch_object("colorbar");
		colorbar.onmouseover = colorbar.onmouseout = colorbar.onmousedown = colorbar.onmouseup = colorbar_intercept;
		colorbar.onclick = instantcolor.onclick = set_instant_color;
	}

	if (is_ie)
	{
		htmlwindow = fetch_object("htmlbox");
		htmlbox = document;
		htmlwindow.contentEditable = true;
		htmlbox.execCommand("liveresize", false, null);

		try
		{
			hf = fetch_object("html_hidden_field");
			itxt = hf.value;
		}
		catch(e)
		{
			itxt = "<p></p>";
		}
		set_default_text(itxt, true);

		htmlwindow.onmouseup = set_context;
		htmlbox.onkeyup = set_context;

		htmlwindow.onkeypress = check_return;
		htmlwindow.onkeydown = check_select_all;
		htmlwindow.onclick = function () { controla = false; };
	}
	else
	{
		htmlwindow = fetch_object("htmlbox").contentWindow;
		htmlbox = htmlwindow.document;

		htmlbox.designMode = "on";


		var itxt;
		try
		{
			var hf = fetch_object("html_hidden_field");
			itxt = hf.value;
		}
		catch(e)
		{
			itxt = "";
		}
		set_default_text(itxt, true);

		htmlbox.addEventListener("mouseup", set_context, true);
		htmlbox.addEventListener("keyup", set_context, true);

		htmlbox.addEventListener("keypress", moz_intercept_keys, true);
	}

	if (controlexists['forecolor'])
	{
		fetch_object("colorbar").style.display = "";
	}

	window.onresize = close_popups;

	if (typeof(preview_focus) == "undefined" && typeof(require_click) == "undefined")
	{
		htmlwindow.focus(); 
	}
    var endtime = new Date();
}

function object_exists(objname)
{
	if (fetch_object(objname))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function check_return()
{
	if (window.event.keyCode == 13)
	{
		range = htmlbox.selection.createRange();
		parentelm = range.parentElement();

		while (parentelm.tagName != "P" && parentelm.tagName != "DIV")
		{
			parentelm = parentelm.parentNode;
		}

		if (parentelm.tagName == "P")
		{
			parentelm.style.margin = "0px";
		}
	}
}

function check_select_all()
{
	if (window.event.ctrlKey)
	{
		if (window.event.keyCode == 65)
		{
			controla = true;
		}
	}
	else if (controla && !window.event.shiftKey && !window.event.altKey)
	{
		if (in_array(window.event.keyCode, nofirekeys) == -1)
		{
			document.selection.createRange().pasteHTML("<p></p>");
		}
		controla = false;
	}
}

function set_context(clickedelm)
{

	if (!is_ie && !css_off)
	{
		try
		{
			htmlbox.execCommand("useCSS", false, true);
			css_off = true;
		}
		catch(e)
		{
			css_off = false;
		}
	}

	var qcs;
	for (var i in contextcontrols)
	{
		if (controlexists[contextcontrols[i]])
		{
			qcs = htmlbox.queryCommandState(contextcontrols[i]);
			if (typeof(buttonstatus[contextcontrols[i]]) != "undefined" && buttonstatus[contextcontrols[i]] != qcs)
			{
				buttonstatus[contextcontrols[i]] = qcs;
				button_context(fetch_object("cmd_" + contextcontrols[i]), contextcontrols[i] == clickedelm ? "mouseover" : "mouseout");
			}
		}
	}

	/*if (is_ie && !buttonstatus['justifycenter'] && !buttonstatus['justifyleft'] && !buttonstatus['justifyfull'])
	{
		buttonstatus['justifyright'] = true;
		button_context(fetch_object("cmd_justifyright"), "mouseout");
	}*/

	// do font context
	if (controlexists['fontname'])
	{
		var fontcontext = htmlbox.queryCommandValue("fontname");
		switch (fontcontext)
		{
			case "":
			{
				if (!is_ie)
				{
					fontcontext = htmlbox.body.style.fontFamily;
				}
			}
			break;

			case null:
			{
				fontcontext = "";
			}
			break;
		}
		if (fontcontext != currentfont)
		{
				var fontword = fontcontext;
				var commapos = fontword.indexOf(",");
				if (commapos != -1)
				{
					fontword = fontword.substr(0, commapos);
					fontword = fontword.substr(0, 1).toUpperCase() + fontword.substr(1);
				}
				fetch_object("SaFont").value = fontword;
			    currentfont = fontcontext;
		}
	}

	// do size context
	if (controlexists['fontsize'])
	{
		var sizecontext = htmlbox.queryCommandValue("fontsize");
		switch (sizecontext)
		{
			case "":
			{
				if (!is_ie)
				{
					sizecontext = moz_get_font_size(htmlbox.body.style.fontSize);
				}
			}
			break;

			case null:
			{
				sizecontext = "";
			}
			break;
		}
		if (sizecontext != currentsize)
		{

			fetch_object("SaSize").value = sizecontext;
			currentsize = sizecontext;
		}
	}

	// do forecolor context
	/*if (controlexists['forecolor'])
	{
		var colorcontext = htmlbox.queryCommandValue("forecolor");
		switch (colorcontext)
		{
			case "":
			{
				/*if (!is_ie)
				{
					sizecontext = moz_get_font_size(htmlbox.body.style.fontSize);
				}*/
			/*}
			break;

			case null:
			{
				sizecontext = "";
			}
			break;
		}
		if (colorcontext != currentcolor)
		{
            newcolor = '#'+(str_pad((colorcontext & 0xFF).toString(16), 2, 0)+str_pad(((colorcontext >> 8) & 0xFF).toString(16), 2, 0)+str_pad(((colorcontext >> 16) & 0xFF).toString(16), 2, 0)).toUpperCase();
            fetch_object("colorbar").style.backgroundColor = newcolor;
			currentcolor = colorcontext;
		}
	}*/

	close_popups();
}

function str_pad(text, length, padstring)
{
	text = new String(text);
	padstring = new String(padstring);

	if (text.length < length)
	{
		padtext = new String(padstring);

		while (padtext.length < (length - text.length))
		{
			padtext += padstring;
		}

		text = padtext.substr(0, (length - text.length)) + text;
	}

	return text;
}

function button_eventhandler(e, elm)
{
	e = do_an_e(e);
	button_context(elm ? elm : this, e.type);
}

function button_context(elm, state)
{
	if (elm == null)
	{
		return;
	}
	if (typeof(buttonstatus[elm.cmd]) == "undefined")
	{
		buttonstatus[elm.cmd] = null;
	}

	switch (buttonstatus[elm.cmd])
	{
		case "down":
		{
			format_control(elm, (elm.cmd == "forecolor") ? "popup" : "button", "down");
		}
		break;

		case true:
		{
			switch (state)
			{
				case "click":
				case "mouseout":
				{
					format_control(elm, "button", "selected");
				}
				break;

				case "mouseover":
				case "mousedown":
				{
					format_control(elm, "button", "down");
				}
				break;

				case "mouseup":
				{
					format_control(elm, "button", "hover");
				}
				break;
			}
		}
		break;

		default:
		{
			switch (state)
			{
				case "click":
				case "mouseout":
				{
					format_control(elm, "button", "normal");
				}
				break;

				case "mouseup":
				case "mouseover":
				{
					if (popupopen)
					{
						return;
					}
					else
					{
						format_control(elm, "button", "hover");
					}
				}
				break;

				case "mousedown":
				{
					format_control(elm, "button", "down");
				}
				break;
			}
		}
	}
}

function button_click(e, elm)
{
	e = do_an_e(e);
	elm = elm ? elm : this;

        /*htmlwindow.focus();
        if(is_ie){
          textselection = htmlbox.selection.createRange();
        }else{
          moz_get_html()
        }*/
	switch (elm.cmd)
	{
		case "forecolor":
		{
			if (buttonstatus[elm.cmd])
			{
				close_popups();
			}
			else
			{
				open_popup(elm, "popup_" + elm.cmd, e);
			}
		}
		break;

		case "insertimage":
		{
			imgurl = new String(prompt("√œŒ· —«»ÿ «·’Ê—…:", imgurl)).replace(/javascript:/gi, 'java_script:').replace(/"/g, '&quot;');

			if (imgurl != "http://" && imgurl != "" && imgurl != "undefined" && imgurl != null)
			{
				if (imgurl.match(/^https?:\/\//))
				{
					do_format("insertimage", false, imgurl);
				}
			}
		}
		break;

		case "youtube":
		{
			tubeurl = new String(prompt("√œŒ· —«»ÿ «·„ﬁÿ⁄:", "http://www.youtube.com/watch?v=XXXXXXX")).replace(/javascript:/gi, 'java_script:').replace(/"/g, '&quot;');

			if (tubeurl != "http://" && tubeurl != "" && tubeurl != "undefined" && tubeurl != null)
			{
				if (tubeurl.match(/^https?:\/\//))
				{
				    tubeurl = tubeurl.replace("watch?v=", 'v/');
					textselection.pasteHTML("[flash width=425 height=344]"+tubeurl+"[/flash]");
				}
			}
		}
		break;

		case "Decrease":
		{
			var box = fetch_object('htmlbox');
			var boxheight = parseInt(box.style.height);
			var newheight = boxheight - 100;
			if (newheight > 0)
			{
				box.style.height = newheight + "px";
			}
		}
		break;

		case "Increase":
		{
			var box = fetch_object('htmlbox');
			var boxheight = parseInt(box.style.height);
			var newheight = boxheight + 100;
			if (newheight > 0)
			{
				box.style.height = newheight + "px";
			}
		}
		break;

		case "flash":
                {
			var X = prompt("≈œŒ· —«»ÿ «·›·«‘","http://")
			if (X!="" & X!=null)
		{
		var W = prompt("≈œŒ· ⁄—÷ „·› «·›·«‘","400")
		var H = prompt("≈œŒ· ≈— ›«⁄ „·› «·›·«‘","300")
		
		if (W>600) {W=600};
		if (H>600) {H=600};
		
			if ((W=="" | W==null) & (H=="" | H==null))
			{
			textselection.pasteHTML("[flash]"+X+"[/flash]");

			return;
			}
		
			if ((W!="" | W!=null) & (H=="" | H==null))
			{
			textselection.pasteHTML("[flash width="+W+" height=300]"+X+"[/flash]");

			return;
			}
		
			if ((W=="" | W==null) & (H!="" | H!=null))
			{
			textselection.pasteHTML("[flash width=400 height="+H+"]"+X+"[/flash]");

			return;
			}
		
			if ((W!="" | W!=null) & (H!="" | H!=null))
			{
			textselection.pasteHTML("[flash width="+W+" height="+H+"]"+X+"[/flash]");

			return;
			}
		
        }
		}
		break;

		case "media":
		{
		     var X = prompt("≈œŒ· —«»ÿ «·„·›","http://")
		     if (X!="" & X!=null)
			{
			textselection.pasteHTML("[sound]"+X+"[/sound]");
                       }
		}
		break;
		
		case "realplayer":
		{
			var X = prompt("≈œŒ· —«»ÿ «·„·›","http://")
			if (X!="" & X!=null)
			{
			    textselection.pasteHTML("[RAM]"+X+"[/RAM]");
		        }
		}
		break;
		
		case "createlink":
		{
			if (is_ie)
			{
				do_format("createlink", true, null);
			}
			else
			{
				if (moz_get_html() == "")
				{
					alert("ÌÃ»  ÕœÌœ «·‰’");
					break;
				}
				var tmplink = prompt("√œŒ· «·—«»ÿ", linkurl);
				if (tmplink != "http://" && tmplink != "" && tmplink != "undefined" && tmplink != null)
				{
					linkurl = tmplink;
					do_format("createlink", false, linkurl);
				}
				else
				{
					linkurl = "http://";
					do_format("unlink", false, null);
				}
			}
		}
		break;

		case "unlink":
		{
			if (is_ie)
			{
				do_format("unlink", true, null);
			}
			else
			{
				if (moz_get_html() == "")
				{
					alert("ÌÃ»  ÕœÌœ «·‰’");
					break;
				}
				do_format("unlink", false, null);
			}
		}
		break;
		
		default:
		{
			if (elm.cmd.substr(0, 4) == "wrap")
			{
				wrap_tags(elm.cmd.substr(6).toUpperCase());
			}
			else
			{
				do_format(elm.cmd, false, null);
			}
		}
		break;
	}

	htmlwindow.focus();
}

function select_eventhandler(e, elm)
{
	e = do_an_e(e);
	select_context(elm = elm ? elm : this, e.type);
}

function select_context(elm, state)
{
	if (typeof(elm.formatoption) == "undefined" || typeof(buttonstatus[elm.formatoption]) == "undefined")
	{
		if (typeof(elm.formatoption) == "undefined")
		{
			elm.formatoption = elm.id;
		}
		buttonstatus[elm.formatoption] = null;
	}
	switch (buttonstatus[elm.formatoption])
	{
		case true:
		{
			switch (state)
			{
				case "click":
				case "mouseout":
				{
					format_control(elm, "button", "selected");
				}
				break;

				case "mouseover":
				case "mousedown":
				{
					format_control(elm, "menu", "down");
				}
				break;

				case "mouseup":
				{
					format_control(elm, "menu", "hover");
				}
				break;
			}
		}
		break;

		default:
		{
			switch (state)
			{
				case "click":
				case "mouseout":
				{
					format_control(elm, "menu", "normal");
					window.status = "";
				}
				break;

				case "mouseover":
				case "mouseup":
				{
					format_control(elm, "menu", "hover");
					window.status = elm.title;
				}
				break;

				case "mousedown":
				{
					format_control(elm, "menu", "down");
				}
				break;

				default: return;
			}
		}
	}
}

function select_click(e)
{
    //htmlwindow.focus();
    e = do_an_e(e);
	set_color(this.formatoption);
	return;
    //format_control(this, "menu", "normal");
}

function open_popup(buttonelement, menuname, e)
{
	close_popups();

	if (e)
	{
		e.cancelBubble = true;
	}

	if (menuname == "popup_forecolor")
	{
		var colorcontext = new String(htmlbox.queryCommandValue("forecolor")).toLowerCase();

		if (is_ie)
		{
			colorcontext = "#" + translate_ie_forecolor(colorcontext);
		}

		if (colorcontext.substr(0, 1) == "#")
		{
			colorcontext = colorcontext.toUpperCase();
			if (coloroptions[colorcontext])
			{
				colorcontext = coloroptions[colorcontext].toLowerCase();
			}
		}

		var colortds = fetch_object("popup_forecolor").getElementsByTagName("td");
		for (var i = 0; i < colortds.length; i++)
		{
			buttonstatus[colortds[i].formatoption] = false;
			format_control(colortds[i], "menu", "normal");
		}

		try
		{
			var selcolor = fetch_object("color_" + colorcontext);
			buttonstatus[selcolor.formatoption] = true;
			format_control(selcolor, "button", "selected");
		}
		catch(e) {}
	}

	buttonstatus[buttonelement.cmd] = "down";
	button_context(buttonelement, "mousedown");

	if (!is_ie)
	{
		var elmleft = getOffsetLeft(buttonelement);
		var elmtop = getOffsetTop(buttonelement) + buttonelement.offsetHeight;

		fetch_object(menuname).style.left = elmleft + "px";
		fetch_object(menuname).style.top = elmtop + "px";
	}

	popupopen = true;

	if (is_ie && ie_use_fader)
	{
		opacity = 0;
		fetch_object(menuname).filters.item(0).opacity = 0;
		fade_popup(menuname);
	}
	else
	{
		fetch_object(menuname).style.display = "";
	}
}

function fade_popup(itemid)
{
	elm = fetch_object(itemid)
	elm.style.display = "";

	if (opacity <= 100)
	{
		opacity += ie_use_fader;
		elm.filters.item(0).opacity = opacity;
		fadetimer = setTimeout("fade_popup('" + itemid + "');", 10);
	}
	else
	{
		opacity = 0;
		clearTimeout(fadetimer);
	}
}

function close_popups()
{
	if (!popupopen)
	{
		return;
	}

	popupopen = false;

	var curbutton, curpopup;
		if (controlexists["forecolor"])
		{
			curbutton = fetch_object("cmd_forecolor");
			buttonstatus[curbutton.cmd] = false;
			button_context(curbutton, "mouseout");

			curpopup = fetch_object("popup_forecolor");
			if (curpopup.style.display != "none")
			{
				curpopup.style.display = "none";
				curpopup.scrollTop = 0;
			}
		}

	if (is_ie && ie_use_fader && fadetimer)
	{
		clearTimeout(fadetimer);
	}
}

function translate_ie_forecolor(forecolor)
{
	if (is_ie)
	{
		var r = (forecolor & 0xFF).toString(16);
			r = r.length < 2 ? ("0" + r) : r;
		var g = ((forecolor >> 8) & 0xFF).toString(16);
			g = g.length < 2 ? ("0" + g) : g;
		var b = ((forecolor >> 16) & 0xFF).toString(16);
			b = b.length < 2 ? ("0" + b) : b;
		return (r + g + b).toUpperCase();
	}
	else
	{
		return forecolor;
	}
}

function call_system_color()
{
	curcolor = translate_ie_forecolor(htmlbox.queryCommandValue("forecolor"));

	newcolor = fetch_object("syscolorpicker").ChooseColorDlg(curcolor).toString(16);

	if (newcolor.length < 6)
	{
		tmpcolor = "000000".substring(0, 6 - newcolor.length);
		newcolor = tmpcolor.concat(newcolor);
	}

	if (newcolor == curcolor)
	{
		return false;
	}
	else
	{
		return newcolor;
	}
}

function do_format(formatcommand, showinterface, extraparameters)
{
	htmlwindow.focus();

	try
	{
		htmlbox.execCommand(formatcommand, showinterface, extraparameters);
		set_context(formatcommand);
	}
	catch(e)
	{
		switch (formatcommand.toLowerCase())
		{
			case "cut":
			case "copy":
			case "paste":
			{
				alert("ÌÃ»  Õ—Ì— „·› ŒÌ«—«  «·„ ’›Õ Õ Ï Ì„ﬂ‰ﬂ «·‰”Œ Ê«··’ﬁ");
			}
			break;

			default:
			{
				show_command_error(formatcommand);
			}
			break;
		}
	}

	htmlwindow.focus();

}

function set_color(colorname)
{
    fetch_object("colorbar").style.background = colorname;
	do_format("forecolor", false, colorname);
}

function wrap_tags(tagname)
{
        var strtag = "["+tagname+"]";
        var endtag = "[/"+tagname+"]";
	htmlwindow.focus();
	
	switch (tagname.toLowerCase())
	{
		case "code":
		case "vbasic":
		case "php":
		{
			htmlbox.execCommand("removeformat", false, null);
		}
		break;
		
		case "marquee-r":
		case "marquee-l":
		{
		   endtag = "[/MARQUEE]";
		}
		break;
	}

	if (is_ie)
	{
		textselection = htmlbox.selection.createRange();
		txt = textselection.htmlText.replace(/<p([^>]*)>(.*)<\/p>/i, '$2');
		textselection.pasteHTML(strtag+txt+endtag);
	}
	else
	{
		var frag = htmlbox.createDocumentFragment();
		var span = htmlbox.createElement("span");
		var txt  = moz_get_html();
		span.innerHTML = strtag+txt+endtag;

		while (span.firstChild)
		{
			frag.appendChild(span.firstChild);
		}

		moz_insert_node_at_selection(frag);
	}

	htmlwindow.focus();
}

function colorbar_intercept(e)
{
	e = do_an_e(e);
	button_context(fetch_object("cmd_forecolor"), e.type);
}

function set_instant_color(e)
{
	e = do_an_e(e);
	do_format("forecolor", false, fetch_object("colorbar").style.backgroundColor);
}

function getOffsetTop(elm)
{
	var mOffsetParent = elm.offsetParent;
	var mOffsetTop = elm.offsetTop;

	while(mOffsetParent)
	{
		mOffsetTop += mOffsetParent.offsetTop;
		mOffsetParent = mOffsetParent.offsetParent;
	}

	return mOffsetTop + (is_ie ? (parseInt(fetch_object("controlbar").currentStyle.borderLeftWidth) + 2) : 0);
}

function getOffsetLeft(elm)
{
	var mOffsetLeft = elm.offsetLeft;
	var mOffsetParent = elm.offsetParent;

	while(mOffsetParent)
	{
		mOffsetLeft += mOffsetParent.offsetLeft;
		mOffsetParent = mOffsetParent.offsetParent;
	}

	return mOffsetLeft + (is_ie ? (parseInt(fetch_object("controlbar").currentStyle.borderLeftWidth) + parseInt(fetch_object("controlbar").currentStyle.paddingLeft)) : 0);
}

function show_command_error(message)
{
	alert(message + ":\n ·« Ì„ﬂ‰  ‰›Ì– «·√„—");
}