
<style type="text/css">
    .ads-absolute-wrapper{
        position:absolute;
        width:100%;
        height:60px;
        left: 0;
        right: 0;
        display: block;
        bottom:10px!important;
        /*bottom:0;*/
        margin:auto;
        background: transparent;
        visibility: hidden;
    }
    .ads-relative-wrapper{
        max-height:90px!important;
        overflow:hidden;
        position:relative;
        padding:0 10px;
        max-width: 550px;
        margin-right: auto;
        margin-left: auto;
    }
    button.close-ads{
        cursor: pointer;
        background: rgba(0,0,0,0.6);
        /*border: 1px solid #fff;*/
        padding: 2px 3px;
        width:auto;
        margin:0 auto;
        font-size: 10px;
        height: 18px;
        /*border-radius: 5px 5px 0 0 ;*/
        color: #fff;
        position: absolute;
       /* right: 85px;
        top:1px;*/
        right: 0;
        z-index: 1111;
        border:none;
    }
     button.close-ads:hover{
        border: 1px solid #fff;
    }

</style>   
    <!-- Responsive -->
   <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <div class="ads-absolute-wrapper" id='advertisement'>
        <div class="close-ads"></div>

        <div class="text-center" style="position:relative;">
            <button class="close-ads">
                <b><i>close ads</i></b>
            </button>
        </div>

        <div class="ads-relative-wrapper">
            <ins class="adsbygoogle"
            style="display:block;"
            data-ad-client="{{$adsense['adsense_id']}}"
            data-ad-slot="{{$adsense['ad_slot_id']}}"
            data-ad-format="auto"></ins>
            <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
        </div>
    </div>
