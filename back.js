function copyClipboard(inputElement) {

    inputElement.select();
    document.execCommand("copy");
    inputElement.blur()
    const button = inputElement.nextElementSibling;
    const tooltip = button ? button.firstElementChild : null;
    if (tooltip) {
        $.growl.notice({ message: window.mymails.trans.copy,  size: "small" });
    }
}