var Spry; if (!Spry) Spry = {}; if (!Spry.Utils) Spry.Utils = {};


Spry.Utils.submitForm = function(form, target_div, callback, opts)
{
	
	if (!form)
		return true;

	if ( typeof form == 'string' )
		form = document.getElementById(form) || document.forms[form];
	
	var frmOpts = {};
	frmOpts.method = form.method;
	frmOpts.url = form.action || document.location.href;

	frmOpts.enctype = form.enctype;

	Spry.Utils.setOptions(frmOpts, opts);
	
	var submitData = Spry.Utils.extractParamsFromForm(form, frmOpts.elements);
	
	var target_div=document.getElementById(target_div);
	
	if (frmOpts.additionalData)
		submitData += "&" + frmOpts.additionalData;

	if (frmOpts.enctype.toLowerCase() != 'multipart/form-data')
	{
		// Ajax submission of a form doesn't work for multipart/form-data!
		frmOpts.method = (frmOpts.method.toLowerCase() == "post") ? 'POST' : 'GET';
		if (frmOpts.method == "GET")
		{
			// Data will be submitted in the url.
			if (frmOpts.url.indexOf('?') == -1)
				frmOpts.url += '?';
			else
				frmOpts.url += '&';
			frmOpts.url += submitData;
		}
		else
		{
			// Send Content-Type header.
			if (!frmOpts.headers) frmOpts.headers = {};
			if (!frmOpts.headers['Content-Type'] || frmOpts.headers['Content-Type'].indexOf("application/x-www-form-urlencoded") ==-1 )
				frmOpts.headers['Content-Type'] = 'application/x-www-form-urlencoded';

			// Set the postData
			frmOpts.postData = submitData;
		}

		Spry.Utils.loadURL(frmOpts.method, frmOpts.url, true, callback, frmOpts);

		return false;
	}
	// Native submission when 'multipart/form-data' is used.
	return false;
};


Spry.Utils.extractParamsFromForm = function (form, elements)
{
	if (!form)
		return '';

	if ( typeof form == 'string' )
		form = document.getElementById(form) || document.forms[form];

	var formElements;
	if (elements)
		formElements = ',' + elements.join(',') + ',';

	var compStack = new Array(); // key=value pairs

	var el;
	for (var i = 0; i < form.elements.length; i++ )
	{
		el = form.elements[i];
		
		/*if (el.disabled || !el.name)
		{
			// Don't submit disabled elements.
			// Don't submit elements without name.
			continue;
		}*/

		if (!el.type)
		{
			// It seems that this element doesn't have a type set,
			// so skip it.
			continue;
		}

		if (formElements && formElements.indexOf(',' + el.name + ',')==-1)
			continue;

		switch(el.type.toLowerCase())
		{
			case 'text':
			case 'password':
			case 'textarea':
			case 'hidden':
			case 'submit':
				compStack.push(encodeURIComponent(el.name) + '=' + encodeURIComponent(el.value));
				break;
			case 'select-one':
				var value = '';
				var opt;
				if (el.selectedIndex >= 0) {
					opt = el.options[el.selectedIndex];
					value = opt.value || opt.text;
				}
				compStack.push(encodeURIComponent(el.name) + '=' + encodeURIComponent(value));
				break;
			case 'select-multiple':
				for (var j = 0; j < el.length; j++)
				{
					if (el.options[j].selected)
					{
						value = el.options[j].value || el.options[j].text;
						compStack.push(encodeURIComponent(el.name) + '=' + encodeURIComponent(value));
					}
				}
				break;
			case 'checkbox':
			case 'radio':
				if (el.checked)
					compStack.push(encodeURIComponent(el.name) + '=' + encodeURIComponent(el.value));
				break;
			default:
			// file, button, reset
			break;
			}
		}
				
	return compStack.join('&');
};
