$('#editor').trumbowyg({
	btns: [
		['viewHTML'],
		['formatting'],
		['strong', 'em', 'del'],
		['superscript', 'subscript'],
		['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
		['unorderedList', 'orderedList'],
		['horizontalRule'],
		['removeformat'],
		['fullscreen'],
		['fontsize'],
	],
	ow: true,
	lang: 'ar',
});
$('#editor').trumbowyg(
	'html',
	`
<h3 style="text-align: center;">شهادة مشاركة</h3>
<h3 style="text-align: center; ">تشهد <span >{اسم_المنظمة}</span> بأنّ&nbsp;</h3>
<h2 style="text-align: center; "><span >{اسم_المشارك}</span></h2>
<h3 style="text-align: center; ">&nbsp;قد شارك في دورة <span >{اسم_الدورة}</span> المقامة في
    <span >{الموقع}</span> بتاريخ
    <span >{تاريخ_البدايةوالنهاية}</span>&nbsp;
</h3>
<p><br></p>
<h2 style="text-align: left; >&nbsp; {التوقيع}</h2>
<h2 style="text-align: center; >{QR}</h2>

        `
);

function submitForm() {
	const content = $('#trumbowyg-editor').html();
	console.log('🚀 ~ submitForm ~ content:', content);
	$('#editor').html(content);
	$('#template-form').submit();
}
