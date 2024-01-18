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
<h3 style="text-align: center;"><span style="font-size: 65px;">شهادة مشاركة</span></h3><p><span style="font-size: 80px;"><br></span></p>
<p style="text-align: center; "><span style="font-size: 35px;">تشهد {اسم_المنظمة} بأنّ&nbsp;</span></p>
<h2 style="text-align: center; "><span><span style="font-size: 38px;">{اسم_المشارك}</span></span></h2>
<p style="text-align: center;"><span style="font-size: 20px;">&nbsp;قد شارك في دورة <span>{اسم_الدورة}
</span> المقامة في
    <span>{الموقع}</span> بتاريخ
    <span>{تاريخ_البداية} إلى {تاريخ_النهاية}</span>&nbsp;
</span></p>
<br>
<br>
<h2 style="text-align: center;">{QR}</h2>
        `
);

function submitForm() {
	const content = $('#trumbowyg-editor').html();
	console.log('🚀 ~ submitForm ~ content:', content);
	$('#editor').html(content);
	$('#template-form').submit();
}
