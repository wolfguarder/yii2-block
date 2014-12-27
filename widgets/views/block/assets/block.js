function blockAddReturnUrl(el){
    var href = el.getAttribute('href');
    var location = href + '&returnUrl=' + encodeURIComponent(window.location);
    el.setAttribute('href', location);
}