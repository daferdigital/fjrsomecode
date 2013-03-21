/*	Prototype JavaScript (lite version from CNET via mad4milk.net) framework, modified to work on top of MooTools
 *	(c) 2005 Sam Stephenson <sam@conio.net>
 *	Prototype is freely distributable under the terms of an MIT-style license.
 *	For details, see the Prototype web site: http://prototype.conio.net/
/*--------------------------------------------------------------------------*/
//note: modified & stripped down version of prototype, to be used with mootools by mad4milk (http://mootools.net)
//this file depends on MooTools: Moo.js, Array.js, Element.js, String.js
var Prototype = {
	Version: 'CNET Prototype Lite, MooTools edition ver. 1.0',
	ScriptFragment: '(?:<script.*?>)((\n|\r|.)*?)(?:<\/script>)',
	emptyFunction: function() {},
	K: function(x) {return x}
};

Function.prototype.bind = function(object) {
	var __method = this;
	return function() { return __method.apply(object, arguments); }
};
Function.prototype.bindAsEventListener = function(object) {
var __method = this;
	return function(event) { __method.call(object, event || window.event); }
};
Object.extend(String.prototype, {
	camelize: function() {
		var oStringList = this.split('-');
		if (oStringList.length == 1) return oStringList[0];

		var camelizedString = this.indexOf('-') == 0
			? oStringList[0].charAt(0).toUpperCase() + oStringList[0].substring(1)
			: oStringList[0];

		for (var i = 1, len = oStringList.length; i < len; i++) {
			var s = oStringList[i];
			camelizedString += s.charAt(0).toUpperCase() + s.substring(1);
		}

		return camelizedString;
	}
});
var Position = {
	cumulativeOffset: function(element) {
		var valueT = 0, valueL = 0;
		do {
			valueT += element.offsetTop	|| 0;
			valueL += element.offsetLeft || 0;
			element = element.offsetParent;
		} while (element);
		return [valueL, valueT];
	}
};
var Abstract = new Object();
Abstract.EventObserver = function() {};
Abstract.EventObserver.prototype = {
	initialize: function(element, callback) {
		this.element	= $(element); this.callback = callback; this.lastValue = this.getValue();
		if (this.element.tagName.toLowerCase() == 'form') this.registerFormCallbacks();
		else this.registerCallback(this.element);
	},
	onElementEvent: function() {
		var value = this.getValue();
		if (this.lastValue != value) { this.callback(this.element, value); this.lastValue = value; }
	}
};
if (!window.Event) { var Event = new Object(); }
Object.extend(Event, {
	element: function(event) {return event.target || event.srcElement;},
	stop: function(event) {
		if (event.preventDefault) {event.preventDefault();event.stopPropagation();
		} else {event.returnValue = false;event.cancelBubble = true;}
	},
	// find the first node with the given tagName, starting from the
	// node the event was triggered on; traverses the DOM upwards
	findElement: function(event, tagName) {
		var element = Event.element(event);
		while (element.parentNode && (!element.tagName || (element.tagName.toUpperCase() != tagName.toUpperCase())))
			element = element.parentNode; return element;
	},
	observers: false,
	_observeAndCache: function(element, name, observer, useCapture) {
		if (!this.observers) this.observers = [];
		if (element.addEventListener) {
			this.observers.push([element, name, observer, useCapture]);
			element.addEventListener(name, observer, useCapture);
		} else if (element.attachEvent) {
			this.observers.push([element, name, observer, useCapture]);
			element.attachEvent('on' + name, observer);
		}
	},
	unloadCache: function() {
		if (!Event.observers) return;
		for (var i = 0; i < Event.observers.length; i++) {
			Event.stopObserving.apply(this, Event.observers[i]);
			Event.observers[i][0] = null;
		}
		Event.observers = false;
	},
	observe: function(element, name, observer, useCapture) {
		var element = $(element);
		useCapture = useCapture || false;
		if (name == 'keypress' && (navigator.appVersion.match(/Konqueror|Safari|KHTML/) || element.attachEvent))
			name = 'keydown';
		this._observeAndCache(element, name, observer, useCapture);
	},
	stopObserving: function(element, name, observer, useCapture) {
		var element = $(element);
		useCapture = useCapture || false;
		if (name == 'keypress' && (navigator.appVersion.match(/Konqueror|Safari|KHTML/) || element.detachEvent))
			name = 'keydown';
		if (element.removeEventListener) { element.removeEventListener(name, observer, useCapture);
		} else if (element.detachEvent) { element.detachEvent('on' + name, observer); }
	}
});


/* -- DOM READY -- */
//cnet.mootools.extentions.js
//these are mootools authored extensions designed to allow prototype.lite libraries run in this environment.
Object.extend(String, {
	stripScripts: function() {
		return this.replace(new RegExp(Prototype.ScriptFragment, 'img'), '');
	},
	evalScripts: function() {
		return this.extractScripts().map(eval);
	},
	replaceAll: function(searchValue, replaceValue) {
		var replaceRegex = new RegExp("%"+searchValue+"%","g");
		var parsed = this.replace(replaceRegex, replaceValue);
		return parsed;
	},
	urlEncode: function() {
		if (this.indexOf('%') > -1) return this;
		else return escape(this);
	}
});
Object.extend(Element, {
	getDimensions: function(element) {
		return $(element).getDimensions();
	},	
	visible: function(element) {
		return $(element).visible();
	},
	toggle: function(element) {
		return $(element).toggle();
	},
	hide: function(element) {
		return $(element).hide();
	},
	show: function(element) {
		return $(element).show();
	},
	cleanWhitespace: function(element) {
		return $(element).cleanWhitespace();
	},
	find: function(element, what) {
		return $(element).find(what);
	},
	replace: function(element, html) {
		$(element).replace(html);
	},
	empty: function(element) {
		return $(element).empty();
	}
});
/* -- IMPORTANT
			This code is included in the global framework, even if the prototype code above is not
 -- */
Element.extend({
	getDimensions: function() {
		return {width: this.getStyle('width', true), height: this.getStyle('height', true)};
	},	
	visible: function() {
		return this.getStyle('display') != 'none';
	},
	toggle: function() {
		return this[this.visible() ? 'hide' : 'show']();
	},
	hide: function() {
		this.originalDisplay = this.style.display; 
		this.style.display = 'none';
		return this;
	},
	show: function(display) {
		this.style.display = display || this.originalDisplay || 'block';
		return this;
	},
	cleanWhitespace: function() {
		$A(this.childNodes).each(function(node){
			if (node.nodeType == 3 && !/\S/.test(node.nodeValue)) node.parentNode.removeChild(node);
		});
	},
	find: function(what) {
		var el = this;
		while (el.nodeType != 1) el = el[what];
		return el;
	},
	replace: function(html) {
		if (this.outerHTML) {
			this.outerHTML = html.stripScripts();
		} else {
			var range = this.ownerDocument.createRange();
			range.selectNodeContents(this);
			this.parentNode.replaceChild(
				range.createContextualFragment(html.stripScripts()), this);
		}
		setTimeout(function() {html.evalScripts()}, 10);
	},
	empty: function() {
		return this.innerHTML.match(/^\s*$/);
	},
	getOffsetHeight: function(){ return this.getStyle('height'); },
	getOffsetWidth: function(){ return this.getStyle('width'); }
});
Array.extend({
	indexOf: function(item) {
		for (var i = 0; i < this.length; i++){
			if (this[i] == item) return i;
		};
	}
});
Window.extend({
	isLoaded: false,
	getHost:function(url){
		if(!$type(url)) url = window.location.href;
		this.host = url;
		if(url.indexOf('http://'))
			this.host = url.substring(url.indexOf('http://')+7,url.length);
		if(url.indexOf('/'))
			this.host = url.substring(0,url.indexOf('/'));
		return this.host;
	}
/* -- 	asLoad: function(fn){
		try {
			fn();
			if(!Window.isLoaded()) {
				Window.asLoad.pass(fn).delay(20);
			} else {
				dbug.log('window loaded, delaying function call one more time');
				fn.delay(20);
			}
		} catch(e){dbug.log(e);}
	} -- */
});



/*	cannot be packed by dean edward's packer:	*/
Object.extend(Event, {
	_domReady : function() {
		if (arguments.callee.done) return;
		arguments.callee.done = true;

		if (this._timer)	clearInterval(this._timer);
		
		$A(this._readyCallbacks).each(function(f) { 
			//try {
				f()
			//} catch(e){dbug.log('onDOMReady function call error: %s', e);}
		});
		this._readyCallbacks = null;
	},
	onDOMReady : function(f) {
		if (!this._readyCallbacks) {
			var domReady = this._domReady.bind(this);
			
			if (document.addEventListener)
				document.addEventListener("DOMContentLoaded", domReady, false);
/*	THIS SECTION MUST NOT BE REMOVED BY COMPRESSION	*/				
				/*@cc_on @*/
				/*@if (@_win32)
						document.write("<script id=__ie_onload defer src=javascript:void(0)><\/script>");
						document.getElementById("__ie_onload").onreadystatechange = function() {
								if (this.readyState == "complete") domReady(); 
						};
				/*@end @*/
/*	THIS SECTION MUST NOT BE REMOVED BY COMPRESSION	*/
				if (/WebKit/i.test(navigator.userAgent)) { 
					this._timer = setInterval(function() {
						if (/loaded|complete/.test(document.readyState)) domReady(); 
					}, 10);
				}
				
				Event.observe(window, 'load', domReady);
				Event._readyCallbacks =	[];
		}
		Event._readyCallbacks.push(f);
	}
});
