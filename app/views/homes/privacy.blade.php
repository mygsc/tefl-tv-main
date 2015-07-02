@extends('layouts.default')

@section('content')
<div class="container">
	<div class="row mg-t-10">
			<div class="col-md-3 col-md-height col-top hidden-xs hidden-sm ">
				<div class="mg-r-10 row mg-t--10">
					@include('elements/home/categories')
					<div>
						@include('elements/home/adverstisement_half_large_recatangle')
					</div>

					<div class="float-div">
						<div class="mg-t-10">
							@include('elements/home/carouselAds')
						</div>
						<div class="mg-t-10">
							@include('elements/home/adverstisementSmall')
						</div>
					</div>
				</div>
			</div>
		<div class="col-md-8 White sameH-h text-justify mg-t-10 same-H col-md-height col-top ">
			<br/>
			<div class="content-padding post-entry">
				<h1>PRIVACY POLICY</h1>
				<br/>
				<p> 
					1. We will endeavor to make sure our policies and practices in relation to the collection, use, retention, transfer and access of personal data (as defined in the Ordinance) supplied by you comply with the requirements of the Personal Data (Privacy) Ordinance (Cap. 486, the laws of <b>Hong Kong) (the “Ordinance”)</b>.
				</p>
				<br/>
				<p>
					2. You may be requested by us to give information (including but not limited to your personal particulars, operating system, browser version, domain name, IP address and details of your website) on a voluntary basis when you apply to us and continue to subscribe with us for an account, our services and/or products. You shall consult your parent or guardian before giving us your personal data if you are under the age of eighteen.
				</p>
				<br/>
				<p>
					3. You have the right to refuse providing your personal data to us. However, certain functions and/or services may not be available to you if such personal data is not supplied, incomplete, incorrect, or misleading. 
				</p>
				<br/>
				<p>
					4. Personal data supplied by you will be retained in one or more of our databases and in different formats and be secured with restricted access by our authorized personnel through appropriate security protocols for authentication and authorization (which may include the use of SSL, encryption, firewalls and data backup). Your personal data will be kept in the strictest confidence and for a reasonable period necessary to attain the above-specified purposes. 
				</p>
				<br/>
				<p>
					5. Personal data supplied by you may be used for any of the following purposes and/or for other purposes as may be agreed between you and us and/or as required by law:
				</p>
				<ul>
					<li> registering, operating or maintaining your account with us; </li>
					<li>  purchasing goods and/or subscribing for services rendered by us; </li>
					<li> facilitating and following up your online transactions with us, including but not limited to processing of any payment instructions; </li>
					<li> marketing of goods and/or services of our parent company and/or its respective subsidiaries and affiliated companies (please see further paragraph 6 herein below); </li>
					<li> enabling us to comply with our obligations to interconnect or comply with industry practices; and/or </li>
					<li>  serving any purposes relating to any of the foregoing. </li>
				</ul>
				<br/>
				<p>
					6. Personal data supplied by you may be used for direct marketing activities (as defined in the Ordinance) only in accordance with the requirements set out under the Ordinance. In that event, you will be:- 
				</p>
				<ul>
					<li> informed that your personal data will be used for direct marketing activities;</li>
					<li> informed of, with specific information, the kinds of personal data to be used and the classes of marketing subjects in relation to which the personal data is to be used;</li>
					<li>informed that your personal data will not be used unless we have received your written consent;</li>
					<li>provided, in case your consent to the use of personal data for direct marketing activities is given orally, a written confirmation within 14 days after receiving your oral consent;</li>
					<li> given opportunity to communicate your consent at no extra charge from us;</li>
					<li> notified the first time your personal data is used for direct marketing activities and that we will cease to use your personal data for direct marketing activities if you wish; and </li>
					<li> given the liberty, at any time, to require cessation of the use of your personal data for direct marketing activities at no extra charge from us </li>
				</ul>
				<br/>
				<p> 
					7. We will not release personal data supplied by you to third parties except in accordance with the Ordinance or in the event of such release is requested by: 
				</p>
				<ul>
					<li> governmental and/or regulatory and/or statutory authorities and/or court orders in compliance with applicable laws; or </li>
					<li> third party service providers which provide supporting services to us; who (i) are under duty of confidentiality to us with respect to the use, hold, process, retain and/or transfer of personal data supplied by you; and (ii) have the need to know or handle such personal data (please see further paragraph 8 herein below).  </li>
				</ul>
				<br/>
				<p>
					8. Personal data supplied by you may be provided to third parties for direct marketing activities (i.e. cross-marketing) only in accordance with the requirements set out under the <b>Ordinance </b>. In that event, you will be:- 
				</p>
				<ul>
					<li> informed in writing of our intention to provide your personal data to third parties for direct marketing activities;</li>
					<li> informed of, with specific information, the kinds of personal data to be provided, the classes of marketing subjects and the class of persons in relation to which the personal data is to be provided;</li>
					<li> informed in writing that provision of your personal data to third parties for direct marketing activities will be for gain (if that is the case);</li>
					<li> informed that your personal data will not be provided to third parties for direct marketing activities unless we have received your written consent; </li>
					<li> given opportunity to communicate your consent at no extra charge from us; and </li>
					<li> given the liberty, at any time, to require the cessation of our provision of personal data to third parties for direct marketing activities and notify the third party to cease the use of your personal data in direct marketing activities at no extra charge from us. </li>
				</ul>
				<br/>
				<p> 
					9. Notwithstanding our security measures for protecting your personal data, you acknowledge that no data transmission over the Internet is completely secure, and by providing your personal data you are transmitting information at your own risk. 
				</p>
				<br/>
				<p> 
					10. Under and in accordance with the Ordinance, among others, you have the rights: 
				</p>
				<ul>
					<li> to check whether we are holding your personal data; </li>
					<li> to access your personal data held by us; and/or </li>
					<li> to require us to correct any of your personal data which is or has become inaccurate. </li>
				</ul>
				<br/>
				<p> 
					11. Cookies are small bits of data automatically stored in the hard drive of the end user, which can save the user from registering again when re-visiting a web site and are commonly used to track preferences in relation to the subject of such website. If you enable these cookies, then your web browser adds the text in a small file. You may wish to set your web browser to notify you of a cookie placement request or refuse to accept cookies by modifying relevant internet options or browsing preferences of your computer system, but to do so you may not be able to utilize or activate certain available functions on this Website.
				</p>
				<br/>
				<p>
					12. We may have third party merchants or service providers hosted in this Website which are operated by third party merchants or service providers. If you want to use, order or receive any services and/or products from any of them, you shall take the risk that personal data supplied by you, once transferred to any of such merchants or service providers, will be beyond our control and thus outside the scope of protection afforded by us. 
				</p>
				<br/>
				<p>
					13. If you have any requests for access to your personal data or for the correction of your personal data, or if you would like any further information regarding our policies and practices, please address your enquiries to: - 
				</p>
				<br/>
				<p>
					<b>The Personal Data Officer </b> <br/>
					9B, Amtel Building, <br/>
					148 Des Voeux Road Central, <br/>
					Central Hongkong<br/>
					Email : privacy@tefltv.com 
				</p>
			</div>
		</div><!--/.col-md-9 left section, writeUps-->
	</div><!--/.container page-->
</div>
	@stop
