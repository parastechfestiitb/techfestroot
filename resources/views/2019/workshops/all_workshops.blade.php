<style>
    @media (max-width: 992px)  {
        .col-md-3{
            min-height: 42vw;
        }
    }
    @media (min-width: 992px)  {
        .workshop_div{
            min-height: 22vw;
        }
    }
</style>
<div class="col-md-1"></div>
<div class="col-md-10">
    <div class="row">
        @foreach($all_workshops_info as $workshop)
            <a href="/workshops/{{$workshop->link}}">
                <div class="col-md-3 col-xs-6 workshop_div" style="padding-bottom: 15px;display: inline-table">
                    <div class="ft-recipe" >
                        <div class="ft-recipe__thumb">
                            <img src="{{$workshop->image}}" alt="{{$workshop->name}} Techfest Workshop"/>
                        </div>
                        <div class="ft-recipe__content" style="min-height: 4em;">
                            <h4 style="text-align: center;margin: 3px 0px;font-size: 1.2em;">{{$workshop->name}}</h4>
                            <p class="description">{!! $workshop->description !!}</p>
                            <footer class="content__footer"><a style="width: 100%" href="/workshops/{{$workshop->link}}">Register</a></footer>
                        </div>
                    </div>
                </div>
            </a>

        @endforeach
    </div>
</div>
<div class="col-md-1"></div>