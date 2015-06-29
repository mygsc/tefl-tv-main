@extends('layouts.partner')

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
                                        <span class="notes"> *Please take note that you should only enter a valid adsense publisher ID otherwise your ads will not be displayed</span> 
                                        {{Form::text('adsense', null, array('placeholder' => 'pub-xxxxxxxxxxxxxxx'))}}
                                        <span class="notes"> Don't know how to retrieve your adsense ID? <a href="#">click here</a></span><br />
                                        	
                                   </div>
                                   <div class="well" style="height:350px; overflow:auto;">
                                      <div id="pub-H"></div> 
                                      <div class="">                    
                                         <h2 class="blueC">Partner Program Terms and Conditions</h2>
                                         <p class="text-justify">
                                             Graphic Studio Central Ltd operates a free video-hosting worldwide website available at www.tefltv.com,  which enables users to access, stream, upload, store, share and comment on videos on the internet, and from any other technical, communication or transmission protocols or platforms now known or hereafter devised, discovered, or developed including, without limitation, mobile phones, tablets, IPTV platforms and other devices (the "Site"). 
                                        </p>
                                        <p class="text-justify">
                                             These Partner Program Terms and Conditions (“Terms”) govern your participation in the Graphic Studio Central Ltd Partner Program. Before joining or applying to our Partner Program, please carefully read these Terms. As a participant (or prospective participant) in the Partner Program, you are required to follow these Terms and to keep your own employees, agents and contractors in compliance with these Terms. 
                                        </p>
                                        <p class="text-justify">
                                             You will be referred as the “Partner” in the Terms. Graphic Studio Central Ltd and Partner may be referred to hereinafter, individually as a "Party" and collectively as the "Parties".
                                        </p>
                                        <p class="text-justify">
                                             Partner has agreed to the following Terms of the program supplied by Graphic Studio Central Ltd (the “Partner Program”) to enable to Partner an optimized exploitation of its contents and the use of the functionalities available on the Site, in particular Advertising Monetization tools as defined hereunder, and any current or future tool which may be supplied by Graphic Studio Central Ltd to its Partners. 
                                        </p>
                                        <p class="text-justify">
                                             By participating in the Partner Program, or clicking that you “agree”, “accept” or “continue” when prompted, you agree to be bound by these Terms and all other Graphic Studio Central Ltd ’s policies, guidelines, documents and materials that we make available to you in connection with your participation in the Partner Program. If you do not consent to these Terms, you are not permitted to participate in the Partner Program. If you are signing up to the Partner Program on behalf of a company or other entity, you represent and warrant that you are an authorized representative of such company or entity with the right to bind such company or entity to these Terms. You further represent and warrant that you are at least 18 years of age or older.
                                        </p>
                                        <p class="text-justify">
                                             These Terms only govern the relationship between you and Graphic Studio Central Ltd in connection with your participation in the Partner Program. Please refer to the applicable agreement between you and Graphic Studio Central Ltd for all terms and conditions that govern your relationship with Graphic Studio Central Ltd.
                                        </p>
                                        <p class="text-justify">
                                             In consideration of the mutual agreements and covenants set forth below, the Parties agree as follows:
                                        </p>
                                        <h2>DEFINITIONS </h2>
                                        <p class="text-justify">
                                             Unless otherwise specifically provided, and in addition to the other capitalized terms defined in this Agreement, the following terms shall have the meanings set forth below: 
                                        </p>
                                        <p class="text-justify">
                                             <b>Advertising</b> or <b>Advertisements</b> means any and all banner advertisements, text links, or other solicitations provided by us to you to promote the our Services and/or which contain a Link to our Site.
                                        </p>
                                        <p class="text-justify">
                                             <b>Advertising Monetization Tools:</b>   means the possibility for PARTNER to monetize the Content on the Service and to record and share the corresponding gross revenues received from the sale of In-Stream Advertising served in connection with the Content distributed the Partner Account and through the Video Player under the advertising Monetization Tools, after deduction of any applicable taxes. 
                                        </p>
                                        <p class="text-justify">
                                             <b>Content(s):</b> means all videos uploaded on one or all Partner's Accounts by the PARTNER including any associated data (title, duration) in digital format as specified herein.
                                        </p>
                                        <p class="text-justify">
                                             <b>Website Services</b> means www.tefltv.com ’s subscription-based online video sharing services available via our websites.
                                        </p>
                                        <p class="text-justify">
                                             <b>Partner Master Account:</b> means the Content storage space which is dedicated to PARTNER and available at the following URL address: www.tefltv.com, enabling Partner to administrate its Partner Sub-Accounts. This Partner Master Account shall notably include information regarding the total number of Contents available on all Partner Sub-Accounts, the number of comments, the number of views for all Contents (in total and per Content), and the number of bookmarks. 
                                        </p>
                                        <p class="text-justify">
                                             <b>Partner Account(s):</b> means the Partner Master Account together with Partner Sub-Accounts. 
                                        </p>
                                        <p class="text-justify">
                                             <b>Partner Sub-Accounts:</b> means any space on the Service dedicated to the storage of PARTNER's Content. These accounts shall be directly managed by PARTNER and are attached to the Partner Master Account mentioned here above, being agreed that such Partner Sub-Accounts will be subject to the same terms and conditions than those provided for their Partner Master Account. 
                                        </p>
                                        <p class="text-justify">
                                             <b>Public:</b> means any person having access to the Service. 
                                        </p>
                                        <p class="text-justify">
                                             <b>Service:</b>  means the Site and the Video Player exportable on any third party website and any declination of the Site in the form of an application or a web app, as accessible (online or offline) via (i) any devices for which the Service's distribution is provided through a wireless handheld network, and by any means of access, including smart phones, tablets and/or (ii) any IP/IPTV platform for which the Service's distribution is provided through a high-speed Internet connection on IP protocol, including without limitation, through a widget integration on TV devices or through the Service referencing on different portals and IPTV distribution network, and/or (iii) through any television (TV) platform for which the Service distribution is provided through cable, satellite or terrestrial transmission, and (iv) through any current or future device capable of distributing the Video Player. 
                                        </p>
                                        <p class="text-justify">
                                             <b>Territory:</b> means worldwide, being however agreed that PARTNER may, on a case-by-case basis, exclude certain territories on which the Content shall be communicated to the Public through its Partner Account(s). 
                                        </p>
                                        <p class="text-justify">
                                             <b>Video Player:</b> means a technology developed by and owed by Graphic Studio Central Ltd, enabling viewing by streaming of videos uploaded and hosted on the Service, notably on the Site and outside the Site
                                        </p>
                                        <h2>Description of Service</h2>
                                        <p class="text-justify">
                                             www.tefltv.com is an online community.  It provides an online space for users to access, view, upload, share and comment on their personal videos. Users may also share their video work through the site.  Users may choose to participate in available contests and promotions, and access and/or purchase services www.tefltv.com makes available on the Site (“Services”). Services include, but are not limited to, any service and/or content that www.tefltv.com provides to its users.   Services include all videos and content displayed or transmitted on www.tefltv.com or through the Services. Content (“Content”) includes, but is not limited to text, user comments, messages, information, data, graphics, news articles, photographs, images, illustrations, and software.
                                        </p>
                                        <p class="text-justify">
                                             Your access to and use of the Site may be interrupted at different times due to equipment malfunctions, site updates, maintenance or site repair or any other reason that may or may not be under the control of www.tefltv.com.  www.tefltv.com reserves the right to suspend or discontinue the availability of the Site and any Service at any time for any reason.  www.tefltv.com reserves the right to remove any Content at any time at its sole discretion and without any prior notice. www.tefltv.com may also impose limits on certain features and Services or restrict your access to parts of or all of the Site and the Services without any prior notice and with no liability to www.tefltv.com. www.tefltv.com should not be used or relied upon for the storage of your videos and www.tefltv.com will not assume any liability for deleted content.  www.tefltv.com directs users to keep their own copies of any content posted to the Site. Since the Website is not designed to back up video data, you are responsible for taking all necessary precautions in that regard. Finally, and in accordance with Internet practice and custom, advertisements may be incorporated into the Website.
                                        </p>
                                        <p class="text-justify">
                                             Partner shall be free to use all or part of Website’s tools and functionalities at its sole discretion. 
                                        </p>
                                        <h2>Registration</h2>
                                        <p class="text-justify">You are required to open an account with www.tefltv.com in order to use the services offered by www.tefltv.com. When opening a user account you must choose a username and a password and provide information, including your email address. The registration information you provide must be accurate, complete, and current at all times. If you do not provide accurate information, you will be in breach of the Terms, and www.tefltv.com may, in its sole discretion, delete your account.
                                        </p>
                                        <p class="text-justify">The Partner shall assume all liability for the choice of a user name. Usernames are restricted to names that are legally available for use.  Your username may not be a trade mark that is owned by any other person or entity other than you without appropriate authorization.  You may not impersonate any person, living or dead, through your choice of username. You are responsible for maintaining the confidentiality of your password and you are solely responsible for all activities conducted through your www.tefltv.com account.  Usernames cannot be vulgar, obscene, or otherwise offensive. If your username is in violation of any of the above restrictions, www.tefltv.com may delete your account or disable it until the username is changed.
                                        </p>
                                        <p class="text-justify">
                                             Registration entitles you to use the Website for an unlimited period of time 
                                        </p>
                                        <p class="text-justify">
                                             <b>By accepting the terms and conditions of the Partner Program, Partner or Partner’s legal representative represents that: </b>
                                        </p>
                                        <ul>
                                             <li>it is duly authorized hereof to act for and on behalf of the legal entity wishing to benefit from the Partner Program;</li>
                                             <li>it has accepted the terms online by ticking the acceptance box provided thereof.</li>
                                        </ul>
                                        <p class="text-justify">
                                             It is Partner’s responsibility to ensure that the information in his registration and otherwise associated with Partner Program account, including email address and other contact information, is at all times complete, accurate and up-to-date.
                                        </p>
                                        <p class="text-justify">
                                             By agreeing to these terms, Partner will have a direct access to the tools and functionalities available in the Partner Program, being however agreed that Partner will not be entitled to any revenues generated by the use of the said tools and functionalities before having duly completed the payment form available through the Partner Master Account. 
                                        </p>
                                        <h2>Your Content</h2>
                                        <p class="text-justify">
                                             Subject to the terms and conditions of this Agreement, you may from time to time upload or otherwise provide one or more original video clips by registering (thereby becoming a “Content Partner”) and following the Upload Instructions located on the Site. At the time you provide a Video you will have an opportunity to include a caption and other descriptive information regarding that Video. You will not be required to provide a Description, and if you do not include a Description for a particular Video, then we may provide a caption or other descriptive information that in our judgment suits that Video.
                                        </p>
                                        <p class="text-justify">
                                             www.tefltv.com has policies and processes that must be adhered to prior to Partner Content being posted on the Site. www.tefltv.com will review all Partner Content uploaded to the Site and reserves the right to refuse to accept or delete any Partner Content that www.tefltv.com may determine, in its sole discretion, violates or may infringe, misappropriate or violate this Agreement, the intellectual property, proprietary or other rights of others or any of www.tefltv.com ‘s policies or is otherwise objectionable or unacceptable. We intend to operate with transparency and will generally attempt to notify you if we do not accept or delete your Partner Content, though it is ultimately your responsibility to contact us if your content is not accepted or is deleted and you do not receive a notification from us regarding such action. In all cases where you feel that Partner Content that you submitted has been misjudged or mishandled by us (including our refusal to accept or deletion of your Partner Content, misclassification of your Partner Content or any omitted or misattribution regarding the origin of your Partner Content), we encourage you to contact us.
                                        </p>
                                        <p class="text-justify">
                                             Partner will deliver to Graphic Studio Central Ltd the Content with a level of quality in accordance with the typical industry standards. 
                                        </p>
                                        <p class="text-justify">
                                             Partner shall provide the Content in one of the following digital formats: MPEG – 4, MPEG – 2, AVI, WMV. 
                                        </p>
                                        <p class="text-justify">
                                             Graphic Studio Central Ltd undertakes not to edit, modify or otherwise alter the Content uploaded or available on the Service provided that Graphic Studio Central Ltd shall be entitled to compress or otherwise store the Contents as is necessary for its activity.          
                                        </p>
                                        <h2>Warranties of the Content</h2>
                                        <p class="text-justify">
                                             <b>The Partner represents and warrants:</b>
                                        </p>
                                        <ol>
                                             <li>That you are the owner of all rights, including all copyrights and intellectual property rights to all the Content you post to the site. Partner warrants that it owns all necessary rights and clearances necessary with regards to any third party right's holders including, without limitation, authors, directors, producers, actors, technicians and, in general, from anyone who has participated directly or indirectly to the creation of the Content and/or from any third party that may be entitled to claim any right on the Content and as such, releases Graphic Studio Central Ltd from any claim or action arising from any third party during the exploitation of such licensed rights.</li>
                                             <li>That you have the complete rights to enter into this agreement and to grant to www.tefltv.com the rights in the Content granted by this agreement, and that no additional permissions are required from, nor payments required to be made to any other person or entity due to the use by www.tefltv.com of the Content as contemplated herein; </li>
                                             <li>That the Content you post does not defame any person and does not infringe upon the copyright, moral rights, publicity rights, privacy rights or any other rights of any person or entity, and that the Content does not violate any law; and</li>
                                             <li>That you do not have any right to terminate the permissions granted herein, nor to seek, obtain, or enforce any injunctive or other equitable relief against www.tefltv.com.  By using the site, you agree to expressly and irrevocably waive these rights;</li>
                                             <li>That the Content does not constitute a threat to public order or standards of decency and good morals or, more generally, violate any applicable laws</li>
                                        </ol>
                                        <p class="text-justify">
                                             Partner also guarantees Graphic Studio Central Ltd against any action, claim or complaint that may be brought by any third party, that has not contributed directly to the creation of the Content, but that may be entitled to exercise its rights on all or part of the Content and/or their exploitation by Graphic Studio Central Ltd and in particular, that may be entitled to limit the exploitation of the Content on the Service. 
                                        </p>
                                        <p class="text-justify">
                                             Partner agrees to notify and forward to Graphic Studio Central Ltd as soon as possible any action, claim or complaint relating to the Content hosted on its Partner Accounts. 
                                        </p>
                                        <p class="text-justify">
                                             In the event Partner’s breach results in the impossibility for Graphic Studio Central Ltd to exploit a Content on the Service, the revenue shares to be paid to Partner under these Terms will not be paid to Partner, or if they were already paid to Partner, shall be refunded by PARTNER within 10 (ten) days from Graphic Studio Central Ltd's request without prejudice of any warranty claim for damages. 
                                        </p>
                                        <p class="text-justify">
                                             Graphic Studio Central Ltd acknowledges and agrees that the Content and all intangible rights thereof remain Partner’s exclusive property. 
                                        </p>
                                        <p class="text-justify">
                                             In accordance with applicable laws, Graphic Studio Central Ltd may take down any illegal Content hosted on the Partner Accounts after obtaining knowledge of it. Partner shall remain fully liable for such Content
                                        </p>
                                        <p class="text-justify">If Partner breaches any of its obligations under these Terms which results in limitations, restrictions or encumbrances of the rights granted to Graphic Studio Central Ltd, Graphic Studio Central Ltd shall be free to (i) make no payments to Partner with regards to the Advertising Monetization Tools, and the Net Advertising Revenues related to the Syndication Tools unduly generated to the benefit of the Partner for such Content and/or (ii) to terminate immediately the Terms without further compensation nor payment of Partner Program Revenues generated by Partner Accounts and without waiver to any other rights or remedies of Graphic Studio Central Ltd within the scope of these terms.</p>
                                        <p class="text-justify">Partner acknowledges that Graphic Studio Central Ltd is authorized to provide the personal data of Partner upon a valid request from the relevant authorities. </p>
                                        <p class="text-justify">Common warranties related to the use of the Partner Program </p>
                                        <p class="text-justify">Partner acknowledges and agrees that (i) Graphic Studio Central Ltd is not a pay-per-view audiovisual media but a web hosting service provider and to that respect, (ii) Graphic Studio Central Ltd is not required to perform any prior monitoring of the Content hosted on its Service, or to search for facts or circumstances revealing illegal activities according to applicable law. </p>
                                        <p class="text-justify">Partner undertakes (i) not to falsely increase the number of views, impression of or clicks associated with the Content directly or indirectly, automatically or manually, (ii) not to authorize or encourage any third party including offering any financial incentive to do the same and (iii) more generally, to comply with the rules of use of the Partner Program specified in the "Frequently Asked Questions" section of the Partner Program and to each tool provided to Partner. </p>
                                        <p class="text-justify">In the event or suspicion of a false or fraudulent increase as defined in this Section, Graphic Studio Central Ltd may, without any justification, (i) withhold payment of the falsely generated Partner Program Revenue until the issue is resolved or (ii) immediately terminate the subscription of the PARTNER to the Partner Program without compensation to Partner or payment of the falsely generated Partner Program Revenue and without waiver or prejudice of any other of Graphic Studio Central Ltd's rights or remedies. </p>
                                        <p class="text-justify">The Site will generally be available 24 hours a day 7 days a week, except during any scheduled or unscheduled interruptions, for maintenance needs or cases of force majeure. Partner acknowledges and agrees that Graphic Studio Central Ltd is not liable for any interruptions, and Partner waives any claim and/or lawsuit against Graphic Studio Central Ltd for this reason. </p>
                                        <p class="text-justify">Partner acknowledges and agrees that the Service, in whole or in part (including, without limitation, the look and feel, the thematic channels, the functionality, the video player), on which the Content will be distributed is provided "as is", provided that Graphic Studio Central Ltd may enhance, modify and update the Service at its sole discretion. For the sake of clarity, Partner shall not be entitled to request any modification to the Service. </p>
                                        <p class="text-justify">Partner further acknowledges and agrees that Graphic Studio Central Ltd makes no representations concerning the volume of advertising sales or orders of Content and in consequence Graphic Studio Central Ltd makes no warranties concerning a minimum amount of Partner Program Revenues to be paid to Partner. </p>

                                        <h2>Partner Content License</h2>
                                        <p class="text-justify">You hereby grant www.tefltv.com a worldwide, paid-up, right and license to copy, reproduce, prepare derivative works based upon, distribute, perform, display, transmit and modify your Partner Content and otherwise use and market, license and commercialize the Partner Content for any purpose and in any form of media now existing or hereafter available or developed. Additionally, you hereby waive all moral rights and rights of attribution and publicity in, to, and with respect to the Partner Content. The foregoing license is sub licensable to users of the Site and members of our service in accordance with these Terms. You acknowledge and agree that we may from time to time offer additional or different licensing and pricing options to users of the Site and members of our service and that we may include your Partner Content under such licensing. If you ever decide that you do not want to allow your Partner Content to continue being licensed under particular licensing, please follow the instructions under Termination below. </p>
                                        <p class="text-justify">The foregoing license is also sub licensable and transferrable by www.tefltv.com on a royalty-free basis to any of our affiliate organizations or to any successor to our business. Additionally, the foregoing license will be non-exclusive or exclusive, as you select as part of the upload process when uploading Partner Content to the Site. </p>
                                        <p class="text-justify">Your license grant(s) to us will survive for the duration of this Agreement and thereafter until we remove the Partner Content from the Site, and to the extent a user or member has obtained a sublicense to your Partner Content, your license to us will be irrevocable with respect to each such sublicense and will survive for so long as that sublicense exists. </p>
                                        <p class="text-justify">In addition to the foregoing, you hereby grant www.tefltv.com a perpetual, irrevocable, worldwide, royalty-free, paid-up, right and license to copy, reproduce, prepare derivative works based upon, display, transmit, modify, and otherwise use your Partner Content for its own business purposes in connection with the operation and promotion of the Site and the services and Partner Content offered by www.tefltv.com or otherwise available through the Site. The foregoing license is also sub licensable and transferrable by www.tefltv.com on a royalty-free basis to any of our affiliate organizations or to any successor to our business. If you elect to remove your Partner Content from the Site, then we will stop using that Partner Content for our own business purposes as promptly as is practical. But please keep in mind that depending on the way in which we are using your Partner Content and the media, on which it is displayed, it could take time before a particular video clip is completely removed from circulation. For example, if we have printed materials with representative content from the Site and your Partner Content appears in such materials, we will continue to use our inventory of those materials until the inventory is exhausted. </p>
                                        <p class="text-justify">In the event of upload of Content on the Service by Partner,   whether under the Advertising Monetization Tools, Partner expressly authorizes Graphic Studio Central Ltd to reproduce the entire Content and without alteration (at the exclusion of potential advertising insertions under the Advertising Monetization Tools) for their provision and their communication to the Public on the Service in particular as necessary if relevant for their (i) compression and digitalization and (ii) hosting and storage or (iii) for technical needs related to the streaming of the Content. </p>
                                        <p class="text-justify">The Parties agree that the rights granted under the TOU covers with retroactive effect as necessary any exploitation of the Content on the Service, prior to the date of acceptation of the TOU. To that respect Partner hereby waives any rights to any claim or reclamation it may be entitled to against Graphic Studio Central Ltd and users of the Service arising from the exploitation or distribution of the Content on the Service before your acceptance of these TOU and warrants Graphic Studio Central Ltd thereof. </p>

                                        <h2>Publicity and Promotion</h2>
                                        <p class="text-justify">The license granted to us by you includes the right to use your Content fully or partially for any promotional reasons and to distribute or redistribute your Content to other parties, websites, applications, or any other entities, provided that your Content is attributed to you in accordance with the credits (i.e. username, profile picture, photo title, descriptions, tags, and other accompanying information) if any and as appropriate, you provide to www.tefltv.com;</p>
                                        <p class="text-justify">Any use by Partner of Graphic Studio Central Ltd's trademark or logo must be approved in advance by Graphic Studio Central Ltd in writing. This approval may be given by email. </p>
                                        <p class="text-justify">The Parties agree and acknowledge that each Party may issue a press release announcing their Partnership provided that the Parties have mutually agreed to the wording of the press release. </p>
                                        <h2>Intellectual Property </h2>
                                        <p class="text-justify">Any intellectual property rights arising from and/or in relation with the Service including the Site and the Video Player and Graphic Studio Central Ltd's logos and brands are and remain Graphic Studio Central Ltd's or any relevant entitled person's exclusive property. Unless otherwise provided herein, no provision contained herein shall grant Partner any intellectual property right or right to use the Service including the Site and the Video Player or Graphic Studio Central Ltd's logos and brands. </p>
                                        <p class="text-justify">Any intellectual property rights arising from and/or in relation with Partner‘s logos and brands are and remain Partner 's exclusive property. Unless otherwise provided herein, no provision contained herein shall grant Graphic Studio Central Ltd any intellectual property right or right to use Partner's Websites or Partner's logos and brands. </p>

                                        <h2>Release and Indemnity</h2>
                                        <p class="text-justify">Through your use of the www.tefltv.com site you expressly and irrevocably release and forever discharge www.tefltv.com, its affiliated and associated companies, and their respective directors, officers, employees, agents, representatives, contractors, licensees, successors and assigns from any and all actions, causes of action, suits, proceedings, liability, debts, judgments, claims and demands whatsoever in law or equity which you have ever had, now have, or hereafter can, shall or may have, for or by reason of, or arising directly or indirectly out of your use of www.tefltv.com and its Services. </p>
                                        <p class="text-justify">You hereby agree to indemnify and hold harmless www.tefltv.com, its affiliated and associated companies, and their respective directors, officers, employees, agents, representatives, contractors, licensees, successors and assigns from and against all claims, losses, expenses, damages and costs (including, but not limited to, direct, incidental, consequential, exemplary and indirect damages), and reasonable attorneys' Proceeds, resulting from or arising out of (i) a breach of these Terms, (ii) Content posted on the Site, (iii) the use of the Services, by you or any person using your account or www.tefltv.com Username and password, (iv) the sale or use of your Videos, or (v) any violation of any rights of a third party.</p>

                                        <h2>Advertising Monetization Tools </h2>
                                        <p class="text-justify">In case of activation by the Partner through its Partner Master Account of the tools and functionalities related to the Advertising Monetization Tools on one or more of its Partner Accounts, the following provisions shall apply: </p>
                                        <p class="text-justify">PARTNER grants to Graphic Studio Central Ltd, for the term of the Terms and the Territory and transferable to its affiliates, the non-exclusive rights to reproduce, represent, stream, replay (including offline display without permanent download), exploit, exhibit, show, market, distribute and to, modify and translate the Content strictly necessary for the purposes of the viewing of the Content on the Service by the Public </p>

                                        <p class="text-justify"><b>3.2 Graphic Studio Central Ltd is granted the exclusive right to sell: </b></p>
                                        <ul>
                                             <li>advertisements in connection with the Content, including, but without limitation, medium rectangle, leader board, roadblock, or hyperlink, as available on the Service ("Display Advertising"), and</li>
                                             <li>advertisements in the form of "In-Stream Advertising" (in particular pre/post roll, player branding, overlay ads) inserted before and/or after the Content distributed on the Service (including on any third-party website on which the Content is distributed through the Player).</li>
                                        </ul>

                                        <p class="text-justify">Display Advertising and In-Stream Advertising may be jointly referred to as "Advertising". </p>
                                        <p class="text-justify">Partner agrees and acknowledges that Graphic Studio Central Ltd shall have the sole control, discretion and approval over the (i) terms and conditions negotiated with advertisers, (ii) Advertising rates and (iii) the look and feel, placement, architecture of the Service, web pages, Advertising, and/or Advertising rates. </p>
                                        <p class="text-justify">Furthermore, subject to the exclusivity granted to Graphic Studio Central Ltd, Partner is prohibited to sell advertising (directly or by any third party) associated to the Content through the Video Player. </p>
                                        <p class="text-justify">Graphic Studio Central Ltd will comply with any legislation and regulation applicable to the Advertising associated to the Contents on the Service. </p>

                                        <h2>Partner’s Revenues</h2>
                                        <p class="text-justify">Subject to the activation of the Advertising Monetization tools by the Partner, Graphic Studio Central Ltd shall pay to the Partner a revenue share equal to 50% of the Net Advertising Revenues related to the Advertising Monetization Tools. </p>
                                        <p class="text-justify">The Net Advertising Revenues related to the Advertising Monetization Tools are defined as gross revenues received from the sale of In-Stream Advertising served in connection with the Content distributed on the Partner Accounts and/or through the Video Player under the Advertising Monetization Tools, after deduction of any applicable taxes. </p>
                                        <p class="text-justify">The Net Advertising Revenues related to the Advertising Monetization Tools shall be jointly defined as "Partner Program Revenues". </p>
                                        <p class="text-justify">It is agreed that Graphic Studio Central Ltd may deduct any amount from the Partner Program Revenues due (i) to the local authorities of any country as relevant and/or (ii) to enable the transfer and/or payment of any amounts due to PARTNER. </p>
                                        <p class="text-justify">Partner will be provided with an online interface in its Partner Master Account enabling Partner to track its monthly Net Advertising Revenues related to the Advertising Monetization Tools. </p>
                                        <p class="text-justify">However, only the conclusive account statements available within 30 days at the end of each month within the "Invoicing" section of the Partner Master Account for the previous months shall determine the billing and payment of PARTNER Program Revenues being agreed that Partner agrees and acknowledges that the account statement and payment shall be deemed final and conclusive unless disputed in writing by PARTNER within 15 days as provided herein. </p>

                                        <h2>Payment </h2>
                                        <p class="text-justify">If Partner has filled in all mandatory information necessary for payment trough the online interface of the Partner Program, Partner will receive payment of its share of the Partner Program Revenues generated during the preceding calendar month. </p>
                                        <p class="text-justify">No payments shall be made to Partner if Partner has not completed beforehand the payment form available on the online interface of the Partner Program. </p>
                                        <p class="text-justify">Graphic Studio Central Ltd shall issue an invoice within 30 (thirty) days following the end of the month in the name of and on behalf of Partner with respect to the authorization of self-billing. </p>
                                        <p class="text-justify">Payments shall be made by wire transfer 30 (thirty) days after receipt of the invoice on behalf of and in the name of Partner. </p>
                                        <p class="text-justify">For the avoidance of doubt, payments shall not be made to the benefit of any other person or entity other than Partner. Furthermore, Partner agrees that the payments shall only be made to a bank account bearing the same name as that of Partner. All the payments shall be made through Paypal. </p>
                                        <p class="text-justify">The Parties agree and acknowledge that Graphic Studio Central Ltd is free to deduct from PARTNER's Program Revenues any bank fees that result from the error, negligence, or omission of Partner in the communication of its bank account information to Graphic Studio Central Ltd. Partner shall also bear the fees for the use of any payment services such as Paypal. </p>
                                        <p class="text-justify">No payments will be issued for any amounts less than $100.00. Guaranteed payments for balances of less than $100.00 will incur a service charge of $2.50. Net payments under $1.00 after service charge will not be made and are permanently forfeited. All unpaid earnings will rollover to the next pay period. Any Publisher account that is unpaid for six (6) months due to low traffic becomes subject to immediate payoff and immediate dismissal from our platform. </p>

                                        <h2>Withholding Tax </h2>
                                        <p class="text-justify">Partner acknowledges and agrees that a withholding tax might be applied on the amounts paid by Graphic Studio Central Ltd to Partner in the scope of these terms. In this regard, it is Partner’s responsibility to provide Graphic Studio Central Ltd with a relevant certificate certified by Partner‘s home-country authorities, as soon as possible after its registration to the Partner Program to benefit to any exemption or reduction. </p>

                                        <h2>Payment Disputes</h2>
                                        <p class="text-justify"> If Partner disputes any payment, Partner must notify Graphic Studio Central Ltd in writing (and not any Advertiser or advertising agency) within fifteen (15) days of Partner’s (or its bank’s) receipt of any such payment or after the posting of the account statement in the online interface for a given month.  If Partner does not notify Graphic Studio Central Ltd within that time, Partner shall waive any claims related to such disputed payment.  Payments shall be calculated solely based on records maintained by Graphic Studio Central Ltd.  No other evidence, measurements or statistics of any kind shall be accepted by Graphic Studio Central Ltd or have any effect under this Agreement</p>

                                        <h2>Trademarks</h2>
                                        <p class="text-justify">www.tefltv.com and other www.tefltv.com graphics, logos, designs, page headers, button icons, scripts, and service names are registered trademarks, trademarks or trade dress of www.tefltv.com. www.tefltv.com ’s trademarks and trade dress may not be used in connection with any product or service without the prior written consent of www.tefltv.com. </p>

                                        <h2>Confidentiality</h2>
                                        <p class="text-justify">The Parties agree that the terms are confidential. The Parties shall each keep the terms and conditions of this Agreement and its subject matter confidential and agree not to disclose such information, including, without limitation, documents and information related to products, clients, strategy, development, financial, business practices, to any third parties except as necessary to any business and legal representatives or as necessary to perform the obligations under these Terms. </p>

                                        <h2>Termination></h2>
                                        <p class="text-justify">Partners who wish to terminate their www.tefltv.com accounts may simply stop using the Services or may delete their accounts.  www.tefltv.com reserves the right to terminate any and all Services and/or your www.tefltv.com account immediately, without prior notice or liability, for any reason whatsoever, including, its determination, in its sole discretion, that you have breached any of the Terms. Upon termination of your account, your right to use the Services will immediately cease. </p>
                                        <p class="text-justify">All Terms that may survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability. </p>
                                        <p class="text-justify">It is your responsibility to back up all Content from your account prior to termination. When your www.tefltv.com account is terminated, we will automatically remove all Content posted to your account. </p>

                                        <h2>Confidentiality</h2>
                                        <p class="text-justify">The Parties agree that the terms are confidential. The Parties shall each keep the terms and conditions of this Agreement and its subject matter confidential and agree not to disclose such information, including, without limitation, documents and information related to products, clients, strategy, development, financial, business practices, to any third parties except as necessary to any business and legal representatives or as necessary to perform the obligations under these Terms. </p>

                                        <h2>Termination</h2>
                                        <p class="text-justify">Partners who wish to terminate their www.tefltv.com accounts may simply stop using the Services or may delete their accounts.  www.tefltv.com reserves the right to terminate any and all Services and/or your www.tefltv.com account immediately, without prior notice or liability, for any reason whatsoever, including, its determination, in its sole discretion, that you have breached any of the Terms. Upon termination of your account, your right to use the Services will immediately cease. </p>
                                        <p class="text-justify">All Terms that may survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability. </p>
                                        <p class="text-justify">It is your responsibility to back up all Content from your account prior to termination. When your www.tefltv.com account is terminated, we will automatically remove all Content posted to your account. </p>

                                        <h2>Change</h2>
                                        <p class="text-justify">www.tefltv.com reserves the right, at its sole discretion, to eliminate, modify or replace any of the Terms at any time. If an alteration constitutes a material change to the Terms, www.tefltv.com will notify users by posting an announcement on the site.  www.tefltv.com will determine what constitutes a material change in its sole discretion. Users are solely responsible for reviewing and becoming familiar with any modifications to the Terms. Using any service or viewing any content following notification of a material change to the Terms shall constitute your acceptance of the revised Terms.</p>

                                        <h2>Responsibility</h2>
                                        <p class="text-justify">You are not allowed to interact with the advertisers and to post your own advertising on www.tefltv.com. </p>

                                        <h2>Third-Party Links</h2>
                                        <p class="text-justify">
                                         The provision of links to other websites or locations is for your convenience and does not signify our endorsement of such other websites or locations or their contents. Links to other Websites or locations may also be posted by other Users within the www.tefltv.com community. www.tefltv.com has no control over, does not review, and cannot be responsible for, these outside websites or their content. Please be aware that the terms of our Privacy Policy do not apply to these outside websites.
                                         </p>

                                         <h2>Electronic communications</h2>
                                         <p class="text-justify">
                                              The communications between you and www.tefltv.com use electronic means, whether you visit the Website or App or otherwise use the Service or send www.tefltv.com e-mails, or whether www.tefltv.com posts notices on the Website or App or communicates with you via e-mail. For contractual purposes, you (a) consent to receive communications from www.tefltv.com  in an electronic form; and (b) agree that all terms and conditions, agreements, notices, disclosures, and other communications that www.tefltv.com  provides to you electronically satisfy any legal requirement that such communications would satisfy if it were be in writing. The foregoing does not affect your statutory rights. 
                                         </p>

                                         <h1>Governing Law and Arbitration</h1>
                                         <p class="text-justify">
                                              This Agreement shall be governed by the laws of the Hong Kong without giving effect to any conflict of laws principles that may provide the application of the law of another jurisdiction. You shall always comply with all the international and domestic laws, ordinance, regulations and statutes that are applicable to your use of the Services.
                                         </p>

                                         <h2>Relationship of Parties</h2>
                                         <p class="text-justify">
                                              You and we are independent contractors, and nothing in this Agreement will create any Partnership, joint venture, agency, franchise, sales representative, or employment relationship between us. You have no authority to make or accept any offers or representations on our behalf. You will not make any statement, whether on your site or in any other place, that would reasonably contradict anything in this section.
                                         </p>

                                         <h2>Limitation of Liability</h2>
                                         <p class="text-justify">
                                              In no event shall www.tefltv.com be liable under contract, tort, strict liability, negligence or any other legal theory with respect to the site, the Services or any content (i) for any lost profits or special, indirect, incidental, punitive, or consequential damages of any kind whatsoever, (ii) to provide substitute goods or services; or (iii) for any direct damages.
                                         </p>

                                         <hr/>
                                     
                                         <br/><br/>
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