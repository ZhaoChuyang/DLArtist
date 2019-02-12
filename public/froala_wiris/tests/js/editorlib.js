$('head').append('<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />');
$('head').append('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">');
$('head').append('<script src="froala/js/plugins/froala_wiris/wiris.js"></script>');

/**
 * Creates a Froala instance instance on "example" div.
 * @param {String} lang Froala language. MathType integration read this variable to set the editor lang.
 * @param {String} wiriseditorparameters JSON containing MathType Web parameters.
 */
function createEditorInstance(lang, wiriseditorparameters) {
    var toolbar = ['undo', 'redo' , 'bold', '|', 'wirisEditor', 'wirisChemistry', '|', 'insertImage','html'];
    let froalaConfiguration = {
        // Add the custom buttons in the toolbarButtons list, after the separator.
        iframe: true,
        //toolbarInline: true,
        charCounterCount: false,
        imageEditButtons: ['wirisEditor', 'wirisChemistry', 'imageRemove'],
        toolbarButtons: toolbar,
        toolbarButtonsMD: toolbar,
        toolbarButtonsSM: toolbar,
        toolbarButtonsXS: toolbar,
        htmlAllowedTags: ['.*'],
        htmlAllowedAttrs: ['.*'],
        htmlAllowedEmptyTags: ['mprescripts'],
        imageResize : false,
        key: 'CA5D-16E3A2E3G1I4A8B8A9B1D2rxycF-7b1C3vyz==',
        heightMax: 310,
        useClasses: false
    };

    // This is done to test when the user doesn't initialize the editor with the language property.
	if (lang !== 'en') {
		froalaConfiguration.language = lang;
    }

    $('#example').froalaEditor(froalaConfiguration);

    // Disable demo padding.
    $('#example').css({'padding' : '0px'})
    // Insert Roboto font-family.
    var editor = $.FroalaEditor.INSTANCES[0];
    editor.$doc[0].body.style.fontFamily = "Roboto,sans-serif";
    updateFunction();
}

if (typeof _wrs_int_langCode !== 'undefined') {
    loadLangFile(_wrs_int_langCode, function(){createEditorInstance(parseLangToFroala(_wrs_int_langCode), {});});
} else {
    createEditorInstance('en', {});
}
function loadLangFile(lang, callback) {
    var script = document.createElement('script');
    script.src = ".\\froala\\js\\languages\\" + parseLangToFroala(lang) + ".js";
    script.onload = function() {
        callback();
    }
    script.onerror = function() {
      createEditorInstance('en', {});
    };
    document.head.appendChild(script);
}
function parseLangToFroala(lang) {
    var languages = {};
    languages['zh-tw'] = 'zh_tw';
    if (typeof languages[lang] !== 'undefined') {
        return languages[lang];
    } else {
        return lang;
    }
}


function getEditorData() {
    return $('#example').froalaEditor('html.get');
}

function setParametersSpecificPlugin(wiriseditorparameters) {
    _wrs_int_wirisProperties = wiriseditorparameters;
    $.FroalaEditor.INSTANCES[0].opts.wiriseditorparameters = wiriseditorparameters;
}