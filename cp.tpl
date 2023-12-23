<div class="panel">
    <h3><i class="icon icon-credit-card"></i> {l s='Customer export' mod='mymails'}</h3>

    <div class="panel-body">
        <div class="mymails_copy_wrapper">
            <span class="label">{l s='Link for download' mod='mymails'}</span>
            <input readonly class="form-control" id="urlDownload" value="{$cp_url}">
            <button id="cron_sync" onclick="copyClipboard(urlDownload);" class="btn  btn-primary">
                <i class="icon icon-copy"></i>
                {l s='Copy' mod='mymails'}
            </button>
        </div>
    </div>

    <div class="panel-footer">
        <p>
            <small>
                {l s='nextpointer.gr is constantly developing!
We created codepresta and we intend to make it the best site for buying Prestashop modules!
If you are satisfied with your purchase, please do not hesitate to write your review on
our Facebook' mod='mymails'}
            </small>
        </p>
        <p>
            <a href="https://www.facebook.com/codepresta" target="_blank">{l s='Facebook' mod='mymails'}</a>
        </p>
    </div>
</div>
