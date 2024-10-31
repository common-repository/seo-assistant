 jQuery(function($){

	var  seo_assistant_google_tag_manager_status = SEO_ASSISTANT_GOOGLE_ANALYTICAL.google_tag_manager['google-tag-manager-enable'],
	seo_assistant_google_tag_manager_tpl = `
		<!-- Google Tag Manager (noscript) Added by Seo Assistant plugin --> \
		<noscript><iframe src="//www.googletagmanager.com/ns.html?id=${SEO_ASSISTANT_GOOGLE_ANALYTICAL.google_tag_manager['google-tag-manager']}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> \
		<!-- End Google Tag Manager (noscript) --> `;
	
	// seo_assistant_google_tag_manager_tpl = seo_assistant_google_tag_manager_tpl.replace('GTMTAG', SEO_ASSISTANT_GOOGLE_ANALYTICAL.google_tag_manager['google-tag-manager'] );
	
	
	if( "yes" == seo_assistant_google_tag_manager_status ){
		var s = document.body.firstChild;
		console.log(s)
		s.insertAdjacentHTML("beforebegin", seo_assistant_google_tag_manager_tpl );
	}
	
});
