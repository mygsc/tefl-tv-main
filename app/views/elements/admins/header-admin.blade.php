<div class="brandingHeader">
  <div class="container">
     <div class="row">
        <div class="col-md-3">
            <div class="row">
                <a href="/"><img src="/img/nav-effect-b.png" class="text-left" title="redirect to homepage"></a>
            </div><!--/.row or col-30-->
        </div><!--/.col-md-3-->

        <div class="col-md-offset-4 col-md-5">
            <div class="row">
                <br/>
                
            
            </div><!--/.row-->
        </div><!--/.col-md-5-->
    </div><!--/.first row-->
</div><!--/.container-->
</div><!--/.brandingHeader-->
<div class="categoryNav">
    <div class="container">
        <div class="row">
            <div class="col-md-12"> 
                <div class="">
                    <ul class="ctgryNav mg-l-65">
                        <li>{{ link_to_route('get.admin.users', 'Users', null, array('class' => 'btn')) }}</li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle btn" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Users  <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>{{ link_to_route('get.admin.users', 'List of Users', null, array('class' => '')) }}</li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle btn" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Videos  <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>{{ link_to_route('get.admin.recommendedvideos', 'Recommended Videos', null, array('class' => '')) }}</li>
                                <li>{{ link_to_route('get.admin.reportedvideos', 'Reported Videos', null, array('class' => '')) }}</li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle btn" data-toggle="dropdown" role="button" aria-expanded="false">
                                Admin Setting  <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>{{ link_to_route('get.admin.changepassword', 'Change Password', null, array('class' => '')) }}</li>
                                <li>{{ link_to_route('get.admin.resetpassword', 'Reset Password', null, array('class' => '')) }}</li>
                                <li>{{ link_to_route('get.admin.createadminlink', 'Admin Registration Code', null, array('class' => '')) }}</li>
                            </ul>
                        </li>
                        <li>{{ link_to_route('get.admin.reports', 'Reports', null, array('class' => '')) }}</li>
                        <li>{{ link_to_route('get.admin.disputes', 'Disputes', null, array('class' => '')) }}</li>
                        <li class="pull-right">{{ link_to_route('admin.logout', 'Logout', null, array('class' => '')) }}</li>
                       
                        
                    </ul>
                </div>
            </div><!--/.col-md-4-->
        </div><!--/.row-->
   </div><!--/.container-->
</div><!--/.categoryNav-->



