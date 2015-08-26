@extends('layouts.partner')

     @section('title')
        Register Adsense | TEFLTV Partners
     @stop

     @section('meta')
               
     @stop
     @section('css')
          {{HTML::style('css/vid.player.min.css')}}
     @stop
     @section('some_script')
     {{HTML::script('js/video-player/media.player.min.js')}}
     {{HTML::script('js/video-player/fullscreen.min.js')}}
@stop

@section('content')
<div class="top-bg"></div>

<div class="paper_wrap">
     <div class="col-md-10 col-md-offset-1">
          <div class="col-md-8">
               <div class="paper">
                    <div class="content-padding">
                         <div class="icons_style pull-right">
                             <img src="/img/icons/par-upload.png"><img src="/img/icons/par-earn.png"><img src="/img/icons/par-share.png">
                         </div>
                         <div class="row ">
                              <h1 class="text-center blueC mg-t-20">Partner's Account Setup</h1>
                              <div class="pub-infoDiv mg-t-20 textbox-layout">
                                  <div class="well">
                                  {{Form::open(array('route' => 'post.partners.register-adsense'))}}
                                        <span>Please enter your Adsense publisher ID</span><br />
                                        <span class="notes"> *Please take note that you should only enter a valid adsense publisher ID and Ad slot ID otherwise your ads will not be visible</span> <br />
                                        {{Form::label('adsense', 'Adsense Publisher ID ')}} <small><a target ="_blank" href="{{route('homes.watch-video', array( 'v=' . 'NMlVjGukbaT'))}}">click here</a></small> to find your Publisher ID
                                        {{Form::text('adsense', null, array('placeholder' => 'pub-xxxxxxxxxxxxxxx'))}}
                                        {{Form::label('ad_slot_id', 'Ad Slot ID')}} <small><a target ="_blank" href="{{route('homes.watch-video', array( 'v=' . 'rZePd7JeQHL'))}}">click here</a></small> to find your Ad Slot ID
                                        {{Form::text('ad_slot_id', null, array('placeholder' => 'xxxxxxxxxx'))}}
                                       <br />
                                        	
                                   </div>
                                   <div class="well" style="height:350px; overflow:auto;">
                                   <div id="pub-H"></div> 
                                   <div class="">                    
                                        <h2 class="blueC">Partner Program Terms and Conditions</h2>
                                        <p class="text-justify">
                                        Lorem ipsum dolor sit amet, eam paulo graeco te, nibh scaevola cu mea, vide vocent audiam cu sit. Eam ei amet summo, usu eu vocibus recusabo reformidans, putant offendit in vis. Duo ex regione utroque ceteros. No per congue patrioque constituam, pro expetenda disputando et. Wisi sententiae referrentur eu ius, ex rebum laoreet sed. Id malis pertinax est, illum utamur inermis nec cu, tollit intellegat eu eos.

Illum graece ex sed, ubique corrumpit eu his. Mel cibo temporibus id, at eam iisque delectus invidunt. Ut senserit molestiae qui, ne oratio soluta sea, nam quot essent antiopam at. Te aliquid adipiscing quo, suas omnes dictas et eos. Duo deleniti pertinacia delicatissimi an, ex pri causae hendrerit democritum.

Nec ea sumo labitur. In eos quot dicunt disputando. Eam et habeo affert repudiare, perpetua necessitatibus te sea. Ius te nemore perfecto intellegam.

Malorum vivendum sea ei. Nobis altera eum te. Qui ne elitr complectitur. Ut vel illum tractatos expetenda. Oportere delicatissimi qui ex, inani euismod delectus nec at.

Cu pri detracto eloquentiam. Tota affert eu his, eum ad congue postea convenire, nec quidam iriure invenire ex. Minim iudico mediocrem eum eu, est no omnes pericula adversarium, ius in esse cetero voluptaria. Ea omnis erroribus pri.
</p>
                                         <hr/>
                              
                                         <input type="checkbox" > <span><b>I have read and agreed to the tems and conditions stated above.</b></span>
                                   </div>
                              </div>



                        
                                   <div class="text-right mg-b-20">
                                        <br />
                                        <p class="notes">Please read terms and condition and click the checkbox at the bottom of the contex if you agree with it.</p>
                                        <!--<a href="{{route('partners.success')}}">{{Form::button('Submit Application', array('class' => 'btn btn-primary'))}}</a>-->
                                        {{Form::submit('Agree and Submit Application', array('class' => 'btn btn-primary')   )}}
                                        {{Form::close()}}
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="col-md-4">
               @include('elements/partners/video')
               <br/>
               @include('elements/partners/support')
          </div>
     </div>
</div>


@stop