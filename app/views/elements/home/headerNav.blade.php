    <div class="categoryNav">

        <div class="container">

        <div class="row">
            <div class="col-md-8 text-left"> 
                <div class="row">
                    <ul class="ctgryNav" style="margin-left:-40px;">
                        <li>
                            {{ link_to_route('homes.popular', 'Popular', null) }}
                        </li>
                        <li>
                            {{ link_to_route('homes.latest', 'Latest', null) }}
                        </li>
                        <li>
                            {{ link_to_route('homes.random', 'Random', null) }}
                        </li>
                        <li>
                            {{ link_to_route('homes.channels', 'Channels', null) }}
                        </li>

                        
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row text-right">
                    <ul class="ctgryNav" >
                        <li>
                           {{ link_to_route('homes.signin', 'Sign-in', null, array('class' => 'btn btn-info whiteC accntbtn')) }}
                       </li>
                    </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
