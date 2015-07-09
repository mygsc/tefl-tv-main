<style type="text/css">
	.btn {
    display: inline-block;
    position: relative;
    padding: 7px 30px;
    border: 0;
    /* margin: 10px 1px; */
    cursor: pointer;
    border-radius: 2px;
    text-transform: uppercase;
    text-decoration: none;
    color: rgba(255, 255, 255, 0.84);
    transition: background-color 0.2s ease, box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1);
    outline: none !important;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
}
.btn-primary {
    color: #fff;
    background-color: #2c436c;
    border-color: #2e6da4;
}
.btn-primary.active, .btn-primary.focus, .btn-primary:active, .btn-primary:focus, .btn-primary:hover, .open>.dropdown-toggle.btn-primary {
    color: #fff;
    background-color: #223353;
    border-color: #204d74;
}
</style>
<table>
	<tr>
		<td width="30%">
			<div style="width:100%; height:auto; background:#FFF;padding:10px 20px;border-radius:10px 0 0 10px;border:1px solid #494848;">
				<img src="http://www.test.tefltv.com/img/logos/teflTv.png" style="width:150px;height:auto;">
			</div>
		</td>
		<td style="width:70%; background:#D1DFF9;border-left:20px solid #1F3359;border-radius:0 10px 10px 0;">
			<div style="width:720px; height:auto; padding:20px 20px;">
				Dear {{$first_name}}!<br>
				<br>
				<p>Thank you for registering with tefltv.com.</p>
				<p> JUST ONE MORE STEP. </p>
				<a href='{{$url}}'><button class="btn btn-primary">Activate your account.</button></a><br/>

				<p><b>IMPORTANT!</b> This activation is valid for 7 days only.  Please activate your login promptly! </p>
 
				<p>Sincerely yours,</p>
				<p>Tefltv support</p>
			</div>
		</td>
	</tr>
</table>


