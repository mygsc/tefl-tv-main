@extends('layouts.publisher')

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

<div  class="top-bg"></div>
<div class="paper_wrap">
     <div class="col-md-10 col-md-offset-1">
          <div class="col-md-8">
               <div class="paper">
                    <div class="content-padding">
                         <div class="icons_style pull-right">
                              <img src="/img/icons/select-ico.png"><img src="/img/icons/share-ico.png"><img src="/img/icons/earn-ico.png">
                         </div>
                         <div class="row ">
                              <h1 class="text-center orangeC mg-t-20">Publisher's Account Setup</h1>
                              <div class="pub-infoDiv mg-t-20 textbox-layout">
                                  <div class="well">
                                  {{Form::open(array('route' => 'post.publishers.register-adsense'))}}
                                    <span>Please enter your Adsense publisher ID</span><br />
                                    <span class="notes"> *Please take note that you should only enter a valid adsense publisher ID and Ad slot ID otherwise your ads will not be displayed</span> <br />
                                    {{Form::label('adsense', 'Adsense Publisher ID')}}
                                    {{Form::text('adsense', null, array('placeholder' => 'pub-xxxxxxxxxxxxxxx'))}}
                                    {{Form::label('ad_slot_id', 'Ad Slot ID')}}
                                    {{Form::text('ad_slot_id', null, array('placeholder' => 'xxxxxxxxxx'))}}
                                    <span class="notes"> Don't know how to retrieve your adsense ID and Ad Slot ID? <a href="#">click here</a></span><br />

                               </div>
                          </div>

                          <div class="well text-justify" style="height:350px; overflow:auto;">
                             <div class="tab-pane text-justify" id="publishers">
                              <div id="pub-H"></div>          
                              <h2 class="orangeC">Publisher Terms and Conditions</h2>
                              <p class="text-justify">
                                   These Online Advertising Terms and Conditions (“Terms”) are hereby entered into by, as applicable, the publisher signing these Terms or any documents that references these Terms or that accepts these Terms electronically (“Publisher”) and Graphic Studio Central Ltd. These Terms shall govern the relationship between www.tefltv.com, a website owned and operated by Graphic Studio Central Ltd., and the Publisher. Graphic Studio Central Ltd. and Publisher shall agree to the following terms and conditions for the receipt of advertising video materials ("Creative") from the Company or Partners to be published on Publisher Websites ("Websites"). 
                              </p>
                              <p class="text-justify">
                                   www.tefltv.com operates a free video-hosting worldwide website available at www.tefltv.com, which enables users to access, stream, upload, store, share and comment on videos on the internet, and from any other technical, communication or transmission protocols or platforms now known or hereafter devised, discovered, or developed including, without limitation, mobile phones, tablets, IPTV platforms and other devices (the "Site"). 
                              </p>
                              <h2>Definitions:</h2>
                              <p class="text-justify">
                                   <b>As used in these Terms: </b>
                              </p>
                              <p class="text-justify">
                                   “Company”, “we”, “us”, or “our” refers to Graphic Studio Central Ltd. and our respective employees, agents, affiliates and contractors; 
                              </p>
                              <p class="text-justify">
                                   ”you” or “your” means the Publisher – a participant who has agreed to be bound by these Terms;
                              </p>
                              <p class="text-justify">
                                   “our website” means the website located at wwwtefltv.com; 
                              </p>
                              <p class="text-justify">
                                   “your website” means any websites that you own or operate and that link to our website and/or any other website that you use to promote the Graphic Studio Central Ltd. Services as permitted by these Terms; 
                              </p>
                              <p class="text-justify">
                                   ”revenue” or “commission “means any fees that you earn in connection with your participation in the Publisher Program
                              </p>
                              <p class="text-justify">
                                   “Publisher Program” means the marketing program operated and managed by Graphic Studio Central Ltd.; 
                              </p>
                              <p class="text-justify">
                                   “Company Services” means Graphic Studio Central Ltd.’s subscription-based online video sharing services available via our websites; 
                              </p>
                              <p class="text-justify">
                                   “Publisher Websites” means those websites, targeted to Users, owned and controlled by Publisher and registered with Website through Publisher Program.
                              </p>
                              <p class="text-justify">
                                   ”Prospective User” means any visitor to your website or other individual to whom you promote our Services in connection with your participation in the Publisher Program;
                              </p>
                              <p class="text-justify">
                                   “Content(s)” means all videos uploaded on one or all Partner's Accounts by the Partner including any associated data (title, duration) in digital format and any Partner’s videos uploaded on Publisher’s website(s);
                              </p>
                              <p class="text-justify">
                                   “Partner” means the Company or individual who post Content on the Website.
                              </p>

                              <h2>Enrollment</h2>
                              <p class="text-justify">
                                   The purpose of the Publisher Program is to permit you to promote our Services to Prospective Users and, in exchange, earn commissions in connection with such promotional activities. In order to participate in the Publisher Program, you must first submit an application to our website. Your application must include all information requested by us, including information about your website, links to any website that you intend to use in connection with the Publisher Program, your website’s visitor demographics, your contact information and your website’s traffic statistics. After receiving your application, we will review your application materials and notify you by email of your acceptance or rejection into our Publisher Program. 
                              </p>
                              <p class="text-justify">
                                   It is your responsibility to ensure that the information in your application and otherwise associated with your Publisher Program account, including your email address and other contact information and identification of your website, is at all times complete, accurate and up-to-date. We will send notifications, approvals and other communications relating to the Publisher Program and these Terms to the email address then-currently associated with your Publisher Program account. You will be deemed to have received all notifications, approvals and other communications sent to the email address associated with your account, even if that email address is no longer current.
                              </p>
                              <p class="text-justify">
                                   Graphic Studio Central Ltd. reserves the right to refuse service to any new or existing Publisher, in its sole discretion, with or without cause. Graphic Studio Central Ltd. reserves the right, in its sole discretion and without liability, to reject, omit or exclude any Publisher or Website for any reason at any time, with or without notice to the Publisher and regardless of whether such Publisher or Website was previously accepted.
                              </p>

                              <h2>Publisher’s Website Requirements</h2>
                              <p class="text-justify">You are solely responsible for your website, including the development, maintenance and technical operation of your website and all materials and content that appears on your website. At all times during your participation in the Publisher Program, your website must not: </p>
                              <ol>
                                   <li>Infringe on Publisher Program’s or any third party’s intellectual property, publicity, privacy or other proprietary rights.</li>
                                   <li>Violate any applicable law, rule, or regulation.</li>
                                   <li>Contain any content that is threatening, harassing, defamatory, obscene, harmful to minors, or contain nudity, pornography or sexually explicit materials.</li>
                                   <li>Contain any viruses, Trojan horses, worms, time bombs, cancel bots, or other computer programming routines intended to damage, interfere with, surreptitiously intercept or expropriate any system, data, or personal information.</li>
                                   <li>The Website does not violate any law or regulation governing false or deceptive advertising, sweepstakes, gambling, comparative advertising, or trade disparagement.</li>
                                   <li>The Website does not violate any law or regulation governing false or deceptive advertising, sweepstakes, gambling, comparative advertising, or trade disparagement.</li>
                                   <li>Contain software or use technology that attempts to intercept, divert, or redirect internet traffic to or from any other website.</li>
                              </ol>
                              <p class="text-justify">
                                   Your website must accurately and adequately disclose, either through a privacy policy or otherwise, how you collect, use, store and disclose data collected from Prospective Users, including a disclosure, where applicable or appropriate, that third parties (including us and other advertisers) may serve content and advertisements, collect information directly from Prospective Customers, and place or recognize cookies on visitors’ browsers
                              </p>
                              <p class="text-justify">
                                   Publisher declares that is generally familiar with the nature of the Internet and will comply with all laws and regulations that may apply. Publisher grants us and to the Partner the right and license to transmit the Content to the Website. 
                              </p>
                              <h2>Publisher Obligations</h2>
                              <p class="text-justify">
                                   Publisher shall deliver the Content in accordance with the terms of this Agreement and, if applicable, any placement requirements and reasonable technical specifications provided by us to Publisher. Publisher shall not modify the Content, unless otherwise allowed by us. Any exceptions must be approved by Graphic Studio Central Ltd., in advance, in writing.
                              </p>
                              <p class="text-justify">
                                   Publisher shall cooperate with Graphic Studio Central Ltd. in good faith, on an ongoing basis, to display the Content on the Publisher Website(s).
                              </p>
                              <p class="text-justify">
                                   <b>Publisher shall not, and shall not authorize or encourage any third party to:</b>
                              </p>
                              <ol type="i">
                                   <li>edit, modify, filter, re-order, or change the content or information contained in it, or remove, obscure or minimize any Content in any way;</li>
                                   <li>frame, minimize, remove or otherwise inhibit the full and complete display of any website accessed by a User after clicking on any part of an Ad; </li>
                                   <li>redirect a User away from any Advertiser website, provide a version of the Advertiser website that is different from the website a User would access by going directly to the Advertiser website, intersperse any content between the Content and the Advertiser website;      </li>
                                   <li>display any Content on any error page, on any chat page or in any email;</li>
                                   <li>“crawl,” “spider,” index or in any non-transitory manner store or cache information obtained from any Content or Actions, or any part, copy, or derivative thereto; or </li>
                                   <li>spam or send unsolicited emails, notifications, invites or use any other broadcasting mechanism mentioning or promoting an Content. Publisher acknowledges that any violation or attempted violation of any of the foregoing is a material breach of this Agreement.</li>
                              </ol>
                              <h2>Content:</h2>
                              <p class="text-justify">
                                   Graphic Studio Central Ltd. reserves the absolute right to refuse to affiliate with any Publisher. Graphic Studio Central Ltd. does not accept Websites that produce or provide adult content. Graphic Studio Central Ltd. does not accept Websites that engage in, promote or facilitate illegal or legally questionable activities such as pirating and hacking. Graphic Studio Central Ltd. does not accept Websites that are: under construction, hosted by a free service, personal home pages, or do not own the domain they are under. This Agreement is voidable by Graphic Studio Central Ltd. immediately if Publisher fails to disclose, conceals or misrepresents itself in any way. In addition, Graphic Studio Central Ltd. may in its complete discretion refuse to serve any Website that it is deem inappropriate. To insure compliance with this Agreement, any Publishers that change their content after approval for membership MUST notify Graphic Studio Central Ltd. of the changes in writing IMMEDIATELY. We prefer you notify us ahead of time of any major changes in content or design
                              </p>
                              <h2>Traffic: </h2>
                              <p class="text-justify">
                                   Graphic Studio Central Ltd. reserves the right to terminate Publisher's relationship with Graphic Studio Central Ltd. immediately should either the number of Impressions delivered by Publisher total less than 25,000 per month or Publisher's traffic falls below the threshold established by Graphic Studio Central Ltd. from time to time. 
                              </p>
                              <h2>Placement</h2>
                              <p class="text-justify">
                                   Publisher agrees to display the Content on each of Publisher’s Site(s) that comply with Internet law and regulation and the provisions set forth herein. 
                              </p>
                              <p class="text-justify">
                                   All Content must be placed within specified ad unit areas of the Webpage (varies by creative type). No member will place Content on blank pages, on pages with no content, on non-approved Websites, or in such a fashion that may be deceptive to the visitor. Content must be placed in such a manner that a majority of visitors will notice the Content. 
                              </p>
                              <h2>Fraud and Deception: </h2>
                              <p class="text-justify">
                                   Graphic Studio Central Ltd. audits every Publisher's traffic on a daily basis. Publishers that commit fraudulent activities, including false clicks, false impressions, and incentivized clicks, will have their account permanently removed from our platform and will not be compensated for fraudulent traffic. Additionally, Graphic Studio Central Ltd. reserves the right to register fraudulent Publishers in a global ad digital advertising platform fraud database, for usage by other ad digital advertising platforms. We have several fraud mechanisms at our disposal that will detect most forms within a few days of the initial activity. All Graphic Studio Central Ltd. Content must be served from Graphic Studio Central Ltd.’s ad server or serving location. Stored images that are loaded from a different location will not count towards any statistic or payment. Publishers agree to not artificially inflate traffic counts using a program (including scripts), device, or other means. Excessive page reloading or any other abuse of our system could result in legal action. No Publisher shall induce visitors to click on Creative based on incentives, provided, however, that, with the prior approval of Graphic Studio Central Ltd., certain language may appear above or below an advertisement served by Graphic Studio Central Ltd. The following methods of generating visitor interest are unacceptable to Graphic Studio Central Ltd. and may be grounds for dismissal from the digital advertising platform: use of unsolicited email or inappropriate newsgroup postings to promote your Website; auto-spawning of browsers; automatic redirecting of users; blind text links; misleading links; or any other method that may lead to artificially high numbers of impressions or clicks. 
                              </p>
                              <h2>Data Reporting (Stats)</h2>
                              <p class="text-justify">
                                   Graphic Studio Central Ltd. is the sole owner of all website, and aggregate web user data collected by Graphic Studio Central Ltd. Publisher only has access to Content. Graphic Studio Central Ltd. reserves the right to share data reporting with third parties on behalf of publisher. 
                              </p>
                              <h2>Contact Information</h2>
                              <p class="text-justify"> 
                                   To insure timely payment, Publishers are responsible for maintaining the correct contact and payment information associated with their account. Payment profile information must be updated by the last day of the month to be reflected in the next payment. This must be done online using the Publisher's Profile page. Any and all bank/service fees associated with returned or cancelled payments due to any error in the Publisher contact or payment information are Publisher's responsibility, and will be deducted from re-payment. 
                              </p>
                              <h2>Payment Policy </h2>
                              <p class="text-justify">
                                   Revenue will be calculated based on traffic measurements made by Graphic Studio Central Ltd’s (third party) ad server. For purposes of fair and accurate reporting, Graphic Studio Central Ltd’s traffic audits will be the sole source of traffic measurement for billing purposes. 
                              </p>
                              <p class="text-justify">
                                   Publishers will receive a revenue share that represents 30% of the Net Ad Revenues received by us for the sale of advertisements into the www.tefltv.com Video Player embedded into the Partner Sites. Net Ad Revenue means the gross revenues received by us from sales of advertising included in the www.tefltv.com Video Player embedded in the Partner Sites and containing the publisher's identification code, less potential applicable taxes.
                              </p>
                              <p class="text-justify">
                                   Publishers will be paid within 7 (seven) days after the end-of-month. Graphic Studio Central Ltd. will reconcile any traffic discrepancies with our partners in that 7 days reconciliation period. 
                              </p>
                              <p class="text-justify">
                                   It is agreed that Graphic Studio Central Ltd. may deduct any amount from the Publisher Program Revenues due (i) to the local authorities of any country as relevant and/or (ii) to enable the transfer and/or payment of any amounts due to Publisher. 
                              </p>
                              <p class="text-justify">
                                   For the avoidance of doubt, payments shall not be made to the benefit of any other person or entity other than Publisher. Furthermore, Publisher agrees that the payments shall only be made to a bank account bearing the same name as that of Publisher. All the payments shall be made through Paypal. 
                              </p>
                              <p class="text-justify">
                                   The Parties agree and acknowledge that Graphic Studio Central Ltd. is free to deduct from Publisher’ Program Revenues any bank fees that result from the error, negligence, or omission of Publisher in the communication of its bank account information to Graphic Studio Central Ltd.. Publisher shall also bear the fees for the use of any payment services such as Paypal. 
                              </p>
                              <p class="text-justify">
                                   No payments will be issued for any amounts less than $100.00. Guaranteed payments for balances of less than $100.00 will incur a service charge of $2.50. Net payments under $1.00 after service charge will not be made and are permanently forfeited. All unpaid earnings will rollover to the next pay period. Any Publisher account that is unpaid for six (6) months due to low traffic becomes subject to immediate payoff and immediate dismissal from our platform. 
                              </p>
                              <p class="text-justify">
                                   All payments are based on actual impressions as defined, accounted and audited by Graphic Studio Central Ltd. Graphic Studio Central Ltd. reserves the absolute right not to pay any accounts or Publishers that violate any of the terms and conditions set forth herein. Graphic Studio Central Ltd. will be responsible for determining, in its sole and absolute discretion, what acts and omissions violate this policy, and which acts include activity that is deceptive or fraudulent in nature. 
                              </p>
                              <p class="text-justify">
                                   Within thirty (30) days after the end of each calendar month during the Term, Graphic Studio Central Ltd. will provide Publisher a written or electronic report, or will enable Publisher to access such reports online, showing the bases for calculating the Net Revenue Share for such month (“Payment Reports”).
                              </p>
                              <h2>Costs and Taxes</h2>
                              <p class="text-justify">
                                   Except as otherwise expressly provided hereunder, each party will be responsible for all costs and expenses incurred by such party in connection with the performance of its obligations under this Agreement. Publisher shall pay all applicable taxes or fees imposed by any government authority in connection with Publisher’s user of the Services.
                              </p>
                              <h2>Payment Disputes</h2>
                              <p class="text-justify">
                                   If Publisher disputes any payment, Publisher must notify Graphic Studio Central Ltd. in writing within fifteen (15) days of Publisher’s (or its bank’s) receipt of any such payment or after the posting of the account statement in the online interface for a given month.  If Publisher does not notify Graphic Studio Central Ltd. within that time, Publisher shall waive any claims related to such disputed payment.  Payments shall be calculated solely based on records maintained by Graphic Studio Central Ltd. No other evidence, measurements or statistics of any kind shall be accepted by Graphic Studio Central Ltd. or have any effect under this Agreement
                              </p>
                              <h2>Proprietary Rights</h2>
                              <p class="text-justify">
                                   Subject to the terms and conditions of this Agreement, Website and Partner hereby grant Publisher a limited, non-exclusive, revocable, non-sub licensable, non-transferable license during the term of this Agreement to display Content on its website(s) for the purposes set forth in this Agreement. Publisher will not copy, alter, create derivative works of, distribute, or otherwise provide or re-syndicate the Content.
                              </p>
                              <p class="text-justify">
                                   www.tefltv.com and other www.tefltv.com graphics, logos, designs, page headers, button icons, scripts, and service names are registered trademarks, trademarks or trade dress of www.tefltv.com. www.tefltv.com ’s trademarks and trade dress may not be used in connection with any product or service without the prior written consent of www.tefltv.com. 
                              </p>
                              <h2>Indemnification: </h2>
                              <p class="text-justify">
                                   Publisher is solely responsible for any legal liability arising out of or relating to (i) the content and other material set forth on the Publisher Websites and/or (ii) any content or material to which users can link through the Publisher Websites (other than through an advertisement supplied by Graphic Studio Central Ltd.. Publisher hereby agrees to indemnify, defend and hold harmless Graphic Studio Central Ltd. and its officers, directors, agents, affiliates and employees from and against all claims, actions, liabilities, losses, expenses, damages, and costs (including, without limitation, reasonable attorneys' fees) that may at any time be incurred by any of them by reason of any claims, suits or proceedings (a) for libel, defamation, violation of right of privacy or publicity, copyright infringement, trademark infringement or other infringement of any third party right, fraud, false advertising, misrepresentation, product liability or violation of any law, statute, ordinance, rule or regulation throughout the world in connection with the Publisher Websites (except for advertisements supplied by Graphic Studio Central Ltd.; (b) arising out of any material breach by Publisher of any duty, representation or warranty under any agreement with Graphic Studio Central Ltd.; or (c) relating to a contaminated file, virus, worm, or Trojan horse originating from the Publisher Websites (other than through an advertisement supplied by Graphic Studio Central Ltd.. 
                              </p>
                              <h2>Damages</h2>
                              <p class="text-justify">
                                   In no event shall either party be liable for special, indirect, incidental, or consequential damages, including, but not limited to, loss of data, loss of use, or loss of profits arising there under or from the provision of services. 
                              </p>
                              <h2>Warranty Disclaimer</h2>
                              <p class="text-justify">
                                   Graphic Studio Central Ltd. do not make and hereby expressly disclaim all warranties, express or implied, with respect to any matter whatsoever, including, without limitation, the performance of any software programs incidental to services rendered by Graphic Studio Central Ltd., services provided there under, or any output or results thereof. Graphic Studio Central Ltd. and its Customers specifically disclaim any implied warranty of merchantability or fitness for a particular purpose. 
                              </p>
                              <h2>Limitation of Liability </h2>
                              <p class="text-justify">
                                   Neither Graphic Studio Central Ltd. nor its Partners will be subject to any liability whatsoever for (a) any failure to provide reference or access to all or any part of the Website due to systems failures or other technological failures of Graphic Studio Central Ltd. or of the Internet; (b) delays in delivery and/or non-delivery of Content, including, without limitation, difficulties with a Partner or Content, difficulties with a third-party server, or electronic malfunction; and (c) errors in content or omissions in any Creative. 
                              </p>
                              <h2>Applicability</h2>
                              <p class="text-justify">
                                   In This Agreement, including all attachments which are incorporated herein by reference, constitutes the entire agreement between the parties with respect to the subject matter hereof, and supersedes and replaces all prior and contemporaneous understandings or agreements, written or oral, regarding such subject matter. Applicable sections shall survive expiration or early termination of this Agreement. Nothing in this Agreement shall be deemed to create a partnership or joint venture between the parties and neither Graphic Studio Central Ltd. nor Publisher shall hold itself out as the agent of the other, except for that specified in this Agreement. Neither party shall be liable to the other for delays or failures in performance resulting from causes beyond the reasonable control of that party, including, but not limited to, acts of God, labor disputes or disturbances, material shortages or rationing, riots, acts of war, governmental regulations, communication or utility failures, or casualties. Failure by either party to enforce any provision of this Agreement shall not be deemed a waiver of future enforcement of that or any other provision. Any waiver, amendment or other modification of any provision of this Agreement shall be effective only if in writing and signed by the parties. If for any reason a court of competent jurisdiction finds any provision of this Agreement to be unenforceable, that provision of the Agreement shall be enforced to the maximum extent permissible so as to affect the intent of the parties, and the remainder of this Agreement shall continue in full force and effect. Headings used in this Agreement are for ease of reference only and shall not be used to interpret any aspect of this Agreement. In addition to terms that are negotiated and documented separately from this Agreement, terms that are automatically generated through the interactive use of the Graphic Studio Central Ltd. website Publisher interface are explicitly bound by this Agreement. 
                              </p>
                              <h2>Public Release</h2>
                              <p class="text-justify">
                                   Publisher shall not release any information regarding Content or Publishers relationship with Graphic Studio Central Ltd. or its Users or Partners, including, without limitation, in press releases or promotional or merchandising materials, without the prior written consent of Graphic Studio Central Ltd. Graphic Studio Central Ltd. shall have the right to reference and refer to its work for, and relationship with, Publisher for marketing and promotional purposes. No press releases or general public announcements shall be made without the mutual consent of Graphic Studio Central Ltd. and Publisher. 
                              </p>
                              <h2>Remedy</h2>
                              <p class="text-justify">
                                   If any Publisher violates or refuses to partake in their responsibilities, or commits fraudulent activity against us, Graphic Studio Central Ltd. reserves the right to withhold payment and take appropriate legal action to cover its damages. 
                              </p>
                              <h2>Audit</h2>
                              <p class="text-justify">
                                   Graphic Studio Central Ltd. shall have the sole responsibility for calculation of Publisher earnings, including Impressions and click through numbers. In the event Publisher disagrees with any such calculation, a written request should be sent immediately to Graphic Studio Central Ltd. Graphic Studio Central Ltd. will provide Publisher with an explanation or adjustment of the numbers which shall be final and binding. 
                              </p>
                              <h2> Modifications:</h2>
                              <p class="text-justify">
                                   Graphic Studio Central Ltd. reserves the right to change any conditions of this contract at any time. Members are responsible for complying with any changes to the Graphic Studio Central Ltd. Publisher Agreement within 10 business days from the date of change. Graphic Studio Central Ltd. will post any changes to this Agreement in the Publisher area of the Graphic Studio Central Ltd. Website. 
                              </p>
                              <h2>Privacy</h2>
                              <p class="text-justify">
                                   Publisher shall support Graphic Studio Central Ltd's commitment to protect the privacy of the online community; such commitment is set forth in Graphic Studio Central Ltd's Privacy Policy, which is hereby incorporated into this Agreement. 
                              </p>
                              <p class="text-justify">
                                   We will endeavor to make sure our policies and practices in relation to the collection, use, retention, transfer and access of personal data (as defined in the Ordinance) supplied by you comply with the requirements of the Personal Data (Privacy) Ordinance (Cap. 486, the laws of Hong Kong) (the “Ordinance”). 
                              </p>
                              <p class="text-justify">
                                   You may be requested by us to give information (including but not limited to your personal particulars, operating system, browser version, domain name, IP address and details of your website) on a voluntary basis when you apply to us and continue to subscribe with us for an account, our services and/or products. You shall consult your parent or guardian before giving us your personal data if you are under the age of eighteen. 
                              </p>
                              <p class="text-justify">
                                   You have the right to refuse providing your personal data to us. However, certain functions and/or services may not be available to you if such personal data is not supplied, incomplete, incorrect, or misleading.
                              </p>
                              <p class="text-justify">
                                   Personal data supplied by you will be retained in one or more of our databases and in different formats and be secured with restricted access by our authorized personnel through appropriate security protocols for authentication and authorization (which may include the use of SSL, encryption, firewalls and data backup). Your personal data will be kept in the strictest confidence and for a reasonable period necessary to attain the above-specified purposes. 
                              </p>
                              <p class="text-justify">
                                   Personal data supplied by you may be used for any of the following purposes and/or for other purposes as may be agreed between you and us and/or as required by law: 
                              </p>
                              <ul style="list-style:none;">
                                   <li><i class="fa fa-check"></i> registering, operating or maintaining your account with us; </li>
                                   <li><i class="fa fa-check"></i> purchasing goods and/or subscribing for services rendered by us;</li>
                                   <li><i class="fa fa-check"></i> facilitating and following up your online transactions with us, including but not limited to processing of any payment instructions;</li>
                                   <li><i class="fa fa-check"></i> marketing of goods and/or services of our parent company and/or its respective subsidiaries and affiliated companies (please see further paragraph 6 herein below);</li>
                                   <li><i class="fa fa-check"></i> enabling us to comply with our obligations to interconnect or comply with industry practices; and/or </li>
                                   <li><i class="fa fa-check"></i> serving any purposes relating to any of the foregoing.</li>
                              </ul>
                              <p class="text-justify">
                                   <b>Personal data supplied by you may be used for direct marketing activities (as defined in the Ordinance) only in accordance with the requirements set out under the Ordinance. In that event, you will be:- </b>
                              </p>
                              <ul style="list-style:none;">
                                   <li><i class="fa fa-check"></i> informed that your personal data will be used for direct marketing activities;</li>
                                   <li><i class="fa fa-check"></i> informed of, with specific information, the kinds of personal data to be used and the classes of marketing subjects in relation to which the personal data is to be used;</li>
                                   <li><i class="fa fa-check"></i> informed that your personal data will not be used unless we have received your written consent;</li>
                                   <li><i class="fa fa-check"></i> provided, in case your consent to the use of personal data for direct marketing activities is given orally, a written confirmation within 14 days after receiving your oral consent;</li>
                                   <li><i class="fa fa-check"></i> given opportunity to communicate your consent at no extra charge from us;</li>
                                   <li><i class="fa fa-check"></i> notified the first time your personal data is used for direct marketing activities and that we will cease to use your personal data for direct marketing activities if you wish; and</li>
                                   <li><i class="fa fa-check"></i> given the liberty, at any time, to require cessation of the use of your personal data for direct marketing activities at no extra charge from us</li>
                              </ul>
                              <p class="text-justify">
                                   <b>We will not release personal data supplied by you to third parties except in accordance with the Ordinance or in the event of such release is requested by: </b>
                              </p>
                              <ul style="list-style:none;">
                                   <li><i class="fa fa-check"></i> governmental and/or regulatory and/or statutory authorities and/or court orders in compliance with applicable laws; or</li>
                                   <li><i class="fa fa-check"></i> third party service providers which provide supporting services to us; who (i) are under duty of confidentiality to us with respect to the use, hold, process, retain and/or transfer of personal data supplied by you; and (ii) have the need to know or handle such personal data (please see further paragraph 8 herein below). </li>
                              </ul>
                              <p class="text-justify">
                                   <b>Personal data supplied by you may be provided to third parties for direct marketing activities (i.e. cross-marketing) only in accordance with the requirements set out under the Ordinance. In that event, you will be:- </b>
                              </p>
                              <ul style="list-style:none;">
                                   <li><i class="fa fa-check"></i> informed in writing of our intention to provide your personal data to third parties for direct marketing activities;</li>
                                   <li><i class="fa fa-check"></i> informed of, with specific information, the kinds of personal data to be provided, the classes of marketing subjects and the class of persons in relation to which the personal data is to be provided;</li>
                                   <li><i class="fa fa-check"></i> informed in writing that provision of your personal data to third parties for direct marketing activities will be for gain (if that is the case);</li>
                                   <li><i class="fa fa-check"></i> informed that your personal data will not be provided to third parties for direct marketing activities unless we have received your written consent;</li>
                                   <li><i class="fa fa-check"></i> given opportunity to communicate your consent at no extra charge from us; and</li>
                                   <li><i class="fa fa-check"></i> given the liberty, at any time, to require the cessation of our provision of personal data to third parties for direct marketing activities and notify the third party to cease the use of your personal data in direct marketing activities at no extra charge from us.</li>
                              </ul>
                              <p class="text-justify">Notwithstanding our security measures for protecting your personal data, you acknowledge that no data transmission over the Internet is completely secure, and by providing your personal data you are transmitting information at your own risk. </p>
                              <p class="text-justify">
                                   <b>Under and in accordance with the Ordinance, among others, you have the rights: </b>
                              </p>
                              <ul style="list-style:none;">
                                   <li><i class="fa fa-check"></i> to check whether we are holding your personal data;</li>
                                   <li><i class="fa fa-check"></i> to access your personal data held by us; and/or</li>
                                   <li><i class="fa fa-check"></i> to require us to correct any of your personal data which is or has become inaccurate.</li>
                              </ul>
                              <p class="text-justify">
                                   Cookies are small bits of data automatically stored in the hard drive of the end user, which can save the user from registering again when re-visiting a web site and are commonly used to track preferences in relation to the subject of such website. If you enable these cookies, then your web browser adds the text in a small file. You may wish to set your web browser to notify you of a cookie placement request or refuse to accept cookies by modifying relevant internet options or browsing preferences of your computer system, but to do so you may not be able to utilize or activate certain available functions on this Website. 
                              </p>
                              <p class="text-justify">
                                   We may have third party merchants or service providers hosted in this Website which are operated by third party merchants or service providers. If you want to use, order or receive any services and/or products from any of them, you shall take the risk that personal data supplied by you, once transferred to any of such merchants or service providers, will be beyond our control and thus outside the scope of protection afforded by us. 
                              </p>
                              <h2>Assignment</h2>
                              <p class="text-justify">
                                   Publisher may not assign this Agreement, in whole or in part, without written consent from Graphic Studio Central Ltd. Any attempt to assign this Agreement without such consent will be null and void. 
                              </p>
                              <h2>Confidentiality </h2>
                              <p class="text-justify">
                                   The Parties agree that the terms are confidential. The Parties shall each keep the terms and conditions of this Agreement and its subject matter confidential and agree not to disclose such information, including, without limitation, documents and information related to products, clients, strategy, development, financial, business practices, to any third parties except as necessary to any business and legal representatives or as necessary to perform the obligations under these Terms. 
                              </p>
                              <h2>
                                   Electronic communications
                              </h2>
                              <p class="text-justify">
                                   The communications between you and www.tefltv.com use electronic means, whether you visit the Website or App or otherwise use the Service or send www.tefltv.com e-mails, or whether www.tefltv.com posts notices on the Website or App or communicates with you via e-mail. For contractual purposes, you (a) consent to receive communications from www.tefltv.com  in an electronic form; and (b) agree that all terms and conditions, agreements, notices, disclosures, and other communications that www.tefltv.com  provides to you electronically satisfy any legal requirement that such communications would satisfy if it were be in writing. The foregoing does not affect your statutory rights.
                              </p>
                              <h2>Governing Law and Arbitration </h2>
                              <p class="text-justify">
                                   This Agreement shall be governed by the laws of the Hong Kong without giving effect to any conflict of laws principles that may provide the application of the law of another jurisdiction. You shall always comply with all the international and domestic laws, ordinance, regulations and statutes that are applicable to your use of the Services.
                              </p>
                              <h2>Ability to Enter into Agreement</h2>
                              <p class="text-justify">
                                   By executing this Agreement, Publisher warrants that Publisher (or Authorized Representative of Publisher) is at least 18 years of age, and that there is no legal reason that Publisher cannot enter into a binding contract.
                              </p>
                              <h2>Relationship of Parties</h2>
                              <p class="text-justify">
                                   You and we are independent contractors, and nothing in this Agreement will create any Partnership, joint venture, agency, franchise, sales representative, or employment relationship between us. You have no authority to make or accept any offers or representations on our behalf. You will not make any statement, whether on your site or in any other place, that would reasonably contradict anything in this section.
                              </p>
                              <h2>Termination</h2>
                              <p class="text-justify">
                                   Graphic Studio Central Ltd. reserves the right to terminate any Publisher's relationship with the Graphic Studio Central Ltd. platform at any time, with or without cause. Termination notice may be provided via email or any other public means and will be effective immediately. Upon receipt of such termination notice, Publisher agrees to immediately remove from his/her website Graphic Studio Central Ltd's html code for serving Creative from Graphic Studio Central Ltd. Publisher will be paid, in the next scheduled payment cycle, all legitimate earnings due up to the time of termination.
                              </p>
                              <hr/>
  
                         </div>
                         <input type="checkbox" > <span><b>I have read and agreed to the tems and conditions stated above.</b></span>
                    </div>
               </div>
               <div class="text-right mg-b-20">
                    <br />
                    <p class="notes">Please read terms and condition and click the checkbox at the bottom of the contex if you agree with it.</p>
                    {{Form::submit('Agree and Submit Application', array('class' => 'btn btn-primary')   )}}
                    {{Form::close()}}
               </div>
          </div>
     </div>
</div>

<div class="col-md-4">
     @include('elements/publishers/video')
     <br/>
     @include('elements/publishers/support')
</div>
</div>
</div>
@stop