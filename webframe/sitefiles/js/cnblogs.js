function copyCnblogsCode(element) {
	alter("fuck");
var codeContainer = getCnblogsCodeContainer(element);
var cbCode = getCnblogsCodeText(codeContainer);
var textarea = document.createElement('textarea');
$(textarea).val(cbCode).select();
$(textarea).css("width", $(codeContainer).css("width"));
$(textarea).css("height", $(codeContainer).css("height"));
$(textarea).css("font-family", "Courier New");
$(textarea).css("font-size", "12px");
$(textarea).css("line-height", "1.5");
$(codeContainer).parent().html(textarea);
$(textarea).select();
$("<div>按 Ctrl+C 复制代码</div>").insertAfter($(textarea));
}

function getCnblogsCodeContainer(element) {
var codeContainer = $(element).parent().parent().parent().find("pre");
if (codeContainer.length == 0) {
codeContainer = $(element).parent().parent().parent().find("div").first();
}
return codeContainer;
}

function getCnblogsCodeText(codeContainer) {
var cbCode = '\n' + $(codeContainer).html()
.replace(/ /g, ' ')
.replace(/<br\s*\/?>/ig, '\n')
.replace(/<[^>]*>/g, '');
cbCode = cbCode.replace(/\n(\s*\d+)/ig, '\n');
cbCode = cbCode.replace(/\n/g, '\r\n');
if (typeof Encoder != undefined) {
cbCode = Encoder.htmlDecode(cbCode);
}
cbCode = $.trim(cbCode);
return cbCode;
}
