    <div class="categoryNav">

        <div class="container">

            <div class="row">
                <div class="col-md-8 text-left"> 
                    <div class="row">
                        <ul class="ctgryNav" style="margin-left:-40px;">
                            <li>
                                {{ link_to_route('home.popular', 'Popular', null) }}
                            </li>
                            <li>
                                {{ link_to_route('home.latest', 'Latest', null) }}
                            </li>
                            <li>
                                {{ link_to_route('home.random', 'Random', null) }}
                            </li>
                            <li>
                                {{ link_to_route('home.channels', 'Top Channels', null) }}
                            </li>

                        </ul>
                    </div><!--/.ctgryNav-->
                </div><!--/.col-md-8 text-left-->

                <div class="col-md-4">
                    <div class="row text-right">
                        <ul class="ctgryNav" >
                            <li>
                                {{ link_to_route('home.signup', 'Sign-in', null, array('class' => 'btn btn-info whiteC accntbtn')) }}
                            </li>

                            <li>
                                {{ link_to_route('user.upload', 'Upload', null, array('class' => 'btn btn-primary orangeC')) }}
                            </li>
                        </ul><!--./ctgryNav-->
                    </div><!--/.row text-right-->
                </div><!--/.col-md-4-->
            </div><!--/.row-->

        </div><!--/.container-->

    </div><!--/.categoryNav-->
