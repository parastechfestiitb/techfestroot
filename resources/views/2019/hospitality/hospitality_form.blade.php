<div class="container">
    <div class="row">
        <div class="col-sm-12 ">
            <!--      Wizard container        -->
            <div class="wizard-container">
                <div class="card wizard-card" data-color="red" id="wizard">
                    <form action="/hospitality/form_submit" method="post">
                        {!! csrf_field() !!}
                        <div class="wizard-header">
                            <h3 class="wizard-title">
                                Book a Room
                            </h3>
                            <h5>This information will let us know more about you.</h5>
                        </div>
                        <div class="wizard-navigation">
                            <ul>
                                <li><a href="#details" data-toggle="tab">Details</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane" id="details">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="info-text"> Let's start with the basic details.</h4>
                                    </div>
                                    <div class="col-md-12">
                                        @for($i =0; $i < $number_of_people->people; $i++)
                                            Member {{$i+1}} Details
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group label-floating" >
                                                        <label class="control-label">Name</label>
                                                        <input class="form-control"  name ="name{{$i}}" value="" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Contact Number</label>
                                                        <input type="number" class="form-control" name ="number{{$i}}" value="" max="9999999999" min="1000000000" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group label-floating" >

                                                        <label class="control-label">Email</label>
                                                        <input type="email" class="form-control"  id="email0" name ="email{{$i}}" value="" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group label-floating" >
                                                        <label class="control-label">Gender</label>
                                                        <select name="gender{{$i}}" class="form-control">
                                                            <option disabled="" selected=""></option>
                                                            <option value="Male"> Male </option>
                                                            <option value="Female"> Female </option>
                                                            <option value="Other"> Other </option>
                                                        </select>
                                                    </div>
                                                </div>
{{--                                                <div class="col-sm-2">--}}
{{--                                                    <div class="form-group label-floating" >--}}

{{--                                                        <label class="control-label">Team ID</label>--}}
{{--                                                        <input class="form-control"  name ="team_id{{$i}}" value="" required>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                            </div>
                                            <hr>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wizard-footer">
                            <input type='submit' class='btn btn-fill btn-danger btn-wd' name='next' value='Submit' />
                        </div>
                        <input type="hidden"  name ="number_of_people" value="{{$number_of_people->people}}" required>

                    </form>
                </div>
            </div> <!-- wizard container -->
        </div>
    </div> <!-- row -->
</div> <!--  big container -->
